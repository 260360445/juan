<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends ComController{
    public function login(){
    	$this->display();
    }
    
    //登录
    public function dologin(){
        $user=M("user");
        $userarr=$user->field("id,mobile,pwd,rand_str,status")->where("mobile='{$_POST['username']}'")->find();
        if(!empty($userarr)){//  账号正确
            $str=$userarr['rand_str'];
            $userpass=md5(md5($_POST['password']));
            $userpwd=md5($userpass.$str);
            if(($userpwd == $userarr['pwd'])){//  登陆成功
                //unset($_SESSION['yguser']);
                $_SESSION['wap']['mobile'] = $userarr['mobile'];
                $_SESSION['wap']['id'] = $userarr['id'];
                $_SESSION['wap']['status'] = $userarr['status'];
                echo 0;
                exit();
            }else{//  密码错误
                echo 2;
                exit();
            }
        }else{//  账号错误
            echo 1;
            exit();
        }
    }
    // 用户退出
    public function logout() {
        $_SESSION['wap'] = array();
        unset($_SESSION['wap']);
        $this->redirect('Index/index');
    }
}