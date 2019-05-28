<?php

	include ('../../base1.php');
	
	class Consultas extends conexionBase
	{
		$conexion = $this->$conexion;
		
		public function (){
			$query = "SELECT id_lugar, nombre_lugar, lugares FROM lugar ORDER BY nombre_lugar";
		}
		
		
	}


?>