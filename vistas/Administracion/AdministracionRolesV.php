<div id="rolesSeleccionados">
    <?php
    foreach ($datos[0] as $ind => $opcion) {
        if ($ind >= 0) {
            if (isset($datos[1][$opcion['id_Rol']])) { ?>
                <input type="checkbox" id="rol<?php echo $opcion['id_Rol'] ?>"
                       onclick="modificarRol(<?php echo $opcion['id_Rol'] ?>);" checked><?php echo $opcion['rol'] ?><br>
                <?php
            } else {
                ?>
                <input type="checkbox" id="rol<?php echo $opcion['id_Rol'] ?>"
                       onclick="modificarRol(<?php echo $opcion['id_Rol'] ?>);"><?php echo $opcion['rol'] ?><br>
                <?php
            }
        }
    }
    ?>
</div>