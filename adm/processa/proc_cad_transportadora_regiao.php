<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$transp_regiao_ingles 			= $_POST["transp_regiao_ingles"];
$transp_regiao_japones 			= $_POST["transp_regiao_japones"];
$transportadora_id 				= $_POST["transportadora_id"];

$query = mysqli_query($connection,'INSERT INTO transp_regioes (transp_regiao_ingles, transp_regiao_japones, transportadora_id, transp_regiao_criacao) VALUES ("'.$transp_regiao_ingles.'", "'.$transp_regiao_japones.'","'.$transportadora_id.'", "'.date($now).'")');
$id_novo = mysqli_insert_id($connection);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	</head>
	
	<body>
		<?php
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=62&id='.$id_novo);		   
			}
			else{ 	
                //retorna para a pagina anterior
                echo    "<script type='text/javascript'>  
                            alert(Erro ao gravar registro!);
                            history.back()
                        </script>";	   
			}
		?>
	</body>
</html>