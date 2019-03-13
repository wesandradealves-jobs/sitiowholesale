<?php
	//Executa consulta
	$resultado = mysqli_query($connection,"SELECT * FROM empresa WHERE id = 1 LIMIT 1");
    $linhas = mysqli_fetch_assoc($resultado);
    
    if (!isset($linhas['id'])){
        $resultado = mysqli_query($connection,"INSERT INTO empresa (id, empresa_criacao) values ('1','".date($now)."')");
        $resultado = mysqli_query($connection,"SELECT * FROM empresa WHERE id = 1 LIMIT 1");
        $linhas = mysqli_fetch_assoc($resultado);
    }
?>
<form class="form-horizontal" method="POST" action="processa/proc_edit_empresa_contas_email.php">
<div class="page-header">
<div class="container">
		<br>
		<h1>Contas de Email</h1>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=75&id=<?php echo $linhas['id']; ?>' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>
			</div>
  </div>
</nav>

<div class="container theme-showcase" role="main">      
  <div class="row">
		<div class="col-md-12">

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">Email de contato</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="empresa_email_contato" placeholder="Email de contato" value="<?php echo $linhas['empresa_email_contato']; ?>">
                    (Email de contato pelo site, este deve ser verificado)
				</div>
			</div>	
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">Email do sistema</label> 
				<div class="col-sm-9">
					<input type="text" class="form-control" name="empresa_email_sistema" placeholder="Email do sistema" value="<?php echo $linhas['empresa_email_sistema']; ?>">
                    (Email para recuperacao de senha e avisos automaticos do sistema, o cliente não responde)
				</div>
			</div>	

			<input type="hidden" name="id" value="<?php echo $linhas['id']; ?>">
		</div>
	</div>
</div> <!-- /container -->
</form>