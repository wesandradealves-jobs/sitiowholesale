<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");

$id              		= $_POST["id"];
$pedido_situacao_id		= $_POST["pedido_situacao_id"];
$sql 					= "";

if ($_POST["pedido_codigo_smartpit"]){
	$pedido_codigo_smartpit	= $_POST["pedido_codigo_smartpit"];
	$sql = ", pedido_codigo_smartpit = $pedido_codigo_smartpit";
} else {
	$sql = ", pedido_codigo_smartpit = ''";	
	$pedido_codigo_smartpit = '';
}

// saber se a situacao do pedido ou codigo smartpit foram alterados para enviar email
$query =mysqli_query($connection,"SELECT * FROM pedidos WHERE id='$id'"); 
$ln = mysqli_fetch_assoc($query);
$id_pedido 				= $ln['id'];
$codigo_smartpit_antigo = $ln['pedido_codigo_smartpit'];
$situacao_id_antiga		= $ln['pedido_situacao_id'];


$query = mysqli_query($connection,"UPDATE pedidos set pedido_situacao_id ='$pedido_situacao_id' $sql WHERE id='$id'");
echo "UPDATE pedidos set pedido_situacao_id ='$pedido_situacao_id' $sql WHERE id='$id'";

	if (($pedido_codigo_smartpit != '' && $pedido_codigo_smartpit != $codigo_smartpit_antigo) && $pedido_situacao_id !=6){
		$informar_smartpit = $pedido_codigo_smartpit;  
	} else {
		$informar_smartpit = 0; 	
	}

	if ($pedido_situacao_id != $situacao_id_antiga && ($pedido_situacao_id ==1 || $pedido_situacao_id ==2 || $pedido_situacao_id ==3 || $pedido_situacao_id ==5 || $pedido_situacao_id ==6 || $informar_smartpit != 0 )){
		include "../../processa/email_pedido.php"; 
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
				header("Location: ../administrativo.php?link=74&id=$id");		   
			}
			else{ 	
				header("Location: ../administrativo.php?link=74&id=$id");
			}
		?>
	</body>
</html>