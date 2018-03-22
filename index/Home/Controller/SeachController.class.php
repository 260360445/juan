<?php
namespace Home\Controller;
use Think\Controller;
use Think\Pagei;
class SeachController extends ComController {
   public function seach(){
   		$query=I('get.query');
        $fid=I('get.pid');
        $sid=I('get.sonid');
        $where='';
        if($query && $fid && $sid){
            $where['goods_title'] = ['like',"%$query%"];
            $where['goods_cate_pid'] = $fid;
            $where['goods_cate_id'] = $sid;
        }else if($query && $fid && $sid == ''){
            $where['goods_title'] = ['like',"%$query%"];
            $where['goods_cate_pid'] = $fid;
        }else if($query && $sid && $fid == ''){
            $where['goods_title'] = ['like',"%$query%"];
            $where['goods_cate_id'] = $sid;
        }else if($query && $fid == '' && $sid == ''){
            $where['goods_title'] = ['like',"%$query%"];
        }else if($query == '' && $fid  && $sid == ''){
            $where['goods_cate_pid'] = $fid;
        }else if($query == '' && $fid == ''  && $sid){
            $where['goods_cate_id'] = $sid;
        }else if($query == '' && $fid && $sid){
            $where['goods_cate_pid'] = $fid;
            $where['goods_cate_id'] = $sid;
        }else{
            $where = '1=1';
        }
   		$total = M('goods')->where($where)->count();
        $limit = 40;
        $page = new Pagei($total,$limit);
        $result = M('goods')
            ->field('id,goods_title,goods_logo,goods_cate_id,price,xfb')
            ->where($where)
            ->limit($page->firstRow.','.$limit)
            ->order('id desc')
            ->select();
        if(empty($result)){
            $result = M('goods')
            ->field('id,goods_title,goods_logo,goods_cate_id,price,xfb')
            ->where('1=1')
            ->limit($page->firstRow.','.$limit)
            ->order('id desc')
            ->select();
        }
        //print_r(M("goods")->getLastSql());
        //查询一级分类M("goods")->getLastSql()
        $good_menu =M('goods_class')->field('goods_class_id,name')->where(['state'=>2,'pid'=>0])->order('sort asc,goods_class_id asc')->select();
        //查询二级分类id
        $pid='';
        foreach ($good_menu as $key => $value) {
        	if($key == 0){
        		$pid=$value['goods_class_id'];
        	}
        }
        if($fid){
        	$cond=['state'=>2,'pid'=>$fid];
        }else{
        	$cond=['state'=>2,'pid'=>$pid];
        }
        $goods_cate_list = M('goods_class')->field("goods_class_id,name")->where($cond)->order('sort asc,goods_class_id asc')->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('result',$result);
        $this->assign('good_menu',$good_menu);
        $this->assign('goods_cate_list',$goods_cate_list);
        if($fid){
        	$this->assign('pid',$fid);
        }else{
        	$this->assign('pid',$pid);
        }
   		$this->display();
   }
   public function sonclass(){
    $pid=I('post.pid');
    $res=M('goods_class')->field("goods_class_id,name,pid")->where(['pid'=>$pid])->select();
    $this->ajaxReturn($res);
    exit;
   }
}
