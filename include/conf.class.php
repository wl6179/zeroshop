<?php
/**
 * 配置文件 操作类（读取类）
 * 
 * 作用：单例模式。  在中间连接 配置文件 和 各个类。
 * 用法：$conf = conf::get_ins();
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

class conf {
	# 静态属性，用来存储它的实例
	protected static $ins = null;
	# 将配置文件中的数组变量 读进来，将其保存在属性中
	protected $data = array();
	
	# 封死构造函数，还不让继承 克隆（单例模式）
	final protected function __construct() {
		# 读取 配置文件 在这直接读进来
		// 1.首先要想法把config.inc.php给包含进来
		include(ROOT . 'include/config.inc.php');		# 直连！
		# 读进数组，保存在属性$data
		$this->data = $_CFG;		# 这样以后就不用再管配置文件了（直接从此类data属性找）
	}
	
	# 封死构造函数，还不让继承 克隆也是（单例模式）
	final protected function __clone() {
	}
	
	/**
	 * 静态方法，单例 之 创建实例。
	 * 作用：负责做一个判断，判断静态属性$ins是不是自身self的一个实例～
	 */
	public static function get_ins() {
		if (self::$ins instanceof self) {	# 如static ins是自身的一个实例
			return self::$ins;			# 直接ruturn static ins过去
		} else {
			self::$ins = new self();	# 自己造一个（实例）给static ins
			return self::$ins; 			# 再返回ruturn static ins过去
		}
	}
	
	/**
	 * 读取$data内的配置信息
	 */
	public function __get($key) {
		# 判断$key项（在$data数组中）是否存在
		if (array_key_exists($key, $this->data)) {
			return $this->data[$key];			# 安全返回项
		} else {
			return null;
		}
	}
	
	/**
	 * 可在运行期间，动态改变or增加配置项
	 */
	public function __set($key,$value) {
		$this->data[$key] = $value;
	}
}