<?php 
    require ('../../base.php');
    require ('../../consulta.php');

    //header('Content-Type: application/json');
    header("Content-Type: text/html;charset=utf-8");
    
    $conexion = abrirConexion();

     $query = "SELECT * FROM requerimientos ORDER BY nombre_req ASC";

   $resultado = leerDatos($conexion, $query);
    

    $req = [];
    while($row = $resultado->fetch_array()){
        
        $req []  = [
            'id_req' => $row[0],
            'nombre_req' => $row[1]
        ];
    }

    
    

    echo json_encode($req);

?>