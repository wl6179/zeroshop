<?php
/**
 * 商品 模型
 * 
 * @author Chris Wang <zeroShop_author@163.com>
 * @version 1.0
 * @package 模型M
 * @copyright (c) 2014 CokeSystem Group
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link http://www.Cokeshow.com.cn zeroShop
 * 
 */

defined('ACC')||exit('404 Error for IIS 6.0');

class GoodGoodModel extends Model {
	protected $table = 'good_good';
	protected $pk = 'good_good_id';
	// 自动过滤功能的 - 所有字段集数组
	// 手动去mysql用desc命令，拷贝所有字段过来 定了：
	protected $fields = array("good_good_sn",
			"good_good_classid_FK_good_class_id",
			"good_good_brandid_FK_good_brand_id",
			"good_good_name",
			"good_good_shopprice",
			"good_good_marketprice",
			"good_good_stocknum",
			"good_good_click",
			"good_good_weight",
			"good_good_brief",
			"good_good_desc",
			"good_good_thumbimage",
			"good_good_goodimage",
			"good_good_originalimage",
			"good_good_isonsale",
			"good_good_isdeleted",
			"good_good_isbest",
			"good_good_isnew",
			"good_good_ishot",
			"good_good_addtime",
			"good_good_lastupdate"
	);
	// 自动填充功能的 - （需要填充的）字段集数组
	// 只对当字段没有传值过来、或无值（空字串）的字段时，起（默认赋值）作用
	// 都是checkbox/radio控件 + 外键：【以后，全在此定义了！！！chris】
	protected $_autofill_fields = array(
			array('good_good_classid_FK_good_class_id', 'value', NULL),		// 外建
			array('good_good_brandid_FK_good_brand_id', 'value', NULL),		// 外建
			array('good_good_isonsale', 'value', NULL),		// 要针对哪些列做填充（value指固定值，值是NULL）
			array('good_good_ishot', 'value', NULL),			// 要针对哪些列做填充（value指固定值，值是NULL）
			array('good_good_isnew', 'value', NULL),			// 要针对哪些列做填充（value指固定值，值是NULL）
			array('good_good_isbest', 'value', NULL)			// 要针对哪些列做填充（value指固定值，值是NULL）
			//array('good_good_addtime', 'function', 'time')	// 要针对哪些列做填充（value指 函数返回值，值是time()）
	);
	// 自动验证规则
	// 参数1：字段名
	// 参数2：验证场景 （0 - 有字段域时才验证哟；   1 - 必须验证；   2 - 有字段域且填写了值不为空字符串时才验证；）
	// 参数3：验证规则
	protected $_autovalid_fields = array(
			array('good_good_name', 1, '必须填 商品名称', 'required', ''),	// 必填项
			array('good_good_sn', 0, '商品编号 必须是数字', 'number', ''),
			array('good_good_classid_FK_good_class_id', 0, '所属分类 必须是数字', 'number', ''),
			array('good_good_brandid_FK_good_brand_id', 0, '所属品牌 必须是数字', 'number', ''),
			array('good_good_shopprice', 1, '本店售价 必须是数字', 'number', ''),
			array('good_good_marketprice', 1, '市场价格 必须是数字', 'number', ''),
			array('good_good_stocknum', 1, '商品库存 必须是整型值', 'number', ''),
			array('good_good_weight', 1, '商品重量 必须是整型值', 'number', ''),
			array('good_good_brief', 2, '商品摘要信息长度要 在10到100字符之内', 'length', '10,100'),// 不填为空也行，填了也行。但如要填写了值，值必须在约束范围内。.
			array('good_good_desc', 2, '商品说明信息长度要 在10到500字符之内', 'length', '10,500'),
			array('good_good_originalimage', 2, '上传图片 长度要 在10到30字符之内', 'length', '10,30'),
			array('good_good_isonsale', 0, '是否上架 只能是1值', 'in', '1'),
			array('good_good_isbest', 0, '是否精品 只能是1值', 'in', '1'),
			array('good_good_ishot', 0, '是否热销 只能是1值', 'in', '1'),
			array('good_good_isnew', 0, '是否新品 只能是1值', 'in', '1'),			// 可能有，可能没有。但如要有则值必是 1。.
			
	);
	
	/**
	 * 放到 回收站
	 * @param int $id
	 * @return bool
	 */
	public  function  trash($id) {
		return $this->edit(array('good_good_isdeleted'=>1), $id);
	}
	
	/**
	 * 自动创建商品货号（不许重复）
	 * 
	 * @return string 返回随机商品货号
	 */
	public  function  create_sn() {
		$sn = ''. date('Ymd') . mt_rand(10000, 99999);
		// 检验一下数据库有无重复的
		$sql = 'select count(*) from `'. $this->table .'` where `good_good_sn`="'. $sn .'"';
		return $this->db->get_one($sql) ? $this->create_sn() : $sn;		// 递归
	}
	
