function buscar(){
	var parametros='&c=Usuarios&a=getVistaResultadosBusqueda';
	parametros+='&id_Opcion='+$('#id_Opcion').val();
	parametros+='&nombre='+$('#nombre').val();
	parametros+='&url='+$('#url').val();
	parametros+='&id_Padre='+$('#id_Padre').val();
	parametros+='&orden='+$('#orden').val();
	$.ajax({
		url:'AjaxC.php',
		type:'post',
		data: parametros,
		async: true,
		success: function(vista){
			$('#div-resultado-busqueda').html(vista);
		}
	})

	var notificacion = "El usuario/s se ha encontrado correctamente";
	llenarNotificaciones(notificacion);
}
function guardar(){
	var correcto='S';
	$('.inputRed').removeClass('inputRed')
	
	if( $('#nombre').val()=='') {
		var correcto='N';
		$('#nombre').addClass('inputRed');
	};
	if( $('#apellido_1').val()=='') {
		var correcto='N';
		$('#apellido_1').addClass('inputRed');
	};
	if( $('#login').val()=='') {
		var correcto='N';
		$('#login').addClass('inputRed');
	};
	if($('#id_Usuario').val()==0){ //nuevo 
		if( $('#pass').val()=='' || $('#repass').val()=='' || $('#pass').val()!=$('#repass').val()) {
			$('#pass').addClass('inputRed');
			$('#repass').addClass('inputRed');
			var correcto='N';
		}
	}else{//edicion
		if( $('#pass').val()!='' || $('#repass').val()!='' ){
			if( $('#pass').val()=='' || $('#repass').val()=='' || $('#pass').val()!=$('#repass').val()) {
				$('#pass').addClass('inputRed');
				$('#repass').addClass('inputRed');
				var correcto='N';
			}
		}
	}
	if(correcto=='S'){
		//Tendriamos que comprobar los campos...
		var parametros='&c=Usuarios&a=guardarUsuario';
		parametros+='&'+$('#formularioEdicion').serialize();
		$.ajax({
			url:'AjaxC.php',
			type:'post',
			data: parametros,
			dataType:'json',
			async: true,
			success: function(respuesta){
				alert(respuesta.msj);
				if(respuesta.correcto=='S'){
					$('#div-edicion').hide();
				}else{
					if(respuesta.tipoError='loginRepetido'){
						$('#login').addClass('inputRed');
					}
				}
			}
		})
	}else{
		alert('NO se ha podido guardar. Revise los campos en rojo;')
	}

	var notificacion = "El usuario se ha guardado correctamente";
	llenarNotificaciones(notificacion);
}


function nuevoEditar(id_Usuario){
	if(id_Usuario==0){ //nuevo
		$('#div-edicion').show();
		$('#id_Usuario').val('0');
		$('#nombre').val('');
		$('#apellido_1').val('');
		$('#apellido_2').val('');
		$('#login').val('');
		$('#pass').val('');
		$('#repass').val('');
		$('#activo').val('S');
	}else{ //editar
		var parametros='&c=Usuarios&a=getDatosUsuario';
		parametros+='&id_Usuario='+id_Usuario;
		$.ajax({
			url:'AjaxC.php',
			type:'post',
			data: parametros,
			dataType:'json',
			async: true,
			success: function(usuario){
				$('#id_Usuario').val(usuario.id_Usuario);
				$('#nombre').val(usuario.nombre);
				$('#apellido_1').val(usuario.apellido_1);
				$('#apellido_2').val(usuario.apellido_1);
				$('#login').val(usuario.login);
				$('#pass').val('');
				$('#repass').val('');
				$('#activo').val(usuario.activo);
				$('#div-edicion').show();
			}
		})
	}

	var notificacion = "Los datos del usuario se han cargado correctamente en el formulario. Pulsa otra vez para que te lleve al formulario de abajo.";
	llenarNotificaciones(notificacion);
}

function activar(activo, id_Usuario){
	var parametros='&c=Usuarios&a=activarDesactivar';
	parametros+='&id_Usuario='+id_Usuario;
	parametros+='&activo='+activo;
	$.ajax({
		url:'AjaxC.php',
		type:'post',
		data: parametros,
		dataType:'json',
		async: true,
		success: function(respuesta){
			alert(respuesta.msj);
			if(respuesta.correcto=='S'){
				buscar();
			}
		}
	})
}


/*Funcion que establece las notificaciones*/
function llenarNotificaciones(notificacionAMostrar){
	var textoAMostrar = notificacionAMostrar;
	$('#notificaciones').text(textoAMostrar);
	window.setTimeout(vaciarNotificaciones, 5000);
}

/*Funcion que vacia la caja de notificaciones*/
function vaciarNotificaciones() {
	var vacio = "";
	$('#notificaciones').text(vacio);
}