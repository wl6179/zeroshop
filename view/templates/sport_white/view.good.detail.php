<?php
/**
 * 商品详情页
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
<title>导航 <?php foreach ($rsarray_parentree as $v_v) { echo ' -> '. $v_v['good_class_name']; } ?> -> <?php echo $rsarray_good_good_one['good_good_name']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo ROOTWWW; ?>view/templates/sport_white/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo ROOTWWW; ?>view/templates/sport_white/css/form.css" rel="stylesheet" type="text/css" media="all" />
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
<script type="text/javascript" src="<?php echo ROOTWWW; ?>view/templates/sport_white/js/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript" id="sourcecode">
			$(function()
			{
				$('.scroll-pane').jScrollPane();
			});
		</script>
<!----details-product-slider--->
				<!-- Include the Etalage files -->
					<link rel="stylesheet" href="<?php echo ROOTWWW; ?>view/templates/sport_white/css/etalage.css">
					<script src="<?php echo ROOTWWW; ?>view/templates/sport_white/js/jquery.etalage.min.js"></script>
				<!-- Include the Etalage files -->
				<script>
						jQuery(document).ready(function($){
			
							$('#etalage').etalage({
								thumb_image_width: 300,
								thumb_image_height: 400,
								
								show_hint: true,
								click_callback: function(image_anchor, instance_id){
									alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
								}
							});
							// This is for the dropdown list example:
							$('.dropdownlist').change(function(){
								etalage_show( $(this).find('option:selected').attr('class') );
							});

					});
				</script>
				<!----//details-product-slider--->	
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
              
       
       <div class="single">
         <div class="wrap">
			<?php include ROOT .'view/templates/sport_white/include/view.left.inc.php'; ?>
   
		
		<div class="cont span_2_of_3">
			  <div class="labout span_1_of_a1">
				<!-- start product_slider -->
				     <ul id="etalage">
							<li>
								<a href="optionallink.html">
									<img class="etalage_thumb_image" src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/t1.jpg" />
									<img class="etalage_source_image" src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/t2.jpg" />
								</a>
							</li>
							<li>
								<img class="etalage_thumb_image" src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/t2.jpg" />
								<img class="etalage_source_image" src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/t2.jpg" />
							</li>
							<li>
								<img class="etalage_thumb_image" src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/t3.jpg" />
								<img class="etalage_source_image" src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/t3.jpg" />
							</li>
							<li>
								<img class="etalage_thumb_image" src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/t4.jpg" />
								<img class="etalage_source_image" src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/t4.jpg" />
							</li>
							<li>
								<img class="etalage_thumb_image" src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/t5.jpg" />
								<img class="etalage_source_image" src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/t5.jpg" />
							</li>
							<li>
								<img class="etalage_thumb_image" src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/t6.jpg" />
								<img class="etalage_source_image" src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/t6.jpg" />
							</li>
							<li>
								<img class="etalage_thumb_image" src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/t1.jpg" />
								<img class="etalage_source_image" src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/t1.jpg" />
							</li>
						</ul>
					
					
			<!-- end product_slider -->
			</div>
			<div class="cont1 span_2_of_a1">
				<h3 class="m_3"><?php echo $rsarray_good_good_one['good_good_name']; ?></h3>
				
				<div class="price_single">
							  <span class="reducedfrom">￥<?php echo $rsarray_good_good_one['good_good_marketprice']; ?></span>
							  <span class="actual">￥<?php echo $rsarray_good_good_one['good_good_shopprice']; ?></span><a href="#">click for offer</a>
							</div>
				<ul class="options">
					<h4 class="m_9">Select a Size</h4>
					<li><a href="#">6</a></li>
					<li><a href="#">7</a></li>
					<li><a href="#">8</a></li>
					<li><a href="#">9</a></li>
					<div class="clear"></div>
				</ul>
				<div class="btn_form">
				   <form action="./checkout.post.php" method="get">
					 <input type="submit" value="buy now" title="">
					 <input type="hidden" name="action" value="buy" />
					 <input type="hidden" name="id" value="<?php echo $rsarray_good_good_one['good_good_id']; ?>" />
					 <input type="hidden" name="num" value="1" />
				  </form>
				</div>
				<ul class="add-to-links">
    			   <li><!-- <img src="<?php echo ROOTWWW; ?>dddd" alt="<?php echo $rsarray_good_good_one['good_good_name']; ?>"/> --><a href="#">Add to wishlist</a></li>
    			</ul>
    			<p class="m_desc"><?php echo $rsarray_good_good_one['good_good_desc']; ?></p>
    			
                <div class="social_single">	
				   <ul>	
					  <li class="fb"><a href="#"><span> </span></a></li>
					  <li class="tw"><a href="#"><span> </span></a></li>
					  <li class="g_plus"><a href="#"><span> </span></a></li>
					  <li class="rss"><a href="#"><span> </span></a></li>		
				   </ul>
			    </div>
			</div>
			<div class="clear"></div>
     
     
         <ul id="flexiselDemo3">
			<li><img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/pic11.jpg" /><div class="grid-flex"><a href="#">Bloch</a><p>Rs 850</p></div></li>
			<li><img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/pic10.jpg" /><div class="grid-flex"><a href="#">Capzio</a><p>Rs 850</p></div></li>
			<li><img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/pic9.jpg" /><div class="grid-flex"><a href="#">Zumba</a><p>Rs 850</p></div></li>
			<li><img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/pic8.jpg" /><div class="grid-flex"><a href="#">Bloch</a><p>Rs 850</p></div></li>
			<li><img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/pic7.jpg" /><div class="grid-flex"><a href="#">Capzio</a><p>Rs 850</p></div></li>
		 </ul>
	    <script type="text/javascript">
		 $(window).load(function() {
			$("#flexiselDemo1").flexisel();
			$("#flexiselDemo2").flexisel({
				enableResponsiveBreakpoints: true,
		    	responsiveBreakpoints: { 
		    		portrait: { 
		    			changePoint:480,
		    			visibleItems: 1
		    		}, 
		    		landscape: { 
		    			changePoint:640,
		    			visibleItems: 2
		    		},
		    		tablet: { 
		    			changePoint:768,
		    			visibleItems: 3
		    		}
		    	}
		    });
		
			$("#flexiselDemo3").flexisel({
				visibleItems: 5,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
		    	responsiveBreakpoints: { 
		    		portrait: { 
		    			changePoint:480,
		    			visibleItems: 1
		    		}, 
		    		landscape: { 
		    			changePoint:640,
		    			visibleItems: 2
		    		},
		    		tablet: { 
		    			changePoint:768,
		    			visibleItems: 3
		    		}
		    	}
		    });
		    
		});
	</script>
	<script type="text/javascript" src="<?php echo ROOTWWW; ?>view/templates/sport_white/js/jquery.flexisel.js"></script>
	 <div class="toogle">
     	<h3 class="m_3">Product Details</h3>
     	<p class="m_text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.</p>
     </div>					
	 <div class="toogle">
     	<h3 class="m_3">Product Reviews</h3>
     	<p class="m_text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.</p>
     </div>
     </div>
     <div class="clear"></div>
	 </div>
     </div>
	  
		
		<?php include ROOT .'view/templates/sport_white/include/view.footer.inc.php'; ?>

</body>
</html>