<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$nome 				= $_POST["nome"];
$email 				= $_POST["email"];
$usuario 			= $_POST["usuario"];
$senha 				= $_POST["senha"];
$nivel_de_acesso 	= $_POST["nivel_de_acesso"];


$options = [
    'cost' => 11,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];
$hash = password_hash($senha, PASSWORD_BCRYPT, $options);

$query = mysqli_query($connection,"INSERT INTO usuarios (nome, email, login, senha, nivel_acesso_id, created) VALUES ('$nome', '$email', '$usuario', '$hash', '$nivel_de_acesso', NOW())");
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
					alert(\"Usuário não foi cadastrado com Sucesso.\");
				</script>
			";		   
			header('Location: ../administrativo.php?link=2');
		}
		?>
	</body>
</html>