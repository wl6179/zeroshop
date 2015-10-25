<?php
/**
 * 商品栏目 添加页
 * 
 * 结构：添加表单
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

// M（主要是因为有额外功能要求：上级栏目 需要查一下数据库！）
// 上级栏目 需要用model
$model_good_class = new GoodClassModel();
$rsarray_good_class_all = $model_good_class->select();	//获取本表的所有数据
//【格式化一下数据】
//根据上边全数据，获得排列好（类）后的数据！
$rsarray_parentid_list = $model_good_class->get_class_tree($rsarray_good_class_all, 0);

// V
include ROOT .'view/admin/view.master_good_class.add.php';