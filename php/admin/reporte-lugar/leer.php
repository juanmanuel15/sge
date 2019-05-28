<?php
	
	include ('../../base1.php');

	$bd = new conexionBase();

	$bd->conectar();
	
	$query = "SELECT id_lugar, nombre_lugar, lugares FROM lugar ORDER BY nombre_lugar";
	
	$resultado = $bd->leer($query);


 
	if($resultado != false){
		while($row = $resultado->fetch_array()){
			$lugar[] = [
	    		'id' => $row[0],
	    		'nombre' => $row[1]
	    	];
		}

		$respuesta = $lugar;
	}else {
		$respuesta = ['valor'=>false];
	}


	echo json_encode($respuesta);
	

?>