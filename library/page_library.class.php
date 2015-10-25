<?php
/**
 * 分页类
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
 * 分页类
 * 
 * 分析：
 * 5条商品，
 * 每页显示2条
 * 
 * 显示几页
 * 3 		#（总条数/每页2条 + 1）
 * 第1页显示第几条，到第几条
 * 1～2  	#（上一页尽头 + 1）～（本页尽头<即当前页数 * 每页2条>）
 * 第2页显示第几条，到第几条
 * 3～4 	# 同上
 * 
 * 
 * 分页原理的三个变量，两个公式：
 * 三个变量
 * 总条数：		$page_number_total
 * 每页条数：	$page_number_perpage
 * 当前页：		$page
 * 两个公式
 * 总页数：		$page_pages_count = ceil($page_number_total/$page_number_perpage) 		# 向上取整！不需要+1了
 * 第$page页，显示第几条，到第几条？
 * 答：第$page页，表示已经跳过了 $page-1 页了，每页又是$page_number_perpage条，所以跳过了($page-1) * $page_number_perpage 条！
 * 		，即从 ($page-1) * $page_number_perpage  +  1 条开始，（到）取$page_number_perpage条出来！就是当前$page页。
 * 
 * 分页导航的生成：
 * 	例 可能性：
 * list.php
 * list.php?classid=3
 * list.php?classid=3&page=1
 * list.php?page=1
 * 分页导航里
 * [1][2] 3 [4][5]
 * 在生成的分页导航里，除了要根据页码page来生成以外，还要同时不能把其它参数搞丢！，如classid等～
 * So，先把它保存起来，免得丢失。
 * 
 * 调用分页类 例子：
 * new page_library(总条数， 当前页码， 每页条数)；
 * 然后用 ->show 返回分页代码片段。
 */
class page_library {
	protected $page_number_total = 0;
	protected $page_number_perpage = 30;
	protected $page = 1;
	protected $page_pages_count = 0;
	protected $page_strparameter = '';
	
	/**
	 * 初始化函数 - 可接收参数
	 * 
	 * @param int $page_number_total 总记录数
	 * @param int $page 当前页码
	 * @param int $page_number_perpage 每页记录数
	 */
	public function __construct($page_number_total, $page = false, $page_number_perpage = false) {
		// 有参数则接收，没则用默认属性值
		$this->page_number_total = $page_number_total;
		// 有参数则接收，没则用默认属性值
		if ($page_number_perpage) {
			$this->page_number_perpage = $page_number_perpage;
		}
		
		// 计算总页数
		$this->page_pages_count = ceil($this->page_number_total/$this->page_number_perpage);	# 向上取整！不需要+1了
		
		// page当前页码
		// 有参数则接收，没则用默认属性值
		if ($page) {
			$this->page = $page + 0;
			if ($this->page < 1) {
				$this->page = 1;
			} elseif ($this->page > $this->page_pages_count) {
				$this->page = $this->page_pages_count;
			} else {
				$this->page = $page;
			}
		}
		
		// 计算并保存uri+参数
		$this->page_strparameter = $this->page_str_uri_parameter();
	}
	
