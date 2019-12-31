<?php
	session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }
	
	include ('../../base1.php');


	if(!$_SERVER['REQUEST_METHOD'] == 'POST'){

		$respuesta = ['valor' => false];

	}else {


		$bd = new conexionBase();

		$conexion = $bd->conectar();

		


		$query = "SELECT * FROM hora ORDER BY time(HORA)";

		$resultado = $bd->leer($query);
		$cantidadHora = $resultado->num_rows;
		$hora = [];

		foreach ($resultado as $key) {
			$hora [] = [

				'id_hora' => $key['id_hora'],
				'hora' => $key['hora']

			];


		}

		$resultado->free();


		$query = "SELECT * FROM fecha ORDER BY fecha ASC";

		$resultado = $bd->leer($query);

		$cantidadFecha = $resultado->num_rows;		
		$fecha = [];
		foreach ($resultado as $key ) {
			$fecha []= [

				'id_fecha' => $key['id_fecha'],
				'fecha' => $key['fecha']
			];
		}

		$fechaFormato = formatoFecha($fecha);
		$horaFormato = formatoHora($hora);



		$resultado->free();

		$bd->cerrar();


		$respuesta = [
			'cantidadHora' => $cantidadHora,
			'cantidadFecha' => $cantidadFecha, 
			'hora' => $hora,
			'fecha' => $fecha,
			'formatoFecha' => $fechaFormato,
			'formatoHora' => $horaFormato
		];

	}
	

	echo json_encode($respuesta);


	function formatoFecha($fecha){

		$respuesta = [];

		for ($i=0; $i < sizeof($fecha); $i++) { 
			$extraer  = str_replace('-',"", $fecha[$i]['fecha']);

			$respuesta[] = substr($extraer, 2, strlen($extraer));
		}


		return $respuesta;
	}


	function formatoHora($hora){
		$respuesta = [];

		for ($i=0; $i < sizeof($hora); $i++) { 
			$extraer  = str_replace(':',"", $hora[$i]['hora']);

			$respuesta[] = substr($extraer, 0, 4);
		}


		return $respuesta;
	}

?>