<?php
if (!empty($datos['filas'])) {
    echo '<ul>' . "\n";
    foreach ($datos['filas'] as $fila) {
        $nombre = mb_strtoupper($fila['apellido_1'] . ' ' . $fila['apellido_2'] . ' ' . $fila['nombre']);
        $nombreplano = $nombre;
        foreach ($datos['palabras'] as $npal => $palabra) {
            $nombre = str_replace($palabra, '<span style="font-weight: bold; color:blue;">' . $palabra . '</span>', $nombre);
        }
        echo "\t" . '<li id="autocomplete_' . $fila['id_Usuario'] . '" rel="' . utf8_encode($fila['id_Usuario']) . '_' . utf8_decode($nombreplano) . '">';
        echo trim(utf8_encode($nombre)) . '</li>' . "\n";
    }
    echo '</ul>';
}