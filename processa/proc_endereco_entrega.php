<?php
    session_start();
    include_once("../seguranca.php");
    include_once("../conexao.php");

    $alterar_endereco  = $_POST['alterar_endereco']; // 0=meu endereco / 1=endereco alterado
    $cep_id            = $_POST["cep_id"];
    $cliente_endereco  = $_POST["cliente_endereco"];


    $_SESSION['cep']                = $_POST["cep_id"];
    $_SESSION['endereco']           = $_POST["cliente_endereco"];
    $_SESSION['nome']               = $_POST["cliente_nome"];
    $_SESSION['telefone']           = $_POST["cliente_telefone"];
    $_SESSION['celular']            = $_POST["cliente_cellfone"];

    //verificar se cep existe e apresentar erro
    $query1 =mysqli_query($connection,'SELECT * FROM post_ceps WHERE id = "'.$cep_id.'"'); 
    if (mysqli_num_rows($query1) < 1){	
        $query1 =mysqli_query($connection,"SELECT mensagem_".$msg_idioma." as mensagem FROM mensagens WHERE id=36"); 
        while($line = mysqli_fetch_assoc($query1)){
                $msg = $line["mensagem"];
        }
        //retorna para a pagina anterior
        echo    "<script type='text/javascript'>  
                    alert('$msg');
                    history.back()
                </script>";  
        exit;
    } else {
        echo '<script> location.replace("../review.php"); </script>';
    }
?>