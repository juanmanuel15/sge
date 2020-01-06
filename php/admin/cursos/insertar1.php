<?php

	


	include ('elimina_acentos.php');
	require ('../../base.php');
    require ('../../consulta.php');

    header("Content-Type: text/html;charset=utf-8");
    date_default_timezone_set('America/Mexico_City');

	$titulo  = quitarCaracteres($_POST['titulo']);
	$descripcion  = quitarCaracteres($_POST['descripcion']);
	$requisitos = quitarCaracteres($_POST['requisitos']);
	$tActividad  = quitarCaracteres($_POST['tActividad']);
	$dirigido  = quitarCaracteres($_POST['dirigido' ]);
	$cantidad = quitarCaracteres($_POST['cantidad']);
	$radioMaterial = quitarCaracteres($_POST['radioMaterial']);


	$profesor  = quitarCaracteres($_POST['profesor']);	
	$responsable  = quitarCaracteres($_POST['responsable']);
	$fecha = quitarCaracteres($_POST['fecha']);
	$horaI  = quitarCaracteres($_POST['horaI']);
	$horaF = quitarCaracteres($_POST['horaF']);
	$lugar  = arrayInt(quitarCaracteres($_POST['lugar']));
	$req  = quitarCaracteres($_POST['req']);
	$material  = quitarCaracteres($_POST['material']);
	$cantidadMaterial = quitarCaracteres($_POST['cantidadMaterial']);


	if(!isset($titulo, $descripcion, $requisitos, $tActividad, $dirigido, $profesor, $responsable, $fecha, $horaI, $horaF, $lugar, $req, $material, $cantidadMaterial)){


		$respuesta [0] = ['curso' => false];

	}else{	

		$conexion= abrirConexion();

		$id_curso = id_curso($titulo);	



		$datosBasicos  = [$titulo, $descripcion, $requisitos, $dirigido, $cantidad];

		if(camposVacios($datosBasicos) || camposVacios($profesor) || camposVacios($responsable) || camposVacios($fecha) || camposVacios($horaI) || camposVacios($horaF) || camposVacios($lugar) || camposVacios($req)){
			$respuesta [0] = ['curso' => false];

		}else {


			$profesorRepetido = valoresRepetidos($profesor);
			$responsableRepetido = valoresRepetidos($responsable);
			$reqRepetido = valoresRepetidos($req);
			$horaMayor = mayorHora($horaI, $horaF);
			$horaIgual = horaIgual($horaI, $horaF);
			
			

			if($radioMaterial == 'false'){
				$vacios = [
					$profesorRepetido,
					$responsableRepetido,
					$reqRepetido,
					$horaMayor,
					$horaIgual
				];

				$materialVacio = false;
				$cantidadMaterialVacio = false;
				
			}
			else {
				$materialVacio = camposVacios(arrayLower($material));
				$cantidadMaterialVacio = camposVacios($cantidadMaterial);

				$vacios = [
					$profesorRepetido,
					$responsableRepetido,
					$reqRepetido,
					$horaMayor,
					$horaIgual,
					$materialVacio,
					$cantidadMaterialVacio

				];
				
			}

			

			#Buscamos un valor true dentro de nuestra cadena.


			if(array_search(true, $vacios)){
				$respuesta = $vacios;
			} else {

				$tActividad = $tActividad[0];


				$queryCurso  = "INSERT INTO curso (id_curso, titulo, id_tipo_actividad, descripcion, prerrequisitos, dirigido, lugares) VALUES('$id_curso', '$titulo', $tActividad, '$descripcion', '$requisitos', '$dirigido', '$cantidad')";

				$respCurso = $conexion->query($queryCurso);	

				if($respCurso){

					$resp =[];

				

					for ($i=0; $i <count($profesor) ; $i++) { 
			
						$profesor[$i] = trim($profesor[$i]);
						$queryProfesor =  "INSERT INTO curso_usuario_org (id, nCuenta, id_curso) VALUES (NULL, '$profesor[$i]', '$id_curso');";
						$respProfesor [] = $conexion->query($queryProfesor);
					}

					
					foreach ($responsable as $key ) {
					
						$queryResponsable = "INSERT INTO curso_usuario_resp (id, nCuenta, id_curso) VALUES (NULL, '$key', '$id_curso');";
						$respResponsable [] = $conexion ->query($queryResponsable);

					}

					
					
					for ($i=0; $i <count($fecha) ; $i++) { 
						$queryHorario = "INSERT INTO horario (fecha, hora_inicio, hora_final, id_curso, id_lugar) VALUES ('$fecha[$i]', '$horaI[$i]', '$horaF[$i]' , '$id_curso', '$lugar[$i]');";
						$respHorario [] = $conexion->query($queryHorario); 
					}

					
					foreach ($req as $key) {
						$queryReq = "INSERT INTO req_curso (id_req, id_curso) VALUES ('$key', '$id_curso');";
						$respReq [] = $conexion->query($queryReq);
					}

					if(!$radioMaterial == 'false'){

						for ($i=0; $i <count($material) ; $i++) { 
						$queryMaterial = "INSERT INTO material (nombre_material, cantidad, id_curso) VALUES ('$material[$i]', $cantidadMaterial[$i], '$id_curso');";
						$respMaterial [] = $conexion->query($queryMaterial);
						
						}

					}else {
						$respMaterial [] = true;
					}


					


					$resp [] = ['curso' => $respCurso];
					$resp [] = ['profesor' => $respProfesor];
					$resp [] = ['responsable' => $respResponsable];
					$resp [] = ['horario' => $respHorario];
					$resp [] = ['req' => $respReq];
					$resp [] = ['material' => $respMaterial]; 

					
					
					$respuesta = $resp;
				}

				else {
					$respuesta [0] = ['curso' => false];
				}
			}
		}

		

	}

	$conexion->close();


	//$respuesta [0] = ['curso' => false];

	echo json_encode($respuesta);


	function camposVacios($array){

		if(is_array($array)) {

			$valor = [];
			for ($i=0; $i <count($array) ; $i++) { 
				if(empty($array[$i])) {
					$valor []= true;
				}else {
					$valor []= false;
				}
			}

			$respuesta =  in_array(true, $valor);

		}else {
			if (empty($array)) {
					$respuesta = true;
				}else {
					$respuesta = false;
			}			
		}

		return $respuesta;
		
	}


	function valoresRepetidos($array){
		if(count($array) > count(array_unique($array))){
			$respuesta = true; 
		} else {
			$respuesta = false;				
		}


		return $respuesta;
	}



	function id_curso($cadena){
		
		$cadena = str_replace(' ', '', $cadena);
		$cadena = str_replace('/', '', $cadena);
		$cadena = str_replace('*', '', $cadena);
		$cadena = str_replace('^', '', $cadena);
		$cadena = elimina_acentos($cadena);

		$porcentaje = strlen($cadena)*0.8;
		

		if(strlen($cadena)>=10){
			$cadena = substr($cadena, 0, 8);	
		}else {
			$cadena = substr($cadena, 0, $porcentaje);
		}
		
		
		return $id = date('dmyhi').$cadena;

	}

	


	function arrayLower($array){
		if(is_array($array)){
			$array_lower = [];
		
		for ($i=0; $i <count($array) ; $i++) { 			
			$array_lower [] =  strtolower(trim($array[$i]));
			}

			return $array_lower;
		}

		else {
			return false;
		}

	}

	function arrayVacio($array){
		$vacio = [];
		for ($i=0; $i < count($array); $i++) { 
			
			if($array[$i] == ''){
				$vacio [] = true;
			}else {
				$vacio [] =false;
			}
		}

		return $vacio;
	}

	function convertir_string($array){
		$string = '';

		if(sizeof($array) == 1){			
			$string = $array[0];
		}

		else {
			$string = false;
		}
		
		return $string;
		
	}

	function arrayValidar($array){
		$tamano = sizeof($array);

		if($tamano>1){
			$string = true;
		}else if($tamano == 1){
			$string = $array[0];
		}

		return $string;
	}

	function quitarCaracteres($array){
		
		if(is_array($array)){
			$resp = [];

			for ($i=0; $i <count($array) ; $i++) { 
				$resp [] = htmlspecialchars(trim($array[$i]));
			}
		}else {
			$resp = htmlspecialchars(trim($array));
		}

		return $resp;
	}
	
	function arrayIntHora($array){
		$resp = [] ;

		for ($i=0; $i <count($array) ; $i++) { 
			

			if($array[$i] == 0){
				$resp [] = 24;
			}else {
				$resp []= (int)$array[$i];
			}
		}

		return $resp;
 	}

 	function arrayResp($array){
 		$array = array_unique($array);

 		if(count($array == 1)){
 			$resp = $array[0];
 		}else {
 			$resp = false;
 		}

 		return $resp;
	}
	 
	function arrayInt($array){
		$resp = [] ;

		for ($i=0; $i <count($array) ; $i++) { 			
				$resp []= (int)$array[$i];			
		}

		return $resp;
 	}


 	function mayorHora($horaI, $horaF){

		//Si HF>HI = TRUE, HI<HF = FALSE

		$horaI1 = arrayIntHora($horaI);
		$horaF1 = arrayIntHora($horaF);

		$hora = [];

		if( count($horaI1) == 1 && count($horaF1) == 1){
		
			if($horaF1[0] > $horaI1[0]){
					$horaMayor = false;
				}else {
					$horaMayor = true; 
				}
		}else {
			for ($i=0; $i <sizeof($horaI); $i++) { 
				//echo ($horaF1[$i] . ">" . $horaI1[$i] . "\n");
				if($horaF1[$i] < $horaI1[$i] ){
					$hora[] = true;
				//	echo "hola";
				}else {
					$hora[] = false;
				//	echo "adios";
				}

				
			}
			//print_r($hora);


			$horaMayor = !camposVacios($hora);

			
		}

		return $horaMayor;
	}


		function horaIgual($horaI, $horaF){
				$hora = [];
				$mayorHora = [];

				// Verificamos que el valor de las horas no sea el mismo. 
				//Si es el mismo marca TRUE, de lo contrario marca FALSE
				if(count($horaI) == 1 && count($horaF) == 1){

					if($horaI != $horaF){
							$horaIgual= false;
						}else {
							$horaIgual= true; 
						}
				}else {

					$horaIgual;
					for ($i=0; $i <sizeof($horaI); $i++) { 

						$horaI[$i] = trim($horaI[$i]);
						$horaF[$i] = trim($horaF[$i]);

						if($horaI[$i] != $horaF[$i]){
							$hora [] = false; 
						}else {
							$hora[] = true; 
						}
						
					}

					$horaIgual = !valoresRepetidos($hora);

					
				}

				return $horaIgual;
			}



?>