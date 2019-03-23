<?php session_start();

    if(isset($_SESSION['admin'])){
        header('Location: ../php/admin/');
    }

    else {
        header('Location: index.php');
    }


?>