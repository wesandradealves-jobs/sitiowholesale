<?php
	$id = $_GET['id'];
	//Executa consulta
	$result = mysqli_query($connection,"SELECT * FROM produtos WHERE id = '$id' LIMIT 1");
	$resultado = mysqli_fetch_assoc($result);

	$id_produto							= $resultado['id'];
	$id_categoria						= $resultado['categoria_id'];
	$id_subcategoria					= $resultado['sub_categoria_id'];
	$id_tipo_unitario 					= $resultado['tipo_unitario_id'];
	$id_grade							= $resultado['grade_id'];
	$id_marca 							= $resultado['marca_id'];
	$produto_seco						= $resultado['produto_seco'];
	$produto_resfriado					= $resultado['produto_resfriado'];
	$produto_congelado					= $resultado['produto_congelado'];
	$produto_caixa_propria				= $resultado['produto_caixa_propria'];
	$produto_valor_frete				= $resultado['produto_valor_frete'];
	$peso 								= $resultado['produto_peso'];
	$preco_custo						= $resultado['produto_preco_custo'];
	$preco_venda						= $resultado['produto_preco_venda'];
	$produto_link_youtube				= $resultado['produto_link_youtube'];
	$produto_descricao_ingles			= $resultado['produto_descricao_ingles'];
	$produto_descricao_japones			= $resultado['produto_descricao_japones'];
	$produto_descricao_curta_ingles		= $resultado['produto_descricao_curta_ingles'];
	$produto_descricao_curta_japones	= $resultado['produto_descricao_curta_japones'];
	$produto_descricao_longa_ingles		= $resultado['produto_descricao_longa_ingles'];
	$produto_descricao_longa_japones	= $resultado['produto_descricao_longa_japones'];
	
	
?>

<script type="text/javascript">
//carrega as subcategorias salvas e altera se trocar a categoria
function CarregaSubCategoria(){
	var categoria  = document.getElementById("categoria_id").value;
	document.getElementById("sub_categoria_id").style.display = 'none';
	document.getElementById("div_subcategoria").style.display = 'block';
	$("#div_subcategoria").empty();
    $("#div_subcategoria").load('processa/categoria_x_subcategoria.php?categoria_id='+categoria);
}
</script>


<form class="form-horizontal" method="POST" action="processa/proc_edit_produto.php" enctype="multipart/form-data">
<div class="page-header">
<div class="container">
	<br>
	<h1>Editar Produto
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=13&id=<?php echo $resultado['id']; ?>' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>
				<a href='administrativo.php?link=10' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>				
			</div>
  </div>
</nav>

