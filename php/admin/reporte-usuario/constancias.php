<?php 

    require_once('../../../bibliotecas/tcpdf/tcpdf.php');
    //include('constancias/Procesar.php');
    include('Constancias/Constancia.php');
    include('comprobacion.php');

    session_start();
    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

    if(isset($_GET['curso']) && isset($_GET['usuario'])){  
        
        $curso = $_GET['curso'];
        $usuario = $_GET['usuario'];       

        $usuario = str_replace("'", "", $usuario);
        $curso = str_replace("'", "", $curso);

        $constancia = new Constancia();
        $respuesta = alumno($usuario, $curso);
        
        
        
        if($respuesta['vacio']){            
            $constancia->error();
        }elseif($respuesta['conn']){            
            $constancia->error();
        }else{
            $success = $respuesta['success']; 
            
            //print_r($success['conf'][0]['universidad']);
            if($success['sin_asistencia']){                
                $constancia->warnning();
            }elseif($success['mas_asistencia']){                
                $constancia->warnning();
            }elseif ($success['porcentaje']){                                
                $constancia->pdf_alumno($success);
            }
        }

    }else {
        $constancia->error();
    }


    
?>


