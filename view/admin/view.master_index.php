<?php
/**
 * 后台HTML框架 总框架frame
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
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>大后台</title>
	<meta name="Keywords" content="大后台" />
	<meta name="Description" content="大后台" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="googlebot" content="noindex, nofollow" />
	<script src="../view/public/js/jquery.min.js" type="text/javascript"></script>
	<script src="../view/public/js/thickbox.js" type="text/javascript"></script>
	<link href="../view/public/js/thickbox.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="../view/public/css/main.css" rel="stylesheet" type="text/css" media="screen" />
	<style type="text/css">
	<!--
	body {
		margin-left: 0px;
		margin-top: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
		overflow:hidden;
	}
	-->
	</style>
	<SCRIPT>
		var status = 1;
		function switchSysBar(){
			 if (1 == window.status){
				  window.status = 0;
				  switchPoint.innerHTML = '<img src="../view/public/images/left.gif">';
				  document.all("frmTitle").style.display="none"
			 }
			 else{
				  window.status = 1;
				  switchPoint.innerHTML = '<img src="../view/public/images/right.gif">';
				  document.all("frmTitle").style.display=""
			 }
		}
	</SCRIPT>
</head>
<body onUnload="javascript:if(self.screenTop>9000) window.location.href='session.shtml';" style="padding:0;">
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="4" height="50"><iframe name="top" style="background: #330D0C;" height="70" width="100%" border="0" frameborder="0" src="master_index_top.php" scrolling="no"></iframe></td>
		</tr>
		<tr>
			<td width="181" id="frmTitle">
				<iframe name="left" style="background:#f8f8f8;" height="100%" width="180" border="0" frameborder="0" src="master_index_left.php"></iframe>
			</td>
			<!--分界线 begin-->
			<td width="20" valign="middle" style="width:18px;background:#F2F9E8;;">
				<div onClick="switchSysBar()">
					<span id="switchPoint" title="关闭/打开左栏" style="cursor:hand;"><img src="../view/public/images/right.gif" alt="" /></span>
				</div>
			</td>
			<!--分界线 end-->
			<td>
				<iframe name="main" height="100%" width="100%" border="0" frameborder="0" src="master_index_right.php"></iframe>
			</td>
			<td style="width:3px;">&nbsp;</td>
		</tr>
	</table>
</body>
</html>