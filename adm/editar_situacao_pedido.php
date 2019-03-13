<?php 
	include "restrito.php";

	$id = $_GET['id'];
	//Executa consulta
	$result = mysqli_query($connection,"SELECT * FROM pedido_situacao WHERE id = '$id' LIMIT 1");
	$linhas = mysqli_fetch_assoc($result);
?>

<form class="form-horizontal" method="POST" action="processa/proc_edit_situacao_pedido.php">
<div class="page-header">
<div class="container">
		<br>
		<h1>Editar Situacao de Pedido</h1>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=68&id=<?php echo $linhas['id']; ?>' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>
				<a href='administrativo.php?link=69' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>				
			</div>
  </div>
</nav>


<div class="container theme-showcase" role="main">      
  <div class="row">
	<div class="col-md-12">
	  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao Ingles</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="pedido_situacao_descricao_ingles" placeholder="Descricao em Ingles" value="<?php echo $linhas['pedido_situacao_descricao_ingles']; ?>">
			</div>
		  </div>		 

			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao Japones</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="pedido_situacao_descricao_japones" placeholder="Descricao em Japones" value="<?php echo $linhas['pedido_situacao_descricao_japones']; ?>">
			</div>
		  </div>
		  		  
		  <input type="hidden" name="id" value="<?php echo $linhas['id']; ?>">
	</div>
	</div>
</div> <!-- /container -->
</form>