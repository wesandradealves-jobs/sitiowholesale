<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");

$query2 =mysqli_query($connection,"SELECT * FROM empresa WHERE id=1"); 
$line2 = mysqli_fetch_assoc($query2);

//Incluindo o arquivo que contém a função sendNvpRequest
include 'sendNvpRequest.php';

  
//Vai usar o Sandbox, ou produção?
// if ($line2["empresa_paypal_tipo"]=='1') {
//     $sandbox = false; //producao
// } else {
//     $sandbox = true; //treino
// }

$sandbox = false;
  
//Baseado no ambiente, sandbox ou produção, definimos as credenciais
//e URLs da API.
if ($sandbox) {
    //credenciais da API para o Sandbox
    // $user = 'shadowcpm_api1.gmail.com';
    // $pswd = 'JVZA49Q3BXMLZAFE';
    // $signature = 'AUT0HHlrYTHIzwf.mOsUkWTRm6VQAM3qfKLvw2pCQWzb29vEgBZIsLqd';
    $user = 'sitiowholesalejapan_api1.gmail.com';
    $pswd = 'P7XDLSJMRKMJ7YNW';
    $signature = 'AX1jZmBfGCrOKA4XU7VLY-2dy4hUAD95xdE97e.fmZsQ90XkWlrJwPA3';
    //URL da PayPal para redirecionamento, não deve ser modificada
    $paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
} else {
    //credenciais da API para produção
    $user = 'sitiowholesalejapan_api1.gmail.com';
    $pswd = 'PQZUEZKQB67EH355';
    $signature = 'ALvW1LfJ5RaibyQPxHIpppfeMDgoAbTpjwo81JL90CC9GzR2v6ry18eQ';

    //URL da PayPal para redirecionamento, não deve ser modificada
    $paypalURL = 'https://www.paypal.com/cgi-bin/webscr';
}
  
//Campos da requisição da operação SetExpressCheckout, como ilustrado acima.
$pedido_id = $_GET['pedido'];
$contador = 0;
$total = 0;

