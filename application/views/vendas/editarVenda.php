<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/trumbowyg/ui/trumbowyg.css">
<script type="text/javascript" src="<?php echo base_url() ?>assets/trumbowyg/trumbowyg.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/trumbowyg/langs/pt_br.js"></script>

<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title" style="margin: -20px 0 0">
                <span class="icon">
                    <i class="fas fa-cash-register"></i>
                </span>
                <h5>Editar Venta</h5>
            </div>
            <div class="widget-content nopadding tab-content">
                <div class="span12" id="divProdutosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalles de Venta</a></li>
                        <li id="tabProdutos"><a href="#tab2" data-toggle="tab">Productos</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class="span12" id="divEditarVenda">
                                <form action="<?php echo current_url(); ?>" method="post" id="formVendas">
                                    <?php echo form_hidden('idVendas', $result->idVendas) ?>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <h3>Venta:
                                            <?php echo $result->idVendas ?>
                                        </h3>
                                        <div class="span2" style="margin-left: 0">
                                            <label for="dataFinal">Fecha Final</label>
                                            <input id="dataVenda" class="span12 datepicker" type="text" name="dataVenda" value="<?php echo date('d/m/Y', strtotime($result->dataVenda)); ?>" />
                                        </div>
                                        <div class="span5">
                                            <label for="cliente">Cliente<span class="required">*</span></label>
                                            <input id="cliente" class="span12" type="text" name="cliente" value="<?php echo $result->nomeCliente ?>" />
                                            <input id="clientes_id" class="span12" type="hidden" name="clientes_id" value="<?php echo $result->clientes_id ?>" />
                                            <input id="valorTotal" type="hidden" name="valorTotal" value="" />
                                        </div>
                                        <div class="span5">
                                            <label for="tecnico">Vendedor<span class="required">*</span></label>
                                            <input id="tecnico" class="span12" type="text" name="tecnico" value="<?php echo $result->nome ?>" />
                                            <input id="usuarios_id" class="span12" type="hidden" name="usuarios_id" value="<?php echo $result->usuarios_id ?>" />
                                        </div>
                                    </div>



                                    <div class="span6" style="padding: 1%; margin-left: 0">
                                        <label for="observacoes">
                                            <h4>Observaciones</h4>
                                        </label>
                                        <textarea class="editor" name="observacoes" id="observacoes" cols="30" rows="5"><?php echo $result->observacoes ?></textarea>
                                    </div>

                                    <div class="span6" style="padding: 1%; margin-left: 0">
                                        <label for="observacoes_cliente">
                                            <h4>Notas para el Cliente</h4>
                                        </label>
                                        <textarea class="editor" name="observacoes_cliente" id="observacoes_cliente" cols="30" rows="5"><?php echo $result->observacoes_cliente ?></textarea>
                                    </div>

                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span8 offset2" style="text-align: center;display:flex; flex-wrap: wrap">
                                            <?php if ($result->Faturado == 0) { ?>
                                                <a href="#modal-faturar" id="btn-faturar" role="button" data-toggle="modal" class="button btn btn-danger">
                                                    <span class="button__icon"><i class='bx bx-dollar'></i></span> <span class="button__text2">Facturar</span></a>
                                            <?php
                                            } ?>
                                            <button class="button btn btn-primary" id="btnContinuar">
                                                <span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Actualizar</span></button>
                                            <a href="<?php echo base_url() ?>index.php/vendas/visualizar/<?php echo $result->idVendas; ?>" class="button btn btn-primary">
                                                <span class="button__icon"><i class="bx bx-show"></i></span><span class="button__text2">Ver</span></a>
                                            <a href="<?php echo base_url() ?>index.php/vendas" class="button btn btn-warning">
                                                <span class="button__icon"><i class="bx bx-undo"></i></span> <span class="button__text2">Volverr</span></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="span12 well" style="padding: 1%; margin-left: 0">
                                <div class="span11">
                                    <form id="formProdutos" action="<?php echo base_url(); ?>index.php/vendas/adicionarProduto" method="post">
                                        <div class="span6">
                                            <input type="hidden" name="idProduto" id="idProduto" />
                                            <input type="hidden" name="idVendasProduto" id="idVendasProduto" value="<?php echo $result->idVendas ?>" />
                                            <input type="hidden" name="estoque" id="estoque" value="" />
                                            <label for="">Producto</label>
                                            <input type="text" class="span12" name="produto" id="produto" placeholder="Introduzca el nombre del producto" />
                                        </div>
                                        <div class="span2">
                                            <label for="">Precio</label>
                                            <input type="text" placeholder="Precio" id="preco" name="preco" class="span12 money" />
                                        </div>
                                        <div class="span2">
                                            <label for="">Cantidad</label>
                                            <input type="text" placeholder="Cantidad" id="quantidade" name="quantidade" class="span12" />
                                        </div>
                                        <div class="span2">
                                            <label for="">&nbsp</label>
                                            <button class="button btn btn-success" id="btnAdicionarProduto">
                                                <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">Agregar</span></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="span11">
                                    <form id="formDesconto" action="<?php echo base_url(); ?>index.php/vendas/adicionarDesconto" method="POST">
                                        <div class="span1">
                                            <input type="hidden" name="idVendas" id="idVendas" value="<?php echo $result->idVendas; ?>" />
                                            <label for="">Descuento</label>
                                            <input style="width: 4em;" id="desconto" name="desconto" type="text" placeholder="0.00" maxlength="6" size="2" /><br />
                                            <strong><span style="color: red" id="errorAlert"></span></strong>
                                        </div>
                                        <div class="span1">
                                        <label for="">Tipo de Desc.</label>
                                        <select style="width: 4em;" name="tipoDesconto" id="tipoDesconto">
                                            <option value="real">$</option>
                                            <option value="porcento" <?=$result->tipo_desconto == "porcento" ? "selected" : "" ?>>%</option>
                                        </select>
                                        <strong><span style="color: red" id="errorAlert"></span></strong>
                                        </div>
                                        <div class="span2">
                                            <label for="">Total con Descuento</label>
                                            <input class="span12 money" id="resultado" type="text" data-affixes-stay="true" data-thousands="" data-decimal="." name="resultado" value="" readonly />
                                        </div>
                                        <div class="span2">
                                            <label for="">&nbsp;</label>
                                            <button class="button btn btn-success" id="btnAdicionarDesconto">
                                                <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">Aplicar</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="span12" id="divProdutos" style="margin-left: 0">
                                <table class="table table-bordered" id="tblProdutos">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th width="8%">Cantidad</th>
                                            <th width="10%">Precio</th>
                                            <th width="6%">Acciones</th>
                                            <th width="10%">Sub-total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
