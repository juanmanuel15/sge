<?php

	require('../../base.php');
    require('../../consulta.php');

    

    if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
        $respuesta = [
        	'inscrito' => true
        ];

    } else {

    	$id_curso = filter_var(trim($_POST['curso']),FILTER_SANITIZE_STRING);
    	$usuario = filter_var(trim($_POST['usuario']),FILTER_SANITIZE_STRING);

        

    	if(empty($id_curso) || empty($usuario)){
    		$respuesta = [
    			'inscrito' => true
    		];
    	}else {

    		$conexion = abrirConexion();

    		if(!$conexion){
    			$respuesta = [
    				'inscrito' => true
    			];
    		}   		
    		
    		else {

    			#Obtenemos el valor de nCuenta através de Usuario
    			$query = "SELECT nCuenta FROM usuario WHERE usuario = '$usuario'";        
		        $resultado = $conexion->query($query);
		        $nCuenta = $resultado->fetch_array();		        
		        $nCuenta = $nCuenta[0];
		        $resultado->free();

		        #Obtenemos los cursos a los que esta inscrito
		        $query = "SELECT * FROM curso_usuario_insc WHERE nCuenta = '$nCuenta' AND id_curso = '$id_curso'";
		        $resultado = leerDatos($conexion, $query);

		        if($resultado->num_rows>0){
		        	$respuesta = ['inscrito' => true];
		        }else{
		        	$respuesta = ['inscrito' => false];
		        }

		        



    		}
    		
    	}

    }


    echo json_encode($respuesta);

?>