<?php

    require ('../../../base1.php');
    

    header("Content-Type: text/html;charset=utf-8");
    date_default_timezone_set('America/Mexico_City');

    function alumno($usuario, $id_curso){
        $base = new ConexionBase();
        //$consulta = new Consultas();


        if(!empty($id_curso) && !empty($usuario)){
            $vacio = false;

            $conn = $base->conectar(); 

            if($conn != false){

                $conexion = false;              
    
                $query = "SELECT porcentaje_asistencia,universidad, campus, tipo_documento,slogan, nombre_director, evento, director, ubicacion FROM conf WHERE id ='conf_alumnos'";
                    $resultado = $base->leer($query);
                    $conf = [];
                    while($row = $resultado->fetch_array()){
                       $conf = [
                        'porcentaje' => $porcentaje = (int)$row[0],
                        'universidad' =>$row[1],
                        'campus' => $row[2],
                        'tipo_documento' =>  $row[3],
                        'slogan' =>  $row[4], 
                        'nombre_director' =>  $row[5],
                        'evento'  =>  $row[6],
                        'director' =>  $row[7],
                        'ubicacion' => $row[8]
                       ];
    
                    }

                    $resultado->free();


                    $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final FROM horario, curso WHERE curso.id_curso = '$id_curso' AND  horario.id_curso = curso.id_curso ORDER BY date(fecha) ASC";
                    $resultado = $base->leer($query);

                    $horarioCurso = [];
        
                    while($row = $resultado->fetch_array()){
                        $horarioCurso []= [
                            'fecha' => $row[0]
                        ];
                    }


                    $query = "SELECT constancia.nombre, constancia.apellidoP, constancia.apellidoM, constancia.usuario, curso.titulo, tipo_actividad.nombre_tipo_actividad FROM constancia, curso, tipo_actividad WHERE constancia.id_curso = '$id_curso' AND constancia.usuario = '$usuario' AND curso.id_curso = constancia.id_curso AND curso.id_tipo_actividad = tipo_actividad.id_tipo_actividad";

                    $resultado = $base->leer($query);
                    $numRows_comprobacion = $resultado->num_rows;
                    foreach ($resultado as $rw) {

                            $nombre = $rw['nombre'];
                            $apellidoP = $rw['apellidoP'];
                            $apellidoM = $rw['apellidoM'];

                            $alumno = [
                                'usuario' => $rw['usuario'],
                                'nombre' =>  $nombre . " " . $apellidoP . " " .$apellidoM 
                            ];

                            $curso = [
                                'titulo' => $rw['titulo'],
                                'tActividad' => $rw['nombre_tipo_actividad']
                            ];
                    }


                    $resultado->free();

                    if($numRows_comprobacion>0){
                        $mas_asistencia = false;
                        $sin_asistencia = false;
                        $por1 = true;



                    }else{


                        $query = "SELECT usuario.usuario, usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, curso.id_curso, curso.titulo, tipo_actividad.nombre_tipo_actividad FROM usuario, curso, tipo_actividad WHERE usuario.usuario = '$usuario' AND curso.id_tipo_actividad = tipo_actividad.id_tipo_actividad AND curso.id_curso = '$id_curso'";

                        $resultado = $base->leer($query);

                        foreach ($resultado as $rw) {
                            $nombre = $rw['nombre'];
                            $apellidoP = $rw['apellidoP'];
                            $apellidoM = $rw['apellidoM'];

                            $alumno = [
                                'id_usuario' => $rw['nCuenta'],
                                'usuario' => $rw['usuario'],
                                'nombre' =>  $nombre . " " . $apellidoP . " " .$apellidoM                                
                            ];

                            $curso = [
                                'id_curso' => $rw['id_curso'],
                                'titulo' => $rw['titulo'],
                                'tActividad' => $rw['nombre_tipo_actividad']
                            ];
                        }

                        $query = "SELECT id_asistencia, hora_e, hora_s, fecha_e, fecha_s, check_in, check_out FROM asistencia WHERE id_usuario = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario' ) AND id_curso = '$id_curso';";                
                        $resultado = $base->leer($query);

                        $horarioRegistro = [];

                        foreach ($resultado as $registro ) {
                            $horarioRegistro [] = [
                                'fecha' => $registro['fecha_e'],
                                'entrada' => $registro['check_in'],
                                'salida' => $registro['check_out']
                            ];
                        }


                    //echo sizeof($horarioCurso) .">= " . sizeof($horarioRegistro) .'&&'. sizeof($horarioRegistro) . "!= 0";
                    if(sizeof($horarioCurso) >= sizeof($horarioRegistro) && sizeof($horarioRegistro) !=0){
                        //echo "hola";
                        $mas_asistencia = false;
                        $sin_asistencia = false;

                        
                        $contador = 0;
                        for ($i=0; $i <sizeof($horarioCurso) ; $i++) { 
                            for ($j=0; $j < sizeof($horarioRegistro); $j++) { 
                                //$horarioCurso[$i]['fecha'] . "==" . $horarioRegistro[$j]['fecha'] ."<br>";
                                if($horarioCurso[$i]['fecha'] == $horarioRegistro[$j]['fecha']){
                                    
                                    
                                    
                                    if($horarioRegistro[$j]['entrada'] == 1){
                                        $contador++;
                                    }

                                    if($horarioRegistro[$j]['salida'] == 1){
                                        $contador++;
                                    }
                                }
                            }
                        }



                        $asistencia = $contador*100/(sizeof($horarioCurso)*2);

                        if($asistencia >= $porcentaje){                            
                            $por1 = true;
                            $fecha_generacion = date('Y-m-d H:i:s');
                            $nombre_usuario = explode(" ", $nombre);
                            $id = $id_curso.$usuario;
                            $query = "INSERT INTO constancia(id_constancia, id_curso, fecha_generacion, usuario, nombre, apellidoP, apellidoM, tipo_usuario) VALUES ('$id', '$id_curso', '$fecha_generacion', '$usuario', '$nombre', '$apellidoP', '$apellidoM', 3)";
                            $resultado = $base->insertar($query);

                        }

                        else {
                            $por1 = false;
                        }
                        

                    }else {
                        //echo "adios";
                        
                        if(sizeof($horarioRegistro) == 0){
                            $sin_asistencia = true;
                            $mas_asistencia = false;
                            $por1 = false;
                        }else {
                            $mas_asistencia = true;
                            $sin_asistencia = false;
                            $por1 = false;
                        }
                        
                        
                        
                    }



                }


                                
            }else{
                $conexion = true;

            }
        }else{
            $conexion = true;
            $vacio = true;
        }

        $respuesta = [
            'vacio' => $vacio,
            'conn' => $conexion,
            'success' => ['porcentaje' => $por1, 'sin_asistencia' => $sin_asistencia, 'mas_asistencia' => $mas_asistencia, 'conf' => $conf, 'usuario' => $alumno, 'curso' => $curso, 'fechas' => $horarioCurso]

        ];


        return $respuesta; 

        $conexion->cerrar();
    }


    





    function profesor($usuario, $curso){
        $id_usuario = $usuario;
        $id_curso = $curso;

        $base = new ConexionBase();
    
        if(!empty($usuario) && !empty($curso)){
            $vacio = false;
            $conexion = $base->conectar();

            if($conexion != false){
                $conn = false;

                $query = "SELECT porcentaje_asistencia,universidad, campus, tipo_documento,slogan, nombre_director, evento, director, ubicacion FROM conf WHERE id ='conf_alumnos'";

                $resultado = $base->leer($query);
                $conf = [];
                while($row = $resultado->fetch_array()){
                   $conf = [
                    'porcentaje' => $porcentaje = (int)$row[0],
                    'universidad' =>$row[1],
                    'campus' => $row[2],
                    'tipo_documento' =>  $row[3],
                    'slogan' =>  $row[4], 
                    'nombre_director' =>  $row[5],
                    'evento'  =>  $row[6],
                    'director' =>  $row[7],
                    'ubicacion' => $row[8]
                   ];    
                }

                $resultado->free();

                $query = "SELECT horario.fecha FROM horario, curso WHERE curso.id_curso = '$curso' AND  horario.id_curso = curso.id_curso ORDER BY date(fecha) ASC";
                $resultado = $base->leer($query);

    
                while($row = $resultado->fetch_array()){
                    $fechasCurso []= [
                        'fecha' => $row[0]
                    ];
                }


                $resultado->free();

                $id_constancia = $id_curso.$id_usuario;

                $query = "SELECT * FROM constancia WHERE id_constancia = '$id_constancia'";
                $resultado = $base->leer($query);

                if($resultado->num_rows>0){

                    $query = "SELECT constancia.usuario, curso.titulo, constancia.nombre, constancia.apellidoP, constancia.apellidoM, tipo_actividad.nombre_tipo_actividad FROM tipo_Actividad, curso, constancia WHERE constancia.id_constancia = '$id_constancia' AND constancia.id_curso = curso.id_curso AND tipo_actividad.id_tipo_actividad = curso.id_tipo_actividad";

                    $resultado = $base->leer($query);

                    foreach ($resultado as $rw) {
                        $usuario = [
                            'nombre' => $rw['nombre']. " ". $rw['apellidoP'] . " " . $rw['apellidoM'],
                            'usuario' => $rw['usuario']
                        ];

                        $curso = [
                            'titulo' => $rw['titulo'],
                            'tActividad' =>$rw['nombre_tipo_actividad'] 
                        ];
                    }


                    $resultado->free();
                }else{

                    $query = "SELECT * FROM curso_usuario_org  WHERE curso_usuario_org.nCuenta = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario') AND curso_usuario_org.id_curso = '$curso';";

                    $resultado = $base->leer($query);
                    if($resultado->num_rows == 1){
                        $resultado->free();

                        $horarioCurso = [];

                        for ($i=0; $i < sizeof($fechasCurso) ; $i++) { 
                            $fechaConvertido [] = $fechasCurso[$i]['fecha'];
                        }

                        $fechaActual = date('Y-m-d');
                        $ultimaFecha = array_pop($fechaConvertido);

                        if($fechaActual >= $ultimaFecha){

                            $query = "SELECT usuario, nombre, apellidoP, apellidoM FROM usuario WHERE usuario = '$usuario'";
                            $resultado = $base->leer($query);
                            
                            while($row = $resultado->fetch_array()){
                                $usuario = [
                                    'usuario' => $row[0],
                                    'nombre' => "$row[1] $row[2] $row[3]",
                                    'nombre1' => $row[1],
                                    'apellidoP' => $row[2],
                                    'apellidoM' => $row[3]
                                ];
                            }


                            $resultado->free();
                            $query = "SELECT curso.titulo, tipo_actividad.nombre_tipo_actividad FROM curso, tipo_actividad WHERE curso.id_curso = '$curso' AND tipo_actividad.id_tipo_actividad = curso.id_tipo_actividad";
                            $resultado = $base->leer($query);
                            
                            while($row = $resultado->fetch_array()){
                                $curso = [
                                    'titulo' => $row[0],
                                    'tActividad' =>$row[1] 
                                ];
                            }

                            $resultado->free();

                            $fecha_constancia = date('Y-m-d H:i:s');
                            $id = $id_curso.$id_usuario;
                            $nombre = $usuario['nombre1'];
                            $apellidoP = $usuario['apellidoP'];
                            $apellidoM = $usuario['apellidoM'];
                            
                            $query = "INSERT INTO constancia(id_constancia, tipo_usuario, id_curso, fecha_generacion, usuario, nombre, apellidoP, apellidoM) VALUES('$id', 2, '$id_curso', '$fecha_constancia', '$id_usuario', '$nombre', '$apellidoP', '$apellidoM')";

                            $resultado = $base->insertar($query);
                        }else {
                            $success = false;
                        }
                    }else {
                        $success = false;
                    }
                
                }
            }else{
                $conn = true;
                $success = false;
            }

        }else{
            $vacio =  true;
            $conn = false;
            $success = false;
        }



        $base->cerrar();


        return $respuesta = [
            'vacio' => $vacio,
            'conn' => $conn,
            'success' => ['conf' => $conf, 'usuario' => $usuario, 'curso' => $curso, 'fechas' => $fechasCurso]
        ];      

        
    }


    function edicion($id){
        $base = new ConexionBase();
        //$consulta = new Consultas();


        if(!empty($id)){
            $vacio = false;

            $conn = $base->conectar(); 

            if($conn != false){

                $conexion = false; 
                $query = "SELECT porcentaje_asistencia,universidad, campus, tipo_documento,slogan, nombre_director, evento, director, ubicacion FROM conf WHERE id ='conf_alumnos'";
                    $resultado = $base->leer($query);
                    $conf = [];
                    while($row = $resultado->fetch_array()){
                       $conf = [
                        'porcentaje' => $porcentaje = (int)$row[0],
                        'universidad' =>$row[1],
                        'campus' => $row[2],
                        'tipo_documento' =>  $row[3],
                        'slogan' =>  $row[4], 
                        'nombre_director' =>  $row[5],
                        'evento'  =>  $row[6],
                        'director' =>  $row[7],
                        'ubicacion' => $row[8]
                       ];
    
                    }

                    $resultado->free();

            }
        }


    }


    function personalizar($datos){

        $base = new ConexionBase();
        if(!is_array($datos)){
            $respuesta =  false;
        }else{
            $conexion = $base->conectar();
            if($conexion != false){
                $conn = false;

                $query = "SELECT * from conf WHERE id = 'conf_alumnos'";
               $resultado = $base->leer($query);
                foreach ($resultado as $rw) {
                    $conf = [
                        'tipo_documento' => $rw['tipo_documento'],
                        'slogan' => $rw['slogan'],
                        'nombreDirector' => $rw['nombre_director'],
                        'tituloEvento' => $rw['evento'],
                        'director' => $rw['director'],
                        'universidad' => $rw['universidad'],
                        'campus' => $rw['campus'],
                        'ubicacion' => $rw['ubicacion'],
                        'FI' => $rw['fecha_inicial'],
                        'FF' => $rw['fecha_final']
                    ];
                }

                $resultado->free();

                $idCurso =  $datos['idCurso'];
                $alumno = $datos['alumno'];
                $tipo_usuario = $datos['tipoUsuario'];

                $query = "SELECT curso.titulo, tipo_actividad.nombre_tipo_actividad, curso.id_curso FROM curso, tipo_actividad WHERE id_curso = '$idCurso' AND curso.id_tipo_actividad = tipo_actividad.id_tipo_actividad ";

                $resultado = $base->leer($query);

                foreach ($resultado as $rw) {
                    $curso = [
                        'idCurso' => $rw['id_curso'],
                        'titulo' => $rw['titulo'],
                        'tipoActividad' => $rw['nombre_tipo_actividad']
                    ];
                }

                $resultado->free();


                $query = "SELECT horario.fecha FROM  curso, horario WHERE horario.id_curso = curso.id_curso AND curso.id_curso = '$idCurso' ORDER BY date(fecha) ASC ";

                $resultado = $base->leer($query);

                foreach ($resultado as $rw) {
                    $fechas [] = [
                        'fecha' => $rw['fecha']
                    ];
                }

            } else {
                $conn = true;
            }
            
        }
        
            $respuesta = [
                'conn' => $conn,
                'res' => ['conf' => $conf, 'curso' => $curso, 'usuario' => $alumno, 'tipo_usuario' => $tipo_usuario, 'fechas' => $fechas]
            ];


        return $respuesta;


    }

    function guardar($alumno, $curso, $tipoUsuario){
        $base = new ConexionBase();
        $conexion = $base->conectar();

        switch ($tipoUsuario){            
            case 'col': $user = 0; break;
            case 'pon': $user = 2; break;
            case 'asis': $user = 3; break;
            default: $user = 3; break;
        }

        if($conexion != false){
            $conn = false;
            $fecha = date('Y-m-d H:i:s');
            $id_constancia = $curso . str_replace(" ", "", strtolower(substr($alumno[0], 0, 3))) . str_replace(" ", "", strtolower(substr($alumno[1], 0, 3))) . str_replace(" ", "", strtolower(substr($alumno[2], 0, 3))) . date("Y-m-d");
                $query = "INSERT INTO constancia(id_constancia, tipo_usuario, id_curso, nombre, apellidoP, apellidoM, fecha_generacion) values('$id_constancia', $user, '$curso','$alumno[0]', '$alumno[1]', '$alumno[2]', '$fecha');";
                $resultado = $base->insertar($query);
                
                if($resultado){
                    $success = true;
                }else{
                    $success = false;
                }




        }else{
            $conn = true;
            $success = false;
        }

        return $respuesta = [
            'conn' => $conn,
            'success' => $success
        ];


    }


    function editar($id){

        $base  = new ConexionBase();

        if($id != ''){
            $conexion = $base->conectar();

            if($conexion != false){
                $conn = false;
                $query = "SELECT porcentaje_asistencia,universidad, campus, tipo_documento,slogan, nombre_director, evento, director, ubicacion FROM conf WHERE id ='conf_alumnos'";
                $resultado = $base->leer($query);
                $conf = [];
                while($row = $resultado->fetch_array()){
                   $conf = [
                    'porcentaje' => $porcentaje = (int)$row[0],
                    'universidad' =>$row[1],
                    'campus' => $row[2],
                    'tipo_documento' =>  $row[3],
                    'slogan' =>  $row[4], 
                    'nombre_director' =>  $row[5],
                    'evento'  =>  $row[6],
                    'director' =>  $row[7],
                    'ubicacion' => $row[8]
                   ];
                }

                $resultado->free();

                $query = "SELECT constancia.id_curso, curso.titulo, tipo_actividad.nombre_tipo_actividad, constancia.nombre, constancia.apellidoP, constancia.apellidoM FROM curso, constancia, tipo_actividad WHERE constancia.id_constancia = '$id' AND curso.id_curso = constancia.id_curso AND curso.id_tipo_actividad = tipo_actividad.id_tipo_actividad";

                $resultado  = $base->leer($query);
                foreach ($resultado as $rw) {
                    $usuario = [
                        'nombre' => $rw['nombre'] . " " .$rw['apellidoP'] . " " .$rw['apellidoM']
                    ];

                    $curso = [
                        'id_curso' => $rw['id_curso'],
                        'titulo' => $rw['titulo'],
                        'tActividad' => $rw['nombre_tipo_actividad']
                    ];
                }

                $resultado->free();

                $id_curso = $curso['id_curso'];
                $query = "SELECT fecha FROM horario WHERE id_curso = '$id_curso'";
                $resultado = $base->leer($query);

                foreach ($resultado as $rw) {
                    $fecha [] = [
                        'fecha' => $rw['fecha']
                    ];
                }

                $resultado->free();

                $success = [
                    'conf' => $conf,
                    'usuario' =>$usuario,
                    'curso' => $curso,                    
                    'fechas' => $fecha
                ];
        }else{
            $conn = true;
            $success = false;
        }


        return $respuesta = [
            'conn' => $conn,
            'success' => $success            
        ];


    }

}



?>