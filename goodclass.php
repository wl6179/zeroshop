<?php
/**
 * 商品列表页
 * 
 * 结构：show
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

//session_start();

// 参数处理区
// 验证id
$classid = empty($_GET['classid']) ? 0 : $_GET['classid']+0;
//$classid = is_numeric($_GET['classid']) ? $_GET['classid'] : 0;
// 分页 begin
$page = empty($_GET['page']) ? 1 : $_GET['page']+0;
if ($page < 1) {
	$page = 1;
}
$page_number_perpage = 3;		// 自定义
$offset = ($page -1) * $page_number_perpage;	// 偏移量
// 分页 end

// M
$model_good_class = new GoodClassModel();
// 借助数据库处理参数$classid
$rsarray_good_class_one = $model_good_class->getrow($classid);	//取出一行数据
if (empty($rsarray_good_class_one)) {
	header('location:index.php');		// 首页凉快去
	exit();
}

// 取出树状导航（0的子孙树）
//【格式化一下数据】
$rsarray_good_class_all = $model_good_class->select();	//获取本表的所有数据
$rsarray_class_sontree = $model_good_class->get_class_tree($rsarray_good_class_all, 0, 1);

// 取出面包屑导航（classid的族谱树）
$rsarray_parentree = $model_good_class->get_class_parenttree($model_good_class->select(), $classid);

// 取出classid栏目下的商品
$data_search = array();
$data_search['good_good_classid_FK_good_class_id'] = $classid;
$model_good_good = new GoodGoodModel();
$rsarray_good_good_forclass = $model_good_good->select($data_search, "$offset,$page_number_perpage", 'desc');

$rsarray_good_good_forclass_forpage = $model_good_good->select($data_search, "0,500", 'desc');// 为了给分页统计总条数
//var_dump(count($rsarray_good_good_forclass_forpage));

// Tool
// 分页 begin
/*	调用分页类 例子：
	new page_library(总条数， 当前页码， 每页条数)；
	然后用 ->show 返回分页代码片段。*/
$library_page = new page_library(count($rsarray_good_good_forclass_forpage), $page, $page_number_perpage);	// <---开启分页类
$pagecode = $library_page->show();
$precode = $library_page->button_pre();
$nextcode = $library_page->button_next();
$selectedcode = $library_page->button_selected();
// 分页 end

// V
include ROOT .'view/templates/sport_white/view.good.list.php';