<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$provincia	= $_GET["provincia"];
$regiao 	= $_GET["regiao"];

$query = "DELETE FROM transp_regiao_provincias WHERE provincia_id=$provincia AND regiao_id=$regiao";
$resultado = mysqli_query($connection,$query);
$linhas = mysqli_affected_rows($connection);

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
		if (mysqli_affected_rows($connection) != 0 ){	
            header('Location: ../administrativo.php?link=62&id='.$regiao);		   
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