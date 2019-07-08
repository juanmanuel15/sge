<?php

    include('../../base1.php');
    include('../../Consultas.php');

    header("Content-Type: text/html;charset=utf-8");

    $base = new ConexionBase();
    $consulta = new Consultas();

    if(isset($_POST['id'])){
        $servidor = false;

        $id = $_POST['id'];

        if($id != ''){
            $vacio = false;

            $conexion = $base->conectar();

            if($conexion != false){
                $conn = false;


                $query = $consulta->eliminar_usuario($id);
                $resultado = $base->eliminar($query);

                if($resultado != false){
                    $success = true;
                }else {
                    $success = false;
                }



            }else{
                $conn = true;
                $success = false;
            }

            



        }else {

            $vacio = true;
            $conn = false;
            $success = false;

        }

    }else{
        $servidor =  true;
        $vacio = false;
        $conn = false;
        $success = false;
    }


    $respuesta = [
        'servidor' => $servidor,
        'vacio' => $vacio,
        'conn' => $conn,
        'success' => $success
    ];


    echo json_encode($respuesta);
?>