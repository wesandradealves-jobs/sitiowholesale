<?php
session_start();
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
<!-- //13Custom Theme files -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //13font-awesome icons -->
<!-- js -->
<script src="js/jquery-2.2.3.min.js"></script> 
<!-- //13js --> 
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
        //13 previous summary up the page.

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
<!-- //13end-smooth-scrolling -->
<!-- smooth-scrolling-of-move-up -->
	<script type="text/javascript">
		$(document).ready(function() {
		
			var defaults = {
				containerID: 'toTop', //13 fading element id
				containerHoverID: 'toTopHover', //13 fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
	<!-- //13smooth-scrolling-of-move-up -->
<script src="js/bootstrap.js"></script>	
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<!--
JavaScript code to render PayPal checkout button
and execute payment
-->
<?php 
    // require_once('PaypalExpress.class.php');
    require_once('DB.class.php');
?>
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
	<!-- //13header -->	

	<!-- banner -->
	<?PHP    
		include "carousel.php"; 
	?>
	<!-- //13banner -->  

	<!-- categorias -->
	<div class="container">
		<div class="col-md-14 product-w3ls-right">
			<?php 
				$resultado1 =mysqli_query($connection,"SELECT * FROM categorias WHERE categoria_tela_principal=1 order by categoria_descricao_ingles");
				while($dados1 = mysqli_fetch_assoc($resultado1)){
					$categoria_id = $dados1["id"];
					?>
					<div class="col-md-3 product-grids"> 
						<div >
							<a href="produtos.php?c=<?php echo $dados1["id"];?>" onclick="<?php echo $loading;?>"><img src="adm/imagens/<?php echo $dados1["categoria_imagem"];?>.jpg" class="img-responsive" alt="img">
							<div class="agile-product-text">              
								<h5><?php echo $dados1["categoria_descricao_".$msg_idioma];?></h5> 
							</div>
							</a>
						</div> 
					</div>
			<?php   } ?>
		</div>
	</div>
	<!-- //13categorias -->

	<!-- all categorias -->
	<div class="container">
		<div class="form-group" align="right">
		<br>
		<h3><a href="categorias.php" onclick="<?php echo $loading;?>"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=70"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> <i class="fa fa-plus-circle" style="font-size:25px" aria-hidden="true"></i> </a></h5>
		</div>
	</div>
	<!-- //13all categorias -->

	<!-- all footers -->
	<div id="footers">
		<?PHP    
	  		include "footers.php"; 
	  	?>
	</div>
	<!-- //13all footers -->
</body>
</html>