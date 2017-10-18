<div class="page-header">
    <h1>Administracion</h1>
</div>

<?php
for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
    if ($_SESSION['permisos'][$i]['id_Permiso'] == 11) {
        ?>
        <h4>
            <b>Filtro a aplicar:</b> Filtrar
            <select id="productosFiltrado" onchange="cambiarProductos()">
                <option value="null">

                </option>
                <option value="Permisos">
                    Permisos
                </option>
                <option value="Roles">
                    Roles
                </option>
            </select>
            del
            <select id="parametrosFiltrado" onchange="cambiarParametros()">
                <option value="null">

                </option>
                <option value="Usuario">
                    Usuario
                </option>
                <option value="Rol">
                    Rol
                </option>
            </select>
            <span id="textoUsuario" style="display: none">Usuario</span>
            , llamado
            <span id="au_id_BusquedaPorUsuario" name="au_id_BusquedaPorUsuario" onclick="activarBotonBuscar();"
                  style="display:none;"></span>

            <select id="selectorRol" style="display: none;">
                <option id="0"></option>
                <?php
                for ($i = 0; $i < count($datos); $i++) {
                    ?>
                    <option id="<?php echo $datos[$i]['id_Rol'] ?>"><?php echo $datos[$i]['rol'] ?></option>
                    <?php
                }
                ?>
            </select>

            <button type="button" class="btn btn-default" id="botonBuscarFiltros" onclick="buscar()"
                    style="display: none;">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </button>
        </h4>
        <?php
    }
}
?>

<div class="panel-group" id="acordeonResultado" role="tablist" aria-multiselectable="true" style="display: none;">
    <div class="panel panel-default">
        <div class="panel-heading itemsPanel" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                   aria-expanded="true" aria-controls="collapseOne">
                    <h4 id="textoAyuda"></h4>
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <div id="resultadoFiltrado"></div>
            </div>
        </div>
    </div>
</div>