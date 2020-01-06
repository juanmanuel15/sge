<?php

    
    include ('../../../Buscar.php');
    include ('../../../Consultas.php');
    include ('../../../base1.php');

    header("Content-Type: text/html;charset=utf-8");
    $base = new ConexionBase();
    $consulta = new Consultas();

    if(!isset($_POST['asistencia']) || !isset($_POST['id'])){
        $servidor = true;
        
        
    }else{
        $servidor = false;
        
        $asistencia = $_POST['asistencia'];
        $id_ = $_POST['id'];

        if(is_array($asistencia) && is_array($id_) && sizeof($asistencia) == sizeof($id_)){
            
            $conexion = $base->conectar();

            if($conexion != true){
                $conexion = true;
            }else{

                $conexion = false;
                $success = [];
            
                for($i =0; $i< sizeof($asistencia) / 2; $i++){
                    $id = explode('_', $id_[2*$i]);

                    $query = $consulta->actualizarAsistenciaUsuario($id[0], $asistencia[2*$i], $asistencia[2*$i+1]);
                    $resultado = $base->actualizar($query);

                    if($resultado == true){
                        $success [] = true;
                    }else {
                        $success [] = false;
                    }

                }
            
            }


            


            
            
        }else {
            $conexion = true;
            $success = false;
            
        }
                
    }


    $respuesta = [        
        'servidor' => $servidor,
        'conexion' => $conexion,
        'success' => $success


    ];
    echo json_encode($respuesta);
?>