<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;
class AdminController extends ComController
{
	/*
	  *管理员列表
	*/
	public function admin(){
	    $total = M('admin')
	        ->count();
	    $limit = 10;
	    $page = new Page($total,$limit);
	    $info = M('admin')
	    	->field('id,account,state,time,auth')
	        ->limit($page->firstRow.','.$limit)
	        ->order('id asc')
	        ->select();
	    $html = $page->show();
	    $this->assign('page',$html);
	    $this->assign('info',$info);
	    $this->display();
	}
	/*
	*--单删
	*/
	public function admin_delete(){
        $id=isset($_POST['id'])?$_POST['id']:'';//单删id
        if ($id!="") {
            $Model=M();
            if ($Model->execute("delete from tao_admin where id='{$id}'")) {
                echo "ok";exit;
            }else{
                echo "删除失败";exit;
            }
        }
    }

	/*
	  *管理员添加
	*/
	public function admin_add(){
		if(IS_POST){
			$admin = M('admin');
			#接到重复密码
			$repwd = trim($_POST['repwd']);
			$pwd  = trim($_POST['pwd']);
			$acc = trim($_POST['name']);#管理员账号
			if($repwd == '' || $pwd == '' || $acc == ''){
				echo '非法提交！';exit;
			}
			if($repwd == $pwd){
				$str=$this->_randStr(4);
                $upwd=md5(md5($pwd));
                $data['pwd']=md5($upwd.$str);
                $data['str']=$str;
				$data['account'] = $acc;
				$data['time'] = time();
				$data['state'] = $_POST['state'];
				$admin_id = $admin->add($data);
				if ($admin_id) {
					echo 'ok';exit;
				}else{
					echo '添加管理员失败！';exit;
				}
			}else{
				echo '两次密码不相同！';exit;
			}
		}else{
			$this->display();
		}
		
	}

	//管理员修改
	public function admin_edit(){
		if(IS_POST){
			$admin = M('admin');
			#接到重复密码
			$repwd = trim($_POST['repwd']);
			$pwd  = trim($_POST['pwd']);
			$acc = trim($_POST['name']);#管理员账号
			if($repwd == '' || $pwd == '' || $acc == ''){
				echo '非法提交！';exit;
			}
			if($repwd == $pwd){
				$str=$this->_randStr(4);
                $upwd=md5(md5($pwd));
                $data['pwd']=md5($upwd.$str);
                $data['str']=$str;
				$data['account'] = $acc;
				$data['time'] = time();
				$data['state'] = $_POST['state'];
				$id=I('post.setid','');
				if (false !== $admin->where(['id'=>$id])->save($data)) {
					echo 'ok';exit;
				}else{
					echo '修改管理员失败！';exit;
				}
			}else{
				echo '两次密码不相同！';exit;
			}
		}else{
			$admin = M('admin');
			$id=I('get.id','');
			$data=$admin->field('id,account,state')->where(['id'=>$id])->find();
			$this->assign('info',$data);
			$this->display();
		}
		
	}
	public function auth(){
		if(IS_POST){
			if(!empty($_POST['auth'])){
                $admin=M("admin");   
                $id=$_POST['editid'];
                $data['auth']=implode(",", $_POST['auth']);
                if(false!==$admin->where(['id'=>$id])->save($data)){
                    echo 'ok';exit;
                }else{
                    echo '操作失败';exit;
                }
            }else{
            	echo '请选择权限';exit;
            }
		}else{
			if(!empty($_GET['id'])){
				#查出修改的权限组
			    $auth = M('admin')->field("id,auth")->where(['id'=>$_GET['id']])->find();
				$this->assign('auth',$auth);
				$this->display();
			}
		}
	}
}