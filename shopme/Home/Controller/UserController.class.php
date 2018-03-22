<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;
class UserController extends ComController {
    //用户信息
    public function user(){
        $mob = I('get.mob','');
        if ($mob != ''){
            $cond = 'mobile=\''.$mob.'\' or wht_pay=\''.$mob.'\' or shop_pay=\''.$mob.'\'';
        }
        $total = M('user')
            ->where($cond)
            ->count();
        $limit = 10;
        $page = new Page($total,$limit);
        $info = M('user')
            ->field('u.id,u.mobile,u.shop_pay,u.wht_pay,u.reg_time,u.wht_reg_time,u.status,i.uid,i.bal,i.ke_bal')
            ->alias('u')
            ->join('left join __USER_INFOR__ i on u.id = i.uid')
            ->where($cond)
            ->limit($page->firstRow.','.$limit)
            ->order('u.reg_time desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    //用户设置
    public function setuser(){
        if (IS_POST){
            $data['status']=I('post.status','');
            $id = I('post.item','');
            if(false !== M('user')->where(['id'=>$id])->save($data)){
                echo 'ok';
                exit;
            }else{
                echo '修改失败';
                exit;
            }
        }else{
            $id = I('get.item','');
            $user=M('user')->field('status')->where(['id'=>$id])->find();
            $this->assign('info',$user);
            $this->display();
        }
    }
    //地址管理
    public function address(){
        $mob = I('get.mob','');
        $cond='';
        if ($mob != ''){
            $cond['mobile'] = ['like',"%$mob%"];
        }
        $total = M('address')
            ->where($cond)
            ->count();
        $limit = 10;
        $page = new Page($total,$limit);
        $info = M('address')
            ->field('id,name,street,mobile,sta,province,city,area')
            ->where($cond)
            ->limit($page->firstRow.','.$limit)
            ->order('id desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();

    }
      //-----删除(单删)-----//
    public function ads_delete(){
        $id=isset($_POST['id'])?$_POST['id']:'';//单删id
        if ($id!="") {
           $Model=M();
            if ($Model->execute("delete from sc_address where id='{$id}'")) {
                echo "ok";exit;
            }else{
                echo "删除失败";exit;
            }
        }
    }
    //冻结账户
    public function close(){
        if (IS_POST){
            $id = I('post.id','');
            if(false !==  M("user")->where(['id'=>$id])->save(['status'=>3])){
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
    //激活账户
    public function open(){
        if (IS_POST){
            $id = I('post.id','');
            if(false !==  M("user")->where(['id'=>$id])->save(['status'=>2])){
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
    //清空钱包地址
    public function clarewht(){
        if (IS_POST){
            $id = I('post.id','');
            $type=I('post.type','');
            if($type == 1){//清空钱包地址
                if(false !==  M("user")->where(['id'=>$id])->save(['wht_pay'=>0])){
                    $info['msg']='ok';
                    echo $this->ajaxReturn($info);
                    exit;
                }else{
                    $info['msg']='设置失败！';
                    echo $this->ajaxReturn($info);
                    exit;
                }
            }else if($type == 2){//清空银行卡
                if(false !==  M("user_infor")->where(['uid'=>$id])->save(['yhk_kh'=>'','yhk_name'=>'','yhk_type'=>'','yhk_sta'=>3])){
                    $info['msg']='ok';
                    echo $this->ajaxReturn($info);
                    exit;
                }else{
                    $info['msg']='设置失败！';
                    echo $this->ajaxReturn($info);
                    exit;
                }
            }else if($type == 3){//清空身份信息
                if(false !==  M("user_infor")->where(['uid'=>$id])->save(['uname'=>'','ucode'=>'','usta'=>3])){
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
    public function setpass(){
        if (IS_POST){
            $id = I('post.id','');
            $type=I('post.type');
            if($type == 1){//登录密码
                $str=$this->_randStr(4);
                $pass='wht'.$this->_randStr(6,1);
                $upwd=md5(md5($pass));
                $data['pwd']=md5($upwd.$str);
                $data['rand_str']=$str; 
            }else{//支付密码
                $str=$this->_randStr(4);
                $pass=$this->_randStr(6,1);
                $upwd=md5(md5($pass));
                $data['pay_pwd']=md5($upwd.$str);
                $data['pay_rand_str']=$str; 
            }
            if(false !== M("user")->where(['id'=>$id])->save($data)){
                $info['msg']='ok';
                $info['flg']=$pass;
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
