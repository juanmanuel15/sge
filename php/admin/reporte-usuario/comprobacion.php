<?php

    require ('../../../base1.php');
    

    header("Content-Type: text/html;charset=utf-8");


    function alumno($usuario, $id_curso){
        $base = new ConexionBase();
        //$consulta = new Consultas();


        if(!empty($id_curso) && !empty($usuario)){
            $vacio = false;

            $conn = $base->conectar(); 

            if($conn != false){

                $conexion = false;

               $query = "SELECT usuario, nombre, apellidoP, apellidoM FROM usuario WHERE nCuenta = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario')";

                $resultado = $base->leer($query);

                while($row = $resultado->fetch_array()){
                    $alumno = [
                        'usuario' => $row[0],
                        'nombre' => $row[1]. " " . $row[2] . " " . $row[3]
                    ];
                }

                $base->limpiar($resultado);

                $query = "SELECT curso.titulo, tipo_actividad.nombre_tipo_actividad FROM curso, tipo_actividad WHERE curso.id_curso = '$id_curso' AND tipo_actividad.id_tipo_actividad = curso.id_tipo_actividad";

                $resultado = $base->leer($query);

                while($row = $resultado->fetch_array()){
                    $curso = [
                        'titulo' => $row[0],
                        'tActividad' => $row[1]
                    ];
                }

                $base->limpiar($resultado);


                $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final FROM horario, curso WHERE curso.id_curso = '$id_curso' AND  horario.id_curso = curso.id_curso ORDER BY date(fecha) ASC";
                $resultado = $base->leer($query);

                $horarioCurso = [];
    
                while($row = $resultado->fetch_array()){
                    $horarioCurso []= [
                        'fecha' => $row[0]
                    ];
                }

                
                $base->limpiar($resultado);
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


                $base->limpiar($resultado);
    
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

                    //echo sizeof($horarioCurso) .">= " . sizeof($horarioRegistro) .'&&'. sizeof($horarioRegistro) . "!= 0";
                    if(sizeof($horarioCurso) >= sizeof($horarioRegistro) && sizeof($horarioRegistro) !=0){
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
                            $por = true;
                        }

                        else {
                            $por = false;
                        }
                        

                    }else {
                        
                        if(sizeof($horarioRegistro) == 0){
                            $sin_asistencia = true;
                            $mas_asistencia = false;
                        }else {
                            $mas_asistencia = true;
                            $sin_asistencia = false;
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
            'success' => ['porcentaje' => $por, 'sin_asistencia' => $sin_asistencia, 'mas_asistencia' => $mas_asistencia, 'conf' => $conf, 'usuario' => $alumno, 'curso' => $curso, 'fechas' => $horarioCurso]

        ];


        return $respuesta; 

        $conexion->cerrar();
    }





    function profesor($usuario, $curso){

        date_default_timezone_set('America/Mexico_City');
        $base = new ConexionBase();
    
        if(!empty($usuario) && !empty($curso)){
            $vacio = false;
            $conexion = $base->conectar();

            if($conexion != false){
                $conn = false;

                $query = "SELECT * FROM curso_usuario_org  WHERE curso_usuario_org.nCuenta = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario') AND curso_usuario_org.id_curso = '$curso';";
                $resultado = $base->leer($query);

                if($resultado->num_rows == 1){

                    $resultado->free();

                    $query = "SELECT porcentaje_asistencia,universidad, campus, tipo_documento,slogan, nombre_director, evento, director, ubicacion FROM conf WHERE id ='conf_profesores'";

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

                    //print_r($conf);

                    $resultado->free();
                    
                    $query = "SELECT horario.fecha FROM horario, curso WHERE curso.id_curso = '$curso' AND  horario.id_curso = curso.id_curso ORDER BY date(fecha) ASC";
                    $resultado = $base->leer($query);

                    $horarioCurso = [];
        
                    while($row = $resultado->fetch_array()){
                        $fechasCurso []= [
                            'fecha' => $row[0]
                        ];
                    }

                    
                    for ($i=0; $i < sizeof($fechasCurso) ; $i++) { 
                        $fechaConvertido [] = $fechasCurso[$i]['fecha']; 
                    }

                    $resultado->free();
                    
                    $fechaActual = date('Y-m-d');
                    $ultimaFecha = array_pop($fechaConvertido);

                    if($fechaActual >= $ultimaFecha){

                        $query = "SELECT usuario, nombre, apellidoP, apellidoM FROM usuario WHERE usuario = '$usuario'";
                        $resultado = $base->leer($query);
                        
                        while($row = $resultado->fetch_array()){
                            $usuario = [
                                'usuario' => $row[0],
                                'nombre' => "$row[1] $row[2] $row[3]"
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


                        
                    }else{
                        $success = false;

                        
                    }
                    

                }else{
                    $success = false;
                    
                }

                   

    
            }else {
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



    
    
    







?>