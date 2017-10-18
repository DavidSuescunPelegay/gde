<?php
$html = '';
$html .= '<div id="rolesSeleccionados">';
foreach ($datos[0] as $opcion) {
    if (isset($datos[1][$opcion['id_Rol']])) {
        $html .= '<input type="checkbox" id="rol'.$opcion['id_Rol'].'" onclick="modificarRol('.$opcion['id_Rol'].');" checked> ';
        $html .= $opcion['rol'] . '<br>';
    } else {
        $html .= '<input type="checkbox" id="rol'.$opcion['id_Rol'].'" onclick="modificarRol('.$opcion['id_Rol'].');"> ';
        $html .= $opcion['rol'] . '<br>';
    }
}
$html .= '</div>';
echo $html;

?>
