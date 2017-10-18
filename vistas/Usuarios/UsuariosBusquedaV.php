<div class="alert alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php
    $contador = count($datos);
    if ($contador == 1) {
        ?>
        La consulta ha devuelto <strong><?php echo count($datos) ?></strong> registro.
        <?php
    } else { ?>
        La consulta ha devuelto <strong><?php echo count($datos) ?></strong> registros.
        <?php
    }
    ?>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <tr style="background-color: #2E353D;">
            <th>Nombre</th>
            <th>Login</th>
            <th>Operaciones disponibles</th>
            <th>Activo</th>
            <th></th>
        </tr>
        <?php foreach ($datos as $fila) { ?>
            <tr style="background-color: #bbbbbb;" class="filaTabla">
                <td>
                    <?php echo $fila['apellido_1'] . ' ' . $fila['apellido_2'] . ', ' . $fila['nombre'] ?>
                </td>
                <td><?php echo $fila['login'] ?></td>
                <td>
                    <?php for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
                        if ($_SESSION['permisos'][$i]['id_Permiso'] == 3) { ?>
                            <button type="button" class="btn btn-default"
                                    onclick="nuevoEditar(<?php echo $fila['id_Usuario'] ?>)" data-toggle="modal"
                                    data-target="#modalNuevoEditarUsuario">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </button>
                            <?php
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php if ($fila['activo'] != 'S') { ?>
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    <?php } else { ?>
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                    <?php } ?>
                </td>
                <td>
                    <?php if ($fila['activo'] != 'S') { ?>
                        <button type="button" class="btn btn-default" title="Activar"
                                onclick="activar('S, ' . <?php echo $fila['id_Usuario'] ?>)">
                            <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
                        </button>
                    <?php } else { ?>
                        <button type="button" class="btn btn-default" title="Desactivar"
                                onclick="activar('N, ' . <?php echo $fila['id_Usuario'] ?>)">
                            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                        </button>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>