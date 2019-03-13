<form class="form-horizontal" method="POST" action="processa/proc_cad_subcat_prod.php">
<div class="page-header">
	<div class="container">
		<br>
		<h1>Cadastrar Sub Categoria</h1>
	</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
			<br>
			<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
			<a href='administrativo.php?link=27' class='btn btn-warning' onclick="<?php echo $loading;?>" >Cancelar</a>	
			<a href='administrativo.php?link=28' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>					
			</div>
  </div>
</nav>

<div class="container theme-showcase" role="main">      
  <div class="row">
	<div class="col-md-12">
	  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao Ingles</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="subcategoria_descricao_ingles" placeholder="Descricao da Sub Categoria em Ingles">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao Japones</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="subcategoria_descricao_japones" placeholder="Descricao da Sub Categoria em Japones">
			</div>
		  </div>

		  <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Categoria</label>
			<div class="col-sm-10">
			  <select class="form-control" name="categoria_id">
				<option value="0"></option>
				<?php 
						$resultado =mysqli_query($connection,"SELECT * FROM categorias");
						while($dados = mysqli_fetch_assoc($resultado)){
							?>
								<option value="<?php echo $dados["id"]; ?>"><?php echo $dados["categoria_descricao_ingles"];?></option>
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