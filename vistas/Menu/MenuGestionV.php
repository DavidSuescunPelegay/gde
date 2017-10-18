<?php
$html = '<table border="1" class="col-lg-12">';
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
    $html .= '<td>' . $opcion['id_Opcion'] . '</td>';
    $html .= '<td>' . $opcion['texto'] . '</td>';
    $html .= '<td>' . $opcion['url'] . '</td>';
    $html .= '<td>' . $opcion['id_Padre'] . '</td>';
    $html .= '<td>' . $opcion['orden'] . '</td>';
    $html .= '<td><button type="button" id="botonEdicion' . $opcion['id_Opcion'] . '" onclick="editarMenu();">Editar</button></td>';
    $html .= '</tr>';

    if (isset($opcion['subOpciones'])) {
        foreach ($opcion['subOpciones'] as $subind => $subOpcion) {
            $html .= '<tr>';
            $html .= '<td>' . $subOpcion['id_Opcion'] . '</td>';
            $html .= '<td>' . $subOpcion['texto'] . '</td>';
            $html .= '<td>' . $subOpcion['url'] . '</td>';
            $html .= '<td>' . $subOpcion['id_Padre'] . '</td>';
            $html .= '<td>' . $subOpcion['orden'] . '</td>';
            $html .= '<td><button type="button" id="botonEdicion' . $subOpcion['id_Opcion'] . '" onclick="editarMenu();">Editar</button></td>';
            $html .= '</tr>';
        }
    }
}

$html .= '</table>';
echo $html;
?>

<div id="div-edicion" style="display:none;">
    <div class="row">
        <div class="col-lg-12">
            <b><span id="operacion">MODIFICAR</span> MENU</b>
        </div>
    </div>
    <form role="form" id="modificarMenu" name="modificarMenu">
        <div class="row">
            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <input type="hidden" id="id_Opcion" name="id_Opcion" />
                <label for="texto" >Texto:</label>
                <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto" />
            </div>
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="url" >URL:</label>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <label for="id_Padre" >ID Padre</label>
                <input type="text" id="id_Padre" name="id_Padre" class="form-control" placeholder="ID Padre" />
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <label for="orden" >Orden</label>
                <input type="text" id="orden" name="orden" class="form-control" placeholder="Orden" />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <label for="nombre" >Login:</label>
                <input type="text" id="login" name="login" class="form-control" placeholder="Login usuario" />
            </div>
            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <label for="pass" >Contrase&ntilde;a:</label>
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Contrase�a" />
            </div>
            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <label for="repass" >Repetir Contrase�a:</label>
                <input type="password" id="repass" name="repass" class="form-control" placeholder="Repetir contrase�a" />
            </div>
            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <label for="activo" >Activo:</label>
                <select id="activo" name="activo" class="form-control">
                    <option value="S">Activo</option>
                    <option value="N">Inactivo</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-1 col-md-1 col-sm-2 col-xs-12">
                <button type="button" onclick="guardar();">Guardar</button>
            </div>
        </div>
    </form>
</div>
