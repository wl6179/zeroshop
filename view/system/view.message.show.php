<?php
/**
 * 信息提示页
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
	<title>信息提示</title>
	<meta name="Keywords" content="信息提示" />
	<meta name="Description" content="信息提示" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="googlebot" content="noindex, nofollow" />
	<script src="./view/public/js/jquery.min.js" type="text/javascript"></script>
	<script src="./view/public/js/thickbox.js" type="text/javascript"></script>
	<link href="./view/public/js/thickbox.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="./view/public/css/main.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	
	
	<table width="100%" border="0" cellspacing="2" cellpadding="0" summary="添加记录." id="table2">
	  <caption>
		信息提示
	  </caption>
	  
	  <tr>
		<td colspan="2">
	   	<div align="center" style="color:red;">
				
				<?php echo $msg; ?>
	   	  		
   		</div></td>
	  </tr>
	  
	  <tr>
		<td colspan="2">
	   	<div align="center">
	   	  
	   	  <input type="button" name="button" id="button" value=" 返回 " style="padding:10px 20px;" onclick="history.back()" />
	   	  		
   		</div></td>
	  </tr>
	</table>
	
	<!--公共新增函数-->
	<script type="text/javascript">
	</script>
	
</body>
</html>