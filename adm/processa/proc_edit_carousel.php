<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");

$id 		                = $_POST["id"];
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

$query = mysqli_query($connection,'UPDATE carousels SET carousel_descricao        = "'.$carousel_descricao.'",	
														carousel_situacao         = "'.$carousel_situacao.'", 
														carousel_url              = "'.$carousel_url.'", 
														carousel_texto_1_ingles   = "'.$carousel_texto_1_ingles.'", 
														carousel_texto_1_japones  = "'.$carousel_texto_1_japones.'",  
														carousel_texto_2_ingles   = "'.$carousel_texto_2_ingles.'",  
														carousel_texto_2_japones  = "'.$carousel_texto_2_japones.'",  
														carousel_posicao_texto    = "'.$carousel_posicao_texto.'", 
														carousel_efeito_texto_1   = "'.$carousel_efeito_texto_1.'", 
														carousel_efeito_texto_2   = "'.$carousel_efeito_texto_2.'", 
														carousel_modificacao      = "'.date($now).'"
                                                        WHERE id = "'.$id.'"');
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

		$imagem_nova = 'CAROUSEL_'.$id;

		$query3 = mysqli_query($connection,"UPDATE carousels set carousel_imagem='".$imagem_nova."' WHERE id=".$id);
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
				header("Location: ../administrativo.php?link=70&id=$id");	   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"Categoria de produto não foi cadastrado com Sucesso.\");
				</script>
				";		   
				header("Location: ../administrativo.php?link=70&id=$id");				
			}
		?>
	</body>
</html>