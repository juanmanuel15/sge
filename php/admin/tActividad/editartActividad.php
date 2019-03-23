<?php

	require ('../../base.php');
    require ('../../consulta.php');

    $id = (int) $_POST['id'];

    $conexion = abrirConexion();

    $query = "SELECT * FROM tipo_actividad WHERE id_tipo_actividad = " .$id;

    $resultado = leerDatos($conexion, $query);
    
    $act = [];
    while($row = $resultado->fetch_array()){
        
        $act []  = [
            'id' => $row[0],
            'nombre' => $row[1]
        ];
    }
    echo json_encode($act);

    cerrarConexion($conexion);  

?>