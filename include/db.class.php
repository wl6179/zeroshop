<?php
/**
 * 抽象 - 各数据库的父类
 * 
 * 作用：不清楚数据库类型时，只写一个抽象类
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

abstract class db {
	/**
	 * 连接服务器
	 * @param string $h 服务器地址
	 * @param string $u 用户名
	 * @param string $p 密码
	 * @return bool 成功与否
	 * @access private
	 */
	public abstract function connect($h,$u,$p);
	
	/**
	 * 发送SQL查询
	 * @param string $sql DML型查询语句
	 * @return mixed 正常情况下 返回 对象或布尔值
	 * @access private
	 */
	public abstract function query($sql);
	
	/**
	 * 查询多行数据
	 * 例如：列表页
	 * @param string $sql select型查询语句
	 * @return mixed 正常情况下 返回 数组或false
	 * @access private
	 */
	public abstract function get_all($sql);
	
	/**
	 * 查询单行数据
	 * 例如：详情页
	 * @param string $sql select型查询语句
	 * @return mixed 正常情况下 返回 数组或false
	 * @access private
	 */
	public abstract function get_row($sql);
	
	/**
	 * 查询单个数据
	 * 例如：统计数量
	 * @param string $sql select型查询语句
	 * @return mixed 正常情况下 返回 数组或false
	 * @access private
	 */
	public abstract function get_one($sql);
	
	
	/**
	 * 自动执行insert/update语句
	 * 例如：auto_execute('user',array('username'=>'zhangsan','email'=>'zhang@163.com'),'insert')
	 * 结果：将自动形成 insert into user (username,email) valuses ('zhangsan','zhang@163.com');
	 * 注意：insert执行方法，是不需要$where参数的！（只有update时才用$where参数）
	 * @param string $table 表名
	 * @param string $data 数组
	 * @param string $act 执行方法
	 * @param string $where where条件
	 * @return bool 返回是否成功
	 * @access private
	 */
	public abstract function auto_execute($table,$data,$act='insert',$where);
}