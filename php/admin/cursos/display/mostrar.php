<?php

	
	require ('../../../base.php');
    require ('../../../consulta.php');
    header("Content-Type: text/html;charset=utf-8");

    $conexion = abrirConexion();

    $query = "SELECT id_curso, titulo FROM curso";


    $resultado = leerDatos($conexion, $query);

    $datos = [];

    $curso = [];
    while($row = $resultado->fetch_array()){
        
        $curso []  = [
        	'id' => $row[0],
        	'titulo' => $row[1]         
        ];


    }

    $resultado->free();

    $respuesta = datosCurso($conexion,$curso);


    cerrarConexion($conexion);

    
 	echo  json_encode($respuesta);





    function datosCurso($conexion,$curso){

	    for ($i=0; $i < sizeof($curso); $i++) { 

	    	$query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM FROM curso_usuario_org, curso, usuario WHERE curso_usuario_org.id_curso = curso.id_curso AND curso.id_curso = '".$curso[$i]['id']. "' AND usuario.nCuenta = curso_usuario_org.nCuenta";

	    	$resultado = leerDatos($conexion, $query);

			    $profesor = [];
			    while($row = $resultado->fetch_array()){
			        
			        $profesor []  = [
			        	'id' => $row[0],
			        	'nombre' => $row[1]. ' ' . $row[2]. ' ' . $row[3]
			        ];
			    }

			 $resultado->free();

			 	$query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM FROM curso_usuario_resp, curso, usuario WHERE curso_usuario_resp.id_curso = curso.id_curso AND curso.id_curso = '".$curso[$i]['id']. "' AND usuario.nCuenta = curso_usuario_resp.nCuenta";

		    	$resultado = leerDatos($conexion, $query);

				    $resp = [];
				    while($row = $resultado->fetch_array()){
				        
				        $resp []  = [
				        	'id' => $row[0],
				        	'nombre' => $row[1]. ' ' . $row[2]. ' ' . $row[3]
				        ];
				    }

				 $resultado->free();


				$query = "SELECT horario.hora_inicio, horario.hora_final, horario.fecha, lugar.nombre_lugar FROM horario, lugar, curso WHERE horario.id_lugar = lugar.id_lugar AND curso.id_curso = horario.id_curso AND curso.id_curso = '". $curso[$i]['id']. "';";

		    	$resultado = leerDatos($conexion, $query);

				    $horario = [];
				    while($row = $resultado->fetch_array()){
				        
				        $horario []  = [
				        	'HI' => $row[0],
				        	'HF' => $row[1],
				        	'fecha' => $row[2],
				        	'lugar' => $row[3]
				        ];
				    }

				$resultado->free();

				


				$query = "SELECT curso.lugares,  COUNT(curso_usuario_insc.id_curso = '" .$curso[$i]['id'] ."') AS inscritos FROM curso, curso_usuario_insc WHERE curso_usuario_insc.id_curso = curso.id_curso AND curso.id_curso = '" .$curso[$i]['id'] ."'";

				$resultado = leerDatos($conexion, $query);
				$lugares = [];

				while($row = $resultado->fetch_array()){

					$lugares [] = [						
						'inscritos' => $row[1],
						'lugares' => $row[0]
					];
				}

				$resultado->free();

				




						 $respuesta [] =[
						 	'curso' => $curso[$i],
						 	'prof' => $profesor,
						 	'resp' => $resp,
						 	'horario' => $horario,
						 	'lugar' => $lugares

						 ]; 
	    }


	    return $respuesta;




	}


   	 





?>

   