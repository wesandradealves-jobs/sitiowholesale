<?php 
   session_start();
    include_once("seguranca.php");
	include_once("conexao.php");

	unset($_SESSION['pedido']);

	$pedido_id = $_GET['id'];

	$query =mysqli_query($connection,"SELECT *, (SELECT pedido_situacao_descricao_".$msg_idioma." FROM pedido_situacao WHERE id = pedido_situacao_id) as situacao FROM pedidos WHERE id = ".$pedido_id." AND cliente_id = ".$_SESSION['clienteId']."");
	$ln = mysqli_fetch_assoc($query);
	$pedido_id 						= $ln['id'];
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
	$pedido_periodo_entrega	 		= $ln['pedido_periodo_entrega'];
	$pedido_criacao 				= $ln['pedido_criacao'];

    $resultado = mysqli_query($connection,"SELECT 	b.post_provincia_".$msg_idioma." as provincia,
	                                                c.post_cidade_".$msg_idioma." as cidade
                                            FROM    post_ceps a,
	                                                post_provincias b, 
	                                                post_cidades c
                                            WHERE   a.id = '$cep_entrega_id' 
                                              AND   b.id=a.provincia_id 
                                              AND   c.id=a.cidade_id
                                              LIMIT 1");
    $linhas = mysqli_fetch_assoc($resultado);    
    $provincia_entrega = $linhas['provincia'];
    $cidade_entrega    = $linhas['cidade'];	
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


	<div class="login-page">
		<div class="container"> 
			<div class="dados-body">
                <h3 class="w3ls-title w3ls-title1"><a href='pedidos.php' onclick="<?php echo $loading;?>"><i class='fa fa-mail-reply-all' style='font-size:25px;' aria-hidden='true'> </i> </a> <?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=114"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h3>  
				<p class="text-center text-danger">
					<?php
						if(isset($_SESSION['loginErro'])){
							echo $_SESSION['loginErro'];
							unset($_SESSION['loginErro']);
						}
					?>
				</p>
				<!--  -->
				<div class="col-md-7">
					<p style="text-align:left"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=115"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>: <?php echo $pedido_id;?></p>
					<p style="text-align:left"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=117"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>: <?php echo $situacao;?></p>
					<p style="text-align:left"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=116"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>: <?php echo $pedido_criacao;?></p>
					<p style="text-align:left"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=118"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>: 
						<?php if ($pedido_forma_pagamento==1){
									$query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=123"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; };
							  } else if ($pedido_forma_pagamento==2){
									echo "PayPal";
							  } 
						?>
					</p>
					<?php 	
						$query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=119"); while($line = mysqli_fetch_assoc($query)){ $mensagem = $line["mensagem"]; }
						if ($pedido_forma_pagamento==1){
							echo "<p style='text-align:left'> $mensagem: "; 
							$query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=120"); while($line = mysqli_fetch_assoc($query)){ $mensagem = $line["mensagem"]; }
							if (!$pedido_codigo_smartpit){
								echo "<strong class='text-danger'>$mensagem</strong>";
							} 
							else {
								echo "<strong class='text-danger'>$pedido_codigo_smartpit</strong>";
							} 
							echo "</p>";
						}
						$query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=121"); while($line = mysqli_fetch_assoc($query)){ $mensagem1 = $line["mensagem"]; }
						$query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=122"); while($line = mysqli_fetch_assoc($query)){ $mensagem2 = $line["mensagem"]; }
						if ($pedido_situacao_id==1 && $pedido_forma_pagamento==2){
							echo "<p class='text-danger' style='text-align:left'><strong>$mensagem1 $mensagem2.</strong></p>";
						}
					?>
				</div>				
				<!-- Se o pagamento do paypal foi cancelado, permite nova tentativa com paypal ou alterar para smartpit -->
				<?php if ($pedido_situacao_id==1 && $pedido_forma_pagamento==2){
						$query2 =mysqli_query($connection,"SELECT * FROM empresa WHERE id=1"); 
						$line2 = mysqli_fetch_assoc($query2);
						if ($line2["empresa_smartpit_situacao"]=='1') {
					?>
							<!-- Smartpit Logo -->
							<a href="pedido.php?smartpit=<?php echo $pedido_id;?>" onclick="<?php echo $loading;?>"><img src="images/smartpit.png"/></a><br><br>
							<!-- Smartpit Logo -->
					<?php
						}
						if ($line2["empresa_paypal_situacao"]=='1') {
					?>
						<!-- PayPal Logo -->
						<a href="processa/paypal.php?pedido=<?php echo $pedido_id;?>" onclick="<?php echo $loading;?>">
							<?php
							if ($http_lang != 'ja') {
								echo "<img src='https://www.paypalobjects.com/webstatic/en_AU/i/buttons/btn_paywith_primary_l.png' />";
							} else {
								echo "<img src='https://www.paypalobjects.com/digitalassets/c/website/marketing/apac/jp/developer/purchase_228_50.png'>";
							}
							?>
						</a>
						<!-- PayPal Logo -->					
				<?php   }
					 }
				?>
				<div class="clearfix"></div>
				<table style="width:98%;margin:0 auto" class="table">
					<thead>
						<tr>
						<th><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=95"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>
						<th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=96"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>	
						<th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=97"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>		
						<th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=98"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>		
						</tr>
					</thead>
					<tbody>

						<?php

							if ($pedido_id > 0){
								$query =mysqli_query($connection,"SELECT 	a.*, 
																			a.situacao_id as situacao, 
																			a.produto_id as produto, 
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
									$sub       = number_format($sub,0,',',',');
									$preco     = number_format($preco,0,',',',');

									echo "  <tr>
												<td align='left'><a href='produto.php?id=".$ln['produto']."' onclick=";	echo '"'.$loading.'"'; echo ">$descricao $cor $tamanho</a></td>
												<td align='right'>$preco 円</td>
												<td align='right'>$qtd</td>
												<td align='right'>$sub 円</td>
											</tr>";

								}
							} else {
								// header("Location: index.php");
							}
						?>

						<!-- Endereco de Entrega -->
						<script>
								//carrega os dados do endereco de entrega 
								var cep  = '<?php echo $cep_entrega_id; ?>';
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
                				<p style="text-align:left"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=112"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> : 〒 <?php echo $_SESSION['cep']; ?>
                                <?php echo $provincia_entrega; ?>
                                <?php echo $cidade_entrega; ?>
                                <?php echo $pedido_endereco_entrega; ?></p>
								<br><h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=142"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> <?php echo $pedido_periodo_entrega; ?></h4><br>
							<tr/></td> 
						<!-- // Endereco de Entrega -->    
						<?php
								$valor_total_frete = number_format($pedido_valor_frete_calculado,0,',',',');
								$total =  number_format($pedido_valor_itens,0,',',',');
								$query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=106"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
								echo "<tr><td colspan='2'td><h4>$msgTotal</h4></td><td colspan='3'><h3>$total 円</h3></td><tr/>";
								$query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=107"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
								echo "<tr><td colspan='2'td><h4>$msgTotal</h4></td><td colspan='3'><h3>$valor_total_frete 円</h3></td><tr/>";
								$total = str_replace(',','',$total) + str_replace(',','',$valor_total_frete);
								$total = number_format($total,0,',',',');
								$query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=99"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
								echo "<tr><td colspan='2'><h4>$msgTotal</h4></td><td colspan='3'><h3>$total 円</h3></td><tr/>";
							
						?>
					</tbody>
        		</table>				
			</div>  
		</div>
	</div>

	<!-- all footers -->
	<div id="footers">
		<?PHP    
	  		include "footers.php"; 
	  	?>
	</div>
	<!-- //all footers -->
</body>
</html>