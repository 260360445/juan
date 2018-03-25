<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller {
  #登录
  public function login(){
    $this->display();
  }
  // 用户登出
	public function logout() {
        $_SESSION['ad'] = array();
        unset($_SESSION['ad']);
      	if(empty($_SESSION['ad'])){
      		$this->redirect('Index/index');
        	exit;
      	}
	}

	/*
	  *登陆
	*/
	public function doLogin(){
			$name=I('post.name');
			$password=I('post.pass');
        	$admin_user=M("admin")->field("id,account,pwd,str,state,auth")->where(['account'=>$name])->find();
        	if($admin_user){
        		if($admin_user['state'] == 2){
        			$str=$admin_user['str'];
		            $userpass=md5(md5($password));
		            $userpwd=md5($userpass.$str);
	        		if($admin_user['pwd'] == $userpwd){//  登陆成功
	        			$_SESSION['ad']['account'] = $admin_user['account'];
                $_SESSION['ad']['id'] = $admin_user['id'];
                $_SESSION['ad']['auth'] = $admin_user['auth'];
	        			echo 'ok';
	        			exit;
	        		}else{
	        			echo '密码不正确！';
	        			exit;
	        		}
        		}else{
        			echo '账户被冻结！';
        			exit;
        		}		        		
        	}else{
        		echo '账号错误！';
        		exit;
        	}
	}
}
