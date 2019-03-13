<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 				= $_GET["id"];

$query = "DELETE FROM transp_regioes WHERE id=$id";
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
			header('Location: ../administrativo.php?link=61');		   
		}
		 else{ 	
			//retorna para a pagina anterior
			echo    "<script type='text/javascript'>  
						alert(Ocorreu um erro desconhecido!);
						history.back()
					</script>";	   
		}

		?>
	</body>
</html>