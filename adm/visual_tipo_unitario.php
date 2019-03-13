<?php
	$id = $_GET['id'];
	//Executa consulta
	$result = mysqli_query($connection,"SELECT * FROM categorias WHERE id = '$id' LIMIT 1");
	$resultado = mysqli_fetch_assoc($result);
?>
<div class="container theme-showcase" role="main">      
	<div class="page-header">
		<h1>Visualizar Categoria</h1>
	</div>
	
	<div class="row">
		<div class="pull-right">
			<a href='administrativo.php?link=7&id=<?php echo $resultado['id']; ?>'><button type='button' class='btn btn-sm btn-info'>Listar</button></a>
							
			<a href='administrativo.php?link=9&id=<?php echo $resultado['id']; ?>'><button type='button' class='btn btn-sm btn-warning'>Editar</button></a>
			
			<a href='processa/proc_apagar_cat_prod.php?id=<?php echo $resultado['id']; ?>'><button type='button' class='btn btn-sm btn-danger'>Apagar</button></a>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class=" col-sm-3 col-md-1">
				<b>Id:</b>
			</div>
			<div class=" col-sm-9 col-md-11">
				<?php echo $resultado['id']; ?>
			</div>
			
			<div class="col-sm-3 col-md-1">
				<b>Nome da Categoria:</b>
			</div>
			<div class="col-sm-9 col-md-11">
				<?php echo $resultado['nome']; ?>
			</div>
			
			<div class="col-sm-3 col-md-1">
				<b>Slug:</b>
			</div>
			<div class="col-sm-9 col-md-11">
				<?php echo $resultado['slug']; ?>
			</div>
			
			<div class="col-sm-3 col-md-1">
				<b>Palavra chave:</b>
			</div>
			<div class="col-sm-9 col-md-11">
				<?php echo $resultado['tag']; ?>
			</div>
			
			<div class="col-sm-3 col-md-1">
				<b>Descrição:</b>
			</div>
			<div class="col-sm-9 col-md-11">
				<?php echo $resultado['description']; ?>
			</div>
		</div>
	</div>
</div> <!-- /container -->

