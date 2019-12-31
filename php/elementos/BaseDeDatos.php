<?php

    
	
	require ('../../base.php');
    require ('../../consulta.php');
    header("Content-Type: text/html;charset=utf-8");

    $conexion = abrirConexion();

    $query = "";

    $respuesta = insertarDatos($conexion, $query);
    $respuesta = leerDatos($conexion, $query);

    $var = [];
    while($row = $resultado->fetch_array()){
        
        $var []  = [
            
        ];
    }

    $respuesta = eliminarDatos($conexion, $query);

    cerrarConexion($conexion);

 	echo  json_encode($respuesta);



?>