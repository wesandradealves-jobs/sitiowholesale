<?php
session_start();
include_once("conexao.php");
	$id_produto 	= $_POST["prd_notificacao"];
    $cliente_email 	= $_POST["cliente_email"];

    $query = mysqli_query($connection,"INSERT INTO notificacoes (notificacao_email, produto_id, notificacao_idioma, notificacao_criacao) VALUES ('$cliente_email', '$id_produto', '$http_lang', '".date($now)."')");

    $query =mysqli_query($connection,'SELECT mensagem_'.$msg_idioma.' as mensagem FROM mensagens WHERE id=86'); 
	while($line = mysqli_fetch_assoc($query)){
        $_SESSION['notificacao'] = $line['mensagem'];
    }
    $var = "<script>javascript:history.back(-2)</script>";
    echo $var;
?>