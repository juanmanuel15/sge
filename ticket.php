<?php
	
	session_start();

    if(isset($_SESSION['usuario'])){
       require('php/usuario/ticket.php');
    }else {
        header('Location: login.php');
    }

    

?>