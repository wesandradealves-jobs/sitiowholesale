<?php
	$result=mysqli_query($connection,"SELECT * FROM mensagens ORDER BY id");
	$linhas=mysqli_num_rows($result);
?>	

<div class="page-header">
	<div class="container">
		<br>
		<h1>Lista de mensagens
			<div class="pull-right">
				<a href="administrativo.php?link=52"><button type='button' class='btn btn-success' onclick="<?php echo $loading;?>">Cadastrar</button></a>
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
			<th>Ingles</th>
			<th>Japones</th>			
			<th>Ações</th>
		  </tr>
		</thead>
		<tbody>
			<?php 
				while($linhas = mysqli_fetch_array($result)){
					echo "<tr>";
						echo "<td><h6>".$linhas['id']."</h6></td>";
						echo "<td><h6>".$linhas['mensagem_ingles']."</h6></td>";
						echo "<td><h6>".$linhas['mensagem_japones']."</h6></td>";
						
						?>
						<td align="right"> 
						<a href='administrativo.php?link=54&id=<?php echo $linhas['id']; ?>'><button type='button' class='btn btn-warning' onclick="<?php echo $loading;?>">Editar</button></a>
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
									<p align="left">Deseja apagar esta mensagem?</p>
									<p align="left"><?php echo $linhas['id']; ?> - <?php echo $linhas['mensagem_ingles'];?></p>
									</div>
									<div class="modal-footer">
									<a href='processa/proc_apagar_mensagem.php?id=<?php echo $linhas['id']; ?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-danger'>Apagar</button></a>
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



