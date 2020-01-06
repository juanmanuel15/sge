<?php
	
	require('../../../Consultas.php');
    require('../../../base1.php');

    header("Content-Type: text/html;charset=utf-8");
	
	$id = $_POST['id'];

	if(isset($id)){

		$base = new ConexionBase();
		$consulta = new Consultas();
		$serv = false;

		$conexion = $base->conectar();
		if($conexion != false){
			$conn = false;

			$query = $consulta->eliminar_editarConstancia($id);
			$resultado = $base->eliminar($query);

			if($resultado != false){
				$success = true;
			}else{
				$success = false;
			}
		}else{
			$conn = true;
		}

	}else{
		$serv = true;
	}



	$respuesta = [
		'serv' => $serv,
		'conn' => $conn,
		'success' => $success
	];

	echo json_encode($respuesta);

?>