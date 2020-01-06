<?php

    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

	require ('../../base.php');
    require ('../../consulta.php');

    $id = (int) $_POST['id'];

    $conexion = abrirConexion();

    $query = "SELECT * FROM lugar WHERE id_lugar = " .$id;

    $resultado = leerDatos($conexion, $query);
    
    $lugar = [];
    while($row = $resultado->fetch_array()){
        
        $lugar []  = [
            'id' => $row[0],
            'nombreLugar' => $row[1],
            'cantidadLugar' => $row[2]
        ];
    }
    echo json_encode($lugar);

    cerrarConexion($conexion);  

?>