<?php
$cantidad=count($datos);
$precioTotal='';
?>

<div class="table-responsive">
    <table class="table table-stripped" id="tablaDetallesPedidos">
        <tr style="background-color: #2E353D;">
            <th>ID Pedido</th>
            <th>ID Producto</th>
            <th>Cantidad</th>
            <th>Precio Venta</th>
        </tr>
        <?php
        foreach ($datos as $opcion) { ?>
            <tr>
                <td><?php echo $opcion['id_Pedido']; ?></td>
                <td><?php echo $opcion['id_Producto']; ?></td>
                <td><?php echo $opcion['cantidad']; ?></td>
                <td><?php echo $opcion['precio_Venta']; ?></td>
            </tr>
            <?php
            $precioTotal += $opcion['precio_Venta'];
        }
        ?>
    </table>
</div>

<div class="alert alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    El pedido <?php echo $datos[0]['id_Pedido']?> contiene <?php echo $cantidad ?> elementos, por un valor total de <?php echo $precioTotal?> euros.
</div>