foreach ($produtos as $p) {
    $preco = $p->preco ?: $p->precoVenda;
    $total = $total + $p->subTotal;
    echo '<tr>';
    echo '<td>' . $p->descricao . '</td>';
    echo '<td><div align="center">' . $p->quantidade . '</td>';
    echo '<td><div align="center">$: ' . $preco . '</td>';
    echo '<td><div align="center"><a href="" idAcao="' . $p->idItens . '" prodAcao="' . $p->idProdutos . '" quantAcao="' . $p->quantidade . '" title="Eliminar Producto" class="btn-nwe4"><i class="bx bx-trash-alt"></i></a></td>';
    echo '<td><div align="center">$: ' . number_format($p->subTotal, 2, '.', '') . '</td>';
    echo '</tr>';
} ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" style="text-align: right"><strong>Total:</strong></td>
                                            <td>
                                                <div align="center"><strong>$: <?php echo number_format($total, 2, '.', ''); ?></strong></div> <input type="hidden" id="total-venda" value="<?php echo number_format($total, 2, '.', ''); ?>">
                                            </td>
                                        </tr>
                                        <?php if ($result->valor_desconto != 0 && $result->desconto != 0) {
                                            ?>
                                            <tr>
                                                <td colspan="4" style="text-align: right"><strong>Descuento:</strong></td>
                                                <td>
                                                    <div align="center"><strong><?php echo $result->tipo_desconto == "real" ? "R$ " : ""; ?> <?php echo number_format($result->desconto, 2, '.', ''); ?> <?php echo $result->tipo_desconto == "porcento" ? " %" : ""; ?></strong></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="text-align: right"><strong>Total Con Descuento:</strong></td>
                                                <td>
                                                    <div align="center"><strong>$: <?php echo number_format($result->valor_desconto, 2, '.', ''); ?></strong></div><input type="hidden" id="total-desconto" value="<?php echo number_format($result->valor_desconto, 2, '.', ''); ?>">
                                                </td>
                                            </tr>
                                        <?php
                                        } ?>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                &nbsp
            </div>
        </div>
    </div>
</div>

