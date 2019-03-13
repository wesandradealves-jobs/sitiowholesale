<?php
	//pelo metodo POST
	if ( isset( $_POST["id"] ) ) {
		$id	= $_POST['id'];
	} else {
		$id	= "";
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
		
	if ( isset( $_POST["pedido_forma_pagamento"] ) ) {
		$pedido_forma_pagamento	= $_POST['pedido_forma_pagamento'];
	} else {
		$pedido_forma_pagamento	= "";
    }    
	if ( isset( $_POST["pedido_codigo_smartpit"] ) ) {
		$pedido_codigo_smartpit	= $_POST['pedido_codigo_smartpit'];
	} else {
		$pedido_codigo_smartpit	= "";
    }
    if ( isset( $_POST["pedido_paypal_token"] ) ) {
		$pedido_paypal_token	= $_POST['pedido_paypal_token'];
	} else {
		$pedido_paypal_token	= "";
    }
    if ( isset( $_POST["pedido_paypal_payerid"] ) ) {
		$pedido_paypal_payerid	= $_POST['pedido_paypal_payerid'];
	} else {
		$pedido_paypal_payerid	= "";
    }    
    if ( isset( $_POST["cliente_nome"] ) ) {
		$cliente_nome	= $_POST['cliente_nome'];
	} else {
		$cliente_nome	= "";
    }
    if ( isset( $_POST["cliente_email"] ) ) {
		$cliente_email	= $_POST['cliente_email'];
	} else {
		$cliente_email	= "";
    }    
    if ( isset( $_POST["cliente_telefone"] ) ) {
		$cliente_telefone	= $_POST['cliente_telefone'];
	} else {
		$cliente_telefone	= "";
    }    
    if ( isset( $_POST["cliente_cellfone"] ) ) {
		$cliente_cellfone	= $_POST['cliente_cellfone'];
	} else {
        $cliente_cellfone	= "";
    }
    if ( isset( $_POST["pedido_cliente_nome"] ) ) {
		$pedido_cliente_nome	= $_POST['pedido_cliente_nome'];
	} else {
		$pedido_cliente_nome	= "";
    }    
    if ( isset( $_POST["pedido_cliente_telefone"] ) ) {
		$pedido_cliente_telefone	= $_POST['pedido_cliente_telefone'];
	} else {
		$pedido_cliente_telefone	= "";
    }    
    if ( isset( $_POST["pedido_cliente_cellfone"] ) ) {
		$pedido_cliente_cellfone	= $_POST['pedido_cliente_cellfone'];
	} else {
        $pedido_cliente_cellfone	= "";
    }
    if ( isset( $_POST["produto_codigo_cliente"] ) ) {
		$produto_codigo_cliente	= $_POST['produto_codigo_cliente'];
	} else {
		$produto_codigo_cliente	= "";
	}

	//pelo metodo GET
	if ( isset( $_GET["f1"] ) ) {
		$pedido_situacao_id	= $_GET['f1'];
	} else {
		$pedido_situacao_id ='';
	}
	if ( isset( $_GET["f2"] ) ) {
		$pedido_forma_pagamento	= $_GET['f2'];
	} 
		

	$query = "";

	if ($id) {
		$query = $query." AND a.id = '".$id."' ";
		} 
	if ($pedido_criacao_inicio && $pedido_criacao_fim) {
		$query = $query." AND (date(a.pedido_criacao) BETWEEN '$pedido_criacao_inicio' AND '$pedido_criacao_fim') ";
		} 
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
	
		   
	if ($pedido_forma_pagamento) {
		$query = $query." AND a.pedido_forma_pagamento = '".$pedido_forma_pagamento."' ";
		}   
	if ($pedido_situacao_id) {
		$query = $query." AND a.pedido_situacao_id = '".$pedido_situacao_id."' ";
		}     
	if ($pedido_codigo_smartpit) {
		$query = $query." AND a.pedido_codigo_smartpit = '".$pedido_codigo_smartpit."' ";
    }     
	if ($pedido_paypal_token) {
		$query = $query." AND a.pedido_paypal_token = '".$pedido_paypal_token."' ";
    }     
	if ($pedido_paypal_payerid) {
		$query = $query." AND a.pedido_paypal_payerid = '".$pedido_paypal_payerid."' ";
    }     
	if ($cliente_nome) {
		$query = $query." AND a.cliente_id IN (SELECT id FROM clientes WHERE cliente_nome like ('%".$cliente_nome."%')) ";
    }     
	if ($cliente_email) {
		$query = $query." AND a.cliente_id IN (SELECT id FROM clientes WHERE cliente_email like ('%".$cliente_email."%')) ";
    }
	if ($cliente_telefone) {
		$query = $query." AND a.cliente_id IN ('".$cliente_telefone."') ";
    }     
	if ($cliente_cellfone) {
		$query = $query." AND a.cliente_id IN ('".$cliente_cellfone."') ";
    }  
	if ($pedido_cliente_nome) {
		$query = $query." AND a.pedido_cliente_nome like '%".$pedido_cliente_nome."%' ";
    }     
	if ($pedido_cliente_telefone) {
		$query = $query." AND a.pedido_cliente_telefone = '".$pedido_cliente_telefone."' ";
    }     
	if ($cliente_cellfone) {
		$query = $query." AND a.pedido_cliente_cellfone = '".$pedido_cliente_cellfone."' ";
    }  
	if ($produto_codigo_cliente) {
		$query = $query." AND a.id IN (SELECT pedido_id FROM pedido_itens WHERE produto_id in (SELECT id FROM produto_itens WHERE produto_id = (SELECT id FROM produtos WHERE produto_codigo_cliente = '".$produto_codigo_cliente."')) GROUP BY pedido_id) ";
		} 

	if ($query) {
		$resultado=mysqli_query($connection,"SELECT a.*, (SELECT pedido_situacao_descricao_ingles FROM pedido_situacao WHERE id = a.pedido_situacao_id) as situacao
											   FROM pedidos a 
											  WHERE 1=1 $query
											  ORDER BY a.id");
		$linhas=mysqli_num_rows($resultado);
	} else {
		$resultado=mysqli_query($connection,"SELECT * FROM pedidos WHERE 1=2");
		$linhas=mysqli_num_rows($resultado);	
	}
?>	
<div class="page-header">
	<div class="container">
		<br>
		<h1>Lista de Pedido</h1>
	</div>
</div>

<div class="container theme-showcase" role="main"> 
  <div class="row ">
		<form class="form-horizontal" method="POST" action="administrativo.php?link=86">
			<!-- Filtro de pesquisa -->
			<div class="tab-content">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Codigo do Pedido</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="id" placeholder="Digite o codigo do pedido" value="<?php echo $id;?>">
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
					<label for="inputEmail3" class="col-sm-2 control-label">Forma de Pagamento</label>
					<div class="col-sm-10">
						<select class="form-control" name="pedido_forma_pagamento">
							<option value="<?php echo $pedido_forma_pagamento;?>">
								<?php if ($pedido_forma_pagamento == "2"){
                                        echo "PayPal";
                                      } else if ($pedido_forma_pagamento == "1"){ 
										echo "SmartPit"; 
									  } else { 
										echo "Escolha uma forma de pagamento"; 
									  }
								?>
							</option>
							<option value="">Escolha uma forma de pagamento</option>
							<option value="1">SmartPit</option>
							<option value="2">PayPal</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">SmartPit</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pedido_codigo_smartpit" placeholder="Digite o codigo do SmartPit" value="<?php echo $pedido_codigo_smartpit;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Token Paypal</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pedido_paypal_token" placeholder="Digite o token do Paypal" value="<?php echo $pedido_paypal_token;?>">
					</div>
				</div>
                <div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Payerid Paypal</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pedido_paypal_payerid" placeholder="Digite o payerid do Paypal" value="<?php echo $pedido_paypal_payerid;?>">
					</div>
				</div>

				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="cliente_nome" placeholder="Digite o nome" value="<?php echo $cliente_nome;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="cliente_email" placeholder="Digite o email" value="<?php echo $cliente_email;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Telefone</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="cliente_telefone" placeholder="Digite o telefone" onkeyup="somenteNumeros(this);"  value="<?php echo $cliente_telefone;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Celular</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="cliente_cellfone" placeholder="Digite o celular" onkeyup="somenteNumeros(this);" value="<?php echo $cliente_cellfone;?>">
					</div>
				</div>

				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Nome Entrega</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pedido_cliente_nome" placeholder="Digite o nome" value="<?php echo $pedido_cliente_nome;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Telefone Entrega</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pedido_cliente_telefone" placeholder="Digite o telefone" onkeyup="somenteNumeros(this);"  value="<?php echo $pedido_cliente_telefone;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Celular Entrega</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pedido_cliente_cellfone" placeholder="Digite o celular" onkeyup="somenteNumeros(this);" value="<?php echo $pedido_cliente_cellfone;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Codigo Interno</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="produto_codigo_cliente" placeholder="Digite o codigo interno" value="<?php echo $produto_codigo_cliente;?>">
					</div>
				</div>

				<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
						<div class="pull-right">
							<a href="administrativo.php?link=86"><button type='button' class='btn btn-primary' onclick="<?php echo $loading;?>">Limpar</button></a>
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
                <th><?php $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=115"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>
                <th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=118"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>	
								<th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=117"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>	
                <th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=124"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>		
                <th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=91"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>		
                </tr>
            </thead>
            <tbody>

                <?php
                    while($ln = mysqli_fetch_assoc($resultado)){
                        $pedido_id 						= $ln['id'];
                        $cep_entrega_id 				= $ln['cep_entrega_id'];
                        $pedido_endereco_entrega 		= $ln['pedido_endereco_entrega'];
                        $pedido_cliente_nome 			= $ln['pedido_cliente_nome'];
                        $pedido_cliente_telefone 		= $ln['pedido_cliente_telefone'];
                        $pedido_cliente_cellfone 		= $ln['pedido_cliente_cellfone'];
                        $pedido_valor_itens 			= $ln['pedido_valor_itens'];
                        $pedido_valor_frete_calculado 	= $ln['pedido_valor_frete_calculado'];
                        $pedido_forma_pagamento 		= $ln['pedido_forma_pagamento'];
                        $pedido_codigo_smartpit 		= $ln['pedido_codigo_smartpit'];
						$pedido_paypal_retorno 			= $ln['pedido_paypal_retorno'];
                        $situacao			 			= $ln['situacao'];
                        $pedido_situacao_id		 		= $ln['pedido_situacao_id'];
						$pedido_criacao					= $ln['pedido_criacao'];
												
						if ($pedido_forma_pagamento=='1'){
							$forma_pagamento = 'SmartPit';
						} else if ($pedido_forma_pagamento=='2'){
							$forma_pagamento = 'PayPal';
						}

                        $total = $pedido_valor_itens + $pedido_valor_frete_calculado;
                        $total = number_format($total,0,',',',');

                        echo "  <tr>
                                    <td align='left'>$pedido_id</td>
                                    <td align='right'>$forma_pagamento</td>
                                    <td align='right'>$situacao</td>
                                    <td align='right'>$pedido_criacao</td>
                                    <td align='right'>$total 円</td>
                                    <td align='right'> <input type='checkbox'> <input type='checkbox'> <a href='administrativo.php?link=74&id=$pedido_id' onclick=";	echo '"'.$loading.'"'; echo "><i class='fa fa-search-plus' style='font-size:25px;' aria-hidden='true'></i></a></td>
                                </tr>";

                    }
                ?>
            </tbody>
            </table>
		</div>
	</div>
</div> <!-- /container -->