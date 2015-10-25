<?php
/**
 * 图片处理类
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
 * 图片处理类
 * 
 * 功能要求：
 * 1 为图片添加透明度 水印；
 * 2 将图片变为 缩略图；
 * 
 * 尚未完善之处：
 * 良好的报错支持；
 * 
 * 例子：
 * 生成水印图 - 
 * echo image_library::water('./bg.png', './chris.jpg', './水印图.png') ? 'ok!' : 'fail!';
 * 生成缩略图 - 
 * echo image_library::thumb('./bg.png', './缩略图.png', 500, 100) ? 'ok!' : 'fail!';
 */
class image_library {
	/**
	 * 获取图片信息
	 * 
	 * @param string $image 图片路径
	 * @return boolean|array 图片信息的数据数组 或false
	 */
	public static function get_image_info($image) {
		// 首先判断是否存在
		if (!file_exists($image)) {
			return false;
		}
		
		// 分析图片
		$info = getimagesize($image);	// 数组
		if ($info == false) {
			return false;	// 分析失败
		}
		
		// 此时info分析出来了，是一个数组数据：（进行数组信息的重新整理）
		$array_imageinfo['width'] = $info[0];
		$array_imageinfo['height'] = $info[1];
		$array_imageinfo['ext'] = substr($info['mime'], strpos($info['mime'], '/')+1);
		
		return $array_imageinfo;
	}
	
	/**
	 * 生成有 透明度水印 的图
	 * 
	 * @param string $dst_bg 目标背景图 的路径
	 * @param string $src_water 水印小图 的路径
	 * @param string $savepath 最终保存生成文件的路径（不填则替换原始 $dst_bg 原图）
	 * @param int $alpha 设置透明度
	 * @param int $pos 加水印的位置编号；（0-左上角；1-右上角；2-右下角；3-左下角；4-正中间；）
	 */
	public static function water($dst_bg, $src_water, $savepath=NULL, $pos=2, $alpha=50) {
		// 先保证2图片都存在
		if (!file_exists($dst_bg) || !file_exists($src_water)) {
			return false;
		}
		
		// 首先要检测保证水印图片，不能比目标图片还大
		$dst_info = self::get_image_info($dst_bg);
		$src_info = self::get_image_info($src_water);
		if ($src_info['height'] > $dst_info['height'] || $src_info['width'] > $dst_info['width']) {
			return false;
		}
		
		// 符合要求！
		
		// + 加水印：
		
		// 判断使用什么函数来读画布
		$string_dst_func = 'imagecreatefrom'. $dst_info['ext'];	// 自动识别dst图类型
		$string_src_func = 'imagecreatefrom'. $src_info['ext'];	// 自动识别src图类型
		// 如果以上2个函数名，有一个不存在，则到此结束：
		if (!function_exists($string_dst_func) || !function_exists($string_src_func)) {
			return false;
		}
		
		// 至此可以【动态】的加载函数，来创建画布了
		$dst_im = $string_dst_func($dst_bg);		// 用什么函数来读（已解决）创建 待操作画布！
		$src_im = $string_src_func($src_water);	// 用什么函数来读（已解决）创建 水印画布！
		
		// 加水印喽
		// （$dst_x, $dst_y）怎么办？   <--------------- $pos
		//			需要根据水印的位置编号，计算粘贴的坐标
		switch ($pos) {
			case 0: //左上角
				$pos_x = 0;
				$pos_y = 0;
				break;
			case 1: //右上角
				$pos_x = $dst_info['width'] - $src_info['width'];
				$pos_y = 0;
				break;
			case 2: //右下角
				$pos_x = $dst_info['width'] - $src_info['width'];
				$pos_y = $dst_info['height'] - $src_info['height'];
				break;
			case 3: //左下角
				$pos_x = 0;
				$pos_y = $dst_info['height'] - $src_info['height'];
				break;
			case 4: //中间
				$pos_x = ($dst_info['width'] - $src_info['width']) / 2;
				$pos_y = ($dst_info['height'] - $src_info['height']) / 2;
				break;
			default: //默认为右下角
				$pos_x = $dst_info['width'] - $src_info['width'];
				$pos_y = $dst_info['height'] - $src_info['height'];
				break;
		}
		// 复制并 加入水印：
		imagecopymerge($dst_im, $src_im, $pos_x, $pos_y, 0, 0, $src_info['width'], $src_info['height'], $alpha);
		
		// 保存了
		if (!$savepath) {
			$save = $dst_bg;
			unlink($dst_bg);		// 先删掉原图！
		} else {
			$save = $savepath;	// 取参数路径！！
		}
		// 用什么函数来保存图片
		$string_create_func = 'image'. $dst_info['ext'];	// 底图的格式为准
		$string_create_func($dst_im, $save);					// 保存！
		
		imagedestroy($dst_im);
		imagedestroy($src_im);
		
		return true;
	}
	
