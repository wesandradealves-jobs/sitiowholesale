<?php
	session_start();
	include_once("../seguranca.php");
	include_once("../conexao.php");
	$grade_descricao 				= $_POST["grade_descricao"];
	$grade_quantidade_tamanhos 		= $_POST["grade_quantidade_tamanhos"];

	$ingles_01 		= $_POST["ingles_01"];
	$ingles_02 		= $_POST["ingles_02"];
	$ingles_03 		= $_POST["ingles_03"];
	$ingles_04 		= $_POST["ingles_04"];
	$ingles_05 		= $_POST["ingles_05"];
	$ingles_06 		= $_POST["ingles_06"];
	$ingles_07 		= $_POST["ingles_07"];
	$ingles_08 		= $_POST["ingles_08"];
	$ingles_09 		= $_POST["ingles_09"];
	$ingles_10 		= $_POST["ingles_10"];
	$japones_01 	= $_POST["japones_01"];
	$japones_02 	= $_POST["japones_02"];
	$japones_03 	= $_POST["japones_03"];
	$japones_04 	= $_POST["japones_04"];
	$japones_05 	= $_POST["japones_05"];
	$japones_06 	= $_POST["japones_06"];
	$japones_07 	= $_POST["japones_07"];
	$japones_08 	= $_POST["japones_08"];
	$japones_09 	= $_POST["japones_09"];
	$japones_10 	= $_POST["japones_10"];


	$query = mysqli_query($connection,'INSERT INTO grades (grade_descricao, grade_quantidade_tamanhos, grade_criacao) VALUES ("'.$grade_descricao.'", "'.$grade_quantidade_tamanhos.'", "'.date($now).'")');
	$id_novo = mysqli_insert_id($connection);

	$query = mysqli_query($connection,'INSERT INTO grade_itens (ingles_01, ingles_02, ingles_03, ingles_04, ingles_05, ingles_06, ingles_07, ingles_08, ingles_09, ingles_10, japones_01, japones_02, japones_03, japones_04, japones_05, japones_06, japones_07, japones_08, japones_09, japones_10, grade_itens_criacao, grade_id) VALUES ("'.$ingles_01.'", "'.$ingles_02.'", "'.$ingles_03.'", "'.$ingles_04.'", "'.$ingles_05.'", "'.$ingles_06.'", "'.$ingles_07.'", "'.$ingles_08.'", "'.$ingles_08.'", "'.$ingles_10.'", "'.$japones_01.'", "'.$japones_02.'", "'.$japones_03.'", "'.$japones_04.'", "'.$japones_05.'", "'.$japones_06.'", "'.$japones_07.'", "'.$japones_08.'", "'.$japones_08.'", "'.$japones_10.'", "'.date($now).'", "'.$id_novo.'")');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>
	
	<body>
		<?php
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=40');		   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"Grade não foi cadastrada com Sucesso.\");
				</script>
				";	
				header('Location: ../administrativo.php?link=40');					   
			}
		?>
	</body>
</html>