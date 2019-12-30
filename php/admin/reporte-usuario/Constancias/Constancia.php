<?php

    class Constancia{

        function pdf_alumno($datos){
            include('archivo/alumno.php');
        }

        function pdf_profesor($datos){
            require('archivo/profesor.php');
        }

        function pdf_colaborador(){
            require('archivo/colaborador.php');
        }

        function error(){
            require('archivo/error_asistencia.php');
        }

        function warnning(){
            require('archivo/warning_asistencia.php');
        }

        function porcentaje(){
            require('archivo/insuficiente_asistencia.php');
        }

        function personalizar($datos){
            if($datos['res']['tipo_usuario'] == 'pon'){
                require('archivo/personalizarPonente.php');
            }elseif($datos['res']['tipo_usuario'] == 'asis'){
                require('archivo/personalizarAsistente.php');
            }elseif ($datos['res']['tipo_usuario'] == 'col') {
                require('archivo/personalizarColaborador.php');
            }
            
        }

        function pdf_editar($datos){
            require('archivo/editar.php');
        }

        function pdf_error(){
            require('archivo/error.php');
        }

        function pdf_repetido(){
            require('archivo/repetido.php');
        }


    }


?>