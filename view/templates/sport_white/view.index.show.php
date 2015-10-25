<?php
/**
 * 首页
 *
 * @author Chris Wang <zeroShop_author@163.com>
 * @version 1.0
 * @package 模板V
 * @copyright (c) 2014 CokeSystem Group
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link http://www.Cokeshow.com.cn zeroShop
 *
 */
?>
<!DOCTYPE HTML>
<html dir="ltr" lang="en-US">
<head>
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo ROOTWWW; ?>view/templates/sport_white/css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo ROOTWWW; ?>view/templates/sport_white/js/jquery.min.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });
                        
            $(".dropdown dd ul li a").click(function() {
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });
                        
            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });


            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });
        });
     </script>
<!-- start menu -->     
<link href="<?php echo ROOTWWW; ?>view/templates/sport_white/css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo ROOTWWW; ?>view/templates/sport_white/js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<!-- end menu -->
<!-- top scrolling -->
<script type="text/javascript" src="<?php echo ROOTWWW; ?>view/templates/sport_white/js/move-top.js"></script>
<script type="text/javascript" src="<?php echo ROOTWWW; ?>view/templates/sport_white/js/easing.js"></script>
   <script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
			});
		});
	</script>
</head>
<body>
	<?php include ROOT .'view/templates/sport_white/include/view.top.inc.php'; ?>
	
	
       <div class="index-banner">
       	  <div class="wmuSlider example1" style="height: 560px;">
			  <div class="wmuSliderWrapper">
				  <article style="position: relative; width: 100%; opacity: 1;"> 
				   	<div class="banner-wrap">
					   	<div class="slider-left">
							<img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/banner1.jpg" alt=""/> 
						</div>
						 <div class="slider-right">
						    <h1>Classic</h1>
						    <h2>White</h2>
						    <p>Lorem ipsum dolor sit amet</p>
						    <div class="btn"><a href="goodclass.php?classid=1">Shop Now</a></div>
						 </div>
						 <div class="clear"></div>
					 </div>
					</article>
				   <article style="position: absolute; width: 100%; opacity: 0;"> 
				   	 <div class="banner-wrap">
					   	<div class="slider-left">
							<img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/banner2.jpg" alt=""/> 
						</div>
						 <div class="slider-right">
						    <h1>Classic</h1>
						    <h2>White</h2>
						    <p>Lorem ipsum dolor sit amet</p>
						    <div class="btn"><a href="goodclass.php?classid=1">Shop Now</a></div>
						 </div>
						 <div class="clear"></div>
					 </div>
				   </article>
				   <article style="position: absolute; width: 100%; opacity: 0;">
				   	<div class="banner-wrap">
					   	<div class="slider-left">
							<img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/banner1.jpg" alt=""/> 
						</div>
						 <div class="slider-right">
						    <h1>Classic</h1>
						    <h2>White</h2>
						    <p>Lorem ipsum dolor sit amet</p>
						    <div class="btn"><a href="goodclass.php?classid=1">Shop Now</a></div>
						 </div>
						 <div class="clear"></div>
					 </div>
				   </article>
				   <article style="position: absolute; width: 100%; opacity: 0;">
				   	<div class="banner-wrap">
					   	<div class="slider-left">
							<img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/banner2.jpg" alt=""/> 
						</div>
						 <div class="slider-right">
						    <h1>Classic</h1>
						    <h2>White</h2>
						    <p>Lorem ipsum dolor sit amet</p>
						    <div class="btn"><a href="goodclass.php?classid=1">Shop Now</a></div>
						 </div>
						 <div class="clear"></div>
					 </div>
				   </article>
				   <article style="position: absolute; width: 100%; opacity: 0;"> 
				   	 <div class="banner-wrap">
					   	<div class="slider-left">
							<img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/banner1.jpg" alt=""/> 
						</div>
						 <div class="slider-right">
						    <h1>Classic</h1>
						    <h2>White</h2>
						    <p>Lorem ipsum dolor sit amet</p>
						    <div class="btn"><a href="goodclass.php?classid=1">Shop Now</a></div>
						 </div>
						 <div class="clear"></div>
					 </div>
			      </article>
				</div>
                <a class="wmuSliderPrev">Previous</a><a class="wmuSliderNext">Next</a>
                <ul class="wmuSliderPagination">
                	<li><a href="#" class="">0</a></li>
                	<li><a href="#" class="">1</a></li>
                	<li><a href="#" class="wmuActive">2</a></li>
                	<li><a href="#">3</a></li>
                	<li><a href="#">4</a></li>
                  </ul>
                 <a class="wmuSliderPrev">Previous</a><a class="wmuSliderNext">Next</a><ul class="wmuSliderPagination"><li><a href="#" class="wmuActive">0</a></li><li><a href="#" class="">1</a></li><li><a href="#" class="">2</a></li><li><a href="#" class="">3</a></li><li><a href="#" class="">4</a></li></ul></div>
            	 <script src="<?php echo ROOTWWW; ?>view/templates/sport_white/js/jquery.wmuSlider.js"></script> 
				 <!-- <script type="text/javascript" src="<?php echo ROOTWWW; ?>view/templates/sport_white/js/modernizr.custom.min.js"></script> --> 
						<script>
       						 $('.example1').wmuSlider();         
   						</script> 	           	      
             </div>
             <div class="main">
                <div class="wrap">
             	  <div class="content-top">
             		<div class="lsidebar span_1_of_c1">
					  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing</p>
					</div>
					<div class="cont span_2_of_c1">
					  <div class="social">	
					     <ul>	
						  <li class="facebook"><a href="#"><span> </span></a><div class="radius"> <img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/radius.png"><a href="#"> </a></div><div class="border hide"><p class="num">1.51K</p></div></li>
						 </ul>
			   		   </div>
					   <div class="social">	
						   <ul>	
							  <li class="twitter"><a href="#"><span> </span></a><div class="radius"> <img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/radius.png"></div><div class="border hide"><p class="num">1.51K</p></div></li>
						  </ul>
			     		</div>
						 <div class="social">	
						   <ul>	
							  <li class="google"><a href="#"><span> </span></a><div class="radius"> <img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/radius.png"></div><div class="border hide"><p class="num">1.51K</p></div></li>
						   </ul>
			    		 </div>
						 <div class="social">	
						   <ul>	
							  <li class="dot"><a href="#"><span> </span></a><div class="radius"> <img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/radius.png"></div><div class="border hide"><p class="num">1.51K</p></div></li>
						  </ul>
			     		</div>
						<div class="clear"> </div>
					  </div>
					  <div class="clear"></div>			
				   </div>
				  <div class="content-bottom">
				   <div class="box1">
					<?php for ($i=0; $i<3; $i++) { ?>
				    <div class="col_1_of_3 span_1_of_3"><a href="gooddetail.php?id=<?php echo $rsarray_good_good_oneclass[$i]['good_good_id']; ?>">
				     <div class="view view-fifth">
				  	  <div class="top_box">
					  	<h3 class="m_1"><?php echo mb_substr($rsarray_good_good_all[$i]['good_good_name'], 0, 15, 'UTF-8'); ?></h3>
					  	<p class="m_2">Lorem ipsum</p>
				         <div class="grid_img">
						   <div class="css3"><img src="./<?php echo $rsarray_good_good_all[$i]['good_good_thumbimage']; ?>" alt=""/></div>
					          <div class="mask">
	                       		<div class="info"> 快&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;看 </div>
			                  </div>
	                    </div>
                       <div class="price">￥<?php echo $rsarray_good_good_all[$i]['good_good_shopprice']; ?></div>
					   </div>
					    </div>
					   <span class="rating">
				        <input type="radio" class="rating-input" id="rating-input-1-5" name="rating-input-1">
				        <label for="rating-input-1-5" class="rating-star1"></label>
				        <input type="radio" class="rating-input" id="rating-input-1-4" name="rating-input-1">
				        <label for="rating-input-1-4" class="rating-star1"></label>
				        <input type="radio" class="rating-input" id="rating-input-1-3" name="rating-input-1">
				        <label for="rating-input-1-3" class="rating-star1"></label>
				        <input type="radio" class="rating-input" id="rating-input-1-2" name="rating-input-1">
				        <label for="rating-input-1-2" class="rating-star"></label>
				        <input type="radio" class="rating-input" id="rating-input-1-1" name="rating-input-1">
				        <label for="rating-input-1-1" class="rating-star"></label>&nbsp;
		        	  (<?php echo $rsarray_good_good_all[$i]['good_good_stocknum']; ?>)
		    	      </span>
						 <ul class="list">
						  <li>
						  	<img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/plus.png" alt=""/>
						  	<ul class="icon1 sub-icon1 profile_img">
							  <li><a class="active-icon c1" href="./checkout.post.php?action=buy&id=<?php echo $rsarray_good_good_all[$i]['good_good_id']; ?>&num=1">Add To Bag </a>
								<ul class="sub-icon1 list">
									<li><h3><?php echo $rsarray_good_good_all[$i]['good_good_brief']; ?></h3><a href=""></a></li>
									<li><p><?php echo $rsarray_good_good_all[$i]['good_good_desc']; ?>  <a href="">adipiscing elit, sed diam</a></p></li>
								</ul>
							  </li>
							 </ul>
						   </li>
					     </ul>
			    	    <div class="clear"></div>
			    	</a></div>
					<?php } ?>
				  <div class="clear"></div>
			  </div>
			  <div class="box1">
				  <?php for ($i=0; $i<3; $i++) { ?>
				    <div class="col_1_of_3 span_1_of_3"><a href="gooddetail.php?id=<?php echo $rsarray_good_good_oneclass[$i]['good_good_id']; ?>">
				     <div class="view view-fifth">
				  	  <div class="top_box">
					  	<h3 class="m_1"><?php echo mb_substr($rsarray_good_good_oneclass[$i]['good_good_name'], 0, 15, 'UTF-8'); ?></h3>
					  	<p class="m_2">Lorem ipsum</p>
				         <div class="grid_img">
						   <div class="css3"><img src="./<?php echo $rsarray_good_good_oneclass[$i]['good_good_thumbimage']; ?>" alt=""/></div>
					          <div class="mask">
	                       		<div class="info"> 快&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;看 </div>
			                  </div>
	                    </div>
                       <div class="price">￥<?php echo $rsarray_good_good_oneclass[$i]['good_good_shopprice']; ?></div>
					   </div>
					    </div>
					   <span class="rating">
				        <input type="radio" class="rating-input" id="rating-input-1-5" name="rating-input-1">
				        <label for="rating-input-1-5" class="rating-star1"></label>
				        <input type="radio" class="rating-input" id="rating-input-1-4" name="rating-input-1">
				        <label for="rating-input-1-4" class="rating-star1"></label>
				        <input type="radio" class="rating-input" id="rating-input-1-3" name="rating-input-1">
				        <label for="rating-input-1-3" class="rating-star1"></label>
				        <input type="radio" class="rating-input" id="rating-input-1-2" name="rating-input-1">
				        <label for="rating-input-1-2" class="rating-star"></label>
				        <input type="radio" class="rating-input" id="rating-input-1-1" name="rating-input-1">
				        <label for="rating-input-1-1" class="rating-star"></label>&nbsp;
		        	  (<?php echo $rsarray_good_good_oneclass[$i]['good_good_stocknum']; ?>)
		    	      </span>
						 <ul class="list">
						  <li>
						  	<img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/plus.png" alt=""/>
						  	<ul class="icon1 sub-icon1 profile_img">
							  <li><a class="active-icon c1" href="./checkout.post.php?action=buy&id=<?php echo $rsarray_good_good_oneclass[$i]['good_good_id']; ?>&num=1">Add To Bag </a>
								<ul class="sub-icon1 list">
									<li><h3><?php echo $rsarray_good_good_oneclass[$i]['good_good_brief']; ?></h3><a href=""></a></li>
									<li><p><?php echo $rsarray_good_good_oneclass[$i]['good_good_desc']; ?>  <a href="">adipiscing elit, sed diam</a></p></li>
								</ul>
							  </li>
							 </ul>
						   </li>
					     </ul>
			    	    <div class="clear"></div>
			    	</a></div>
					<?php } ?>
				  <div class="clear"></div>
			    </div>
			  </div>
			 </div>
        </div>
        
		
		<?php include ROOT .'view/templates/sport_white/include/view.footer.inc.php'; ?>
	
</body>
</html>