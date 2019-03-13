<?php
    session_start();
    include_once("../conexao.php");

    $email = $_POST['cliente_email'];
 
    $query1 =mysqli_query($connection,"SELECT * FROM clientes WHERE cliente_email = '$email'"); 
    if(mysqli_num_rows($query1) == 1){
        $linhas = mysqli_fetch_assoc($query1);
        $id     = $linhas["id"];
        $pass   = $linhas["cliente_password"];

        $query =mysqli_query($connection,"SELECT * FROM empresa WHERE id=1"); 
        $line = mysqli_fetch_assoc($query); 
        $empresa_host    = $line["empresa_host"];
        $empresa_facebook= $line["empresa_facebook"];
        $texto           = "  <!DOCTYPE html><html><head><meta charset='UTF-8' /></head><body style='background-color:#DCDCDC;'><table style='width: 100%; max-height: 100%;' border='0' cellspacing='0' cellpadding='0' align='center'><tbody><tr><td align='center' style='padding:0;Margin:0;'><div style='max-width: 1024px; width: 100%; height: 100%; background: #fff; border-style: solid; border-width: 1px; border-color: #C0C0C0;' align='center'><a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'><div style='max-width: 90%; padding:10; padding-top:5; padding-bottom:5;' align='center'><br><img src='https://$empresa_host/images/logo.png'></div></a>";
        $texto           = $texto.' '.$line["empresa_texto_recuperar_senha_".$msg_idioma];
        $assunto         = $line["empresa_assunto_recuperar_senha_".$msg_idioma];
        $empresa_email_contato = $line["empresa_email_sistema"];
        $email_remetente = 'Sitio Wholesale <'.$line["empresa_email_sistema"].'>';
    
        $data_expirar = date('Y-m-d', strtotime('+1 day'));
        $codigo = $pass.''.$data_expirar.''.$email;
        $codigo = base64_encode($codigo);
        $query =mysqli_query($connection,'SELECT mensagem_'.$msg_idioma.' as mensagem FROM mensagens WHERE id=55'); $line = mysqli_fetch_assoc($query); $local   = $line['mensagem']; 
        $query =mysqli_query($connection,'SELECT mensagem_'.$msg_idioma.' as mensagem FROM mensagens WHERE id=71'); $line = mysqli_fetch_assoc($query); $celular = $line['mensagem']; 
        $query =mysqli_query($connection,'SELECT mensagem_'.$msg_idioma.' as mensagem FROM mensagens WHERE id=56'); $line = mysqli_fetch_assoc($query); $telefone= $line['mensagem']; 
        $link= '';

        $texto = $texto."</div></td></tr><tr><td align='center' style='padding:0;Margin:0;'><div style='max-width: 1024px; width: 100%; height: 100%; align='center'><h6><img height='20px' width='auto' src='https://$empresa_host/images/fb_icon.png'><br>$local<br>+81 $celular - +81 $telefone<br><a style='text-decoration:none; color: #000000;' href='mailto:$empresa_email_contato'>$empresa_email_contato</a> - <a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'>$empresa_host</a></h6></div></td></tr></tbody></table></body></html>";

        $texto  = str_replace('$link', "$empresa_host/nova_senha.php?id=$id&token=$codigo", $texto);
        $texto  = str_replace('$local', $local, $texto);
        $texto  = str_replace('$celular', $celular, $texto);
        $texto  = str_replace('$telefone', $telefone, $texto);
        $texto  = str_replace('$empresa_facebook', $empresa_facebook, $texto);
        $texto  = str_replace('$empresa_email_contato', $empresa_email_contato, $texto);
        $texto  = str_replace('$empresa_host', $empresa_host, $texto);
        $mensagem = nl2br("$texto");

        $headers  = "MIME-Version: 1.1\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        $headers .= "From: $email_remetente\n";
        $headers .= "Return-Path: $email_remetente\n"; 
        $headers .= "Reply-To: $email\n"; 
        $_POST["name"].' <'.$_POST["email"].'>';

        if(mail("$email", "$assunto", "$mensagem", $headers, "-f$email_remetente")){
            echo 'ok!';
        }
    }
    echo '<script> location.replace("../login.php"); </script>';
?>