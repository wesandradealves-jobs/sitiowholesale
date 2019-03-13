<?php
	$resultado=mysqli_query($connection,"SELECT * FROM contatos ORDER BY id asc");
	$linhas=mysqli_num_rows($resultado);
	$contr_sob = $linhas;
?>	
<div class="page-header">
	<div class="container">
		<br>
		<h1>Lista de mensagem de Contato</h1>
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
			<th>Assunto</th>
			<th>Data</th>
			 <th>Ações</th>
		  </tr>
		</thead>
		<tbody>
			<?php 
				while($linhas = mysqli_fetch_array($resultado)){					
					$carousel_id = $linhas['id'];
					echo "<tr>";
						echo "<td>".$linhas['id']."</td>";
						echo "<td>".$linhas['nome']."</td>";
						echo "<td>".$linhas['assunto']."</td>";
						$data = $linhas['created'];
						echo "<td>".date('Y/m/d', strtotime($data))."</td>";
						?>
						<td align="right"> 
						<a href='#'><button type='button' class='btn btn-sm btn-primary' onclick="<?php echo $loading;?>">Visualizar</button></a>
						<a href='#'><button type='button' class='btn btn-sm btn-danger'>Apagar</button></a>
						<?php
					echo "</tr>";
				}
			?>
		</tbody>
	  </table>
	</div>
	</div>
</div> <!-- /container -->

