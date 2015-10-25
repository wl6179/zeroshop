<?php
/**
 * 商品 添加页
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

define('ACC', true);
require '../include/init.php';

// M（为了外键）
$model_good_class = new GoodClassModel();
$rsarray_good_class_all = $model_good_class->select();
$rsarray_fk_good_class_id = $model_good_class->get_class_tree($rsarray_good_class_all, 0);

// V
include '../view/admin/view.master_good_good.add.php';