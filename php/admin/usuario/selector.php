<?php
	
	require ('../../base.php');
    require ('../../consulta.php');

    header("Content-Type: text/html;charset=utf-8");

    $conexion = abrirConexion();

    $query = "SELECT * FROM tipo_usuario";

    $resultado = leerDatos($conexion, $query);
    

    $tipoUsuario = [];
    while($row = $resultado->fetch_array()){
        
        $tipoUsuario []  = [
            'id' => $row[0],
            'tipoUsuario' => $row[1],
        ];
    }

    
    

    echo json_encode($tipoUsuario);
	
?>