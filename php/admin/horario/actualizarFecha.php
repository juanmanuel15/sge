<?php
	
	require ('../../base.php');
    require ('../../consulta.php');

    $id = (int) $_POST['id'];
    $fecha =  $_POST['fecha'];

    $conexion = abrirConexion();

    $query = "UPDATE fecha SET fecha = '$fecha' WHERE id_fecha = $id"; 

    $resultado = insertarDatos($conexion, $query);
    
   
    echo json_encode($resultado);

    cerrarConexion($conexion);  

?>