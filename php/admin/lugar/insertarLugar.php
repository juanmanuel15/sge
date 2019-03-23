<?php
    //header('Content-Type: application/json');

    require ('../../base.php');
    require ('../../consulta.php');

    $nombreLugar = $_POST['nombreLugar'];
    $cantidadLugar = $_POST['cantidadLugar'];

    $conexion = abrirConexion();

    $query = "INSERT INTO lugar (id_lugar, nombre_lugar, lugares) VALUES (null, '$nombreLugar', $cantidadLugar)";

    $respuesta = insertarDatos($conexion, $query);
    
    echo json_encode($respuesta);

    cerrarConexion($conexion);    
?>