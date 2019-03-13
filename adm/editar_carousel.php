<?php
	$id = $_GET['id'];
	//Executa consulta
	$result = mysqli_query($connection,"SELECT * FROM carousels WHERE id = '$id' LIMIT 1");
	$linhas = mysqli_fetch_assoc($result);
?>

<form class="form-horizontal" method="POST" action="processa/proc_edit_carousel.php" enctype="multipart/form-data">
<div class="page-header">
<div class="container">
		<br>
		<h1>Editar Carousel</h1>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=70&id=<?php echo $linhas['id']; ?>' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>
				<!-- <button type='button' class='btn btn-danger' data-toggle="modal" data-target="#apagar<?php echo $linhas['id']; ?>">Apagar</button>-->
				<a href='administrativo.php?link=25' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>				
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
				<p>Deseja apagar este carousel?</p>
				<p><?php echo $linhas['id']; ?> - <?php echo $linhas['carousel_descricao'];?></p>
				</div>
				<div class="modal-footer">
				<a href='processa/proc_apagar_carousel?id=<?php echo $linhas['id']; ?>'><button type='button' class='btn btn-danger' onclick="<?php echo $loading;?>">Apagar</button></a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>

  <div class="row">
	<div class="col-md-12">
        <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao do Carousel</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="carousel_descricao" placeholder="Nome do Carousel" required="" value="<?php echo $linhas['carousel_descricao']; ?>">
			</div>
		  </div>

		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Situacao</label>
			<div class="col-sm-10">
				<select class="form-control" name="carousel_situacao" id="carousel_situacao">
                    <option value="<?php echo $linhas['carousel_situacao']; ?>"><?php if ($linhas['carousel_situacao']=='0'){ echo 'Inativo';} else {echo 'Ativo';} ?></option>
					<option value="0">Inativo</option>
					<option value="1">Ativo</option>
				</select>
			</div>
		  </div>  

		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Url</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="carousel_url" placeholder="Página de destino" value="<?php echo $linhas['carousel_url']; ?>">
			</div>
		  </div>  

		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Texto 1 Ingles</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="carousel_texto_1_ingles" placeholder="Página de destino" value="<?php echo $linhas['carousel_texto_1_ingles']; ?>">
			</div>
		  </div>
			
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Texto 1 Japones</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="carousel_texto_1_japones" placeholder="Página de destino" value="<?php echo $linhas['carousel_texto_1_japones']; ?>">
			</div>
		  </div>

		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Texto 2 Ingles</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="carousel_texto_2_ingles" placeholder="Página de destino" value="<?php echo $linhas['carousel_texto_2_ingles']; ?>">
			</div>
		  </div>  
			
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Texto 2 Japones</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="carousel_texto_2_japones" placeholder="Página de destino" value="<?php echo $linhas['carousel_texto_2_japones']; ?>">
			</div>
		  </div>  		  
		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Posicao Textos</label>
			<div class="col-sm-10">
				<select class="form-control" name="carousel_posicao_texto" id="carousel_posicao_texto">
                <option value="<?php echo $linhas['carousel_posicao_texto']; ?>"><?php if ($linhas['carousel_posicao_texto']=='kb_caption_center'){
                                                                                                echo 'Centralizado';
                                                                                            } else if ($linhas['carousel_posicao_texto']=='kb_caption_right'){
                                                                                                echo 'Direita';
                                                                                            } else if ($linhas['carousel_posicao_texto']=='kb_caption_esquerda'){
                                                                                                echo 'Esquerda';
                                                                                            }
                                                                                    ?>
                    </option>                
					<option value="kb_caption_center">Centralizado</option>
					<option value="kb_caption_right">Direita</option>
					<option value="kb_caption_esquerda">Esquerda</option>
				</select>
			</div>
		  </div>  

		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Efeito Texto 1</label>
			<div class="col-sm-10">
				<select class="form-control" name="carousel_efeito_texto_1" id="carousel_efeito_texto_1">
                    <option value="<?php echo $linhas['carousel_efeito_texto_1']; ?>"><?php if ($linhas['carousel_efeito_texto_1']=='flipInX'){
                                                                                                echo 'Girando';
                                                                                            } else if ($linhas['carousel_efeito_texto_1']=='fadeInDown'){
                                                                                                echo 'De cima para baixo';
                                                                                            } else if ($linhas['carousel_efeito_texto_1']=='fadeInUp'){
                                                                                                echo 'De baixo para cima';
                                                                                            } else if ($linhas['carousel_efeito_texto_1']=='fadeInLeft'){
                                                                                                echo 'Da esquerda para direita';
                                                                                            } else if ($linhas['carousel_efeito_texto_1']=='fadeInRight'){
                                                                                                echo 'Da direita para esquerda';
                                                                                            } 
                                                                                    ?>
                    </option>
                    <option value="flipInX">Girando</option>
                    <option value="fadeInDown">De cima para baixo</option>
                    <option value="fadeInUp">De baixo para cima</option>
                    <option value="fadeInLeft">Da esquerda para direita</option>
                    <option value="fadeInRight">Da direita para esquerda</option>
                </select>
			</div>
		  </div>  

		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Efeito Texto 2</label>
			<div class="col-sm-10">
				<select class="form-control" name="carousel_efeito_texto_2" id="carousel_efeito_texto_2">
                <option value="<?php echo $linhas['carousel_efeito_texto_2']; ?>"><?php if ($linhas['carousel_efeito_texto_2']=='flipInX'){
                                                                                                echo 'Girando';
                                                                                            } else if ($linhas['carousel_efeito_texto_2']=='fadeInDown'){
                                                                                                echo 'De cima para baixo';
                                                                                            } else if ($linhas['carousel_efeito_texto_2']=='fadeInUp'){
                                                                                                echo 'De baixo para cima';
                                                                                            } else if ($linhas['carousel_efeito_texto_2']=='fadeInLeft'){
                                                                                                echo 'Da esquerda para direita';
                                                                                            } else if ($linhas['carousel_efeito_texto_2']=='fadeInRight'){
                                                                                                echo 'Da direita para esquerda';
                                                                                            } 
                                                                                    ?>
                    </option>
                    <option value="flipInX">Girando</option>
                    <option value="fadeInDown">De cima para baixo</option>
                    <option value="fadeInUp">De baixo para cima</option>
                    <option value="fadeInLeft">Da esquerda para direita</option>
                    <option value="fadeInRight">Da direita para esquerda</option>
                </select>
			</div>
		  </div>   

		  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Foto do Carousel (1680x600)</label>
				<div class="col-sm-10">
				<input type="file" id="uploadFile" name="uploadFile" />	
				</div>
		  </div>  
          <input type="hidden" name="id" value="<?php echo $linhas['id']; ?>">
          Obs.: Se a imagem nova nao carregar apos ser alterada, aperte CTRL+F5 para atualizar a pagina.
          <iframe src="visual_carousel.php?id=<?php echo $id; ?>" name="content" width="100%" marginwidth="0" height="450" marginheight="0" align="top" scrolling="no" frameborder="0" hspace="0" vspace="0" allowtransparency="true" application="true"> </iframe>

	</div>
</div> <!-- /container -->
</form>