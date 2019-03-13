<?php 
	include "restrito.php";
?>

<form class="form-horizontal" method="POST" action="processa/proc_cad_situacao_pedido.php">
<div class="page-header">
	<div class="container">
		<br>
		<h1>Cadastrar Situacao de Pedido</h1>
	</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=68' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>	
				<a href='administrativo.php?link=69' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>				
			</div>
  </div>
</nav>
<div class="container theme-showcase" role="main">
  <div class="row">
	<div class="col-md-12" >
	  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao Ingles</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="pedido_situacao_descricao_ingles" placeholder="Descricao da situacao em ingles">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao Japones</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="pedido_situacao_descricao_japones" placeholder="Descricao da situacao em Japones">
			</div>
		  </div>
	</div>
	</div>
</div> <!-- /container -->
</form>