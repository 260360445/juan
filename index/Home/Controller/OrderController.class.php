<?php
namespace Home\Controller;

use Think\Controller;
class OrderController extends ComController{
	//会员首页
    protected function _initialize(){
        if(empty($_SESSION['sc']['id'])){
            //跳转到认证网关
            $this->redirect('Login/login');
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
        $address_arr=M("address")->field("id,name,street,mobile,sta,province,city,area")->where(['uid'=>$_SESSION['sc']['id']])->select();
		$this->assign("address_arr",$address_arr);
	    $this->assign("user_info",$user_info);
	    $this->display();
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
		if($buyType == 1){
			$gid=I('post.itemid','');
			$buyNum=I('post.buynum','');
			$list=M("goods")->field("id,goods_title,goods_logo,goods_cate_id,kucun,price,xfb")->where(['id'=>$gid])->find();
        	$catename=M("goods_class")->field("name")->where("goods_class_id=".$list['goods_cate_id'])->find();
            $html='<tr>';
				$html.='<td><input type="checkbox" class="check_alls" name="items" value="'.$list['id'].'" checked="checked"/></td>';
				$html.='<td>';
					$html.='<a href="'.U("Good/goodlist",["id"=>$list["id"]]).'" target="_blank"><img src="/Uploads'.$list['goods_logo'].'"></a>';
					$html.='<p ><a target="_blank" href="'.U("Good/goodlist",["id"=>$list["id"]]).'" title="'.$list['goods_title'].'">';
						if (strlen($list['goods_title'])>20) {
							$html.=''.mb_substr($list['goods_title'],0,20,'utf-8').'...'.'';
						}else{
							$html.=''.$list["goods_title"].'';
						}
					$html.='</a></p>';
				$html.='</td>';
				$html.='<td>'.$catename['name'].'</td>';
				$html.='<td>';
				$html.='<span class="payNum">'.$list['price'].'</span>';
				$html.='</td>';
				$html.='<td>';
				$html.='<span class="xfbNum">'.$list['xfb'].'</span>';
				$html.='</td>';
				$html.='<td>';
					if($list['kucun'] <= 1){
						$html.='<div class="datatype" type="1" data-limit="'.$list['kucun'].'" data-id="'.$list['id'].'">';
							$html.='<span class="cart_in2 " >-</span>';
							$html.='<span class="buynum onlyNum" id="cart_inp1" disabled="disabled">'.$buyNum.'</span>';
							$html.='<span class="cart_out2 ">+</span>';
						$html.='</div>';
					}else{
						$html.='<div class="datatype" type="1" data-limit="'.$list['kucun'].'" data-id="'.$list['id'].'">';
							$html.='<span class="cart_in " >-</span>';
							$html.='<span class="buynum onlyNum" id="cart_inp1" >'.$buyNum.'</span>';
							$html.='<span class="cart_out ">+</span>';
						$html.='</div>';
					}
				$html.='<input type="hidden" id="buynum_'.$list['id'].'" value="'.$buyNum.'"></td>';
				$html.='</td>';
				$html.='<td>';
				$paymon=$list['price']*$buyNum;
				$xfbmon=$list['xfb']*$buyNum;
				$fukuan=$paymon+$xfbmon;
				$html.='<span class="sumPay">'.$fukuan.'</span>';
				$html.='</td>';
				$html.='<td>';
					$html.='<input type="hidden" value="'.$list['id'].'" name="goodid">';
					$html.='<a class="del" href="javascript:void(0);" >删除</a>';
				$html.='</td>';
			$html.='</tr>';

		}else if($buyType == 2){
			$data=I('post.item','');
			foreach ($data as $key => $item) {
				$list=M("goods")->field("id,goods_title,goods_logo,goods_cate_id,kucun,price,xfb")->where(['id'=>$item['gid']])->find();
	        	$catename=M("goods_class")->field("name")->where("goods_class_id=".$list['goods_cate_id'])->find();
	            $html.='<tr>';
					$html.='<td><input type="checkbox" class="check_alls" name="items" value="'.$list['id'].'" checked="checked"/></td>';
					$html.='<td>';
						$html.='<a href="'.U("Good/goodlist",["id"=>$list["id"]]).'" target="_blank"><img src="/Uploads'.$list['goods_logo'].'"></a>';
						$html.='<p ><a target="_blank" href="'.U("Good/goodlist",["id"=>$list["id"]]).'" title="'.$list['goods_title'].'">';
							if (strlen($list['goods_title'])>20) {
								$html.=''.mb_substr($list['goods_title'],0,20,'utf-8').'...'.'';
							}else{
								$html.=''.$list["goods_title"].'';
							}
						$html.='</a></p>';
					$html.='</td>';
					$html.='<td>'.$catename['name'].'</td>';
					$html.='<td>';
						$html.='<span class="payNum">'.$list['price'].'</span>';
					$html.='</td>';
					$html.='<td>';
						$html.='<span class="xfbNum">'.$list['xfb'].'</span>';
					$html.='</td>';
					$html.='<td>';
						if($list['kucun'] <= 1){
							$html.='<div class="datatype" type="1" data-limit="'.$list['kucun'].'" data-id="'.$list['id'].'">';
								$html.='<span class="cart_in2 " >-</span>';
								$html.='<span class="buynum onlyNum" id="cart_inp1" disabled="disabled">'.$item['num'].'</span>';
								$html.='<span class="cart_out2 ">+</span>';
							$html.='</div>';
						}else{
							$html.='<div class="datatype" type="1" data-limit="'.$list['kucun'].'" data-id="'.$list['id'].'">';
								$html.='<span class="cart_in" >-</span>';
								$html.='<span  class="buynum onlyNum" id="cart_inp1" >'.$item['num'].'</span>';
								$html.='<span class="cart_out">+</span>';
							$html.='</div>';
						}
					$html.='<input type="hidden" id="buynum_'.$list['id'].'" value="'.$item['num'].'"></td>';
					$html.='<td>';
					$paymon=$list['price']*$item['num'];
					$xfbmon=$list['xfb']*$item['num'];
					$fukuan=$paymon+$xfbmon;
					$html.='<span class="sumPay">'.$fukuan.'</span>';
					$html.='</td>';
					$html.='<td>';
						$html.='<input type="hidden" value="'.$list['id'].'" name="goodid">';
						$html.='<a class="del" href="javascript:void(0);">删除</a>';
					$html.='</td>';
				$html.='</tr>';
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
		$goods_arr=$good->field("id,kucun,price,xfb,sid")->where(['id'=>$gid])->find();
		if($goods_arr){
			$address=M('address')->field('id')->where(['uid'=>$_SESSION['sc']['id']])->find();
			if($address){
				if($adsid){
					if($goods_arr['kucun'] >= $num){
						$payMoney=$goods_arr['price']*$num;
		    			$xfbMoney=$goods_arr['xfb']*$num;
						$sumpay=$payMoney+$xfbMoney;
						//添加订单
				        $order_num=date("YmdHis",time()).$this->_randStr(6,1);
				        $res = M('order')->add(['gid'=>$gid,'state'=>5,'order_num'=>$order_num,'buytime'=>time(),'uid'=>$_SESSION['sc']['id'],'buynum'=>$num,'address_id'=>$adsid,'sumpay'=>$sumpay,'xfb'=>$xfbMoney,'price'=>$payMoney,'sid'=>$goods_arr['sid']]);
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
	//生成订单--购物车订单
	public function cartPayOrder(){
		$good=M("goods");
		$user=M("user");
		$adsid=I('post.adsid','');
		$item=I('post.item','');
		$userarr = M('user_infor')->field('ke_bal,xfb_bal')->where(['uid'=>$_SESSION['sc']['id']])->find();
    	$payMoney='';
    	$xfbMoney='';
    	$ture='';
    	$address=M('address')->field('id')->where(['uid'=>$_SESSION['sc']['id']])->find();
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
			            $res1 = M('order')->add(['gid'=>$v['gid'],'order_num'=>$order_num,'sumpay'=>$sumpay,'buytime'=>time(),'state'=>5,'uid'=>$_SESSION['sc']['id'],'buynum'=>$v['num'],'address_id'=>$adsid,'price'=>$payMoney,'xfb'=>$xfbMoney,'sid'=>$goods_arr['sid']]);    
						//更新购物车
				    	$res2 = M('cart')->where(['gid'=>$v['gid'],'uid'=>$_SESSION['sc']['id']])->delete();
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
	public function paycashier(){
		$this->display();
	}
	//订单详情--单笔
	public function orderdetail(){
		$oid=I('post.buyOid','');
		$gid=I('post.gid','');
		$info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.buynum,o.sumpay,o.xfb,o.price,o.sid,g.goods_title,s.store_name')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->join('left join __STORE__ s on o.sid = s.sj_id')
            ->where(['o.uid'=>$_SESSION['sc']['id'],'o.order_id'=>$oid])
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
	//付款
	public function dopayorder(){
		$good=M("goods");
		$user=M("user");
		$oid=I('post.buyFlg','');
		$where['order_id']=['in',$oid];
		$paypass=I('post.pass','');
		$info = M('order')->field('order_id,price,xfb,sumpay,gid,buynum')->where($where)->select();
		$userarr = M('user_infor')->field('ke_bal,xfb_bal')->where(['uid'=>$_SESSION['sc']['id']])->find();
		$user=M("user")->field('pay_pwd,pay_rand_str')->where(['id'=>$_SESSION['sc']['id']])->find();
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
			            $userbal = M('user_infor')->field('ke_bal,xfb_bal')->where(['uid'=>$_SESSION['sc']['id']])->find();
			            $ke_bal=$userbal['ke_bal']-$v['price'];
			            $xfb_bal=$userbal['xfb_bal']-$v['xfb'];
			            $res2 =M('user_infor')->where(['uid'=>$_SESSION['sc']['id']])->setInc(['ke_bal'=>$ke_bal,'xfb_bal'=>$xfb_bal]);
			            //添加资金变动表
			            //$res3 = M('bill')->add(['uid'=>$_SESSION['sc']['id'],'xfb'=>$v['xfb'],'after_xfb'=>$xfb_bal,'ke_bal'=>$v['price'],'after_ke_bal'=>$ke_bal,'btime'=>time(),'type'=>2,'billnum'=>date("YmdHis",time()).$this->_randStr(4,1),'sta'=>2]);
			            $res3=$this->billadd($_SESSION['sc']['id'],2,$v['xfb'],$xfb_bal,2,3,4);
			            $res4=$this->billadd($_SESSION['sc']['id'],2,$v['price'],$ke_bal,2,3,3);
			            //更新库存
			            $kc=$goods_arr['kucun']-$v['buynum'];
			            $xl=$goods_arr['sell']+$v['buynum'];
			            $res5 = M('goods')->where(['id'=>$v['gid']])->setInc(['kucun'=>$kc,'sell'=>$xl]);
			            if ($res1 && $res2 && $res3 && $res4 && $res5){
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
	//确认收货
    public function setOrder(){
        $id=I('post.buy','');
		$paypass=I('post.pass','');
        $order=M('order')->field("state,price,xfb,sid")->where(['order_id'=>$id])->find();
        if($order){
            if($order['state'] != 4){
            	$userarr = M('user_infor')->field('ke_bal,xfb_bal')->where(['uid'=>$_SESSION['sc']['id']])->find();
				$user=M("user")->field('pay_pwd,pay_rand_str')->where(['id'=>$_SESSION['sc']['id']])->find();
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
			                //$res3 = M('bill')->add(['uid'=>$order['sid'],'xfb'=>$order['xfb'],'after_xfb'=>$xf,'ke_bal'=>$order['price'],'after_ke_bal'=>$ke,'btime'=>time(),'type'=>4,'billnum'=>date("YmdHis",time()).$this->_randStr(4,1),'sta'=>3]);
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
	//订单详情--已关闭订单
	public function detail(){
		$id=I("get.order","");
		$info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.settime,o.price,o.xfb,g.id,g.goods_title,g.goods_cate_id,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['o.order_id'=>$id])
            ->find();
        $goods = M('goods');
        $good_tm = $goods->field("id,goods_title,goods_logo,price,money,xfb,sell")->where('tm = 2')->order('tm_time desc')->limit('8')->select();
        $address=M('express')->field('express_name,express_num,express_time,express_user')->where(['order_id'=>$info['order_id']])->find();
        $this->assign("address",$address);
        $this->assign('good_tm',$good_tm);
        $this->assign("info",$info);
		$this->display();
	}
	//订单详情--未关闭订单
	public function detailOrder(){
		$id=I("get.order","");
		$info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.settime,o.price,o.xfb,g.id,g.goods_title,g.goods_cate_id,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['o.order_id'=>$id])
            ->find();
        $goods = M('goods');
        $good_tm = $goods->field("id,goods_title,goods_logo,price,money,xfb,sell")->where('tm = 2')->order('tm_time desc')->limit('8')->select();
        $address=M('express')->field('express_name,express_num,express_time,express_user')->where(['order_id'=>$info['order_id']])->find();
        $this->assign("address",$address);
        $this->assign('good_tm',$good_tm);
        $this->assign("info",$info);    
		$this->display();
	}
	//确认收货--订单详情--确认
	public function confirmpay(){
		$id=I("get.order","");
		$info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.settime,o.price,o.xfb,g.id,g.goods_title,g.goods_cate_id,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['o.order_id'=>$id])
            ->find();
        $address=M('express')->field('express_name,express_num,express_time,express_user')->where(['order_id'=>$info['order_id']])->find();
        $this->assign("address",$address);
        $this->assign("info",$info);    
		$this->display();
	}
	//查看物流
	public function trace(){
		$this->display();
	}
}

