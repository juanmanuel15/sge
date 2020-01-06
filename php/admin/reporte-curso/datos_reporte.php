<?php

    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

	require ('../../base.php');
    require ('../../consulta.php');

    header("Content-Type: text/html;charset=utf-8");

    function alumno($id){

    	$conexion = abrirConexion();

    	$query = "SELECT usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.nCuenta, usuario.cuenta FROM usuario, curso_usuario_insc, curso WHERE curso.id_curso = '$id' AND curso_usuario_insc.nCuenta = usuario.nCuenta AND curso_usuario_insc.id_curso = curso.id_curso order by usuario.apellidoP ASC; ";

    	$resultado = leerDatos($conexion, $query);

    	$respuesta = [];

    	while($row  = $resultado->fetch_array()){
    		$respuesta [] = [
    			'nombre' => $row[1] . " " . $row[2] . " " . $row[0],
    			'cuenta' => $row[4]
    		];
    	}

    	$resultado->free();
    	cerrarConexion($conexion);

    	return $respuesta;
    }


    function profesor($id){

    	$conexion = abrirConexion();

    	$query = "SELECT usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.nCuenta FROM usuario, curso_usuario_org, curso WHERE curso.id_curso = '$id' AND curso_usuario_org.nCuenta = usuario.nCuenta AND curso_usuario_org.id_curso = curso.id_curso ORDER BY usuario.apellidoP ASC;";

    	$resultado = leerDatos($conexion, $query);

    	$respuesta = [];

    	while($row  = $resultado->fetch_array()){
    		$respuesta [] = [
    			'nombre' => $row[1] . " " . $row[2] . " " . $row[0],
    			'cuenta' => $row[3]
    		];
    	}

    	$resultado->free();
    	cerrarConexion($conexion);

    	return $respuesta;
    }



    function curso($id){

    	$conexion = abrirConexion();

    	$query = "SELECT titulo FROM  curso WHERE id_curso = '$id'";

    	$resultado = leerDatos($conexion, $query);

    	

    	while($row  = $resultado->fetch_array()){
    		$respuesta  = [
    			'titulo' => $row[0]
    		];
    	}

    	$resultado->free();
    	cerrarConexion($conexion);

    	return $respuesta;

    }


    function horario ($id){
        $conexion = abrirConexion();
        $query = "SELECT horario.hora_inicio, horario.hora_final, horario.fecha, lugar.nombre_lugar FROM horario, lugar, curso WHERE horario.id_lugar = lugar.id_lugar AND curso.id_curso = horario.id_curso AND curso.id_curso = '$id'";

        $resultado = leerDatos($conexion, $query);

        

        while($row  = $resultado->fetch_array()){
            $respuesta [] = [
                'HI' => $row[0],
                'HF' => $row[1],
                'fecha' => $row[2],
                'lugar' => $row[3],
            ];
        }

        $resultado->free();
        cerrarConexion($conexion);

        return $respuesta;

    }    


    function colaborador($id){
        $conexion = abrirConexion();

        $query = "SELECT usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.nCuenta FROM usuario, curso_usuario_resp, curso WHERE curso.id_curso = '$id' AND curso_usuario_resp.nCuenta = usuario.nCuenta AND curso_usuario_resp.id_curso = curso.id_curso ORDER BY usuario.apellidoP ASC;";

        $resultado = leerDatos($conexion, $query);

        $respuesta = [];

        while($row  = $resultado->fetch_array()){
            $respuesta [] = [
                'nombre' => $row[1] . " " . $row[2] . " " . $row[0],
                'cuenta' => $row[3]
            ];
        }

        $resultado->free();
        cerrarConexion($conexion);

        return $respuesta;           
    }


    function conf(){
        $conexion = abrirConexion();
        $query = "SELECT id, universidad, campus, evento from conf WHERE id = 'conf_alumnos'";;


        $resultado = leerDatos($conexion, $query);

        $respuesta = [];

        while($row  = $resultado->fetch_array()){
            $respuesta [] = [
                'id' => $row[0],
                'universidad' => $row[1],
                'campus' => $row[2],
                'evento' => $row[3]
            ];
        }

        $resultado->free();
        cerrarConexion($conexion);

        return $respuesta; 
    }
    







?>