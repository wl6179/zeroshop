<?php
/**
 * 商品 处理页
 * 
 * 结构：action
 * 作用：接收表单数据；调用model写入表单数据；
 * 
 * @author Chris Wang <zeroShop_author@163.com>
 * @version 1.0
 * @package 大后台C
 * @copyright (c) 2014 CokeSystem Group
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link http://www.Cokeshow.com.cn zeroShop
 * 
 */

// init
define('ACC', true);
require '../include/init.php';



// 主控塔
$action = isset($_GET['action'])?$_GET['action']:'无';

switch ($action) {
	case 'save_add':
		save_add();
		break;
	case 'delete':
		//delete();
		break;
	case 'save_edit':
		save_edit();
		break;
	case 'trash':
			trash();
	default:
		# Do this then. example:list.
		break;
}



/**
 * 增
 * 小心：undefined string
 */
function save_add() {
	
	/* print(var_dump($_POST['good_good_brandid_FK_good_brand_id']));
	exit(); */
	/* var_dump(empty($_POST['good_good_ishot333333333']));
	exit();
	foreach ($_POST as $k=>$v) {
		var_dump($v);
	}
	exit(); */
	// 第二步：检、筛
	/* $data = array();
	if (empty($_POST['good_good_name'])) {
		//exit('商品名称 不能为空');
	} */
	
	// 第一步：接收数据
	/* $data['good_good_name']				= $_POST['good_good_name'];
	$data['good_good_sn']				= $_POST['good_good_sn'];
	// 空值加工为[NULL]； 否则接收[数字类型x+0]参数；
	// 对 外建 + checkbox + radio 进行empty处理！：
	$data['good_good_classid_FK_good_class_id'] = empty($_POST['good_good_classid_FK_good_class_id'])?NULL:$_POST['good_good_classid_FK_good_class_id'] + 0;
	$data['good_good_brandid_FK_good_brand_id'] = empty($_POST['good_good_brandid_FK_good_brand_id'])?NULL:$_POST['good_good_brandid_FK_good_brand_id'] + 0;
	$data['good_good_shopprice']		= $_POST['good_good_shopprice'] + 0;
	$data['good_good_marketprice']	= $_POST['good_good_marketprice'] + 0;
	$data['good_good_stocknum']		= $_POST['good_good_stocknum'] + 0;
	$data['good_good_weight']			= ( $_POST['good_good_weight'] * ($_POST['good_good_weightunit']+0) ) + 0;
	$data['good_good_brief']			= $_POST['good_good_brief'];
	$data['good_good_desc']				= $_POST['good_good_desc'];
	$data['good_good_originalimage']	= $_POST['good_good_originalimage'];
	$data['good_good_isonsale']		= empty($_POST['good_good_isonsale']) ? NULL : $_POST['good_good_isonsale'] + 0;
	$data['good_good_isbest']			= empty($_POST['good_good_isbest']) ? NULL : $_POST['good_good_isbest'] + 0;
	$data['good_good_isnew']			= empty($_POST['good_good_isnew']) ? NULL : $_POST['good_good_isnew'] + 0;
	$data['good_good_ishot']			= empty($_POST['good_good_ishot']) ? NULL : $_POST['good_good_ishot'] + 0;
	 */
	
	// （如果没有上传文件，只需要去掉view中的按钮注释即可，再把此处的 上传类代码部分去掉即可！！！）
	
	// $_POST
	//（特殊处理 字段）
	$_POST['good_good_weight']		*= ($_POST['good_good_weightunit']+0);	// chris 提前先处理好了！
	
	
	
	// 第三步：实例化model。并调用model相关的方法。（先 创建表）
	$model_good_good = new GoodGoodModel();
	
	
	// 新 - 自动过滤：
	//print_r($_POST);	// 测看
	$data = array();
	$data = $model_good_good->_autofacade($_POST);	// 自动过滤处理OK！
	//print_r($data);	// 测看
	
	// 新 - 自动填充（+上缺少的字段）： 【自动填充、补全！】
	$data = $model_good_good->_autofill($data);		// 自动填充处理OK！
	//var_dump($data);	// 测看
	//exit();				// 结果 对比
	
	// 自动商品货号
	if (empty($data['good_good_sn'])) {
		// 要是为空，我给你自动生成一个 不重复的 货号
		$data['good_good_sn'] = $model_good_good->create_sn();		// 小递归确保sn不重复
	}
	
	// 新 - 自动检验： 
	if (!$model_good_good->_autovalid($data)) {
		// 如果检验没通过：
		exit('没通过检验！-'. $model_good_good->get_errormsg());
	}
	// -------------------------往下没有错误了-(处理图片等的好时机)--------start-----------------------------
	
	
	//  处理上传图片：（不必先处理！）
	// $_POST是接收不到此file字段的！！！
	// 用 data[] 数组接收数据～chris
	if (!empty($_FILES['good_good_originalimage']['name'])) {	// 如果表单中的file控件 有选择图片时，上传！  否则就不用上传～进而也没生成缩略图了～
		$library_upfile_single = new upfile_single_library();
		$library_upfile_single->set_size(0.5);						// 重置文件大小限制为：0.5MB！（动态配置）
		$library_upfile_single->set_ext('gif,jpg,png,rar');	// 重置文件扩展名为：！（动态配置）
		$fileresult = $library_upfile_single->up('good_good_originalimage');
		
		if ($fileresult) {
			// echo end(explode("/image/", $fileresult));
			$data['good_good_originalimage'] = $fileresult;											// <---------A
			
			
			// 如果上传ori图片成功，再次生成中等缩略图
			// - $library_image = new image_library();
			// 先定义各文件名称
			$string_ori_img = ROOT . $fileresult;		// 原图路径
			$string_good_img = dirname($string_ori_img) . '/good_'. basename($string_ori_img);	// 中等缩略图路径
			$string_thumb_img = dirname($string_ori_img) . '/thumb_'. basename($string_ori_img);	// 最小缩略图路径
			// 生成中等缩略图
			if (image_library::thumb($string_ori_img, $string_good_img, 360, 480)) {
				$data['good_good_goodimage'] = str_replace(ROOT, '', $string_good_img);		// <---------B
			}
		
			// ，再次生成（浏览时用的）最小缩略图
			if (image_library::thumb($string_ori_img, $string_thumb_img, 250, 173)) {
				$data['good_good_thumbimage'] = str_replace(ROOT, '', $string_thumb_img);	// <---------C
			}
		} else {
			// false!
			// 不处理此file字段值，大概就为空了！chris
			// 打印出错误信息：
			echo $library_upfile_single->get_err();
		}
	}// if (!empty($_FILES['...
	// -------------------------往下没有错误了-(处理图片等的好时机)--------end-----------------------------
	
	
	if ($model_good_good->add($data)) {
		echo 'success';
	} else {
		echo '操作失败';
	}
}

