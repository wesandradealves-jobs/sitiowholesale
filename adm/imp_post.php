<?php 
	include "restrito.php";
?>
<form class="form-horizontal" method="POST" action="administrativo.php?link=56">
<div class="page-header">
	<div class="container">
		<br>
		<h1>Importacao de Post (CEP)</h1>
	</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Importar</button>		
			</div>
  </div>
</nav>

<div class="container theme-showcase" role="main">   
  <div class="row">
		<div class="col-md-12">
		  <div class="form-group">
				<label for="inputEmail3" class="col-sm-14 control-label">Importar o arquivo da pasta: post/roman2.txt</label><br>
				<label for="inputEmail3" class="col-sm-14 control-label">Base de dados: https://fabrice.jp/japan-national-postal-code-list-in-roman</label>
		  </div>
		</div>
	</div>
</div> <!-- /container -->
</form>