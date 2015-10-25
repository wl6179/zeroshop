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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>check</title>

	<!--- CSS --->
	<link rel="stylesheet" href="<?php echo ROOTWWW; ?>view/templates/login_web2/css/style.css" type="text/css" />


	<!--- Javascript libraries (jQuery and Selectivizr) used for the custom checkbox --->

	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="<?php echo ROOTWWW; ?>view/templates/login_web2/js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="<?php echo ROOTWWW; ?>view/templates/login_web2/js/selectivizr.js"></script>
		<noscript><link rel="stylesheet" href="<?php echo ROOTWWW; ?>view/templates/login_web2/css/fallback.css" /></noscript>
	<![endif]-->

	</head>

	<body>
		<div id="container">
			<form action="?action=check" method="post">
				<div class="login">登陆普罗米修斯</div>
				<div class="username-text">Username:</div>
				<div class="password-text">Password:</div>
				<div class="username-field">
					<input type="text" name="username" value="<?php echo empty($_COOKIE['remember_user']) ? 'Prometheus' : $_COOKIE['remember_user']; ?>" />
					<!-- value="<?php echo $_COOKIE['remember_user']; ?>"  -->
				</div>
				<div class="password-field">
					<input type="password" name="password" value="<?php echo empty($_COOKIE['remember_user']) ? 'Prometheus' : 'Prometheus'; ?>" />
				</div>
				<input type="checkbox" name="remember-me" id="remember-me" checked="checked" /><label for="remember-me">Remember me</label>
				<div class="forgot-usr-pwd">&nbsp;&nbsp;&nbsp;Forgot&nbsp;&nbsp;<a href="" onclick="alert('普罗米修斯号即将起飞...请就坐在座位上'); return false;">password</a>?</div>
				<input type="submit" name="submit" value="GO" />
			</form>
		</div>
		<div id="footer">
			请系好安全带，本飞船仅全面支持HTML5的火狐浏览器 <a href="http://www.Cokeshow.com.cn/" target="_blank" title="可乐秀">Cokeshow</a>
		</div>
	</body>
</html>
