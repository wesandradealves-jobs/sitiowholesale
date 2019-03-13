<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 	   			         = $_POST["id"];
$mensagem_ingles	 = $_POST["mensagem_ingles"];
$mensagem_japones = $_POST["mensagem_japones"];

$query = mysqli_query($connection,'UPDATE mensagens set mensagem_ingles ="'.$mensagem_ingles.'", mensagem_japones="'.$mensagem_japones.'" WHERE id="'.$id.'"');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=53');		   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"mensagem de produto não foi editado com Sucesso.\");
				</script>
				";	
				header('Location: ../administrativo.php?link=53');	   
			}
		?>
	</body>
</html>