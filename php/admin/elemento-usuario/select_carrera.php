<?php
	
	include('../../base1.php');
    include('../../Consultas.php');

    header("Content-Type: text/html;charset=utf-8");    

    $base = new ConexionBase();
    $consulta = new Consultas();

    $conexion = $base->conectar();

    if($conexion != false){
        $conn = false;

        $query = $consulta->select_usuario_carrera();
        $resultado = $base->leer($query);

        if($resultado != false){
            $res = [];

            while($row = $resultado->fetch_array()){
                $res [] = [
                    'id' => $row[0],
                    'nombre' => $row[1]
                ];
            }


        }else{
            $res = true;

        }

    }else{
        $conn = true;
        $res = false;
    }


    $respuesta = ['conn' => $conn, 'resultado' => $res];
    
  
    $base->cerrar();

    echo json_encode($respuesta);
	

?>