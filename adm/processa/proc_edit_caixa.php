<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$caixa_kg               = $_POST["id"];
$caixa_valor_embalagem	= $_POST["caixa_valor_embalagem"];

$query = mysqli_query($connection,'UPDATE caixas set caixa_valor_embalagem ="'.$caixa_valor_embalagem.'" WHERE caixa_kg="'.$caixa_kg.'"');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=64');		   
			}
			else{ 	
				header('Location: ../administrativo.php?link=64');
			}
		?>
	</body>
</html>