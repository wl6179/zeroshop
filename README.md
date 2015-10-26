#zeroShop MVC 框架（PHP）
浏览效果：
#####前台访问网址是：http://marryup-wang-dong.com/myshop/zeroshop/
#####后台参观网址是：http://marryup-wang-dong.com/myshop/zeroshop/admin/master_index.php
#####购物车访问网址是：http://marryup-wang-dong.com/myshop/zeroshop/checkout.php
#####前台登录演示网址是：http://marryup-wang-dong.com/myshop/zeroshop/login.php
#####前台商品详情演示是：http://marryup-wang-dong.com/myshop/zeroshop/gooddetail.php?id=8

核心源代码说明：
- MVC 的核心 M 父类 在：zeroshop/model/Model.class.php，包含了自动过滤、自动验证、自动填充 等重要可重用机制
- 整站已完全实现了 MVC 架构，如大后台代码 zeroshop/admin/* 中，查看代码可发现它们拥有 极简的代码量、清晰的代码分离

- 这是一个购物类网站，核心是其自主设计的 MVC 框架的机制源代码，使用了面向对象、设计模式、自动化处理机制等

- 整站使用 PHP 技术进行 MVC 开发，代码分离，每页所需代码量极少

- 优点在于大后台的代码可重用度高，外加一整套个人多年总结的极简纯Javascript代码，不依赖任何别的框架来实现大后台常用 Ajax 功能

- 整体拥有高速的访问响应能力

- 大后台无登录功能，主要是展现源代码的自动化实现机制和面向对象的运用水平

示例：首页代码总共就这么多
````php
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
$data_search = array();
$data_search['good_good_classid_FK_good_class_id'] = 1;
$rsarray_good_good_oneclass = $model_good_good->select($data_search, 3, 'desc');
// V
include ROOT .'view/templates/sport_white/view.index.show.php';
````
浏览首页效果：http://marryup-wang-dong.com/myshop/zeroshop/
#####开始于2013年 上线于2014年！
