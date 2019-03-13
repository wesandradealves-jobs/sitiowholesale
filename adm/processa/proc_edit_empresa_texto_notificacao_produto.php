<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");

$empresa_assunto_notificacao_produto_ingles	    = $_POST["empresa_assunto_notificacao_produto_ingles"];
$empresa_texto_notificacao_produto_ingles	    = $_POST["empresa_texto_notificacao_produto_ingles"];
$empresa_assunto_notificacao_produto_japones	= $_POST["empresa_assunto_notificacao_produto_japones"];
$empresa_texto_notificacao_produto_japones	    = $_POST["empresa_texto_notificacao_produto_japones"];

$query = mysqli_query($connection,'UPDATE empresa set empresa_assunto_notificacao_produto_ingles  ="'.$empresa_assunto_notificacao_produto_ingles.'", 
                                                      empresa_texto_notificacao_produto_ingles    ="'.$empresa_texto_notificacao_produto_ingles.'", 
                                                      empresa_assunto_notificacao_produto_japones ="'.$empresa_assunto_notificacao_produto_japones.'", 
                                                      empresa_texto_notificacao_produto_japones   ="'.$empresa_texto_notificacao_produto_japones.'", 
                                                      empresa_modificacao        				  ="'.date($now).'"
                                                      WHERE id=1');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=79');		   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"Marca não editada com Sucesso.\");
				</script>
				";		
				header('Location: ../administrativo.php?link=79');   
			}
		?>
	</body>
</html>