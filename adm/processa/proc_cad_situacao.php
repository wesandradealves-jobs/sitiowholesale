<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$nome 				= $_POST["nome"];

$query = mysqli_query($connection,"INSERT INTO situacaos (nome, created) VALUES ('$nome', NOW())");
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
		if (mysqli_affected_rows() != 0 ){	
			header('Location: ../administrativo.php?link=14');		   
		}
		 else{ 	
				echo "
				<script type=\"text/javascript\">
					alert(\"Situação não foi cadastrada com Sucesso.\");
				</script>
			";		   
			header('Location: ../administrativo.php?link=14');
		}

		?>
	</body>
</html>