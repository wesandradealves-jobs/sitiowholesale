<?php 
date_default_timezone_set('Asia/Tokyo');
$newTime = time();
$now = date("Y-m-d H:i:s", $newTime);

if (!isset($_SESSION['idioma'])){
  $http_lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
    
  if ($http_lang != 'ja') {
    $http_lang  = 'en';
    $msg_idioma = 'ingles';
  } else {
    $msg_idioma = 'japones';
    $http_lang  = 'ja';
  }
} else {
  if ($_SESSION['idioma'] == 'ja') {
    $msg_idioma = 'japones';
    $http_lang  = 'ja';
  } else {
    $http_lang  = 'en';
    $msg_idioma = 'ingles';
  }
}

$connection = mysqli_connect("LOCALHOST", "sitio_adm", "kqR{vV59_nZT", "sitio_ecomerce");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


  //verificar se a manutencao esta ativa, se sim, direcionar para manutencao.php
	//Executa consulta
	$resultado = mysqli_query($connection,"SELECT * FROM empresa WHERE id = 1 LIMIT 1");
  $linhas = mysqli_fetch_assoc($resultado);

  if ($linhas['empresa_manutencao'] == 1){
    if (!isset($manutencao)){
      header('Location: manutencao.php');
    }
  }
?>