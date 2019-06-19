<?php
	
	require ('../base.php');
    require ('../consulta.php');
    header("Content-Type: text/html;charset=utf-8");

    $conexion = abrirConexion();

    if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
        $respuesta = false;

    } else {

    	$id_curso = $_POST['id'];
        $id_usuario = $_POST['usuario'];


    	if($id_curso != ''){

    		$query = "DELETE FROM curso_usuario_insc WHERE id_curso = '$id_curso' AND nCuenta = (SELECT nCuenta FROM usuario WHERE usuario = '$id_usuario')";
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