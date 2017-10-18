<?php
require_once '/modelos/Modelo.php';
require_once '/modelos/ClaseBD.php';
class UsuariosM extends Modelo{
	private $BD;
	
	public function UsuariosM(){
		parent::Modelo();
		$this->BD=new ClaseBD();
	}
	
	public function validarUsuario($campos){
		$login='';
		$pass='';
		extract($campos);
		
		$login=addslashes($login);
		$pass=MD5($pass);
		
		$SQL="SELECT * 
				FROM usuarios
				WHERE login='".$login."' 
					AND pass='".$pass."' 
					AND activo='S' ";
		$res=$this->BD->executeQuery($SQL);
		if(sizeof($res)>0){
			return $res[0];
		}else{
			return array();
		}
	}
	
	public function findAll($filtros){
		$usuario='';
		$login='';
		$activo='S';
		$id_Usuario='';
		$loginEXACTO='N';
		extract($filtros);
		$SQL="SELECT * FROM usuarios
				WHERE 1=1 ";
		if( $usuario!=''){
			$SQL.=" AND ( nombre LIKE '%".$usuario."%' 
							OR apellido_1 LIKE '%".$usuario."%'
							OR apellido_2 LIKE '%".$usuario."%'
						) ";
		}
		if( $login!='' ){
			if($loginEXACTO=='S'){
			
				$SQL.=" AND login = '".$login."' ";
			}else{
				$SQL.=" AND login LIKE '%".$login."%' ";
			}
		}
		if( $activo!='' ){
			$SQL.=" AND activo = '".$activo."' ";
		}
		
		$SQL.=" ORDER BY apellido_1, apellido_2, nombre ";
		$filas=$this->BD->executeQuery($SQL);
		return $filas;
	}
	
	public function getDatosUsuarioPorId($id_Usuario){
		$SQL="SELECT * FROM usuarios
					WHERE id_Usuario='".$id_Usuario."' ";
		$res=$this->BD->executeQuery($SQL);
		return $res[0];
	}
	
	public function insertUsuario($datos){
		$nombre='';
		$apellido_1='';
		$apellido_2='';
		$login='';
		$pass='';
		$activo='N';
		extract($datos);
		$pass=md5($pass);
	
		$SQL="INSERT INTO usuarios SET
				nombre='$nombre',
				apellido_1='$apellido_1',
				apellido_2='$apellido_2',
				login='$login',
				pass='$pass',
				activo='$activo' ";
		$id=$this->BD->executeInsert($SQL);
		return $id;
	}
	public function updateUsuario($datos){
		$id_Usuario='';
		$nombre='';
		$apellido_1='';
		$apellido_2='';
		$login='';
		$pass='';
		$actualizarPass='N';
		$activo='N';
		extract($datos);
		$pass=md5($pass);
	
		$SQL="UPDATE usuarios SET
				nombre='$nombre',
				apellido_1='$apellido_1',
				apellido_2='$apellido_2',
				login='$login', ";
		if($actualizarPass=='S'){
			$SQL.=	"pass='$pass', ";
		}
		$SQL.=	"activo='$activo' 
				WHERE id_Usuario='".$id_Usuario."' ";
		$numFilasModificadas=$this->BD->executeUpdate($SQL);
		return $numFilasModificadas;
	}
	
	public function activarDesactivarUsuario($datos){
		$id_Usuario='';
		$activo='N';
		extract($datos);
	
		$SQL="UPDATE usuarios SET
				activo='$activo' 
				WHERE id_Usuario='".$id_Usuario."' ";
		$numFilasModificadas=$this->BD->executeUpdate($SQL);
		return $numFilasModificadas;
	}
	
	
	
	
}