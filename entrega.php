<?php
    session_start();
    include_once("seguranca.php");
    include_once("conexao.php");

    if (count($_SESSION['carrinho']) == 0){
        header("Location: index.php");
    }

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
        <h3 class="w3ls-title w3ls-title1"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=101"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h3>  
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

                //carregar meu endereco quando selecionar o radio
                function meuEndereco() {
                    $('#cliente_nome').val('<?php echo $linhas['cliente_nome']; ?>');
                    $('#cliente_telefone').val('<?php echo $linhas['cliente_telefone']; ?>');
                    $('#cep_id').val('<?php echo $linhas['cep_id']; ?>');
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
                    $('#cliente_endereco').val('<?php echo $linhas['cliente_endereco']; ?>');
                }
                //limpar endereco quando selecionar o radio
                function enderecoDiferente() {
                    $('#cep_id').val('');
					dadosCep();
                }
            </script>
  				<form action="processa/proc_endereco_entrega.php" method="post">
                    <h4><input type='radio' onclick='meuEndereco()' id='alterar_endereco' value='0' name='alterar_endereco' checked> <?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=112"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>
					    <input type='radio' onclick='enderecoDiferente()' id='alterar_endereco' value='1' name='alterar_endereco'> <?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=113"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> 
                    </h4><br>
                    <h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=16"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>  
						<input type="text" class="form-control" id="cliente_nome" name="cliente_nome" 
                            placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=17"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>" 
                            required=""
                            value="<?php echo $linhas['cliente_nome']; ?>";
                        >
                    <h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=18"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>  
                    	<input type="text" class="form-control" id="cliente_telefone" name="cliente_telefone" 
                            placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=19"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>" 
                            required="" onkeyup="somenteNumeros(this);"
                            value="<?php echo $linhas['cliente_telefone']; ?>";
                        >
 					<h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=22"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>  
                        <div style="float: left; ">
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
                            value="<?php echo $linhas['cliente_endereco']; ?>";
                        >
						<input type="submit" value="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=104"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>">
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