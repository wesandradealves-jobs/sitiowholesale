<?php
	$id = $_GET['id'];
    //Executa consulta

    //informacoes do cadastro

      $resultado = mysqli_query($connection,"SELECT 	d.*, 
	                                                b.post_provincia_ingles as provincia,
	                                                c.post_cidade_ingles as cidade
                                            FROM    post_ceps a,
	                                                post_provincias b, 
	                                                post_cidades c,
	                                                clientes d
                                            WHERE   a.id = d.cep_id 
                                              AND   b.id=a.provincia_id 
                                              AND   c.id=a.cidade_id
                                              AND   d.id = $id LIMIT 1");
    $linhas = mysqli_fetch_assoc($resultado);

    $cliente_nome       = $linhas['cliente_nome'];
    $cliente_telefone   = $linhas['cliente_telefone'];
    $cliente_cellfone   = $linhas['cliente_cellfone'];
    $cep_id             = $linhas['cep_id'];
    $provincia          = $linhas['provincia'];
    $cidade             = $linhas['cidade'];
    $cliente_endereco   = $linhas['cliente_endereco'];
    $cliente_email      = $linhas['cliente_email'];
    $cliente_criacao    = $linhas['cliente_criacao'];
    $cliente_modificacao= $linhas['cliente_modificacao'];

    //informacoes de faturamento
    $resultado = mysqli_query($connection,"SELECT pedido_situacao_id, count(*) AS qt_pedido, sum(pedido_valor_itens+pedido_valor_frete_calculado) AS valor_pedido FROM pedidos WHERE cliente_id = '$id' GROUP BY pedido_situacao_id");
    $valor_pagamento_recebido   = 0;
    $qt_pedido_recebido         = 0;
    $valor_pagamento_aberto     = 0;
    $qt_pedido_aberto           = 0;
    $valor_pagamento_cancelado  = 0;
    $qt_pedido_cancelado        = 0;
    $qt_pedido_total            = 0;
    $valor_pagamento_total      = 0;
    while ($linhas = mysqli_fetch_assoc($resultado)){
        $pedido_situacao_id = $linhas['pedido_situacao_id'];
        $qt_pedido          = $linhas['qt_pedido'];
        $valor_pedido       = $linhas['valor_pedido'];

        //pedidos recebidos
        if ($pedido_situacao_id==3 || $pedido_situacao_id==4 || $pedido_situacao_id==5){
            $valor_pagamento_recebido  += $linhas['valor_pedido'];
            $qt_pedido_recebido        += $linhas['qt_pedido'];
        } else if ($pedido_situacao_id==1 || $pedido_situacao_id==2){        
            $valor_pagamento_aberto += $linhas['valor_pedido'];
            $qt_pedido_aberto       += $linhas['qt_pedido'];
        } else  if ($pedido_situacao_id==6){    
            $valor_pagamento_cancelado += $linhas['valor_pedido'];
            $qt_pedido_cancelado       += $linhas['qt_pedido'];
        }
        $valor_pagamento_total += $linhas['valor_pedido'];
        $qt_pedido_total += $linhas['qt_pedido'];
    }
    $valor_pagamento_recebido   = number_format($valor_pagamento_recebido,0,',',',');
    $valor_pagamento_aberto     = number_format($valor_pagamento_aberto,0,',',',');
    $valor_pagamento_cancelado  = number_format($valor_pagamento_cancelado,0,',',',');
    $valor_pagamento_total      = number_format($valor_pagamento_total,0,',',',');
    

?>
<div class="page-header">
<div class="container">
		<br>
		<h1>Informacoes do Cliente</h1>
</div>
</div>
<div class="container theme-showcase" role="main">      
  <div class="row">
		<div class="col-md-12">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-1 control-label">Email</label>
				<div class="col-sm-10">
                    <label><?php echo $cliente_email;?></label>
				</div>
			</div>	
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-1 control-label">Nome</label>
				<div class="col-sm-10">
                    <label><?php echo $cliente_nome;?></label>
				</div>
			</div>	
        </div>	
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-1 control-label">Telefone</label>
				<div class="col-sm-10">
                    <label><?php echo $cliente_telefone;?></label>
				</div>
			</div>	
        </div>	
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-1 control-label">Cep</label>
				<div class="col-sm-10">
                    <label><?php echo $cep_id;?></label> <label id="provincia_descricao"><?php echo $provincia;?></label> <label id="cidade_descricao"><?php echo $cidade;?></label>
				</div>
			</div>	
        </div>	
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-1 control-label">Endereco</label>
				<div class="col-sm-10">
                    <label><?php echo $cliente_endereco;?></label>
				</div>
			</div>		 
		</div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-1 control-label">Cadastrado</label>
				<div class="col-sm-10">
                    <label><?php echo $cliente_criacao;?></label>
				</div>
			</div>	
        </div>	
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-1 control-label">Atualizado</label>
				<div class="col-sm-10">
                    <label><?php echo $cliente_modificacao;?></label>
				</div>
			</div>	
        </div>	
	</div>
</div> <!-- /container -->


<div class="page-header">
<div class="container">
		<br>
		<h1>Informacoes dos Pedidos</h1>
</div>
</div>
<div class="container theme-showcase" role="main">      
    <div class="row">
    <div class="col-md-12">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-1 control-label">Incompleto</label>
				<div class="col-sm-10">
                    <label><?php echo "Qt: $qt_pedido_aberto - Valor: $valor_pagamento_aberto 円";?></label>
                </div>
			</div>	
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-1 control-label">Recebido</label>
				<div class="col-sm-10">
                    <label><?php echo "Qt: $qt_pedido_recebido - Valor: $valor_pagamento_recebido 円";?></label>
                </div>
			</div>	
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-1 control-label">Cancelado</label>
				<div class="col-sm-10">
                    <label><?php echo "Qt: $qt_pedido_cancelado - Valor: $valor_pagamento_cancelado 円";?></label>
                </div>
			</div>	
        </div>	
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-1 control-label">Total</label>
				<div class="col-sm-10">
                    <label><?php echo "Qt: $qt_pedido_total - Valor: $valor_pagamento_total 円";?></label>
                </div>
			</div>	
        </div>
    </div>
</div>



<div class="page-header">
<div class="container">
		<br>
		<h1>Lista de Pedidos</h1>
</div>
</div>
<div class="container theme-showcase" role="main"> 
    <div class="row ">
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
                    $query =mysqli_query($connection,"SELECT *, (SELECT pedido_situacao_descricao_ingles FROM pedido_situacao WHERE id = pedido_situacao_id) as situacao FROM pedidos WHERE cliente_id =$id order by id desc");
                    while($ln = mysqli_fetch_assoc($query)){
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
                        $pedido_criacao 				= $ln['pedido_criacao'];

                        $total = $pedido_valor_itens + $pedido_valor_frete_calculado;
                        $total = number_format($total,0,',',',');

                        if ($pedido_forma_pagamento=='1'){
                            $forma_pagamento = 'SmartPit';
                        } else if ($pedido_forma_pagamento=='2'){
                            $forma_pagamento = 'PayPal';
                        }


                        echo "  <tr>
                                    <td align='left'>$pedido_id</td>
                                    <td align='right'>$forma_pagamento</td>
                                    <td align='right'>$situacao</td>
                                    <td align='right'>$pedido_criacao</td>
                                    <td align='right'>$total 円</td>
                                    <td align='right'><a href='administrativo.php?link=74&id=$pedido_id' onclick=";	echo '"'.$loading.'"'; echo "><i class='fa fa-search-plus' style='font-size:25px;' aria-hidden='true'></i></a></td>
                                </tr>";

                    }
                ?>
            </tbody>
            </table>
        </div>
    </div>
</div>