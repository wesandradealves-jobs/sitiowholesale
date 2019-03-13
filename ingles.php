<?php 
    session_start();
    $_SESSION['idioma'] = 'en';
    header("Location: index.php");
?>