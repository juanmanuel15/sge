<?php

    require('../base.php');
    require('../consulta.php');

    $conexion = abrirConexion();

    if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
        $respuesta = false;

    } else {

        $curso = filter_var(trim($_POST['curso']),FILTER_SANITIZE_STRING);
        $usuario = filter_var(trim($_POST['usuario']),FILTER_SANITIZE_STRING);

        $query = "SELECT nCuenta FROM usuario WHERE usuario = '$usuario'";
        
        $resultado = $conexion->query($query);
        $nCuenta = $resultado->fetch_array();
        
        $nCuenta = $nCuenta[0];

        $resultado->free();

        #Obtenemos el horario del curso a inscribir
        $query = "SELECT fecha, hora_inicio, hora_final FROM horario WHERE id_curso= '$curso'";
        $resultado = leerDatos($conexion, $query);
        $curso = [];
        $traslape = [];

        while($row = $resultado->fetch_array()){

            $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final FROM horario, curso_usuario_insc, curso, usuario WHERE horario.id_curso = curso.id_curso AND curso_usuario_insc.id_curso = curso.id_curso AND curso_usuario_insc.nCuenta = usuario.nCuenta AND usuario.nCuenta = '$nCuenta' AND horario.hora_inicio < '$row[2]' AND horario.hora_final > '$row[1]' AND horario.fecha = '$row[0]'";

            $cursos_inscritos = leerDatos($conexion, $query);

            if($cursos_inscritos->num_rows>0){
                $traslape [] = true; 
            }else {
                $traslape [] = false;
            }           
            
        }

        
        $resultado->free();


       print_r($respuesta = $traslape);     



        echo json_encode($respuesta);


        
    }


?>