<div class="new122">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

    <div class="span12" style="margin-left: 0">
    <div class="widget-title" style="margin: -20px 0 0">
                <span class="icon">
                    <i class="fas fa-hdd"></i>
                </span>
                <h5>Archivos</h5>
            </div>
        <form method="get" action="<?= current_url(); ?>">
            <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aArquivo')) : ?>
                <div class="span3">
                    <a href="<?= base_url(); ?>index.php/arquivos/adicionar" class="button btn btn-mini btn-success" style="max-width:150px">
                        <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">Nuevo Archivo</span></a>
                </div>
            <?php endif ?>

            <div class="span5">
                <input type="text" name="pesquisa" id="pesquisa" placeholder="Ingrese el nombre del documento para buscar" class="span12" value="<?= $this->input->get('pesquisa') ?>">
            </div>
            <div class="span3">
                <input type="text" name="data" id="data" placeholder="Fecha desde" class="span6 datepicker" value="<?= $this->input->get('data') ?>">
                <input type="text" name="data2" id="data2" placeholder="Fecha hasta" class="span6 datepicker" value="<?= $this->input->get('data2') ?>">
            </div>
            <div class="span1">
                <button class="button btn btn-mini btn-warning" style="min-width: 30px"><span class="button__icon"><i class='bx bx-search-alt'></i></span></button>
            </div>
        </form>
    </div>

    <div>
        <div class="widget-box">
            <div class="widget-content nopadding tab-content">
                <table id="tabela" width="100%" class="table table-bordered ">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="10%">Miniatura</th>
                            <th width="10%">Nombre</th>
                            <th width="8%">Fecha</th>
                            <th>Descripción</th>
                            <th width="8%">Tamaño</th>
                            <th width="5%">Extensión</th>
                            <th width="14%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if (!$results) {
                            echo '<tr>
                                <td colspan="8">No se econtraron ficheros.</td>
                            </tr>';
                        }
                        foreach ($results as $r) : ?>
                            <tr>
                                <td><?= $r->idDocumentos ?></td>
                                <td>
                                    <?php if (@getimagesize($r->path)) : ?>
                                        <a href="<?= $r->url ?>"> <img src="<?= $r->url ?> "></a>
                                    <?php else : ?>
                                        <span>-</span>
                                    <?php endif ?>
                                </td>
                                <td><?= $r->documento ?></td>
                                <td><?= date('d/m/Y', strtotime($r->cadastro)) ?></td>
                                <td><?= $r->descricao ?></td>
                                <td><?= $r->tamanho ?> KB</td>
                                <td><?= $r->tipo ?></td>
                                <td><?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vArquivo')) : ?>
                                        <a href="<?= base_url() ?>index.php/arquivos/download/<?= $r->idDocumentos; ?>" class="btn-nwe" title="Bajar Archivo"><i class="bx bx-download"></i>
                                        <?php endif ?>

                                        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eArquivo')) : ?>
                                            <a href="<?= base_url() ?>index.php/arquivos/editar/<?= $r->idDocumentos ?>" class="btn-nwe3" title="Editar"><i class="bx bx-edit"></i></a>
                                        <?php endif ?>

                                        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dArquivo')) : ?>
                                            <a href="#modal-excluir" style="margin-right: 1%" role="button" data-toggle="modal" arquivo="<?= $r->idDocumentos ?>" class="btn-nwe4" title="Eliminar"><i class="bx bx-trash-alt"></i></a>
                                        </a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?= $this->pagination->create_links() ?>

    <div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="<?= base_url() ?>index.php/arquivos/excluir" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 id="myModalLabel">Eliminar archivo</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idDocumento" name="id" value="" />
                <h5 style="text-align: center">Desea realmente eliminar este archivo?</h5>
            </div>
            <div class="modal-footer" style="display:flex;justify-content: center">
                <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true">
                    <span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                <button class="button btn btn-danger"><span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Eliminar</span></button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', 'a', function(event) {
            var arquivo = $(this).attr('arquivo');
            $('#idDocumento').val(arquivo);
        });
        $(".datepicker").datepicker({
            dateFormat: 'dd/mm/yy'
        });
    });
</script>