<?php 
    require ('../../base.php');
    require ('../../consulta.php');
    header('Content-Type: application/json');
    
    $conexion = abrirConexion();

    $query = "SELECT * FROM hora";

    $resultado = leerDatos($conexion, $query);
    

    $hora = [];
    while($row = $resultado->fetch_array()){
        
        $hora []  = [
            'id' => $row[0],
            'hora' => $row[1]
        ];
    }

    

    echo json_encode($hora);

?>