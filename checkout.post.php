<?php
/**
 * 购物车+结算 处理页
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
	case 'buy':
		buy();
		break;
	case 'delete':
		delete();
		break;
	case 'incr':
		incr();
		break;
	case 'less':
		less();
		break;
	default:
		# Do this then. example:list.
		break;
}


/**
 * 添加商品
 */
function buy() {
	// 购物车实例
	$library_checkout = checkout_library::get_checkout();
	// 传参
	$int_goodid = empty($_GET['id']) ? 0 : $_GET['id']+0;
	$int_buynum = empty($_GET['num']) ? 1 : $_GET['num']+0;
	
	
	// 商品
	$model_good_good = new GoodGoodModel();
	
	// 想买商品时
	if ($int_goodid) {
		// 对应的商品记录
		$rsarray_good_good_one = $model_good_good->getrow($int_goodid);
		
		if ($rsarray_good_good_one) {
			// 执行添加入购物车操作
			$library_checkout->add_item($int_goodid, $int_buynum);
		} else {
			// 如果检验没通过：
			$msg = '木有此商品！';
			include ROOT .'view/templates/login_web2/view.message.show.php';
			exit();
		}
	}
	
	header('location:./checkout.php');	// 正常放入购物车后，跳转到购物车页
}

/**
 * 删
 */
function delete() {
	// 第一步：接收数据
	$id = $_REQUEST['id'];		// +0处理 会阻挡 id 集合的传递！
	//print_r($id);
	//exit();
	if (empty($id)) {
		echo '请选择 要批量操作的商品！（舰长拒绝执行）';
		exit();
	}
	
	// 购物车
	$library_checkout = checkout_library::get_checkout();		// 购物车实例

	// 删
	$flag = true;
	//var_dump(strpos($id, ','));
	//exit();
	if (strpos($id, ',') > 0) {		// 如是包含逗号，的数字集合时
		// 遍历每个id
		//print_r(explode(',', $id));
		foreach (explode(',', $id) as $v) {
			$v = $v + 0;		// 验
			if ($library_checkout->delete_item($v)) {
				//echo 'success-'. $v . '<br />';
			} else {
				//echo '操作失败';
				$flag = false;
			}
		}
	} else {									// 如果是一个数字号时，正常处理
		// 删
		$id = $id + 0;		// 验
		if ($library_checkout->delete_item($id)) {
			//echo 'success';
		} else {
			//echo '操作失败';
			$flag = false;
		}
	}
	
	if ($flag == true) {
		echo 'success';
	} else {
		echo '操作失败';
	}
}

/**
 * 收藏
 */
function collect() {
}

/**
 * 递增
 * 
 * @param int 商品ID主键
 */
function incr() {
	$id = $_REQUEST['id'] + 0;
	
	// 购物车
	$library_checkout = checkout_library::get_checkout();		// 购物车实例
	$library_checkout->incr_item($id);
	
	header('location:./checkout.php');
}

/**
 * 递减
 *
 * @param int 商品ID主键
 */
function less() {
	$id = $_REQUEST['id'] + 0;
	
	// 购物车
	$library_checkout = checkout_library::get_checkout();		// 购物车实例
	$library_checkout->less_item($id);
	
	header('location:./checkout.php');
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