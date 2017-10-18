<?php
session_start();

header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename=pedidos' . date("dmy") . '.xls');

require_once $_SESSION['RAIZ'] . 'controladores/PedidosC.php';

$objPedidos = new PedidosC();
$pedidos = $objPedidos->exportToFile($_SESSION['PEDIDOS_ULTIMA_CONSULTA']);

$html = '';
$html .= '<table>';
$html .= '<tr>';
$html .= '<td style="width: 10cm">Direccion</td>';
$html .= '</tr>';

foreach ($pedidos as $opcion) {
    $html .= '<tr>';
    $html .= '<td>' . $opcion['direccion'] . '</td>';
    $html .= '</tr>';
}
$html .= '</table>';

echo $html;