<?php

    session_start();

    if(!isset($_SESSION['admin'])){
    header('Location: ../../admin/admin.php' );
    }

    include ('../../Consultas.php');
    include ('../../base1.php');

    $base = new ConexionBase();
    $consulta = new Consultas();



    if(isset($_GET['curso']) && isset($_GET['usuario'])){
        $servidor = false;
        
        $curso = $_GET['curso'];
        $usuario = $_GET['usuario'];       

        $usuario = str_replace("'", "", $usuario);
        $curso = str_replace("'", "", $curso);
        


        if(empty($curso) || empty($usuario)){
            $vacio = true;
        }else{
            $vacio = false;

            $conexion = $base->conectar();

            if($conexion != false){
                $query = $consulta->horarioCurso($curso);
                $resultado = $base->leer($query);

                //print_r($respuesta);
                $horarioCurso = [];

                while($row = $resultado->fetch_array()){
                    $horarioCurso []= [
                        'fecha' => $row[0]
                    ];
                }

                $base->limpiar($resultado);

                $query = $consulta->buscarAsistenciaUsuario($usuario, $curso);
                $resultado = $base->leer($query);

                $horarioRegistro = [];

                
                foreach ($resultado as $registro ) {
                    $horarioRegistro [] = [
                        'fecha' => $registro['fecha_e'],
                        'entrada' => $registro['check_in'],
                        'salida' => $registro['check_out']
                    ];
                }

                if(sizeof($horarioCurso) >= sizeof($horarioRegistro)){
                    require('paginas/success_asistencia.php');
                }else{
                    require('paginas/error_asistencia.php');
                }


                //print_r($horarioRegistro);
                
            }else{
                $conexion = true;
            }

        }





    }else{
        $servidor = true;
        $vacio = true;
        $conexion = true;

    }





?>