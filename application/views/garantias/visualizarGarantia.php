<?php $totalProdutos = 0; ?>
<div class="row-fluid" style="margin-top: 0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title" style="margin: -20px 0 0">
                <span class="icon">
                    <i class="fas fa-book"></i>
                </span>
                <h5>Plazo de Garantía</h5>
                <div class="buttons">
                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eGarantia')) {
                        echo '<a title="Editar Términos de Garantia" class="button btn btn-mini btn-success" href="' . base_url() . 'index.php/garantias/editar/' . $result->idGarantias . '">
    <span class="button__icon"><i class="bx bx-edit"></i> </span> <span class="button__text">Editar</span></a>';
                    } ?>
                    <a target="_blank" title="Imprimir" class="button btn btn-mini btn-inverse" href="<?php echo site_url() ?>/garantias/imprimir/<?php echo $result->idGarantias; ?>">
                      <span class="button__icon"><i class="bx bx-printer"></i></span> <span class="button__text">Imprimir</span></a>
                </div>
            </div>
            <div class="widget-content" id="printOs">
                <div class="invoice-content">
                    <div class="invoice-head">
                        <table class="table">
                            <tbody>
                                <?php if ($emitente == null) { ?>
                                    <tr>
                                        <td colspan="3" class="alert">Necesita configurar los datos del Cliente. >>><a href="<?php echo base_url(); ?>index.php/Sgtos/emitente">Configurar</a>
                                            <<<</td> </tr> <?php
                                } else { ?> <tr>
                                        <td style="width: 25%"><img src=" <?php echo $emitente[0]->url_logo; ?> "></td>
                                        <td> <span style="font-size: 20px; ">
                                                <?php echo $emitente[0]->nome; ?></span> </br><span>
                                                <?php echo $emitente[0]->cnpj; ?> </br>
                                                <?php echo $emitente[0]->rua . ', nº:' . $emitente[0]->numero . ', ' . $emitente[0]->bairro . ' - ' . $emitente[0]->cidade . ' - ' . $emitente[0]->uf; ?> </span> </br> <span> E-mail:
                                                <?php echo $emitente[0]->email . ' - Fone: ' . $emitente[0]->telefone; ?></span></td>
                                        <td style="width: 18%; text-align: center">#Venta: <span>
                                                <?php echo $result->idVendas ?></span></br> </br> <span>Emitido:
                                                <?php echo date('d/m/Y'); ?></span>
                                            <?php if ($result->Faturado) : ?>
                                                <br>
                                                Vencimiento:
                                                <?php echo date('d/m/Y', strtotime($result->data_vencimento)); ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                        </table>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 40%; padding-left: 0">
                                        <ul>
                                            <li>
                                                <span>
                                                    <h5>Responsable</h5>
                                                </span>
                                                <span>
                                                    <?php echo $result->nome ?></span> <br />
                                                <span>Teléfono:
                                                    <?php echo $result->telefone ?></span><br />
                                                <span>E-mail:
                                                    <?php echo $result->email ?></span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td style="width: 30%; padding-left: 0">
                                        <ul>
                                            <li>
                                                <span>
                                                    <h5>Fecha</h5>
                                                </span>
                                                <span> <?php echo date('d/m/Y', strtotime($result->dataGarantia)); ?></span> <br />

                                            </li>
                                        </ul>
                                    </td>
                                    <td style="width: 30%; padding-left: 0">
                                        <ul>
                                            <li>
                                                <span>
                                                    <h5>Ref. Plazo</h5>
                                                </span>
                                                <span><?php echo $result->refGarantia ?> </span>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 100%; padding-left: 0">
                                        <ul>
                                            <li>

                                                <span>
                                                    <h5>Texto de garantía</h5>
                                                </span><br />
                                                <span><?php echo htmlspecialchars_decode($result->textoGarantia) ?></span><br />
                                            </li>
                                        </ul>
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
