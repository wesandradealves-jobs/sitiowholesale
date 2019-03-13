<?php
    session_start();
    include_once("../seguranca.php");
    include_once("../conexao.php");

    include 'PaypalExpress.class.php';
    $paypal = new PaypalExpress;
    // Get payment info from URL
    $paymentID = $_GET['paymentID'];
    $token = $_GET['token'];
    $payerID = $_GET['payerID'];
    $productID = $_GET['pedido'];

    $pedido_id = $productID;
    $pedido_paypal_retorno   = $_GET['retorno'];
    $pedido_paypal_token     = $token;
    $pedido_paypal_payerid   = $payerID;

    if ($pedido_paypal_retorno == 1){ //pagamento efetuado, muda situacao do pedido para 2
        $pedido_situacao_id = 2;
    } else {
        $pedido_situacao_id = 1;
    }
    echo "$pedido_id<br>$pedido_paypal_retorno<br>$pedido_paypal_token<br>$pedido_paypal_payerid<br>$pedido_situacao_id";

    //gravando na tabela pedidos
    $query = mysqli_query($connection,'UPDATE pedidos set pedido_paypal_retorno = "'.$pedido_paypal_retorno.'",
                                                          pedido_paypal_token = "'.$pedido_paypal_token.'",
                                                          pedido_paypal_payerid = "'.$pedido_paypal_payerid.'",
                                                          pedido_situacao_id = "'.$pedido_situacao_id.'" 
                                                          where id = "'.$pedido_id.'"');     
    //Enviar email de pedido aguardando confirmacao de pagamento    
    // if ($pedido_situacao_id == 2){
    //     $id_pedido = $pedido_id;
    //     include "email_pedido.php"; 
    // }  
    //Fim enviar email de pedido aguardando confirmacao de pagamento

    header("Location: ../pedido.php?id=$pedido_id");
?>