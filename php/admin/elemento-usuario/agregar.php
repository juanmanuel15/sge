<?php
    include('../../base1.php');
    include('../../Consultas.php');

    header("Content-Type: text/html;charset=utf-8");

    $base = new ConexionBase();
    $consulta = new Consultas();

    $nCuenta = htmlspecialchars($_POST['nCuenta']);
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellidoP = htmlspecialchars($_POST['apellidoP']);
    $apellidoM = htmlspecialchars($_POST['apellidoM']);
    $correo = htmlspecialchars($_POST['correo']);
    $usuario = htmlspecialchars($_POST['usuario']);
    $pass = htmlspecialchars($_POST['pass']);
    $telefono =  htmlspecialchars($_POST['telefono']);
    $tipoUser = (int) htmlspecialchars($_POST['tipoUser']);
    $area = (int) htmlspecialchars($_POST['area']);
    $nombre_area = htmlspecialchars($_POST['area_nombre']);


    if(isset($nCuenta, $nombre,$apellidoP,$apellidoM,$correo, $usuario,$pass,$telefono,$tipoUser, $area, $nombre_area)){
        $servidor = false;
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

    $respuesta = [ 
        'servidor' => $servidor,
        'conn' => $conn,
        'vacio' => $vacio,
        'success' => $success
    ];

    echo json_encode($respuesta);


    function id_usuario_int($nombre, $apellido, $correo, $area){
        return $id = date('Ymd') .substr(strtolower($correo), 0, 3). substr(strtolower($nombre), 0, 3) . substr(strtolower($apellido), 0,3).substr(strtolower($area),0,3);
    }

    function id_usuario_ext($nombre, $apellido, $correo){
        return $id = date('Ymd') .substr(strtolower($correo), 0, 2). substr(strtolower($nombre), 0, 2) . substr(strtolower($apellido), 0,2). "EXT";
    }


?>