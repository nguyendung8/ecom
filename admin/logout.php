<?php 
    session_start();
    unset($_SESSION["ADMIN"]);
    header("location:login.php");
    exit();
?>