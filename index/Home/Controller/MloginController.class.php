<?php
namespace Home\Controller;
use Think\Controller;
class MloginController extends ComSjController{

    public function member(){
       $this->display();
    }
   public function dolog(){
        $merchant=M("merchant");
        $merchantarr=$merchant->field("sid,account,pwd,rand_str,status")->where("account='{$_POST['username']}'")->find();
        if(!empty($merchantarr)){//  账号正确
            $str=$merchantarr['rand_str'];
            $userpass=md5(md5($_POST['password']));
            $userpwd=md5($userpass.$str);
            if( $userpwd == $merchantarr['pwd'] ){//  登陆成功
                if($merchantarr['status'] == '2'){
                    $_SESSION['sj']['account'] = $merchantarr['account'];
                    $_SESSION['sj']['id'] = $merchantarr['sid'];
                    $_SESSION['sj']['status'] = $merchantarr['status'];
                    echo 'ok';
                    exit();
                }else{
                    echo '账户被冻结，请联系方大商城！';
                    exit();
                }
                
            }else{//  密码错误
                echo '密码错误';
                exit();
            }
        }else{//  账号错误
            echo '账号错误';
            exit();
        }
    }
    // 用户登出
    public function logout() {
        $_SESSION['sj'] = array();
        unset($_SESSION['sj']);
        $this->redirect('Index/index');
    }
}