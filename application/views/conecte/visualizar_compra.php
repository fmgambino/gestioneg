<?php $totalProdutos = 0; ?>
<div class="row-fluid" style="margin-top: 0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title" style="margin: -20px 0 0">
                <span class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </span>
                <h5>Venta</h5>
                <div class="buttons">

                    <a id="imprimir" target="_blank" title="Imprimir" class="btn btn-mini btn-inverse" href="<?php echo site_url(); ?>/mine/imprimirCompra/<?php echo $result->idVendas; ?>"><i class="fas fa-print"></i> Imprimir</a>
                </div>
            </div>
            <div class="widget-content" id="printOs">
                <div class="invoice-content">
                    <div class="invoice-head">
                        <table class="table">
                            <tbody>

                                <?php if ($emitente == null) { ?>

                                    <tr>
                                        <td colspan="3" class="alert">Datos del cliente no configurados. </td>
                                    </tr>
                                <?php
                                } else { ?>

                                    <tr>
                                        <td style="width: 25%"><img src=" <?php echo $emitente[0]->url_logo; ?> "></td>
                                        <td> <span style="font-size: 20px; ">
                                                <?php echo $emitente[0]->nome; ?></span> </br><span>
                                                <?php echo $emitente[0]->cnpj; ?> </br>
                                                <?php echo $emitente[0]->rua . ', nº:' . $emitente[0]->numero . ', ' . $emitente[0]->bairro . ' - ' . $emitente[0]->cidade . ' - ' . $emitente[0]->uf; ?> </span> </br> <span> E-mail:
                                                <?php echo $emitente[0]->email . ' - Fone: ' . $emitente[0]->telefone; ?></span></td>
                                        <td style="width: 18%; text-align: center">#Venta: <span>
                                                <?php echo $result->idVendas ?></span></br> </br> <span>Emisión:
                                                <?php echo date('d/m/Y'); ?></span></td>
                                    </tr>

                                <?php
                                } ?>
                            </tbody>
                        </table>

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 50%; padding-left: 0">
                                        <ul>
                                            <li>
                                                <span>
                                                    <h5>Cliente</h5>
                                                    <span>
                                                        <?php echo $result->nomeCliente ?></span><br />
                                                    <span>
                                                        <?php echo $result->rua ?>,
                                                        <?php echo $result->numero ?>,
                                                        <?php echo $result->bairro ?></span><br />
                                                    <span>
                                                        <?php echo $result->cidade ?> -
                                                        <?php echo $result->estado ?></span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td style="width: 50%; padding-left: 0">
                                        <ul>
                                            <li>
                                                <span>
                                                    <h5>Vendedor</h5>
                                                </span>
                                                <span>
                                                    <?php echo $result->nome ?></span> <br />
                                                <span>Teléfono:
                                                    <?php echo $result->telefone_usuario ?></span><br />
                                                <span>E-mail:
                                                    <?php echo $result->email_usuario ?></span>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div style="margin-top: 0; padding-top: 0">


                        <?php if ($produtos != null) { ?>

                            <table class="table table-bordered table-condensed" id="tblProdutos" style="margin-top: 0; padding-top: 0">
                                <thead>
                                    <tr>
                                        <th style="font-size: 15px">Producto</th>
                                        <th style="font-size: 15px">Cantidad</th>
                                        <th style="font-size: 15px">Sub-total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($produtos as $p) {
                                        $totalProdutos = $totalProdutos + $p->subTotal;
                                        echo '<tr>';
                                        echo '<td>' . $p->descricao . '</td>';
                                        echo '<td>' . $p->quantidade . '</td>';

                                        echo '<td>$ ' . number_format($p->subTotal, 2, ',', '.') . '</td>';
                                        echo '</tr>';
                                    } ?>

                                    <tr>
                                        <td colspan="2" style="text-align: right"><strong>Total:</strong></td>
                                        <td><strong>$
                                                <?php echo number_format($totalProdutos, 2, ',', '.'); ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php
                        } ?>

                        <hr />

                        <h4 style="text-align: right">Valor Total: $
                            <?php echo number_format($totalProdutos, 2, ',', '.'); ?>
                        </h4>
                        <?php if ($result->valor_desconto != 0 || $result->valor_desconto != 0) { ?>
                        <h4 style="text-align: right">Descuento: $
                            <?php echo number_format($result->valor_desconto - $totalProdutos, 2, ',', '.'); ?>
                        </h4>
                        <h4 style="text-align: right">Total Con Descuento: $
                            <?php echo number_format($result->valor_desconto, 2, ',', '.'); ?>
                        </h4>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
