<?php
		
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }
	require ('../../base.php');
    require ('../../consulta.php');

    header("Content-Type: text/html;charset=utf-8");

    $id =  htmlspecialchars($_POST['id']);
    $respuesta = [];

    if(isset($id)){
    	$conexion = abrirConexion();
    	$query = "DELETE FROM usuario WHERE nCuenta = '$id'";
    	$respuesta = eliminarDatos($conexion, $query);
    	
    	cerrarConexion($conexion);
 		
    }else {
    	$respuesta = [
    		'valor' => false
    	];
    }

    echo  json_encode($respuesta);

?>