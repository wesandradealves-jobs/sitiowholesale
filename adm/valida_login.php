<?php
session_start();
$usuariot = $_POST['email'];
$senhat = $_POST['senha'];
include_once("conexao.php");

$query = "SELECT * FROM usuarios WHERE email='$usuariot' LIMIT 1";
$result = mysqli_query($connection,$query) or die (mysql_error());;
$resultado = mysqli_fetch_assoc($result);

$senha = $resultado["senha"];
if (password_verify($senhat, $senha)) {
	//Define os valores atribuidos na sessao do usuario
	$_SESSION['usuarioId'] 			= $resultado['id'];
	$_SESSION['usuarioNome'] 		= $resultado['nome'];
	$_SESSION['usuarioNivelAcesso'] = $resultado['nivel_acesso_id'];
	$_SESSION['usuarioEmail'] 		= $resultado['email'];
	$_SESSION['usuarioSenha'] 		= $resultado['senha'];
	
	//if($_SESSION['usuarioNivelAcesso'] == 1){
		header("Location: administrativo.php");
//	}else{
//		header("Location: usuario.php");
//	}
} else {
	//Mensagem de Erro
	$_SESSION['loginErro'] = "Usuário ou senha Inválido";
	//Manda o usuario para a tela de login
	header("Location: index.php");
}
?>