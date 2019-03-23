<?php

	require ('../../base.php');
    require ('../../consulta.php');

    $id = (int) $_POST['id'];
    $nombre_req =  $_POST['nombreReq'];

    $conexion = abrirConexion();

    $query = "UPDATE requerimientos SET nombre_req = '$nombre_req' WHERE id_req = $id"; 

    $resultado = insertarDatos($conexion, $query);
    
   
    echo json_encode($resultado);

    cerrarConexion($conexion);  

?>