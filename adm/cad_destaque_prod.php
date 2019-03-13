
<div class="container theme-showcase" role="main">      
  <div class="page-header">
		<h1>Pesquisar produtos para destacar</h1>
	</div>
	<div class="row">
	<div class="col-md-12">
	  <form action="administrativo.php?link=23" class="form-horizontal" method="POST" >
	  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="nome" placeholder="Nome do Produto">
			</div>
		  </div>
		  
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <input type="submit" class="btn btn-success" value="Pesquisar">
			</div>
		  </div>
		</form>
	</div>
	</div>
	<?php
	$nome = $_POST['nome'];
	if ($nome != ""){
		$resultado=mysqli_query($connection,"SELECT * FROM produtos WHERE nome LIKE '%$nome%' ORDER BY id ASC");
		$linhas=mysqli_num_rows($resultado);	?>
		<div class="row">
			<div class="col-md-12">
			  <table class="table">
				<thead>
				  <tr>
					<th>ID</th>
					<th>Nome</th>
					<th>Preco</th>
					<th>Situação</th>
					<th>Destacar no</th>
				  </tr>
				</thead>
				<tbody>
					<?php 
						while($linhas = mysqli_fetch_array($resultado)){
							$id_prod = $linhas['id'];
							echo "<tr>";
								echo "<td>".$linhas['id']."</td>";
								echo "<td>".$linhas['nome']."</td>";
								echo "<td>".$linhas['preco']."</td>";
								echo "<td>".$linhas['situacao_id']."</td>";
								?>
								<td> 
								<a href='processa/proc_cad_destaque_prod.php?situacao=1&id=<?php echo $id_prod; ?>'><button type='button' class='btn btn-sm btn-primary' onclick="<?php echo $loading;?>">Nivel 1</button></a>
								
								<a href='processa/proc_cad_destaque_prod.php?situacao=2&id=<?php echo $id_prod; ?>'><button type='button' class='btn btn-sm btn-primary' onclick="<?php echo $loading;?>">Nivel 2</button></a>
								
								<a href='#'><button type='button' class='btn btn-sm btn-primary' onclick="<?php echo $loading;?>">Interessante</button></a>
								
								<?php
							echo "</tr>";
						}
					?>
				</tbody>
			  </table>
			</div>
			</div>
	<?php }	?>
</div> <!-- /container -->

