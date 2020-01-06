<?php
    
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

	require ('../../base.php');
    require ('../../consulta.php');

    $id = (int) $_POST['id'];
    $nombreLugar =  $_POST['nombreLugar'];
    $cantidadLugar =  $_POST['cantidadLugar'];

    $conexion = abrirConexion();

    $query = "UPDATE lugar SET nombre_lugar = '$nombreLugar', lugares = '$cantidadLugar' WHERE id_lugar = $id"; 

    $resultado = insertarDatos($conexion, $query);
    
   
    echo json_encode($resultado);

    cerrarConexion($conexion);  

?>