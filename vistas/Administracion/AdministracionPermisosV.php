<div id="permisosSeleccionados">
    <?php
    foreach ($datos[0] as $opcion) {
        if ($opcion['id_Opcion'] % 2 == 0) {
            ?>
            <div style="background-color: #eaeaea">
                <?php if (isset($datos[1][$opcion['id_Permiso']])) { ?>
                    <input type="checkbox" id="permiso<?php echo $opcion['id_Permiso'] ?>"
                           onclick="modificarPermiso(<?php echo $opcion['id_Permiso'] ?>);"
                           checked><?php echo $opcion['permiso'] ?><br>
                <?php } else { ?>
                    <input type="checkbox" id="permiso<?php echo $opcion['id_Permiso'] ?>"
                           onclick="modificarPermiso(<?php echo $opcion['id_Permiso'] ?>);"><?php echo $opcion['permiso'] ?>
                    <br>
                <?php } ?>
            </div>
            <?php
        } else {
            ?>
            <div>
                <?php if (isset($datos[1][$opcion['id_Permiso']])) { ?>
                    <input type="checkbox" id="permiso<?php echo $opcion['id_Permiso'] ?>"
                           onclick="modificarPermiso(<?php echo $opcion['id_Permiso'] ?>);"
                           checked><?php echo $opcion['permiso'] ?><br>
                <?php } else { ?>
                    <input type="checkbox" id="permiso<?php echo $opcion['id_Permiso'] ?>"
                           onclick="modificarPermiso(<?php echo $opcion['id_Permiso'] ?>);"><?php echo $opcion['permiso'] ?>
                    <br>
                <?php } ?>
            </div>
            <?php
        }
    }
    ?>
</div>