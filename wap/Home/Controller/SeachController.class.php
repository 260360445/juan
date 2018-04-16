<?php
namespace Home\Controller;
use Think\Controller;
class SeachController extends ComController {
   public function seach(){
   		$query=I('get.query');
        $where='';
        if($query){
            $where['title'] = ['like',"%$query%"];
        }else{
            $where = '1=1';
        }
        $limit = 6;
        $result = M('goods')
            ->field('id,title,glogo,goods_cate_id,price,sell,yhj_price')
            ->where($where)
            ->limit($limit)
            ->order('id desc')
            ->select();
      if(empty($result)){
        $result = M('goods')
            ->field('id,title,glogo,goods_cate_id,price,sell,yhj_price')
            ->where('1=1')
            ->limit($limit)
            ->order('id desc')
            ->select();
      }
      $this->assign('result',$result);
   		$this->display();
   }
}
