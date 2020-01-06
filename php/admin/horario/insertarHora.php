<?php
    //header('Content-Type: application/json');
	
    require ('../../base.php');
    require ('../../consulta.php');

    $hora = $_POST['hora'];


    $conexion = abrirConexion();

    echo $query = "INSERT INTO hora (id_hora, hora) VALUES(NULL, '$hora')";

    $respuesta = insertarDatos($conexion, $query);
    
    echo json_encode($respuesta);

    cerrarConexion($conexion);    
?>