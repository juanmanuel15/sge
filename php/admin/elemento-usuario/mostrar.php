<?php

    include('../../base1.php');
    include('../../Consultas.php');

    header("Content-Type: text/html;charset=utf-8");

    $base = new ConexionBase();
    $consulta = new Consultas();

    $conexion = $base->conectar();

    


    if($conexion != false){
        $conn = false;

        $query = $consulta->mostrar_elementoUsuario();

        $resultado = $base->leer($query);

        if($resultado != false){

            $user = [];
            while($row = $resultado->fetch_array()){
                
                $user []  = [
                    'id' => $row[0],
                    'nombre' => $row[1]. " " . $row[2] . " " . $row[3], 
                    'usuario' => $row[4],
                    'tipo_usuario' => $row[5],
                    'carrera' => $row[6],
                    'numeroCuenta' => $row[7]
                ];
            }

            

        }else{
            $user = true;
        }

    }else {
        $conn = true;
        $resultado = false;
    }

    $base->cerrar();


    $respuesta = [
        'conn' => $conn,
        'resultado' => $user
    ];

    echo json_encode($respuesta);




?>