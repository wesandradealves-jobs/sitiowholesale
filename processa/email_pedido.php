<?php
     $query =mysqli_query($connection,"SELECT * FROM clientes WHERE id=(SELECT cliente_id FROM pedidos where id = $id_pedido)"); 
    $line  = mysqli_fetch_assoc($query); 
    $email      = $line['cliente_email'];
    if ($line['cliente_idioma'] == 'ja'){
        $idioma = 'japones'; 
    } else {
        $idioma = 'ingles'; 
    }

   // se precisar informar o smartpit
    // variavel carregada no adm/processa/proc_edit_pedido.php
    $instrucao_smartpit = '';
    if (isset($informar_smartpit)){ 
        if ($informar_smartpit != 0){
            if ($idioma == 'ingles'){
                $instrucao_smartpit = " <div style='width: 90%; max-width: 600px; padding:10;' align='justify'>
                                            SmartPit code for payment: $informar_smartpit<br><br><br>
                                            Lawson / Ministop<br>
                                            <br>
                                            At Lawson or Mini Stop, please use the multimedia terminal 'Loppi'.<br>
                                            <br>
                                            1 - Select '各種サービスメニュー' from the Loppi screen.<br>
                                            2 - Select '各種代金・インターネット受付・スマートピット（Smart Pit）／クレジット等のお支払い／Amazon等受取り'.<br>
                                            3 - Select「スマートピットお支払い（Smart Pit）」.<br>
                                            4 - Enter your 'Smart pit number (13 digits)'.<br>
                                            5 - After entering 'Smart pit number (13 digits)', press the [ ▶︎ 次 へ ] 'next' button to proceed.<br>
                                            6 - Your bills are shown in the screen. Touch the item(s) to select your bill(s) to pay.<br>
                                            7 - Item is checked and selected. Press the [◯確定する] 'Confirm' button in the bottom right corner to proceed to the next screen.<br>
                                            8 - Check details of your bill before printing, and press the [◯確定する] 'Confirm' button to print your bill.<br>
                                            9 - Your bill is printed. Please take the printed bill to the cashier and make a payment ※ Printed bill expires in 30minutes. In the case it expires, please start over again from step1<br>
                                            <br>
                                            <br>
                                            Family Mart<br>
                                            <br>
                                            At Family Mart, please use the multimedia terminal 'Fami Port'.<br>
                                            <br>
                                            1 - Please select 'smart pit payment' from the Fami port screen.<br>
                                            * You can change the display language from the 'LANGUAGE' button on the top right. The languages supported by Smart Pit service are 6 languages including Japanese, Chinese, English, Korean, Portuguese, Russian. ※ This site will be a description of the Japanese screen.<br>
                                            2 - Please enter 'smart pit number (13 digits)' and press 'OK' button<br>
                                            3 - Your bills are shown in the screen. Touch the item(s) to select your bill(s) to pay. Press OK to continue. <br>
                                            4 - Please check the selected item(s) again and press 'OK' button to print your bill.<br>
                                            5 - Your bill is printed. Please take the printed bill to the cashier and make a payment ※ Printed bill expires in 30minutes. In the case it expires, please start over again from step1<br>
                                            <br>
                                            <br>
                                            Circle K / Master<br>
                                            <br>
                                            For the convenience stores above, please directly take the smart pit card to cashiers.<br>
                                            <br>
                                            1 - Present a smart pit card (sheet) at the cash register, and tell the store clerk 'smart pit payment'.<br>
                                            2 - Your smart-pit number is backside. Your due amount will be displayed in the cash register screen.<br>
                                            3 - Please complete the payment.
                                        </div>";
            } else if ($idioma == 'japones'){
                $instrucao_smartpit = " <div style='max-width: 90%; padding:10;' align='justify'>
                                            支払いのためのスマートピットコード: $informar_smartpit<br><br><br>
                                            ローソン/ミニストップ<br>
                                            <br>
                                            ローソンやミニストップで、マルチメディア端末「ロッピー」をご利用ください。<br>
                                            <br>
                                            1 - ロッピー画面から「サービスメニュー各種」を選択します。<br>
                                            2 - 選択して「各種代金・インターネット受付・スマートピット（スマートピット） /クレジット等のお支払い/アマゾン等受取り」。<br>
                                            3 - スマートピットお支払い（スマートピット）」を選択します。<br>
                                            4 - あなたの「スマートピット番号（13桁）」を入力します。<br>
                                            5 - 「スマートピット番号（13桁）」を入力した後、[▶︎次へ]続行する「次へ」ボタンを押してください。<br>
                                            6 - あなたの法案は、画面に表示されています。支払うためにあなたの法案（複数可）を選択した項目（複数可）をタッチします。<br>
                                            7 - 項目がチェックされ、選択されています。押して、右下の隅にある[◯確定する]「確認」ボタンを押して次の画面に進みます。<br>
                                            8 - 印刷する前に、法案の内容を確認し、あなたの請求書を印刷するには、[◯確定する]「確認」ボタンを押してください。<br>
                                            9 - あなたの法案が印刷されます。レジに印刷された法案を取り、支払い※プリント代は30分で期限が切れるしてください。有効期限が切れる場合は、STEP1からやり直すください。<br>
                                            <br>
                                            <br>
                                            ファミリーマート<br>
                                            <br>
                                            ファミリーマートでは、マルチメディアの端末「ファミポート」をご利用ください。<br>
                                            <br>
                                            1 - ファミポート画面から「スマートピット支払い」を選択してください。<br>
                                            *あなたは、右上の「LANGUAGE」ボタンから表示言語を変更することができます。スマートピットサービスによってサポートされている言語は、日本語、中国語、英語、韓国語、ポルトガル語、ロシア語を含む6つの言語です。 ※このサイトは、日本、画面の説明になります。<br>
                                            2 - 「スマートピット番号（13桁）」を押して「OK」ボタンを入力してください。<br>
                                            3 - あなたの法案は、画面に表示されています。支払うためにあなたの法案（複数可）を選択した項目（複数可）をタッチします。OKを押して続行します。 <br>
                                            4 - あなたの請求書を印刷するには、再び選択した項目（複数可）を押して「OK」ボタンをご確認ください。<br>
                                            5 - あなたの法案が印刷されます。レジに印刷された法案を取ると、入金してください ※プリント代は30分で満了します。有効期限が切れる場合は、STEP1からやり直すください。<br>
                                            <br>
                                            <br>
                                            サークルK /サンクス<br>
                                            <br>
                                            上記のコンビニエンスストアの場合は、直接レジにスマートピットカードをご利用ください。<br>
                                            <br>
                                            1 - レジでスマートピットカード（シート）を提示し、店員「スマートピット支払い」を伝えます。<br>
                                            2 - あなたのスマートピット番号が裏面です。あなたのため、量はレジの画面に表示されます。<br>
                                            3 - 支払いを完了してください。
                                        </div>";
            }
        }
    }

    //montar dados do pedido
    $query =mysqli_query($connection,"SELECT *, (SELECT pedido_situacao_descricao_".$idioma." FROM pedido_situacao WHERE id = pedido_situacao_id) as situacao FROM pedidos WHERE id = $id_pedido");
    $ln = mysqli_fetch_assoc($query);
    $pedido_id 						= $ln['id'];
    $cliente_id						= $ln['cliente_id'];
    $cep_entrega_id 				= $ln['cep_entrega_id'];
    $pedido_endereco_entrega 		= $ln['pedido_endereco_entrega'];
    $pedido_cliente_nome 			= $ln['pedido_cliente_nome'];
    $pedido_cliente_telefone 		= $ln['pedido_cliente_telefone'];
    $pedido_cliente_cellfone 		= $ln['pedido_cliente_cellfone'];
    $pedido_valor_itens 			= $ln['pedido_valor_itens'];
    $pedido_valor_frete_calculado 	= $ln['pedido_valor_frete_calculado'];
    $pedido_forma_pagamento 		= $ln['pedido_forma_pagamento'];
    $pedido_codigo_smartpit 		= $ln['pedido_codigo_smartpit'];
    $pedido_paypal_retorno 			= $ln['pedido_paypal_retorno'];
    $situacao			 			= $ln['situacao'];
    $pedido_situacao_id		 		= $ln['pedido_situacao_id'];
    $pedido_criacao 				= $ln['pedido_criacao'];



    $texto_pedido = "";
    $texto_pedido = $texto_pedido."<div style='width: 95%; max-width: 600px;' align='center'>";
    $query =mysqli_query($connection,"SELECT mensagem_".$idioma." as mensagem FROM mensagens WHERE id=115"); $line = mysqli_fetch_assoc($query); $mensagem= $line["mensagem"];
    $texto_pedido = $texto_pedido."<p style='text-align:left; max-width: 95%;'>$mensagem : $pedido_id<br>";
    $query =mysqli_query($connection,"SELECT mensagem_".$idioma." as mensagem FROM mensagens WHERE id=117"); $line = mysqli_fetch_assoc($query); $mensagem= $line["mensagem"];
    $texto_pedido = $texto_pedido."$mensagem : $situacao<br>";
    $query =mysqli_query($connection,"SELECT mensagem_".$idioma." as mensagem FROM mensagens WHERE id=116"); $line = mysqli_fetch_assoc($query); $mensagem= $line["mensagem"];
    $texto_pedido = $texto_pedido."$mensagem : $pedido_criacao<br>";
    $query =mysqli_query($connection,"SELECT mensagem_".$idioma." as mensagem FROM mensagens WHERE id=118"); $line = mysqli_fetch_assoc($query); $mensagem= $line["mensagem"]; 
    if ($pedido_forma_pagamento==1){
        $query =mysqli_query($connection,"SELECT mensagem_".$idioma." as mensagem FROM mensagens WHERE id=123"); $line = mysqli_fetch_assoc($query); $mensagem1= $line["mensagem"]; 
    } else if ($pedido_forma_pagamento==2){
        $mensagem1= "PayPal";
    } 
    $texto_pedido = $texto_pedido."$mensagem : $mensagem1</p>";
    $texto_pedido = $texto_pedido. "<table style='width: 95%; border-bottom: 1px solid #000;' border='0' cellspacing='0' cellpadding='0'><thead><tr>";
    $query =mysqli_query($connection,"SELECT mensagem_".$idioma." as mensagem FROM mensagens WHERE id=95"); $line = mysqli_fetch_assoc($query); $mensagem = $line["mensagem"];
    $texto_pedido = $texto_pedido. "<th style='text-align:left'>$mensagem</th>";
    $query =mysqli_query($connection,"SELECT mensagem_".$idioma." as mensagem FROM mensagens WHERE id=96"); $line = mysqli_fetch_assoc($query); $mensagem = $line["mensagem"];
    $texto_pedido = $texto_pedido. "<th style='text-align:right'>&nbsp;$mensagem</th>	";
    $query =mysqli_query($connection,"SELECT mensagem_".$idioma." as mensagem FROM mensagens WHERE id=97"); $line = mysqli_fetch_assoc($query); $mensagem = $line["mensagem"];
    $texto_pedido = $texto_pedido. "<th style='text-align:right'>&nbsp;$mensagem</th>	";
    $query =mysqli_query($connection,"SELECT mensagem_".$idioma." as mensagem FROM mensagens WHERE id=98"); $line = mysqli_fetch_assoc($query); $mensagem = $line["mensagem"];
    $texto_pedido = $texto_pedido. "<th style='text-align:right'>&nbsp;$mensagem</th>	";
    $texto_pedido = $texto_pedido. "</tr></thead><tbody>";
    
    
    $query =mysqli_query($connection,"SELECT 	a.*, 
                                                a.situacao_id as situacao, 
                                                a.produto_id as produto, 
                                                b.*,
                                                c.*,
                                                (select cor_descricao_$idioma from cor where id = cor_id) as cor_descricao,
                                                (select case 
                                                            when a.tamanho_id = 1 then ".$idioma."_01
                                                            when a.tamanho_id = 2 then ".$idioma."_02
                                                            when a.tamanho_id = 3 then ".$idioma."_03
                                                            when a.tamanho_id = 4 then ".$idioma."_04
                                                            when a.tamanho_id = 5 then ".$idioma."_05
                                                            when a.tamanho_id = 6 then ".$idioma."_06
                                                            when a.tamanho_id = 7 then ".$idioma."_07
                                                            when a.tamanho_id = 8 then ".$idioma."_08
                                                            when a.tamanho_id = 9 then ".$idioma."_09
                                                            when a.tamanho_id = 10 then ".$idioma."_10
                                                        end as tamanhos
                                                from grade_itens where grade_id=a.grade_id and grade_id > 1) as tamanho
                                                FROM 	(select * from produto_itens) a,
                                                produtos b,
                                                pedido_itens c
                                                WHERE a.produto_id = b.id 
                                                AND a.id = c.produto_id
                                                AND c.pedido_id = $pedido_id");

    while($ln = mysqli_fetch_assoc($query)){
        $descricao = $ln['produto_descricao_'.$idioma];
        $cor       = $ln['cor_descricao'];
        $tamanho   = $ln['tamanho']; 
        $preco     = $ln['pedido_item_valor_unitario'];
        $qtd       = $ln['pedido_item_quantidade']; 
        $sub       = 0;
        $sub       = $preco * $qtd;
        $sub       = number_format($sub,0,',',',');
        $preco     = number_format($preco,0,',',',');

        $texto_pedido = $texto_pedido. "<tr style='border-top: 1px dashed #000;'>";
        $texto_pedido = $texto_pedido. "<td>$descricao $cor $tamanho</td>";
        $texto_pedido = $texto_pedido. "<td align='right'>$preco 円</td>";
        $texto_pedido = $texto_pedido. "<td align='right'>$qtd</td>";
        $texto_pedido = $texto_pedido. "<td align='right'>$sub 円</td>";
        $texto_pedido = $texto_pedido. "</tr>";
    }

    $query = mysqli_query($connection,"SELECT a.*, b.post_provincia_".$idioma." as provincia, c.post_cidade_".$idioma." as cidade FROM post_ceps a, post_provincias b, post_cidades c WHERE a.id=$cep_entrega_id AND b.id=a.provincia_id AND c.id=a.cidade_id");
    $line = mysqli_fetch_assoc($query); 
    $cidade = $line["cidade"];
    $provincia = $line["provincia"];

    $texto_pedido = $texto_pedido. "<tr><td>";
    $query =mysqli_query($connection,"SELECT mensagem_".$idioma." as mensagem FROM mensagens WHERE id=101"); $line = mysqli_fetch_assoc($query); $mensagem = $line["mensagem"];
    $texto_pedido = $texto_pedido. "<h2 align='left'>$mensagem</h2>";
    $texto_pedido = $texto_pedido. "<p style='text-align:left; margin: 0;'>NOME: $pedido_cliente_nome</p>";
    $texto_pedido = $texto_pedido. "<p style='text-align:left; margin: 0;'>TELEFONE: $pedido_cliente_telefone</p>";
    $texto_pedido = $texto_pedido. "<p style='text-align:left; margin: 0;'>CELULAR: $pedido_cliente_cellfone</p><br>";
    $texto_pedido = $texto_pedido. "<p style='text-align:left; margin: 0;'>〒 $cep_entrega_id<br>";
    $texto_pedido = $texto_pedido. "$cidade $provincia<br>";
    $texto_pedido = $texto_pedido. "$pedido_endereco_entrega<br><br>";
    $texto_pedido = $texto_pedido. "<tr/></td> ";
    $valor_total_frete = number_format($pedido_valor_frete_calculado,0,',',',');
    $total =  number_format($pedido_valor_itens,0,',',',');
    $query =mysqli_query($connection,"SELECT mensagem_".$idioma." as mensagem FROM mensagens WHERE id=106"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
    $texto_pedido = $texto_pedido.  "<tr style='border-top: 1px dashed #000;'><td><strong>$msgTotal</strong></td><td> </td><td> </td><td style='text-align:right;'><strong>$total 円</strong></td><tr/>";
    $query =mysqli_query($connection,"SELECT mensagem_".$idioma." as mensagem FROM mensagens WHERE id=107"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
    $texto_pedido = $texto_pedido.  "<tr><td><strong>$msgTotal</strong></td><td> </td><td> </td><td style='text-align:right;'><strong>$valor_total_frete 円</strong></td><tr/>";
    $total = str_replace(',','',$total) + str_replace(',','',$valor_total_frete);
    $total = number_format($total,0,',',',');
    $query =mysqli_query($connection,"SELECT mensagem_".$idioma." as mensagem FROM mensagens WHERE id=99"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
    $texto_pedido = $texto_pedido.  "<tr><td><strong>$msgTotal</strong></td><td> </td><td> </td><td style='text-align:right;'><strong>$total 円</strong><br></td><tr/>";
    $texto_pedido = $texto_pedido."</tbody></table></div>";
    //fim dados pedidos

    $query =mysqli_query($connection,"SELECT * FROM empresa WHERE id=1"); 
    $line = mysqli_fetch_assoc($query); 
    $empresa_host           = $line["empresa_host"];
    $empresa_facebook       = $line["empresa_facebook"];
    $empresa_email_contato  = $line["empresa_email_sistema"];
    $email_remetente        = 'Sitio Wholesale <'.$line["empresa_email_sistema"].'>';

    $query =mysqli_query($connection,'SELECT mensagem_'.$idioma.' as mensagem FROM mensagens WHERE id=55'); $line = mysqli_fetch_assoc($query); $local      = $line['mensagem']; 
    $query =mysqli_query($connection,'SELECT mensagem_'.$idioma.' as mensagem FROM mensagens WHERE id=71'); $line = mysqli_fetch_assoc($query); $celular    = $line['mensagem']; 
    $query =mysqli_query($connection,'SELECT mensagem_'.$idioma.' as mensagem FROM mensagens WHERE id=56'); $line = mysqli_fetch_assoc($query); $telefone   = $line['mensagem']; 
    $query =mysqli_query($connection,'SELECT mensagem_'.$idioma.' as mensagem FROM mensagens WHERE id=114'); $line = mysqli_fetch_assoc($query);$my_order   = $line['mensagem']; 

    $texto_smartpit = "";
    $imagem_situacao_pedido = "";
    if ($pedido_situacao_id==1) { //aguardando pagamento
        $assunto                = "$my_order $pedido_id - $situacao";
        $imagem_situacao_pedido = " <br>
                                    <div style='max-width: 90%; padding:10;' align='center'>
                                        <a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'>
                                            <img style='max-width:100%; height:auto;' src='https://$empresa_host/images/pedido_situacao_1_$idioma.fw.png'>
                                        </a>
                                    </div>";
        if ($forma_pagamento==1) { //smartpit
            if ($idioma == 'ingles'){
                $texto_smartpit = " <div style='max-width: 600px; padding:10;' align='center'>
                                        We will soon send you a new email with the smartpit code and payment instructions.
                                    </div>";
            } else if ($idioma == 'japones'){
                $texto_smartpit = " <div style='max-width: 600px; padding:10;' align='center'>
                                        間もなく、スマートピットのコードとお支払い方法についての新しいメールをお送りします。
                                    </div>";
            }
        }
    } else if ($pedido_situacao_id==2) { //aguardando confirmacao de pagamento
        $assunto                = "$my_order $pedido_id - $situacao";
        $imagem_situacao_pedido = " <br>
                                    <div style='max-width: 90%; padding:10;' align='center'>
                                        <a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'>
                                            <img style='max-width:100%; height:auto;' src='https://$empresa_host/images/pedido_situacao_2_$idioma.fw.png'>
                                        </a>
                                    </div>";
    }else if ($pedido_situacao_id==3) { //pagamento confirmado
        $assunto                = "$my_order $pedido_id - $situacao";
        $imagem_situacao_pedido = " <br>
                                    <div style='max-width: 90%; padding:10;' align='center'>
                                        <a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'>
                                            <img style='max-width:100%; height:auto;' src='https://$empresa_host/images/pedido_situacao_3_$idioma.fw.png'>
                                        </a>
                                    </div>";
    }else if ($pedido_situacao_id==5) { //pedido enviado
        $assunto                = "$my_order $pedido_id - $situacao";
        $imagem_situacao_pedido = " <br>
                                    <div style='max-width: 90%; padding:10;' align='center'>
                                        <a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'>
                                            <img style='max-width:100%; height:auto;' src='https://$empresa_host/images/pedido_situacao_4_$idioma.fw.png'>
                                        </a>
                                    </div>";
    }

    if ($idioma == 'ingles'){
        $texto = "<!DOCTYPE html><html><head><meta charset='UTF-8' /></head><body style='background-color:#DCDCDC;'><table style='width: 100%; max-height: 100%;' border='0' cellspacing='0' cellpadding='0' align='center'><tbody><tr><td align='center' style='padding:0;Margin:0;'><div style='max-width: 1024px; width: 100%; height: 100%; background: #fff; border-style: solid; border-width: 1px; border-color: #C0C0C0;' align='center'><a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'><div style='max-width: 90%; padding:10; padding-top:5; padding-bottom:5;' align='center'><br><img src='https://$empresa_host/images/logo.png'></div></a>
        <div style='max-width: 100%; background: #0b5394;' align='center'>
            <font color='#fff'>
                <strong>
                    <h2><br>$assunto<br><br></h2>
                </strong>
            </font>
        </div>
        $instrucao_smartpit
        $texto_smartpit
        $imagem_situacao_pedido
        $texto_pedido
        <div style='max-width: 600px; padding:10;' align='center'>
            <p>You can also follow the status and history of your orders by clicking on the button below and choosing the Order Status option.</p>
        </div>
        <div style='max-width: 90%; padding:10;' align='center'>
            <a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'>
                <button type='button' style='background: #0b5394; max-width: 400px; width: 100%; '>
                    <font color='#fff'><strong><h2> My Orders </h2></strong></font>
                </button>
            </a>
        </div>
        <div style='max-width: 90%; padding:10;' align='center'>
            <p>Regards, <a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'>Sitio Wholesale</a><p/>
        </div>
        <div style='max-width: 90%; padding:10;' align='center'>
            <img style='max-width:100%; height:auto;' src='https://$empresa_host/images/email_footer.jpg'
        </div>
        <div style='max-width: 90%; padding:10;' align='center'>
            <p>This is an automated email. There is no need to answer it.</p>
        </div>

    </div></td></tr><tr><td align='center' style='padding:0;Margin:0;'><div style='max-width: 1024px; width: 100%; height: 100%; align='center'><br><h6><img height='20px' width='auto' src='https://$empresa_host/images/fb_icon.png'><br>$local<br>+81 $celular - +81 $telefone<br><a style='text-decoration:none; color: #000000;' href='mailto:$empresa_email_contato'>$empresa_email_contato</a> - <a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'>$empresa_host</a></h6></div></td></tr></tbody></table></body></html>";

    } else if ($idioma == 'japones'){
        $texto = "<!DOCTYPE html><html><head><meta charset='UTF-8' /></head><body style='background-color:#DCDCDC;'><table style='width: 100%; max-height: 100%;' border='0' cellspacing='0' cellpadding='0' align='center'><tbody><tr><td align='center' style='padding:0;Margin:0;'><div style='max-width: 1024px; width: 100%; height: 100%; background: #fff; border-style: solid; border-width: 1px; border-color: #C0C0C0;' align='center'><a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'><div style='max-width: 90%; padding:10; padding-top:5; padding-bottom:5;' align='center'><br><img src='https://$empresa_host/images/logo.png'></div></a>
        <div style='max-width: 100%; background: #0b5394;' align='center'>
            <font color='#fff'>
                <strong>
                    <h2><br>$assunto<br><br></h2>
                </strong>
            </font>
        </div>
        $instrucao_smartpit
        $texto_smartpit
        $imagem_situacao_pedido
        $texto_pedido
        <div style='max-width: 600px; padding:10;' align='center'>
            <p>また、下のボタンをクリックし、注文ステータスオプションを選択することで、注文のステータスと履歴に従うことができます。</p>
        </div>
        <div style='max-width: 90%; padding:10;' align='center'>
            <a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'>
                <button type='button' style='background: #0b5394; max-width: 400px; width: 100%; '>
                    <font color='#fff'><strong><h2> 私の注文 </h2></strong></font>
                </button>
            </a>
        </div>
        <div style='max-width: 90%; padding:10;' align='center'>
            <p>よろしく、<a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'>Sitio Wholesale</a><p/>
        </div>
        <div style='max-width: 90%; padding:10;' align='center'>
            <img style='max-width:100%; height:auto;' src='https://$empresa_host/images/email_footer.jpg'
        </div>
        <div style='max-width: 90%; padding:10;' align='center'>
            <p>これは自動化された電子メールです。 それに答える必要はありません。</p>
        </div>

    </div></td></tr><tr><td align='center' style='padding:0;Margin:0;'><div style='max-width: 1024px; width: 100%; height: 100%; align='center'><br><h6><img height='20px' width='auto' src='https://$empresa_host/images/fb_icon.png'><br>$local<br>+81 $celular - +81 $telefone<br><a style='text-decoration:none; color: #000000;' href='mailto:$empresa_email_contato'>$empresa_email_contato</a> - <a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'>$empresa_host</a></h6></div></td></tr></tbody></table></body></html>";

    }



        
    $mensagem = $texto;
    $headers  = "MIME-Version: 1.1\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $headers .= "From: $email_remetente\n";
    $headers .= "Return-Path: $email_remetente\n"; 
    $headers .= "Reply-To: $email\n"; 

    if(mail("$email", "$assunto", "$mensagem", $headers, "-f$email_remetente")){
        echo $texto;
    }
?>