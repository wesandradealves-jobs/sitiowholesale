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
<form class="form-horizontal" method="POST" action="processa/proc_edit_empresa_paypal.php">
<div class="page-header">
<div class="container">
		<br>
		<h1>Configuracao do PayPal</h1>
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
				<label for="inputEmail3" class="col-sm-3 control-label">Usuario de producao (USER)</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="empresa_paypal_user_producao" placeholder="Usuario de producao (USER)" value="<?php echo $linhas['empresa_paypal_user_producao']; ?>">
				</div>
			</div>	
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">Password producao (PSWD)</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="empresa_paypal_pswd_producao" placeholder="Password producao (PSWD)" value="<?php echo $linhas['empresa_paypal_pswd_producao']; ?>">
				</div>
			</div>	
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">Assinatura de producao (SIGNATURE)</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="empresa_paypal_signature_producao" placeholder="Assinatura de producao (SIGNATURE)" value="<?php echo $linhas['empresa_paypal_signature_producao']; ?>">
				</div>
			</div>	

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">Usuario de teste - sandbox (USER)</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="empresa_paypal_user_sandbox" placeholder="Usuario de teste - sandbox (USER)" value="<?php echo $linhas['empresa_paypal_user_sandbox']; ?>">
				</div>
			</div>	
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">Password teste - sandbox (PSWD)</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="empresa_paypal_pswd_sandbox" placeholder="Password teste - sandbox (PSWD)" value="<?php echo $linhas['empresa_paypal_pswd_sandbox']; ?>">
				</div>
			</div>	
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">Assinatura de teste - sandbox (SIGNATURE)</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="empresa_paypal_signature_sandbox" placeholder="Assinatura de teste - sandbox (SIGNATURE)" value="<?php echo $linhas['empresa_paypal_signature_sandbox']; ?>">
				</div>
			</div>	

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Versao</label>
                <div class="col-sm-9">
                    <select class="form-control" name="empresa_paypal_tipo">
                        <option value="<?php if (!isset($linhas['empresa_paypal_tipo'])){ echo '0';} else { echo $linhas['empresa_paypal_tipo'];} ?>">
                            <?php if (!isset($linhas['empresa_paypal_tipo']) || $linhas['empresa_paypal_tipo']==0){ echo 'Teste (sandbox)';} 
                                  else if ($linhas['empresa_paypal_tipo']==1){ echo 'Producao';}
                            ?>
                        </option>
                        <option value="0">Teste (sandbox)</option>
                        <option value="1">Producao</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Situacao</label>
                <div class="col-sm-9">
                    <select class="form-control" name="empresa_paypal_situacao">
                        <option value="<?php if (!isset($linhas['empresa_paypal_situacao'])){ echo '0';} else { echo $linhas['empresa_paypal_situacao'];} ?>">
                            <?php if (!isset($linhas['empresa_paypal_situacao']) || $linhas['empresa_paypal_situacao']==0){ echo 'Desativo';} 
                                  else if ($linhas['empresa_paypal_situacao']==1){ echo 'Ativo';}
                            ?>
                        </option>
                        <option value="0">Desativo</option>
                        <option value="1">Ativo</option>
                    </select>
                </div>
            </div>


			<input type="hidden" name="id" value="<?php echo $linhas['id']; ?>">
		</div>
	</div>
</div> <!-- /container -->
</form>