<?php
// +----------------------------------------------------------------------
// | Author: liangyue <liangyue0712@163.com>
// +----------------------------------------------------------------------
// | Name : 公共类
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;
class ComController extends Controller {
	
	protected function _initialize(){
		//查询基本信息
	    $infor=M('information')->find();
	    $_SESSION['sc']['infor']=$infor;
		$_GET  = self::_tags($_GET);
		$_POST = self::_tags($_POST);
		$str = $_SERVER["REQUEST_URI"];
		if (stripos($str,'Pcenter') != false){
	    	if(empty($_SESSION['sc']['id'])){
	            //跳转到认证网关
	            $this->redirect('Login/login');
	        }
	    }
	}
	public function get_goods_arr($ids){
        if( !($goods_arr = S('goods_arr')) ){
            $good_arr = array();
            foreach ($ids as $key => $id) {
                $res = array();
                $idstr = implode(",", $id);
                $map['classid'] = array('in',$idstr);
                $map['curstate'] = 0;
                $good = M('goods')->where($map)->order('goods_time desc')->limit(4)->select();
                $goods_arr[$key] = $good;
            }
            S('goods_arr',$goods_arr,86400);
        }
        return $goods_arr;
    }
	/**
	 * 
	 * 剔除HTML标签
	 *
	 */
	static function _tags($data) {
		foreach ($data as $k => $v) {
			if (is_array($v)) {
				$data[$k] = self::_tags($v);
			} else {
				$data[$k] = strip_tags(trim($v));
				$data[$k] = addslashes(trim($v));
			}
		}
		return $data;
	}
	/*
	 *
	 * 设置COOKIE
	 *
	 * @param string $name   cookie名
	 * @param string $val    cookie值
	 * @param int    $day    有效时间天
	 * 默认时间关闭浏览器清除
	 *
	 */
	static function _setCookie($name, $val, $day = 0) {
		if ($day == 0) {
			$deadTime = null;
		} else {
			$deadTime = time() + 3600 * 24 * $day;
		}
		return setCookie($name, $val, $deadTime,'/');
	}
	/*
	 *
	 * 清除COOKIE
	 *
	 * @param string $name   cookie名
	 *
	 */
	static function _clsCookie($name) {
		setCookie($name, '');
		setCookie($name, null, time()-3600,'/');
	}
	/**
	 * 生成随机字符串
	 *
	 * @param int $len 需要随机字符串的长度
	 * @param int $num false返回字母数字混合,true返回纯数字
	 *
	 */
	static function _randStr($len = 4, $num = false) {
		if ($num == false) {
			$str = str_shuffle('ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789');
		} else {
			$str = str_shuffle('0123456789'); 
		}
		return substr($str, 0, $len);
	}
	/**
	 * 获取文件后缀
	 *
	 * @param string $name 文件名
	 *
	 * @return string $ext 后缀名
	 */
	static function _getExt($name) {
		$ext = explode('.', $name);
		return end($ext);
	}
	/**
	 * 创建目录
	 *
	 * @param string $dir 文件夹名
	 *
	 * @return string $path 返回路径
	 */
	static function _createDir($dir) {
		$path = './Uploads/' . $dir;
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		return $path;
	}
	static function _createDirUser($dir) {
		$path = './Uploads/Userlogo/' . $dir . '/' ;
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		return $path;
	}
	/**
	 * 上传图片
	 *
	 * @param string $fileName input的name
	 * @param string $savePath 附件上传子目录
	 * @param string $saveName 文件名字
	 * @param string $saveExt  文件后缀
	 * @param int    $maxSize  上传大小默认 1MB
	 */
	static function _uploadFile($fileName, $savePath, $saveName, $saveExt, $maxSize = 1) {
		$maxSize = is_int($maxSize) ? $maxSize : 1;
		$fileName = $fileName;
		if (!$fileName || !$savePath || !$saveName || !$saveExt || $maxSize >= 2) {
			return false;
		}
		$res = array();
		$type = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/bmp');

		if (($_FILES[$fileName]["size"] / 1024) > ($maxSize * 1024)) {
			$res['tag'] = 1;
			$res['con'] = '图片大小不得超过1MB';
		} else if (!in_array($_FILES[$fileName]["type"], $type)) {
			$res['tag'] = 2;
			$res['con'] = '文件格式不正确';
		} else if ($_FILES[$fileName]["error"] > 0) {
			$res['tag'] = 3;
			$res['con'] = '系统繁忙,请稍后再试';
		} else {
			$dest = self::_createDir($savePath) . '/' . $saveName . '.' . $saveExt;
			if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $dest)) {
				$res['tag'] = 4;
				$res['con'] = substr($dest, 9);
			} else {
				$res['tag'] = 3;
				$res['con'] = '系统繁忙,请稍后再试';
			}
		}
		return $res;
	}
	/**
	 * 字符串截取返回
	 *
	 * @param str $str 截取字符串的长度
	 * @param int $len 截取字符串的长度
	 */
	static function _subStr($str, $len, $type = ture, $charset = 'UTF-8') {
		$str = mb_substr($str, 0, $len, $charset);
		if ($type == ture) {
			$strLen = strlen($str);
			$len = $len * 2;
			if ($strLen > $len) {
				return $str . '...';
			} else {
				return $str;
			}
		} else {
			return $str;
		}

	}
	function _getiP() {
		if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
			$cip = $_SERVER["HTTP_CLIENT_IP"];
		} else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else if (!empty($_SERVER["REMOTE_ADDR"])) {
			$cip = $_SERVER["REMOTE_ADDR"];
		} else {
			$cip = "0.0.0.0";
		}

		return $cip;
	}
	static function _mdStr($v1, $v2 = 'whtshop') {
		$v1 = strtoupper(md5(md5(ENCODEKEY . $v1)));
		$v2 = sha1(strtoupper(md5($v2 . ENCODEKEY)));
		return strtoupper(md5($v1 . ENCODEKEY . $v2));
	}
	/**
	 * 发送手机验证码
	 *
	 * @param int $mobile 发送验证码手机号
	 *
	 * @return 成功返回success+验证码,失败返回false
	 */
	static function _sendCode($mobile) {
		$str = self::_randStr(4, 1);
		self::_setCookie('cod', self::_setStr($str), 600);
		self::_setCookie('key', self::_setStr(md5(md5($str . md5($mobile)))), 600);
		file_get_contents('https://www.wanht.net/sms/jiuwuSendSms.php?mobile='.$mobile.'&code='.$str);
		$resault['status'] = 'success';
		$resault['cod'] = $str;
		return $resault;
	}
	/**
	 * 验证手机验证码是否正确
	 *
	 * @param int $mobile 发送验证码手机号
	 * @param int $cod 验证码
	 *
	 * @return 验证成功返回true,失败返回false
	 */
	static function _isCode($mobile, $cod) {
		$key = (md5(md5($cod . md5($mobile))));
		if ($key == self::_getStr($_COOKIE['key']) && $cod == self::_getStr($_COOKIE['cod'])) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * 数据加密
	 *
	 * @param int $data 被加密数据
	 *
	 * @return 加密后的数据
	 */
	static function _setStr($data) {
		$key = self::_mdStr(ENCODEKEY);
		$data = base64_encode($data);
		$x = 0;
		$len = strlen($data);
		$l = strlen($key);
		for ($i = 0; $i < $len; $i++) {
			if ($x == $l) {
				$x = 0;
			}

			$char .= substr($key, $x, 1);
			$x++;
		}
		for ($i = 0; $i < $len; $i++) {
			$str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1))) % 256);
		}
		return $str;
	}
	/**
	 * 数据解密
	 *
	 * @param int $data 被解密数据
	 *
	 * @return 解密后的数据
	 */
	static function _getStr($data) {
		$key = self::_mdStr(ENCODEKEY);
		$x = 0;
		$len = strlen($data);
		$l = strlen($key);
		for ($i = 0; $i < $len; $i++) {
			if ($x == $l) {
				$x = 0;
			}

			$char .= substr($key, $x, 1);
			$x++;
		}
		for ($i = 0; $i < $len; $i++) {
			if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
				$str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
			} else {
				$str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
			}
		}
		return base64_decode($str);
	}
	/**
	 * 上传图片生成缩略图
	 *
	 * @param string $fileName input的name
	 * @param string $savePath 附件上传子目录
	 * @param string $saveName 文件名字
	 * @param string $saveExt  文件后缀
	 * @param int    $maxSize  上传大小默认 1MB
	 */
	static function _createThumImg($fileName, $savePath, $saveName, $saveExt, $maxSize = 3) {
		$maxSize = is_int($maxSize) ? $maxSize : 1;
		$fileName = $fileName;
		if (!$fileName || !$savePath || !$saveName || !$saveExt || $maxSize > 5) {
			$res['con'] = '操作异常!';
			return $res;
		}
		$res = array();
		$type = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/bmp');
		if (($_FILES[$fileName]["size"] / 1024) > ($maxSize * 1024)) {
			$res['tag'] = 1;
			$res['con'] = '图片大小不得超过3MB';
		} else if (!in_array($_FILES[$fileName]["type"], $type)) {
			$res['tag'] = 2;
			$res['con'] = '文件格式不正确';
		} else if ($_FILES[$fileName]["error"] > 0) {
			$res['tag'] = 3;
			$res['con'] = '系统繁忙,请稍后再试';
		} else {
			$dest = self::_createDir($savePath) . '/' . $saveName . '.' . $saveExt;
			if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $dest)) {
				$res['tag'] = 4;
				$res['con'] = substr($dest, 9);
				$imgsize = getimagesize('./Uploads/'.$res['con']);
				//dump($imgsize);die;
				if($imgsize[0] > 0 && $imgsize[0] < 500){
					$old_img_w = $imgsize[0] / 1;
				}elseif($imgsize[0] >= 500 && $imgsize[0] < 700){
					$old_img_w = $imgsize[0] / 1.3;
				}elseif($imgsize[0] >= 700 && $imgsize[0] < 900){
					$old_img_w = $imgsize[0] / 1.6;
				}elseif($imgsize[0] >= 900){
					$old_img_w = $imgsize[0] / 2;
				}
				$bei = $imgsize[0] / $old_img_w;

				$old_img_h = (int)($imgsize[1]/$bei);

				$newimg = imagecreatetruecolor($old_img_w, $old_img_h);

				$gray = imagecolorallocate($newimg, 200, 200, 200);

				imagefill($newimg, 0, 0, $gray);

				if($imgsize['mime'] == 'image/gif'){
					$small = imagecreatefromgif('./Uploads/'.$res['con']);
				}elseif($imgsize['mime'] == 'image/jpeg'){
					$small = imagecreatefromjpeg('./Uploads/'.$res['con']);
				}elseif($imgsize['mime'] == 'image/png'){
					$small = imagecreatefrompng('./Uploads/'.$res['con']);
				}elseif($imgsize['mime'] == 'image/bmp'){
					$small = imagecreatefromwbmp('./Uploads/'.$res['con']);
				}elseif($imgsize['mime'] == 'image/pjpeg'){
					$small = imagecreatefromjpeg('./Uploads/'.$res['con']);
				}
				imagecopyresampled($newimg, $small, 0, 0, 0, 0, $old_img_w,$old_img_h,$imgsize[0], $imgsize[1]);
				if($imgsize['mime'] == 'image/gif'){
					imagegif($newimg,'./Uploads/'.$res['con']);
				}elseif($imgsize['mime'] == 'image/jpeg'){
					imagejpeg($newimg,'./Uploads/'.$res['con']);
				}elseif($imgsize['mime'] == 'image/png'){
					imagepng($newimg,'./Uploads/'.$res['con']);
				}elseif($imgsize['mime'] == 'image/bmp'){
					imagewbmp($newimg,'./Uploads/'.$res['con']);
				}elseif($imgsize['mime'] == 'image/pjpeg'){
					imagejpeg($newimg,'./Uploads/'.$res['con']);
				}
				imagedestroy($im);
			} else {
				$res['tag'] = 3;
				$res['con'] = '系统繁忙,请稍后再试';
			}
		}
		return $res;
	}
	/**
	 * 
	 * 判断是否为POST提交
	 *
	 */
	static function _isPost() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * 
	 * 判断是否为GET提交
	 *
	 */
	static function _isGet() {
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			return true;
		} else {
			return false;
		}
	}
	/**
	* 递归查询分类
	*
	* @param string $data 数据
	* @param string $pId 父类编号
	*/
	public function getTree($data, $pId)
	{
		$tree = '';
		foreach($data as $k => $v)
		{
   			if($v['pid'] == $pId)
   			{
    			$v['pid'] = $this->getTree($data, $v['goods_class_id']);
    			$tree[] = $v;    
  			}				
		}
		return $tree;
	}
	public function getTreeArc($data, $pId)
	{
		$tree = '';
		foreach($data as $k => $v)
		{
   			if($v['pid'] == $pId)
   			{
    			$v['pid'] = $this->getTreeArc($data, $v['id']);
    			$tree[] = $v;    
  			}				
		}
		return $tree;
	}
		/*
	*添加资金变动表
	*	@param 	$uid  用户
		@param 	$pay  发生金额
		@param 	$bal  发生后剩余
		@param	$type 发生事件 2==购买商品,3==充值,4==用户确认收货，付款,5==提现,6==用户提现，被驳回,7==转账
		@param 	$sta  属性  用户/商家   2==用户，3==商家
		@param 	$stus 类型  2==加，3==减
		@param 	$sts  分类 2==余额，3==可用金，4==消费币
	*/
	public function billadd($uid,$type,$pay,$bal,$sta,$stus,$sts){
		$data['btime']=time();
		$data['billnum']=date("YmdHis",time()).$this->_randStr(4,1);
		$data['uid']=$uid;
		if($sts == 2){
			$data['number']=$pay;
			$data['money']=$bal;
		}else if($sts == 3){
			$data['ke_bal']=$pay;
			$data['after_ke_bal']=$bal;
		}else if($sts == 4){
			$data['xfb']=$pay;
			$data['after_xfb']=$bal;
		}
		$data['sta']=$sta;
		$data['stus']=$stus;
		$data['sts']=$sts;
		$data['type']=$type;
        $res = M('bill')->add($data);
		return $res;
	}
}