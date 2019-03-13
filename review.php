<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title>Sítio Whole Sale</title>
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="sitio wholesale" content="sitio, sitio wholesale, costco, costco wholesale" />
<link rel="icon" href="images/icon.png">
<script type="application/x-javascript"> 
	addEventListener("load", function() {
		setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); 
	} 
</script>
<!-- Custom Theme files -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="css/ken-burns.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="css/animate.min.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all"> 
<!-- //Custom Theme files -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="js/jquery-2.2.3.min.js"></script> 
<!-- //js --> 
<!-- web-fonts -->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Lovers+Quarrel' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Offside' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Tangerine:400,700' rel='stylesheet' type='text/css'>
<!-- web-fonts --> 
<script src="js/jquery-scrolltofixed-min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        // Dock the header to the top of the window when scrolled past the banner. This is the default behaviour.

        $('.header-two').scrollToFixed();  
        // previous summary up the page.

        var summaries = $('.summary');
        summaries.each(function(i) {
            var summary = $(summaries[i]);
            var next = summaries[i + 1];

            summary.scrollToFixed({
                marginTop: $('.header-two').outerHeight(true) + 10, 
                zIndex: 999
            });
        });
    });
</script>
<!-- start-smooth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>	
<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
</script>
<!-- //end-smooth-scrolling -->
<!-- smooth-scrolling-of-move-up -->
	<script type="text/javascript">
		$(document).ready(function() {
		
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
	<!-- //smooth-scrolling-of-move-up -->
<script src="js/bootstrap.js"></script>	
</head>

<body>
	<!-- header -->
	<div id="headers">
		<?PHP    
	  		include "header.php"; 
	  	?>
	</div>
	<!-- //header -->

	<!-- carrinho -->
	<div class="login-page">
		<div class="container"> 
			<h3 class="w3ls-title w3ls-title1"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=104"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h3>  
			<div class="dados-body">
			<h2 align='left' class="w3ls-title w3ls-title1"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=93"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h2>  
            <table class="table">
		<thead>
		  <tr>
			<th><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=95"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>
			<th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=96"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>	
			<th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=97"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>		
			<th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=102"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>
			<th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=98"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>		
		  </tr>
		</thead>
		<tbody>
            <?php 
                $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=94"); while($line = mysqli_fetch_assoc($query)){ $mensagem = $line["mensagem"]; } 
                $total = 0;

                //variaveis para frete
                $valor_total_frete = 0;
                $peso_total = 0;
                // fim variaveis para frete

                if (count($_SESSION['carrinho']) == 0){
                    echo "<tr align='center'><td colspan='5'><h3>$mensagem</h3></td></tr>";
                    header("Location: index.php");
                } else {
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
									FROM 	(select * from produto_itens where situacao_id = 1) a,
											produtos b
									WHERE a.produto_id = b.id 
									  AND a.id=$id");
                        $ln = mysqli_fetch_assoc($query);
                        $descricao = $ln['produto_descricao_'.$msg_idioma];
                        $cor       = $ln['cor_descricao'];
                        $tamanho   = $ln['tamanho'];
                        $preco     = 0;
                        $sub       = 0;
                        if ($descricao){ // verifica se o produto esta disponivel
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
                            $preco     = number_format($preco,0,',',',');
                            if ($tpembalagem){
                                $id=$id.'.'.$embalagem;
                            }
                            echo "  <tr>
                                        <td align='left'><a href='produto.php?id=".$ln['produto_id']."' onclick=";	echo '"'.$loading.'"'; echo ">$descricao $cor $tamanho $tpembalagem</a></td>
                                        <td align='right'>$preco 円</td>
                                        <td align='right'>$qtd</td>
                                        <td align='right'>
                                            <form action='#' method='post'>
                                                <button class='w3view-cart' type='hidden' name='submit'><i class='fa fa-times-circle-o' style='font-size:25px;color:red;' aria-hidden='true'  onclick=";	echo '"'.$loading.'"'; echo "></i></button>
                                                <input type='hidden' id='acao' name='acao' value='del'/> 
                                                <input type='hidden' id='abrircart' name='abrircart' value='0'/> 
                                                <input type='hidden' id='idproddel' name='idproddel' value='$id'/> 
                                            </form>
                                        </td>
                                        <td align='right'>$sub 円</td>
                                    </tr>";

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
                        } else { // se produto indisponivel, o sistema retira ele do carrinho
                            if (isset($_SESSION['carrinho'][$id])){ // se existir o produto no carrinho
                                unset($_SESSION['carrinho'][$id]);
                            }
                            echo '<script> location.reload(); </script>';
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
                    
                    $total = number_format($total,0,',',',');
            ?>
        	<!-- Endereco de Entrega -->
            <script>
                //carrega os dados do endereco de entrega 
                var cep  = '<?php echo $_SESSION['cep']; ?>';
                //descricao da provincia
                function provincia(data) {
                    $("#provincia_descricao").text(data);
                }
                $.get('processa/dados_cep.php?f=1&cep='+cep, provincia);
                //descricao da cidade
                function cidade(data) {	
                    $("#cidade_descricao").text(data);
                }
                $.get('processa/dados_cep.php?f=2&cep='+cep, cidade);
            </script>    
            <tr><td colspan='5'>
                <h2 align='left' class="w3ls-title w3ls-title1"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=101"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h2>  
                <p style="text-align:left"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=16"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> : <?php echo $_SESSION['nome']; ?></p>
                <p style="text-align:left"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=18"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> : <?php echo $_SESSION['telefone']?></p>
                <p style="text-align:left"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=112"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> : 〒 <?php echo $_SESSION['cep']; ?></p>
                <p style="text-align:left" id="provincia_descricao" name="provincia_descricao"></p>
                <p style="text-align:left" id="cidade_descricao" name="cidade_descricao"></p>
                <p style="text-align:left"><?php echo $_SESSION['endereco']; ?></p>
                <h4><a href="entrega.php" onclick="<?php echo $loading;?>"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=105"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> »</a></h6> 
                <br><h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=141"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>  
				<select class="form-control" name="pedido_periodo_entrega" id="pedido_periodo_entrega" onchange="periodo(this)">
                    <option value=""></option>
                    <option value="08:00 - 12:00">08:00 - 12:00</option>
                    <option value="12:00 - 14:00">12:00 - 14:00</option>
                    <option value="14:00 - 16:00">14:00 - 16:00</option>
                    <option value="16:00 - 18:00">16:00 - 18:00</option>
                    <option value="18:00 - 21:00">18:00 - 21:00</option>
                    <option value="19:00 - 21:00">19:00 - 21:00</option>
				</select>
                <script>
                    function periodo(lnk) {
                        var $lnk = document.getElementById("link_entrega1");
                        $lnk.href = $lnk.href.replace(/pedido_periodo_entrega=(.*)/, 'pedido_periodo_entrega=') + lnk.value;

                        var $lnk = document.getElementById("link_entrega2");
                        $lnk.href = $lnk.href.replace(/pedido_periodo_entrega=(.*)/, 'pedido_periodo_entrega=') + lnk.value;
 
                    }
                </script>

            <tr/></td> 
        <!-- // Endereco de Entrega -->         
            <?php
                    $valor_total_frete = number_format($valor_total_frete,0,',',',');
                    $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=106"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
                    echo "<tr><td colspan='2'td><h4>$msgTotal</h4></td><td colspan='3'><h3>$total 円</h3></td><tr/>";
                    $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=107"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
                    echo "<tr><td colspan='2'td><h4>$msgTotal</h4></td><td colspan='3'><h3>$valor_total_frete 円</h3></td><tr/>";
                    $total = str_replace(',','',$total) + str_replace(',','',$valor_total_frete);
                    $total = number_format($total,0,',',',');
                    $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=99"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
                    echo "<tr><td colspan='2'><h4>$msgTotal</h4></td><td colspan='3'><h3>$total 円</h3></td><tr/>";
                }
            ?>
		</tbody>
        </table>
        <h3 class="w3ls-title w3ls-title1"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=140"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h3>  
        <?php
            $query2 =mysqli_query($connection,"SELECT * FROM empresa WHERE id=1"); 
            $line2 = mysqli_fetch_assoc($query2);
        ?>

        <?php
            if ($line2["empresa_paypal_situacao"]=='1') {
        ?>
        <!-- Botao PayPal -->



<!--             <a href="processa/proc_cad_pedido.php?f=2&pedido_periodo_entrega=" id="link_entrega1" onclick="<?php echo $loading;?>">
                <div style='padding: 0.5em 0em; border: 0px; background: #fff;' align='center'>
                    <div style='width: 100%; ' align='center'>
                        <input type='image' src='https://sitiowholesale.co/images/cards.png' style='max-width: 95%;'>
                    </div>
                </div>
            </a> -->

            <!-- Checkout button -->
            <?php 
                // Include and initialize paypal class
                include 'processa/PaypalExpress.class.php';
                $paypal = new PaypalExpress;

                // print_r($ln);

                // echo $total;

                // produto_preco_venda
            ?>
            <script src="https://www.paypalobjects.com/api/checkout.js"></script>
            <script>
            paypal.Button.render({
                // Configure environment
                env: '<?php echo $paypal->paypalEnv; ?>',
                client: {
                    sandbox: '<?php echo $paypal->paypalClientID; ?>',
                    production: '<?php echo $paypal->paypalClientID; ?>'
                },
                // Customize button (optional)
                locale: 'en_US',
                style: {
                    size: 'small',
                    color: 'gold',
                    shape: 'pill',
                },
                // Set up a payment
                payment: function (data, actions) {
                    return actions.payment.create({
                        transactions: [{
                            amount: {
                                total: '<?php echo $total; ?>',
                                currency: 'JPY'
                            }
                        }]
                  });
                },
                // Execute the payment
                onAuthorize: function (data, actions) {
                    return actions.payment.execute()
                    .then(function () {
                        // Show a confirmation message to the buyer
                        //window.alert('Thank you for your purchase!');
                        
                        // Redirect to the payment process page
                        
                        // window.location = "processa/paypal_retorno.php?paymentID="+data.paymentID+"&token="+data.paymentToken+"&payerID="+data.payerID+"&pid=<?php echo $ln['id']; ?>";

                        // proc_cad_pedido
                        window.location = "processa/proc_cad_pedido.php?f=2&pedido_periodo_entrega=&paymentID="+data.paymentID+"&token="+data.paymentToken+"&payerID="+data.payerID+"&pid=<?php echo $ln['id']; ?>";
                    });
                }
            }, '#paypal-button');
            </script>
            <div id="paypal-button"></div>



                <!-- Fim Botao PayPal -->
        <!-- Smartpit Logo -->
        <?php
            }
            if ($line2["empresa_smartpit_situacao"]=='1') {
        ?>
            <a href="processa/proc_cad_pedido.php?f=1&pedido_periodo_entrega=" id="link_entrega2" onclick="<?php echo $loading;?>">
                <div style='padding: 0.5em 0em; border: 0px; background: #fff;' align='center'>
                    <div style='background: #085EAA; width: 100%; ' align='center'>
                        <input type='image' src='images/smartpit.jpg' style='max-width: 95%;'>
                    </div>
                </div>
            </a>
            <!-- Smartpit Logo -->
        <?php
           }
        ?>

        <form action="index.php" method="post">
            <input type="submit" onclick="<?php echo $loading;?>" value="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=103"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>">
        </form>

		    </div>  
		</div>
	</div>
	<!-- //carrinho --> 

	<!-- all footers -->
	<div id="footers">
		<?PHP    
	  		include "footers.php"; 
	  	?>
	</div>
	<!-- //all footers -->
</body>
</html>