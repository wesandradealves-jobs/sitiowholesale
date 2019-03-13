<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$cor_descricao_ingles 	= $_POST["cor_descricao_ingles"];
$cor_descricao_japones 	= $_POST["cor_descricao_japones"];
$cor_html 				= $_POST["cor_html"];

$query = mysqli_query($connection,'INSERT INTO cor (cor_descricao_ingles, cor_descricao_japones, cor_html, cor_criacao) VALUES ("'.$cor_descricao_ingles.'", "'.$cor_descricao_japones.'", "'.$cor_html.'","'.date($now).'")');
?>
<!DOCTYPE html>
<html>
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
				alert(\"cor não foi cadastrada com Sucesso.\");
				</script>
				";		
				header('Location: ../administrativo.php?link=36');   
			}
		?>
	</body>
</html>