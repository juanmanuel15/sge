<?php 

	require ('../../base.php');
    require ('../../consulta.php');

    header("Content-Type: text/html;charset=utf-8");

    $nCuenta = $_POST['id'];
    $conexion = abrirConexion();

    $query = "SELECT nCuenta, nombre, apellidoP, apellidoM, tipo_usuario, correo, usuario, telefono, pass FROM usuario WHERE nCuenta = '$nCuenta'";

    $resultado = leerDatos($conexion, $query);


    $user = [];

    while($row = $resultado->fetch_array()){
        
        $user []  = [
            'nCuenta' => $row[0],
            'nombre' => $row[1],
            'apellidoP' => $row[2],
            'apellidoM' =>$row[3], 
            'tipo_usuario' => $row[4],
            'correo' => $row[5],
            'usuario' => $row[6],
            'telefono' => $row[7], 
            'pass' => $row[8]
        ];
    }


    echo json_encode($user);


?>