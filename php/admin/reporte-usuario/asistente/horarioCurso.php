<?php
    
    include ('../../../Buscar.php');
    include ('../../../Consultas.php');
    include ('../../../base1.php');

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
            $asistencia = true;
        }else{
            $vacio = false;

            $usuario = $id[0];
            $curso = $id[1];

            $conexion = $base->conectar();

            if($conexion != false){
                $conexion = false;

                
                $asistencia = [];

                $query = $consulta->buscarAsistenciaUsuario($usuario, $curso);
                $resultado = $base->leer($query);

                while($row = $resultado->fetch_array()){
                    $asistencia[] = [
                        'id' => $row[0],
                        'fecha_e' => $row[3],
                        'fecha_s' => $row[4],
                        'hora_e' => $row[1],
                        'hora_s' => $row[2],
                        'check_in' => $row[5],
                        'check_out' => $row[6]
                    ];
                }

                if(sizeof($asistencia) == 0){
                    $asistencia = false;
                }else {
                    $asistencia = $asistencia;
                }


            }else {
                $conexion = true;
            }
            
        }

    }

    $respuesta = [
        'servidor'=> $servidor,
        'vacio' => $vacio, 
        'conn' => $conexion,
        'asistencia' => $asistencia
    ];

    echo json_encode($respuesta);


?>