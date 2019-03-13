<div class="container"><br></div>

<!-- footer-top -->
	<div class="w3agile-ftr-top">
		<div class="container">
			<div class="ftr-toprow">
				<div class="col-md-4 ftr-top-grids">
					<div class="ftr-top-left">
						<i class="fa fa-truck" aria-hidden="true"></i>
					</div> 
					<div class="ftr-top-right">
						<h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=48"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>
						<p style="color:#FFFFFF;"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=49"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></p>
					</div> 
					<div class="clearfix"> </div>
				</div> 
				<div class="col-md-4 ftr-top-grids">
					<div class="ftr-top-left">
						<i class="fa fa-user" aria-hidden="true"></i>
					</div> 
					<div class="ftr-top-right">
						<h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=50"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>
						<p style="color:#FFFFFF;"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=51"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></p>
					</div> 
					<div class="clearfix"> </div>
				</div>
				<div class="col-md-4 ftr-top-grids">
					<div class="ftr-top-left">
						<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
					</div> 
					<div class="ftr-top-right">
						<h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=52"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>
						<p style="color:#FFFFFF;"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=53"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></p>
					</div>
					<div class="clearfix"> </div>
				</div> 
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //footer-top --> 


	<div class="clearfix"> </div>
	<!-- recommendations -->
	<div class="recommend">
		<div class="container">
		<h3 class="w3ls-title"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=131"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h3> 
		<script>
		$(document).ready(function(){
		$('.carousel[data-type="multi"] .item').each(function(){
		var next = $(this).next();
		if (!next.length) {
			next = $(this).siblings(':first');
		}
		next.children(':first-child').clone().appendTo($(this));
		
		for (var i=0;i<4;i++) {
			next=next.next();
			if (!next.length) {
				next = $(this).siblings(':first');
			}
			
			next.children(':first-child').clone().appendTo($(this));
		}
		});
		});
		</script>
		<script src="css/owl.carousel.css"></script>

		<?php
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
													AND a.situacao_id = '1'
													GROUP BY a.produto_id
													ORDER BY RAND() limit 10");
		?>

		<div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="5000" id="myCarousel">
			<div class="carousel-inner">

				<?php
					$primeiro = " active";
					while($dados1 = mysqli_fetch_assoc($resultado1)){

				?>
					<div class="item<?php echo $primeiro;?>">
						<div class="col-md-2 col-sm-6 col-xs-12">
							<a href="produto.php?id=<?php echo $dados1["produto_id"];?>" onclick="<?php echo $loading;?>">
								<div class="imagem">
									<img src="adm/imagens/<?php echo $dados1["imagem"]; ?>.jpg" class="img-responsive">
								</div>

									<div class="agile-product-text">              
										<h6 align="center"><?php echo $dados1["produto_descricao_".$msg_idioma]; ?></h6>
										<h4 align="center"><?php echo $dados1["produto_preco_venda"]; ?> 円</h4>
									</div>

							</a>
						</div>
					</div>
				<?php
						$primeiro = "";
					}?>
			</div>	

		<a class="left carousel-control-sug" style="float:left; font-size: 25px;" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-backward"></i></a>
		<a class="right carousel-control-sug" style="float:right; font-size: 25px;" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-forward"></i></a>
		</div>
	</div>

	<!-- subscribe -->
	<div class="subscribe"> 
		<div class="container">
			<div class="col-md-6">
				<?php $email_usuario = '';if (isset($_SESSION['clienteEmail'])){$email_usuario=$_SESSION['clienteEmail'];}?>
				<form action="processa/email_entrar_lista.php" method="post">
					<div class="col-sm-6 pull-right">
						<div class="input-group">
							<h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=139"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4> 
						</div>
						<div class="input-group">
							<input type="email" class="form-control" id="lista_email" name="lista_email" 
								placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=14"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>" 
								required=""
								value="<?php echo $email_usuario;?>";
							>
							<span class="input-group-btn">
								<button class="btn btn-default"><i class="fa fa-envelope" aria-hidden="true"></i></button>
							</span>
						</div>
					</div>
				</form>
			</div>


			<div class="col-md-6">
				<div class="col-sm-6 social-icons pull-left">
				<h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=54"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h4>  
					<ul>
						<li><a href="http://<?php $query =mysqli_query($connection,"SELECT empresa_facebook FROM empresa WHERE id=1"); $line = mysqli_fetch_assoc($query); echo $line["empresa_facebook"];  ?>" class="fa fa-facebook icon facebook" target="_blank"></a></li>
					</ul> 
				</div>
			</div> 
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //subscribe --> 
	<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="footer-info w3-agileits-info">
				<div class="col-md-4 address-left agileinfo">
					<div class="footer-logo header-logo">
						<h2><a href="index.php" onclick="<?php echo $loading;?>"><img src="images/logo.png" style="width: 190px;"/></a></h2>
					</div>
					<ul>
						<li><i class="fa fa-map-marker"></i> <?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=55"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></li>
						<li><i class="fa fa-mobile-phone"></i> <?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=71"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> </li>
						<li><i class="fa fa-phone"></i> <?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=56"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> </li>
						<?php $query =mysqli_query($connection,"SELECT empresa_email_contato FROM empresa WHERE id=1"); $line = mysqli_fetch_assoc($query); $empresa_email_contato = $line["empresa_email_contato"];  ?>
						<li><i class="fa fa-envelope-o"></i> <a href="mailto:<?php echo $empresa_email_contato; ?>"> <?php echo $empresa_email_contato; ?></a></li>
					</ul> 
				</div>
				<div class="col-md-8 address-right">
					<div class="col-md-4 footer-grids">
						<h3><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=59"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h3>
						<ul>
							<li><a href="sobre.php" onclick="<?php echo $loading;?>"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=60"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></a></li>
							<!-- <li><a href="marketplace.php" onclick="<?php echo $loading;?>"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=61"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></a></li>  -->
							<li><a href="politica_privacidade.php" onclick="<?php echo $loading;?>"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=62"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></a></li>
							<li><a href="contato.php" onclick="<?php echo $loading;?>"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=2"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></a></li>
						</ul>
					</div>
					<div class="col-md-4 footer-grids">
						<h3><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=63"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h3>
						<ul>
							<input type='hidden' id='vapara' name='vapara' value='pedidos.php'/>

							<?php if((!isset($_SESSION['clienteId'])) || (!isset($_SESSION['clienteNome'])) || (!isset($_SESSION['clienteEmail'])) || (!isset($_SESSION['clienteSenha']))){ ?>  
									<script type="text/javascript">
										function submitform() {
											if(document.pedidosphp.onsubmit && !document.pedidosphp.onsubmit()){
												return;
											}
											document.pedidosphp.submit();
										}
									</script>
									<form name="pedidosphp" action="login.php" method="post">
										<li><a href="javascript: submitform()" onclick="<?php echo $loading;?>"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=65"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></a></li>
										<input type='hidden' id='vapara' name='vapara' value='pedidos.php'/>
									</form>
							<?php } else {?>
									<li><a href="pedidos.php" onclick="<?php echo $loading;?>"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=65"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></a></li>
							<?php }?>
							<li><a href="politica_troca.php" onclick="<?php echo $loading;?>"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=64"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></a></li> 
							<li><a href="politica_frete.php" onclick="<?php echo $loading;?>"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=129"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></a></li>
						</ul> 
					</div>
					<div class="col-md-4 footer-grids">
						<h3><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=66"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h3>
						<ul>
							<li><i class="fa fa-credit-card" style="color:#fff" aria-hidden="true"></i> <a href="#"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=67"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></li>
							<li><i style="color:#fff" aria-hidden="true">￥</i> <a href="#"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=123"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></li>
						</ul> 
						<br>
						<h3><?php $query =mysqli_query($connection,"SELECT * FROM mensagens WHERE id=134"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem_ingles"].' / '. $line["mensagem_japones"]; } ?></h3>
						<a href="japones.php" onclick="<?php echo $loading;?>"> <img src="images/japao.jpg"> </a>
						<a href="ingles.php" onclick="<?php echo $loading;?>"> <img src="images/eua.jpg"/> </a>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
        <!-- //footer -->		
        <div class="copy-right"> 
            <div class="container">
                <p>© <?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=69"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></p>
				<a href="https://www.appudata.com" target="_blank"><?php if ($msg_idioma=='ingles') {$query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=68"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; }} ?> <strong>AppuData <?php if ($msg_idioma=='japones') {$query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=68"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; }} ?></strong></a>
            </div>
		</div> 
	</div>
