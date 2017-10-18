//Funcion que despues de haberse cargado la pagina genere el combo Simple Autocomplete
$(document).ready(function () {
    comboSimpleAutoComplete('id_UsuarioB', 'Usuarios', 'autoCompleteUsuarios', '7', '300', '&tabindex=1');
});

function busquedaInteligente() {
    var idUsuarioSeleccionado = $('#id_UsuarioB[type=hidden]').val();

    var parametros = '&c=Usuarios&a=getVistaResultadosBusqueda';
    parametros += '&id_Usuario=' + idUsuarioSeleccionado;

    $.ajax({
        url: 'AjaxC.php',
        type: 'post',
        data: parametros,
        async: true,
        success: function (vista) {
            $('#div-resultado-busqueda').html(vista);
            llenarNotificaciones("El usuario/s se ha encontrado correctamente");
        }
    })
}

function busquedaSimple() {
    var nombre = $('#usuarioB').val();
    var login = $('#loginB').val();
    var activo = $('#activoB').val();

    //Inicio de recuperacion inteligente de valores. Si un campo es vacio no se pasa a Ajax
    var parametros = '&c=Usuarios&a=getVistaResultadosBusqueda';
    if (nombre.length !== 0) {
        parametros += '&nombre=' + nombre;
    }
    if (login.length !== 0) {
        parametros += '&login=' + login;
    }
    if (activo.length !== 0) {
        parametros += '&activo=' + activo;
    }

    $.ajax({
        url: 'AjaxC.php',
        type: 'post',
        data: parametros,
        async: true,
        success: function (vista) {
            $('#div-resultado-busqueda').html(vista);
            llenarNotificaciones("El usuario/s se ha encontrado correctamente");

            new AjaxUpload('#subirFoto', {
                    action: 'AjaxC.php',
                    name: 'fichero',
                    onSubmit: function (file, ext) {
                        if (!(ext && /^(jpg|JPG|png|PNG|gif|GIF)$/.test(ext))) {
                            alert("Deben ser imagenes jpg, png o gif");
                            return false;
                        } else {
                            this.setData({
                                c: 'Usuarios',
                                a: 'subirFichero',
                                tipo: 'fotoUsuario',
                                id_Usuario: $('#id_Usuario').val(),
                            });
                        }
                    },
                    onComplete: function (file, respuesta) {

                    }
                }
            );
        }
    })
}

function guardarFoto() {
    alert("entro al onclick")
    new AjaxUpload('#subirFoto', {
            action: 'AjaxC.php',
            name: 'fichero',
            onSubmit: function (file, ext) {
                if (!(ext && /^(jpg|JPG|png|PNG|gif|GIF)$/.test(ext))) {
                    alert("Deben ser imagenes jpg, png o gif");
                    return false;
                } else {
                    this.setData({
                        c: 'Usuarios',
                        a: 'subirFichero',
                        tipo: 'fotoUsuario',
                        id_Usuario: $('#id_Usuario').val(),
                    });
                }
            },
            onComplete: function (file, respuesta) {

            }
        }
    );
}

function guardar() {
    var correcto = 'S';
    $('.inputRed').removeClass('inputRed')

    if ($('#nombre').val() == '') {
        var correcto = 'N';
        $('#nombre').addClass('inputRed');
    }
    ;
    if ($('#apellido_1').val() == '') {
        var correcto = 'N';
        $('#apellido_1').addClass('inputRed');
    }
    ;
    if ($('#login').val() == '') {
        var correcto = 'N';
        $('#login').addClass('inputRed');
    }
    ;
    if ($('#id_Usuario').val() == 0) { //nuevo
        if ($('#pass').val() == '' || $('#repass').val() == '' || $('#pass').val() != $('#repass').val()) {
            $('#pass').addClass('inputRed');
            $('#repass').addClass('inputRed');
            var correcto = 'N';
        }
    } else {//edicion
        if ($('#pass').val() != '' || $('#repass').val() != '') {
            if ($('#pass').val() == '' || $('#repass').val() == '' || $('#pass').val() != $('#repass').val()) {
                $('#pass').addClass('inputRed');
                $('#repass').addClass('inputRed');
                var correcto = 'N';
            }
        }
    }
    if (correcto == 'S') {
        //Tendriamos que comprobar los campos...
        var parametros = '&c=Usuarios&a=guardarUsuario';
        parametros += '&' + $('#formularioEdicion').serialize();
        $.ajax({
            url: 'AjaxC.php',
            type: 'post',
            data: parametros,
            dataType: 'json',
            async: true,
            success: function (respuesta) {
                alert(respuesta.msj);
                if (respuesta.correcto == 'S') {
                    $('#modalNuevoEditarUsuario').modal('hide');
                } else {
                    if (respuesta.tipoError = 'loginRepetido') {
                        $('#login').addClass('inputRed');
                    }
                }
                llenarNotificaciones("El usuario se ha guardado correctamente");
            }
        })
    } else {
        llenarNotificaciones('No se ha podido guardar. Revise los campos en rojo;')
    }

    location.reload();
}

function nuevoEditar(id_Usuario) {
    if (id_Usuario == 0) { //nuevo
        $('#div-edicion').show();
        $('#id_Usuario').val('0');
        $('#nombre').val('');
        $('#apellido_1').val('');
        $('#apellido_2').val('');
        $('#login').val('');
        $('#pass').val('');
        $('#repass').val('');
        $('#activo').val('S');

        $('#operacion').text("Insertar");

        llenarNotificaciones("Formulario de insercion abierto correctamente.");
    } else { //editar
        var parametros = '&c=Usuarios&a=getDatosUsuario';
        parametros += '&id_Usuario=' + id_Usuario;
        $.ajax({
            url: 'AjaxC.php',
            type: 'post',
            data: parametros,
            dataType: 'json',
            async: true,
            success: function (usuario) {
                $('#id_Usuario').val(usuario.id_Usuario);
                $('#nombre').val(usuario.nombre);
                $('#apellido_1').val(usuario.apellido_1);
                $('#apellido_2').val(usuario.apellido_1);
                $('#login').val(usuario.login);
                $('#pass').val('');
                $('#repass').val('');
                $('#activo').val(usuario.activo);
                llenarNotificaciones("Los datos del usuario se han cargado correctamente en el formulario.");
            }
        })
        $('#operacion').text("Modificar");
    }
}

function activar(activo, id_Usuario) {
    var parametros = '&c=Usuarios&a=activarDesactivar';
    parametros += '&id_Usuario=' + id_Usuario;
    parametros += '&activo=' + activo;
    $.ajax({
        url: 'AjaxC.php',
        type: 'post',
        data: parametros,
        dataType: 'json',
        async: true,
        success: function (respuesta) {
            alert(respuesta.msj);
            if (respuesta.correcto == 'S') {
                buscar();
            }
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