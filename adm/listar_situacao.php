<?php 
	include "restrito.php";
	
	$resultado=mysqli_query($connection,"SELECT * FROM situacaos ORDER BY id");
	$linhas=mysqli_num_rows($resultado);
?>	
<div class="page-header">
	<div class="container">
		<br>
		<h1>Lista de Situacao
			<div class="pull-right">
				<a href="administrativo.php?link=15"><button type='button' class='btn btn-success' onclick="<?php echo $loading;?>">Cadastrar</button></a>
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
			<th>Ações</th>
		  </tr>
		</thead>
		<tbody>
			<?php 
				while($linhas = mysqli_fetch_array($resultado)){
					echo "<tr>";
						echo "<td>".$linhas['id']."</td>";
						echo "<td>".$linhas['nome']."</td>";
						
						?>
						<td align="right"> 
						<a href='administrativo.php?link=17&id=<?php echo $linhas['id']; ?>'><button type='button' class='btn btn-warning' onclick="<?php echo $loading;?>">Editar</button></a>
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

