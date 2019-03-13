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
<form class="form-horizontal" method="POST" action="processa/proc_edit_empresa_frete.php">
<div class="page-header">
<div class="container">
		<br>
		<h1>Politica de Frete</h1>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=84&id=<?php echo $linhas['id']; ?>' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>
			</div>
  </div>
</nav>

<div class="container theme-showcase" role="main">      
  <div class="row">
		<div class="col-md-12">
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Titulo ingles</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="empresa_titulo_frete_ingles" placeholder="titulo em ingles" value="<?php echo $linhas['empresa_titulo_frete_ingles']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Texto em Ingles</label>
				<div class="col-sm-10">
                    <textarea class="form-control" rows="5" name="empresa_texto_frete_ingles" placeholder="Texto em Ingles"><?php echo $linhas['empresa_texto_frete_ingles']; ?></textarea>
				</div>
			</div>	
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Titulo Japones</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="empresa_titulo_frete_japones" placeholder="titulo em Japones" value="<?php echo $linhas['empresa_titulo_frete_japones']; ?>">
				</div>
			</div>
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Texto em Japones</label> 
				<div class="col-sm-10">
                    <textarea class="form-control" rows="5" name="empresa_texto_frete_japones" placeholder="Texto em Japones"><?php echo $linhas['empresa_texto_frete_japones']; ?></textarea>
				</div>
			</div>	

			<input type="hidden" name="id" value="<?php echo $linhas['id']; ?>">
		</div>
	</div>
</div> <!-- /container -->
</form>