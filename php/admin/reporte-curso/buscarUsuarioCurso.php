<?php 
	
	include ('../../Buscar.php');
	include ('../../Consultas.php');
	include ('../../ComprobarMetodo.php');
	include ('../../base1.php');
	include ('../../consulta.php');

	header("Content-Type: text/html;charset=utf-8");


	$cadena = new Buscar();
	$metodo = new ComprobarMetodo();
	$consulta = new Consultas();
	$base = new ConexionBase();

	$txt = $_POST['txt'];

	$definido = $metodo->Post($txt);

	if($definido){
		$respuesta = ['servidor' => true];
	}else {

		if($txt == ''){

			$respuesta = ['servidor' => false ,
						'vacio' => true];

		}else {

			$buscar = $cadena->quitarCaracteres($txt);
			
			$base->conectar();

			$query = $consulta->buscarUsuario($buscar);
			
			$resultado = $base->leer($query);

			$usuarios = [];

			foreach ($resultado as $usuario ) {
				
				$usuarios [] = [
					'usuario' => $usuario['usuario'],
					'nCuenta' => $usuario['cuenta'],
					'nombre' => $usuario['nombre']	. " " . $usuario['apellidoP'] . " ". $usuario['apellidoM'],
					'id' => $usuario['nCuenta'],
					'carrera' => $usuario['carrera'],
					'tipo_usuario' => $usuario['tipo_usuario']
				];
			}



			$respuesta = [
				'servidor' => false,
				'vacio' => false,
				'usuarios' => $usuarios
			];
		}
		
	}
	

	echo json_encode($respuesta);

	

?>