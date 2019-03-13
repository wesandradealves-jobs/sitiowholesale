<?php
session_start();
//session_destroy(); //linha comentada para nao apagar itens do carrinho

//Remove todas as informações contidas na variaveis globais
unset($_SESSION['clienteId'],			
      $_SESSION['clienteNome'], 		
      $_SESSION['clienteLogin'], 		
      $_SESSION['clienteSenha'], 		
      $_SESSION['cep'], 		
      $_SESSION['endereco'],
      $_SESSION['nome'],
	$_SESSION['telefone'],
	$_SESSION['celular']);

//redirecionar o usuário para a página principal
header("Location: login.php");
?>