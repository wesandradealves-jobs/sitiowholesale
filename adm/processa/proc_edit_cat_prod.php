<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 	   			         = $_POST["id"];
$categoria_descricao_ingles	 = $_POST["categoria_descricao_ingles"];
$categoria_descricao_japones = $_POST["categoria_descricao_japones"];
$departamento_id			 = $_POST["departamento_id"];
$categoria_tela_principal	 = ( isset($_POST['categoria_tela_principal']) ) ? 1 : 0;

$query = mysqli_query($connection,'UPDATE categorias set categoria_descricao_ingles ="'.$categoria_descricao_ingles.'", categoria_descricao_japones="'.$categoria_descricao_japones.'", departamento_id="'.$departamento_id.'", categoria_tela_principal="'.$categoria_tela_principal.'", categoria_modificacao = "'.date($now).'" WHERE id="'.$id.'"');

//rotina para imagens
if (isset($_FILES["uploadFile"]["name"])) {
	$img = $_FILES["uploadFile"]["name"];
	//só faz a rotina se tiver alguma imagem sendo inserida ($img=true)
	if ($img){
		$uploadfile=$_FILES["uploadFile"]["tmp_name"];
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
					</script>";
		}
		
		$largura = imagesx($img_origem);
		$altura = imagesy($img_origem);
		if ($altura > 220){
			$nova_altura = 220;
			$nova_largura = 320;   
		}

		$imagem_nova = 'CAT_'.$id;

		$query3 = mysqli_query($connection,"UPDATE categorias set categoria_imagem='".$imagem_nova."' WHERE id=".$id);
		$img_destino = imagecreatetruecolor($nova_largura, $nova_altura);
		imagecopyresampled($img_destino,$img_origem,0,0,0,0,$nova_largura,$nova_altura,$largura,$altura);		
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
				header('Location: ../administrativo.php?link=7');		   
			}
			else{ 	
				echo "
				<script type=\"text/javascript\">
				alert(\"Categoria de produto não foi editado com Sucesso.\");
				</script>
				";	
				header('Location: ../administrativo.php?link=7');	   
			}
		?>
	</body>
</html>