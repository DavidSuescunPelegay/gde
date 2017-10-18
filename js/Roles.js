function insertRol() {
    /*INICIO RECUPERACION VALORES INSERCION*/
    var rol = $('#textoRolInsertar').val();
    /*FIN RECUPERACION VALORES INSERCION*/

    /*INICIO COMPROBACIONES SEGURIDAD*/
    if (rol.length === 0) {//En caso de que el campo texto este vacio salta un error
        $('#textoRolInsertar').css("border-color", "red");
        $('#textoRolInsertar').effect("shake");

        llenarNotificaciones("Revisar campos en rojo");
        /*FIN COMPROBACIONES SEGURIDAD*/
    } else {
        var parametros = "&c=Roles&a=insertarRol";
        parametros += '&rol=' + rol;

        $.ajax({
            url: 'AjaxC.php',
            type: 'post',
            data: parametros,
            dataType: 'json',
            async: true,
            success: function () {
                llenarNotificaciones("Los datos del rol " + textoRol.toUpperCase() + " se han insertado correctamente");

                $('#modalInsertarRol').modal('hide');
            }
        })
    }

    location.reload();
}

function editarRol(id_Rol) {
    $('#idRolModificar').val(id_Rol);
    $('#textoRolModificar').val($('#textoRol' + id_Rol).text());

    llenarNotificaciones("Los campos han sido cargados en el formulario de edicion");
}

function updateRol() {
    var id_Rol = $('#idRolModificar').val();
    var rol = $('#textoRolModificar').val();

    var parametros = '&c=Roles&a=modificarRol';
    parametros += '&id_Rol=' + id_Rol;
    parametros += '&rol=' + rol;

    $.ajax({
        url: 'AjaxC.php',
        type: 'post',
        data: parametros,
        dataType: 'json',
        async: true,
        success: function (rol) {
            llenarNotificaciones("Los datos del rol " + textoRol.toUpperCase() + " se han modificado correctamente");

            $('#modalModificarRol').modal('hide');
        }
    })

    location.reload();
}

function eliminarRol(id_Rol){
    var primeraConfirmacion = confirm("¿Esta seguro de que desea eliminar un rol?");

    if (primeraConfirmacion == true) {
        var segundaConfirmacion = confirm("¿Esta seguro?");

        if (segundaConfirmacion == true) {
            var parametros = '&c=Roles&a=eliminarRol';
            parametros += '&id_Rol=' + id_Rol;

            $.ajax({
                url: 'AjaxC.php',
                type: 'post',
                data: parametros,
                dataType: 'json',
                async: true,
                success: function (rol) {
                    llenarNotificaciones("Se ha eliminado correctamente el rol");
                }
            })
        } else {
            llenarNotificaciones("Se ha cancelado la eliminacion correctamente");
        }
    } else {
        llenarNotificaciones("Se ha cancelado la eliminacion correctamente");
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
