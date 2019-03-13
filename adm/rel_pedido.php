<?php
	//pelo metodo POST
	if ( isset( $_POST["sit_1"] ) ) {
		$sit_1	= $_POST['sit_1'];
	} else {
		$sit_1 = '';
	}
	if ( isset( $_POST["sit_2"] ) ) {
		$sit_2	= $_POST['sit_2'];
	} else {
		$sit_2 = '';
	}
	if ( isset( $_POST["sit_3"] ) ) {
		$sit_3	= $_POST['sit_3'];
	} else {
		$sit_3 = '';
	}
	if ( isset( $_POST["sit_4"] ) ) {
		$sit_4	= $_POST['sit_4'];
	} else {
		$sit_4 = '';
	}
	if ( isset( $_POST["sit_5"] ) ) {
		$sit_5	= $_POST['sit_5'];
	} else {
		$sit_5 = '';
	}
	if ( isset( $_POST["sit_6"] ) ) {
		$sit_6	= $_POST['sit_6'];
	} else {
		$sit_6 = '';
	}

	if ( isset( $_POST["pedido_criacao_inicio"] ) ) {
		$pedido_criacao_inicio	= $_POST['pedido_criacao_inicio'];
	} else {
		$pedido_criacao_inicio = '';
	}

	if ( isset( $_POST["pedido_criacao_fim"] ) ) {
		$pedido_criacao_fim	= $_POST['pedido_criacao_fim'];
	} else {
		$pedido_criacao_fim	= '';
	}

	if ( isset( $_POST["pedido_forma_pagamento"] ) ) {
		$pedido_forma_pagamento	= $_POST['pedido_forma_pagamento'];
	} else {
		$pedido_forma_pagamento	= "";
	}    
  
	if ( isset( $_POST["agrupamento"] ) ) {
		$agrupamento	= $_POST['agrupamento'];
	} else {
		$agrupamento	= "";
	}  

	$query = "";

	if ($sit_1 || $sit_2 || $sit_3 || $sit_4 || $sit_5 || $sit_6) {
		$sql_sit = '';
		if ($sit_1){
			$sql_sit = '1';
		}		
		if ($sit_2){
			if ($sql_sit==''){
				$sql_sit = '2';
			}	else {
				$sql_sit = "$sql_sit,2";
			}			
		}
		if ($sit_3){
			if ($sql_sit==''){
				$sql_sit = '3';
			}	else {
				$sql_sit = "$sql_sit,3";
			}			
		}
		if ($sit_4){
			if ($sql_sit==''){
				$sql_sit = '4';
			}	else {
				$sql_sit = "$sql_sit,4";
			}			
		}
		if ($sit_5){
			if ($sql_sit==''){
				$sql_sit = '5';
			}	else {
				$sql_sit = "$sql_sit,5";
			}			
		}
		if ($sit_6){
			if ($sql_sit==''){
				$sql_sit = '6';
			}	else {
				$sql_sit = "$sql_sit,6";
			}			
		}
		$query = $query." AND a.pedido_situacao_id in ($sql_sit) ";
	} 
	if ($pedido_criacao_inicio && $pedido_criacao_fim) {
		$query = $query." AND (date(a.pedido_criacao) BETWEEN '$pedido_criacao_inicio' AND '$pedido_criacao_fim') ";
	} 
	if ($pedido_forma_pagamento) {
		$query = $query." AND a.pedido_forma_pagamento = '".$pedido_forma_pagamento."' ";
	}  	

	$sql_agrupamento = '';
	$group_by = '';
	$virgula = '';
	$as = '';
	$orderby = '';
	if ($agrupamento) {
		$group_by = ' GROUP BY ';
		$virgula = ',';
		$as = ' as agrupamento ';
		$query = $query." AND 1=1 ";
		if ($agrupamento=='1'){	
			$sql_agrupamento = ' a.pedido_forma_pagamento ';
		} else if ($agrupamento=='2'){
            $sql_agrupamento = ' b.pedido_situacao_descricao_ingles ';
		} else if ($agrupamento=='3') {
			$sql_agrupamento = ' YEAR(a.pedido_criacao) ';
			$orderby 		 = ' ORDER BY a.pedido_criacao DESC ';
		} else if ($agrupamento=='4') {
			$sql_agrupamento = ' concat(YEAR(a.pedido_criacao), "-", MONTH(a.pedido_criacao)) ';
			$orderby 		 = ' ORDER BY a.pedido_criacao DESC ';
		} else if ($agrupamento=='5') {
			$sql_agrupamento = ' concat(YEAR(a.pedido_criacao), "-", MONTH(a.pedido_criacao), "-", DAYOFMONTH(a.pedido_criacao)) ';
			$orderby 		 = ' ORDER BY a.pedido_criacao DESC ';
		} else if ($agrupamento=='6') {
			$sql_agrupamento = ' concat(a.cliente_id," - ", c.cliente_nome) ';
			$orderby 		 = ' ORDER BY valor_total DESC ';
		} else if ($agrupamento=='7') {
			$sql_agrupamento = ' e.post_provincia_ingles ';
			$orderby 		 = ' ORDER BY valor_total DESC';
		}
}


	if ($query) {
		$sql = "SELECT  a.pedido_forma_pagamento as forma_pagamento,
						count(a.id) as qt_pedido, 
						sum(a.pedido_valor_itens) as valor_itens,
						sum(a.pedido_valor_frete_calculado) as valor_frete,
						(sum(a.pedido_valor_itens) + sum(a.pedido_valor_frete_calculado)) as valor_total $virgula $sql_agrupamento $as
				FROM  	pedidos a,
						pedido_situacao b,
						clientes c,
						post_ceps d,
						post_provincias e
				WHERE	b.id=a.pedido_situacao_id
				  AND   c.id = a.cliente_id
				  AND	a.cep_entrega_id = d.id
				  AND	d.provincia_id = e.id
						$query $group_by $sql_agrupamento $orderby";
		$resultado=mysqli_query($connection,$sql);
		$linhas=mysqli_num_rows($resultado);
	} else {
		$resultado=mysqli_query($connection,"SELECT * FROM pedidos WHERE 1=2");
		$linhas=mysqli_num_rows($resultado);	
	}

