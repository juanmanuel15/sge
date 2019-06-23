<?php
    

    function abrirConexion(){

	$conexion = new mysqli('localhost', 'root', '', 'sam');
	$conexion->set_charset("utf8");
	return $conexion;

	
    }

   	


    function cerrarConexion($conexion){
    	$conexion->close();
    }
?>