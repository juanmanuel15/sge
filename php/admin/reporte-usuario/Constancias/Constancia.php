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


    }


?>