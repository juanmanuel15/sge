<?php
    //header('Content-Type: application/json');

    require ('../../base.php');
    require ('../../consulta.php');

    $fecha = $_POST['fecha'];


    $conexion = abrirConexion();

    $query = "INSERT INTO fecha (id_fecha, fecha) VALUES(NULL, '$fecha')";
    

    $respuesta = insertarDatos($conexion, $query);
    
    echo json_encode($respuesta);

    cerrarConexion($conexion);    
?>