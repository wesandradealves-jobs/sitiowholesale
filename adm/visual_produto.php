<?php
	$id = $_GET['id'];
	//Executa consulta
	$result = mysqli_query($connection,"SELECT * FROM produtos WHERE id = '$id' LIMIT 1");
	$resultado = mysqli_fetch_assoc($result);
?>
<div class="container theme-showcase" role="main">      
	<div class="page-header">
		<h1>Visualizar Produto</h1>
	</div>
	
	<div class="row">
		<div class="pull-right">
			<a href='administrativo.php?link=10'><button type='button' class='btn btn-sm btn-info'>Listar</button></a>
							
			<a href='administrativo.php?link=13&id=<?php echo $resultado['id']; ?>'><button type='button' class='btn btn-sm btn-warning'>Editar</button></a>
			
			<a href='processa/proc_apagar_produto.php?id=<?php echo $resultado['id']; ?>'><button type='button' class='btn btn-sm btn-danger'>Apagar</button></a>
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
				<b>Nome do Produto:</b>
			</div>
			<div class="col-sm-9 col-md-11">
				<?php echo $resultado['nome']; ?>
			</div>
			
			<div class="col-sm-3 col-md-1">
				<b>Descrição Curta:</b>
			</div>
			<div class="col-sm-9 col-md-11">
				<?php echo $resultado['descricao_curta']; ?>
			</div>
			
			<div class="col-sm-3 col-md-1">
				<b>Descricao Longa:</b>
			</div>
			<div class="col-sm-9 col-md-11">
				<?php echo $resultado['descricao_longa']; ?>
			</div>
			
			<div class="col-sm-3 col-md-1">
				<b>Preço:</b>
			</div>
			<div class="col-sm-9 col-md-11">
				<?php echo $resultado['preco']; ?>
			</div>
			
			<div class="col-sm-3 col-md-1">
				<b>Tag:</b>
			</div>
			<div class="col-sm-9 col-md-11">
				<?php echo $resultado['tag']; ?>
			</div>
			
			<div class="col-sm-3 col-md-1">
				<b>Description:</b>
			</div>
			<div class="col-sm-9 col-md-11">
				<?php echo $resultado['description']; ?>
			</div>
			
			<div class="col-sm-3 col-md-1">
				<b>Imagem:</b>
			</div>
			<div class="col-sm-9 col-md-11">
				<?php $foto = $resultado['imagem']; ?>
				<img src="<?php echo "../foto/$foto"; ?>" width="100" height="100">
			</div>
			
			<div class="col-sm-3 col-md-1">
				<b>Situação:</b>
			</div>
			<div class="col-sm-9 col-md-11">
				<?php echo $resultado['situacao_id']; ?>
			</div>
			
			<div class="col-sm-3 col-md-1">
				<b>Categoria:</b>
			</div>
			<div class="col-sm-9 col-md-11">
				<?php echo $resultado['categoria_id']; ?>
			</div>
			
		</div>
	</div>
</div> <!-- /container -->

