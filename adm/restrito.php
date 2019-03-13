<?php 
	if($_SESSION['usuarioId'] != "1"){  
		header('Location: administrativo.php');
		exit;
	}
?>