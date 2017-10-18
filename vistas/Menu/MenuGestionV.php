<?php
for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
    if ($_SESSION['permisos'][$i]['id_Permiso'] == 7) {
        ?>
        <button type="button" id="botonNuevo" class="btn btn-danger" data-toggle="modal"
                data-target="#modalInsertarMenu">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"> Menu</span>
        </button>
        <br><br>
        <?php
    }
}
?>

<?php
for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
    if ($_SESSION['permisos'][$i]['id_Permiso'] == 6) {
        $html = '<div class="table-responsive">';
        $html .= '<table class="table table-striped" >';
        $html .= '<tr style="background-color: #888888;">';
        $html .= '<th>Nombre</th>';
        $html .= '<th>URL</th>';
        $html .= '<th>ID Padre</th>';
        $html .= '<th>Orden</th>';
        $html .= '<th>Operaciones Disponibles</th>';
        $html .= '</tr>';

        foreach ($datos[0] as $ind => $opcion) {
            $html .= '<tr style="background-color: #bbbbbb;">';
            $html .= '<td id="texto' . $opcion['id_Opcion'] . '">' . $opcion['texto'] . '</td>';
            $html .= '<td id="url' . $opcion['id_Opcion'] . '">' . $opcion['url'] . '</td>';
            $html .= '<td id="padre' . $opcion['id_Opcion'] . '">' . $opcion['id_Padre'] . '</td>';
            $html .= '<td id="orden' . $opcion['id_Opcion'] . '">' . $opcion['orden'] . '</td>';
            $html .= '<td>';
            for ($j = 0; $j < count($_SESSION['permisos']); $j++) {
                if ($_SESSION['permisos'][$j]['id_Permiso'] == 8) {
                    $html .= '<button type="button" class="btn btn-warning" title="Editar" data-toggle="modal" data-target="#modalModificarMenu" id="botonEdicion' . $opcion['id_Opcion'] . '" onclick="editarMenu(' . $opcion['id_Opcion'] . ', ' . $opcion['id_Padre'] . ')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
                }
            }

            $html .= '&nbsp &nbsp';

            for ($k = 0; $k < count($_SESSION['permisos']); $k++) {
                if ($_SESSION['permisos'][$k]['id_Permiso'] == 9) {
                    $html .= '<button type="button" class="btn btn-danger" title="Eliminar" id="botonEliminar' . $opcion['id_Opcion'] . '" onclick="eliminarMenu(' . $opcion['id_Opcion'] . ')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
                }
            }

            $html .= '&nbsp &nbsp';
            $html .= '<a href="app.php?d=Permisos&opcion=' . $opcion['id_Opcion'] . '"><button type="button" class="btn btn-info" id="botonPermisos' . $opcion['id_Opcion'] . '"><span class="glyphicon glyphicon-flag" aria-hidden="true"> Permisos</span></button></a></td>';

            if (isset($opcion['subOpciones'])) {
                foreach ($opcion['subOpciones'] as $subind => $subOpcion) {
                    $html .= '<tr style="background-color: #dddddd;">';
                    $html .= '<td style="padding-left: 2%;" id="texto' . $subOpcion['id_Opcion'] . '">' . $subOpcion['texto'] . '</td>';
                    $html .= '<td id="url' . $subOpcion['id_Opcion'] . '">' . $subOpcion['url'] . '</td>';
                    $html .= '<td id="padre' . $subOpcion['id_Opcion'] . '">' . $subOpcion['id_Padre'] . '</td>';
                    $html .= '<td id="orden' . $subOpcion['id_Opcion'] . '">' . $subOpcion['orden'] . '</td>';
                    $html .= '<td>';
                    for ($j = 0; $j < count($_SESSION['permisos']); $j++) {
                        if ($_SESSION['permisos'][$j]['id_Permiso'] == 8) {
                            $html .= '<button type="button" class="btn btn-warning" title="Editar" data-toggle="modal" data-target="#modalModificarMenu" id="botonEdicion' . $subOpcion['id_Opcion'] . '" onclick="editarMenu(' . $subOpcion['id_Opcion'] . ', ' . $subOpcion['id_Padre'] . ')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
                        }
                    }

                    $html .= '&nbsp &nbsp';

                    for ($k = 0; $k < count($_SESSION['permisos']); $k++) {
                        if ($_SESSION['permisos'][$k]['id_Permiso'] == 9) {
                            $html .= '<button type="button" class="btn btn-danger" title="Eliminar" id="botonEliminar' . $subOpcion['id_Opcion'] . '" onclick="eliminarMenu(' . $subOpcion['id_Opcion'] . ')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
                        }
                    }

                    $html .= '&nbsp &nbsp';
                    $html .= '<a href="app.php?d=Permisos&opcion=' . $subOpcion['id_Opcion'] . '"><button type="button" class="btn btn-info" id="botonPermisos' . $subOpcion['id_Opcion'] . '"><span class="glyphicon glyphicon-flag" aria-hidden="true"> Permisos</span></button></a></td>';
                    $html .= '</tr>';
                }
            }

        }

        $html .= '</table>';
        $html .= '</div>';

        echo $html;
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
                                    $html = '<option value="padre' . $opcion['id_Opcion'] . '">' . $opcion['id_Opcion'] . ' (dependera del menu ' . $opcion['texto'] . ')</option>';
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
                <button type="button" class="btn btn-primary" onclick="insertMenu()">Insertar</button>
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
                                    $html = '<option value="padre' . $opcion['id_Opcion'] . '">' . $opcion['id_Opcion'] . ' (dependera del menu ' . $opcion['texto'] . ')</option>';
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
                <button type="button" class="btn btn-primary" onclick="updateMenu()">Guardar</button>
            </div>
        </div>
    </div>
</div>
