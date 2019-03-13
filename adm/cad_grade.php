<form class="form-horizontal" method="POST" action="processa/proc_cad_grade.php">
<div class="page-header">
	<div class="container">
		<br>
		<h1>Cadastrar Grade</h1>
	</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
  <div class="container">
			<div class="pull-right">
				<br>
				<button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
				<a href='administrativo.php?link=39' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>	
				<a href='administrativo.php?link=40' class='btn btn-primary' onclick="<?php echo $loading;?>">Listar</a>				
			</div>
  </div>
</nav>


<div class="container theme-showcase" role="main">      
  <div class="row">
	<div class="col-md-12">	  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descricao</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="grade_descricao" required="required" placeholder="Descricao da Grade">
			</div>
		  </div>
			<script type="text/javascript">
				function optionCheck(){
						var option = document.getElementById("options").value;
						if(option == "00"){
							document.getElementById('item_ingles_00').style.display = 'Block';
							document.getElementById('item_ingles_01').style.display = 'none';
							document.getElementById('item_ingles_02').style.display = 'none';
							document.getElementById('item_ingles_03').style.display = 'none';
							document.getElementById('item_ingles_04').style.display = 'none';
							document.getElementById('item_ingles_05').style.display = 'none';
							document.getElementById('item_ingles_06').style.display = 'none';
							document.getElementById('item_ingles_07').style.display = 'none';
							document.getElementById('item_ingles_08').style.display = 'none';
							document.getElementById('item_ingles_09').style.display = 'none';
							document.getElementById('item_ingles_10').style.display = 'none';
							document.getElementById('item_japones_00').style.display = 'block';
							document.getElementById('item_japones_01').style.display = 'none';
							document.getElementById('item_japones_02').style.display = 'none';
							document.getElementById('item_japones_03').style.display = 'none';
							document.getElementById('item_japones_04').style.display = 'none';
							document.getElementById('item_japones_05').style.display = 'none';
							document.getElementById('item_japones_06').style.display = 'none';
							document.getElementById('item_japones_07').style.display = 'none';
							document.getElementById('item_japones_08').style.display = 'none';
							document.getElementById('item_japones_09').style.display = 'none';
							document.getElementById('item_japones_10').style.display = 'none';
						}
						if(option == "01"){
							document.getElementById('item_ingles_00').style.display = 'none';
							document.getElementById('item_ingles_01').style.display = 'block';
							document.getElementById('item_ingles_02').style.display = 'none';
							document.getElementById('item_ingles_03').style.display = 'none';
							document.getElementById('item_ingles_04').style.display = 'none';
							document.getElementById('item_ingles_05').style.display = 'none';
							document.getElementById('item_ingles_06').style.display = 'none';
							document.getElementById('item_ingles_07').style.display = 'none';
							document.getElementById('item_ingles_08').style.display = 'none';
							document.getElementById('item_ingles_09').style.display = 'none';
							document.getElementById('item_ingles_10').style.display = 'none';
							document.getElementById('item_japones_00').style.display = 'none';
							document.getElementById('item_japones_01').style.display = 'block';
							document.getElementById('item_japones_02').style.display = 'none';
							document.getElementById('item_japones_03').style.display = 'none';
							document.getElementById('item_japones_04').style.display = 'none';
							document.getElementById('item_japones_05').style.display = 'none';
							document.getElementById('item_japones_06').style.display = 'none';
							document.getElementById('item_japones_07').style.display = 'none';
							document.getElementById('item_japones_08').style.display = 'none';
							document.getElementById('item_japones_09').style.display = 'none';
							document.getElementById('item_japones_10').style.display = 'none';
						}
						if(option == "02"){
							document.getElementById('item_ingles_00').style.display = 'none';
							document.getElementById('item_ingles_01').style.display = 'block';
							document.getElementById('item_ingles_02').style.display = 'block';
							document.getElementById('item_ingles_03').style.display = 'none';
							document.getElementById('item_ingles_04').style.display = 'none';
							document.getElementById('item_ingles_05').style.display = 'none';
							document.getElementById('item_ingles_06').style.display = 'none';
							document.getElementById('item_ingles_07').style.display = 'none';
							document.getElementById('item_ingles_08').style.display = 'none';
							document.getElementById('item_ingles_09').style.display = 'none';
							document.getElementById('item_ingles_10').style.display = 'none';
							document.getElementById('item_japones_00').style.display = 'none';
							document.getElementById('item_japones_01').style.display = 'block';
							document.getElementById('item_japones_02').style.display = 'block';
							document.getElementById('item_japones_03').style.display = 'none';
							document.getElementById('item_japones_04').style.display = 'none';
							document.getElementById('item_japones_05').style.display = 'none';
							document.getElementById('item_japones_06').style.display = 'none';
							document.getElementById('item_japones_07').style.display = 'none';
							document.getElementById('item_japones_08').style.display = 'none';
							document.getElementById('item_japones_09').style.display = 'none';
							document.getElementById('item_japones_10').style.display = 'none';
						}
						if(option == "03"){
							document.getElementById('item_ingles_00').style.display = 'none';
							document.getElementById('item_ingles_01').style.display = 'block';
							document.getElementById('item_ingles_02').style.display = 'block';
							document.getElementById('item_ingles_03').style.display = 'block';
							document.getElementById('item_ingles_04').style.display = 'none';
							document.getElementById('item_ingles_05').style.display = 'none';
							document.getElementById('item_ingles_06').style.display = 'none';
							document.getElementById('item_ingles_07').style.display = 'none';
							document.getElementById('item_ingles_08').style.display = 'none';
							document.getElementById('item_ingles_09').style.display = 'none';
							document.getElementById('item_ingles_10').style.display = 'none';
							document.getElementById('item_japones_00').style.display = 'none';
							document.getElementById('item_japones_01').style.display = 'block';
							document.getElementById('item_japones_02').style.display = 'block';
							document.getElementById('item_japones_03').style.display = 'block';
							document.getElementById('item_japones_04').style.display = 'none';
							document.getElementById('item_japones_05').style.display = 'none';
							document.getElementById('item_japones_06').style.display = 'none';
							document.getElementById('item_japones_07').style.display = 'none';
							document.getElementById('item_japones_08').style.display = 'none';
							document.getElementById('item_japones_09').style.display = 'none';
							document.getElementById('item_japones_10').style.display = 'none';
						}
						if(option == "04"){
							document.getElementById('item_ingles_00').style.display = 'none';
							document.getElementById('item_ingles_01').style.display = 'block';
							document.getElementById('item_ingles_02').style.display = 'block';
							document.getElementById('item_ingles_03').style.display = 'block';
							document.getElementById('item_ingles_04').style.display = 'block';
							document.getElementById('item_ingles_05').style.display = 'none';
							document.getElementById('item_ingles_06').style.display = 'none';
							document.getElementById('item_ingles_07').style.display = 'none';
							document.getElementById('item_ingles_08').style.display = 'none';
							document.getElementById('item_ingles_09').style.display = 'none';
							document.getElementById('item_ingles_10').style.display = 'none';
							document.getElementById('item_japones_00').style.display = 'none';
							document.getElementById('item_japones_01').style.display = 'block';
							document.getElementById('item_japones_02').style.display = 'block';
							document.getElementById('item_japones_03').style.display = 'block';
							document.getElementById('item_japones_04').style.display = 'block';
							document.getElementById('item_japones_05').style.display = 'none';
							document.getElementById('item_japones_06').style.display = 'none';
							document.getElementById('item_japones_07').style.display = 'none';
							document.getElementById('item_japones_08').style.display = 'none';
							document.getElementById('item_japones_09').style.display = 'none';
							document.getElementById('item_japones_10').style.display = 'none';
						}
						if(option == "05"){
							document.getElementById('item_ingles_00').style.display = 'none';
							document.getElementById('item_ingles_01').style.display = 'block';
							document.getElementById('item_ingles_02').style.display = 'block';
							document.getElementById('item_ingles_03').style.display = 'block';
							document.getElementById('item_ingles_04').style.display = 'block';
							document.getElementById('item_ingles_05').style.display = 'block';
							document.getElementById('item_ingles_06').style.display = 'none';
							document.getElementById('item_ingles_07').style.display = 'none';
							document.getElementById('item_ingles_08').style.display = 'none';
							document.getElementById('item_ingles_09').style.display = 'none';
							document.getElementById('item_ingles_10').style.display = 'none';
							document.getElementById('item_japones_00').style.display = 'none';
							document.getElementById('item_japones_01').style.display = 'block';
							document.getElementById('item_japones_02').style.display = 'block';
							document.getElementById('item_japones_03').style.display = 'block';
							document.getElementById('item_japones_04').style.display = 'block';
							document.getElementById('item_japones_05').style.display = 'block';
							document.getElementById('item_japones_06').style.display = 'none';
							document.getElementById('item_japones_07').style.display = 'none';
							document.getElementById('item_japones_08').style.display = 'none';
							document.getElementById('item_japones_09').style.display = 'none';
							document.getElementById('item_japones_10').style.display = 'none';
						}
						if(option == "06"){
							document.getElementById('item_ingles_00').style.display = 'none';
							document.getElementById('item_ingles_01').style.display = 'block';
							document.getElementById('item_ingles_02').style.display = 'block';
							document.getElementById('item_ingles_03').style.display = 'block';
							document.getElementById('item_ingles_04').style.display = 'block';
							document.getElementById('item_ingles_05').style.display = 'block';
							document.getElementById('item_ingles_06').style.display = 'block';
							document.getElementById('item_ingles_07').style.display = 'none';
							document.getElementById('item_ingles_08').style.display = 'none';
							document.getElementById('item_ingles_09').style.display = 'none';
							document.getElementById('item_ingles_10').style.display = 'none';
							document.getElementById('item_japones_00').style.display = 'none';
							document.getElementById('item_japones_01').style.display = 'block';
							document.getElementById('item_japones_02').style.display = 'block';
							document.getElementById('item_japones_03').style.display = 'block';
							document.getElementById('item_japones_04').style.display = 'block';
							document.getElementById('item_japones_05').style.display = 'block';
							document.getElementById('item_japones_06').style.display = 'block';
							document.getElementById('item_japones_07').style.display = 'none';
							document.getElementById('item_japones_08').style.display = 'none';
							document.getElementById('item_japones_09').style.display = 'none';
							document.getElementById('item_japones_10').style.display = 'none';
						}
						if(option == "07"){
							document.getElementById('item_ingles_00').style.display = 'none';
							document.getElementById('item_ingles_01').style.display = 'block';
							document.getElementById('item_ingles_02').style.display = 'block';
							document.getElementById('item_ingles_03').style.display = 'block';
							document.getElementById('item_ingles_04').style.display = 'block';
							document.getElementById('item_ingles_05').style.display = 'block';
							document.getElementById('item_ingles_06').style.display = 'block';
							document.getElementById('item_ingles_07').style.display = 'block';
							document.getElementById('item_ingles_08').style.display = 'none';
							document.getElementById('item_ingles_09').style.display = 'none';
							document.getElementById('item_ingles_10').style.display = 'none';
							document.getElementById('item_japones_00').style.display = 'none';
							document.getElementById('item_japones_01').style.display = 'block';
							document.getElementById('item_japones_02').style.display = 'block';
							document.getElementById('item_japones_03').style.display = 'block';
							document.getElementById('item_japones_04').style.display = 'block';
							document.getElementById('item_japones_05').style.display = 'block';
							document.getElementById('item_japones_06').style.display = 'block';
							document.getElementById('item_japones_07').style.display = 'block';
							document.getElementById('item_japones_08').style.display = 'none';
							document.getElementById('item_japones_09').style.display = 'none';
							document.getElementById('item_japones_10').style.display = 'none';
						}
						if(option == "08"){
							document.getElementById('item_ingles_00').style.display = 'none';
							document.getElementById('item_ingles_01').style.display = 'block';
							document.getElementById('item_ingles_02').style.display = 'block';
							document.getElementById('item_ingles_03').style.display = 'block';
							document.getElementById('item_ingles_04').style.display = 'block';
							document.getElementById('item_ingles_05').style.display = 'block';
							document.getElementById('item_ingles_06').style.display = 'block';
							document.getElementById('item_ingles_07').style.display = 'block';
							document.getElementById('item_ingles_08').style.display = 'block';
							document.getElementById('item_ingles_09').style.display = 'none';
							document.getElementById('item_ingles_10').style.display = 'none';
							document.getElementById('item_japones_00').style.display = 'none';
							document.getElementById('item_japones_01').style.display = 'block';
							document.getElementById('item_japones_02').style.display = 'block';
							document.getElementById('item_japones_03').style.display = 'block';
							document.getElementById('item_japones_04').style.display = 'block';
							document.getElementById('item_japones_05').style.display = 'block';
							document.getElementById('item_japones_06').style.display = 'block';
							document.getElementById('item_japones_07').style.display = 'block';
							document.getElementById('item_japones_08').style.display = 'block';
							document.getElementById('item_japones_09').style.display = 'none';
							document.getElementById('item_japones_10').style.display = 'none';
						}
						if(option == "09"){							
							document.getElementById('item_ingles_00').style.display = 'none';
							document.getElementById('item_ingles_01').style.display = 'block';
							document.getElementById('item_ingles_02').style.display = 'block';
							document.getElementById('item_ingles_03').style.display = 'block';
							document.getElementById('item_ingles_04').style.display = 'block';
							document.getElementById('item_ingles_05').style.display = 'block';
							document.getElementById('item_ingles_06').style.display = 'block';
							document.getElementById('item_ingles_07').style.display = 'block';
							document.getElementById('item_ingles_08').style.display = 'block';
							document.getElementById('item_ingles_09').style.display = 'block';
							document.getElementById('item_ingles_10').style.display = 'none';
							document.getElementById('item_japones_00').style.display = 'none';
							document.getElementById('item_japones_01').style.display = 'block';
							document.getElementById('item_japones_02').style.display = 'block';
							document.getElementById('item_japones_03').style.display = 'block';
							document.getElementById('item_japones_04').style.display = 'block';
							document.getElementById('item_japones_05').style.display = 'block';
							document.getElementById('item_japones_06').style.display = 'block';
							document.getElementById('item_japones_07').style.display = 'block';
							document.getElementById('item_japones_08').style.display = 'block';
							document.getElementById('item_japones_09').style.display = 'block';
							document.getElementById('item_japones_10').style.display = 'none';
						}
						if(option == "10"){
							document.getElementById('item_ingles_00').style.display = 'none';
							document.getElementById('item_ingles_01').style.display = 'block';
							document.getElementById('item_ingles_02').style.display = 'block';
							document.getElementById('item_ingles_03').style.display = 'block';
							document.getElementById('item_ingles_04').style.display = 'block';
							document.getElementById('item_ingles_05').style.display = 'block';
							document.getElementById('item_ingles_06').style.display = 'block';
							document.getElementById('item_ingles_07').style.display = 'block';
							document.getElementById('item_ingles_08').style.display = 'block';
							document.getElementById('item_ingles_09').style.display = 'block';
							document.getElementById('item_ingles_10').style.display = 'block';
							document.getElementById('item_japones_00').style.display = 'none';
							document.getElementById('item_japones_01').style.display = 'block';
							document.getElementById('item_japones_02').style.display = 'block';
							document.getElementById('item_japones_03').style.display = 'block';
							document.getElementById('item_japones_04').style.display = 'block';
							document.getElementById('item_japones_05').style.display = 'block';
							document.getElementById('item_japones_06').style.display = 'block';
							document.getElementById('item_japones_07').style.display = 'block';
							document.getElementById('item_japones_08').style.display = 'block';
							document.getElementById('item_japones_09').style.display = 'block';
							document.getElementById('item_japones_10').style.display = 'block';
						}

				}
			</script>

		  <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Numero de Tam.s</label>
			<div class="col-sm-10">
			  <select class="form-control" name="grade_quantidade_tamanhos" id="options" onchange="optionCheck()">
				<option value="00">00</option>
				<option value="01">01</option>
				<option value="02">02</option>
				<option value="03">03</option>
				<option value="04">04</option>
				<option value="05">05</option>
				<option value="06">06</option>
				<option value="07">07</option>
				<option value="08">08</option>
				<option value="09">09</option>
				<option value="10">10</option>
				</select>
			</div>
		  </div>

		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tamanho Ingles</label>
			<div class="col-sm-10">
			  <label id="item_ingles_00">N/A</label>
			  <input type="text" id="item_ingles_01" name="ingles_01" placeholder="Tam. 01" size="9" style="display:none; float:left;">
				<input type="text" id="item_ingles_02" name="ingles_02" placeholder="Tam. 02" size="9" style="display:none; float:left;">
			  <input type="text" id="item_ingles_03" name="ingles_03" placeholder="Tam. 03" size="9" style="display:none; float:left;">
			  <input type="text" id="item_ingles_04" name="ingles_04" placeholder="Tam. 04" size="9" style="display:none; float:left;">
			  <input type="text" id="item_ingles_05" name="ingles_05" placeholder="Tam. 05" size="9" style="display:none; float:left;">
			  <input type="text" id="item_ingles_06" name="ingles_06" placeholder="Tam. 06" size="9" style="display:none; float:left;">
			  <input type="text" id="item_ingles_07" name="ingles_07" placeholder="Tam. 07" size="9" style="display:none; float:left;">
			  <input type="text" id="item_ingles_08" name="ingles_08" placeholder="Tam. 08" size="9" style="display:none; float:left;">
			  <input type="text" id="item_ingles_09" name="ingles_09" placeholder="Tam. 09" size="9" style="display:none; float:left;">
			  <input type="text" id="item_ingles_10" name="ingles_10" placeholder="Tam. 10" size="9" style="display:none; float:left;">
			</div>
		  </div>

			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tamanho Japones</label>
			<div class="col-sm-10">
				<label id="item_japones_00">N/A</label>
				<input type="text" id="item_japones_01" name="japones_01" placeholder="Tam. 01" size="9" style="display:none; float:left;">
				<input type="text" id="item_japones_02" name="japones_02" placeholder="Tam. 02" size="9" style="display:none; float:left;">
				<input type="text" id="item_japones_03" name="japones_03" placeholder="Tam. 03" size="9" style="display:none; float:left;">
				<input type="text" id="item_japones_04" name="japones_04" placeholder="Tam. 04" size="9" style="display:none; float:left;">
				<input type="text" id="item_japones_05" name="japones_05" placeholder="Tam. 05" size="9" style="display:none; float:left;">
				<input type="text" id="item_japones_06" name="japones_06" placeholder="Tam. 06" size="9" style="display:none; float:left;">
				<input type="text" id="item_japones_07" name="japones_07" placeholder="Tam. 07" size="9" style="display:none; float:left;">
				<input type="text" id="item_japones_08" name="japones_08" placeholder="Tam. 08" size="9" style="display:none; float:left;">
				<input type="text" id="item_japones_09" name="japones_09" placeholder="Tam. 09" size="9" style="display:none; float:left;">
				<input type="text" id="item_japones_10" name="japones_10" placeholder="Tam. 10" size="9" style="display:none; float:left;">
			</div>
		  </div>
	</div>
	</div>
</div> <!-- /container -->
</form>