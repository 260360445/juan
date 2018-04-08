<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends ComController {
    public function index(){
    	//轮播
        $ban = M('ban')->field("url,logo")->where(['state'=>2,'type'=>3])->order('sort desc,id desc')->select();
        $this->assign('ban',$ban);
        //猜你喜欢商品
        $good = M('goods')->where(['state'=>2])->order('sell desc,time desc')->limit('50')->select();
        $this->assign('goods',$good);
    	$this->display();
    }
}