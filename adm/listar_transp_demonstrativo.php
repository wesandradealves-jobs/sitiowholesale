<div class="page-header">
	<div class="container">
		<br>
		<h1>Demonstrativo de Transporte</h1>
	</div>
</div>

<div class="container theme-showcase" role="main">      
    <?php
	    $result=mysqli_query($connection,"SELECT * FROM transportadoras");
	    while($dados = mysqli_fetch_assoc($result)){
        $transportadora_id = $dados['id'];
            
    ?>	
        <div class="container">
            <h3><?php echo $dados['transportadora_ingles'];?> </h3>
        </div>

        <div class="row">
            <div class="col-md-12">
            <table border='1' style="border-collapse: separate; padding:5px;" >
                <thead>
                <tr bgcolor='#F8F8FF'>
                <th>Caixa(KG)</th>
                <?php
                    $result1=mysqli_query($connection,"SELECT * FROM transp_regioes WHERE transportadora_id=$transportadora_id ORDER BY id");
                    while($dados1 = mysqli_fetch_assoc($result1)){
                        $regiao_id = $dados1['id'];
                        
                        echo '<th style="vertical-align: top; text-align:center;"><a href="administrativo.php?link=62&id='.$dados1['id'].'" onclick="'.$loading.'">'.$dados1['transp_regiao_ingles'].'</a><p></p>';
                ?>	
                    <?php
                        $result2=mysqli_query($connection,"SELECT * FROM post_provincias WHERE id IN (SELECT provincia_id  FROM transp_regiao_provincias WHERE regiao_id = $regiao_id)");
                        while($dados2 = mysqli_fetch_assoc($result2)){
                            echo '<small>&nbsp;'.$dados2['post_provincia_ingles'].'&nbsp;</small><br>';
                        }
                    ?>	                       
                <?php
                        echo '</th>';
                    }
                ?>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $result=mysqli_query($connection,"SELECT distinct(caixa_id) FROM transp_valores WHERE regiao_id IN (SELECT regiao_id FROM transp_regioes WHERE transportadora_id=$transportadora_id) ORDER BY caixa_id, regiao_id");
                        while($dados = mysqli_fetch_assoc($result)){
                            $caixa_id = $dados['caixa_id'];
                            echo '<tr><td>&nbsp;'.$caixa_id.'&nbsp;</td>';
   
                            $result1=mysqli_query($connection,"SELECT a.*, (SELECT b.transp_valor_frete FROM transp_valores b WHERE b.caixa_id = $caixa_id and b.regiao_id = a.id) as transp_valor_frete FROM transp_regioes a WHERE a. transportadora_id=$transportadora_id ORDER BY a.id");
                            while($dados1 = mysqli_fetch_assoc($result1)){
                                echo '<td><small>&nbsp;'.$dados1['transp_valor_frete'].'&nbsp;</small></td>';
                            }

                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    <?php
    	}
    ?>
</div> <!-- /container -->



