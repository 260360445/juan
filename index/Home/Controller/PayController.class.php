<?php
namespace Home\Controller;
use Think\Controller;
class PayController extends ComController{
    #首页展示
    public function pay(){
    	$this->display();
    }
    #邀请充值
    public function rebate(){
        $this->display();
    }
    
    #新手专区
    public function experience(){
        $this->display();
    }
    #晒单专区
    public function share(){
        $this->display();
    }
    #急速专区
    public function speed(){
        $this->display();
    }
    #最新揭晓专区
    public function announced(){
        $this->display();
    }
    #会员抽奖
    public function draw(){
        $this->display();
    }
     #会员认购
    public function vip(){
        $this->display();
    }
     #积分兑换
    public function score(){
        $this->display();
    }
}
