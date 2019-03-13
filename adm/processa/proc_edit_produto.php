<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");

//produtos
$id 								= $_POST["id"];
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

$query = mysqli_query($connection,'UPDATE produtos SET
	produto_codigo_cliente 			= "'.$produto_codigo_cliente.'",
	produto_codigo_fornecedor		= "'.$produto_codigo_fornecedor.'",
	categoria_id 					= "'.$categoria_id.'",
	sub_categoria_id 				= "'.$sub_categoria_id.'",
	tipo_unitario_id 				= "'.$tipo_unitario_id.'",
	grade_id 						= "'.$grade_id.'",
	marca_id 						= "'.$marca_id.'",
	produto_seco					= "'.$produto_seco.'",
	produto_resfriado				= "'.$produto_resfriado.'",
	produto_congelado				= "'.$produto_congelado.'",
	produto_caixa_propria			= "'.$produto_caixa_propria.'",
	produto_valor_frete				= "'.$produto_valor_frete.'",
	produto_peso 					= "'.$produto_peso.'",
	produto_preco_venda 			= "'.$produto_preco_venda.'",
	produto_preco_custo 			= "'.$produto_preco_custo.'",
	produto_link_youtube 			= "'.$produto_link_youtube.'",
	produto_descricao_ingles 		= "'.$produto_descricao_ingles.'",
	produto_descricao_japones 		= "'.$produto_descricao_japones.'",
	produto_descricao_curta_ingles 	= "'.$produto_descricao_curta_ingles.'",
	produto_descricao_curta_japones = "'.$produto_descricao_curta_japones.'",
	produto_descricao_longa_ingles 	= "'.$produto_descricao_longa_ingles.'",
	produto_descricao_longa_japones = "'.$produto_descricao_longa_japones.'",
	produto_modificacao				= "'.date($now).'"
	WHERE id						= "'.$id.'"'
);

//variaveis produto itens update
$contador		= $_POST["contador"]; //quantidade de cores
$tamanho		= $_POST["tamanho"];  //quantidade de tamanhos
for ($i = 1; $i <= $contador; $i++) { //for por cor
	$semcor						= $_POST["semcor"];
	$cor_id						= $_POST["cor_id$i"];
	//update produto_itens 
	$query1 = mysqli_query($connection,"SELECT * FROM produto_itens WHERE produto_id=$id");
	if ($semcor){ //quando tem cor na grade
		while($dados1 = mysqli_fetch_assoc($query1)){
			for ($c = 1; $c <= $tamanho; $c++) { //for por tamanho
				$produto_item_preco_custo	= $_POST["produto_item_preco_custo$i$c"];
				$produto_item_preco_venda	= $_POST["produto_item_preco_venda$i$c"];
				$produto_item_codigo_barra	= $_POST["produto_item_codigo_barra$i$c"];

				$query2 = mysqli_query($connection,"UPDATE produto_itens SET
					cor_id						= '$cor_id',
					produto_item_preco_custo	= '$produto_item_preco_custo',
					produto_item_preco_venda 	= '$produto_item_preco_venda',
					produto_item_codigo_barra	= '$produto_item_codigo_barra',
					produto_item_modificacao	= NOW()
					WHERE produto_id = '$id'
					AND cor_id= '$cor_id'
					AND tamanho_id = '$c'"
				);
			}
		}
	}else{ // quando nao tem cor na grade
		while($dados1 = mysqli_fetch_assoc($query1)){
			for ($c = 1; $c <= $tamanho; $c++) { //for por tamanho
				$produto_item_preco_custo	= $_POST["produto_item_preco_custo$i$c"];
				$produto_item_preco_venda	= $_POST["produto_item_preco_venda$i$c"];
				$produto_item_codigo_barra	= $_POST["produto_item_codigo_barra$i$c"];
		
				$query2 = mysqli_query($connection,"UPDATE produto_itens SET
					produto_item_preco_custo	= '$produto_item_preco_custo',
					produto_item_preco_venda 	= '$produto_item_preco_venda',
					produto_item_codigo_barra	= '$produto_item_codigo_barra',
					produto_item_modificacao	= NOW()
					WHERE produto_id = '$id'
					AND tamanho_id = '$c'"
				);
			}
		}
	}
}

