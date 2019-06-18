<?php 

	require('../base1.php');

	$id_usuario = $_POST['usuario'];

	$respuesta = [];
	$profesor = [];
	$horario = [];

	$bd = new ConexionBase();

	$conn = $bd->conectar();


	if($bd != false){

		$query = "SELECT curso.id_curso, curso.titulo FROM curso, curso_usuario_insc, usuario WHERE usuario.usuario = '$id_usuario' AND curso.id_curso = curso_usuario_insc.id_curso AND usuario.nCuenta = curso_usuario_insc.nCuenta";

		$resultado = $bd->leer($query);

		if($resultado->num_rows>=1){

			$curso = [];
		while($row = $resultado->fetch_array()){
			$curso [] = [
				'id' => $row[0],
				'titulo' => $row[1]
			];
		}

		$resultado->free();

		


		$respuesta = $curso[0]['id'];

		for ($i=0; $i < sizeof($curso) ; $i++) { 

			$id = $curso[$i]['id'];
			$query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final, lugar.nombre_lugar FROM lugar, horario, curso WHERE curso.id_curso = '$id' AND curso.id_curso = horario.id_curso AND lugar.id_lugar = horario.id_lugar";
			$resultado = $bd->leer($query);

			

			while ($row = $resultado->fetch_array()) {
				$horario [] = [
					'fecha' => $row[0],
					'HI' => $row[1],
					'HF' => $row[2],
					'lugar' => $row[3]
				];
			}

			$resultado->free();


			$query = "SELECT usuario.nombre, usuario.apellidoP, usuario.apellidoM FROM usuario, curso_usuario_org, curso WHERE curso_usuario_org.nCuenta = usuario.nCuenta AND curso.id_curso = '$id' AND curso.id_curso = curso_usuario_org.id_curso ORDER BY usuario.apellidoP ASC";

			$resultado = $bd->leer($query);

			

			while ($row = $resultado->fetch_array()) {
				$profesor [] = [
					'nombre' => $row[0]. " ". $row[1]. " ". $row[2],					
				];
			}

			$resultado->free();


			
			$valor [] = [
					'curso' => $curso[$i],
					'horario' => $horario,
					'profesor' => $profesor
			]; 
		}

		$respuesta = $valor;

		} else {
			$respuesta = ['datos' =>false];
		}



		


		

		


		


	

	}else {
		$respuesta = ['base' => false];
	}



	echo json_encode($respuesta);

	

?>