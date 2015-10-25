<?php
/**
 * 商品栏目 修改表单
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
		修改记录
	  </caption>
	  <tr>
		<th colspan="2" scope="col">E</th>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">栏目名称：</div></td>
		<td width="76%" align="left">
			<input type="text" name="good_class_name" id="good_class_name" value="<?php echo $rsarray_good_class_one['good_class_name']; ?>" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">上级栏目：</div></td>
		<td width="76%" align="left">
			<select name="good_class_parentid_FK_good_class_id" id="good_class_parentid_FK_good_class_id" size="1">
				<option value="">顶级栏目</option>
				
				<?php foreach ($rsarray_parentid_list as $v) { ?>
				<option value="<?php echo $v['good_class_id']; ?>" <?php echo ($v['good_class_id'] == $rsarray_good_class_one['good_class_parentid_FK_good_class_id'])?' selected=selected':''; ?>><?php echo str_repeat('……',$v['lev']+1); ?><?php echo $v['good_class_name']; ?></option>
				<?php } ?>
				
			</select>
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">栏目简介：</div></td>
		<td width="76%" align="left">
			<textarea name="good_class_readme" id="good_class_readme" cols="45" rows="5"><?php echo $rsarray_good_class_one['good_class_readme']; ?></textarea>
		</td>
	  </tr>
		
	  <tr>
		<td colspan="2">
	   	<div align="center">
	   	  <input type="button" name="modifybtn" id="modifybtn" value="修改记录" style="padding:10px 20px;" />
		  
		  <input type="hidden" name="id" id="id" value="<?php echo $rsarray_good_class_one['good_class_id']; ?>" />
   		</div></td>
	  </tr>
	</table>
	
	<!--公共修改函数-->
	<script type="text/javascript">
	<?php 
	// 定义数据（字段）：
	$array_parameters = array('id'
			,'good_class_name'
			,'good_class_parentid_FK_good_class_id'
			,'good_class_readme'
	);
	$string_url = "master_good_class.post.php?action=save_edit";
	?>
		$(document).ready(function(){
			$("#modifybtn").click(function(){
				if ($("#good_class_name").val()=="" ){
					alert(""+"栏目名称不能为空！"+"");
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
				$("#modifybtn").toggle();	//提交时，隐藏提交按钮；
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