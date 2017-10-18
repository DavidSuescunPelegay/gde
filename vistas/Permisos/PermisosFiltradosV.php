<button type="button" id="botonNuevo" class="btn btn-danger" data-toggle="modal" data-target="#modalInsertarPermiso">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"> Permiso</span>
</button>
<a href="app.php?c=Menus">
    <button type="button" id="botonNuevo" class="btn btn-warning">
        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"> Volver a Menus</span>
    </button>
</a>
<br><br>

<?php
$html = '<div class="table-responsive">';
$html .= '<table class="table table-stripped" id="tablaPermisos">';
$html .= '<tr style="background-color: #888888;">';
$html .= '<th>ID Menu</th>';
$html .= '<th>Numero de Permiso</th>';
$html .= '<th>Nombre de Permiso</th>';
$html .= '<th>Operaciones disponibles</th>';
$html .= '</tr>';
foreach ($datos[0] as $opcion) {
    $html .= '<tr style="background-color: #bbbbbb" class="filaTabla">';
    $html .= '<td id="opcion' . $opcion['id_Permiso'] . '">' . $opcion['id_Opcion'] . ' - ' . $opcion['texto'] . '</td>';
    $html .= '<td id="ordenPermiso' . $opcion['id_Permiso'] . '">' . $opcion['num_Permiso'] . '</td>';
    $html .= '<td id="textoPermiso' . $opcion['id_Permiso'] . '">' . $opcion['permiso'] . '</td>';
    $html .= '<td>';

    if ($opcion['num_Permiso'] < 5) {//Desactivo el boton editar si el numero de permiso es 1, 2, 3 o 4
        $html .= '<button type="button" class="btn btn-warning disabled" title="Las funciones de edicion estan desactivadas para los numero de permiso 1-4" id="botonEdicion' . $opcion['id_Permiso'] . '" onclick="edicionProhibida()"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
    } else {
        $html .= '<button type="button" class="btn btn-warning" id="botonEdicion' . $opcion['id_Permiso'] . '" data-toggle="modal" data-target="#modalModificarPermiso" onclick="editPermiso(' . $opcion['id_Permiso'] . ', ' . $opcion['id_Opcion'] . ')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
    }
    $html .= '&nbsp &nbsp';
    if ($opcion['num_Permiso'] < 5) {//Desactivo el boton eliminar si el numero de permiso es 1, 2, 3 o 4
        $html .= '<button type="button" class="btn btn-danger disabled" title="Las funciones de eliminacion estan desactivadas para los numero de permiso 1-4" id="botonEliminacion' . $opcion['id_Permiso'] . '" onclick="eliminacionProhibida()"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
    } else {
        $html .= '<button type="button" class="btn btn-danger" id="botonEliminacion' . $opcion['id_Permiso'] . '" onclick="deletePermiso(' . $opcion['id_Permiso'] . ')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
    }
    $html .= '</td>';
    $html .= '</tr>';
}
$html .= '</table>';
$html .= '</div>';

echo $html;
?>

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
                                foreach ($datos[1] as $opcion){
                                    $html = '<option value="' . $datos[1]['id_Opcion'] . '">' . $datos[1]['id_Opcion'] . ' (dependera del menu ' . $datos[1]['texto'] . ')</option>';
                                    echo $html;
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
                <button type="button" class="btn btn-primary" onclick="insertPermiso()">Insertar</button>
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
                                foreach ($datos[1] as $opcion){
                                    $html = '<option value="' . $datos[1]['id_Opcion'] . '">' . $datos[1]['id_Opcion'] . ' (dependera del menu ' . $datos[1]['texto'] . ')</option>';
                                    echo $html;
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
                <button type="button" class="btn btn-primary" onclick="updatePermiso()">Guardar</button>
            </div>
        </div>
    </div>
</div>