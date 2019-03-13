
<?php	
	$resultado=mysqli_query($connection,"SELECT * FROM usuarios ORDER BY 'id'");
	$linhas=mysqli_num_rows($resultado);
?>	     
<div class="page-header">
	<div class="container">
		<br>
		<h1>Lista de Usuario
			<div class="pull-right">
				<a href="administrativo.php?link=3"><button type='button' class='btn btn-success' onclick="<?php echo $loading;?>">Cadastrar</button></a>
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
			<th>Nome</th>
			<th>E-mail</th>
			<th>Nivel de Acesso</th>
			<th>Ações</th>
		  </tr>
		</thead>
		<tbody>
			<?php 
				while($linhas = mysqli_fetch_array($resultado)){
					echo "<tr>";
						echo "<td>".$linhas['id']."</td>";
						echo "<td>".$linhas['nome']."</td>";
						echo "<td>".$linhas['email']."</td>";
						echo "<td>".$linhas['nivel_acesso_id']."</td>";
						?>
						<td align="right"> 
						<a href='administrativo.php?link=4&id=<?php echo $linhas['id']; ?>'><button type='button' class='btn btn-warning' onclick="<?php echo $loading;?>">Editar</button></a>
						<button type='button' class='btn btn-danger' data-toggle="modal" data-target="#apagar<?php echo $linhas['id']; ?>">Apagar</button>
						<!-- Modal Apagar-->
						<div id="apagar<?php echo $linhas['id']; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header alert-danger">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 align="left" class="modal-title">CUIDADO</h4>
									</div>
									<div class="modal-body">
										<p align="left">Deseja apagar este usuario?</p>
										<p align="left"><?php echo $linhas['id']; ?> - <?php echo $linhas['nome'];?></p>
									</div>
									<div class="modal-footer">
									<a href='processa/proc_apagar_usuario.php?id=<?php echo $linhas['id']; ?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-danger'>Apagar</button></a>
										<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
									</div>
								</div>
							</div>
						</div>
						</td> 
						<?php
					echo "</tr>";
				}
			?>
		</tbody>
	  </table>
	</div>
	</div>
</div> <!-- /container -->

