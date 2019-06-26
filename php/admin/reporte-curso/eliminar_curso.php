<?php
	
	require ('../../base.php');
    require ('../../consulta.php');
    header("Content-Type: text/html;charset=utf-8");

    $conexion = abrirConexion();

    if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
        $respuesta = ['base' => false];

    } else {

    	$id_curso = $_POST['id'];
        $id_usuario = $_POST['usuario'];


    	if($id_curso != ''){

    		$query = "DELETE FROM curso_usuario_insc WHERE id_curso = '$id_curso' AND nCuenta = '$id_usuario'";
    		$resultado = eliminarDatos($conexion, $query);

    		if($resultado['valor'] == true){
    			$respuesta = true;
    		}else{
    			$respuesta = false;
    		}

    		
    		

    	}else {
    		$respuesta = ['metodo' => false];
    	}





    }




    echo json_encode($respuesta);

	


?>