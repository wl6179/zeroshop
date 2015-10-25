<?php
/**
 * 会员 列表页
 * 结构：查询表单和列表
 */

// init
define('ACC', true);
require '../include/init.php';

// 参数重新定义区
$conf->window_width = '600';
$conf->window_height = '620';

// V
include ROOT .'view/admin/view.master_user_user.list.php';