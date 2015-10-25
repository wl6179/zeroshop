<?php
/**
 * 帐号 模型
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

class UserUserModel extends Model {
	protected $table = 'user_user';
	protected $pk = 'user_user_id';
	// 自动过滤功能的 - 所有字段集数组
	protected $fields = array("user_user_id",
			"user_user_username",
			"user_user_password",
			"user_user_email",
			"user_user_thumbimage",
			"user_user_originalimage",
			"user_user_level",
			"user_user_isdeleted",
			"user_user_addtime",
			"user_user_lastupdate",
			"user_user_lastlogin",
	);
	// 自动填充功能的 - （需要填充的）字段集数组
	// 只对当字段没有传值过来、或无值（空字串）的字段时，起（默认赋值）作用
	// 都是checkbox/radio控件 + 外键：【以后，全在此定义了！！！chris】
	protected $_autofill_fields = array(
			array('user_user_originalimage', 'value', ''),		// 
			//array('good_good_brandid_FK_good_brand_id', 'value', NULL),		// 外建
			//array('good_good_isonsale', 'value', NULL),		// 要针对哪些列做填充（value指固定值，值是NULL）
			array('user_user_lastlogin', 'function', 'get_datetime')	// 要针对哪些列做填充（value指 函数返回值，值是time()）
	);
	// 自动验证规则
	// 参数1：字段名
	// 参数2：验证场景 （0 - 有字段域时才验证哟；   1 - 必须验证；   2 - 有字段域且填写了值不为空字符串时才验证；）
	// 参数3：验证规则
	protected $_autovalid_fields = array(
			array('user_user_id', 2, 'ID 必须是数字', 'number', ''),	// 必填项
			array('user_user_username', 1, '帐号必填，且在6到16字符之内', 'length', '6,16'),
			array('user_user_password', 1, '密码必填，且在6到16字符之内', 'length', '6,16'),
			//array('good_good_brandid_FK_good_brand_id', 0, '所属品牌 必须是数字', 'number', ''),
			array('user_user_email', 1, 'email格式不对', 'email', ''),
			array('user_user_thumbimage', 2, '缩略图 长度要 在10到30字符之内', 'length', '10,30'),
			array('user_user_originalimage', 2, '上传图片 长度要 在10到30字符之内', 'length', '10,30'),
			array('user_user_level', 2, '帐号的级别 必须是数字', 'number', ''),
			
	);
	
	/**
	 * 注册add（特殊）处理
	 * 
	 * 关键就是（先）做一下处理【解决掉密码是明码的问题】，再调用（回）add方法！
	 * 场景：
	 * encode_passwd($p)导致了，不能在默认的调用model父类中的add方法注册了！ 只能另外写一个reg方法了！！～
	 * @param int $id
	 * @return bool
	 */
	public function reg($data) {
		// 关键就是（先）做一下处理
		if ($data['user_user_password']) {
			// 如果有 user_user_password 字段单元（在$data中），则处理之！！（就在$data里处理好了）
			$data['user_user_password'] = $this->encode_passwd($data['user_user_password']); // 加密覆盖原值！chris
		}
		
		// * 重返 add 方法
		return $this->add($data);		// 裹一层处理，立即又回到add方法中！！！～～～（去该一下调用为reg吧）
	}
	
	/**
	 * md5加密密码
	 * 
	 * 场景：
	 * 导致了，不能在默认的调用model父类中的add方法注册了！ 只能另外写一个reg方法了！！～
	 * @param string $passwd 明文密码
	 * @return string 返回md5加密后的密码信息
	 */
	protected function encode_passwd($passwd) {
		return md5($passwd);
	}
	
	/**
	 * 检查用户名是否存在
	 * 
	 * @param string $username 用户帐号
	 * @return boolean 返回是否存在
	 */
	public function ishave_username($username) {
		$sql = 'select count(*) from `'. $this->table .'` where `user_user_username`=\''. $username .'\'';
		return $this->db->get_one($sql);
	}
	
	/**
	 * 检测登录
	 * 
	 * @param string $u 帐号
	 * @param string $p 密码
	 * @return boolean 返回登录是否正确
	 */
	public function check_user($u, $p) {
		$sql = 'SELECT
					user_user_username,
					user_user_password,
					user_user_email,
					user_user_level
				FROM `'. $this->table .'`
				where `user_user_username`=\''. $u .'\'
				';
		$row = $this->db->get_row($sql);
		
		// 判断比较一下password
		if (empty($row)) {
			// 帐号不存在
			return false;
		}
		
		if ($row['user_user_password'] !== $this->encode_passwd($p)) {
			// 密码不正确
			return false;
		}
		
		// 安全切除 password
		unset($row['user_user_password']);		// <-------------- 安全
		return $row;
	}
}