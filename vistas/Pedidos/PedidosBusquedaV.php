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

<div class="table-responsive">
    <table class="table table-stripped" id="tablaPedidos">
        <tr style="background-color: #2E353D;">
            <th>
                <center>Detalles</center>
            </th>
            <th>
                <center>ID Pedido</center>
            </th>
            <th>
                <center>Usuario</center>
            </th>
            <th>
                <center>Fecha Pedido</center>
            </th>
            <th>
                <center>Fecha Almacen</center>
            </th>
            <th>
                <center>Fecha Envio</center>
            </th>
            <th>
                <center>Fecha Recibido</center>
            </th>
            <th>
                <center>Fecha Finalizado</center>
            </th>
            <th>
                <center>Transporte</center>
            </th>
            <th>
                <center>Direccion</center>
            </th>
            <th>
                <center>Suma</center>
            </th>
            <th>
                <center>Conteo</center>
            </th>
        </tr>
        <?php
        foreach ($datos as $opcion) { ?>
            <tr>
                <td>
                    <button type="button" data-toggle="modal" data-target="#modalDetalles"
                            onclick="cargarDetallesPedido(<?php echo $opcion['id_Pedido'] ?>)">+
                    </button>
                </td>
                <td><?php echo $opcion['id_Pedido']; ?></td>
                <td><?php echo $opcion['apellido_1'] . ', ' . $opcion['nombre']; ?></td>
                <td><?php echo $opcion['fecha_Pedido']; ?></td>
                <td><?php echo $opcion['fecha_Almacen']; ?></td>
                <td><?php echo $opcion['fecha_Envio']; ?></td>
                <td><?php echo $opcion['fecha_Recibido']; ?></td>
                <td><?php echo $opcion['fecha_Finalizado']; ?></td>
                <td><?php echo $opcion['transporte']; ?></td>
                <td><?php echo $opcion['direccion']; ?></td>
                <td><?php echo $opcion['suma']; ?></td>
                <td><?php echo $opcion['conteo']; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>

<div class="modal fade bs-example-modal-lg" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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