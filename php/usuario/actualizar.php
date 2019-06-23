<?php

    require('../base.php');
    require('../consulta.php');
    

    if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
        $respuesta = [
            'valor' => false
        ];
     }else {

         $usuario = filter_var($_POST['usuario'],FILTER_SANITIZE_STRING);
         $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
         $correo = filter_var($_POST['mail'], FILTER_SANITIZE_STRING);
         $apellidoP = filter_var($_POST['apellidoP'], FILTER_SANITIZE_STRING);
         $apellidoM = filter_var($_POST['apellidoM'], FILTER_SANITIZE_STRING);
         $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
         $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);

        if(empty($usuario) || empty($correo) || empty($apellidoP) || empty($apellidoM) || empty($pass) || empty($telefono)) {
            print_r($respuesta = [
                'valor' => false
            ]);
        }else {
            
            $conexion = abrirConexion();
            echo $query = "UPDATE usuario SET nombre = '$nombre', apellidoP = '$apellidoP', apellidoM = '$apellidoM', pass = '$pass' , telefono = '$telefono', correo = '$correo' WHERE usuario = '$usuario'";
            $resultado = $conexion->query($query);

           if($resultado){
                $respuesta = [
                    'valor' => true
                ];
            }else {
                $respuesta = [
                    'valor' => false
                ];
            }
        }
     }


     echo json_encode($respuesta);


?>