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
	<!-- categorias -->
	<div class="container">
		<div class="col-md-14 product-w3ls-right">
			<?php 
				$resultado1 =mysqli_query($connection,"SELECT * FROM categorias WHERE id > 1 order by categoria_descricao_ingles");
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
	<!-- //categorias -->

	<!-- all footers -->
	<div id="footers">
		<?PHP    
	  		include "footers.php"; 
	  	?>
	</div>
	<!-- //all footers -->
</body>
</html>