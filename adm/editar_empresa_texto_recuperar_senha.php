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
<form class="form-horizontal" method="POST" action="processa/proc_edit_empresa_texto_recuperacao_senha.php">
<div class="page-header">
<div class="container">
		<br>
		<h1>Texto para Recuperacao de Senha</h1>
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
				<label for="inputEmail3" class="col-sm-2 control-label">Assunto ingles</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="empresa_assunto_recuperar_senha_ingles" placeholder="Assunto em ingles" value="<?php echo $linhas['empresa_assunto_recuperar_senha_ingles']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Texto em Ingles</label>
				<div class="col-sm-10">
                    <textarea class="form-control" rows="5" name="empresa_texto_recuperar_senha_ingles" placeholder="Texto em Ingles"><?php echo $linhas['empresa_texto_recuperar_senha_ingles']; ?></textarea>
                    (Colocar no texto a variavel $link para referenciar o "clique no link") ex: clique no link $link para redefinir a senha 
				</div>
			</div>	
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Assunto Japones</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="empresa_assunto_recuperar_senha_japones" placeholder="Assunto em Japones" value="<?php echo $linhas['empresa_assunto_recuperar_senha_japones']; ?>">
				</div>
			</div>
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Texto em Japones</label> 
				<div class="col-sm-10">
                    <textarea class="form-control" rows="5" name="empresa_texto_recuperar_senha_japones" placeholder="Texto em Japones"><?php echo $linhas['empresa_texto_recuperar_senha_japones']; ?></textarea>
                    (Colocar no texto a variavel $link para referenciar o "clique no link") ex: clique no link $link para redefinir a senha 
				</div>
			</div>	

			<input type="hidden" name="id" value="<?php echo $linhas['id']; ?>">
		</div>
	</div>
</div> <!-- /container -->
</form>