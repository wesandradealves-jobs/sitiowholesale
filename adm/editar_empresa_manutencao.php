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
<form class="form-horizontal" method="POST" action="processa/proc_edit_empresa_manutencao.php">
<div class="page-header">
<div class="container">
		<br>
		<h1>Configurar Manutencao</h1>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=88&id=<?php echo $linhas['id']; ?>' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>
			</div>
  </div>
</nav>

<div class="container theme-showcase" role="main">      
  <div class="row">
		<div class="col-md-12">

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Situacao</label>
                <div class="col-sm-10">
                    <select class="form-control" name="empresa_manutencao">
                        <option value="<?php if (!isset($linhas['empresa_manutencao'])){ echo '0';} else { echo $linhas['empresa_manutencao'];} ?>">
                            <?php if (!isset($linhas['empresa_manutencao']) || $linhas['empresa_manutencao']==0){ echo 'Desativo';} 
                                  else if ($linhas['empresa_manutencao']==1){ echo 'Ativo';}
                            ?>
                        </option>
                        <option value="0">Desativo</option>
                        <option value="1">Ativo</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Texto</label> 
				<div class="col-sm-10">
                    <textarea class="form-control" rows="30" name="empresa_texto_manutencao" placeholder="Texto da manutencao"><?php echo $linhas['empresa_texto_manutencao']; ?></textarea>
				</div>
			</div>	
			<input type="hidden" name="id" value="<?php echo $linhas['id']; ?>">
		</div>
	</div>
</div> <!-- /container -->
</form>