<div class="container theme-showcase" role="main">      
	<div class="container">
		<div class="row">
			<div class="page-header">
				<h1>Imagens</h1>
			</div>
			<style type="text/css">
				input[type=file]{
				display: inline;
				}
				#image_preview img{
				height: 200px;
				padding: 5px;
				}
			</style>

			<input type="file" id="uploadFile" name="uploadFile[]" multiple/>
			<p><h6>Obs.: Se a imagem tiver mais de 500 pixels na horizontal ou vertical, o sistema vai redimensionar automaticamente. Utilizamos calculos matematicos para deixar a imagem proporcional.</h6></p>
			<p><h6>Na loja vao aparecer no maximo 4 imagens, seguindo a sequencia da esquerda para direita.</h6></p>
			<!-- Imagens ja cadastradas -->
			<div id="image_preview">
				<table align="left" border="0" cellspacing="0">
					<tr>
						<?php
						$resultado3 =mysqli_query($connection,"SELECT *,(SELECT MAX(imagem_sequencia) FROM imagem_produto WHERE produto_id=$id_produto) as max_seq FROM imagem_produto WHERE produto_id=$id_produto order by imagem_sequencia");
							$seq = 1;
							while($dados3 = mysqli_fetch_assoc($resultado3)){
								echo '<td align="center" border="5"><img src="imagens/'.$dados3["id"].'.jpg"/><br>';
								if ($seq != 1){
									echo '<a href="processa/proc_edit_ordem_imagem.php?situacao=1&produto_id='.$dados3["produto_id"].'&seq='.$dados3["imagem_sequencia"].'"><button type="button" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></button></a>';
								}
								if ($seq < $dados3["max_seq"]){
									echo ' <a href="processa/proc_edit_ordem_imagem.php?situacao=2&produto_id='.$dados3["produto_id"].'&seq='.$dados3["imagem_sequencia"].'"><button type="button" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button></a>';
								}										
								echo ' <a href="processa/proc_edit_ordem_imagem.php?situacao=3&produto_id='.$dados3["produto_id"].'&id='.$dados3["id"].'"><button type="button" class="btn btn-sm btn-danger">Excluir</button></a></td>';
								$seq = $seq + 1;
							}						
						?>
					<tr>
				</table>
			</div>
			<script type="text/javascript">
				$("#uploadFile").change(function(){
					$('#image_preview').html("");
					var total_file=document.getElementById("uploadFile").files.length;
					for(var i=0;i<total_file;i++)
					{
					$('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
					}
				});
			</script>
		</div>
		<div class="page-header">
			<h1>Dados do Produto</h1>
		</div>

		<div class="row">
			<div class="col-md-12">
						<!-- Nav pills -->
				<ul class="nav nav-pills" role="tablist" id="nav">
				<li class="active">
						<a class="nav-link active" data-toggle="tab" href="#dadosproduto" role="tab">Dados do Produto</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#ingles" role="tab">Ingles</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#japones" role="tab">Japones</a>
					</li>
				</ul>
				<br>

				<!-- id do produto -->
				<input type="hidden" name="id" value="<?php echo $id_produto; ?>">
			
				<!-- Tab -->
				<div class="tab-content">
					<!-- Tab Dados do produto -->
					<div class="tab-pane active" id="dadosproduto" role="tabpanel">
						<!-- codigo do cliente-->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Codigo</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_codigo_cliente" placeholder="Codigo do produto" value="<?php echo $resultado['produto_codigo_cliente']; ?>">
							</div>
						</div>	
						<!-- codigo do fornecedor-->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Codigo do Fornecedor</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_codigo_fornecedor" placeholder="Codigo do fornecedor" value="<?php echo $resultado['produto_codigo_fornecedor']; ?>">
							</div>
						</div>							
						<!-- Categoria -->
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Categoria</label>
							<div class="col-sm-10">
								<!-- carrega as subcategorias pelo evento onchange -->
								<select class="form-control" name="categoria_id" id="categoria_id" onchange="CarregaSubCategoria()">
								<?php 
										$resultado =mysqli_query($connection,"SELECT * FROM categorias order by id");
										while($dados = mysqli_fetch_assoc($resultado)){
											
											?>
												<option value="<?php echo $dados["id"]; ?>" <?php if($id_categoria == $dados["id"]){ echo 'selected'; } ?>><?php echo $dados["categoria_descricao_ingles"];?></option>
											<?php
										}
									?>
								</select>
							</div>
						</div>	
						
						<!-- sub categoria -->
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Sub Categoria</label>
							<!-- sub categoria atual -->
							<div class="col-sm-10" id="div_subcategoriaatual">
								<select class="form-control" name="sub_categoria_id" id="sub_categoria_id">
										<?php 
											$resultado =mysqli_query($connection,"SELECT * FROM subcategorias WHERE categoria_id=$id_categoria order by id");
											while($dados = mysqli_fetch_assoc($resultado)){?>
												<option value="<?php echo $dados["id"]; ?>" <?php if($id_subcategoria == $dados["id"]){ echo 'selected'; } ?>><?php echo $dados["subcategoria_descricao_ingles"];?></option>
												<?php
											}?>
								</select>
							</div>
							<!-- quando trocar a categoria, recarrega a lista de subcategorias de acordo com a categoria selecionada -->
							<div class="col-sm-10" id="div_subcategoria" style="display:none"></div>
						</div>

						<!-- Tipo Unitario  -->
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Tipo Unitario</label>
							<div class="col-sm-10">
								
								<select class="form-control" name="tipo_unitario_id">
								<?php 
										$resultado =mysqli_query($connection,"SELECT * FROM tipo_unitario");
										while($dados = mysqli_fetch_assoc($resultado)){
											?>
												<option value="<?php echo $dados["id"]; ?>" <?php if($id_tipo_unitario == $dados["id"]){ echo 'selected'; } ?>><?php echo $dados["tipo_unitario_descricao_ingles"];?></option>
											<?php
										}
									?>
								</select>
							</div>
						</div>
						<!-- Grade -->
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Grade</label>
							<div class="col-sm-10">
								<select class="form-control" name="grade_id" id="grade_id" onchange="ValidaGrade()">
								<?php 
									$resultado =mysqli_query($connection,"SELECT * FROM grades WHERE id=$id_grade order by id");
									while($dados = mysqli_fetch_assoc($resultado)){
										?>
											<option value="<?php echo $dados["id"]; ?>" <?php if($id_grade == $dados["id"]){ echo 'selected'; } ?>><?php echo $dados["grade_descricao"];?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						<!-- Marca -->
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Marca</label>
							<div class="col-sm-10">
								<select class="form-control" name="marca_id">
								<?php 
										$resultado =mysqli_query($connection,"SELECT * FROM marcas order by id");
										while($dados = mysqli_fetch_assoc($resultado)){
											?>
												<option value="<?php echo $dados["id"]; ?>" <?php if($id_marca == $dados["id"]){ echo 'selected'; } ?>><?php echo $dados["marca_descricao"];?></option>
											<?php
										}
									?>
								</select>
							</div>
						</div>
						<!-- Preco de custo -->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Preco Custo ￥</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_preco_custo" placeholder="Preco de custo em Yene" value="<?php echo $preco_custo;?>">
							</div>
						</div>
						<!-- Preco de venda -->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Preco Venda ￥</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_preco_venda" placeholder="Preco de venda em Yene" value="<?php echo $preco_venda;?>">
							</div>
						</div>
						<!-- Youtube -->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Codigo YouTube</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_link_youtube" placeholder="Link do YouTube para o produto" value="<?php echo $produto_link_youtube;?>">
								Obs.: Cadastrar o codigo do youtube, que esta em vermelho neste exemplo: https://www.youtube.com/watch?v=<font color="red"><strong>F9Q597Fq23U</strong></font>
							</div>
						</div>							


					</div>

					<!-- Tab Ingles -->
					<div class="tab-pane fade" id="ingles" role="tabpanel">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Nome do Produto</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_descricao_ingles" placeholder="Nome do Produto" value="<?php echo $produto_descricao_ingles;?>">
							</div>
							</div>		  
							<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Descricao Curta</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="5" name="produto_descricao_curta_ingles" placeholder="Descricao curta do produto"><?php echo $produto_descricao_curta_ingles;?></textarea>
							</div>
							</div>
							<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Descricao Longa</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="5" name="produto_descricao_longa_ingles" placeholder="Descricao longa do produto"><?php echo $produto_descricao_longa_ingles;?></textarea>
							</div>
							</div>
						</div>
					<!-- Tab Japones -->
					<div class="tab-pane fade" id="japones" role="tabpanel">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Nome do Produto</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_descricao_japones" placeholder="Nome do Produto"  value="<?php echo $produto_descricao_japones;?>">
							</div>
							</div>
							<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Descricao Curta</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="5" name="produto_descricao_curta_japones" placeholder="Descricao curta do produto"><?php echo $produto_descricao_curta_japones;?></textarea>
							</div>
							</div>
							<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Descricao Longa</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="5" name="produto_descricao_longa_japones" placeholder="Descricao longa do produto"><?php echo $produto_descricao_longa_japones;?></textarea>
							</div>
							</div>
						</div>
					</div>

					<!-- Frete -->
					<script>
						function com_caixa_propria() {
							document.getElementById("produto_seco").checked = false;
							document.getElementById("produto_resfriado").checked = false;
							document.getElementById("produto_congelado").checked = false;
						}
						function sem_caixa_propria() {
							document.getElementById("produto_caixa_propria").checked = false;
						}
					</script>			
					<div class="page-header">
						<h1>Dados do Frete</h1>
  					</div>
					<div class="form-group">
						<!-- Tipo de embalagem -->
						<div class="form-group">	
						<label for="inputEmail3" class="col-sm-2 control-label">Tipo de embalagem</label>
							<div class="col-sm-10">		
								<label><input type="checkbox" onclick='sem_caixa_propria()'  <?php if ($produto_seco=='1'){echo 'checked="checked"';} ?> name="produto_seco" id="produto_seco" value="">Seco</label><br>
								<label><input type="checkbox" onclick='sem_caixa_propria()'  <?php if ($produto_resfriado=='1'){echo 'checked="checked"';} ?> name="produto_resfriado" id="produto_resfriado" value="">Resfriado</label><br>
								<label><input type="checkbox" onclick='sem_caixa_propria()'  <?php if ($produto_congelado=='1'){echo 'checked="checked"';} ?> name="produto_congelado" id="produto_congelado" value="">Congelado</label><br>
								<label><input type="checkbox" onclick='com_caixa_propria()' <?php if ($produto_caixa_propria=='1'){echo 'checked="checked"';} ?> name="produto_caixa_propria" id="produto_caixa_propria" value="">Caixa Propria</label>
							</div>
						</div>						
						<!-- Valor do frete -->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Valor do Frete Fixo</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_valor_frete" placeholder="Valor do frete Fixo" value="<?php echo $produto_valor_frete;?>">
							</div>
						</div>
						<!-- Peso -->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Peso (gramas)</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_peso" placeholder="Peso do produto em gramas" value="<?php echo $peso;?>">
							</div>
						</div>
					</div>
					<!-- //Frete -->
				
					<!-- Grade -->
					<div class="page-header">
						<h1>Dados da Grade</h1>
  					</div>
					  <div class="form-group">
					  <!-- validacao das cores existentes para o produto -->
							<?php 
								$resultado = mysqli_query($connection,"SELECT DISTINCT(cor_id) FROM produto_itens WHERE produto_id=$id_produto");
								$dados=mysqli_num_rows($resultado);
								$contador = 0;
								while($dados = mysqli_fetch_array($resultado)){
									$cor_id 		= $dados['cor_id'];
									$contador 		= $contador + 1;
							?>
							<!-- se o produto nao tiver cor -->
							<input type="hidden" id="semcor" name="semcor" size="22" value="<?php echo $cor_id;?>">								
							<div class="form-group">
								<table align="center" border="0" cellspacing="0">
									<tr>
										<td align="right" width="70">
											<select style="width:99.5%;" name="cor_id<?php echo $contador;?>">
												<?php 
													if ($cor_id){
														$resultado1 =mysqli_query($connection,"SELECT * FROM cor WHERE id=$cor_id");
													}	
													else {
														$resultado1 =mysqli_query($connection,"SELECT * FROM cor");
														echo '<option value="">Selecione uma cor</option>';
													}
													while($dados1 = mysqli_fetch_assoc($resultado1)){
												?>
														<option value="<?php echo $dados1["id"];?>"><?php echo $dados1["cor_descricao_ingles"];?></option>
													<?php
													}
													?>
											</select>
											<strong><input type="text" id="preco_custo" name="preco_custo" size="22" value="Preco de Custo"  disabled></strong>
											<strong><input type="text" id="preco_custo" name="preco_custo" size="22" value="Preco de Venda"  disabled></strong>
											<strong><input type="text" id="preco_custo" name="preco_custo" size="22" value="Codigo de Barra" disabled></strong>
										</td>
									<?php //tamanhos da grade
										if ($cor_id){
											$resultado2 = mysqli_query($connection,"SELECT *,
											CASE
												WHEN tamanho_id = 1 THEN (SELECT ingles_01 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 2 THEN (SELECT ingles_02 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 3 THEN (SELECT ingles_03 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 4 THEN (SELECT ingles_04 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 5 THEN (SELECT ingles_05 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 6 THEN (SELECT ingles_06 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 7 THEN (SELECT ingles_07 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 8 THEN (SELECT ingles_08 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 9 THEN (SELECT ingles_09 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 10 THEN (SELECT ingles_10 FROM grade_itens where grade_id=$id_grade)
											END AS desc_grade
											FROM produto_itens WHERE produto_id=$id_produto AND cor_id=$cor_id ORDER BY produto_id,tamanho_id");
										}else{
											$resultado2 = mysqli_query($connection,"SELECT *,
											CASE
												WHEN tamanho_id = 1 THEN (SELECT ingles_01 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 2 THEN (SELECT ingles_02 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 3 THEN (SELECT ingles_03 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 4 THEN (SELECT ingles_04 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 5 THEN (SELECT ingles_05 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 6 THEN (SELECT ingles_06 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 7 THEN (SELECT ingles_07 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 8 THEN (SELECT ingles_08 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 9 THEN (SELECT ingles_09 FROM grade_itens where grade_id=$id_grade)
												WHEN tamanho_id = 10 THEN (SELECT ingles_10 FROM grade_itens where grade_id=$id_grade)
											END AS desc_grade
											FROM produto_itens WHERE produto_id=$id_produto  ORDER BY tamanho_id");	
										}
										$tamanho = 0;
										while($dados2 = mysqli_fetch_assoc($resultado2)){
											$tamanho = $tamanho+1;
											?>
											<td align="right" width="1" border="0" cellspacing="0">
												<input type="text" id="produto_item_descricao<?php 	  echo $contador; echo $tamanho;?>" name="produto_item_descricao<?php 	 echo $contador; echo $tamanho;?>" size="9" value="<?php echo $dados2["desc_grade"];?>" disabled>	
												<input type="text" id="produto_item_preco_custo<?php  echo $contador; echo $tamanho;?>" name="produto_item_preco_custo<?php  echo $contador; echo $tamanho;?>" size="9" value="<?php echo $dados2["produto_item_preco_custo"];?>">
												<input type="text" id="produto_item_preco_venda<?php  echo $contador; echo $tamanho;?>" name="produto_item_preco_venda<?php  echo $contador; echo $tamanho;?>" size="9" value="<?php echo $dados2["produto_item_preco_venda"];?>">
												<input type="text" id="produto_item_codigo_barra<?php echo $contador; echo $tamanho;?>" name="produto_item_codigo_barra<?php echo $contador; echo $tamanho;?>" size="9" value="<?php echo $dados2["produto_item_codigo_barra"];?>">
												</td>
											<?php
										}
											?>
										<!-- saber quantos tamanhos tem o produto -->
										<input type="hidden" id="tamanho" name="tamanho" size="22" value="<?php echo $tamanho;?>">	
									</tr>
								</table>
							</div>
							<?php 
								}
							?>	
							<!-- quantidade de cores existentes -->
							<input type="hidden" id="contador" name="contador" size="22" value="<?php echo $contador;?>">		
						<!-- fim validacao das cores existentes para o produto -->

					<!-- se nao tiver produto sem cor, permite inclruir uma nova cor -->
						<?php 
							if ($cor_id){
						?>	
						<div class="form-group">
							<table align="center" border="0" cellspacing="0">
								<tr>
									<td align="right" width="70">
										<select style="width:99.5%;" name="cor_id_incluir">
										<option value="">Selecione uma cor</option>
											<?php 
												$resultado1 =mysqli_query($connection,"SELECT * FROM cor WHERE id NOT IN (SELECT DISTINCT(cor_id) FROM produto_itens WHERE produto_id=$id_produto AND cor_id IS NOT NULL)");
												while($dados1 = mysqli_fetch_assoc($resultado1)){
											?>
													<option value="<?php echo $dados1["id"];?>"><?php echo $dados1["cor_descricao_ingles"];?></option>
											<?php
												}
											?>
										</select>
										<strong><input type="text" id="preco_custo" name="preco_custo" size="22" value="Preco de Custo" disabled></strong>
										<strong><input type="text" id="preco_custo" name="preco_custo" size="22" value="Preco de Venda" disabled></strong>
										<strong><input type="text" id="preco_custo" name="preco_custo" size="22" value="Codigo de Barra" disabled></strong>
									</td>
									<?php //tamanhos da grade
										$resultado2 = mysqli_query($connection,"SELECT *,
										CASE
											WHEN tamanho_id = 1 THEN (SELECT ingles_01 FROM grade_itens where grade_id=$id_grade)
											WHEN tamanho_id = 2 THEN (SELECT ingles_02 FROM grade_itens where grade_id=$id_grade)
											WHEN tamanho_id = 3 THEN (SELECT ingles_03 FROM grade_itens where grade_id=$id_grade)
											WHEN tamanho_id = 4 THEN (SELECT ingles_04 FROM grade_itens where grade_id=$id_grade)
											WHEN tamanho_id = 5 THEN (SELECT ingles_05 FROM grade_itens where grade_id=$id_grade)
											WHEN tamanho_id = 6 THEN (SELECT ingles_06 FROM grade_itens where grade_id=$id_grade)
											WHEN tamanho_id = 7 THEN (SELECT ingles_07 FROM grade_itens where grade_id=$id_grade)
											WHEN tamanho_id = 8 THEN (SELECT ingles_08 FROM grade_itens where grade_id=$id_grade)
											WHEN tamanho_id = 9 THEN (SELECT ingles_09 FROM grade_itens where grade_id=$id_grade)
											WHEN tamanho_id = 10 THEN (SELECT ingles_10 FROM grade_itens where grade_id=$id_grade)
										END AS desc_grade
										FROM produto_itens WHERE produto_id=$id_produto  AND cor_id=$cor_id");
										while($dados2 = mysqli_fetch_assoc($resultado2)){
									?>
											<td align="right" width="1" border="0" cellspacing="0">
												<input type="text" id="descricao" name="descricao" size="9" value="<?php echo $dados2["desc_grade"];?>" disabled>	
												<input type="text" id="preco_custo" name="preco_custo" size="9" value="" disabled>
												<input type="text" id="preco_venda" name="preco_venda" size="9" value="" disabled>
												<input type="text" id="codigo_barra" name="codigo_barra" size="9" value="" disabled>
												</td>
									<?php
										}
									?>
								</tr>
							</table>
						</div>
						<?php				
							}	
						?>
					</div>
			</div>
		</div>
	</div> <!-- /container -->
</div>
</form>