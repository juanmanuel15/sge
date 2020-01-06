<?php

	require('../../base1.php');
	require('../../Consultas.php');

	//echo 'Hola' . htmlspecialchars($_COOKIE["user"]);
	
	if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
        $serv = true;
     }else {
     	$serv = false;

     	$usuario = $_POST['user'];

     	$base = new ConexionBase();
     	$consulta = new Consultas();

     	$conexion = $base->conectar();

     	if($conexion != false){
     		$conn = false;

     		$query = $consulta->leer_cursosRegistrados($usuario);
     		$resultado = $base->leer($query);
     		//var_dump($resultado);
     		if($resultado->num_rows>0){
     			foreach ($resultado as $rw ) {
     			$cursos [] = [
     				'titulo' => $rw['titulo'],     				
     				'id_usuario' => $rw['nCuenta'],
     				'id_curso' => $rw['id_curso']
	     			];
	     		}

	     		//print_r($cursos);
	     		//echo $cursos[0];

	     		for ($i=0; $i < sizeof($cursos) ; $i++) { 
	     			
	     			$query = $consulta->leer_inscritos($cursos[$i]['id_curso']);

	     			$resultado = $base->leer($query);

	     			foreach ($resultado as $rw) {
	     				$inscritos = (int)$rw['inscritos'];
	     			}

	     			
	     			$query = $consulta->leer_usuarioTotales($cursos[$i]['id_curso']);

	     			$resultado = $base->leer($query);

	     			foreach ($resultado as $rw) {
	     				$lugares = (int)$rw['lugares'];
	     			}


	     			$relacion [] = [ 
	     				'inscritos' => $inscritos,
	     				'lugares' => $lugares
	     			];


	     		}


	     		$success = [ 
	     			'cursos' => $cursos,
	     			'relacion' => $relacion
	     		];

     		}else {
     			$success = false;
     		}

     	}else{
     		$conn = true;
     	}



     }

     $respuesta = [
     		'serv' => $serv,
     		'conn' => $conn,
     		'success' => $success
     	];


     	echo json_encode($respuesta);


?>