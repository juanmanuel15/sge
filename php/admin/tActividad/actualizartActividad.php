<?php

	session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

	require ('../../base.php');
    require ('../../consulta.php');

    $id = (int) $_POST['id'];
    $nombre_act =  $_POST['nombre'];

    $conexion = abrirConexion();

    $query = "UPDATE tipo_actividad SET nombre_tipo_actividad = '$nombre_act' WHERE id_tipo_actividad = $id"; 

    $resultado = insertarDatos($conexion, $query);
    
   
    echo json_encode($resultado);

    cerrarConexion($conexion);  

?>