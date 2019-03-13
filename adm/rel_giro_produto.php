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
	
	if ( isset( $_POST["codigo_produto"] ) ) {
		$codigo_produto	= $_POST['codigo_produto'];
	} else {
		$codigo_produto	= "";
	}  
	  
	if ( isset( $_POST["departamento_id"] ) ) {
		$departamento_id = $_POST['departamento_id'];
	} else {
		$departamento_id = "";
	}    
	  
	if ( isset( $_POST["categoria_id"] ) ) {
		$categoria_id = $_POST['categoria_id'];
	} else {
		$categoria_id = "";
	}    

	if ( isset( $_POST["sub_categoria_id"] ) ) {
		$sub_categoria_id = $_POST['sub_categoria_id'];
	} else {
		$sub_categoria_id = "";
	}  

	if ( isset( $_POST["departamento_id"] ) ) {
		$departamento_id	= $_POST['departamento_id'];
	} else {
		$departamento_id	= "";
	}  

	if ( isset( $_POST["categoria_id"] ) ) {
		$categoria_id	= $_POST['categoria_id'];
	} else {
		$categoria_id	= "";
	}  

	if ( isset( $_POST["sub_categoria_id"] ) ) {
		$sub_categoria_id	= $_POST['sub_categoria_id'];
	} else {
		$sub_categoria_id	= "";
	}  

	if ( isset( $_POST["marca_id"] ) ) {
		$marca_id	= $_POST['marca_id'];
	} else {
		$marca_id	= "";
	}  	
	
	if ( isset( $_POST["agrupamento"] ) ) {
		$agrupamento	= $_POST['agrupamento'];
	} else {
		$agrupamento	= "";
	}   

	if ( isset( $_POST["ordem"] ) ) {
		$ordem	= $_POST['ordem'];
	} else {
		$ordem	= "";
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
		$query = $query." AND g.pedido_situacao_id in ($sql_sit) ";
	} 
	if ($pedido_criacao_inicio && $pedido_criacao_fim) {
		$query = $query." AND (date(g.pedido_criacao) BETWEEN '$pedido_criacao_inicio' AND '$pedido_criacao_fim') ";
	} 
	if ($pedido_forma_pagamento) {
		$query = $query." AND g.pedido_forma_pagamento = '".$pedido_forma_pagamento."' ";
	}  	
	if ($departamento_id) {
		$query = $query." AND e.departamento_id = '".$departamento_id."' ";
	}  	
	if ($categoria_id) {
		$query = $query." AND b.categoria_id = '".$categoria_id."' ";
	}  	
	if ($sub_categoria_id) {
		$query = $query." AND b.sub_categoria_id = '".$sub_categoria_id."' ";
	}
	if ($marca_id) {
		$query = $query." AND b.marca_id = '".$marca_id."' ";
	} 
	if ($codigo_produto) {
		$query = $query." AND b.produto_codigo_cliente = '".$codigo_produto."' ";
	}  	


	$sql_agrupamento = '';
	$group_by = '';
	$virgula = '';
	$as = '';
	if ($agrupamento) {
		$group_by = ' GROUP BY ';
		$virgula = ',';
		$as = ' as agrupamento ';
		$query = $query." AND 1=1 ";
		if ($agrupamento=='6'){	
			$sql_agrupamento = ' concat(b.produto_codigo_cliente, " - ", b.produto_descricao_ingles) ';
		} else if ($agrupamento=='1'){
            $sql_agrupamento = ' concat(d.id, " - ", d.departamento_descricao_ingles) ';
		} else if ($agrupamento=='2'){
			$sql_agrupamento = ' concat(e.id, " - ", e.categoria_descricao_ingles) ';
		} else if ($agrupamento=='3'){
			$sql_agrupamento = ' concat(f.id, " - ", f.subcategoria_descricao_ingles) ';
		} else if ($agrupamento=='4'){
			$sql_agrupamento = ' concat(h.id, " - ", h.pedido_situacao_descricao_ingles) ';
		} else if ($agrupamento=='5'){
			$sql_agrupamento = ' concat(i.id, " - ", i.marca_descricao) ';
		} 
	}


	$orderby = '';
	if ($ordem) {
		$query = $query." AND 1=1 ";
		if ($ordem=='1'){	
			$orderby = ' ORDER BY quantidade_itens DESC ';
		} else if ($ordem=='2'){
            $orderby = ' ORDER BY valor_itens DESC ';
		} 
	}

	if ($query) {
		$sql = "SELECT 	sum(c.pedido_item_quantidade) as quantidade_itens,
						count(g.id) qt_pedido,
						sum(c.pedido_item_quantidade * c.pedido_item_valor_unitario) as valor_itens $virgula $sql_agrupamento $as
				FROM  produto_itens a
						LEFT JOIN pedido_itens c ON a.id=c.produto_id
						LEFT JOIN pedidos g ON c.pedido_id=g.id,
						produtos b,
						departamentos d,
						categorias e,
						subcategorias f,
						pedido_situacao h,
						marcas i
				WHERE a.produto_id=b.id
					AND e.departamento_id=d.id
					AND b.categoria_id=e.id
					AND b.sub_categoria_id=f.id
					AND h.id=g.pedido_situacao_id
					AND b.marca_id=i.id
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
		<h1>Giro de Produto</h1>
	</div>
</div>

<div class="container theme-showcase" role="main"> 
  <div class="row ">
		<form class="form-horizontal" method="POST" action="administrativo.php?link=89">
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

				<!-- codigo -->
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Codigo do Produto</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="codigo_produto" placeholder="Codigo do produto" value="<?php echo $codigo_produto;?>">
					</div>
				</div>	

				<!-- Departamento -->
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Departamento</label>
					<div class="col-sm-10">
						<select class="form-control" name="departamento_id">
						<option value="">Todos</option>
						<?php 
								$pesquisa =mysqli_query($connection,"SELECT * FROM departamentos");
								while($dados = mysqli_fetch_assoc($pesquisa)){
									?>
										<option value="<?php echo $dados["id"]; ?>"><?php echo $dados["departamento_descricao_ingles"];?></option>
									<?php
								}
							?>
						</select>
					</div>
				</div>

				<script type="text/javascript">
					//carrega as subcategorias relacionadas a categoria
					function CarregaSubCategoria(){
						var categoria  = document.getElementById("categoria").value;
						$("#div_subcategoria").empty();
						$("#div_subcategoria").load('processa/categoria_x_subcategoria.php?categoria_id='+categoria+'&op=rel');
					}
				</script>
				<!-- Categoria -->
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Categoria</label>
					<div class="col-sm-10">
						<select class="form-control" name="categoria_id" id="categoria" onchange="CarregaSubCategoria()">
						<option value="">Todas</option>
						<?php 
								$pesquisa =mysqli_query($connection,"SELECT * FROM categorias order by id");
								while($dados = mysqli_fetch_assoc($pesquisa)){
									?>
										<option value="<?php echo $dados["id"]; ?>"><?php echo $dados["categoria_descricao_ingles"];?></option>
									<?php
								}
							?>
						</select>
					</div>
				</div>		
				<!-- sub categoria -->
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Sub Categoria</label>
					<div class="col-sm-10" id="div_subcategoria"></div>
				</div>

				<!-- Marca -->
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Marca</label>
					<div class="col-sm-10">
						<select class="form-control" name="marca_id">
						<option value="">Todas</option>
							<?php 
								$pesquisa =mysqli_query($connection,"SELECT * FROM marcas order by id");
								while($dados = mysqli_fetch_assoc($pesquisa)){
									?>
										<option value="<?php echo $dados["id"]; ?>"><?php echo $dados["marca_descricao"];?></option>
									<?php
								}
							?>
						</select>
					</div>
				</div>

				<!-- Agrupamento -->
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Agrupamento</label>
					<div class="col-sm-10">
						<select class="form-control" name="agrupamento">
								<?php 	if ($agrupamento == "6"){ 
											echo "<option value='$agrupamento'>Produto</option>"; 
										} else if ($agrupamento == "1"){ 
											echo "<option value='$agrupamento'>Departamento</option>"; 
                                        } else if ($agrupamento == "2"){ 
                                            echo "<option value='$agrupamento'>Categoria</option>"; 
                                        } else if ($agrupamento == "3"){ 
											echo "<option value='$agrupamento'>Sub Categoria</option>"; 
										} else if ($agrupamento == "5"){ 
											echo "<option value='$agrupamento'>Marca</option>"; 
										} else if ($agrupamento == "4"){ 
											echo "<option value='$agrupamento'>Situacao Pedido</option>"; 
										} else {
											echo "<option value=''>Sem Agrupamento</option>";
										}
								?>
							<option value="">Sem Agrupamento</option>
							<option value="6">Produto</option>
                            <option value="1">Departamento</option>
							<option value="2">Categoria</option>
							<option value="3">Sub Categoria</option>
							<option value="5">Marca</option>
							<option value="4">Situacao Pedido</option>
						</select>
					</div>
				</div>

				<!-- Ordem -->
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Ordem</label>
					<div class="col-sm-10">
						<select class="form-control" name="ordem">
								<?php 	if ($ordem == "1"){ 
											echo "<option value='$ordem'>Quantidade</option>"; 
										} else if ($ordem == "2"){ 
											echo "<option ordem='$ordem'>Valor</option>"; 
                                        } else {
											echo "<option value=''>Sem Ordenar</option>";
										}
								?>
							<option value="">Sem Ordenar</option>
							<option value="1">Quantidade</option>
                            <option value="2">Valor</option>
						</select>
					</div>
				</div>


				<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
						<div class="pull-right">
							<a href="administrativo.php?link=89"><button type='button' class='btn btn-primary' onclick="<?php echo $loading;?>">Limpar</button></a>
							<button type="submit" name="submit" class="btn btn-success" onclick="javascript:document.getElementById('blanket').style.display = 'block';document.getElementById('aguarde').style.display = 'block';">Pesquisar</button>
						</div>
					</div>	
				</div>	
			</div>
		</form>
		<div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <?php 
                        if ($agrupamento==''){
                            $tp_agrupamento = 'Sem Agrupamento';
                        } else if ($agrupamento=='6'){
                            $tp_agrupamento = 'Produto';
                        } else if ($agrupamento=='1'){
                            $tp_agrupamento = 'Departamento';
                        } else if ($agrupamento=='2'){
                            $tp_agrupamento = 'Categoria';
                        } else if ($agrupamento=='3'){
                            $tp_agrupamento = 'Sub Categoria';
                        } else if ($agrupamento=='4'){
                            $tp_agrupamento = 'Situacao do Pedido';
                        } else if ($agrupamento=='5'){
                            $tp_agrupamento = 'Marca';
                        }
                    ?>
								
                <th style="text-align:left"><?php echo $tp_agrupamento; ?></th>	
								<th style="text-align:right">Qt. Pedidos</th>	
								<th style="text-align:right">Qt. Itens</th>	
                <th style="text-align:right">Valor Itens</th>		
                </tr>
            </thead>
            <tbody>

                <?php
										$qt_total = 0;
										$valor_total = 0;
                    while($ln = mysqli_fetch_assoc($resultado)){
											$qt_pedido 	= $ln['qt_pedido'];
											$quantidade_itens 	= $ln['quantidade_itens'];
											if (!isset($quantidade_itens)){
												$quantidade_itens=0;
											}
											$valor_itens 				= $ln['valor_itens'];
											if (isset($ln['agrupamento'])){
												$desc_agrupamento = $ln['agrupamento'];
											} else {
												$desc_agrupamento = '';
											}
												
											$qt_total +=$quantidade_itens;
											$valor_total += $valor_itens;
											$valor_itens = number_format($valor_itens,0,',',',');

                        echo "  <tr>
                                    <td align='left'>$desc_agrupamento</td>
                                    <td align='right'>$qt_pedido</td>
                                    <td align='right'>$quantidade_itens</td>
                                    <td align='right'>$valor_itens</td>
                                </tr>";

										}
										$valor_total = number_format($valor_total,0,',',',');
										echo "<tr>
														<td align='LEFT'><strong>TOTAL</strong></td>
														<td align='right'></td>
														<td align='right'>$qt_total</td>
														<td align='right'>$valor_total</td>
													</tr>";
                ?>
            </tbody>
            </table>
		</div>
	</div>
</div> <!-- /container -->