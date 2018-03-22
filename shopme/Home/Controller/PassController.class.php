<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;
class PassController extends ComController
{

	//管理员修改
	public function pass(){
		if(IS_POST){
			$admin = M('admin');
			#接到重复密码
			$repwd = trim($_POST['repwd']);
			$pwd  = trim($_POST['pwd']);
			if($repwd == '' || $pwd == ''){
				echo '非法提交！';exit;
			}
			if($repwd == $pwd){
				$str=$this->_randStr(4);
                $upwd=md5(md5($pwd));
                $data['pwd']=md5($upwd.$str);
                $data['str']=$str;
				$id=I('post.setid','');
				if (false !== $admin->where(['id'=>$id])->save($data)) {
					echo 'ok';exit;
				}else{
					echo '修改失败！';exit;
				}
			}else{
				echo '两次密码不相同！';exit;
			}
		}else{
			$this->display();
		}
		
	}
}