?>	
<div class="page-header">
	<div class="container">
		<br>
		<h1>Relatorio de Pedido</h1>
	</div>
</div>

<div class="container theme-showcase" role="main"> 
  <div class="row ">
		<form class="form-horizontal" method="POST" action="administrativo.php?link=87">
			<!-- Filtro de pesquisa -->
			<div class="tab-content">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Situacao do Pedido</label>
					<div class="col-sm-5">
						<label><input type="checkbox" name="sit_3" id="sit_3" value="3" <?php if ($sit_3==3){echo "checked";}?>><?php $query =mysqli_query($connection,"SELECT pedido_situacao_descricao_ingles as mensagem FROM pedido_situacao WHERE id=3"); $line = mysqli_fetch_assoc($query); echo $line["mensagem"]; ?></label><br>
						<label><input type="checkbox" name="sit_4" id="sit_4" value="4" <?php if ($sit_4==4){echo "checked";}?>><?php $query =mysqli_query($connection,"SELECT pedido_situacao_descricao_ingles as mensagem FROM pedido_situacao WHERE id=4"); $line = mysqli_fetch_assoc($query); echo $line["mensagem"]; ?></label><br>
						<label><input type="checkbox" name="sit_5" id="sit_5" value="5" <?php if ($sit_5==5){echo "checked";}?>><?php $query =mysqli_query($connection,"SELECT pedido_situacao_descricao_ingles as mensagem FROM pedido_situacao WHERE id=5"); $line = mysqli_fetch_assoc($query); echo $line["mensagem"]; ?></label>
					</div>
					<div class="col-sm-5">
						<label><input type="checkbox" name="sit_1" id="sit_1" value="1" <?php if ($sit_1==1){echo "checked";}?>><?php $query =mysqli_query($connection,"SELECT pedido_situacao_descricao_ingles as mensagem FROM pedido_situacao WHERE id=1"); $line = mysqli_fetch_assoc($query); echo $line["mensagem"]; ?></label><br>
						<label><input type="checkbox" name="sit_2" id="sit_2" value="2" <?php if ($sit_2==2){echo "checked";}?>><?php $query =mysqli_query($connection,"SELECT pedido_situacao_descricao_ingles as mensagem FROM pedido_situacao WHERE id=2"); $line = mysqli_fetch_assoc($query); echo $line["mensagem"]; ?></label><br>
						<label><input type="checkbox" name="sit_6" id="sit_6" value="6" <?php if ($sit_6==6){echo "checked";}?>><?php $query =mysqli_query($connection,"SELECT pedido_situacao_descricao_ingles as mensagem FROM pedido_situacao WHERE id=6"); $line = mysqli_fetch_assoc($query); echo $line["mensagem"]; ?></label>
					</div>
				</div>
       			<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Data do Pedido</label>
					<div class="col-sm-5">
						<input type="date" class="form-control" name="pedido_criacao_inicio" value="<?php echo $pedido_criacao_inicio;?>">
					</div>
					<div class="col-sm-5">
						<input type="date" class="form-control" name="pedido_criacao_fim" value="<?php echo $pedido_criacao_fim;?>">
					</div>
				</div>
        		<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Forma de Pagamento</label>
					<div class="col-sm-10">
						<select class="form-control" name="pedido_forma_pagamento">
							<option value="<?php echo $pedido_forma_pagamento;?>">
								<?php if ($pedido_forma_pagamento == "2"){
                                        echo "PayPal";
                                      } else if ($pedido_forma_pagamento == "1"){ 
										echo "SmartPit"; 
									  } else { 
										echo "Todas"; 
									  }
								?>
							</option>
							<option value="">Todas</option>
							<option value="1">SmartPit</option>
							<option value="2">PayPal</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Agrupamento</label>
					<div class="col-sm-10">
						<select class="form-control" name="agrupamento">
							<option value="<?php echo $agrupamento;?>">
								<?php 	if ($agrupamento == "1"){ 
											echo "Forma de Pagamento"; 
										} else if ($agrupamento == "2"){ 
											echo "Situacao Pedido"; 

										} else if ($agrupamento == "3"){ 
											echo "Ano"; 
										} else if ($agrupamento == "4"){ 
											echo "Mes"; 
										} else if ($agrupamento == "5"){ 
											echo "Dia"; 
										} else if ($agrupamento == "6"){ 
											echo "Cliente"; 
										} else if ($agrupamento == "7"){ 
											echo "Provincia"; 
										} else { 
											echo "Escolha um Agrupamento"; 
										}
								?>
							</option>
							<option value="3">Ano</option>
							<option value="4">Mes</option>
							<option value="5">Dia</option>
							<option value="1">Forma de Pagamento</option>
							<option value="2">Situacao Pedido</option>
							<option value="6">Cliente</option>
							<option value="7">Provincia</option>
						</select>
					</div>
				</div>


				<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
						<div class="pull-right">
							<a href="administrativo.php?link=87"><button type='button' class='btn btn-primary' onclick="<?php echo $loading;?>">Limpar</button></a>
							<button type="submit" name="submit" class="btn btn-success" onclick="javascript:document.getElementById('blanket').style.display = 'block';document.getElementById('aguarde').style.display = 'block';">Pesquisar</button>
						</div>
					</div>	
				</div>	
			</div>
		</form>
		<div class="col-md-12">
        <table class="table">
			<?php 
				if ($agrupamento==''){
					$tp_agrupamento = 'Sem Agrupamento';
				} else if ($agrupamento=='3'){
					$tp_agrupamento = 'Ano';
				} else if ($agrupamento=='4'){
					$tp_agrupamento = 'Mes';
				} else if ($agrupamento=='5'){
					$tp_agrupamento = 'Dia';
				} else if ($agrupamento=='1'){
					$tp_agrupamento = 'Forma de Pagamento';
				} else if ($agrupamento=='2'){
					$tp_agrupamento = 'Situacao Pedido';
				} else if ($agrupamento=='6'){
					$tp_agrupamento = 'Cliente';
				} else if ($agrupamento=='7'){
					$tp_agrupamento = 'Provincia';
				}
			?>

            <thead>
                <tr>
					<th style="text-align:left"><?php echo $tp_agrupamento; ?></th>	
					<th style="text-align:right">Qt. Pedidos</th>	
					<th style="text-align:right">Valor Itens</th>		
					<th style="text-align:right">Valor Frete</th>		
					<th style="text-align:right">Valor Total</th>		
                </tr>
            </thead>
            <tbody>

                <?php
					$qt_total = 0;
					$valor_total = 0;
					$valor_total_itens = 0;
					$valor_total_frete = 0;
					$valor_total_pedidos = 0;

                    while($ln = mysqli_fetch_assoc($resultado)){
						$qt_pedido 	  = $ln['qt_pedido'];
						$valor_itens  = $ln['valor_itens'];
						$valor_frete  = $ln['valor_frete'];
						$total_pedido = $valor_itens+$valor_frete;
						
						$qt_total +=$qt_pedido;
						$valor_total_itens += $valor_itens;
						$valor_total_frete += $valor_frete;
						$valor_total_pedidos += $total_pedido;

						$valor_itens  = number_format($valor_itens,0,',',',');
						$valor_frete  = number_format($valor_frete,0,',',',');
						$total_pedido = number_format($total_pedido,0,',',',');

						if (isset($ln['agrupamento'])){
							$desc_agrupamento = $ln['agrupamento'];
						} else {
							$desc_agrupamento = '';
						}

						if ($agrupamento=='1'){
							if ($ln['forma_pagamento']==1) {
								$desc_agrupamento = 'SmartPit';
							} else if ($ln['forma_pagamento']==2) {
								$desc_agrupamento = 'Paypal';
							}
						}
						echo "  <tr>
									<td align='LEFT'>$desc_agrupamento</td>
                                    <td align='right'>$qt_pedido</td>
                                    <td align='right'>$valor_itens</td>
                                    <td align='right'>$valor_frete</td>
                                    <td align='right'>$total_pedido</td>
                                </tr>";

										}
										$tiquete_medio = 0;
										if ($qt_total>0){
											$tiquete_medio 			= $valor_total_pedidos / $qt_total;
											$tiquete_medio		 	= number_format($tiquete_medio,0,',',',');
										}
										$valor_total_itens		= number_format($valor_total_itens,0,',',',');
										$valor_total_frete 		= number_format($valor_total_frete,0,',',',');
										$valor_total_pedidos 	= number_format($valor_total_pedidos,0,',',',');
										echo "<tr>
												<td align='LEFT'><strong>TOTAL</strong></td>
												<td align='right'>$qt_total</td>
												<td align='right'>$valor_total_itens</td>
												<td align='right'>$valor_total_frete</td>
												<td align='right'>$valor_total_pedidos</td>
											</tr>";
                ?>
            </tbody>
            </table>

        		<div class="form-group" align='right'>
					<label for="inputEmail3" class="col-sm-12 control-label">Tiquete Medio: <?php echo $tiquete_medio;?></label>
				</div>
		</div>
	</div>
</div> <!-- /container -->