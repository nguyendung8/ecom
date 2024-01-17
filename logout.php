<?php 
    session_start();
    unset($_SESSION['USER_ID']);
    unset($_SESSION['NAME']);
    unset($_SESSION['EMAIL']);
    session_destroy();
    header('location: index.php');
?>