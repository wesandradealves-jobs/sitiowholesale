<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 				= $_GET["id"];

$query = "DELETE FROM situacaos WHERE id=$id";
$resultado = mysqli_query($connection,$query);
$linhas = mysqli_affected_rows();

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
					alert(\"Situação não foi apagada com Sucesso.\");
				</script>
			";		   
			header('Location: ../administrativo.php?link=14');
		}

		?>
	</body>
</html>