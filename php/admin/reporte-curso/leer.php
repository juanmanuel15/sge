<?php 

    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }
	
	require ('../../base.php');
    require ('../../consulta.php');

    //header('Content-Type: application/json');
    header("Content-Type: text/html;charset=utf-8");
    
    $conexion = abrirConexion();

    $query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM,  curso.titulo, horario.fecha, horario.hora_inicio, horario.hora_final
    FROM curso_usuario_org, curso, usuario, horario
    WHERE curso.id_curso = curso_usuario_org.id_curso AND usuario.nCuenta = curso_usuario_org.nCuenta AND curso.id_curso = horario.id_curso";


   $resultado = leerDatos($conexion, $query);

    $horario = [];
    while($row = $resultado->fetch_array()){
        
        $horario []  = [
            'numeroCuenta' => $row[0],
            'nombreCompleto' => $row[1]. " " . $row[2] . " " . $row[3], 
            'titulo' => $row[4],
            'fecha' => $row[5],
            'hora_inicio' => $row[6],
            'hora_final' => $row[7]
        ];
    }



    if(count($horario)>1){

        $numeroCuenta;
        $nombreCompleto;
        $titulo;
        $fecha;
        $hora_inicio;
        $hora_final;

        

        for($i = 0; $i <count($horario); $i++ ){

            $numeroCuenta [] = $horario[$i]["numeroCuenta"]; 
            $nombreCompleto [] = $horario[$i]["nombreCompleto"];
            $titulo [] = $horario[$i]["titulo"];
            $fecha [] = $horario[$i]["fecha"];
            $hora_inicio [] = $horario[$i]["hora_inicio"];
            $hora_final [] = $horario[$i]["hora_final"];
            
        }

        if(count($numeroCuenta) > count(array_unique($numeroCuenta))){
            $numeroCuenta = $numeroCuenta[0];
        }else {
            $numeroCuenta;
        }

        if(count($nombreCompleto) > count(array_unique($nombreCompleto))){
            $nombreCompleto = $nombreCompleto[0];
        }else {
            $nombreCompleto;
        }

        if(count($titulo) > count(array_unique($titulo))){
            $titulo = $titulo[0];
        }else {
            $titulo;
        }



        $respuesta = [
            'numeroCuenta' => $numeroCuenta,
            'nombreCompleto' => $nombreCompleto,
            'titulo' => $titulo, 
            'fecha' => $fecha, 
            'hora_inicio' => $hora_inicio,
            'hora_final' => $hora_final
        ];
        
    }
    else {
        $respuesta = $horario;
    }
    echo json_encode($respuesta);
?>