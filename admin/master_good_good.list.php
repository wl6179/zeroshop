<?php
/**
 * 商品栏目 列表页
 * 
 * 结构：查询表单和列表
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

// 参数重新定义区
$conf->window_width = '600';
$conf->window_height = '780';
$conf->managepage_name = '商品';

// 应变嘛
// 参[查] - ''为空字符串者，代表没有查询值！！（包括下拉控件的“全部=''”也是！） - 此为专为服务于查询参数的机制策略。
$data_search = array();
$data_search['good_good_id']			= empty($_GET['good_good_id']) ? '' : $_GET['good_good_id'];
$data_search['good_good_name']		= empty($_GET['good_good_name']) ? '' : $_GET['good_good_name'];
$data_search['good_good_sn']			= empty($_GET['good_good_sn']) ? '' : $_GET['good_good_sn'];
$data_search['good_good_classid_FK_good_class_id'] = empty($_GET['good_good_classid_FK_good_class_id']) ? '' : $_GET['good_good_classid_FK_good_class_id'];
//var_dump($data);exit();

// M
$model_good_good = new GoodGoodModel();
$rsarray_good_good_all = $model_good_good->select($data_search);	//获取本表的所有数据

$model_good_class = new GoodClassModel();
$rsarray_good_class_all = $model_good_class->select();	//获取本表的所有数据
//【格式化一下数据】
//根据上边全数据，获得排列好（类）后的数据！
$rsarray_good_class_list = $model_good_class->get_class_tree($rsarray_good_class_all, 0);

// V
include ROOT .'view/admin/view.master_good_good.list.php';