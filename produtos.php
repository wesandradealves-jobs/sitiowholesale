<?php
session_start();
include_once("conexao.php");
$categoria_id_get = $_GET['c'];
$link = "";
$link = "?c=".$_GET["c"];
$sql_complmento = "";
if (isset($_GET["sc"])){
	$sub_categoria_id_get = $_GET["sc"];
	$sql_complmento = " AND sub_categoria_id=".$_GET["sc"]." ";
	$link = $link."&sc=".$_GET["sc"];
}
if (isset($_GET["m"])){
	$marca_id_get = $_GET["m"];
	$sql_complmento = $sql_complmento." AND marca_id=".$_GET["m"]." ";
}
if (isset($_GET["v"])){
	if ($_GET["v"]==1){ $sql_complmento = $sql_complmento." AND (replace(produto_preco_venda,',','')  BETWEEN 0 AND 1000) ";}; 
	if ($_GET["v"]==2){ $sql_complmento = $sql_complmento." AND (replace(produto_preco_venda,',','')  BETWEEN 1000 AND 10000) ";}; 
	if ($_GET["v"]==3){ $sql_complmento = $sql_complmento." AND (replace(produto_preco_venda,',','')  BETWEEN 10000 AND 100000) ";}; 
	if ($_GET["v"]==4){ $sql_complmento = $sql_complmento." AND (replace(produto_preco_venda,',','')  BETWEEN 100000 AND 1000000) ";}; 
	if ($_GET["v"]==5){ $sql_complmento = $sql_complmento." AND (replace(produto_preco_venda,',','')  BETWEEN 1000000 AND 10000000) ";}; 
	if ($_GET["v"]==6){ $sql_complmento = $sql_complmento." AND (replace(produto_preco_venda,',','')  BETWEEN 10000000 AND 100000000) ";}; 
	$link = $link."&v=".$_GET["v"];
}
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
<script src="js/owl.carousel.js"></script>  

