<?php

use Libraries\Gateways\BasePaymentGateway;
use Libraries\Gateways\Contracts\PaymentGateway;
use MercadoPago\Payment;
use MercadoPago\SDK;
use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;

class MercadoPago extends BasePaymentGateway
{
    /** @var SDK $mercadoPagoApi */
    private $mercadoPagoApi;

    private $mercadoPagoConfig;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->config('payment_gateways');
        $this->ci->load->model('Os_model');
        $this->ci->load->model('vendas_model');
        $this->ci->load->model('cobrancas_model');
        $this->ci->load->model('Sgtos_model');
        $this->ci->load->model('email_model');

        $mercadoPagoConfig = $this->ci->config->item('payment_gateways')['MercadoPago'];
        $this->mercadoPagoConfig = $mercadoPagoConfig;

        $mercadoPagoApi = new SDK();
        $mercadoPagoApi->setAccessToken($mercadoPagoConfig['credentials']['access_token']);
        $mercadoPagoApi->setPublicKey($mercadoPagoConfig['credentials']['public_key']);
        $mercadoPagoApi->setClientSecret($mercadoPagoConfig['credentials']['client_secret']);
        $mercadoPagoApi->setClientId($mercadoPagoConfig['credentials']['client_id']);
        $mercadoPagoApi->setIntegratorId($mercadoPagoConfig['credentials']['integrator_id']);
        $mercadoPagoApi->setPlatformId($mercadoPagoConfig['credentials']['platform_id']);
        $mercadoPagoApi->setCorporationId($mercadoPagoConfig['credentials']['corporation_id']);

