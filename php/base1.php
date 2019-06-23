<?php
    
	class ConexionBase {

		public $ip = "localhost";
		public $user = "root";
		public $pass = "";
		public $bd = "sam";

		private $conn;

		public function conectar(){
	
			$conexion = new mysqli($this->ip, $this->user, $this->pass, $this->bd);
			$conexion->set_charset("utf8");
			

			if($conexion->connect_errno){
				$respuesta = false;
			} else {
				$respuesta = $conexion;	
			}
			
			return $this->conn = $respuesta;
						
		}


		public function cerrar(){
			$this->conn->close();
		}

		public function leer($query){

			//echo $query;
			if(!$this->conn){
				$respuesta =  false;
			}else {
				
				$respuesta = $this->conn->query($query);
			}

			return $respuesta;
		}


		public function limpiar($datos){
			$datos->free();
		}


		public function insertar($query){

			if(!$this->conn){
				$respuesta =  false;
			}else {				
				$respuesta = $this->conn->query($query);
			}

			return $respuesta;
		}
	}
?>