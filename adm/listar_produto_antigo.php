<?php
	$resultado=mysqli_query($connection,"SELECT * FROM produtos ORDER BY 'id'");
	$linhas=mysqli_num_rows($resultado);
?>	
<div class="page-header">
	<div class="container">
		<br>
		<h1>Lista de Produtos
			<div class="pull-right ">
				<a href="administrativo.php?link=11"><button type='button' class='btn btn-success' onclick="<?php echo $loading;?>">Cadastrar</button></a>
			</div>
		</h1>
	</div>
</div>
<div class="container theme-showcase" role="main"> 
  <div class="row ">
	<div class="col-md-12">
	  <table class="table">
		<thead>
		  <tr>
			<th>ID</th>
			<th>Codigo</th>
			<th>Descricao</th>
			<th>Situacao</th>
			<th>Acoes</th>
		  </tr>
		</thead>
		<tbody>
			<?php 
				while($linhas = mysqli_fetch_array($resultado)){
					echo "<tr>";
					echo "<td>".$linhas['id']."</td>";
					echo "<td>".$linhas['produto_codigo_cliente']."</td>";
					echo "<td>".$linhas['produto_descricao_ingles']."</td>";
					echo "<td>".$linhas['situacao_id']."</td>";
					?>
					<td align="right"> 
						<a href='administrativo.php?link=13&id=<?php echo $linhas['id']; ?>'><button type='button' class='btn btn-warning' onclick="<?php echo $loading;?>">Editar</button></a>
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

