<?php
/**
 * 购物车结算页
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
<!DOCTYPE HTML>
<html dir="ltr" lang="en-US">
<head>
<title>购物车结算</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo ROOTWWW; ?>view/templates/sport_white/css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo ROOTWWW; ?>view/templates/sport_white/js/jquery.min.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });
                        
            $(".dropdown dd ul li a").click(function() {
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });
                        
            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });


            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });
        });
     </script>
<!-- start menu -->     
<link href="<?php echo ROOTWWW; ?>view/templates/sport_white/css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo ROOTWWW; ?>view/templates/sport_white/js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<!-- end menu -->
<!-- top scrolling -->
<script type="text/javascript" src="<?php echo ROOTWWW; ?>view/templates/sport_white/js/move-top.js"></script>
<script type="text/javascript" src="<?php echo ROOTWWW; ?>view/templates/sport_white/js/easing.js"></script>
   <script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
			});
		});
	</script>
</head>
<body>
	<?php include ROOT .'view/templates/sport_white/include/view.top.inc.php'; ?>
					
					
       <div class="login">
         <div class="wrap">
    	     <h4 class="title">外太空购物车</h4>
    	     <!-- <p class="cart">You have no items in your shopping cart.<br>Click<a href="./"> here</a> to continue shopping</p> -->
    	     
    	     
    	     
    	     		
		<table width="100%" border="0" cellspacing="2" cellpadding="0" summary="摘要哈" id="table2">
		<!--List-->
		  <caption>
			<?php echo $conf->managepage_name ?>管理列表
		  </caption>
		  <tr>
			<th scope="col"><input type="checkbox" name="All_CheckAll" id="All_CheckAll" value="All_CheckAll" onClick="CheckAll();" /><label for="All_CheckAll">全/反选</label>&nbsp;</th>
			<th scope="col">ID</th>
			<th scope="col">商品名称</th>
			<th scope="col">参考图</th>
			
			<th scope="col">市场价</th>
			<th scope="col">本店价</th>
			
			<th scope="col">购买数</th>
			<th scope="col">小计</th>
			<th scope="col">操作</th>
		  </tr>
			<!--List-->
		
		
		<!-- 遭淘汰！ -->
		<?php
		//*$rsarray_good_good_one = array();
		//*foreach ($array_checkout_all as $k=>$v) {
			// 得到对应商品记录
			//*$rsarray_good_good_one = $model_good_good->getrow($k);
		?>
		  <!-- <tr>
			<td><input type="checkbox" name="id" id="id<?php //*echo $k; ?>" value="<?php //*echo $k; ?>" /></td>
			<td><?php //*echo $k; ?></td>
			<td><a href="./gooddetail.php?id=<?php //*echo $rsarray_good_good_one['good_good_id']; ?>" target="_blank"><?php //*echo $rsarray_good_good_one['good_good_name']; ?></a></td>
			<td><IMG width="80" alt="<?php //*echo $rsarray_good_good_one['good_good_name']; ?>" src="<?php //*echo ROOTWWW . $rsarray_good_good_one['good_good_thumbimage']; ?>"></td>
			
			<td><?php //*echo $rsarray_good_good_one['good_good_marketprice']; ?></td>
			<td><?php //*echo $rsarray_good_good_one['good_good_shopprice']; ?></td>
			
			<td><?php //*echo $v['num']; ?></td>
			<td><?php //*echo $rsarray_good_good_one['good_good_shopprice'] * $v['num']; ?></td>
			<td>
				<span id="showinfo_edit1"><a href="" onclick="alert('Sorry，设计师去修普罗米修斯飞船去了，没来得及制作更新功能！'); return false;">更新</a></span>
				&nbsp;<a href="#" onClick="javascript:if (confirm('确定要删除吗？')){deleteRS(<?php //*echo $k; ?>);}else{return false;}">删除</a>
			</td>
		  </tr> -->
		<?php  //*} ?>
		
		
		<!-- 创新！ -->
		<?php
		if (!empty($rsarray_checkoutgoods)) {	// 防止没数据时出错
		foreach ($rsarray_checkoutgoods as $v) {
		?>
		  <tr>
			<td><input type="checkbox" name="id" id="id<?php echo $v['good_good_id']; ?>" value="<?php echo $v['good_good_id']; ?>" /></td>
			<td><?php echo $v['good_good_id']; ?></td>
			<td><a href="./gooddetail.php?id=<?php echo $v['good_good_id']; ?>" target="_blank"><?php echo $v['good_good_name']; ?></a></td>
			<td><IMG width="80" alt="<?php echo $v['good_good_name']; ?>" src="<?php echo ROOTWWW . $v['good_good_thumbimage']; ?>"></td>
			
			<td><?php echo $v['good_good_marketprice']; ?></td>
			<td><?php echo $v['good_good_shopprice']; ?></td>
			
			<td>
				<a href="./checkout.post.php?action=less&id=<?php echo $v['good_good_id']; ?>">-</a>
				<?php echo $array_checkout_all[$v['good_good_id']]['num']; ?>
				<a href="./checkout.post.php?action=incr&id=<?php echo $v['good_good_id']; ?>">+</a>
			</td>
			<td><?php echo $v['good_good_shopprice'] * $library_checkout->get_itemnum($v['good_good_id']); ?></td>
			<td>
				<span id="showinfo_edit1"><a href="" onclick="alert('Sorry，设计师去修普罗米修斯飞船了，没来得及制作更新功能！'); return false;">更新</a></span>
				&nbsp;<a href="#" onClick="javascript:if (confirm('确定要删除吗？')){deleteRS(<?php echo $v['good_good_id']; ?>);}else{return false;}">删除</a>
			</td>
		  </tr>
		<?php }} ?>
		  
		  
		  
		
		  <tr>
			<td colspan="9">
				定义操作:
				<select name="All_Action" id="All_Action">
					<option value="delete">批量删除</option>
					<option value="collect">批量收藏</option>
					<option value="air">批量投放太空！</option>
				</select>
				&nbsp;
				<button type="button" name="All_ExecButton" id="All_ExecButton">确认执行</button>
			</td>
		  </tr>
		  <!--结算区-->
		  <tr>
			<td colspan="9">
				<br />
				结算价格：￥<font size=6 color=red><?php echo $allprice; ?></font>
				<br />
				总共 <?php echo $allnumber; ?> 个商品
				<br />
				总共 <?php echo $allcount; ?> 种商品
				
				<br />
				<br />
				<!-- <a href="./checkout_cash.php"> 结 算 </a> -->
				
			</td>
		  </tr>
		<!--List-->
		
		</table>
		
		
    	     
    	     
    	     
    	   </div>
		</div>
		

		
		
        
		<?php include ROOT .'view/templates/sport_white/include/view.footer.inc.php'; ?>
	<!--公共删除函数-->
	<script src="<?php echo ROOTWWW; ?>view/public/js/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		function deleteRS(paraID)
		{
			$.ajax({url:"checkout.post.php?action=delete",type:"POST",data:""
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
				//------------------
				if (escape($("#All_Action").val()) == 'collect') {
					alert('Sorry，设计师去修普罗米修斯飞船去了，没来得及制作 批量收藏 功能！');
					return false;
				}
				if (escape($("#All_Action").val()) == 'air') {
					alert('Sorry，设计师去修普罗米修斯飞船去了，没来得及制作 批量投放太空！ 功能！');
					return false;
				}
				//---------------
				var IDstr = "";  
				$("[name='id'][checked]").each(function(){
					IDstr += $(this).val()+",";
					//alert($(this).val());
				})
				IDstr += "0";	//ID.
				$("#All_ExecButton").toggle();		//提交时，隐藏提交按钮；
				$.ajax({url:"checkout.post.php?action=" + escape($("#All_Action").val()),type:"POST",data:""
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