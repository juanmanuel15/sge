<?php

// Include the main TCPDF library (search for installation path).
require_once('bibliotecas/tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SGEA');
$pdf->SetTitle('Ticket de Entrada');



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

    #Título del evento
    $tituloEvento = 'Título del Evento';
    $pdf->SetFont('times', 'B', 16);
    $pdf->MultiCell(0, 5, $tituloEvento, 0, 'C', 0, 1, '', '', true);

    $pdf->Ln(5);
    #Título del curso
    $pdf->SetFont('times', 'B', 12);
    $pdf->MultiCell(0, 5, $tituloCurso, 0, 'C', 0, 1, '', '', true);
    $pdf->Ln(5);
    
    $pdf->SetFont('times', 'B', 9);
    $pdf->MultiCell(80, 5, 'Nombre:', 0, 'R', 0, 0, '', '', true);
    $pdf->SetFont('times', '', 9);
    $pdf->MultiCell(0, 5, $nombreUsuario, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(10);


    #Profesores

    $pdf->SetFillColor(204, 204, 204);
    $pdf->SetFont('times', 'B', 9);
    $pdf->setCellMargins(0, 0, 0, 0);
    $pdf->setCellPaddings(1, 1, 1, 1);
    $pdf->Multicell(0, 5, 'Profesor(es)', 0, 'C', 1, 1, '', '', true);
    

    for ($i=0; $i <sizeof($profesores) ; $i++) { 

        $pdf->SetFont('times','',8);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFillColor(255, 255, 255); 
        $pdf->MultiCell(200,5, $profesores[$i], 0, 'C', 0, 1, '',  '', true );       
        
    }


    $pdf->Ln(10);
    #Horario
    $pdf->SetFillColor(204, 204, 204);
    $pdf->SetFont('times', 'B', 9);
    $pdf->setCellMargins(0, 0, 0, 0);
    $pdf->setCellPaddings(1, 1, 1, 1);
    $pdf->Multicell(0, 5, 'Horario (s)', 0, 'C', 1, 1, '', '', true);
    $pdf->SetFont('times', 'B', 8);
    $pdf->Multicell(47, 5, 'Fecha', 'B', 'C', 0, 0, '', '', true);
    $pdf->Multicell(47, 5, 'Hora de Inicio', 'B', 'C', 0, 0, '', '', true);
    $pdf->Multicell(47, 5, 'Hora de Termino', 'B', 'C', 0, 0, '', '', true);
    $pdf->Multicell(47, 5, 'Lugar', 'B', 'C', 0, 1, '', '', true);

    
    for ($i=0; $i <sizeof($horario) ; $i++) { 

        $pdf->SetFont('times','',8);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFillColor(255, 255, 255); 
        $pdf->MultiCell(47,5, $horario[$i]['fecha'], 0, 'C', 0, 0, '',  '', true );
        $pdf->MultiCell(47,5, $horario[$i]['HI'], 0, 'C', 0, 0, '',  '', true);
        $pdf->MultiCell(47,5, $horario[$i]['HF'], 0, 'C', 0, 0, '',  '', true);
        $pdf->MultiCell(47,5, $horario[$i]['lugar'], 0, 'C', 0, 1, '',  '', true);
        
    }


    


    $cadena = "$usuario&$id_curso";

// set style for barcode
$style = array(
    'border' => 0,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'bgcolor' => false,//array(204, 204, 204),
    'fgcolor' => array(0,0,0), //array(255,255,255)
    'module_width' => 5, // width of a single module in points
    'module_height' => 5 // height of a single module in points
);

$pdf->Ln(15);
$pdf->SetFont('times', 'B', 10);
//$pdf->MultiCell(0,5, 'Código para el acceso a la actividad', 0, 'C', 0, 1, '',  '', true);

$pdf->Ln(15);


// QRCODE,H : QR-CODE Best error correction

$pdf->write2DBarcode($cadena, 'QRCODE,H', 74, 200, 60, 0, $style, 'N');
$pdf->Ln(5);





//Close and output PDF document
$pdf->Output('');

//============================================================+
// END OF FILE
//============================================================+