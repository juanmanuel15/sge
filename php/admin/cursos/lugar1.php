<?php

    include ('elimina_acentos.php');
	require ('../../base.php');
    require ('../../consulta.php');

    header("Content-Type: text/html;charset=utf-8");

    $fecha = quitarCaracteres($_POST['fecha']);
	$horaI  = quitarCaracteres($_POST['horaI']);
    $horaF = quitarCaracteres($_POST['horaF']);
    
    if(!isset($fecha, $horaI, $horaF)){
        $respuesta = [
            'valor' => false
        ];

    }else {
       
        /*if(count($horaI) == 1 && count($horaF) == 1){

			if($horaI != $horaF){
					$igualHora= false;
				}else {
					$igualHora= true; 
				}
		}else {
			for ($i=0; $i <sizeof($horaI); $i++) { 

				$horaI[$i] = trim($horaI[$i]);
				$horaF[$i] = trim($horaF[$i]);

				if($horaI[$i] != $horaF[$i]){
					$hora [] = false; 
				}else {
					$hora[] = true; 
				}
			}

            

            if(count(array_unique($hora)) == 1){
                
                $valor =  array_unique($hora)[0];

                if($valor){
                    $igualHora = true;
                }else{
                    $igualHora = false;
                }
            
            }else {
                $igualHora = true;
            }
     
            
        }*/


        
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
				
				if($horaI1[$i] > $horaF1[$i] || $horaI1[$i] == $horaF1[$i]){
					$hora[] = true;
					
				}else {
					$hora[] = false;
					
				}

				
			}
            
            

            

            if(count(array_unique($hora)) == 1){
                
                $valor =  array_unique($hora)[0];

                if($valor){
                    $mayorHora = true;
                }else{
                    $mayorHora = false;
                }
            
            }else {
                $mayorHora = true;
            }



			
        }
        

        
        
        if(!$mayorHora){

            $conexion = abrirConexion();

            $query = "SELECT id_lugar, nombre_lugar FROM lugar";
            $resultado = leerDatos($conexion,$query);
            $base = [];
            while($row = $resultado->fetch_array()){
                $base [] = [
                    'id' => $row[0],
                    'nombre' => $row[1]
                ]; 
            }

            $resultado->free();


            
            $lugar = [];
            for($i = 0 ; $i<count($fecha); $i++){

               $query = "SELECT lugar.id_lugar, lugar.nombre_lugar
                FROM lugar, curso, horario   
                WHERE horario.fecha = '$fecha[$i]' AND horario.hora_inicio = '$horaI[$i]' 
                AND horario.hora_final = '$horaF[$i]' AND lugar.id_lugar = horario.id_lugar"; 
                
                $select = [];
                $resultado = leerDatos($conexion, $query);

                while($row = $resultado->fetch_array()){
                    $select [] = [
                        'id' => $row[0],
                        'nombre' => $row[1]
                    ];
                }

                $resultado->free();

                $lugar[] = $select;
            }




            /*$select = [];
            for($i = 0; $i<count($lugar); $i++){
                $select [] = array_diff($lugar[$i], $base); 
            }*/

            print_r($lugar[1]);
            //print_r($base);

            //$respuesta = $lugar;
        }else {
            $respuesta = [
                'valor' => false
            ];
        }

        
        



        
    }

    //echo json_encode($respuesta);


    function quitarCaracteres($array){
		
		if(is_array($array)){
			$resp = [];

			for ($i=0; $i <count($array) ; $i++) { 
				$resp [] = htmlspecialchars(trim($array[$i]));
			}
		}else {
			$resp = htmlspecialchars(trim($array));
		}

		return $resp;
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