	/**
	 * 列表
	 * 
	 * 作用：获取本表的所有数据 & 查询筛选
	 * @param array $array_where 需要查询的数据
	 * @param mixed $mixed_limit 偏移量、（本页）显示记录条数 - 默认0,50
	 * @param string $str_orderby 排序规则
	 * @return array|bool 返回数据数组 或false
	 */
	public function select($array_where = array(), $mixed_limit = '0,500', $str_orderby=null) {
		// 重新定义 自动验证 规则：（自定义）
		$customvalid_fields = array(
				array('good_good_id', 2, 'ID号 必须是数字', 'number', ''),
				array('good_good_name', 2, '商品名 且在1到10字符之内', 'length', '1,10'),
				array('good_good_sn', 2, '商品编号 必须是数字', 'number', ''),
				array('good_good_classid_FK_good_class_id', 2, '所属分类 必须是数字', 'number', ''),
		);
		
		// 新 - 自动检验（自定义）
		if (!$this->_autovalid($array_where, $customvalid_fields)) {
			// 如果检验没通过：
			$msg = '没通过检验：<br />'. $this->get_errormsg();
			include ROOT .'view/templates/login_web2/view.message.show.php';
			exit();
		}
		
		// 应变嘛
		$str_where = '';
		if (array_key_exists('good_good_id', $array_where) && $array_where['good_good_id']!=='') {
			$str_where .= ' and `good_good_id`='. $array_where['good_good_id'];
		}
		if (array_key_exists('good_good_name', $array_where) && $array_where['good_good_name']!=='') {
			$str_where .= ' and `good_good_name` like \'%'. $array_where['good_good_name'] .'%\'';
		}
		if (array_key_exists('good_good_sn', $array_where) && $array_where['good_good_sn']!=='') {
			$str_where .= ' and `good_good_sn` like \'%'. $array_where['good_good_sn'] .'%\'';
		}
		if (array_key_exists('good_good_classid_FK_good_class_id', $array_where) && $array_where['good_good_classid_FK_good_class_id']!=='') {
			$str_where .= ' and good_good_classid_FK_good_class_id in ('. $this->getstring_subclassid($array_where['good_good_classid_FK_good_class_id']) .')';
		}
		// 排序
		switch ($str_orderby) {
			case 'asc':
				$str_orderby = ' order by '. $this->pk .'';
			case 'desc':
				$str_orderby = ' order by '. $this->pk .' desc';
				break;
			case ('time'):
				$str_orderby = ' order by '. $this->table .'_addtime';
				break;
			case 'timedesc':
				$str_orderby = ' order by '. $this->table .'_addtime desc';
				break;
			default:
				$str_orderby = ' order by '. $this->pk .' desc';
				break;
		}
		$sql = 'select good_good_id, good_good_name, good_good_sn
					, good_good_shopprice, good_good_marketprice, good_good_stocknum
					, good_good_weight, good_good_isonsale, good_good_isbest
					, good_good_isnew, good_good_ishot, good_good_thumbimage
					, good_good_brief, good_good_desc
				from `'. $this->table .'`
				where 1
				'. $str_where . $str_orderby .' limit '. $mixed_limit;
		
		return $this->db->get_all($sql);
	}
	
	/**
	 * 生成子孙树id号（包括自己）
	 * 
	 * 用在获取指定某栏目下的商品（包括其 子孙 树）的场景
	 * @param int $int_classid ‘父’类id号
	 * @return string 拼接好的所有子孙树id号
	 */
	public function getstring_subclassid($int_classid) {
		// 先把当前栏目的所有 子孙 栏目一次性的取完！：
		$model_good_class = new GoodClassModel();
		$rsarray_good_class_all = $model_good_class->select();
		//【格式化一下数据】
		// 排列好
		$rsarray_good_class_sontree = $model_good_class->get_class_tree($rsarray_good_class_all, $int_classid);
		// （$int_classid 的子孙树）
		
		$sub = array($int_classid);	// 自身 也放进sub里！
		if (!empty($rsarray_good_class_sontree)) {
			foreach ($rsarray_good_class_sontree as $v) {
				$sub[] = $v['good_class_id'];
			}
		}
		// 返回逗号拼接好的id集
		return implode(',', $sub);		// 凑成字符串
		
	}
	
	/**
	 * 根据购物车中商品集，返回更详尽信息的 数据数组！!!!!! !!!!!!!!!!!!!!! !!!!!!!
	 * 
	 * @param array $items 传入购物车商品集合 数据数组 进来！
	 * @return array 返回 更详细的商品之 数据数组！
	 */
	public function get_checkoutgoods($array_items) {
		$ids = array();
		// 循环购物车内商品id s
		/* foreach ($array_items as $k=>$v) {
			$ids[] = $k; 	// 把购物车中商品的id，都集中到$ids临时数组中去先！
		} */
		// 取代上边的foreach循环 -- 熟练实用函数 array_keys ********************
		$ids = array_keys($array_items);
		
		// 判断当前（购物车中）是否有数据
		if (empty($array_items)) {
			return false;
		}
		
		$sql = 'select good_good_id, good_good_classid_FK_good_class_id, good_good_name
						,good_good_shopprice, good_good_marketprice, good_good_stocknum, good_good_weight
						,good_good_thumbimage, good_good_isdeleted 
				from `'. $this->table .'`
				where 1 
						and `'. $this->pk .'` in ('. implode(',', $ids) .')
				';
		
		return $this->db->get_all($sql);
	}
}