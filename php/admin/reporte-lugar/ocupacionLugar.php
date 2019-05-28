<?php

	include ('../../base1.php');

	if(!$_SERVER['REQUEST_METHOD'] == 'POST'){

		$respuesta = ['valor' => false];

	}else {

		$id = $_POST['id'];


		$bd = new ConexionBase();

		$bd->conectar();


		$query = "SELECT horario.hora_inicio, horario.hora_final, curso.titulo, horario.fecha FROM lugar, horario, curso WHERE lugar.id_lugar = horario.id_lugar AND curso.id_curso = horario.id_curso AND lugar.id_lugar = '$id'";

		$resultado = $bd->leer($query);
		$ocupado = [];
		foreach ($resultado as $key ) {
			$ocupado [] = [
				'HI' => formatoHora($key['hora_inicio']),
				'HF' => formatoHora($key['hora_final']),
				'titulo' => $key['titulo'],
				'fecha' => formatoFecha($key['fecha'])
			];
		}


		

		$respuesta = $ocupado;

	}


	


	echo json_encode($respuesta);



	function formatoFecha($fecha){
			$extraer  = str_replace('-',"", $fecha);
			$respuesta = substr($extraer, 2, strlen($extraer));
		return $respuesta;
	}


	function formatoHora($hora){				
			$extraer  = str_replace(':',"", $hora);
			$respuesta = substr($extraer, 0, 4);
		


		return $respuesta;
	}


?>