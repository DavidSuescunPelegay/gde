<div class="page-header">
    <h1>Gestion de Roles</h1>
</div>

<?php
for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
    if ($_SESSION['permisos'][$i]['id_Permiso'] == 17) {
        ?>
        <button type="button"  class="btn btn-default botonNuevo" data-toggle="modal"
                data-target="#modalInsertarRol">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"> Rol</span>
        </button>
        <?php
    }
}
?>
<br><br>

<?php
for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
    if ($_SESSION['permisos'][$i]['id_Permiso'] == 16) {
        ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr style="background-color: #2E353D;">
                    <th>Rol</th>
                    <th>Operaciones disponibles</th>
                </tr>
                <?php
                foreach ($datos as $ind => $opcion) {
                    ?>
                    <tr style="background-color: #bbbbbb;" class="filaTabla">
                        <td id="textoRol<?php echo $opcion['id_Rol'] ?>"><?php echo $opcion['rol'] ?></td>
                        <td>
                            <?php
                            for ($j = 0; $j < count($_SESSION['permisos']); $j++) {
                                if ($_SESSION['permisos'][$j]['id_Permiso'] == 18) {
                                    ?>
                                    <button type="button" class="btn btn-warning" title="Editar" data-toggle="modal"
                                            data-target="#modalModificarRol"
                                            id="botonEdicion<?php echo $opcion['id_Rol'] ?>"
                                            onclick="editarRol(<?php echo $opcion['id_Rol'] ?>)"><span
                                                class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                                    <?php
                                }
                            }
                            ?>

                            &nbsp &nbsp

                            <?php
                            for ($k = 0; $k < count($_SESSION['permisos']); $k++) {
                                if ($_SESSION['permisos'][$k]['id_Permiso'] == 19) {
                                    ?>
                                    <button type="button" class="btn btn-danger" title="Eliminar"
                                            id="botonEliminar<?php echo $opcion['id_Rol'] ?>"
                                            onclick="eliminarRol(<?php echo $opcion['id_Rol'] ?>)"><span
                                                class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                    <?php
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <?php
    }
}
?>

<div class="modal fade" id="modalInsertarRol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Insertar Rol</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="insertarRol" name="insertarRol">
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" id="idRolInsertar" name="idRolInsertar"/>
                            <label for="texto">Texto:</label>
                            <input type="text" id="textoRolInsertar" name="textoRolInsertar" class="form-control"
                                   placeholder="Texto"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="insertRol()">Insertar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalModificarRol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modificar Rol</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="modificarRol" name="modificarRol">
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" id="idRolModificar" name="idRolModificar"/>
                            <label for="texto">Texto:</label>
                            <input type="text" id="textoRolModificar" name="textoRolModificar" class="form-control"
                                   placeholder="Texto"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="updateRol()">Guardar</button>
            </div>
        </div>
    </div>
</div>
