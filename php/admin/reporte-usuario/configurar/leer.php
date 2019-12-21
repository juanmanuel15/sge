<?php
	
	require("../../../Consultas.php");
	require("../../../base1.php");

	$conexion = new ConexionBase();
	$bd = new Consultas();

	if(!$conexion->conectar()){
		$conn = false;
	}else{
		$conn = true;
		$query = $bd->leer_configurarConstancia();

		$resultado = $conexion->leer($query);

		if($resultado == false){
			$bd = false;
		}else{
			$bd = true;
			$consulta= [];
			foreach ($resultado as $value) {

				$consulta  = [
					'tipoReconocimiento' => $value['tipo_documento'],
					'slogan' => $value['slogan'],
					'nombreDirector' => $value['nombre_director'],
					'nombreEvento' => $value['evento'],
					'porcentaje' => $value['porcentaje_asistencia'],
					'nombreUniversidad' => $value['universidad'],
					'nombreCampus' => $value['campus'],
					'FI' => $value['fecha_inicial'],
					'FF' => $value['fecha_final'],
					'lugarEvento' => $value['lugar']
				];
			}

		}


		


	}

	$respuesta = [
		'conexion' => $conexion,
		'base' => $bd,
		'consulta' => $consulta
	];


	echo json_encode($respuesta)


	
?>