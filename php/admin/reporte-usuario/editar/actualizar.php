<?php

	require('../../../Consultas.php');
    require('../../../base1.php');

    header("Content-Type: text/html;charset=utf-8");


    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidoP = $_POST['apellidoP'];
    $apellidoM = $_POST['apellidoM'];
    if(isset($id)){
    	$ser = false;
    	$base = new ConexionBase();
    	$conexion = $base->conectar();

    	if($conexion != false){
    		$conn = false;
    		$consulta = new Consultas();

    		$query = $consulta->actualizar_constancia($id, $nombre, $apellidoP, $apellidoM);
    		$resultado = $base->leer($query);

    		if($resultado != false){
    			$success = true;
    		}else{
    			$success = false;
    		}

    		




    	}else{
    		$conn = true;
    		$asistente = true;
    	}
    }else{
    	$ser = true;
    	$conn = true;
    	$asistente = true;
    }




    $respuesta = [
    	'serv' => $ser,
    	'conn' => $conn, 
    	'success' => $success
    ];

    
    $base->cerrar();
    echo json_encode($respuesta);






?>