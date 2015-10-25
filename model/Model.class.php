<?php
/**
 * 抽象 - 各模型的父类
 * 
 * 作用：消除自定义Model的一些重复
 * 
 * @author Chris Wang <zeroShop_author@163.com>
 * @version 1.0
 * @package 抽象类
 * @copyright (c) 2014 CokeSystem Group
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link http://www.Cokeshow.com.cn zeroShop
 * 
 */

defined('ACC')||exit('404 Error for IIS 6.0');

class Model {
	protected $table = NULL;		// 控制的表
	protected $db = NULL;			// mysql操作对象
	// + 加1个属性 pk
	protected $pk = '';				//Primary Key（灵活在外 继承，并自定义）
	// 自动过滤功能的 - 所有字段集数组
	// 手动去mysql用desc命令，拷贝所有字段过来 定了：
	protected $fields = array();
	// 自动填充功能的 - （需要填充的）字段集数组
	// 只对当字段没有传值过来、或无值（空字串）的字段时，起（默认赋值）作用
	// 都是checkbox/radio控件 + 外键：【以后，全在此定义了！！！chris】
	protected $_autofill_fields = array();
	// 自动验证规则
	protected $_autovalid_fields = array();
	/* protected $_autovalid_fields = array(	// 例子：
			array('good_good_name', 1, '非空规则'),
			array('good_good_sn', 1, '非空规则'),
			array('good_good_classid_FK_good_class_id', 1, '整型值'),
			array('good_good_isnew', 0, '值', 1),			// 可能有，可能没有。但如要有则值必是 1。.
			array('good_good_brief', 2, '长度', 100->200),// 不填为空也行，填了也行。但如要填写了值，值必须在约束范围内。.
	); */
	// 提示错误信息
	// 每当验证时，有验证通不过时，就往error数组里添一个单元的错误信息！
	protected $errormsg = array();
	
	
	
	public function __construct() {
		// 把mysql操作对象，赋给自己
		$this->db = mysql::get_ins();	// 单例
	}
	
	public function set_table($table) {
		$this->table = $table;		
	}
	
	/*
	 * 在 model父类 中，写最基本的 增、删、改、查 操作功能！ 
	 */
	/**
	 * 添加
	 * @param array $data 关联数组数据
	 * @return bool 返回执行是否成功
	 */
	public function add($data) {
		return $this->db->auto_execute($this->table,$data,'insert');
	}
	/**
	 * 删除
	 * @param mixed $id 单独一个数字，或逗号隔开的很多数字组合。（一般是 主键）
	 * @return int 返回影响行数
	 */
	public function delete($id) {
		$sql = 'delete from `'. $this->table .'` where `'. $this->pk .'` in ('. $id .')';
		if ($this->db->query($sql)) {
			return $this->db->affected_rows();		// 影响了的行数
		} else {
			return false;
		}
	}
	/**
	 * 修改
	 * @param array $data 关联数组 数据
	 * @param int $id 当前记录ID号
	 * @return int 返回影响行数
	 */
	public function edit($data, $id) {
		$rs = $this->db->auto_execute($this->table,$data,'update','where `'. $this->pk .'`='. $id);
		if ($rs) {
			return $this->db->affected_rows();		// 影响了的行数
		} else {
			return false;
		}
	}
	/**
	 * 查
	 * 先只查询全部记录！以后再完善～
	 * @return array 返回处理后的记录集 - 数组
	 */
	public function select() {
		$sql = 'select * from `'. $this->table .'` order by `'. $this->pk .'` desc';
		return $this->db->get_all($sql);
	}
	/**
	 * 查 一行数据
	 * @param int $id 当前记录ID号
	 * @return array 返回处理后的 单记录数组
	 */
	public function getrow($id) {
		$sql = 'select * from `'. $this->table .'` where `'. $this->pk .'`='. $id;
		return $this->db->get_row($sql);
	}
	
