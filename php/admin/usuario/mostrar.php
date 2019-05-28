<?php

	#Este programa aún esta en proceso de desarrollo, no se puede realizar la consulta

	require ('../../base.php');
    require ('../../consulta.php');

    header("Content-Type: text/html;charset=utf-8");

    $nCuenta = (int) $_POST['id'];
    
    $conexion = abrirConexion();

    $query = "SELECT nCuenta, nombre, apellidoP, apellidoM, usuario FROM usuario WHERE nCuenta = $nCuenta ORDER BY apellidoP ASC";

    $resultado = leerDatos($conexion, $query);

    $user = [];

     while($row = $resultado->fetch_array()){
        
        $user []  = [
            'numeroCuenta' => $row[0],
            'nombreCompleto' => $row[3]. " " . $row[2] . " " . $row[1], 
            'usuario' => $row[4]
        ];
    }

    echo json_encode($user);


?>