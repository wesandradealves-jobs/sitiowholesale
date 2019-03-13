<?php 
    session_start();
    $_SESSION['idioma'] = 'ja';
    header("Location: index.php");
?>