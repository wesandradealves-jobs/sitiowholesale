<form class="form-horizontal" method="POST" action="processa/proc_cad_carousel.php" enctype="multipart/form-data">
<div class="page-header">
	<div class="container">
		<br>
		<h1>Cadastrar Carousel</h1>
	</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=24' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>	
				<a href='administrativo.php?link=25' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>				
			</div>
  </div>
</nav>

<div class="container theme-showcase" role="main">      
  <div class="row">
	<div class="col-md-12">
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao do Carousel</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="carousel_descricao" placeholder="Nome do Carousel" required="">
			</div>
		  </div>

		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Situacao</label>
			<div class="col-sm-10">
				<select class="form-control" name="carousel_situacao" id="carousel_situacao">
					<option value="0">Inativo</option>
					<option value="1">Ativo</option>
				</select>
			</div>
		  </div>  

		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Url</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="carousel_url" placeholder="Página de destino">
			</div>
		  </div>  

		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Texto 1 Ingles</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="carousel_texto_1_ingles" placeholder="Página de destino">
			</div>
		  </div>
			
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Texto 1 Japones</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="carousel_texto_1_japones" placeholder="Página de destino">
			</div>
		  </div>

		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Texto 2 Ingles</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="carousel_texto_2_ingles" placeholder="Página de destino">
			</div>
		  </div>  
			
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Texto 2 Japones</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="carousel_texto_2_japones" placeholder="Página de destino">
			</div>
		  </div>  		  
		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Posicao Textos</label>
			<div class="col-sm-10">
				<select class="form-control" name="carousel_posicao_texto" id="carousel_posicao_texto">
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
	</div>
	</div>
</div> <!-- /container -->
</form>