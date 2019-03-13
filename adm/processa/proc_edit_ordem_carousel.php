<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");

$id					= $_GET["id"];
$carousel_sequencia = $_GET["seq"];
$situacao			= $_GET["situacao"];
$sequenciamenor     = $carousel_sequencia -1;
$sequenciamaior     = $carousel_sequencia +1;

//quando estiver mudando a sequencia para menos
if($situacao == 1){
	//Pesquisar as sequencias das carouselss
	$resultado=mysqli_query($connection,"SELECT * FROM carousels WHERE carousel_sequencia IN ($sequenciamenor,$carousel_sequencia) AND carousel_sequencia < 9999 ORDER BY carousel_sequencia asc");
	$seq = 0; 
	$nr_registros = mysqli_num_rows($resultado);
	while($linhas=mysqli_fetch_assoc($resultado)){
		if ($nr_registros > 1){
			echo '<br>ID: '.$linhas["id"];
			$id=$linhas["id"];
			$menos =$carousel_sequencia-1;
			$mais = $carousel_sequencia;
			if ($seq==0){
				$query = mysqli_query($connection,"UPDATE carousels set carousel_sequencia = '$mais', carousel_modificacao = '".date($now)."' WHERE id='$id' ");
				echo ' - '.$linhas["carousel_sequencia"];
				echo ' - '.$mais;	
				echo "UPDATE carousels set carousel_sequencia = '$mais', carousel_modificacao = '".date($now)."' WHERE id=$id;<br>";
			} else {
				$query = mysqli_query($connection,"UPDATE carousels set carousel_sequencia = '$menos', carousel_modificacao = '".date($now)."' WHERE id='$id' ");	
				echo ' - '.$linhas["carousel_sequencia"];	
				echo ' - '.$menos;	
				echo "UPDATE carousels set carousel_sequencia = '$menos', carousel_modificacao = '".date($now)."' WHERE id=$id;";
			}
			$seq = 1;
		}
	}
}

//quando estiver mudando a sequencia para mais
if($situacao == 2){
	//Pesquisar as sequencias dos carousels
	$resultado=mysqli_query($connection,"SELECT * FROM carousels WHERE carousel_sequencia IN ($sequenciamaior,$carousel_sequencia) AND carousel_sequencia < 9999 ORDER BY carousel_sequencia asc");
	$seq = 0; 
	$nr_registros = mysqli_num_rows($resultado);
	while($linhas=mysqli_fetch_assoc($resultado)){
		if ($nr_registros > 1){
			$id=$linhas["id"];			
			$mais = $carousel_sequencia+1;
			$menos =$carousel_sequencia;
			if ($seq==0){
				$query = mysqli_query($connection,"UPDATE carousels set carousel_sequencia = '$mais', carousel_modificacao = '".date($now)."' WHERE id='$id'");
				echo 'ID MAIS: '.$linhas["id"];		
				echo ' - '.$linhas["carousel_sequencia"];
				echo ' - '.$mais.'<br>';	
				echo "UPDATE carousels set carousel_sequencia = '$mais', carousel_modificacao = '".date($now)."' WHERE id='$id';<br>";
			} else {
				$query = mysqli_query($connection,"UPDATE carousels set carousel_sequencia = '$menos', carousel_modificacao = '".date($now)."' WHERE id='$id'");	
				echo '<br>ID MENOS: '.$linhas["id"];		
				echo ' - '.$linhas["carousel_sequencia"];	
				echo ' - '.$menos.'<br>';	
				echo "UPDATE carousels set carousel_sequencia = '$menos', carousel_modificacao = '".date($now)."' WHERE id='$id';<br>";
			}
			$seq = 1;
		}
	}
}

//Desativar
if($situacao == 3){
	$query1 = "UPDATE carousels SET carousel_sequencia=9999, carousel_situacao='0' WHERE id = $id";
	$resultado1 = mysqli_query($connection,$query1);

	$query3 =mysqli_query($connection,"SELECT * FROM carousels WHERE carousel_sequencia > $carousel_sequencia AND carousel_sequencia < 9999 ORDER BY carousel_sequencia asc");
	while($linhas3=mysqli_fetch_assoc($query3)){
		$sequencia_sit3 = $linhas3['carousel_sequencia']-1;
		$id_sit3 = $linhas3['id'];

		$query1 = "UPDATE carousels SET carousel_sequencia='$sequencia_sit3' WHERE id = '$id_sit3'";
		$resultado1 = mysqli_query($connection,$query1);
	}
}

//Ativar
if($situacao == 4){
	$query4 =mysqli_query($connection,"SELECT max(carousel_sequencia) as seq FROM carousels WHERE carousel_sequencia < 9999");
	$linhas4=mysqli_fetch_assoc($query4);
	if ($linhas4['seq']) {
		$sequencia =  $linhas4['seq']+1;	
	} else {
		$sequencia = 1;
	}

	$query1 = "UPDATE carousels SET carousel_sequencia=$sequencia, carousel_situacao='1' WHERE id = $id";
	$resultado1 = mysqli_query($connection,$query1);
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
				header('Location: ../administrativo.php?link=25');	   
			}
			 else{ 	
				header('Location: ../administrativo.php?link=25');
			}
?>
	</body>
</html>