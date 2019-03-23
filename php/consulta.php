<?php


	# Esta función es de consulta, es decir, solo retornará el valor del query enviado.

	function insertarDatos($conexion, $query){
		if ($conexion->connect_errno) {
        $respuesta = [
        	'valor' => false
        ];
    	}

    	else {

    		if($respuesta = $conexion->query($query))
    			$respuesta = [
    				'valor' => true
    			];
    	}

    	return $respuesta;
	}

	function leerDatos($conexion, $query){
		if ($conexion->connect_errno) {
        $respuesta = [
        	'valor' => false
        ];
    	}
    	else {
    		$respuesta = $conexion->query($query);
     	}

     	return $respuesta;
	}


	function eliminarDatos($conexion, $query){
		if ($conexion->connect_errno) {
        $respuesta = [
        	'valor' => false
        ];
    	}

    	else {

    		if($respuesta = $conexion->query($query)){
    			$respuesta = [
    				'valor' => true
    			];
    		}else {
    			$respuesta = [
		        	'valor' => false
		        ];
    		}

    	}
    	return $respuesta;
	}

    


    
	

    

?>