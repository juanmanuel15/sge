<?php

	session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

	require('../../../fpdf/fpdf.php');
	require('datos_reporte.php');
	$id = $_GET['id'];

	$alumnos = alumno($id);
	$profesores = profesor($id);
	$curso = curso($id);

	//print_r($alumnos);


	//print_r($curso['titulo']);

	

	$fpdf = new FPDF ();
	$fpdf->AddPage('portrait', 'letter');


	#Titulo del evento
	$fpdf->SetFont('Arial','B',14);
	$fpdf->Cell(0, 5, utf8_decode('Título del Evento'),0,1,'C');
	$fpdf->Ln(10);

	#Titulo del curso
	$fpdf->SetFont('Arial','',12);
	$fpdf->Cell(0,5, $curso['titulo'], 0, 1, 'C');
	$fpdf->SetFont('Arial','',8);
	$fpdf->Ln(10);

	#Nombre de los profesores
	$fpdf->SetFont('Arial','B',8);
	$fpdf->SetFillColor(204, 204, 204);
	$fpdf->Cell(0,5, 'Profesor (es):',1,1, 'C', true);
	
	
	for ($i=0; $i <sizeof($profesores) ; $i++) { 

		$fpdf->SetFont('Arial','',7);
		$fpdf->SetTextColor(0,0,0);
		$fpdf->SetFillColor(255, 255, 255);
		$fpdf->Cell(0,5, utf8_decode($profesores[$i]['nombre']),1,1, 'C', true);
	}

	$fpdf->Ln(5);


	#Cabecera de los alumnos
	$fpdf->SetFont('Arial','B',8);
	$fpdf->SetTextColor(0,0,0);
	$fpdf->SetFillColor(204, 204, 204);
	$fpdf->Cell(10,5, '#',1,0, 'C', true);
	$fpdf->Cell(0,5, 'Nombre del alumno',1,0, 'C', true);
	$fpdf->Cell(-20,5, utf8_decode('N° Cuenta'), 1, 1, 'C');


	for ($i=0; $i <sizeof($alumnos) ; $i++) { 

		$fpdf->SetFont('Arial','',7);
		$fpdf->SetTextColor(0,0,0);
		$fpdf->SetFillColor(255, 255, 255);
		$fpdf->Cell(10,5, $i+1 ,1,0, 'C', true);
		$fpdf->Cell(0,5, utf8_decode($alumnos[$i]['nombre']),1,0, 'I', true);
		$fpdf->Cell(-20,5, $alumnos[$i]['cuenta'], 1, 1, 'C');
	}
	
	$fpdf->Output();
	
	


?>