<?php
	$id = $_GET['id'];
	//Executa consulta
	$result = mysqli_query($connection,"SELECT a.*,b.transportadora_ingles  FROM transp_regioes a LEFT JOIN transportadoras b on a.transportadora_id=b.id WHERE a.id = '$id' LIMIT 1");
	$linhas = mysqli_fetch_assoc($result);
	$transportadora_id = $linhas['transportadora_id'];
?>
<form class="form-horizontal" method="POST" action="processa/proc_edit_transportadora_regiao.php">
		<div class="page-header">
		<div class="container">
				<br>
				<h1>Descricao da Regiao</h1>
		</div>
		</div>
		<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
			<div class="container">
					<div class="pull-right">
						<br>
						<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
					<a href='administrativo.php?link=62&id=<?php echo $linhas['id']; ?>' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>
					<button type='button' class='btn btn-danger' data-toggle="modal" data-target="#apagar<?php echo $linhas['id']; ?>">Apagar</button>
					<a href='administrativo.php?link=61' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>			
					</div>
			</div>
		</nav>
		<div class="container theme-showcase" role="main">      
			<!-- Modal Apagar-->
			<div id="apagar<?php echo $linhas['id']; ?>" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header alert-danger">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">CUIDADO</h4>
						</div>
						<div class="modal-body">
							<p>Deseja apagar esta regiao?</p>
							<p><?php echo $linhas['id']; ?> - <?php echo $linhas['transp_regiao_ingles'];?></p>
						</div>
						<div class="modal-footer">
							<a href='processa/proc_apagar_transportadora_regiao.php?id=<?php echo $linhas['id']; ?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-sm btn-danger'>Apagar</button></a>
							<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fechar</button>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
				
					<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Descricao Ingles</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="transp_regiao_ingles" placeholder="Descricao da Regiao em Ingles" value="<?php echo $linhas['transp_regiao_ingles']; ?>">
					</div>
					</div>		 

					<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Descricao Japones</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="transp_regiao_japones" placeholder="Descricao da Regiao em Japones" value="<?php echo $linhas['transp_regiao_japones']; ?>">
					</div>
					</div>

					<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Transportadora</label>
					<div class="col-sm-10">
						<select class="form-control" name="transportadora_id">
						<option value="<?php echo $linhas['transportadora_id']; ?>"><?php echo $linhas['transportadora_ingles']; ?></option>
						<?php 
								$linhas2 =mysqli_query($connection,"SELECT * FROM transportadoras");
								while($dados = mysqli_fetch_assoc($linhas2)){
									?>
										<option value="<?php echo $dados["id"]; ?>"><?php echo $dados["transportadora_ingles"];?></option>
									<?php
								}
							?>
						</select>
					</div>
					</div>
					<input type="hidden" name="id" value="<?php echo $linhas['id']; ?>">
				</div>
			</div>
		</div> <!-- /container -->


		<div class="page-header">
			<div class="container">
					<h1>Provincias da Regiao</h1>
			</div>
		</div>
		<div class="container theme-showcase" role="main"> 
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Incluir a Provincia</label>
						<div class="col-sm-10">
							<select class="form-control" name="provincia_id">
							<option></option>
							<?php 
									$linhas2 =mysqli_query($connection,"SELECT * FROM post_provincias WHERE id NOT IN (SELECT provincia_id  FROM transp_regiao_provincias WHERE regiao_id IN (SELECT regiao_id FROM transp_regioes WHERE transportadora_id=$transportadora_id))");
									while($dados = mysqli_fetch_assoc($linhas2)){
										?>
											<option value="<?php echo $dados["id"]; ?>"><?php echo $dados["post_provincia_ingles"];?></option>
										<?php
									}
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
			$resultado=mysqli_query($connection,"SELECT a.*,b.post_provincia_ingles FROM transp_regiao_provincias a, post_provincias b WHERE a.regiao_id = $id and a.provincia_id=b.id");
			$linhas=mysqli_num_rows($resultado);
		?>	
		<div class="container theme-showcase" role="main">      
		<div class="row">
			<div class="col-md-12">
			<table class="table">
				<thead>
				<tr>
					<th>Provincias</th>			
					<th></th>
				</tr>
				</thead>
				<tbody>
					<?php 
						while($linhas = mysqli_fetch_array($resultado)){
							echo "<tr>";
								echo "<td>".$linhas['post_provincia_ingles']."</td>";
								
								?>
								<td align="right"> 
									<a href='processa/proc_apagar_provincia_regiao.php?provincia=<?php echo $linhas['provincia_id']; ?>&regiao=<?php echo $linhas['regiao_id']; ?>'><button type='button' class='btn btn-danger'>Retirar</button></a>
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


		<div class="page-header">
			<div class="container">
					<h1>Valor do Frete</h1>
			</div>
		</div>
		<div class="container theme-showcase" role="main"> 
			<div class="row">
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Caixa</label>
					<div class="col-sm-10">

						<select class="form-control" name="caixa_id">
						<option></option>
						<?php 
								$linhas2 =mysqli_query($connection,"SELECT * FROM caixas WHERE caixa_kg not in (select caixa_id from transp_valores where regiao_id=$id)");
								while($dados = mysqli_fetch_assoc($linhas2)){
									?>
										<option value="<?php echo $dados["caixa_kg"]; ?>"><?php echo $dados["caixa_kg"];?></option>
									<?php
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Valor do frete</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="transp_valor_frete" placeholder="Valor do frete">
					</div>
				</div>
			</div>
		</div>

		<?php
			$resultado=mysqli_query($connection,"SELECT *, (SELECT caixa_valor_embalagem FROM caixas WHERE caixa_kg=caixa_id) as valor_embalagem FROM transp_valores WHERE regiao_id = $id ORDER BY caixa_id");
			$linhas=mysqli_num_rows($resultado);
		?>	
		<div class="container theme-showcase" role="main">      
		<div class="row">
			<div class="col-md-12">
			<table class="table">
				<thead>
				<tr>
					<th>Peso (kg)</th>			
					<th>Valor do frete</th>
					<th>Valor da embalagem</th>
				</tr>
				</thead>
				<tbody>
					<?php 
						while($linhas = mysqli_fetch_array($resultado)){
							echo "<tr>";
								echo "<td>".$linhas['caixa_id']."</td>";
								echo "<td>".$linhas['transp_valor_frete']."</td>";
								echo "<td>".$linhas['valor_embalagem']."</td>";
								
								?>
								<td align="right"> 
									<a href='processa/proc_apagar_valor_frete.php?kg=<?php echo $linhas['caixa_id']; ?>&regiao=<?php echo $linhas['regiao_id']; ?>'><button type='button' class='btn btn-danger'>Retirar</button></a>
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

</form>