<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/dayjs.min.js"></script>

<?php $situacao = $this->input->get('situacao');
$periodo = $this->input->get('periodo');
?>

<style type="text/css">
    label.error {
        color: #b94a48;
    }

    input.error {
        border-color: #b94a48;
    }

    input.valid {
        border-color: #5bb75b;
    }

    textarea {
        resize: vertical;
    }
</style>

<div class="new122">
    <div class="widget-title">
                <span class="icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </span>
                <h5>Lanzamientos financieros</h5>
    </div>
    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aLancamento')) { ?>
        <div class="span5" style="display:flex">
            <a href="#modalReceita" data-toggle="modal" role="button" class="button btn btn-mini btn-success" style="width: 230px">
                <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2" title="Registrar nuevos ingresos o gastos">Ingreso/Gasto</span></a>
        </div>
    <?php } ?>

    <div class="span12" style="margin-left: 0;margin-top: 1rem;">
        <form action="<?php echo current_url(); ?>" method="get">
            <div class="span2" style="margin-left: 0">
                <label>Período</label>
                <select id="periodo" name="periodo" class="span12">
                    <option value="dia" <?= $this->input->get('periodo') === 'dia' ? 'selected' : '' ?>>Día</option>
                    <option value="semana" <?= $this->input->get('periodo') === 'semana' ? 'selected' : '' ?>>Semana
                    </option>
                    <option value="mes" <?= $this->input->get('periodo') === 'mes' ? 'selected' : '' ?>>Mes</option>
                    <option value="ano" <?= $this->input->get('periodo') === 'ano' ? 'selected' : '' ?>>Año</option>
                </select>
            </div>

            <div class="span2">
                <label>Vencimiento (en)</label>
                <input id="vencimento_de" type="text" class="span12 datepicker" name="vencimento_de" value="<?= $this->input->get('vencimento_de') ? $this->input->get('vencimento_de') : date('d/m/Y') ?>">
            </div>

            <div class="span2">
                <label>Vencimiento (Hasta)</label>
                <input id="vencimento_ate" type="text" class="span12 datepicker" name="vencimento_ate" value="<?= $this->input->get('vencimento_ate') ? $this->input->get('vencimento_ate') : date('d/m/Y') ?>">
            </div>

            <div class="span2">
                <label>Tipo</label>
                <select name="tipo" class="span12">
                    <option value="">Todos</option>
                    <option value="receita" <?= $this->input->get('tipo') === 'receita' ? 'selected' : '' ?>>Ganancia
                    </option>
                    <option value="despesa" <?= $this->input->get('tipo') === 'despesa' ? 'selected' : '' ?>>Gastos
                    </option>
                </select>
            </div>

            <div class="span2">
                <label>Estado</label>
                <select name="status" class="span12">
                    <option value="">Todos (Pendiente y Pagado)</option>
                    <option value="0" <?= $this->input->get('status') === '0' ? 'selected' : '' ?>>Pendiente</option>
                    <option value="1" <?= $this->input->get('status') === '1' ? 'selected' : '' ?>>Pagado</option>
                </select>
            </div>

            <div class="span2">
                <label>Cliente/Proveedor</label>
                <input id="cliente_busca" type="text" class="span12" name="cliente" value="<?= $this->input->get('cliente') ?>">
            </div>

            <div class="span2 pull-right">
                <button type="submit" class="button btn btn-primary btn-sm" style="min-width: 120px">
                    <span class="button__icon"><i class='bx bx-filter-alt'></i></span><span class="button__text2">Filtrar</span></a></button>
            </div>
        </form>
    </div>

    <div>
        <div class="widget-box">

            <div class="widget-content nopadding tab-content">


                <table class="table table-bordered " id="divLancamentos">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Cliente / Proveedor</th>
                            <th>Descripción</th>
                            <th>Vencimiento</th>
                            <th>Estado</th>
                            <th>Observaciones</th>
                            <th>Forma de Pago</th>
                            <th>Valor (+)</th>
                            <th>Descuento (-)</th>
                            <th>Valor Total (=)</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if (!$results) {
                            echo '<tr>
              <td colspan="9" >No se econtraron datos financieros...</td>
            </tr>';
                        }
                        foreach ($results as $r) {
                            $vencimento = date(('d/m/Y'), strtotime($r->data_vencimento));
                           
                            if ($r->baixado == 0) {
                                $status = 'Pendente';
                            } else {
                                $status = 'Pago';
                            };
                            if ($r->tipo == 'receita') {
                                $label = 'success';
                            } else {
                                $label = 'important';
                            }
                            echo '<tr>';
                            echo '<td>' . $r->idLancamentos . '</td>';
                            echo '<td><span class="label label-' . $label . '">' . ucfirst($r->tipo) . '</span></td>';
                            echo '<td>' . $r->cliente_fornecedor . '</td>';
                            echo '<td>' . $r->descricao . '</td>';
                            echo '<td>' . $vencimento . '</td>';
                            echo '<td>' . $status . '</td>';
                            echo '<td>' . $r->observacoes . '</td>';
                            echo '<td>' . $r->forma_pgto . '</td>';
                            echo '<td> $ ' . number_format($r->valor, 2, ',', '.') . '</td>'; //valor total sem o desconto
                            echo  $r->tipo_desconto == "real" ? '<td>' . "$ ".$r->desconto . '</td>' : ($r->tipo_desconto == "porcentaje" ? '<td>' . $r->desconto." %" . '</td>' : '<td>' . "-" . '</td>'); // valor do desconto
                            echo '<td> $ ' . number_format($r->valor_desconto, 2, ',', '.') . '</td>'; // valor total  com o desconto
                           
                            echo '<td>';
                            if ($r->data_pagamento == "0000-00-00") {
                                $data_pagamento = "";
                            } else {
                                $data_pagamento = date('d/m/Y', strtotime($r->data_pagamento));
                            }

                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eLancamento')) {
                                echo '<a href="#modalEditar" style="margin-right: 1%" data-toggle="modal" role="button" idLancamento="' . $r->idLancamentos . '" descricao="' . $r->descricao . '" valor="' . number_format($r->valor, 2, ',', '.') . '" vencimento="' . date('d/m/Y', strtotime($r->data_vencimento)) . '" pagamento="' . $data_pagamento . '" baixado="' . $r->baixado . '" cliente="' . $r->cliente_fornecedor . '" formaPgto="' . $r->forma_pgto . '" tipo="' . $r->tipo . '" observacoes="' . $r->observacoes . '" descontos_editar="' . $r->desconto . '" valor_desconto_editar="' . $r->desconto . '" usuario="' . $r->nome . '" class="btn-nwe3 editar" title="Editar OS"><i class="bx bx-edit"></i></a>';
                            }
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dLancamento')) {
                                echo '<a href="#modalExcluir" data-toggle="modal" role="button" idLancamento="' . $r->idLancamentos . '" class="btn-nwe4 excluir" title="Eliminar OS"><i class="bx bx-trash-alt"></i></a>';
                            }

                            echo '</td>';
                            echo '</tr>';
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" style="text-align: right; color: green"><strong>Total Ingresos:</strong></td>
                            <td colspan="6" style="text-align: left; color: green">
                                <strong>$ <?php echo number_format($totals['receitas'], 2, ',', '.') ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: right; color: red"><strong>Total Gastos:</strong></td>
                            <td colspan="6" style="text-align: left; color: red">
                                <strong>$<?php echo number_format($totals['Gastos'], 2, ',', '.') ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: right"><strong>Saldo:</strong></td>
                            <td colspan="6" style="text-align: left;">
                                <strong>$ <?php echo number_format($totals['receitas'] - $totals['despesas'], 2, ',', '.') ?></strong>
                            </td>
                        </tr>
                    
                        <tr>
                            <td colspan="7" style="text-align: left;"><strong>Estadísticas Generales de Finanzas:</strong></td>
                        </tr> 
                        <tr>
                      <td colspan="7" style="text-align: left; color: green">Ingresos Totales (Pagado): $ <?php echo number_format($estatisticas_financeiro->total_receita, 2, ',', '.'); ?></td>
                      </tr>
                      <tr>
                      <td colspan="7" style="text-align: left; color: red">Gastos Totales (Pagado): $ <?php echo number_format($estatisticas_financeiro->total_despesa, 2, ',', '.'); ?></td>
                      </tr>
                      <tr>
                      <td colspan="7" style="text-align: left;"><strong>Ingresos Totales (-) Gastos = Saldo Líquido: $ <?php $sub_receita_despesa = $estatisticas_financeiro->total_receita - $estatisticas_financeiro->total_despesa;
