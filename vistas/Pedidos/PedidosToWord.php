<?php
session_start();

function encabezado()
{
    $encabezado = '';
    $encabezado .= '<table style="width: 100%; border: 1px #000 solid">';
    $encabezado .= '<tr>';
    $encabezado .= '<td>Direccion</td>';
    $encabezado .= '</tr>';

    return $encabezado;
}

header('Content-Type: application/word');
header('Content-Disposition: attachment; filename=usuarios' . date("dmy") . '.doc');

require_once $_SESSION['RAIZ'] . 'controladores/PedidosC.php';

$objPedidos = new PedidosC();
$pedidos = $objPedidos->exportToWord($_SESSION['PEDIDOS_ULTIMA_CONSULTA']);

$html = '';
$html .= '<html xmlns:w="urn:schemas-microsoft-com:office:word">';
$html .= '<head>';
$html .= '<style type="text/css">
            @page{
                size:210mm 297mm;
                /*top, right, bottom, left*/
                margin: 27mm 10mm 15mm 30mm;
                
                mso-header: e1;
                mso-footer: f1;
            }
            @page section1{
            
            }
            #e1, #f1{
                mso-pagination: widow-orphan;
                margin: 0cm 0cm 0cm 22cm; /*a 22cm para que este fuera de la pagina*/
            }
            p.msoFooter{
                margin-top: -10mm;
                tab-stops: right 16cm;
                border-top: 1px solid black;
            }
            .saltoPagina{
                page-break-after: always;
            }
            div.section1{
                page:section1;
            }
            .title{
                font-weight: bold;
                font-size: 14pt;
                font-family: "Arial";
                text-align: center;
            }
          </style>';
$html .= '</head>';
$html .= '<body>';
$html .= '<div class="section1">';
$html .= '<p class="title">LISTADO DE PEDIDOS</p>';
$html .= encabezado();
$nFilas = 0;
foreach ($pedidos as $opcion) {
    $nFilas++;
    if ($nFilas % 2 == 0) {
        $estilo = '';
    } else {
        $estilo = 'style = "background-color: silver"';
    }
    $html .= '<tr ' . $estilo . '>';
    $html .= '<td>' . $opcion['direccion'] . '</td>';
    $html .= '</tr>';

    /*Para paginar la tabla*/
    if ($nFilas > 30) {
        $html .= '</table>';
        $html .= '<br clear="all" class="saltoPagina">';//Saltar una pagina
        $html .= encabezado();
        $nFilas = 0;
    }
}
$html .= '</table>';

$html .= '<div style="mso-element:header" id="e1" name="e1">';
$html .= 'Esto es un encabezado';
$html .= '</div>';

$html .= '<div style="mso-element:footer" id="f1" name="f1">';
$html .= '<p class="msoFooter">';
$html .= 'Esto es un pie';
$html .= '<span style="mso-tab-count: 1">';
$html .= 'Pagina <span style="mso-field-code:PAGE"></span> de <span style="mso-field-code:NUMPAGES"></span>';
$html .= '</span>';
$thml .= '</p>';
$html .= '</div>';

$html .= '</div>';
$html .= '</body>';
$html .= '</html>';
echo $html;