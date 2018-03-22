<?php
namespace Home\Controller;
use Think\Controller;
use Think\Pagei;
class SeachController extends ComController {
   public function seach(){
   		$query=I('get.query');
        $where='';
        if($query){
            $where['goods_title'] = ['like',"%$query%"];
        }else{
            $where = '1=1';
        }
        $limit = 6;
        $result = M('goods')
            ->field('id,goods_title,goods_logo,goods_cate_id,price,xfb')
            ->where($where)
            ->limit($limit)
            ->order('id desc')
            ->select();
        if(empty($result)){
            $result = M('goods')
            ->field('id,goods_title,goods_logo,goods_cate_id,price,xfb')
            ->where('1=1')
            ->limit($limit)
            ->order('id desc')
            ->select();
        }
        $this->assign('result',$result);
   		$this->display();
   }
}
