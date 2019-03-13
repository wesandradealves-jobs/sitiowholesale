<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 				= $_GET["id"];

$query = "DELETE FROM tipo_unitario WHERE id=$id";
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
			header('Location: ../administrativo.php?link=44');		   
		}
		 else{ 	
				echo "
				<script type=\"text/javascript\">
					alert(\"Tipo Unitario não foi apagado com Sucesso.\");
				</script>
			";		   
			header('Location: ../administrativo.php?link=44');
		}

		?>
	</body>
</html>