	/*
	 * 在 model父类 中，写最基本的 自动过滤功能！
	*/
	/**
	 * 自动过滤：		—————— 实现非表中的对应字段，自动【删除】！ ———————————————
	 * 负责处理传来的数组。（过滤！）
	 * 清除掉（表）不用的单元，保留下与表中字段 能对应上的单元
	 * 思路：
	 * 循环数组，分辨判断key，是否是表的字段。
	 * 所以需要先有表的字段名先！ 那，表的字段，从何而来？！ --- 【可以从desc 表名 命令中得到；也可手动写好；】以TP为例，两者都行！！！
	 * 建议是： 如果上线稳定了，建议手动写好。 |  如果刚开始开发，就用自动分析吧。
	 * 
	 * 先来个手动的：
	 * @param array $array_request 表单传来的 数据 数组
	 * @return array 返回自动过滤后的数组，去除了不服和表中字段的单元。
	 */
	public function _autofacade($array_request=array()) {
		$data = array();	// 过滤后的（有用）数组
		foreach ($array_request as $k=>$v) {
			// 判断传来的单元，是否“有用”：
			if ( in_array($k, $this->fields) ) {
				// 在我的表字段里时：
				$data[$k] = $v;		// 创建一个数组元素存入$data中（建-值 皆保留）
			}
		}
		
		return $data;
	}
	/**
	 * 自动填充：		—————— 实现没有的字段、或无值（空字串）的字段，自动【赋值】！ ——————
	 * 负责把表中需要的字段，而$_POST又没有传过来的字段，赋上值（默认值）。（填充！）
	 * 如： $_POST中没有good_good_addtime字段，则本函数会自动把 time()函数的值，即该字段之应有的默认值，赋值过来。
	 * 思路：
	 * 首先，并不是所有的列都需要自动填充的！所以，需要定义一下，有那些列，需要自动填充处理的：在上边用属性自己定义。
	 * 
	 * // 都是checkbox/radio控件 + 外键：【以后，全在此定义了！！！chris】
	 * 
	 * @param array $data 应该是 自动过滤 之后的数据数组
	 * @return array 返回自动填充后的数组，。
	 */
	public function _autofill($data) {
		// 只循环针对自己定义好的 数组：
		foreach ($this->_autofill_fields as $v) {
			// 针对：没有传过来的、或 传过来却值为空字符串的。。。进行强制处理！：
			if (!array_key_exists($v[0], $data) || empty($_POST[$v[0]])) { // 增强：处理N值
				// 如果自动过滤数据数组中，没有此字段的传值信息：则赋予默认值
				// 还得 分析 赋值类型！：
				//测试：echo '-------------------'. $v[0] .'-----------------';
				switch ($v[1]) {	// 判断第2个元素的值
					case 'value':
						$data[$v[0]] = $v[2];	// 直接将第3个单元，赋值过来（给当前不存在传值的、正在盯着的字段）即可！～
						break;
					case 'function':
						$data[$v[0]] = call_user_func($v[2]);	// 动态去调用一个函数，回调函数！～
						break;
					default:
						# Do this then.
						break;
				}
			}// if
			
		}
		
		return $data;
	}
	/**
	 * 自动验证：
	 * 分有几种情况：
	 * 1  必检字段。
	 * 2  有字段则检查，没有此字段则不检。  如 性别（没有不检查；有，必是男或女之一的值）
	 * 3  如果有且内容不空，则检查。  如 签名档，非空，则检查其字符串长度
	 * 格式：$this->_autovalid_fields = array(
	 * 	array( '验证的字段名', 0/1/2（验证场景）,'报错提示信息！', 'require/in（某几种情况）/between（范围）/length（某个范围）' )
	 * )
	 * 
	 * @param array $data 自动过滤+填充后的 数据数组
	 * @param array $customvalid_fields 规则数组（可自定义的！）
	 * @return array 返回true为验证通过；false为验证不通过。
	 */
	public function _autovalid($data, $customvalid_fields=NULL) {
		if ($customvalid_fields == null) {
			$customvalid_fields = $this->_autovalid_fields;		// 为了能灵活兼容前台调用 自动验证（默认）
		}
		// 如果验证没通过时，应该有一个对应的错误信息，所以array的设计，多加一个单元 - 错误信息！（属性_autovalid_fields）
		//print_r($data);
		// 如果你没写验证规则：
		if (empty($customvalid_fields)) {
			return true;
		}
		
		// 报错信息 初始化：
		$this->errormsg = array();
		
		// 如果你写了严密的验证规则，我就循环这些 规则：
		foreach ($customvalid_fields as $v) {				// 循环 每一个定义的字段 - 做自定检查：
			//echo '【正在检验' . $v[0] . '中】';
			switch ($v[1]) {	// 判断第2个元素的值
				case 0: 		// 此字段有就判断，没有就算了～
					//echo '---------case 0:----------';
					if (isset($data[$v[0]])) { //有
						// 检查
						// 判断是否符合 自定义的范围条件：
						if ( !$this->check($data[$v[0]], $v[3], $v[4]) ) {
							$this->errormsg[] = $v[2];		//塞进去！
							return false;
						}
					}
					//return true;		//（通过了）
					break;
					
				case 1: 		// 此字段必填～
					//echo '---------case 1:----------';
					if (empty($data[$v[0]])) {
						$this->errormsg[] = $v[2];		//塞进去！
						return false;
					}
					
					// 防止不填后参数时报错的处理：
					if (!isset($v[4])) {
						$v[4] = '';
					}
					
					// 检查
					// 判断是否符合 自定义的范围条件：
					if ( !$this->check($data[$v[0]], $v[3], $v[4]) ) {	// $v[4] 在上边做了处理
						$this->errormsg[] = $v[2];		//塞进去！
						return false;
					}
					//return true;		//（通过了）
					break;
					
				case 2:
					//echo '---------case 2:----------';
					if ( isset($data[$v[0]]) && !empty($data[$v[0]]) ) {
						// 检查
						// 判断是否符合 自定义的范围条件：
						if ( !$this->check($data[$v[0]], $v[3], $v[4]) ) {
							$this->errormsg[] = $v[2];		//塞进去！
							return false;
						}
					}
					//return true;		//（通过了）
					break;
					
				default:
					//echo '---------default:----------';
					# Do this then.
					break;
			}
		}
		
		return true;
	}
	/**
	 * 验证 值 是否符合 规则
	 */
	protected function check($value, $rule='', $parm='') {
		switch ($rule) {
			case 'required':
				//echo '===required:===';
				return !empty($value);		// 验证值是否为空就行了
				break;
			case 'number':
				//echo '===number:===';
				return is_numeric($value);	// 验证值是否为数字就行了
				break;
			case 'email':
				//echo '===email:===';
				return filter_var($value, FILTER_VALIDATE_EMAIL);	// 验证值是否为email格式就行了
				break;
			case 'in':
				//echo '===in:===';
				// 把逗号隔开的字符串，拆成数组：
				$array_tmp = explode(',', $parm);
				//echo '((('. var_dump($array_tmp[0]) .')))';
				// 然后再检查当前的此字段的传值，是否就在（约束范围内）本数组里（数组的所有项的值就是取值范围）！：
				return in_array($value, $array_tmp);
				break;
			case 'between':
				//echo '===between:===';
				// 把逗号隔开的字符串，拆成数组：
				list($min, $max) = explode(',', $parm);		// 把数组的2个项，分别赋给 list中的2个值
				return $value>=$min && $value<=$max;
				break;
			case 'length':
				//echo '===length:===';
				// 把逗号隔开的字符串，拆成数组：
				list($min, $max) = explode(',', $parm);		// 把数组的2个项，分别赋给 list中的2个值
				return mb_strlen($value)>=$min && mb_strlen($value)<=$max;
				break;
			default:
				//echo '===default:===';
				# 如到此处，可能验证规则有问题了：
				return false;
				break;
		}
	}
	/**
	 * 输出错误信息
	 */
	public function get_errormsg() {
		foreach ($this->errormsg as $v) {
			return '['. $v .'] ';
		}
	}
}