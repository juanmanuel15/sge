<?php 

    require_once('../../../bibliotecas/tcpdf/tcpdf.php');
    require('datos_reporte.php');

    $id = $_GET['id'];

	$alumnos = alumno($id);
	$profesores = profesor($id);
	$curso = curso($id);

    $horario = horario($id);

    //print_r($horario);



    // create new PDF document
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);



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

    #Título del evento
    $tituloEvento = 'Título del Evento';
    $pdf->SetFont('times', 'B', 16);
    $pdf->MultiCell(0, 5, $tituloEvento, 0, 'C', 0, 1, '', '', true);


    #Título del curso
    $tituloCurso = $curso['titulo'];
    $pdf->SetFont('times', 'B', 12);
    $pdf->MultiCell(0, 5, $tituloCurso, 0, 'C', 0, 1, '', '', true);
    $pdf->Ln(5);
    

    #Profesores 
    $pdf->SetFont('times', 'B', 9);
    $pdf->MultiCell(30, 5, 'Profesor(es): ', 0, 'R', 0, 0, '', '', true);
    $profesor = '';

    $pdf->SetFont('times', '', 8);
    for ($i=0; $i <$tamanoProfesor = sizeof($profesores) ; $i++) { 
    	if($tamanoProfesor == 1 ){
    		$profesor .= $profesores[$i]['nombre']. ".";
    	}else {
    		if ($i >= $tamanoProfesor-1) {
    			$profesor .= " " . $profesores[$i]['nombre']. ".";
    		}else {
    			$profesor .= " " . $profesores[$i]['nombre']. ",";
    		}
    	}
    	
    }


    $pdf->MultiCell(0,5, $profesor, 0, 'C', 0, 1, '', '', true);
    $pdf->Ln(5);

    #Horario
    $pdf->SetFillColor(204, 204, 204);
    $pdf->SetFont('times', 'B', 9);
    $pdf->setCellMargins(0, 0, 0, 0);
    $pdf->setCellPaddings(1, 1, 1, 1);
    $pdf->Multicell(0, 5, 'Horario', 0, 'C', 1, 1, '', '', true);
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

    $pdf->Ln(10);



    #Alumnos
    $pdf->SetFillColor(204, 204, 204);
    $pdf->SetFont('times', 'B', 9);    
    $pdf->Multicell(10, 5, '#', 1, 'C', 1, 0, '', '', true);    
    $pdf->Multicell(40, 5, 'N° de Cuenta', 1, 'C', 1, 0, '', '', true);
    $pdf->Multicell(120, 5,'Nombre del Alumno', 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(20,5, 'Asistencia', 1, 'C', 1, 1, '',  '', true);

    for ($i=0; $i <sizeof($alumnos) ; $i++) { 

		$pdf->SetFont('times','',8);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->MultiCell(10,5, $i+1, 1, 'C', 0, 0, '', '', true); 
		$pdf->MultiCell(40,5, $alumnos[$i]['cuenta'], 1, 'L', 0, 0, '',  '', true );
		$pdf->MultiCell(120,5, $alumnos[$i]['nombre'], 1, 'L', 0, 0, '',  '', true);
		$pdf->MultiCell(20,5, '', 1, 'C', 0, 1, '',  '', true);
		
	}



// set style for barcode
$style = array(
    'border' => true,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

// write RAW 2D Barcode

$code = '111011101110111,010010001000010,010011001110010,010010000010010,010011101110010';
$pdf->write2DBarcode($code, 'RAW', 80, 30, 30, 20, $style, 'N');

    /*// set style for barcode
    $style = array(
        'border' => 2,
        'vpadding' => 'auto',
        'hpadding' => 'auto',
        'fgcolor' => array(0,0,0),
        'bgcolor' => false, //array(255,255,255)
        'module_width' => 1, // width of a single module in points
        'module_height' => 1 // height of a single module in points
    );



    // QRCODE,H : QR-CODE Best error correction
    $pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,H', 20, 210, 50, 50, $style, 'N');
    $pdf->Text(20, 205, 'QRCODE H');*/

    


$pdf->Output('');
