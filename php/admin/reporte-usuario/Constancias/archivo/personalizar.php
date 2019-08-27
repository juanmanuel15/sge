<?php   

require_once('../../../../bibliotecas/tcpdf/tcpdf.php');

    date_default_timezone_set('America/Mexico_City');


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

    #Título de la universidad
    
    $pdf->SetXY(90, 10);
    $pdf->Image('../Constancias/archivo/UAEM.jpg', '','' ,26 ,22 , 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
    $pdf->Ln(25);


    $pdf->SetFont('helvetica', '', 13);
    $pdf->Multicell(0,11, 'Otorga la presente:', 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(10);

    $documento = $datos['tipoDocumento'];
    $pdf->SetTextColor(149,132,25);
    $pdf->SetFont('helvetica', 'B', 40);
    $pdf->Multicell(0,40, $documento, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(25);

   

    $nombre = "A: " . $datos['alumno'];
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('timesI', 'B', 20);
    $pdf->Multicell(0,20, $nombre, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(20);

    $tActividad = "Por su participación en el " . $datos['tActividad'] . " titulado:"; 
    $pdf->SetFont('helvetica', '', 15);
    $pdf->Multicell(0,12, $tActividad, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(12);

    $titulo_del_Curso = ' "' . $datos['nombreCurso'] .'" ';
    $pdf->SetFont('timesI', 'B U I', 25);
    $pdf->Multicell(0,20, $titulo_del_Curso, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(20);

    
    $pdf->SetFont('helvetica', '', 15);
    $pdf->Multicell(0,20,'En el marco de la celebración de la', 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(8);

    $evento = $datos['tituloEvento'];
    $pdf->SetFont('helvetica', 'B', 15);
    $pdf->Multicell(0,20,'"' . $evento . '"', 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(8);


    $pdf->SetFont('helvetica', '', 15);
    $pdf->Multicell(0,20,'llevada acabo en este espacio acádemico', 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(8);


    $fechas = $datos['fechaCurso'];

    $pdf->SetFont('helvetica', '', 15);
    $pdf->Multicell(0,20,$fechas, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(20);

    $lugar = $datos['lugar'];

    $generacion = fecha_guardado($datos['fechaGeneracion']);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Multicell(0,13,$lugar . " a " . $generacion .".", 0, 'R', 0, 0, '', '', true);
    $pdf->Ln(30);

    $slogan = $datos['slogan'];
    $pdf->SetFont('helvetica', 'B', 8);
    $pdf->Multicell(0,20, '"' . $slogan . '"', 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(30);



    $nombre_director = $datos['director'];

    $pdf->SetFont('helvetica', '', 9);
    $pdf->Multicell(0,8,$nombre_director, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', 'B', 9);
    $pdf->Multicell(0,8,$nombre_director, 0, 'C', 0, 0, '', '', true);




    
    $pdf->Output('');


    function fecha_guardado($fecha){  
        $fecha = str_replace('"', '' ,$fecha );


        $fechas = explode('-' ,$fecha);

        
         return $fechas[2]. " de " . mes($fechas[1]). " del " . $fechas[0];
         
    }


    function mes($mes){
            
            switch($mes){
                case '01':
                $mes = 'Enero';
                break;
                
                case '02':
                $mes = 'Febrero';
                break;
    
                case '03':
                $mes = 'Marzo';
                break;
    
                case '04':
                $mes = 'Abril';
                break;
    
                case '05':
                $mes = 'Mayo';
                break;
    
                case '06':
                $mes = 'Junio';
                break;
                
                case '07':
                $mes = 'Julio';
                break;
    
                case '08':
                $mes = 'Agosto';
                break;
    
                case '09':
                $mes = 'Septiembre';
                break;
    
                case '10':
                $mes = 'Octubre';
                break;
    
                case '11':
                $mes = 'Noviembre';
                break;
    
                case '12':
                $mes = 'Diciembre';
                break;
    
            }

            return $mes;
        }