	/**
	 * 生成 缩略图
	 * 
	 * 思路：等比例缩放！ 两边留白！！
	 * @param string $src 原图的图片路径
	 * @param string $savepath 保存路径
	 * @param int $width 目标 缩略后 宽度！
	 * @param int $height 目标 缩略后 高度！
	 */
	public static function thumb($src, $savepath=NULL, $width=200, $height=200) {
		// 先保证图片存在：
		if (!file_exists($src)) {
			return false;
		}
		
		$src_info = self::get_image_info($src);
		if ($src_info == false) {
			return false;
		}
		
		// 处理缩放
		// 先计算缩放比例：（$src_info['width']原图宽度）（$width目标缩略后宽度）
		$scaling_x = $width / $src_info['width'];		// 按宽算比例～
		$scaling_y = $height / $src_info['height'];	// 按高算比例～（选择了高，则最后等比例缩放相乘后，其将为 原高度 一样高！！！<即 只缩放宽度了就～> ）
		// 比一下哪个比例 小，就选哪个比例。。（xy谁比例（值）小，就证明 【原图】在其（宽x或高y方面）更大！）
		$scaling = min($scaling_x, $scaling_y);	// 选择一个小的（比例）
		
		// 创建画布
		// 创建原始图的画布先：
		$string_src_func = 'imagecreatefrom'. $src_info['ext'];
		$src_im = $string_src_func($src);
		// 创建缩略图的画布：
		$thu_im = imagecreatetruecolor($width, $height);
		
		// 创建白色颜料
		$white = imagecolorallocate($thu_im, 255, 255, 255);	// 白边（用于2边留白）
		// 填充 缩略画布
		imagefill($thu_im, 0, 0, $white);
		
		// （难！）（用上上边算出来的比例操作）
		// 复制并 加入（按w或h比例）缩略：
		//imagecopyresampled($thu_im, $src_im, 0, 0, 0, 0, $src_info['width']*$scaling, $src_info['height']*$scaling, $src_info['width'], $src_info['height']);
		// ...
		$s_width = (int)$src_info['width'] * $scaling;			// 一个 则宽一定需要留白，即 更短一下 假如～
		$s_height = (int)$src_info['height'] * $scaling;		// 一个 假如此高是满打满算的【原样高】
		// ...
		$paddingx = ($width - $s_width) / 2;		// 一个大于0～
		$paddingy = ($height - $s_height) / 2;		// 一个必等于0
		imagecopyresampled($thu_im, $src_im, $paddingx, $paddingy, 0, 0, $s_width, $s_height, $src_info['width'], $src_info['height']);
		// 原图缩小后，并与新小画布结合了～
		
		// 保存了
		if (!$savepath) {
			$save = $src;
			unlink($src);			// 先删掉原图！
		} else {
			$save = $savepath;	// 取参数路径！！
		}
		// 用什么函数来保存图片
		$string_create_func = 'image'. $src_info['ext'];
		$string_create_func($thu_im, $save);	// 保存！
		
		imagedestroy($thu_im);
		imagedestroy($src_im);
		
		return true;
	}
	
	/**
	 * 验证码
	 *
	 * 例子：
	 * code.php --- image_library::code();
	 * 前端 --- <input type="text" name="code" id="code" value="" />
	 * 前端 --- <img alt="点击更换验证码" src="code.php" onclick="this.src='code.php?code=' + Math.random()" />
	 */
	public static function code() {
		$str = 'abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
		$code = substr(str_shuffle($str), 0, 5);
		
		// 原始 造画布
		$src_im = imagecreatetruecolor(80, 25);
		// 目标 造画布
		$dst_im = imagecreatetruecolor(80, 25);
		
		// 随机颜色
		$randcolor = imagecolorallocate($src_im, mt_rand(0, 150), mt_rand(0, 150), mt_rand(0, 150));
		// 灰色背景
		$gray = imagecolorallocate($src_im, 250, 250, 250);
		imagefill($src_im, 0, 0, $gray);
		imagefill($dst_im, 0, 0, $gray);
		
		
		// 3 写字儿
		// imagestring($src_im, 5, 18, 4, $code, $randcolor);
		/* $char = array('啊', '的', '单', '额', '覆', '父', '了', '在', '内', '哦', '其', '所');
			shuffle($char);		// 打乱 数组元素
		$char = implode('', $char);	// 将数组 排成字符串
		$char = substr($char, 0, 12);	//	截拳道 */
		imagettftext($src_im, 18, 0, 10, 19, $randcolor, ROOT .'view/public/font/Yahei.ttf', $code);
		
		//-----------------------------------------------------------------------扭
		// 对src画布的每一个横向像素，进行循环 复制出来！
		for ($i=0; $i<80; $i++) {
			// 定义最大波动几个像素-top（偏移量）；
			$offset = 3;
			// 定义波动几个周期-round（周期越多波动越大）；
			$round = 2;		// 扭2个周期，即 4 PI
				
			$posY = round(  sin((($round * 2 * M_PI)/60) * $i) * $offset  );	// 正玄变化
			//$posY = (  sin((($round * 2 * M_PI)/60) * $i) * $offset  );	// 正玄变化
			imagecopy($dst_im, $src_im, $i, $posY, $i, 0, 1, 25);	// 第一个0要扭曲的变化，用整选sin？！
				
		}
		//-----------------------------------------------------------------------曲
		// 随机  色
		$randcolor1 = imagecolorallocate($dst_im, mt_rand(120, 150), mt_rand(150, 180), mt_rand(180, 250));
		$randcolor2 = imagecolorallocate($dst_im, mt_rand(120, 150), mt_rand(150, 180), mt_rand(180, 250));
		$randcolor3 = imagecolorallocate($dst_im, mt_rand(120, 150), mt_rand(150, 180), mt_rand(180, 250));
		// 画干扰线（向 画布）
		imageline($dst_im, 0, mt_rand(0, 25), 80, mt_rand(0, 25), $randcolor1);	// 80已超过横宽长度！
		imageline($dst_im, 0, mt_rand(0, 25), 80, mt_rand(0, 25), $randcolor1);
		imageline($dst_im, 0, mt_rand(0, 25), 80, mt_rand(0, 25), $randcolor1);
		
		// 4 直接输出
		header('content-type:image/jpeg; charset=utf-8');
		imagepng($dst_im);
		
		// 5 销毁
		imagedestroy($src_im);
		imagedestroy($dst_im);
		
		// session
		
	}
}