<?php
/**
 * 商品列表页
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
<title>面包屑导航<?php foreach ($rsarray_parentree as $v_v) { echo ' -> '. $v_v['good_class_name']; } ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo ROOTWWW; ?>view/templates/sport_white/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo ROOTWWW; ?>view/templates/sport_white/css/form.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo ROOTWWW; ?>view/templates/sport_white/js/jquery.min.js"></script>
<script src="<?php echo ROOTWWW; ?>view/templates/sport_white/js/jquery.easydropdown.js"></script>
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
       
       <div class="login">
         <div class="wrap">
			<?php include ROOT .'view/templates/sport_white/include/view.left.inc.php'; ?>
   
		<div class="cont span_2_of_3">
		  <div class="mens-toolbar">
              <div class="sort">
               	<div class="sort-by">
		            <label>Sort By</label>
		            <select>
		                            <option value="">
		                    Popularity               </option>
		                            <option value="">
		                    Price : High to Low               </option>
		                            <option value="">
		                    Price : Low to High               </option>
		            </select>
		            <a href=""><img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/arrow2.gif" alt="" class="v-middle"></a>
               </div>
    		</div>
	          <div class="pager">   
	           <div class="limiter visible-desktop">
	            <label>Show</label>
	            	<?php echo $precode .' '. $pagecode .' '. $nextcode; ?>
	            	
	                <?php echo $selectedcode; ?> per page        
	             </div>
	       		
		   		<div class="clear"></div>
	    	</div>
     	    <div class="clear"></div>
	       </div>
			    
			    <!-- 固有开始 -->
			    <div class="box1">
				   
				   
				   <?php $i = 0; ?>
				   <?php foreach ($rsarray_good_good_forclass as $v) { ?>
				   <?php $i += 1; ?>
				   <!-- for -->
				   <div class="col_1_of_single1 span_1_of_single1"><a href="gooddetail.php?id=<?php echo $v['good_good_id']; ?>">
				     <div class="view1 view-fifth1">
				  	  <div class="top_box">
					  	<h3 class="m_1"><?php echo $v['good_good_name']; ?></h3>
					  	<p class="m_2">Lorem ipsum</p>
				         <div class="grid_img">
						   <div class="css3"><img src="<?php echo ROOTWWW; ?><?php echo $v['good_good_thumbimage']; ?>" alt=""/></div>
					          <div class="mask1">
	                       		<div class="info">Quick View</div>
			                  </div>
	                    </div>
                       <div class="price">￥<?php echo $v['good_good_shopprice']; ?></div>
					   </div>
					    </div>
					   <span class="rating1">
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
		        	  (<?php echo $v['good_good_stocknum']; ?>)
		    	      </span>
						 <ul class="list2">
						  <li>
						  	<img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/plus.png" alt=""/>
						  	<ul class="icon1 sub-icon1 profile_img">
							  <li><a class="active-icon c1" href="./checkout.post.php?action=buy&id=<?php echo $v['good_good_id']; ?>&num=1">Add To Bag </a>
								<ul class="sub-icon1 list">
									<li><h3><?php echo $v['good_good_brief']; ?></h3><a href=""></a></li>
									<li><p><?php echo $v['good_good_desc']; ?>  <a href="">adipiscing elit, sed diam</a></p></li>
								</ul>
							  </li>
							 </ul>
						   </li>
					     </ul>
			    	    <div class="clear"></div>
			    	</a></div>
			    	
			    	<?php
			    		// 取 3 的模
			    		if (($i % 3) == 0) {?>
			  <!-- 取模时输出 --> 
				  <div class="clear"></div>
			  </div>
			  <div class="box1">
			  <!-- 取模时输出 --> 
			    	<?php }//if
			    	?>
			    	
				   <!-- for -->
				   <?php }//for ?>
			    	
				
				<!-- 固有结尾 -->    
				  <div class="clear"></div>
			  </div>
			  
			 
             
			  </div>
			  <div class="clear"></div>
			</div>
		   </div>
	     
		
		<?php include ROOT .'view/templates/sport_white/include/view.footer.inc.php'; ?>

</body>
</html>