<?php
/**
 * 配置文件
 * 
 * 作用：用来放置一些常用的配置信息。如 数据库连接信息、Smart模板路径信息 等。
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

$_CFG = array();

$_CFG['host'] = '192.168.1.230';
$_CFG['user'] = 'root';
$_CFG['pwd'] = '666666';
$_CFG['db'] = 'zeroshop';
$_CFG['char'] = 'utf8';
// 后台 的弹出窗口默认尺寸：
$_CFG['window_width'] = '600';
$_CFG['window_height'] = '650';