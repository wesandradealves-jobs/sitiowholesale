<form class="form-horizontal" method="POST" action="processa/proc_cad_caixa.php" enctype="multipart/form-data">
<div class="page-header">
	<div class="container">
		<br>
		<h1>Cadastrar Caixa</h1>
	</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=63' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>	
				<a href='administrativo.php?link=64' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>				
			</div>
  </div>
</nav>
<div class="container theme-showcase" role="main">
  <div class="row">
	<div class="col-md-12" >
	  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Peso da Caixa (KG)</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="caixa_kg" placeholder="Peso da caixa em KG">
			</div>
	  </div>
		  
	  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Valor Embalagem</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="caixa_valor_embalagem" placeholder="Valor da embalagem (caixa + fita + outros)">
			</div>
	   </div>
	</div>
</div> <!-- /container -->
</form>