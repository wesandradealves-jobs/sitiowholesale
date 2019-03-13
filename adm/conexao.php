<?php 
date_default_timezone_set('Asia/Tokyo');
$newTime = time();
$now = date("Y-m-d H:i:s", $newTime);

$http_lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
   
if ($http_lang != 'ja') {
	$http_lang  = 'en';
	$msg_idioma = 'ingles';
} else {
	$msg_idioma = 'japones';
}

$connection = mysqli_connect("LOCALHOST", "sitio_adm", "kqR{vV59_nZT", "sitio_ecomerce");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>