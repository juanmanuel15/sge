<?php
	
	require ('../../../base.php');
    require ('../../../consulta.php');
    header("Content-Type: text/html;charset=utf-8");

    $conexion = abrirConexion();

    if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
        $respuesta = false;

    } else {

    	$id = $_POST['id'];


    	if($id != ''){

    		$query = "DELETE FROM curso WHERE id_curso = '$id'";
    		$resultado = eliminarDatos($conexion, $query);

    		if($resultado['valor']){
    			$respuesta = true;
    		}else{
    			$respuesta = false;
    		}

    		
    		

    	}else {
    		$respuesta = false;
    	}





    }




    echo json_encode($respuesta);





?>