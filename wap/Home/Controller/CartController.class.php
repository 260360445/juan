<?php
namespace Home\Controller;
use Think\Controller;
use Think\Pagei;
class CartController extends ComController{
	//会员首页
    protected function _initialize(){
        if(empty($_SESSION['wap']['id'])){
            //跳转到认证网关
            $this->redirect('Login/login');
        }
    }
    public function cartCount(){
    	$cart = M('cart');
    	$good=M('goods');
    	$del= $cart->field('cart_id,gid')->where(['uid'=>$_SESSION['wap']['id'],'pay'=>3])->select();
		foreach ($del as $key => $value) {
			$goods=$good->field('id')->where(['id'=>$value['gid']])->find();
			if(!$goods){
				$cart->where(['cart_id'=>$value['cart_id'],'uid'=>$_SESSION['wap']['id']])->delete();
			}
		}
    	$cartCount=$cart->field("cart_id")->where(['uid'=>$_SESSION['wap']['id'],'pay'=>3])->count();
    	if($cartCount == 0){
    		$infor=0;
    	}else{
    		$infor=$cartCount;
    	}
    	$this->ajaxReturn($infor);
    	exit;
    }
	public function cart(){
		$info = M('cart')
	            ->alias('c')
	            ->join('left join __GOODS__ g on c.gid = g.id')
	            ->join('left join __GOODS_CLASS__ l on g.goods_cate_id = l.goods_class_id')
	            ->field('c.cart_id,c.gid,c.uid,c.buynum,c.addtime,g.id,g.goods_title,g.goods_logo,g.goods_cate_id,g.price,g.kucun,g.xfb,l.name')
	            ->where(['c.uid'=>$_SESSION['wap']['id'],'c.pay'=>3])
	            ->order('c.addtime desc')
	            ->select();
		$this->assign("cartlist",$info);
	    $this->display();
	}
	//删除
	public function orderdel(){
		$id=isset($_POST['id'])?$_POST['id']:'';//单删id
        if ($id!="") {
            $Model=M();
            if ($Model->execute("delete from sc_cart where cart_id='{$id}'")) {
                echo "ok";exit;
            }else{
                echo "删除失败";exit;
            }
        }
	}
	//添加购物车
	public function docart(){
	    $shopcart_m = M('cart');
	    $gid =I("post.id","");
	    $buyNum=I('post.num','');
		if(!preg_match("/^[1-9][0-9]*$/",$buyNum)){
            $returndata='购买数量错误！';
            $this->ajaxReturn($returndata);exit;
        }
        $kucun=M('goods')->field('kucun')->where(['id'=>$gid])->find();
        if($kucun['kucun'] > 0){
        	if($kucun['kucun'] >= $buyNum){
        		$cartlist = $shopcart_m->field("buynum,pay")->where(['gid'=>$gid,'uid'=>$_SESSION['wap']['id']])->find();
			    if($cartlist){//如果购物车中存在商品id 购买数量累加
			    	$shoplist['buynum'] = $cartlist['buynum'] + $buyNum;
			    	if($cartlist['pay'] == 2){//已付款
			    		$data['buynum'] = 0;
			    		$data['pay'] = 3;
			    		$shopcart_m->where(['gid'=>$gid,'uid'=>$_SESSION['wap']['id']])->save($data);
			    	}
			    	if(false !== $shopcart_m->where(['gid'=>$gid,'uid'=>$_SESSION['wap']['id']])->save($shoplist)){
						$returndata='ok';$this->ajaxReturn($returndata);exit;
					}else{
						$returndata='添加失败！';$this->ajaxReturn($returndata);exit;
					}
			    }else{// 若购物车中不存在 则直接添加
			    	$shopdata['gid'] = $gid;
			        $shopdata['uid'] = $_SESSION['wap']['id'];
			        $shopdata['buynum'] = $buyNum;
			        $shopdata['pay'] = 3;
			        $shopdata['addtime'] = time();
			        $addID=$shopcart_m->add($shopdata);
			        if($addID){
			        	$returndata='ok';$this->ajaxReturn($returndata);exit;
					}else{
						$returndata='添加失败！';$this->ajaxReturn($returndata);exit;
					}
			    }
        	}else{
        		$returndata='该商品库存不足！';$this->ajaxReturn($returndata);exit;
        	}
        }else{
        	$returndata='该商品库存不足！';$this->ajaxReturn($returndata);exit;
        }
	}
}

