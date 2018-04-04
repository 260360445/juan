<?php
namespace Home\Controller;
use Think\Controller;
use Think\Pagei;
class SeachController extends ComController {
   public function seach(){
   		$query=I('get.query');
        $id=I('get.gclass','');
        $where=['state'=>2] ;
        if($query != '' && $id != ''){
            $where['title'] = ['like',"%$query%"];
            $where['goods_cate_id']= $id;
        }else if($query == '' && $id != ''){
            $where['goods_cate_id']= $id;
        }else if($query != '' && $id == ''){
            $where['title'] = ['like',"%$query%"];
        }else{
            $where = '1=1';
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
            ->order('id desc,sell desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('result',$result);
        $this->assign('gclass',$gclass);
        $this->display();
   }
}
