<?php

if (!$results) { ?>
    <div class="widget-box">
        <div class="widget-title" style="margin: -20px 0 0">
            <span class="icon">
                <i class="fas fa-tags"></i>
            </span>
            <h5>Compras</h5>

        </div>

        <div class="widget-content nopadding tab-content">


            <table id="tabela" class="table table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha de Compra</th>
                        <th>Responsable</th>
                        <th>Faturado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td colspan="6">No se registró compra</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php
} else { ?>


    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="fas fa-shopping-cart"></i>
            </span>
            <h5>Compras</h5>

        </div>

        <div class="widget-content nopadding tab-content">


            <table id="tabela" class="table table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha de Compra</th>
                        <th>Responsable</th>
                        <th>Faturado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $r) {
                        $dataVenda = date(('d/m/Y'), strtotime($r->dataVenda));
                        if ($r->Faturado == 1) {
                            $Faturado = 'Si';
                        } else {
                            $Faturado = 'No';
                        }
                        echo '<tr>';
                        echo '<td>' . $r->idVendas . '</td>';
                        echo '<td>' . $dataVenda . '</td>';
                        echo '<td>' . $r->nome . '</td>';
                        echo '<td>' . $Faturado . '</td>';

                        echo '<td><a href="' . base_url() . 'index.php/mine/visualizarCompra/' . $r->idVendas . '" class="btn-nwe" title="Ver más detalles"><i class="bx bx-show"></i></a>
                      <a href="' . base_url() . 'index.php/mine/imprimirCompra/' . $r->idVendas . '" class="btn-nwe6" title="Imprimir"><i class="bx bx-printer"></i></a>

                  </td>';
                        echo '</tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

<?php echo $this->pagination->create_links();
} ?>
