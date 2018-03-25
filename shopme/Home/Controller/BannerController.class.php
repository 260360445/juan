<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;
class BannerController extends ComController {
    /*
    *2017.12.28
    *明明
    *商品分类
    */
    public function ban(){
        $total = M('ban')->count();
        $limit = 10;
        $page = new Page($total,$limit);
        $info = M('ban')
            ->where($cond)
            ->limit($page->firstRow.','.$limit)
            ->order('sort desc,id desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    /*
    *2017.12.28
    *明明
    *分类添加
    */
    public function ban_add(){
    	if (IS_POST){
    		//图片更新
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   = 22222222 ;// 设置附件上传大小 
            $upload->exts = array('jepg','png','jpg');// 设置附件上传类型
            $upload->autoSub   = true;//自动子目录保存文件
            $upload->rootPath  = "./";
            $upload->savePath  ='Uploads/Ban/'; // 设置附件上传目录
            // 获取上传文件信息
            if(!empty($_FILES['logo']['name'])){//处理上传的文件
                $time=date('Y-m-d', time());
                $uploadinfo = $upload->uploadOne($_FILES['logo']);
                if ($uploadinfo) {//验证上传数组验证成功就拼接图片地址否则返回错误信息
                    $data['logo'] = $upload->savePath.$time.'/'.$uploadinfo['savename'];
                }else{
                    echo '上传失败';exit;
                } 
            }else{
                echo '请上传图片';exit;
            }
            //$data['url']=1;
            $data['type']=$_POST['type'];
            $data['state']=$_POST['state'];
            $data['time']=time();
            $addid=M('ban')->add($data);
            if($addid){
            	echo 'ok';
            	exit;
            }else{
            	echo '添加失败';
            	exit;
            }
    	}else{
    		$this->display();
    	}
    }
    
    /*
    *2017.12.28
    *明明
    *分类修改
    */
    public function ban_edit(){
    	if (IS_POST){
            //图片更新
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   = 22222222 ;// 设置附件上传大小 
            $upload->exts = array('jpg','png','gif');// 设置附件上传类型
            $upload->autoSub   = true;//自动子目录保存文件
            $upload->rootPath  = "./";
            $upload->savePath  ='Uploads/Ban/'; // 设置附件上传目录
                 // 获取上传文件信息
            if(!empty($_FILES['logo']['name'])){//处理上传的文件
                $time=date('Y-m-d', time());
                $Url=M('ban')->field("".$key."")->where('')->find();
                $save_path=$upload->rootPath.$Url["".$key.""];
                @unlink($save_path);//删除原来的图片
                $uploadinfo = $upload->uploadOne($_FILES['logo']);
                if ($uploadinfo) {//验证上传数组验证成功就拼接图片地址否则返回错误信息
                    $data['logo'] = $upload->savePath.$time.'/'.$uploadinfo['savename'];
                }else{
                    echo '上传失败';exit;
                } 
            }
            $data['state']=$_POST['state'];
            //$data['url']=2;
            $data['type']=$_POST['type'];
            $data['time']=time();
            $id = I('post.setid','');
            if(false !== M('ban')->where("id=".$id)->save($data)){
            	echo 'ok';
            	exit;
            }else{
            	echo '修改失败';
            	exit;
            }
    	}else{
    		$id = I('get.id','');
    		$data=M("ban")->field("id,url,logo,state,type")->where(['id'=>$id])->find();
    		$this->assign("infor",$data);
    		$this->display();
    	}
    }
    
    //-----删除(单删)-----//
    public function ban_delete(){
        $id=isset($_POST['id'])?$_POST['id']:'';//单删id
        if ($id!="") {
            $Model=M();
            if ($Model->execute("delete from sc_ban where id='{$id}'")) {
                echo "ok";exit;
            }else{
                echo "删除失败";exit;
            }
        }
    }
    //置顶
    public function zdSet(){
        $id=isset($_POST['id'])?$_POST['id']:'';//单删id
        if ($id!="") {
            $data['sort']=time();
            if (false !== M('ban')->where(['id'=>$id])->save($data)) {
                echo "ok";exit;
            }else{
                echo "置顶失败";exit;
            }
        }
    }
}