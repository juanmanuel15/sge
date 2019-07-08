<?php

    include('../../base1.php');
    include('../../Consultas.php');

    header("Content-Type: text/html;charset=utf-8");

    $base = new ConexionBase();
    $consulta = new Consultas();

    if(isset($_POST['correo']) && isset($_POST['usuario']) && isset($_POST['cuenta'])){
        $servidor = false;

        $correo = htmlspecialchars($_POST['correo']);
        $usuario = htmlspecialchars($_POST['usuario']);
        $cuenta = htmlspecialchars($_POST['cuenta']);

       

        if($correo != '' && $usuario != ''){
            $vacio = false;

            $conexion = $base->conectar();

            if($conexion != false){
                $conn = false;

                $query = $consulta->consultar_correo($correo);
                $resultado = $base->leer($query);

                if($resultado->num_rows>0){
                    $correo = true;
                }else{
                    $correo = false;
                }

                $resultado->free();


                $query = $consulta->consultar_usuario($usuario);
                $resultado = $base->leer($query);

                if($resultado->num_rows>0){
                    $usuario = true;
                }else{
                    $usuario = false;
                }

                $resultado->free();


                if($cuenta != ''){
                    $query = $consulta->consultar_cuenta($cuenta);
                    $resultado = $base->leer($query);

                    if($resultado->num_rows>0){
                        $cuenta = true;
                    }else{
                        $cuenta = false;
                    }

                    $resultado->free();
                }else{
                    $cuenta = false;
                }
                

                


                $success = [
                    'correo' => $correo,
                    'cuenta' => $cuenta,
                    'usuario' => $usuario
                ];




                


            }else{
                $conn = true;
                $success = false;

            }

        }else{
            $vacio = true;
            $conn = false;
            $success = false;

            

        }
    }else{
        $servidor = true;
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