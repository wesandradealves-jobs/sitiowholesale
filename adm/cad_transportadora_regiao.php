<form class="form-horizontal" method="POST" action="processa/proc_cad_transportadora_regiao.php">
<div class="page-header">
	<div class="container">
		<br>
		<h1>Cadastrar Regiao</h1>
	</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
			<a href='administrativo.php?link=60' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>	
			<a href='administrativo.php?link=61' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>					
			</div>
  </div>
</nav>

<div class="container theme-showcase" role="main">      
  <div class="row">
	<div class="col-md-12">
	  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao Ingles</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="transp_regiao_ingles" placeholder="Descricao da Regiao em Ingles" required>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao Japones</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="transp_regiao_japones" placeholder="Descricao da Regiao em Japones" required>
			</div>
		  </div>

		  <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Transportadora</label>
			<div class="col-sm-10">
			  <select class="form-control" name="transportadora_id">
				<?php 
						$resultado =mysqli_query($connection,"SELECT * FROM transportadoras");
						while($dados = mysqli_fetch_assoc($resultado)){
							?>
								<option value="<?php echo $dados["id"]; ?>"><?php echo $dados["transportadora_ingles"];?></option>
							<?php
						}
					?>
				</select>
			</div>
		  </div>
	</div>
	</div>
</div> <!-- /container -->
</form>