<?php

    require('../base.php');
    require('../consulta.php');

    if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
        $respuesta = [
            'valor' => false
        ];
     }else {
         $usuario = $_POST['usuario'];

         $conexion = abrirConexion();

         $query = "SELECT nombre, apellidoP, apellidoM, correo, pass, telefono, nCuenta, correo, cuenta FROM usuario WHERE usuario = '$usuario'";

         $resultado = $conexion->query($query);

         $respuesta = [];

         while($row = $resultado->fetch_array()){

            $respuesta  = [
                'nombre' => $row[0],
                'apellidoP' => $row[1],
                'apellidoM' => $row[2], 
                'correo' => $row[3],
                'pass' => $row[4],
                'telefono' => $row[5],
                'nCuenta' => $row[6],
                'correo' => $row[7],
                'cuenta' => $row[8]
            ];

         }
         

     }

     echo json_encode($respuesta);

?>