echo number_format($sub_receita_despesa, 2, ',', '.') ?></strong></td>
                      </tr>
                      <tr>
                      <td colspan="7" style="text-align: left;">Ingresos Totales (+) Gastos $ <?php $soma_receita_despesa = $estatisticas_financeiro->total_receita + $estatisticas_financeiro->total_despesa;
echo number_format($soma_receita_despesa, 2, ',', '.') ?></td>
                      </tr>
                      <tr>
                      <td colspan="7" style="text-align: left;">Total Ingresos pendientes: $ <?php  echo number_format($estatisticas_financeiro->total_receita_pendente, 2, ',', '.'); ?></td>
                      </tr>
                      <tr>
                      <td colspan="7" style="text-align: left;">Total Gastos Pendientes: $ <?php echo number_format($estatisticas_financeiro->total_despesa_pendente, 2, ',', '.'); ?></td>
                      </tr>
                      <tr>
                      <td colspan="7" style="text-align: left;">Total Ingresos pendientes (-) Gastos Pendientes: $ <?php $sub_recpendente_despependente = $estatisticas_financeiro->total_receita_pendente - $estatisticas_financeiro->total_despesa_pendente;
echo number_format($sub_recpendente_despependente, 2, ',', '.')?></td>
                      </tr>
                      <tr>
                      <td colspan="7" style="text-align: left;"><strong>Total Ingresos pendientes (+) Gastos Pendientes: $ <?php $sub_recpendente_despependente = $estatisticas_financeiro->total_receita_pendente + $estatisticas_financeiro->total_despesa_pendente;
echo number_format($sub_recpendente_despependente, 2, ',', '.')?></strong></td>
                      </tr>
                      <tr>
                      <td colspan="7" style="text-align: left;">Descuentos totales aplicados a lanzamientos pagados: $ <?php echo number_format($estatisticas_financeiro->total_valor_desconto, 2, ',', '.'); ?></td>
                      </tr>
                      <tr>
                      <td colspan="7" style="text-align: left;">Descuentos Totales aplicados a lanzamientos Pendientes: $ <?php echo number_format($estatisticas_financeiro->total_valor_desconto_pendente, 2, ',', '.'); ?></td>
                      </tr>
                      <tr>
                      <td colspan="7" style="text-align: left;"><strong>Total descuentos aplicados (pagados + pendientes): $ <?php $soma_descontos_pagos = $estatisticas_financeiro->total_valor_desconto + $estatisticas_financeiro->total_valor_desconto_pendente;
