<?php
session_start();
include_once("../conexao.php");
    $lista_email 	= $_POST["lista_email"];

    $query =mysqli_query($connection,"DELETE FROM lista_emails WHERE id ='$lista_email'"); 

    echo '<script> location.replace("../"); </script>';
?>