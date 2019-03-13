<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$tipo_unitario_descricao_ingles 				= $_POST["tipo_unitario_descricao_ingles"];
$tipo_unitario_descricao_japones 				= $_POST["tipo_unitario_descricao_japones"];
$tipo_unitario_fracao							= ( isset($_POST['tipo_unitario_fracao']) ) ? 1 : 0;

$query = mysqli_query($connection,'INSERT INTO tipo_unitario (tipo_unitario_descricao_ingles, tipo_unitario_descricao_japones, tipo_unitario_fracao, tipo_unitario_criacao) VALUES ("'.$tipo_unitario_descricao_ingles.'", "'.$tipo_unitario_descricao_japones.'", "'.$tipo_unitario_fracao.'", "'.date($now).'")');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>
	
	<body>
		<?php
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=44');	   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"Tipo Unitario não foi cadastrado com Sucesso.\");
				</script>
				";	
				header('Location: ../administrativo.php?link=44');
			}
		?>
	</body>
</html>