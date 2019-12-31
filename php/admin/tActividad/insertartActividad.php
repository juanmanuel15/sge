<?php
    //header('Content-Type: application/json');

	session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

    require ('../../base.php');
    require ('../../consulta.php');

    $nombre_act = $_POST['nombre'];

    $conexion = abrirConexion();

    $query = "INSERT INTO tipo_actividad (id_tipo_actividad, nombre_tipo_actividad) VALUES (null, '$nombre_act')";

    $respuesta = insertarDatos($conexion, $query);
    
    echo json_encode($respuesta);

    cerrarConexion($conexion);    
?>