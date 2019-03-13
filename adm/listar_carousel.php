<?php
	$resultado=mysqli_query($connection,"SELECT * FROM carousels ORDER BY carousel_situacao desc, carousel_sequencia, id asc");
	
	echo "aqui";		
?>	
<div class="page-header">
	<div class="container">
		<br>
		<h1>Lista de Carousel
			<div class="pull-right">
				<a href="administrativo.php?link=24"><button type='button' class='btn btn-success' onclick="<?php echo $loading;?>">Cadastrar</button></a>
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
			 <th>Sequencia</th>
			 <th>Ações</th>
		  </tr>
		</thead>
		<tbody>
			<?php 
				while($linhas = mysqli_fetch_array($resultado)){	
					$carousel_id = $linhas['id'];
					echo "<tr>";
					echo "<td>".$linhas['id']."</td>";
					echo "<td>".$linhas['carousel_descricao']."</td>";
					echo "<td>".$linhas['carousel_sequencia']."</td>";
						?>
						<td align="right"> 
						<?php if($linhas['carousel_situacao'] == '1'){ ?>
										<button type='button' class='btn btn-danger' data-toggle="modal" data-target="#apagar<?php echo $linhas['id']; ?>">Inativar</button>
										<!-- Modal Apagar-->
										<div id="apagar<?php echo $linhas['id']; ?>" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header alert-danger">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 align="left" class="modal-title">CUIDADO</h4>
													</div>
													<div class="modal-body">
														<p align="left">Deseja inativar este banner do carousel da loja?</p>
														<p align="left"><?php echo $linhas['id']; ?> - <?php echo $linhas['carousel_descricao'];?></p>
													</div>
													<div class="modal-footer">
														<a href='processa/proc_edit_ordem_carousel.php?situacao=3&id=<?php echo $carousel_id; ?>&seq=<?php echo $linhas['carousel_sequencia'];?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-danger'>Inativar</button></a>
														<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
													</div>
												</div>
											</div>
										</div>
										<a href='processa/proc_edit_ordem_carousel.php?situacao=1&id=<?php echo $carousel_id; ?>&seq=<?php echo $linhas['carousel_sequencia'];?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-primary'><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></button></a>
										<a href='processa/proc_edit_ordem_carousel.php?situacao=2&id=<?php echo $carousel_id; ?>&seq=<?php echo $linhas['carousel_sequencia'];?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-primary'><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></button></a>		
						<?php	} else { ?>
										<button type='button' class='btn btn-success' data-toggle="modal" data-target="#apagar<?php echo $linhas['id']; ?>">Ativar</button>
										<!-- Modal Apagar-->
										<div id="apagar<?php echo $linhas['id']; ?>" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header alert-danger">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 align="left" class="modal-title">CUIDADO</h4>
													</div>
													<div class="modal-body">
														<p align="left">Deseja ativar este banner do carousel da loja?</p>
														<p align="left"><?php echo $linhas['id']; ?> - <?php echo $linhas['carousel_descricao'];?></p>
													</div>
													<div class="modal-footer">
														<a href='processa/proc_edit_ordem_carousel.php?situacao=4&id=<?php echo $carousel_id; ?>&seq=<?php echo $linhas['carousel_sequencia'];?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-danger'>Ativar</button></a>
														<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
													</div>
												</div>
											</div>
										</div>
						<?php	} ?>
						<a href='administrativo.php?link=70&id=<?php echo $carousel_id; ?>'><button type='button' class='btn btn-warning' onclick="<?php echo $loading;?>">Editar</button></a>
					</tr>
					<?php
				}
			?>
		</tbody>
	  </table>
	</div>
	</div>
</div> <!-- /container -->