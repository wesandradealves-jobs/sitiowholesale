<form class="form-horizontal" method="POST" action="processa/proc_cad_cat_prod.php" enctype="multipart/form-data">
<div class="page-header">
	<div class="container">
		<br>
		<h1>Cadastrar Categoria</h1>
	</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=6' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>	
				<a href='administrativo.php?link=7' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>				
			</div>
  </div>
</nav>
<div class="container theme-showcase" role="main">
  <div class="row">
	<div class="col-md-12" >
	  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao Ingles</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="categoria_descricao_ingles" maxlength="17" placeholder="Descricao da Categoria em Ingles">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao Japones</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="categoria_descricao_japones" maxlength="17" placeholder="Descricao da Categoria em Japones">
			</div>
			</div>
			
		  <div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Departamento</label>
				<div class="col-sm-10">
					<select class="form-control" name="departamento_id">
					<option value="0"></option>
					<?php 
							$resultado =mysqli_query($connection,"SELECT * FROM departamentos");
							while($dados = mysqli_fetch_assoc($resultado)){
								?>
									<option value="<?php echo $dados["id"]; ?>"><?php echo $dados["departamento_descricao_ingles"];?></option>
								<?php
							}
						?>
					</select>
				</div>
			</div>
			<!-- Tipo de embalagem -->
			<div class="form-group">	
				<label for="inputEmail3" class="col-sm-2 control-label"></label>
				<div class="col-sm-10">		
					<label><input type="checkbox"  name="categoria_tela_principal" value="">Mostrar na tela principal de vendas?</label>
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Imagem</label>
				<div class="col-sm-10">
					<input type="file" id="uploadFile" name="uploadFile" /><br>Tamanho da imagem para categoria deve ser 320x220 pixel
				</div>
			</div>
	</div>
</div> <!-- /container -->
</form>