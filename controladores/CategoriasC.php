<?php
require_once $_SESSION['RAIZ'] . 'controladores/Controlador.php';
require_once $_SESSION['RAIZ'] . 'modelos/CategoriasM.php';
require_once $_SESSION['RAIZ'] . 'vistas/Vista.php';

class CategoriasC extends Controlador
{
    private $modelo;

    public function CategoriasC()
    { //constructor del objeto
        parent::Controlador(); //ejecuta el constructor padre
        $this->modelo = new CategoriasM();
    }

    public function getVistaPrincipal()
    {
        $datos = $this->modelo->getCategorias();

        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Categorias/CategoriasV.php', $datos);
    }
}