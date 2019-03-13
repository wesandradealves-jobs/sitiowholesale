<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");

$empresa_email_contato	    = $_POST["empresa_email_contato"];
$empresa_email_sistema	    = $_POST["empresa_email_sistema"];

$query = mysqli_query($connection,"UPDATE empresa set empresa_email_contato      ='".$empresa_email_contato."', 
                                                      empresa_email_sistema      ='".$empresa_email_sistema."', 
                                                      empresa_modificacao               ='".date($now)."'
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
				header('Location: ../administrativo.php?link=77');		   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"Marca não editada com Sucesso.\");
				</script>
				";		
				header('Location: ../administrativo.php?link=77');   
			}
		?>
	</body>
</html>