<?php
	$id = $_GET['id'];
	//Executa consulta
	$resultado = mysqli_query($connection,"SELECT * FROM usuarios WHERE id = '$id' LIMIT 1");
	$linhas = mysqli_fetch_assoc($resultado);
?>
<form class="form-horizontal" method="POST" action="processa/proc_edit_usuario.php">
<div class="page-header">
<div class="container">
		<br>
		<h1>Editar Usuario</h1>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=4&id=<?php echo $linhas['id']; ?>' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>
				<button type='button' class='btn btn-danger' data-toggle="modal" data-target="#apagar<?php echo $linhas['id']; ?>">Apagar</button>
				<a href='administrativo.php?link=2' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>				
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
					<p>Deseja apagar este usuario?</p>
					<p><?php echo $linhas['id']; ?> - <?php echo $linhas['nome'];?></p>
				</div>
				<div class="modal-footer">
				<a href='processa/proc_apagar_usuario.php?id=<?php echo $linhas['id']; ?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-sm btn-danger'>Apagar</button></a>
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
			  <input type="text" class="form-control" name="nome" placeholder="Nome Completo" value="<?php echo $linhas['nome']; ?>">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">E-mail</label>
			<div class="col-sm-10">
			  <input type="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo $linhas['email']; ?>">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Usuário</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="usuario" placeholder="Usuário" value="<?php echo $linhas['login']; ?>">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Senha</label>
			<div class="col-sm-10">
			  <input type="password" class="form-control" name="senha" placeholder="Senha">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Nivel de Acesso</label>
			<div class="col-sm-10">
			  <select class="form-control" name="nivel_de_acesso">
					<option>Selecione</option>
					<option value="1"
					<?php
						if( $linhas['nivel_acesso_id'] == 1){
							echo 'selected';
						}
					?>
					>Administrativo</option>
					<option value="2"
					<?php
						if( $linhas['nivel_acesso_id'] == 2){
							echo 'selected';
						}
					?>
					>Usuário</option>
				</select>
			</div>
		  </div>
		  
		  <input type="hidden" name="id" value="<?php echo $linhas['id']; ?>">
	</div>
	</div>
</div> <!-- /container -->
</form>