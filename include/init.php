<?php
/**
 * 初始化文件
 * 
 * 作用：框架初始化
 * 所有用户访问到的页面-都应该最先包含它。
 * 
 * @author Chris Wang <zeroShop_author@163.com>
 * @version 1.0
 * @package 配置文件
 * @copyright (c) 2014 CokeSystem Group
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link http://www.Cokeshow.com.cn zeroShop
 * @ignore
 * 
 */

defined('ACC')||exit('404 Error for IIS 6.0');

// 初始化当前的绝对路径常量
define('ROOT', dirname(dirname(__FILE__)) . '/');		# 2次dirname就是再上一级目录
define('ROOTWWW', '/myshop/zeroshop/');

// 设置Debug选项，即 设置报错级别
define('DEBUG', true);

// 报错级别
if(defined('DEBUG')) {
	error_reporting(E_ALL);		# 开发模式
} else {
	error_reporting(0);			# 生产环境
}

// 开启 session
session_start();


// 大规模 - 引入模块儿
require ROOT . 'include/lib_base.php';			# 基础函数库 - 包含有递归转义函数
/**
 * 自动加载系统
 * 
 * 作用：如果遇到不存在的类时，自动去尝试加载此类名对应的文件
 * 
 * @param string 魔术的字符 - 类名
 */
function __autoload($class) {
	// Model类的
	switch ($class) {
		case strtolower(substr($class, -5)) == 'model':
			require ROOT .'model/'. $class .'.class.php';
			break;
		case strtolower(substr($class, -7)) == 'library':
			require ROOT .'library/'. $class .'.class.php';
			break;
		default:
			// 否则就认为是include/的：
			require ROOT .'include/'. $class .'.class.php';
			break;
	}
}
$conf = conf::get_ins();			// 各个配置信息


// 递归过滤参数 $_GET, $_POST, $_COOKIE
$_GET = _addslashes($_GET);
$_POST = _addslashes($_POST);
$_COOKIE = _addslashes($_COOKIE);

// 日志记录功能；
# 散落在mysql类的执行sql方法中 等（会自动加载）