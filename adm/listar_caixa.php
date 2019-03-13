<?php
	
	$resultado=mysqli_query($connection,"SELECT * FROM caixas ORDER BY caixa_kg");
	$linhas=mysqli_num_rows($resultado);
?>	
<div class="page-header">
	<div class="container">
		<br>
		<h1>Lista de Caixas
			<div class="pull-right">
			<a href="administrativo.php?link=63"><button type='button' class='btn btn-success' onclick="<?php echo $loading;?>">Cadastrar</button></a>
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
			<th>Peso (KG)</th>
			<th>Valor da Embalagem</th>
			<th>Ações</th>
		  </tr>
		</thead>
		<tbody>
			<?php 
				while($linhas = mysqli_fetch_array($resultado)){
					echo "<tr>";
						echo "<td>".$linhas['caixa_kg']."</td>";
						echo "<td>".$linhas['caixa_valor_embalagem']."</td>";
						
						?>
						<td align="right"> 
						<a href='administrativo.php?link=65&id=<?php echo $linhas['caixa_kg']; ?>'><button type='button' class='btn btn-warning' onclick="<?php echo $loading;?>">Editar</button></a>
						<button type='button' class='btn btn-danger' data-toggle="modal" data-target="#apagar<?php echo $linhas['caixa_kg']; ?>">Apagar</button>

						<!-- Modal Apagar-->
						<div id="apagar<?php echo $linhas['caixa_kg']; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header alert-danger">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title" align="left">CUIDADO</h4>
									</div>
									<div class="modal-body">
									<p align="left">Deseja apagar esta caixa?</p>
									<p align="left"><?php echo $linhas['caixa_kg']; ?></p>
									</div>
									<div class="modal-footer">
										<a href='processa/proc_apagar_caixa.php?id=<?php echo $linhas['caixa_kg']; ?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-danger'>Apagar</button></a>
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

