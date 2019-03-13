<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id 	   			    = $_POST["id"];
$transp_regiao_ingles	= $_POST["transp_regiao_ingles"];
$transp_regiao_japones  = $_POST["transp_regiao_japones"];
$transportadora_id      = $_POST["transportadora_id"];

// Incluindo provincia
if (isset($_POST['caixa_id']) && isset($_POST['transp_valor_frete'])){
	$caixa_id 				= $_POST['caixa_id'];
	$caixa_valor_frete 		= $_POST['transp_valor_frete'];
	$query = mysqli_query($connection,'INSERT INTO transp_valores (caixa_id, regiao_id, transp_valor_frete) VALUES ("'.$caixa_id.'","'.$id.'","'.$caixa_valor_frete.'")');
}

// Incluindo a caixa
if (isset($_POST['provincia_id'])){
	$provincia_id = $_POST['provincia_id'];
	$query = mysqli_query($connection,'INSERT INTO transp_regiao_provincias (regiao_id, provincia_id, transp_regiao_provincia_criacao) VALUES ("'.$id.'","'.$provincia_id.'", "'.date($now).'")');
}

$query = mysqli_query($connection,'UPDATE transp_regioes set transp_regiao_ingles ="'.$transp_regiao_ingles.'", transp_regiao_japones="'.$transp_regiao_japones.'", transportadora_id="'.$transportadora_id.'", transp_regiao_modificacao = "'.date($now).'" WHERE id="'.$id.'"');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=62&id='.$id);	   
			}
			else{ 	
                //retorna para a pagina anterior
                echo    "<script type='text/javascript'>  
                            alert(Ocorreu um erro desconhecido!);
                            history.back()
                        </script>";	   
			}
		?>
	</body>
</html>