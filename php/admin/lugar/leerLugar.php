<?php 
    require ('../../base.php');
    require ('../../consulta.php');
    header('Content-Type: application/json');
    
    $conexion = abrirConexion();

    $query = "SELECT * FROM lugar";

    $resultado = leerDatos($conexion, $query);
    

    $lugar = [];
    while($row = $resultado->fetch_array()){
        
        $lugar []  = [
            'id' => $row[0],
            'nombreLugar' => $row[1],
            'cantidadLugar' => $row[2]
        ];
    }

    

    echo json_encode($lugar);

?>