<?php
/**
 * 注册表单
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
	<title>欢迎新用户注册</title>
	<meta name="Keywords" content="注册" />
	<meta name="Description" content="欢迎新用户注册" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="googlebot" content="noindex, nofollow" />
	<script src="./view/public/js/jquery.min.js" type="text/javascript"></script>
	<script src="./view/public/js/thickbox.js" type="text/javascript"></script>
	<link href="./view/public/js/thickbox.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="./view/public/css/main.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	
	<form action="reg.post.php?action=save_add" method="post">
	<table width="100%" border="0" cellspacing="2" cellpadding="0" summary="添加记录." id="table2">
	  <caption>
		注册新用户
	  </caption>
	  <tr>
		<th colspan="2" scope="col">+</th>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">用户名：</div></td>
		<td width="76%" align="left">
			<input type="text" name="user_user_username" id="user_user_username" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">email：</div></td>
		<td width="76%" align="left">
			<input type="text" name="user_user_email" id="user_user_email" />
		</td>
	  </tr>
	  
	  
	  <tr>
		<td width="24%"><div align="right">密码：</div></td>
		<td width="76%" align="left">
			<input type="password" name="user_user_password" id="user_user_password" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">密码强度：</div></td>
		<td width="76%" align="left">
			
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">确认密码：</div></td>
		<td width="76%" align="left">
			<input type="password" name="cpassword" id="cpassword" />
		</td>
	  </tr>
	  
	  
	  <tr>
		<td width="24%"><div align="right"></div></td>
		<td width="76%" align="left">
			<input type="checkbox" name="agree" id="agree" value="agree" />
			&nbsp;我已看过并接受《<a>用户协议</a>》
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">验证码：</div></td>
		<td width="76%" align="left">
			<input type="text" name="code" id="code" value="" />
			&nbsp;
			<img alt="点击更换验证码" src="code.php" onclick="this.src='code.php?code=' + Math.random()" />
		</td>
	  </tr>
	  
	  <tr>
		<td colspan="2">
	   	<div align="center">
	   	  
	   	  <input type="submit" name="button" id="addbtn" value=" 注册 " style="padding:10px 20px;" />
				<input type="submit" value=" Form 提交注册 " />
   		</div></td>
	  </tr>
	</table>
	</form>
	
	<!--公共新增函数-->
	<script type="text/javascript">
	<?php 
	// 定义数据（字段）：[checkbox、radio要加上:ckra]
	$array_parameters = array('user_user_username'
			,'user_user_password','cpassword','code'
			,'user_user_email'
	);
	$string_url = "reg.post.php?action=save_add";
	?>
	$(document).ready(function(){
		$("#addbtn").click(function(){
			if ($("#good_good_name").val()=="" ){
				alert(""+"商品名称不能为空！"+"");
				return;
			}
			// escape用在gb2312
			<?php // 循环 begin
			foreach ($array_parameters as $v) {
			// 不能直接实用 $v 了： 用 $str_inputname 代替！
			$str_inputname = (strpos($v,':ckra') > 0) ? strstr($v,':ckra',true) : $v;
			?>
			
			var <?php echo $str_inputname; ?> = <?php 
				if (strpos($v,':ckra') > 0) {
					echo "$(\"input[name='$str_inputname']:checked\").val();\r";
				} else {
					echo "$(\"#$str_inputname\").val();\r";
				}
				?>
				
			<?php }// 循环 end ?>
			//$("#button1").hide();
			$("#addbtn").toggle();		//提交时，隐藏提交按钮；
			$.ajax({url:"<?php echo $string_url ?>",type:"POST",data:""
				+ "Chris="	//操作.
				<?php // 循环 begin
				foreach ($array_parameters as $v) {
				$str_inputname = (strpos($v,':ckra') > 0) ? strstr($v,':ckra',true) : $v;
				?>
				
				+ "&<?php echo $str_inputname; ?>=" + <?php echo $str_inputname; ?>
				
				<?php }// 循环 end ?>
				+ "",success: function(msg){
				if (msg=="success"){
				//$("#aaa").text("数据处理中。。。");
					alert("" + "添加提交成功" + "");
					//$("#addbtn").toggle();	//提交成功时，再显示提交按钮；
					parent.tb_remove();			//thickbox关闭窗口
					parent.window.location.reload();	//刷新页面 
				}else{
					alert( "报警：" + msg + "" );
				  	//document.write(msg)
					$("#addbtn").toggle();
					//parent.tb_remove();			//thickbox关闭窗口
				}},error: function(){alert( "" + "页面错误" + "" );}});
		});
	 });
	</script>
	
</body>
</html>