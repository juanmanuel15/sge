<?php session_start();

    if(isset($_SESSION['prof'])){
        header('Location: ../php/profesor/');
    }

    else {
        header('Location: index.php');
    }


?>