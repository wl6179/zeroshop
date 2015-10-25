<?php
/**
 * 首页
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
$data_search = array();
$data_search['good_good_classid_FK_good_class_id'] = 2;
$model_good_good = new GoodGoodModel();
$rsarray_good_good_all = $model_good_good->select($data_search, 3, 'desc');	//获取本表的所有数据
// 取出指定栏目的商品（要包括其 子孙 类）
// 应变嘛
// 参[查] - ''为空字符串者，代表没有查询值！！（包括下拉控件的“全部=''”也是！） - 此为专为服务于查询参数的机制策略。
$data_search = array();
$data_search['good_good_classid_FK_good_class_id'] = 1;
$rsarray_good_good_oneclass = $model_good_good->select($data_search, 3, 'desc');

// V
include ROOT .'view/templates/sport_white/view.index.show.php';