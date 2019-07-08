<?php

    include('../../base1.php');
    include('../../Consultas.php');
    header("Content-Type: text/html;charset=utf-8");

    $base = new ConexionBase();
    $consulta = new Consultas();

    if(isset($_POST['id'])){
        $servidor = false;

        $id = htmlspecialchars( $_POST['id']);

        if($id != ''){
            $vacio = false;

            $conexion = $base->conectar();

            if($conexion != false){
                $conn = false;

                $query = $consulta->leer_usuario($id);
                $resultado = $base->leer($query);

                foreach ($resultado as $usuario) {
                    $usuarios = [
                        'id' => $usuario['nCuenta'],
                        'cuenta' => $usuario['cuenta'],
                        'nombre' => $usuario['nombre'],
                        'apellidoP' => $usuario['apellidoP'],
                        'apellidoM' => $usuario['apellidoM'],
                        'correo' => $usuario['correo'],
                        'usuario' => $usuario['usuario'],
                        'pass' => $usuario['pass'],
                        'telefono' => $usuario['telefono'],
                        'area' => $usuario['area'],
                        'tipoUsuario' => $usuario['tipo_usuario']
                    ];
                }


            }else{
                $conn = true;
                $usuarios = false;
            }


        }else{

            $vacio = true;
            $conn = false;
            $usuarios = false;

        }
    }else{
        $servidor = true;
        $vacio = false;
        $conn = false;
        $usuarios = false;
    }

    $respuesta = [
        'servidor' => $servidor,
        'vacio' => $vacio,
        'conn' => $conn,
        'success' => $usuarios
    ];


    echo json_encode($respuesta);
?>