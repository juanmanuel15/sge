<?php
    //header('Content-Type: application/json');
	
	session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

    require ('../../base.php');
    require ('../../consulta.php');

    $fecha = $_POST['fecha'];


    $conexion = abrirConexion();

    $query = "INSERT INTO fecha (id_fecha, fecha) VALUES(NULL, '$fecha')";
    

    $respuesta = insertarDatos($conexion, $query);
    
    echo json_encode($respuesta);

    cerrarConexion($conexion);    
?>