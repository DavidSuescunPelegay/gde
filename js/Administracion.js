//Funcion que despues de haberse cargado la pagina genere el combo Simple Autocomplete
$(document).ready(function () {
    comboSimpleAutoComplete('id_BusquedaPorUsuario', 'Menus', 'autoCompleteUsuarios', '7', '300', '&tabindex=0');
});

function cambiarProductos() {
    var productosFiltrado = $('#productosFiltrado').val();
    switch (productosFiltrado) {
        case "Permisos":
            $('#parametrosFiltrado').prop('disabled', false);
            $('#parametrosFiltrado').show();
            $('#textoUsuario').hide();
            break;
        case "Roles":
            $('#parametrosFiltrado').hide();
            $('#textoUsuario').show();
            $('#au_id_BusquedaPorUsuario').show();
            break;
        default:
            alert("No puedes dejar este campo en blanco");
    }
}

function cambiarParametros() {
    var parametrosFiltrados = $('#parametrosFiltrado').val();
    switch (parametrosFiltrados) {
        case "Usuario":
            $('#au_id_BusquedaPorUsuario').show();
            $('#selectorRol').hide();

            $('#id_BusquedaPorUsuarioauto').val('');
            $('#id_BusquedaPorRolauto').val('');

            activarBotonBuscar();
            break;
        case "Rol":
            $('#selectorRol').show();
            $('#au_id_BusquedaPorUsuario').hide();

            $('#id_BusquedaPorUsuarioauto').val('');
            $('#id_BusquedaPorRolauto').val('');

            activarBotonBuscar();
            break;
        default:
            alert("No puedes dejar este campo en blanco");
    }
}

function activarBotonBuscar() {
    $('#botonBuscarFiltros').show();
}

function buscar() {
    var productosFiltrados = $('#productosFiltrado').val();
    var parametrosFiltrados = $('#parametrosFiltrado').val();

    if (parametrosFiltrados == null) {
        parametrosFiltrados == "Usuario";
    }

    var idUsuarioSeleccionado = $('#id_BusquedaPorUsuario').val();
    var idRolSeleccionado = $('#selectorRol').children(":selected").attr('id');

    if (idUsuarioSeleccionado == null) {
        idUsuarioSeleccionado = 0;
    }

    if (idRolSeleccionado == null) {
        idRolSeleccionado = 0;
    }

    if (idUsuarioSeleccionado == 0 && idRolSeleccionado == 0) {
        alert("No puedes dejar el selector en blanco");
    } else {
        switch (productosFiltrados) {
            case "Permisos":
                var parametros = '&c=Administracion&a=getDatosPermisos';
                parametros += '&productosFiltrados=' + productosFiltrados;
                parametros += '&parametrosFiltrados=' + parametrosFiltrados;
                if (idUsuarioSeleccionado !== '') {
                    parametros += '&id_Usuario=' + idUsuarioSeleccionado;
                }
                if (idRolSeleccionado !== '') {
                    parametros += '&id_Rol=' + idRolSeleccionado;
                }
                break;
            case "Roles":
                var parametros = '&c=Administracion&a=getDatosRoles';
                parametros += '&productosFiltrados=' + productosFiltrados;
                parametros += '&parametrosFiltrados=' + parametrosFiltrados;
                if (idUsuarioSeleccionado !== '') {
                    parametros += '&id_Usuario=' + idUsuarioSeleccionado;
                }
                break;
            default:
                alert("No puedes dejar este campo en blanco");
        }

        $.ajax({
            url: 'AjaxC.php',
            type: 'post',
            data: parametros,
            async: true,
            success: function (vista) {
                $('#resultadoFiltrado').html(vista);
                llenarNotificaciones("Se han cargado correctamente los " + productosFiltrados + " del " + parametrosFiltrados);

                if (idUsuarioSeleccionado !== '') {
                    $('#textoAyuda').text(productosFiltrados + " del " + parametrosFiltrados + ": " + $('#id_BusquedaPorUsuarioauto').val());
                } else {
                    $('#textoAyuda').text(productosFiltrados + " del " + parametrosFiltrados + ": " + $('#selectorRol').children(":selected").text());
                }

                $('#acordeonResultado').show();
            }
        })
    }
}

function modificarPermiso(id_Permiso) {
    var idUsuarioSeleccionado = $('#id_BusquedaPorUsuario').val();
    var id_Rol = $('#selectorRol').children(":selected").attr('id');

    if (idUsuarioSeleccionado !== '') {
        var checked = $('#permiso' + id_Permiso).is(":checked");

        if (checked) {
            var id_Usuario = $('#id_BusquedaPorUsuario').val();

            var parametros = '&c=Administracion&a=insertarPermisoUsuario';
            parametros += '&id_Permiso=' + id_Permiso;
            parametros += '&id_Usuario=' + id_Usuario;
        } else {
            var id_Usuario = $('#id_BusquedaPorUsuario').val();

            var parametros = '&c=Administracion&a=eliminarPermisoUsuario';
            parametros += '&id_Permiso=' + id_Permiso;
            parametros += '&id_Usuario=' + id_Usuario;
        }

        $.ajax({
            url: 'AjaxC.php',
            type: 'post',
            data: parametros,
            async: true,
            success: function () {
                llenarNotificaciones("Se han modificado correctamente los datos.");
            }
        })
    } else if (id_Rol !== '') {
        var checked = $('#permiso' + id_Permiso).is(":checked");

        if (checked) {
            var parametros = '&c=Administracion&a=insertarPermisoRol';
            parametros += '&id_Permiso=' + id_Permiso;
            parametros += '&id_Rol=' + id_Rol;
        } else {
            var parametros = '&c=Administracion&a=eliminarPermisoRol';
            parametros += '&id_Permiso=' + id_Permiso;
            parametros += '&id_Rol=' + id_Rol;
        }

        $.ajax({
            url: 'AjaxC.php',
            type: 'post',
            data: parametros,
            async: true,
            success: function () {
                llenarNotificaciones("Se han modificado correctamente los datos.");
            }
        })
    }
}

function modificarRol(id_Rol) {
    var idUsuarioSeleccionado = $('#id_BusquedaPorUsuario').val();
    var idRolSeleccionado = $('#selectorRol').children(":selected").attr('id');

    var checked = $('#rol' + id_Rol).is(":checked");

    if (checked) {
        var id_Usuario = $('#id_BusquedaPorUsuario').val();

        var parametros = '&c=Administracion&a=insertarRolUsuario';
        parametros += '&id_Rol=' + id_Rol;
        parametros += '&id_Usuario=' + id_Usuario;
    } else {
        var id_Usuario = $('#id_BusquedaPorUsuario').val();

        var parametros = '&c=Administracion&a=eliminarRolUsuario';
        parametros += '&id_Rol=' + id_Rol;
        parametros += '&id_Usuario=' + id_Usuario;
    }

    $.ajax({
        url: 'AjaxC.php',
        type: 'post',
        data: parametros,
        async: true,
        success: function () {
            llenarNotificaciones("Se han modificado correctamente los datos.");
        }
    })
}

/*Funcion que establece las notificaciones*/
function llenarNotificaciones(notificacionAMostrar) {
    $('#notificaciones').text(notificacionAMostrar);
    window.setTimeout(vaciarNotificaciones, 5000);
}

/*Funcion que vacia la caja de notificaciones*/
function vaciarNotificaciones() {
    $('#notificaciones').text("");
}