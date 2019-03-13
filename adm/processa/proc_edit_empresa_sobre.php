<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");

$empresa_titulo_sobre_ingles	= $_POST["empresa_titulo_sobre_ingles"];
$empresa_texto_sobre_ingles	    = $_POST["empresa_texto_sobre_ingles"];
$empresa_titulo_sobre_japones	= $_POST["empresa_titulo_sobre_japones"];
$empresa_texto_sobre_japones	= $_POST["empresa_texto_sobre_japones"];

$query = mysqli_query($connection,'UPDATE empresa set empresa_titulo_sobre_ingles  ="'.$empresa_titulo_sobre_ingles.'", 
                                                      empresa_texto_sobre_ingles   ="'.$empresa_texto_sobre_ingles.'", 
                                                      empresa_titulo_sobre_japones ="'.$empresa_titulo_sobre_japones.'", 
                                                      empresa_texto_sobre_japones  ="'.$empresa_texto_sobre_japones.'", 
                                                      empresa_modificacao          ="'.date($now).'"
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
				header('Location: ../administrativo.php?link=80');		   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"Marca não editada com Sucesso.\");
				</script>
				";		
				header('Location: ../administrativo.php?link=80');   
			}
		?>
	</body>
</html>