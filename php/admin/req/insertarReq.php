<?php
    //header('Content-Type: application/json');

	session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

    require ('../../base.php');
    require ('../../consulta.php');

    $nombre_req = $_POST['nombreReq'];

    $conexion = abrirConexion();

    $query = "INSERT INTO requerimientos (id_req, nombre_req) VALUES (null, '$nombre_req')";

    $respuesta = insertarDatos($conexion, $query);
    
    echo json_encode($respuesta);

    cerrarConexion($conexion);    
?>