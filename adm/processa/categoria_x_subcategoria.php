<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao.php");
$categoria_id = $_GET["categoria_id"];

$query = "SELECT * FROM subcategorias WHERE categoria_id=$categoria_id";
$resultado = mysqli_query($connection,$query);


echo '<select class="form-control" name="sub_categoria_id" id="sub_categoria_id">';
if (isset($_GET["op"])){
	if ($_GET["op"]=='rel'){
		echo "<option value=''>Todas</option>";
	}
}
while($row = mysqli_fetch_array($resultado)) {             
	$codigo    = $row["id"];
	$descricao = $row["subcategoria_descricao_ingles"];
	echo $codigo;
	echo "<option value=".$codigo.">".$descricao."</option>";
}   
echo '</select>';
?>