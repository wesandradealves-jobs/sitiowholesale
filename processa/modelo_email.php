<?php
    session_start();
    include_once("../conexao.php");
    if (isset($_SESSION['clienteEmail'])){
        $email = $_SESSION['clienteEmail'];
    } else {
        $email = '';
    }

    $query =mysqli_query($connection,"SELECT * FROM empresa WHERE id=1"); 
    $line = mysqli_fetch_assoc($query); 
    $empresa_host           = $line["empresa_host"];
    $empresa_facebook       = $line["empresa_facebook"];
    $assunto                = $line["empresa_assunto_recuperar_senha_".$msg_idioma];
    $empresa_email_contato  = $line["empresa_email_sistema"];
    $email_remetente        = 'Sitio Wholesale <'.$line["empresa_email_sistema"].'>';
    
    $query =mysqli_query($connection,'SELECT mensagem_'.$msg_idioma.' as mensagem FROM mensagens WHERE id=55'); $line = mysqli_fetch_assoc($query); $local   = $line['mensagem']; 
    $query =mysqli_query($connection,'SELECT mensagem_'.$msg_idioma.' as mensagem FROM mensagens WHERE id=71'); $line = mysqli_fetch_assoc($query); $celular = $line['mensagem']; 
    $query =mysqli_query($connection,'SELECT mensagem_'.$msg_idioma.' as mensagem FROM mensagens WHERE id=56'); $line = mysqli_fetch_assoc($query); $telefone= $line['mensagem']; 
    $texto = "<!DOCTYPE html><html><head><meta charset='UTF-8' /></head><body style='background-color:#DCDCDC;'><table style='width: 100%; max-height: 100%;' border='0' cellspacing='0' cellpadding='0' align='center'><tbody><tr><td align='center' style='padding:0;Margin:0;'><div style='max-width: 1024px; width: 100%; height: 100%; background: #fff; border-style: solid; border-width: 1px; border-color: #C0C0C0;' align='center'><a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'><div style='max-width: 90%; padding:10; padding-top:5; padding-bottom:5;' align='center'><br><img src='https://$empresa_host/images/logo.png'></div></a>

                <div style='max-width: 100%; background: #0b5394;' align='center'>
                    <font color='#fff'>
                        <strong>
                            <h2><br>Status do Pedido<br><br></h2>
                        </strong>
                    </font>
                </div>
                <div style='max-width: 600px; padding:10;' align='center'>
                    <p>Seu pedido esta 'Aguardando Confirmacao de Pagamento'.</p>
                </div>
                <div style='max-width: 90%; padding:10;' align='center'>
                    <img style='max-width:100%; height:auto;' src='https://$empresa_host/images/pedido_situacao_1_$msg_idioma.fw.png'
                </div>
                <div style='max-width: 600px; padding:10;' align='center'>
                    <p>Você tambem pode acompanhar a situação e historico dos seus pedidos<br>clicando no botao abaixo e escolhendo a opcao 'Order Status'.</p>
                </div>
                <div style='max-width: 90%; padding:10;' align='center'>
                    <a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'>
                        <button type='button' style='border-radius:10px; background: #0b5394;'>
                            <font color='#fff'><strong><h2> Meus Pedidos </h2></strong></font>
                        </button>
                    </a>
                </div>
                <div style='max-width: 90%; padding:10;' align='center'>
                    <p>Regards, <a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'>Sitio Wholesale</a></p><br>
                </div>
                <div style='max-width: 90%; padding:10;' align='center'>
                    <img style='max-width:100%; height:auto;' src='https://$empresa_host/images/email_footer.jpg'
                </div>
                <div style='max-width: 90%; padding:10;' align='center'>
                    <p>This is an automated email. There is no need to answer it.</p>
                </div>

            </div></td></tr><tr><td align='center' style='padding:0;Margin:0;'><div style='max-width: 1024px; width: 100%; height: 100%; align='center'><h6><img height='20px' width='auto' src='https://$empresa_host/images/fb_icon.png'><br>$local<br>+81 $celular - +81 $telefone<br><a style='text-decoration:none; color: #000000;' href='mailto:$empresa_email_contato'>$empresa_email_contato</a> - <a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'>$empresa_host</a></h6></div></td></tr></tbody></table></body></html>";
    $mensagem = $texto;

    $headers  = "MIME-Version: 1.1\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $headers .= "From: $email_remetente\n";
    $headers .= "Return-Path: $email_remetente\n"; 
    $headers .= "Reply-To: $email\n"; 
//        $_POST["name"].' <'.$_POST["email"].'>';

//        if(mail("$email", "$assunto", "$mensagem", $headers, "-f$email_remetente")){
        echo $texto;
//        }

?>