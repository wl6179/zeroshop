<?php
/**
 * 购物车类
 * 
 * @author Chris Wang <zeroShop_author@163.com>
 * @version 1.0
 * @package lib类
 * @copyright (c) 2014 CokeSystem Group
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link http://www.Cokeshow.com.cn zeroShop
 * 
 */

defined('ACC')||exit('404 Error for IIS 6.0');

/* session_start(); */

/**
 * 购物车类
 * 
 * 功能要求：
 * 1 要求全局有效可访问
 * 方案：把购物车的信息放在数据库；也可以放在session或cookie里；（此次选session）
 * 
 * 2 既然全局有效，即 暗示购物车的实例，只能有1个！
 * 方案：单例模式；（此次选 单例）
 * 
 * 功能分析：
 * 0 前能判断商品是否存在；
 * 1 添加商品（前能判断商品是否存在）；
 * 2 删除商品；
 * 3 修改商品数量；（再封装 +1 -1）
 * 4 查询购物车商品的种类数；（商品品数）
 * 5 查询购物车的商品数量；
 * 7 查询购物车里的商品总金额；
 * 8 返回购物车里的所有商品；
 * 9 清空购物车；
 * 
 * 把购物车的单例对象，放到session里！
 * 
 */
class checkout_library {
	private static $ins = null;
	private $items = array();
	//public $sign = 0;
	final protected function __construct() {
		//$this->sign = mt_rand(1, 100000);		
	}
	final protected function __clone() {
	}
	/**
	 * 单例
	 * 
	 * @return resource 返回实例
	 */
	protected static function getIns() {
		if (!(self::$ins instanceof self)) {
			self::$ins = new self();
		}
		return self::$ins;
	}
	
	/**
	 * 获得当前 购物车对象
	 * 
	 * 把购物车的单例对象，放到session里返回！
	 * @return resource 返回用 session 承载的 购物车类实例
	 */
	public static function get_checkout() {
		if (!isset($_SESSION['checkout']) || !$_SESSION['checkout'] instanceof self) {
			$_SESSION['checkout'] = self::getIns();
		}
		
		return $_SESSION['checkout'];
	}
	
	/**
	 * 添加商品
	 * 
	 * @param int $int_goodid 商品ID主键
	 * @param int $int_buynum 购买数量
	 * @return boolean 返回是否成功（加入购物车）
	 */
	public function add_item($int_goodid, $int_buynum=1) {
		$items = array();			// 先组建一个数组，后再把此数组赋值给 $this->items[$int_goodid]
		
		if ($this->has_item($int_goodid)) {	// 追加购买数量而已～
			$this->incr_item($int_goodid, $int_buynum);
			return;
		} else {	// 新增！
			/* $items['name'] = $string_goodname;
			$items['price'] = $int_goodprice; */
			$items['num'] = $int_buynum;
			return $this->items[$int_goodid] = $items;	// 主键ID是不重复的，所以利用它做一个数组（记录）的下标吧！
		}
	}
	/**
	 * 清空购物车
	 * 
	 * @return boolean 返回执行情况
	 */
	public function clear_allitem() {
		$this->items = array();
		return true;
	}
	/**
	 * 删除一个商品
	 * 
	 * @return boolean 返回执行情况
	 */
	public function delete_item($int_goodid) {
		unset($this->items[$int_goodid]);
		return true;
	}
	/**
	 * 修改购物车中的商品的数量
	 * 
	 * @param int $int_goodid 商品ID主键
	 * @param number $int_buynum 直接修改后的对应商品e数量
	 * @return boolean 返回执行情况
	 */
	public function modify_item($int_goodid, $int_buynum=1) {
		if (!$this->has_item($int_goodid)) {
			return false;
		}
		
		$this->items[$int_goodid]['num'] = $int_buynum;
		return true;
	}
	
