<?php   

require_once('../../../bibliotecas/tcpdf/tcpdf.php');


    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);


    //$curso = $_GET['curso'];


    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);


    $pdf->AddPage();

    // set cell padding
    $pdf->setCellPaddings(1, 1, 1, 1);

    // set cell margins
    $pdf->setCellMargins(1, 1, 1, 1);

    // set color for background
    $pdf->SetFillColor(255, 255, 127);

    // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

    #Título de la universidad


    $pdf->Ln(40);

    $universidad = $datos['conf']['universidad'];
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->MultiCell(0, 12, $universidad, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(8);


    

    $campus = $datos['conf']['campus'];
    $pdf->SetFont('helvetica', '', 12);
    $pdf->MultiCell(0, 5, $campus, 0, 'C', 0, 1, '', '', true);
    $pdf->Ln(5);


    $pdf->SetFont('helvetica', '', 13);
    $pdf->Multicell(0,11, 'Otorga el presente:', 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(10);

    $documento = $datos['conf']['tipo_documento'];
    $pdf->SetTextColor(149,132,25);
    $pdf->SetFont('helvetica', 'B', 40);
    $pdf->Multicell(0,40, $documento, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(25);

   

    $nombre = "A: " . $datos['usuario']['nombre'];
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('timesI', 'B', 20);
    $pdf->Multicell(0,20, $nombre, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(20);

    $tActividad = "Por su participación en el " . $datos['curso']['tActividad'] . " titulado:"; 
    $pdf->SetFont('helvetica', '', 15);
    $pdf->Multicell(0,12, $tActividad, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(12);

    $titulo_del_Curso = ' "' . $datos['curso']['titulo'] .'" ';
    $pdf->SetFont('timesI', 'B U I', 25);
    $pdf->Multicell(0,20, $titulo_del_Curso, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(20);

    
    $pdf->SetFont('helvetica', '', 15);
    $pdf->Multicell(0,20,'En el marco de la celebración de la', 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(8);

    $evento = $datos['conf']['evento'];
    $pdf->SetFont('helvetica', 'B', 15);
    $pdf->Multicell(0,20,'"' . $evento . '"', 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(8);


    $pdf->SetFont('helvetica', '', 15);
    $pdf->Multicell(0,20,'llevada acabo en este ', 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(8);


    $pdf->Output('');