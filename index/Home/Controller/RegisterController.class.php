<?php
namespace Home\Controller;
use Think\Controller;
class RegisterController extends ComController {
    public function register(){
    	$this->display();
    }
/*********************************** 登录 注册 找回密码 start ************************************************/

    public function registercode(){
        $user=M("user");
        $usermobile=$user->field("mobile")->where("mobile='{$_POST['registerCode']}'")->find();
        if ($usermobile==$_POST['mobile']) {
            echo 2;
            exit;
        }else{
            if(!empty($usermobile)){
                echo 0;
                exit;
            }else{
                echo 1;
                exit;
            }
        }
    }
    //找回密码验证手机
    public function checkMobileExist(){
    	$user=M("user");
    	$usermobile=$user->field("mobile")->where("mobile='{$_POST['mobile']}'")->find();
    	if(!empty($usermobile)){
    		echo 1;
    		exit;
    	}else{
    		echo 0;
    		exit;
    	}
    }
    //发送 验证码--找回密码
    public function checkValidCodeUSer(){
        $mobile =trim($_POST['mobile']);
        if(!empty($mobile)){       
            $usermobile=M('user')->field("mobile")->where(['mobile'=>$mobile])->find();
            if(empty($usermobile)){//手机不已存在
                $infor['infor']=4;
                $this->ajaxReturn($infor);
                exit;
            }else{
                $ret=$this->_sendCode($mobile);
                if($ret['status'] == 'success'){
                    $infor['infor']=2;
                    $this->ajaxReturn($infor);
                    exit;             
                }else{
                    $infor['infor']=3;
                    $this->ajaxReturn($infor);
                    exit;
                }
            }
        }
    }
	//发送 验证码
	public function checkValidCode(){
        $mobile =trim($_POST['mobile']);
        if(!empty($mobile)){       
            $usermobile=M('user')->field("mobile")->where(['mobile'=>$mobile])->find();
            if(!empty($usermobile)){//手机已存在
                $infor['infor']=4;
                $this->ajaxReturn($infor);
                exit;
            }else{
                $ret=$this->_sendCode($mobile);
                if($ret['status'] == 'success'){
                    $infor['infor']=2;
                    $this->ajaxReturn($infor);
                    exit;             
                }else{
                    $infor['infor']=3;
                    $this->ajaxReturn($infor);
                    exit;
                }
            }
        }
	}
     //修改密码
    public function setPass(){
        $pass=I('post.pass','');
        $mobile=I('post.mobile','');
        $smsCode=I('post.code','');
        $user=M("user");
        $usermobile=$user->field("id")->where(['mobile'=>$mobile])->find();
        if (empty($usermobile)) {
            echo 4;
            exit();
        }
        if($this->_isCode($mobile,$smsCode) == true){
            $id=$usermobile['id'];//接到要修改的id
            $str=$this->_randStr(4);
            $user_pwd=md5(md5($pass));
            $data['pwd']=md5($user_pwd.$str);
            $data['rand_str']=$str;                 
            if( false!==$user->where(['id'=>$id])->save($data)){
                echo 2;
                exit;
            }else{
                echo 3;
                exit;
            }
        }else{
            echo '5';
            exit;
        }
    }
	//用户注册 处理
	public function doRegisterForMobile(){
        $smsCode=$_POST['code'];
        $mobile=$_POST['mobile'];
        $uname=$_POST['uname'];
        $password=$_POST['password'];
        $respassword=$_POST['respassword'];
        $paypass=$_POST['paypass'];
        $respaypass=$_POST['respaypass'];
        $user=M("user");
        $usermobile=$user->field("mobile")->where("mobile='{$_POST['mobile']}'")->find();
        if($usermobile){
            $infor['status']='false';
            $infor['msg']='手机号已经注册过';
            $this->ajaxReturn($infor);
            exit;
        }else{
            if($this->_isCode($mobile,$smsCode) == true){
                if($password == $respassword){
                    if($paypass == $respaypass){
                        if(!empty($_POST)){
                            $str=$this->_randStr(4);
                            $paystr=$this->_randStr(4);
                            $upwd=md5(md5($password));
                            $payupwd=md5(md5($paypass));
                            $data['rand_str']=$str;
                            $data['pwd']=md5($upwd.$str);
                            $data['rand_str']=$str;
                            $data['pay_pwd']=md5($payupwd.$paystr);
                            $data['pay_rand_str']=$paystr;
                            $data['mobile']=$mobile;
                            $data['shop_pay']=self::_mdStr($this->_randStr(9),$this->_randStr(10));
                            $data['reg_time']=time();
                            $data['status']=2;
                            $data['reg_ip']=$_SERVER["REMOTE_ADDR"];
                            //开启事务
                            M()->startTrans();
                            //注册用户 user 表
                            $res1=M("user")->add($data);
                            //添加用户信息
                            $res2 = M('user_infor')->add(['uid'=>$res1,'nick_name'=>$uname]);
                            if ($res1 && $res2){
                                M()->commit();
                                $_SESSION['sc']['usermobile']=$mobile;
                                $_SESSION['sc']['id']=$res1;
                                $_SESSION['sc']['status']=2;
                                $infor['status']='true';
                                $this->ajaxReturn($infor);
                                exit;
                            }else{
                                M()->rollback();
                                $infor['status']='false';
                                $infor['msg']='注册失败';
                                $this->ajaxReturn($infor);
                                exit;
                            }       
                        }else{
                            $infor['status']='false';
                            $infor['msg']='网络错误';
                            $this->ajaxReturn($infor);
                            exit;
                        }
                    }else{
                        $infor['status']='false';
                        $infor['msg']='两次交易密码不一致';
                        $this->ajaxReturn($infor);
                        exit;
                    }
                }else{
                    $infor['status']='false';
                    $infor['msg']='两次登录密码不一致';
                    $this->ajaxReturn($infor);
                    exit;
                }
            }else{
                $infor['status']='false';
                $infor['msg']='验证码错误或已过期';
                $this->ajaxReturn($infor);
                exit;
            }    
        }
	}
/***************************************** 登录 注册 找回密码 end*******************************************************/

}
			
			