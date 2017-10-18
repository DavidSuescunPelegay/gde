<?php
session_start();

//Importacion Libreria DOMPDF
require_once $_SESSION['RAIZ'] . 'lib/dompdf/dompdf_config.inc.php';

require_once $_SESSION['RAIZ'] . 'controladores/PedidosC.php';
$objPedidos = new PedidosC();
$pedidos = $objPedidos->exportToFile($_SESSION['PEDIDOS_ULTIMA_CONSULTA']);

function encabezado()
{
    $encabezado = '';
    $encabezado .= '<table style="width: 100%; border: 1px #000 solid">';
    $encabezado .= '<tr>';
    $encabezado .= '<td>Direccion</td>';
    $encabezado .= '</tr>';

    return $encabezado;
}

$html = '';
$html .= '<html>';
$html .= '<head>';
$html .= '<style type="text/css">
            @page{
                size:210mm 297mm;
                /*top, right, bottom, left*/
                margin: 30mm 15mm 20mm 30mm;
            }
            #encabezado{
                position: fixed;
                left: 0mm;
                top: -20mm;
                right: 0mm;
                height: 20mm;
            }
            #pie{
                position: fixed;
                height: 20mm;
                text-align: left;
                bottom: -20mm;
            }
          </style>';
$html .= '</head>';
$html .= '<body>';
$html .= '<div id="encabezado">';
$html .= '<table style="width: 100%">';
$html .= '<tr>';
$html .= '<td style="text-align: left; width: 30%">';
$html .= '</td>';
$html .= '</tr>';
$html .= '</table>';
$html .= '</div>';
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
        $html .= '<div style="page-break-after: always;"></div>';//Saltar una pagina
        $html .= encabezado();
        $nFilas = 0;
    }
}
$html .= '</table>';
$html .= '</body>';
$html .= '</html>';

$dompdf = new DOMPDF();
$dompdf->set_paper('a4', 'portrait');
$dompdf->load_html($html);
$dompdf->render();

$canvas = $dompdf->get_canvas();
$font = Font_Metrics::get_font("helvetica", "normal");
$canvas->page_text(530, 800, "{PAGE_NUM} / {PAGE_COUNT}", $font, 8, array(0, 0, 0));
//x,y,texto,font,size,color
$dompdf->stream('documento.pdf');