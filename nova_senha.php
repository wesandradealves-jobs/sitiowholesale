<?php
    session_start();
	include_once("conexao.php");
	
	if (isset($_GET['id'])){
		$id = $_GET['id'];
	} else {
		$id = '0';
	}
	if (isset($_GET['token'])){
		$token = $_GET['token'];
	} else {
		$token = '0';
	}
	
	
	$query1 =mysqli_query($connection,"SELECT * FROM clientes WHERE id = '$id'"); 
    if(mysqli_num_rows($query1) == 1){
        $linhas = mysqli_fetch_assoc($query1);
        $id     = $linhas["id"];
        $pass   = $linhas["cliente_password"];
        $email  = $linhas["cliente_email"];

        $query =mysqli_query($connection,"SELECT * FROM empresa WHERE id=1"); 
        $line = mysqli_fetch_assoc($query); 
		$empresa_host    = $line["empresa_host"];
		$data_hoje = date('Y-m-d', strtotime($now));
        $data_expirar = date('Y-m-d', strtotime('+1 day'));
        $codigo1 = $pass.''.$data_expirar.''.$email;
		$codigo1 = base64_encode($codigo1);
		$codigo2 = $pass.''.$data_hoje.''.$email;
		$codigo2 = base64_encode($codigo1);
		
		if ($token != $codigo1 && $token != $codigo2){
			$id    = '';
			$token = '';
			$query =mysqli_query($connection,'SELECT mensagem_'.$msg_idioma.' as mensagem FROM mensagens WHERE id=128'); 
			$line = mysqli_fetch_assoc($query);
			$_SESSION['loginErro'] = $line['mensagem'];

			echo "	<script> 
						location.replace('recuperar_senha.php'); 
					</script>";
		} else {
			$query =mysqli_query($connection,'SELECT mensagem_'.$msg_idioma.' as mensagem FROM mensagens WHERE id=127'); 
			$line = mysqli_fetch_assoc($query);
			$_SESSION['loginErro'] = $line['mensagem'];
			//efetua o login e envia para a tela com os dados do cliente
			$_SESSION['clienteId'] 			= $linhas['id'];
			$_SESSION['clienteNome'] 		= $linhas['cliente_nome'];
			$_SESSION['clienteEmail'] 		= $linhas['cliente_email'];
			$_SESSION['clienteSenha'] 		= $linhas['cliente_password'];
			$_SESSION['cep'] 				= $linhas['cep_id'];
			$_SESSION['endereco'] 			= $linhas['cliente_endereco'];	
			$_SESSION['nome'] 				= $linhas['cliente_nome'];
			$_SESSION['telefone'] 			= $linhas['cliente_telefone'];
			$_SESSION['celular'] 			= $linhas['cliente_cellfone'];
			echo "	<script> 
						location.replace('dados_cliente.php'); 
					</script>";
		}
    }
?>