<?php 
    session_start();
    
    unset($_GET);

    unset($_POST);

    session_destroy();

    header("Location: ../index.php");
?>