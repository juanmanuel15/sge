<?php
    

    function abrirConexion(){

	$conexion = new mysqli('localhost', 'root', '', 'sam');

	return $conexion;

	
    }

   	


    function cerrarConexion($conexion){
    	$conexion->close();
    }
?>