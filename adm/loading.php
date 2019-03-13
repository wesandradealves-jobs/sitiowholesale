<!-- loading -->
<?php
	$loading = "javascript:document.getElementById('blanket').style.display = 'block';document.getElementById('aguarde').style.display = 'block';";
?>
	<!--OBS: colocar o comando a baixo no botao 
	onclick="javascript:document.getElementById('blanket').style.display = 'block';document.getElementById('aguarde').style.display = 'block';" 	
	onclick="<?php echo $loading;?>"
	onclick="'.$loading.'"
	-->
	<script>
		$(document).ready(function() {
			$('.btn-theme').click(function(){
				$('#aguarde, #blanket').css('display','block');
			});
		});
	</script>
<div id="blanket"></div>
<div id="aguarde"></div>
<!-- // loading -->	