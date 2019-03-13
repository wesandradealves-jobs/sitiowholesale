<?php
session_start();
include_once("../conexao.php");
    $lista_email 	= $_POST["lista_email"];

    $query =mysqli_query($connection,"DELETE FROM lista_emails WHERE id ='$lista_email'"); 
    $query = mysqli_query($connection,"INSERT INTO lista_emails (id, lista_email_idioma) VALUES ('$lista_email', '$http_lang')");

    echo '<script> location.replace("../"); </script>';
?>