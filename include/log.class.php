<?php
/**
 * 日志类
 * 
 * 作用：写入日志的功能
 * 思路：给定内容，写入文件；
 * 机制：如果文件 > 1M，重写一份日志文件（备份）。
 * 
 * @author Chris Wang <zeroShop_author@163.com>
 * @version 1.0
 * @package 类
 * @copyright (c) 2014 CokeSystem Group
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link http://www.Cokeshow.com.cn zeroShop
 * 
 */

defined('ACC')||exit('404 Error for IIS 6.0');

class log {
	const LOGFILE = 'curr.log';		# 日志文件名称
	
	/**
	 * （追加模式）写入日志
	 */
	public static function write($content) {
		// 追加 换行符
		$content .= "\n";		# 必须用双引号
		
		// 判断日志大小，是否需要分割备份日志文件
		$log = self::isBak();		# 得出日志文件的地址
		
		$jubing = fopen($log, 'ab');	// ab追加模式
		fwrite($jubing, $content);
		fclose($jubing);
	}
	
	/**
	 * 备份日志
	 */
	public static function bak() {
		// 就是把原来的日志文件改个名，存储起来。【并清空当前日志文件！】
		// 改成： 年-月-日.bak 这种形式。
		$log = ROOT . 'data/log/' . self::LOGFILE;		// 当前日志路径
		$bak = ROOT . 'data/log/' . date('ymd') . mt_rand(10000, 99999) . '.bak';
		
		// 把log文件重命名：
		return rename($log, $bak);		# 返回 重命名 的结果
	}
	
	/**
	 * 读取，并判断日志的大小
	 */
	public static function isBak() {
		$log = ROOT . 'data/log/' . self::LOGFILE;		// 当前日志路径
		// 清除文件属性 之 缓存
		clearstatcache(true,$log);		# <---
		
		// 如果curr.log文件不存在，则创建
		if (!file_exists($log)) {
			touch($log);
			return  $log;			# 返回新建日志文件的curr.log路径（结束）
		}
		
		// 要是能运行到此处，则就是curr.log日志已存在。判断其大小决定是否另建新日志文件，并备份
		$size = filesize($log);
		// 如果curr.log文件小于等于1M，能继续写
		if ($size <= (1024*1024)) {
			return $log;			# 返回新建日志文件的curr.log路径（结束）
		}
		
		// 要是能运行到此处，则curr.log日志大于1M了。需要备份旧文件，并另新建日志（清空原curr.log并重新写入～）！：
		// 主要是 self::bak()
		if (!self::bak()) {	# 如果备份失败，默认继续在原log中写
			return $log;		#原log（结束）
		} else {// 备份成功时：
			touch($log);		# 因为bak()已经rename了备份，所以此处可以重新新建curr.log日志文件！
			return $log;		#一样 返回新建日志文件的curr.log路径（结束）
		}
		
	}
}