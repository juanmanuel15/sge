<?php

	require('../base1.php');
	//require('../../Consultas.php');

	session_start();

    if(!isset($_SESSION['prof'])){
        header('Location: ../../../profesor/index.php' );
    } else {
    	 
        if($_SERVER['REQUEST_METHOD'] == 'GET'){

    	 	 $id_curso = htmlspecialchars($_GET['id']);

    	 	if(isset($_GET['id'])){
    	 		
    	 		$base = new ConexionBase();

    	 		$conexion = $base->conectar();

    	 		if($conexion != false){

    	 			 $query = "SELECT usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.nCuenta, usuario.cuenta FROM usuario, curso_usuario_insc, curso WHERE curso.id_curso = '$id_curso' AND curso_usuario_insc.nCuenta = usuario.nCuenta AND curso_usuario_insc.id_curso = curso.id_curso order by usuario.apellidoP ASC;";

    	 			$resultado = $base->leer($query);

    	 			foreach ($resultado as $rw) {
    	 				$alumnos [] = [
    	 					'nombre' => $rw['apellidoP']. " ". $rw['apellidoM']. " ". $rw['nombre'],
    	 					'cuenta' => $rw['cuenta']
    	 				];    	 				
    	 			}

    	 			$resultado->free();


    	 			$query = "SELECT usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.nCuenta FROM usuario, curso_usuario_org, curso WHERE curso.id_curso = '$id_curso' AND curso_usuario_org.nCuenta = usuario.nCuenta AND curso_usuario_org.id_curso = curso.id_curso ORDER BY usuario.apellidoP ASC ";

    	 			$resultado = $base->leer($query);

    	 			foreach ($resultado as $rw) {
    	 				$profesores [] = [
    	 					'nombre' => $rw['nombre']. " ". $rw['apellidoP']. " ". $rw['apellidoM'],
    	 					'cuenta' => $rw['nCuenta']
    	 				];    	 				
    	 			}

    	 			$resultado->free();

    	 			$query = "SELECT titulo FROM  curso WHERE id_curso = '$id_curso'";

    	 			$resultado = $base->leer($query);

					while($row  = $resultado->fetch_array()){
			    		$curso  = [
			    			'titulo' => $row[0]
			    		];
			    	}

    	 			$resultado->free();


    	 			$query = "SELECT horario.hora_inicio, horario.hora_final, horario.fecha, lugar.nombre_lugar FROM horario, lugar, curso WHERE horario.id_lugar = lugar.id_lugar AND curso.id_curso = horario.id_curso AND curso.id_curso = '$id_curso'";

    	 			$resultado = $base->leer($query);

    	 			foreach ($resultado as $rw) {
    	 				$horario [] = [
		                'HI' => $rw['hora_inicio'],
		                'HF' => $rw['hora_final'],
		                'fecha' => $rw['fecha'],
		                'lugar' => $rw['nombre_lugar'],
		           		 ];
    	 				
    	 			}

                    //print_r($horario);

    	 			$resultado->free();

    	 			$query = "SELECT id, universidad, campus, evento from conf WHERE id = 'conf_alumnos'";

    	 			$resultado = $base->leer($query);

       	 			foreach ($resultado as $rw) {
    	 				$conf  = [
			                'id' => $rw['id'],
			                'universidad' => $rw['universidad'],
			                'campus' => $rw['campus'],
			                'evento' => $rw['evento']
			            ];
    	 				
    	 			}

    	 			$resultado->free();


                    $query = "SELECT usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.nCuenta FROM usuario, curso_usuario_resp, curso WHERE curso.id_curso = '$id_curso' AND curso_usuario_resp.nCuenta = usuario.nCuenta AND curso_usuario_resp.id_curso = curso.id_curso ORDER BY usuario.apellidoP ASC;";

                    $resultado = $base->leer($query);

                     while($row  = $resultado->fetch_array()){
                        $colaboradores [] = [
                            'nombre' => $row[0] . " " . $row[1] . " " . $row[2],
                            'cuenta' => $row[3]
                        ];
                    }

                    $resultado->free();

    	 			require('pdf/lista.php');

    	 		}
	    	}else{
                require('pdf/error.php');

            }
	    }
        else{
            require('pdf/error.php');
        }
    }


?>