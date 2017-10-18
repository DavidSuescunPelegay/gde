<div class="alert alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php
    $contador = count($datos);
    if ($contador == 1) {
        ?>
        La consulta ha devuelto <strong><?php echo count($datos) ?></strong> registro.
        <?php
    } else { ?>
        La consulta ha devuelto <strong><?php echo count($datos) ?></strong> registros.
        <?php
    }
    ?>
</div>

<br>
<button type="button" onclick="exportarAWord()" class="btn btn-default" style="background-color: #2C5898 !important; border: 1px #2C5898 solid !important;">
    <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
    Exportar a Word
</button>
<button type="button" onclick="exportarAExcel()" class="btn btn-default" style="background-color: #02723B !important; border: 1px #02723B solid !important;">
    <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
    Exportar a Excel
</button>
<button type="button" onclick="exportarAExcelPHP()" class="btn btn-default" style="background-color: #02723B !important; border: 1px #02723B solid !important;">
    <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
    Exportar a Excel (PHP)
</button>
<button type="button" onclick="exportarAPDF()" class="btn btn-default" style="background-color: #CF3B31 !important; border: 1px #CF3B31 solid !important;">
    <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
    Exportar a PDF
</button>
<br>
<br>

<form id="busquedaPedidos">
    <div class="table-responsive">
        <table class="table table-stripped" id="tablaPedidos">
            <tr style="background-color: #2E353D;">
                <th>
                    <p style="text-align: center">Detalles</p>
                </th>
                <th>
                    <p style="text-align: center">ID Pedido</p>
                </th>
                <th>
                    <p style="text-align: center">Nº Elementos</p>
                </th>
                <th>
                    <p style="text-align: center">Usuario</p>
                </th>
                <th>
                    <p style="text-align: center">Fecha Pedido</p>
                </th>
                <th>
                    <p style="text-align: center">Fecha Almacen</p>
                </th>
                <th>
                    <p style="text-align: center">Fecha Envio</p>
                </th>
                <th>
                    <p style="text-align: center">Fecha Recibido</p>
                </th>
                <th>
                    <p style="text-align: center">Fecha Finalizado</p>
                </th>
                <th>
                    <p style="text-align: center">Transporte</p>
                </th>
                <th>
                    <p style="text-align: center">Direccion</p>
                </th>
                <th>
                    <p style="text-align: center">Suma</p>
                </th>
            </tr>
            <?php
            foreach ($datos as $opcion) { ?>
                <tr class="filaTabla">
                    <td>
                        <p style="text-align: center">
                            <button type="button" data-toggle="modal" data-target="#modalDetalles"
                                    onclick="cargarDetallesPedido(<?php echo $opcion['id_Pedido'] ?>)">+
                            </button>
                        </p>
                    </td>
                    <td>
                        <p style="text-align: center">
                            <?php echo $opcion['id_Pedido']; ?>
                        </p>
                    </td>
                    <td>
                        <p style="text-align: center">
                            <?php echo $opcion['conteo']; ?>
                        </p>
                    </td>
                    <td>
                        <p style="text-align: center">
                            <?php echo $opcion['apellido_1'] . ', ' . $opcion['nombre']; ?>
                        </p>
                    </td>
                    <td>
                        <p style="text-align: center">
                            <?php echo $opcion['fecha_Pedido']; ?>
                        </p>
                    </td>
                    <td>
                        <p style="text-align: center">
                            <?php echo $opcion['fecha_Almacen']; ?>
                        </p>
                    </td>
                    <td>
                        <p style="text-align: center">
                            <?php echo $opcion['fecha_Envio']; ?>
                        </p>
                    </td>
                    <td>
                        <p style="text-align: center">
                            <?php echo $opcion['fecha_Recibido']; ?>
                        </p>
                    </td>
                    <td>
                        <p style="text-align: center">
                            <?php echo $opcion['fecha_Finalizado']; ?>
                        </p>
                    </td>
                    <td>
                        <p style="text-align: center">
                            <?php echo $opcion['transporte']; ?>
                        </p>
                    </td>
                    <td>
                        <p style="text-align: center">
                            <?php echo $opcion['direccion']; ?>
                        </p>
                    </td>
                    <td>
                        <p style="text-align: center">
                            <?php echo $opcion['suma']; ?> €
                        </p>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</form>

<div class="modal fade bs-example-modal-lg" id="modalDetalles" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Detalles del Pedido</h4>
            </div>
            <div class="modal-body">
                <div id="modalDetallesPedido"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
