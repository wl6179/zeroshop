<?php
/**
 * 商品 添加表单
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
	<!-- <form action="master_good_good.post.php?action=save_add" method="post">
			<input type="checkbox" name="good_good_isbest" id="" value="1" />精品
			&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="good_good_isnew" id="" value="2" />新品
			&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="good_good_ishot" id="" value="3" />热销
			
			<input type="radio" name="good_good_aaa" id="good_good_aaa" value="4" />热销
			
			<input type="submit" value="submit1" />
	</form> -->
	<FORM action="master_good_good.post.php?action=save_add" method="post" enctype="multipart/form-data">
	<table width="100%" border="0" cellspacing="2" cellpadding="0" summary="添加记录." id="table2">
	  <caption>
		添加记录
	  </caption>
	  <tr>
		<th colspan="2" scope="col">+</th>
	  </tr>
	  <tr>
		<td width="24%"><div align="right">商品名称：</div></td>
		<td width="76%" align="left">
			<input type="text" name="good_good_name" id="good_good_name" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">商品货号：</div></td>
		<td width="76%" align="left">
			<input type="text" name="good_good_sn" id="good_good_sn" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">商品分类栏目：</div></td>
		<td width="76%" align="left">
			<select name="good_good_classid_FK_good_class_id" id="good_good_classid_FK_good_class_id" size="1">
				<option value="">顶级栏目</option>
				
				<?php foreach ($rsarray_fk_good_class_id as $v) { ?>
				<option value="<?php echo $v['good_class_id']; ?>"><?php echo str_repeat('……',$v['lev']+1); ?><?php echo $v['good_class_name']; ?></option>
				<?php } ?>
				
			</select>
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">本店售价：</div></td>
		<td width="76%" align="left">
			<input type="text" name="good_good_shopprice" id="good_good_shopprice" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">市场售价：</div></td>
		<td width="76%" align="left">
			<input type="text" name="good_good_marketprice" id="good_good_marketprice" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">上传商品图片：</div></td>
		<td width="76%" align="left">
			<input type="file" name="good_good_originalimage" id="good_good_originalimage" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">商品重量：</div></td>
		<td width="76%" align="left">
			
			<input type="text" name="good_good_weight" id="good_good_weight" />
			
			&nbsp;&nbsp;&nbsp;
			<select name="good_good_weightunit" id="good_good_weightunit" size="1">
				<option value="1000">千克</option>
				<option value="1">克</option>
			</select>
			
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">商品库存：</div></td>
		<td width="76%" align="left">
			<input type="text" name="good_good_stocknum" id="good_good_stocknum" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">加入推荐：</div></td>
		<td width="76%" align="left">
			<input type="checkbox" name="good_good_isbest" id="good_good_isbest" value="1" />精品
			&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="good_good_isnew" id="good_good_isnew" value="1" />新品
			&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="good_good_ishot" id="good_good_ishot" value="1" />热销
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">是否上架：</div></td>
		<td width="76%" align="left">
			<input type="checkbox" name="good_good_isonsale" id="good_good_isonsale" value="1" />
		</td>
	  </tr>
	  
	  
	  <tr>
		<td width="24%"><div align="right">商品简单描述：</div></td>
		<td width="76%" align="left">
			<textarea name="good_good_brief" id="good_good_brief" cols="45" rows="5"></textarea>
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">详细描述：</div></td>
		<td width="76%" align="left">
			<textarea name="good_good_desc" id="good_good_desc" cols="45" rows="5"></textarea>
		</td>
	  </tr>
	  
	  <tr>
		<td colspan="2">
	   	<div align="center">
	   	  <!-- <input type="submit" name="button" id="addbtn" value="新增记录ajax" style="padding:10px 20px;" /> -->
	   	  		
	   	  	<INPUT type="submit" value="新增记录submit" />
   		</div></td>
	  </tr>
	</table>
	</FORM>
	<!--公共新增函数-->
	<script type="text/javascript">
	<?php 
	// 定义数据（字段）：[checkbox、radio要加上:ckra]
	$array_parameters = array('good_good_sn'
			,'good_good_classid_FK_good_class_id'
			,'good_good_brandid_FK_good_brand_id'
			,'good_good_name'
			,'good_good_shopprice'
			,'good_good_marketprice'
			,'good_good_stocknum'
			,'good_good_weight','good_good_weightunit'
			,'good_good_brief'
			,'good_good_desc'
			,'good_good_originalimage'
			,'good_good_isonsale:ckra'
			,'good_good_isbest:ckra'
			,'good_good_isnew:ckra'
			,'good_good_ishot:ckra'
	);
	$string_url = "master_good_good.post.php?action=save_add";
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