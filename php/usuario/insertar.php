<?php

    require('../base.php');
    require('../consulta.php');

    if(!$_SERVER['REQUEST_METHOD']== 'POST'){
        $respuesta = [
            'valor' => false
        ];

    }else {

        $nCuenta = filter_var($_POST['cuenta'],FILTER_SANITIZE_STRING);
        $nombre = filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
        $apellidoP = filter_var($_POST['apellidoP'],FILTER_SANITIZE_STRING);
        $apellidoM = filter_var($_POST['apellidoM'],FILTER_SANITIZE_STRING);
        $correo = filter_var($_POST['correo'],FILTER_SANITIZE_STRING);
        $usuario = filter_var($_POST['usuario'],FILTER_SANITIZE_STRING);
        $pass = filter_var($_POST['pass'],FILTER_SANITIZE_STRING);
        $telefono = filter_var($_POST['tel'],FILTER_SANITIZE_STRING);

        if(empty($usuario) || empty($correo) || empty($nCuenta) || empty($nombre) || empty($apellidoM) || empty($apellidoP) || empty($pass) || empty($telefono)){
            $respuesta = [
                'valor' => false
            ];
        } else {
            $conexion = abrirConexion();

            $query = "INSERT INTO usuario (nCuenta, nombre, apellidoP, apellidoM, correo, usuario, pass, tipo_usuario, telefono ) VALUES ('$nCuenta', '$nombre', '$apellidoP', '$apellidoM', '$correo', '$usuario', '$pass', 3, '$telefono')";

            if($conexion->query($query)){
                $respuesta  = [
                    'valor' => true
                ];
            }else {
                $respuesta = [
                    'valor' => false
                ];
            }
            
            $conexion->close();
            
        }
    }

    echo json_encode($respuesta);


?>