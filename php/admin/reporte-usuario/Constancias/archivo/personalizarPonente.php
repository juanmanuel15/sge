<?php   

require_once('../../../../bibliotecas/tcpdf/tcpdf.php');

    date_default_timezone_set('America/Mexico_City');


    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    $conf = $datos['res']['conf'];
    $curso = $datos['res']['curso'];
    $nombre = $datos['res']['usuario'];

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
    $pdf->Image('../Constancias/archivo/UAEM.jpg', '','' ,26 ,22 , 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
    //$pdf->Image('UAEM.jpg', 15, 140, 75, 113, 'JPG', 'Holamundo.com.mx', '', true, 150, '', false, false, 1, false, false, false);
    $pdf->Ln(25);

    $universidad = $conf['universidad'];
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->MultiCell(0, 12, $universidad, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(8);

    $campus = $conf['campus'];
    $pdf->SetFont('helvetica', '', 12);
    $pdf->MultiCell(0, 5, $campus, 0, 'C', 0, 1, '', '', true);
    $pdf->Ln(5);


    $pdf->SetFont('helvetica', '', 13);
    $pdf->Multicell(0,11, 'Otorga la presente:', 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(10);

    $documento = $conf['tipo_documento'];
    $pdf->SetTextColor(149,132,25);
    $pdf->SetFont('helvetica', 'B', 40);
    $pdf->Multicell(0,40, $documento, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(25);

   

    $nombre = "A: " . $nombre;
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('timesI', 'B', 20);
    $pdf->Multicell(0,20, $nombre, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(20);

    $tActividad = "Por impartir " . adjetivo($curso['tipoActividad']) . " " .$curso['tipoActividad'] . " titulado:";  
    $pdf->SetFont('helvetica', '', 15);
    $pdf->Multicell(0,12, $tActividad, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(12);

    $titulo_del_Curso = ' "' . $curso['titulo'] .'" ';
    $pdf->SetFont('timesI', 'B U I', 25);
    $pdf->Multicell(0,20, $titulo_del_Curso, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(20);

    
    $pdf->SetFont('helvetica', '', 15);
    $pdf->Multicell(0,20,'En el marco de la celebración de la', 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(8);

    $tituloEvento = $conf['tituloEvento'];
    $pdf->SetFont('helvetica', 'B', 15);
    $pdf->Multicell(0,20,'"' . $tituloEvento . '"', 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(8);


    $pdf->SetFont('helvetica', '', 15);
    $pdf->Multicell(0,20,'llevada acabo en este espacio acádemico los dias', 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(8);


    $fechas = cursoDias($datos['res']). " del año en curso.";

    $pdf->SetFont('helvetica', '', 15);
    $pdf->Multicell(0,20,$fechas, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(20);

    $lugar = $conf['ubicacion'];
    $generacion = fecha_guardado($datos['res']);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Multicell(0,13,$lugar . " a " . $generacion .".", 0, 'R', 0, 0, '', '', true);
    $pdf->Ln(30);

    $slogan = $conf['slogan'];
    $pdf->SetFont('helvetica', 'B', 8);
    $pdf->Multicell(0,20, '"' . $slogan . '"', 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(30);



    $nombre_director = $conf['nombreDirector'];
    $director = $conf['director'];

    $pdf->SetFont('helvetica', '', 9);
    $pdf->Multicell(0,8,$nombre_director, 0, 'C', 0, 0, '', '', true);
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', 'B', 9);
    $pdf->Multicell(0,8,$director, 0, 'C', 0, 0, '', '', true);
   
    $pdf->Output($datos['res']['usuario']);

    function cursoDias($datos){
        $texto = '';

        for ($i=0; $i < sizeof($datos['fechas']) ; $i++) { 
            $fechas [] = explode('-' ,$datos['fechas'][$i]['fecha']);
        }
    
        
        for ($j=0; $j < sizeof($fechas); $j++) { 
            $ano [] = $fechas[$j][0];
            $mes [] = mes($fechas[$j][1]); 
            $dia [] = $fechas[$j][2];
        }

        for ($k=0; $k < sizeof($ano) ; $k++) { 
            if($k == 0){
                $texto .= "$dia[$k]";
            }elseif($k == sizeof($dia)-1){
                $texto .= " y $dia[$k]";
            }else{
                $texto .= ", $dia[$k]";
            }
    
    
            if($k == sizeof($mes)-1){
                $texto .= " de $mes[$k]";
            }else {
                if($mes[$k] != $mes[$k+1]){
                    $texto .= " de  $mes[$k]";
                }
            }        
            
        }
    
    
        return $texto;




    }

    function fecha_guardado($datos){

        

        for ($i=0; $i < sizeof($datos['fechas']) ; $i++) { 
            $fechas [] = explode('-' ,$datos['fechas'][$i]['fecha']);
        }

        $fechas = array_reverse($fechas);
    
        
        for ($j=0; $j < sizeof($fechas); $j++) { 
            $ano [] = $fechas[$j][0];
            $mes [] = mes($fechas[$j][1]); 
            $dia [] = $fechas[$j][2];
        }



        return $dia[0]. " de " . $mes[0]. " del " . $ano[0];




        

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

        function adjetivo($tipoActividad){
            $tipoActividad = strtolower($tipoActividad);
            switch($tipoActividad){
                case 'curso':
                    $adjetivo = 'el';
                    break;
                case 'asesoria':
                    $adjetivo = 'la';
                    break;
                case 'campamento':
                    $adjetivo = 'el';
                    break;
                case 'taller':
                    $adjetivo = 'el';
                    break;
                case 'cine club':
                    $adjetivo = 'el';
                    break;
                case 'concurso':
                    $adjetivo = 'el';
                    break;
                case 'conferencia':
                    $adjetivo = 'la';
                    break;
                case 'concierto':
                    $adjetivo = 'el';
                    break;
                case 'exhibición':
                    $adjetivo = 'la';
                    break;
                case 'exposicion de carteles':
                    $adjetivo = 'la';
                    break;
                case 'feria':
                    $adjetivo = 'la';
                    break;
                case 'generador de ideas':
                    $adjetivo = 'el';
                    break;
                case 'kermes':
                    $adjetivo = 'la';
                    break;
                case 'maratón de conocimientos':
                    $adjetivo = 'el';
                    break;
                case 'la':
                    $adjetivo = 'mesa redonda';
                    break;
                case 'obra de teatro':
                    $adjetivo = 'la';
                    break;
                case 'presentación de libros':
                    $adjetivo = 'la';
                    break;
                case 'simulador':
                    $adjetivo = 'el';
                    break;
                case 'torneo':
                    $adjetivo = 'el';
                    break;
                default:
                    $adjetivo = "el (la)";
                    break;
            }       

            return $adjetivo;

        }



    