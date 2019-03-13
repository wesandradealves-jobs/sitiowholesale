<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 	   			         = $_POST["id"];
$departamento_descricao_ingles	 = $_POST["departamento_descricao_ingles"];
$departamento_descricao_japones = $_POST["departamento_descricao_japones"];

$query = mysqli_query($connection,'UPDATE departamentos set departamento_descricao_ingles ="'.$departamento_descricao_ingles.'", departamento_descricao_japones="'.$departamento_descricao_japones.'", departamento_modificacao = "'.date($now).'" WHERE id="'.$id.'"');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=49');		   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"departamento de produto não foi editado com Sucesso.\");
				</script>
				";	
				header('Location: ../administrativo.php?link=49');	   
			}
		?>
	</body>
</html>