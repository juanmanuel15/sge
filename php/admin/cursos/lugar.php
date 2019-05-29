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
        $cantidad = $_POST['cantidad'];



         if(!isset($fecha, $hora_final, $hora_inicio)){
            #No están definidos los valores del tipo POST

            $respuesta = false;

         }else {

            $conexion = abrirConexion();

            #Se verifica que todos los datos que insertamos sean del tipo array

            if(is_array($fecha) && is_array($hora_inicio) && is_array($hora_final)){
                    
                    #Verificamos que no haya error alguno en el llenado del formulario HF<HI y HF == HI
                    
                    $igual = horaIgual($hora_inicio, $hora_final);
                    $mayor = horaMayor($hora_inicio, $hora_final);



                   

                    if(!$igual && !$mayor ){
                        #En el dado caso de que solo sea una fecha, solo obtenemos los lugares para ese horario.
                        if(count($fecha) == 1){

                            $respuesta = respuesta($fecha, $hora_inicio, $hora_final, lugaresDisponibles($conexion, $fecha, $hora_inicio, $hora_final, $cantidad));



                        }else {

                            #En el caso de que sean varias fecha necesitamos verificar cada una de ellas.

                            #Verificamos que todas las fechas sean diferentes
                            if(count($fecha) ==  count(array_unique($fecha))){
                                #Si es el caso, solo necesitamos introducir los datos
                                $respuesta = respuesta($fecha, $hora_inicio, $hora_final, lugaresDisponibles($conexion, $fecha, $hora_inicio, $hora_final, $cantidad));
                                
                            }else {

                                #En caso contrario necesitamos verificar cada uno de los horarios 
                                
                                #Esta funcion nos retorna TRUE en caso de que no se traslapen y las fechas sean correctas, en caso contrario FALSE y necesitamos verificar los formularios.
                                $valor = arrayFecha_Hora($fecha, $hora_inicio, $hora_final);

                                if($valor) {
                                    #Mandamos a llamar la función que nos permite obtener los datos y enviarlos al seleccionador

                                    $respuesta = respuesta($fecha, $hora_inicio, $hora_final, lugaresDisponibles($conexion, $fecha, $hora_inicio, $hora_final, $cantidad));            

                                   
                                } else{
                                    $respuesta = false;
                                }

                            }                        

                        }
                    }else {
                        $respuesta = false;
                    }

            }else {
                $respuesta = false;
            }


         }

    }


    echo  json_encode($respuesta);

    


    function horaIgual ($horaI, $horaF){

        $HI = [];
        $HF = [];




        for ($i=0; $i <count($horaI) ; $i++) { 
            
            $HI = hora($horaI[$i]);
            $HF= hora($horaF[$i]);

            if($HI == $HF){
                $hora []= true;
            }else {
                $hora []= false;
            }

        }


        $igualHora = array_search(true, $hora);

        if($igualHora === false ){
            $igualHora = false;
        }else {
            $igualHora = true;
        }


        return $igualHora;

    }


    function horaMayor($horaI, $horaF){

        $HI = [];
        $HF = [];




        for ($i=0; $i <count($horaI) ; $i++) { 
            
            $HI = hora($horaI[$i]);
            $HF= hora($horaF[$i]);

            if($HI > $HF){
                $hora []= true;
            }else {
                $hora []= false;
            }

        }



        $mayorHora = array_search(true, $hora);

        if($mayorHora === false ){
            $mayorHora = false;
        }else {
            $mayorHora = true;
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

    function arrayFecha_Hora($fecha, $HI, $HF){

        $respuesta = [];
        for ($i=0; $i <= count($fecha)-2 ; $i++) { 
            for ($j=$i+1; $j <= count($fecha)-1; $j++) { 
                if($fecha[$i] == $fecha[$j]){
                    //echo (int)hora($HI[$j]).  ">=" . (int)hora($HF[$i]). "&&" . (int)hora($HI[$i]).  "<=" . (int)hora($HF[$j]);
                    if((int)hora($HI[$j]) >= (int)hora($HF[$i]) && (int)hora($HI[$i]) <= (int)hora($HF[$j])){
                        #Cuando no estan traslapados los horarios.
                        $respuesta[] = true;
                    }else {
                        #Cuando estan traslapados los horarios
                        $respuesta[] = false;
                    }
                }

                else {

                    #Cuando las fechas no están traslapadas
                    $respuesta[] = true;                    
                }

            }
        }

               

        $respuesta = array_unique($respuesta);

        if(count($respuesta) == 1){

            if ($respuesta[0] == true) {
                $respuesta = true;
            }else {
                $respuesta = false;
            }
        }else{
            $respuesta = false;
        }
        
        

        return $respuesta;
    }


    function fecha($fecha){
        $fecha = str_replace('-', '', $fecha);
        return $fecha;
    }

    function hora($hora){
        $hora = str_replace(':', '', $hora);
        $hora = substr($hora, 0, -2);
        //print_r($hora);
        return $hora;
    }

    function arrayInt($array){
        $resp = [] ;

        for ($i=0; $i <count($array) ; $i++) {          
                $resp []= (double)$array[$i];          
        }

        return $resp;
    }

    function lugaresDisponibles($conn, $fecha, $HI, $HF, $cantidad){
        $respuesta =  [];
        for ($i=0; $i <count($fecha) ; $i++) {

            $resultado = [];

            //$query = "SELECT id_lugar, nombre_lugar  FROM lugar WHERE id_lugar NOT IN  (SELECT DISTINCT lugar.id_lugar FROM lugar INNER JOIN horario ON lugar.id_lugar =  horario.id_lugar AND horario.hora_inicio < '$HF[$i]' AND horario.hora_final > '$HI[$i]' AND horario.fecha = '$fecha[$i]')";

            $query = "SELECT id_lugar, lugar.nombre_lugar, lugar.lugares FROM lugar WHERE lugar.lugares >= $cantidad  AND id_lugar NOT IN (SELECT lugar.id_lugar FROM lugar, horario WHERE lugar.id_lugar = horario.id_lugar  AND horario.hora_inicio < '$HF[$i]' AND horario.hora_final > '$HI[$i]' AND horario.fecha = '$fecha[$i]');";

            //echo $query;

            $lectura = leerDatos($conn, $query);



            while($row = $lectura->fetch_array()){
                $resultado[] = [
                    'id' => $row[0],
                    'nombre' => $row[1]
                ]; 
            }

            array_push($respuesta, $resultado);
        }
        
        return $respuesta;
    }


    function respuesta($fecha, $HI, $HF, $lugar){
        $aFecha = [];
        $aHI = [];

        for ($i=0; $i < count($fecha); $i++) {             
            $aFecha [] = $fecha[$i]; 
            $aHI [] = $HI[$i];
            $aHF [] = $HF [$i];
        }

        return $respuesta  = [

            'fecha' => $aFecha,
            'HI' => $aHI,
            'HF' => $aHF, 
            'lugar' => $lugar

        ];

    }

?>