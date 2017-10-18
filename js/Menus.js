function editarMenu(id_Opcion) {
    /*Rellenamos los campos del formulario con los datos de la tabla*/
    $('#id_OpcionModificar').val($('#id' + id_Opcion).text());
    $('#textoModificar').val($('#texto' + id_Opcion).text());
    $('#urlModificar').val($('#url' + id_Opcion).text());
    $('#id_PadreModificar').val($('#padre' + id_Opcion).text());
    $('#ordenModificar').val($('#orden' + id_Opcion).text());

    /*Al final se muestra el DIV con el resultado final*/
    $('#div-edicion').show();
}

function mostrarMenuInsertar() {
    $('#div-nuevo').show();
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

    $('#div-nuevo').hide();
    recargarTabla();
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

    $('#div-edicion').hide();
    recargarTabla();
}

function eliminarMenu(id_Opcion) {
    var id_Opcion_A_Eliminar = id_Opcion;

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


    recargarTabla();
}

/*Funcion que recarga el contenido de la tabla*/
function recargarTabla(){
    $("#tablaMenus").load(location.href + " #tablaMenus");
}

/*Funcion jQuery que oculta el div cuando se pulsa el boton Cerrar*/
function ocultarOpcionesInsertar() {
    $('#div-nuevo').hide();
}

/*Funcion jQuery que oculta el div cuando se pulsa el boton Cerrar*/
function ocultarOpcionesModificar() {
    $('#div-edicion').hide();
}