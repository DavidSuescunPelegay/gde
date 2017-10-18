<?php
require_once $_SESSION['RAIZ'] . '/modelos/Modelo.php';
require_once $_SESSION['RAIZ'] . '/modelos/ClaseBD.php';

class CategoriasM extends Modelo
{
    private $BD;

    public function CategoriasM()
    {
        parent::Modelo();
        $this->BD = new ClaseBD();
    }

    public function getCategorias()
    {
        $SQL = "SELECT * FROM categorias";
        $pedidos = $this->BD->executeQuery($SQL);
        return $pedidos;
    }

}
