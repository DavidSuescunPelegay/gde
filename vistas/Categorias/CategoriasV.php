<div class="page-header">
    <h1>Gestion de Categorias</h1>
</div>

<div class="table-responsive">
    <table class="table table-stripped" id="tablaDetallesPedidos">
        <tr style="background-color: #2E353D;">
            <th>Categoria</th>
            <th>Descripcion</th>
        </tr>
        <?php
        foreach ($datos as $opcion) { ?>
            <tr>
                <td><?php echo $opcion['categoria']; ?></td>
                <td><?php echo $opcion['descripcion']; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
