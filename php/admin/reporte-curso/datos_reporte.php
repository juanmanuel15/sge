<?php

	require ('../../base.php');
    require ('../../consulta.php');

    header("Content-Type: text/html;charset=utf-8");

    function alumno($id){

    	$conexion = abrirConexion();

    	$query = "SELECT usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.nCuenta FROM usuario, curso_usuario_insc, curso WHERE curso.id_curso = '$id' AND curso_usuario_insc.nCuenta = usuario.nCuenta order by usuario.apellidoP ASC; ";

    	$resultado = leerDatos($conexion, $query);

    	$respuesta = [];

    	while($row  = $resultado->fetch_array()){
    		$respuesta [] = [
    			'nombre' => $row[1] . " " . $row[2] . " " . $row[0],
    			'cuenta' => $row[3]
    		];
    	}

    	$resultado->free();
    	cerrarConexion($conexion);

    	return $respuesta;
    }


    function profesor($id){

    	$conexion = abrirConexion();

    	$query = "SELECT usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.nCuenta FROM usuario, curso_usuario_org, curso WHERE curso.id_curso = '$id' AND curso_usuario_org.nCuenta = usuario.nCuenta ORDER BY usuario.apellidoP ASC;";

    	$resultado = leerDatos($conexion, $query);

    	$respuesta = [];

    	while($row  = $resultado->fetch_array()){
    		$respuesta [] = [
    			'nombre' => $row[1] . " " . $row[2] . " " . $row[0],
    			'cuenta' => $row[3]
    		];
    	}

    	$resultado->free();
    	cerrarConexion($conexion);

    	return $respuesta;
    }



    function curso($id){

    	$conexion = abrirConexion();

    	$query = "SELECT titulo FROM  curso WHERE id_curso = '$id'";

    	$resultado = leerDatos($conexion, $query);

    	

    	while($row  = $resultado->fetch_array()){
    		$respuesta  = [
    			'titulo' => $row[0]
    		];
    	}

    	$resultado->free();
    	cerrarConexion($conexion);

    	return $respuesta;

    }    
    







?>