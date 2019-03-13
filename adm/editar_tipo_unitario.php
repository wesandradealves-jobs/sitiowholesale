<?php
	$id = $_GET['id'];
	//Executa consulta
	$resultado = mysqli_query($connection,"SELECT * FROM tipo_unitario WHERE id = '$id' LIMIT 1");
	$linhas = mysqli_fetch_assoc($resultado);
?>
<form class="form-horizontal" method="POST" action="processa/proc_edit_tipo_unitario.php">
<div class="page-header">
<div class="container">
		<br>
		<h1>Editar Tipo Unitario</h1>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=46&id=<?php echo $linhas['id']; ?>' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>
				<?php
					if ($linhas['id'] > 1){
				?>
				<button type='button' class='btn btn-danger' data-toggle="modal" data-target="#apagar<?php echo $linhas['id']; ?>">Apagar</button>
				<?php
					}
				?>
				<a href='administrativo.php?link=44' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>		
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
				<p>Deseja apagar este tipo unitario? </p>
				<p><?php echo $linhas['id']; ?> - <?php echo $linhas['tipo_unitario_descricao_ingles'];?></p>
				</div>
				<div class="modal-footer">
				<a href='processa/proc_apagar_tipo_unitario.php?id=<?php echo $linhas['id']; ?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-sm btn-danger'>Apagar</button></a>
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
			  <input type="text" class="form-control" name="tipo_unitario_descricao_ingles" placeholder="Descricao do tipo_unitario em Ingles" value="<?php echo $linhas['tipo_unitario_descricao_ingles']; ?>">
			</div>
		  </div>		 

			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao Japones</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="tipo_unitario_descricao_japones" placeholder="Descricao do tipo_unitario em Japones" value="<?php echo $linhas['tipo_unitario_descricao_japones']; ?>">
			</div>
			</div>
			
			<div class="form-group">	
			<label for="inputEmail3" class="col-sm-2 control-label"></label>
				<div class="col-sm-10">		
						<label><input type="checkbox" <?php if ($linhas['tipo_unitario_fracao']=='1'){echo 'checked="checked"';} ?> name="tipo_unitario_fracao" value="">Aceita fracionar</label>
				</div>
			</div>
		  		  
		  <input type="hidden" name="id" value="<?php echo $linhas['id']; ?>">
	</div>
	</div>
</div> <!-- /container -->
</form>