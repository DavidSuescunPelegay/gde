<div class="page-header">
    <h1>Gestion de Productos</h1>
</div>

<div class="table-responsive">
    <table class="table table-stripped" id="tablaDetallesPedidos">
        <tr style="background-color: #2E353D;">
            <th>Producto</th>
            <th>Descripcion</th>
            <th>ID Categoria</th>
            <th>Stock</th>
            <th>Precio Compra</th>
            <th>Precio Venta</th>
            <th>Cantidad Vendida</th>
            <th>Cantidad Minima</th>
        </tr>
        <?php
        foreach ($datos as $opcion) { ?>
            <tr>
                <td><?php echo $opcion['producto']; ?></td>
                <td><?php echo $opcion['descripcion']; ?></td>
                <td><?php echo $opcion['id_Categoria']; ?></td>
                <td><?php echo $opcion['stock']; ?></td>
                <td><?php echo $opcion['precio_Compra']; ?></td>
                <td><?php echo $opcion['precio_Venta']; ?></td>
                <td><?php echo $opcion['cantidad_Vendida']; ?></td>
                <td><?php echo $opcion['cantidad_Minima']; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
