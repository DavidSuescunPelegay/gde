<?php
require_once $_SESSION['RAIZ'] . '/modelos/Modelo.php';
require_once $_SESSION['RAIZ'] . '/modelos/ClaseBD.php';

class PedidosM extends Modelo
{
    private $BD;

    public function PedidosM()
    {
        parent::Modelo();
        $this->BD = new ClaseBD();
    }

    public function getAllPedidos()
    {
        $SQL = "SELECT usuarios.nombre, usuarios.apellido_1, pedidos.fecha_Pedido, pedidos.fecha_Almacen, pedidos.fecha_Envio, pedidos.fecha_Recibido, pedidos.fecha_Finalizado, pedidos.transporte, pedidos.direccion";
        $SQL .= " FROM usuarios, pedidos ";
        $SQL .= " WHERE usuarios.id_Usuario = pedidos.id_Usuario";
        $pedidos = $this->BD->executeQuery($SQL);
        return $pedidos;
    }

    public function busqueda($datos)
    {
        $usuario = '';
        $fechaPedido = '';
        $fechaAlmacen = '';
        $fechaEnvio = '';
        $fechaRecibido = '';
        $fechaFinalizado = '';
        $transporte = '';
        $direccion = '';
        extract($datos);

        $SQL = "SELECT pedidos.id_Pedido, usuarios.nombre, usuarios.apellido_1, pedidos.fecha_Pedido, pedidos.fecha_Almacen, pedidos.fecha_Envio, pedidos.fecha_Recibido, pedidos.fecha_Finalizado, pedidos.transporte, pedidos.direccion, SUM(pedidosdetalles.cantidad * pedidosdetalles.precio_Venta) 'suma', COUNT(pedidosdetalles.id_Pedido) 'conteo' FROM pedidos, pedidosdetalles, usuarios WHERE 1=1 ";
        if ($usuario != null) {
            $SQL .= " AND usuarios.nombre LIKE '%" . $usuario . "%'";
        }
        if ($usuario != null) {
            $SQL .= " AND usuarios.apellido_1 LIKE '%" . $usuario . "%'";
        }
        if ($fechaPedido != null) {
            $SQL .= " AND pedidos.fecha_Pedido LIKE '%" . $fechaPedido . "%'";
        }
        if ($fechaAlmacen != null) {
            $SQL .= " AND pedidos.fecha_Almacen LIKE '%" . $fechaAlmacen . "%'";
        }
        if ($fechaEnvio != null) {
            $SQL .= " AND pedidos.fecha_Envio LIKE '%" . $fechaEnvio . "%'";
        }
        if ($fechaRecibido != null) {
            $SQL .= " AND pedidos.fecha_Recibido LIKE '%" . $fechaRecibido . "%'";
        }
        if ($fechaFinalizado != null) {
            $SQL .= " AND pedidos.fecha_Finalizado LIKE '%" . $fechaFinalizado . "%'";
        }
        if ($transporte != null) {
            $SQL .= " AND pedidos.transporte LIKE '%" . $transporte . "%'";
        }
        if ($direccion != null) {
            $SQL .= " AND pedidos.direccion LIKE '%" . $direccion . "%'";
        }

        $SQL .= " AND pedidos.id_Usuario = usuarios.id_Usuario ";
        $SQL .= " AND pedidos.id_Pedido = pedidosdetalles.id_Pedido ";
        $SQL .= " GROUP BY pedidos.id_Pedido, usuarios.nombre, usuarios.apellido_1, pedidos.fecha_Pedido, pedidos.fecha_Almacen, pedidos.fecha_Envio, pedidos.fecha_Recibido, pedidos.fecha_Finalizado, pedidos.transporte, pedidos.direccion";

        $resultadoBusqueda = $this->BD->executeQuery($SQL);

        return $resultadoBusqueda;
    }

    public function detallesPedido($datos)
    {
        $id_Pedido = '';
        extract($datos);

        $SQL = "SELECT * FROM pedidosdetalles, pedidos WHERE pedidosdetalles.id_Pedido = '$id_Pedido' AND pedidosdetalles.id_Pedido=pedidos.id_Pedido";
        $resultadoBusquedaDetalle = $this->BD->executeQuery($SQL);

        return $resultadoBusquedaDetalle;
    }
}