<!-- Modal Faturar-->
<div id="modal-faturar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="formFaturar" action="<?php echo current_url() ?>" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Facturar Venta</h3>
        </div>
        <div class="modal-body">
            <div class="span12 alert alert-info" style="margin-left: 0"> Es obligatorio rellenar los campos con asterisco.</div>
            <div class="span12" style="margin-left: 0">
                <label for="descricao">Descripción</label>
                <input class="span12" id="descricao" type="text" name="descricao" value="Fatura de Venda Nº: <?php echo $result->idVendas; ?> " />
            </div>
            <div class="span12" style="margin-left: 0">
                <div class="span12" style="margin-left: 0">
                    <label for="cliente">Cliente*</label>
                    <input class="span12" id="cliente" type="text" name="cliente" value="<?php echo $result->nomeCliente ?>" />
                    <input type="hidden" name="clientes_id" id="clientes_id" value="<?php echo $result->clientes_id ?>">
                    <input type="hidden" name="vendas_id" id="vendas_id" value="<?php echo $result->idVendas; ?>">
                </div>
            </div>
            <div class="span12" style="margin-left: 0">
                <div class="span5" style="margin-left: 0">
                    <label for="valor">Valor*</label>
                    <input type="hidden" id="tipo" name="tipo" value="receita" />
                    <input class="span12 money" id="valor" type="text" name="valor" value="<?php echo number_format($total, 2, '.', ''); ?> " />
                </div>
                <div class="span5" style="margin-left: 2">
                    <label for="valor">Valor Con Descuento*</label>
                    <input class="span12 money" id="faturar-desconto" type="text" name="faturar-desconto" value="<?php echo number_format($result->valor_desconto, 2, '.', ''); ?> " />
                </div>
            </div>
            <div class="span12" style="margin-left: 0">
                <div class="span4" style="margin-left: 0">
                    <label for="vencimento">fecha de Entrega*</label>
                    <input class="span12 datepicker" autocomplete="off" id="vencimento" type="text" name="vencimento" />
                </div>
            </div>
            <div class="span12" style="margin-left: 0">
                <div class="span4" style="margin-left: 0">
                    <label for="recebido">Recibió?</label>
                    &nbsp &nbsp &nbsp &nbsp<input id="recebido" type="checkbox" name="recebido" value="1" />
                </div>
                <div id="divRecebimento" class="span8" style=" display: none">
                    <div class="span6">
                        <label for="recebimento">Fecha de Recibimiento</label>
                        <input class="span12 datepicker" autocomplete="off" id="recebimento" type="text" name="recebimento" />
                    </div>
                    <div class="span6">
                        <label for="formaPgto">Formulario de pago</label>
                        <select name="formaPgto" id="formaPgto" class="span12">
                            <option value="Dinheiro">Dinheiro</option>
                            <option value="Cartão de Crédito">Tarjeta de Crédito</option>
                            <option value="Débito">Débito</option>
                            <option value="Boleto">Efectivo</option>
                            <option value="Depósito">Depósito</option>
                            <option value="Pix">Pix</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="display:flex">
            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true" id="btn-cancelar-faturar">
                <span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
            <button class="button btn btn-danger"><span class="button__icon"><i class='bx bx-dollar'></i></span> <span class="button__text2">Facturar</span></button>
        </div>
    </form>
