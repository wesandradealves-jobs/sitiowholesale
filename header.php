<?php
include_once("adm/loading.php");

	//rotina do carrinho de compra	
	if (!isset($_SESSION['carrinho'])){
		$_SESSION['carrinho'] = array();
	}


	if (isset($_POST['acao'])){
		if (isset($_POST['quantidade'])){
			$quantidade = $_POST['quantidade'];
		}	
		//adicionar carrinho
		if (isset($_POST['token'])){
			$token = $_POST['token'];
		} else {
			$token = 1;
		}
	
		if (!isset($_SESSION['token'])){
			$_SESSION['token'] = 1;
		}
		if ($token != $_SESSION['token']){
			$_SESSION['token'] = $token;
			if ($_POST['acao'] == 'add' && $quantidade > 0){
				if (isset($_POST['resfriado_congelado'])){ //resfriado .0 congelado .1 
					$idprod = intval($_POST['idprod']).''.$_POST['resfriado_congelado'];
				} else {
					$idprod = intval($_POST['idprod']);	
				}
				if (!isset($_SESSION['carrinho'][$idprod])){ // se nao existir o produto no carrinho adiciona
					$_SESSION['carrinho'][$idprod] = $quantidade;
				} else { // se existir o produto soma
					$_SESSION['carrinho'][$idprod] += $quantidade;
				}
			}
		}

		//remover do carrinho
		if ($_POST['acao'] == 'del'){
			$idprod = $_POST['idproddel'];	
			if (isset($_SESSION['carrinho'][$idprod])){ // se existir o produto no carrinho
				unset($_SESSION['carrinho'][$idprod]);
			}
		}
		
		//abre o carrinho de compra quando deleta ou inclui algum item
		if (!isset($_POST['abrircart'])){
			echo "	
				<script> 
					$(document).ready(function(){
						$('#div_carrinho').modal('show')														
					});
				</script>";
		}
	}
	

	//print_r($_SESSION['carrinho']);

	//coloca a quantidade total no circulo vermelho do carrinho
	$qtTotal=0;
	if (isset($_SESSION['carrinho'])){ //calcula a quantidade total
		foreach($_SESSION['carrinho'] as $idprod => $qt){
			$qtTotal=$qtTotal+$qt;
		}
	}
	if ($qtTotal > 0){ // se for maior que zero torna visivel e mostra a quantidade
		echo "<script> 
				$(document).ready(function(){
					document.getElementById('qt_cart').style.display = 'block'; 
					$('#qttotal').text('$qtTotal');
				});
			  </script>";
	} else { //se nao esconde a quantidade
		echo "<script> 
				$(document).ready(function(){
					document.getElementById('qt_cart').style.display = 'none'; 
				});
			  </script>";		
	}
?>

