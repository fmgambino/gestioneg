<div class="row-fluid" style="margin-top: 0">
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="fas fa-shopping-bag"></i>
                </span>
                <h5>Informes Rápidos</h5>
            </div>
            <div class="widget-content">
                <ul style="flex-direction: row;" class="site-stats">
                    <li><a target="_blank" href="<?php echo base_url() ?>index.php/relatorios/produtosRapid"><i class="fas fa-shopping-bag"></i> <small>Todos los Productos</small></a></li>
                    <li><a target="_blank" href="<?php echo base_url() ?>index.php/relatorios/produtosRapidMin"><i class="fas fa-shopping-bag"></i> <small>Con Stock Mínimo</small></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="span8">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="fas fa-shopping-bag"></i>
                </span>
                <h5>Informes Personalizables</h5>
            </div>
            <div class="widget-content">
                <div class="span12 well">
                    <div class="span12 alert alert-info">Déjalo en blanco si no quieres usar el parámetro.</div>
                    <form target="_blank" action="<?php echo base_url() ?>index.php/relatorios/produtosCustom" method="get">
                        <div class="span12 well">
                            <div class="span6">
                                <label for="">Precio de Venta desde:</label>
                                <input type="text" name="precoInicial" class="span12 money" />
                            </div>
                            <div class="span6">
                                <label for="">Hasta:</label>
                                <input type="text" name="precoFinal" class="span12 money" />
                            </div>
                        </div>
                        <div class="span12 well" style="margin-left: 0">
                            <div class="span6">
                                <label for="">Stock desde:</label>
                                <input type="text" name="estoqueInicial" class="span12" />
                            </div>
                            <div class="span6">
                                <label for="">Hasta:</label>
                                <input type="text" name="estoqueFinal" class="span12" />
                            </div>
                        </div>
                        <div class="span12" style="display:flex;justify-content: center">
                            <input type="reset" class="button btn btn-warning" value="Limpar" / style="justify-content: center">
                            <button class="button btn btn-inverse"><span class="button__icon"><i class="bx bx-printer"></i></span> <span class="button__text2">Imprimir</span></button>
                        </div>
                    </form>
                </div>
                .
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".money").maskMoney();
    });
</script>
