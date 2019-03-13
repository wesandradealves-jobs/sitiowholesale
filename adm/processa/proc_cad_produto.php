<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");

$produto_codigo_cliente 			= $_POST["produto_codigo_cliente"];
$produto_codigo_fornecedor 			= $_POST["produto_codigo_fornecedor"];
$categoria_id 						= $_POST["categoria_id"];
$sub_categoria_id 					= $_POST["sub_categoria_id"];
$tipo_unitario_id 					= $_POST["tipo_unitario_id"];
$grade_id 							= $_POST["grade_id"];
$marca_id 							= $_POST["marca_id"];
$produto_seco						= ( isset($_POST['produto_seco']) ) ? 1 : 0;
$produto_congelado					= ( isset($_POST['produto_congelado']) ) ? 1 : 0;
$produto_resfriado					= ( isset($_POST['produto_resfriado']) ) ? 1 : 0;
$produto_caixa_propria				= ( isset($_POST['produto_caixa_propria']) ) ? 1 : 0;
$produto_valor_frete				= $_POST["produto_valor_frete"];
$produto_peso 						= $_POST["produto_peso"];
$produto_preco_venda	 			= $_POST["produto_preco_venda"];
$produto_preco_custo 				= $_POST["produto_preco_custo"];
$produto_link_youtube			 	= $_POST["produto_link_youtube"];
$produto_descricao_ingles 			= $_POST["produto_descricao_ingles"];
$produto_descricao_japones 			= $_POST["produto_descricao_japones"];
$produto_descricao_curta_ingles 	= $_POST["produto_descricao_curta_ingles"];
$produto_descricao_curta_japones 	= $_POST["produto_descricao_curta_japones"];
$produto_descricao_longa_ingles 	= $_POST["produto_descricao_longa_ingles"];
$produto_descricao_longa_japones 	= $_POST["produto_descricao_longa_japones"];

$query = mysqli_query($connection,'INSERT INTO produtos (
	produto_codigo_cliente,
	produto_codigo_fornecedor,
	categoria_id,
	sub_categoria_id,
	tipo_unitario_id,
	grade_id,
	marca_id,
	produto_seco,
	produto_resfriado,
	produto_congelado,
	produto_caixa_propria,
	produto_valor_frete,
	produto_peso,
	produto_preco_venda,
	produto_preco_custo,
	produto_link_youtube,
	produto_descricao_ingles,
	produto_descricao_japones,
	produto_descricao_curta_ingles,
	produto_descricao_curta_japones,
	produto_descricao_longa_ingles,
	produto_descricao_longa_japones,
	produto_criacao
	) VALUES(
	"'.$produto_codigo_cliente.'",
	"'.$produto_codigo_fornecedor.'",
	"'.$categoria_id.'",
	"'.$sub_categoria_id.'",
	"'.$tipo_unitario_id.'",
	"'.$grade_id.'",
	"'.$marca_id.'",
	"'.$produto_seco.'",
	"'.$produto_resfriado.'",
	"'.$produto_congelado.'",
	"'.$produto_caixa_propria.'",
	"'.$produto_valor_frete.'",
	"'.$produto_peso.'",
	"'.$produto_preco_venda.'",
	"'.$produto_preco_custo.'",
	"'.$produto_link_youtube.'",
	"'.$produto_descricao_ingles.'",
	"'.$produto_descricao_japones.'",
	"'.$produto_descricao_curta_ingles.'",
	"'.$produto_descricao_curta_japones.'",
	"'.$produto_descricao_longa_ingles.'",
	"'.$produto_descricao_longa_japones.'",
	"'.date($now).'")'
);
$id_novo = mysqli_insert_id($connection);

//gravar um produto_itens por tamanho que existe no produto
$query1 =mysqli_query($connection,"SELECT * FROM grades WHERE id=$grade_id");
$dados = mysqli_fetch_assoc($query1);

for ($i = 1; $i <= $dados["grade_quantidade_tamanhos"]; $i++) {
	$query1 =mysqli_query($connection,"INSERT INTO produto_itens (
		produto_id,
		grade_id,
		tamanho_id,
		produto_item_criacao
		) VALUES(
		'$id_novo',
		'$grade_id',
		'$i',
		NOW())"
	);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
		if (mysqli_affected_rows($connection) != 0 ){	
			header('Location: ../administrativo.php?link=13&id='.$id_novo);	   
		}
		 else{ 	
				echo "
				<script type=\"text/javascript\">
					alert(\"Produto não foi cadastrado com Sucesso.\");
				</script>
			";		   
			header('Location: ../administrativo.php?link=10');
		}
		?>
	</body>
</html>