</div>

<!-- countdown.js -->	
<script src="js/jquery.knob.js"></script>
<script src="js/jquery.throttle.js"></script>
<script src="js/jquery.classycountdown.js"></script>
	<script>
		$(document).ready(function() {
			$('#countdown1').ClassyCountdown({
				end: '1388268325',
				now: '1387999995',
				labels: true,
				style: {
					element: "",
					textResponsive: .5,
					days: {
						gauge: {
							thickness: .10,
							bgColor: "rgba(0,0,0,0)",
							fgColor: "#1abc9c",
							lineCap: 'round'
						},
						textCSS: 'font-weight:300; color:#fff;'
					},
					hours: {
						gauge: {
							thickness: .10,
							bgColor: "rgba(0,0,0,0)",
							fgColor: "#05BEF6",
							lineCap: 'round'
						},
						textCSS: ' font-weight:300; color:#fff;'
					},
					minutes: {
						gauge: {
							thickness: .10,
							bgColor: "rgba(0,0,0,0)",
							fgColor: "#8e44ad",
							lineCap: 'round'
						},
						textCSS: ' font-weight:300; color:#fff;'
					},
					seconds: {
						gauge: {
							thickness: .10,
							bgColor: "rgba(0,0,0,0)",
							fgColor: "#f39c12",
							lineCap: 'round'
						},
						textCSS: ' font-weight:300; color:#fff;'
					}

				},
				onEndCallback: function() {
					console.log("Time out!");
				}
			});
		});
	</script>
<!-- //countdown.js -->
<!-- menu js aim -->
<script src="js/jquery.menu-aim.js"> </script>
<script src="js/main.js"></script>
<!-- Resource jQuery -->
<!-- //menu js aim --> 
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster --> 	