echo number_format($soma_descontos_pagos, 2, ',', '.')?></strong></td>
                      </tr>
                      <tr>
                      <td colspan="7" style="text-align: left;">Ingresos Totales sin descuentos aplicados (pagados + pendientes): $ <?php echo number_format($estatisticas_financeiro->total_receita_sem_desconto, 2, ',', '.'); ?></td>
                      </tr>
                      <tr>
                      <td colspan="7" style="text-align: left;">Gastos Totales sin descuentos aplicados (pagados + pendientes): $ <?php echo number_format($estatisticas_financeiro->total_despesa_sem_desconto, 2, ',', '.'); ?></td>
                      </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <?php echo $this->pagination->create_links(); ?>
</div>

<!-- Modal nova receita e despesa -->
<div id="modalReceita" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="formReceita" action="<?php echo base_url() ?>index.php/financeiro/adicionarReceita" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Agregar Ingresos/Gastos</h3>
        </div>
        <div class="modal-body">

            <div class="span12 alert alert-info" style="margin-left: 0"> Es obligatorio rellenar los campos con
            asterisco.
            </div>

            <div class="span3" style="margin-left: 0">
		    		<label for="tipo">Tipo</label>
		    		<select name="tipo" id="tipo" class="span10">
		    			<option value="receita">Ingresos</option>
		    			<option value="despesa">Gastos</option>				
		    		</select>
	    	</div>

            <div class="span6" style="margin-left: 0">
                <label for="descricao">Descripción/Referencia*</label>
                <input class="span12" id="descricao" type="text" name="descricao" required />
                <input id="urlAtual" type="hidden" name="urlAtual" value="<?php echo current_url() ?>" />
            </div>
            <div class="span12" style="margin-left: 0">
                <div class="span12" style="margin-left: 0">
                    <label for="cliente">Cliente/Proveedor*</label>
                    <input class="span12" id="cliente" type="text" name="cliente" value="" required />
                    <input class="span12" id="idCliente" type="hidden" name="idCliente" value="" />
                </div>

                <div class="span12" style="margin-left: 0">
                    <label for="observacoes">Observaciones</label>
                    <textarea class="span12" id="observacoes" name="observacoes"></textarea>
                </div>

            </div>
            <div class="span12" style="margin-left: 0">
                <div class="span4" style="margin-left: 0">
                    <label for="valor">Valor*</label>
                    <input class="span12 money" id="valor" type="text" name="valor" data-affixes-stay="true" data-thousands="" data-decimal="." required />
                </div>

        <div class="span4">  
	        <label for="descontos">Descuento</label>
	        <input class="span6 money" id="descontos" type="text" name="descontos" value="" placeholder="en $" style="float: left;" />
            <input class="btn btn-inverse" onclick="mostrarValores();" type="button" name="valor_desconto" value="Aplicar" placeholder="$" style="margin-left:3px; width: 70px;" />
	      </div>
		            
          <div class="span3">  
          <label for="valor_desconto">Val.Desc <i class="icon-info-sign tip-left" title="No cambies este campo, si haces clic en él y sales y queda vacío, tendrás que recargar la página e insertarla de nuevo"></i></label>
          <input class="span12 money" id="valor_desconto" readOnly="true" title="No cambies este campo" type="text" name="valor_desconto" value="<?php echo number_format("0.00", 2, ',', '.') ?>"/>
        </div>

                <div class="span4" style="margin-left: 0">
                    <label for="vencimento">Fecha Vencimiento*</label>
                    <input class="span12 datepicker" autocomplete="off" id="vencimento" type="text" name="vencimento" required />
                </div>

                <div class="span5">
		    		<label for="qtdparcelas">Cant. Cuotas</label>
		    		<select name="qtdparcelas" id="qtdparcelas" class="span10">
		    			<option value="0">Pago al contado</option>
		    			<option value="1">1x</option>			
		    			<option value="2">2x</option>			
		    			<option value="3">3x</option>			
		    			<option value="4">4x</option>			
		    			<option value="5">5x</option>			
		    			<option value="6">6x</option>			
		    			<option value="7">7x</option>			
		    			<option value="8">8x</option>			
		    			<option value="9">9x</option>			
		    			<option value="10">10x</option>			
		    			<option value="11">11x</option>			
		    			<option value="12">12x</option>			
		    		</select>
		    	<a href="#modalReceitaParcelada" id="abrirmodalreceitaparcelada" data-toggle="modal" style="display: none;" role="button"> </a>   
	    	</div>    
            <div class="span3" style="margin-left: 0">
                <div class="span3" style="margin-left: 0">
                    <label for="recebido">Recibido?</label>
                  <input id="recebido" type="checkbox" name="recebido" value="1" />
                </div>
            </div>
            
                <div id="divRecebimento" class="span8" style="display: none; margin-left: 0">
                    <div class="span6" style="margin-left: 0">
                        <label for="recebimento">Fecha de Recepción</label>
                        <input class="span12 datepicker" autocomplete="off" id="recebimento" type="text" name="recebimento" />
                    </div>
                    <div class="span6">
                        <label for="formaPgto">Formulario de pago</label>
                        <select name="formaPgto" id="formaPgto" class="span12">
                            <option value="Dinheiro">Contado Efectivo</option>
                            <option value="Pix">MercadoPago</option>
                            <option value="Boleto">Dólares</option>
                            <option value="Cartão de Crédito">Tarjeta de Crédito</option>
                            <option value="Cartão de Débito">Tarjeta de Débito</option>
                            <option value="Cheque">Cheque</option> 
                            <option value="Cheque Pré-datado">Cheque Al-Portador</option> 
                            <option value="Depósito">Depósito</option>
                            <option value="Transferência DOC">Transferencia Bancaria</option>
                            <option value="Transferência TED">Transferencia Billetera Virtual</option>
                            <!-- <option value="Promissória">Promisorio</option>  -->
                        </select>
                    </div>
                </div>

            </div>

        </div>
        <div class="modal-footer" style="display:flex;justify-content: right">
            <button class="button btn btn-warning" id="cancelar_nova_receita" data-dismiss="modal" aria-hidden="true" style="min-width: 110px">
            <span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
            <button class="button btn btn-primary" style="min-width: 110px">
            <span class="button__icon"><i class='bx bx-save'></i></span><span class="button__text2">Agregar Registro</span></button>
        </div>
    </form>
