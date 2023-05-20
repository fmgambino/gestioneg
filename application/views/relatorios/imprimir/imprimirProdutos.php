<!DOCTYPE html>
<html>

<head>
    <title>Electronica Gambino</title>
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
                        <h4 style="text-align: center; font-size: 1.1em; padding: 5px;">
                            <?= ucfirst($title) ?>
                        </h4>
                    </div>
                    <div class="widget-content nopadding tab-content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="600" align="center" style="font-size: 15px">Nombre</th>
                                    <th width="100" align="center" style="font-size: 15px">UND.</th>
                                    <th width="130" align="center" style="font-size: 15px">Precio Compra</th>
                                    <th width="130" align="center" style="font-size: 15px">Precio Venta</th>
                                    <th width="145" align="center" style="font-size: 15px">Stock</th>
                                    <th width="145" align="center" style="font-size: 15px">Total c/Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($produtos as $p) {
                                        echo '<tr>';
                                        echo '<td>' . $p->descricao . '</td>';
                                        echo '<td align="center">' . $p->unidade . '</td>';
                                        echo '<td align="center">$: ' . $p->precoCompra . '</td>';
                                        echo '<td align="center">$: ' . $p->precoVenda . '</td>';
                                        echo '<td align="center">' . $p->estoque . '</td>';
                                        echo '<td align="center">$: ' . number_format($p->valorEstoque, 2, ',', '.') . '</td>';
                                        echo '</tr>';
                                    }
    ?>
                                <tr>
                                    <td colspan="6">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td align="center"><b>Artículos en stock</b></td>
                                    <td align="center"><b>Total c/Stock</b></td>
                                </tr>
                                <tr style="background-color: gainsboro;">
                                    <td colspan="4"></td>
                                    <td align="center"><?= array_sum(array_column($produtos, 'estoque')) ?></td>
                                    <td align="center">$: <?= number_format(array_sum(array_column($produtos, 'valorEstoque')), 2, ',', '.'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <h5 style="text-align: right; font-size: 0.8em; padding: 5px;">
                    Fecha del Informe: <?php echo date('d/m/Y'); ?>
                </h5>
            </div>
        </div>
    </div>
</body>

</html>
