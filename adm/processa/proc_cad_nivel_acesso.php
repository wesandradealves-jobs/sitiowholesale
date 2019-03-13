<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$nome_nivel 				= $_POST["nome_nivel"];

$query = mysqli_query($connection,"INSERT INTO nivel_acessos (nome_nivel, created) VALUES ('$nome_nivel', NOW())");
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
		if (mysqli_affected_rows($connection) != 0 ){	
			header('Location: ../administrativo.php?link=18');
		}
		 else{ 	
				echo "
				<script type=\"text/javascript\">
					alert(\"Nivel de acesso não foi cadastrado com Sucesso.\");
				</script>
			";		   
			header('Location: ../administrativo.php?link=18');
		}

		?>
	</body>
</html>