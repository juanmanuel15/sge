
<?php
    
    

	require ('../base.php');
    require ('../consulta.php');

    header("Content-Type: text/html;charset=utf-8");


    if(!$_SERVER['REQUEST_METHOD'] == 'GET'){
        $respuesta = false;

    } else {
    	$conexion = abrirConexion();

    	if(!$conexion){
    		
    	}else {
    		$query = "SELECT id_curso, titulo FROM curso";
    		$resultado = leerDatos($conexion, $query);

    		$curso = [];

    		while ($row = $resultado->fetch_array()) {
    			$curso [] = [
    				'id' => $row[0],
    				'titulo' => $row[1]
    			];
    		}

    		$respuesta = $curso;


    	}    	


    }


    echo json_encode($respuesta);
	
?>