$query =mysqli_query($connection,"SELECT 	a.*, 
                                            a.situacao_id as situacao, 
                                            b.*,
                                            c.*,
                                            (select cor_descricao_$msg_idioma from cor where id = cor_id) as cor_descricao,
                                            (select case 
                                                        when a.tamanho_id = 1 then ".$msg_idioma."_01
                                                        when a.tamanho_id = 2 then ".$msg_idioma."_02
                                                        when a.tamanho_id = 3 then ".$msg_idioma."_03
                                                        when a.tamanho_id = 4 then ".$msg_idioma."_04
                                                        when a.tamanho_id = 5 then ".$msg_idioma."_05
                                                        when a.tamanho_id = 6 then ".$msg_idioma."_06
                                                        when a.tamanho_id = 7 then ".$msg_idioma."_07
                                                        when a.tamanho_id = 8 then ".$msg_idioma."_08
                                                        when a.tamanho_id = 9 then ".$msg_idioma."_09
                                                        when a.tamanho_id = 10 then ".$msg_idioma."_10
                                                    end as tamanhos
                                            from grade_itens where grade_id=a.grade_id and grade_id > 1) as tamanho
                                            FROM 	(select * from produto_itens) a,
                                            produtos b,
                                            pedido_itens c
                                            WHERE a.produto_id = b.id 
                                            AND a.id = c.produto_id
                                            AND c.pedido_id = $pedido_id");

    while($ln = mysqli_fetch_assoc($query)){
                                            
        $descricao = $ln['produto_descricao_'.$msg_idioma];
        $cor       = $ln['cor_descricao'];
        $tamanho   = $ln['tamanho']; 
        $preco     = $ln['pedido_item_valor_unitario'];
        $qtd       = $ln['pedido_item_quantidade']; 
        $sub       = 0;

        $sub       = $preco * $qtd;
        $total     = $total + $sub; 

        //monta os itens para o paypal
        $item = array(
            'L_PAYMENTREQUEST_0_NAME'.$contador => $ln['produto_codigo_cliente']." $descricao",
            'L_PAYMENTREQUEST_0_DESC'.$contador => "$descricao $cor $tamanho",
            'L_PAYMENTREQUEST_0_AMT'.$contador  => $preco,
            'L_PAYMENTREQUEST_0_QTY'.$contador  => $qtd
        );
        if (!isset($itens)) {
            $itens = $item;
        } else {
            $addItem = $itens;
            $itens = $addItem + $item;
        }
        $contador += 1;
    }
/* if (count($_SESSION['carrinho']) > 0){
    foreach($_SESSION['carrinho'] as $id => $qtd){
        $tpembalagem='';
        if (isset(explode('.', $id)[1])){ // se o produto for congelado ou resfriado
            $tpembalagem = $id;
            $id = explode('.', $id)[0];
            $tpembalagem = explode('.', $tpembalagem)[1];
            //pega o dado de resfriado ou congelado para colocar na descricao do produto
            if ($tpembalagem == 0){
                $embalagem ='0';
                $query2 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=79"); while($line2 = mysqli_fetch_assoc($query2)){ $tpembalagem = $line2["mensagem"]; }
            } else if ($tpembalagem == 1){
                $embalagem ='1';
                $query2 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=80"); while($line2 = mysqli_fetch_assoc($query2)){ $tpembalagem = $line2["mensagem"]; }
            }
        }

        $query =mysqli_query($connection,"SELECT 	a.*, 
                            a.situacao_id as situacao, 
                            b.*,
                            (select cor_descricao_$msg_idioma from cor where id = cor_id) as cor_descricao,
                            (select case 
                                        when a.tamanho_id = 1 then ".$msg_idioma."_01
                                        when a.tamanho_id = 2 then ".$msg_idioma."_02
                                        when a.tamanho_id = 3 then ".$msg_idioma."_03
                                        when a.tamanho_id = 4 then ".$msg_idioma."_04
                                        when a.tamanho_id = 5 then ".$msg_idioma."_05
                                        when a.tamanho_id = 6 then ".$msg_idioma."_06
                                        when a.tamanho_id = 7 then ".$msg_idioma."_07
                                        when a.tamanho_id = 8 then ".$msg_idioma."_08
                                        when a.tamanho_id = 9 then ".$msg_idioma."_09
                                        when a.tamanho_id = 10 then ".$msg_idioma."_10
                                    end as tamanhos
                            from grade_itens where grade_id=a.grade_id and grade_id > 1) as tamanho
                    FROM 	(select * from produto_itens) a,
                            produtos b
                    WHERE a.produto_id = b.id 
                      AND a.id=$id");
        $ln = mysqli_fetch_assoc($query);
        $descricao = $ln['produto_descricao_'.$msg_idioma];
        $cor       = $ln['cor_descricao'];
        $tamanho   = $ln['tamanho'];
        $preco     = 0;
        $sub       = 0;
        if ($ln['produto_item_preco_venda'] > 0){ //pega o preço da tabela produto_itens
            $preco = str_replace('.','',$ln['produto_item_preco_venda']);
            $preco = str_replace(',','',$preco);
        } else { // se nao tiver no produto itens, pega o preço da tabela produtos
            $preco = str_replace('.','',$ln['produto_preco_venda']);
            $preco = str_replace(',','',$preco);
        }
        $sub       = $preco * $qtd;
        $total     = $total + $sub; 
        $sub       = number_format($sub,0,',',',');
        $preco     = number_format($preco,0,',',',');
        if ($tpembalagem){
            $id=$id.'.'.$embalagem;
        }
        //monta os itens para o paypal
        $item = array(
            'L_PAYMENTREQUEST_0_NAME'.$contador => $ln['produto_codigo_cliente']." $descricao",
            'L_PAYMENTREQUEST_0_DESC'.$contador => "$descricao $cor $tamanho $tpembalagem",
            'L_PAYMENTREQUEST_0_AMT'.$contador  => $preco,
            'L_PAYMENTREQUEST_0_QTY'.$contador  => $qtd
        );
        if (!isset($itens)) {
            $itens = $item;
        } else {
            $addItem = $itens;
            $itens = $addItem + $item;
        }
        $contador = $contador + 1;
    }
}
*/


$query =mysqli_query($connection,"SELECT * FROM pedidos WHERE id = $pedido_id");
$ln = mysqli_fetch_assoc($query);
$valor_frete = $ln['pedido_valor_frete_calculado'];

$valores_paypal = array(
    'USER' => $user,
    'PWD' => $pswd,
    'SIGNATURE' => $signature,
    'TOKEN' => $responseNvp['TOKEN'],
    'VERSION' => '108.0',
    'METHOD'=> 'SetExpressCheckout',
  
    'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE', //acao SALE
    'PAYMENTREQUEST_0_CURRENCYCODE' => 'JPY', // moeda japao JPY
    'PAYMENTREQUEST_0_SHIPPINGAMT'=> $valor_frete, // valor do frete
    'PAYMENTREQUEST_0_ITEMAMT' => $total, // valor dos itens
    'PAYMENTREQUEST_0_AMT' => $total + $valor_frete, // valor dos itens + valor do frete

    'RETURNURL' => "https://sitiowholesale.co/processa/paypal_retorno.php?retorno=1&pedido=$pedido_id",
    'CANCELURL' => "https://sitiowholesale.co/processa/paypal_retorno.php?retorno=2&pedido=$pedido_id",
    'BUTTONSOURCE' => 'BR_EC_EMPRESA'
);

$requestNvp = $valores_paypal + $itens;

unset($_SESSION['pedido']);

//Envia a requisição e obtém a resposta da PayPal
$responseNvp = sendNvpRequest($requestNvp, $sandbox);
//Se a operação tiver sido bem sucedida, redirecionamos o cliente para o
//ambiente de pagamento.

if (isset($responseNvp['ACK']) && $responseNvp['ACK'] == 'Success') {
    $query = array(
        'cmd'    => '_express-checkout',
        'token'  => $responseNvp['TOKEN']
    );
  
    $redirectURL = sprintf('%s?%s', $paypalURL, http_build_query($query));
  
    header('Location: ' . $redirectURL);
} else {
	//Mensagem de Erro
	$query =mysqli_query($connection,'SELECT mensagem_'.$msg_idioma.' as mensagem FROM mensagens WHERE id=133'); 
	$line = mysqli_fetch_assoc($query);
    $_SESSION['loginErro'] = $line['mensagem'];
    
    //envia email para administracao
    $query =mysqli_query($connection,"SELECT * FROM empresa WHERE id=1"); 
    $line = mysqli_fetch_assoc($query); 
    $assunto         = 'ERRO PAYPAL';
    $email_remetente = 'Sitio Wholesale <'.$line["empresa_email_sistema"].'>';
    $email = 'adm@appudata.com';
    $mensagem = "Ocorreu um erro no paypal para o pedido $pedido_id, verifique o log do servidor";

    $headers  = "MIME-Version: 1.1\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $headers .= "From: $email_remetente\n";
    $headers .= "Return-Path: $email_remetente\n"; 
    $headers .= "Reply-To: $email\n"; 
    $_POST["name"].' <'.$_POST["email"].'>';

    if(mail("$email", "$assunto", "$mensagem", $headers, "-f$email_remetente")){
        echo 'ok!';
    }

	//Manda o cliente para a tela do pedido
    header("Location: ../pedido.php?id=$pedido_id");
}
?>