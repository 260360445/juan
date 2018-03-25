<?php
namespace Home\Controller;
use Think\Controller;
use Think\Pagei;
class GoodController extends ComController {
    /*
    *2018.1.5
    *首页二级分类鼠标悬浮获取商品
    *
    */
    public function getGoods(){
        $map['goods_cate_id'] = array('in',$_POST['bid']);
        $map['sta'] = 3;
        $good = M("goods")->field("id,goods_title,goods_logo,goods_cate_id,price,xfb,kucun,sell,comment")->where($map)->order('goods_time desc')->limit(7)->select();
        echo $this->ajaxReturn($good);
    }
    /*
    *商品详情
    *2018.1.5
    */
    public function goodlist(){
        $id=I('get.id','');
        //商品详情
        $info = M('goods')
            ->field('id,goods_title,price,sid,money,xfb,goods_small_title,kucun,cont,sell,comment')
            ->where(['id'=>$id,'sta'=>3])
            ->find();
        //商家    
        $store=M('store')->field('store_name')->where(['sj_id'=>$info['sid']])->find();
        //商家商品
        $store_good=M('goods')->field('id')->where(['sid'=>$info['sid']])->count();
        //销量
        $store_sell=M('order')->field('order_id')->where(['sid'=>$info['sid']])->count();
        //看了又看
        $store_look=M('goods')->field('id,goods_logo')->where(['sid'=>$info['sid']])->limit(6)->order('id desc')->select();
        //热卖商品
        $store_hot=M('goods')->field('id,goods_title,goods_logo,price,xfb')->where(['sid'=>$info['sid']])->limit(6)->order('sell desc')->select();
        $this->assign("store_hot",$store_hot);
        $this->assign("store_look",$store_look);
        $this->assign("store_good",$store_good);
        $this->assign("store_sell",$store_sell);
        $this->assign("store",$store);
        if($info){
            $this->assign("type",'yes');
            $this->assign("info",$info);
        }
        $this->display();
    }
    public function pingjia(){
        $id=I('get.gid','');
        $count = M('comment')->where(['gid'=>$id])->count();   //计算总数
        $limit = 6;
        $Page = new \Think\PageAjax($count, $limit);
        $comment = M('comment')
            ->field('o.id,o.cont,o.ptime,u.nick_name,u.photo')
            ->alias('o')
            ->join('left join __USER_INFOR__ u on o.uid = u.uid')
            ->where(['o.gid'=>$id])
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->order('o.id desc')
            ->select();
        $html = $Page->show();
        $this->assign('page',$html);
        $this->assign('comment',$comment);
        $this->display();
    }
    /**
    *全部商品(一级分类)
    */
    public function allgood(){
        $id=I('get.id','');
        if($id == ''){
            $type='1001';
            $this->assign('type',$type);
        }else{
            $sonid=I('get.sonid','');
            $goods_class = M("goods_class");
            //查询一级分类
            $good_menu = $goods_class->field("goods_class_id,name")->where("state = 2 and pid = 0")->order('sort asc,goods_class_id asc')->select();
            //查询二级分类
            $goods_cate_list = $goods_class->field("goods_class_id,name")->where("pid = ".$id)->order('sort asc,goods_class_id asc')->select();
            //查询分类下的商品
            if($id != '' && $sonid != ''){
                $goods_cate_id_true = $goods_class->field("goods_class_id")->where("goods_class_id = ".$id)->find();
                if($goods_cate_id_true){
                    $goods_cate_id_true_son = $goods_class->field("goods_class_id")->where("goods_class_id = ".$sonid)->find();
                    if($goods_cate_id_true_son){
                        $where['goods_cate_id']=$sonid;
                        $where['sta']=3;
                        $total = M('goods')->where($where)->count();
                        $limit = 40;
                        $page = new Pagei($total,$limit);
                        $result = M('goods')
                            ->field('id,goods_title,goods_logo,goods_cate_id,price,xfb')
                            ->where($where)
                            ->limit($page->firstRow.','.$limit)
                            ->order('id desc')
                            ->select();
                        if($result){
                            $html = $page->show();
                            $type='1000';
                            $this->assign('type',$type);
                            $this->assign('page',$html);
                            $this->assign('result',$result);
                        }else{//小分类下没有商品
                            $type='1003';
                            $this->assign('type',$type);    
                        }
                    }else{//小分类错误
                        $type='1004';
                        $this->assign('type',$type);
                    }
                }else{
                    $type='1001';
                    $this->assign('type',$type);
                }
            }else{
                if($id != '' && $sonid == ''){
                    $goods_cate_id_true = $goods_class->field("goods_class_id")->where("goods_class_id = ".$id)->find();
                    $goods_cate_id = $goods_class->field("goods_class_id")->where("pid = ".$id)->select();
                    if($goods_cate_id_true){
                        if($goods_cate_id){
                            $strid='';
                            foreach ($goods_cate_id as $key => $value) {
                                if($key == 0){
                                    $strid.=$value['goods_class_id'];
                                }else{
                                    $strid.=','.$value['goods_class_id'];   
                                }
                            }
                            $where['goods_cate_id']=['in',''.$strid.''];
                            $where['sta']=3;
                            $total = M('goods')->where($where)->count();
                            $limit = 40;
                            $page = new Pagei($total,$limit);
                            $result = M('goods')
                                ->field('id,goods_title,goods_logo,goods_cate_id,price,xfb')
                                ->where($where)
                                ->limit($page->firstRow.','.$limit)
                                ->order('id desc')
                                ->select();
                            if($result){
                                $html = $page->show();
                                $type='1000';
                                $this->assign('type',$type);
                                $this->assign('page',$html);
                                $this->assign('result',$result);
                            }else{//小分类下没有商品
                                $type='1003';
                                $this->assign('type',$type);    
                            }
                        }else{//大分类下没有小分类
                            $type='1002';
                            $this->assign('type',$type);
                        }
                    }else{
                        $type='1001';
                        $this->assign('type',$type);
                    }
                    //echo M('goods')->getLastSql();
                    //print_r($result);
                }else{//大分类错误
                    $type='1001';
                    $this->assign('type',$type);
                }
            }
            $this->assign("goods_class",$good_menu);
            $this->assign("goods_cate_list",$goods_cate_list);
        }
        $goods_num = M('goods')->count();
        $this->assign("goods_num",$goods_num);
        $this->display();
    }
    /**
    *全部商品(二级分类)
    */
    public function goods_cate_list(){
        $id=I('get.id','');
        $sonid=I('get.sonid','');
        $goods_class = M("goods_class");
        $good_menu = $goods_class->where("pid = ".$id)->order('sort asc,goods_class_id asc')->select();
        $this->assign("goods_class",$good_menu);
        $this->display();
    }
    //特卖会场
    public function specialsale(){
        //特卖最热商品
        $result_hot = M('goods')
            ->field('id,goods_title,goods_logo,price,kucun,sell,xfb')
            ->where(['tm'=>2,'sta'=>3])
            ->order('sell desc')
            ->limit(6)
            ->select();
        //特卖商品
        $total = M('goods')->where('tm = 2')->count();
        $limit = 27;
        $page = new Pagei($total,$limit);
        $result = M('goods')
            ->field('id,goods_title,goods_logo,price,xfb')
            ->where(['tm'=>2,'sta'=>3])
            ->limit($page->firstRow.','.$limit)
            ->order('tm_time desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('result',$result);
        $this->assign('result_hot',$result_hot);
        $this->display('Good/specialsale');
    }
    //新品上架
    public function newgood(){
        $total = M('goods')->where(['xp'=>2,'sta'=>3])->count();
        $limit = 28;
        $page = new Pagei($total,$limit);
        $result = M('goods')
            ->field('id,goods_title,goods_logo,price,kucun,sell,comment,xfb')
            ->where(['xp'=>2,'sta'=>3])
            ->limit($page->firstRow.','.$limit)
            ->order('xp_time desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('result',$result);
        $this->display('Good/newgood');
    }
}
