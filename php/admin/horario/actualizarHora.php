<?php
	session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

	require ('../../base.php');
    require ('../../consulta.php');

    $id = (int) $_POST['id'];
    $hora =  $_POST['hora'];

    $conexion = abrirConexion();

    $query = "UPDATE hora SET hora = '$hora' WHERE id_hora = $id"; 

    $resultado = insertarDatos($conexion, $query);
    
   
    echo json_encode($resultado);

    cerrarConexion($conexion);  

?>