<?php

	session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

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
	$respuesta = [];

	if(isset($_POST['id_usuario']) &&  isset($_POST['id_curso'])){
		$servidor = false;

		$id_usuario = $_POST['id_usuario'];
		$id_curso = $_POST['id_curso'];

		if(empty($id_curso) || empty($id_usuario)){
			$vacio = true;
		}else {
			$vacio = false;

			$conexion = $base->conectar();

			if($conexion != false ){

				$conn = false;

				$query = $consulta->comprobarInscrito($id_usuario, $id_curso);

				$resultado = $base->leer($query);

				if($resultado->num_rows>0){
					$inscrito = true;
					$lugar = true;
					$traslape = true;
					$insertado = false;
				}else {
					$inscrito = false;

					$query = $consulta->lugares($id_curso);
					$resultado = $base->leer($query);
					

					foreach ($resultado as $lugar) {
						$lugares = (int)$lugar['cupo'];
					}

					$resultado->free();


					if($lugares == 0){
						$lugar = true;

					}else {
						$lugar = false;

						$query = $consulta->horarioCurso($id_curso);
						$resultado = $base->leer($query);

						$horarioCurso = [];

						foreach ($resultado as $horario) {
							$horarioCurso [] = [
								'fecha' => $horario['fecha'],
								'HI' => $horario['hora_inicio'],
								'HF' => $horario['hora_final']
							];	
						}

						$resultado->free();


						$query = $consulta->horarioOcupadosInscritos($id_usuario);
						$resultado = $base->leer($query);

						$horarioOcupadoInscrito = [];

						foreach ($resultado as $horario) {
							$horarioOcupadoInscrito [] = [
								'fecha' => $horario['fecha'],
								'HI' => $horario['hora_inicio'],
								'HF' => $horario['hora_final']
							];	
						}

						$resultado->free();


						$query = $consulta->horarioCursosResponsable($id_usuario);
						$resultado = $base->leer($query);

						$horarioOcupadoResp = [];

						foreach ($resultado as $horario) {
							$horarioOcupadoResp [] = [
								'fecha' => $horario['fecha'],
								'HI' => $horario['hora_inicio'],
								'HF' => $horario['hora_final']
							];	
						}

						$resultado->free();


						$query = $consulta->horarioCursosImpartidos($id_usuario);
						$resultado = $base->leer($query);

						$horarioOcupadoProf = [];

						foreach ($resultado as $horario) {
							$horarioOcupadoProf [] = [
								'fecha' => $horario['fecha'],
								'HI' => $horario['hora_inicio'],
								'HF' => $horario['hora_final']
							];	
						}

						$resultado->free();

						

						$traslapeInscrito = algoritmoTraslape($horarioCurso, $horarioOcupadoInscrito);
						$traslapeProf = algoritmoTraslape($horarioCurso, $horarioOcupadoProf);
						$traslapeResp = algoritmoTraslape($horarioCurso, $horarioOcupadoResp);

						

						if($traslapeInscrito !== false || $traslapeProf !== false || $traslapeResp !== false){
				            $traslape = true;
				            $insertado = false;
				        }else {
				            $traslape = false;

				            $query = $consulta->insertarUsuarioCurso($id_curso, $id_usuario);

				            $resultado = $base->insertar($query);


				            if($resultado != true){
				            	$insertado = false;
				            }else {
				            	$insertado = true;
				            }
				        }
					}
				}

			}else {
				$conn = true;
			}

			
		}

	}else {
		$servidor = true;
		$traslape = true;
	}


	$respuesta = [
		'servidor' => $servidor,
		'conn' => $conn,
		'inscrito' => $inscrito,
		'vacio' => $vacio,
		'lugar' => $lugar,
		'traslape' => $traslape,
		'success' => $insertado
	];



	echo json_encode($respuesta);



	function fecha($fecha){
        $fecha = str_replace('-', '', $fecha);
        return $fecha;
    }

    function hora($hora){
        $hora = str_replace(':', '', $hora);
        $hora = substr($hora, 0, -2);
        //print_r($hora);
        return $hora;
    }

    function algoritmoTraslape($horarioOcupado, $horarioCurso){
    	$traslape = [];

		for($i = 0; $i<sizeof($horarioOcupado); $i++){

			for ($j=0; $j < sizeof($horarioCurso) ; $j++) { 

				$fecha1 = fecha($horarioOcupado[$i]['fecha']);
				$fecha2 = fecha($horarioCurso[$j]['fecha']);
				$HI1 = hora($horarioOcupado[$i]['HI']);
				$HI2 = hora($horarioCurso[$j]['HI']);
				$HF1 = hora($horarioOcupado[$i]['HF']);
				$HF2 = hora($horarioCurso[$j]['HF']);

				//echo "$fecha1  == $fecha2 <br>";
				//
				if($fecha1 == $fecha2){
					//echo "$HI1<$HI2 AND $HI1< $HF2 AND $HF1<= $HI2 AND $HF1 < $HF2 ";
					if($HI1<$HI2 && $HI1< $HF2 && $HF1<= $HI2 && $HF1 < $HF2){
						$traslape[] = false;

					}else {
						$traslape [] = true;
					}
				}else {
					$traslape [] = false;
				}
			}
		}


		return $traslape = array_search(true, $traslape);
    }

?>