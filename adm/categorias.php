<?php           
    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest"){        
        include 'conexao.php';
        $ufid = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($ufid){
            $query = $pdo->prepare('SELECT id as value, subcategoria_descricao_ingles as label FROM subcategorias where id=?');
            $query->bindParam(1, $id, PDO::PARAM_INT);
            $query->execute();          
            echo json_encode($query->fetchAll());
            return;
        }       
    }
	echo NULL;
?>