
<style>
    .widget-title h5 {
        font-weight : 500;
        padding     : 5px;
        padding-left: 36px !important;
        line-height : 12px;
        margin      : 5px 0 !important;
        font-size   : 1.3em;
        color       : var(--violeta1);
    }

    .icon-cli {
        color: #239683;
        margin-top : 3px;
        margin-left: 8px;
        position   : absolute;
        font-size  : 18px;
    }

    .icon-clic {
        color: #9faab7;
        top: 4px;
        right: 10px;
        position: absolute;
        font-size: 1.9em;
    }

    .icon-clic:hover {
        color: #3fadf6;
    }

    .widget-content {
        padding: 8px 12px 0;
    }

    .table td {
        padding: 5px;
    }

    .table {
        margin-bottom: 0;
    }

    .accordion .widget-box {
        margin-top   : 10px;
        margin-bottom: 0;
        border-radius: 6px;
    }

    .accordion {
        margin-top: -25px;
    }

    .collapse.in {
        top: -15px
    }

    .button {
    min-width: 130px;
    }

    .form-actions {
        padding: 0;
        margin-top: 20px;
        margin-bottom: 20px;
        background-color: transparent;
        border-top: 0px;
    }

    .widget-content table tbody tr:hover {
        background: transparent;
    }

@media (max-width: 480px) {
    .widget-content {
        padding      : 10px 7px !important;
        margin-bottom: -15px;
    }
}

</style>

