<?php 
include "restrito.php";

include_once("seguranca.php");
include_once("conexao.php");

$arquivo   = '/home/sitio/public_html/adm/post/roman2.txt';
$handle    = fopen($arquivo, "r");
$cidade    = "";
$provincia = "";

// loop até o final do arquivo
while (!feof ($handle)) {
  // pega o texto linha a linha
  $nome = fgets($handle, 4096);
  // imprime os nomes do arquivo
  $dados = explode(';', $nome);
  
  //rotina para gravar a cidade só uma vez
  if ($cidade != $dados[3]){
    // Perform a query, check for error
    $query = mysqli_query($connection,"INSERT INTO post_cidades (id, post_cidade_ingles, post_cidade_japones) VALUES (".$dados[3].",'$dados[5]', '$dados[13]')");
    $cidade = $dados[3]; //guarda qual cidade foi gravada para nao entrar no if novamente
  }
  
  //rotina para gravar a provincia só uma vez
  if ($provincia != $dados[2]){
    $query = mysqli_query($connection,"INSERT INTO post_provincias (id, post_provincia_ingles, post_provincia_japones) VALUES (".$dados[2].",'$dados[6]', '$dados[14]')");
    $provincia = $dados[2]; //guarda qual cidade foi gravada para nao entrar no if novamente
  }

  //rotina para gravar o CEP
  $query = mysqli_query($connection,"INSERT INTO post_ceps (id,
                                                            provincia_id,
                                                            cidade_id,
                                                            post_cep_bairro_ingles,
                                                            post_cep_bairro_japones,
                                                            post_cep_regiao_ingles,
                                                            post_cep_regiao_japones
                                                          ) VALUES (
                                                            '$dados[1]',
                                                            '$dados[2]',
                                                            '$dados[3]',                                                           
                                                            '$dados[4]',
                                                            '$dados[12]', 
                                                            '$dados[7]', 
                                                            '$dados[15]'
                                                            )");
  echo   $dados[0]." - " //id
        .$dados[1]." - " //post_cep
        .$dados[2]." - " //provincia_id
        .$dados[6]." - " //provincia_descricao_ingles
        .$dados[14]." - " //provincia_descricao_japones
        .$dados[3]." - " //cidade_id
        .$dados[5]." - " //cidade_descricao_ingles
        .$dados[13]." - " //cidade_descricao_japones
        .$dados[4]." - " //post_descricao_bairro_ingles
        .$dados[12]." - " //post_descricao_bairro_japones
        .$dados[7]." - " //post_regiao_ingles
        //.$dados[8]." - "
        //.$dados[9]." - "
        //.$dados[10]." - "
        //.$dados[11]." - "
        .$dados[15]."<br>"; //post_regiao_japones

}

// fecha um ponteiro de arquivo aberto
fclose ($handle);

?>