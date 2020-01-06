<?php
	


	include ('elimina_acentos.php');
	require ('../../base.php');
    require ('../../consulta.php');

    header("Content-Type: text/html;charset=utf-8");

	$titulo  = quitarCaracteres($_POST['titulo']);
	$descripcion  = quitarCaracteres($_POST['descripcion']);
	$requisitos = quitarCaracteres($_POST['requisitos']);
	$tActividad  = quitarCaracteres($_POST['tActividad']);
	$dirigido  = quitarCaracteres($_POST['dirigido' ]);
	$cantidad = quitarCaracteres($_POST['cantidad']);


	$profesor  = quitarCaracteres($_POST['profesor']);	
	$responsable  = quitarCaracteres($_POST['responsable']);
	$fecha = quitarCaracteres($_POST['fecha']);
	$horaI  = quitarCaracteres($_POST['horaI']);
	$horaF = quitarCaracteres($_POST['horaF']);
	$lugar  = arrayInt(quitarCaracteres($_POST['lugar']));
	$req  = quitarCaracteres($_POST['req']);
	$material  = quitarCaracteres($_POST['material']);
	$cantidadMaterial = quitarCaracteres($_POST['cantidadMaterial']);


	if(!isset($titulo, $descripcion, $requisitos, $tActividad, $dirigido, $profesor, $responsable, $fecha, $horaI, $horaF, $lugar, $req, $material, $cantidadMaterial, $cantidad)){
		//Valores, cuando no esta definida alguna variable
		
	}else {

		$query = "";
		$valores_repetidos = [];
		$vacioMaterial;
		//Valores, cuando estan definidas todas las variables
		$conexion = abrirConexion();

		$id_curso = id_curso($titulo);


		// Insertamos los valores para la tabla Cursos
		$tActividad = $tActividad[0];
	
		if(!vacio($titulo) || !vacio($descripcion) || !vacio($requisitos) || !vacio($dirigido) || $tActividad == ''  || !vacio($cantidad)){
			$vacioTitulo = false; 
		}

		else {
			$vacioTitulo = true;
		}

		if(count($profesor) > count(array_unique($profesor))){
			$igualProfesor = true; 
		} else {
			$igualProfesor = false;				
		}

		if (count($responsable) > count(array_unique($responsable))){
			$igualResponsable = true; 
		} else {
			$igualResponsable = false;
		}





		
		$hora = [];
		$mayorHora = [];
		//print_r($horaI);
		//print_r($horaI = (int)$horaI[0]);

		// Verificamos que el valor de las horas no sea el mismo. 
		//Si es el mismo marca TRUE, de lo contrario marca FALSE
		if(count($horaI) == 1 && count($horaF) == 1){

			if($horaI != $horaF){
					$igualHora= false;
				}else {
					$igualHora= true; 
				}
		}else {
			for ($i=0; $i <sizeof($horaI); $i++) { 

				$horaI[$i] = trim($horaI[$i]);
				$horaF[$i] = trim($horaF[$i]);

				if($horaI[$i] != $horaF[$i]){
					$hora [] = false; 
				}else {
					$hora[] = true; 
				}
				
			}

			if (count($hora) > count(array_unique($hora))) {
			$igualHora = false;
			}else {
				$igualHora = true;
			}
		}

		//Si HF>HI = TRUE, HI<HF = FALSE

		$horaI1 = arrayIntHora($horaI);
		$horaF1 = arrayIntHora($horaF);

		$hora = [];

		if( count($horaI1) == 1 && count($horaF1) == 1){
		
			if($horaF1[0] > $horaI1[0]){
					$mayorHora= false;
				}else {
					$mayorHora= true; 
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

			if (count($hora) > count(array_unique($hora))) {
				$mayorHora = false;
			}else {
				$mayorHora = true;
			}
		}

		

		if(count($req) > count(array_unique($req))){
			$igualReq = true;
		}else {
			$igualReq = false;
		}



		


		$material = arrayLower($material);
		$vacioMaterial = arrayVacio($material);
		$vacioCantidadMaterial = arrayVacio($cantidadMaterial);

		$vacioMaterial = arrayValidar(array_unique($vacioMaterial));
		$vacioCantidadMaterial = arrayValidar(array_unique($vacioCantidadMaterial));


		
		if (count($material) > count(array_unique($material))) {
			$igualMaterial = true;

		}else{
			$igualMaterial = false;
		}

		$datos = [
		'titulo' => $vacioTitulo,
		'profesor' => $igualProfesor,
		'responsable' => $igualResponsable,
		'horario' => $igualHora,
		'mayorHora' => $mayorHora,
		'req' => $igualReq,
		'material' => $igualMaterial,
		'materialVacio' => $vacioMaterial,
		'cantidadMaterial' => $vacioCantidadMaterial
		];


		if(count(array_unique($datos)) == 1){

			

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

				
				for ($i=0; $i <count($material) ; $i++) { 
					$queryMaterial = "INSERT INTO material (nombre_material, cantidad, id_curso) VALUES ('$material[$i]', $cantidadMaterial[$i], '$id_curso');";
					$respMaterial [] = $conexion->query($queryMaterial);
					
				}

				

				$resp [] = ['curso' => $respCurso];
				$resp [] = ['profesor' => $respProfesor];
				$resp [] = ['responsable' => $respResponsable];
				$resp [] = ['horario' => $respHorario];
				$resp [] = ['req' => $respReq];
				$resp [] = ['material' => $respMaterial]; 

				$respuesta = $resp;

			} else {

				$respuesta = ['curso' => false];
			}


			
		
		}
		else {
			$resp = [];

			if($vacioMaterial || $vacioCantidadMaterial || $igualMaterial){
				$igualMaterial = true;
			}else {
				$igualMaterial = false;
			}

			if($igualHora || $mayorHora){
				$igualHora = true;
			}else {
				$igualHora = false;
			}

			$resp [] = ['curso' => false];
			$resp [] = ['profesor' => !$igualProfesor];
			$resp [] = ['responsable' => !$igualResponsable];
			$resp [] = ['horario' => !$igualHora];
			$resp [] = ['req' => !$igualReq];
			$resp [] = ['material' => !$igualMaterial];

			$respuesta = $resp;
		}


		//print_r($respuesta);

	$conexion->close();
	echo  json_encode($respuesta);


	}


	function id_curso($cadena){
		
		$cadena = str_replace(' ', '', $cadena);
		$cadena = str_replace('/', '', $cadena);
		$cadena = str_replace('*', '', $cadena);
		$cadena = str_replace('^', '', $cadena);
		$cadena = elimina_acentos($cadena);

		if(strlen($cadena)<8){
			$cadena = substr($cadena, 0, strlen($cadena));	
		}else {
			$cadena = substr($cadena, 0, 10);	
		}
		
		
		return $id = date('dmy').$cadena;

	}

	function vacio($variable) {
		if(empty($variable))
			return true;
		else
			return false;
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
	

?>