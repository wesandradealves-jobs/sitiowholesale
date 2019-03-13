<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 				= $_POST["id"];
$nome_nivel 				= $_POST["nome_nivel"];
$query = mysqli_query($connection,"UPDATE nivel_acessos set nome_nivel ='$nome_nivel', modified = NOW() WHERE id='$id'");
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>
	<body>
		<?php
		if (mysqli_affected_rows() != 0 ){	
			header('Location: ../administrativo.php?link=18');		   
		}
		 else{ 	
				echo "
				<script type=\"text/javascript\">
					alert(\"Nivel de acesso não foi editado com Sucesso.\");
				</script>
			";		   
			header('Location: ../administrativo.php?link=18');
		}

		?>
	</body>
</html>