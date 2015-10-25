<?php
/**
 * 消息提示页
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

	<title>信息提示</title>

	<!--- CSS --->
	<link rel="stylesheet" href="<?php echo ROOTWWW; ?>view/templates/login_web2/css/style.css" type="text/css" />

	</head>

	<body>
		<div id="container">
			<div class="welcome">
				<div class="welcome-user">信息提示：</div>
				<div class="welcome-text"><?php echo $msg; ?></div>
				<div class="home">
				<?php if ( strpos($msg, '录成功') > 0 ) { ?>
				<a href="./">index</a>
				<?php } else { ?>
				<a href="" onclick="history.back(); return false;">Back</a>
				<?php } ?>
				</div>
			</div>
		</div>
		<div id="footer">
			Web 2.0 Power by <a href="http://www.Cokeshow.com.cn/" target="_blank" title="可乐秀">Cokeshow</a>
		</div>
	</body>
</html>
