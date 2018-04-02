<?php
namespace Home\Controller;
use Think\Controller;
use Think\Pagei;
class GoodController extends ComController {
    /*
    *商品详情
    *2018.1.5
    */
    public function goodlist(){
        $id=I('get.id','');
        //商品详情
        $info = M('goods')
            ->field('id,title,price,glogo,gurl,store,sell,yhj_num,yhj_url,yhj_price,state')
            ->where(['id'=>$id,'sta'=>3])
            ->find();
        if($info['state']== '2'){
            //看了又看
            $store_look=M('goods')->field('id,glogo')->limit(6)->order('sell desc')->select();
            //精品推荐
            $store_hot=M('goods')->field('id,title,price,glogo,sell,yhj_price')->where(['tj_sta'=>2])->limit(6)->order('tj_time desc')->select();
            $this->assign("type",'yes');
            $this->assign("info",$info);
            $this->assign("store_hot",$store_hot);
            $this->assign("store_look",$store_look);
        }
        $this->display();
    }
    //咚咚会场
    public function specialsale(){
        //特卖最热商品
        $result_hot = M('goods')
            ->field('id,title,glogo,price,sell,yhj_num,yhj_sy_num')
            ->where(['ddq'=>2,'zd_ddq'=>2,'state'=>2])
            ->order('zd_ddq_time desc')
            ->limit(7)
            ->select();
        //特卖商品
        $result = M('goods')
            ->field('id,title,price,glogo,gurl,store,sell,yhj_num,yhj_sy_num,yhj_url,yhj_price,state')
            ->where(['ddq'=>2,'state'=>2])
            ->limit('18')
            ->order('ddq_time desc,id desc')
            ->select();
        $this->assign('result',$result);
        $this->assign('result_hot',$result_hot);
        $this->display();
    }
    //9.9
    public function newgood(){
        $id=I('get.gclass','');
        $where=['gtype'=>2,'state'=>2] ;
        if($id != ''){
            $where['goods_cate_id']= $id;
        }
        //商品分类
        $gclass=M('goods_class')->field('goods_class_id,name')->where(['state'=>2])->select();
        //商品详情
        $total = M('goods')->where($where)->count();
        $limit = 40;
        $page = new Pagei($total,$limit);
        $result = M('goods')
            ->field('id,title,price,glogo,gurl,store,sell,yhj_num,yhj_sy_num,yhj_url,yhj_price,state')
            ->where($where)
            ->limit($page->firstRow.','.$limit)
            ->order('sell desc,id desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('result',$result);
        $this->assign('gclass',$gclass);
        $this->display();
    }
    //超级人气
    public function popularity(){
        $id=I('get.gclass','');
        $where=['state'=>2] ;
        if($id != ''){
            $where['goods_cate_id']= $id;
        }
        //商品分类
        $gclass=M('goods_class')->field('goods_class_id,name')->where($where)->select();
        //商品详情
        $total = M('goods')->where($where)->count();
        $limit = 40;
        $page = new Pagei($total,$limit);
        $result = M('goods')
            ->field('id,title,price,glogo,gurl,store,sell,yhj_num,yhj_sy_num,yhj_url,yhj_price,state')
            ->where($where)
            ->limit($page->firstRow.','.$limit)
            ->order('sell desc,time desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('gclass',$gclass);
        $this->assign('info',$result);
        $this->display();
    }
    //领卷优惠
    public function allgood(){
        $id=I('get.gclass','');
        $s=I('get.s','');
        $where=['state'=>2] ;
        $order='time desc,id desc';
        if($id != '' && $s != ''){
            $where['goods_cate_id']= $id;
            if($s == 'zh'){
                $order= 'time desc,id desc';
            }else if($s == 'new'){
                $order='lid desc,id desc';
            }else if($s == 'sell'){
                $order='sell desc,price desc';    
            }else if($s == 'price'){
                $order='price desc,sell desc';
            }
        }else if($id != '' && $s == ''){
            $where['goods_cate_id']= $id;
        }else if($id == '' && $s != ''){
            if($s == 'zh'){
                $order= 'time desc,id desc';
            }else if($s == 'new'){
                $order='lid desc,id desc';
            }else if($s == 'sell'){
                $order='sell desc,price desc';    
            }else if($s == 'price'){
                $order='price desc,sell desc';
            }
        }
        //商品分类
        $gclass=M('goods_class')->field('goods_class_id,name')->where($where)->select();
        //商品详情
        $total = M('goods')->where($where)->count();
        $limit = 40;
        $page = new Pagei($total,$limit);
        $result = M('goods')
            ->field('id,title,price,glogo,gurl,sell,yhj_price')
            ->where($where)
            ->limit($page->firstRow.','.$limit)
            ->order($order)
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$result);
        $this->assign('gclass',$gclass);
        $this->assign('total',$total);
        $this->display();
    }
}
