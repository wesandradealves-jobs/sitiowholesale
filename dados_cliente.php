<?php
    session_start();
    include_once("seguranca.php");
    include_once("conexao.php");

    $id = $_SESSION['clienteId'];
    //Executa consulta
    $resultado = mysqli_query($connection,"SELECT * FROM clientes WHERE id = '$id' LIMIT 1");
    $linhas = mysqli_fetch_assoc($resultado);
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
            <h3><p class="text-center text-danger"><strong>
					<?php
						if(isset($_SESSION['loginErro'])){
							echo $_SESSION['loginErro'];
                            unset($_SESSION['loginErro']);
						}
					?>
			<strong></p></h3>
            <div class="dados-body">
                <a  class="fa fa-shopping-bag" style="font-size:20px; color:#085EAA;" href="pedidos.php" onclick="<?php echo $loading;?>"> <?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=46"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></a>
                <strong style="font-size:25px; color:#085EAA;">&nbsp;&nbsp;|&nbsp;&nbsp;</strong>
                <a  class="fa fa-user-times" style="font-size:20px; color:#085EAA;" href="sair.php" onclick="<?php echo $loading;?>"> <?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=47"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></a>
            </div>
            <br>
			<div class="dados-body">
            <script>
                //fucao de numeros
                function somenteNumeros(num) {
                    var er = /[^0-9]/;
                    er.lastIndex = 0;
                    var campo = num;
                    if (er.test(campo.value)) {
                    campo.value = "";
                    }
                }
                
                //carrega os dados do cep que esta cadastrado 
                    var cep  = <?php echo $linhas['cep_id']; ?>;
                    //descricao da provincia
                    function provincia(data) {
                        $("#provincia_descricao").val(data);
                    }
                    $.get('processa/dados_cep.php?f=1&cep='+cep, provincia);
                    //descricao da cidade
                    function cidade(data) {	
                        $("#cidade_descricao").val(data);
                    }
                    $.get('processa/dados_cep.php?f=2&cep='+cep, cidade);
                    $("#cliente_endereco").val(data+' ');

                //funcao para carregar os dados do endereco do cep digitado
                function dadosCep() {
                    var cep  = document.getElementById("cep_id").value;
					//descricao da provincia
					function provincia(data) {
						$("#provincia_descricao").val(data);
					}
					$.get('processa/dados_cep.php?f=1&cep='+cep, provincia);
					//descricao da cidade
					function cidade(data) {	
						$("#cidade_descricao").val(data);
					}
					$.get('processa/dados_cep.php?f=2&cep='+cep, cidade);
                    //descricao endereco
					function endereco(data) {
						$("#cliente_endereco").val(data+' ');
					}
					$.get('processa/dados_cep.php?f=3&cep='+cep, endereco);
				}

            </script>
                <h3 class="w3ls-title w3ls-title1"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=43"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h3>  
				<form action="processa/proc_edit_cliente.php" method="post" name="form_cliente" id="form_cliente">
                    <h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=16"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>  
						<input type="text" class="form-control" id="cliente_nome" name="cliente_nome" 
                            placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=17"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>" 
                            required=""
                            value="<?php echo $linhas['cliente_nome']; ?>"
                        >
                    <h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=18"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>  
                    	<input type="text" class="form-control" id="cliente_telefone" name="cliente_telefone" 
                            placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=19"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>" 
                            required="" onkeyup="somenteNumeros(this);"
                            value="<?php echo $linhas['cliente_telefone']; ?>"
                        >
					<h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=22"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>  
                    <div style="float: left;">
						<input type="text" class="form-control" id="cep_id" name="cep_id" maxlength="7" minlength="7" 
                            placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=23"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>" 
                            required="" onkeyup="somenteNumeros(this);" 
                            value="<?php echo $linhas['cep_id']; ?>"
                        >
                        </div>
                        <div style="float: left; ">
                        <button type="button" onclick="dadosCep()" class="btn btn-default" aria-label="Left Align"><i class="fa fa-search" aria-hidden="true"> </i></button>
                        </div><br>
                        <div>
                        &nbsp;&nbsp;
                        </div><br>
					<h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=24"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4> 
                    	<input type="text" class="form-control" id="provincia_descricao" name="provincia_descricao" 
                            placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=23"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>" 
                            required="" disabled
                        >
                    <h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=25"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>  
                    	<input type="text" class="form-control" id="cidade_descricao" name="cidade_descricao" 
                            placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=23"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>" 
                            required="" disabled
                        >
                    <h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=26"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>  
						<input type="text" class="form-control" id="cliente_endereco" name="cliente_endereco" 
                            placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=27"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>" 
                            required=""
                            value="<?php echo $linhas['cliente_endereco']; ?>"
                        >
					<h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=13"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>  
						<input type="email" class="form-control" id="cliente_email" name="cliente_email" 
                            placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=14"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>" 
                            required="" disabled
                            value="<?php echo $linhas['cliente_email']; ?>"
                        >
                    <h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=28"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>  
						<input type="password" name="cliente_password" id="cliente_password" class="form-control" 
                            placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=28"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>" 
                        >
                    <?php 
                    $query =mysqli_query($connection,"SELECT * FROM empresa WHERE id=1"); 
                    $line = mysqli_fetch_assoc($query)
						
					?>
					<h4><?php echo $line["empresa_titulo_privacidade_".$msg_idioma]; ?></h4>  
					<textarea rows="10" readonly class="form-control" style="text-align: justify;">
						<?php echo $line["empresa_texto_privacidade_".$msg_idioma];?>
					</textarea>
                    <br>
                    <div class="container">
					    <h4><label class="checkbox"><input type="checkbox" name="checkbox_privacidade" required=""><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=132"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></label></h4>
					</div>
                    <div class="container">
                        <h4><label class="checkbox"><input type="checkbox" name="checkbox_get_ofers" checked><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=139"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></label></h4>
					</div>
                    <br>
					<script>
						function verificaCliente()	{ 
							if (form_cliente.checkbox_privacidade.checked && form_cliente.cliente_nome.value!="" && form_cliente.cliente_telefone.value!="" && form_cliente.cep_id.value!="" && form_cliente.cliente_endereco.value!="" && form_cliente.cliente_email.value!="" && form_cliente.cliente_password.value!="")	{
								document.getElementById('blanket').style.display = 'block';
								document.getElementById('aguarde').style.display = 'block';
								document.cliente.submit();
							}
						}
					</script>

					<input type="submit" onclick="verificaCliente();" value="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=44"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>">
                    <input type="hidden" name="id" value="<?php echo $linhas['id']; ?>">
                </form>
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