<?php

    require('../../../Consultas.php');
    require('../../../base1.php');

    header("Content-Type: text/html;charset=utf-8");

    $base = new ConexionBase();
    $conexion = $base->conectar();
    $dato = $_POST['dato'];
    if(isset($dato)){
        $serv = false;
        if($conexion != false){
            $conn = false;

            $consulta = new Consultas();            
            $query = $consulta->buscar_constanciaPonente($dato);
            $resultado = $base->leer($query);

            
            if($resultado != false){
                $res = false;
                
                if($resultado->num_rows>0){
                    $tamano = false;
                    $profesor = [];
                    while($row = $resultado->fetch_array()){

                        $profesor [] = [
                            'numeroCuenta' =>  $row[0],
                            'nombreCompleto' => $row[1] ." " . $row[2]. " " .$row[3],
                            'titulo' => $row[4],
                            'curso' => $row[5],
                            'usuario' => $row[6],
                        ];
                        
                    }

                    $success = $profesor;

                }else{
                    $tamano = true;
                    $success = false;

                }
                
            }else{
                $res = true;
                $tamano = false;
                $success = false;
            }
        }else{
            $conn = true;
            $res = false;
            $tamano = false;
            $success = false;
        }
    }else{
        $serv = true;
        $conn = true;
        $res = true;
        $tamano = true;
        $success = false;

    }



    $respuesta = [
        'serv' => $serv,
        'conn' => $conn,
        'res' => $res,
        'tamano' => $tamano,
        'success' => $success
    ];



    echo json_encode($respuesta);


?>