<?php
session_start();

require_once $_SESSION['RAIZ'] . 'lib/fpdf181/fpdf.php';

require_once $_SESSION['RAIZ'] . 'controladores/PedidosC.php';
$objPedidos = new PedidosC();
$pedidos = $objPedidos->exportToFile($_SESSION['PEDIDOS_ULTIMA_CONSULTA']);

class PDF extends FPDF
{
    function encabezadoTabla($y)
    {
        $this->SetXY(20, $y);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(175, 5, 'Direccion Completa', 1, 0, 'L', 0);
    }

    function Header()
    {
        $this->Image('../../images/userdefault.png', 20, 8, 0, 10, 'png', 'http://www.svalero.com');
        $this->SetFont('Times', 'B', 8);
        $this->SetXY(120, 10);
        $this->Cell(80, 10, 'Desarrollo de Interfaces. 2SI (2016/2017)', 0, 0, 'R');
    }

    function Footer()
    {
        $this->SetY(-10);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(180, 0, 'Pagina ' . $this->PageNo() . ' / {nb}', 0, 0, 'R');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();//Necesario para visualizar el numero de paginas
$pdf->SetAutoPageBreak(false);
$pdf->SetMargins(20, 30, 10);
$pdf->AddPage('P');

$pdf->SetXY(20, 35);
$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(70, 10, 'LISTADO DE PEDIDOS', 0, 1, 'L', 0);

$pdf->SetXY(20, 55);
$pdf->encabezadoTabla(55);
$pdf->SetXY(20, 60);
$pdf->SetFont('Arial', '', 8);
$nFil = 0;
foreach ($pedidos as $opcion) {
    $html = $opcion['direccion'];

    //$pdf->Cell(40, 5, $html, '1', 1, 'L');

    $y = $pdf->GetY();
    $pdf->MultiCell(175, 5, $html, 1, 'L');
    $yy = $pdf->GetY();

    $pdf->SetX(20);

    if ($pdf->GetY() >= 266) {
        $pdf->AddPage('P');
        $pdf->SetXY(20, 35);
        $pdf->encabezadoTabla(35);
        $pdf->SetXY(20, 40);
        $pdf->SetFont('Arial', '', 8);
    }
}

$pdf->Output();