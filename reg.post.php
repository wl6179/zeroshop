<?php
/**
 * 注册 处理页
 * 
 * 结构：action
 * 作用：接收表单数据；调用model写入表单数据；
 * 
 * @author Chris Wang <zeroShop_author@163.com>
 * @version 1.0
 * @package 前台C
 * @copyright (c) 2014 CokeSystem Group
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link http://www.Cokeshow.com.cn zeroShop
 * 
 */

// init
define('ACC', true);
require './include/init.php';



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
	default:
		# Do this then. example:list.
		break;
}



/**
 * 增
 * 小心：undefined string
 */
function save_add() {
	// $_POST
	//（特殊处理 字段）
	//$_POST['good_good_weight']		*= $_POST['good_good_weightunit'];	// chris 提前先处理好了！
	
	
	
	// 第三步：实例化model。并调用model相关的方法。（先 创建表）
	$model_user_user = new UserUserModel();
	// 先 检验帐号 是否已存在 !
	if ($model_user_user->ishave_username($_POST['user_user_username'])) {
		$msg = '用户名已存在！';
		include ROOT .'view/templates/login_web2/view.message.show.php';
		// view/system/view.message.show.php
		exit();
	}
	// 先 检验2个密码 是否一致 !
	if (!empty($_POST['user_user_password']) && ($_POST['user_user_password'] !== $_POST['cpassword'])) {
		$msg = '密码与确认密码填写不一致！';
		include ROOT .'view/templates/login_web2/view.message.show.php';
		exit();
	}
	// 新 - 自动过滤
	$data = array();
	$data = $model_user_user->_autofacade($_POST);	// 自动过滤处理OK！
	// 新 - 自动填充
	$data = $model_user_user->_autofill($data);		// 自动填充处理OK！
	// 新 - 自动检验
	
	if (!$model_user_user->_autovalid($data)) {
		// 如果检验没通过：
		$msg = '没通过检验：<br />'. $model_user_user->get_errormsg();
		include ROOT .'view/templates/login_web2/view.message.show.php';
		exit();
	}
	// -------------------------往下没有错误了-(处理图片等的好时机)--------start-----------------------------
	
	
	
	if ($model_user_user->reg($data)) {
		//echo 'success';
		$msg = '用户注册成功！';
		include ROOT .'view/templates/login_web2/view.message.show.php';
	} else {
		//echo '操作失败';
		$msg = '用户注册失败！';
		include ROOT .'view/templates/login_web2/view.message.show.php';
	}
}