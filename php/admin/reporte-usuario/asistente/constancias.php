<?php 

    
    //include('constancias/Procesar.php');
    include('../Constancias/Constancia.php');
    include('../comprobacion.php');

    session_start();
    if(!isset($_SESSION['admin'])){
        header('Location: ../../../../admin/admin.php' );
    }

    if(isset($_GET['curso']) && isset($_GET['usuario'])){  
        
        $curso = $_GET['curso'];
        $usuario = $_GET['usuario'];       

        $usuario = str_replace("'", "", $usuario);
        $curso = str_replace("'", "", $curso);

        $constancia = new Constancia();
       $respuesta = alumno($usuario, $curso);
        
        //var_dump()
        if($respuesta['vacio']){            
            $constancia->error();
        }elseif($respuesta['conn']){            
            $constancia->error();
        }else{
            $success = $respuesta['success']; 
            //var_dump($success['porcentaje']);
            if($success['sin_asistencia'] || $success['mas_asistencia']){                
                $constancia->warnning();
            }elseif ($success['porcentaje']){                                
                $constancia->pdf_alumno($success);
            }else{
                $constancia->porcentaje();
            }
        }

    }else {
        $constancia->error();
    }


    
?>


