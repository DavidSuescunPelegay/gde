<?php
session_start();

require_once $_SESSION['RAIZ'] . 'lib/PHPExcel-1.8/Classes/PHPExcel.php';

require_once $_SESSION['RAIZ'] . 'controladores/PedidosC.php';

$objPedidos = new PedidosC();
$pedidos = $objPedidos->exportToFile($_SESSION['PEDIDOS_ULTIMA_CONSULTA']);

$excel = new PHPExcel();
$excel->setActiveSheetIndex(0);
$hoja = $excel->getActiveSheet();

$hoja->setTitle('Lista de Pedidos'); //Nombre de la hoja. Maximo 33 caracteres
$hoja->setCellValue('A1', 'Listado de Pedidos');
$hoja->mergeCells('A1:B1'); //Combinar Celdas

//INICIO DISEÑO APLICADO COMO ARRAY
$cssTitular['font']['bold'] = true;
$cssTitular['font']['name'] = 'Arial';
$cssTitular['font']['size'] = 16;
$cssTitular['aligment']['horizontal'] = PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
$hoja->getStyle('A1')->applyFromArray($cssTitular);
//FIN DISEÑO APLICADO COMO ARRAY

//INICIO DISEÑO APLICADO COMO OBJETOS
$hoja->getStyle('A1')->getFont()->setBold(true)->setName('Arial')->setSize(16);
$hoja->getStyle('A1')->getAlignment(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//FIN DISEÑO APLICADO COMO OBJETOS

$hoja->getColumnDimension('A')->setAutoSize(true);
$hoja->getColumnDimension('B')->setAutoSize(true);

//Encabezado Tabla
$fi = 3;
$hoja->setCellValueByColumnAndRow(0, $fi, 'Nombre');

foreach ($pedidos as $opcion) {
    $fi++;
    $hoja->setCellValueByColumnAndRow(0, $fi, $opcion['direccion']);
}
$hoja->freezePane('A4'); //Bloquea en pantalla el panel limitado por la columna (fijar celdas)

//INICIO PREPARACION IMPRESION
$hoja->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(3, 3);
//FIN PREPARAACION IMPRESION

//INICIO TAMAÑO Y ORIENTACION
$hoja->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$hoja->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
//FIN TAMAÑO Y ORIENTACION

//IMPRIMIR A UNA PAGINA DE ANCHO Y LAS NECESARIAS DE ALTO
$hoja->getPageSetup()->setFitToPage(true);
$hoja->getPageSetup()->setFitToWidth(1);
$hoja->getPageSetup()->setFitToHeight(0);
$hoja->getPageSetup()->setPrintArea('A1:B' . ($fi + 1));

//INICIO ENCABEZADO Y PIE DE PAGINA
$hoja->getHeaderFooter()->setOddHeader('&RFundacion San Valero');
$hoja->getHeaderFooter()->setOddFooter('&L&B Listado de Pedidos');
//FIN ENCABEZADO YPIE DE PAGINA


//PAGINA 2 CON FORMULAS
$objWorkSheet = $excel->createSheet();
$excel->setActiveSheetIndex(1);
$hoja2 = $excel->getActiveSheet();
$hoja2->setCellValue('A1', '192.3');
$hoja2->setCellValue('A2', '12.34');
$hoja2->setCellValue('A3', '=SUM(A1:A2)');
$formatoEuro = iconv('Windows-1252', 'utf-8', '#,##0.00 E; [Red]-#,##0.00 E');
$hoja2->getStyleByColumnAndRow(0, 3)->getNumberFormat()->setFormatCode($formatoEuro);


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=pedidos' . date("dmy") . '.xls');
header('Cache-Control:max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$objWriter->save('php://output');