<?php
    $pedido_id = $_GET['id'];
    //Executa consulta

    //informacoes do pedido
	$query =mysqli_query($connection,"SELECT *, (SELECT pedido_situacao_descricao_ingles FROM pedido_situacao WHERE id = pedido_situacao_id) as situacao FROM pedidos WHERE id = $pedido_id");
	$ln = mysqli_fetch_assoc($query);
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
    $pedido_paypal_token			= $ln['pedido_paypal_token'];
    $pedido_paypal_payerid			= $ln['pedido_paypal_payerid'];
	$situacao			 			= $ln['situacao'];
    $pedido_situacao_id		 		= $ln['pedido_situacao_id'];    
	$pedido_periodo_entrega	 		= $ln['pedido_periodo_entrega'];
    $pedido_criacao 				= $ln['pedido_criacao'];
    $id                             = $ln['cliente_id'];
    
    $resultado = mysqli_query($connection,"SELECT 	b.post_provincia_ingles as provincia,
	                                                c.post_cidade_ingles as cidade
                                            FROM    post_ceps a,
	                                                post_provincias b, 
	                                                post_cidades c
                                            WHERE   a.id = '$cep_entrega_id' 
                                              AND   b.id=a.provincia_id 
                                              AND   c.id=a.cidade_id
                                              LIMIT 1");
    $linhas = mysqli_fetch_assoc($resultado);    
    $provincia_entrega = $linhas['provincia'];
    $cidade_entrega    = $linhas['cidade'];

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
    $cliente_idioma     = $linhas['cliente_idioma'];

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
		<h1>Detalhe do Pedido</h1>
     <a href='impressao_pedido.php?id=<?php echo $pedido_id;?>&idioma=ingles' target="_blank">Imprimir (Ingles)<?php if ($cliente_idioma=='en'){ echo ' - Este é o idioma do cliente.';}?></a><br>
     <a href='impressao_pedido.php?id=<?php echo $pedido_id;?>&idioma=japones' target="_blank">Imprimir (japones)<?php if ($cliente_idioma=='ja'){ echo ' - Este é o idioma do cliente.';}?></a>
</div>
</div>

<form class="form-horizontal" method="POST" action="processa/proc_edit_pedido.php" enctype="multipart/form-data">
    <nav class="navbar navbar-default navbar-fixed-bottom" id="menu">
    <div class="container">
            <div class="pull-right">
                <br>
                <button type="submit" name="submit" class="btn btn-success" onclick="<?php echo $loading;?>">Salvar</button>
                <a href='administrativo.php?link=74&id=<?php echo $pedido_id;?>' class='btn btn-warning' onclick="<?php echo $loading;?>">Cancelar</a>	
            </div>
    </div>
    </nav>
    <div class="container theme-showcase" role="main"> 
        <div class="row ">
            <div class="col-md-12">

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=115"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo $pedido_id;?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=116"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo $pedido_criacao;?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=118"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></label>
                    <div class="col-sm-10">
                        <input type="text" ,
                            class="form-control" 
                            value="<?php    if ($pedido_forma_pagamento==1){
                                                $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=123"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; };
                                            } else if ($pedido_forma_pagamento==2){
                                                echo "PayPal";
                                            } 
                                    ?>"
                            disabled
                        >
                    </div>
                </div>



                <div class="form-group">
                <?php 	
                    if ($pedido_forma_pagamento==1){
                        echo "<label for='inputEmail3' class='col-sm-2 control-label'> SmartPit </label>"; 
                        $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=120"); while($line = mysqli_fetch_assoc($query)){ $mensagem = $line["mensagem"]; }
                        if (!$pedido_codigo_smartpit){
                            echo "<div class='col-sm-10'><input type='text' class='form-control' name='pedido_codigo_smartpit' placeholder='Codigo do SmartPit'></div>";
                        } 
                        else {
                            echo "<div class='col-sm-10'><input type='text' class='form-control' name='pedido_codigo_smartpit' placeholder='Codigo do SmartPit' value='$pedido_codigo_smartpit'></div>";
                        } 

                    }
                    $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=122"); while($line = mysqli_fetch_assoc($query)){ $mensagem2 = $line["mensagem"]; }

                    if ($pedido_forma_pagamento==2){
                        echo "<label for='inputEmail3' class='col-sm-2 control-label'> PayPal Token </label>
                                <div class='col-sm-10'><input type='text' class='form-control' value='$pedido_paypal_token' disabled></div>
                </div>
                <div class='form-group'>";
                                
                        echo "<label for='inputEmail3' class='col-sm-2 control-label'> PayPal payerid </label>
                                <div class='col-sm-10'><input type='text' class='form-control' value='$pedido_paypal_payerid' disabled></div>";
                    } 
                ?>
                </div>
                
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=117"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></label>
                    <div class="col-sm-10">
                        <select name="pedido_situacao_id" class="form-control">
                            <option value="<?php $pedido_situacao = $ln['pedido_situacao_id']; echo $pedido_situacao;?>">
                                <?php 
                                    if ($pedido_situacao != ""){
                                        $resultado1 =mysqli_query($connection,"SELECT * FROM pedido_situacao WHERE id=$pedido_situacao ORDER BY id");
                                        $dados1 = mysqli_fetch_assoc($resultado1);
                                        echo $dados1["pedido_situacao_descricao_ingles"]; 
                                    } else { 
                                        echo "Escolha uma situacao"; 
                                    }
                                ?>
                            </option>
                            <?php 
                                $resultado1 =mysqli_query($connection,"SELECT * FROM pedido_situacao WHERE id<>$pedido_situacao ORDER BY id");
                                while($dados1 = mysqli_fetch_assoc($resultado1)){
                                    ?>
                                        <option value="<?php echo $dados1["id"]; ?>"><?php echo $dados1["pedido_situacao_descricao_ingles"];?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                        <th><?php $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=95"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>
                        <th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=96"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>	
                        <th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=97"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>		
                        <th style="text-align:right"><?php $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=98"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></th>		
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $query =mysqli_query($connection,"SELECT 	a.*, 
                                                                        a.situacao_id as situacao, 
                                                                        a.produto_id as produto, 
                                                                        b.*,
                                                                        c.*,
                                                                        (select cor_descricao_ingles from cor where id = cor_id) as cor_descricao,
                                                                        (select case 
                                                                                    when a.tamanho_id = 1 then ingles_01
                                                                                    when a.tamanho_id = 2 then ingles_02
                                                                                    when a.tamanho_id = 3 then ingles_03
                                                                                    when a.tamanho_id = 4 then ingles_04
                                                                                    when a.tamanho_id = 5 then ingles_05
                                                                                    when a.tamanho_id = 6 then ingles_06
                                                                                    when a.tamanho_id = 7 then ingles_07
                                                                                    when a.tamanho_id = 8 then ingles_08
                                                                                    when a.tamanho_id = 9 then ingles_09
                                                                                    when a.tamanho_id = 10 then ingles_10
                                                                                end as tamanhos
                                                                        from grade_itens where grade_id=a.grade_id and grade_id > 1) as tamanho
                                                                        FROM 	(select * from produto_itens) a,
                                                                        produtos b,
                                                                        pedido_itens c
                                                                        WHERE a.produto_id = b.id 
                                                                        AND a.id = c.produto_id
                                                                        AND c.pedido_id = $pedido_id");

                            while($ln = mysqli_fetch_assoc($query)){
                                $descricao = $ln['produto_codigo_cliente'].' - '. $ln['produto_descricao_ingles'];
                                $cor       = $ln['cor_descricao'];
                                $tamanho   = $ln['tamanho']; 
                                $preco     = $ln['pedido_item_valor_unitario'];
                                $qtd       = $ln['pedido_item_quantidade']; 
                                $sub       = 0;
                                $sub       = $preco * $qtd;
                                $sub       = number_format($sub,0,',',',');
                                $preco     = number_format($preco,0,',',',');

                                echo "  <tr>
                                            <td align='left'><a href='administrativo.php?link=13&id=".$ln['produto']."' onclick=";	echo '"'.$loading.'"'; echo ">$descricao $cor $tamanho</a></td>
                                            <td align='right'>$preco 円</td>
                                            <td align='right'>$qtd</td>
                                            <td align='right'>$sub 円</td>
                                        </tr>";

                            }
                        ?>

                        <!-- Endereco de Entrega -->
                        <script>
                                //carrega os dados do endereco de entrega 
                                var cep  = '<?php echo $cep_entrega_id; ?>';
                                //descricao da provincia
                                function provincia(data) {
                                    $("#provincia_descricao").text(data);
                                }
                                $.get('processa/dados_cep.php?f=1&cep='+cep, provincia);
                                //descricao da cidade
                                function cidade(data) {	
                                    $("#cidade_descricao").text(data);
                                }
                                $.get('processa/dados_cep.php?f=2&cep='+cep, cidade);
                            </script>    
                            <tr><td colspan='5'>
                                <h2 align='left' class="w3ls-title w3ls-title1"><?php $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=101"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h2>  
                                <p style="text-align:left"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=16"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> : <?php echo $_SESSION['nome']; ?></p>
                                <p style="text-align:left"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=18"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> : <?php echo $_SESSION['telefone']?></p>
                                <p style="text-align:left"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=112"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> : 〒 <?php echo $cep_entrega_id; ?>
                                <?php echo $provincia_entrega; ?>
                                <?php echo $cidade_entrega; ?>
                                <?php echo $pedido_endereco_entrega; ?></p>
                                <br><h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=142"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> <?php echo $pedido_periodo_entrega; ?></h4><br>
                            <tr/></td> 
                        <!-- // Endereco de Entrega -->    
                        <?php
                                $valor_total_frete = number_format($pedido_valor_frete_calculado,0,',',',');
                                $total =  number_format($pedido_valor_itens,0,',',',');
                                $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=106"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
                                echo "<tr><td colspan='2'td><h4>$msgTotal</h4></td><td colspan='3' align='right'><h3>$total 円</h3></td><tr/>";
                                $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=107"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
                                echo "<tr><td colspan='2'td><h4>$msgTotal</h4></td><td colspan='3' align='right'><h3>$valor_total_frete 円</h3></td><tr/>";
                                $total = str_replace(',','',$total) + str_replace(',','',$valor_total_frete);
                                $total = number_format($total,0,',',',');
                                $query =mysqli_query($connection,"SELECT mensagem_ingles as mensagem FROM mensagens WHERE id=99"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
                                echo "<tr><td colspan='2'><h4>$msgTotal</h4></td><td colspan='3' align='right'><h3>$total 円</h3></td><tr/>";
                            
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $pedido_id; ?>">
</form>

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
                <label for="inputEmail3" class="col-sm-1 control-label">Pago</label>
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
                        $pedido_criacao = time($pedido_criacao);
                        $pedido_criacao = date("Y-m-d",$pedido_criacao);

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