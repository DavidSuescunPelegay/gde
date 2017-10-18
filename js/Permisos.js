function insertPermiso() {
    //INICIO RECUPERACION VALORES INSERCION
    var idMenuDependeCompleto = $('#valoresIdMenuDependeInsertar').val();
    var idMenuDepende = idMenuDependeCompleto.slice(-1);//Recorta la palabra menu con slice
    var numeroPermiso = $('#numPermisoInsertar').val();
    if (idMenuDepende == 0) {
        $('#valoresIdMenuDependeInsertar').css("border-color", "red");
        $('#valoresIdMenuDependeInsertar').effect("shake");

        llenarNotificaciones("Revisar campos en rojo");
    } else {
        if (numeroPermiso < 5) {//En caso de que el numero de permiso este vacio salta un error
            $('#numPermisoInsertar').css("border-color", "red");
            $('#numPermisoInsertar').effect("shake");

            llenarNotificaciones("Revisar campos en rojo");
        } else {
            var textoPermiso = $('#textoPermisoInsertar').val();
            if (textoPermiso.length == 0) {//En caso de que el campo texto este vacio salta un error
                $('#textoPermisoInsertar').css("border-color", "red");
                $('#numPermisoInsertar').effect("shake");

                llenarNotificaciones("Revisar campos en rojo");
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
                    llenarNotificaciones("Los datos del permiso " + textoPermiso.toUpperCase() + " se han insertado correctamente");

                    $('#modalInsertarPermiso').modal('hide');
                }
            })
        }
    }

    location.reload();
}

/*Funcion que muestra el formulario de edicion*/
function editPermiso(id_Permiso, id_Opcion) {
    $('#idPermisoModificar').val($('#permiso' + id_Permiso).text());
    $("#valoresIdMenuDependeModificar").val(id_Opcion);
    $('#numPermisoModificar').val($('#ordenPermiso' + id_Permiso).text());
    $('#textoPermisoModificar').val($('#textoPermiso' + id_Permiso).text());

    llenarNotificaciones("Los campos han sido cargados en el formulario de edicion");
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

            llenarNotificaciones("Los datos del permiso " + permiso.toUpperCase() + " se han modificado correctamente");

            $('#modalModificarPermiso').modal('hide');
        }
    })

    location.reload();
}

/*Funcion que se activa cuando se intenta modificar algun permiso con numero de permiso 1, 2, 3 o 4*/
function edicionProhibida() {
    llenarNotificaciones("Los permisos de los menus con numeros del 1 al 4 no se pueden editar");
}

function deletePermiso(id_Permiso) {
    var primeraConfirmacion = confirm("¿Esta seguro de que desea eliminar un permiso?");

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

                    llenarNotificaciones("Se ha eliminado correctamente el permiso");
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

/*Funcion que se activa cuando se intenta eliminar algun permiso con numero de permiso 1, 2, 3 o 4*/
function eliminacionProhibida() {
    llenarNotificaciones("Los permisos de los menus con numeros del 1 al 4 no se pueden eliminar");
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
