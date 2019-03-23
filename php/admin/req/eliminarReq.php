<?php
	
	require ('../../base.php');
    require ('../../consulta.php');

	$id = (int) $_POST['id'];
	

	$conexion = abrirConexion();

	$query = "DELETE FROM requerimientos WHERE id_req = ". $id;

	$resultado = eliminarDatos($conexion, $query);

	echo json_encode($resultado);

	cerrarConexion($conexion);

?>