<?php

	include ('elimina_acentos.php');
	require ('../../base.php');
    require ('../../consulta.php');

    header("Content-Type: text/html;charset=utf-8");

	$titulo  = $_POST['titulo'];
	$descripcion  = $_POST['descripcion'];
	$requisitos = $_POST['requisitos'];
	$tActividad  = $_POST['tActividad'];
	$dirigido  = $_POST['dirigido' ];


	$profesor  = $_POST['profesor'];
	
	$responsable  = $_POST['responsable'];
	$fecha = $_POST['fecha'];
	$horaI  = $_POST['horaI' ];
	$horaF = $_POST['horaF'];
	$lugar  = $_POST['lugar'];
	$req  = $_POST['req'];
	$material  = $_POST['material'];
	$cantidadMaterial = $_POST['cantidadMaterial'];


	if(!isset($titulo, $descripcion, $requisitos, $tActividad, $dirigido, $profesor, $responsable, $fecha, $horaI, $horaF, $lugar, $req, $material, $cantidadMaterial)){

	}else{

		$conexion = abrirConexion();


		$id_curso = id_curso($titulo);
		$tActividad = $tActividad[0];
		
		if(!vacio($titulo) || !vacio($descripcion) || !vacio($requisitos) || !vacio($dirigido) || $tActividad == ''){

			$queryCurso  = "INSERT INTO curso (id_curso, titulo, id_tipo_actividad, descripcion, prerrequisitos, dirigido) VALUES('$id_curso', '$titulo', $tActividad, '$descripcion', '$requisitos', '$dirigido');";

			$curso = false;		
		}

		else {
			$curso = true;
		}

		


	}



	function id_curso($cadena){
		
		$cadena = str_replace(' ', '', $cadena);
		$cadena = elimina_acentos($cadena);
		$cadena = substr($cadena, 0, 5);
		
		return $id = date('dmy').$cadena;

	}

?>