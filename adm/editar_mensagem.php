<?php
	$id = $_GET['id'];
	//Executa consulta
	$result = mysqli_query($connection,"SELECT * FROM mensagens WHERE id = '$id' LIMIT 1");
	$linhas = mysqli_fetch_assoc($result);
?>

<form class="form-horizontal" method="POST" action="processa/proc_edit_mensagem.php">
<div class="page-header">
<div class="container">
		<br>
		<h1>Editar mensagem</h1>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=54&id=<?php echo $linhas['id']; ?>' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>
				<button type='button' class='btn btn-danger' data-toggle="modal" data-target="#apagar<?php echo $linhas['id']; ?>">Apagar</button>
				<a href='administrativo.php?link=53' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>				
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
				<p>Deseja apagar esta mensagem?</p>
				<p><?php echo $linhas['id']; ?> - <?php echo $linhas['mensagem_ingles'];?></p>
				</div>
				<div class="modal-footer">
				<a href='processa/proc_apagar_mensagem.php?id=<?php echo $linhas['id']; ?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-danger'>Apagar</button></a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>

  <div class="row">
	<div class="col-md-12">
	  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao Ingles</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="mensagem_ingles" placeholder="Descricao da mensagem em Ingles" value="<?php echo $linhas['mensagem_ingles']; ?>">
			</div>
		  </div>		 

			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao Japones</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="mensagem_japones" placeholder="Descricao da mensagem em Japones" value="<?php echo $linhas['mensagem_japones']; ?>">
			</div>
		  </div>
		  		  
		  <input type="hidden" name="id" value="<?php echo $linhas['id']; ?>">
	</div>
	</div>
</div> <!-- /container -->
</form>