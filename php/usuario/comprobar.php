<?php 
     require('../base.php');
     require('../consulta.php');

     if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
        $respuesta = [
            'valor' => false
        ];
     }else {

            $usuario = filter_var($_POST['usuario'],FILTER_SANITIZE_STRING);
            $nCuenta = filter_var($_POST['nCuenta'], FILTER_SANITIZE_STRING);
            $correo = filter_var($_POST['mail'], FILTER_SANITIZE_STRING); 

            if(empty($usuario) || empty($correo) || empty($nCuenta)){
                
                if(!empty($correo)){

                    $conexion = abrirConexion();
                    $query = "SELECT * FROM usuario WHERE correo = '$correo'";
                    $resultado = leerDatos($conexion, $query);

                    if($resultado->num_rows>= 1){
                        $respuesta = [
                            'correo'=> true
                        ];
                    }else {
                        $respuesta = [
                            'correo'=> false
                        ];
                    }

                    

                }else {
                    $respuesta = [
                        'valor' => false
                    ];
                }

            }else {

                $conexion = abrirConexion();

                $query = "SELECT * FROM usuario WHERE usuario = '$usuario'";

                $resultado = leerDatos($conexion, $query);

                if($resultado->num_rows>= 1){
                    $respUsuario = true;
                }else {
                    $respUsuario = false;
                }

                $resultado->free();

                $query = "SELECT * FROM usuario WHERE correo = '$correo'";

                $resultado = leerDatos($conexion, $query);

                if($resultado->num_rows>= 1){
                    $respCorreo = true;
                }else {
                    $respCorreo = false;
                }

                

                $resultado->free();

                $query = "SELECT * FROM usuario WHERE nCuenta = '$nCuenta'";

                $resultado = leerDatos($conexion, $query);

                if($resultado->num_rows>= 1){
                    $respCuenta = true;
                }else {
                    $respCuenta = false;
                }

                $resultado->free();


                $respuesta = [
                    'usuario' => $respUsuario,
                    'correo' => $respCorreo,
                    'cuenta' => $respCuenta
                ];
            }
     }

     
     echo json_encode($respuesta);
    



?>