<script>
$(document).ready(function() { 
	$("#owl-demo").owlCarousel({ 
	  autoPlay: 3000, //Set AutoPlay to 3 seconds 
	  items :4,
	  itemsDesktop : [640,5],
	  itemsDesktopSmall : [480,2],
	  navigation : true
 
	}); 
}); 
</script>
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
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<!--
JavaScript code to render PayPal checkout button
and execute payment
-->
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
                    total: '<?php echo $productData['price']; ?>',
                    currency: 'USD'
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
            window.location = "process.php?paymentID="+data.paymentID+"&token="+data.paymentToken+"&payerID="+data.payerID+"&pid=<?php echo $productData['id']; ?>";
        });
    }
}, '#paypal-button');
</script>
</head>
<body>
	<!-- header -->
	<div id="headers">
		<?PHP    
	  		include "header.php"; 
	  	?>
	</div>
	<!-- //header -->	

	<!-- produtos -->
	<div class="container">
	    <div class="col-md-9 product-w3ls-right">
 				<div class="products-row">
						<?php 
							$produto = '';
							$resultado1 =mysqli_query($connection,"SELECT a.*, 
																		  a.situacao_id as situacao, 
																		  b.*, 
																		  (SELECT id 
																			 FROM imagem_produto 
																			WHERE produto_id=b.id
																			  AND imagem_sequencia=1) as imagem
																	 FROM (select * from produto_itens where situacao_id <> 3) a,
																	 	  produtos b
																    WHERE a.produto_id = b.id 
																	  AND b.categoria_id=$categoria_id_get
																	  	  $sql_complmento
																 ORDER BY a.produto_id, 
																		  a.situacao_id");
                            while($dados1 = mysqli_fetch_assoc($resultado1)){
								if ($produto!=$dados1["produto_id"]){
						?>
									<div class="col-md-3 product-grids"> 
										<div class="agile-products">
												<a href="produto.php?id=<?php echo $dados1["produto_id"];?>" onclick="<?php echo $loading;?>"><img src="adm/imagens/<?php echo $dados1["imagem"]; ?>.jpg" class="img-responsive" alt="img">
												<?php if ($dados1["situacao"]==2){?>
													<div id="indisponivel">
														<h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=74"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>            
														<h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=75"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>            
													</div>
												<?php };?>
													<div class="agile-product-text">              
														<h6><?php echo $dados1["produto_descricao_".$msg_idioma]; ?></h6>
														<div style="float: left;"><h6>#<?php echo $dados1["produto_codigo_cliente"]; ?></h6></div>
														<div style="float: right;"><h4 align="right"> <?php echo $dados1["produto_preco_venda"]; ?> 円</h4></div>
													</div>
												</a>
										</div>  
									</div>			
						<?php   
								}  $produto=$dados1["produto_id"];	

							} ?>
					<div class="clearfix"> </div>
				</div>
            </div>
            <ol></ol> 
			<div class="col-md-3 rsidebar">
				<div class="rsidebar-top">
					<div class="slider-left">
						<h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=72"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>            
						<div class="sidebar-row">
							<ul class="faq">
								<?php echo "<li><a href='produtos.php".$link."&v=1' onclick="; echo '"'.$loading.'"'; echo ">￥0 - ￥1000</a></li>";?>
								<?php echo "<li><a href='produtos.php".$link."&v=2' onclick="; echo '"'.$loading.'"'; echo ">￥1,000 - ￥10,000</a></li>";?>
								<?php echo "<li><a href='produtos.php".$link."&v=3' onclick="; echo '"'.$loading.'"'; echo ">￥10,000 -￥100,000</a></li>";?>
								<?php echo "<li><a href='produtos.php".$link."&v=4' onclick="; echo '"'.$loading.'"'; echo ">￥100,000 - ￥1,000,000</a></li>";?>
								<?php echo "<li><a href='produtos.php".$link."&v=5' onclick="; echo '"'.$loading.'"'; echo ">￥1,000,000 - ￥10,000,000</a></li>";?>
								<?php echo "<li><a href='produtos.php".$link."&v=6' onclick="; echo '"'.$loading.'"'; echo ">￥10,000,000 - ￥100,000,000</a></li>";?>
							</ul>
						</div> 
					</div>
					<div class="sidebar-row">
						<h4><?php $query =mysqli_query($connection,"SELECT categoria_descricao_".$msg_idioma." as categoria FROM categorias WHERE id=$categoria_id_get"); while($line = mysqli_fetch_assoc($query)){ echo $line["categoria"]; } ?></h4>
						<ul class="faq">
							<?php    
								$resultado2 =mysqli_query($connection,"SELECT * FROM subcategorias WHERE categoria_id = $categoria_id_get order by id");
									while($dados2 = mysqli_fetch_assoc($resultado2)){
										echo "<li> <a href='produtos.php".$link."&sc=".$dados2['id']."' onclick="; echo '"'.$loading.'"'; echo ">".$dados2['subcategoria_descricao_'.$msg_idioma]."</a></li>";
									}
						 ?>
							<li> <?php echo "<a href='produtos.php?c=".$categoria_id_get."' onclick="; echo '"'.$loading.'"'; echo ">"; $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=8"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]." "; } $query =mysqli_query($connection,"SELECT categoria_descricao_".$msg_idioma." as categoria FROM categorias WHERE id=$categoria_id_get"); while($line = mysqli_fetch_assoc($query)){ echo $line["categoria"]; } ?></a></li>
						</ul>
					</div>
					<div class="sidebar-row">
					<h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=73"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>
						<ul class="faq">
							<?php    
								$resultado2 =mysqli_query($connection,"SELECT distinct(marca_id), (SELECT marca_descricao FROM marcas WHERE id =marca_id ) as marca FROM produtos WHERE categoria_id= $categoria_id_get order by marca");
									while($dados2 = mysqli_fetch_assoc($resultado2)){
										echo "<li> <a href='produtos.php".$link."&m=".$dados2['marca_id']."' onclick="; echo '"'.$loading.'"'; echo ">". $dados2['marca']."</a></li>";
									}
						 ?>
								
						</ul>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
 		</div>
	<!-- //produtos -->
	</div>
	<!-- header -->
	<div id="headers">
		<?PHP    
	  		include "footers.php"; 
	  	?>
	</div>
	<!-- //header -->	
</body>
</html>