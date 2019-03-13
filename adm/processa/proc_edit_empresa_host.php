<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");

$empresa_host	    = $_POST["empresa_host"];
$empresa_facebook   = $_POST["empresa_facebook"];

$query = mysqli_query($connection,"UPDATE empresa set empresa_host      	='".$empresa_host."',
													  empresa_facebook 		='".$empresa_facebook."',
                                                      empresa_modificacao   ='".date($now)."'
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
				header('Location: ../administrativo.php?link=85');		   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"Marca não editada com Sucesso.\");
				</script>
				";		
				header('Location: ../administrativo.php?link=85');   
			}
		?>
	</body>
</html>