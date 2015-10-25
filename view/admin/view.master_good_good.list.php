<?php
/**
 * 商品 列表
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
	<title><?php echo $conf->managepage_name ?>管理</title>
	<meta name="Keywords" content="<?php echo $conf->managepage_name ?>管理" />
	<meta name="Description" content="<?php echo $conf->managepage_name ?>管理" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="googlebot" content="noindex, nofollow" />
	<script src="../view/public/js/jquery.min.js" type="text/javascript"></script>
	<script src="../view/public/js/thickbox.js" type="text/javascript"></script>
	<link href="../view/public/js/thickbox.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="../view/public/css/main.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	
	<!--search begin-->
	<form style="padding:0; margin:0;" action="master_good_good.list.php" method="GET" name="custForm" id="custForm">
	<table width="100%" border="0" cellspacing="2" cellpadding="0" summary="搜索">
		<tr>
			<td style="line-height:30px; text-align:left; font-size:1em;">
				ID：
					<input type="text" name="good_good_id" value="" size="6" />
				
				&nbsp;&nbsp;&nbsp;
				商品名称：
					<input type="text" name="good_good_name" value="" size="10" />
				
				&nbsp;&nbsp;&nbsp;
				商品货号：
					<input type="text" name="good_good_sn" value="" />
				
				&nbsp;&nbsp;&nbsp;
				所属分类：
				<select name="good_good_classid_FK_good_class_id" size="1">
					<option value="">全部</option>
					
					<?php foreach ($rsarray_good_class_list as $v) { ?>
					<option value="<?php echo $v['good_class_id']; ?>"><?php echo str_repeat('……',$v['lev']+1); ?><?php echo $v['good_class_name']; ?></option>
					<?php } ?>
					
				</select>
				
				
				&nbsp;&nbsp;&nbsp;
				<input name="search_submit" type="submit" value=" 搜索 " />
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
		</tr>
	</table>
	<input type="hidden" name="ExecuteSearch" id="ExecuteSearch" value="10" />
	</form>
	<!--search end-->
	
	<a href="master_good_good.add.php?KeepThis=true&TB_iframe=true&height=<?php echo $conf->window_height ?>&width=<?php echo $conf->window_width ?>&modal=false" title="添加新记录" class="thickbox">+添加</a>
	
	<hr />
	
	<table width="100%" border="0" cellspacing="2" cellpadding="0" summary="摘要哈" id="table2">
	<!--List-->
	  <caption>
		<?php echo $conf->managepage_name ?>管理列表
	  </caption>
	  <tr>
		<th scope="col"><input type="checkbox" name="All_CheckAll" id="All_CheckAll" value="All_CheckAll" onClick="CheckAll();" /><label for="All_CheckAll">全/反选</label>&nbsp;</th>
		<th scope="col">ID</th>
		<th scope="col">商品名称</th>
		
		<th scope="col">货号</th>
		<th scope="col">价格</th>
		<th scope="col">上架</th>
		<th scope="col">精品</th>
		<th scope="col">新品</th>
		<th scope="col">热销</th>
		<th scope="col">库存</th>
		
		<th scope="col">操作</th>
	  </tr>
		<!--List-->
	
	
	
	<?php foreach ($rsarray_good_good_all as $v) { ?>
	  <tr>
		<td><input type="checkbox" name="id" id="id<?php echo $v['good_good_id']; ?>" value="<?php echo $v['good_good_id']; ?>" /></td>
		<td><?php echo $v['good_good_id']; ?></td>
		<td><?php echo $v['good_good_name']; ?></td>
		
		<td><?php echo $v['good_good_sn']; ?></td>
		<td><?php echo $v['good_good_shopprice']; ?></td>
		<td><input type="checkbox" name="a" id="a" value="1" <?php if (!is_null($v['good_good_isonsale'])) {echo ' checked=checked';} ?> disabled="disabled" /></td>
		<td><input type="checkbox" name="a" id="a" value="1" <?php if (!is_null($v['good_good_isbest'])) {echo ' checked=checked';} ?> disabled="disabled" /></td>
		<td><input type="checkbox" name="a" id="a" value="1" <?php if (!is_null($v['good_good_isnew'])) {echo ' checked=checked';} ?> disabled="disabled" /></td>
		<td><input type="checkbox" name="a" id="a" value="1" <?php if (!is_null($v['good_good_ishot'])) {echo ' checked=checked';} ?> disabled="disabled" /></td>
		<td><?php echo $v['good_good_stocknum']; ?></td>
		
		<td>
			<span id="showinfo_edit1"><a href="master_good_good.edit.php?id=<?php echo $v['good_good_id']; ?>&code=<?php echo md5(time()); ?>&KeepThis=true&TB_iframe=true&height=<?php echo $conf->window_height ?>&width=<?php echo $conf->window_width ?>&modal=false"  title="修改 <b><?php echo $conf->managepage_name ?></b> 的信息" class="thickbox">修改</a></span>
			&nbsp;<a href="#" onClick="javascript:if (confirm('确定要删除吗？')){deleteRS(<?php echo $v['good_good_id']; ?>);}else{return false;}">删除</a>
			&nbsp;<a href="#" onClick="javascript:if (confirm('确定要放入回收站吗？')){trashRS(<?php echo $v['good_good_id']; ?>);}else{return false;}">放入回收站</a>
		</td>
	  </tr>
	<?php } ?>
	  
	  
	  
	  
	
	  <tr>
		<td colspan="11">
			定义操作:
			<select name="All_Action" id="All_Action">
				<option value="delete">删除操作</option>
			</select>
			&nbsp;
			<button type="button" name="All_ExecButton" id="All_ExecButton">批量执行</button>
		</td>
	  </tr>
	  <!--可插入分页04-->
	  <tr>
		<td colspan="11">
			<font color="#CCC">首页&nbsp;&nbsp;&nbsp;&lt;上一页&nbsp;&nbsp;&nbsp;</font><font color="#CCC">下一页&gt;&nbsp;&nbsp;&nbsp;尾页</font>&nbsp;&nbsp;&nbsp;<b>当前:&nbsp;1</b>/1&nbsp;</strong><b>页</b> &nbsp;&nbsp;&nbsp;Go <select name='Page' size='1' onchange="javascript:window.location='master_good_class.list.php?ExecuteSearch=0&Page=' + this.options[this.selectedIndex].value;" ><option value='1' selected >1</option></select>&nbsp;&nbsp;&nbsp;当前:2&nbsp;个商品栏目&nbsp;&nbsp;&nbsp;共:2&nbsp;个商品栏目
		</td>
	  </tr>
	<!--List-->
	
	</table>
	<!--公共删除函数-->
	<script type="text/javascript">
		function deleteRS(paraID)
		{
			$.ajax({url:"master_good_good.post.php?action=delete",type:"POST",data:""
				+ "Chris="	//操作.
				+ "&id="+ paraID
				+ "",success: function(msg){
				if (msg=="success"){
					alert("" + "删除提交成功" + "");
					parent.location.reload();		//刷新页面
				}else{
					alert( "报警：" + msg + "" );
					//document.write(msg)
				}},error: function(){alert( "" + "访问失败" + "" );}});	
		}
		
		function trashRS(paraID)
		{
			$.ajax({url:"master_good_good.post.php?action=trash",type:"POST",data:""
				+ "Chris="	//操作.
				+ "&id="+ paraID
				+ "",success: function(msg){
				if (msg=="success"){
					alert("" + "成功放入回收站" + "");
					parent.location.reload();		//刷新页面
				}else{
					alert( "报警：" + msg + "" );
					//document.write(msg)
				}},error: function(){alert( "" + "访问失败" + "" );}});	
		}
	</script>
	<!--批量删除函数-->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#All_ExecButton").click(function(){
				if (confirm('确定要批量执行吗？')) {
					//go.
				} else {
					//阻拦操作：
					return false;
				}
				var IDstr = "";  
				$("[name='id'][checked]").each(function(){
					IDstr += $(this).val()+",";
					//alert($(this).val());
				})
				IDstr += "0";	//ID.
				$("#All_ExecButton").toggle();		//提交时，隐藏提交按钮；
				$.ajax({url:"master_good_good.post.php?action=" + escape($("#All_Action").val()),type:"POST",data:""
					+ "Chris="	//操作.
					+ "&id="+ escape(IDstr)	//ID.
					+ "",success: function(msg){
					if (msg=="success"){
						alert("" + "批量执行成功" + "");
						parent.location.reload();		//刷新页面
					}else{
						alert( "报警：" + msg + "" );
						$("#All_ExecButton").toggle();
						//document.write(msg)
					}},error: function(){alert( "" + "访问失败" + "" );}});	
			});
		 });
		function CheckAll() {
		   $("[name='id']").each(function(){
				if ($(this).attr("checked")) {
					$(this).removeAttr("checked");
				} else {
					$(this).attr("checked",'true');
				}
			})
		}
	</script>
	
</body>
</html>