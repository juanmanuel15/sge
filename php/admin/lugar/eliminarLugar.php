<?php
	
	require ('../../base.php');
    require ('../../consulta.php');

	$id = (int) $_POST['id'];
	

	$conexion = abrirConexion();

	$query = "DELETE FROM lugar WHERE id_lugar = ". $id;

	$resultado = eliminarDatos($conexion, $query);

	echo json_encode($resultado);

	cerrarConexion($conexion);

?>