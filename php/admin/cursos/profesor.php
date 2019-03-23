<?php 

	require ('../../base.php');
    require ('../../consulta.php');
    header("Content-Type: text/html;charset=utf-8");

    $conexion = abrirConexion();

    $query = "SELECT usuario.nCuenta, usuario.apellidoP, usuario.apellidoM, usuario.nombre from usuario, tipo_usuario WHERE usuario.tipo_usuario = tipo_usuario.id_tipoUsuario AND tipo_usuario.id_tipoUsuario = 2 ORDER BY apellidoP ASC";


    $resultado = leerDatos($conexion, $query);

    $var = [];
    while($row = $resultado->fetch_array()){
        
        $var []  = [
        	'id' => $row[0],
        	'nombre' => $row[1] . " " . $row[2] . " " . $row[3]            
        ];
    }

    cerrarConexion($conexion);
    
 	echo  json_encode($var);

?>