<?php

        
    


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
    // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
    $pdf->SetXY(90, 10);
    $pdf->Image('Constancias/archivo/UAEM.jpg', '','' ,26 ,22 , 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
    //$pdf->Image('UAEM.jpg', 15, 140, 75, 113, 'JPG', 'Holamundo.com.mx', '', true, 150, '', false, false, 1, false, false, false);
    $pdf->Ln(25);

    $pdf->Output('');
