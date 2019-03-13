<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$pedido_situacao_descricao_ingles 				= $_POST["pedido_situacao_descricao_ingles"];
$pedido_situacao_descricao_japones 				= $_POST["pedido_situacao_descricao_japones"];

$query = mysqli_query($connection,"INSERT INTO pedido_situacao (pedido_situacao_descricao_ingles, pedido_situacao_descricao_japones) VALUES ('$pedido_situacao_descricao_ingles', '$pedido_situacao_descricao_japones')");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>
	
	<body>
		<?php
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=69');	   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"Situacao nao foi cadastrado com Sucesso.\");
				</script>
				";		   
				header('Location: ../administrativo.php?link=69');				
			}
		?>
	</body>
</html>