</div>

<!-- Modal nova receita e despesa parcelada -->
<div id="modalReceitaParcelada" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="formReceita_parc" action="<?php echo base_url() ?>index.php/financeiro/adicionarReceita_parc" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Añadir Ingresos/Gastos en Cuotas</h3>
  </div>
  <div class="modal-body">	
  		<div class="span12 alert alert-info" style="margin-left: 0"> Es obligatorio rellenar los campos con asterisco.</div>
          <div class="span3" style="margin-left: 0">
		    		<label for="tipo_parc" style="margin-left: 0">Tipo</label>
		    		<select name="tipo_parc" id="tipo_parc" class="span10">
		    			<option value="receita">Ingresos</option>
		    			<option value="despesa">Gastos</option>				
		    		</select>
	    	</div>
          <div class="span6" style="margin-left: 0"> 
    		<label for="descricao_parc">Descripción/Referencia*</label>
    		<input class="span12" id="descricao_parc" type="text" name="descricao_parc" required />
    		<input id="urlAtual" type="hidden" name="urlAtual" value="<?php echo current_url() ?>"/>
    	</div>	
    	        
    		<div class="span6" style="margin-left: 0"> 
    			<label for="cliente_parc">Cliente/Proveedor*</label>
    			<input class="span11" id="cliente_parc" type="text" name="cliente_parc" required />
    		</div>
		
			<div class="span6" style="margin-left: 0">
          <label for="observacoes_parc">Observaciones</label>
          <textarea class="span12" id="observacoes_parc" name="observacoes_parc"></textarea>
        </div>	
	  
    	<div class="span12" style="margin-left: 0"> 
        		<div class="span3" style="margin-left: 0">  
    			<label for="valor_parc">Valor*</label>
    			<input class="span12 money" id="valor_parc" type="text" name="valor_parc" required />
    		</div>

          <div class="span4" style="margin-left: 2">  
	        <label for="descontos_parc">Descuento</label>
	        <input class="span6 money" id="descontos_parc" type="text" name="descontos_parc" value="" placeholder="en $" style="float: left;" />
            <input class="btn btn-inverse" onclick="mostrarValoresParc();" type="button" name="desconto_parc" value="Aplicar" placeholder="$" style="width: 70px; margin-left:3px;" />
	      </div>
		         
          <div class="span3" style="margin-left: 0">  
	        <label for="desconto_parc">Descuento <i class="icon-info-sign tip-left" title="No cambies este campo, si haces clic en él y sales y queda vacío, tendrás que recargar la página e insertarla de nuevo"></i></label>
            <input class="span6 money"  id="desconto_parc" readOnly="true" title="No cambies este campo" type="text" name="desconto_parc" value="<?php echo number_format("0.00", 2, ',', '.') ?>" style="float: left;" />
	      </div>
			
    		<div id="divParcelamento" class="span2" style="margin-left: 0">
		    		<label for="qtdparcelas_parc">Cuotas</label>
		    		<select name="qtdparcelas_parc" id="qtdparcelas_parc" class="span12" style="margin-left: 0">
		    			<option value="1">1x</option>
		    			<option value="2">2x</option>			
		    			<option value="3">3x</option>			
		    			<option value="4">4x</option>			
		    			<option value="5">5x</option>			
		    			<option value="6">6x</option>			
		    			<option value="7">7x</option>			
		    			<option value="8">8x</option>			
		    			<option value="9">9x</option>			
		    			<option value="10">10x</option>			
		    			<option value="11">11x</option>			
		    			<option value="12">12x</option>			
		    		</select>
	    	</div>

    		<div class="span4" style="margin-left: 0">
		    		<label for="formaPgto_parc">Formulario de Pago</label>
		    		<select name="formaPgto_parc" id="formaPgto_parc" class="span12" style="margin-left: 0">
                    <option value="Dinheiro">Contado Efectivo</option>
                            <option value="Pix">MercadoPago</option>
                            <option value="Boleto">Dólares</option>
                            <option value="Cartão de Crédito">Tarjeta de Crédito</option>
                            <option value="Cartão de Débito">Tarjeta de Débito</option>
                            <option value="Cheque">Cheque</option> 
                            <option value="Cheque Pré-datado">Cheque Al-Portador</option> 
                            <option value="Depósito">Depósito</option>
                            <option value="Transferência DOC">Transferencia Bancaria</option>
                            <option value="Transferência TED">Transferencia Billetera Virtual</option>
                            <!-- <option value="Promissória">Promisorio</option>  -->
		    		</select>
	    	</div>
    	</div>

	    <div class="span12" style="margin-left: 0;"> 
	    	<div class="span4">
	    		<label for="entrada">Entrada <i class="icon-info-sign tip-right" title="El monto de la entrada se publicará como pagado en el día actual (Hoy)"></i></label>
	    		<input class="span12 money" id="entrada" type="text" name="entrada" value="0" />
	    	</div>

	    	<div class="span4" style="margin-left: 1">
	    		<label for="dia_pgto">Fecha de Entrada*</label>
	    		<input class="span12 datepicker" id="dia_pgto" type="text" name="dia_pgto" value="<?php echo date('d/m/Y'); ?>"  autocomplete="off"  required/>
	    	</div>
	    	
	    	<div class="span4" style="margin-left: 1">
	    		<label for="dia_base_pgto">Fecha Base de Pago* <i class="icon-info-sign tip-left" title="Día del mes en que se liberarán las cuotas restantes, a partir de la fecha seleccionada."></i></label>
	    		<input class="span12 datepicker" id="dia_base_pgto" type="text" autocomplete="off" name="dia_base_pgto" required  />
	    	</div>

	    	<div class="span12" style="background:#f5f5f5;border-radius:4px;margin: 0;border:1px solid #ddd;">
		    	<input id="valorparcelas" type="hidden" name="valorparcelas" readonly />
		    	<div class="span12" style="margin: 14px 0 0 0;float:right;text-align: center; color:#b94a48">
		    		<label id="string_parc" style="font-weight: bold;"></label>
		    	</div>
	    	</div>
            
	    </div>
        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
            <button class="button btn btn-success" id="submitReceita"><span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">Agregar Registro</span></button>
        </div>
    </form>
