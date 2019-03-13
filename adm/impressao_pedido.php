<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");;
include_once("loading.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página Administrativa">
    <link rel="icon" href="imgSite/icon.png">

    <title>Administrativo</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
	
	<link href="../css/font-awesome.css" rel="stylesheet"> 
    <script src="js/ie-emulation-modes-warning.js"></script>
	<style type="text/css">
		#menu {
			botton: 0px;
			width: 100%;
			height: 70px;
		}
	</style>
  </head>

<body onload="window.print();window.close();">

<?php
    $pedido_id = $_GET['id'];
    $msg_idioma = $_GET['idioma'];
    //Executa consulta

    //informacoes do pedido
	$query =mysqli_query($connection,"SELECT *, (SELECT pedido_situacao_descricao_".$msg_idioma." FROM pedido_situacao WHERE id = pedido_situacao_id) as situacao FROM pedidos WHERE id = $pedido_id");
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
    
    $resultado = mysqli_query($connection,"SELECT 	b.post_provincia_".$msg_idioma." as provincia,
	                                                c.post_cidade_".$msg_idioma." as cidade
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

?>

<h3>
        <?php   $query =mysqli_query($connection,"SELECT * FROM empresa WHERE id=1"); 
                $line = mysqli_fetch_assoc($query);
                $empresa_email_contato  = $line["empresa_email_contato"]; 
                $empresa_host           = $line["empresa_host"];
                $empresa_titulo_troca   = $line["empresa_titulo_troca_".$msg_idioma.""];
                $empresa_texto_troca    = $line["empresa_texto_troca_".$msg_idioma.""]; 
        ?>
        <h1 style="text-align:center"><img src='imgSite/logo.png' style="width: 208px;"></h1>
        <p style="text-align:center"><h3 style="text-align:center"><?php echo $empresa_host; ?></h3></p>
        <p style="text-align:center"><h3 style="text-align:center"><i class="fa fa-envelope-o"></i> <?php echo $empresa_email_contato; ?></a> 
        <i class="fa fa-map-marker"></i> <?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=55"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h3></p>
        <p style="text-align:center"><h3 style="text-align:center"><i class="fa fa-mobile-phone"></i> <?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=71"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>
        <i class="fa fa-phone"></i> <?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=56"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h3></p>
        



        <div class="row ">
            <div class="col-md-12">
                <p style="text-align:left"><h3><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=115"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>: <?php echo $pedido_id;?></h3></p>
                <p style="text-align:left"><h3><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=116"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>: <?php echo $pedido_criacao;?></h3></p>
                <p style="text-align:left"><h3><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=118"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?>: 
                    <?php if ($pedido_forma_pagamento==1){
                                $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=123"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; };
                            } else if ($pedido_forma_pagamento==2){
                                echo "PayPal";
                                
                            } 
                    ?>
                </p>

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

                    <h1 align='left' class="w3ls-title w3ls-title1"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=101"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h1>  
                    <p style="text-align:left"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=16"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> : <?php echo $_SESSION['nome']; ?></p>
                    <p style="text-align:left"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=18"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> : <?php echo $_SESSION['telefone']?></p>
                    <p style="text-align:left"><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=112"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> : 〒 <?php echo $cep_entrega_id; ?> <?php echo $provincia_entrega; ?>
                    <?php echo $cidade_entrega; ?>
                    <?php echo $pedido_endereco_entrega; ?></p></h3>
                    <?php if (isset($pedido_periodo_entrega)){ ?>
                        <h4><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=142"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?> <?php echo $pedido_periodo_entrega; ?></h4>
                    <?php }?>
                <!-- // Endereco de Entrega -->    


                <table class="table">
                    <thead>
                        <tr>
                            <th><h1><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=95"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h1></th>
                            <th style="text-align:right"><h1><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=96"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h1></th>	
                            <th style="text-align:right"><h1><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=97"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h1></th>		
                            <th style="text-align:right"><h1><?php $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=98"); while($line = mysqli_fetch_assoc($query)){ echo $line["mensagem"]; } ?></h1></th>		
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $query =mysqli_query($connection,"SELECT 	a.*, 
                                                                        a.situacao_id as situacao, 
                                                                        a.produto_id as produto, 
                                                                        b.*,
                                                                        c.*,
                                                                        (select cor_descricao_$msg_idioma from cor where id = cor_id) as cor_descricao,
                                                                        (select case 
                                                                                    when a.tamanho_id = 1 then ".$msg_idioma."_01
                                                                                    when a.tamanho_id = 2 then ".$msg_idioma."_02
                                                                                    when a.tamanho_id = 3 then ".$msg_idioma."_03
                                                                                    when a.tamanho_id = 4 then ".$msg_idioma."_04
                                                                                    when a.tamanho_id = 5 then ".$msg_idioma."_05
                                                                                    when a.tamanho_id = 6 then ".$msg_idioma."_06
                                                                                    when a.tamanho_id = 7 then ".$msg_idioma."_07
                                                                                    when a.tamanho_id = 8 then ".$msg_idioma."_08
                                                                                    when a.tamanho_id = 9 then ".$msg_idioma."_09
                                                                                    when a.tamanho_id = 10 then ".$msg_idioma."_10
                                                                                end as tamanhos
                                                                        from grade_itens where grade_id=a.grade_id and grade_id > 1) as tamanho
                                                                        FROM 	(select * from produto_itens) a,
                                                                        produtos b,
                                                                        pedido_itens c
                                                                        WHERE a.produto_id = b.id 
                                                                        AND a.id = c.produto_id
                                                                        AND c.pedido_id = $pedido_id");

                            while($ln = mysqli_fetch_assoc($query)){
                                $descricao = $ln['produto_codigo_cliente'].' - '. $ln['produto_descricao_'.$msg_idioma];
                                $cor       = $ln['cor_descricao'];
                                $tamanho   = $ln['tamanho']; 
                                $preco     = $ln['pedido_item_valor_unitario'];
                                $qtd       = $ln['pedido_item_quantidade']; 
                                $sub       = 0;
                                $sub       = $preco * $qtd;
                                $sub       = number_format($sub,0,',',',');
                                $preco     = number_format($preco,0,',',',');

                                echo "  <tr>
                                            <td align='left'><h3>$descricao $cor $tamanho</h3></td>
                                            <td align='right'><h3>$preco 円</h3></td>
                                            <td align='right'><h3>$qtd</h3></td>
                                            <td align='right'><h3>$sub 円</h3></td>
                                        </tr>";

                            }
                        ?>

         
                        <?php
                                $valor_total_frete = number_format($pedido_valor_frete_calculado,0,',',',');
                                $total =  number_format($pedido_valor_itens,0,',',',');
                                $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=106"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
                                echo "<tr><br><td colspan='2'td><h1>$msgTotal</1></td><td colspan='4' align='right'><h2>$total 円</h2></td><tr/>";
                                $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=107"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
                                echo "<tr><td colspan='2'td><h1>$msgTotal</h1></td><td colspan='4' align='right'><h2>$valor_total_frete 円</h2></td><tr/>";
                                $total = str_replace(',','',$total) + str_replace(',','',$valor_total_frete);
                                $total = number_format($total,0,',',',');
                                $query =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=99"); while($line = mysqli_fetch_assoc($query)){ $msgTotal= $line["mensagem"]; } 
                                echo "<tr><td colspan='2'><h1>$msgTotal</h1></td><td colspan='4' align='right'><h2>$total 円</h2></td><tr/>";
                            
                        ?>
                    </tbody>
                </table>

            <!-- Politica de troca -->
            <br><br><br>
            <h4 class="w3ls-title w3ls-title1" align='Center'><?php echo $empresa_titulo_troca; ?></h4>  
            <span style="text-align: justify; display:block;"><?php echo nl2br($empresa_texto_troca);?></span>
            </div>
    </div>
<h3>
    <script src="js/jquery.min.js"></script>
	<script src="js/jquery2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
	<script src="js/ckeditor/ckeditor.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
