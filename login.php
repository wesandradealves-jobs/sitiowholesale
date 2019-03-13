<?php
session_start();
include_once("conexao.php");

//veio do checkout do carrinho de compra
$vapara = '';
if (isset($_POST['vapara'])){
	$vapara =$_POST['vapara'];
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
	
	<!-- login-page -->
	<div class="login-page">
		<div class="container"> 
			<h3 class="w3ls-title w3ls-title1"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=38"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h3>  
			<div class="login-body">

				<script>
					function verificaLogin(){ 
						if (form_login.cliente_password.value!="" && form_login.cliente_email.value!="")	{
							document.getElementById('blanket').style.display = 'block';
							document.getElementById('aguarde').style.display = 'block';
							document.form_login.submit();
						}
					}
				</script>
				<form action="valida_login.php" method="post" name="form_login" id="form_login">
					<input type='hidden' id='vapara' name='vapara' value='<?php echo $vapara;?>'>
					<input type="email" class="form-control" name="cliente_email" placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=14"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>" required="">
					<input type="password" name="cliente_password" class="form-control" placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=28"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>" required="">
					<input type="submit" onclick="verificaLogin();" value="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=39"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>">
					<div class="forgot-grid">
						<label class="checkbox"><input type="checkbox" name="checkbox"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=30"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></label>
						<div class="forgot">
							<a href="recuperar_senha.php" onclick="<?php echo $loading;?>"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=31"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></a>
						</div>
						<div class="clearfix"> </div>
					</div>
				</form>
				<p class="text-center text-danger">
					<?php
						if(isset($_SESSION['loginErro'])){
							echo $_SESSION['loginErro'];
							unset($_SESSION['loginErro']);
						}
					?>
				</p>
			</div>  
			<script>
				function submitForm() {
				// Can do some validation here if needed
				document.getElementById('sample_form').submit();  

				return true;
				}
			</script>
			<form method="POST" action="cad_cliente.php" id="sample_form">
				<input type='hidden' id='vapara' name='vapara' value='<?php echo $vapara;?>'>
				<h6> <?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=40"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> <a href="javascript:void(0);" onclick="<?php echo $loading;?> submitForm();"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=41"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> »</a> </h6> 
			</form>
		</div>
	</div>
	<!-- //login-page --> 

	<!-- all footers -->
	<div id="footers">
		<?PHP    
	  		include "footers.php"; 
	  	?>
	</div>
	<!-- //all footers -->
</body>
</html>