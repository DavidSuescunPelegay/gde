<?php
$html = '<div class="table-responsive">';
$html .= '<table class="table table-stripped" id="tablaPermisos">';
$html .= '<tr style="background-color: #888888;">';
$html .= '<th>ID Permiso</th>';
$html .= '<th>ID Menu</th>';
$html .= '<th>Numero de Permiso</th>';
$html .= '<th>Nombre de Permiso</th>';
$html .= '<th>Operaciones disponibles</th>';
$html .= '</tr>';
foreach ($datos as $ind => $opcion) {
    $html .= '<tr style="background-color: #bbbbbb">';
    $html .= '<td id="permiso' . $datos[$ind]['id_Permiso'] . '">' . $datos[$ind]['id_Permiso'] . '</td>';
    $html .= '<td id="opcion' . $datos[$ind]['id_Permiso'] . '">' . $datos[$ind]['id_Opcion'] . '</td>';
    $html .= '<td id="ordenPermiso' . $datos[$ind]['id_Permiso'] . '">' . $datos[$ind]['num_Permiso'] . '</td>';
    $html .= '<td id="textoPermiso' . $datos[$ind]['id_Permiso'] . '">' . $datos[$ind]['permiso'] . '</td>';
    $html .= '<td>';
    if ($datos[$ind]['num_Permiso'] < 5) {//Desactivo el boton editar si el numero de permiso es 1, 2, 3 o 4
        $html .= '<button type="button" class="btn btn-warning disabled" title="Las funciones de edicion estan desactivadas para los numero de permiso 1-4" id="botonEdicion' . $datos[$ind]['id_Permiso'] . '" onclick="edicionProhibida()">Editar</button>';
    } else {
        $html .= '<button type="button" class="btn btn-warning" id="botonEdicion' . $datos[$ind]['id_Permiso'] . '" onclick="editPermiso(' . $datos[$ind]['id_Permiso'] . ', ' . $datos[$ind]['id_Opcion'] . ')">Editar</button>';
    }
    $html .= '&nbsp &nbsp';
    if ($datos[$ind]['num_Permiso'] < 5) {//Desactivo el boton eliminar si el numero de permiso es 1, 2, 3 o 4
        $html .= '<button type="button" class="btn btn-danger disabled" title="Las funciones de eliminacion estan desactivadas para los numero de permiso 1-4" id="botonEliminacion' . $datos[$ind]['id_Permiso'] . '" onclick="eliminacionProhibida()">Eiminar</button>';
    } else {
        $html .= '<button type="button" class="btn btn-danger" id="botonEliminacion' . $datos[$ind]['id_Permiso'] . '" onclick="deletePermiso(' . $datos[$ind]['id_Permiso'] . ')">Eiminar</button>';
    }
    $html .= '</td>';
    $html .= '</tr>';
}
$html .= '</table>';
$html .= '</div>';

echo $html;
?>

<br><br>
<button type="button" id="botonNuevo" class="btn btn-info" onclick="mostrarFormularioInsertar()">Nuevo Permiso</button>
<br><br>

<div id="divNuevoPermiso" style="display: none; border: 1px #000 solid; padding: 1%">
    <div class="row">
        <div class="col-lg-12">
            <b><span id="operacion">INSERTAR</span> PERMISO</b>
        </div>
    </div>
    <br>
    <form role="form" id="insertarPermiso" name="insertarPermiso">
        <div class="row">
            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <input type="hidden" id="idOpcionInsertar" name="idOpcionInsertar"/>
                <label for="idMenu">Menu que depende:</label>
                <?php
                $html = '';
                $conexion = mysqli_init();
                if (!$conexion) {
                    die("mysqli_init failed");
                }

                if (!mysqli_real_connect($conexion, "127.0.0.1", "root", "", "gde")) {
                    die("Connect Error: " . mysqli_connect_error());
                }

                $sql = 'SELECT id_Opcion, texto FROM menus ORDER BY id_Opcion ASC';

                $resultado = mysqli_query($conexion, $sql);

                $html .= '<select id="valoresIdMenuDependeInsertar" name="valoresIdMenuInsertar">';
                while ($fila = mysqli_fetch_array($resultado)) {
                    $html .= '<option value="' . $fila['id_Opcion'] . '">' . $fila['id_Opcion'] . ' (dependera del menu ' . $fila['texto'] . ')</option>';
                }
                $html .= '</select>';
                mysqli_close($conexion);

                echo $html;
                ?>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="numPermisoInsertar">Numero de Permiso (reservadas del 1 al 4)</label>
                <input type="number" id="numPermisoInsertar" min="5" placeholder="Numero de Permiso">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="textoPermisoInsertar">Texto descriptivo del Permiso</label>
                <input type="text" id="textoPermisoInsertar" placeholder="Texto del Permiso">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-1 col-md-1 col-sm-2 col-xs-12">
                <button type="button" onclick="insertPermiso()">Insertar</button>
            </div>
            <div class="form-group col-lg-1 col-md-1 col-sm-2 col-xs-12">
                <button type="button" onclick="ocultarFormularioInsertar()">Cerrar</button>
            </div>
        </div>
    </form>
</div>

<div id="divModificarPermiso" style="display: none; border: 1px #000 solid; padding: 1%">
    <div class="row">
        <div class="col-lg-12">
            <b><span id="operacion">MODIFICAR</span> PERMISO</b>
        </div>
    </div>
    <br>
    <form role="form" id="modificarPermiso" name="modificarPermiso">
        <div class="row">
            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <input type="hidden" id="idPermisoModificar" name="idPermisoModificar"/>
                <label for="idMenu">Menu que depende:</label>
                <?php
                $html = '';
                $conexion = mysqli_init();
                if (!$conexion) {
                    die("mysqli_init failed");
                }

                if (!mysqli_real_connect($conexion, "127.0.0.1", "root", "", "gde")) {
                    die("Connect Error: " . mysqli_connect_error());
                }

                $sql = 'SELECT id_Opcion, texto FROM menus ORDER BY id_Opcion ASC';

                $resultado = mysqli_query($conexion, $sql);

                $html .= '<select id="valoresIdMenuDependeModificar" name="valoresIdMenuDependeModificar">';
                while ($fila = mysqli_fetch_array($resultado)) {
                    $html .= '<option value="' . $fila['id_Opcion'] . '">' . $fila['id_Opcion'] . ' (dependera del menu ' . $fila['texto'] . ')</option>';
                }
                $html .= '</select>';
                mysqli_close($conexion);

                echo $html;
                ?>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="numPermisoModificar">Numero de Permiso (reservadas del 1 al 4)</label>
                <input type="number" id="numPermisoModificar" min="5" placeholder="Numero de Permiso">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="textoPermisoModificar">Texto descriptivo del Permiso</label>
                <input type="text" id="textoPermisoModificar" placeholder="Texto del Permiso">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-1 col-md-1 col-sm-2 col-xs-12">
                <button type="button" onclick="updatePermiso()">Guardar</button>
            </div>
            <div class="form-group col-lg-1 col-md-1 col-sm-2 col-xs-12">
                <button type="button" onclick="ocultarFormularioModificar()">Cerrar</button>
            </div>
        </div>
    </form>
</div>