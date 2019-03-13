<?php 
	include "restrito.php";

	$result=mysqli_query($connection,"SELECT * FROM pedido_situacao ORDER BY id");
	$linhas=mysqli_num_rows($result);
?>	

<div class="page-header">
	<div class="container">
		<br>
		<h1>Lista situcao de pedido
			<div class="pull-right">
				<a href="administrativo.php?link=68"><button type='button' class='btn btn-success' onclick="<?php echo $loading;?>">Cadastrar</button></a>
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
						echo "<td>".$linhas['id']."</td>";
						echo "<td>".$linhas['pedido_situacao_descricao_ingles']."</td>";
                        echo "<td>".$linhas['pedido_situacao_descricao_japones']."</td>";
                        ?>
						<td align="right"> 
                            <a href='administrativo.php?link=68&id=<?php echo $linhas['id']; ?>'><button type='button' class='btn btn-warning' onclick="<?php echo $loading;?>">Editar</button></a>
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



