$(document).ready(function () {
    new AjaxUpload('#subirFoto', {
        action: 'AjaxC.php',
        name: 'fichero',
        onSubmit: function (file, ext) {
            if (!(ext && /^(jpg|JPG|png|PNG|gif|GIF)$/.test(ext) )) {
                alert('Deben der imagenes jsp,png,gif');
                return false; //No subir
            } else {
                this.setData({
                    c: 'Ficheros',
                    a: 'subirFoto',
                    tipo: 'fotoUsuario',
                    id_Usuario: $('#id_Usuario').val(),
                });
            }
        },
        onComplete: function (file, respuesta) {
            if (respuesta == 'ok') {
                var parametros = '&c=Ficheros&a=getVistaFotosUsuarios&id_Usuario=' + $('#id_Usuario').val();
                $.ajax({
                    url: 'AjaxC.php',
                    type: 'post',
                    data: parametros,
                    async: true,
                    success: function (vista) {
                        //$('#capaDocumentos').html(vista);
                    }
                });

                location.reload();
            } else {
                alert('No se ha podido subir.');
            }
        }
    });

    new AjaxUpload('#subirDocumento', {
        action: 'AjaxC.php',
        name: 'fichero',
        onSubmit: function (file, ext) {
            if (!(ext && /^(docx|xlsx|pdf|doc|xls)$/.test(ext) )) {
                alert('Deben ser pdf, word o excel');
                return false; //No subir
            } else {
                this.setData({
                    c: 'Ficheros',
                    a: 'subirDocumento',
                    tipo: 'documentoUsuario',
                    id_Usuario: $('#id_Usuario').val(),
                });
            }
        },
        onComplete: function (file, respuesta) {
            llenarNotificaciones(respuesta);
            if (respuesta == 'ok') {
                var parametros = '&c=Ficheros&a=getVistaDocumentosUsuarios&id_Usuario=' + $('#id_Usuario').val();
                $.ajax({
                    url: 'AjaxC.php',
                    type: 'post',
                    data: parametros,
                    async: true,
                    success: function (vista) {
                        //$('#capaDocumentos').html(vista);
                    }
                });

                location.reload();
            } else {
                alert('No se ha podido subir.');
            }
        }


    });
});

function cambiarFotoPerfil(id_Fichero) {
    var parametros = '&c=Ficheros';
    parametros += '&a=establecerFotoPerfil';
    parametros += '&id_Fichero=' + id_Fichero;

    $.ajax({
        url: 'AjaxC.php',
        type: 'post',
        data: parametros,
        async: true,
        success: function (vista) {
            //$('#capaDocumentos').html(vista);
        }
    });

    location.reload();
}

function desactivarFichero(id_Fichero) {
    var primeraConfirmacion = confirm("¿Esta seguro de que desea eliminar este fichero?");

    if (primeraConfirmacion == true) {
        var segundaConfirmacion = confirm("¿Esta seguro?");

        if (segundaConfirmacion == true) {
            var parametros = '&c=Ficheros';
            parametros += '&a=desactivarFichero';
            parametros += '&id_Fichero=' + id_Fichero;

            $.ajax({
                url: 'AjaxC.php',
                type: 'post',
                data: parametros,
                async: true,
                success: function (vista) {
                    //$('#capaDocumentos').html(vista);
                }
            });
        } else {
            llenarNotificaciones("Se ha cancelado la eliminacion correctamente");
        }
    } else {
        llenarNotificaciones("Se ha cancelado la eliminacion correctamente");
    }

    location.reload();
}

function desestablecerFotoPerfil() {
    var primeraConfirmacion = confirm("ￂ﾿Esta seguro de que desea establecer como foto de perfil la predeterminada?");

    if (primeraConfirmacion == true) {
        var parametros = '&c=Ficheros';
        parametros += '&a=desestablecerFotoPerfil';
        parametros += '&id_Usuario=' + $('#id_Usuario').val();

        $.ajax({
            url: 'AjaxC.php',
            type: 'post',
            data: parametros,
            async: true,
            success: function () {

            }
        });
    } else {
        llenarNotificaciones("Se ha cancelado el desestablecimiento correctamente");
    }

    location.reload();
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