</div>

<!-- Modal nova despesa (NAO É UTILIZADO MAIS ESSE MODAL)
<div id="modalDespesa" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="formDespesa" action="<?php // echo base_url()?>index.php/financeiro/adicionarDespesa" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Sgtos - Adicionar Despesa</h3>
        </div>
        <div class="modal-body">
            <div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento dos campos com
                asterisco.
            </div>
            <div class="span12" style="margin-left: 0">
                <label for="descricao">Descrição*</label>
                <input class="span12" id="descricao" type="text" name="descricao" />
                <input id="urlAtual" type="hidden" name="urlAtual" value="<?php  // echo current_url()?>" />
            </div>
            <div class="span12" style="margin-left: 0">
                <div class="span12" style="margin-left: 0">
                    <label for="fornecedor">Fornecedor / Empresa*</label>
                    <input class="span12" id="fornecedor" type="text" name="fornecedor" />
                    <input class="span12" id="idFornecedor" type="hidden" name="idFornecedor" />
                </div>

                <div class="span12" style="margin-left: 0">
                    <label for="observacoes">Observações</label>
                    <textarea class="span12" id="observacoes" name="observacoes"></textarea>
                </div>

            </div>
            <div class="span12" style="margin-left: 0">
                <div class="span4" style="margin-left: 0">
                    <label for="valor">Valor*</label>
                    <input type="hidden" name="tipo" value="despesa" />
                    <input class="span12 money" type="text" name="valor" data-affixes-stay="true" data-thousands="" data-decimal="." />
                </div>
                <div class="span4">
                    <label for="vencimento">Data Vencimento*</label>
                    <input class="span12 datepicker" autocomplete="off" type="text" name="vencimento" />
                </div>

            </div>
            <div class="span12" style="margin-left: 0">
                <div class="span4" style="margin-left: 0">
                    <label for="pago">Foi Pago?</label>
                    &nbsp &nbsp &nbsp &nbsp<input id="pago" type="checkbox" name="pago" value="1" />
                </div>
                <div id="divPagamento" class="span8" style=" display: none">
                    <div class="span6">
                        <label for="pagamento">Data Pagamento</label>
                        <input class="span12 datepicker" autocomplete="off" id="pagamento" type="text" name="pagamento" />
                    </div>

                    <div class="span6">
                        <label for="formaPgto">Forma Pgto</label>
                        <select name="formaPgto" class="span12">
                            <option value="Dinheiro">Dinheiro</option>
                            <option value="Cartão de Crédito">Cartão de Crédito</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Boleto">Boleto</option>
                            <option value="Depósito">Depósito</option>
                            <option value="Débito">Débito</option>
                            <option value="Pix">Pix</option>
                        </select>
                    </div>
                </div>

            </div>

        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true">
                <span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
            <button class="button btn btn-danger" id="submitDespesa">
                <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">Adicionar Despesa</span></button>
        </div>
    </form>
</div>
 -->

