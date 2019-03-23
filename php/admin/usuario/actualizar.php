<?php
	
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
	$nCuenta_actual = htmlspecialchars($_POST['nCuenta_actual']);

	//echo ($nCuenta.$nombre.$apellidoP.$apellidoM.$correo.$usuario.$pass.$telefono.$tipoUser);
 	if(isset($nCuenta, $nombre,$apellidoP,$apellidoM,$correo, $usuario,$pass,$telefono,$tipoUser, $nCuenta_actual)){

		$conexion = abrirConexion();

    	$query = "UPDATE usuario SET nCuenta = '$nCuenta',  apellidoP = '$apellidoP', apellidoM = '$apellidoM', tipo_usuario = $tipoUser, correo = '$correo', usuario = '$usuario', pass = '$pass', telefono = '$telefono' WHERE nCuenta = '$nCuenta_actual'" ;


   		$respuesta = insertarDatos($conexion, $query);

   		} else {
 		
 		$respuesta = [
 			'valor' => false
 		];
 	}

 	cerrarConexion($conexion);
 	echo  json_encode($respuesta);


?>