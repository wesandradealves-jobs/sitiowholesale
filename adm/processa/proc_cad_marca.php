<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$marca_descricao 				= $_POST["marca_descricao"];

$query = mysqli_query($connection,'INSERT INTO marcas (marca_descricao, marca_criacao) VALUES ("'.$marca_descricao.'",  "'.date($now).'")');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>
	
	<body>
		<?php
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=32');		   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"Categoria de produto não foi cadastrado com Sucesso.\");
				</script>
				";
				header('Location: ../administrativo.php?link=32');		   
			}
		?>
	</body>
</html>