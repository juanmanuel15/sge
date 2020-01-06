<?php

    require('../base1.php');
    require('../Consultas.php');


    if(!$_SERVER['REQUEST_METHOD']== 'POST'){
        $servidor = true;
        $conn = false;
        $success = false;
        $vacio = false;

    }else {

        $nCuenta = filter_var($_POST['cuenta'],FILTER_SANITIZE_STRING);
        $nombre = filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
        $apellidoP = filter_var($_POST['apellidoP'],FILTER_SANITIZE_STRING);
        $apellidoM = filter_var($_POST['apellidoM'],FILTER_SANITIZE_STRING);
        $correo = filter_var($_POST['correo'],FILTER_SANITIZE_STRING);
        $usuario = filter_var($_POST['usuario'],FILTER_SANITIZE_STRING);
        $pass = filter_var($_POST['pass'],FILTER_SANITIZE_STRING);
        $telefono = filter_var($_POST['tel'],FILTER_SANITIZE_STRING);
        $area = filter_var($_POST['area'],FILTER_SANITIZE_STRING);
        $nombre_area = filter_var($_POST['area_nombre'],FILTER_SANITIZE_STRING);

        $tipoUser = 3;

        if(isset($nCuenta, $nombre,$apellidoP,$apellidoM,$correo, $usuario,$pass,$telefono,$tipoUser, $area, $nombre_area)){
        $servidor = false;

        $base = new ConexionBase();
        $consulta = new Consultas();

        $conexion = $base->conectar();

        if($conexion != false){
            $conn = false;

            if(!empty($nCuenta)){
                if(empty($nCuenta) || empty($nombre) ||empty($apellidoP) ||empty($correo) || empty($usuario) ||empty($pass) ||empty($telefono) ||empty($tipoUser) || empty($area) || empty($nombre_area)){
                    $vacio = true;
                }else {
                    $vacio = false;
                    $id = id_usuario_int($nombre, $apellidoP, $correo, $nombre_area);
                    $query = $consulta->insertar_usuario($nCuenta, $nombre,$apellidoP,$apellidoM,$correo, $usuario,$pass,$telefono,$tipoUser, $area, $id);
                    $resultado = $base->insertar($query);

                    if($resultado != false){
                        $success = true;
                    }else{
                        $success = false;
                    }
                    
                }
            }else{

                if(empty($nombre) ||empty($apellidoP) ||empty($correo) || empty($usuario) ||empty($pass) ||empty($telefono) ||empty($tipoUser) ){
                    $vacio = true;
                }else {
                    $vacio = false;
                    $id = id_usuario_int($nombre, $apellidoP, $correo, $nombre_area);
                    $query = $consulta->insertar_usuario($nCuenta, $nombre,$apellidoP,$apellidoM,$correo, $usuario,$pass,$telefono,$tipoUser,$area, $id);
                    $resultado = $base->insertar($query);

                    if($resultado != false){
                        $success = true;
                    }else{
                        $success = false;
                    }
                    
                }


            }

            


        }else {
            $conn = true;
            $success = false;
            $vacio = false;

        }

    }else {
        $servidor = true;
        $conn = false;
        $success = false;
        $vacio = false;

    }

        /*if(empty($usuario) || empty($correo) || empty($nCuenta) || empty($nombre) || empty($apellidoM) || empty($apellidoP) || empty($pass) || empty($telefono)){
            $respuesta = [
                'valor' => false
            ];
        } else {
            $conexion = abrirConexion();

            $id_usuario = id_usuario_int($nombre, $apellidoP, $correo, $carrera);

            $query = "INSERT INTO usuario (nCuenta,cuenta, nombre, apellidoP, apellidoM, correo, usuario, pass, tipo_usuario, telefono, id_area ) VALUES ('$id_usuario', '$nCuenta', '$nombre', '$apellidoP', '$apellidoM', '$correo', '$usuario', '$pass', 3, '$telefono', $carrera)";

            echo $query;

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
            
        }*/
    }

    $respuesta = [ 
        'servidor' => $servidor,
        'conn' => $conn,
        'vacio' => $vacio,
        'success' => $success
    ];

    echo json_encode($respuesta);


    function id_usuario_int($nombre, $apellido, $correo, $nombre_area){
        return $id = date('Ymd') .substr(strtolower($correo), 0, 3). substr(strtolower($nombre), 0, 3) . substr(strtolower($apellido), 0,3).substr(strtoupper($nombre_area),0,3);
    }

    function id_usuario_ext($nombre, $apellido, $correo){
        return $id = date('Ymd') .substr(strtolower($correo), 0, 2). substr(strtolower($nombre), 0, 2) . substr(strtolower($apellido), 0,2). "EXT";
    }


?>