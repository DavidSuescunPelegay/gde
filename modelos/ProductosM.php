<?php
require_once $_SESSION['RAIZ'] . '/modelos/Modelo.php';
require_once $_SESSION['RAIZ'] . '/modelos/ClaseBD.php';

class ProductosM extends Modelo
{
    private $BD;

    public function ProductosM()
    {
        parent::Modelo();
        $this->BD = new ClaseBD();
    }

    public function getProductos()
    {
        $SQL="SELECT * FROM productos";

        $datos = $this->BD->executeQuery($SQL);

        return $datos;
    }

}
