<?php
require_once $_SESSION['RAIZ'] . '/controladores/Controlador.php';
require_once $_SESSION['RAIZ'] . '/vistas/Vista.php';
require_once $_SESSION['RAIZ'] . '/modelos/PedidosM.php';

class PedidosC extends Controlador
{
    private $modelo;

    public function PedidosC()
    { //constructor del objeto
        parent::Controlador(); //ejecuta el constructor padre
        $this->modelo = new PedidosM();
    }

    public function getVistaPrincipal()
    {
        $menu = $this->modelo->getAllPedidos();

        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Pedidos/PedidosV.php', $menu);
    }

    public function busqueda($datos)
    {
        $datosParaVista = $this->modelo->busqueda($datos);

        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Pedidos/PedidosBusquedaV.php', $datosParaVista);
    }

    public function detallesPedido($datos)
    {
        $datosParaVista = $this->modelo->detallesPedido($datos);

        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Pedidos/PedidosDetallesV.php', $datosParaVista);
    }

}