	/**
	 * 商品数量 -减少1
	 * 
	 * @param int $int_goodid 商品ID主键
	 * @return boolean 返回执行情况
	 */
	public function less_item($int_goodid, $int_num=1) {
		if ($this->has_item($int_goodid)) {
			$this->items[$int_goodid]['num'] -= $int_num;
		}
		
		// 如果减少后，数量为0了，则把此商品 删除掉一个
		if ($this->items[$int_goodid]['num'] < 1) {
			// 删除一个商品
			$this->delete_item($int_goodid);
		}
		return true;
	}
	/**
	 * 商品数量 +增加1
	 *
	 * @param int $int_goodid 商品ID主键
	 * @return boolean 返回执行情况
	 */
	public function incr_item($int_goodid, $int_num=1) {
		if ($this->has_item($int_goodid)) {
			$this->items[$int_goodid]['num'] += $int_num;
		}
		return true;
	}
	/**
	 * 判断某商品是否存在
	 * 
	 * @param int $int_goodid 商品ID
	 * @return boolean 返回是否存在
	 */
	public function has_item($int_goodid) {
		return array_key_exists($int_goodid, $this->items);
	}
	
	/**
	 * 查询购物车中商品的 种类数
	 *
	 * @return boolean 返回item数组的单元数 即可
	 */
	public function get_allcount() {
		return count($this->items);
	}
	/**
	 * 查询购物车中商品的 个数
	 *
	 * @return int 返回item数组的每个单元的num数量的总和个数
	 */
	public function get_allnumber() {
		if ($this->get_allcount() == 0) {
			return 0;
		}
		
		// 加一遍
		$sum = 0;
		foreach ($this->items as $item) {
			$sum += $item['num'];
		}
		return $sum;
	}
	/**
	 * 查询购物车中商品的 总金额
	 *
	 * @return int 返回item数组的每个单元的num数量*其单价的 总金额
	 */
	public function get_allprice() {
		if ($this->get_allcount() == 0) {
			return 0;
		}
	
		// 有商品，遍历一遍+钱
		$sumprice = 0;	// 钱
		foreach ($this->items as $k=>$item) {
			$sumprice += $item['num'] * $this->get_itemprice($k);	// ++钱
		}
		return $sumprice;
	}
	/**
	 * 查询购物车中 的所有商品
	 * 
	 * @return array 返回购物车中的所有商品 e数据数组
	 */
	public function get_allitems() {
		return $this->items;
	}
	
	/**
	 * 查询某商品价格
	 * 
	 * @param int $int_goodid 商品ID主键
	 * @return int 返回价格
	 */
	protected function get_itemprice($int_goodid) {
		if (!$this->has_item($int_goodid)) {
			return false;	// 系统出错！
		}
		
		$model_good_good = new GoodGoodModel();
		$rsarray_good_good_one = $model_good_good->getrow($int_goodid);	//取出一行数据
		if (empty($rsarray_good_good_one)) {
			return false;	// 系统出错！
		}
		return $rsarray_good_good_one['good_good_shopprice'];		// 返回正常的市场价！
	}
	
	/**
	 * 查询某商品的 当前 购买数量
	 *
	 * @param int $int_goodid 商品ID主键
	 * @return int 返回 购买数量
	 */
	public function get_itemnum($int_goodid) {
		if (!$this->has_item($int_goodid)) {
			return 0;
		}
		
		return $this->items[$int_goodid]['num'];		// 返回 购买数量
	}
}
/* var_dump(checkout_library::get_checkout()); */
/* $action = empty($_GET['action']) ? '' : $_GET['action'];
$cart = checkout_library::get_checkout();
if ($action == 'add') {
	$cart->add_item(1, '三八', 23.4, 1);
	echo 'add ok!';
} elseif ($action == 'clear') {
	$cart->clear_allitem();
	echo 'clear ok!';
} elseif ($action == 'show') {
	print_r($cart->get_allitems());
	echo '<br />';
	echo '共 ', $cart->get_allcount(), '种 商品<br />';
	echo '共 ', $cart->get_allnumber(), '个 商品<br />';
	echo '共 ￥', $cart->get_allprice(), ' 钱<br />';
} else {
	print_r($cart);
} */