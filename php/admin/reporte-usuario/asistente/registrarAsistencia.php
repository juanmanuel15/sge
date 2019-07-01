<?php

    include ('../../../Buscar.php');
    include ('../../../Consultas.php');
    include ('../../../base1.php');

    header("Content-Type: text/html;charset=utf-8");
    date_default_timezone_set('America/Mexico_City');
    $base = new ConexionBase();
    $consulta = new Consultas();

    if(isset($_POST['entrada']) && isset($_POST['salida']) && isset($_POST['fecha']) && isset($_POST['id'])){
        $servidor = false;

        $entrada = $_POST['entrada'];
        $salida = $_POST['salida'];
        $fecha = $_POST['fecha'];
        $id = $_POST['id'];

        if(!empty($id) && !empty($entrada) && !empty($salida) && !empty($fecha) ){
            $vacio = false;

            $conexion = $base->conectar();

            if($conexion != false){
                $conn = false;                

                $datos = explode('&', $id);

                $id_usuario = $datos[0];
                $id_curso = $datos[1];
                $fecha_id = str_replace("-", "", $fecha);
                $id = "$fecha_id&$id";

                $hora_e = date("H:i:s");

                if($salida == true){
                    $salida = 1;
                }else {
                    $salida = 0;
                }

                if($entrada == true){
                    $entrada = 1;
                }else {
                    $entrada = 0;
                }

                $query = $consulta->insertarRegistroAsistencia($id, $fecha, $hora_e, $id_usuario, $id_curso, $entrada, $salida);

                $resultado = $base->insertar($query);

                if($resultado != false){
                    $success = true;
                }else{
                    $success = false;
                }

            }else {
                $conn = true;
            }

        }else {
            $vacio = true;
        }

    }else{
        $servidor = true;        
    }


    $respuesta = [
        'servidor' => $servidor,
        'vacio' => $vacio,
        'conn' => $conn,
        'success' => $success

    ];

    echo json_encode($respuesta);



?>