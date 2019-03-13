<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 				= $_POST["id"];
$nome 				= $_POST["nome"];
$email 				= $_POST["email"];
$usuario 			= $_POST["usuario"];
$senha 				= $_POST["senha"];
$nivel_de_acesso 	= $_POST["nivel_de_acesso"];

if ($id!=1 || $_SESSION['usuarioId'] ==1){
	if ($senha){
		$options = [
			'cost' => 11,
			'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
		$hash = password_hash($senha, PASSWORD_BCRYPT, $options);
		$query = mysqli_query($connection,"UPDATE usuarios set nome ='$nome', email = '$email', login = '$usuario', senha = '$hash', nivel_acesso_id = '$nivel_de_acesso', modified = NOW() WHERE id='$id'");
	} else {
		$query = mysqli_query($connection,"UPDATE usuarios set nome ='$nome', email = '$email', login = '$usuario', nivel_acesso_id = '$nivel_de_acesso', modified = NOW() WHERE id='$id'");
	}
}

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
		if (mysqli_affected_rows() != 0 ){	
			header('Location: ../administrativo.php?link=2');	   
		}
		 else{ 	
				echo "
				<script type=\"text/javascript\">
					alert(\"Usuário não foi editado com Sucesso.\");
				</script>
			";		   
			header('Location: ../administrativo.php?link=2');
		}

		?>
	</body>
</html>