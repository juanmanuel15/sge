<?php

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 050');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');



    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



// set font
$pdf->SetFont('helvetica', '', 11);

// add a page
$pdf->AddPage();

// print a message

    $tituloEvento = 'Título del Evento';
    $pdf->SetFont('times', 'B', 16);
    $pdf->MultiCell(0, 5, $tituloEvento, 0, 'C', 0, 1, '', '', true);

    $tituloCurso = "Arduino para principiantes";

    $pdf->Ln(10);

    $nombreUsuario = "Juan Manuel Hernández Contreras";

    $pdf->SetFont('times', 'B', 9);
    $pdf->MultiCell(30, 5, 'Nombre: ', 0, 'R', 0, 0, '', '', true);
    $pdf->SetFont('times', '', 9);
    $pdf->MultiCell(50, 5, $nombreUsuario, 0, 'L', 0, 0, '', '', true);
    $pdf->SetFont('times', 'B', 9);
    $pdf->MultiCell(30, 5, 'Curso: ', 0, 'R', 0, 0, '', '', true);
    $pdf->SetFont('times', '', 9);
    $pdf->MultiCell(50, 5, $tituloCurso, 0, 'L', 0, 0, '', '', true);




// set style for barcode
$style = array(
    'border' => 0,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(255,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 5, // width of a single module in points
    'module_height' => 5 // height of a single module in points
);


// QRCODE,H : QR-CODE Best error correction
$pdf->write2DBarcode('Hola Mundo', 'QRCODE,H', 80, 100, 60, 0, $style, 'N');





//Close and output PDF document
$pdf->Output('');

//============================================================+
// END OF FILE
//============================================================+