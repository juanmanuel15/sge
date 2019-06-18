<?php 

	include('php/base1.php');
	

	$id_curso = $_GET['curso'];
	$usuario = $_GET['usuario'];



	$base = new ConexionBase();

	$conn = $base->conectar();


	if($conn != false){
		$query = "SELECT * FROM curso_usuario_insc WHERE id_curso = '$id_curso' AND nCuenta = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario') ";
		//echo $query;
		$resultado = $base->leer($query);

		if($resultado->num_rows == 1){
			$valor = true;
		}else {
			$valor = false;
		}

		$resultado->free();


		if($valor){

			$query = "SELECT nombre, apellidoP, apellidoM FROM usuario WHERE usuario = '$usuario'";
			$resultado = $base->leer($query);

			while($row = $resultado->fetch_array()){
        
		        $nombreUsuario = $row[0] . " " .$row[1] . " " .$row[2];

		    }


		    $resultado->free();


		    $query = "SELECT titulo FROM curso where id_curso = '$id_curso'";
		    $resultado = $base->leer($query);
		    
		    while($row = $resultado->fetch_array()){
		    	$tituloCurso = $row[0];
		    }


		    $resultado->free();


		    $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final, lugar.nombre_lugar FROM horario, lugar, curso WHERE curso.id_curso = '$id_curso' AND horario.id_lugar = lugar.id_lugar AND curso.id_curso = horario.id_curso";

		    $resultado = $base->leer($query);

		    $horario = [];

		    while ($row = $resultado->fetch_array()) {
		    	$horario [] = [
		    		'fecha' => $row[0],
		    		'HI' => $row[1],
		    		'HF' => $row[2],
		    		'lugar' => $row[3]
		    	];
		    }

		    
		    $resultado->free();


		   	$query = "SELECT usuario.nombre, usuario.apellidoP, usuario.apellidoM FROM usuario, curso, curso_usuario_org WHERE usuario.nCuenta = curso_usuario_org.nCuenta AND curso.id_curso = curso_usuario_org.id_curso AND curso.id_curso = '$id_curso' ORDER by usuario.apellidoP ASC";

			$resultado = $base->leer($query);

			$profesores = [];

			while($row = $resultado->fetch_array()){
        
		        $profesores [] = $row[0] . " " . $row[1] . " " . $row[2];

		    }


		    

			include('qr.php');

		}else {
			$respuesta = ['usuario' => false];
		}

	}else {
		$respuesta = ['base' => false];
	}


	//print_r($respuesta);







?>