<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$mensagem_ingles 				= $_POST["mensagem_ingles"];
$mensagem_japones 				= $_POST["mensagem_japones"];
echo $mensagem_ingles;
echo "<br>";
echo $mensagem_japones;

$query = mysqli_query($connection,'INSERT INTO mensagens (mensagem_ingles, mensagem_japones) VALUES ("'.$mensagem_ingles.'", "'.$mensagem_japones.'")');

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
				alert(\"mensagem não foi cadastrada com Sucesso.\");
				</script>
				";		   
				header('Location: ../administrativo.php?link=53');				
			}
		?>
	</body>
</html>