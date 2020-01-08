<?php
	require('../../base1.php');
	require('../../Consultas.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$serv = false;
		if(isset($_POST['curso'])){
			$base = new ConexionBase();
			$consulta = new Consultas();
			$conexion = $base->conectar();

			if($conexion != false){

				
				

			}else{

			}
		}else{

		}
	}else{
		$serv = false;

	}


?>