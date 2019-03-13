<?php
	ob_start();
	if((!isset($_SESSION['clienteId'])) || (!isset($_SESSION['clienteNome'])) || (!isset($_SESSION['clienteEmail'])) || (!isset($_SESSION['clienteSenha']))){
		unset($_SESSION['clienteId'],			
			$_SESSION['clienteNome'], 		
			$_SESSION['clienteEmail'], 		
			$_SESSION['clienteSenha']);
		
		//Manda o usuário para a tela de login
		header("Location: login.php");
	}
?>