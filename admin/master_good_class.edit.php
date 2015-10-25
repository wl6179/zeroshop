<?php
/**
 * 商品栏目 修改页
 * 
 * 结构：修改表单
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

// 第一步：接收数据
$id = is_numeric($_GET['id'])?$_GET['id']:0;
// 第二步：检验数据

// 第三步：实例化model。并调用model相关的方法 取得对象
// M
$model_good_class = new GoodClassModel();
$rsarray_good_class_one = $model_good_class->getrow($id);	//取出一行数据
//【格式化一下数据】
$rsarray_good_class_all = $model_good_class->select();	//获取本表的所有数据
$rsarray_parentid_list = $model_good_class->get_class_tree($rsarray_good_class_all, 0);

// V
include ROOT .'view/admin/view.master_good_class.edit.php';