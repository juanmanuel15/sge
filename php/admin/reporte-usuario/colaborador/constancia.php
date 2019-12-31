<?php 

    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

    
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
        $respuesta = colaborador($usuario, $curso);
        
        
        if($respuesta['vacio']){            
            $constancia->error();
        }elseif($respuesta['conn']){            
            $constancia->error();
        }else{
            $success = $respuesta['success']; 
            if ($success != false){                                
                $constancia->pdf_colaborador($success);
            }else{
                $constancia->error();
            }
        }

    }else {
        $constancia->error();
    }


    
?>