        $this->mercadoPagoApi = $mercadoPagoApi;
    }

    public function cancelar($id)
    {
        $cobranca = $this->ci->cobrancas_model->getById($id);
        if (!$cobranca) {
            throw new \Exception('Cobrança não existe!');
        }

        $payment = Payment::find_by_id($cobranca->charge_id);
        if ($payment->Error()) {
            throw new \Exception($payment->Error());
        }

        $payment->status = 'cancelled';
        $payment->update();
        if ($payment->Error()) {
            throw new \Exception($payment->Error());
        }

        return $this->atualizarDados($id);
    }

    public function enviarPorEmail($id)
    {
        $cobranca = $this->ci->cobrancas_model->getById($id);
        if (!$cobranca) {
            throw new \Exception('Cobrança não existe!');
        }

        $emitente = $this->ci->Sgtos_model->getEmitente();
        if (!$emitente) {
            throw new \Exception('Emitente não configurado!');
        }

        $html = $this->ci->load->view(
            'cobrancas/emails/cobranca',
            [
                'cobranca' => $cobranca,
                'emitente' => $emitente[0],
                'paymentGatewaysConfig' => $this->ci->config->item('payment_gateways'),
            ],
            true
        );

        $assunto = "Cobrança - " . $emitente[0]->nome;
        if ($cobranca->os_id) {
            $assunto .= ' - OS #' . $cobranca->os_id;
        } else {
            $assunto .= ' - Venda #' . $cobranca->vendas_id;
        }

        $remetentes = [$cobranca->email];
        foreach ($remetentes as $remetente) {
            $headers = [
                'From' => $emitente[0]->email,
                'Subject' => $assunto,
                'Return-Path' => ''
            ];
            $email = [
                'to' => $remetente,
                'message' => $html,
                'status' => 'pending',
                'date' => date('Y-m-d H:i:s'),
                'headers' => serialize($headers),
            ];
            $this->ci->email_model->add('email_queue', $email);
        }
    }

    public function atualizarDados($id)
    {
        $cobranca = $this->ci->cobrancas_model->getById($id);
        if (!$cobranca) {
            throw new \Exception('Cobrança não existe!');
        }

        $payment = Payment::find_by_id($cobranca->charge_id);
        if ($payment->Error()) {
            throw new \Exception($payment->Error());
        }

        // Cobrança foi paga ou foi confirmada de forma manual, então damos baixa
        if ($payment->status === 'approved') {
            // TODO: dar baixa no lançamento caso exista
        }

        $databaseResult = $this->ci->cobrancas_model->edit(
            'cobrancas',
            [
                'status' => $payment->status
            ],
            'idCobranca',
            $id
        );

        if ($databaseResult == true) {
            $this->ci->session->set_flashdata('success', 'Cobrança atualizada com Éxito');
            log_info('Alterou um status de cobrança. ID' . $id);
        } else {
            $this->ci->session->set_flashdata('error', 'Erro ao atualizar cobrança!');
            throw new \Exception('Erro ao atualizar cobrança!');
        }
    }

    public function confirmarPagamento($id)
    {
        $cobranca = $this->ci->cobrancas_model->getById($id);
        if (!$cobranca) {
            throw new \Exception('Cobrança não existe!');
        }

        $payment = Payment::find_by_id($cobranca->charge_id);
        if ($payment->Error()) {
            throw new \Exception($payment->Error());
        }

        $payment->capture();
        if ($payment->Error()) {
            throw new \Exception($payment->Error());
        }

        return $this->atualizarDados($id);
    }

    protected function gerarCobrancaBoleto($id, $tipo)
    {
        $entity = $this->findEntity($id, $tipo);
        $produtos = $tipo === PaymentGateway::PAYMENT_TYPE_OS
            ? $this->ci->Os_model->getProdutos($id)
            : $this->ci->vendas_model->getProdutos($id);
        $servicos = $tipo === PaymentGateway::PAYMENT_TYPE_OS
            ? $this->ci->Os_model->getServicos($id)
            : [];
        $desconto = [$tipo === PaymentGateway::PAYMENT_TYPE_OS
            ? $this->ci->Os_model->getById($id)
            : $this->ci->vendas_model->getById($id)];
        $tipo_desconto = [$tipo === PaymentGateway::PAYMENT_TYPE_OS
            ? $this->ci->Os_model->getById($id)
            : $this->ci->vendas_model->getById($id)];

        $totalProdutos = array_reduce(
            $produtos,
            function ($total, $item) {
                return $total + (floatval($item->preco) * intval($item->quantidade));
            },
            0
        );
        $totalServicos = array_reduce(
            $servicos,
            function ($total, $item) {
                return $total + (floatval($item->preco) * intval($item->quantidade));
            },
            0
        );
        $tipoDesconto = array_reduce(
            $tipo_desconto,
            function ($total, $item) {
                return $item->tipo_desconto;
            },
            0
        );
        $totalDesconto = array_reduce(
            $desconto,
            function ($total, $item) {
                return $item->desconto;
            },
            0
        );

        if (empty($entity)) {
            throw new \Exception('OS ou venda não existe!');
        }

        if (($totalProdutos + $totalServicos) <= 0) {
            throw new \Exception('OS ou venda com valor negativo ou zero!');
        }

        if ($err = $this->errosCadastro($entity)) {
            throw new \Exception($err);
        }

        $clientNameParts = explode(' ', $entity->nomeCliente);
        $documento = preg_replace('/[^0-9]/', '', $entity->documento);
        $expirationDate = (new DateTime())->add(new DateInterval($this->mercadoPagoConfig['boleto_expiration']));
        $expirationDate = ($expirationDate->format(DateTime::RFC3339_EXTENDED));


        /*$payment = new Payment();
        $payment->transaction_amount = floatval($this->valorTotal($totalProdutos, $totalServicos, $totalDesconto, $tipoDesconto));
        $payment->description = PaymentGateway::PAYMENT_TYPE_OS ? "OS #$id" : "Venta #$id";
        $payment->payment_method_id = "";
        //$payment->notification_url = base_url();
        $payment->notification_url = 'https://mi-iphone.com.ar/mp_logs';
        //$payment->date_of_expiration = $expirationDate;
        $payment->payer = [
            'email' => $entity->email,
            'first_name' => $clientNameParts[0],
            'last_name' => $clientNameParts[count($clientNameParts) - 1],
            'identification' => [
                'type' => 'DNI', // strlen($documento) == 11 ? 'CPF' : 'CNPJ',
                'number' => $documento
            ],
            'address' => [
                'zip_code' => preg_replace('/[^0-9]/', '', $entity->cep),
                'street_name' => $entity->rua,
                'street_number' => $entity->numero,
                'neighborhood' => $entity->bairro,
                'city' => $entity->cidade,
                'federal_unit' => $entity->estado
            ]
        ];*/

        $transaction_amount = floatval($this->valorTotal($totalProdutos, $totalServicos, $totalDesconto, $tipoDesconto));
        
        $title = PaymentGateway::PAYMENT_TYPE_OS ? "OS #$id" : "Venta #$id";
        $payer = [
            'email' => $entity->email,
            'first_name' => $clientNameParts[0],
            'last_name' => $clientNameParts[count($clientNameParts) - 1],
            'identification' => [
                'type' => 'DNI', // strlen($documento) == 11 ? 'CPF' : 'CNPJ',
                'number' => $documento
            ],
            'address' => [
                'zip_code' => preg_replace('/[^0-9]/', '', $entity->cep),
                'street_name' => $entity->rua,
                'street_number' => $entity->numero,
                'neighborhood' => $entity->bairro,
                'city' => $entity->cidade,
                'federal_unit' => $entity->estado
            ]
        ];

        $preference = new MercadoPago\Preference();

        // Create a preference item
        $item = new MercadoPago\Item();
        $item->title = $title;
        $item->quantity = 1;
        $item->unit_price = $transaction_amount;
        $preference->items = array($item);
        $preference->save();

        if ($preference->Error()) {
            throw new \Exception($payment->Error());
        }

        // qr code
        $public_qr = base_url() . "assets/qrs/{$preference->id}.png";
        $init_point = $preference->init_point;
        $qrCode = new QrCode($init_point);
        $output = new Output\Png();
        $qrs_path = '/../../assets/qrs/';
        // Save black on white PNG image 100px wide to filename.png
        $data = $output->output($qrCode, 500, [255, 255, 255], [0, 0, 0]);
        $filedest = dirname(__DIR__) . "{$qrs_path}{$preference->id}.png";
        file_put_contents($filedest, $data);

        // send client notification for this service order
        $this->ci->load->library('email'); // Note: no $config param needed
        //$this->email->from('cobranzas@mi-iphone.com', 'cobran@gmail.com');
        $this->ci->email->to($payer['email']);
        $this->ci->email->subject("Ya puede efectuar su pago para Orden de servicio #{$id}");
        $this->ci->email->attach($filedest);
        $this->ci->email->message("
COBRANZA DE MI-iPhone<br><br>

Asunto: Factura de su Orden de Servicio en MI-iPhone.com.ar<br><br>

Estimado/a [Nombre del cliente],<br><br>

Esperamos que este correo electrónico lo encuentre bien. El motivo de nuestro mensaje es para informarle que su Orden de Servicio ha sido facturada y está lista para su pago. En MI-iPhone.com.ar nos esforzamos por brindar un servicio de calidad y rapidez en la reparación de sus dispositivos, y estamos seguros de que encontrará nuestra factura precisa y detallada.<br><br>

Le ofrecemos varias opciones de pago, pero le recomendamos utilizar MercadoPago para una transacción rápida y segura. Podrá abonar su factura haciendo click en el siguiente enlace {$init_point} o escaneando el código QR adjunto. Los detalles de su factura son los siguientes:<br><br>

ID externo (charge_id): {$preference->id}<br>
ID interno: {$id}<br>
Valor de la Cobranza: {$transaction_amount}<br>
Método de Pago: Mercadopago<br>
Vencimiento: 30 días<br><br>

Si tiene alguna pregunta sobre su factura o necesita ayuda para procesar su pago, no dude en ponerse en contacto con nosotros. Estamos aquí para ayudarlo en cualquier momento.<br><br>

Agradecemos su confianza en MI-iPhone.com.ar, y esperamos seguir siendo su proveedor de confianza para la reparación de sus dispositivos.<br><br>

Atentamente,<br>
El equipo de MI-iPhone<br>
Whatsapp Business Wa.me/541128715389<br>
Nuestra web: https://mi-iphone.com.ar
");

        $this->ci->email->send();
        $data = [
            'barcode' => $public_qr,
            'payment_url' => $preference->init_point,
            //'link' => $preference->init_point,
            //'pdf' => '',
            //'expire_at' => $preference->date_of_expiration,
            'charge_id' => $preference->id,
            //'status' => $preference->status,
            'total' => getMoneyAsCents($this->valorTotal($totalProdutos, $totalServicos, $totalDesconto, $tipoDesconto)),
            'clientes_id' => $entity->idClientes,
            'payment_method' => 'boleto',
            'payment_gateway' => 'MercadoPago',
        ];

        if ($tipo === PaymentGateway::PAYMENT_TYPE_OS) {
            $data['os_id'] = $id;
        } else {
            $data['vendas_id'] = $id;
        }

        if ($id = $this->ci->cobrancas_model->add('cobrancas', $data, true)) {
            $data['idCobranca'] = $id;
            log_info('Cobrança criada com successo. ID: ' . $preference->id);
        } else {
            throw new \Exception('Erro ao salvar cobrança!');
        }

        return $data;
    }

    protected function gerarCobrancaLink($id, $tipo)
    {
        throw new Exception('MercadoPago não suporta gerar link pela API, somente pelo panel!');
    }

    private function valorTotal($produtosValor, $servicosValor, $desconto, $tipo_desconto)
    {
        if ($tipo_desconto == "porcento") {
            $def_desconto = $desconto * ($produtosValor + $servicosValor) / 100;
        } elseif ($tipo_desconto == "real") {
            $def_desconto = $desconto;
        } else {
            $def_desconto = 0;
        }

        return ($produtosValor + $servicosValor) - $def_desconto;
    }


    public function send_mail() {
        $from_email = "electronicagambino@gmail.com";
        $to_email = $this->input->post('email');
        //Load email library
        $this->load->library('email');
        $this->email->from($from_email, 'Identification');
        $this->email->to($to_email);
        $this->email->subject('Send Email Codeigniter');
        $this->email->message('The email send using codeigniter library');
        //Send mail
        if($this->email->send())
            $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
        else
            $this->session->set_flashdata("email_sent","You have encountered an error");
        $this->load->view('contact_email_form');
    }    

}
