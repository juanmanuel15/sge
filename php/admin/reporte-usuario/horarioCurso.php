<?php
    include ('../../Buscar.php');
    include ('../../Consultas.php');
    include ('../../base1.php');

    header("Content-Type: text/html;charset=utf-8");
    $base = new ConexionBase();
    $consulta = new Consultas();

    if(!isset($_POST['id'])) {
        $servidor = true;
    }else {
        $servidor = false;

        $id = explode('&', $_POST['id']);

        if(empty($id) || sizeof($id)<2){
            $vacio = true;
            $horario = true;
        }else{
            $vacio = false;

            $usuario = $id[0];
            $curso = $id[1];

            $conexion = $base->conectar();

            if($conexion != false){
                $conexion = false;

                $query = $consulta->buscarHorarioCurso($usuario, $curso);

                $resultado = $base->leer($query);

                while($row = $resultado->fetch_array()){
                    $horario [] = [
                        'fecha' => $row[0],
                        'HI' => $row[1],
                        'HF' => $row[2]
                    ];
                }

                $resultado->free();

            }else {
                $conexion = true;
            }
            
        }

    }

    $respuesta = [
        'servidor'=> $servidor,
        'vacio' => $vacio, 
        'conn' => $conexion,
        'horario' => $horario
    ];

    echo json_encode($respuesta);


?>