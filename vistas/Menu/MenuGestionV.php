<div class="page-header">
    <h1>Gestion del Menu</h1>
</div>

<?php
for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
    if ($_SESSION['permisos'][$i]['id_Permiso'] == 7) {
        ?>
        <button type="button"  class="btn btn-default" data-toggle="modal"
                data-target="#modalInsertarMenu">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"> Menu</span>
        </button>
        <br><br>
        <?php
    }
}
?>

<?php
for ($i = 0;
     $i < count($_SESSION['permisos']);
     $i++) {
    if ($_SESSION['permisos'][$i]['id_Permiso'] == 6) {
        ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr style="background-color: #2E353D;">
                    <th>Nombre</th>
                    <th>URL</th>
                    <th>ID Padre</th>
                    <th>Orden</th>
                    <th>Operaciones Disponibles</th>
                </tr>
                <?php
                foreach ($datos[0] as $ind => $opcion) {
                    ?>
                    <tr style="background-color: #bbbbbb;" class="filaTabla">
                    <td id="texto<?php echo $opcion['id_Opcion'] ?>"><?php echo $opcion['texto'] ?></td>
                    <td id="url<?php echo $opcion['id_Opcion'] ?>"><?php echo $opcion['url'] ?></td>
                    <td id="padre<?php echo $opcion['id_Opcion'] ?>"><?php echo $opcion['id_Padre'] ?></td>
                    <td id="orden<?php echo $opcion['id_Opcion'] ?>"><?php echo $opcion['orden'] ?></td>
                    <td>
                        <?php
                        for ($j = 0; $j < count($_SESSION['permisos']); $j++) {
                            if ($_SESSION['permisos'][$j]['id_Permiso'] == 8) {
                                ?>
                                <button type="button" class="btn btn-default" title="Editar" data-toggle="modal"
                                        data-target="#modalModificarMenu" id="botonEdicion<?php echo $opcion['id_Opcion'] ?>"
                                        onclick="editarMenu(<?php echo $opcion['id_Opcion'] ?>, <?php echo $opcion['id_Padre'] ?>)"><span
                                            class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                                <?php
                            }
                        }
                        ?>
                        &nbsp &nbsp
                        <?php
                        for ($k = 0; $k < count($_SESSION['permisos']); $k++) {
                            if ($_SESSION['permisos'][$k]['id_Permiso'] == 9) {
                                ?>
                                <button type="button" class="btn btn-default" title="Eliminar"
                                        id="botonEliminar<?php echo $opcion['id_Opcion'] ?>"
                                        onclick="eliminarMenu(<?php echo $opcion['id_Opcion'] ?>)"><span
                                            class="glyphicon glyphicon-trash"
                                            aria-hidden="true"></span></button>
                                <?php
                            }
                        }
                        ?>
                        &nbsp &nbsp
                        <a href="app.php?d=Permisos&opcion=<?php echo $opcion['id_Opcion'] ?>">
                            <button type="button" class="btn btn-default"
                                    id="botonPermisos<?php echo $opcion['id_Opcion'] ?>"><span
                                        class="glyphicon glyphicon-flag" aria-hidden="true"> Permisos</span></button>
                        </a></td>
                    <?php

                    if (isset($opcion['subOpciones'])) {
                        foreach ($opcion['subOpciones'] as $subind => $subOpcion) {
                            ?>
                            <tr style="background-color: #dddddd;" class="filaTabla">
                                <td style="padding-left: 2%;"
                                    id="texto<?php echo $subOpcion['id_Opcion'] ?>"><?php echo $subOpcion['texto'] ?>
                                </td>
                                <td id="url<?php echo $subOpcion['id_Opcion'] ?>"><?php echo $subOpcion['url'] ?></td>
                                <td id="padre<?php echo $subOpcion['id_Opcion'] ?>"><?php echo $subOpcion['id_Padre'] ?></td>
                                <td id="orden<?php echo $subOpcion['id_Opcion'] ?>"><?php echo $subOpcion['orden'] ?></td>
                                <td>
                                    <?php
                                    for ($j = 0; $j < count($_SESSION['permisos']); $j++) {
                                        if ($_SESSION['permisos'][$j]['id_Permiso'] == 8) {
                                            ?>
                                            <button type="button" class="btn btn-default" title="Editar"
                                                    data-toggle="modal"
                                                    data-target="#modalModificarMenu"
                                                    id="botonEdicion<?php echo $subOpcion['id_Opcion'] ?>"
                                                    onclick="editarMenu(<?php echo $subOpcion['id_Opcion'] ?>, <?php echo $subOpcion['id_Padre'] ?>)"><span
                                                        class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                            </button>
                                            <?php
                                        }
                                    }
                                    ?>
                                    &nbsp &nbsp
                                    <?php
                                    for ($k = 0; $k < count($_SESSION['permisos']); $k++) {
                                        if ($_SESSION['permisos'][$k]['id_Permiso'] == 9) {
                                            ?>
                                            <button type="button" class="btn btn-default" title="Eliminar"
                                                    id="botonEliminar<?php echo $subOpcion['id_Opcion'] ?>"
                                                    onclick="eliminarMenu(<?php echo $subOpcion['id_Opcion'] ?>)"><span
                                                        class="glyphicon glyphicon-trash"
                                                        aria-hidden="true"></span>
                                            </button>
                                            <?php
                                        }
                                    }
                                    ?>
                                    &nbsp &nbsp
                                    <a href="app.php?d=Permisos&opcion=<?php echo $subOpcion['id_Opcion'] ?>">
                                        <button type="button" class="btn btn-default"
                                                id="botonPermisos<?php echo $subOpcion['id_Opcion'] ?>"><span
                                                    class="glyphicon glyphicon-flag" aria-hidden="true"> Permisos</span>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                }
                ?>
            </table>
        </div>
        <?php
    }
}
?>

<div class="modal fade bs-example-modal-lg" id="modalInsertarMenu" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Insertar Menu</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="insertarMenu" name="insertarMenu">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <input type="hidden" id="id_OpcionInsertar" name="id_OpcionInsertar"/>
                            <label for="texto">Texto:</label>
                            <input type="text" id="textoInsertar" name="textoInsertar" class="form-control"
                                   placeholder="Texto"/>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="url">URL:</label>
                            <input type="text" id="urlInsertar" name="urlInsertar" class="form-control"
                                   placeholder="URL"/>
                        </div>

                        <!--Funcion PHP que carga los ID Padre que existen en la Base de Datos-->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="id_Padre">ID Padre</label>
                            <br>
                            <select id="valoresIdPadreInsertar" name="valoresIdPadreInsertar">
                                <option value="0">0 (no depende de ningun menu)</option>
                                <?php
                                foreach ($datos[1] as $opcion) {
                                    $html = '<option value="' . $opcion['id_Opcion'] . '">' . $opcion['id_Opcion'] . ' (dependera del menu ' . $opcion['texto'] . ')</option>';
                                    echo $html;
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="orden">Orden</label>
                            <input type="number" id="ordenInsertar" name="ordenInsertar" class="form-control"
                                   placeholder="Orden"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-default" onclick="insertMenu()">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Insertar
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modalModificarMenu" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modificar Menu</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="modificarMenu" name="modificarMenu">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <input type="hidden" id="id_OpcionModificar" name="id_OpcionModificar"/>
                            <label for="texto">Texto:</label>
                            <input type="text" id="textoModificar" name="textoModificar" class="form-control"
                                   placeholder="Texto"/>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="url">URL:</label>
                            <input type="text" id="urlModificar" name="urlModificar" class="form-control"
                                   placeholder="URL"/>
                        </div>

                        <!--Funcion PHP que carga los ID Padre que existen en la Base de Datos-->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="id_Padre">ID Padre</label>
                            <br>
                            <select id="valoresIdPadreModificar" name="valoresIdPadreModificar">
                                <option value="0">0 (no depende de ningun menu)</option>
                                <?php
                                foreach ($datos[1] as $opcion) {
                                    $html = '<option value="' . $opcion['id_Opcion'] . '">' . $opcion['id_Opcion'] . ' (dependera del menu ' . $opcion['texto'] . ')</option>';
                                    echo $html;
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="orden">Orden</label>
                            <input type="number" id="ordenModificar" name="ordenModificar" class="form-control"
                                   placeholder="Orden"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-default" onclick="updateMenu()">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar
                </button>
            </div>
        </div>
    </div>
</div>
