function insertMenu() {
    var id_Opcion = $('#id_OpcionInsertar').val();
    var texto = $('#textoInsertar').val();
    var url = $('#urlInsertar').val();
    var id_Padre = $('#valoresIdPadreInsertar').val();
    var orden = $('#ordenInsertar').val();

    if (texto.length === 0 || texto === null) {
        $('#textoInsertar').css("border-color", "red");
        $('#textoInsertar').effect("shake");
        llenarNotificaciones("Revisar campos en rojo");
    } else {
        if (orden == 0) {
            $('#ordenInsertar').css("border-color", "red");
            $('#ordenInsertar').effect("shake");
            llenarNotificaciones("Revisar campos en rojo");
        } else {
            var parametros = '&c=Menus&a=insertarMenu';
            parametros += '&id_Opcion=' + id_Opcion;
            parametros += '&texto=' + texto;
            parametros += '&url=' + url;
            parametros += '&id_Padre=' + id_Padre;
            parametros += '&orden=' + orden;

            $.ajax({
                url: 'AjaxC.php',
                type: 'post',
                data: parametros,
                dataType: 'json',
                async: true,
                success: function () {
                    llenarNotificaciones("Los datos del menu " + texto.toUpperCase() + " se han insertado correctamente");

                    $('#modalInsertarMenu').modal('hide');

                    location.reload();
                }
            })
        }
    }
}

function editarMenu(id_Opcion, id_Padre) {
    /*Si el id_Padre es undefined se pasa a 0*/
    if (id_Padre == 0) {
        id_Padre = 0;
    }
    /*Rellenamos los campos del formulario con los datos de la tabla*/
    //$('#id_OpcionModificar').val($('#id' + id_Opcion).text());
    $('#id_OpcionModificar').val(id_Opcion);
    $('#textoModificar').val($('#texto' + id_Opcion).text());
    $('#urlModificar').val($('#url' + id_Opcion).text());
    $("#valoresIdPadreModificar").val(id_Padre);
    $('#ordenModificar').val($('#orden' + id_Opcion).text());

    llenarNotificaciones("Los campos han sido cargados en el formulario de edicion");
}

function updateMenu() {
    var id_Opcion = $('#id_OpcionModificar').val();
    var texto = $('#textoModificar').val();
    var url = $('#urlModificar').val();
    var id_Padre = $('#valoresIdPadreModificar').val();
    var orden = $('#ordenModificar').val();

    //Si id_Padre es null, se pone como 0
    if (id_Padre === null) {
        id_Padre = 0;
    }

    if (texto.length === 0) {
        $('#textoModificar').css("border-color", "red");
        $('#textoModificar').effect("shake");
        llenarNotificaciones("Revisar campos en rojo");
    } else {
        if (orden === 0 || orden==="") {
            $('#ordenModificar').css("border-color", "red");
            $('#ordenModificar').effect("shake");
            llenarNotificaciones("Revisar campos en rojo");
        } else {
            var parametros = '&c=Menus&a=modificarMenu';
            parametros += '&id_Opcion=' + id_Opcion;
            parametros += '&texto=' + texto;
            parametros += '&url=' + url;
            parametros += '&id_Padre=' + id_Padre;
            parametros += '&orden=' + orden;

            $.ajax({
                url: 'AjaxC.php',
                type: 'post',
                data: parametros,
                dataType: 'json',
                async: true,
                success: function () {
                    llenarNotificaciones("Los datos del menu " + texto.toUpperCase() + " se han modificado correctamente");

                    $('#modalModificarMenu').modal('hide');

                    location.reload();
                }
            })
        }
    }


}

function eliminarMenu(id_Opcion) {
    var primeraConfirmacion = confirm("¿Esta seguro de que desea eliminar un elemento del menu? Se eliminaran los permisos asociados.");

    if (primeraConfirmacion == true) {
        var segundaConfirmacion = confirm("¿Esta seguro?");

        if (segundaConfirmacion == true) {
            var parametros = '&c=Menus&a=eliminarMenu';
            parametros += '&id_Opcion=' + id_Opcion;
            $.ajax({
                url: 'AjaxC.php',
                type: 'post',
                data: parametros,
                dataType: 'json',
                async: true,
                success: function (menu) {
                    $('#id_Opcion').val(menu.id_Opcion_A_Eliminar);
                    llenarNotificaciones("El menu se ha eliminado correctamente");
                }
            })
        } else {
            $('#notificaciones').text("Se ha cancelado la eliminacion correctamente");
            window.setTimeout(vaciarNotificaciones, 5000);
        }
    } else {
        $('#notificaciones').text("Se ha cancelado la eliminacion correctamente");
        window.setTimeout(vaciarNotificaciones, 5000);
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