<?php
$html = '<table border="1" class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="tablaMenus">';
$html .= '<tr>';
$html .= '<th>ID</th>';
$html .= '<th>Nombre</th>';
$html .= '<th>URL</th>';
$html .= '<th>ID Padre</th>';
$html .= '<th>Orden</th>';
$html .= '<th>Operaciones Disponibles</th>';
$html .= '</tr>';

foreach ($datos as $ind => $opcion) {
    $html .= '<tr>';
    $html .= '<td id="id' . $opcion['id_Opcion'] . '">' . $opcion['id_Opcion'] . '</td>';
    $html .= '<td id="texto' . $opcion['id_Opcion'] . '">' . $opcion['texto'] . '</td>';
    $html .= '<td id="url' . $opcion['id_Opcion'] . '">' . $opcion['url'] . '</td>';
    $html .= '<td id="padre' . $opcion['id_Opcion'] . '">' . $opcion['id_Padre'] . '</td>';
    $html .= '<td id="orden' . $opcion['id_Opcion'] . '">' . $opcion['orden'] . '</td>';
    $html .= '<td><button type="button" id="botonEdicion' . $opcion['id_Opcion'] . '" onclick="editarMenu(' . $opcion['id_Opcion'] . ')">Editar</button>';
    $html .= '<button type="button" id="botonEliminar' . $opcion['id_Opcion'] . '" onclick="eliminarMenu(' . $opcion['id_Opcion'] . ')">Eliminar</button></td>';
    $html .= '</tr>';

    if (isset($opcion['subOpciones'])) {
        foreach ($opcion['subOpciones'] as $subind => $subOpcion) {
            $html .= '<tr>';
            $html .= '<td id="id' . $subOpcion['id_Opcion'] . '">' . $subOpcion['id_Opcion'] . '</td>';
            $html .= '<td id="texto' . $subOpcion['id_Opcion'] . '">' . $subOpcion['texto'] . '</td>';
            $html .= '<td id="url' . $subOpcion['id_Opcion'] . '">' . $subOpcion['url'] . '</td>';
            $html .= '<td id="padre' . $subOpcion['id_Opcion'] . '">' . $subOpcion['id_Padre'] . '</td>';
            $html .= '<td id="orden' . $subOpcion['id_Opcion'] . '">' . $subOpcion['orden'] . '</td>';
            $html .= '<td><button type="button" id="botonEdicion' . $subOpcion['id_Opcion'] . '" onclick="editarMenu(' . $subOpcion['id_Opcion'] . ')">Editar</button>';
            $html .= '<button type="button" id="botonEliminar' . $subOpcion['id_Opcion'] . '" onclick="eliminarMenu(' . $subOpcion['id_Opcion'] . ')">Eliminar</button></td>';
            $html .= '</tr>';
        }
    }
}

$html .= '</table>';
echo $html;
?>

<br><br>
<button type="button" id="botonNuevo" onclick="mostrarMenuInsertar()">Nuevo Menu</button>
<br><br>

<div id="div-nuevo" style="display:none; border: 1px #000 solid; padding: 1%">
    <div class="row">
        <div class="col-lg-12">
            <b><span id="operacion">INSERTAR</span> MENU</b>
        </div>
    </div>
    <br>
    <form role="form" id="insertarMenu" name="insertarMenu">
        <div class="row">
            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <input type="hidden" id="id_OpcionInsertar" name="id_OpcionInsertar"/>
                <label for="texto">Texto:</label>
                <input type="text" id="textoInsertar" name="textoInsertar" class="form-control" placeholder="Texto"/>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="url">URL:</label>
                <input type="text" id="urlInsertar" name="urlInsertar" class="form-control" placeholder="URL"/>
            </div>

            <!--Funcion PHP que carga los ID Padre que existen en la Base de Datos-->
            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="id_Padre">ID Padre</label>
                <br>
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

                $html .= '<select id="valoresIdPadreInsertar" name="valoresIdPadreInsertar">';
                $html .= '<option value="0">0 (no depende de ningun menu)</option>';
                while ($fila = mysqli_fetch_array($resultado)) {
                    $html .= '<option value="padre'.$fila['id_Opcion'].'">'.$fila['id_Opcion'].' (dependera del menu '.$fila['texto'].')</option>';
                }
                $html .= '</select>';
                mysqli_close($conexion);

                echo $html;
                ?>
            </div>

            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="orden">Orden</label>
                <input type="text" id="ordenInsertar" name="ordenInsertar" class="form-control" placeholder="Orden"/>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-1 col-md-1 col-sm-2 col-xs-12">
                <button type="button" onclick="insertMenu()">Insertar</button>
            </div>
            <div class="form-group col-lg-1 col-md-1 col-sm-2 col-xs-12">
                <button type="button" onclick="ocultarOpcionesInsertar()">Cerrar</button>
            </div>
        </div>
    </form>
</div>

<div id="div-edicion" style="display:none; border: 1px #000 solid; padding: 1%">
    <div class="row">
        <div class="col-lg-12">
            <b><span id="operacion">MODIFICAR</span> MENU</b>
        </div>
    </div>
    <br>
    <form role="form" id="modificarMenu" name="modificarMenu">
        <div class="row">
            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <input type="hidden" id="id_OpcionModificar" name="id_OpcionModificar"/>
                <label for="texto">Texto:</label>
                <input type="text" id="textoModificar" name="textoModificar" class="form-control" placeholder="Texto"/>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="url">URL:</label>
                <input type="text" id="urlModificar" name="urlModificar" class="form-control" placeholder="URL"/>
            </div>

            <!--Funcion PHP que carga los ID Padre que existen en la Base de Datos-->
            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="id_Padre">ID Padre</label>
                <br>
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

                $html .= '<select id="valoresIdPadreModificar" name="valoresIdPadreModificar">';
                $html .= '<option value="0">0 (no depende de ningun menu)</option>';
                while ($fila = mysqli_fetch_array($resultado)) {
                    $html .= '<option value="padre'.$fila['id_Opcion'].'">'.$fila['id_Opcion'].' (dependera del menu '.$fila['texto'].')</option>';
                }
                $html .= '</select>';
                mysqli_close($conexion);

                echo $html;
                ?>
            </div>

            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="orden">Orden</label>
                <input type="text" id="ordenModificar" name="ordenModificar" class="form-control" placeholder="Orden"/>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-1 col-md-1 col-sm-2 col-xs-12">
                <button type="button" onclick="updateMenu()">Guardar</button>
            </div>
            <div class="form-group col-lg-1 col-md-1 col-sm-2 col-xs-12">
                <button type="button" onclick="ocultarOpcionesModificar()">Cerrar</button>
            </div>
        </div>
    </form>
</div>