<?php 
	
	require ('../../base.php');
    require ('../../consulta.php');

	$busqueda = $_POST['buscar'];
	


    //header('Content-Type: application/json');
    header("Content-Type: text/html;charset=utf-8");
    
    $conexion = abrirConexion();

    $query = "SELECT nCuenta, nombre, apellidoP, apellidoM, usuario FROM usuario WHERE nCuenta LIKE '$busqueda%' OR nombre LIKE '%$busqueda%' OR usuario LIKE '%$busqueda%' OR apellidoP LIKE '%$busqueda%' OR apellidoM LIKE '%$busqueda%' ORDER BY apellidoP ASC";

   $resultado = leerDatos($conexion, $query);
    

    $user = [];
    while($row = $resultado->fetch_array()){
        
        $user []  = [
            'numeroCuenta' => $row[0],
            'nombreCompleto' => $row[2]. " " . $row[3] . " " . $row[1], 
            'usuario' => $row[4]
        ];
    }

    
    

    echo json_encode($user);
?>