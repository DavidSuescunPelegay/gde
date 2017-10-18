<?php
require_once '/controladores/Controlador.php';
require_once '/vistas/Vista.php';
require_once '/modelos/MenusM.php';

class MenusC extends Controlador{
	private $modelo;
	
	public  function MenusC(){ //constructor del objeto
		parent::Controlador(); //ejecuta el constructor padre
		$this->modelo=new MenusM();
	}
	
	public function getVistaMenu(){
		$menu=$this->modelo->getDatosMenu();
		$vista=new Vista();
		$vista->render('/vistas/Menu/MenuV.php', $menu);
	}

    public function getVistaPrincipal(){
        $filas=$this->modelo->getDatosMenu();
        $vista=new Vista();
        $vista->render('/vistas/Menu/MenuGestionV.php', $filas);
    }

    public function getVistaResultadosBusqueda($datos){
        $filas=$this->modelo->findAll($datos);
        //fb::log($filas);
        $vista=new Vista();
        $vista->render('/vistas/Menu/MenuV.php',$filas);
    }

    public function getDatosMenu($datos){
        $menu=$this->modelo->getDatosMenuGestionPorId($datos['id_Opcion']);
        $menu['text']=utf8_encode($menu['texto']);
        $menu['url']=utf8_encode($menu['url']);
        $menu['id_Padre']=utf8_encode($menu['id_Padre']);
        $menu['orden']=utf8_encode($menu['orden']);

        echo json_encode($menu);
    }
}