<?php

class Configuracoes extends Seeder
{
    private $table = 'configuracoes';

    public function run()
    {
        echo "Running Configuracoes Seeder";

        $configs = [
            [
                'idConfig' => 2,
                'config' => 'app_name',
                'valor' => 'Map-OS',
            ],
            [
                'idConfig' => 3,
                'config' => 'app_theme',
                'valor' => 'white',
            ],
            [
                'idConfig' => 4,
                'config' => 'per_page',
                'valor' => 10,
            ],
            [
                'idConfig' => 5,
                'config' => 'os_notification',
                'valor' => 'cliente',
            ],
            [
                'idConfig' => 6,
                'config' => 'control_estoque',
                'valor' => '1',
            ],
            [
                'idConfig' => 7,
                'config' => 'notifica_whats',
                'valor' => '*Estimado(a), {CLIENTE_NOME}* su OS Nº *{NUMERO_OS}* había cambiado el estado a: *{STATUS_OS}* con descripción {DESCRI_PRODUTOS} con Valor Total de: *{VALOR_OS}*!
                Para más información entre en contacto con Nosotros.

                Atte., *{EMITENTE} {TELEFONE_EMITENTE}*.',
            ],
            [
                'idConfig' => 8,
                'config' => 'control_baixa',
                'valor' => '0',
            ],
            [
                'idConfig' => 9,
                'config' => 'control_editos',
                'valor' => '1',
            ],
            [
                'idConfig' => 10,
                'config' => 'control_datatable',
                'valor' => '1',
            ],
            [
                'idConfig' => 11,
                'config' => 'pix_key',
                'valor' => '',
            ],
        ];

        foreach ($configs as $config) {
            $this->db->insert($this->table, $config);
        }

        echo PHP_EOL;
    }
}
