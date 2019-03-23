<?php

	require ('../../base.php');
    require ('../../consulta.php');

    $id = (int) $_POST['id'];

    $conexion = abrirConexion();

    $query = "SELECT * FROM requerimientos WHERE id_req = " .$id;

    $resultado = leerDatos($conexion, $query);
    
    $req = [];
    while($row = $resultado->fetch_array()){
        
        $lugar []  = [
            'id' => $row[0],
            'nombreReq' => $row[1]
        ];
    }
    echo json_encode($lugar);

    cerrarConexion($conexion);  

?>