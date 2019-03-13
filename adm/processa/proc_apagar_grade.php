<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 				= $_GET["id"];

$query = "DELETE FROM grades WHERE id=$id";
$resultado = mysqli_query($connection,$query);

$query2 = "DELETE FROM grade_itens WHERE grade_id=$id";
$resultado2 = mysqli_query($connection,$query2);

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
			header('Location: ../administrativo.php?link=40');	   
		}
		 else{ 	
				echo "
				<script type=\"text/javascript\">
					alert(\"Grade não foi apagada com Sucesso.\");
				</script>
			";		   
			header('Location: ../administrativo.php?link=40');
		}

		?>
	</body>
</html>