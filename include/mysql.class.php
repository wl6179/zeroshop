<?php
/**
 * MySQL 类
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

/**
 * MySQL类
 * 
 * 继承自DB父类
 */
class mysql extends db {
	private static $ins = NULL;
	private $conn = NULL;
	private $conf = array();
	
	protected function __construct() {
		$this->conf = conf::get_ins();
		
		$this->connect($this->conf->host,$this->conf->user,$this->conf->pwd);
		$this->select_db($this->conf->db);
		$this->set_char($this->conf->char);
    }
	
	public function __destruct() {
	}
	
	public function __clone() {
	}
	
	public static function get_ins() {
		if(!(self::$ins instanceof self)) {
			self::$ins = new self();
		}
		
		return self::$ins;
	}
	
	public function connect($h,$u,$p) {
		$this->conn = mysqli_connect($h,$u,$p);
		if(!$this->conn) {
			$err = new Exception('连接失败');	//创建新异常
			throw $err;			// 报出异常
		}
	}
	
	protected function select_db($db) {
		$sql = 'use ' . $db;
		$this->query($sql);
	}
	
	protected function set_char($char) {
		$sql = 'set names ' . $char;
		return $this->query($sql);
	}
	
	/**
	 * 执行SQL语句，获得原始资源对象
	 * 适合：不需要返回值的查询；或仅仅需要直接返回“赤裸”资源对象来自行处理的底层函数。
	 * (non-PHPdoc)
	 * @see db::query()
	 * @param string $sql SQL查询语句
	 * @return mixed 返回错误false，或查询获取的资源对象
	 */
	public function query($sql) {
		$rs = mysqli_query($this->conn,$sql);

		log::write($sql);		// 写入日志！

		return $rs;
	}
	
	/**
	* 半自动化处理数据请求
	* 特殊字段的例子：（注意是针对：$_POST传参而作）
	* $data['x_FK_good_class_id'] = empty($_POST['x_FK_good_class_id'])?NULL:$_POST['x_FK_good_class_id'];
	* (non-PHPdoc)
	* @see db::auto_execute()
	* @param string $table 表名
	* @param array $arr 数据e数组
	* @param string $mode 操作模式，新增or更新
	* @param string $where 筛选条件
	* @return bool 返回是否已正确执行，因为只有Insert和Update语句两种
	*/
	public function auto_execute($table,$arr,$mode='insert',$where = ' where 1 limit 1') {
		if(!is_array($arr)) {
			return false;
		}
		
		// 如果是update模式：
		if($mode == 'update') {
			$sql = 'update `'. $table .'` set ';
			foreach($arr as $k=>$v) {
				if (is_null($v)) {	// 特殊的NULL值类型时，处理之chris
					$sql .= "`". $k ."`=NULL,";	// 不是 IS NULL!而是 =NULL
				} else {				// 普通通用的值类型时：
					$sql .= "`". $k ."`='". $v ."',";
				}
			}
			$sql = rtrim($sql,',');
			$sql .= ' '. $where;
			
			return $this->query($sql);
		}
		
		// 如果是insert模式：
		$sql = 'insert into `'. $table .'` (`'. implode('`,`', array_keys($arr)) .'`)'; // 
		//$sql .= ' values (\'';
		//$sql .= implode("','", array_values($arr));		// 注意，别在双引号里用 反斜杠\，因为它并不会在双引号下起转义作用！chris
		//$sql .= '\')';
		$sql .= ' values (';
		foreach($arr as $k=>$v) {
			if (is_null($v)) {	// 特殊的NULL值类型时，处理之chris
				$sql .= "NULL,";
			} else {				// 普通通用的值类型时：
				$sql .= "'". $v ."',";
			}
		}
		$sql = rtrim($sql,',');
		$sql .= ')';
		
		return $this->query($sql);
	}
	
	/**
	 * 执行SQL语句，获取整个记录集数组【与query比，此处已加工成了数组】
	 * 说明：返回值经过了处理，为数组。
	 * (non-PHPdoc)
	 * @see db::get_all()
	 * @param string $sql SQL查询语句
	 * @return array 返回空数组，或记录集数组
	 */
	public function get_all($sql) {
		$rs = $this->query($sql);
        
		$list = array();
		while($row = mysqli_fetch_assoc($rs)) {
			$list[] = $row;
		}
		
		return $list;
	}
	
	/**
	 * 执行SQL语句，获取单个记录行，为一个单数组
	 * 说明：返回值经过了处理，为数组。
	 * (non-PHPdoc)
	 * @see db::get_row()
	 * @param string $sql SQL查询语句，一般用在 详情页查询
	 * @return array 返回NULL，或一个单数组
	 */
	public function get_row($sql) {
		$rs = $this->query($sql);
		
		return mysqli_fetch_assoc($rs);	//（关联数组式）没有记录时结果为NULL
	}
	
	/**
	 * 执行SQL语句，获取单个记录中的单个列的值，为一个数字或字符
	 * 说明：返回值经过了处理，为数字或字符。
	 * (non-PHPdoc)
	 * @see db::get_one()
	 * @param string $sql SQL查询语句，一般用在 1个统计聚合值的查询
	 * @return array 返回NULL，或一个数字或字符
	 */
	public function get_one($sql) {
		$rs = $this->query($sql);
		$row = mysqli_fetch_row($rs);		//（数字（枚举）数组式）没有记录时结果为NULL
		
		return $row[0];
	}
	
	/**
	 * 返回影响行数的函数
	 * @return int 返回一个影响行数的数字
	 */
	public function affected_rows() {
		return mysqli_affected_rows($this->conn);
	}
	
	/**
	 * 返回最新插入的auto_increment列的自增长的值
	 * @return int 返回上一步INSERT语句操作，所产生的自增长（主键）的ID值
	 */
	public function inserted_id() {
		return mysqli_insert_id($this->conn);
	}
	
}