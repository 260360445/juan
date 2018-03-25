<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;
class MerchantController extends ComController {
    /*
    *2017.1.2
    *开发者
    *商家列表
    */
    public function merchant(){
        $account = I('get.account','');
        if ($account != ''){
            $cond['account'] = ['like',"%$account%"];
        }
        $total = M('merchant')
            ->where($cond)
            ->count();
        $limit = 10;
        $page = new Page($total,$limit);
        $info = M('merchant')
            ->field('u.sid,u.account,u.reg_time,u.status,i.sid,i.smobile,i.sname,i.stype,i.ke_bal,i.fre_bal')
            ->alias('u')
            ->join('left join __MERCHANT_INFOR__ i on u.sid = i.sid')
            ->where($cond)
            ->limit($page->firstRow.','.$limit)
            ->order('u.sid desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    public function setpass(){
        if (IS_POST){
            $id = I('post.id','');
            $str=$this->_randStr(4);
            $pass=$this->_randStr(6,1);
            $upwd=md5(md5($pass));
            $data['pwd']=md5($upwd.$str);
            $data['rand_str']=$str;
            $addid=M("merchant")->where(['sid'=>$id])->save($data);
            if($addid){
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
    /*
    *2017.12.28
    *明明
    *分类添加
    */
    public function merchant_add(){
    	if (IS_POST){
    		$str=$this->_randStr(4);
            if($_POST['pwd'] != $_POST['repwd']){
                echo '两次密码不相同！';
                exit;
            }
            $upwd=md5(md5($_POST['pwd']));
            $data['pwd']=md5($upwd.$str);
            $data['rand_str']=$str;
            $data['reg_time']=time();
            $data['status']=$_POST['status'];
            $data['account']=$_POST['account'];
            //开启事务
            M()->startTrans();
            $res1=M("merchant")->add($data);
            //添加商家信息
            $res2 = M('merchant_infor')->add(['sid'=>$res1]);
            $res3 = M('store')->add(['sj_id'=>$res1]);
            if ($res1 && $res2 && $res3){
                M()->commit();
            	echo 'ok';
            	exit;
            }else{
                M()->rollback();
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
    public function merchant_edit(){
    	if (IS_POST){
    		$id = I('post.setid','');
            $data['status']=$_POST['status'];
            $data['account']=$_POST['account'];
            $addid=M("merchant")->where("sid=".$id)->save($data);
            if($addid){
            	echo 'ok';
            	exit;
            }else{
            	echo '修改失败';
            	exit;
            }
    	}else{
    		$id = I('get.id','');
    		$data=M("merchant")->field("account,status")->where("sid=".$id)->find();
    		$this->assign("infor",$data);
    		$this->display();
    	}
    }
    //-----删除(单删)-----//
    public function merchant_delete(){
        $id=isset($_POST['id'])?$_POST['id']:'';//单删id
        if ($id!="") {
            $result = M('goods')->where("sid = {$id}")->find();
            if ($result) {//分类下有商品不允许删除
                echo "商家名下有商品不允许删除";
                exit;
            }else{
                 $Model=M();
                 if ($Model->execute("delete from sc_merchant where sid='{$id}'")) {
                    echo "ok";exit;
                 }else{
                    echo "删除失败";exit;
                 }
            }
        }
    }
}