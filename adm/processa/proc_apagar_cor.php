<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 				= $_GET["id"];

$query = "DELETE FROM cor WHERE id=$id";
$resultado = mysqli_query($connection,$query);
$linhas = mysqli_affected_rows($connection);

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
		if (mysqli_affected_rows($connection) != 0 ){	
			header('Location: ../administrativo.php?link=36');	   
		}
		 else{ 	
				echo "
				<script type=\"text/javascript\">
					alert(\"Cor não foi apagada com Sucesso.\");
				</script>
			";		   
			header('Location: ../administrativo.php?link=36');
		}

		?>
	</body>
</html>