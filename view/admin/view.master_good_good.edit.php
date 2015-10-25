<?php
/**
 * 商品 修改表单
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
	<FORM action="master_good_good.post.php?action=save_edit" method="post" enctype="multipart/form-data">
	<table width="100%" border="0" cellspacing="2" cellpadding="0" summary="修改记录." id="table2">
	  <caption>
		修改记录
	  </caption>
	  <tr>
		<th colspan="2" scope="col">E</th>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">商品名称：</div></td>
		<td width="76%" align="left">
			<input type="text" name="good_good_name" id="good_good_name" value="<?php echo $rsarray_good_good_one['good_good_name']; ?>" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">商品货号：</div></td>
		<td width="76%" align="left">
			<input type="text" name="good_good_sn" id="good_good_sn" value="<?php echo $rsarray_good_good_one['good_good_sn']; ?>" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">商品分类栏目：</div></td>
		<td width="76%" align="left">
			<select name="good_good_classid_FK_good_class_id" id="good_good_classid_FK_good_class_id" size="1">
				<option value="">顶级栏目</option>
				
				<?php foreach ($rsarray_fk_good_class_id as $v) { ?>
				<option value="<?php echo $v['good_class_id']; ?>" <?php if ($v['good_class_id'] == $rsarray_good_good_one['good_good_classid_FK_good_class_id']) { echo ' selected="selected"'; } ?>><?php echo str_repeat('……',$v['lev']+1); ?><?php echo $v['good_class_name']; ?></option>
				<?php } ?>
				
			</select>
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">本店售价：</div></td>
		<td width="76%" align="left">
			<input type="text" name="good_good_shopprice" id="good_good_shopprice" value="<?php echo $rsarray_good_good_one['good_good_shopprice']; ?>" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">市场售价：</div></td>
		<td width="76%" align="left">
			<input type="text" name="good_good_marketprice" id="good_good_marketprice" value="<?php echo $rsarray_good_good_one['good_good_marketprice']; ?>" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">上传商品图片：</div></td>
		<td width="76%" align="left">
			<?php if (!empty($rsarray_good_good_one['good_good_originalimage'])) { ?>
			<img src="../<?php echo $rsarray_good_good_one['good_good_originalimage']; ?>" width="100" height="100" />
			<?php } ?>
			<input type="file" name="good_good_originalimage" id="good_good_originalimage" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">商品重量：</div></td>
		<td width="76%" align="left">
			
			<input type="text" name="good_good_weight" id="good_good_weight" value="<?php echo $rsarray_good_good_one['good_good_weight']; ?>" />
			
			&nbsp;&nbsp;&nbsp;
			<select name="good_good_weightunit" id="good_good_weightunit" size="1">
				<option value="1000">千克</option>
				<option value="1" selected="selected">克</option>
			</select>
			
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">商品库存：</div></td>
		<td width="76%" align="left">
			<input type="text" name="good_good_stocknum" id="good_good_stocknum" value="<?php echo $rsarray_good_good_one['good_good_stocknum']; ?>" />
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">加入推荐：</div></td>
		<td width="76%" align="left">
			<input type="checkbox" name="good_good_isbest" id="good_good_isbest" value="1" <?php if (empty($rsarray_good_good_one['good_good_isbest']) ? false : $rsarray_good_good_one['good_good_isbest']=1) { echo ' checked="checked"'; } ?> />精品
			&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="good_good_isnew" id="good_good_isnew" value="1" <?php if (empty($rsarray_good_good_one['good_good_isnew']) ? false : $rsarray_good_good_one['good_good_isnew']=1) { echo ' checked="checked"'; } ?> />新品
			&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="good_good_ishot" id="good_good_ishot" value="1" <?php if (empty($rsarray_good_good_one['good_good_ishot']) ? false : $rsarray_good_good_one['good_good_ishot']=1) { echo ' checked="checked"'; } ?> />热销
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">是否上架：</div></td>
		<td width="76%" align="left">
			<input type="checkbox" name="good_good_isonsale" id="good_good_isonsale" value="1" <?php if (empty($rsarray_good_good_one['good_good_isonsale']) ? false : $rsarray_good_good_one['good_good_isonsale']=1) { echo ' checked="checked"'; } ?> />
		</td>
	  </tr>
	  
	  
	  <tr>
		<td width="24%"><div align="right">商品简单描述：</div></td>
		<td width="76%" align="left">
			<textarea name="good_good_brief" id="good_good_brief" cols="45" rows="5"><?php echo $rsarray_good_good_one['good_good_brief']; ?></textarea>
		</td>
	  </tr>
	  
	  <tr>
		<td width="24%"><div align="right">详细描述：</div></td>
		<td width="76%" align="left">
			<textarea name="good_good_desc" id="good_good_desc" cols="45" rows="5"><?php echo $rsarray_good_good_one['good_good_desc']; ?></textarea>
		</td>
	  </tr>
		
	  <tr>
		<td colspan="2">
	   	<div align="center">
	   	  <input type="button" name="modifybtn" id="modifybtn" value="修改记录" style="padding:10px 20px;" />
		  		
		  		<INPUT type="submit" value="修改记录submit" />
		  		
		  <input type="hidden" name="id" id="id" value="<?php echo $rsarray_good_good_one['good_good_id']; ?>" />
   		</div></td>
	  </tr>
	</table>
	</FORM>
	<!--公共修改函数-->
	<script type="text/javascript">
	<?php 
	// 定义数据（字段）：
	$array_parameters = array('id'
			,'good_good_sn'
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
	$string_url = "master_good_good.post.php?action=save_edit";
	?>
		$(document).ready(function(){
			$("#modifybtn").click(function(){
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