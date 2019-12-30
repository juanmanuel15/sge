<?php
	require('../../../Consultas.php');
    require('../../../base1.php');

    header("Content-Type: text/html;charset=utf-8");


    $id = $_POST['id'];
    if(isset($id)){
    	$ser = false;
    	$base = new ConexionBase();
    	$conexion = $base->conectar();

    	if($conexion != false){
    		$conn = false;
    		$consulta = new Consultas();

    		$query = $consulta->editar_constancia($id);
    		$resultado = $base->leer($query);

    		foreach ($resultado as $rw) {
    			$asistente = [
    				'id' => $rw['id_constancia'],
    				'nombre' => $rw['nombre'],
    				'apellidoP' => $rw['apellidoP'],
    				'apellidoM' => $rw['apellidoM']
    			];
    		}

    		$resultado->free();




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
    	'success' => $asistente
    ];

    
    $base->cerrar();
    echo json_encode($respuesta);

?>