<?php
	$id = $_GET['id'];
	//Executa consulta
	$resultado = mysqli_query($connection,"SELECT * FROM grades WHERE id = '$id' LIMIT 1");
	$linhas = mysqli_fetch_assoc($resultado);

	$resultado2 = mysqli_query($connection,"SELECT * FROM grade_itens WHERE grade_id = '$id' LIMIT 1");
	$linhas2 = mysqli_fetch_assoc($resultado2);
?>
<form class="form-horizontal" method="POST" action="processa/proc_edit_grade.php">
<div class="page-header">
<div class="container">
		<br>
		<h1>Editar Grade</h1>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=42&id=<?php echo $linhas['id']; ?>' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>
				<?php
					if ($linhas['id'] > 1){
				?>
				<button type='button' class='btn btn-danger' data-toggle="modal" data-target="#apagar<?php echo $linhas['id']; ?>">Apagar</button>
				<?php
					}
				?>
				<a href='administrativo.php?link=40' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>				
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
					<p>Deseja apagar a grade?</p>
					<p><?php echo $linhas['id']; ?> - <?php echo $linhas['grade_descricao'];?></p>
				</div>
				<div class="modal-footer">
					<a href='processa/proc_apagar_grade.php?id=<?php echo $linhas['id']; ?>' onclick="<?php echo $loading;?>"><button type='button' class='btn btn-sm btn-danger'>Apagar</button></a>
					<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>

  <div class="row">
	<div class="col-md-12">
	  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="grade_descricao" placeholder="Descricao da Grade"  required="required" value="<?php echo $linhas['grade_descricao']; ?>">
			</div>
		  </div>		 

		  <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Numero de Tamanhos</label>
			<div class="col-sm-10">
			  <select class="form-control" name="grade_quantidade_tamanhos" id="options" disabled>
				<option value="<?php echo $linhas['grade_quantidade_tamanhos']; ?>"><?php echo $linhas['grade_quantidade_tamanhos']; ?></option>
				</select>
			</div>
		  </div>

		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tamanho Ingles</label>
			<div class="col-sm-10">
			  <label id="item_ingles_00" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] != 0 ){echo "none"; } else{ echo "block";} ?>;">N/A</label>
			  <input type="text" id="item_ingles_01" name="ingles_01" placeholder="Tam. 01" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 0 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['ingles_01']; ?>">
				<input type="text" id="item_ingles_02" name="ingles_02" placeholder="Tam. 02" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 1 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['ingles_02']; ?>">
			  <input type="text" id="item_ingles_03" name="ingles_03" placeholder="Tam. 03" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 2 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['ingles_03']; ?>">
			  <input type="text" id="item_ingles_04" name="ingles_04" placeholder="Tam. 04" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 3 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['ingles_04']; ?>">
			  <input type="text" id="item_ingles_05" name="ingles_05" placeholder="Tam. 05" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 4 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['ingles_05']; ?>">
			  <input type="text" id="item_ingles_06" name="ingles_06" placeholder="Tam. 06" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 5 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['ingles_06']; ?>">
			  <input type="text" id="item_ingles_07" name="ingles_07" placeholder="Tam. 07" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 6 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['ingles_07']; ?>">
			  <input type="text" id="item_ingles_08" name="ingles_08" placeholder="Tam. 08" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 7 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['ingles_08']; ?>">
			  <input type="text" id="item_ingles_09" name="ingles_09" placeholder="Tam. 09" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 8 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['ingles_09']; ?>">
			  <input type="text" id="item_ingles_10" name="ingles_10" placeholder="Tam. 10" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 9 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['ingles_10']; ?>">
			</div>
		  </div>

			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tamanho Japones</label>
			<div class="col-sm-10">
				<label id="item_japones_00" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] != 0 ){echo "none"; } else{ echo "block";} ?>;">N/A</label>
				<input type="text" id="item_japones_01" name="japones_01" placeholder="Tam. 01" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 0 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['japones_01']; ?>">
				<input type="text" id="item_japones_02" name="japones_02" placeholder="Tam. 02" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 1 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['japones_02']; ?>">
				<input type="text" id="item_japones_03" name="japones_03" placeholder="Tam. 03" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 2 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['japones_03']; ?>">
				<input type="text" id="item_japones_04" name="japones_04" placeholder="Tam. 04" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 3 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['japones_04']; ?>">
				<input type="text" id="item_japones_05" name="japones_05" placeholder="Tam. 05" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 4 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['japones_05']; ?>">
				<input type="text" id="item_japones_06" name="japones_06" placeholder="Tam. 06" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 5 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['japones_06']; ?>">
				<input type="text" id="item_japones_07" name="japones_07" placeholder="Tam. 07" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 6 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['japones_07']; ?>">
				<input type="text" id="item_japones_08" name="japones_08" placeholder="Tam. 08" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 7 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['japones_08']; ?>">
				<input type="text" id="item_japones_09" name="japones_09" placeholder="Tam. 09" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 8 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['japones_09']; ?>">
				<input type="text" id="item_japones_10" name="japones_10" placeholder="Tam. 10" size="9" style="display:<?php if ( $linhas['grade_quantidade_tamanhos'] > 9 ){echo "block"; } else{ echo "none";} ?>; float:left;" value="<?php echo $linhas2['japones_10']; ?>">
			</div>
		  </div>
		  <input type="hidden" name="id" value="<?php echo $linhas['id']; ?>">
	</div>
	</div>
</div> <!-- /container -->
</form>