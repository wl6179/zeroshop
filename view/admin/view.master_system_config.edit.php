<?php
/**
 * 系统设置 修改表单
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
	<title>修改记录</title>
	<meta name="Keywords" content="修改记录" />
	<meta name="Description" content="修改记录" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="googlebot" content="noindex, nofollow" />
	<script src="../view/public/js/jquery.min.js" type="text/javascript"></script>
	<script src="../view/public/js/thickbox.js" type="text/javascript"></script>
	<link href="../view/public/js/thickbox.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="../view/public/css/main.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	
	
	<table width="100%" border="0" cellspacing="2" cellpadding="0" summary="修改记录." id="table2">
	  <caption>
		网站配置信息
	  </caption>
	  <tr>
		<th colspan="2" scope="col">E</th>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">网站名称：</div></td>
		<td width="76%" align="left">
			<input type="text" name="system_configSiteName" id="system_configSiteName" value="爱在婚礼网" size="20" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">网站标题：</div></td>
		<td width="76%" align="left">
			<input type="text" name="system_configSiteTitle" id="system_configSiteTitle" value="爱在婚礼网-这里是王亮与董新秀的婚礼现场-邀请你到场" size="50" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">网站关键词：</div></td>
		<td width="76%" align="left">
			<input type="text" name="system_configSiteKeywords" id="system_configSiteKeywords" value="婚礼,视频,照片,结婚,朋友,结婚,北京,感谢,1080P" size="50" />
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">网站描述：</div></td>
		<td width="76%" align="left">
			<textarea name="system_configSiteDiscription" id="system_configSiteDiscription" cols="50" rows="5" style="font-size:1.1em;">今天，我们在这里结婚了。感谢许多好朋友为我们婚礼添加了色彩,正因有了你们,婚礼才能如此美丽.</textarea>
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">网站域名：</div></td>
		<td width="76%" align="left">
			<input type="text" name="system_configSiteDomain" id="system_configSiteDomain" value="www.marryup-wang-dong.com" size="50" />
		</td>
	  </tr>
	  
	  <tr>
		<td colspan="2">
	   	<div align="center">
	   	  <input type="button" name="modifybtn" id="modifybtn" value="修改记录" style="padding:10px 20px;" />
		  
		  <input type="hidden" name="id" id="id" value="2" />
   		</div></td>
	  </tr>
	</table>
	
	<!--公共修改函数-->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#modifybtn").click(function(){
				if ($("#system_configSiteName").val()=="" ){
					alert(""+"组名不能为空！"+"");
					return;
				}
				var id					= escape($("#id").val());
				var system_configSiteName			= escape($("#system_configSiteName").val());
				var system_configSiteTitle			= escape($("#system_configSiteTitle").val());
				var system_configSiteKeywords		= escape($("#system_configSiteKeywords").val());
				var system_configSiteDiscription	= escape($("#system_configSiteDiscription").val());
				var system_configSiteDomain			= escape($("#system_configSiteDomain").val());
				//$("#button1").hide();
				$("#modifybtn").toggle();	//提交时，隐藏提交按钮；
				$.ajax({url:"master_system_config.post.php?Action=SaveModify",type:"POST",data:""
					+ "Chris="	//操作.
					+ "&id="+ id
					+ "&system_configSiteName="+ system_configSiteName
					+ "&system_configSiteTitle="+ system_configSiteTitle
					+ "&system_configSiteKeywords="+ system_configSiteKeywords
					+ "&system_configSiteDiscription="+ system_configSiteDiscription
					+ "&system_configSiteDomain="+ system_configSiteDomain
					+ "",success: function(msg){
					if (msg=="success"){
						//$("#aaa").text("数据处理中。。。");
						alert("" + "修改成功" + "");
						parent.window.location.reload();	//刷新页面 
						parent.tb_remove();			//thickbox关闭窗口
					}else{
						alert( "报警：" + msg + "" );
						///document.write(msg)
						$("#modifybtn").toggle();
						//parent.tb_remove();			//thickbox关闭窗口
					}},error: function(){alert( "" + "页面错误" + "" );}});
			});
		 });
	</script>
	
	
	
</body>
</html>