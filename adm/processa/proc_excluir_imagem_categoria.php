<?php
    session_start();
    include_once("../seguranca.php");
    include_once("../conexao.php");
    $id	= $_GET["id"];

	$query = "UPDATE categorias SET categoria_imagem=null WHERE id=$id";
	$resultado = mysqli_query($connection,$query);
	unlink("../imagens/CAT_".$id.".jpg");	
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
			header('Location: ../administrativo.php?link=9&id='.$id);
		?>
	</body>
</html>