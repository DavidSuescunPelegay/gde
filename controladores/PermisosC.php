<?php
require_once '/controladores/Controlador.php';
require_once '/vistas/Vista.php';
require_once '/modelos/PermisosM.php';

class PermisosC extends Controlador
{
    private $modelo;

    public function PermisosC()
    { //constructor del objeto
        parent::Controlador(); //ejecuta el constructor padre
        $this->modelo = new PermisosM();
    }

    public function getVistaPrincipal()
    {
        $lista = $this->modelo->getPermisos();
        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Permisos/PermisosV.php', $lista);
    }

    public function insertarPermiso($datos)
    {
        $resultado = $this->modelo->insertarPermiso($datos);
    }

    public function modificarPermiso($datos)
    {
        $resultado = $this->modelo->modificarPermiso($datos);
    }

    public function eliminarPermiso($datos)
    {
        $resultado = $this->modelo->eliminarPermiso($datos);
    }
}