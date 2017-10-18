<div class="page-header">
    <h1>Gestion de Permisos (Filtrados)</h1>
</div>
<button type="button"  class="btn btn-default" data-toggle="modal" data-target="#modalInsertarPermiso">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"> Permiso</span>
</button>
<a href="app.php?c=Menus">
    <button type="button"  class="btn btn-default">
        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"> Volver a Menus</span>
    </button>
</a>
<br><br>

<div class="table-responsive">
    <table class="table table-stripped" id="tablaPermisos">
        <tr style="background-color: #2E353D;">
            <th>ID Menu</th>
            <th>Numero de Permiso</th>
            <th>Nombre de Permiso</th>
            <th>Operaciones disponibles</th>
        </tr>
        <?php
        foreach ($datos[0] as $opcion) {
            ?>
            <tr style="background-color: #bbbbbb" class="filaTabla">
                <td id="opcion<?php echo $opcion['id_Permiso'] ?>"><?php echo $opcion['id_Opcion'] ?>
                    - <?php echo $opcion['texto'] ?></td>
                <td id="ordenPermiso<?php echo $opcion['id_Permiso'] ?>"><?php echo $opcion['num_Permiso'] ?></td>
                <td id="textoPermiso<?php echo $opcion['id_Permiso'] ?>"><?php echo $opcion['permiso'] ?></td>
                <td>
                    <?php
                    if ($opcion['num_Permiso'] < 5) {//Desactivo el boton editar si el numero de permiso es 1, 2, 3 o 4
                        ?>
                        <button type="button" class="btn btn-default disabled"
                                title="Las funciones de edicion estan desactivadas para los numero de permiso 1-4"
                                id="botonEdicion<?php echo $opcion['id_Permiso'] ?>" onclick="edicionProhibida()"><span
                                    class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                        <?php
                    } else {
                        ?>

                        <button type="button" class="btn btn-default" id="botonEdicion<?php echo $opcion['id_Permiso'] ?>"
                                data-toggle="modal" data-target="#modalModificarPermiso"
                                onclick="editPermiso(<?php echo $opcion['id_Permiso'] ?>, <?php echo $opcion['id_Opcion'] ?>)"><span
                                    class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                        <?php
                    }
                    ?>
                    &nbsp &nbsp
                    <?php
                    if ($opcion['num_Permiso'] < 5) {//Desactivo el boton eliminar si el numero de permiso es 1, 2, 3 o 4
                        ?>

                        <button type="button" class="btn btn-default disabled"
                                title="Las funciones de eliminacion estan desactivadas para los numero de permiso 1-4"
                                id="botonEliminacion<?php echo $opcion['id_Permiso'] ?>"
                                onclick="eliminacionProhibida()"><span
                                    class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                        <?php
                    } else {
                        ?>

                        <button type="button" class="btn btn-default"
                                id="botonEliminacion<?php echo $opcion['id_Permiso'] ?>"
                                onclick="deletePermiso(<?php echo $opcion['id_Permiso'] ?>)"><span
                                    class="glyphicon glyphicon-trash"
                                    aria-hidden="true"></span></button>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>


<div class="modal fade bs-example-modal-lg" id="modalInsertarPermiso" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalInsertarPermisoLabel">Insertar Permiso</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="insertarPermiso" name="insertarPermiso">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <input type="hidden" id="idOpcionInsertar" name="idOpcionInsertar"/>
                            <label for="idMenu">Menu que depende:</label>
                            <br>
                            <select id="valoresIdMenuDependeInsertar" name="valoresIdMenuInsertar">
                                <option value="0">Menu del que dependera el permiso</option>
                                <?php
                                foreach ($datos[1] as $opcion) {
                                    ?>
                                    <option value="<?php echo $opcion['id_Opcion']?>"><?php echo $opcion['id_Opcion']?> (dependera del menu <?php echo $opcion['texto']?>)</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="numPermisoInsertar">Numero de Permiso (reservadas del 1 al 4)</label>
                            <input type="number" id="numPermisoInsertar" min="5" placeholder="Numero de Permiso">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="textoPermisoInsertar">Texto descriptivo del Permiso</label>
                            <div id="divNumPermisoInsertar">
                                <input type="text" id="textoPermisoInsertar" placeholder="Texto del Permiso"
                                       style="width: 100%;">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-default" onclick="insertPermiso()">Insertar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-example-modal-lg" id="modalModificarPermiso" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modificar Permiso</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="modificarPermiso" name="modificarPermiso">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <input type="hidden" id="idPermisoModificar" name="idPermisoModificar"/>
                            <label for="idMenu">Menu que depende:</label>
                            <br>
                            <select id="valoresIdMenuDependeModificar" name="valoresIdMenuDependeModificar">
                                <option value="0">Menu del que dependera el permiso</option>
                                <?php
                                foreach ($datos[1] as $opcion) {
                                    ?>
                                    <option value="<?php echo $opcion['id_Opcion']?>"><?php echo $opcion['id_Opcion']?> (dependera del menu <?php echo $opcion['texto']?>)</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="numPermisoModificar">Numero de Permiso (reservadas del 1 al 4)</label>
                            <input type="number" id="numPermisoModificar" min="5" placeholder="Numero de Permiso">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="textoPermisoModificar">Texto descriptivo del Permiso</label>
                            <input type="text" id="textoPermisoModificar" placeholder="Texto del Permiso"
                                   style="width: 100%;">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-default" onclick="updatePermiso()">Guardar</button>
            </div>
        </div>
    </div>
</div>