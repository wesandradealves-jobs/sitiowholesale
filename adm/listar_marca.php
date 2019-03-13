
<?php
	
	$resultado=mysqli_query($connection,"SELECT * FROM marcas ORDER BY id");
	$linhas=mysqli_num_rows($resultado);
?>	
<div class="page-header">
	<div class="container">
		<br>
		<h1>Lista de Marca
			<div class="pull-right">
			<a href="administrativo.php?link=31"><button type='button' class='btn btn-success' onclick="<?php echo $loading;?>">Cadastrar</button></a>
			</div>
		</h1>
	</div>
</div>

<div class="container theme-showcase" role="main">      
  <div class="row">
	<div class="col-md-12">
	  <table class="table">
		<thead>
		  <tr>
			<th>ID</th>
			<th>Descricao</th>
			<th>Ações</th>
		  </tr>
		</thead>
		<tbody>
			<?php 
				while($linhas = mysqli_fetch_array($resultado)){
					echo "<tr>";
						echo "<td>".$linhas['id']."</td>";
						echo "<td>".$linhas['marca_descricao']."</td>";
						
						?>
						<td align="right"> 
				<?php
					if ($linhas['id'] > 1){
				?>
						<a href='administrativo.php?link=34&id=<?php echo $linhas['id']; ?>'><button type='button' class='btn btn-warning' onclick="<?php echo $loading;?>">Editar</button></a>
						<button type='button' class='btn btn-danger' data-toggle="modal" data-target="#apagar<?php echo $linhas['id']; ?>">Apagar</button>
				<?php
					}
				?>
						<!-- Modal Apagar-->
						<div id="apagar<?php echo $linhas['id']; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header alert-danger">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title" align="left">CUIDADO</h4>
									</div>
									<div class="modal-body">
									<p align="left">Deseja apagar esta marca?</p>
									<p align="left"><?php echo $linhas['id']; ?> - <?php echo $linhas['marca_descricao'];?></p>
									</div>
									<div class="modal-footer">
										<a href='processa/proc_apagar_marca.php?id=<?php echo $linhas['id']; ?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-danger'>Apagar</button></a>
										<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
									</div>
								</div>
							</div>
						</div>

						<?php
					echo "</tr>";
				}
			?>
		</tbody>
	  </table>
	</div>
	</div>
</div> <!-- /container -->

