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

  <body role="document">
	<?php
		include_once("menu_admin.php");
		
		if(isset($_GET['link'])) {
			$link = $_GET['link'];
		}
		
		$pag[1] = "bem_vindo.php";
		$pag[2] = "listar_usuario.php";
		$pag[3] = "cad_usuario.php";
		$pag[4] = "editar_usuario.php";
		$pag[6] = "cad_categoria.php";
		$pag[7] = "listar_categoria.php";
		$pag[9] = "editar_categoria.php";
		$pag[10] = "listar_produto.php";
		$pag[11] = "cad_produto.php";
		$pag[13] = "editar_produto.php";
		$pag[14] = "listar_situacao.php";
		$pag[15] = "cad_situacao.php";
		$pag[17] = "editar_situacao.php";
		$pag[18] = "listar_nivel_acesso.php";
		$pag[19] = "cad_nivel_acesso.php";
		$pag[21] = "editar_nivel_acesso.php";
		$pag[22] = "listar_destaque_produto.php";
		$pag[23] = "cad_destaque_prod.php";
		$pag[24] = "cad_carousel.php";
		$pag[25] = "listar_carousel.php";
		$pag[26] = "listar_mensagem_contato.php";
		$pag[27] = "cad_subcategoria.php";
		$pag[28] = "listar_subcategoria.php";
		$pag[30] = "editar_subcategoria.php";
		$pag[31] = "cad_marca.php";
		$pag[32] = "listar_marca.php";
		$pag[34] = "editar_marca.php";
		$pag[35] = "cad_cor.php";
		$pag[36] = "listar_cor.php";
		$pag[38] = "editar_cor.php";
		$pag[39] = "cad_grade.php";
		$pag[40] = "listar_grade.php";
		$pag[42] = "editar_grade.php";
		$pag[43] = "cad_tipo_unitario.php";
		$pag[44] = "listar_tipo_unitario.php";
		$pag[46] = "editar_tipo_unitario.php";
		$pag[47] = "listar_produto.php";
		$pag[48] = "cad_departamento.php";
		$pag[49] = "listar_departamento.php";
		$pag[51] = "editar_departamento.php";
		$pag[52] = "cad_mensagem.php";
		$pag[53] = "listar_mensagem.php";
		$pag[54] = "editar_mensagem.php";
		$pag[55] = "imp_post.php";
		$pag[56] = "processa/proc_imp_post.php";
		$pag[57] = "cad_transportadora.php";
		$pag[58] = "listar_transportadora.php";
		$pag[59] = "editar_transportadora.php";
		$pag[60] = "cad_transportadora_regiao.php";
		$pag[61] = "listar_transportadora_regiao.php";
		$pag[62] = "editar_transportadora_regiao.php";
		$pag[63] = "cad_caixa.php";
		$pag[64] = "listar_caixa.php";
		$pag[65] = "editar_caixa.php";
		$pag[66] = "listar_transp_demonstrativo.php";
		$pag[67] = "cad_situacao_pedido.php";
		$pag[68] = "editar_situacao_pedido.php";
		$pag[69] = "listar_situacao_pedido.php";
		$pag[70] = "editar_carousel.php";
		$pag[71] = "listar_cliente.php";
		$pag[72] = "visual_cliente.php";
		$pag[73] = "listar_pedido.php";
		$pag[74] = "visual_pedido.php";
		$pag[75] = "editar_empresa_paypal.php";
		$pag[76] = "editar_empresa_smartpit.php";
		$pag[77] = "editar_empresa_contas_email.php";
		$pag[78] = "editar_empresa_texto_recuperar_senha.php";
		$pag[79] = "editar_empresa_texto_notificacao_produto.php";
		$pag[80] = "editar_empresa_sobre.php";
		$pag[81] = "editar_empresa_marketplace.php";
		$pag[82] = "editar_empresa_privacidade.php";
		$pag[83] = "editar_empresa_troca.php";
		$pag[84] = "editar_empresa_frete.php";
		$pag[85] = "editar_empresa_host.php";
		$pag[86] = "listar_pedido.php";
		$pag[87] = "rel_pedido.php";
		$pag[88] = "editar_empresa_manutencao.php";
		$pag[89] = "rel_giro_produto.php";
		$pag[90] = "impressao_pedido.php";
		
		if(!empty($link)){
			if(file_exists($pag[$link])){
				include $pag[$link];
			}else{
				include "bem_vindo.php";
			}
		}else{
			include "bem_vindo.php";
		}
		
	?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
	<script src="js/ckeditor/ckeditor.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>