<?php
	define('HOST', '127.0.0.1');
	define('USER', 'root');
	define('PASS', '');
	define('DB', 'gde');
	
	
	class ClaseBD{
		private $conexion;
		public $SQL='';
		private $debug='N';
		
		public function ClaseBD(){
			if(isset($_SESSION['debug'])) $this->debug=$_SESSION['debug'];
			$this->conexion= new mysqli(HOST,USER,PASS,DB);
			if($this->conexion->connect_errno){
				$this->error='Error de conexión a BD: '.$this->conexion->connect_error;
				if($this->debug=='S'){
					die('Error de conexión: '.$this->conexion->connect_error);
				}else{
					die('ERROR (NO se puede conectar con la BD.)');
				}
			}
			$this->error='';
		}
		
		public function executeQuery($SQL){
			$this->SQL=$SQL;
			$res=$this->conexion->query($SQL, MYSQL_ASSOC);
			$filas=array();
			if ($this->conexion->errno) {
				$this->error='Error de consulta en BD.'.'('.$this->conexion->errno.')';
				if($this->debug=='S'){
					die('(Error en consulta: ('.$this->conexion->error.') '.$SQL);
				}else{
					die('ERROR (Consulta erronea en BD.)');
				}
			}
			while($reg=mysqli_fetch_assoc($res)){
				$filas[]=$reg;//
			}
			return $filas;
		}
		
		
		public function executeUpdate($SQL){
			$this->SQL=$SQL;
			$this->conexion->query($SQL);
			if ($this->conexion->errno){
				$this->error='Error de actualización en BD.'.'('.$this->conexion->errno.')';
				if($this->debug=='S'){
					die('(Error en actualización: ('.$this->conexion->error.') '.$SQL);
				}else{
					die('ERROR (Consulta de actualización erronea en BD.)');
				}
			}
			return $this->conexion->affected_rows;
		}
		
		public function executeInsert($SQL){
			$this->SQL=$SQL;
			$this->conexion->query($SQL);
			if ($this->conexion->errno){
				$this->error='Error de inserción en BD.'.'('.$this->conexion->errno.')';
				if($this->debug=='S'){
					die('(Error al insertar: ('.$this->conexion->error.') '.$SQL);
				}else{
					die('ERROR (Consulta de inserción en BD erronea.)');
				}
			}
			return $this->conexion->insert_id;
		}

		public function executeDelete($SQL){
			$this->SQL=$SQL;
			$this->conexion->query($SQL);
			
			if ($this->conexion->errno){ 
				$this->error='Error al borrar de la BD.'.'('.$this->conexion->errno.')';
				if($this->debug=='S'){
					die('(Error al borrar: ('.$this->conexion->error.') '.$SQL);
				}else{
					die('ERROR (Consulta de borrar en BD erronea.)');
				}
			}
			return $this->conexion->affected_rows;
		}
	}
?>