<?php
/**
 * 后台HTML框架 左栏
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
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左列表</title>
	<meta name="Keywords" content="左列表" />
	<meta name="Description" content="左列表" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="googlebot" content="noindex, nofollow" />
	<script src="../view/public/js/jquery.min.js" type="text/javascript"></script>
	<script src="../view/public/js/thickbox.js" type="text/javascript"></script>
	<link href="../view/public/js/thickbox.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="../view/public/css/main.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body style="background:#f8f8f8;">
	
	<br />
	<strong>商品管理</strong>：
	<hr style="color:#FFFFFF;" />
	<a href="master_good_good.list.php" target="main">商品列表</a>
	<br /><br />
	
	<a href="master_good_class.list.php" target="main">商品栏目列表</a>
	<br /><br />
	
	
	
	
	
	<br />
	<strong>会员管理</strong>：
	<hr style="color:#FFFFFF;" />
	<a href="master_user_user.list.php" target="main">会员列表</a>
	<br /><br />
	
	<a href="master_user_user.add.php" target="main">会员添加</a>
	<br /><br />
	
	
	
	<br />
	<strong>站点管理</strong>：
	<hr style="color:#FFFFFF;" />
	<a href="master_system_config.edit.php" target="main">网站信息管理</a>
	<br /><br />
	
	<a href="master_user_user.edit.php" target="main">个人信息管理</a>
	<br /><br />
	
	
	
	<br />
	<strong>其它操作</strong>：
	<hr style="color:#FFFFFF;" />
	<a href="master_login.post.php?Action=Logout" onClick="return confirm('确定推出吗？！');">退出登录</a>
	<br /><br />
	
</body>
</html>