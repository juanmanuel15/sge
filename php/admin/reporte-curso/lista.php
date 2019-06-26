<?php

	require('../../base1.php');
    

	if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
        $respuesta = [
            'metodo' => false
        ];
     }else{ 

     	$bd = new ConexionBase();

     	$conn = $bd->conectar();

     	if($conn != false){

     		$id_curso = $_POST['id'];
            $id_curso;

     		$query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM FROM usuario, curso, curso_usuario_insc WHERE curso_usuario_insc.id_curso = curso.id_curso AND curso_usuario_insc.nCuenta = usuario.nCuenta AND curso_usuario_insc.id_curso = '$id_curso' ORDER BY usuario.apellidoP ASC;";

     		$resultado = $bd->leer($query);

     		if($resultado->num_rows > 0){
     			while($row = $resultado->fetch_array()){
	     			$respuesta [] = [
	     				'usuario' => $row[0],
	     				'nombre' => $row[2] . " " . $row[3] . " " . $row[1]
	     			];
	     		}

	     		$resultado->free();

     		} else {
     			$respuesta = [];
     				
     		}

     		


     		

     	}else {
     		$respuesta = [
     			'base' => false
     		];
     	}

     	 

     }

     echo json_encode($respuesta);	



?>