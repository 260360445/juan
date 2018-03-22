<?php
namespace Home\Controller;
use Think\Controller;
class GoodController extends ComController {
    /*
    *商品详情
    *2018.1.5
    */
    public function goodlist(){
        $id=I('get.id','');
        //商品详情
        $info = M('goods')
            ->field('id,goods_title,goods_logo,price,sid,money,xfb,goods_small_title,kucun,cont,sell,comment')
            ->where(['id'=>$id,'sta'=>3])
            ->find();
        //评价
        $comment = M('comment')
            ->field('o.id,o.cont,o.ptime,u.nick_name,u.photo')
            ->alias('o')
            ->join('left join __USER_INFOR__ u on o.uid = u.uid')
            ->where(['o.gid'=>$id])
            ->limit('6')
            ->order('o.id desc')
            ->select();
        $this->assign('comment',$comment);
        if($info){
            $this->assign("type",'yes');
            $this->assign("info",$info);
        }
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
        if($type == '2'){//特卖
            $model=M('goods');
            $where = ['tm'=>2,'sta'=>3];
            $order = 'tm_time desc';
            $good = $model->field('id,goods_title,goods_logo,price,xfb')->where($where)->order($order)->limit("$limit,$count")->select();
        }else if($type == '3'){//新品
            $model=M('goods');
            $where = ['xp'=>2,'sta'=>3];
            $order = 'xp_time desc';
            $good = $model->field('id,goods_title,goods_logo,price,xfb')->where($where)->order($order)->limit("$limit,$count")->select();
        }else if($type == '4'){//按分类查找
            $model=M('goods');
            $cid=I('post.cid','');
            $where = ['goods_cate_id'=>$cid,'sta'=>3];
            $order = 'sell desc';
            $good = $model->field('id,goods_title,goods_logo,price,xfb')->where($where)->order($order)->limit("$limit,$count")->select();
        }else if($type == '5'){//评价
            $id=I('post.gid','');
            $good = M('comment')
                ->field('o.id,o.cont,o.ptime,u.nick_name,u.photo')
                ->alias('o')
                ->join('left join __USER_INFOR__ u on o.uid = u.uid')
                ->where(['o.gid'=>$id])
                ->limit("$limit,$count")
                ->order('o.id desc')
                ->select();
        }else if($type == '6'){//搜索
            $seach=I('post.seach','');
            if($seach){
                $where['goods_title'] = ['like',"%$seach%"];
            }else{
                $where = '1=1';
            }
            $good = M('goods')
            ->field('id,goods_title,goods_logo,goods_cate_id,price,xfb')
            ->where($where)
            ->limit("$limit,$count")
            ->order('id desc')
            ->select();
            if(empty($good)){
                $good = M('goods')
                ->field('id,goods_title,goods_logo,goods_cate_id,price,xfb')
                ->where('1=1')
                ->limit("$limit,$count")
                ->order('id desc')
                ->select();
            }
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
        $where['goods_cate_id']=$sonid;
        $where['sta']=3;
        $result = M('goods')
            ->field('id,goods_title,goods_logo,goods_cate_id,price,xfb')
            ->where($where)
            ->limit('10')
            ->order('id desc')
            ->select();
        $this->assign('result',$result);
        $this->display();
    }

    //特卖会场
    public function specialsale(){
        //特卖商品
        $total = M('goods')->where('tm = 2')->count();
        $result = M('goods')
            ->field('id,goods_title,goods_logo,price,xfb')
            ->where(['tm'=>2,'sta'=>3])
            ->order('tm_time desc')
            ->limit('6')
            ->select();
        $this->assign('page',$html);
        $this->assign('result',$result);
        $this->display();
    }
    
    //新品上架
    public function newgood(){
        $result = M('goods')
            ->field('id,goods_title,goods_logo,price,kucun,sell,comment,xfb')
            ->where(['xp'=>2,'sta'=>3])
            ->limit('6')
            ->order('xp_time desc')
            ->select();
        $this->assign('result',$result);
        $this->display();
    }
    public function gclass(){
        $goods_class = M("goods_class");
        //查询一级分类
        $good_menu = $goods_class->field("goods_class_id,name")->where("state = 2 and pid = 0")->order('sort asc,goods_class_id asc')->select();
        //查询二级分类
        $pid='';
        foreach ($good_menu as $key => $value) {
            if($key == 0){
                $pid = $value['goods_class_id'];    
            }
        }
        $goods_cate_list = $goods_class->field("goods_class_id,name,mic")->where(['pid'=>$pid,'state'=>2])->order('sort asc,goods_class_id asc')->select();
        $this->assign('good_menu',$good_menu);
        $this->assign('goods_cate_list',$goods_cate_list);
        $this->display();
    }
    public function ajaxclass(){
        $cid=I('post.cid','');
        $goods_cate_list = M("goods_class")->field("goods_class_id,name,mic")->where(['pid'=>$cid,'state'=>2])->order('sort asc,goods_class_id asc')->select();
        $this->ajaxReturn($goods_cate_list);exit;
    }
}
