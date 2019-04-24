<?php

	require ('../../base.php');
    require ('../../consulta.php');

    //header('Content-Type: application/json');
    header("Content-Type: text/html;charset=utf-8");
    
    $conexion = abrirConexion();

    $query = "SELECT id_lugar, nombre_lugar, lugares FROM lugar ORDER BY nombre_lugar";

    $resultado = leerDatos($conexion, $query);

    $lugar = [];

    while($row = $resultado->fetch_array()){

    	$lugar[] = [
    		'id' => $row[0],
    		'nombre' => $row[1]
    	];

    }

    echo json_encode($lugar);
?>