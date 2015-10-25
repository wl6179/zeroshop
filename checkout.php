<?php
/**
 * 购物车页
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

// 参数重新定义区
$conf->managepage_name = '购物';

//session_start();
// 购物车
$library_checkout = checkout_library::get_checkout();		// 购物车实例
$array_checkout_all = $library_checkout->get_allitems();	// 车内商品数据数组


// M
// 商品
$model_good_good = new GoodGoodModel();

// 创新方法：（根据购物车ids，生成更详尽的goods数组数据！！！）
$rsarray_checkoutgoods = $model_good_good->get_checkoutgoods($array_checkout_all);	// 购物车详细化！
//var_dump($rsarray_checkoutgoods);
//exit();

// 数据定义区
$allprice = $library_checkout->get_allprice();
$allnumber = $library_checkout->get_allnumber();
$allcount = $library_checkout->get_allcount();

// V
include ROOT .'view/templates/sport_white/view.checkout.show.php';