<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 	   			         = $_POST["id"];
$cor_descricao_ingles  	= $_POST["cor_descricao_ingles"];
$cor_descricao_japones 	= $_POST["cor_descricao_japones"];
$cor_html 				= $_POST["cor_html"];

$query = mysqli_query($connection,'UPDATE cor set cor_descricao_ingles ="'.$cor_descricao_ingles.'", cor_descricao_japones="'.$cor_descricao_japones.'", cor_html ="'.$cor_html.'", cor_modificacao = "'.date($now).'" WHERE id="'.$id.'"');
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
				alert(\"Cor não foi editada com Sucesso.\");
				</script>
				";	
				header('Location: ../administrativo.php?link=36');	   
			}
		?>
	</body>
</html>