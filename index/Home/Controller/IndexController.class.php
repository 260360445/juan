<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends ComController{
    #首页展示
    public function index(){
        
       //按照分类循环商品
        $goods_class = M("goods_class");
        $good_menu = $goods_class->where("state = 2")->order('sort asc,goods_class_id asc')->select();
        $good_tree = $this->getTree($good_menu,0);
        $this->assign('goods',$good_tree);
         //查找秒杀
        $goods = M('goods');
        $good_tm = $goods->where(['ms_sta'=>2,'state'=>2])->order('ms_time desc,sell desc')->limit('6')->select();
        $this->assign('good_tm',$good_tm);
        //查找商品
        $good = $goods->where(['state'=>2])->order('sell desc,time desc')->limit('50')->select();
        $this->assign('good',$good);
        //轮播
        $ban = M('ban')->field("url,logo")->where(['state'=>2,'type'=>2])->order('sort desc,id desc')->select();
        $this->assign('ban',$ban);
    	$this->display();
    }
}
