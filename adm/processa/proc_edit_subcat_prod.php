<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 	   			         	= $_POST["id"];
$subcategoria_descricao_ingles	= $_POST["subcategoria_descricao_ingles"];
$subcategoria_descricao_japones = $_POST["subcategoria_descricao_japones"];
$categoria_id = $_POST["categoria_id"];

$query = mysqli_query($connection,'UPDATE subcategorias set subcategoria_descricao_ingles ="'.$subcategoria_descricao_ingles.'", subcategoria_descricao_japones="'.$subcategoria_descricao_japones.'", categoria_id="'.$categoria_id.'", subcategoria_modificacao = "'.date($now).'" WHERE id="'.$id.'"');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=28');	   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"Sub Categoria de produto não foi editado com Sucesso.\");
				</script>
				";		   
				header('Location: ../administrativo.php?link=28');
			}
		?>
	</body>
</html>