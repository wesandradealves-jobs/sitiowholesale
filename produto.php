<?php
session_start();
include_once("conexao.php");
$produto = $_GET['id'];

// selecionar somente se o produto nao estiver bloqueado
$query =mysqli_query($connection,"SELECT 	a.*, 
											a.situacao_id as situacao, 
											b.*, 
											(SELECT id 
											   FROM imagem_produto 
											  WHERE produto_id=b.id
												AND imagem_sequencia=1) as imagem
									FROM 	(select * from produto_itens where situacao_id <> 3) a,
											produtos b
									WHERE a.produto_id = b.id 
									  AND b.id=$produto
								 GROUP BY a.produto_id");
while($line = mysqli_fetch_assoc($query)){
    $produto_descricao      = $line["produto_descricao_".$msg_idioma]; 
    $produto_descricao_curta= $line["produto_descricao_curta_".$msg_idioma];
    $produto_descricao_longa= $line["produto_descricao_longa_".$msg_idioma];
    $produto_codigo_cliente = $line["produto_codigo_cliente"];  
	$produto_preco_venda    = $line["produto_preco_venda"]; 
	$produto_resfriado		= $line["produto_resfriado"]; 
	$produto_congelado		= $line["produto_congelado"]; 	
	$produto_link_youtube	= $line["produto_link_youtube"]; 
} 
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $produto_descricao;?></title><meta name="description" content="<?php echo $produto_descricao;?>" />
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

<!--flex slider-->
<script defer src="js/jquery.flexslider.js"></script>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<script>
	// Can also be used with $(document).ready()
	$(window).load(function() {
	  $('.flexslider').flexslider({
		animation: "slide",
		controlNav: "thumbnails"
	  });
	});
</script>
<!--flex slider-->
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
	
	<!-- products -->
	<div class="products">	 
		<div class="container">  
			<div class="single-page">
				<div class="single-page-row" id="detail-21">
					<div class="col-md-6 single-top-left">	
						<div class="flexslider">
							<ul class="slides">
                                <?php
                                    $query =mysqli_query($connection,"SELECT * FROM imagem_produto WHERE produto_id=$produto order by imagem_sequencia limit 4");
                                    while($line = mysqli_fetch_assoc($query)){ 
                                ?>
                                    <li data-thumb="adm/imagens/<?php echo $line["id"];?>.jpg">
                                        <div class="thumb-image detail_images"> <img src="adm/imagens/<?php echo $line["id"];?>.jpg" data-imagezoom="true" class="img-responsive" alt=""> </div>
                                    </li>
                                <?php
                                    } 
                                ?>
							</ul>
						</div>
					</div>
					<div class="col-md-7 single-top-right">
						<h3 class="item_name"><?php echo $produto_descricao;?></h3>
						<p>#<?php echo $produto_codigo_cliente;?></p>
                        <p><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=76"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> </p><br>
						<span><?php echo nl2br($produto_descricao_curta);?></span><br>

						<form action="">
							<!-- //radio button cor -->
							<?php
							$query =mysqli_query($connection,"SELECT *, (select cor_html from cor where id = cor_id) as cor_html, (select cor_descricao_".$msg_idioma." from cor where id = cor_id) as cor_descricao FROM produto_itens WHERE produto_id=$produto AND situacao_id <> 3 group by cor_id order by id,tamanho_id");
							$primeiro = 1;
							$id_cor = 100;
							while($line = mysqli_fetch_assoc($query)){
								//preco do produto
								if ($line['produto_item_preco_venda'] > 0){ //pega o preço da tabela produto_itens
									$preco = $line['produto_item_preco_venda'];
								} else { // se nao tiver no produto itens, pega o preço da tabela produtos
									$preco = $produto_preco_venda;
								}

/*								//produto resfriado e/ou congelado
								$query2 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=79"); while($line2 = mysqli_fetch_assoc($query2)){ $resfriado = $line2["mensagem"]; }
								$query2 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=80"); while($line2 = mysqli_fetch_assoc($query2)){ $congelado = $line2["mensagem"]; }
								//script que altera o tipo de caixa quando selecionar o radio button
								$tipo_resfriado ='';
								$tipo_congelado ='';
								echo "<script>
										function resfriado() {
											$('#caixa').text('$resfriado');
											$('#resfriado_congelado').val('.0');
											return false;  
										}
										function congelado() {
											$('#caixa').text('$congelado');
											$('#resfriado_congelado').val('.1');
											return false;  
										}
									 </script>";
								
								if ($produto_resfriado && $produto_congelado){ //produto resfriado e congelado
									echo "	<input type='radio' onclick='resfriado()' name='gender' value='male' checked> $resfriado
											<input type='radio' onclick='congelado()' name='gender' value='male'> $congelado
											<br><br>";
											$tipo_resfriado = '.0';
											echo "<script> 
													$(document).ready(function(){
														$('#caixa').text('$resfriado');
														$('#resfriado_congelado').val('".$tipo_resfriado."');
													});
												 </script>";

								} else if ($produto_resfriado)  { //produto resfriado
									echo "	<input type='radio' onclick='resfriado()' name='gender' value='resfriado' checked> $resfriado
											<br><br>";
											$tipo_resfriado = '.0';
											echo "<script> 
													$(document).ready(function(){
														$('#caixa').text('$resfriado');
														$('#resfriado_congelado').val('".$tipo_resfriado."');														
													});
												 </script>";
								} else if ($produto_congelado)  { //produto congelado
									echo "	<input type='radio' onclick='congelado()' name='gender' value='congelado' checked> $congelado
											<br><br>";
											$tipo_congelado = '.1';
											echo "<script> 
													$(document).ready(function(){
														$('#caixa').text('$congelado');
														$('#resfriado_congelado').val('".$tipo_congelado."');
													}); 
												 </script>";
								}
*/
								//preco do primeiro item (sempre procura preço por tamanho e cor, se nao encontrar ele procura o preco padrao)
								if ($primeiro==1) {
									if ($line['produto_item_preco_venda'] > 0){ //pega o preço da tabela produto_itens
										echo "	<div class='single-price'>
													<ul>
														<li><strong id='preco'>".$line['produto_item_preco_venda']." 円</strong></li> 
													</ul>	
												</div> ";
									} else { // se nao tiver no produto itens, pega o preço da tabela produtos
										echo "	<div class='single-price'>
													<ul>
														<li><strong id='preco'>$produto_preco_venda 円</strong></li>  
													</ul>	
												</div> ";
									}
									//coloca a informacao do produto que entrou 
									//$('#resfriado_congelado').val('".$tipo_congelado."".$tipo_resfriado."');
									echo "<script> 
											$(document).ready(function(){
												$('#id_produto').text('".$line['id']."');
												$('#prd_notificacao').val('".$line['id']."');
												$('#idprod').val('".$line['id']."');												
												$('#cor').text('".$line['cor_descricao']."');
												$('#w3ls_item').val('".$produto_descricao." ".$line['cor_descricao']."');
											});
										  </script>";

									if ($line['situacao_id']>1){
										echo "<script>
												$(document).ready(function(){
													notify(); 
												});
											  </script>";
									}

								}
								
								$query2 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=81"); while($line2 = mysqli_fetch_assoc($query2)){ $mensagem = $line2["mensagem"]; }
								$id_cor = $id_cor+1; //conta mais um para saber que mudou a cor do produto, se entrar novamente no loop é por que tem mais cores
								if ($line["cor_id"] && $line["grade_id"] > 1){
									if ($primeiro==1) {
										echo "<p><h3 class='item_name'>$mensagem</h3></p>";
										echo "<label class='radios' onclick='mostrartamanhos".$id_cor."()' ><input type='radio' name='color' value='".$line['produto_id']."' checked>";
									} else {
										echo "<label class='radios' onclick='mostrartamanhos".$id_cor."()' ><input type='radio' name='color' value='".$line['produto_id']."'>";
									}
									echo "		<div class='layer'></div>
												<div class='button'style='background-color: ".$line['cor_html'].";'><span></span></div>
												</label>";
									
									//gera o scrip para vincular a cor do produto a grade
									echo 	"<script>
												$(document).ready(function() {
													document.getElementById(101).style.display = 'block';
												});

												function mostrartamanhos".$id_cor."() {
													escondertamanhos();
													document.getElementById(".$id_cor.").style.display = 'block'; 
													return false;  
												}
											</script>";
								} else if ($line["cor_id"]){
									if ($primeiro==1) {
										echo "	<p><h3 class='item_name'>$mensagem</h3></p>";
										if ($line['situacao_id']==1){
											echo "<label class='radios' onclick='cart(),produto".$line["id"]."()' ><input type='radio' name='color' value='".$line['produto_id']."' checked>";
										} else {
											echo "<label class='radios' onclick='notify(),produto".$line["id"]."()' ><input type='radio' name='color' value='".$line['produto_id']."' checked>";
										}
									} else {
										if ($line['situacao_id']==1){
											echo "<label class='radios' onclick='cart(),produto".$line["id"]."()' ><input type='radio' name='color' value='".$line['produto_id']."'>";
										} else {
											echo "<label class='radios' onclick='notify(),produto".$line["id"]."()' ><input type='radio' name='color' value='".$line['produto_id']."'>";
										}



										
									}
									echo "		<div class='layer'></div>";
									if ($line['situacao_id']==1){
										echo "	<div class='button' onclick='cart()' style='background-color: ".$line['cor_html'].";'><span></span></div>";
									} else {	
										echo "	<div class='button' onclick='notify()' style='background-color: ".$line['cor_html'].";'><span></span></div>";
									}
										echo "</label>";
	
									
									//gera o scrip para vincular a cor do produto a grade
									echo 	"<script>
												function produto".$line['id']."() {
													$('#preco').text('".$preco." 円');
													$('#id_produto').text('".$line['id']."');
													$('#prd_notificacao').val('".$line['id']."');
													$('#idprod').val('".$line['id']."');
													$('#cor').text('".$line['cor_descricao']."');
													$('#w3ls_item').val('".$produto_descricao." ".$line['cor_descricao']."');
													return false;  
												}
											</script>";	
								}

								$primeiro = $primeiro +1; // coloca no segundo item, isso é necessario por que o item 1 é o que fica selecionado
							} 							
							?>
						</form>
						<!-- //radio button cor -->

						<!-- radio button tamanho -->
						<div><div>
							<form action="">
								<?php
								//seleciona os produtos itens
								$query =mysqli_query($connection,"SELECT a.*, (select cor_html from cor where id = a.cor_id) as cor_html, (select cor_descricao_".$msg_idioma." from cor where id = a.cor_id) as cor_descricao  FROM produto_itens a WHERE a.produto_id=$produto AND situacao_id <> 3");
								
								$primeiro = 1; //variavel para identificar que é o primeiro item
								$mudarcor =''; //variavel para identificar que mudou de cor
								$id_cor = 100; //variavel para gerar nome do script que mostra ou esconde os tamanhos

								while($line = mysqli_fetch_assoc($query)){
									//preco do produto
									if ($line['produto_item_preco_venda'] > 0){ //pega o preço da tabela produto_itens
										$preco = $line['produto_item_preco_venda'];
									} else { // se nao tiver no produto itens, pega o preço da tabela produtos
										$preco = $produto_preco_venda;
									}

									//seleciona os tamanhos dos produtos
									$tamanho_id = str_pad($line['tamanho_id'],2,"0",STR_PAD_LEFT);
									$query1 =mysqli_query($connection,"select ".$msg_idioma."_".$tamanho_id." as tamanho from grade_itens where grade_id=".$line['grade_id']." and grade_id > 1"); 
									$tamanho = '';
									while($line1 = mysqli_fetch_assoc($query1)){ 
										$tamanho = $line1['tamanho'];
									}

									//produto com cor e tamanho
									if ($line["cor_id"] && $tamanho){
										//abre a div quando mudar de cor
										if ($line['cor_id'] != $mudarcor ){
											$id_cor = $id_cor+1;
											echo '</div>';	
											$query2 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=90"); while($line2 = mysqli_fetch_assoc($query2)){ $size = $line2["mensagem"]; }
											if ($primeiro==1) {	
												echo "<div id='".$id_cor."'>"; //style='display:none;'
												echo "<p><h3 class='item_name'>$size</h3></p>";
											} else {												
												echo "<div id='".$id_cor."' style='display:none;' >"; //style='display:none;'
												echo "<p><h3 class='item_name'>$size</h3></p>";
											}
											$mudarcor = $line['cor_id'];
										}
										if ($primeiro==1) {	
											if ($line['situacao_id']==1){	
												echo "<label class='radios' onclick='cart();produto".$line["id"]."()' ><input type='radio' name='color' value='".$line['produto_id']."' checked>";										
											} else {
												echo "<label class='radios' onclick='notify();produto".$line["id"]."()' ><input type='radio' name='color' value='".$line['produto_id']."' checked>";										
											}
											$primeiro = $primeiro +1; //marca que o primeiro item ja terminou
											
											echo "<script> 
													$(document).ready(function() {
														$('#id_produto').text('".$line['id']."');
														$('#prd_notificacao').val('".$line['id']."');
														$('#idprod').val('".$line['id']."');
														$('#tamanho').text('".$line['cor_descricao']." - ".$tamanho."');
														$('#w3ls_item').val('".$produto_descricao." ".$line['cor_descricao']." - ".$tamanho."');
													});
												  </script>";
										} else {
											if ($line['situacao_id']==1){											
												echo "<label class='radios' onclick='cart();produto".$line["id"]."()' ><input type='radio' name='color' value='".$line['produto_id']."'>";
											} else {
												echo "<label class='radios' onclick='notify();produto".$line["id"]."()' ><input type='radio' name='color' value='".$line['produto_id']."'>";
											}
											}
											echo "		<div class='layer'></div>";
											if ($line['situacao_id']==1){
												echo "	<div class='button' onclick='cart()'><span>".$tamanho."</span></div>";
											} else {
												echo "	<div class='button' onclick='notify()' style='background-color: #999999;'><span>".$tamanho."</span></div>";
											}
											echo "	  </label>";

											echo 	"<script>
														function produto".$line['id']."() {
															$('#preco').text('".$preco." 円');
															$('#id_produto').text('".$line['id']."');
															$('#prd_notificacao').val('".$line['id']."');
															$('#idprod').val('".$line['id']."');
															$('#tamanho').text('".$line['cor_descricao']." - ".$tamanho."');
															$('#w3ls_item').val('".$produto_descricao." ".$line['cor_descricao']." - ".$tamanho."');
															return false;  
														}
													</script>";											

											//fecha a div quando mudar de cor
											if ($line['cor_id'] != $mudarcor ){
												echo '</div>';
										}
									} else if ($tamanho) { // produto que só tem tamanho
										if ($line['situacao_id']==1){
											echo "<form>
											<label class='radios' onclick='cart();produto".$line["id"]."()'>
											<input type='radio' name='color' value='".$line['produto_id']."'>
											<div class='layer'></div>";
										} else {
											echo "<form>
											<label class='radios' onclick='notify();produto".$line["id"]."()'>
											<input type='radio' name='color' value='".$line['produto_id']."'>
											<div class='layer'></div>";
										}										

										if ($line['situacao_id']==1){
											echo "	<div class='button' onclick='cart()'><span>".$tamanho."</span></div>";
										} else {
											echo "	<div class='button' onclick='notify()' style='background-color: #999999;'><span>".$tamanho."</span></div>";
										}
										echo "	  </label>
										</form>";

										echo 	"<script>
													function produto".$line['id']."() {
														$('#preco').text('".$preco." 円');
														$('#id_produto').text('".$line['id']."');
														$('#prd_notificacao').val('".$line['id']."');
														$('#idprod').val('".$line['id']."');
														$('#tamanho').text('".$tamanho."');
														$('#w3ls_item').val('".$produto_descricao." ".$tamanho."');
														return false;  
													}
												</script>";											


									}

								}
								echo '</div>';
								//criar script para esconder todas as divs de 
									echo "<script>
											function escondertamanhos() {";
												for ($i = 101; $i <=$id_cor; $i++) {
													echo "document.getElementById(".$i.").style.display = 'none';";
												}
									echo 		"return false;  
											}
										 </script>";

								?>
							</form>

							<?php 
								//informacoes do produto (id, cor e tamanho)
								 $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=89"); while($line = mysqli_fetch_assoc($query)){ $mensagem = $line["mensagem"]; } 
								echo "	<label>$mensagem</label>: 
										<label id='id_produto'></label> - $produto_descricao 
										<label id='cor'></label> 
										<label id='tamanho'></label>
										<label id='caixa'></label>";
							?>
						</div>
						<!-- //radio button tamanho -->

						<!-- botao notificacao -->
						<script>
							function cart() {
								document.getElementById("notify").style.display = 'none';
								document.getElementById("cart").style.display = 'block';
								return false;  
							}
							function notify() {
								document.getElementById("cart").style.display = 'none';
								document.getElementById("notify").style.display = 'block';
								return false;  
							}
						</script>
						<div id='notify' class="notify" style='display:none;'>
							<form action="notificacao.php" method="post">
							<input type="hidden" id="prd_notificacao" name="prd_notificacao"/> 
							<?php $email_usuario = '';if (isset($_SESSION['clienteEmail'])){$email_usuario=$_SESSION['clienteEmail'];}?>
							<h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=13"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>  
								<input type="email" class="form-control" id="cliente_email" name="cliente_email" 
									placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=14"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>" 
									required=""
									value="<?php echo $email_usuario;?>";
								>
								<button type="submit" class="w3ls-cart" ><i class="fa fa-envelope" aria-hidden="true"></i><?php $query2 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=82"); while($line2 = mysqli_fetch_assoc($query2)){ echo $line2["mensagem"]; } ?></button>
							</form>
						<!--// botao notificacao -->
						</div>

						<!-- botao cart -->
						<div id='cart'>
							<br>
							<label><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=91"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></label>
							<br>
							<form action="#" method="post">
								<div style="float: left; width: 75px;"><input class="form-control" type="number" id="quantidade" name="quantidade" value="1"/></div>
								<div style="float: left; width: 300px;">&nbsp;
								<input type="submit" name="add" id="adicionar" class="w3ls-cart" onclick="<?php echo $loading;?>" value="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=92"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>"></div>
								<input type="hidden" id="acao" name="acao" value="add"/> 
								<input type="hidden" id="idprod" name="idprod"/>
								<input type="hidden" id="token" name="token" value="<?php echo strtotime($now);?>"/> 
								<input type="hidden" id="resfriado_congelado" name="resfriado_congelado"/>
							</form>
						<!--// botao cart -->
						</div>
						<p class="text-danger">
							<?php
								if(isset($_SESSION['notificacao'])){
									echo "<strong>".$_SESSION['notificacao']."</strong>";
									unset($_SESSION['notificacao']);
								}
							?>
						</p>
					</div>
				   <div class="clearfix"> </div>  
				</div>
            </div>

			<!-- collapse-tabs -->
			<div class="collpse tabs">
				<h3 class="w3ls-title"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=77"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h3> 
				<div class="panel-group collpse" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<a class="pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="fa fa-file-text-o fa-icon" aria-hidden="true"></i> <?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=78"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> <span class="fa fa-angle-down fa-arrow" aria-hidden="true"></span> <i class="fa fa-angle-up fa-arrow" aria-hidden="true"></i>
								</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
                        		<?php echo nl2br($produto_descricao_longa);?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- //collapse --> 

			<!-- video --> 
			<?php 
				if ($produto_link_youtube) { 
			?>
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src='<?php echo "https://www.youtube.com/embed/$produto_link_youtube?rel=0";?>' allowfullscreen></iframe>
					</div>
			<?php 
				} 
			?>
			<!-- video --> 

		</div>
	</div>
	<!--//products-->  

	<!-- all footers -->
	<div id="footers">
		<?PHP    
	  		include "footers.php"; 
	  	?>
	</div>
	<!-- //all footers -->
</body>
</html>