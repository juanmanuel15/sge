<?php
    
    //include('../../../base1.php');
    //include('../../../Consultas.php');
    include('../Constancias/Constancia.php');
    include('../comprobacion.php');  

    session_start();
    if(!isset($_SESSION['admin'])){
        header('Location: ../../../../admin/admin.php' );
    }

    $constancia = new Constancia();

    if(isset($_GET['nombre'], $_GET['nombreCurso'], $_GET['tituloEvento'], $_GET['tipoUsuario'])){
        
        $alumno= $_GET['nombre']; 
        $idCurso= $_GET['nombreCurso']; 
        $tituloEvento = $_GET['tituloEvento'];
        $tipoUsuario = $_GET['tipoUsuario'];
        $datosAlumno = explode('-', $alumno);
        

        $alumno = str_replace("'", "", $alumno);
        $alumno = str_replace("-", " ", $alumno);
        $idCurso = str_replace("'", "", $idCurso);
        $tituloEvento = str_replace("'", "", $tituloEvento);
        $tipoUsuario = str_replace("'", "", $tipoUsuario);

        $datos = [
            'alumno' => $alumno,
            'idCurso' => $idCurso,
            'tituloEvento' => $tituloEvento,
            'tipoUsuario' => $tipoUsuario
        ];

        $respuesta = personalizar($datos);


        if($respuesta != false){
            if(!$respuesta['conn']){
                $guardar = guardar($datosAlumno, $idCurso, $tipoUsuario);
                if(!$guardar['conn']){
                   if($guardar['success']){
                    //echo "hola";
                    $constancia->personalizar($respuesta);
                   } else{
                        $constancia->pdf_repetido();
                   }
                }else{
                    $constancia->pdf_error();
                }                
            }
        }else{
            $constancia->pdf_error();
        }

        

    }else {

        $constancia->pdf_error();

    }




?>