<?php
require_once $_SESSION['RAIZ'] . 'modelos/Modelo.php';
require_once $_SESSION['RAIZ'] . 'modelos/ClaseBD.php';

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
        $SQL="SELECT productos.producto, productos.descripcion, categorias.categoria, productos.stock, productos.precio_Compra, productos.precio_Venta, productos.cantidad_Vendida, productos.cantidad_Minima FROM productos, categorias ";
        $SQL .= "WHERE productos.id_Categoria = categorias.id_Categoria";

        $datos = $this->BD->executeQuery($SQL);

        return $datos;
    }

}
