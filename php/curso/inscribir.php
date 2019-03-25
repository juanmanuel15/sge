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

        #Obtenemos los horarios para todos los cursos inscritos
        $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final FROM horario, curso_usuario_insc, curso, usuario WHERE horario.id_curso = curso.id_curso AND curso_usuario_insc.id_curso = curso.id_curso AND curso_usuario_insc.nCuenta = usuario.nCuenta AND usuario.nCuenta = '$nCuenta'";

        $resultado = leerDatos($conexion, $query);

        $cursos_inscritos = [];
        while ($row = $resultado->fetch_assoc()) {
            $cursos_inscritos[] = [
                'fecha' => (int)str_replace("-","",  $row['fecha']),
                'HI' => (int)substr(str_ireplace(":", "", $row['hora_inicio']), 0, -2),
                'HF' => (int)substr(str_ireplace(":", "", $row['hora_final']), 0, -2) 
            ];
        }




        $resultado->free();

        #Obtenemos el horario del curso a inscribir
        $query = "SELECT fecha, hora_inicio, hora_final FROM horario WHERE id_curso= '$curso'";
        $resultado = leerDatos($conexion, $query);
        $curso = [];

        while($row = $resultado->fetch_array()){

            $curso[] =  [
                'fecha' => (int)str_replace("-","",  $row[0]),
                'HI' => (int)substr(str_ireplace(":", "", $row[1]), 0, -2),
                'HF' => (int)substr(str_ireplace(":", "", $row[2]), 0, -2) 
            ];
        }

        print_r($curso);
        print_r($cursos_inscritos);

        

        
        $resultado->free();
        $respuesta = [];

        for ($i=0; $i < count($curso); $i++) { 
            for ($j=0; $j <count($cursos_inscritos); $j++) {                 

                if($curso[$i]['fecha'] == $cursos_inscritos[$j]['fecha']){
                    
                    if($cursos_inscritos[$j]['HI']-$curso[$i]['HF']>= 0){

                        $respuesta [] = true;
                    }else {
                        $respuesta [] = false;
                    }
                }else {
                    $respuesta [] = true;
                }
            }
            
        }
         

    

        /*$query = "SELECT COUNT(id) FROM curso_usuario_insc WHERE nCuenta = '$nCuenta' AND id_curso = '$curso'";
        $resultado = $conexion->query($query);
        $inscrito = $resultado->fetch_array();
        $inscrito = $inscrito[0];
        $resultado->free();

        if($inscrito == 0){
            $query = "INSERT INTO curso_usuario_insc (id, nCuenta, id_curso) VALUES (NULL, '$nCuenta', '$curso')";
            $resultado = $conexion->query($query);

            if(!$resultado){
                $respuesta = false;
            }else {
                $respuesta = true;
            }


        }else {

            $respuesta = false;

        }*/



        echo json_encode($respuesta);





    }


?>