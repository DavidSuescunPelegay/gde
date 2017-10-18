function mostrarFormularioInsertar() {
    $('#divNuevoPermiso').show();

    var notificacion = "El formulario de insercion se han mostrado correctamente";
    llenarNotificaciones(notificacion);
}

function ocultarFormularioInsertar() {
    $('#divNuevoPermiso').hide();

    var notificacion = "El formulario de insercion se ha cerrado correctamente";
    llenarNotificaciones(notificacion);
}

function ocultarFormularioModificar() {
    $('#divModificarPermiso').hide();

    var notificacion = "El formulario de modificacion se ha cerrado correctamente";
    llenarNotificaciones(notificacion);
}

function insertPermiso() {
    //INICIO RECUPERACION VALORES INSERCION
    var idMenuDependeCompleto = $('#valoresIdMenuDependeInsertar').val();
    var idMenuDepende = idMenuDependeCompleto.slice(-1);//Recorta la palabra menu con slice
    var numeroPermiso = $('#numPermisoInsertar').val();
    if (numeroPermiso < 5) {//En caso de que el numero de permiso este vacio salta un error
        $('#numPermisoInsertar').css("border-color", "red");
        var notificacion = "Revisar campos en rojo";
        llenarNotificaciones(notificacion);
    }
    var textoPermiso = $('#textoPermisoInsertar').val();
    if (textoPermiso.length == 0) {//En caso de que el campo texto este vacion salta un error
        $('#textoPermisoInsertar').css("border-color", "red");
        var notificacion = "Revisar campos en rojo";
        llenarNotificaciones(notificacion);
    }
    //FIN RECUPERACION VALORES INSERCION

    var parametros = '&c=Permisos&a=insertarPermiso';
    parametros += '&id_Opcion=' + idMenuDepende;
    parametros += '&num_Permiso=' + numeroPermiso;
    parametros += '&permiso=' + textoPermiso;
    $.ajax({
        url: 'AjaxC.php',
        type: 'post',
        data: parametros,
        dataType: 'json',
        async: true,
        success: function (permiso) {
            var notificacion = "Los datos del permiso " + textoPermiso.toUpperCase() + " se han insertado correctamente";
            llenarNotificaciones(notificacion);
        }
    })

    $('#divNuevoPermiso').hide();
}

/*Funcion que se activa cuando se intenta modificar algun permiso con numero de permiso 1, 2, 3 o 4*/
function edicionProhibida() {
    var notificacion = "Los permisos de los menus con numeros del 1 al 4 no se pueden editar";
    llenarNotificaciones(notificacion);
}

/*Funcion que se activa cuando se intenta eliminar algun permiso con numero de permiso 1, 2, 3 o 4*/
function eliminacionProhibida() {
    var notificacion = "Los permisos de los menus con numeros del 1 al 4 no se pueden eliminar";
    llenarNotificaciones(notificacion);
}

function updatePermiso() {
    /*INICIO RECUPERACION VALORES*/
    var id_Permiso = $('#idPermisoModificar').val();
    var id_Menu = $('#valoresIdMenuDependeModificar').val();
    var num_Permiso = $('#numPermisoModificar').val();
    var permiso = $('#textoPermisoModificar').val();
    /*FIN RECUPERACION VALORES*/

    var parametros = '&c=Permisos&a=modificarPermiso';
    parametros += '&id_Permiso=' + id_Permiso;
    parametros += '&id_Opcion=' + id_Menu;
    parametros += '&num_Permiso=' + num_Permiso;
    parametros += '&permiso=' + permiso;

    $.ajax({
        url: 'AjaxC.php',
        type: 'post',
        data: parametros,
        dataType: 'json',
        async: true,
        success: function (permiso) {
            $('#idpermisomodificar').val(permiso.id_Permiso);
            $('#valoresIdMenuDependeModificar').val(permiso.id_Opcion);
            $('#numPermisoModificar').val(permiso.num_Permiso);
            $('#textoPermisoModificar').val(permiso.permiso);
            var notificacion = "Los datos del permiso " + textoPermiso.toUpperCase() + " se han modificado correctamente";
            llenarNotificaciones(notificacion);
        }
    })

    $('#divModificarPermiso').hide();
}

function deletePermiso(id_Permiso) {
    var primeraConfirmacion = confirm("¿Esta seguro de que desea eliminar un permiso? Si a esa opcion estan anidadas subopciones podria corromper la base de datos.");

    if (primeraConfirmacion == true) {
        var segundaConfirmacion = confirm("¿Esta seguro?");

        if (segundaConfirmacion == true) {
            var parametros = '&c=Permisos&a=eliminarPermiso';
            parametros += '&id_Permiso=' + id_Permiso;

            $.ajax({
                url: 'AjaxC.php',
                type: 'post',
                data: parametros,
                dataType: 'json',
                async: true,
                success: function (permiso) {
                    $('#id_Permiso').val(permiso.id_Permiso);
                    var notificacion = "Se ha eliminado correctamente el permiso";
                    llenarNotificaciones(notificacion);
                }
            })
        } else {
            var notificacion = "Se ha cancelado la eliminacion correctamente";
            llenarNotificaciones(notificacion);
        }
    } else {
        var notificacion = "Se ha cancelado la eliminacion correctamente";
        llenarNotificaciones(notificacion);
    }
}

/*Funcion que muestra el formulario de edicion*/
function editPermiso(id_Permiso, id_Opcion) {
    $('#idPermisoModificar').val($('#permiso' + id_Permiso).text());
    document.getElementById("valoresIdMenuDependeModificar").getElementsByTagName('option')[id_Opcion - 1].selected = 'selected';
    $('#numPermisoModificar').val($('#ordenPermiso' + id_Permiso).text());
    $('#textoPermisoModificar').val($('#textoPermiso' + id_Permiso).text());

    $('#divModificarPermiso').show();
    var notificacion = "Los campos han sido cargados en el formulario de edicion";
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
