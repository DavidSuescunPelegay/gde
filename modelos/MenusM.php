<?php
require_once '/modelos/Modelo.php';
require_once '/modelos/ClaseBD.php';
class MenusM extends Modelo{
	private $BD;

	public function MenusM(){
		parent::Modelo();
		$this->BD=new ClaseBD();
	}
	
	public function getDatosMenu(){
		$menu=array();
		$SQL="SELECT * FROM menus
				ORDER BY id_Opcion, id_Padre, orden";
		$res=$this->BD->executeQuery($SQL);
		
		if(!empty($res)){
			foreach ($res as $opcion){
				$id_Opcion=$opcion['id_Opcion'];
				if($opcion['id_Padre']==0){
					//padre o uno principal
					$menu[$id_Opcion]=$opcion;
				}else{
					//hijo
					$id_Padre=$opcion['id_Padre'];
					$menu[$id_Padre]['subOpciones'][$id_Opcion]=$opcion;
				}
			}
		}
		return $menu;
	}

	public function insertarMenu($datos){
        $id_Opcion='';
        $texto='';
        $url='';
        $id_Padre='';
        $orden='';

        extract($datos);

        $SQL = "INSERT INTO menus (texto, url, id_Padre, orden) VALUES ('$texto', '$url', '$id_Padre', '$orden')" ;

        $id_Opcion=$this->BD->executeInsert($SQL);
        return $id_Opcion;
    }

    public function guardarMenu($datos){
        $id_Opcion='';
        $texto='';
        $url='';
        $id_Padre='';
        $orden='';

        extract($datos);

        $SQL = "UPDATE menus SET
        texto='$texto',
        url='$url',
        id_Padre='$id_Padre',
        orden='$orden' " ;

        $SQL .= "WHERE id_Opcion='".$id_Opcion."'";

        $numFilasModificadas = $this->BD->executeUpdate($SQL);

        return $numFilasModificadas;
    }

    public function eliminarMenu($datos){
        $id_Opcion='';
        $texto='';
        $url='';
        $id_Padre='';
        $orden='';

        extract($datos);

        $SQL = "DELETE FROM menus WHERE id_Opcion='".$id_Opcion."'";

        $id_Opcion=$this->BD->executeDelete($SQL);
        return $id_Opcion;
    }
	
	
// 	public function getDatosMenu(){
// 		$menu=array(
// 			0=>array('texto'=>'Usuarios', 'url'=>'#'),
// 			1=>array('texto'=>'Productos', 'url'=>'#'),
// 			2=>array('texto'=>'Pedidos', 'url'=>'#'),
// 			3=>array('texto'=>'Personal', 'url'=>'#',
// 				'subOpciones'=>array(
// 						0=>array('texto'=>'Contratos', 'url'=>'#'),
// 						1=>array('texto'=>'Nominas', 'url'=>'#')
// 				)
// 			),
// 			4=>array('texto'=>'Administracion', 'url'=>'#',
// 				'subOpciones'=>array(
// 						0=>array('texto'=>'Facturas', 'url'=>'#'),
// 						1=>array('texto'=>'Informes', 'url'=>'#')
// 				)
// 			),
// 			5=>array('texto'=>'Ayuda', 'url'=>'#')
// 		);
// 		return $menu;
// 	}
	
	
}
