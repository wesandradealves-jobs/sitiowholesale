<link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all"> 
<script src="js/owl.carousel.js"></script>  

<script>
$(document).ready(function() { 
	$("#owl-demo").owlCarousel({ 
	  autoPlay: 3000, //Set AutoPlay to 3 seconds 
	  items :4,
	  itemsDesktop : [640,5],
	  itemsDesktopSmall : [480,2],
	  navigation : true
 
	}); 
}); 
</script>
	<!-- banner -->
	<div class="banner">
		<div id="kb" class="carousel kb_elastic animate_text kb_wrapper" data-ride="carousel" data-interval="6000" data-pause="hover">

			<!-- Wrapper-for-Slides -->
            <div class="carousel-inner" role="listbox">  
			<?php
				$resultado=mysqli_query($connection,"SELECT * FROM carousels WHERE carousel_situacao = '1' ORDER BY carousel_sequencia");
				$active = ' active';
				while($linhas = mysqli_fetch_array($resultado)){			
			?>
					<div class="item<?php echo $active; ?>">
						<a href="<?php echo $linhas['carousel_url']; ?>" onclick="<?php echo $loading;?>">
						<img src="images/<?php echo $linhas['carousel_imagem']; ?>.jpg" alt="" class="img-responsive" />
						<div class="carousel-caption kb_caption <?php echo $linhas['carousel_posicao_texto']; ?>">
							<?php if ($linhas["carousel_texto_1_$msg_idioma"]){  ?>   
								<h3 data-animation="animated <?php echo $linhas['carousel_efeito_texto_1']; ?>"><?php echo $linhas["carousel_texto_1_$msg_idioma"]; ?></h3>
							<?php }
								if ($linhas["carousel_texto_2_$msg_idioma"]){  
							?>   
								<h4 data-animation="animated <?php echo $linhas['carousel_efeito_texto_2']; ?>"><?php echo $linhas["carousel_texto_2_$msg_idioma"]; ?></h4>
							<?php } 
							?>   
						</div>
						</a>
					</div>  
			<?php
					$active = '';
				}
			?>
            </div> 
            <!-- Left-Button -->
            <a class="left carousel-control kb_control_left" href="#kb" role="button" data-slide="prev">
				<span class="fa fa-angle-left kb_icons" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a> 
            <!-- Right-Button -->
            <a class="right carousel-control kb_control_right" href="#kb" role="button" data-slide="next">
                <span class="fa fa-angle-right kb_icons" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a> 
        </div>
		<script src="js/custom.js"></script>
	</div>
	<!-- //13banner -->  
