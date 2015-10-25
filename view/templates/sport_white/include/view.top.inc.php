  <div class="header-top">
	 <div class="wrap"> 
		<div class="logo">
			<a href="./"><img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/logo.png" alt=""/></a>
	    </div>
	    <div class="cssmenu">
		   <ul>
			 <?php if (!empty($_SESSION['user_user_username'])) { ?>
				 <li>
				 	<?php echo $_SESSION['user_user_username'] ?>，欢迎光临
				 </li>
				 
				 <li><a href="login.php?action=out">退出</a></li>
			 <?php } else { ?>
				 <li class="active"><a href="reg.php" target="_blank">注册</a></li> 
				 <li><a href="login.php">登录</a></li> 
			 <?php } ?>
			 <li><a href="./admin/master_index.php" target="_blank">+参观大后台</a></li> 
			 <li><a href="checkout.php" target="_self">购物车结算</a></li> 
		   </ul>
		</div>
		<ul class="icon2 sub-icon2 profile_img">
			<li><a class="active-icon c2" href="#"> </a>
				<ul class="sub-icon2 list">
					<li><h3>飞船乘客请注意：</h3><a href=""></a></li>
					<li><p>
					<?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'irefox') > 0) { ?>
					Lorem ipsum dolor sit amet, consectetuer  <a href="">adipiscing elit, sed diam</a>
					<?php } else { ?>
					<font color=red>本飞船仅全面支持HTML5的火狐浏览器 <a href="http://www.Cokeshow.com.cn/" target="_blank" title="可乐秀">Cokeshow</a></font>
					<?php } ?>
					</p></li>
				</ul>
			</li>
		</ul>
		<div class="clear"></div>
 	</div>
   </div>
   <div class="header-bottom">
   	<div class="wrap">
   		<!-- start header menu -->
		<ul class="megamenu skyblue">
		    <li><a class="color1" href="./">Home</a></li>
			<li class="grid"><a class="color2" href="goodclass.php?classid=1">Men</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>popular</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">new arrivals</a></li>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">login</a></li>
								</ul>	
							</div>
							<div class="h_nav">
								<h4 class="top">men</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">new arrivals</a></li>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>style zone</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">brands</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/nav_img.jpg" alt=""/>
					</div>
				</div>
				</li>
  			   <li class="active grid"><a class="color4" href="goodclass.php?classid=1">Women</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>shop</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">new arrivals</a></li>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">brands</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>help</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">trends</a></li>
									<li><a href="goodclass.php?classid=1">sale</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>my company</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">trends</a></li>
									<li><a href="goodclass.php?classid=1">sale</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>												
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>account</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">login</a></li>
									<li><a href="goodclass.php?classid=1">create an account</a></li>
									<li><a href="goodclass.php?classid=1">create wishlist</a></li>
									<li><a href="goodclass.php?classid=1">my shopping bag</a></li>
									<li><a href="goodclass.php?classid=1">brands</a></li>
									<li><a href="goodclass.php?classid=1">create wishlist</a></li>
								</ul>	
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>popular</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">new arrivals</a></li>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>
						</div>
						<div class="col1">
						 <div class="h_nav">
						   <img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/nav_img1.jpg" alt=""/>
						 </div>
						</div>
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
					</div>
    			</li>				
				<li><a class="color5" href="goodclass.php?classid=1">Kids</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>popular</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">new arrivals</a></li>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">login</a></li>
								</ul>	
							</div>
							<div class="h_nav">
								<h4 class="top">man</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">new arrivals</a></li>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>style zone</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">brands</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<img src="<?php echo ROOTWWW; ?>view/templates/sport_white/images/nav_img2.jpg" alt=""/>
					</div>
				</div>
				</li>
				<li><a class="color6" href="goodclass.php?classid=1">Sale</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>shop</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">new arrivals</a></li>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">brands</a></li>
								</ul>	
							</div>	
							<div class="h_nav">
								<h4 class="top">my company</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">trends</a></li>
									<li><a href="goodclass.php?classid=1">sale</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>												
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>man</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">new arrivals</a></li>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>help</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">trends</a></li>
									<li><a href="goodclass.php?classid=1">sale</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>account</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">login</a></li>
									<li><a href="goodclass.php?classid=1">create an account</a></li>
									<li><a href="goodclass.php?classid=1">create wishlist</a></li>
									<li><a href="goodclass.php?classid=1">my shopping bag</a></li>
									<li><a href="goodclass.php?classid=1">brands</a></li>
									<li><a href="goodclass.php?classid=1">create wishlist</a></li>
								</ul>	
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>my company</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">trends</a></li>
									<li><a href="goodclass.php?classid=1">sale</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>popular</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">new arrivals</a></li>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
				</div>
				</li>
				<li><a class="color7" href="goodclass.php?classid=1">Customize</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>shop</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">new arrivals</a></li>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">brands</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>help</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">trends</a></li>
									<li><a href="goodclass.php?classid=1">sale</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>my company</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">trends</a></li>
									<li><a href="goodclass.php?classid=1">sale</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>												
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>account</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">login</a></li>
									<li><a href="goodclass.php?classid=1">create an account</a></li>
									<li><a href="goodclass.php?classid=1">create wishlist</a></li>
									<li><a href="goodclass.php?classid=1">my shopping bag</a></li>
									<li><a href="goodclass.php?classid=1">brands</a></li>
									<li><a href="goodclass.php?classid=1">create wishlist</a></li>
								</ul>	
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>my company</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">trends</a></li>
									<li><a href="goodclass.php?classid=1">sale</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>popular</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">new arrivals</a></li>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
    				</div>
				</li>
				<li><a class="color8" href="goodclass.php?classid=1">Shop</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>style zone</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">brands</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>popular</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">new arrivals</a></li>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">login</a></li>
								</ul>	
							</div>
							<div class="h_nav">
								<h4 class="top">man</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">new arrivals</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
				</div>
				</li>
				<li><a class="color9" href="goodclass.php?classid=1">Football</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>shop</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">new arrivals</a></li>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">brands</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>help</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">trends</a></li>
									<li><a href="goodclass.php?classid=1">sale</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>my company</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">trends</a></li>
									<li><a href="goodclass.php?classid=1">sale</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>												
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>account</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">login</a></li>
									<li><a href="goodclass.php?classid=1">create an account</a></li>
									<li><a href="goodclass.php?classid=1">create wishlist</a></li>
									<li><a href="goodclass.php?classid=1">my shopping bag</a></li>
									<li><a href="goodclass.php?classid=1">brands</a></li>
									<li><a href="goodclass.php?classid=1">create wishlist</a></li>
								</ul>	
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>my company</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">trends</a></li>
									<li><a href="goodclass.php?classid=1">sale</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>popular</h4>
								<ul>
									<li><a href="goodclass.php?classid=1">new arrivals</a></li>
									<li><a href="goodclass.php?classid=1">men</a></li>
									<li><a href="goodclass.php?classid=1">women</a></li>
									<li><a href="goodclass.php?classid=1">accessories</a></li>
									<li><a href="goodclass.php?classid=1">kids</a></li>
									<li><a href="goodclass.php?classid=1">style videos</a></li>
								</ul>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
    				</div>
				</li>
				<li><a class="color10" href="goodclass.php?classid=1">Running</a></li>
				<li><a class="color11" href="goodclass.php?classid=1">Originals</a></li>
				<li><a class="color12" href="goodclass.php?classid=1">Basketball</a></li>
		   </ul>
		   <div class="clear"></div>
     	</div>
       </div>