<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");

$empresa_paypal_user_producao	    = $_POST["empresa_paypal_user_producao"];
$empresa_paypal_pswd_producao	    = $_POST["empresa_paypal_pswd_producao"];
$empresa_paypal_signature_producao	= $_POST["empresa_paypal_signature_producao"];
$empresa_paypal_user_sandbox	    = $_POST["empresa_paypal_user_sandbox"];
$empresa_paypal_pswd_sandbox	    = $_POST["empresa_paypal_pswd_sandbox"];
$empresa_paypal_signature_sandbox	= $_POST["empresa_paypal_signature_sandbox"];
$empresa_paypal_tipo	            = $_POST["empresa_paypal_tipo"];
$empresa_paypal_situacao	        = $_POST["empresa_paypal_situacao"];

$query = mysqli_query($connection,"UPDATE empresa set empresa_paypal_user_producao      ='".$empresa_paypal_user_producao."', 
                                                      empresa_paypal_pswd_producao      ='".$empresa_paypal_pswd_producao."', 
                                                      empresa_paypal_signature_producao ='".$empresa_paypal_signature_producao."', 
                                                      empresa_paypal_user_sandbox       ='".$empresa_paypal_user_sandbox."', 
                                                      empresa_paypal_pswd_sandbox       ='".$empresa_paypal_pswd_sandbox."', 
                                                      empresa_paypal_signature_sandbox  ='".$empresa_paypal_signature_sandbox."', 
                                                      empresa_paypal_tipo               ='".$empresa_paypal_tipo."', 
                                                      empresa_paypal_situacao           ='".$empresa_paypal_situacao."', 
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
				header('Location: ../administrativo.php?link=75');		   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"Marca não editada com Sucesso.\");
				</script>
				";		
				header('Location: ../administrativo.php?link=75');   
			}
		?>
	</body>
</html>