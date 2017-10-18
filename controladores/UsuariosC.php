<?php
require_once '/controladores/Controlador.php';
require_once '/modelos/UsuariosM.php';
require_once '/vistas/Vista.php';

class UsuariosC extends Controlador{
	private $modelo;
	
	public  function UsuariosC(){ //constructor del objeto
		parent::Controlador(); //ejecuta el constructor padre
		$this->modelo=new UsuariosM();
	}
	
	public function validarUsuario($datos){
// 		$login='';
// 		$pass='';
// 		extract($datos);
		
		$validacion=$this->modelo->validarUsuario($datos);
		
// 		if($login=='javier' && $pass=='123'){
		if( !empty($validacion) ){
			$respuesta['valido']='S';
			$respuesta['msj']='';
		}else{
			$respuesta['valido']='N';
			$respuesta['msj']='Datos incorrectos';
		}
		$respuesta['datos']=$validacion;
		return $respuesta;
	}
	
	public function getVistaPrincipal(){
		$vista=new Vista();
		$vista->render('/vistas/Usuarios/UsuariosV.php');
	}
	
	public function getVistaResultadosBusqueda($datos){
		$filas=$this->modelo->findAll($datos);
		//fb::log($filas);
		$vista=new Vista();
		$vista->render('/vistas/Usuarios/UsuariosBusquedaV.php',$filas);
	}
	
	public function getDatosUsuario($datos){
		$usuario=$this->modelo->getDatosUsuarioPorId($datos['id_Usuario']);
		
		$usuario['nombre']=utf8_encode($usuario['nombre']);
		$usuario['apellido_1']=utf8_encode($usuario['apellido_1']);
		$usuario['apellido_2']=utf8_encode($usuario['apellido_2']);
		$usuario['login']=utf8_encode($usuario['login']);
		
		echo json_encode($usuario);
	}
	
	public function guardarUsuario($datos){
	
		$respuesta['correcto']='S';
		$respuesta['tipoError']='';
		if($datos['id_Usuario']==0){
			$respuesta['msj']=utf8_encode('Se a guardado el nuevo usuario.');
		}else{
			$respuesta['msj']=utf8_encode('Se han guardado los cambios del usuario.');
		}
		//comprobar que no se repite el login
		$filas=$this->modelo->findAll(array('login'=>$datos['login'],
				'loginEXACTO'=>'S', 'activo'=>''));
		if(!empty($filas) && $filas[0]['id_Usuario']!=$datos['id_Usuario']){
			$respuesta['correcto']='N';
			$respuesta['tipoError']='loginReptido';
			$respuesta['msj']=utf8_encode('Login repetido, elija otro.');
		}else{
			if($datos['id_Usuario']==0){ //nuevo
				$resul = $this->modelo->insertUsuario($datos);
				if( $resul<1 ){
					$respuesta['correcto']='N';
					$respuesta['tipoError']='errorGuardar';
					$respuesta['msj']=utf8_encode('Error al guardar.');
						
				}
			}else{ //modificacion
				if(isset($datos['pass']) && $datos['pass']!='') $datos['actualizarPass']='S';
	
				$resul = $this->modelo->updateUsuario($datos);
				if( $resul!=1 ){
					$respuesta['correcto']='N';
					$respuesta['tipoError']='errorModificar';
					$respuesta['msj']=utf8_encode('Error al modificar.');
				
				}
			}
		}
	
		echo json_encode($respuesta);
	}
	
	public function activarDesactivar($datos){
		$respuesta['correcto']='S';
		$respuesta['tipoError']='';
		if($datos['activo']=='S'){
			$respuesta['msj']=utf8_encode('Se a activado el usuario.');
		}else{
			$respuesta['msj']=utf8_encode('Se desactivado el usuario.');
		}
		$resul = $this->modelo->activarDesactivarUsuario($datos);
		if( $resul!=1 ){
			$respuesta['correcto']='N';
			$respuesta['tipoError']='errorModificar';
			$respuesta['msj']=utf8_encode('Error al cambiar el estado del usuario.');
		
		}
		echo json_encode($respuesta);
	}
}