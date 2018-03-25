<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;
class BaoController extends ComController {
    //用户信息
    public function baolist(){
        $mob = I('get.mob','');
        $cond='';
        if ($mob != ''){
            $cond = ['mobile'=>$mob];
        }
        $total = M('buy_bao')->where($cond)->count();
        $limit = 10;
        $page = new Page($total,$limit);
        $info = M('buy_bao')
            ->where($cond)
            ->limit($page->firstRow.','.$limit)
            ->order('id desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    public function setType(){
        if (IS_POST){
            $id = I('post.id','');
            $type=I('post.type');
            if($type == 1){//已付款
                $data['status']=3; 
            }else{//作废
                $data['status']=6; 
            }
            if(false !== M("buy_bao")->where(['id'=>$id])->save($data)){
                $info['msg']='ok';
                echo $this->ajaxReturn($info);
                exit;
            }else{
                $info['msg']='设置失败！';
                echo $this->ajaxReturn($info);
                exit;
            }
        }
    }
}
