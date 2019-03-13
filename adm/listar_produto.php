<?php
	//pelo metodo POST
	if ( isset( $_POST["produto_codigo_cliente"] ) ) {
		$produto_codigo_cliente			= $_POST['produto_codigo_cliente'];
	} else {
		$produto_codigo_cliente			= "";
	}
	if ( isset( $_POST["produto_codigo_fornecedor"] ) ) {
		$produto_codigo_fornecedor	= $_POST['produto_codigo_fornecedor'];
	} else {
		$produto_codigo_fornecedor	= "";
	}
	if ( isset( $_POST["produto_item_codigo_barra"] ) ) {
		$produto_item_codigo_barra	= $_POST['produto_item_codigo_barra'];
	} else {
		$produto_item_codigo_barra	= "";
	}
	if ( isset( $_POST["situacao_id"] ) ) {
		$situacao_id	= $_POST['situacao_id'];
	} else {
		$situacao_id	= "";
	}
	if ( isset( $_POST["produto_descricao_ingles"] ) ) {
		$produto_descricao_ingles	= $_POST['produto_descricao_ingles'];
	} else {
		$produto_descricao_ingles	= "";
	}

		//pelo metodo GET
	if ( isset( $_GET["sit"] ) ) {
		$sit	= $_GET['sit'];
	} 
	if ( isset( $_GET["id"] ) ) {
		$id	= $_GET['id'];
	} 
	if ( isset( $_GET["op"] ) ) {
		$op	= $_GET['op'];
	} 
	if ( isset( $_GET["f1"] ) ) {
		$produto_codigo_cliente	= $_GET['f1'];
	} 
	if ( isset( $_GET["f2"] ) ) {
		$produto_codigo_fornecedor = $_GET['f2'];
	}
	if ( isset( $_GET["f3"] ) ) {
		$produto_item_codigo_barra = $_GET['f3'];
	}
	if ( isset( $_GET["f4"] ) ) {
		$situacao_id = $_GET['f4'];
	}
	if ( isset( $_GET["f5"] ) ) {
		$produto_descricao_ingles = $_GET['f5'];
	}
	//alterar a situacao do produto
	$qt_notificacao = 0;
	if ( isset( $_GET["op"]) ) {
		$resultado=mysqli_query($connection,"UPDATE produto_itens SET situacao_id=$op WHERE id=$id");
		// envia email de notificacao
		if ($_GET['op']=='1'){ // se alterar para disponivel
			$query1 =mysqli_query($connection,"SELECT a.*,
													b.produto_id as cod_produto,
													(select id from imagem_produto where produto_id=b.produto_id order by imagem_sequencia limit 1) as img
													FROM notificacoes a, produto_itens b
													WHERE a.produto_id = $id 
													AND a.notificacao_situacao=0 
													AND b.id = a.produto_id"); 
			if(mysqli_num_rows($query1) > 0){
				while($linhas = mysqli_fetch_assoc($query1)){ // manda um email para cada email registrado 
					$email  		= $linhas["notificacao_email"];
					$cod_produto 	= $linhas["cod_produto"];
					$img		 	= $linhas["img"];	
					$id_notificacao = $linhas["id"];	
					
					if ($linhas["notificacao_idioma"] =='en'){
						$msg_idioma = 'ingles';
					} else {
						$msg_idioma = 'japones';
					}

					$query =mysqli_query($connection,"SELECT 	a.*, 
																b.*
														FROM 	produto_itens a,
																produtos b
														WHERE a.produto_id = b.id 
														AND a.id=$id
													GROUP BY a.produto_id");
												$line = mysqli_fetch_assoc($query);
												$produto_descricao      = $line["produto_descricao_".$msg_idioma]; 
												$produto_descricao_curta= $line["produto_descricao_curta_".$msg_idioma];
												$produto_codigo_cliente = $line["produto_codigo_cliente"];  
			


					$query =mysqli_query($connection,"SELECT * FROM empresa WHERE id=1"); 
					$line = mysqli_fetch_assoc($query); 
					$empresa_host    = $line["empresa_host"];
					$empresa_facebook= $line["empresa_facebook"];
					$texto 			 = "<!DOCTYPE html><html lang='ja'><title>Sitio Wholesale</title><link rel='icon' href='https://$empresa_host/icon.png'></head><body style='background-color:#DCDCDC;'><table style='width: 100%; max-height: 100%;' border='0' cellspacing='0' cellpadding='0' align='center'><tbody><tr><td align='center' style='padding:0;Margin:0;'><div style='max-width: 1024px; width: 100%; height: 100%; background: #fff; border-style: solid; border-width: 1px; border-color: #C0C0C0;' align='center'><a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'><div style='max-width: 90%; padding:10; padding-top:5; padding-bottom:5;' align='center'><br><img src='https://$empresa_host/images/logo.png'></div></a>";
					$texto           = $texto.' '.$line["empresa_texto_notificacao_produto_".$msg_idioma];
					$assunto         = $line["empresa_assunto_notificacao_produto_".$msg_idioma];
					$empresa_email_contato = $line["empresa_email_sistema"];
					$email_remetente = 'Sitio Wholesale <'.$line["empresa_email_sistema"].'>';

					$query =mysqli_query($connection,'SELECT mensagem_'.$msg_idioma.' as mensagem FROM mensagens WHERE id=55'); $line = mysqli_fetch_assoc($query); $local   = $line['mensagem']; 
					$query =mysqli_query($connection,'SELECT mensagem_'.$msg_idioma.' as mensagem FROM mensagens WHERE id=71'); $line = mysqli_fetch_assoc($query); $celular = $line['mensagem']; 
					$query =mysqli_query($connection,'SELECT mensagem_'.$msg_idioma.' as mensagem FROM mensagens WHERE id=56'); $line = mysqli_fetch_assoc($query); $telefone= $line['mensagem']; 
					$link= '';
			
					$texto = $texto."</div></td></tr><tr><td align='center' style='padding:0;Margin:0;'><div style='max-width: 1024px; width: 100%; height: 100%; align='center'><h6><img height='20px' width='auto' src='https://$empresa_host/images/fb_icon.png'><br>$local<br>+81 $celular - +81 $telefone<br><a style='text-decoration:none; color: #000000;' href='mailto:$empresa_email_contato'>$empresa_email_contato</a> - <a style='text-decoration:none; color: #000000;' href='https://$empresa_host' target='_blank'>$empresa_host</a></h6></div></td></tr></tbody></table></body></html>";
						
					$texto  = str_replace('$link', "$empresa_host/produto.php?id=$cod_produto", $texto);
					$texto  = str_replace('$local', $local, $texto);
					$texto  = str_replace('$celular', $celular, $texto);
					$texto  = str_replace('$telefone', $telefone, $texto);
					$texto  = str_replace('$empresa_facebook', $empresa_facebook, $texto);
					$texto  = str_replace('$empresa_email_contato', $empresa_email_contato, $texto);
					$texto  = str_replace('$empresa_host', $empresa_host, $texto);
					$texto  = str_replace('$produto_descricao', $produto_descricao, $texto);
					$texto  = str_replace('$produto_codigo_cliente', $produto_codigo_cliente, $texto);
					$texto  = str_replace('$img', $img, $texto);
					$mensagem = $texto;
			
					$headers  = "MIME-Version: 1.1\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1\n";
					$headers .= "From: $email_remetente\n";
					$headers .= "Return-Path: $email_remetente\n"; 
					$headers .= "Reply-To: $email\n"; 
					$_POST["name"].' <'.$_POST["email"].'>';
			
					if(mail("$email", "$assunto", "$mensagem", $headers, "-f$email_remetente")){
						$qt_notificacao += 1;
						$query = mysqli_query($connection,"UPDATE notificacoes set notificacao_situacao = 1 WHERE id='$id_notificacao'");
					}
				}
			}
		}
		// fim envia email de notificacao
	}


	$query = "";

	if ($produto_codigo_cliente) {
		$query = " AND a.produto_id in (SELECT id FROM produtos WHERE produto_codigo_cliente like '".$produto_codigo_cliente."') ";
	} 
	if ($produto_codigo_fornecedor) {
		$query = $query." AND a.produto_id in (SELECT id FROM produtos WHERE produto_codigo_fornecedor like '".$produto_codigo_fornecedor."') ";			
	} 
	if ($produto_item_codigo_barra) {
		$query = $query."AND a.produto_item_codigo_barra = ".$produto_item_codigo_barra." ";			
	} 
	if ($situacao_id) {
		$query = $query."AND a.situacao_id = ".$situacao_id." ";			
	}
	if ($produto_descricao_ingles) {
		$query = $query." AND a.produto_id in (SELECT id FROM produtos WHERE produto_descricao_ingles like '%".$produto_descricao_ingles."%') ";			
	} 

	
	if ($query) {
		$resultado=mysqli_query($connection,"SELECT a.*,
																								b.produto_codigo_cliente,
																								b.produto_descricao_ingles, 
																								(select cor_descricao_ingles from cor where id=a.cor_id) as cor, 
																								(select CASE
																													WHEN a.tamanho_id = 1 THEN ingles_01
																													WHEN a.tamanho_id = 2 THEN ingles_02
																													WHEN a.tamanho_id = 3 THEN ingles_03
																													WHEN a.tamanho_id = 4 THEN ingles_04
																													WHEN a.tamanho_id = 5 THEN ingles_05
																													WHEN a.tamanho_id = 6 THEN ingles_06
																													WHEN a.tamanho_id = 7 THEN ingles_07
																													WHEN a.tamanho_id = 8 THEN ingles_08
																													WHEN a.tamanho_id = 9 THEN ingles_09
																													WHEN a.tamanho_id = 10 THEN ingles_10
																													ELSE ''
																												END
																								from grade_itens 
																							 where grade_id=a.grade_id) as tamanho
																					FROM produto_itens a, produtos b 
																				 WHERE a.produto_id = b.id $query
																				 ORDER BY a.id");
		$linhas=mysqli_num_rows($resultado);
	} else {
		$resultado=mysqli_query($connection,"SELECT * FROM produto_itens WHERE 1=2");
		$linhas=mysqli_num_rows($resultado);	
	}
?>	
<div class="page-header">
	<div class="container">
		<br>
		<h1>Lista de Produto
			<div class="pull-right ">
				<a href="administrativo.php?link=11"><button type='button' class='btn btn-success' onclick="<?php echo $loading;?>">Cadastrar</button></a>
			</div>
		</h1>
	</div>
</div>

<div class="container theme-showcase" role="main"> 
  <div class="row ">
		<form class="form-horizontal" method="POST" action="administrativo.php?link=47">
			<!-- Filtro de pesquisa -->
			<div class="tab-content">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Codigo Interno</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="produto_codigo_cliente" placeholder="Digite o codigo interno" value="<?php echo $produto_codigo_cliente;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Codigo do Fornecedor</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="produto_codigo_fornecedor" placeholder="Digite o codigo do fornecedor" value="<?php echo $produto_codigo_fornecedor;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Codigo de Barras</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="produto_item_codigo_barra" placeholder="Digite o codigo de barras" value="<?php echo $produto_item_codigo_barra;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Situacao</label>
					<div class="col-sm-10">
						<select class="form-control" name="situacao_id">
							<option value="<?php echo $situacao_id;?>">
								<?php if ($situacao_id != ""){
										$resultado1 =mysqli_query($connection,"SELECT * FROM situacaos WHERE id=$situacao_id");
										$dados1 = mysqli_fetch_assoc($resultado1);
										echo $dados1["nome"]; 
									  } else { 
										echo "Escolha uma situacao"; 
									  }
								?>
							</option>
							<option value="">Escolha uma situacao</option>
							<?php 
								$resultado1 =mysqli_query($connection,"SELECT * FROM situacaos order by id");
								while($dados1 = mysqli_fetch_assoc($resultado1)){
									?>
										<option value="<?php echo $dados1["id"]; ?>"><?php echo $dados1["nome"];?></option>
									<?php
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Descricao Ingles</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="produto_descricao_ingles" placeholder="Digite a descricao em ingles" value="<?php echo $produto_descricao_ingles;?>">
					</div>
				</div>
				<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
						<div class="pull-right">
							<a href="administrativo.php?link=10"><button type='button' class='btn btn-primary' onclick="<?php echo $loading;?>">Limpar</button></a>
							<button type="submit" name="submit" class="btn btn-success" onclick="javascript:document.getElementById('blanket').style.display = 'block';document.getElementById('aguarde').style.display = 'block';">Pesquisar</button>
						</div>
					</div>	
				</div>			
			</div>
		</form>
		<div class="row ">
			<div class="tab-content">
				<div class="form-group">
					<h3><?php if ($qt_notificacao > 0){echo "Notificacao enviada para $qt_notificacao e-mail(s)"; $qt_notificacao=0;}?></h3>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<table class="table">
			<thead>
				<tr>
				<th>ID</th>
				<th>Codigo</th>
				<th>Descricao</th>
				<th>Situacao</th>
				<th>Acoes</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					while($linhas = mysqli_fetch_array($resultado)){
						if ($linhas['situacao_id']==1){
							echo "<tr class='success'>";
						} else if ($linhas['situacao_id']==2){
							echo "<tr class='warning'>";
						} else {
							echo "<tr class='danger'>";
						}		
						echo "<td>".$linhas['id']."</td>";
						echo "<td>".$linhas['produto_codigo_cliente']."</td>";
						echo "<td>".$linhas['produto_descricao_ingles']." ".$linhas['cor']." ".$linhas['tamanho']."</td>";
						echo "<td>";
							if ($linhas['situacao_id']==1){
								echo "Disponivel";
							} else if ($linhas['situacao_id']==2){
								echo "Indisponivel";
							} else {
								echo "Bloqueado";
							}echo "</td>";
						?>
						<td align="right"> 
						<?php
						if ($linhas['situacao_id']!=2){
							echo '<a href="administrativo.php?link=47&id='.$linhas["id"].'&op=2&f1='.$produto_codigo_cliente.'&f2='.$produto_codigo_fornecedor.'&f3='.$produto_item_codigo_barra.'&f4='.$situacao_id.'&f5='.$produto_descricao_ingles.'"><button type="button" class="btn btn-warning" onclick="'.$loading.'">Indisponivel</button></a>';
						} 
						if ($linhas['situacao_id']!=1){
							echo " ";
							echo '<a href="administrativo.php?link=47&id='.$linhas["id"].'&op=1&f1='.$produto_codigo_cliente.'&f2='.$produto_codigo_fornecedor.'&f3='.$produto_item_codigo_barra.'&f4='.$situacao_id.'&f5='.$produto_descricao_ingles.'"><button type="button" class="btn btn-success" onclick="'.$loading.'">Disponivel</button></a>';
						}
						if ($linhas['situacao_id']!=3){
							echo " ";
							echo '<a href="administrativo.php?link=47&id='.$linhas["id"].'&op=3&f1='.$produto_codigo_cliente.'&f2='.$produto_codigo_fornecedor.'&f3='.$produto_item_codigo_barra.'&f4='.$situacao_id.'&f5='.$produto_descricao_ingles.'"><button type="button" class="btn btn-danger" onclick="'.$loading.'">Bloqueado</button></a>';
						}
						?>
							<a href='administrativo.php?link=13&id=<?php echo $linhas['produto_id']; ?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-warning'>Editar</button></a>
						</td> 
						<?php
						echo "</tr>";
					}
				?>
			</tbody>
			</table>
		</div>
	</div>
</div> <!-- /container -->