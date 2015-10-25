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
		修改记录
	  </caption>
	  <tr>
		<th colspan="2" scope="col">E</th>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">帐号：</div></td>
		<td width="76%" align="left" style="font-size:1.5em; font-weight:bold;">
			admin
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
				
					
					<option value="1" selected>管理员组</option>
					
				
			</select>
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">名字：</div></td>
		<td width="76%" align="left">
			<input type="text" name="user_userName" id="user_userName" value="亮晶晶" />
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">性别：</div></td>
		<td width="76%" align="left">
			<select name="user_userSex" id="user_userSex" size="1">
				<option value="" >选择性别</option>
				<option value="1" selected>男</option>
				<option value="2" >女</option>
			</select>
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">电话：</div></td>
		<td width="76%" align="left">
			<input type="text" name="user_userTel" id="user_userTel" value="" />
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">邮箱：</div></td>
		<td width="76%" align="left">
			<input type="text" name="user_userEmail" id="user_userEmail" value="" />
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">QQ号：</div></td>
		<td width="76%" align="left">
			<input type="text" name="user_userQQ" id="user_userQQ" value="" />
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">备注：</div></td>
		<td width="76%" align="left">
			<textarea name="user_userRemark" id="user_userRemark" cols="45" rows="5"></textarea>
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">创建时间：</div></td>
		<td width="76%" align="left">
			2013/12/27 22:30:00
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">最后登录时间：</div></td>
		<td width="76%" align="left">
			2014/8/22 13:05:00
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">最后登录IP：</div></td>
		<td width="76%" align="left">
			116.243.166.41
		</td>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">密码到期日期：</div></td>
		<td width="76%" align="left">
			2016/9/25 1:17:00
		</td>
	  </tr>
	  <tr>
		<td colspan="2">
	   	<div align="center">
	   	  <input type="button" name="modifybtn" id="modifybtn" value="修改记录" style="padding:10px 20px;" />
		  
		  <input type="hidden" name="id" id="id" value="1" />
   		</div></td>
	  </tr>
	</table>
	
	<!--公共修改函数-->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#modifybtn").click(function(){
				if ($("#user_userUsername").val()=="" ){
					alert(""+"帐号不能为空！"+"");
					return;
				}
				if ($("#user_userName").val()=="" ){
					alert(""+"姓名不能为空！"+"");
					return;
				}
				// escape用在gb2312
				var id					= ($("#id").val());
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
				$("#modifybtn").toggle();	//提交时，隐藏提交按钮；
				$.ajax({url:"master_user_user.post.php?Action=SaveModify",type:"POST",data:""
					+ "Chris="	//操作.
					+ "&id="+ id
					//+ "&user_userUsername="+ user_userUsername
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