<!-- Modal editar lançamento -->
<div id="modalEditar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="formEditar" action="<?php echo base_url() ?>index.php/financeiro/editar" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Editar Lanzamiento</h3>
        </div>
        <div class="modal-body">
            <div class="span12 alert alert-info" style="margin-left: 0"> Es obligatorio rellenar los campos con
                asterisco.
            </div>
            <div class="span12" style="margin-left: 0">
                <label for="descricao">Descripción/Referencia*</label>
                <input class="span12" id="descricaoEditar" type="text" name="descricao" required />
                <input id="urlAtualEditar" type="hidden" name="urlAtual" value="" />
            </div>
            <div class="span12" style="margin-left: 0">
                <div class="span12" style="margin-left: 0">
                    <label for="fornecedor">Cliente/Proveedor*</label>
                    <input class="span12" id="fornecedorEditar" type="text" name="fornecedor" required />
                </div>

                <div class="span12" style="margin-left: 0">
                    <label for="observacoes">Observaciones</label>
                    <textarea class="span12" id="observacoes_edit" name="observacoes"></textarea>
                </div>
            </div>
            <div class="span12" style="margin-left: 0">
                <div class="span4" style="margin-left: 0">
                    <label for="valor">Valor*</label>
                    <input type="hidden" id="idEditar" name="id" value="" />
                    <input class="span12 money" type="text" name="valor" id="valorEditar" value="<?php echo number_format("0.00", 2, ',', '.') ?>" required />
                </div>

        <div class="span4">  
	        <label for="descontos">Descuento</label>
	        <input class="span6 money" id="descontos_editar" type="text" name="descontos_editar" value="" placeholder="en $" style="float: left;" />
            <input class="btn btn-inverse" onclick="mostrarValoresEditar();" type="button" name="valor_desconto_editar" value="Aplicar" placeholder="$" style="width: 70px; margin-left:3px;" />
	      </div>

            <div class="span2">  
            <label for="valor_desconto">Val.Desc</label>
            <input class="span12 money" id="descontoEditar" name="valor_desconto_editar" type="text" value="<?php echo number_format("0.00", 2, ',', '.') ?>" />
            </div>

                <div class="span4" style="margin-left: 0">
                    <label for="vencimento">Fecha Vencimiento*</label>
                    <input class="span12 datepicker2" type="text" name="vencimento" id="vencimentoEditar" autocomplete="off" required />
                </div>
                <div class="span4">
                    <label for="vencimento">Tipo*</label>
                    <select class="span12" name="tipo" id="tipoEditar">
                        <option value="receita">Ingresos</option>
                        <option value="despesa">Gastos</option>
                    </select>
                </div>

            </div>
            <div class="span12" style="margin-left: 0">
                <div class="span4" style="margin-left: 0">
                    <label for="pago">Fue pagado?</label>
                    &nbsp &nbsp &nbsp &nbsp<input id="pagoEditar" type="checkbox" name="pago" value="1" />
                </div>
                <div id="divPagamentoEditar" class="span8" style=" display: none">
                    <div class="span6">
                        <label for="pagamento">Fecha de Pago</label>
                        <input class="span12 datepicker2" id="pagamentoEditar" type="text" name="pagamento" autocomplete="off"  />
                    </div>

                    <div class="span6">
                        <label for="formaPgto">Forma de Pago</label>
                        <select name="formaPgto" id="formaPgtoEditar" class="span12">
                            <option value="Cartão de Débito">Tarjeta de Débito</option> 
                            <option value="Transferência DOC">Transferencia DOC</option>
                            <option value="Dinheiro">Efectivo</option>
                            <option value="Cartão de Crédito">Tarjeta de Crédito</option>
                            <option value="Débito">Débito</option>
                            <option value="Boleto">Transferencia</option>
                            <option value="Depósito">Depósito</option>
                            <option value="Pix">MercadoPago</option>
                            <option value="Promissória">PayPal</option>
                            <option value="Transferência TED">Wise</option>
                            <option value="Cheque Pré-datado">Binance USDT</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                    </div>
                </div>

            </div>

        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
            <label for="documento" class="control-label">Modificado por: </label>
            <div class="controls span4">
                <input disabled id="usuarioEditar" value="" style="background-color: #f5f5f5; border-color: transparent; height: 10px">
            </div>
            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true" id="btnCancelarEditar" style="min-width: 110px">
                <span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
            <button class="button btn btn-primary" style="min-width: 110px">
                <span class="button__icon"><i class='bx bx-save'></i></span><span class="button__text2">Ahorrar</span></button>
        </div>
    </form>
</div>

<!-- Modal Excluir lançamento-->
<div id="modalExcluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Eliminar Publicación</h3>
    </div>
    <div class="modal-body">
        <h5 style="text-align: center">¿De verdad quieres eliminar esta publicación?</h5>
        <input name="id" id="idExcluir" type="hidden" value="" />
    </div>
    <div class="modal-footer" style="display:flex;justify-content:center;">
        <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true" id="btnCancelExcluir"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
        <button class="button btn btn-danger" id="btnExcluir"><span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Eliminar</span></button>
    </div>
</div>