</div>
<script src="<?php echo base_url(); ?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
    
    $("#quantidade").keyup(function() {
        this.value = this.value.replace(/[^0-9.]/g, '');
    });

    function calcDesconto(valor, desconto, tipoDesconto) {
        var resultado = 0;
        if (tipoDesconto == 'real') {
            resultado = valor - desconto;
        }
        if (tipoDesconto == 'porcento') {
            resultado = (valor - desconto * valor / 100).toFixed(2);
        }
        return resultado;
    }

    function validarDesconto(resultado, valor) {
        if (resultado == valor) {
            return resultado = "";
        } else {
            return resultado.toFixed(2);
        }
    }
    var valorBackup = $("#total-venda").val();

    $("#desconto").keyup(function() {

        this.value = this.value.replace(/[^0-9.]/g, '');
        if ($("#total-venda").val() == null || $("#total-venda").val() == '') {
            $('#errorAlert').text('El valor no se puede borrar.').css("display", "inline").fadeOut(5000);
            $('#desconto').val('');
            $('#resultado').val('');
            $("#total-venda").val(valorBackup);
            $("#desconto").focus();

        } else if (Number($("#desconto").val()) >= 0) {
            $('#resultado').val(calcDesconto(Number($("#total-venda").val()), Number($("#desconto").val()), $("#tipoDesconto").val()));
            $('#resultado').val(validarDesconto(Number($('#resultado').val()), Number($("#total-venda").val())));
        } else {
            $('#errorAlert').text('Erro desconhecido.').css("display", "inline").fadeOut(5000);
            $('#desconto').val('');
            $('#resultado').val('');
        }
    });
    $('#tipoDesconto').on('change', function() {
        if (Number($("#desconto").val()) >= 0) {
            $('#resultado').val(calcDesconto(Number($("#total-venda").val()), Number($("#desconto").val()), $("#tipoDesconto").val()));
            $('#resultado').val(validarDesconto(Number($('#resultado').val()), Number($("#total-venda").val())));
        }
    });

    $("#total-venda").focusout(function() {
        $("#total-venda").val(valorBackup);
        if ($("#total-venda").val() == '0.00' && $('#resultado').val() != '') {
            $('#errorAlert').text('No puede borrar el valor.').css("display", "inline").fadeOut(6000);
            $('#resultado').val('');
            $("#total-venda").val(valorBackup);
            $('#resultado').val(calcDesconto(Number($("#total-venda").val()), Number($("#desconto").val()), $("#tipoDesconto").val()));
            $('#resultado').val(validarDesconto(Number($('#resultado').val()), Number($("#total-venda").val())));
            $("#desconto").focus();
        } else {
            $('#resultado').val(calcDesconto(Number($("#total-venda").val()), Number($("#desconto").val()), $("#tipoDesconto").val()));
            $('#resultado').val(validarDesconto(Number($('#resultado').val()), Number($("#total-venda").val())));
        }
    });

    $('#resultado').focusout(function() {
        if (Number($('#resultado').val()) > Number($("#total-venda").val())) {
            $('#errorAlert').text('El descuento no puede ser mayor que el Valor.').css("display", "inline").fadeOut(6000);
            $('#resultado').val('');
        }
        if ($("#desconto").val() != "" || $("#desconto").val() != null) {
            $('#resultado').val(calcDesconto(Number($("#total-venda").val()), Number($("#desconto").val())));
            $('#resultado').val(validarDesconto(Number($('#resultado').val()), Number($("#total-venda").val())));
        }
    });

    $(document).ready(function() {
        $(".money").maskMoney();
        $('#recebido').click(function(event) {
            var flag = $(this).is(':checked');
            if (flag == true) {
                $('#divRecebimento').show();
            } else {
                $('#divRecebimento').hide();
            }
        });
        $(document).on('click', '#btn-faturar', function(event) {
            event.preventDefault();
            valor = $('#total-venda').val();
            valor_desconto = $('#total-desconto').val();
            valor_desconto != 0.00 || valor_desconto ? $('#valor').attr('readonly', false) : $('#faturar-desconto').attr('readonly', false);
            valor = valor.replace(',', '');
            $('#valor').val(valor);
        });
        $('#formDesconto').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                beforeSend: function() {
                    Swal.fire({
                        title: 'Procesando',
                        text: 'Registrando Descuento...',
                        icon: 'info',
                        showCloseButton: false,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    });
                },
                success: function(response) {
                    if (response.result) {
                        Swal.fire({
                            type: "success",
                            title: "Éxito",
                            text: response.messages
                        });
                        $("#divProdutos").load("<?php echo current_url(); ?> #divProdutos");
                        $("#desconto").val("");
                        $("#resultado").val("");
                        /*setTimeout(function() {
                            window.location.href = window.BaseUrl + 'index.php/vendas/editar/' + <?php echo $result->idVendas ?>;
                        }, 2000);*/
                    } else {
                        Swal.fire({
                            type: "error",
                            title: "Atención",
                            text: response.messages
                        });
                        $("#divProdutos").load("<?php echo current_url(); ?> #divProdutos");
                        $("#desconto").val("");
                        $("#resultado").val("");
                    }

                },
                error: function(response) {
                    Swal.fire({
                        type: "error",
                        title: "Atención",
                        text: response.responseJSON.messages
                    });
                    $("#divProdutos").load("<?php echo current_url(); ?> #divProdutos");
                    $("#desconto").val("");
                    $("#resultado").val("");
                }
            });
        });
        $("#formFaturar").validate({
            rules: {
                descricao: {
                    required: true
                },
                cliente: {
                    required: true
                },
                valor: {
                    required: true
                },
                vencimento: {
                    required: true
                }
            },
            messages: {
                descricao: {
                    required: 'Campo Requerido.'
                },
                cliente: {
                    required: 'Campo Requerido.'
                },
                valor: {
                    required: 'Campo Requerido.'
                },
                vencimento: {
                    required: 'Campo Requerido.'
                }
            },
            submitHandler: function(form) {
                var dados = $(form).serialize();
                var qtdProdutos = $('#tblProdutos >tbody >tr').length;

                $('#btn-cancelar-faturar').trigger('click');

                if (qtdProdutos <= 0) {
                    Swal.fire({
                        type: "error",
                        title: "Atención",
                        text: "No se puede facturar una venta sin productos"
                    });
                } else if (qtdProdutos > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/vendas/faturar",
                        data: dados,
                        dataType: 'json',
                        success: function(data) {
                            if (data.result == true) {
                                window.location.reload(true);
                            } else {
                                Swal.fire({
                                    type: "error",
                                    title: "Atención",
                                    text: "Ocorreu um erro ao tentar faturar venda."
                                });
                                $('#progress-fatura').hide();
                            }
                        }
                    });

                    return false;
                }
            }
        });
        $("#produto").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteProdutoSaida",
            minLength: 2,
            select: function(event, ui) {
                $("#idProduto").val(ui.item.id);
                $("#estoque").val(ui.item.estoque);
                $("#preco").val(ui.item.preco);
                $("#quantidade").focus();
            }
        });
        $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteCliente",
            minLength: 2,
            select: function(event, ui) {
                $("#clientes_id").val(ui.item.id);
            }
        });
        $("#tecnico").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteUsuario",
            minLength: 2,
            select: function(event, ui) {
                $("#usuarios_id").val(ui.item.id);
            }
        });
        $("#formVendas").validate({
            rules: {
                cliente: {
                    required: true
                },
                tecnico: {
                    required: true
                },
                dataVenda: {
                    required: true
                }
            },
            messages: {
                cliente: {
                    required: 'Campo Requerido.'
                },
                tecnico: {
                    required: 'Campo Requerido.'
                },
                dataVenda: {
                    required: 'Campo Requerido.'
                }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });
        $("#formProdutos").validate({
            rules: {
                preco: {
                    required: true
                },
                quantidade: {
                    required: true
                }
            },
            messages: {
                preco: {
                    required: 'Ingrese el Precio'
                },
                quantidade: {
                    required: 'ingrese la cantidad'
                }
            },
            submitHandler: function(form) {
                var quantidade = parseInt($("#quantidade").val());
                var estoque = parseInt($("#estoque").val());

                <?php if (!$configuration['control_estoque']) {
                    echo 'estoque = 1000000';
                }; ?>

                if (estoque < quantidade) {
                    Swal.fire({
                        type: "warning",
                        title: "Atención",
                        text: "No tienes suficiente stock."
                    });
                } else {
                    var dados = $(form).serialize();
                    $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/vendas/adicionarProduto",
                        data: dados,
                        dataType: 'json',
                        success: function(data) {
                            if (data.result == true) {
                                $("#divProdutos").load("<?php echo current_url(); ?> #divProdutos");
                                $("#quantidade").val('');
                                $("#preco").val('');
                                $("#produto").val('').focus();
                                $("#resultado").val("");
                                $("#desconto").val("");
                            } else {
                                Swal.fire({
                                    type: "error",
                                    title: "Atención",
                                    html: "Ocorreu um erro ao tentar adicionar produto. <br /><br />Error: " + data.messages
                                });
                                $("#divProdutos").load("<?php echo current_url(); ?> #divProdutos");
                                $('#formProdutos')[0].reset();
                            }
                        }
                    });
                    return false;
                }
            }
        });
        $(document).on('click', 'a', function(event) {
            var idProduto = $(this).attr('idAcao');
            var quantidade = $(this).attr('quantAcao');
            var produto = $(this).attr('prodAcao');
            if ((idProduto % 1) == 0) {
                $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/vendas/excluirProduto",
                    data: "idProduto=" + idProduto + "&idVendas=" + <?= $result->idVendas ?> + "&quantidade=" + quantidade + "&produto=" + produto,
                    dataType: 'json',
                    success: function(data) {
                        if (data.result == true) {
                            $("#divProdutos").load("<?php echo current_url(); ?> #divProdutos");
                            $("#resultado").val("");
                            $("#desconto").val("");
                        } else {
                            Swal.fire({
                                type: "error",
                                title: "Atención",
                                html: "Ocorreu um erro ao tentar excluir produto." + data.messages
                            });
                            $("#divProdutos").load("<?php echo current_url(); ?> #divProdutos");
                        }
                    }
                });
                return false;
            }
        });
        $(".datepicker").datepicker({
            dateFormat: 'dd/mm/yy'
        });
        $('.editor').trumbowyg({
            lang: 'pt_br'
        });
    });
</script>
