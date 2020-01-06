<?php

	
	
	class Consultas{

		

		function buscarUsuario($inf){
			
			$busqueda = explode(" ", $inf);



			$query = "SELECT usuario.nCuenta, usuario.usuario, usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.cuenta, area.nombre as carrera,  tipo_usuario.usuario as tipo_usuario  FROM usuario, area, tipo_usuario WHERE (usuario.id_area = area.id_area AND usuario.tipo_usuario = tipo_usuario.id_tipoUsuario) AND (";

			for($i=0; $i<sizeof($busqueda); $i++){
				


				$query .= "usuario.usuario 		LIKE 	'%$busqueda[$i]%'	OR 
						   usuario.nombre		LIKE	'%$busqueda[$i]%'	OR
						   usuario.apellidoP	LIKE	'%$busqueda[$i]%'	OR
						   usuario.apellidoM	LIKE	'%$busqueda[$i]%'	OR
						   usuario.correo 		LIKE 	'%$busqueda[$i]%' 	OR 
						   usuario.ncuenta 		LIKE 	'%$busqueda[$i]%'	";

				if($i != sizeof($busqueda)-1){
					$query .= ")AND(";
				}

				if($i == sizeof($busqueda)-1){
					$query .= ")";
				}
			}

			

			return  $query;

		}

		function buscarCurso($curso){
			$busqueda = explode(" ", $curso);
			$query = "SELECT id_curso, titulo FROM curso WHERE (";

			for($i=0; $i<sizeof($busqueda); $i++){	

					$query .= "titulo 		LIKE 	'%$busqueda[$i]%'	OR 
							   descripcion	LIKE	'%$busqueda[$i]%'	OR
							   id_curso		LIKE	'%$busqueda[$i]%'	";

					if($i != sizeof($busqueda)-1){
						$query .= ")AND(";
					}

					if($i == sizeof($busqueda)-1){
						$query .= ")";
					}
				}

				return $query;
		}


		function disponibilidadCurso($curso){
			return $query = "SELECT  COUNT(curso_usuario_insc.id_curso) AS inscritos, curso.lugares  FROM curso_usuario_insc, curso WHERE curso_usuario_insc.id_curso = '$curso' AND curso.id_curso = curso_usuario_insc.id_curso";
		}

		function comprobarInscrito($usuario, $curso){


			$query = "SELECT * FROM curso_usuario_insc WHERE curso_usuario_insc.nCuenta = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario') AND curso_usuario_insc.id_curso = '$curso';";
			
			return $query;

		}

		function horarioCursosImpartidos($usuario){
			return $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final FROM horario, curso_usuario_org, usuario, curso WHERE curso_usuario_org.nCuenta = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario') AND usuario.nCuenta = curso_usuario_org.nCuenta AND horario.id_curso = curso.id_curso AND curso_usuario_org.id_curso = curso.id_curso";
		}

		function horarioCursosResponsable($usuario){
			return $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final FROM horario, curso_usuario_resp, usuario, curso WHERE curso_usuario_resp.nCuenta = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario') AND usuario.nCuenta = curso_usuario_resp.nCuenta AND horario.id_curso = curso.id_curso AND curso_usuario_resp.id_curso = curso.id_curso";
		}



		function horarioOcupadosInscritos($usuario){
			return $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final FROM horario, curso_usuario_insc, usuario, curso WHERE curso_usuario_insc.nCuenta = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario') AND usuario.nCuenta = curso_usuario_insc.nCuenta AND horario.id_curso = curso.id_curso AND curso_usuario_insc.id_curso = curso.id_curso";
		}


		function horarioCurso($id_curso){
			return $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final FROM horario, curso WHERE curso.id_curso = '$id_curso' AND  horario.id_curso = curso.id_curso";
		}

		

		function lugares($id_curso){
			return $query = "SELECT IF( (SELECT  COUNT(id_curso) AS inscritos FROM curso_usuario_insc WHERE curso_usuario_insc.id_curso = '$id_curso') < ( SELECT lugares  FROM curso WHERE id_curso = '$id_curso') , 1, 0) AS cupo FROM curso WHERE id_curso = '$id_curso'; ";
		}


		function insertarUsuarioCurso($curso, $usuario){
			return $query = "INSERT INTO curso_usuario_insc (nCuenta, id_curso) VALUES ( (SELECT nCuenta FROM usuario WHERE usuario = '$usuario') , '$curso');";
		}

		function buscarHorarioCurso($usuario, $curso){
			return $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final 
			FROM horario, curso_usuario_insc, usuario, curso WHERE curso.id_curso = curso_usuario_insc.id_curso  AND usuario.nCuenta = curso_usuario_insc.nCuenta 
			AND usuario.nCuenta = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario') AND curso_usuario_insc.id_curso = '$curso' 
			AND horario.id_curso = curso.id_curso ORDER BY DATE(horario.fecha);";

		}


		function buscarAsistenciaUsuario($usuario,$curso){
			return $query = "SELECT id_asistencia, hora_e, hora_s, fecha_e, fecha_s, check_in, check_out FROM asistencia WHERE id_usuario = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario' ) AND id_curso = '$curso'; ";
		}


		function actualizarAsistenciaUsuario($id, $entrada, $salida){
			return $query = "UPDATE asistencia SET check_in = $entrada, check_out = $salida WHERE id_asistencia = '$id'";
		}


		function eliminarRegistroAsistencia($id){
			return $query = "DELETE FROM asistencia where id_asistencia = '$id'"; 
		}

		function insertarRegistroAsistencia($id, $fecha, $hora_e, $id_usuario, $id_curso, $entrada, $salida){
			return $query = "INSERT INTO asistencia (id_asistencia, fecha_e, fecha_s, hora_e, hora_s, id_usuario, id_curso, check_in, check_out) VALUES ('$id', '$fecha', '$fecha', '$hora_e', '$hora_e', (SELECT ncuenta FROM usuario WHERE usuario = '$id_usuario'), '$id_curso', $entrada, $salida)";
		}


		function buscar_RegistroAsistencia($txt){
			$busqueda = explode(" ", $txt);

			
			$query = "SELECT DISTINCT usuario.usuario, usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.nCuenta, curso.id_curso, curso.titulo FROM curso, usuario, asistencia WHERE  asistencia.id_usuario = usuario.nCuenta AND asistencia.id_curso = curso. id_curso AND (";

			for($i=0; $i<sizeof($busqueda); $i++){
				


				$query .= "usuario.usuario 		LIKE 	'%$busqueda[$i]%'	OR 
						   usuario.nombre		LIKE	'%$busqueda[$i]%'	OR
						   usuario.apellidoP	LIKE	'%$busqueda[$i]%'	OR
						   usuario.apellidoM	LIKE	'%$busqueda[$i]%'	OR						   
						   usuario.ncuenta 		LIKE 	'%$busqueda[$i]%'	OR
						   curso.titulo			LIKE	'%$busqueda[$i]%'	";

				if($i != sizeof($busqueda)-1){
					$query .= ")AND(";
				}

				if($i == sizeof($busqueda)-1){
					$query .= ")  ORDER BY usuario.apellidoP ASC";
				}
			}

			return $query;
		}


		function porcentajeAsistencia(){
			return $query = "SELECT porcentaje_asistencia,universidad, campus, tipo_documento,slogan, nombre_director, evento, director FROM conf WHERE id ='conf_alumnos'";
		}


		function leer_ConstanciasProfesor(){
			return $query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, curso.titulo, curso.id_curso, usuario.usuario FROM curso, usuario, curso_usuario_org WHERE curso_usuario_org.id_curso = curso.id_curso AND curso_usuario_org.nCuenta = usuario.nCuenta";
		}



		function mostrar_elementoUsuario(){
			return $query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.usuario, tipo_usuario.usuario , area.nombre, usuario.cuenta FROM usuario, tipo_usuario, AREA WHERE usuario.tipo_usuario = tipo_usuario.id_tipoUsuario AND usuario.id_area = area.id_area order by usuario.apellidoP;";
			//return return $query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.usuario, tipo_usuario.usuario , area.nombre, usuario.cuenta FROM usuario, tipo_usuario, AREA WHERE usuario.tipo_usuario = tipo_usuario.id_tipoUsuario AND usuario.id_area = area.id_area order by usuario.apellidoP;";
		}

		function select_tipoUsuario(){
			return $query = "SELECT * FROM tipo_usuario ORDER BY usuario ASC";
		}


		function select_usuario_carrera(){
			return $query = "SELECT id_area, nombre FROM area ORDER  BY nombre ASC";
		}


		function consultar_correo($correo){
			return $query = "SELECT * FROM usuario WHERE correo = '$correo'; ";
		}

		function consultar_usuario($usuario){
			return $query = "SELECT * FROM usuario WHERE usuario = '$usuario'; ";
		}

		function consultar_cuenta($cuenta){
			return $query = "SELECT * FROM usuario WHERE cuenta = '$cuenta'; ";
		}

		
		function insertar_usuario($nCuenta, $nombre,$apellidoP,$apellidoM,$correo, $usuario,$pass,$telefono,$tipoUser, $area,$id){
			return $query = "INSERT INTO usuario (nCuenta, id_area, cuenta, nombre, apellidoP, apellidoM, correo, usuario, pass, tipo_usuario, telefono) VALUES ('$id', $area, '$nCuenta', '$nombre', '$apellidoP', '$apellidoM', '$correo', '$usuario', '$pass', $tipoUser, '$telefono') ";
		}

		function eliminar_usuario($id){
			return $query = "DELETE FROM usuario WHERE nCuenta = '$id'";
		}

		function leer_usuario($id){
			return $query = "SELECT usuario.nCuenta, AREA.nombre AS area, usuario.cuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.correo, usuario.pass, usuario.telefono, tipo_usuario.usuario AS tipo_usuario, usuario.usuario FROM usuario, AREA, tipo_usuario WHERE nCuenta = '$id' AND usuario.id_area = AREA.id_area AND tipo_usuario.id_tipoUsuario = usuario.tipo_usuario;";
		}

		function actualizar_usuario($cuenta, $nombre, $apellidoP, $apellidoM, $correo, $usuario, $pass, $telefono, $tipoUser, $area,  $id){

			return "UPDATE usuario SET usuario = '$usuario', cuenta = '$cuenta', nombre = '$nombre', apellidoP = '$apellidoP', apellidoM = '$apellidoM', correo = '$correo', pass = '$pass', telefono = '$telefono', tipo_usuario = $tipoUser, id_area = $area WHERE nCuenta = '$id'";
		}

		function select_tipoDocumento(){			
			return $query = "SELECT tipo_documento, evento  from conf ORDER BY tipo_documento ASC";
		}

		function select_cursos(){
			return $query = "SELECT titulo, id_curso FROM curso ORDER BY titulo ASC";
		}

		function select_tipoActividad(){
			return $query = "SELECT nombre_tipo_actividad FROM tipo_actividad ORDER BY nombre_tipo_actividad ASC";
		}


		//---------Cursos -------//

		function leer_Curso($id){
			return $query = "SELECT curso.id_curso, curso.titulo, curso.descripcion, tipo_actividad.nombre_tipo_actividad as tActividad, curso.prerrequisitos, curso.dirigido, curso.lugares, tipo_actividad.id_tipo_actividad FROM curso, tipo_actividad WHERE id_curso = '$id' AND tipo_actividad.id_tipo_actividad = curso.id_tipo_actividad;";
		}

		function leer_tActividad_Curso($id){
			return $query = "SELECT id_tipo_actividad as id, nombre_tipo_actividad as nombre FROM tipo_actividad WHERE id_tipo_actividad = $id";
		}

		function leer_requerimientos_curso($id){
			return $query = "SELECT requerimientos.id_req as id, requerimientos.nombre_req as nombre FROM requerimientos, req_curso, curso WHERE req_curso.id_req = requerimientos.id_req AND curso.id_curso = req_curso.id_curso AND req_curso.id_curso = '$id'";
		}

		function leer_material_curso($id){
			return $query = "SELECT id_mat as id, nombre_material as nombre, cantidad as cantidad FROM material WHERE id_curso = '$id'";
		}

		function leer_horario_curso($id){
			return $query = " SELECT horario.id_horario, horario.fecha, horario.hora_inicio, horario.hora_final, horario.id_lugar, lugar.nombre_lugar, lugar.lugares FROM horario, lugar, curso WHERE horario.id_curso = curso.id_curso AND lugar.id_lugar = horario.id_lugar AND horario.id_curso = '$id'";
		}

		function leer_profesor_curso($id){
			return $query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM FROM usuario, curso_usuario_org, curso WHERE usuario.nCuenta = curso_usuario_org.nCuenta AND curso.id_curso = '$id' AND curso_usuario_org.id_curso = curso.id_curso;";
		}

		function leer_responsable_curso($id){
			return $query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM FROM usuario, curso_usuario_resp, curso WHERE usuario.nCuenta = curso_usuario_resp.nCuenta AND curso.id_curso = '$id' AND curso_usuario_resp.id_curso = curso.id_curso;";
		}


		#/*------Actualización Curso ------------*/
		function actualizar_curso($id, $titulo, $id_tipo_actividad, $des, $pre, $dir, $lug){
			return $query = "UPDATE curso SET titulo = '$titulo', id_tipo_actividad = $id_tipo_actividad, descripcion = '$des', prerrequisitos = '$pre', dirigido = '$dir', lugares = $lug WHERE id_curso = '$id'";
		}



		function actualizar_horario($id){
			return $query = "DELETE FROM horario WHERE id_curso = '$id'";
		}

		function agregarHorario($fecha, $HI, $HF, $lugar, $id_curso){
			$query = "INSERT INTO horario (id_horario, fecha, hora_inicio, hora_final, id_curso, id_lugar) VALUES";
			for($i = 0; $i<count($fecha); $i++){
				$query .= "(NULL, '$fecha[$i]', '$HI[$i]', '$HF[$i]', '$id_curso', '$lugar[$i]')";

				if($i != count($lugar)-1){
					$query .= ",";
				}else {
					$query .= ";";
				}
			}

			return $query;
		}


		function actualizar_prof($id){
			return $query = "DELETE FROM curso_usuario_org WHERE id_curso = '$id'";
		}
		function actualizar_resp($id){
			return $query = "DELETE FROM curso_usuario_resp WHERE id_curso = '$id'";
		}


		function agregar_prof($id, $profesor){
			$query = "INSERT INTO curso_usuario_org (nCuenta, id_curso) VALUES";
			for($i = 0; $i<count($profesor); $i++){
				$query .= "('$profesor[$i]', '$id')";

				if($i != count($profesor)-1){
					$query .= ",";
				}else {
					$query .= ";";
				}
			}

			return $query; 
		}

		function agregar_resp($id, $resp){
			$query = "INSERT INTO curso_usuario_resp(nCuenta, id_curso) VALUES";
			for($i = 0; $i<count($resp); $i++){
				$query .= "('$resp[$i]', '$id')";

				if($i != count($resp)-1){
					$query .= ",";
				}else {
					$query .= ";";
				}
			}

			return $query; 
		}




		# -------- Configurar Constancias ---------#

		function leer_configurarConstancia(){
			$query = "SELECT * from conf WHERE id = 'conf_alumnos'";
			return $query;
		}

		function actualizar_configurarConstancia($nU, $nC, $tR, $tE, $FF, $FI, $lE, $lU,$p, $nD){
			return $query = "UPDATE conf SET tipo_documento = '$tR', slogan = '$lU', nombre_director = '$nD', evento = '$tE', porcentaje_asistencia = '$p', universidad = '$nU', campus = '$nC', fecha_inicial = '$FI', fecha_final = '$FF',  ubicacion = '$lE' WHERE id = 'conf_alumnos'" ;
		}



		# ------------- Editar Constancia ---------#

		function leer_constanciasGuardadas(){
			return $query = "SELECT constancia.id_constancia, constancia.nombre, constancia.apellidoP, constancia.apellidoM, curso.titulo, constancia.id_curso, constancia.usuario FROM curso, constancia WHERE curso.id_curso = constancia.id_curso";
		}

		function editar_constancia($id_constancia){
			return $query = "SELECT constancia.id_constancia, constancia.nombre, constancia.apellidoP, constancia.apellidoM FROM  constancia WHERE constancia.id_constancia = '$id_constancia'";
		}
		function actualizar_constancia($id, $name, $lastName1, $lastName2){
			return $query = "UPDATE constancia SET nombre = '$name', apellidoP = '$lastName1', apellidoM = '$lastName2' WHERE id_constancia = '$id'";
		}


		function eliminar_editarConstancia($id){
			return $query = "DELETE FROM constancia WHERE id_constancia = '$id'";
		}

		function buscar_constanciasGuardadas($dato){
			$dato = explode(" ", $dato);

			$query = "SELECT constancia.id_constancia, constancia.nombre, constancia.apellidoP, constancia.apellidoM, curso.titulo, constancia.id_curso, constancia.usuario FROM curso, constancia WHERE curso.id_curso = constancia.id_curso AND (";

			for($i=0; $i<sizeof($dato); $i++){	

				$query .= "
					   constancia.id_constancia LIKE '%$dato[$i]%' 	
					OR constancia.nombre	LIKE '%$dato[$i]%'	
				    OR constancia.apellidoP	LIKE '%$dato[$i]%' 
				    OR constancia.apellidoM	LIKE '%$dato[$i]%'
				    OR curso.titulo LIKE '%$dato[$i]%'
				    OR constancia.usuario LIKE '%$dato[$i]%'
				    ";

					if($i != sizeof($dato)-1){
						$query .= ")AND(";
					}

					if($i == sizeof($dato)-1){
						$query .= ")";
					}
			}


			return $query;
		}



		/* ----------- Cosntancias Ponentes --------- */

		function buscar_constanciaPonente($dato){
			$dato = explode(" ", $dato);

			$query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, curso.titulo, curso.id_curso, usuario.usuario FROM curso, usuario, curso_usuario_org WHERE curso_usuario_org.id_curso = curso.id_curso AND curso_usuario_org.nCuenta = usuario.nCuenta AND (";

			for($i=0; $i<sizeof($dato); $i++){	

				$query .= "
					   usuario.nCuenta LIKE '%$dato[$i]%' 	
					OR usuario.nombre	LIKE '%$dato[$i]%'	
				    OR usuario.apellidoP	LIKE '%$dato[$i]%' 
				    OR usuario.apellidoM	LIKE '%$dato[$i]%'
				    OR curso.titulo LIKE '%$dato[$i]%'
				    OR usuario.usuario LIKE '%$dato[$i]%'
				    ";

					if($i != sizeof($dato)-1){
						$query .= ")AND(";
					}

					if($i == sizeof($dato)-1){
						$query .= ")";
					}
			}


			return $query;
		}


		/* ------ Constancias Colaboradores ------- */

		function buscar_constanciaColaborador($dato){
			$dato = explode(" ", $dato);

			$query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, curso.titulo, curso.id_curso, usuario.usuario FROM curso, usuario, curso_usuario_resp WHERE curso_usuario_resp.id_curso = curso.id_curso AND curso_usuario_resp.nCuenta = usuario.nCuenta AND (";

			for($i=0; $i<sizeof($dato); $i++){	

				$query .= "
					   usuario.nCuenta LIKE '%$dato[$i]%' 	
					OR usuario.nombre	LIKE '%$dato[$i]%'	
				    OR usuario.apellidoP	LIKE '%$dato[$i]%' 
				    OR usuario.apellidoM	LIKE '%$dato[$i]%'
				    OR curso.titulo LIKE '%$dato[$i]%'
				    OR usuario.usuario LIKE '%$dato[$i]%'
				    ";

					if($i != sizeof($dato)-1){
						$query .= ")AND(";
					}

					if($i == sizeof($dato)-1){
						$query .= ")";
					}
			}


			return $query;
		}


		function leer_ConstanciasColaborador(){
			return $query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, curso.titulo, curso.id_curso, usuario.usuario FROM curso, usuario, curso_usuario_resp WHERE curso_usuario_resp.id_curso = curso.id_curso AND curso_usuario_resp.nCuenta = usuario.nCuenta";
		}



		
	}



?>

