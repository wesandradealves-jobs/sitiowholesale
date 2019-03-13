<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 	   			               = $_POST["id"];
$pedido_situacao_descricao_ingles  = $_POST["pedido_situacao_descricao_ingles"];
$pedido_situacao_descricao_japones = $_POST["pedido_situacao_descricao_japones"];

$query = mysqli_query($connection,"UPDATE pedido_situacao set pedido_situacao_descricao_ingles ='$pedido_situacao_descricao_ingles', pedido_situacao_descricao_japones='$pedido_situacao_descricao_japones' WHERE id='$id'");
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
				alert(\"Registro não foi editado com Sucesso.\");
				</script>
				";	
				header('Location: ../administrativo.php?link=69');	   
			}
		?>
	</body>
</html>