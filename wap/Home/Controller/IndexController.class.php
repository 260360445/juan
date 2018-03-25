<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends ComController {
    public function index(){
    	//轮播
        $ban = M('ban')->field("url,logo")->where(['state'=>2,'type'=>3])->order('sort desc,id desc')->select();
        $this->assign('ban',$ban);
        $goods = M('goods');
        //查找特卖商品
        $good_tm = $goods->field("id,goods_title,goods_logo,price,money,xfb")->where(['tm'=>2,'sta'=>3])->order('tm_time desc')->limit('4')->select();
        $this->assign('good_tm',$good_tm);
        //猜你喜欢商品
        $rel = $goods->field("id,goods_title,goods_logo,price,money,xfb,sell")->where(['sta'=>3])->order('sell desc')->limit('40')->select();
        $this->assign('goods',$rel);
    	$this->display();
    }
}