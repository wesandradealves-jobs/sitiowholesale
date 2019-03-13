<?php
session_start();
include_once("conexao.php");
if (isset($_SESSION['clienteId'])){
    $id = $_SESSION['clienteId'];
} else {
    $id = 0;
}

//verifica o email de contato
$query =mysqli_query($connection,"SELECT empresa_email_contato FROM empresa WHERE id=1"); 
$line = mysqli_fetch_assoc($query); 
$empresa_email_contato = $line["empresa_email_contato"];


//Executa consulta para carregar os dados automatico se estiver logado
$resultado = mysqli_query($connection,"SELECT * FROM clientes WHERE id = '$id' LIMIT 1");
$linhas = mysqli_fetch_assoc($resultado);

if (isset($_POST["email"])) {
    /*
    *  CONFIGURE EVERYTHING HERE
    */

    // an email address that will be in the From field of the email.
    $from = $_POST["name"].' <'.$_POST["email"].'>';

    // an email address that will receive the email with the output of the form
    $sendTo = $empresa_email_contato;

    // subject of the email
    $subject = 'Enviado pelo site Sitio Wholesale';

    // form field names and their translations.
    // array variable name => Text to appear in the email
    $fields = array('name' => 'Nome', 'phone' => 'Telefone', 'email' => 'Email', 'message' => 'Menssagem'); 


    // message that will be displayed when everything is OK :)
    $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=88"); while($line = mysqli_fetch_assoc($query)){ $msgemail = $line["mensagem"]; } 
    $okMessage = $msgemail;

    // If something goes wrong, we will display this message.
    $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=87"); while($line = mysqli_fetch_assoc($query)){ $msgemail = $line["mensagem"]; } 
    $errorMessage = $msgemail;

    /*
    *  LET'S DO THE SENDING
    */

    // if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
    error_reporting(E_ALL & ~E_NOTICE);

    try
    {

        if(count($_POST) == 0) throw new \Exception('Form is empty');
                
        $emailText = "Este email foi enviado atraves do site www.appudata.com\n==========================================================\n";

        foreach ($_POST as $key => $value) {
            // If the field exists in the $fields array, include it in the email 
            if (isset($fields[$key])) {
                $emailText .= "$fields[$key]: $value\n";
            }
        }

        // All the neccessary headers for the email.
        $headers = array('Content-Type: text/plain; charset="UTF-8";',
            'From: ' . $from,
            'Reply-To: ' . $from,
            'Return-Path: ' . $from,
        );
        
        // Send email
        mail($sendTo, $subject, $emailText, implode("\n", $headers));

        $responseArray = array('type' => 'success', 'message' => $okMessage);
    }
    catch (\Exception $e)
    {
        $responseArray = array('type' => 'danger', 'message' => $errorMessage);
    }
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
			<h3 class="w3ls-title w3ls-title1"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=2"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h3>  
			<div class="login-body">
				<form action="contato.php" method="post" name="form_contato" id="form_contato">
                    <div class="messages"></div>
                    <div class="controls">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=16"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> *</h4>
                                    <input id="form_name" type="text" name="name" value="<?php echo $linhas['cliente_nome']; ?>" class="form-control" placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=17"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> *" required="required">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=18"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>
                                <input id="form_phone" type="tel" name="phone" value="<?php echo $linhas['cliente_cellfone']; ?>" class="form-control" placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=19"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=13"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> *</h4>
                                    <input id="form_email" type="email" name="email" value="<?php echo $linhas['cliente_email']; ?>" class="form-control" placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=14"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> *" required="required">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=83"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> *</h4>
                                    <textarea id="form_message" name="message" class="form-control" placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=84"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> *" rows="4" required="required"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>
                                        <p class="text-center text-danger">  
                                            <?php
                                                echo $responseArray['message'];
                                            ?>
                                        </p>
                                    </strong>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <script>
                                    function verificaContato()	{ 
                                        if (form_contato.name.value!="" && form_contato.email.value!="" && form_contato.message.value!="")	{
                                            document.getElementById('blanket').style.display = 'block';
                                            document.getElementById('aguarde').style.display = 'block';
                                            document.form_contato.submit();
                                        }
                                    }
                                </script>
                                <input type="submit" onclick="verificaContato();" class="btn btn-success btn-send" value="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=85"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>">
                            </div>
                        </div>
                    </div>
                </form>

			</div>  
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