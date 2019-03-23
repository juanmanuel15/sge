<?php

    require('../base.php');
    require('../consulta.php');

    $conexion = abrirConexion();

    if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
        $respuesta = [
            'valor' => false
        ];
     }else {

        
        $curso = filter_var($_POST['curso'],FILTER_SANITIZE_STRING);

        

       $query = "SELECT * FROM curso WHERE id_curso = '$curso'";

        
        $resultado = leerDatos($conexion, $query);

        $varCurso = [];

        while($row = $resultado->fetch_array()){
            $varCurso [] = [
                'id_curso' => $row[0],
                'titulo'=> $row[1],
                'tipo_actividad'=> tipo_actividad($conexion,$row[2]),
                'descripcion' => $row[3],
                'requisitos'=> $row[4],
                'dirigido' => $row[5]
            ];
        }

        $resultado->free();

        $query = "SELECT usuario.nombre, usuario.apellidoP, usuario.apellidoM FROM usuario, curso_usuario_org, curso WHERE usuario.nCuenta = curso_usuario_org.nCuenta AND curso_usuario_org.id_curso = curso.id_curso AND curso.id_curso = '$curso'";

        $resultado = leerDatos($conexion, $query);

        $varProfesor = []; 
        while($row = $resultado->fetch_array()){
            $varProfesor [] = [
                'nombre' => $row[0]. " " . $row[1]. " " . $row[2]
            ];
        }

       

        $resultado->free();


        $query = "SELECT usuario.nombre, usuario.apellidoP, usuario.apellidoM FROM usuario, curso_usuario_resp, curso WHERE usuario.nCuenta = curso_usuario_resp.nCuenta AND curso_usuario_resp.id_curso = curso.id_curso AND curso.id_curso = '$curso'";

        $resultado = leerDatos($conexion, $query);

        $varResp = []; 
        while($row = $resultado->fetch_array()){
            $varResp [] = [
                'nombre' => $row[0]. " " . $row[1]. " " . $row[2]
            ];
        }

        $resultado->free();


        $query = "SELECT material.nombre_material, material.cantidad
        FROM material, curso
        WHERE material.id_curso = curso.id_curso AND material.id_curso = '$curso'";

        $resultado = leerDatos($conexion, $query);

        $varMaterial = []; 
        while($row = $resultado->fetch_array()){
            $varMaterial [] = [
                'nombreMaterial' => $row[0],
                'cantidadMaterial' => $row[1] 
            ];
        }

        $resultado->free();

        $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final, lugar.nombre_lugar
        FROM horario, lugar, curso
        WHERE horario.id_curso = curso.id_curso AND lugar.id_lugar = horario.id_lugar AND curso.id_curso ='$curso'";

        $resultado = leerDatos($conexion, $query);

        $varHorario = []; 
        while($row = $resultado->fetch_array()){
            $varHorario [] = [
                'fecha' => $row[0],
                'HI' => $row[1],
                'HF' => $row[2],
                'lugar' => $row[3]
            ];
        }

        $resultado->free();




        $var = [
            'curso' => $varCurso, 
            'profesor' => $varProfesor,
            'resp' => $varResp,
            'material' => $varMaterial,
            'horario' => $varHorario
        ];

        

        

        echo json_encode($var);

        

        

    }

    function tipo_actividad($conexion,$tipo_actividad){
        $query = "SELECT nombre_tipo_actividad FROM tipo_actividad WHERE id_tipo_actividad= $tipo_actividad";            
        $resultado = leerDatos($conexion, $query);

        $array = $resultado->fetch_array();

        return $array[0];      
       
    }


    function profesorCurso($conexion, $id_curso){
        $query = "SELECT nCuenta FROM curso_usuario_resp WHERE id_curso= '$id_curso'";
        $resultado = leerDatos($conexion, $query);
               
        if(count($resultado->fetch_array()) == 1){
            $array = $resultado->fetch_array();
            return $array[0];
        }else {
            
            $var = [];
            while($row = $resultado->fetch_array()){
                $var [] = [
                    'nombre' => profesorNombre($conexion,$row[0])
                ];

            }
           
            return $var;
        }
        


    }


    function profesorNombre($conexion, $nCuenta){
        $query = "SELECT nombre, apellidoP, apellidoM FROM usuario WHERE nCuenta = '$nCuenta'";
        $resultado = leerDatos($conexion, $query);
        $array = $resultado->fetch_array();
        return $array[0]. " " . $array[1] . " " . $array[2];
    }

    


        

?>