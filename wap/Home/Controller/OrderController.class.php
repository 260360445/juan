<?php
namespace Home\Controller;

use Think\Controller;
class OrderController extends ComController{
	//会员首页
    protected function _initialize(){
        if(empty($_SESSION['wap']['id'])){
            //跳转到认证网关
            $this->redirect('Login/login');
        }
    }
	//订单数据--全部
	public function order(){
        $info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.price,o.xfb,g.id,g.goods_title,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['uid'=>$_SESSION['wap']['id']])
            ->limit('6')
            ->order('o.order_id desc')
            ->select();
        $this->assign('info',$info);
        $this->display();
	}
	//订单数据--待付款
	public function payorderlist(){
        $info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.price,o.xfb,g.id,g.goods_title,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['uid'=>$_SESSION['wap']['id'],'state'=>5])
            ->limit('6')
            ->order('o.order_id desc')
            ->select();
        $this->assign('info',$info);
        $this->display();
	}
	//订单数据--待付款--详情
	public function payordercon(){
		$id=I('get.order','');
		$info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.state,o.address_id,o.buynum,o.sid,o.sumpay,o.settime,o.price,o.xfb,g.id,g.goods_title,g.goods_cate_id,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['o.order_id'=>$id])
            ->find();
        $goods = M('goods');
        $address=M('address')->field('name,street,mobile,province,city,area')->where(['id'=>$info['address_id']])->find();
        $this->assign("address",$address);
        $this->assign("info",$info); 
		$this->display();
	}
	//订单数据--待发货
	public function order_record(){
        $info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.price,o.xfb,g.id,g.goods_title,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['uid'=>$_SESSION['wap']['id'],'state'=>3])
            ->limit('6')
            ->order('o.order_id desc')
            ->select();
        $this->assign('info',$info);
        $this->display();
	}
	//订单数据--待发货--详情
	public function shipments(){
		$id=I('get.order','');
		$info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.pay_time,o.state,o.address_id,o.buynum,o.sid,o.sumpay,o.settime,o.price,o.xfb,g.id,g.goods_title,g.goods_cate_id,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['o.order_id'=>$id])
            ->find();
        $goods = M('goods');
        $address=M('address')->field('name,street,mobile,province,city,area')->where(['id'=>$info['address_id']])->find();
        $this->assign("address",$address);
        $this->assign("info",$info); 
		$this->display();
	}
	//订单数据--待收货
	public function shouhuo(){
        $info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.price,o.xfb,g.id,g.goods_title,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['uid'=>$_SESSION['wap']['id'],'state'=>2])
            ->limit('6')
            ->order('o.order_id desc')
            ->select();
        $this->assign('info',$info);
        $this->display();
	}
	//订单数据--待收货--详情
	public function delivery(){
		$id=I('get.order','');
		$info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.pay_time,o.state,o.address_id,o.buynum,o.sid,o.sumpay,o.settime,o.price,o.xfb,g.id,g.goods_title,g.goods_cate_id,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['o.order_id'=>$id])
            ->find();
        $goods = M('goods');
        $address=M('address')->field('name,street,mobile,province,city,area')->where(['id'=>$info['address_id']])->find();
        $express=M('express')->field('express_time')->where(['order_id'=>$info['order_id']])->find();
        $this->assign("address",$address);
        $this->assign("express",$express);
        $this->assign("info",$info); 
		$this->display();
	}
	//订单数据--待评价
	public function pingjia(){
        $info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.price,o.xfb,g.id,g.goods_title,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['uid'=>$_SESSION['wap']['id'],'state'=>4])
            ->limit('6')
            ->order('o.order_id desc')
            ->select();
        $this->assign('info',$info);
        $this->display();
	}
	//订单数据--待评价--详情
	public function evaluate(){
		$id=I('get.order','');
		$info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.pay_time,o.settime,o.state,o.address_id,o.buynum,o.sid,o.sumpay,o.settime,o.price,o.xfb,g.id,g.goods_title,g.goods_cate_id,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['o.order_id'=>$id])
            ->find();
        $address=M('address')->field('name,street,mobile,province,city,area')->where(['id'=>$info['address_id']])->find();
        $express=M('express')->field('express_time')->where(['order_id'=>$info['order_id']])->find();
        $this->assign("address",$address);
        $this->assign("express",$express);
        $this->assign("info",$info); 
		$this->display();
	}
	//订单数据--待评价--写评价
	public function writing_evaluation(){
		$gid=I('get.gid','');
		$goods=M('goods')->field('id,goods_logo')->where(['id'=>$gid])->find();
		$this->assign("goods",$goods); 
		$this->display();
	}
	 /*
    *滚动加载
    */
    public function listpage(){
        $page = (int)$_POST['page'];
        $type = (int)$_POST['type'];
        $where = '';
        $order = '';
        $field='';
        $model=M('order');
        if($type == '2'){//全部订单
            $where=['uid'=>$_SESSION['wap']['id']];
        }else if($type == '3'){//待付款
            $where = ['uid'=>$_SESSION['wap']['id'],'state'=>5];
        }else if($type == '4'){//待发货
            $where = ['uid'=>$_SESSION['wap']['id'],'state'=>3];
        }else if($type == '5'){//待收货
            $where = ['uid'=>$_SESSION['wap']['id'],'state'=>2];
        }else if($type == '6'){//待评价
            $where = ['uid'=>$_SESSION['wap']['id'],'state'=>4];
        }
        $count = 6;
        $limit = $page * $count;
        $list = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.price,o.xfb,g.id,g.goods_title,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where($where)
            ->limit("$limit,$count")
            ->order('o.order_id desc')
            ->select();
        $this->ajaxReturn($list);
        exit();
    }
    //付款
	public function fukuan(){
		$id=I('get.order','');

		$this->display();
	}
	//订单查询
	public function doPayBuyOrder(){
		$oid=I('post.oid','');
		$order=M('order')->field('gid')->where(['order_id'=>$oid])->find();
		if($order){
			$info['flg']=$oid;
			$info['msg']='ok';
			$info['gid']=$order['gid'];
			$info['buytype']='1';
		}else{
			$info['msg']='订单查询失败';
		}
		$this->ajaxReturn($info);exit;
	}
	//订单详情--单笔
	public function orderdetail(){
		$oid=I('post.buyOid','');
		$info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.buynum,o.sumpay,o.xfb,o.price,o.sid,g.goods_title,s.store_name')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->join('left join __STORE__ s on o.sid = s.sj_id')
            ->where(['o.uid'=>$_SESSION['wap']['id'],'o.order_id'=>$oid])
            ->find();
        if($info){
        	$info['msg']='ok';
        	$this->ajaxReturn($info);exit;
        }
	}
	//订单详情--购物车
	public function cartorderdetail(){
		$oid=I('post.buyOid','');
		$where['o.order_id']=['in',$oid];
		$info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.buynum,o.sumpay,o.xfb,o.price,o.sid,g.goods_title,s.store_name')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->join('left join __STORE__ s on o.sid = s.sj_id')
            ->where($where)
            ->select();
        if($info){
        	$this->ajaxReturn($info);exit;
        }
	}
	//订单数据
	public function confirm_order(){
		//echo M('goods')->getLastSql();
        //print_r($result);
        //查询个人可用金
        $user_info = M('user')
            ->field('u.id,u.status,i.uid,i.ke_bal,i.xfb_bal')
            ->alias('u')
            ->join('left join __USER_INFOR__ i on u.id = i.uid')
            ->where(['u.id'=>$_SESSION['sc']['id']])
            ->find();
        $address_arr=M("address")->field("id,name,street,mobile,sta,province,city,area")->where(['uid'=>$_SESSION['wap']['id'],'sta'=>2])->find();
		$this->assign("address_arr",$address_arr);
	    $this->assign("user_info",$user_info);
	    $this->display();
	}
	//地址选择
	public function addressinfo(){
		$address_arr=M("address")->field("id,name,street,mobile,sta,province,city,area")->where(['uid'=>$_SESSION['wap']['id']])->select();
		$this->assign("address_arr",$address_arr);
		$this->display();
	}
	//选择收货地址
	public function ajaxAddress(){
		$aid=I('post.aid','');
		if($aid == '2'){
			$address=M("address")->field("id,name,street,mobile,province,city,area")->where(['uid'=>$_SESSION['wap']['id'],'sta'=>2])->find();
		}else{
			$address=M("address")->field("id,name,street,mobile,province,city,area")->where(['id'=>$aid])->find();
		}
		if($address){
			$this->ajaxReturn($address);exit;
		}else{
			$this->ajaxReturn('3');exit;
		}
		
	}













	//删除
	public function orderdel(){
		$id=isset($_POST['id'])?$_POST['id']:'';//单删id
        if ($id!="") {
            $Model=M();
            if ($Model->execute("delete from sc_cart where id='{$id}'")) {
                echo "ok";exit;
            }else{
                echo "删除失败";exit;
            }
        }
	}
	public function ajaxGoods(){
		//查询商品数据
		$buyType=I('post.buyType','');
		$buyNum=I('post.buynum','');
		if($buyType == 1){
			if(!preg_match("/^[1-9][0-9]*$/",$buyNum)){
	            //$info['msg']='购买数量错误！';
	            $this->ajaxReturn('3');exit;
	        }	
		}
		if($buyType == 1){
			$gid=I('post.itemid','');
			$list=M("goods")->field("id,goods_title,goods_logo,goods_cate_id,kucun,price,xfb")->where(['id'=>$gid])->find();
				$html.='<div>';
				$html.='<input type="checkbox" style="display:none;" class="check_alls" name="items"  value="'.$list['id'].'" checked="checked">';
					$html.='<div>';
					$html.='<a href="'.U("Good/goodlist",["id"=>$list["id"]]).'">';
					$html.='<img src="/Uploads'.$list['goods_logo'].'" alt="">';
					$html.='<h4>';
					if (strlen($list['goods_title'])>20) {
						$html.=''.mb_substr($list['goods_title'],0,20,'utf-8').'...'.'';
					}else{
						$html.=''.$list["goods_title"].'';
					}
					$html.='</h4>';
					$html.='<p style="float: none;">可用金：<span class="payNum">'.$list['price'].'</span></p>';
					$html.='<p>消费币：<span class="xfbNum">'.$list['xfb'].'</span></p>';
					$html.='<input type="hidden" id="goodsid" value="'.$list['id'].'">';
					$html.='<input type="hidden" id="buynum_'.$list['id'].'" value="'.$buyNum.'">';
					$html.='<i id="buyNum">×'.$buyNum.'</i>';
					$html.='</a>';
					$html.='</div>';
				$html.='</div>';
				$paymon=$list['price']*$buyNum;
				$xfbmon=$list['xfb']*$buyNum;
				$fukuan=$paymon+$xfbmon;
				$html.='<h6>小计：<span>'.$fukuan.'</span></h6>';

		}else if($buyType == 2){
			$data=I('post.item','');
			//print_r($data);
			
			foreach ($data as $key => $item) {
				$list=M("goods")->field("id,goods_title,goods_logo,goods_cate_id,kucun,price,xfb")->where(['id'=>$item['gid']])->find();
					$html.='<div style="padding:0;">';
						$html.='<input type="checkbox" style="display:none;" class="check_alls" name="items"  value="'.$list['id'].'" checked="checked">';
						$html.='<div >';
							$html.='<a href="'.U("Good/goodlist",["id"=>$list["id"]]).'">';
							$html.='<img src="/Uploads'.$list['goods_logo'].'" alt="">';
							$html.='<h4>';
							if (strlen($list['goods_title'])>20) {
								$html.=''.mb_substr($list['goods_title'],0,20,'utf-8').'...'.'';
							}else{
								$html.=''.$list["goods_title"].'';
							}
							$html.='</h4>';
							$html.='<p style="float: none;">可用金：<span class="payNum">'.$list['price'].'</span></p>';
							$html.='<p>消费币：<span class="xfbNum">'.$list['xfb'].'</span></p>';
							$html.='<input type="hidden" id="goodsid" value="'.$list['id'].'">';
							$html.='<input type="hidden" id="buynum_'.$list['id'].'" value="'.$item['num'].'">';
							$html.='<i id="buyNum">×'.$item['num'].'</i>';
							$html.='</a>';
						$html.='</div>';
						$paymon=$list['price']*$item['num'];
						$xfbmon=$list['xfb']*$item['num'];
						$fukuan=$paymon+$xfbmon;
						$html.='<h6>小计：<span class="sumPay">'.$fukuan.'</span></h6>';
					$html.='</div>';
			}
		}
        $this->ajaxReturn($html);exit;
	}
	//生成订单--单个订单
	public function payorder(){
		$good=M("goods");
		$num=I('post.num','');
		$adsid=I('post.adsid','');
		$gid=I('post.gid','');
		if(!preg_match("/^[1-9][0-9]*$/",$num)){
            $$info['msg']='购买数量错误！';
			$this->ajaxReturn($info);exit;
        }
		$goods_arr=$good->field("id,kucun,price,xfb,sid")->where(['id'=>$gid])->find();
		if($goods_arr){
			$address=M('address')->field('id')->where(['uid'=>$_SESSION['wap']['id']])->find();
			if($address){
				if($adsid){
					if($goods_arr['kucun'] >= $num){
						$payMoney=$goods_arr['price']*$num;
		    			$xfbMoney=$goods_arr['xfb']*$num;
						$sumpay=$payMoney+$xfbMoney;
						//添加订单
				        $order_num=date("YmdHis",time()).$this->_randStr(6,1);
				        $res = M('order')->add(['gid'=>$gid,'state'=>5,'order_num'=>$order_num,'buytime'=>time(),'uid'=>$_SESSION['wap']['id'],'buynum'=>$num,'address_id'=>$adsid,'sumpay'=>$sumpay,'xfb'=>$xfbMoney,'price'=>$payMoney,'sid'=>$goods_arr['sid']]);
						if($res){
							$info['flg']=$res;
							$info['msg']='ok';
							$info['gid']=$gid;
							$info['buytype']='1';
							$this->ajaxReturn($info);exit;
						}else{
							$info['msg']='订单提交失败，请从新提交！';
							$this->ajaxReturn($info);exit;
						}
					}else{
						$info['msg']='库存不足，请从新选择购买数量！';
						$this->ajaxReturn($info);exit;
					}
				}else{
					$info['msg']='请选择收货地址！';
					$this->ajaxReturn($info);exit;
				}
			}else{
				$info['msg']='您还没有设置收货地址，请前往个人中心设置！';
				$this->ajaxReturn($info);exit;
			}
		}else{
			$info['msg']='商品不存在！';
			$this->ajaxReturn($info);exit;
		}	
	}
	
	//生成订单--购物车订单
	public function cartPayOrder(){
		$good=M("goods");
		$user=M("user");
		$adsid=I('post.adsid','');
		$item=I('post.item','');
		$userarr = M('user_infor')->field('ke_bal,xfb_bal')->where(['uid'=>$_SESSION['wap']['id']])->find();
    	$payMoney='';
    	$xfbMoney='';
    	$ture='';
    	$address=M('address')->field('id')->where(['uid'=>$_SESSION['wap']['id']])->find();
    	if($address){
    		if($adsid){
    			foreach ($item as $key => $list) {//检验库存
		    		$goods_arr=$good->field("kucun")->where(['id'=>$list['gid']])->find();
		    		if($goods_arr['kucun'] > $list['num']){
		    			$ture='10000';
		    		}else{
		    			$ture='10015';
		    			$info['msg']='有商品库存不足，请从新选择！';
						$this->ajaxReturn($info);exit;
		    		}
		    	}
		    	if($ture =='10000'){
					foreach ($item as $key => $v){
						$goods_arr=$good->field("id,kucun,price,xfb,sid")->where(['id'=>$v['gid']])->find();
			            //开启事务
						M()->startTrans();
			            //添加订单
			            $payMoney=$goods_arr['price']*$v['num'];
						$xfbMoney=$goods_arr['xfb']*$v['num'];
						$sumpay=$payMoney+$xfbMoney;
			            $order_num=date("YmdHis",time()).$this->_randStr(6,1);
			            $res1 = M('order')->add(['gid'=>$v['gid'],'order_num'=>$order_num,'sumpay'=>$sumpay,'buytime'=>time(),'state'=>5,'uid'=>$_SESSION['wap']['id'],'buynum'=>$v['num'],'address_id'=>$adsid,'price'=>$payMoney,'xfb'=>$xfbMoney,'sid'=>$goods_arr['sid']]);    
						//更新购物车
				    	$res2 = M('cart')->where(['gid'=>$v['gid'],'uid'=>$_SESSION['wap']['id']])->delete();
						//print_r($res2);exit;
						if($res1 && $res2){
							M()->commit();
							if($key == 0){
								$info['flg'].=$res1;
							}else{
								$info['flg'].=','.$res1;
							}
							$info['msg']='ok';
							$info['buytype']='2';
						}else{
							M()->rollback();
							$info['msg']='订单提交失败，请从新购买商品！';
							$this->ajaxReturn($info);exit;
						}
					}
					$this->ajaxReturn($info);exit;
				}else{
					$info['msg']='有商品库存不足，请从新选择！';
					$this->ajaxReturn($info);exit;
				}
    		}else{
    			$info['msg']='请选择收货地址！';
				$this->ajaxReturn($info);exit;
    		}
    	}else{
    		$info['msg']='您还没有设置收货地址，请前往个人中心设置！';
			$this->ajaxReturn($info);exit;
    	}
        exit;
	}
	
	
	//付款
	public function dopayorder(){
		$good=M("goods");
		$user=M("user");
		$oid=I('post.buyFlg','');
		$where['order_id']=['in',$oid];
		$paypass=I('post.pass','');
		$info = M('order')->field('order_id,price,xfb,sumpay,gid,buynum')->where($where)->select();
		$userarr = M('user_infor')->field('ke_bal,xfb_bal')->where(['uid'=>$_SESSION['wap']['id']])->find();
		$user=M("user")->field('pay_pwd,pay_rand_str')->where(['id'=>$_SESSION['wap']['id']])->find();
        $user_pwd=md5(md5(md5($paypass)).$user['pay_rand_str']);
        if($user_pwd == $user['pay_pwd']){
        	$payMoney='';
        	$xfbMoney='';
        	foreach ($info as $key => $list) {//检验钱
        		$payMoney=$payMoney+$list['price'];
        		$xfbMoney=$xfbMoney+$list['xfb'];
        	}
        	if($userarr['ke_bal'] >= $payMoney){
        		if($userarr['xfb_bal'] >= $xfbMoney){
        			foreach ($info as $key => $v){
        				$goods_arr=$good->field("id,kucun,sell")->where(['id'=>$v['gid']])->find();
        				//开启事务
			            M()->startTrans();
			            //更新订单
			            $order_num=date("YmdHis",time()).$this->_randStr(6,1);
			            $res1 = M('order')->where(['order_id'=>$v['order_id']])->setInc(['state'=>3,'pay_time'=>time()]);
			            //更新用户可用金+消费币
			            $userbal = M('user_infor')->field('ke_bal,xfb_bal')->where(['uid'=>$_SESSION['wap']['id']])->find();
			            $ke_bal=$userbal['ke_bal']-$v['price'];
			            $xfb_bal=$userbal['xfb_bal']-$v['xfb'];
			            $res2 =M('user_infor')->where(['uid'=>$_SESSION['wap']['id']])->setInc(['ke_bal'=>$ke_bal,'xfb_bal'=>$xfb_bal]);
			            //添加资金变动表
			            //$res3 = M('bill')->add(['uid'=>$_SESSION['wap']['id'],'xfb'=>$v['xfb'],'after_xfb'=>$xfb_bal,'number'=>$v['price'],'money'=>$ke_bal,'btime'=>time(),'type'=>2,'billnum'=>date("YmdHis",time()).$this->_randStr(4,1),'sta'=>2]);
			            $res3=$this->billadd($_SESSION['wap']['id'],2,$v['xfb'],$xfb_bal,2,3,4);
			            $res4=$this->billadd($_SESSION['wap']['id'],2,$v['price'],$ke_bal,2,3,3);
			            //更新库存
			            $kc=$goods_arr['kucun']-$v['buynum'];
			            $xl=$goods_arr['sell']+$v['buynum'];
			            $res5 = M('goods')->where(['id'=>$v['gid']])->setInc(['kucun'=>$kc,'sell'=>$xl]);
			            if ($res1 && $res2 && $res3 && $res4 && $res5 ){
			                M()->commit();
			                $info['msg']='ok';
			            }else{
			                M()->rollback();
			                $info['msg']='支付失败！';
			                $this->ajaxReturn($info);exit;
			            } 
        			}
        			$this->ajaxReturn($info);exit;
        		}else{
        			$info['msg']='消费币余额不足！';
        			$this->ajaxReturn($info);exit;	
        		}
        	}else{
        		$info['msg']='可用金余额不足！';
        		$this->ajaxReturn($info);exit;
        	}
        }else{
        	$info['msg']='支付密码错误！';
        	$this->ajaxReturn($info);exit;
        }
	}
	//取消订单
	public function closeDoPayBuyOrder(){
		$oid=I('post.oid','');
		$res = M('order')->field('state')->where(['order_id'=>$oid])->find();
		if($res){
			if($res['state'] == 5){
				$result= M('order')->where(['order_id'=>$oid])->setInc(['state'=>6]);
				if($result){
					$info['msg']='ok';
        			$this->ajaxReturn($info);exit;
				}else{
					$info['msg']='取消失败！';
        			$this->ajaxReturn($info);exit;
				}
			}else{
				$info['msg']='订单已支付，不可取消！';
        		$this->ajaxReturn($info);exit;
			}
		}else{
			$info['msg']='订单查询失败！';
        	$this->ajaxReturn($info);exit;
		}
	}
	//确认收货
    public function setOrder(){
        $id=I('post.buy','');
		$paypass=I('post.pass','');
        $order=M('order')->field("state,price,xfb,sid")->where(['order_id'=>$id])->find();
        if($order){
            if($order['state'] != 4){
            	$userarr = M('user_infor')->field('ke_bal,xfb_bal')->where(['uid'=>$_SESSION['wap']['id']])->find();
				$user=M("user")->field('pay_pwd,pay_rand_str')->where(['id'=>$_SESSION['wap']['id']])->find();
		        $user_pwd=md5(md5(md5($paypass)).$user['pay_rand_str']);
		        if($user_pwd == $user['pay_pwd']){
		        	if($userarr['ke_bal'] >= $payMoney){
        				if($userarr['xfb_bal'] >= $xfbMoney){
        					//开启事务
			                M()->startTrans();
			                //更新订单
			                $res1 = M('order')->where(['order_id'=>$id])->setInc(['state'=>4,'settime'=>time()]);
			                //更新可用金+消费币
			                $suser=M('merchant_infor')->field('ke_bal,xfb_bal')->where(['sid'=>$order['sid']])->find();
			                $ke=$suser['ke_bal']+$order['price'];
			                $xf=$suser['xfb_bal']+$order['xfb'];
			                $res2 =M('merchant_infor')->where(['sid'=>$order['sid']])->setInc(['ke_bal'=>$ke,'xfb_bal'=>$xf]);
			                //添加资金变动表
			                //$res3 = M('bill')->add(['uid'=>$order['sid'],'xfb'=>$order['xfb'],'after_xfb'=>$xf,'number'=>$order['price'],'money'=>$ke,'btime'=>time(),'type'=>4,'billnum'=>date("YmdHis",time()).$this->_randStr(4,1),'sta'=>3]);
			                $res3=$this->billadd($order['sid'],4,$order['xfb'],$xf,3,2,4);
			                $res4=$this->billadd($order['sid'],4,$order['price'],$ke,3,2,3);
			                if ($res1 && $res2 && $res3 && $res4){			                    
			                	M()->commit();
			                    $info['msg']='ok';
        						$this->ajaxReturn($info);exit;
			                }else{
			                    M()->rollback();
			                    $info['msg']='支付失败，请稍后再试！';
        						$this->ajaxReturn($info);exit;
			                } 
		        		}else{
		        			$info['msg']='消费币余额不足！';
        					$this->ajaxReturn($info);exit;
		        		}
		        	}else{
		        		$info['msg']='可用金余额不足！';
        				$this->ajaxReturn($info);exit;
		        	}
		        }else{
		        	$info['msg']='支付密码错误！';
        			$this->ajaxReturn($info);exit;
		        }
                
            }else{
               $info['msg']='订单已经支付过！';
        		$this->ajaxReturn($info);exit;    
            }
        }else{
            $info['msg']='订单不存在！';
        	$this->ajaxReturn($info);exit;
        }
    }

}

