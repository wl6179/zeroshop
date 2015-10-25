<?php
/**
 * 单文件上传类
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

/**
 * 单上传类
 * 
 * 功能要求：
 * 1 上传文件；
 * 2 可配置允许的后缀；
 * 3 可配置允许的大小；
 * 
 * 
 * 获取文件后缀；+ 判断文件后缀；
 * 良好的报错支持；
 * 随机生成目录；+ 随机生成文件名；
 */
class upfile_single_library {
	protected $allow_ext = 'jpg,jpeg,gif,bmp,png';
	protected $maxsize_perfile = 1;	// 单位：MB
	protected $file = NULL;		// 准备储存上传文件信息用的，方便索取；
	
	// 良好的错误支持 ——— 错误代码
	protected $errno = 0;
	protected $error = array(
			0=>'无错',
			1=>'上传文件超出系统限制',
			2=>'上传文件大小超出网页表单限制',
			3=>'上传文件只有部分被上传',
			4=>'没有文件被上传',
			6=>'找不到临时目录',
			7=>'文件写入失败',
			8=>'不允许的 文件后缀',				// 自定义！
			9=>'文件大小超出类的允许范围',		// 自定义！
			10=>'创建目录失败',					// 自定义！
			11=>'移动文件 失败'					// 自定义！
	);
	
	/**
	 * 获取上传文件信息
	 * 
	 * 根据表单控件名，获得上传的“临时文件”的信息数组
	 * 
	 * @param string $key 表单域中的字段名
	 * @return 无返回值！ 赋值给属性file一个上传数据一个数组（根据表单域的字段名）！
	 */
	protected function get_file($key) {
		$this->file = $_FILES[$key];
	}
	
	/**
	 * 获取文件后缀
	 * 
	 * 给我一个文件名，我帮得出它的后缀
	 * 
	 * @param string $file 文件名
	 * @return string 后缀名
	 */
	protected function get_ext($file) {
		$array_tmp = explode('.', $file);
		return end($array_tmp);
	}
	
	/**
	 * 检查后缀
	 * 
	 * 判断后缀是否合法
	 * 
	 * @param string $ext 后缀
	 * @return boolean 是否合法
	 */
	protected function is_allow_ext($ext) {
		/* print_r(explode(',', $this-> allow_ext));
		print_r($ext);
		exit(); */
		// 注意：要防止大小写的问题：strtolower
		return in_array(strtolower($ext), explode(',', $this->allow_ext));;
	}
	
	/**
	 * 检查大小
	 * 
	 * 判断大小是否超范围
	 * 
	 * @param int $size 当前上传文件的大小信息
	 * @return bool 返回符合大小检查与否
	 */
	protected function is_maxsize_perfile($size) {
		return $size <= $this->maxsize_perfile * 1024 * 1024;	// 
	}
	
	/**
	 * 上传
	 * 
	 * @param string $key 表单域中的字段名
	 * @return mixed 返回上传成功后的路径字符串；或上传失败的false；  
	 */
	public function up($key) {
		if (!isset($_FILES[$key])) {
			return false;
		}
		
		// 获得文件信息
		$this->get_file($key);		
		// 获得 ： $this->file['name']、$this->file['tmp_name']、$this->file['size']...
		
		// 系统级别的“出错”捕捉：
		if ($this->file['error']) {
			$this->errno = $this->file['error'];	// 
		}
		
		// 检查后缀：
		$ext = $this->get_ext($this->file['name']);	// 获取后缀。源文件名 -> 后缀
		if (!$this->is_allow_ext($ext)) {
			$this->errno = 8;		/// 8=>'不允许的 文件后缀',				// 自定义！
			return false;
		}
		
		// 检查大小：
		if (!$this->is_maxsize_perfile( $this->file['size']) ) {
			$this->errno = 9;		/// 9=>'文件大小超出类的允许范围',		// 自定义！
			return false;
		}
		
		// 创建目录
		$dir = $this->mk_dir();
		if ($dir == false) {
			$this->errno = 10;	/// 10=>'创建目录失败',					// 自定义！
			return false;
		}
		
		// 生成随机文件名
		$newname = $this->rand_name() .'.'. $ext;
		
		// 移动文件
		if (!move_uploaded_file($this->file['tmp_name'], $dir .'/'. $newname)) {
			$this->errno = 11;	/// 11=>'移动文件 失败',				// 自定义！
			return false;
		}
		
		//return end( explode("/image/", ($dir .'/'. $newname)) );
		return str_replace(ROOT, '', ($dir .'/'. $newname));
	}
	
	/**
	 * 创建 最新日期 目录
	 * 
	 * @return mixed 返回创建好的目录名字符串；或返回false;
	 */
	protected function mk_dir() {
		// 即将创建的目录名：
		$dir = ROOT .'data/image/'. date('Ym/d');		// 
		
		// 看看目录是否存在
		if (is_dir($dir) || mkdir($dir, 0777, true)) {
			return $dir;
		} else {
			return false;		//没有创建目录成功～
		}
	}
	
	/**
	 * 创建随机文件名
	 * 
	 * @param int $length 生成随机名的长度
	 * @return string 返回随机名字符串
	 */
	protected function rand_name($length = 6) {
		$str = 'abcdefghijkmnpqrstuvwxyz23456789';
		// 打乱
		return substr(str_shuffle($str), 0, $length);
	}
	
	/**
	 * 获取错误
	 * 
	 * @return string 从自定义的错误信息数组中，通过属性errno返回对应的关联数组的值（即错误信息字符串）
	 */
	public function get_err() {
		return $this->error[$this->errno];
	}
	
	/**
	 * （动态配置）ext后缀
	 * 
	 * @param string $exts 允许的ext后缀
	 */
	public function set_ext($exts) {
		$this->allow_ext = $exts;
	}
	/**
	 * （动态配置）文件大小
	 * 
	 * @param int $sizenum 重置最大文件大小限制
	 */
	public function set_size($sizenum) {
		$this->maxsize_perfile = $sizenum;
	}
}