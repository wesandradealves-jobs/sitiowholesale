<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 	   			         = $_POST["id"];
$transportadora_ingles	 = $_POST["transportadora_ingles"];
$transportadora_japones = $_POST["transportadora_japones"];

$query = mysqli_query($connection,'UPDATE transportadoras set transportadora_ingles ="'.$transportadora_ingles.'", transportadora_japones="'.$transportadora_japones.'" WHERE id="'.$id.'"');
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
				echo "
				<script type=\"text/javascript\">
				alert(\"transportadora de produto não foi editado com Sucesso.\");
				</script>
				";	
				header('Location: ../administrativo.php?link=58');	   
			}
		?>
	</body>
</html>