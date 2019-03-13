<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 	   			         = $_POST["id"];
$marca_descricao	 = $_POST["marca_descricao"];

$query = mysqli_query($connection,'UPDATE marcas set marca_descricao ="'.$marca_descricao.'", marca_modificacao = "'.date($now).'" WHERE id="'.$id.'"');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=32');		   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"Marca não editada com Sucesso.\");
				</script>
				";		
				header('Location: ../administrativo.php?link=32');   
			}
		?>
	</body>
</html>