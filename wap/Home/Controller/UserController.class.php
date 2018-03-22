<?php
namespace Home\Controller;
use Think\Controller;
use Think\Pagei;
class UserController extends ComController {
   protected function _initialize(){
        if(empty($_SESSION['wap']['id'])){
            //跳转到认证网关
            $this->redirect('Login/login');
        }
    }
    //个人中心
    public function member(){
        //用户信息
        $user=M('user_infor')->field('bal,ke_bal,xfb_bal,fre_bal,nick_name')->where(['uid'=>$_SESSION['wap']['id']])->find();
        //最近订单
        $info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.state,o.buynum,o.price,o.xfb,g.id,g.goods_title,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['uid'=>$_SESSION['wap']['id']])
            ->limit('6')
            ->order('o.buytime desc')
            ->select();
        //待付款
        $fukan=M('order')->field('order_id')->where(['uid'=>$_SESSION['wap']['id'],'state'=>5])->count();    
        //待发货
        $fahuo=M('order')->field('order_id')->where(['uid'=>$_SESSION['wap']['id'],'state'=>3])->count();
        //待收货
        $shouhuo=M('order')->field('order_id')->where(['uid'=>$_SESSION['wap']['id'],'state'=>2])->count();
        //待评价
        $pingjia=M('order')->field('order_id')->where(['uid'=>$_SESSION['wap']['id'],'state'=>4])->count();
        $this->assign('fukan',$fukan);
        $this->assign('fahuo',$fahuo);
        $this->assign('shouhuo',$shouhuo);
        $this->assign('pingjia',$pingjia);
        $this->assign('info',$info);
        $this->assign('user',$user);
        $this->display();
    }
    //设置
    public function instal(){
        $user=M('user_infor')->field('nick_name,photo')->where(['uid'=>$_SESSION['wap']['id']])->find();
        $this->assign('user',$user);
        $this->display();
    }
    //昵称
    public function nickname(){
        if(IS_POST){
            $name=I('post.nickname','');
            if(false !== M('user_infor')->where(['uid'=>$_SESSION['wap']['id']])->save(['nick_name'=>$name])){
                $info='ok';
                $this->ajaxReturn($info);exit;
            }else{
                $info='修改失败';
                $this->ajaxReturn($info);exit;
            }
        }else{
            $user=M('user_infor')->field('nick_name')->where(['uid'=>$_SESSION['wap']['id']])->find();
            $this->assign('user',$user);
            $this->display();
        }
    }
    //我的套餐包
    public function package(){
        $type=M('buy_bao')->field('id')->where(['uid'=>$_SESSION['wap']['id'],'status'=>2])->find();
        if($type){
            $this->assign('type',2);
        }else{
            $this->assign('type',3);
        }
        $info = M('buy_bao')
            ->where(['uid'=>$_SESSION['wap']['id']])
            ->limit('6')
            ->order('id desc')
            ->select();
        $this->assign('info',$info);
        $this->display();
    }
    //套包购买
    public function cashier_desk(){
         $this->display();
    }
    //对公账户 打款+网银
    public function pay_show(){
        $this->display();
    }
     //套包生成订单
    public function paybao(){
        $type=M('buy_bao')->field('id')->where(['uid'=>$_SESSION['wap']['id'],'status'=>2])->find();
        if($type){
            $info['msg']='您有订单未支付，请先支付!';
            $this->ajaxReturn($info);
            exit;
        }else{
            $pay=I('post.pay');
            $type=I('post.type');
            $order_num=date("YmdHis",time()).$this->_randStr(6,1);
            $res = M('buy_bao')->add(['number'=>$order_num,'type'=>$type,'uid'=>$_SESSION['wap']['id'],'money'=>$pay,'buy_time'=>time(),'status'=>2,'mobile'=>$_SESSION['sc']['usermobile']]);
            if($res){
                $info['msg']='ok';
                $info['flg']=$pay;
                $this->ajaxReturn($info);
                exit;
            }else{
                $info['msg']='订单生成失败，请稍后再试!';
                $this->ajaxReturn($info);
                exit;
            }
        }
    }
    //财务记录
    public function financial(){
        $where['uid']=$_SESSION['wap']['id'];
        $info = M('bill')
            ->field('id,number,btime,type,billnum,xfb,ke_bal,sts,stus')
            ->where($where)
            ->limit('6')
            ->order('id desc')
            ->select();
        $this->assign('info',$info);
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
        if($type == '2'){//消费记录
            $model=M('bill');
            $field='id,number,btime,type,billnum,xfb,after_xfb,sts,stus';
            $where['uid']=$_SESSION['wap']['id'];
            $order = 'id desc';
        }else if($type == '3'){//新品
            $model=M('good');
            $where = ['xp'=>2,'sta'=>3];
            $order = 'xp_time desc';
        }else if($type == '4'){//按分类查找
            $model=M('good');
            $cid=I('post.cid','');
            $where = ['goods_cate_id'=>$cid,'sta'=>3];
            $order = 'sell desc';
        }else if($type == '5'){//套餐包
            $model=M('buy_bao');
            $where = ['uid'=>$_SESSION['wap']['id']];
            $order = 'id desc';
        }else if($type == '6'){//提现
            $model=M('wht_tilog');
            $field='id,money,ctime,status,number';
            $where = ['uid'=>$_SESSION['wap']['id']];
            $order = 'id desc';
        }else if($type == '7'){//转账
            $model=M('transfer');
            $field='id,mobile,number,money,ztime,status';
            $where = ['uid'=>$_SESSION['wap']['id']];
            $order = 'ztime desc';
        }
        $count = 6;
        $limit = $page * $count;
        $list = $model->field($field)->where($where)->order($order)->limit("$limit,$count")->select(); 
        $this->ajaxReturn($list);
        exit();
    }
    //绑定钱包
    public function bind_wallet_one(){
        $user = M('user')->field('wht_pay')->where(['id'=>$_SESSION['wap']['id']])->find();
        $this->assign('info',$user);
        $this->display();
    }
    //钱包绑定
    public function payKeySuc(){
        $num=I('post.paynum','');
        $user = M('user')->field('wht_pay')->where(['id'=>$_SESSION['wap']['id']])->find();
        $wht_pay = M('user')->field('wht_pay')->where(['wht_pay'=>$num])->find();
        if($wht_pay){
           $this->ajaxReturn('钱包地址已绑定,请更换钱包地址!');exit; 
        }
        if($user['wht_pay'] == 0){
            if(false !== M('user')->where(['id'=>$_SESSION['wap']['id']])->save(['wht_pay'=>$num])){
                $this->ajaxReturn('ok');exit;
            }else{
                $this->ajaxReturn('绑定失败，请从新绑定！');exit;
            }
        }else{
            $this->ajaxReturn('已绑定，不可修改！');exit;
        }
    }
    //实名认证
    public function real_name_authentication(){
        $user=M('user_infor')->field('uname,ucode,usta')->where(['uid'=>$_SESSION['wap']['id']])->find();
        $this->assign('info',$user);
        $this->display();
    }
    //身份认证
    public function idCardAuth(){
        $user_infor=M("user_infor");
        $data['uname']=I("post.realname","");
        $data['ucode']=I("post.idcard","");
        $data['usta']=2;
        if(false !== $user_infor->where(['uid'=>$_SESSION['wap']['id']])->save($data)){
            $info='2';
            $this->ajaxReturn($info) ;exit;
        }else{
            $info='3';
            $this->ajaxReturn($info) ;exit;
        }
    }
    //绑定银行卡
    public function bank(){
        $user=M('user_infor')->field('yhk_name,yhk_type,yhk_sta,yhk_kh')->where(['uid'=>$_SESSION['wap']['id']])->find();
        $this->assign('info',$user);
        $this->display();
    }
        //绑定银行卡
    public function userbank(){
        $name=I('post.name','');
        $type=I('post.type','');
        $num=I('post.num','');
        if($name && $type && $num){
            if(preg_match("/^\d*$/",$num)){
                $user=M('user_infor')->field('yhk_sta')->where(['uid'=>$_SESSION['wap']['id']])->find();
                $isyhk=M('user_infor')->field('id')->where(['yhk_kh'=>$num])->find();
                if($isyhk){
                    $info['msg']='银行卡已绑定,请更换银行卡！';
                    $this->ajaxReturn($info);exit;
                }
                if($user['yhk_sta'] == 2){
                    $info['msg']='您已绑定银行卡！';
                    $this->ajaxReturn($info);exit;
                }else{
                    if(false !== M('user_infor')->where(['uid'=>$_SESSION['wap']['id']])->save(['yhk_kh'=>$num,'yhk_name'=>$name,'yhk_type'=>$type,'yhk_sta'=>2])){
                        $info['msg']='ok';
                        $this->ajaxReturn($info);exit;
                    }else{
                        $info['msg']='绑定失败，请从新绑定！';
                        $this->ajaxReturn($info);exit;
                    }
                }
            }else{
                $info['msg']='卡号格式不正确！';
                $this->ajaxReturn($info);exit;
            }
        }else{
            $info['msg']='非法提交，请从新提交！';
            $this->ajaxReturn($info);exit;
        }
    }
    //修改密码
    public function login_password(){
        $this->display();
    }
    //修改登录密码
    public function updatePass(){
        $oldPass=I("post.oldPass","");
        $pass=I("post.pass","");
        $repass=I("post.repass","");
        $user=M("user")->field('pwd,rand_str')->where(['id'=>$_SESSION['wap']['id']])->find();
        $user_pwd=md5(md5(md5($oldPass)).$user['rand_str']);
        if($user_pwd == $user['pwd']){
            if($pass == $repass){
                $str=$this->_randStr(4);
                $user_pass=md5(md5($pass));
                $data['pwd']=md5($user_pass.$str);
                $data['rand_str']=$str;                 
                if( false!==M("user")->where(['id'=>$_SESSION['wap']['id']])->save($data)){
                    $info='2';
                    $this->ajaxReturn($info) ;exit;
                }else{
                    $info='5';
                    $this->ajaxReturn($info) ;exit;
                }
            }else{//两次密码不一致
                $info='4';
                $this->ajaxReturn($info) ;exit;
            }
        }else{//原始密码错误
            $info='3';
            $this->ajaxReturn($info) ;exit;
        }
    }
    //修改手机号--验证原手机号
    public function telephone(){
        $this->display();
    }
    //修改手机号--新手机号
    public function telephone_number(){
        $this->display();
    }
     //修改手机发送验证码
    public  function updateMobileOldCode(){
        $umobile=I("post.mobile","");
        $mobile =trim($umobile);
        if(!empty($mobile)){       
            $ret=$this->_sendCode($mobile);
            if($ret['status'] == 'success'){
                $infor=2;
                $this->ajaxReturn($infor);
                exit;             
            }else{
                $infor=3;
                $this->ajaxReturn($infor);
                exit;
            }
        }
    }
    //验证 验证码是否正确
    public function verifyOldMobileValidCode(){
        $mobile=I("post.mobile","");
        $smsCode=I("post.validCode","");
        if($this->_isCode($mobile,$smsCode) == true){
            $info='2';
            $this->ajaxReturn($info) ;exit;
        }else{
            $info='3';
            $this->ajaxReturn($info) ;exit;        
        }
    }
    //绑定新手机 发送验证码
    public function updateMobileNewCode(){
        $umobile=I("post.mobile","");
        $mobile =trim($umobile);
        if(!empty($mobile)){  
            $che_mob=M('user')->field('mobile')->where(['mobile'=>$mobile])->find();
            if($che_mob){
                $infor=4;
                $this->ajaxReturn($infor);
                exit;  
            }else{
                $ret=$this->_sendCode($mobile);
                if($ret['status'] == 'success'){
                    $infor=2;
                    $this->ajaxReturn($ret);
                    exit;             
                }else{
                    $infor=3;
                    $this->ajaxReturn($infor);
                    exit;
                }
            }     
        }
    }
    //绑定新手机
    public function verifyNewMobileValidCode(){
        $mobile=I("post.mobile","");
        $smsCode=I("post.validCode","");
        $che_mob=M('user')->field('mobile')->where(['mobile'=>$mobile])->find();
        if($che_mob){
            $infor='4';
            $this->ajaxReturn($infor);
            exit;  
        }else{
            $data['mobile']=$mobile;
            if( false!==M("user")->where(['id'=>$_SESSION['wap']['id']])->save($data)){
                unset($_SESSION['wap']['mobile']);
                unset($_SESSION['wap']['id']);
                unset($_SESSION['wap']['status']);
                $info='2';
                $this->ajaxReturn($info) ;exit;
            }else{
                $info='3';
                $this->ajaxReturn($info) ;exit;
            }
        }
    }
    //支付密码
    public function amend_pay_number(){
        $this->display();
    }
    public function pay_number(){
        $this->display();
    }
    //验证验证码(修改支付密码下一步)
    public function verifyOldPayValidCode(){
        $mobile=I("post.mobile","");
        $smsCode=I("post.validCode","");
        if($this->_isCode($mobile,$smsCode) == true){
            $info='2';
            $this->ajaxReturn($info) ;exit;
        }else{
            $info='3';
            $this->ajaxReturn($info) ;exit;        
        }
    }
     //设置新的支付密码
    public function updateNewPayPass(){
        $oldPass=I("post.oldPass","");
        $pass=I("post.pass","");
        $repass=I("post.repass","");
        $user=M("user")->field('pay_pwd,pay_rand_str')->where(['id'=>$_SESSION['wap']['id']])->find();
        $user_pwd=md5(md5(md5($oldPass)).$user['pay_rand_str']);
        if($user_pwd == $user['pay_pwd']){
            if($pass == $repass){
                $str=$this->_randStr(4);
                $user_pass=md5(md5($pass));
                $data['pay_pwd']=md5($user_pass.$str);
                $data['pay_rand_str']=$str;                 
                if( false!==M("user")->where(['id'=>$_SESSION['wap']['id']])->save($data)){
                    $info='2';
                    $this->ajaxReturn($info) ;exit;
                }else{
                    $info='5';
                    $this->ajaxReturn($info) ;exit;
                }
            }else{//两次密码不一致
                $info='4';
                $this->ajaxReturn($info) ;exit;
            }
        }else{//原始密码错误
            $info='3';
            $this->ajaxReturn($info) ;exit;
        }
    }
    //提现管理
    public function shenqing(){
        $info = M('wht_tilog')
            ->where(['uid'=>$_SESSION['wap']['id']])
            ->limit('6')
            ->order('id desc')
            ->select();
        $this->assign('info',$info);
        $this->display();
    }
    //申请提现--审核跳转
    public function doTiXian(){
        $user=M('user_infor')->field('yhk_sta')->where(['uid'=>$_SESSION['wap']['id']])->find();
        if($user['yhk_sta'] == 3){
            die('您还没有绑定银行卡,请在安全中心中绑定！');
        }else{
            die('ok');
        }
    }
    //申请提现--提交页面
    public function tixian(){
        $this->display();
    }
    //验证--银行是否绑定
    public function checkBank(){
        $user=M('user_infor')->field('bal,yhk_kh,yhk_name,yhk_type,yhk_sta')->where(['uid'=>$_SESSION['wap']['id']])->find();
        if($user['yhk_sta'] == 3){
            $info['msg']='您还没有绑定银行卡！';
            $this->ajaxReturn($info);exit;
        }else{
            $info['flg']='2';
            $info['bal']=$user['bal'];
            $info['num']=$user['yhk_kh'];
            $info['name']=$user['yhk_name'];
            $info['type']=$user['yhk_type'];
            $this->ajaxReturn($info);exit;
        }
    }
    //提交提现申请
    public function userdepsit(){
        $money=I('post.money','');
        if(!preg_match("/^[1-9][0-9]*$/",$money)){
            $info['msg']='金额错误！';
            $this->ajaxReturn($info);exit;
        }
        if($money < 100){
            $info['msg']='单次提现不得小于100元！';
            $this->ajaxReturn($info);exit;
        }
        $pass=I('post.pass','');
        if($money != '' && $pass != ''){
            if($money <= 50000){
                $day_start = strtotime(date("Ymd"));
                $day_end=$day_start+86400;
                $summoney=M('wht_tilog')->field('sum(money)')->where("uid='{$_SESSION['wap']['id']}' and {$day_start}<=ctime and ctime<$day_end ")->find();
                $is=$summoney['sum(money)']+$money;
                if($summoney['sum(money)'] <= 50000 ){
                    if($is <= 50000){
                        $userbal = M('user_infor')->field('bal')->where(['uid'=>$_SESSION['wap']['id']])->find();
                        $user=M("user")->field('pay_pwd,pay_rand_str')->where(['id'=>$_SESSION['wap']['id']])->find();
                        $user_pwd=md5(md5(md5($pass)).$user['pay_rand_str']);
                        if($user_pwd == $user['pay_pwd']){
                            if($userbal['bal'] >= $money){
                                //开启事务
                                M()->startTrans();
                                //添加提现记录
                                $order_num=date("YmdHis",time()).$this->_randStr(6,1);
                                $res1=M('wht_tilog')->add(['uid'=>$_SESSION['wap']['id'],'money'=>$money,'shiji'=>$money-5,'ctime'=>time(),'status'=>2,'number'=>$order_num]);
                                //跟新余额
                                $bal=$userbal['bal']-$money;
                                $res2 =M('user_infor')->where(['uid'=>$_SESSION['wap']['id']])->setInc(['bal'=>$bal]);
                                //添加资金变动表
                                $res3=$this->billadd($_SESSION['wap']['id'],5,$money,$bal,2,3,2);
                                if($res1 && $res2 && $res3){
                                    M()->commit();
                                    $info['msg']='ok';
                                    $this->ajaxReturn($info);exit;    
                                }else{
                                    M()->rollback();
                                    $info['msg']='申请失败！';
                                    $this->ajaxReturn($info);exit;
                                }
                            }else{
                                $info['msg']='您的提现金额不足！';
                                $this->ajaxReturn($info);exit;
                            }
                        }else{
                            $info['msg']='交易密码错误！';
                            $this->ajaxReturn($info);exit;
                        }
                    }else{
                        $info['msg']='每日最多提现5万元！';
                        $this->ajaxReturn($info);exit;
                    }
                }else{
                    $info['msg']='每日最多提现5万元！';
                    $this->ajaxReturn($info);exit;
                }
            }else{
                $info['msg']='单笔最多提现5万元！';
                $this->ajaxReturn($info);exit;
            }
        }else{
            $info['msg']='提交错误，请从新提交！';
            $this->ajaxReturn($info);exit;
        }
    }
     //收货地址
    public function address(){
        $address=M("address");
        $user_address=$address->field("id,name,street,mobile,sta,province,city,area")->where("uid='{$_SESSION['wap']['id']}'")->select();
        $this->assign("user_address",$user_address);
        $this->display();
    }
    //新增收货地址
    public function addressinfor(){
        $this->display(); 
    }
    public function dizhione(){
        $province=M("province");
        $sheng=$province->where("pid=0")->select();
        $this->assign("sheng",$sheng);
        $this->display();
    }
    public function dizhitwo(){
        $province=M("province");
        $pid=I('get.pid','');
        $city=$province->where(['pid'=>$pid])->select();
        $this->assign("city",$city);
        $this->assign("pid",$pid);
        $this->display();
    }
    public function dizhithree(){
        //三级联动----区、县
        $this->display();
    }
    public function ajaxdizhithree(){
         //三级联动----区、县
        $province=M("province");
        $cid=I('post.city_id','');
        $area=$province->where(['pid'=>$cid])->select();
        $this->ajaxReturn($area);
        exit;
    }
    public function ajaxAddressInfo(){
        $pid=I('post.pro_id','');
        $cid=I('post.city_id','');
        $aid=I('post.area_id','');
        $province=M("province");
        $sheng=$province->field('name')->where(['id'=>$pid])->find();
        $city=$province->field('name')->where(['id'=>$cid])->find();
        $area=$province->field('name')->where(['id'=>$aid])->find();
        $this->ajaxReturn($sheng['name'].'-'.$city['name'].'-'.$area['name']);
        exit;
    }
    public function setAddressInfo(){//增加收货地址---更新收货地址
        $address=M("address");
        $count=$address->field("count(id)")->where(['uid'=>$_SESSION['wap']['id']])->find();
        if($count['count(id)'] < 4){
            $province=M("province");
            $sheng=$province->field('name')->where(['id'=>$_POST['pro_id']])->find();
            $city=$province->field('name')->where(['id'=>$_POST['city_id']])->find();
            $area=$province->field('name')->where(['id'=>$_POST['area_id']])->find();
            $data['name']   = $_POST['uname'];
            $data['pro_id']   = $_POST['pro_id'];
            $data['city_id']   = $_POST['city_id'];
            $data['area_id']   = $_POST['area_id'];
            $data['province']   = $sheng['name'];
            $data['city']   = $city['name'];
            $data['area']   = $area['name'];
            $data['sta']   = $_POST['isdefault'];
            $data['street']   = $_POST['street'];
            $data['mobile']   = $_POST['mobile'];
            $data['uid']   = $_SESSION['wap']['id'];
            $addressId=$address->add($data);
            if($addressId){
                if($_POST['isdefault'] == 2){
                    $userstate=$address->field("id")->where("uid='{$_SESSION['wap']['id']}' and id!='{$addressId}'")->select();
                     foreach($userstate as $k=>$v){
                        $address->where(['id'=>$v['id']])->save(['sta'=>3]);
                    }
                }
                $info='ok';
                $this->ajaxReturn($info);
                exit;
            }else{
                $info='添加失败！';
                $this->ajaxReturn($info);
                exit;
            }
        }else{
            $info='最多添加4条地址！';
            $this->ajaxReturn($info);
            exit;
        }
    }
    public function addressinforset(){
        if(IS_POST){
            $address=M('address');
            $id=I('post.id','');
            $province=M("province");
            if($_POST['pro_id'] != '' && $_POST['city_id'] !='' && $_POST['area_id']!=''){
                $sheng=$province->field('name')->where(['id'=>$_POST['pro_id']])->find();
                $city=$province->field('name')->where(['id'=>$_POST['city_id']])->find();
                $area=$province->field('name')->where(['id'=>$_POST['area_id']])->find();
                $data['pro_id']   = $_POST['pro_id'];
                $data['city_id']   = $_POST['city_id'];
                $data['area_id']   = $_POST['area_id'];
                $data['province']   = $sheng['name'];
                $data['city']   = $city['name'];
                $data['area']   = $area['name'];
            }
            $data['name']   = $_POST['uname'];
            $data['sta']   = $_POST['isdefault'];
            $data['street']   = $_POST['street'];
            $data['mobile']   = $_POST['mobile'];
            if(false!==$address->where(['id'=>$id])->save($data)){
                if($_POST['isdefault'] == 2){
                    $userstate=$address->field("id")->where("uid='{$_SESSION['wap']['id']}' and id!='{$id}'")->select();
                    foreach($userstate as $k=>$v){
                        $address->where(['id'=>$v['id']])->save(['sta'=>3]);
                    }
                }
                $info='ok';
                $this->ajaxReturn($info);
                exit;
            }else{
                $info='修改失败！';
                $this->ajaxReturn($info);
                exit;
            }
        }else{
            $id=I('get.id','');
            $address=M("address");
            $address_arr=$address->field("id,name,street,mobile,sta,province,city,area")->where(['id'=>$id])->find();
            $this->assign('res',$address_arr);
            $this->display();
        }
    }
    public function addressdel(){
        $id=$_POST['id'];
        if ($id!="") {
            $Model=M();
            if ($Model->execute("delete from sc_address where id='{$id}'")) {
                echo "1";
                exit;
            }else{
                echo "0";
                exit;
            }
        }
    }
    #兑入记录
    public function dui_list(){
        $where['uid']=$_SESSION['wap']['id'];
        $total = M('wht_ru_log')->where(['uid'=>$_SESSION['wap']['id']])->count();
        $info = M('wht_ru_log')
            ->field('wht_pay,shop_pay,type,money,ctime')
            ->where($where)
            ->limit('8')
            ->order('ctime desc')
            ->select();
        $typearr = ['2'=>'可用金','3'=>'消费积分','4'=>'理财收益','5'=>'代理收益','6'=>'推广收益'];
        $this->assign('typearr',$typearr);
        $this->assign('info',$info);
        $this->display();
    }
     //头像上传
    public function pic(){
        $user=M('user_infor')->field('photo')->where(['uid'=>$_SESSION['wap']['id']])->find();
        $this->assign('user',$user);
        $this->display();
    }
     //头像上传
    public function userlogo(){
        $img=$_POST['image'];
        $imgs=str_replace('data:image/jpeg;base64,','', $img);
        $data=base64_decode($imgs);
        $dir=$_SESSION['wap']['id'];
        $saveName=date("Ymd",time()).$this->_randStr(4,1);
        $save_path = $this->_createDirUser($dir);
        $file_name = $save_path.$saveName.'.jpg'; //上传后的文件保存路径和名称 
        file_put_contents($file_name, $data);
        $param['photo'] = '/Userlogo/'.$dir.'/'.$saveName.'.jpg';
        if(false !== M("user_infor")->where(['uid'=>$_SESSION['wap']['id']])->save($param)){
            $this->ajaxReturn('ok');exit;
        }else{
            $this->ajaxReturn('上传失败！');exit;
        }
    }
    //转账管理
    public function transfer(){
        $where['uid']=$_SESSION['wap']['id'];
        $info = M('transfer')
            ->where($where)
            ->limit('6')
            ->order('ztime desc')
            ->select();
        $this->assign('info',$info);
        $this->display();
    }
    //申请转账
    public function dotran(){
        $user=M('user_infor')->field('bal')->where(['uid'=>$_SESSION['wap']['id']])->find();
        $this->assign('user',$user);
        $this->display();
    }
    //提交转账
    public function dozhuandepsit(){
        $money=I('post.money','');
        $mobile=I('post.mobile','');
        if(!preg_match("/^[1-9][0-9]*$/",$money)){
            $info['msg']='金额错误！';
            $this->ajaxReturn($info);exit;
        }
        $userz=M("user")->field('id,mobile')->where(['mobile'=>$mobile])->find();
        $userbal2 = M('user_infor')->field('bal')->where(['uid'=>$userz['id']])->find();
        if(empty($userz)){
            $info['msg']='接收账户不存在！';
            $this->ajaxReturn($info);exit;
        }
        if($mobile == $_SESSION['wap']['mobile']){
            $info['msg']='您不可以给自己转账！';
            $this->ajaxReturn($info);exit;
        }
        $pass=I('post.pass','');
        if($money != '' && $pass != '' && $mobile != ''){
            if($money >=100){
                if($money <= 30000){
                    $userbal = M('user_infor')->field('bal')->where(['uid'=>$_SESSION['wap']['id']])->find();
                    $user=M("user")->field('mobile,pay_pwd,pay_rand_str')->where(['id'=>$_SESSION['wap']['id']])->find();
                    $user_pwd=md5(md5(md5($pass)).$user['pay_rand_str']);
                    if($user_pwd == $user['pay_pwd']){
                        if($userbal['bal'] >= $money){
                            //开启事务
                            M()->startTrans();
                            //添加提现记录
                            $order_num=date("YmdHis",time()).$this->_randStr(6,1);
                            $res1=M('transfer')->add(['uid'=>$_SESSION['wap']['id'],'money'=>$money,'mobile'=>$mobile,'ztime'=>time(),'status'=>2,'number'=>$order_num]);
                            //跟新余额
                            $bal1=$userbal['bal']-$money;
                            $bal2=$userbal2['bal']+$money;
                            $res2 =M('user_infor')->where(['uid'=>$_SESSION['wap']['id']])->setInc(['bal'=>$bal1]);
                            $res3 =M('user_infor')->where(['uid'=>$userz['id']])->setInc(['bal'=>$bal2]);
                            $res4=$this->billadd($_SESSION['wap']['id'],7,$money,$bal1,2,3,2);
                            $res5=$this->billadd($userz['id'],7,$money,$bal2,2,2,2);
                            if($res1 && $res2 && $res3 && $res4 && $res5){
                                M()->commit();
                                $info['msg']='ok';
                                $this->ajaxReturn($info);exit;    
                            }else{
                                M()->rollback();
                                $info['msg']='转账失败！';
                                $this->ajaxReturn($info);exit;
                            }
                        }else{
                            $info['msg']='您的转账金额不足！';
                            $this->ajaxReturn($info);exit;
                        }
                    }else{
                        $info['msg']='交易密码错误！';
                        $this->ajaxReturn($info);exit;
                    }
                }else{
                    $info['msg']='单笔最多3万元！';
                    $this->ajaxReturn($info);exit;
                }
            }else{
                $info['msg']='单笔最少转账100元！';
                $this->ajaxReturn($info);exit;
            }
        }else{
            $info['msg']='提交错误，请从新提交！';
            $this->ajaxReturn($info);exit;
        }
    }










    //充值-付款
    public function subPay(){
        $pay=I("post.pay","");
        if(preg_match("/^\+?[1-9][0-9]*$/",$pay)){
            //开启事务
            M()->startTrans();
            //更新用户可用金+消费币
            $userbal = M('user_infor')->field('bal')->where(['uid'=>$_SESSION['sc']['id']])->find();
            $bal=$userbal['bal']+$pay;
            $res1 =M('user_infor')->where(['uid'=>$_SESSION['sc']['id']])->setInc(['bal'=>$bal]);
            //添加资金变动表
            $res2 = M('bill')->add(['uid'=>$_SESSION['sc']['id'],'number'=>$pay,'money'=>$bal,'btime'=>time(),'type'=>3,'billnum'=>date("YmdHis",time()).$this->_randStr(4,1),'sta'=>2]);
            if ($res1 && $res2){
                M()->commit();
                $this->ajaxReturn('ok');exit;
            }else{
                M()->rollback();
                $this->ajaxReturn('充值失败！');exit;
            } 
        }else{
            $this->ajaxReturn('金额不正确！');exit;
        }
    }
    
    public function setcom(){
        if(!empty($_FILES)){
            foreach ($_FILES as $key => $item) {
                $dir=date("Ymd",time());
                $saveName=date("Ymd",time()).$this->_randStr(4,1);
                $saveExtStr=explode('/',$_FILES[$key]['type']);
                $saveExt=$saveExtStr[1];
                if (!empty($item['name'])) {
                    $uploadinfo = $this->_createThumImg($key, 'Goods/'.$dir, $saveName, $saveExt);
                    if($uploadinfo['tag'] == '1'){
                        echo '图片大小不得超过3MB';exit;
                    }else if($uploadinfo['tag'] == '2'){
                        echo '文件格式不正确';exit;
                    }else if($uploadinfo['tag'] == '3'){
                        echo '系统繁忙,请稍后再试';exit;
                    }else if($uploadinfo['tag'] == '4'){
                        $files[$key]=$uploadinfo['con'];
                    }
                }
            }
        }
        $cont=I('post.cont','');
        $gid=I('post.gid','');
        //开启事务
        M()->startTrans();
        //添加
        $res1=M("comment")->add(['uid'=>$_SESSION['wap']['id'],'cont'=>$cont,'ptime'=>time(),'gid'=>$gid]);
        if(!empty($_FILES)){
            $data['cid']=$res1;
            foreach ($files as $key => $value) {
                $data['showlogo']=$value;
                $res2 = M('comment_img')->add($data);
            }
        }
        $good=M('goods')->field('comment')->where(['id'=>$gid])->find();
        $com=$good['comment']+1;
        $res3 = M('goods')->where(['id'=>$gid])->setInc(['comment'=>$com]);
        if ($res1 &&  $res3){
            M()->commit();
            echo 'ok';
            exit;
        }else{
            if(!empty($files)){
                foreach ($files as $key => $value) {
                    @unlink($save_path.$value);//删除原来的图片
                }
            }
            M()->rollback();
            echo '发布失败';
            exit;
        }       
    }

   
    //去付款套包
    public function doPayBaoOrder(){
        $id=I('post.oid','');
        $type=M('buy_bao')->field('money')->where(['uid'=>$_SESSION['sc']['id'],'status'=>2,'id'=>$id])->find();
        if($type){
            $info['msg']='ok';
            $info['flg']=$type['money'];
        }else{
            $info['msg']='订单查询失败！';
        }
        $this->ajaxReturn($info);exit;
    }
    //使用套包
    public function shiyong(){
        $id=I('post.id','');
        $uid = $_SESSION['sc']['id'];
        $user = M('user')->field('shop_pay,wht_pay,status')->where(['id'=>$uid])->find();
        if($user['status'] == 3){
            die('账号已冻结,暂时无法操作!');
        }elseif(empty($user['wht_pay'])){
            die('请先绑定万花筒钱包地址!');
        }
        $buy_bao=M('buy_bao')->field('type')->where(['uid'=>$uid,'status'=>3,'id'=>$id])->find();
        if(empty($buy_bao)){
            die('操作异常!');
        }
        $typearr = array('2'=>'ZS','3'=>'YK','4'=>'JK','5'=>'ZK');
        $url = API_PATH . 'index.php?s=/Home/Api/shopRuBal/';
        $key = '118482494389c9ce536ae699cd1272c4';
        $wht_pay = $user['wht_pay'];
        $shop_pay = $user['shop_pay'];
        $type = $typearr[$buy_bao['type']];
        $sign = md5(md5($wht_pay).md5($type).md5($shop_pay).md5(md5($key)));
        $url .= 'wht_pay/'.$wht_pay.'/shop_pay/'.$shop_pay.'/type/'.$type.'/sign/'.$sign.'.html';
        $res = file_get_contents($url);
        if($res == '1000'){
            $data['status'] = 5;
            $where['id'] = $id;
            M('buy_bao')->where($where)->save($data);
            die('ok');
        }
        die;
    }
    

    
    public function postPay(){
        $where['uid'] = $_SESSION['sc']['id'];
        $where['status'] = 2;
        $buy_bao = M('buy_bao');
        $baoinfo = $buy_bao->where($where)->find();
        if(($baoinfo['buy_time'] + 1200) < time()){
            $where['id'] = $baoinfo['id'];
            $data['status'] = 6;
            $buy_bao->where($where)->save($data);
            echo '<script>alert("订单已过期请重新提交!");location.href="/home/pcenter/buy_bao_lst.html"</script>';
            die;
        }
        if($baoinfo['payurl']){
            echo '<script>location.href="'.$baoinfo['payurl'].'"</script>';
            die;
        }
        $money = $baoinfo['money'] + ($baoinfo['money'] * 0.003);
        $res = self::postYinsbPay($money,$baoinfo['number']);
        $resarr = (array)json_decode($res);
        if($resarr['resCode'] == '000000'){
            $where['id'] = $baoinfo['id'];
            $data['payurl'] = $resarr['payUrl'];
            $buy_bao->where($where)->save($data);
            echo '<script>location.href="'.$resarr['payUrl'].'"</script>';
        }
        die;
    }
    public function postYinsbPay($amount,$pay_number) {
        $SubmitUrl  = 'http://extman.baiduannet.com/pay/pay_mobile.action';
        $key        = '0ca7a8f74e1c79fae9db8c8ea2884aa5';                     #商户key
        $data['userid']     = '019699';                                       #商户IDID
        $data['orderCode']  = 'up_gateway';                                   #固定up_gatewayPay网关
        $data['notifyURL']  = 'https://www.fdcfsy.com/test/index.php';        #异步通知地址
        $data['frontURL']   = 'https://www.fdcfsy.com/home/Pcenter/resfront';     #成功后返回地址
        $data['pay_number'] = $pay_number;                                    #订单号
        $data['amount']     = $amount;                                        #支付金额
        $data['remark']     = '购买套餐包';                                   #订单号
        $data['route']      = 'baiduan';                                      #固定：baiduan
        $signstr            = 'amount='.$data['amount'];
        $signstr           .= '&route='.$data['route'];
        $signstr           .= '&userid='.$data['userid'];
        $signstr           .= '&key='.$key;
        $data['sign']     = md5($signstr);#数字签名
        /*提交代付信息至接口*/
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $SubmitUrl);
        curl_setopt ($ch, CURLOPT_POST, 1);
        if($data != ''){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        return $file_contents;
    }
    public function resfront(){
        $where['uid'] = $_SESSION['sc']['id'];
        $where['status'] = 2;
        $buy_bao = M('buy_bao');
        $baoinfo = $buy_bao->where($where)->find();
        if(!$baoinfo){
            die('操作异常');
        }
        $SubmitUrl  = 'http://extman.baiduannet.com/pay/pay_mobile.action';
        $key             = '0ca7a8f74e1c79fae9db8c8ea2884aa5';         #商户KEY
        $data['userid']          = '019699';
        $data['pay_number']      = $baoinfo['number'];                          #固定up_QueryWithdrawOrder
        $data['route']           = 'baiduan';                                  #baiduan
        $data['orderCode']       = 'up_Querygateway';                         #用户姓名
        $signstr           .= 'route='.$data['route'];
        $signstr           .= '&userid='.$data['userid'];
        $signstr           .= '&key='.$key;
        $data['sign']            = md5($signstr);     #数字签名
        #生成请求支付接口表单并提交
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $SubmitUrl);
        curl_setopt ($ch, CURLOPT_POST, 1);
        if($data != ''){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        $res = (array)json_decode($file_contents);
        if($res['status'] == '支付成功' && $res['resCode'] == '000000'){
            $buy_bao_data['status'] = 3;
            $buy_bao_where['id'] = $baoinfo['id'];
            $buy_bao->where($buy_bao_where)->save($buy_bao_data);
            echo '<script>alert("购买成功");location.href="/home/pcenter/buy_bao_lst.html"</script>';
        }
        die;
    }
}