//variaveis produto itens insert
if (isset($_POST["cor_id_incluir"])) {
	$cor_id_incluir	= "";
	$cor_id_incluir	= $_POST["cor_id_incluir"];
} else {
	$cor_id_incluir	= "";
}

//gravar uma nova cor no produto_itens
if ($cor_id_incluir!=''){
	$query2 =mysqli_query($connection,"SELECT * FROM grades WHERE id=$grade_id");
	$dados2 = mysqli_fetch_assoc($query2);
	for ($i = 1; $i <= $dados2["grade_quantidade_tamanhos"]; $i++) {
		$query2 =mysqli_query($connection,"INSERT INTO produto_itens (
			produto_id,
			grade_id,
			cor_id,
			tamanho_id,
			produto_item_criacao
			) VALUES(
			'$id',
			'$grade_id',
			'$cor_id_incluir',
			'$i',
			NOW())"
		);
	}
}


//rotina para imagens
for($i=0;$i<count($_FILES["uploadFile"]["name"]);$i++){
	$img = $_FILES["uploadFile"]["name"][$i];
	//só faz a rotina se tiver alguma imagem sendo inserida ($img=true)
	if ($img){
		$uploadfile=$_FILES["uploadFile"]["tmp_name"][$i];
		$folder="../imagens/";
		$ext = strrchr($img, '.');
		if ($ext === ".jpg"){
			$img_origem = ImageCreateFromJpeg($uploadfile);
		} elseif ($ext === ".jpeg") {
			$img_origem = ImageCreateFromJpeg($uploadfile);
		} elseif ($ext === ".png") {
			$img_origem = ImageCreateFromPng($uploadfile);
		} else {
			echo    "<script type='text/javascript'>  
						alert('Formato da imagem incorreto, carregue uma imagem JPG, JPEG ou PNG!');
						history.back()
					</script>";
			exit;
		}
		
		$largura = imagesx($img_origem);
		$altura = imagesy($img_origem);
		if ($altura > $largura){
		$nova_altura = 500;
		$nova_largura = $largura*$nova_altura/$altura;   
		} else {
		$nova_largura = 500;
		$nova_altura = $altura*$nova_largura/$largura;   
		}
		//insere o nome da imagem no banco de dados
		$query4 =mysqli_query($connection,"SELECT MAX(imagem_sequencia) as seq FROM imagem_produto WHERE produto_id='$id' group by produto_id");
		$linhas4=mysqli_fetch_assoc($query4);
		$sequencia =  $linhas4['seq'];

		if ($sequencia){
			$sequencia = $sequencia + 1;
		} else {
			$sequencia = 1;
		}
		$query3 = mysqli_query($connection,"INSERT INTO imagem_produto (
			produto_id,
			imagem_sequencia,
			imagem_produto_criacao
			) VALUES(
			'$id',
			'$sequencia',
			NOW())"
		);
		$id_nova_img = mysqli_insert_id($connection);
		$img_destino = imagecreatetruecolor($nova_largura, $nova_altura);
		imagecopyresampled($img_destino,$img_origem,0,0,0,0,$nova_largura,$nova_altura,$largura,$altura);		
		imageJPEG($img_destino,$folder.$id_nova_img.'.jpg',75);
	}
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
			header('Location: ../administrativo.php?link=13&id='.$id);	   
		}
		 else{ 	
				echo "
				<script type=\"text/javascript\">
					alert(\"Produto não foi cadastrado com Sucesso.\");
				</script>
			";		   
			header('Location: ../administrativo.php?link=13&id='.$id);
		}
		?>
	</body>
</html>