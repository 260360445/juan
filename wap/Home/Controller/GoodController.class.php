<?php
namespace Home\Controller;
use Think\Controller;
use Think\Image;
class GoodController extends ComController {
    /*
    *商品详情
    *2018.1.5
    */
    public function goodlist(){
        $id=I('get.id','');
        //商品详情
        $info = M('goods')
            ->field('id,title,price,glogo,gurl,store,sell,yhj_num,yhj_url,yhj_price,yhj_kl,state,ddq_kai')
            ->where(['id'=>$id,'state'=>2])
            ->find();
        //精品推荐
        $store_hot=M('goods')->field('id,title,price,glogo,sell,yhj_price')->where(['tj_sta'=>2])->limit(6)->order('tj_time desc')->select();
        $this->assign("info",$info);
        $this->assign("store_hot",$store_hot);
        $this->display();
    }
    /*
    *滚动加载
    */
    public function goodpage(){
        $page = (int)$_POST['page'];
        $type = (int)$_POST['type'];
        $where = '';
        $order = '';
        $count = 6;
        $limit = $page * $count;
        if($type == '2'){//咚咚抢
            $model=M('goods');
            $where = ['tm'=>2,'sta'=>3];
            $order = 'tm_time desc';
            $good = $model->field('id,goods_title,goods_logo,price,xfb')->where($where)->order($order)->limit("$limit,$count")->select();
        }else if($type == '3'){//超级人气
            $model=M('goods');
            $where = ['state'=>2];
            $order = 'sell desc,time desc';
            $good = $model->field('id,title,price,glogo,gurl,store,sell,yhj_num,yhj_sy_num,yhj_url,yhj_price,state,time')->where($where)->order($order)->limit("$limit,$count")->select();
        }else if($type == '4'){//按分类查找
            $model=M('goods');
            $cid=I('post.cid','');
            $where = ['goods_cate_id'=>$cid,'state'=>2];
            $order = 'sell desc';
            $good = $model->field('id,title,price,glogo,gurl,store,sell,yhj_num,yhj_sy_num,yhj_url,yhj_price,state,time')->where($where)->order($order)->limit("$limit,$count")->select();
        }else if($type == '5'){//小编力荐
            $model=M('goods');
            $where = ['state'=>2];
            $order = 'time desc,id desc';
            $good = $model->field('id,title,price,glogo,gurl,store,sell,yhj_num,yhj_sy_num,yhj_url,yhj_price,state,time')->where($where)->order($order)->limit("$limit,$count")->select();
        }else if($type == '6'){//搜索
            $seach=I('post.seach','');
            if($seach){
                $where['title'] = ['like',"%$seach%"];
            }else{
                $where = '1=1';
            }
            $good = M('goods')
            ->field('id,title,price,glogo,gurl,store,sell,yhj_num,yhj_sy_num,yhj_url,yhj_price,state,time')
            ->where($where)
            ->limit("$limit,$count")
            ->order('id desc')
            ->select();
        }else if($type == '7'){//9.9包邮
            $model=M('goods');
            $where = ['gtype'=>2,'state'=>2];
            $order = 'id desc,sell desc';
            $good = $model->field('id,title,price,glogo,gurl,store,sell,yhj_num,yhj_sy_num,yhj_url,yhj_price,state,time')->where($where)->order($order)->limit("$limit,$count")->select();
        }
        $this->ajaxReturn($good);
        exit();
    }
    public function imageImg(){
        $id=I('post.cid','');
        $img=M('comment_img')->field('showlogo')->where(['cid'=>$id])->select(); 
        $this->ajaxReturn($img);
        exit();
    }
    /**
    *全部商品
    */
    public function allgood(){
        $sonid=I('get.sonid','');
        $result = M('goods')
            ->field('id,title,price,glogo,gurl,store,sell,yhj_num,yhj_sy_num,yhj_url,yhj_price,state,time')
            ->where(['goods_cate_id'=>$sonid,'state'=>2])
            ->limit('6')
            ->order('id desc')
            ->select();
        $this->assign('result',$result);
        $this->display();
    }

    //咚咚会场
    public function specialsale(){
        //咚咚
        $where='';
        $time=date("H",time());
        $starttime=date("H",mktime(9));
        if($time < 9 || $time >= 9 && $time < 12){
            $where = ['ddq'=>2,'state'=>2,'ddq_kai'=>9];
        }else if($time >= 12 && $time < 15){
            $where = ['ddq'=>2,'state'=>2,'ddq_kai'=>12];
        }else if($time >= 15 && $time < 18){
            $where = ['ddq'=>2,'state'=>2,'ddq_kai'=>15];   
        }else if($time >= 18 && $time < 21){
            $where = ['ddq'=>2,'state'=>2,'ddq_kai'=>18];
        }else if($time >= 21 && $time < 24){
            $where = ['ddq'=>2,'state'=>2,'ddq_kai'=>21];
        }else if($time >= 24 && $time < $starttime){
            $where = ['ddq'=>2,'state'=>2,'ddq_kai'=>9];
        }
        $result = M('goods')
            ->field('id,title,price,glogo,sell,yhj_num,yhj_sy_num,yhj_price,ddq_kai')
            ->where($where)
            ->limit('18')
            ->order('ddq_time desc,id desc')
            ->select();
        $this->assign('result',$result);
        $this->assign('result_hot',$result_hot);
        $this->display();
    }
    //点击切换咚咚抢
    public function ajaxDdq(){
        $time = I('post.time','');
        $result = M('goods')
            ->field('id,title,price,glogo,sell,yhj_num,yhj_sy_num,yhj_price,ddq_kai')
            ->where(['ddq'=>2,'state'=>2,'ddq_kai'=>$time])
            ->limit('18')
            ->order('ddq_time desc,id desc')
            ->select();
        if($result){
            $result=$result;
        }else{
            $result='no';
        }
        $this->ajaxReturn($result);
    }
    //人气
    public function popularity(){
        $where=['state'=>2] ;
        //商品详情
        $result = M('goods')
            ->field('id,title,price,glogo,gurl,store,sell,yhj_num,yhj_sy_num,yhj_url,yhj_price,state,time')
            ->where($where)
            ->limit(6)
            ->order('sell desc,time desc')
            ->select();
        $this->assign('info',$result);
        $this->display();
    }
    //新品上架
    public function newgood(){
        $where=['state'=>2] ;
        //商品详情
        $result = M('goods')
            ->field('id,title,price,glogo,gurl,store,sell,yhj_num,yhj_sy_num,yhj_url,yhj_price,state,time')
            ->where($where)
            ->limit(6)
            ->order('time desc,id desc')
            ->select();
        $this->assign('result',$result);
        $this->display();
    }
    //9.9包邮
    public function jiuby(){
        $where=['gtype'=>2,'state'=>2];
        //商品详情
         $result = M('goods')
            ->field('id,title,price,glogo,gurl,store,sell,yhj_num,yhj_sy_num,yhj_url,yhj_price,state,time')
            ->where($where)
            ->limit(6)
            ->order('id desc,sell desc')
            ->select();
        $this->assign('result',$result);
        $this->display();
    }
    public function gclass(){
        $goods_class = M("goods_class");
        //查询一级分类
        $good_menu = $goods_class->field("goods_class_id,name")->where("state = 2 and pid = 0")->order('sort asc,goods_class_id asc')->select();
        $this->assign('good_menu',$good_menu);
        $this->display();
    }
}
