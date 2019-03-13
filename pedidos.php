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

	<!-- sign up-page -->
	<div class="login-page">
		<div class="container"> 
			<div class="dados-body">
				 <h3 class="w3ls-title w3ls-title1"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=45"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h3>  
				 
				 <table class="table">
					<thead>
						<tr>
						<th><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=115"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>
						<th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=117"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>	
						<th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=124"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>		
						<th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=91"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>		
						</tr>
					</thead>
					<tbody>

						<?php
							$query =mysqli_query($connection,"SELECT *, (SELECT pedido_situacao_descricao_".$msg_idioma." FROM pedido_situacao WHERE id = pedido_situacao_id) as situacao FROM pedidos WHERE cliente_id =".$_SESSION['clienteId']." order by id desc");
							while($ln = mysqli_fetch_assoc($query)){
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
								$pedido_criacao 				= $ln['pedido_criacao'];

								$total = $pedido_valor_itens + $pedido_valor_frete_calculado;
								$total = number_format($total,0,',',',');
								$pedido_criacao = date("Y-m-d",strtotime($pedido_criacao));

								echo "  <tr>
											<td align='left'>$pedido_id</td>
											<td align='right'>$situacao</td>
											<td align='right'>$pedido_criacao</td>
											<td align='right'>$total 円</td>
											<td align='right'><a href='pedido.php?id=".$pedido_id."' onclick=";	echo '"'.$loading.'"'; echo "><i class='fa fa-search-plus' style='font-size:25px;' aria-hidden='true'></i></a></td>
										</tr>";

							}
						?>
					</tbody>
        		</table>

			</div>  
		</div>
	</div>
	<!-- //sign up-page --> 

	<!-- all footers -->
	<div id="footers">
		<?PHP    
	  		include "footers.php"; 
	  	?>
	</div>
	<!-- //all footers -->
</body>
</html>