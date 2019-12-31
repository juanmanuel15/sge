<?php 

    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }s

    require_once('../../../bibliotecas/tcpdf/tcpdf.php');
    require('datos_reporte.php');

    session_start();
    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

    if(isset($_GET['id'])){     

        $id = $_GET['id'];

        $alumnos = alumno($id);
        $profesores = profesor($id);
        $curso = curso($id);
        $colaboradores = colaborador($id);

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
        $pdf->Ln(1);

        #Colaboradores
        $pdf->SetFont('times', 'B', 9);
        $pdf->MultiCell(30, 5, 'Colaborador(es): ', 0, 'R', 0, 0, '', '', true);
        $profesor = '';

        $pdf->SetFont('times', '', 8);
        for ($i=0; $i <$tamanoColaborador = sizeof($colaboradores) ; $i++) { 
            if($tamanoColaborador == 1 ){
                $profesor .= $colaboradores[$i]['nombre']. ".";
            }else {
                if ($i >= $tamanoColaborador-1) {
                    $profesor .= " " . $colaboradores[$i]['nombre']. ".";
                }else {
                    $profesor .= " " . $colaboradores[$i]['nombre']. ",";
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
        
        $pdf->Output('');

    }else {
        require('pagina/error.php');
    }


    



