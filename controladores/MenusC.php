<?php
require_once '/controladores/Controlador.php';
require_once '/vistas/Vista.php';
require_once '/modelos/MenusM.php';

class MenusC extends Controlador
{
    private $modelo;

    public function MenusC()
    { //constructor del objeto
        parent::Controlador(); //ejecuta el constructor padre
        $this->modelo = new MenusM();
    }

    public function getVistaMenu()
    {
        $menu = $this->modelo->getDatosMenu();
        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Menu/MenuV.php', $menu);
    }

    public function getDatosMenu()
    {
        $menu = $this->modelo->getDatosMenu();
        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Menu/MenuV.php', $menu);
    }

    public function getVistaPrincipal()
    {
        $menu = $this->modelo->getDatosMenu();
        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Menu/MenuGestionV.php', $menu);
    }

    public function insertarMenu($datos)
    {
        $resultado = $this->modelo->insertarMenu($datos);
    }

    public function modificarMenu($datos)
    {
        $resultado = $this->modelo->guardarMenu($datos);
    }

    public function eliminarMenu($datos)
    {
        $resultado = $this->modelo->eliminarMenu($datos);
    }
}
