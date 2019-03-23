<?php

	require ('../../base.php');
    require ('../../consulta.php');

    $id = (int) $_POST['id'];

    $conexion = abrirConexion();

    $query = "SELECT * FROM hora WHERE id_hora = " .$id;

    $resultado = leerDatos($conexion, $query);
    
    $hora = [];
    while($row = $resultado->fetch_array()){
        
        $lugar []  = [
            'id' => $row[0],
            'hora' => $row[1],
        ];
    }
    echo json_encode($lugar);

    cerrarConexion($conexion);  

?>