/**
 * 删
 */
function delete() {
	// 第一步：接收数据
	$id = $_POST['id'];
	
	// 第二步：调用model。
	$model_good_good = new GoodGoodModel();
	
	// 删
	echo $model_good_good->delete($id) ? 'success' : '操作失败';
}

/**
 * 改
 */
function save_edit() {
	$id = $_POST['id'];
	if (!is_numeric($id)) {
		exit('ID参数错误');
	} else {
		$id = $_POST['id'] + 0;
	}
	$data = array();
	
	// $_POST
	//（特殊处理）
	$_POST['good_good_weight']		*= ($_POST['good_good_weightunit']+0);
	
	
	
	// 第三步：实例化model。并调用model相关的方法
	$model_good_good = new GoodGoodModel();
	
	
	// 新 - 自动过滤
	$data = array();
	$data = $model_good_good->_autofacade($_POST);
	// 新 - 自动填充
	$data = $model_good_good->_autofill($data);
	// 新 - 自动检验： 
	if (!$model_good_good->_autovalid($data)) {
		// 如果检验没通过：
		exit('没通过检验！-'. $model_good_good->get_errormsg());
	}
	// -------------------------往下没有错误了-(处理图片等的好时机)--------start-----------------------------
	
	
	//  处理上传图片
	// $_POST是接收不到此file字段的！！！
	// 用 data[] 数组接收数据～chris
	if (!empty($_FILES['good_good_originalimage']['name'])) {	// 如果表单中的file控件 有选择图片时，上传！  否则就不用上传～进而也没生成缩略图了～
		$library_upfile_single = new upfile_single_library();
		$library_upfile_single->set_size(0.5);						// 重置文件大小限制为：0.5MB！（动态配置）
		$library_upfile_single->set_ext('gif,jpg,png,rar');	// 重置文件扩展名为：！（动态配置）
		$fileresult = $library_upfile_single->up('good_good_originalimage');
		
		if ($fileresult) {
			$data['good_good_originalimage'] = $fileresult;											// <---------A
			
			// 如果上传ori图片成功，再次生成中等缩略图
			// 先定义各文件名称
			$string_ori_img = ROOT . $fileresult;		// 原图路径
			$string_good_img = dirname($string_ori_img) . '/good_'. basename($string_ori_img);	// 中等缩略图路径
			$string_thumb_img = dirname($string_ori_img) . '/thumb_'. basename($string_ori_img);	// 最小缩略图路径
			// 生成中等缩略图
			if (image_library::thumb($string_ori_img, $string_good_img, 360, 480)) {
				$data['good_good_goodimage'] = str_replace(ROOT, '', $string_good_img);		// <---------B
			}
			// ，再次生成（浏览时用的）最小缩略图
			if (image_library::thumb($string_ori_img, $string_thumb_img, 250, 173)) {
				$data['good_good_thumbimage'] = str_replace(ROOT, '', $string_thumb_img);	// <---------C
			}
		} else {
			// false!
			// 不处理此file字段值，大概就为空了！chris
			// 打印出错误信息：
			echo $library_upfile_single->get_err();
		}
	}// if (!empty($_FILES['...
	// -------------------------往下没有错误了-(处理图片等的好时机)--------end-------------
	
	
	if ($model_good_good->edit($data,$id)) {
		echo 'success';
	} else {
		echo '操作失败';
	}
}

/**
 * 放回收站
 */
function trash() {
	$id = $_POST['id'];
	if (!is_numeric($id)) {
		exit('ID参数错误');
	} else {
		$id = $_POST['id'] + 0;
	}
	
	$model_good_good = new GoodGoodModel();
	
	// 删
	echo $model_good_good->trash($id)?'success':'放入回收站失败';
}