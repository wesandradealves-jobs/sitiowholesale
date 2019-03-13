<?php
	//pelo metodo POST
	if ( isset( $_POST["cliente_nome"] ) ) {
		$cliente_nome	= $_POST['cliente_nome'];
	} else {
		$cliente_nome	= "";
	}
	if ( isset( $_POST["cliente_email"] ) ) {
		$cliente_email	= $_POST['cliente_email'];
	} else {
		$cliente_email	= "";
	}
	if ( isset( $_POST["cliente_telefone"] ) ) {
		$cliente_telefone	= $_POST['cliente_telefone'];
	} else {
		$cliente_telefone	= "";
	}
	if ( isset( $_POST["cliente_cellfone"] ) ) {
		$cliente_cellfone	= $_POST['cliente_cellfone'];
	} else {
		$cliente_cellfone	= "";
	}
	if ( isset( $_POST["cliente_cep"] ) ) {
		$cliente_cep	= $_POST['cliente_cep'];
	} else {
		$cliente_cep	= "";
	}
	if ( isset( $_POST["cliente_pedido"] ) ) {
		$cliente_pedido	= $_POST['cliente_pedido'];
	} else {
		$cliente_pedido	= "";
	}

		//pelo metodo GET
	if ( isset( $_GET["f1"] ) ) {
		$cliente_nome	= $_GET['f1'];
	} 
	if ( isset( $_GET["f2"] ) ) {
		$cliente_email = $_GET['f2'];
	}
	if ( isset( $_GET["f3"] ) ) {
		$cliente_telefone = $_GET['f3'];
	}
	if ( isset( $_GET["f4"] ) ) {
		$cliente_cellfone = $_GET['f4'];
	}
	if ( isset( $_GET["f5"] ) ) {
		$cliente_cep = $_GET['f5'];
	}
	if ( isset( $_GET["f6"] ) ) {
		$cliente_pedido = $_GET['f6'];
	}

	$query = "";

	if ($cliente_nome) {
		$query = " AND cliente_nome like '%".$cliente_nome."%' ";
	} 
	if ($cliente_email) {
		$query = $query." AND cliente_email like '%".$cliente_email."%' ";			
	} 
	if ($cliente_telefone) {
		$query = $query."AND cliente_telefone = '".$cliente_telefone."' ";			
	} 
	if ($cliente_cellfone) {
		$query = $query."AND cliente_cellfone = '".$cliente_cellfone."' ";			
	}
	if ($cliente_cep) {
		$query = $query."AND cep_id = '".$cliente_cep."' ";			
	}
	if ($cliente_pedido) {
		$query = $query." AND id in (SELECT cliente_id FROM pedidos WHERE id = ".$cliente_pedido.") ";			
	} 

	
	if ($query) {
		$resultado=mysqli_query($connection,"SELECT *
											   FROM clientes
											  WHERE cliente_email IS NOT NULL $query");
		$linhas=mysqli_num_rows($resultado);
	} else {
		$resultado=mysqli_query($connection,"SELECT * FROM clientes WHERE 1=2");
		$linhas=mysqli_num_rows($resultado);	
	}
?>	
<script>
	//fucao de numeros
	function somenteNumeros(num) {
		var er = /[^0-9]/;
		er.lastIndex = 0;
		var campo = num;
		if (er.test(campo.value)) {
		campo.value = "";
		}
	}
</script>

<div class="page-header">
	<div class="container">
		<br>
		<h1>Lista de Cliente
			<div class="pull-right ">
				<!-- <a href="administrativo.php?link=11"><button type='button' class='btn btn-success' onclick="<?php echo $loading;?>">Cadastrar</button></a> -->
			</div>
		</h1>
	</div>
</div>

<div class="container theme-showcase" role="main"> 
  <div class="row ">
		<form class="form-horizontal" method="POST" action="administrativo.php?link=71">
			<!-- Filtro de pesquisa -->
			<div class="tab-content">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="cliente_nome" placeholder="Digite o nome" value="<?php echo $cliente_nome;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="cliente_email" placeholder="Digite o email" value="<?php echo $cliente_email;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Telefone</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="cliente_telefone" placeholder="Digite o telefone" onkeyup="somenteNumeros(this);"  value="<?php echo $cliente_telefone;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Celular</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="cliente_cellfone" placeholder="Digite o celular" onkeyup="somenteNumeros(this);" value="<?php echo $cliente_cellfone;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">CEP</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="cliente_cep" placeholder="Digite o cep" onkeyup="somenteNumeros(this);" maxlength="7" value="<?php echo $cliente_cep;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Pedido</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="cliente_pedido" placeholder="Digite o pedido" onkeyup="somenteNumeros(this);" value="<?php echo $cliente_pedido;?>">
					</div>
				</div>
				<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
						<div class="pull-right">
							<a href="administrativo.php?link=71"><button type='button' class='btn btn-primary' onclick="<?php echo $loading;?>">Limpar</button></a>
							<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Pesquisar</button>
						</div>
					</div>	
				</div>			
			</div>
		</form>

		<div class="col-md-12">
			<table class="table">
			<thead>
				<tr>
				<th>Nome</th>
				<th>Email</th>
				<th>Telefone</th>
				<th>Celular</th>
				<th>Cep</th>
				<th>Acoes</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					while($linhas = mysqli_fetch_array($resultado)){
						echo "<tr>";
						echo "<td>".$linhas['cliente_nome']."</td>";
						echo "<td>".$linhas['cliente_email']."</td>";
						echo "<td>".$linhas['cliente_telefone']."</td>";
						echo "<td>".$linhas['cliente_cellfone']."</td>";
						echo "<td>".$linhas['cep_id']."</td>";
						?>
							<td><a href='administrativo.php?link=72&id=<?php echo $linhas['id']; ?>' onclick="<?php echo $loading;?>"><i class='fa fa-search-plus' style='font-size:25px;' aria-hidden='true'></i></a></td>
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