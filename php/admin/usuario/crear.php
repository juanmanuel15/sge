<?php

	session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

	require ('../../base.php');
    require ('../../consulta.php');

    header("Content-Type: text/html;charset=utf-8");
	
	$nCuenta = htmlspecialchars($_POST['nCuenta']);
	$nombre = htmlspecialchars($_POST['nombre']);
	$apellidoP = htmlspecialchars($_POST['apellidoP']);
	$apellidoM = htmlspecialchars($_POST['apellidoM']);
	$correo = htmlspecialchars($_POST['correo']);
	$usuario = htmlspecialchars($_POST['usuario']);
	$pass = htmlspecialchars($_POST['pass']);
	$telefono =  htmlspecialchars($_POST['telefono']);
	$tipoUser = (int) htmlspecialchars($_POST['tipoUser']);

	//echo ($nCuenta.$nombre.$apellidoP.$apellidoM.$correo.$usuario.$pass.$telefono.$tipoUser);
 	if(isset($nCuenta, $nombre,$apellidoP,$apellidoM,$correo, $usuario,$pass,$telefono,$tipoUser)){

		$conexion = abrirConexion();

    	$query = "INSERT INTO  usuario(nCuenta, nombre, apellidoP, apellidoM, tipo_usuario, correo, usuario, pass, telefono)  VALUES ($nCuenta, '$nombre', '$apellidoP', '$apellidoM', $tipoUser, '$correo', '$usuario', '$pass', '$telefono')";


   		$respuesta = insertarDatos($conexion, $query);


    

	    

 	
 	} else {
 		
 		$respuesta = [
 			'valor' => false
 		];
 	}

 	cerrarConexion($conexion);
 	echo  json_encode($respuesta);
	
	

?>