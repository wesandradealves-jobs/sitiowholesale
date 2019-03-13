<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");

$carousel_descricao 		= $_POST["carousel_descricao"];
$carousel_url				= $_POST["carousel_url"];
$carousel_texto_1_ingles	= $_POST["carousel_texto_1_ingles"];
$carousel_texto_1_japones	= $_POST["carousel_texto_1_japones"];
$carousel_texto_2_ingles	= $_POST["carousel_texto_2_ingles"];
$carousel_texto_2_japones	= $_POST["carousel_texto_2_japones"];
$carousel_posicao_texto		= $_POST["carousel_posicao_texto"];
$carousel_efeito_texto_1	= $_POST["carousel_efeito_texto_1"];
$carousel_efeito_texto_2	= $_POST["carousel_efeito_texto_2"];
$carousel_situacao			= $_POST['carousel_situacao'];

if ($carousel_situacao == 1) { // se produto estiver ativo
	$query4 =mysqli_query($connection,"SELECT max(carousel_sequencia) as seq FROM carousels WHERE carousel_sequencia < 9999");
	$linhas4=mysqli_fetch_assoc($query4);
	if ($linhas4['seq']) {
		$sequencia =  $linhas4['seq']+1;	
	} else {
		$sequencia = 1;
	}
} else {
	$sequencia = 9999;
}

$query = mysqli_query($connection,'INSERT INTO carousels (carousel_sequencia, 
														  carousel_descricao, 
														  carousel_situacao, 
														  carousel_url,
														  carousel_texto_1_ingles, 
														  carousel_texto_1_japones, 
														  carousel_texto_2_ingles, 
														  carousel_texto_2_japones, 
														  carousel_posicao_texto, 
														  carousel_efeito_texto_1, 
														  carousel_efeito_texto_2, 
														  carousel_criacao
														  ) VALUES (
														  "'.$sequencia.'",
														  "'.$carousel_descricao.'",														  
														  "'.$carousel_situacao.'",
														  "'.$carousel_url.'", 
														  "'.$carousel_texto_1_ingles.'", 
														  "'.$carousel_texto_1_japones.'", 
														  "'.$carousel_texto_2_ingles.'", 
														  "'.$carousel_texto_2_japones.'", 
														  "'.$carousel_posicao_texto.'", 
														  "'.$carousel_efeito_texto_1.'", 
														  "'.$carousel_efeito_texto_2.'", 
														  "'.date($now).'"
														  )');
$id_novo = mysqli_insert_id($connection);

//rotina para imagens
if (isset($_FILES["uploadFile"]["name"])) {
	$img = $_FILES["uploadFile"]["name"];
	//só faz a rotina se tiver alguma imagem sendo inserida ($img=true)
	if ($img){
		$uploadfile=$_FILES["uploadFile"]["tmp_name"];
		$folder="../../images/";
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
					</script>";
		}
		
		$largura = imagesx($img_origem);
		$altura = imagesy($img_origem);

		$imagem_nova = 'CAROUSEL_'.$id_novo;

		$query3 = mysqli_query($connection,"UPDATE carousels set carousel_imagem='".$imagem_nova."' WHERE id=".$id_novo);
		$img_destino = imagecreatetruecolor($largura, $altura);
		imagecopyresampled($img_destino,$img_origem,0,0,0,0,$largura,$altura,$largura,$altura);		
		imageJPEG($img_destino,$folder.$imagem_nova.'.jpg',75);
	}
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>
	
	<body>
		<?php
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=25');	   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"Categoria de produto não foi cadastrado com Sucesso.\");
				</script>
				";		   
				header('Location: ../administrativo.php?link=25');				
			}
		?>
	</body>
</html>