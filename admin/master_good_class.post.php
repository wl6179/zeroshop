<?php
/**
 * 商品栏目 处理页
 * 
 * 结构：action
 * 作用：接收表单数据；调用model写入表单数据；
 * 
 * @author Chris Wang <zeroShop_author@163.com>
 * @version 1.0
 * @package 大后台C
 * @copyright (c) 2014 CokeSystem Group
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link http://www.Cokeshow.com.cn zeroShop
 * 
 */

// init
define('ACC', true);
require '../include/init.php';



// 主控塔
$action = isset($_GET['action'])?$_GET['action']:'无';

switch ($action) {
	case 'save_add':
		save_add();
		break;
	case 'delete':
		delete();
		break;
	case 'save_edit':
		save_edit();
		break;
	default:
		# Do this then. example:list.
		break;
}



/**
 * 增
 */
function save_add() {
	// 第二步：检验数据 - (并‘筛选’想要的数据！chris)
	$data = array();
	
	// $_POST
	//（特殊处理 字段）
	//$_POST['good_good_weight']	*= ($_POST['good_good_weightunit']);
	
	// 第三步：实例化model。并调用model相关的方法。（先 创建表）
	$model_good_class = new GoodClassModel();
	
	// 新 - 自动过滤：
	$data = array();
	$data = $model_good_class->_autofacade($_POST);	// 自动过滤处理OK！
	// 新 - 自动填充（+上缺少的字段）： 【自动填充、补全！】
	$data = $model_good_class->_autofill($data);		// 自动填充处理OK！
	// 自动商品货号
	/* $data['good_good_sn'] = ...*/
	// 新 - 自动检验：
	if (!$model_good_class->_autovalid($data)) {
		// 如果检验没通过：
		exit('没通过检验！-'. $model_good_class->get_errormsg());
	}
	// -------------------------往下没有错误了-(处理图片等的好时机)--------start------
	
	if ($model_good_class->add($data)) {
		echo 'success';			// 严格的说，Controllor里是不应该出现echo东西的！！！
										// 因该调用view的 成功提示模板！
	} else {
		echo '操作失败';
	}
}

/**
 * 删
 */
function delete() {
	// 第一步：接收数据
	$id = $_POST['id'];
	if (!is_numeric($id)) {
		exit('ID参数错误');
	} else {
		$id = $_POST['id'] + 0;
	}
	
	// 第二步：调用model。
	$model_good_class = new GoodClassModel();
	
	// 验证要删的栏目下，是否还有 子栏目！
	$sons = $model_good_class->get_class_sons($id);
	if (!empty($sons)) {
		exit('其下还有子栏目，不允许删除！');
	}
	
	// 删
	echo $model_good_class->delete($id) ? 'success' : '操作失败';
}

/**
 * 改
 */
function save_edit() {
	$id = $_POST['id'];
	if (!is_numeric($id)) {
		exit('ID参数错误');
	} else {
		$id = $_POST['id'] + 0;
	}
	
	// $_POST
	//（特殊处理 字段）
	//$_POST['good_good_weight']	*= ($_POST['good_good_weightunit']);
	
	// 第三步：实例化model。并调用model相关的方法。（先 创建表）
	$model_good_class = new GoodClassModel();
	
	// 新 - 自动过滤：
	$data = array();
	$data = $model_good_class->_autofacade($_POST);	// 自动过滤处理OK！
	// 新 - 自动填充（+上缺少的字段）： 【自动填充、补全！】
	$data = $model_good_class->_autofill($data);		// 自动填充处理OK！
	// 自动商品货号
	/* $data['good_good_sn'] = ...*/
	// 新 - 自动检验：
	if (!$model_good_class->_autovalid($data)) {
		// 如果检验没通过：
		exit('没通过检验！-'. $model_good_class->get_errormsg());
	}
	// -------------------------往下没有错误了-(处理图片等的好时机)--------start------
	
	
	
	// +
	// 获得当前栏目的所选“上一级”的它的 家谱树 数组：（经过自动验证后的parentid一定是数字！或null）
	$rsarray_parentree = $model_good_class->get_class_parenttree($model_good_class->select(), empty($data['good_class_parentid_FK_good_class_id'])?0:$data['good_class_parentid_FK_good_class_id']);
	//echo empty($rsarray_parentree);
	//print_r($rsarray_parentree);
	//exit();
	$flag = true;
	foreach ($rsarray_parentree as $v) {
		if ($v['good_class_id'] == $id) {
			// wrong! - 家谱树中，不应该有$id的存在！如今此处有，则表示 互为父子 了！
			$flag = false;
			break;
		}
	}
	// 如 $flag 非真则肯定有 互为父子 的问题了～ 【注：同时页一块儿解决了 - 自己选自己为自己父类的错误情况！】
	if (!$flag) {
		exit("您所选择的上一级 已经是当前 $data[good_class_name] 中的一个子级！它们将互为父子，So不允许修改！");
		//或 exit('父栏目选取错误！');
	}
	
	if ($model_good_class->edit($data,$id)) {
		echo 'success';
	} else {
		echo '操作失败';
	}
}