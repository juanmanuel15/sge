<?php 

    
    //include('constancias/Procesar.php');
    include('../Constancias/Constancia.php');    
    include('../comprobacion.php');

    session_start();
    if(!isset($_SESSION['admin'])){
        header('Location: ../../../../admin/admin.php' );
    }

    if(isset($_GET['id'])){  
        
       $id = $_GET['id'];       

       $id = str_replace("'", "", $id);

        $constancia = new Constancia();
        $respuesta = editar($id);
        
        if($respuesta['conn']){            
            $constancia->error();
        }else{
            $success = $respuesta['success']; 
            if ($success != false){                                
                $constancia->pdf_editar($success);
            }else{
                $constancia->error();
            }
        }

    }else {
        $constancia->error();
    }


    
?>