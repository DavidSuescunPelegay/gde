function mostrarMenuInsertar() {
    $('#div-nuevo').show();

    var notificacion = "Completa los campos para agregar un nuevo menu";
    llenarNotificaciones(notificacion);
}

function insertMenu() {
    var id_Opcion = $('#id_OpcionInsertar').val();
    var texto = $('#textoInsertar').val();
    var url = $('#urlInsertar').val();
    var id_Padre_Completo = $('#valoresIdPadreInsertar').val();
    var id_Padre = id_Padre_Completo.slice(-1);//Recorta la palabra padre con slice
    var orden = $('#ordenInsertar').val();

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
        success: function (menu) {
            $('#id_OpcionInsertar').val(menu.id_Opcion);
            $('#textoInsertar').val(menu.texto);
            $('#urlInsertar').val(menu.url);
            $('#valoresIdPadreInsertar').val(menu.id_Padre);
            $('#ordenInsertar').val(menu.orden);
            $('#div-nuevo').show();
        }
    })

    var notificacion = "Los datos del menu " + texto.toUpperCase() + " se han insertado correctamente";
    llenarNotificaciones(notificacion);

    $('#div-nuevo').hide();
}

function editarMenu(id_Opcion, id_Padre) {
    /*Si el id_Padre es undefined se pasa a 0*/
    if (id_Padre == null) {
        id_Padre = 0;
    }
    /*Rellenamos los campos del formulario con los datos de la tabla*/
    $('#id_OpcionModificar').val($('#id' + id_Opcion).text());
    $('#textoModificar').val($('#texto' + id_Opcion).text());
    $('#urlModificar').val($('#url' + id_Opcion).text());
    document.querySelector('#valoresIdPadreModificar [value="' + id_Padre + '"]').selected = true;//Sentencia que recupera el valor del select-option
    $('#ordenModificar').val($('#orden' + id_Opcion).text());

    /*Al final se muestra el DIV con el resultado final*/
    $('#div-edicion').show();

    var notificacion = "Los campos han sido cargados en el formulario de edicion";
    llenarNotificaciones(notificacion);
}

function updateMenu() {
    var id_Opcion = $('#id_OpcionModificar').val();
    var texto = $('#textoModificar').val();
    var url = $('#urlModificar').val();
    var id_Padre_Completo = $('#valoresIdPadreModificar').val();
    var id_Padre = id_Padre_Completo.slice(-1);//Recorta la palabra padre con slice
    var orden = $('#ordenModificar').val();

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
        success: function (menu) {
            $('#id_OpcionModificar').val(menu.id_Opcion);
            $('#textoModificar').val(menu.texto);
            $('#urlModificar').val(menu.url);
            $('#valoresIdPadreModificar').val(menu.id_Padre);
            $('#ordenModificar').val(menu.orden);
            $('#div-edicion').show();
        }
    })

    var notificacion = "Los datos del menu " + texto.toUpperCase() + " se han modificado correctamente";
    llenarNotificaciones(notificacion);

    $('#div-edicion').hide();
}

function eliminarMenu(id_Opcion) {
    var id_Opcion_A_Eliminar = id_Opcion;

    var primeraConfirmacion = confirm("¿Esta seguro de que desea eliminar un elemento del menu? Si a esa opcion estan anidadas subopciones podria corromper la base de datos.");

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
                }
            })
        } else {
            var textoAMostrar = "Se ha cancelado la eliminacion correctamente";
            $('#notificaciones').text(textoAMostrar);
            window.setTimeout(vaciarNotificaciones, 5000);
        }
    } else {
        var textoAMostrar = "Se ha cancelado la eliminacion correctamente";
        $('#notificaciones').text(textoAMostrar);
        window.setTimeout(vaciarNotificaciones, 5000);
    }

    var notificacion = "El menu se ha eliminado correctamente";
    llenarNotificaciones(notificacion);
}

/*Funcion que establece las notificaciones*/
function llenarNotificaciones(notificacionAMostrar) {
    var textoAMostrar = notificacionAMostrar;
    $('#notificaciones').text(textoAMostrar);
    window.setTimeout(vaciarNotificaciones, 5000);
}

/*Funcion que vacia la caja de notificaciones*/
function vaciarNotificaciones() {
    var vacio = "";
    $('#notificaciones').text(vacio);
}

/*Funcion jQuery que oculta el div cuando se pulsa el boton Cerrar*/
function ocultarOpcionesInsertar() {
    $('#div-nuevo').hide();

    var textoAMostrar = "Formulario Insertar ocultado correctamente";
    $('#notificaciones').text(textoAMostrar);
    window.setTimeout(vaciarNotificaciones, 5000);
}

/*Funcion jQuery que oculta el div cuando se pulsa el boton Cerrar*/
function ocultarOpcionesModificar() {
    $('#div-edicion').hide();

    var textoAMostrar = "Formulario Modificar ocultado correctamente";
    $('#notificaciones').text(textoAMostrar);
    window.setTimeout(vaciarNotificaciones, 5000);
}