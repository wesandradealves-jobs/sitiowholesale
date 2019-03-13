<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$id					= $_GET["id"];
$produto_id			= $_GET["produto_id"];
$imagem_sequencia 	= $_GET["seq"];
$situacao			= $_GET["situacao"];
$sequenciamenor     = $imagem_sequencia -1;
$sequenciamaior     = $imagem_sequencia +1;

//quando estiver mudando a sequencia para menos
if($situacao == 1){
	//Pesquisar as sequencias das imagem_produtos
	$resultado=mysqli_query($connection,"SELECT * FROM imagem_produto WHERE produto_id=$produto_id and imagem_sequencia IN ($sequenciamenor,$imagem_sequencia) ORDER BY imagem_sequencia");
	$seq = 0; 
	while($linhas=mysqli_fetch_assoc($resultado)){
		$id=$linhas["id"];
		if ($seq==0){
			$mais = $sequenciamenor+1;
			echo 'ID MAIS: '.$linhas["id"];		
			echo ' - '.$linhas["imagem_sequencia"];
			echo ' - '.$mais;	
			$query = mysqli_query($connection,"UPDATE imagem_produto set imagem_sequencia = $mais, imagem_produto_modificacao = NOW() WHERE id=$id");
		} else {
			$menos =$imagem_sequencia-1;
			$query = mysqli_query($connection,"UPDATE imagem_produto set imagem_sequencia = $menos, imagem_produto_modificacao = NOW() WHERE id=$id");	
			echo '<br>ID MENOS: '.$linhas["id"];		
			echo ' - '.$linhas["imagem_sequencia"];	
			echo ' - '.$menos;	
		}
		$seq = 1;
	}
}


//quando estiver mudando a sequencia para mais
if($situacao == 2){
	//Pesquisar as sequencias das imagem_produtos
	$resultado=mysqli_query($connection,"SELECT * FROM imagem_produto WHERE produto_id=$produto_id and imagem_sequencia IN ($sequenciamaior,$imagem_sequencia) ORDER BY imagem_sequencia");
	$seq = 0; 
	while($linhas=mysqli_fetch_assoc($resultado)){
		$id=$linhas["id"];
		if ($seq==0){
			$mais = $imagem_sequencia+1;
			echo 'ID MAIS: '.$linhas["id"];		
			echo ' - '.$linhas["imagem_sequencia"];
			echo ' - '.$mais;	
			$query = mysqli_query($connection,"UPDATE imagem_produto set imagem_sequencia = $mais, imagem_produto_modificacao = NOW() WHERE id=$id");
		} else {
			$menos =$sequenciamaior-1;
			$query = mysqli_query($connection,"UPDATE imagem_produto set imagem_sequencia = $menos, imagem_produto_modificacao = NOW() WHERE id=$id");	
			echo '<br>ID MENOS: '.$linhas["id"];		
			echo ' - '.$linhas["imagem_sequencia"];	
			echo ' - '.$menos;	
		}
		$seq = 1;
	}
}

//Apagar imagem
if($situacao == 3){
	$query = "SELECT * FROM imagem_produto WHERE id=$id";
	$resultado = mysqli_query($connection,$query);
	$linhas=mysqli_fetch_assoc($resultado);
	$imagem_sequencia = $linhas["imagem_sequencia"];

	$query1 = "UPDATE imagem_produto SET imagem_sequencia=imagem_sequencia-1 WHERE produto_id=$produto_id AND imagem_sequencia > $imagem_sequencia";
	$resultado1 = mysqli_query($connection,$query1);
	
	$query2 = "DELETE FROM imagem_produto WHERE id=$id";
	$resultado2 = mysqli_query($connection,$query2);
	unlink("../imagens/".$id.".jpg");	
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
		if(($situacao == 1)or($situacao == 2)){
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=13&id='.$produto_id);	   
			}
			 else{ 	
				header('Location: ../administrativo.php?link=13&id='.$produto_id);
			}
		}if($situacao == 3){
			if (mysqli_affected_rows($connection) != 0 ){	
				header('Location: ../administrativo.php?link=13&id='.$produto_id);		   
			}
			 else{ 	
				header('Location: ../administrativo.php?link=13&id='.$produto_id);
			}
		}
		?>
	</body>
</html>