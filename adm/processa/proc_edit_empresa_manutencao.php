<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");

$empresa_manutencao	       = $_POST["empresa_manutencao"];
$empresa_texto_manutencao  = $_POST["empresa_texto_manutencao"];

$query = mysqli_query($connection,"UPDATE empresa set empresa_manutencao       ='".$empresa_manutencao."',
                                                      empresa_texto_manutencao ='".$empresa_texto_manutencao."',
                                                      empresa_modificacao      ='".date($now)."'
                                                      WHERE id=1");

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=88');		   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"Marca não editada com Sucesso.\");
				</script>
				";		
				header('Location: ../administrativo.php?link=88');   
			}
		?>
	</body>
</html>