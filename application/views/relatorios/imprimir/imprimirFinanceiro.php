<!DOCTYPE html>
<html>

<head>
    <title>MI-iPhone</title>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/blue.css" class="skin-color" />
</head>

<body style="background-color: transparent">

    <div class="container-fluid">

        <div class="row-fluid">
            <div class="span12">

                <div class="widget-box">
                    <?= $topo ?>

                    <div class="widget-title">
                        <h4 style="text-align: center">Informes Financieros</h4>
                    </div>
                    <div class="widget-content nopadding tab-content">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="font-size: 1.2em; padding: 5px;width: 25%;">Cliente/Proveedor</th>
                                    <th style="font-size: 1.2em; padding: 5px;width: 20%;">Tipo</th>
                                    <th style="font-size: 1.2em; padding: 5px;width: 20%;">Valor</th>
                                    <th style="font-size: 1.2em; padding: 5px;width: 20%;">Descuencto</th>
                                    <th style="font-size: 1.2em; padding: 5px;width: 20%;">Valor Total</th>
                                    <th style="font-size: 1.2em; padding: 5px;width: 20%;">Vencimiento</th>
                                    <th style="font-size: 1.2em; padding: 5px;width: 20%;">Método de Pago</th>
                                    <th style="font-size: 1.2em; padding: 5px;width: 20%;">Forma de Pgo.</th>
                                    <th style="font-size: 1.2em; padding: 5px;width: 20%;">Situación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $totalReceita = 0;
    $totalDespesa = 0;
    $saldo = 0;
    foreach ($lancamentos as $l) {
        $vencimento = date('d/m/Y', strtotime($l->data_vencimento));
        $pagamento = date('d/m/Y', strtotime($l->data_pagamento));
        if ($l->baixado == 1) {
            $situacao = 'Pago';
        } else {
            $situacao = 'Pendente';
        }
        if ($l->tipo == 'receita') {
            $totalReceita += $l->valor_desconto;
        } else {
            $totalDespesa += $l->valor_desconto;
        }
        echo '<tr>';
        echo '<td>' . $l->cliente_fornecedor . '</td>';
        echo '<td>' . $l->tipo . '</td>';
        echo '<td>' . 'R$ ' . number_format($l->valor, 2, ',', '.') . '</td>';
        echo '<td>' . ($l->tipo_desconto == "real" ? "R$ " : "") . number_format($l->desconto, 2, ',', '.') . ($l->tipo_desconto == "porcento" ? " %" : "") . '</td>';
        echo '<td>' . 'R$ ' . number_format($l->valor_desconto, 2, ',', '.') . '</td>';
        echo '<td>' . $vencimento . '</td>';
        echo '<td>' . $pagamento . '</td>';
        echo '<td>' . $l->forma_pgto . '</td>';
        echo '<td>' . $situacao . '</td>';
        echo '</tr>';
    }
    ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="text-align: right; color: green">
                                        <strong>Total de Ingresos:</strong>
                                    </td>
                                    <td colspan="2" style="text-align: left; color: green">
                                        <strong>$
                                            <?php echo number_format($totalReceita, 2, ',', '.') ?>
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right; color: red">
                                        <strong>Total de Gastos:</strong>
                                    </td>
                                    <td colspan="2" style="text-align: left; color: red">
                                        <strong>$
                                            <?php echo number_format($totalDespesa, 2, ',', '.') ?>
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right">
                                        <strong>Saldo:</strong>
                                    </td>
                                    <td colspan="2" style="text-align: left;">
                                        <strong>$
                                            <?php echo number_format($totalReceita - $totalDespesa, 2, ',', '.') ?>
                                        </strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <h5 style="text-align: right">Fecha del Informe:
                    <?php echo date('d/m/Y'); ?>
                </h5>

            </div>
        </div>
    </div>
</body>

</html>
