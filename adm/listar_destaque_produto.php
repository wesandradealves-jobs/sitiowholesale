<?php
	//Pesquisar o id dos produtos em destaque no nivel 1 página principal
	$resultado_prod_dest=mysqli_query($connection,"SELECT * FROM destaques_produtos WHERE nivel_um='1' ORDER BY ordem ASC");
	$linhas_prod_dest=mysqli_num_rows($resultado_prod_dest);
	$contr_sob = $linhas_prod_dest;
?>	
<div class="container theme-showcase" role="main">      
  <div class="page-header">
	<h1>Produtos em destaque nivel 1</h1>
  </div>
  <div class="row">
	<div class="col-md-12">
	  <table class="table">
		<thead>
		  <tr>
			<th>ID Produto</th>
			<th>Nome</th>
			<th>Preco</th>
			<th>Situação</th>
			<th>Ordem</th>
			<th>Ações</th>
		  </tr>
		</thead>
		<tbody>
			<?php 
				$contr_ord = 1;
				while($linhas_prod_dest = mysqli_fetch_array($resultado_prod_dest)){
					//id do produto na tabela produto em destaque
					$produto_id = $linhas_prod_dest['produto_id'];
					$produto_dest_id = $linhas_prod_dest['id'];
					
					//Selecionar os dados do produto no BD
					$resultado_prod=mysqli_query($connection,"SELECT * FROM produtos WHERE id='$produto_id' LIMIT 1");
					$linhas_prod=mysqli_fetch_assoc($resultado_prod);
					
					echo "<tr>";
						echo "<td>".$linhas_prod['id']."</td>";
						echo "<td>".$linhas_prod['nome']."</td>";
						echo "<td>".$linhas_prod['preco']."</td>";
						echo "<td>".$linhas_prod['situacao_id']."</td>";						
						echo "<td>".$linhas_prod_dest['ordem']."</td>";						
						?>
						<td> 
						<?php if($contr_sob != $contr_ord){ ?>
							<a href='processa/proc_edit_ordem_nivel_um.php?situacao=1&id=<?php echo $produto_dest_id; ?>'><button type='button' class='btn btn-sm btn-primary'><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></button></a>
						<?php }else{ ?>	
							<a href='#'><button type='button' class='btn btn-sm btn-primary'><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></button></a>
						<?php } ?>
						<?php if($contr_ord != 1){ ?>
							<a href='processa/proc_edit_ordem_nivel_um.php?situacao=2&id=<?php echo $produto_dest_id; ?>'><button type='button' class='btn btn-sm btn-primary'><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></button></a>		
						<?php }else{ ?>	
							<a href='#'><button type='button' class='btn btn-sm btn-primary'><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></button></a>
						<?php } ?>	
						<a href='processa/proc_edit_ordem_nivel_um.php?situacao=3&id=<?php echo $produto_dest_id; ?>'><button type='button' class='btn btn-sm btn-danger'>Retirar</button></a>
						
						<?php
					echo "</tr>";
					$contr_ord = $contr_ord + 1; 
				}
			?>
		</tbody>
	  </table>
	</div>
	</div>
	
	<?php
	//Pesquisar o id dos produtos em destaque no nivel 1 página principal
	$resultado_prod_dest_dois=mysqli_query($connection,"SELECT * FROM destaques_produtos WHERE nivel_dois='1' ORDER BY ordem ASC");
	$linhas_prod_dest_dois=mysqli_num_rows($resultado_prod_dest_dois);
	$contr_sob_dois = $linhas_prod_dest_dois;	
	?>
	<div class="page-header">
	<h1>Produtos em destaque nivel 2</h1>
  </div>
  <div class="row">
	<div class="col-md-12">
	  <table class="table">
		<thead>
		  <tr>
			<th>ID Produto</th>
			<th>Nome</th>
			<th>Preco</th>
			<th>Situação</th>
			<th>Ordem</th>
			<th>Ações</th>
		  </tr>
		</thead>
		<tbody>
			<?php 
				$contr_ord_dois = 1;
				while($linhas_prod_dest_dois = mysqli_fetch_array($resultado_prod_dest_dois)){
					//id do produto na tabela produto em destaque
					$produto_id_dois = $linhas_prod_dest_dois['produto_id'];
					$produto_dest_id_dois = $linhas_prod_dest_dois['id'];
					
					//Selecionar os dados do produto no BD
					$resultado_prod_dois=mysqli_query($connection,"SELECT * FROM produtos WHERE id='$produto_id_dois' LIMIT 1");
					$linhas_prod_dois=mysqli_fetch_assoc($resultado_prod_dois);
					echo "<tr>";
						echo "<td>".$linhas_prod_dois['id']."</td>";
						echo "<td>".$linhas_prod_dois['nome']."</td>";
						echo "<td>".$linhas_prod_dois['preco']."</td>";
						echo "<td>".$linhas_prod_dois['situacao_id']."</td>";
												
						echo "<td>".$linhas_prod_dest_dois['ordem']."</td>";	
						?>
						<td> 
						<?php if($contr_sob_dois != $contr_ord_dois){ ?>
							<a href='processa/proc_edit_ordem_nivel_dois.php?situacao=1&id=<?php echo $produto_dest_id_dois; ?>'><button type='button' class='btn btn-sm btn-primary'><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></button></a>
						<?php }else{ ?>	
							<a href='#'><button type='button' class='btn btn-sm btn-primary'><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></button></a>
						<?php } ?>
						<?php if($contr_ord_dois != 1){ ?>
							<a href='processa/proc_edit_ordem_nivel_dois.php?situacao=2&id=<?php echo $produto_dest_id_dois; ?>'><button type='button' class='btn btn-sm btn-primary'><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></button></a>		
						<?php }else{ ?>	
							<a href='#'><button type='button' class='btn btn-sm btn-primary'><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></button></a>
						<?php } ?>	
						<a href='processa/proc_edit_ordem_nivel_dois.php?situacao=3&id=<?php echo $produto_dest_id_dois; ?>'><button type='button' class='btn btn-sm btn-danger'>Retirar</button></a>
						
						<?php
					echo "</tr>";
					$contr_ord_dois = $contr_ord_dois + 1; 
				}
			?>
		</tbody>
	  </table>
	</div>
	</div>
	
</div> <!-- /container -->