<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/maskmoney.js"></script>
<script type="text/javascript">

    function mostrarValor() {
		if (document.getElementById('valor').value == "" || document.getElementById('desconto').value == ""){
			
		}else{
			
			var valor = parseFloat(document.getElementById('valor').value);
			var desconto = parseInt(document.getElementById('desconto').value); 
			var valor_desconto = parseFloat(document.getElementById('valor_desconto').value);
			var resultado, total;
			resultado = valor/100;
			total = valor-(desconto*resultado);
			
			resultdesc = total ;
			totaldesc = valor-(resultdesc);	
			
			document.getElementById('valor').value = total.toFixed(2);
			document.getElementById('valor_desconto').value = totaldesc.toFixed(2);
			}
	}
	
    function mostrarValores() {
		if (document.getElementById('valor').value == "" || document.getElementById('descontos').value == "" || document.getElementById('valor_desconto').value == ""){
			
		}else{
			var valor = parseFloat(document.getElementById('valor').value);
			var desconto = parseFloat(document.getElementById('descontos').value); 
			var valor_desconto = parseFloat(document.getElementById('valor_desconto').value);
			var resultado, total;
			resultado = valor;
			total = valor-desconto;
			
			resultdesc = total ;
			totaldesc = valor-(resultdesc);	
			
			document.getElementById('valor').value = total.toFixed(2);
			document.getElementById('valor_desconto').value = totaldesc.toFixed(2);
			}
	}

    function mostrarValoresEditar() {
		if (document.getElementById('valorEditar').value == "" || document.getElementById('descontos_editar').value == "" || document.getElementById('descontoEditar').value == ""){
			
		}else{
			var valor = parseFloat(document.getElementById('valorEditar').value);
			var desconto = parseFloat(document.getElementById('descontos_editar').value); 
			var valor_desconto = parseFloat(document.getElementById('descontoEditar').value);
			var resultado, total;
			resultado = valor;
			total = valor-desconto;
			
			resultdesc = total ;
			totaldesc = valor-(resultdesc);	
			
			document.getElementById('valorEditar').value = total.toFixed(2);
			document.getElementById('descontoEditar').value = totaldesc.toFixed(2);
			}
	}

    function mostrarValoresParc() {
		if (document.getElementById('valor_parc').value == "" || document.getElementById('descontos_parc').value == "" || document.getElementById('desconto_parc').value == ""){
			
		}else{
			var valor = parseFloat(document.getElementById('valor_parc').value);
			var desconto = parseFloat(document.getElementById('descontos_parc').value); 
			var valor_desconto = parseFloat(document.getElementById('desconto_parc').value);
			var resultado, total;
			resultado = valor;
			total = valor-desconto;
			
			resultdesc = total ;
			totaldesc = valor-(resultdesc);	
			
			document.getElementById('valor_parc').value = total.toFixed(2);
			document.getElementById('desconto_parc').value = totaldesc.toFixed(2);
			}
        }

    jQuery(document).ready(function($) {

        $(".money").maskMoney();

        $('#pago').click(function(event) {
            var flag = $(this).is(':checked');
            if (flag == true) {
                $('#divPagamento').show();
            } else {
                $('#divPagamento').hide();
            }
        });


        $('#recebido').click(function(event) {
            var flag = $(this).is(':checked');
            if (flag == true) {
                $('#divRecebimento').show();
            } else {
                $('#divRecebimento').hide();
            }
        });

        $('#pagoEditar').click(function(event) {
            var flag = $(this).is(':checked');
            if (flag == true) {
                $('#divPagamentoEditar').show();
            } else {
                $('#divPagamentoEditar').hide();
            }
        });


        $("#formReceita").validate({
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
                $("#submitReceita").attr("disabled", true);
                form.submit();
            }
        });


        $("#formDespesa").validate({
            rules: {
                descricao: {
                    required: true
                },
                fornecedor: {
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
                fornecedor: {
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
                $("#submitDespesa").attr("disabled", true);
                form.submit();
            }
        });


        $(document).on('click', '.excluir', function(event) {
            $("#idExcluir").val($(this).attr('idLancamento'));
        });


        $(document).on('click', '.editar', function(event) {
            $("#idEditar").val($(this).attr('idLancamento'));
            $("#descricaoEditar").val($(this).attr('descricao'));
            $("#usuarioEditar").val($(this).attr('usuario'));
            $("#fornecedorEditar").val($(this).attr('cliente'));
            $("#observacoes_edit").val($(this).attr('observacoes'));
            $("#valorEditar").val($(this).attr('valor'));
            $("#vencimentoEditar").val($(this).attr('vencimento'));
            $("#pagamentoEditar").val($(this).attr('pagamento'));
            $("#formaPgtoEditar").val($(this).attr('formaPgto'));
            $("#tipoEditar").val($(this).attr('tipo'));
            $("#descontos_editar").val($(this).attr('descontos_editar'));
            $("#descontoEditar").val($(this).attr('valor_desconto_editar'));
            $("#urlAtualEditar").val($(location).attr('href'));
            var baixado = $(this).attr('baixado');
            if (baixado == 1) {
                $("#pagoEditar").prop('checked', true);
                $("#divPagamentoEditar").show();
            } else {
                $("#pagoEditar").prop('checked', false);
                $("#divPagamentoEditar").hide();
            }


        });

        $(document).on('click', '#btnExcluir', function(event) {
            var id = $("#idExcluir").val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/financeiro/excluirLancamento",
                data: "id=" + id,
                dataType: 'json',
                success: function(data) {
                    if (data.result == true) {
                        $("#btnCancelExcluir").trigger('click');
                        $("#divLancamentos").html('<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>');
                        $("#divLancamentos").load($(location).attr('href') + " #divLancamentos");

                    } else {
                        $("#btnCancelExcluir").trigger('click');
                        Swal.fire({
                            type: "error",
                            title: "Atención",
                            text: "Ocorreu um erro ao tentar excluir lançamento."
                        });
                    }
                }
            });
            return false;
        });
        let controlBaixa = "<?php echo $configuration['control_baixa']; ?>";
        let datePickerOptions = {
            dateFormat: 'dd/mm/yy',
        };
        if (controlBaixa === '1') {
            datePickerOptions.minDate = 0;
            datePickerOptions.maxDate = 0;
        }
        $(".datepicker2").datepicker(
            datePickerOptions
        );
        $(".datepicker").datepicker();
        $('#periodo').on('change', function(event) {
            const period = $('#periodo').val();

            switch (period) {
                case 'dia':
                    $('#vencimento_de').val(dayjs().locale('pt-br').format('DD/MM/YYYY'));
                    $('#vencimento_ate').val(dayjs().locale('pt-br').format('DD/MM/YYYY'));
                    break;
                case 'semana':
                    $('#vencimento_de').val(dayjs().startOf('week').locale('pt-br').format('DD/MM/YYYY'));
                    $('#vencimento_ate').val(dayjs().endOf('week').locale('pt-br').format('DD/MM/YYYY'));
                    break;
                case 'mes':
                    $('#vencimento_de').val(dayjs().startOf('month').locale('pt-br').format('DD/MM/YYYY'));
                    $('#vencimento_ate').val(dayjs().endOf('month').locale('pt-br').format('DD/MM/YYYY'));
                    break;
                case 'ano':
                    $('#vencimento_de').val(dayjs().startOf('year').locale('pt-br').format('DD/MM/YYYY'));
                    $('#vencimento_ate').val(dayjs().endOf('year').locale('pt-br').format('DD/MM/YYYY'));
                    break;
            }
        });

        $("#fornecedorEditar").autocomplete({
            source: "<?php echo base_url(); ?>index.php/financeiro/autoCompleteClienteAddReceita",
            minLength: 1,
            select: function(event, ui) {
                $("#fornecedorEditar").val(ui.item.label);
            }
        });
    
        $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>index.php/financeiro/autoCompleteClienteAddReceita",
            minLength: 1,
            select: function(event, ui) {
                $("#cliente").val(ui.item.label);
                $("#idCliente").val(ui.item.id);
            }
        });

          $("#cliente_busca").autocomplete({
            source: "<?php echo base_url(); ?>index.php/financeiro/autoCompleteClienteAddReceita",
            minLength: 1,
            select: function(event, ui) {
                $("#cliente_busca").val(ui.item.label);
            }
        });

        $("#cliente_parc").autocomplete({
            source: "<?php echo base_url(); ?>index.php/financeiro/autoCompleteClienteAddReceita",
            minLength: 1,
            select: function(event, ui) {
                $("#cliente_parc").val(ui.item.label);
            }
        });

        $("#fornecedor").autocomplete({
            source: "<?php echo base_url(); ?>index.php/financeiro/autoCompleteClienteAddReceita",
            minLength: 1,
            select: function(event, ui) {
                $("#fornecedor").val(ui.item.label);
                $("#idFornecedor").val(ui.item.id);
            }
        });

        function valorParcelas(){
			var valor_parc = $("#valor_parc").val();
			var qtdparc = $("#qtdparcelas_parc").val();
			var entrada = $("#entrada").val();
			var result = (valor_parc - entrada) / qtdparc;
			
			if(qtdparc > 1){
				if(entrada > 0){
					$("#string_parc").text('R$ '+entrada+' de entrada mais '+qtdparc+' parcelas de $ '+parseFloat(Math.round(result * 100) / 100).toFixed(2));
				$("#valorparcelas").val(parseFloat(Math.round(result * 100) / 100).toFixed(2));
				}else{
					$("#string_parc").text(qtdparc+' parcelas de R$ '+parseFloat(Math.round(result * 100) / 100).toFixed(2));
				$("#valorparcelas").val(parseFloat(Math.round(result * 100) / 100).toFixed(2));
				}
			}else{
				if(entrada > 0){
					$("#string_parc").text('R$ '+entrada+' de entrada mais '+qtdparc+' parcela de $ '+parseFloat(Math.round(result * 100) / 100).toFixed(2));
				$("#valorparcelas").val(parseFloat(Math.round(result * 100) / 100).toFixed(2));
				}else{
					$("#string_parc").text(qtdparc+' parcela de $ '+parseFloat(Math.round(result * 100) / 100).toFixed(2));
				$("#valorparcelas").val(parseFloat(Math.round(result * 100) / 100).toFixed(2));
				}
			}
		}

		$('#qtdparcelas').change(function(event) {
			var parcelas = $("#qtdparcelas").val();
			if(parcelas > 1){
				$('#cancelar_nova_receita').trigger('click');
				$('#abrirmodalreceitaparcelada').trigger('click');
				$("#descricao_parc").val($("#descricao").val());
				$("#cliente_parc").val($("#cliente").val());
                $("#tipo_parc").val($("#tipo").val());
                $("#formaPgto_parc").val($("#formaPgto").val());
				$("#pcontas_parc").val($("#pcontas").val());
				$("#categoria_parc").val($("#categoria").val());
				$("#observacoes_parc").val($("#observacoes").val());
				$("#valor_parc").val($("#valor").val());
				$("#desconto_parc").val($("#valor_desconto").val());
				$("#qtdparcelas_parc").val($("#qtdparcelas").val());		
			valorParcelas();
			}
			else{
				if(parcelas == 1){
					$('#cancelar_nova_receita').trigger('click');
					$('#abrirmodalreceitaparcelada').trigger('click');
					$("#descricao_parc").val($("#descricao").val());
					$("#cliente_parc").val($("#cliente").val());
                    $("#tipo_parc").val($("#tipo").val());
                    $("#formaPgto_parc").val($("#formaPgto").val());
					$("#pcontas_parc").val($("#pcontas").val());
					$("#categoria_parc").val($("#categoria").val());
					$("#observacoes_parc").val($("#observacoes").val());
					$("#desconto_parc").val($("#valor_desconto").val());
					$("#valor_parc").val($("#valor").val());
					$("#qtdparcelas_parc").val(1);		
					valorParcelas();
				}
			}
		});
							
		$('#valor_parc').keypress(function(event) {
			valorParcelas();
		});

		$('#qtdparcelas_parc').change(function(event) {
			valorParcelas();
		});
		
		$('#entrada').keypress(function(event){
			valorParcelas();
			var entrada = $("#entrada").val();
			if(entrada > 0){
				$('#dia_pgto').css("color", "#444444");
			}else{
				$('#dia_pgto').css("color", "#eeeeee");
			}
		});
		
		$('#valor_parc, #qtdparcelas_parc, #formaPgto_parc, #entrada, #dia_pgto, #dia_base_pgto').click(function(event){
			valorParcelas();
		});
		
		$('#add_receita').mouseover(function(event){
			valorParcelas();
		});
		
		$('#entrada').keypress(function(event){
			valorParcelas();
			var entrada = $("#entrada").val();
			if(entrada > 0){
				$('#dia_pgto').css("color", "#444444");
			}else{
				$('#dia_pgto').css("color", "#eeeeee");
			}
		});
		$('#valor_parc, #qtdparcela_parc, #formaPgto_parc, #entrada, #dia_pgto, #dia_base_pgto').click(function(event){
			valorParcelas();
		});
		
		$('#add_receita').mouseover(function(event){
			valorParcelas();
		});
    });
</script>