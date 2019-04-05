<?php

	require ('../../base.php');
    require ('../../consulta.php');
    header("Content-Type: text/html;charset=utf-8");

    

    if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
        $respuesta = false;

    } else {

        $fecha = $_POST['fecha'];
        $hora_inicio = $_POST['horaI'];
        $hora_final = $_POST['horaF'];




         if(!isset($fecha, $hora_final, $hora_inicio)){
            #No están definidos los valores del tipo POST

            $respuesta = false;

         }else {

            $conexion = abrirConexion();

            if(is_array($fecha) && is_array($hora_inicio) && is_array($hora_final)){

                

                    $igual = horaIgual($hora_inicio, $hora_final);
                    $mayor = horaMayor($hora_inicio, $hora_final);

                   if(!$igual && !$mayor){
                      $respuesta = "Horarios Correctos";
                   }else {
                        $respuesta = "Horarios No Correctos";
                   }

                
                

                

                

                
            }else {
                $respuesta = "No es array";
            }


         }

        






    }

    /*$query = "SELECT id_lugar, nombre_lugar  FROM lugar WHERE id_lugar NOT IN (SELECT DISTINCT lugar.id_lugar FROM lugar INNER JOIN horario ON lugar.id_lugar =  horario.id_lugar AND horario.hora_inicio < '09:00:00' AND horario.hora_final > '07:00:00' AND horario.fecha = '2019-03-18')";


    $resultado = leerDatos($conexion, $query);

    $var = [];
    while($row = $resultado->fetch_array()){
        
        $var []  = [
        	'id' => $row[0],
        	'nombre' => $row[1]         
        ];
    }

    cerrarConexion($conexion);
    
 	echo  json_encode($var);



    function isArray($array){
        if(is_array($array)){

        }else {
            return false;
        }
    }*/


    echo  json_encode($respuesta);


    function horaIgual ($horaI, $horaF){

        if(count($horaI) == 1 && count($horaF) == 1){

            if($horaI != $horaF){
                    $igualHora= false;
                }else {
                    $igualHora= true; 
                }
        }else {

            for ($i=0; $i <count($horaI); $i++) { 

                $horaI[$i] = trim($horaI[$i]);
                $horaF[$i] = trim($horaF[$i]);

                if($horaI[$i] != $horaF[$i]){
                    $hora [] = false; 
                }else {
                    $hora[] = true; 
                }
                
            }
            
            //echo count($hora) . "==" . count(array_unique($hora));
            

            if (count(array_unique($hora)) == 1) {
                $hora = array_unique($hora);
                if(!$hora[0]){
                    $igualHora = false;
                }else {
                    $igualHora = true;
                }
            }else {
                $igualHora = true;
            }
        }

        return $igualHora;

    }


    function horaMayor($horaI, $horaF){

        //Si HF>HI = TRUE, HI<HF = FALSE

        $horaI1 = arrayIntHora($horaI);
        $horaF1 = arrayIntHora($horaF);

        $hora = [];

        if( count($horaI1) == 1 && count($horaF1) == 1){
        
            if($horaF1[0] > $horaI1[0]){
                    $mayorHora= false;
                }else {
                    $mayorHora= true; 
                }
        }else {
            for ($i=0; $i <sizeof($horaI); $i++) { 
                //echo ($horaF1[$i] . ">" . $horaI1[$i] . "\n");
                if($horaF1[$i] < $horaI1[$i] ){
                    $hora[] = true;
                //  echo "hola";
                }else {
                    $hora[] = false;
                //  echo "adios";
                }

                
            }
            //print_r($hora);

            if (count(array_unique($hora)) == 1) {
                $hora = array_unique($hora);
                if(!$hora[0]){
                    $mayorHora = false;
                }else {
                    $mayorHora = true;
                }
            }else {
                $mayorHora = true;
            }
        }

        return $mayorHora;

    }




    function arrayIntHora($array){
        $resp = [] ;

        for ($i=0; $i <count($array) ; $i++) { 
            

            if($array[$i] == 0){
                $resp [] = 24;
            }else {
                $resp []= (int)$array[$i];
            }
        }

        return $resp;
    }

?>