<?php $totalServico = 0;
$totalProdutos = 0; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>MI-iPhone<?php echo $result->idOs ?>_<?php echo $result->nomeCliente ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-style.css" />
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?= base_url('assets/css/custom.css'); ?>" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <style>
        .table {

            width: 72mm;
            margin: auto;
        }
    </style>
</head>

<body id=body class="body">
<div id ="principal">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">

                <div class="invoice-content">
                    <div class="invoice-head" style="margin-bottom: 0">
                        <table class="table table-condensed">
                            <tbody>
                            

                                <?php if ($emitente == null) { ?>
                                    
                                    <tr>
                                        <td colspan="5" class="alert">Debe configurar los datos del cliente >>><a href="<?php echo base_url(); ?>index.php/Sgtos/emitente">Configurar</a>
                                            <<<</td> </tr> <?php } else { ?> 
                                    <td style="width: 25% ;text-align: center" ><img src=" <?php echo $emitente[0]->url_logo; ?> " style="max-height: 100px"></td>
                                    <tr>
                                        
                                        <td colspan="5" style="text-align: center">
                                            <span style="font-size: 12px; ">CUIT/CUIL: <?php echo $emitente[0]->cnpj; ?> </br>
                                                <?php echo $emitente[0]->rua . ', ' . $emitente[0]->numero . ' ' . $emitente[0]->bairro . ' -  ' . $emitente[0]->cidade . ' - ' . $emitente[0]->uf; ?> </span> </br> <span>Teléfono: <?php echo $emitente[0]->telefone; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%; font-size: 15px;"><b>N° OS:</b> <span><?php echo $result->idOs ?></span><span style="padding-left: 5%;"><b>Emitido:</b> <?php echo date('d/m/Y') ?></span></td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
    
                        <table class="table table-condensend">
                            <tbody>
                                <tr>
                                    <td style="width: 50%; padding-left: 0; font-size: 11px;">
                                        <ul>
                                            <li>
                                                <span>
                                                    <b>Cliente: </b>
                                                    <span><?php echo $result->nomeCliente ?></span>
                                                    <span style="padding-left: 4%;"><b>Celular/WhatsApp:</b> <?php echo $result->celular_cliente ?></span>
                                            </li>
                                        </ul>
                                    </td>

                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div style="margin-top: 0; padding-top: 0; font-size: 15px;">
                        <table class="table table-condensed">
                            <tbody>
                                <tr>
                                    <td>
                                        <b>Estado O.S.: </b>
                                        <?php echo $result->status ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-condensed">
                            <tbody>

                                <?php if ($result->dataInicial != null) { ?>
                                    <tr>

                                        <td>
                                            <b>Inicial: </b>
                                            <?php echo date('d/m/Y', strtotime($result->dataInicial)); ?>
                                        </td>

                                        <td>
                                            <b>Final: </b>
                                            <?php echo $result->dataFinal ? date('d/m/Y', strtotime($result->dataFinal)) : ''; ?>
                                        </td>

                                        <td>
                                            <?php if ($result->garantia != null) { ?>
                                                <b>Garantía: </b>
                                                <?php echo $result->garantia . ' dias'; ?>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                    
                                        <?php if ($result->descricaoProduto != null) { ?>
                                    <tr>
                                        <td colspan="5">
                                            <b>Descripción: </b>
                                            <?php echo htmlspecialchars_decode($result->descricaoProduto) ?>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <?php if ($result->defeito != null) { ?>
                                    <tr>
                                        <td colspan="5">
                                            <b>Defecto Presentado: </b>
                                            <?php echo htmlspecialchars_decode($result->defeito) ?>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <?php if ($result->observacoes != null) { ?>
                                    <tr>
                                        <td colspan="5">
                                            <b>Observaciones: </b>
                                            <?php echo htmlspecialchars_decode($result->observacoes) ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php if ($result->status != 'Aberto') { ?>
                                <?php if ($result->laudoTecnico != null) { ?>
                                    <tr>
                                        <td colspan="5">
                                            <b>Informe Técnico: </b>
                                            <?php echo htmlspecialchars_decode($result->laudoTecnico) ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>

                            </tbody>
                        </table>
                        <?php if ($produtos != null) { ?>
                            <br />
                            <table style='font-size: 11px;' class="table table-bordered table-condensed" id="tblProdutos">
                                <thead>
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Producto</th>
                                        <th>Precio unit.</th>
                                        <th>Sub-total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($produtos as $p) {
                                        $totalProdutos = $totalProdutos + $p->subTotal;
                                        echo '<tr>';
                                        echo '<td>' . $p->quantidade . '</td>';
                                        echo '<td>' . $p->descricao . '</td>';
                                        echo '<td>$ ' . $p->preco ?: $p->precoVenda . '</td>';
                                        echo '<td>$ ' . number_format($p->subTotal, 2, ',', '.') . '</td>';
                                        echo '</tr>';
                                    } ?>

                                    <tr>
                                        <td colspan="3" style="text-align: right"><strong>Total:</strong></td>
                                        <td><strong>$ <?php echo number_format($totalProdutos, 2, ',', '.'); ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php } ?>

                        <?php if ($servicos != null) { ?>
                            <table style='font-size: 11px;' class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Servicio</th>
                                        <th>Precio unit.</th>
                                        <th>Sub-total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    setlocale(LC_MONETARY, 'en_US');
                            foreach ($servicos as $s) {
                                $preco = $s->preco ?: $s->precoVenda;
                                $subtotal = $preco * ($s->quantidade ?: 1);
                                $totalServico = $totalServico + $subtotal;
                                echo '<tr>';
                                echo '<td>' . ($s->quantidade ?: 1) . '</td>';
                                echo '<td>' . $s->nome . '</td>';
                                echo '<td>$ ' . $preco . '</td>';
                                echo '<td>$ ' . number_format($subtotal, 2, ',', '.') . '</td>';
                                echo '</tr>';
                            } ?>

                                    <tr>
                                        <td colspan="3" style="text-align: right"><strong>Total:</strong></td>
                                        <td><strong>$ <?php echo number_format($totalServico, 2, ',', '.'); ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php } ?>

                        <table class="table table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td colspan="5"> <?php
                                                if ($totalProdutos != 0 || $totalServico != 0) {
                                                    echo "<h4 style='text-align: right; font-size: 13px;'>Valor Total: $ " . number_format($totalProdutos + $totalServico, 2, ',', '.') . "</h4>";
                                                    echo $result->valor_desconto != 0 ? "<h4 style='text-align: right; font-size: 13px;'> Descuento: $ " . number_format($result->valor_desconto != 0 ? $result->valor_desconto - ($totalProdutos + $totalServico) : 0.00, 2, ',', '.') . "</h4>" : "";
                                                    echo $result->valor_desconto != 0 ? "<h4 style='text-align: right; font-size: 13px;'> Total con Descuento: $ " . number_format($result->valor_desconto, 2, ',', '.') . "</h4>" : "";
                                                } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered table-condensed" style="font-size: 15px">
                            <tbody>
                                <tr>

                                    <td colspan="5">
                                        <b><p class="text-center">Firma del Cliente</p></b><br />
                                        <hr>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                      
                        <!-- Via Da Empresa  -->
                        <?php $totalServico = 0;
                        $totalProdutos = 0; ?>
                    <div id="ViaEmpresa" <?php echo (!$configuration['control_2vias']) ? "style='display: none;'" : "style='display: block;'" ?>>
                        <div class="invoice-head" style="margin-bottom: 0">

                                <table class="table table-condensed">
                                <tbody>
                            

                            <?php if ($emitente == null) { ?>
                                
                                <tr>
                                    <td colspan="5" class="alert">Debe configurar los datos del cliente. >>><a href="<?php echo base_url(); ?>index.php/Sgtos/emitente">Configurar</a>
                                        <<<</td> </tr> <?php } else { ?> 
                                <td style="width: 25% ;text-align: center" ><img src=" <?php echo $emitente[0]->url_logo; ?> " style="max-height: 100px"></td>
                                <tr>
                                    
                                    <td colspan="5" style="text-align: center">
                                        <span style="font-size: 12px; ">CUIT/CUIL: <?php echo $emitente[0]->cnpj; ?> </br>
                                            <?php echo $emitente[0]->rua . ', ' . $emitente[0]->numero . ' ' . $emitente[0]->bairro . ' -  ' . $emitente[0]->cidade . ' - ' . $emitente[0]->uf; ?> </span> </br> <span>Teléfono: <?php echo $emitente[0]->telefone; ?></span></td>
                                </tr>
                                <tr>
                                    <td style="width: 100%; font-size: 15px;"><b>N° OS:</b> <span><?php echo $result->idOs ?></span><span style="padding-left: 5%;"><b>Emitido:</b> <?php echo date('d/m/Y') ?></span></td>
                                </tr>

                            <?php } ?>
                        </tbody>
                                </table>

                                <table class="table table-condensend">
                                    <tbody>
                                        <tr>
                                            <td style="width: 50%; padding-left: 0; font-size: 11px;">
                                                <ul>
                                                    <li>
                                                        <span>
                                                            <b>Cliente: </b>
                                                            <span><?php echo $result->nomeCliente ?></span>
                                                            <span style="padding-left: 4%;"><b>Celular/ WhatsApp:</b> <?php echo $result->celular_cliente ?></span>
                                                    </li>
                                                </ul>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>

                                </div>

                                <div style="margin-top: 0; padding-top: 0">
                                <table class="table table-condensed">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <b>Estado O.S.: </b>
                                                <?php echo $result->status ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-condensed">
                                    <tbody>

                                        <?php if ($result->dataInicial != null) { ?>
                                            <tr>

                                                <td>
                                                    <b>Inicial: </b>
                                                    <?php echo date('d/m/Y', strtotime($result->dataInicial)); ?>
                                                </td>

                                                <td>
                                                    <b>Final: </b>
                                                    <?php echo $result->dataFinal ? date('d/m/Y', strtotime($result->dataFinal)) : ''; ?>
                                                </td>

                                                <td>
                                                    <?php if ($result->garantia != null) { ?>
                                                        <b>Garantía: </b>
                                                        <?php echo $result->garantia . ' dias'; ?>
                                                    <?php } ?>
                                                </td>
                                            <?php } ?>
                                            
                                                <?php if ($result->descricaoProduto != null) { ?>
                                            <tr>
                                                <td colspan="5">
                                                    <b>Descripción: </b>
                                                    <?php echo htmlspecialchars_decode($result->descricaoProduto) ?>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        <?php if ($result->defeito != null) { ?>
                                            <tr>
                                                <td colspan="5">
                                                    <b>Defecto Presentado: </b>
                                                    <?php echo htmlspecialchars_decode($result->defeito) ?>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        <?php if ($result->observacoes != null) { ?>
                                            <tr>
                                                <td colspan="5">
                                                    <b>Observaciones: </b>
                                                    <?php echo htmlspecialchars_decode($result->observacoes) ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php if ($result->status != 'Aberto') { ?>
                                        <?php if ($result->laudoTecnico != null) { ?>
                                            <tr>
                                                <td colspan="5">
                                                    <b>Informe Técnico: </b>
                                                    <?php echo htmlspecialchars_decode($result->laudoTecnico) ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>

                                    </tbody>
                                </table>
                                <?php if ($produtos != null) { ?>
                                    <br />
                                    <table style='font-size: 11px;' class="table table-bordered table-condensed" id="tblProdutos">
                                        <thead>
                                            <tr>
                                                <th>Cantidad</th>
                                                <th>Producto</th>
                                                <th>Precio unit.</th>
                                                <th>Sub-total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($produtos as $p) {
                                                $totalProdutos = $totalProdutos + $p->subTotal;
                                                echo '<tr>';
                                                echo '<td>' . $p->quantidade . '</td>';
                                                echo '<td>' . $p->descricao . '</td>';
                                                echo '<td>$ ' . $p->preco ?: $p->precoVenda . '</td>';
                                                echo '<td>$ ' . number_format($p->subTotal, 2, ',', '.') . '</td>';
                                                echo '</tr>';
                                            } ?>

                                            <tr>
                                                <td colspan="3" style="text-align: right"><strong>Total:</strong></td>
                                                <td><strong>$ <?php echo number_format($totalProdutos, 2, ',', '.'); ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php } ?>

                                <?php if ($servicos != null) { ?>
                                    <table style='font-size: 11px;' class="table table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Cantidad</th>
                                                <th>Servicio</th>
                                                <th>Precio unit.</th>
                                                <th>Sub-total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            setlocale(LC_MONETARY, 'en_US');
                                    foreach ($servicos as $s) {
                                        $preco = $s->preco ?: $s->precoVenda;
                                        $subtotal = $preco * ($s->quantidade ?: 1);
                                        $totalServico = $totalServico + $subtotal;
                                        echo '<tr>';
                                        echo '<td>' . ($s->quantidade ?: 1) . '</td>';
                                        echo '<td>' . $s->nome . '</td>';
                                        echo '<td>$ ' . $preco . '</td>';
                                        echo '<td>$ ' . number_format($subtotal, 2, ',', '.') . '</td>';
                                        echo '</tr>';
                                    } ?>

                                            <tr>
                                                <td colspan="3" style="text-align: right"><strong>Total:</strong></td>
                                                <td><strong>$ <?php echo number_format($totalServico, 2, ',', '.'); ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php } ?>

                                <table class="table table-bordered table-condensed">
                                    <tbody>
                                        <tr>
                                            <td colspan="5"> <?php
                                                        if ($totalProdutos != 0 || $totalServico != 0) {
                                                            echo "<h4 style='text-align: right; font-size: 13px;'>Valor Total: $ " . number_format($totalProdutos + $totalServico, 2, ',', '.') . "</h4>";
                                                            echo $result->valor_desconto != 0 ? "<h4 style='text-align: right; font-size: 13px;'> Desconto: $ " . number_format($result->valor_desconto != 0 ? $result->valor_desconto - ($totalProdutos + $totalServico) : 0.00, 2, ',', '.') . "</h4>" : "";
                                                            echo $result->valor_desconto != 0 ? "<h4 style='text-align: right; font-size: 13px;'> Total con Descuento: $ " . number_format($result->valor_desconto, 2, ',', '.') . "</h4>" : "";
                                                        } ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered table-condensed" style="font-size: 15px">
                            <tbody>
                                <tr>

                                    <td colspan="5">
                                        <b><p class="text-center">Firma del Cliente</p></b><br />
                                        <hr>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/matrix.js"></script>

</html>
