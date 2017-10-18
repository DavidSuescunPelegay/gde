<div class="page-header">
    <h1>Gestion de Usuarios</h1>
</div>

<?php
for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
    if ($_SESSION['permisos'][$i]['id_Permiso'] == 7) {
        ?>
        <button type="button" class="btn btn-danger" onclick="nuevoEditar('0');" data-toggle="modal"
                data-target="#modalNuevoEditarUsuario"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Usuario</span>
        </button>
        <?php
    }
}
?>
<br>
<br>
<?php
for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
    if ($_SESSION['permisos'][$i]['id_Permiso'] == 7) {
        ?>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                           aria-expanded="true" aria-controls="collapseOne"
                           title="Nueva Busqueda! Con funcion de autocompletado de Usuarios">
                            Busqueda Inteligente
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <form id="formularioBusquedaInteligente" name="formularioBusquedaInteligente">
                            <fieldset>
                                <label for="au_id_UsuarioB">Usuario:</label>
                                <span id="au_id_UsuarioB" name="au_id_UsuarioB"></span>
                                <button type="button" class="btn btn-primary"
                                        title="Si no introduces ningun valor, mostrara todos los resultados"
                                        onclick="busquedaInteligente()">Buscar
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                           href="#collapseTwo"
                           aria-expanded="false" aria-controls="collapseTwo" title="La busqueda de siempre">
                            Busqueda Simple
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <form id="formularioBuscar" name="formularioBuscar">
                            <fieldset>
                                <label for="usuarioB">Usuario:</label>
                                <input type="text" id="usuarioB" name="usuarioB" value="">

                                <label for="loginB">Login:</label>
                                <input type="text" id="loginB" name="loginB" value="">

                                <label for="activoB">Estado:</label>
                                <select id="activoB" name="activoB">
                                    <option value="S">Solo Activos</option>
                                    <option value="N">Solo Inactivos</option>
                                    <option value="" selected>Activos e Inactivos</option>
                                </select>
                                <button type="button" class="btn btn-primary"
                                        title="Si no introduces ningun valor, mostrara todos los resultados"
                                        onclick="busquedaSimple();">Buscar
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
<div id="div-resultado-busqueda"></div>

<div class="modal fade bs-example-modal-lg" id="modalNuevoEditarUsuario" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><span id="operacion"></span> Usuario</h4>
            </div>
            <div class="modal-body">
                <div id="div-edicion">
                    <a name="edicionUsuario"></a>
                    <form role="form" id="formularioEdicion" name="formularioEdicion">
                        <div class="row">
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <input type="hidden" id="id_Usuario" name="id_Usuario"/>
                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre"
                                       class="form-control" placeholder="Nombre usuario"/>
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label for="apellido_1">Primer Apellido:</label>
                                <input type="text" id="apellido_1" name="apellido_1"
                                       class="form-control" placeholder="Primer Apellido"/>
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label for="apellido_1">Segundo Apellido:</label>
                                <input type="text" id="apellido_2" name="apellido_2"
                                       class="form-control" placeholder="Segundo Apellido"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <label for="nombre">Login:</label>
                                <input type="text" id="login" name="login"
                                       class="form-control" placeholder="Login usuario"/>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <label for="pass">Contrase&ntilde;a:</label>
                                <input type="password" id="pass" name="pass"
                                       class="form-control" placeholder="Contrasena"/>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <label for="repass">Repetir Contrasena:</label>
                                <input type="password" id="repass" name="repass"
                                       class="form-control" placeholder="Repetir contrasena"/>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <label for="activo">Activo:</label>
                                <select id="activo" name="activo" class="form-control">
                                    <option value="S">Activo</option>
                                    <option value="N">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="guardar();">Guardar</button>
            </div>
        </div>
    </div>
</div>



