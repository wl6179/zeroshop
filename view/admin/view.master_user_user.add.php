<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>添加记录</title>
	<meta name="Keywords" content="添加记录" />
	<meta name="Description" content="添加记录" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="googlebot" content="noindex, nofollow" />
	<script src="../view/public/js/jquery.min.js" type="text/javascript"></script>
	<script src="../view/public/js/thickbox.js" type="text/javascript"></script>
	<link href="../view/public/js/thickbox.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="../view/public/css/main.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	
	<table width="100%" border="0" cellspacing="2" cellpadding="0" summary="添加记录." id="table2">
	  <caption>
		添加记录
	  </caption>
	  <tr>
		<th colspan="2" scope="col">+</th>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">帐号：</div></td>
		<td width="76%" align="left">
			<input type="text" name="user_userUsername" id="user_userUsername" />
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">密码：</div></td>
		<td width="76%" align="left">
			<input type="password" name="user_userPassword" id="user_userPassword" />
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">确认密码：</div></td>
		<td width="76%" align="left">
			<input type="password" name="user_userPassword_confirm" id="user_userPassword_confirm" />
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">用户组：</div></td>
		<td width="76%" align="left">
			<select name="user_user_PK_user_groupID" id="user_user_PK_user_groupID" size="1">
				
					
					<option value="1">管理员组</option>
					
				
			</select>
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">名字：</div></td>
		<td width="76%" align="left">
			<input type="text" name="user_userName" id="user_userName" />
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">性别：</div></td>
		<td width="76%" align="left">
			<select name="user_userSex" id="user_userSex" size="1">
				<option value="">选择性别</option>
				<option value="1">男</option>
				<option value="2">女</option>
			</select>
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">电话：</div></td>
		<td width="76%" align="left">
			<input type="text" name="user_userTel" id="user_userTel" />
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">邮箱：</div></td>
		<td width="76%" align="left">
			<input type="text" name="user_userEmail" id="user_userEmail" />
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">QQ号：</div></td>
		<td width="76%" align="left">
			<input type="text" name="user_userQQ" id="user_userQQ" />
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">备注：</div></td>
		<td width="76%" align="left">
			<textarea name="user_userRemark" id="user_userRemark" cols="45" rows="5"></textarea>
		</td>
	  </tr>
	  
	  <tr>
		<td colspan="2">
	   	<div align="center">
	   	  <input type="submit" name="button" id="addbtn" value="新增记录" style="padding:10px 20px;" />
   		</div></td>
	  </tr>
	</table>
	<!--公共新增函数-->
	<script type="text/javascript">
	$(document).ready(function(){
		$("#addbtn").click(function(){
			if ($("#user_userUsername").val()=="" ){
				alert(""+"帐号不能为空！"+"");
				return;
			}
			if ($("#user_userPassword").val()=="" ){
				alert(""+"密码不能为空！"+"");
				return;
			}
			if ($("#user_userName").val()=="" ){
				alert(""+"姓名不能为空！"+"");
				return;
			}
			// escape用在gb2312
			var user_userUsername	= ($("#user_userUsername").val());
			var user_userPassword	= ($("#user_userPassword").val());
			var user_userPassword_confirm	= ($("#user_userPassword_confirm").val());
			var user_user_PK_user_groupID	= ($("#user_user_PK_user_groupID").val());
			var user_userName		= ($("#user_userName").val());
			var user_userSex		= ($("#user_userSex").val());
			var user_userTel		= ($("#user_userTel").val());
			var user_userEmail		= ($("#user_userEmail").val());
			var user_userQQ			= ($("#user_userQQ").val());
			var user_userRemark		= ($("#user_userRemark").val());
			//$("#button1").hide();
			$("#addbtn").toggle();		//提交时，隐藏提交按钮；
			$.ajax({url:"master_user_user.post.php?Action=SaveAdd",type:"POST",data:""
				+ "Chris="	//操作.
				+ "&user_userUsername="+ user_userUsername
				+ "&user_userPassword="+ user_userPassword
				+ "&user_userPassword_confirm="+ user_userPassword_confirm
				+ "&user_user_PK_user_groupID="+ user_user_PK_user_groupID
				+ "&user_userName="+ user_userName
				+ "&user_userSex="+ user_userSex
				+ "&user_userTel="+ user_userTel
				+ "&user_userEmail="+ user_userEmail
				+ "&user_userQQ="+ user_userQQ
				+ "&user_userRemark="+ user_userRemark
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