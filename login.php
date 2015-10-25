<?php
/**
 * 登录 表单+处理页
 * 
 * 结构：表单
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

// V
// 表单
if (empty($_GET['action'])) {
	include ROOT .'view/templates/login_web2/view.login.form.php';	// 登录表单页
	exit();
}

// 处理登录检查
if ($_GET['action'] == 'check') {
	// 接收
	$u = $_POST['username'];
	$p = $_POST['password'];
	
	// M
	// 验证
	$model_user_user = new UserUserModel();
	//------------------------------------------------
	// 重新定义 自动验证 规则：（自定义）
	$customvalid_fields = array(
			array('username', 1, '帐号必填，且在6到16字符之内', 'length', '6,16'),
			array('password', 1, '密码必填，且在6到16字符之内', 'length', '6,16'),
	);
	// 新 - 自动检验（自定义）
	if (!$model_user_user->_autovalid($_POST, $customvalid_fields)) {
		// 如果检验没通过：
		$msg = '没通过检验：<br />'. $model_user_user->get_errormsg();
		include ROOT .'view/templates/login_web2/view.message.show.php';
		exit();
	}
	//------------------------------------------------
	$row = $model_user_user->check_user($u, $p);		// 获取登录信息
	
	if ($row) {
		// 通过
		$msg = '登录成功！
				<br /><br /><br /><br /><br />
				<a href="./" style="color:white;">首页</a>
				';
		// 要设置session了！：（记住信息）
		//session_start();
		$_SESSION = $row;		// 一次性全部赋值！
		
		//***
		if (!empty($_POST['remember-me'])) {
			// 登录成功后，如果发现用户勾选了‘记住我的登录状态’选项，则生成cookie记下
			setcookie('remember_user', $u, time()+14*24*3600);	// 记住14天时间！
		} else {
			// 否则就是不记住
			setcookie('remember_user', $u, 10);		// 让cookie失效！
		}
		//***
		
		include ROOT .'view/templates/login_web2/view.message.show.php';
		exit();
	} else {
		// 不匹配 报告错误
		$msg = '用户名密码不正确！';
		
		include ROOT .'view/templates/login_web2/view.message.show.php';
		exit();
	}
}

// 退出
if ($_GET['action'] == 'out') {
	// 删掉session
	//session_start();
	session_destroy();
	
	$msg = '退出成功！';
	include ROOT .'view/templates/login_web2/view.message.show.php';
}