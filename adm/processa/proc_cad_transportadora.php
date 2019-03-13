<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$transportadora_ingles 			= $_POST["transportadora_ingles"];
$transportadora_japones 		= $_POST["transportadora_japones"];

$query = mysqli_query($connection,'INSERT INTO transportadoras (transportadora_ingles, transportadora_japones) VALUES ("'.$transportadora_ingles.'", "'.$transportadora_japones.'")');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>
	
	<body>
		<?php
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=58');	   
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