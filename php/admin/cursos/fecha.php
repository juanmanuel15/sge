<?php

	require ('../../base.php');
    require ('../../consulta.php');
    header("Content-Type: text/html;charset=utf-8");

    $conexion = abrirConexion();

    $query = "SELECT * FROM fecha";


    $resultado = leerDatos($conexion, $query);

    $var = [];
    while($row = $resultado->fetch_array()){
        
        $var []  = [
        	'id' => $row[0],
        	'nombre' => $row[1]         
        ];
    }

    cerrarConexion($conexion);
    
 	echo  json_encode($var);

?>