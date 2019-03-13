<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$caixa_kg				= $_POST["caixa_kg"];
$caixa_valor_embalagem	= $_POST["caixa_valor_embalagem"];

$query = mysqli_query($connection,'INSERT INTO caixas (caixa_kg, caixa_valor_embalagem) VALUES ("'.$caixa_kg.'", "'.$caixa_valor_embalagem.'")');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>
	
	<body>
		<?php
			if (mysqli_affected_rows($connection) > 0 ){	
				header('Location: ../administrativo.php?link=64');		   
			}
			else{ 	
                //retorna para a pagina anterior
                echo    "<script type='text/javascript'>  
                            alert('Ocorreu um erro desconhecido!');
                            history.back()
                        </script>";	     
			}
		?>
	</body>
</html>