	/**
	 * 保存uri+参数的 函数
	 *
	 * @return string 返回 uri+参数（除了page）
	 */
	private function page_str_uri_parameter() {
		// 保存参数部分：
		// 想办法保存地址栏上的信息保存起来！：（要去除page项参数哟！）
		// 先获取地址栏参数 : /myshop/zeroshop/library/page_library.class.php?classid=1&page=4
		$uri = $_SERVER['REQUEST_URI'];
		// 分析并获得后边的问号后的 参数部分：
		/* parse_url
		 Array
		(									# 得到url与参数分割 的 数组形式！
				[path] => /myshop/zeroshop/library/page_library.class.php
				[query] => classid=1&page=4 	#如果没有参数，则也没有[query]数组单元了！
		) */
		// 翻手为云！！！@
		$array_parseuri = parse_url($uri);		// 分析uri部分 将其转换为 数组  parse_url
		
		$array_parameter = array();				// 纯参数部分（数组）
		if (!empty($array_parseuri)) {
			parse_str( empty($array_parseuri['query'])?'':$array_parseuri['query'], $array_parameter );	// 分析参数部分 也将其转换为 数组 parse_str
		}
		/* parse_str
		Array
		(
		[classid] => 1 		#得到每一个参数之间分割 的 数组形式！
		[page] => 4
		)
		print_r($param); */
		
		// 所以，判断$param数组里，不管有没有page单元项，都unset一下！确保没有page单元混杂进来 参数保存中！！！chris
		// 即 保存出page之外的所有单元
		unset($array_parameter['page']);		// 去除（数组中）page项！
		// 保存参数部分完成。

		// 加？还是加 & 呢：
		if (!empty($array_parameter)) {
			$str_parameter = http_build_query($array_parameter);	// 覆手为雨！！！@ （转回字符串）
			$url = $array_parseuri['path'] .'?'. $str_parameter;	// 一来一回，搞定拼接需要的带参数uri了。
		} else {
			$url = $array_parseuri['path'] .'?z=zeroShop';
		}
		//print_r($url);
		return $url;
	}
	
	/**
	 * 主要函数 - 创建分页导航代码
	 * 
	 * @return string 返回分页导航的代码
	 */
	public function show() {
		// 计算总页数
		//$page_pages_count = ceil($this->page_number_total/$this->page_number_perpage);	# 向上取整！不需要+1了
		
		// 关键步，计算页码导航：
		// 当前页
		$nav = array();
		$nav[] = '<font color=red>'. $this->page .'</font>';
		
		// 最终得到一个所有页码的 大数据数组！！：
		//var_dump($nav);
		for ($left=$this->page-1, $right=$this->page+1; !( ($left<1&&$right>$this->page_pages_count) || count($nav)>=5 ); $left-=1,$right+=1) {
			//echo $url .'page='. $i, '<br />';		// 页面导航出来了！
			
			if (!($left<1)) {
				// 压到最头
				array_unshift($nav, '[<a href="'. $this->page_strparameter .'&page='. $left .'">'. $left .'</a>]');
			}
			
			if (!($right>$this->page_pages_count)) {
				// 压到最尾
				array_push($nav, '[<a href="'. $this->page_strparameter .'&page='. $right .'">'. $right .'</a>]');
			}
		}
		//var_dump($nav);
		
		// 返回字符串格式
		return implode('', $nav);
	}
	
	/**
	 * 上一页 按钮
	 * 
	 * @return string 返回上一页 按钮的代码
	 */
	public function button_pre() {
		// 上一页
		if ($this->page < 2) {
			$str_pre = '上一页';		// 到头了
		} else {
			$str_pre = '<a href="'. $this->page_strparameter .'&page='. ($this->page - 1) .'">上一页</a>';
			//var_dump($str_pre);
		}
		
		return $str_pre;
	}
	
	/**
	 * 下一页 按钮
	 *
	 * @return string 返回下一页 按钮的代码
	 */
	public function button_next() {
		// 上一页
		if ($this->page >= $this->page_pages_count) {
			$str_next = '下一页';		// 到头了
		} else {
			$str_next = '<a href="'. $this->page_strparameter .'&page='. ($this->page + 1) .'">下一页</a>';
			//var_dump($str_next);
		}
	
		return $str_next;
	}
	
	/**
	 * 下拉分页 按钮
	 *
	 * @return string 返回处理好的 下拉分页 按钮
	 */
	public function button_selected() {
		$str_selected = '<select size="1" onchange="javascript:window.location=\''. $this->page_str_uri_parameter() .'&page=\' + this.options[this.selectedIndex].value;">';
		
		for ($i=0; $i<$this->page_pages_count; $i++) {
			$str_selected .= '<option value="'. ($i+1) .'" '. ( (($i+1) == $this->page)?'selected="selected"':'' ) .'>'. ($i+1) .'</option>';
		}
		$str_selected .= '</select>';
				
		return $str_selected;
	}
}
// 测试
/* $p = new page_library(100, !empty($_GET['page'])?$_GET['page']:0, 6);
echo $p->show(); */