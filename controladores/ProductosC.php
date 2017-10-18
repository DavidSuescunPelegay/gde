<?php
require_once $_SESSION['RAIZ'] . '/controladores/Controlador.php';
require_once $_SESSION['RAIZ'] . '/vistas/Vista.php';
require_once $_SESSION['RAIZ'] . '/modelos/ProductosM.php';

class ProductosC extends Controlador
{
    private $modelo;

    public function ProductosC()
    { //constructor del objeto
        parent::Controlador(); //ejecuta el constructor padre
        $this->modelo = new ProductosM();
    }

    public function getVistaPrincipal()
    {
        $lista = $this->modelo->getProductos();
        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Productos/ProductosV.php', $lista);
    }

}