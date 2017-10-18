<?php
$html = '';
$html .= '<div id="permisosSeleccionados">';
foreach ($datos[0] as $opcion) {
    if ($opcion['id_Opcion'] % 2 == 0) {
        $html .= '<div style="background-color: #eaeaea">';
        if (isset($datos[1][$opcion['id_Permiso']])) {
            $html .= '<input type="checkbox" id="permiso' . $opcion['id_Permiso'] . '" onclick="modificarPermiso(' . $opcion['id_Permiso'] . ');" checked> ';
            $html .= $opcion['permiso'] . '<br>';
        } else {
            $html .= '<input type="checkbox" id="permiso' . $opcion['id_Permiso'] . '" onclick="modificarPermiso(' . $opcion['id_Permiso'] . ');"> ';
            $html .= $opcion['permiso'] . '<br>';
        }
        $html .= '</div>';
    } else {
        $html .= '<div>';
        if (isset($datos[1][$opcion['id_Permiso']])) {
            $html .= '<input type="checkbox" id="permiso' . $opcion['id_Permiso'] . '" onclick="modificarPermiso(' . $opcion['id_Permiso'] . ');" checked> ';
            $html .= $opcion['permiso'] . '<br>';
        } else {
            $html .= '<input type="checkbox" id="permiso' . $opcion['id_Permiso'] . '" onclick="modificarPermiso(' . $opcion['id_Permiso'] . ');"> ';
            $html .= $opcion['permiso'] . '<br>';
        }
        $html .= '</div>';
    }
}
$html .= '</div>';
echo $html;

?>
