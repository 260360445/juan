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
        //查找特卖商品
        $goods = M('goods');
        $good_tm = $goods->field("id,goods_title,goods_logo,price,money,xfb")->where(['tm'=>2,'sta'=>3])->order('tm_time desc')->limit('4')->select();
        $this->assign('good_tm',$good_tm);
        //最新上架
        $good_xp = $goods->field("id,goods_title,goods_logo,price,xfb")->where(['xp'=>2,'sta'=>3])->order('xp_time desc')->limit('8')->select();
        $this->assign('good_xp',$good_xp);
        //轮播
        $ban = M('ban')->field("url,logo")->where(['state'=>2,'type'=>2])->order('sort desc,id desc')->select();
        $this->assign('ban',$ban);
    	$this->display();
    }
    #会员抽奖
    public function draw(){
        $this->display();
    }
     #积分兑换
    public function score(){
        $this->display();
    }
    #处理手动代付失败数据驳回提现记录
    /*public function cheTino(){
        $tinolog = M('tinolog')->field('money,kahao')->select();
        $kahao = '';
        foreach ($tinolog as $key=>$v) {
            if($key == 0){
                $kahao .= '\''.$v['kahao'].'\'';
            }else{
                $kahao .= ',\''.$v['kahao'].'\'';
            }
        }
        $ulst = M('user_infor')->where('yhk_kh in('.$kahao.')')->field('uid')->select();
        $uid = '';
        foreach ($ulst as $kk=>$vv) {
            if($kk == 0){
                $uid .= $vv['uid'];
            }else{
                $uid .= ','.$vv['uid'].'';
            }
        }
        #UID拼接字符串
        #echo $uid;
        $moblst = M('user')->where('id in('.$uid.')')->field('mobile')->select();
        foreach ($moblst as $kkk=>$vvv) {
            echo $vvv['mobile'].'<br>';
        }
        die;
    }*/
}
