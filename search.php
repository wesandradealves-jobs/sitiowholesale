<?php
session_start();
include_once("conexao.php");

$search = "asdasdasdasdasdas";
if (isset($_POST["search"])){
    $search = $_POST["search"];
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
	    <div class="col-md-12 product-w3ls">
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
                                                                      AND (b.produto_descricao_".$msg_idioma." like '%$search%'
                                                                       OR  b.produto_descricao_curta_".$msg_idioma." like '%$search%'
                                                                       OR  b.produto_descricao_longa_".$msg_idioma." like '%$search%')
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