<?php
	$id = $_GET['id'];
	//Executa consulta
	$result = mysqli_query($connection,"SELECT a.*,b.departamento_descricao_ingles  FROM categorias a LEFT JOIN departamentos b on a.departamento_id=b.id WHERE a.id = '$id' LIMIT 1");
	$linhas = mysqli_fetch_assoc($result);
?>

<form class="form-horizontal" method="POST" action="processa/proc_edit_cat_prod.php" enctype="multipart/form-data">
<div class="page-header">
<div class="container">
		<br>
		<h1>Editar Categoria</h1>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=9&id=<?php echo $linhas['id']; ?>' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>
				<?php
					if ($linhas['id'] > 1){
				?>
				<button type='button' class='btn btn-danger' data-toggle="modal" data-target="#apagar<?php echo $linhas['id']; ?>">Apagar</button>
				<?php
					}
				?>
				<a href='administrativo.php?link=7' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>				
			</div>
  </div>
</nav>


<div class="container theme-showcase" role="main">      
	<!-- Modal Apagar-->
	<div id="apagar<?php echo $linhas['id']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header alert-danger">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">CUIDADO</h4>
				</div>
				<div class="modal-body">
				<p>Deseja apagar esta categoria?</p>
				<p><?php echo $linhas['id']; ?> - <?php echo $linhas['categoria_descricao_ingles'];?></p>
				</div>
				<div class="modal-footer">
				<a href='processa/proc_apagar_cat_prod.php?id=<?php echo $linhas['id']; ?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-danger'>Apagar</button></a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>

  <div class="row">
	<div class="col-md-12">
	  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao Ingles</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="categoria_descricao_ingles" placeholder="Descricao da Categoria em Ingles" value="<?php echo $linhas['categoria_descricao_ingles']; ?>">
			</div>
		  </div>		 

			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao Japones</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="categoria_descricao_japones" placeholder="Descricao da Categoria em Japones" value="<?php echo $linhas['categoria_descricao_japones']; ?>">
			</div>
			</div>
			
			<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Departamento</label>
			<div class="col-sm-10">
			  <select class="form-control" name="departamento_id">
				<option value="<?php echo $linhas['departamento_id']; ?>"><?php echo $linhas['departamento_descricao_ingles']; ?></option>
				<option value="0"></option>
					<?php 
						$linhas2 =mysqli_query($connection,"SELECT * FROM departamentos");
						while($dados = mysqli_fetch_assoc($linhas2)){
							?>
								<option value="<?php echo $dados["id"]; ?>"><?php echo $dados["departamento_descricao_ingles"];?></option>
							<?php
						}
					?>
				</select>
			</div>
		  </div>
			<!-- Tipo de embalagem -->
			<div class="form-group">	
				<label for="inputEmail3" class="col-sm-2 control-label"></label>
				<div class="col-sm-10">		
					<label><input type="checkbox"  name="categoria_tela_principal" <?php if ( $linhas['categoria_tela_principal']=='1'){echo 'checked="checked"';} ?> value="">Mostrar na tela principal de vendas?</label>
				</div>
			</div>
			<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Imagem</label>
				<div class="col-sm-10">
					<style type="text/css">
						input[type=file]{
						display: inline;
						}
						#image_preview img{
						height: 200px;
						padding: 5px;
						}
					</style>
					<!-- Imagens ja cadastradas -->
					<div id="image_preview">
						<table align="left" border="0" cellspacing="0">
							<tr>
								<?php
								  if ($linhas["categoria_imagem"]) {
										echo '<td align="center" border="5"><img src="imagens/'.$linhas["categoria_imagem"].'.jpg"/><br>';
										echo '<a href="processa/proc_excluir_imagem_categoria.php?id='.$linhas["id"].'"><button type="button" class="btn btn-sm btn-danger">Excluir Imagem</button></a></td>';
									} else {
										echo '<input type="file" id="uploadFile" name="uploadFile" /><br>Tamanho da imagem para categoria deve ser 320x220 pixel';
									}
								?>
							<tr>
						</table>
					</div>
					<script type="text/javascript">
						$("#uploadFile").change(function(){
							$('#image_preview').html("");
							var total_file=document.getElementById("uploadFile").files.length;
							for(var i=0;i<total_file;i++)
							{
							$('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
							}
						});
					</script>
				</div>
			</div>
		  		  
		  <input type="hidden" name="id" value="<?php echo $linhas['id']; ?>">
	</div>
	</div>
</div> <!-- /container -->
</form>