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
    $productID = $_GET['pid'];
    $paymentCheck = $paypal->validate($paymentID, $token, $payerID, $productID);


    $forma_pagamento = $_GET['f'];
    $pedido_periodo_entrega = '';
    if (isset($_GET['pedido_periodo_entrega'])){
        $pedido_periodo_entrega = $_GET['pedido_periodo_entrega'];
    }

    $pedido_situacao_id = 1;
    

    $id_pedido = 0; //variavel utilizada para direcionar o usuario caso ele de um duplo click no pagamento 
    $total = 0;
    //variaveis para frete
    $valor_total_frete = 0;
    $peso_total = 0;
    // fim variaveis para frete

        //evitar problemas com duplo click
        if ($id_pedido>0) {
            $_SESSION['pedido'] = $id_pedido;
        } else if ($_SESSION['pedido'] > 0){
            $id_pedido = $_SESSION['pedido'];
            if ($forma_pagamento==1) { //smartpit
                header("Location: ../pedido.php?id=$id_pedido");
            } else if ($forma_pagamento==2) {//paypal
                // header("Location: paypal.php?pedido=$id_pedido");
                if($paymentCheck && $paymentCheck->state == 'approved'){
                    // Get the transaction data
                    $id = $paymentCheck->id;
                    $state = $paymentCheck->state;
                    $payerFirstName = $paymentCheck->payer->payer_info->first_name;
                    $payerLastName = $paymentCheck->payer->payer_info->last_name;
                    $payerName = $payerFirstName.' '.$payerLastName;
                    $payerEmail = $paymentCheck->payer->payer_info->email;
                    $payerID = $paymentCheck->payer->payer_info->payer_id;
                    $payerCountryCode = $paymentCheck->payer->payer_info->country_code;
                    $paidAmount = $paymentCheck->transactions[0]->amount->details->subtotal;
                    $currency = $paymentCheck->transactions[0]->amount->currency;

                    //Incluindo o arquivo que contém a função sendNvpRequest
                    // include 'sendNvpRequest.php';

                    $pedido_id = $_GET['pid'];
                    $pedido_paypal_retorno   = $_GET['paymentID'];
                    $pedido_paypal_token     = $_GET['token'];
                    $pedido_paypal_payerid   = $_GET['PayerID'];

                    header("Location: paypal_retorno.php?retorno=1&pedido=$id_pedido");
                    // print_r($paymentCheck);
                }                 
            }
            exit;
        }     
        //fim evitar problemas com duplo click    

    if (count($_SESSION['carrinho']) == 0){
        header("Location: ../index.php");
    } else {
        //evitar produtos indisponiveis no pedido
        foreach($_SESSION['carrinho'] as $id => $qtd){
            $query =mysqli_query($connection,"SELECT    a.*, 
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
                                                        FROM    (select * from produto_itens where situacao_id = 1) a,
                                                                produtos b
                                                        WHERE a.produto_id = b.id 
                                                            AND a.id=$id");
            $ln = mysqli_fetch_assoc($query);
            $descricao = $ln['produto_descricao_'.$msg_idioma];
            if (!isset($descricao)){
                header("Location: ../review.php");                
                exit;
            }
        }
        //gravando na tabela pedidos
        $query = mysqli_query($connection,'INSERT INTO pedidos (cliente_id, 
                                                                cep_entrega_id, 
                                                                pedido_endereco_entrega, 
                                                                pedido_cliente_nome,
                                                                pedido_cliente_telefone,
                                                                pedido_cliente_cellfone,
                                                                pedido_forma_pagamento, 
                                                                pedido_situacao_id,  
                                                                pedido_periodo_entrega,  
                                                                pedido_criacao
                                                            ) VALUES (
                                                                "'.$_SESSION['clienteId'].'", 
                                                                "'.$_SESSION['cep'].'", 
                                                                "'.$_SESSION['endereco'].'", 
                                                                "'.$_SESSION['nome'].'", 
                                                                "'.$_SESSION['telefone'].'", 
                                                                "'.$_SESSION['celular'].'", 
                                                                "'.$forma_pagamento.'", 
                                                                "'.$pedido_situacao_id.'", 
                                                                "'.$pedido_periodo_entrega.'", 
                                                                "'.date($now).'")');
        $id_pedido = mysqli_insert_id($connection);

        foreach($_SESSION['carrinho'] as $id => $qtd){
            $tpembalagem='';
            if (isset(explode('.', $id)[1])){ // se o produto for congelado ou resfriada
                $tpembalagem = $id;
                $id = explode('.', $id)[0];
                $tpembalagem = explode('.', $tpembalagem)[1];
                //pega o dado de resfriada ou congelado para colocar na descricao do produto
                if ($tpembalagem == 0){
                    $embalagem ='0';
                    $query2 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=79"); while($line2 = mysqli_fetch_assoc($query2)){ $tpembalagem = $line2["mensagem"]; }
                } else if ($tpembalagem == 1){
                    $embalagem ='1';
                    $query2 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=80"); while($line2 = mysqli_fetch_assoc($query2)){ $tpembalagem = $line2["mensagem"]; }
                }
            }

            $query =mysqli_query($connection,"SELECT    a.*, 
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
                        FROM    (select * from produto_itens where situacao_id = 1) a,
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
            $total     += $sub; 
            $sub       = number_format($sub,0,',',',');
            if ($tpembalagem){
                $id=$id.'.'.$embalagem;
            }

            //gravando na tabela pedido_itens
            $query = mysqli_query($connection,'INSERT INTO pedido_itens (pedido_id, 
                                                                         produto_id, 
                                                                         pedido_item_quantidade, 
                                                                         pedido_item_valor_unitario
                                                                        ) VALUES (
                                                                         "'.$id_pedido.'", 
                                                                         "'.$id.'", 
                                                                         "'.$qtd.'", 
                                                                         "'.$preco.'"
                                                                        )');           

            // Calculo do frete
            $produto_peso          = $ln['produto_peso']*$qtd; // peso vezes a quantidade para saber o peso total do produto
            $produto_caixa_propria = $ln['produto_caixa_propria']; // quando for 1 é caixa propria
            $produto_valor_frete   = str_replace(',','',$ln['produto_valor_frete']); // valor do frete sem virgula
            $tipo_caixa            = $ln['produto_seco'].''.$ln['produto_resfriado'].''.$ln['produto_congelado']; // tipo de caixa a ser utilizado: 100 - 110 - 111 - 010 - 011 - 001
            //regiao da entrega
            $cep = $_SESSION['cep'];
            $query1 =mysqli_query($connection,"SELECT * FROM transp_regiao_provincias WHERE provincia_id=(SELECT provincia_id FROM post_ceps WHERE id='$cep')");
            while($line1 = mysqli_fetch_assoc($query1)){
                $regiao = $line1["regiao_id"]; 
            } 

            // Produto com frete fixo
            if ($produto_valor_frete > 0){
                $valor_total_frete += $produto_valor_frete*$qtd;
            // Produto com caixa propria, sem valor de frete fixo
            } else if ($produto_caixa_propria == 1){ 
                
                $query1 =mysqli_query($connection,"SELECT * FROM transp_valores WHERE regiao_id=$regiao ORDER BY caixa_id");
                $caixa_selecionada = 0; // Registra o produto dentro da caixa com menor tamanho possivel
                while($line1 = mysqli_fetch_assoc($query1)){
                    $peso_caixa = $line1["caixa_id"] * 1000; //converte peso da caixa, de kilos para gramas
                    if ($peso_caixa >= $produto_peso/$qtd && $caixa_selecionada == 0){
                        $valor_total_frete += str_replace(',','',$line1["transp_valor_frete"]) * $qtd;
                        $caixa_selecionada = 1;
                    }
                } 
            
            // outros tipos de frete
            } else {  
                $peso_total += $produto_peso; 
            }
        }

        //verifica a maior caixa cadastrada para frete
        $query2 =mysqli_query($connection,"SELECT MAX(caixa_id) as peso_maior_caixa, MAX(transp_valor_frete) as valor_maior_caixa FROM transp_valores WHERE regiao_id=$regiao"); 
        while($line2 = mysqli_fetch_assoc($query2)){
            $peso_maior_caixa  = $line2["peso_maior_caixa"]*1000;
            $valor_maior_caixa = str_replace(',','',$line2["valor_maior_caixa"]);
        }

        //peso total
        if ($peso_maior_caixa <= ($peso_total)){
            $valor_total_frete += str_replace(',','',(($peso_total-($peso_total%$peso_maior_caixa))/$peso_maior_caixa)*$valor_maior_caixa);
            $peso_total = $peso_total%$peso_maior_caixa;
        }
        $query1 =mysqli_query($connection,"SELECT * FROM transp_valores WHERE regiao_id=$regiao ORDER BY caixa_id");
        $caixa_1_selecionada = 0; // Registra o produto dentro da caixa com menor tamanho possivel
        while($line1 = mysqli_fetch_assoc($query1)){
            $peso_caixa = $line1["caixa_id"] * 1000; //converte peso da caixa de kilos para gramas
            if ($peso_caixa >= $peso_total && $peso_total > 0 && $caixa_1_selecionada == 0){
                $valor_total_frete += str_replace(',','',$line1["transp_valor_frete"]);
                $caixa_1_selecionada = 1; //selecionou uma caixa para o produto
            }
        }
        //fim peso total
        
        //gravando na tabela pedidos
        if (count($_SESSION['carrinho']) > 0){
            $query = mysqli_query($connection,'UPDATE pedidos set   pedido_valor_itens = "'.$total.'",
                                                                    pedido_valor_frete_calculado = "'.$valor_total_frete.'" where id = "'.$id_pedido.'"'); 
        }          

        unset($_SESSION['carrinho']); 

        //evitar problemas com duplo click
        if ($id_pedido>0) {
            $_SESSION['pedido'] = $id_pedido;
        } else {
            $id_pedido = $_SESSION['pedido'];
        }     
        //fim evitar problemas com duplo click      
        
        //Enviar email de pedido aguardando pagamento      
        include "email_pedido.php"; 
        //Fim enviar email de pedido aguardando pagamento 

        if ($forma_pagamento==1) { //smartpit
            header("Location: ../pedido.php?id=$id_pedido");
        } else if ($forma_pagamento==2) {//paypal
            // header("Location: paypal.php?pedido=$id_pedido");
                if($paymentCheck && $paymentCheck->state == 'approved'){
                    // Get the transaction data
                    $id = $paymentCheck->id;
                    $state = $paymentCheck->state;
                    $payerFirstName = $paymentCheck->payer->payer_info->first_name;
                    $payerLastName = $paymentCheck->payer->payer_info->last_name;
                    $payerName = $payerFirstName.' '.$payerLastName;
                    $payerEmail = $paymentCheck->payer->payer_info->email;
                    $payerID = $paymentCheck->payer->payer_info->payer_id;
                    $payerCountryCode = $paymentCheck->payer->payer_info->country_code;
                    $paidAmount = $paymentCheck->transactions[0]->amount->details->subtotal;
                    $currency = $paymentCheck->transactions[0]->amount->currency;

                    //Incluindo o arquivo que contém a função sendNvpRequest
                    // include 'sendNvpRequest.php';

                    $pedido_id = $_GET['pid'];
                    $pedido_paypal_retorno   = $_GET['paymentID'];
                    $pedido_paypal_token     = $_GET['token'];
                    $pedido_paypal_payerid   = $_GET['PayerID'];

                    // print_r($paymentCheck);
                    header("Location: paypal_retorno.php?retorno=1&pedido=$id_pedido");
                }             
        }
    }
?>