<div class="header">
	<div class="w3ls-header"> 

		<div class="clearfix"> </div> 
	</div>
	<div class="header-two">
		<div class="container">
			<div class="header-logo">
				<br>
				<h1><a href="index.php" onclick="<?php echo $loading;?>"><img class="logo" src="images/logo.png"/></a></h1>
			</div>	

			<script type="text/javascript">
				function local(){
					location.href="contato.php"
				}
				function usuario(){
					location.href="login.php"
				}
				function usuarioEditar(){
					location.href="dados_cliente.php"
				}
			</script>
			<div class="header-cart"> 
				<button class="w3view-cart" data-toggle="modal" data-target="#div_carrinho" type="hidden"><i class="fa fa-shopping-cart" aria-hidden="true"></i><br><span class="top-button-title"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=12"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></span><div id="cart0"><div id="qt_cart" style='display:none;'><h6 id="qttotal"></h6></div></div></button>
				<div class="clearfix"> </div> 
			</div> 
			<div class="header-cart"> 
				<button class="w3view-cart" type="text" value="" onclick="local(); <?php echo $loading;?>"><i class="fa fa-envelope" aria-hidden="true"></i><br><span class="top-button-title"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=11"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></span></button>
				<?php //se nao estiver logado
				if((!isset($_SESSION['clienteId'])) || (!isset($_SESSION['clienteNome'])) || (!isset($_SESSION['clienteEmail'])) || (!isset($_SESSION['clienteSenha']))){ 
					$query =mysqli_query($connection,'SELECT mensagem_'.$msg_idioma.' as mensagem FROM mensagens WHERE id=37'); while($line = mysqli_fetch_assoc($query)){ $botao = $line['mensagem']; }
					$add_loading = '"'.$loading.' usuario();"';
					echo "<button class='w3view-cart' type='hidden' name='submit'  value='' onclick=$add_loading><i class='fa fa-user' aria-hidden='true'></i><br><span class='top-button-title'>".$botao."</span></button>";
				} else { // se estiver logado
					$add_loading = '"'.$loading.' usuarioEditar();"';
					$query =mysqli_query($connection,'SELECT mensagem_'.$msg_idioma.' as mensagem FROM mensagens WHERE id=1'); while($line = mysqli_fetch_assoc($query)){ $botao = $line['mensagem']; }
					echo "<button class='w3view-cart' type='hidden' name='submit'  value='' onclick=$add_loading><i class='fa fa-user' aria-hidden='true'></i><br><span class='top-button-title'>".$botao."</span></button>";
				}
				?>
				<div class="clearfix"> </div> 
			</div> 
		</div>		
	</div>

	<!-- carrinho -->
	<div id="div_carrinho" class="modal fade" role="dialog">
		<div class="container">
			<div class="login-page">
				<div class="dados-body" >
				<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="w3ls-title w3ls-title1"><strong><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=93"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></strong></h3>
						<table class="table">
							<?php
							if (count($_SESSION['carrinho']) == 0){ //se nao tiver itens no carrinho abre mostra a msg de sem produtos 
								$query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=94"); while($line = mysqli_fetch_assoc($query)){ $mensagem = $line["mensagem"]; } 
								echo "<tr align='center'><td colspan='5'><h3>$mensagem</h3></td></tr>";
							} else { //se tiver produtos monta a tabela
							?>
								<thead>
									<tr>
										<th><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=95"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>
										<th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=96"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>	
										<th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=97"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>		
										<th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=102"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>
										<th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=98"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>		
									</tr>
								</thead>
								<tbody>
									<?php 
										$total = 0;

											foreach($_SESSION['carrinho'] as $id => $qtd){
												$tpembalagem='';
												if (isset(explode('.', $id)[1])){ // se o produto for congelado ou resfriado
													$tpembalagem = $id;
													$id = explode('.', $id)[0];
													$tpembalagem = explode('.', $tpembalagem)[1];
													//pega o dado de resfriado ou congelado para colocar na descricao do produto
													if ($tpembalagem == 0){
														$embalagem ='0';
														$query2 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=79"); while($line2 = mysqli_fetch_assoc($query2)){ $tpembalagem = $line2["mensagem"]; }
													} else if ($tpembalagem == 1){
														$embalagem ='1';
														$query2 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=80"); while($line2 = mysqli_fetch_assoc($query2)){ $tpembalagem = $line2["mensagem"]; }
													}
												}

												$query =mysqli_query($connection,"SELECT 	a.*, 
																	a.situacao_id as situacao, 
																	b.*,
																	(select cor_descricao_$msg_idioma from cor where id = cor_id) as cor_descricao,
																	(select case 
																				when a.tamanho_id = 1 then ".$msg_idioma."_01
																				when a.tamanho_id = 2 then ".$msg_idioma."_02
																				when a.tamanho_id = 3 then ".$msg_idioma."_03
																				when a.tamanho_id = 4 then ".$msg_idioma."_04
																				when a.tamanho_id = 5 then ".$msg_idioma."_05
																				when a.tamanho_id = 6 then ".$msg_idioma."_06
																				when a.tamanho_id = 7 then ".$msg_idioma."_07
																				when a.tamanho_id = 8 then ".$msg_idioma."_08
																				when a.tamanho_id = 9 then ".$msg_idioma."_09
																				when a.tamanho_id = 10 then ".$msg_idioma."_10
																			end as tamanhos
																	from grade_itens where grade_id=a.grade_id and grade_id > 1) as tamanho
															FROM 	(select * from produto_itens where situacao_id <> 3) a,
																	produtos b
															WHERE a.produto_id = b.id 
															AND a.id=$id");
												$ln = mysqli_fetch_assoc($query);
												$descricao = $ln['produto_descricao_'.$msg_idioma];
												$cor       = $ln['cor_descricao'];
												$tamanho   = $ln['tamanho'];
												$preco     = 0;
												$sub       = 0;
												if ($ln['produto_item_preco_venda'] > 0){ //pega o preço da tabela produto_itens
													$preco = str_replace('.','',$ln['produto_item_preco_venda']);
													$preco = str_replace(',','',$preco);
												} else { // se nao tiver no produto itens, pega o preço da tabela produtos
													$preco = str_replace('.','',$ln['produto_preco_venda']);
													$preco = str_replace(',','',$preco);
												}
												$sub       = $preco * $qtd;
												$total     += $sub; 
												$sub       = number_format($sub,0,',',',');
												$preco     = number_format($preco,0,',',',');
												if ($tpembalagem){
													$id=$id.'.'.$embalagem;
												}
												echo "  <tr>
															<td align='left'><a href='produto.php?id=".$ln['produto_id']."' onclick='".$loading."'>$descricao $cor $tamanho $tpembalagem</a></td>
															<td align='right'>$preco 円</td>
															<td align='right'>$qtd</td>
															<td align='right'>
																<form action='#' method='post'>
																	<button class='w3view-cart' type='hidden' name='submit'><i class='fa fa-times-circle-o' style='font-size:25px;color:red;' aria-hidden='true' onclick=";	echo '"'.$loading.'"'; echo "></i></button>
																	<input type='hidden' id='acao' name='acao' value='del'/> 
																	<input type='hidden' id='idproddel' name='idproddel' value='$id'/> 
																</form>
															</td>
															<td align='right'>$sub 円</td>
														</tr>";
											}
											$total = number_format($total,0,',',',');
											$query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=99"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
											echo "<tr>
														<td colspan='5'><h3>$msgTotal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$total 円</h3></td>

												</tr>
								</tbody>";
							}
							?>
						</table>
						<input type="submit" data-dismiss="modal" value="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=103"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>">

						<?php 
							if (count($_SESSION['carrinho']) > 0){
								if((!isset($_SESSION['clienteId'])) || (!isset($_SESSION['clienteNome'])) || (!isset($_SESSION['clienteEmail'])) || (!isset($_SESSION['clienteSenha']))){ ?>  
									<form action="login.php" method="post">
										<input type='hidden' id='vapara' name='vapara' value='review.php' onclick="<?php echo $loading;?>"/>
							<?php } else {?>
									<form action="review.php" method="post">
							<?php }?>
										<input type="submit" onclick="<?php echo $loading;?>" value="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=100"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>">
									</form>
						<?php }?>
					</div>  
				</div>
			</div>
		</div>
	</div>
	<!-- //carrinho --> 

	<div class="header-three">
		<div class="container">
			<div class="menu">
				<div class="cd-dropdown-wrapper" >
					<a class="cd-dropdown-trigger" href="#0"><span class="glyphicon glyphicon-menu-hamburger"></span> <?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=6"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> </a>
					<nav class="cd-dropdown" > 
						<a href="#0" class="cd-close"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=10"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></a>
						<ul class="cd-dropdown-content"> 
						<!-- 	<li><a href="offers.html">Today's Offers</a></li> -->

							<?php 
								$resultado =mysqli_query($connection,"SELECT * FROM departamentos WHERE id > 1 order by id");
								while($dados = mysqli_fetch_assoc($resultado)){
									$departamento_id = $dados["id"];
									?>
										<li class="has-children">
											<a href="#"><?php echo $dados["departamento_descricao_".$msg_idioma];?></a> 
											<ul class="cd-secondary-dropdown is-hidden">
												<li class="go-back"><a href="#"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=9"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></a></li>

												<?php 
													$resultado1 =mysqli_query($connection,"SELECT * FROM categorias WHERE departamento_id = $departamento_id order by id");
													while($dados1 = mysqli_fetch_assoc($resultado1)){
														$categoria_id = $dados1["id"];
														?>
														<li class="has-children">
															<a href="#"><?php echo $dados1["categoria_descricao_".$msg_idioma];?></a>
															<ul class="is-hidden"> 												
																<li class="go-back"><a href="#">Return</a></li>
																	<?php 
																	$resultado2 =mysqli_query($connection,"SELECT * FROM subcategorias WHERE categoria_id = $categoria_id order by id");
																	while($dados2 = mysqli_fetch_assoc($resultado2)){
																		?>
																				<li> <a href="produtos.php?c=<?php echo $dados1["id"]."&sc=".$dados2['id'];?>" onclick="<?php echo $loading;?>"><?php echo $dados2["subcategoria_descricao_".$msg_idioma];?></a> </li>
																		</li> 		
																<?php    } ?>
																<li> <a href="produtos.php?c=<?php echo $dados1["id"];?>" onclick="<?php echo $loading;?>"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=8"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]." "; } echo $dados1["categoria_descricao_".$msg_idioma];?></a> </li>
															</ul>
														</li> 		
												<?php    } ?>
																		
											</ul>
										</li>                                        
									<?php
								}
							?>

						</ul> 
					</nav> 
				</div>
			</div>
			<div class="header-search">
				<script>
					function verificaSearch()	{ 
						if (form_search.search.value!="")	{
							document.getElementById('blanket').style.display = 'block';
							document.getElementById('aguarde').style.display = 'block';
							document.form_search.submit();
						}
					}
				</script>
					<form action="search.php" id="form_search" name="form_search" method="post">
						<input type="search" name="search" id="search" placeholder="<?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=7"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>" required="">
						<button type="submit" class="btn btn-default" onclick="verificaSearch();" aria-label="Left Align">
							<i class="fa fa-search" aria-hidden="true"> </i>
						</button>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>