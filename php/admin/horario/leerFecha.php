<?php 
    require ('../../base.php');
    require ('../../consulta.php');
    header('Content-Type: application/json');
    
    $conexion = abrirConexion();

    $query = "SELECT * FROM fecha ORDER BY DATE(fecha)";

    $resultado = leerDatos($conexion, $query);
    

    $fecha = [];
    while($row = $resultado->fetch_array()){
        
        $fecha []  = [
            'id' => $row[0],
            'fecha' => $row[1]
        ];
    }

    

    echo json_encode($fecha);

?>