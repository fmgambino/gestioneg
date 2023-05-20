<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$config['payment_gateways'] = [
    // 'GerencianetSdk' => [
    //     'name' => 'GerenciaNetOS',
    //     'library_name' => 'GerencianetSdk',
    //     'production' => false,
    //     'credentials' => [
    //         'client_id' => '',
    //         'client_secret' => ''
    //     ],
    //     'timeout' => 30,
    //     'boleto_expiration' => 'P3D',
    //     'payment_methods' => [
    //         [
    //             'name' => 'Boleto',
    //             'value' => 'boleto',
    //         ],
    //         [
    //             'name' => 'Link',
    //             'value' => 'link'
    //         ]
    //     ],
    //     'transaction_status' => [
    //         'new' => 'Cobrança / Assinatura gerada',
    //         'waiting' => 'Aguardando a confirmação do pagamento',
    //         'paid' => 'Pagamento confirmado',
    //         'unpaid' => 'Não foi possível confirmar o pagamento da cobrança',
    //         'refunded' => 'Pagamento devolvido pelo lojista ou pelo intermediador Gerencianet',
    //         'contested' => 'Pagamento em processo de contestação',
    //         'canceled' => 'Cobrança/Assinatura cancelada pelo vendedor ou pelo pagador ',
    //         'settled' => 'Cobrança/Pagamento foi confirmada manualmente ',
    //         'link' => 'Link de pagamento',
    //         'expired' => 'Link/Assinatura de pagamento expirado',
    //         'active' => 'Assinatura ativa Todas as cobranças estão sendo geradas',
    //         'finished' => 'Carnê está Finalizado',
    //         'up_to_date' => 'Carnê encontra-se em dia',
    //     ]
    // ],
    'MercadoPago' => [
        'name' => 'MercadoPago',
        'library_name' => 'MercadoPago',
        'credentials' => [
            'access_token' => 'APP_USR-5022931750378772-070523-4d84e9000d49b39264df01f652605f87__LB_LD__-120916789',
            'public_key' => 'APP_USR-e0e85168-7888-4fc9-8c98-7f9c5b47c027',
            'client_secret' => 'L6EouXCh9Q0Irf2Zo0wnKGfbqQXt6EaZ',
            'client_id' => '5022931750378772',
            'integrator_id' => '',
            'platform_id' => '',
            'corporation_id' => ''
        ],
        'boleto_expiration' => 'P3D',
        'payment_methods' => [
            [
                'name' => 'On-Line',
                'value' => 'boleto',
            ]
        ],
        'transaction_status' => [
            'pending' => 'El usuario aún no ha completado el proceso de pago',
            'approved' => 'El pago ha sido Aprovado y acreditado',
            'authorized' => 'El pago ha sido autorizado pero aún no acreditado',
            'in_process' => 'Se está revisando el pago',
            'in_mediation' => 'Los usuarios iniciaron una disputa',
            'rejected' => 'El pago fue rechazado, el usuario puede intentar el pago nuevamente',
            'cancelled' => 'El pago fue Cancelado por una de las partes o porque el plazo de pago ha vencido',
            'refunded' => 'El pago ha sido reembolsado al usuario.',
            'charged_back' => 'Se ha realizado un contracargo a la tarjeta de crédito del comprador.'
        ]
    ],
    'Asaas' => [
        'name' => 'Asaas',
        'library_name' => 'Asaas',
        'production' => false,
        'notify' => false,
        'credentials' => [
            'api_key' => '',
        ],
        'boleto_expiration' => 'P3D',
        'payment_methods' => [
            [
                'name' => 'Boleto',
                'value' => 'boleto',
            ],
            [
                'name' => 'Link',
                'value' => 'link'
            ]
        ],
        'transaction_status' => [
            'PENDING' => 'Aguardando pagamento',
            'RECEIVED' => 'Recebida (saldo já creditado na conta)',
            'CONFIRMED' => 'Pagamento confirmado (saldo ainda não creditado)',
            'OVERDUE' => 'Vencida',
            'REFUNDED' => 'Estornada',
            'RECEIVED_IN_CASH' => 'Recebida em dinheiro (não gera saldo na conta)',
            'REFUND_REQUESTED' => 'Estorno Solicitado',
            'CHARGEBACK_REQUESTED' => 'Recebido chargeback',
            'CHARGEBACK_DISPUTE' => 'Em disputa de chargeback (caso sejam apresentados documentos para contestação)',
            'AWAITING_CHARGEBACK_REVERSAL' => 'Disputa vencida, aguardando repasse da adquirente',
            'DUNNING_REQUESTED' => 'Em processo de recuperação',
            'DUNNING_RECEIVED' => 'Recuperada',
            'AWAITING_RISK_ANALYSIS' => 'Pagamento em análise',
        ]
    ]
];
