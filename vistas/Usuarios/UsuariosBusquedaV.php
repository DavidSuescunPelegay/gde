<?php
$html = '';
$html .= '<div class="table-responsive">';
$html .= '<table class="table table-striped">';
$html .= '<tr style="background-color: #888888;">';
$html .= '<th>Nombre</th>';
$html .= '<th>Login</th>';
$html .= '<th>Operaciones disponibles</th>';
$html .= '<th>Activo</th>';
$html .= '<th></th>';
$html .= '</tr>';
foreach ($datos as $fila) {
    $html .= '<tr style="background-color: #bbbbbb">';
    $html .= '<td>' . $fila['apellido_1'] . ' ' . $fila['apellido_2'] . ', ' . $fila['nombre'] . '</td>';
    $html .= '<td>' . $fila['login'] . '</td>';
    $html .= '<td>';
    for ($i=0;$i<count($_SESSION['permisos']);$i++){
        if ($_SESSION['permisos'][$i]['id_Permiso']==3){
            $html .= '<button type="button" class="btn btn-warning" onclick="nuevoEditar(' . $fila['id_Usuario'] . ')" data-toggle="modal" data-target="#modalNuevoEditarUsuario"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
        }
    }
    $html .= '</td>';
    $html .= '<td>';
    if ($fila['activo'] != 'S') {
        $html .= '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
    } else {
        $html .= '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
    }
    $html .= '</td>';
    $html .= '<td>';
    if ($fila['activo'] != 'S') {
        $html .= '<button type="button" class="btn btn-success" title="Activar" onclick="activar(\'S\', ' . $fila['id_Usuario'] . ')"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button>';
    } else {
        $html .= '<button type="button" class="btn btn-danger" title="Desactivar" onclick="activar(\'N\', ' . $fila['id_Usuario'] . ')"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></button>';
    }
    $html .= '</td>';
    $html .= '</tr>';
}
$html .= '</table>';
$html .= '</div>';

echo $html;
?>
