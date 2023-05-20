<style>
  select {
    width: 70px;
  }
</style>
<div class="new122" style="margin-top: 0; min-height: 100vh">
<div class="widget-title" style="margin: -20px 0 0">
        <span class="icon">
            <i class="fas fa-clock"></i>
        </span>
        <h5>Registros</h5>
</div>
  <a href="#modal-excluir" role="button" data-toggle="modal" class="button btn btn-danger tip-top" style="max-width: 250px" title="Eliminar Registro">
  <span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Eliminar registros: 30 días o más</span></a>

<div class="widget-box">
    <h5 style="padding: 3px 0"></h5>
    <div class="widget-content nopadding tab-content">
        <table id="tabela" class="table table-bordered ">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>IP</th>
                    <th>Tarea</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $r) {
                    echo '<tr>';
                    echo '<td>' . $r->usuario . '</td>';
                    echo '<td>' . date('d/m/Y', strtotime($r->data)) . '</td>';
                    echo '<td>' . $r->hora . '</td>';
                    echo '<td>' . $r->ip . '</td>';
                    echo '<td>' . $r->tarefa . '</td>';
                    echo '</tr>';
                } ?>
                <?php if (!$results) { ?>
                    <tr>
                        <td colspan="5">Ningún registro encontrado.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php echo $this->pagination->create_links(); ?>

<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo site_url('auditoria/clean') ?>" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5>Limpieza de Resgistros</h5>
        </div>
        <div class="modal-body">
            <h5 style="text-align: center">Realmente desea eliminar los registros más antiguos?</h5>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <button class="btn btn-danger">Eliminar</button>
        </div>
    </form>
</div>
</div>
