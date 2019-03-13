<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");
	$id = $_GET['id'];
	//Executa consulta
	$result = mysqli_query($connection,"SELECT * FROM carousels WHERE id = '$id' LIMIT 1");
	$linhas = mysqli_fetch_assoc($result);
?>
        <div class="banner">
        <script type="application/x-javascript"> 
            addEventListener("load", function() {
                setTimeout(hideURLbar, 0); }, false);
                function hideURLbar(){ window.scrollTo(0,1); 
            } 
        </script>
        <!-- Custom Theme files -->
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <link href="../css/style.css" rel="stylesheet" type="text/css" media="all" /> 
        <link href="../css/menu.css" rel="stylesheet" type="text/css" media="all" /> <!-- menu style --> 
        <link href="../css/ken-burns.css" rel="stylesheet" type="text/css" media="all" /> <!-- banner slider --> 
        <link href="../css/animate.min.css" rel="stylesheet" type="text/css" media="all" /> 
        <link href="../css/owl.carousel.css" rel="stylesheet" type="text/css" media="all"> <!-- carousel slider -->  
        <!-- //Custom Theme files -->
        <!-- font-awesome icons -->
        <link href="../css/font-awesome.css" rel="stylesheet"> 
        <!-- //font-awesome icons -->
        <!-- js -->
        <script src="../js/jquery-2.2.3.min.js"></script> 
        <!-- //js --> 
        <!-- web-fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Lovers+Quarrel' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Offside' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Tangerine:400,700' rel='stylesheet' type='text/css'>
        <!-- web-fonts --> 
        <script src="../js/owl.carousel.js"></script>  

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
        <script src="../js/jquery-scrolltofixed-min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {

                // Dock the header to the top of the window when scrolled past the banner. This is the default behaviour.

                $('.header-two').scrollToFixed();  
                // previous summary up the page.

                var summaries = $('.summary');
                summaries.each(function(i) {
                    var summary = $(summaries[i]);
                    var next = summaries[i + 1];

                    summary.scrollToFixed({
                        marginTop: $('.header-two').outerHeight(true) + 10, 
                        zIndex: 999
                    });
                });
            });
        </script>
        <!-- start-smooth-scrolling -->
        <script type="text/javascript" src="../js/move-top.js"></script>
        <script type="text/javascript" src="../js/easing.js"></script>	
        <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $(".scroll").click(function(event){		
                        event.preventDefault();
                        $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
                    });
                });
        </script>
        <!-- //end-smooth-scrolling -->
        <!-- smooth-scrolling-of-move-up -->
            <script type="text/javascript">
                $(document).ready(function() {
                
                    var defaults = {
                        containerID: 'toTop', // fading element id
                        containerHoverID: 'toTopHover', // fading element hover id
                        scrollSpeed: 1200,
                        easingType: 'linear' 
                    };
                    
                    $().UItoTop({ easingType: 'easeOutQuart' });
                    
                });
            </script>
            <!-- //smooth-scrolling-of-move-up -->
        <script src="../js/bootstrap.js"></script>	








		<div id="kb" class="carousel kb_elastic animate_text kb_wrapper" data-ride="carousel" data-interval="6000" data-pause="hover">
			<!-- Wrapper-for-Slides -->
            <div class="carousel-inner" role="listbox">  
                <div class="item active"><!-- First-Slide -->
                    <a href="<?php echo $linhas['carousel_url']; ?>" target="_blank">
                    <img src="../images/<?php echo $linhas['carousel_imagem']; ?>.jpg" alt="" class="img-responsive" />
                    <div class="carousel-caption kb_caption <?php echo $linhas['carousel_posicao_texto']; ?>">
                        <?php if ($linhas['carousel_texto_1_ingles']){  ?>   
                            <h3 data-animation="animated <?php echo $linhas['carousel_efeito_texto_1']; ?>"><?php echo $linhas['carousel_texto_1_ingles']; ?></h3>
                        <?php }
                              if ($linhas['carousel_texto_2_ingles']){  
                        ?>   
                            <h4 data-animation="animated <?php echo $linhas['carousel_efeito_texto_2']; ?>"><?php echo $linhas['carousel_texto_2_ingles']; ?></h4>
                        <?php } 
                        ?>   
                    </div>
                    </a>
                </div>  

                <div class="item"> <!-- Second-Slide -->
                    <a href="<?php echo $linhas['carousel_url']; ?>" target="_blank">
                    <img src="../images/<?php echo $linhas['carousel_imagem']; ?>.jpg" alt="" class="img-responsive" />
                    <div class="carousel-caption kb_caption <?php echo $linhas['carousel_posicao_texto']; ?>">
                        <?php if ($linhas['carousel_texto_1_japones']){  ?>   
                            <h3 data-animation="animated <?php echo $linhas['carousel_efeito_texto_1']; ?>"><?php echo $linhas['carousel_texto_1_japones']; ?></h3>
                        <?php }
                              if ($linhas['carousel_texto_2_japones']){  
                        ?>   
                            <h4 data-animation="animated <?php echo $linhas['carousel_efeito_texto_2']; ?>"><?php echo $linhas['carousel_texto_2_japones']; ?></h4>
                        <?php } 
                        ?>   
                    </div>
                    </a>
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
            <script src="../js/custom.js"></script>
    	</div>






        <!-- countdown.js -->	
        <script src="../js/jquery.knob.js"></script>
        <script src="../js/jquery.throttle.js"></script>
        <script src="../js/jquery.classycountdown.js"></script>
            <script>
                $(document).ready(function() {
                    $('#countdown1').ClassyCountdown({
                        end: '1388268325',
                        now: '1387999995',
                        labels: true,
                        style: {
                            element: "",
                            textResponsive: .5,
                            days: {
                                gauge: {
                                    thickness: .10,
                                    bgColor: "rgba(0,0,0,0)",
                                    fgColor: "#1abc9c",
                                    lineCap: 'round'
                                },
                                textCSS: 'font-weight:300; color:#fff;'
                            },
                            hours: {
                                gauge: {
                                    thickness: .10,
                                    bgColor: "rgba(0,0,0,0)",
                                    fgColor: "#05BEF6",
                                    lineCap: 'round'
                                },
                                textCSS: ' font-weight:300; color:#fff;'
                            },
                            minutes: {
                                gauge: {
                                    thickness: .10,
                                    bgColor: "rgba(0,0,0,0)",
                                    fgColor: "#8e44ad",
                                    lineCap: 'round'
                                },
                                textCSS: ' font-weight:300; color:#fff;'
                            },
                            seconds: {
                                gauge: {
                                    thickness: .10,
                                    bgColor: "rgba(0,0,0,0)",
                                    fgColor: "#f39c12",
                                    lineCap: 'round'
                                },
                                textCSS: ' font-weight:300; color:#fff;'
                            }

                        },
                        onEndCallback: function() {
                            console.log("Time out!");
                        }
                    });
                });
            </script>
        <!-- //countdown.js -->
        <!-- menu js aim -->
        <script src="../js/jquery.menu-aim.js"> </script>
        <script src="../js/main.js"></script> <!-- Resource jQuery -->
