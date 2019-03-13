<?php
    session_start();
    include_once("../seguranca.php");
    include_once("../conexao.php");

    $id                = $_POST["id"];
    $cliente_nome      = $_POST["cliente_nome"];
    $cliente_telefone  = $_POST["cliente_telefone"];
    $cliente_cellfone  = $_POST["cliente_cellfone"];
    $cep_id            = $_POST["cep_id"];
    $cliente_endereco  = $_POST["cliente_endereco"];
    $cliente_password  = $_POST["cliente_password"];
    $cliente_email     = $_SESSION['clienteEmail'];
    //colocando email para receber promocoes
    if (isset($_POST['checkbox_get_ofers'])){
        $query =mysqli_query($connection,"DELETE FROM lista_emails WHERE id ='$cliente_email'"); 
        $query = mysqli_query($connection,"INSERT INTO lista_emails (id, lista_email_idioma) VALUES ('$cliente_email', '$http_lang')");
    } else {
        $query =mysqli_query($connection,"DELETE FROM lista_emails WHERE id ='$cliente_email'"); 
    }
    
    //verificar se o cep existe
    $query1 =mysqli_query($connection,"SELECT * FROM post_ceps WHERE id = $cep_id"); 
    if (mysqli_num_rows($query1) < 1){	
        $query1 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=36"); 
        while($line = mysqli_fetch_assoc($query1)){
                $msg = $line["mensagem"];
        }
        //retorna para a pagina anterior
        echo    "<script type='text/javascript'>  
                    alert('$msg');
                    history.back()
                </script>";  
        exit;
    }

	if ($cliente_password){
		$options = [
			'cost' => 11,
			'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
		$hash = password_hash($cliente_password, PASSWORD_BCRYPT, $options);
		$query = mysqli_query($connection,'UPDATE clientes set cliente_nome     = "'.$cliente_nome.'", 
                                                               cliente_telefone = "'.$cliente_telefone.'",
                                                               cliente_cellfone = "'.$cliente_cellfone.'",
                                                               cep_id           = "'.$cep_id.'",
                                                               cliente_endereco = "'.$cliente_endereco.'",
                                                               cliente_password = "'.$hash.'",
                                                               cliente_idioma   = "'.$http_lang.'", 
                                                               cliente_modificacao = "'.date($now).'" 
                                                            WHERE id="'.$id.'"');

	} else {
		$query = mysqli_query($connection,'UPDATE clientes set cliente_nome     = "'.$cliente_nome.'", 
                                                               cliente_telefone = "'.$cliente_telefone.'",
                                                               cliente_cellfone = "'.$cliente_cellfone.'",
                                                               cep_id           = "'.$cep_id.'",
                                                               cliente_endereco = "'.$cliente_endereco.'",
                                                               cliente_idioma   = "'.$http_lang.'", 
                                                               cliente_modificacao = "'.date($now).'" 
                                                            WHERE id="'.$id.'"');
    }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>
	<body>
		<?php
            if (!$query){	
                $query1 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=34"); 
                while($line = mysqli_fetch_assoc($query1)){
                        $msg = $line["mensagem"];
                }
                //retorna para a pagina anterior
                echo    "<script type='text/javascript'>  
                            alert('$msg');
                            history.back()
                        </script>";
            }
            else{
                echo '<script> location.replace("../dados_cliente.php"); </script>';
            }
		?>
	</body>
</html>