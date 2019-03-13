<?php
	$id = $_GET['id'];
	//Executa consulta
	$resultado = mysqli_query($connection,"SELECT * FROM caixas WHERE caixa_kg = '$id' LIMIT 1");
	$linhas = mysqli_fetch_assoc($resultado);
?>
<form class="form-horizontal" method="POST" action="processa/proc_edit_caixa.php">
<div class="page-header">
<div class="container">
		<br>
		<h1>Editar Caixa</h1>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=65&id=<?php echo $linhas['caixa_kg']; ?>' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>
				<button type='button' class='btn btn-danger' data-toggle="modal" data-target="#apagar<?php echo $linhas['caixa_kg']; ?>">Apagar</button>
				<a href='administrativo.php?link=64' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>				
			</div>
  </div>
</nav>

<div class="container theme-showcase" role="main">      
	<!-- Modal Apagar-->
	<div id="apagar<?php echo $linhas['caixa_kg']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header alert-danger">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">CUIDADO</h4>
				</div>
				<div class="modal-body">
					<p>Deseja apagar esta caixa?</p>
					<p><?php echo $linhas['caixa_kg']; ?></p>
				</div>
				<div class="modal-footer">
					<a href='processa/proc_apagar_caixa.php?id=<?php echo $linhas['caixa_kg']; ?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-sm btn-danger'>Apagar</button></a>
					<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>


  <div class="row">
	<div class="col-md-12" >
	  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Peso da Caixa (KG)</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="caixa_kg" placeholder="Peso da caixa em KG" value="<?php echo $linhas['caixa_kg']; ?>" disabled>
			</div>
	  </div>
		  
	  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Valor Embalagem</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="caixa_valor_embalagem" placeholder="Valor da embalagem (caixa + fita + outros)" value="<?php echo $linhas['caixa_valor_embalagem']; ?>">
			</div>
	   </div>
	</div>
    <input type="hidden" name="id" value="<?php echo $linhas['caixa_kg']; ?>">
</div> <!-- /container -->
</form>