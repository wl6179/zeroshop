<?php
/**
 * 基础函数库
 * 
 * 各种常用、频率出现高的公共函数
 *
 * @author Chris Wang <zeroShop_author@163.com>
 * @version 1.0
 * @package 函数库
 * @copyright (c) 2014 CokeSystem Group
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link http://www.Cokeshow.com.cn zeroShop
 * 
 */

defined('ACC')||exit('404 Error for IIS 6.0');

/**
 * 将数组内各元素转义函数
 * 
 * 作用：递归转义 数组(内每一个元素) 之函数
 * 用法：$arr = _addslashes($arr);
 * 优势：不引起任何错误、或兼容性问题，通用性最佳（杜绝 &引用参数 方式）
 */
function _addslashes($arr) {
	foreach ($arr as $k=>$v) {
		// 元素如果是字符串，转义之！
		if (is_string($v)) {
			//$arr[$k] = addslashes($v);		# 转义元素！且就地改变数组本身。
			($arr[$k]=='undefined') ? $arr[$k]=null : $arr[$k]=addslashes($v);
		} elseif (is_array($v)) {
			// 如又是数组类型，递归！（继续深入转义其存在的字符串，并返回纵深处理后的 数组）
			$arr[$k] = _addslashes($v);		# 递归
		}
	}

	return $arr;
}

/**
 * 格式化好的时间
 * 
 * 可用于写入数据库timestamp字段类型
 * @return string 返回格式化好的时间
 */
function get_datetime() {
	return date('Y-m-d h:i:s');
}