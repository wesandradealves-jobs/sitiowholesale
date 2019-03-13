<?php
session_start();
include_once("../conexao.php");
$cep = $_GET["cep"];
$f = $_GET["f"];

if (strlen($cep)>6){
    $query = "SELECT a.*, b.post_provincia_".$msg_idioma." as provincia, c.post_cidade_".$msg_idioma." as cidade FROM post_ceps a, post_provincias b, post_cidades c WHERE a.id=$cep AND b.id=a.provincia_id AND c.id=a.cidade_id";
    $resultado = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($resultado);

    if ($f==1){       
        $codigo    = $row["provincia"];
        echo $codigo;
    }
    if ($f==2){       
        $codigo    = $row["cidade"];
        echo $codigo;
    }
    if ($f==3){   
        if ($row["post_cep_bairro_ingles"]!='*'){    
            $codigo    = $row["post_cep_bairro_".$msg_idioma.""];
            echo $codigo;
        }
    }
}
?>