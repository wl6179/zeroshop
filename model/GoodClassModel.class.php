<?php
/**
 * 商品栏目 模型
 * 
 * 问题1： 分类可以选择自己的子类为父类，这点漏洞会引起逻辑混乱！ So，需要改进代码解决此问题，做限制！（互为父子）
 * 问题2： 有子栏目时，应该是不能删除的
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

class GoodClassModel extends Model {
	protected $table = 'good_class';
	protected $pk = 'good_class_id';
	// 自动过滤功能的 - 所有字段集数组
	// 手动去mysql用desc命令，拷贝所有字段过来 定了：
	protected $fields = array("good_class_name",
			"good_class_readme",
			"good_class_parentid_FK_good_class_id",
			"good_class_addtime",
			"good_class_lastupdate"
	);
	// 自动填充功能的 - （需要填充的）字段集数组
	// 只对当字段没有传值过来、或无值（空字串）的字段时，起（默认赋值）作用
	// 都是checkbox/radio控件 + 外键：【以后，全在此定义了！！！chris】
	protected $_autofill_fields = array(
			array('good_class_parentid_FK_good_class_id', 'value', NULL),		// 外建
			//array('good_good_isbest', 'value', NULL)			// 要针对哪些列做填充（value指固定值，值是NULL）
			//array('good_good_addtime', 'function', 'time')	// 要针对哪些列做填充（value指 函数返回值，值是time()）
	);
	// 自动验证规则
	// 参数1：字段名
	// 参数2：验证场景 （0 - 有字段域时才验证哟；   1 - 必须验证；   2 - 有字段域且填写了值不为空字符串时才验证；）
	// 参数3：验证规则
	protected $_autovalid_fields = array(
			array('good_class_name', 1, '名称长度要 在2到20字符之内', 'length', '2,20'),	// 必填项
			array('good_class_parentid_FK_good_class_id', 0, '上级分类 必须是数字', 'number', ''),
			//array('good_good_shopprice', 1, '本店售价 必须是数字', 'number', ''),
			array('good_class_readme', 2, '介绍信息长度要 在10到100字符之内', 'length', '10,100'),
			//array('good_good_isonsale', 0, '是否上架 只能是1值', 'in', '1'),
			
	);
	
	/**
	 * 列表
	 * 
	 * 作用：获取本表的所有数据 & 查询筛选
	 * @param array $array_where 需要查询的数据
	 * @param int $int_limit 记录条数
	 * @param string $str_orderby 排序规则
	 * @return array|bool 返回数据数组 或false
	 */
	public function select($array_where = array(), $mixed_limit = '0,500', $str_orderby=null) {
		// 重新定义 自动验证 规则：（自定义）
		$customvalid_fields = array(
				array('good_class_id', 2, 'ID号 必须是数字', 'number', ''),
				array('good_class_name', 2, '栏目名 且在1到10字符之内', 'length', '1,10'),
				array('good_class_readme', 2, '栏目简介 且在1到10字符之内', 'length', '1,10'),
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
		if (array_key_exists('good_class_id', $array_where) && $array_where['good_class_id']!=='') {
			$str_where .= ' and good_class_id='. $array_where['good_class_id'];
		}
		if (array_key_exists('good_class_name', $array_where) && $array_where['good_class_name']!=='') {
			$str_where .= ' and good_class_name like \'%'. $array_where['good_class_name'] .'%\'';
		}
		if (array_key_exists('good_class_readme', $array_where) && $array_where['good_class_readme']!=='') {
			$str_where .= ' and good_class_readme like \'%'. $array_where['good_class_readme'] .'%\'';
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
				$str_orderby = ' order by '. $this->pk .'';
				break;
		}
		
		$sql = 'select good_class_id,good_class_name,good_class_parentid_FK_good_class_id,good_class_readme
				from `'. $this->table .'`
				where 1
				'. $str_where . $str_orderby .' limit '. $mixed_limit;
		
		return $this->db->get_all($sql);
	}
	/**
	 * 返回 子孙树
	 * @param array $arr 栏目的全部数据
	 * @param int $id 指定ID（是父id）
	 * @param int $lev 当前分类深度
	 * @return array 指定ID的子孙树
	 */
	public function get_class_tree($arr, $id = 0, $lev = 0) {
		// 获得所有的栏目数据；（放在外围更方便每次调用！）
		// $arr  		# 因为外边Controllor中的list，会定义有 所有的栏目数据，所以直接传参进来即可。
		
		$tree = array();
		// 咱用递归来排序（排出它的子孙树）
		foreach ($arr as $v) {
			if ($v['good_class_parentid_FK_good_class_id'] == $id) {	//查找并筛选parentid是$id号的（其$id号的儿子）类
				$v['lev'] = $lev;		//赋值（且并入此$v数组中）
				//找到了～就先给它塞到$tree里边去！
				$tree[] = $v;
				//那它还有每有子类呢？不知到。就再 递归的 找一下呗！～[找$v的下一级！]
				// 返回了继续给我 塞到 $tree里边！～
				$tree = array_merge($tree, $this->get_class_tree($arr, $v['good_class_id'], $lev+1));	//[找$v的下一级！] - parentid为$v的id（的（子）类（们））。
			}
		}
		
		return $tree;		
	}
	
	/**
	 * 返回 子栏目
	 * （除了用来判断 是否有子栏目删除时 外；还能留着以后使用）
	 * @param int $id 当前栏目ID
	 * @return array 指定ID的子栏目
	 */
	public function get_class_sons($id) {
		$sql = 'select `good_class_id`,`good_class_name`,`good_class_parentid_FK_good_class_id`
				from `'. $this->table .'`
				where `good_class_parentid_FK_good_class_id`='. $id;
		return $this->db->get_all($sql);
	}
	
	/**
	 * 返回 家谱树
	 * 对于edit栏目时：
	 * 我们为A栏目设定一个新的父栏目N 时。我们可以先查看N 的家谱树里，如果有A存在，则子孙差辈了！
	 * @param array $arr 栏目的全部数据
	 * @param int $id 指定ID
	 * @return array 指定ID的家谱树
	 */
	public function get_class_parenttree($arr, $id = 0) {
		// 获得所有的栏目数据；（放在外围更方便每次调用！）
		// $arr  		# 因为外边Controllor中的list，会定义有 所有的栏目数据，所以直接传参进来即可。
	
		$tree = array();
		// 咱用递归来排序（排出它的家谱树）
		foreach ($arr as $v) {
			// 先把它(自身)拿出来：
			if ($v['good_class_id'] == $id) {
				//找到了～就先给它塞到$tree里边去！
				$tree[] = $v;
				//那它还有没有上级呢？不知道。就再 递归的 找一下呗！～[找$v的上一级！]
				// 如返回了继续给我 塞到 $tree里边！～
				$tree = array_merge($tree, $this->get_class_parenttree($arr, $v['good_class_parentid_FK_good_class_id']));
				//[找$v的下一级！] - parentid为$v的id（的（子）类（们））。
			}
		}
		
		//迭代法：
		/* while ($v['good_class_id'] > 0) {
			foreach ($arr as $v) {
				// 先把它(自身)拿出来：
				if ($v['good_class_id'] == $id) {
					$tree[] = $v;
					
					$id = $v['good_class_parentid_FK_good_class_id'];
					break;
				}
			}
		} */
		
		return array_reverse($tree);
	}
	
	
}