<?php $permissoes = unserialize($result->permissoes);?>
<div class="span12" style="margin-left: 0">
    <form action="<?php echo base_url();?>index.php/permissoes/editar" id="formPermissao" method="post">
        <div class="span12" style="margin-left: 0">
            <div class="widget-box">
                <div class="widget-title">
               <span class="icon">
               <i class="fas fa-lock"></i>
               </span>
                    <h5 style="padding:12px;padding-left:18px!important;margin:-10px 0 0!important;font-size:1.7em;">Editar Permiso</h5>
                </div>
                <div class="widget-content">
                    <div class="span4">
                        <label>Nombre de Permiso/Rol</label>
                        <input name="nome" type="text" id="nome" class="span12" value="<?php echo $result->nome; ?>" />
                        <input type="hidden" name="idPermissao" value="<?php echo $result->idPermissao; ?>">
                    </div>
                    <div class="span3">
                        <label>Situación</label>
                        <select name="situacao" id="situacao" class="span12">
                            <?php if ($result->situacao == 1) {
                                $sim = 'selected';
                                $nao ='';
                            } else {
                                $sim = '';
                                $nao ='selected';
                            }?>
                            <option value="1" <?php echo $sim;?>>Activo</option>
                            <option value="0" <?php echo $nao;?>>Inactivo</option>
                        </select>
                    </div>
                    <div class="span4">
                        <label>
                            <input name="" type="checkbox" value="1" id="marcarTodos" />
                            <span class="lbl"> Marcar Todos</span>
                        </label>
                    </div>

                    <div class="control-group">
                        <label for="documento" class="control-label"></label>
                        <div class="controls">

                    <div class="widget-content" style="padding: 5px 0 !important">
        <div id="tab1" class="tab-pane active" style="min-height: 300px">
            <div class="accordion" id="collapse-group">
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                <span><i class='bx bx-group icon-cli' ></i></span>
                                <h5 style="padding-left: 28px">Clientes</h5>
                                <span><i class='bx bx-chevron-right icon-clic'></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="collapse in accordion-body" id="collapseGOne">
                        <div class="widget-content">
                        <table class="table table-bordered">
                                <tr>
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label......>
                                            <input <?php if (isset($permissoes['vCliente'])) {
                                                if ($permissoes['vCliente'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="vCliente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Ver Cliente</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['aCliente'])) {
                                                if ($permissoes['aCliente'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="aCliente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Agregar Cliente</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['eCliente'])) {
                                                if ($permissoes['eCliente'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="eCliente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Cliente</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['dCliente'])) {
                                                if ($permissoes['dCliente'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="dCliente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Eliminar Cliente</span>
                                        </label>
                                    </td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse">
                                <span><i class='bx bx-package icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Productos</h5>
                                <span><i class='bx bx-chevron-right icon-clic'></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGTwo">
                        <div class="widget-content">
                        <table class="table table-bordered">
                        <tr>
                            <td colspan="4"></td>
                        </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input <?php if (isset($permissoes['vProduto'])) {
                                            if ($permissoes['vProduto'] == '1') {
                                                echo 'checked';
                                            }
                                        }?> name="vProduto" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Ver Producto</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['aProduto'])) {
                                                if ($permissoes['aProduto'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="aProduto" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Agregar Producto</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['eProduto'])) {
                                                if ($permissoes['eProduto'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="eProduto" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Producto</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['dProduto'])) {
                                                if ($permissoes['dProduto'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="dProduto" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Eliminar Producto</span>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGThree" data-toggle="collapse">
                                <span><i class='bx bx-stopwatch icon-cli' ></i></span>
                                <h5 style="padding-left: 28px">Servicios</h5>
                                <span><i class='bx bx-chevron-right icon-clic'></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGThree">
                        <div class="widget-content">
                        <table class="table table-bordered">
                        <tr>
                            <td colspan="4"></td>
                        </tr>
                            <tr>
                                <td>
                                    <label>
                                            <input <?php if (isset($permissoes['vServico'])) {
                                                if ($permissoes['vServico'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="vServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Ver Servicio</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['aServico'])) {
                                                if ($permissoes['aServico'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="aServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Agregar Servicio</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['eServico'])) {
                                                if ($permissoes['eServico'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="eServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Servicio</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['dServico'])) {
                                                if ($permissoes['dServico'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="dServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Eliminar Servicio</span>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGFour" data-toggle="collapse">
                                <span><i class='bx bx-spreadsheet icon-cli' ></i></span>
                                <h5 style="padding-left: 28px">Ordenes de Servicio</h5>
                                <span><i class='bx bx-chevron-right icon-clic'></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGFour">
                        <div class="widget-content">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                            <input <?php if (isset($permissoes['vOs'])) {
                                                if ($permissoes['vOs'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="vOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Ver OS</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['aOs'])) {
                                                if ($permissoes['aOs'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="aOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Agregar OS</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['eOs'])) {
                                                if ($permissoes['eOs'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="eOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar OS</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['dOs'])) {
                                                if ($permissoes['dOs'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="dOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Eliminar OS</span>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGFive" data-toggle="collapse">
                                <span><i class='bx bx-cart-alt icon-cli' ></i></span>
                                <h5 style="padding-left: 28px">Ventas</h5>
                                <span><i class='bx bx-chevron-right icon-clic'></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGFive">
                        <div class="widget-content">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                            <input <?php if (isset($permissoes['vVenda'])) {
                                                if ($permissoes['vVenda'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="vVenda" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Ver Venta</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['aVenda'])) {
                                                if ($permissoes['aVenda'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="aVenda" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Agregar Venta</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['eVenda'])) {
                                                if ($permissoes['eVenda'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="eVenda" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Venta</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['dVenda'])) {
                                                if ($permissoes['dVenda'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="dVenda" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Eliminar Venta</span>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGSix" data-toggle="collapse">
                                <span><i class='bx bx-credit-card-front icon-cli' ></i></span>
                                <h5 style="padding-left: 28px">Cobranzas</h5>
                                <span><i class='bx bx-chevron-right icon-clic'></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGSix">
                        <div class="widget-content">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                            <input <?php if (isset($permissoes['vCobranca'])) {
                                                if ($permissoes['vCobranca'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="vCobranca" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Ver Cobranzas</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['aCobranca'])) {
                                                if ($permissoes['aCobranca'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="aCobranca" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Agregar Cobranzas</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['eCobranca'])) {
                                                if ($permissoes['eCobranca'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="eCobranca" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Cobranzas</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['dCobranca'])) {
                                                if ($permissoes['dCobranca'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="dCobranca" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Eliminar Cobranzas</span>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGSeven" data-toggle="collapse">
                                <span><i class='bx bx-receipt icon-cli' ></i></span>
                                <h5 style="padding-left: 28px">Garantías</h5>
                                <span><i class='bx bx-chevron-right icon-clic'></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGSeven">
                        <div class="widget-content">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                            <input <?php if (isset($permissoes['vGarantia'])) {
                                                if ($permissoes['vGarantia'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="vGarantia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Ver Garantía</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['aGarantia'])) {
                                                if ($permissoes['aGarantia'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="aGarantia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Agregar Garantía</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['eGarantia'])) {
                                                if ($permissoes['eGarantia'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="eGarantia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Garantía</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['dGarantia'])) {
                                                if ($permissoes['dGarantia'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="dGarantia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Eliminar Garantía</span>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGEight" data-toggle="collapse">
                                <span><i class='bx bx-box icon-cli' ></i></span>
                                <h5 style="padding-left: 28px">Archivos</h5>
                                <span><i class='bx bx-chevron-right icon-clic'></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGEight">
                        <div class="widget-content">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                            <input <?php if (isset($permissoes['vArquivo'])) {
                                                if ($permissoes['vArquivo'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="vArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Ver Archivo</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['aArquivo'])) {
                                                if ($permissoes['aArquivo'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="aArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Agregar Archivo</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['eArquivo'])) {
                                                if ($permissoes['eArquivo'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="eArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Archivo</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['dArquivo'])) {
                                                if ($permissoes['dArquivo'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="dArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Eliminar Archivo</span>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGNine" data-toggle="collapse">
                                <span><i class='bx bx-bar-chart-square icon-cli' ></i></span>
                                <h5 style="padding-left: 28px">Financiero</h5>
                                <span><i class='bx bx-chevron-right icon-clic'></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGNine">
                        <div class="widget-content">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                            <input <?php if (isset($permissoes['vLancamento'])) {
                                                if ($permissoes['vLancamento'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="vLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Ver lanzamiento</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['aLancamento'])) {
                                                if ($permissoes['aLancamento'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="aLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Agregar Lanzamiento</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['eLancamento'])) {
                                                if ($permissoes['eLancamento'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="eLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Lanzamiento</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['dLancamento'])) {
                                                if ($permissoes['dLancamento'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="dLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Eliminar Lanzamiento</span>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGTen" data-toggle="collapse">
                                <span><i class='bx bx-chart icon-cli' ></i></span>
                                <h5 style="padding-left: 28px">Informes</h5>
                                <span><i class='bx bx-chevron-right icon-clic'></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGTen">
                        <div class="widget-content">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                            <input <?php if (isset($permissoes['rCliente'])) {
                                                if ($permissoes['rCliente'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="rCliente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Informe Cliente</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['rServico'])) {
                                                if ($permissoes['rServico'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="rServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Informe Servicio</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['rOs'])) {
                                                if ($permissoes['rOs'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="rOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl">Informe OS</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['rProduto'])) {
                                                if ($permissoes['rProduto'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="rProduto" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl">Informe Producto</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['rVenda'])) {
                                                if ($permissoes['rVenda'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="rVenda" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl">Informe Venta</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['rFinanceiro'])) {
                                                if ($permissoes['rFinanceiro'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="rFinanceiro" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl">Informe Financiero</span>
                                        </label>
                                    </td>
                                    <td colspan="2"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGEleven" data-toggle="collapse">
                                <span><i class='bx bx-cog icon-cli' ></i></span>
                                <h5 style="padding-left: 28px">Configuraciones y Sistema</h5>
                                <span><i class='bx bx-chevron-right icon-clic'></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGEleven">
                        <div class="widget-content">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                            <input <?php if (isset($permissoes['cUsuario'])) {
                                                if ($permissoes['cUsuario'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="cUsuario" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Usuario</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['cEmitente'])) {
                                                if ($permissoes['cEmitente'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="cEmitente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Cliente</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['cPermissao'])) {
                                                if ($permissoes['cPermissao'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="cPermissao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Permiso</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if (isset($permissoes['cBackup'])) {
                                                if ($permissoes['cBackup'] == '1') {
                                                    echo 'checked';
                                                }
                                            }?> name="cBackup" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Backup</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>
                                            <input <?php echo (isset($permissoes['cAuditoria']) && $permissoes['cAuditoria'] == 1) ? 'checked' : ''; ?> name="cAuditoria" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Auditoría</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php echo (isset($permissoes['cEmail']) && $permissoes['cEmail'] == 1) ? 'checked' : ''; ?> name="cEmail" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> E-mails</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php echo (isset($permissoes['cSistema']) && $permissoes['cSistema'] == 1) ? 'checked' : ''; ?> name="cSistema" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Sistema</span>
                                        </label>
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3" style="display:flex;justify-content: center">
                              <button type="submit" class="button btn btn-primary">
                              <span class="button__icon"><i class='bx bx-save'></i></span><span class="button__text2">Salvar</span></button>
                                <a title="Volver" class="button btn btn-mini btn-warning" href="<?php echo site_url() ?>/permissoes">
                                  <span class="button__icon"><i class="bx bx-undo"></i></span> <span class="button__text2">Volver</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<script type="text/javascript" src="<?php echo base_url()?>assets/js/validate.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#marcarTodos").change(function () {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });
        $("#formPermissao").validate({
            rules :{
                nome: {required: true}
            },
            messages:{
                nome: {required: 'Campo obrigatório'}
            }});
    });
</script>
