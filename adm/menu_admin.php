<!-- Inicio navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
		<li><a class="navbar-brand" href="administrativo.php" onclick="<?php echo $loading;?>">Inicio</a></li>
	</div>

		<?php
		//quantidades de pedido que vai mostrar nos avisos
    $resultado = mysqli_query($connection,"SELECT pedido_situacao_id, count(*) AS qt_pedido FROM pedidos WHERE  pedido_situacao_id in ('2','3') OR (pedido_situacao_id=1 AND pedido_forma_pagamento=1) GROUP BY pedido_situacao_id");
    $qt_pedido_smartpit    = 0;
    $qt_pedido_confirmar   = 0;
    $qt_pedido_entregar    = 0;
    while ($linhas = mysqli_fetch_assoc($resultado)){
        $pedido_situacao_id = $linhas['pedido_situacao_id'];
        $qt_pedido          = $linhas['qt_pedido'];

        //pedidos recebidos
        if ($pedido_situacao_id==1){
            $qt_pedido_smartpit  += $linhas['qt_pedido'];
        } else if ($pedido_situacao_id== 2){        
            $qt_pedido_confirmar += $linhas['qt_pedido'];
        } else  if ($pedido_situacao_id==3){    
            $qt_pedido_entregar  += $linhas['qt_pedido'];
        }
    }
		?>
	<div id="navbar" class="navbar-collapse collapse">
	  <ul class="nav navbar-nav">  

			<div class="navbar-header">
				<li class="dropdown">
					<!-- Pedidos aguardando codigo de pagamento smart pit -->
					<?php if ($qt_pedido_smartpit > 0){ ?>
								<a class="navbar-brand" href="administrativo.php?link=86&f1=1&f2=1" onclick="<?php echo $loading;?>"> <i style="font-size: 25px; color:red;" class="fa fa fa-warning"  aria-hidden="true"><div id="cart0"><div id="qt_cart" style='display:block;' ><div id="qttotal"><h6><?php echo $qt_pedido_smartpit; ?></h6></div></div></div></i></a>
					<?php } ?>
					<!-- // Pedidos aguardando codigo de pagamento smart pit -->

					<!-- Pedidos aguardando confirmacao de pagamento -->
					<?php if ($qt_pedido_confirmar > 0){ ?>
								<a class="navbar-brand" href="administrativo.php?link=86&f1=2" onclick="<?php echo $loading;?>"> <i style="font-size: 25px; color:#FFD700;" class="fa fa-question-circle" aria-hidden="true"><div id="cart0"><div id="qt_cart" style='display:block;'><div id="qttotal"><h6><?php echo $qt_pedido_confirmar; ?></h6></div></div></div></i></a>
					<?php } ?>
					<!-- // Pedidos aguardando confirmacao de pagamento -->

					<!-- Pedidos aguardando envio -->
					<?php if ($qt_pedido_entregar > 0){ ?>
								<a class="navbar-brand" href="administrativo.php?link=86&f1=3" onclick="<?php echo $loading;?>"> <i style="font-size: 25px; color:#008000;" class="fa fa-thumbs-up" aria-hidden="true"><div id="cart0"><div id="qt_cart" style='display:block;'><div id="qttotal"><h6><?php echo $qt_pedido_entregar; ?></h6></div></div></div></i></a>
					<?php } ?>
					<!-- // Pedidos aguardando envio -->
				</li>
			</div>

		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Faturamento <span class="caret"></span></a>
		  <ul class="dropdown-menu">
			<li><a href="administrativo.php?link=86" onclick="<?php echo $loading;?>">Lista de Pedido(s)</a></li>
		  </ul>
		</li>   
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Produtos <span class="caret"></span></a>
		  <ul class="dropdown-menu">
			<li><a href="administrativo.php?link=11" onclick="<?php echo $loading;?>">Produto </a></li>
			<li><a href="administrativo.php?link=47" onclick="<?php echo $loading;?>">Alterar situacao do Produto</a></li>   
			<li><a href="administrativo.php?link=48" onclick="<?php echo $loading;?>">Departamento</a></li>   
			<li><a href="administrativo.php?link=6" onclick="<?php echo $loading;?>">Categoria</a></li>   
			<li><a href="administrativo.php?link=27" onclick="<?php echo $loading;?>">Sub Categoria</a></li>   
			<li><a href="administrativo.php?link=31" onclick="<?php echo $loading;?>">Marca</a></li>   
			<li><a href="administrativo.php?link=35" onclick="<?php echo $loading;?>">Cor</a></li>   
			<li><a href="administrativo.php?link=39" onclick="<?php echo $loading;?>">Grade</a></li>   
			<li><a href="administrativo.php?link=43" onclick="<?php echo $loading;?>">Tipo Unitario</a></li>   
		  </ul>
		</li>
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Frete <span class="caret"></span></a>
		  <ul class="dropdown-menu">
			<li><a href="administrativo.php?link=63" onclick="<?php echo $loading;?>">Caixa</a></li>
			<li><a href="administrativo.php?link=57" onclick="<?php echo $loading;?>">Transportadoras</a></li>
			<li><a href="administrativo.php?link=60" onclick="<?php echo $loading;?>">Regiao x Valor</a></li>
			<li><a href="administrativo.php?link=66" onclick="<?php echo $loading;?>">Demonstrativo</a></li>
		  </ul>
		</li> 
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Conteudo <span class="caret"></span></a>
		  <ul class="dropdown-menu">
			<li><a href="administrativo.php?link=24" onclick="<?php echo $loading;?>">Carousel</a></li> 
			<li><a href="administrativo.php?link=52" onclick="<?php echo $loading;?>">Traducao da Loja</a></li>  
			<li><a href="administrativo.php?link=78" onclick="<?php echo $loading;?>">Texto Recuperar Senha</a></li>  
			<li><a href="administrativo.php?link=79" onclick="<?php echo $loading;?>">Texto Notificacao de Produto</a></li> 
			<li><a href="administrativo.php?link=80" onclick="<?php echo $loading;?>">Sobre a Empresa</a></li>  
			<li><a href="administrativo.php?link=81" onclick="<?php echo $loading;?>">Market Place</a></li>  
			<li><a href="administrativo.php?link=82" onclick="<?php echo $loading;?>">Politica de Privacidade</a></li>  
			<li><a href="administrativo.php?link=83" onclick="<?php echo $loading;?>">Politica de Troca</a></li>  
			<li><a href="administrativo.php?link=84" onclick="<?php echo $loading;?>">Politica de Frete</a></li>  
			</ul>
		</li> 
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Relatorios <span class="caret"></span></a>
		  <ul class="dropdown-menu">
			<li><a href="administrativo.php?link=86" onclick="<?php echo $loading;?>">Lista de Pedido(s)</a></li> 
			<li><a href="administrativo.php?link=71" onclick="<?php echo $loading;?>">Lista de Cliente(s)</a></li>
			<li><a href="administrativo.php?link=47" onclick="<?php echo $loading;?>">Lista de Produto(s)</a></li>   
			<li><a href="administrativo.php?link=87" onclick="<?php echo $loading;?>">Relatorio de Pedido(s)</a></li> 
			<li><a href="administrativo.php?link=89" onclick="<?php echo $loading;?>">Giro de Produto(s)</a></li> 
		  </ul>
		</li> 
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Configuracao <span class="caret"></span></a>
		  <ul class="dropdown-menu">
				<li><a href="administrativo.php?link=2" onclick="<?php echo $loading;?>">Usuario</a></li>  
				<li><a href="administrativo.php?link=75" onclick="<?php echo $loading;?>">PayPal</a></li>  
				<li><a href="administrativo.php?link=76" onclick="<?php echo $loading;?>">Smart Pit</a></li>  
				<li><a href="administrativo.php?link=77" onclick="<?php echo $loading;?>">Contas de Email</a></li> 
				<li><a href="administrativo.php?link=85" onclick="<?php echo $loading;?>">Dominios da Empresa</a></li>  
				<li><a href="administrativo.php?link=88" onclick="<?php echo $loading;?>">Manutencao</a></li>  
				<!-- acesso restrito do sistema -->
				<?php if($_SESSION['usuarioId'] == "1"){  ?>
					<li><a href="administrativo.php?link=15" onclick="<?php echo $loading;?>">Situacao de Produto</a></li>
					<li><a href="administrativo.php?link=67" onclick="<?php echo $loading;?>">Situacao de Pedido</a></li>
					<li><a href="administrativo.php?link=19" onclick="<?php echo $loading;?>">Nivel de Acesso</a></li>  
					<li><a href="administrativo.php?link=55" onclick="<?php echo $loading;?>">Importacao do POST (CEP)</a></li>  
				<?php } ?>
				<!-- //acesso restrito do sistema -->
			</ul>
		</li> 

		<li><a href="sair.php" onclick="<?php echo $loading;?>">Sair</a></li>
	  </ul>
	</div><!--/.nav-collapse -->
</div>
</nav>
<!-- Fim navbar -->