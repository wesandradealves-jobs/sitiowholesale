<?php
    session_start();
    include_once("../conexao.php");

    $cliente_email     = $_POST["cliente_email"];
    $cliente_nome      = $_POST["cliente_nome"];
    $cliente_telefone  = $_POST["cliente_telefone"];
    $cliente_cellfone  = $_POST["cliente_cellfone"];
    $cep_id            = $_POST["cep_id"];
    $cliente_endereco  = $_POST["cliente_endereco"];
    $cliente_password  = $_POST["cliente_password"];

    //veio do checkout do carrinho de compra
    $vapara = '';
    if (isset($_POST['vapara'])){
        $vapara =$_POST['vapara'];
    }

    //colocando email para receber promocoes
    if (isset($_POST['checkbox_get_ofers'])){
        $query =mysqli_query($connection,"DELETE FROM lista_emails WHERE id ='$cliente_email'"); 
        $query = mysqli_query($connection,"INSERT INTO lista_emails (id, lista_email_idioma) VALUES ('$cliente_email', '$http_lang')");
    }
    
    //verificar se email ja esta cadastrado e apresentar erro
    $query1 =mysqli_query($connection,'SELECT * FROM clientes WHERE cliente_email = "'.$cliente_email.'"'); 
    if (mysqli_num_rows($query1) > 0){	
        $query1 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=35"); 
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

    //verificar se cep existe e apresentar erro
    $query1 =mysqli_query($connection,'SELECT * FROM post_ceps WHERE id = "'.$cep_id.'"'); 
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

    $options = [
        'cost' => 11,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    ];
    $hash = password_hash($cliente_password, PASSWORD_BCRYPT, $options);
    $query = mysqli_query($connection,'INSERT INTO clientes (cliente_email, cliente_nome, cliente_telefone, cliente_cellfone, cep_id, cliente_endereco,  cliente_password, cliente_idioma, cliente_criacao) VALUES ("'.$cliente_email.'", "'.$cliente_nome.'", "'.$cliente_telefone.'", "'.$cliente_cellfone.'", "'.$cep_id.'", "'.$cliente_endereco.'", "'.$hash.'", "'.$http_lang.'", "'.date($now).'")');
    $id = mysqli_insert_id($connection);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>
	<body>
		<?php
            $query1 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=34"); 
            while($line = mysqli_fetch_assoc($query1)){
                    $msg = $line["mensagem"];
            }
                if (! $query){	
                    //retorna para a pagina anterior
                    echo    "<script type='text/javascript'>  
                                alert('$msg');
                                history.back()
                            </script>";
                }
                else{ 	
                    $_SESSION['clienteId'] 			= $id;
                    $_SESSION['clienteNome'] 		= $cliente_nome;
                    $_SESSION['clienteEmail'] 		= $cliente_email;
                    $_SESSION['clienteSenha'] 		= $cliente_password;
                    $_SESSION['cep'] 		        = $cep_id;
                    $_SESSION['endereco'] 	        = $cliente_endereco;
                    $_SESSION['nome']   	        = $cliente_nome;
                    $_SESSION['telefone'] 	        = $cliente_telefone;
                    $_SESSION['celular'] 	        = $cliente_cellfone;

                    if ($vapara) { // vai para o proxima pagina do checkout apos o login
                        header("Location: ../$vapara");
                    } else {
                        echo '<script> location.replace("../"); </script>';
                    }
                }
		?>
	</body>
</html>