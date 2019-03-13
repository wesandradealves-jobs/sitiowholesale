<?php 
	include "restrito.php";

	//Executa consulta
	$resultado = mysqli_query($connection,"SELECT * FROM nivel_acessos WHERE id = '$id' LIMIT 1");
	$linhas = mysqli_fetch_assoc($resultado);
?>
<form class="form-horizontal" method="POST" action="processa/proc_edit_nivel_acesso.php">
<div class="page-header">
<div class="container">
		<br>
		<h1>Editar Nivel de Acesso</h1>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=21&id=<?php echo $linhas['id']; ?>' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>
				<button type='button' class='btn btn-danger' data-toggle="modal" data-target="#apagar<?php echo $linhas['id']; ?>">Apagar</button>
				<a href='administrativo.php?link=18' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>		
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
			<div class="modal-body ">
				<p>Deseja apagar este nivel de acesso?</p>
				<p><?php echo $linhas['id']; ?> - <?php echo $linhas['nome_nivel'];?></p>
			</div>
			<div class="modal-footer">
				<a href='processa/proc_apagar_nivel_acesso.php?id=<?php echo $linhas['id']; ?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-sm btn-danger'>Apagar</button></a>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
	</div>

  <div class="row">
	<div class="col-md-12">
	  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="nome_nivel" placeholder="Nome Completo" value="<?php echo $linhas['nome_nivel']; ?>">
			</div>
		  </div>		  
		  
		  <input type="hidden" name="id" value="<?php echo $linhas['id']; ?>">
	</div>
	</div>
</div> <!-- /container -->
</form>