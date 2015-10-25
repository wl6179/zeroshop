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

// M
// 验证id
$id = empty($_GET['id']) ? 0 : $_GET['id']+0;

$model_good_good = new GoodGoodModel();
$rsarray_good_good_one = $model_good_good->getrow($id);	//取出一行数据
if (empty($rsarray_good_good_one)) {
	header('location:index.php');		// 首页凉快去
	exit();
}

// 取出树状导航（0的子孙树）
//【格式化一下数据】
$model_good_class = new GoodClassModel();
$rsarray_good_class_all = $model_good_class->select();	//获取本表的所有数据
$rsarray_class_sontree = $model_good_class->get_class_tree($rsarray_good_class_all, 0, 1);

// 取出面包屑导航（classid的族谱树）
$rsarray_parentree = $model_good_class->get_class_parenttree($model_good_class->select(), $rsarray_good_good_one['good_good_classid_FK_good_class_id']);

// V
include ROOT .'view/templates/sport_white/view.good.detail.php';