<?php

	session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }
	
	require ('../../base.php');
    require ('../../consulta.php');

	$id = (int) $_POST['id'];
	

	$conexion = abrirConexion();

	$query = "DELETE FROM tipo_actividad WHERE id_tipo_actividad = ". $id;

	$resultado = eliminarDatos($conexion, $query);

	echo json_encode($resultado);

	cerrarConexion($conexion);

?>