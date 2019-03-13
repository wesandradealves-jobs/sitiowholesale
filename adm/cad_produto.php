<script type="text/javascript">
var gradequantidade = "";
var cor = ""; 

window.onload = function(){
	var categoria  = document.getElementById("categoria").value;
	$("#div_subcategoria").empty();
    $("#div_subcategoria").load('processa/categoria_x_subcategoria.php?categoria_id='+categoria);
}

//carrega as subcategorias relacionadas a categoria
function CarregaSubCategoria(){
	var categoria  = document.getElementById("categoria").value;
	$("#div_subcategoria").empty();
    $("#div_subcategoria").load('processa/categoria_x_subcategoria.php?categoria_id='+categoria);
}
</script>

<form class="form-horizontal" method="POST" action="processa/proc_cad_produto.php">
<div class="page-header">
<div class="container">
		<h1>Cadastrar Produto</h1>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=11' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>	
				<a href='administrativo.php?link=10' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>			
			</div>
  </div>
</nav>
<div class="container theme-showcase " role="main"> 
 	<div class="row" >
		<div class="col-md-12">
				<!-- Nav pills -->
				<ul class="nav nav-pills" role="tablist">
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

				<!-- Tab -->
				<div class="tab-content">
					<!-- Tab Dados do produto -->
					<div class="tab-pane active" id="dadosproduto" role="tabpanel">
						<!-- codigo -->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Codigo Interno</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_codigo_cliente" placeholder="Codigo interno do produto">
							</div>
						</div>	
						<!-- codigo fornecedor-->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Codigo Fornecedor</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_codigo_fornecedor" placeholder="Codigo do fornecedor">
							</div>
						</div>							
						<!-- Categoria -->
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Categoria</label>
							<div class="col-sm-10">
								<select class="form-control" name="categoria_id" id="categoria" onchange="CarregaSubCategoria()">
								<?php 
										$resultado =mysqli_query($connection,"SELECT * FROM categorias order by id");
										while($dados = mysqli_fetch_assoc($resultado)){
											?>
												<option value="<?php echo $dados["id"]; ?>"><?php echo $dados["categoria_descricao_ingles"];?></option>
											<?php
										}
									?>
								</select>
							</div>
						</div>		
						<!-- sub categoria -->
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Sub Categoria</label>
							<div class="col-sm-10" id="div_subcategoria"></div>
						</div>
						<!-- Tipo Unitario  -->
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Tipo Unitario</label>
							<div class="col-sm-10">
								<select class="form-control" name="tipo_unitario_id">
								<?php 
										$resultado =mysqli_query($connection,"SELECT * FROM tipo_unitario order by id");
										while($dados = mysqli_fetch_assoc($resultado)){
											?>
												<option value="<?php echo $dados["id"]; ?>"><?php echo $dados["tipo_unitario_descricao_ingles"];?></option>
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
								<select class="form-control" name="grade_id">
								<?php 
									$resultado =mysqli_query($connection,"SELECT * FROM grades order by id");
									while($dados = mysqli_fetch_assoc($resultado)){
										?>
											<option value="<?php echo $dados["id"];?>"><?php echo $dados["grade_descricao"];?></option>
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
												<option value="<?php echo $dados["id"]; ?>"><?php echo $dados["marca_descricao"];?></option>
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
								<input type="text" class="form-control" name="produto_preco_custo" placeholder="Preco de custo em Yene">
							</div>
						</div>
						<!-- Preco de venda -->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Preco Venda ￥</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_preco_venda" placeholder="Preco de venda em Yene">
							</div>
						</div>
						<!-- Youtube -->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">YouTube</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_link_youtube" placeholder="Link do YouTube para o produto">
								Obs.: Cadastrar o codigo do youtube, que esta em vermelho neste exemplo: https://www.youtube.com/watch?v=<font color="red"><strong>F9Q597Fq23U</strong></font>
							</div>
						</div>						
					</div>
					<!-- Tab Ingles -->
					<div class="tab-pane fade" id="ingles" role="tabpanel">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Nome do Produto</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_descricao_ingles" placeholder="Nome do Produto">
							</div>
							</div>		  
							<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Descricao Curta</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="5" name="produto_descricao_curta_ingles" placeholder="Descricao curta do produto"></textarea>
							</div>
							</div>
							<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Descricao Longa</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="5" name="produto_descricao_longa_ingles" placeholder="Descricao longa do produto"></textarea>
							</div>
						</div>
					</div>
					<!-- Tab Japones -->
					<div class="tab-pane fade" id="japones" role="tabpanel">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Nome do Produto</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_descricao_japones" placeholder="Nome do Produto">
							</div>
							</div>
							<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Descricao Curta</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="5" name="produto_descricao_curta_japones" placeholder="Descricao curta do produto"></textarea>
							</div>
							</div>
							<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Descricao Longa</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="5" name="produto_descricao_longa_japones" placeholder="Descricao longa do produto"></textarea>
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
								<label><input type="checkbox" onclick='sem_caixa_propria()' name="produto_seco" id="produto_seco" value="">Seco</label><br>
								<label><input type="checkbox" onclick='sem_caixa_propria()' name="produto_resfriado" id="produto_resfriado" value="">Resfriado</label><br>
								<label><input type="checkbox" onclick='sem_caixa_propria()' name="produto_congelado" id="produto_congelado" value="">Congelado</label><br>
								<label><input type="checkbox" onclick='com_caixa_propria()' name="produto_caixa_propria" id="produto_caixa_propria" value="">Caixa Propria</label>
							</div>
						</div>						
						<!-- Valor do frete -->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Valor do Frete Fixo</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_valor_frete" placeholder="Valor do frete Fixo">
							</div>
						</div>
						<!-- Peso -->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Peso (gramas)</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="produto_peso" placeholder="Peso do produto em gramas">
							</div>
						</div>
					</div>
					<!-- //Frete -->

					<!-- Tab grade -->
					<div class="tab-pane fade" id="grade" role="tabpanel">
						<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">Cor</label>
								<div class="col-sm-10">
									<select class="form-control" name="cor" id="guardacor" onchange="optionCheckCor()">
									<option>Incluir cor</option>
									<?php 
											$resultado =mysqli_query($connection,"SELECT * FROM cor");
											while($dados = mysqli_fetch_assoc($resultado)){
												?>
													<option value="<?php echo $dados["cor_descricao_ingles"]; $corid=$dados["id"]; ?>"><?php echo $dados["cor_descricao_ingles"];?></option>
												<?php
											}
										?>
									</select>
								</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" id="cor1" class="col-sm-2 control-label"></label>
							<div class="col-sm-10">
								<input type="text" id="item_ingles_01" name="ingles_01" placeholder="Tam. 01" size="9" style="display:none; float:left;">
								<input type="text" id="item_ingles_02" name="ingles_02" placeholder="Tam. 02" size="9" style="display:none; float:left;">
								<input type="text" id="item_ingles_03" name="ingles_03" placeholder="Tam. 03" size="9" style="display:none; float:left;">
								<input type="text" id="item_ingles_04" name="ingles_04" placeholder="Tam. 04" size="9" style="display:none; float:left;">
								<input type="text" id="item_ingles_05" name="ingles_05" placeholder="Tam. 05" size="9" style="display:none; float:left;">
								<input type="text" id="item_ingles_06" name="ingles_06" placeholder="Tam. 06" size="9" style="display:none; float:left;">
								<input type="text" id="item_ingles_07" name="ingles_07" placeholder="Tam. 07" size="9" style="display:none; float:left;">
								<input type="text" id="item_ingles_08" name="ingles_08" placeholder="Tam. 08" size="9" style="display:none; float:left;">
								<input type="text" id="item_ingles_09" name="ingles_09" placeholder="Tam. 09" size="9" style="display:none; float:left;">
								<input type="text" id="item_ingles_10" name="ingles_10" placeholder="Tam. 10" size="9" style="display:none; float:left;">
							</div>
						</div>
					</div>
		</div>
	</div>
</div> <!-- /container -->
</form>












