<?php
namespace Home\Controller;
use Think\Controller;
use Think\Pagei;
class PcenterController extends ComController {
    //会员首页
    protected function _initialize(){
        if(empty($_SESSION['sc']['id'])){
            //跳转到认证网关
            $this->redirect('Login/login');
        }
    }
    //个人中心
    public function account(){
        //用户信息
        $user=M('user_infor')->field('bal,ke_bal,xfb_bal,fre_bal')->where(['uid'=>$_SESSION['sc']['id']])->find();
        //最近订单
        $info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.state,o.buynum,o.price,o.xfb,g.id,g.goods_title,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['uid'=>$_SESSION['sc']['id']])
            ->limit('6')
            ->order('o.buytime desc')
            ->select();
        //待付款
        $fukan=M('order')->field('order_id')->where(['uid'=>$_SESSION['sc']['id'],'state'=>5])->count();    
        //待发货
        $fahuo=M('order')->field('order_id')->where(['uid'=>$_SESSION['sc']['id'],'state'=>3])->count();
        //待收货
        $shouhuo=M('order')->field('order_id')->where(['uid'=>$_SESSION['sc']['id'],'state'=>2])->count();
        //待评价
        $pingjia=M('order')->field('order_id')->where(['uid'=>$_SESSION['sc']['id'],'state'=>4])->count();
        $this->assign('fukan',$fukan);
        $this->assign('fahuo',$fahuo);
        $this->assign('shouhuo',$shouhuo);
        $this->assign('pingjia',$pingjia);
        $this->assign('info',$info);
        $this->assign('user',$user);
        $this->display();
    }
    //头像上传
    public function userphoto(){
        if(empty($_FILES['avatar']['name'])){
            echo '请上传头像图片！';
            exit;
        }
        $saveName=date("Ymd",time()).$this->_randStr(4,1);
        $saveExtStr=explode('/',$_FILES['avatar']['type']);
        $saveExt=$saveExtStr[1];
        $dir=$_SESSION['sc']['id'];
        $userLogo = M('user_infor')->field('photo')->where(['uid'=>$dir])->find();
        $logo=$this->_createThumImg('avatar', 'Userlogo/'.$dir, $saveName, $saveExt);
        if($logo['tag'] == '1'){
            echo '图片大小不得超过3MB';exit;
        }else if($logo['tag'] == '2'){
            echo '文件格式不正确';exit;
        }else if($logo['tag'] == '3'){
            echo '系统繁忙,请稍后再试';exit;
        }else if($logo['tag'] == '4'){
            $save_path='./Uploads';
            if(!empty($userLogo['photo'])){
                @unlink($save_path.$userLogo['photo']);//删除原来的图片
            }
            $data['photo']=$logo['con'];
        }    
        $user=M("user_infor");
        if(false !== $user->where(['uid'=>$_SESSION['sc']['id']])->save($data)){
            echo 'ok';exit;
        }else{
            echo '上传失败！';exit;
        }
    }
    #购买记录
    public function buy_list_item(){
        $where['uid']=$_SESSION['sc']['id'];
        $total = M('order')->where(['uid'=>$_SESSION['sc']['id']])->count();
        $limit = 8;
        $page = new Pagei($total,$limit);
        $info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.price,o.xfb,g.id,g.goods_title,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where($where)
            ->limit($page->firstRow.','.$limit)
            ->order('o.order_id desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    #兑入记录
    public function dui_list(){
        $where['uid']=$_SESSION['sc']['id'];
        $total = M('wht_ru_log')->where(['uid'=>$_SESSION['sc']['id']])->count();
        $limit = 8;
        $page = new Pagei($total,$limit);
        $info = M('wht_ru_log')
            ->field('wht_pay,shop_pay,type,money,ctime')
            ->where($where)
            ->limit($page->firstRow.','.$limit)
            ->order('ctime desc')
            ->select();
        $html = $page->show();
        $typearr = ['2'=>'可用金','3'=>'消费积分','4'=>'理财收益','5'=>'代理收益','6'=>'推广收益'];
        $this->assign('page',$html);
        $this->assign('typearr',$typearr);
        $this->assign('info',$info);
        $this->display();
    }
    #套餐包订单记录
    public function bug_bao_lst(){
        $where['uid']=$_SESSION['sc']['id'];
        $total = M('order')->where(['uid'=>$_SESSION['sc']['id']])->count();
        $limit = 8;
        $page = new Pagei($total,$limit);
        $info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.price,o.xfb,g.id,g.goods_title,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where($where)
            ->limit($page->firstRow.','.$limit)
            ->order('o.order_id desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    
    #财务记录
    public function bill_list_item(){
        $where['uid']=$_SESSION['sc']['id'];
        $total = M('bill')->where(['uid'=>$_SESSION['sc']['id']])->count();
        $limit = 8;
        $page = new Pagei($total,$limit);
        $info = M('bill')
            ->field('id,number,btime,type,billnum,xfb,ke_bal,sts,stus')
            ->where($where)
            ->limit($page->firstRow.','.$limit)
            ->order('id desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    //收货地址
    public function address(){
        $address=M("address");
        $user_address=$address->field("id,name,street,mobile,sta,province,city,area")->where("uid='{$_SESSION['sc']['id']}'")->select();
        $addcount=$address->field("count(uid)")->where("uid='{$_SESSION['sc']['id']}'")->find();
        $this->assign("user_address",$user_address);
        $this->assign("addcount",$addcount["count(uid)"]);
        $this->display();
    }
    //新增收货地址
    public function addressinfor(){
        $province=M("province");
        $address=M("address");
        $province_arr=$province->where("pid=0")->select();
        $addcount=$address->field("count(uid)")->where("uid='{$_SESSION['sc']['id']}'")->find();
        $this->assign("addcount",$addcount["count(uid)"]);
        $this->assign("province_arr",$province_arr);
        $this->display(); 
    }
    public function pro_city(){
        //三级联动----市
        $province=M("province");
        $city=$province->where("pid='{$_POST['procode']}'")->select();
        echo json_encode($city);
        exit;
    }
    public function city_area(){
        //三级联动----市
        $province=M("province");
        $area=$province->where("pid='{$_POST['citycode']}'")->select();
        echo json_encode($area);
        exit;
    }
    public function setAddressInfo(){//增加收货地址---更新收货地址
        $address=M("address");
        $count=$address->field("count(id)")->where("uid='{$_SESSION['sc']['id']}'")->find();
        if($count['count(id)'] < 4){
            $data['name']   = $_POST['uname'];
            $data['pro_id']   = $_POST['pro_id'];
            $data['city_id']   = $_POST['city_id'];
            $data['area_id']   = $_POST['area_id'];
            $data['province']   = $_POST['province'];
            $data['city']   = $_POST['city'];
            $data['area']   = $_POST['area'];
            $data['sta']   = $_POST['isdefault'];
            $data['street']   = $_POST['street'];
            $data['mobile']   = $_POST['mobile'];
            $data['uid']   = $_SESSION['sc']['id'];
            $addressId=$address->add($data);
            if($addressId){
                if($_POST['isdefault'] == 2){
                    $userstate=$address->field("id")->where("uid='{$_SESSION['sc']['id']}' and id!='{$addressId}'")->select();
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
            $id=I('post.aid','');
            $data['name']   = $_POST['uname'];
            $data['pro_id']   = $_POST['pro_id'];
            $data['city_id']   = $_POST['city_id'];
            $data['area_id']   = $_POST['area_id'];
            $data['province']   = $_POST['province'];
            $data['city']   = $_POST['city'];
            $data['area']   = $_POST['area'];
            $data['sta']   = $_POST['isdefault'];
            $data['street']   = $_POST['street'];
            $data['mobile']   = $_POST['mobile'];
            if(false!==$address->where(['id'=>$id])->save($data)){
                if($_POST['isdefault'] == 2){
                    $userstate=$address->field("id")->where("uid='{$_SESSION['sc']['id']}' and id!='{$id}'")->select();
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
            $address_arr=$address->field("id,name,street,mobile,sta,pro_id,city_id,area_id")->where(['id'=>$id])->find();
            $province_arr=M('province')->select();
            $addcount=$address->field("count(uid)")->where("uid='{$_SESSION['sc']['id']}'")->find();
            $this->assign("addcount",$addcount["count(uid)"]);
            $this->assign("province_arr",$province_arr);
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
    //身份认证
    public function idCardAuth(){
        $user_infor=M("user_infor");
        $data['uname']=I("post.realname","");
        $data['ucode']=I("post.idcard","");
        $data['usta']=2;
        if(false !== $user_infor->where(['uid'=>$_SESSION['sc']['id']])->save($data)){
            $info='2';
            $this->ajaxReturn($info) ;exit;
        }else{
            $info='3';
            $this->ajaxReturn($info) ;exit;
        }
    }
    //安全中心
    public  function save(){
        $info = M('user')
            ->field('u.pay_pwd,u.shop_pay,u.wht_pay,i.usta,i.yhk_sta,i.yhk_name,i.yhk_type,i.yhk_kh,i.uname,i.ucode')
            ->alias('u')
            ->join('left join __USER_INFOR__ i on u.id = i.uid')
            ->where(['u.id'=>$_SESSION['sc']['id']])
            ->find();
        $this->assign('info',$info);
        $this->display();
    }
    //验证登录原密码
    public function checkOldPass(){
        $pass=I("post.pass","");
        $user=M("user")->field('pwd,rand_str')->where(['id'=>$_SESSION['sc']['id']])->find();
        $userpass=md5(md5($pass));
        $user_pwd=md5($userpass.$user['rand_str']);
        if($user_pwd == $user['pwd']){
            $info='2';
            $this->ajaxReturn($info) ;exit;
        }else{
            $info='3';
            $this->ajaxReturn($info) ;exit;
        }
    }
    //修改登录密码
    public function updatePass(){
        $oldPass=I("post.oldPass","");
        $pass=I("post.pass","");
        $repass=I("post.repass","");
        $user=M("user")->field('pwd,rand_str')->where(['id'=>$_SESSION['sc']['id']])->find();
        $user_pwd=md5(md5(md5($oldPass)).$user['rand_str']);
        if($user_pwd == $user['pwd']){
            if($pass == $repass){
                $str=$this->_randStr(4);
                $user_pass=md5(md5($pass));
                $data['pwd']=md5($user_pass.$str);
                $data['rand_str']=$str;                 
                if( false!==M("user")->where(['id'=>$_SESSION['sc']['id']])->save($data)){
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
                    $this->ajaxReturn($infor);
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
            if( false!==M("user")->where(['id'=>$_SESSION['sc']['id']])->save($data)){
                unset($_SESSION['sc']['usermobile']);
                unset($_SESSION['sc']['id']);
                unset($_SESSION['sc']['status']);
                $info='2';
                $this->ajaxReturn($info) ;exit;
            }else{
                $info='3';
                $this->ajaxReturn($info) ;exit;
            }
        }
    }
    //设置支付密码验证验证码下一步
    public function verifybindEmailMobileValidCode(){
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
    //设置支付密码
    public function updatePayPass(){
        $pass=I("post.pass","");
        $repass=I("post.repass","");
        if($pass == $repass){
            $str=$this->_randStr(4);
            $user_pass=md5(md5($pass));
            $data['pay_pwd']=md5($user_pass.$str);
            $data['pay_rand_str']=$str;                 
            if( false!==M("user")->where(['id'=>$_SESSION['sc']['id']])->save($data)){
                $info='2';
                $this->ajaxReturn($info) ;exit;
            }else{
                $info='3';
                $this->ajaxReturn($info) ;exit;
            }
        }else{
            $info='4';
            $this->ajaxReturn($info) ;exit;
        }
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
    //验证原支付密码
    public function checkOldPayPass(){
        $pass=I("post.pass","");
        $user=M("user")->field('pay_pwd,pay_rand_str')->where(['id'=>$_SESSION['sc']['id']])->find();
        $user_pwd=md5(md5(md5($pass)).$user['pay_rand_str']);
        if($user_pwd == $user['pay_pwd']){
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
        $user=M("user")->field('pay_pwd,pay_rand_str')->where(['id'=>$_SESSION['sc']['id']])->find();
        $user_pwd=md5(md5(md5($oldPass)).$user['pay_rand_str']);
        if($user_pwd == $user['pay_pwd']){
            if($pass == $repass){
                $str=$this->_randStr(4);
                $user_pass=md5(md5($pass));
                $data['pay_pwd']=md5($user_pass.$str);
                $data['pay_rand_str']=$str;                 
                if( false!==M("user")->where(['id'=>$_SESSION['sc']['id']])->save($data)){
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
    //忘记支付密码--重置
    public function updateNewPayPassUser(){
        $pass=I("post.pass","");
        $repass=I("post.respass","");
        $mobile=I("post.mobile","");
        $code=I("post.code","");
        if($this->_isCode($mobile,$code) == true){
            if($pass == $repass){
                $str=$this->_randStr(4);
                $user_pass=md5(md5($pass));
                $data['pay_pwd']=md5($user_pass.$str);
                $data['pay_rand_str']=$str;                 
                if( false!==M("user")->where(['id'=>$_SESSION['sc']['id']])->save($data)){
                    $info['infor']='2';
                    $this->ajaxReturn($info) ;exit;
                }else{
                    $info['infor']='3';
                    $this->ajaxReturn($info) ;exit;
                }
            }else{//两次密码不一致
                $info['infor']='4';
                $this->ajaxReturn($info) ;exit;
            }
        }else{//验证码错误或者已过期
            $info['infor']='5';
            $this->ajaxReturn($info) ;exit;        
        }
    }
    //充值-付款
    public function subPay(){
        $pay=I("post.pay","");
        if(preg_match("/^\+?[1-9][0-9]*$/",$pay)){
            //开启事务
            M()->startTrans();
            $userbal = M('user_infor')->field('bal')->where(['uid'=>$_SESSION['sc']['id']])->find();
            $bal=$userbal['bal']+$pay;
            $res1 =M('user_infor')->where(['uid'=>$_SESSION['sc']['id']])->setInc(['bal'=>$bal]);
            //添加资金变动表
            //$res2 = M('bill')->add(['uid'=>,'number'=>$pay,'money'=>$bal,'btime'=>time(),'type'=>3,'billnum'=>date("YmdHis",time()).$this->_randStr(4,1),'sta'=>2,'stus'=>2,'sts'=>2]);
            $res2=$this->billadd($_SESSION['sc']['id'],3,$pay,$bal,2,2,2);
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
    //评价
    public function pingjia(){
        $gid=I('get.gid','');
        $good=M('goods')->field('id,goods_title,goods_logo,price,xfb,comment')->where(['id'=>$gid])->find();
        $this->assign('good',$good);
        $total = M('comment')->where(['gid'=>$gid])->count();
        $limit = 10;
        $page = new Pagei($total,$limit);
        $info = M('comment')
            ->field('o.id,o.cont,o.ptime,u.nick_name')
            ->alias('o')
            ->join('left join __USER_INFOR__ u on o.uid = u.uid')
            ->where(['o.gid'=>$gid])
            ->limit($page->firstRow.','.$limit)
            ->order('o.id desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
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
        $res1=M("comment")->add(['uid'=>$_SESSION['sc']['id'],'cont'=>$cont,'ptime'=>time(),'gid'=>$gid]);
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
    //钱包绑定
    public function payKeySuc(){
        $num=I('post.paynum','');
        $user = M('user')->field('wht_pay')->where(['id'=>$_SESSION['sc']['id']])->find();
        $wht_pay = M('user')->field('wht_pay')->where(['wht_pay'=>$num])->find();
        if($wht_pay){
           $this->ajaxReturn('钱包地址已绑定,请更换钱包地址!');exit; 
        }
        if($user['wht_pay'] == 0){
            if(false !== M('user')->where(['id'=>$_SESSION['sc']['id']])->save(['wht_pay'=>$num])){
                $this->ajaxReturn('ok');exit;
            }else{
                $this->ajaxReturn('绑定失败，请从新绑定！');exit;
            }
        }else{
            $this->ajaxReturn('已绑定，不可修改！');exit;
        }
    }
    //套包
    public function buy_bao_lst(){
        $type=M('buy_bao')->field('id')->where(['uid'=>$_SESSION['sc']['id'],'status'=>2])->find();
        if($type){
            $this->assign('type',2);
        }else{
            $this->assign('type',3);
        }
        $total = M('buy_bao')->where(['uid'=>$_SESSION['sc']['id']])->count();
        $limit = 8;
        $page = new Pagei($total,$limit);
        $info = M('buy_bao')
            ->where(['uid'=>$_SESSION['sc']['id']])
            ->limit($page->firstRow.','.$limit)
            ->order('id desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    //套包生成订单
    public function paybao(){
        $type=M('buy_bao')->field('id')->where(['uid'=>$_SESSION['sc']['id'],'status'=>2])->find();
        if($type){
            $info['msg']='您有订单未支付，请先支付!';
            $this->ajaxReturn($info);
            exit;
        }else{
            $pay=I('post.pay');
            $type=I('post.type');
            $order_num=date("YmdHis",time()).$this->_randStr(6,1);
            $res = M('buy_bao')->add(['number'=>$order_num,'type'=>$type,'uid'=>$_SESSION['sc']['id'],'money'=>$pay,'buy_time'=>time(),'status'=>2,'mobile'=>$_SESSION['sc']['usermobile']]);
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
        $typearr = array('2'=>'ZS','3'=>'YK','4'=>'JK','5'=>'ZK','6'=>'10LC','7'=>'30LC','8'=>'100LC','9'=>'500LC','10'=>'1000LC','11'=>'10JH','12'=>'50JH','13'=>'100JH');
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
    #取消套餐包
    public function quxiao(){
        $id=I('post.id','');
        $uid = $_SESSION['sc']['id'];
        $user = M('user')->field('status')->where(['id'=>$uid])->find();
        if($user['status'] == 3){
            die('账号已冻结,暂时无法操作!');
        }
        $buy_bao=M('buy_bao')->field('type')->where(['uid'=>$uid,'status'=>2,'id'=>$id])->find();
        if(empty($buy_bao)){
            die('操作异常!');
        }
        $data['status'] = 6;
        $where['id'] = $id;
        M('buy_bao')->where($where)->save($data);
        die('ok');
        die;
    }
    //购买套包
    public function checkstand(){
        $this->display();
    }
    //购买理财券
    public function checklcq(){
        echo '<script>location.href="/home/pcenter/buy_bao_lst.html"</script>';
        die;
        $this->display();
    }
    //购买激活币
    public function checkjhb(){
        echo '<script>location.href="/home/pcenter/buy_bao_lst.html"</script>';
        die;
        $this->display();
    }
    //收银台付款
    public function pay(){
        $this->display();
    }
    //对公账户 打款
    public function pay_show(){
        $this->display();
    }
    //绑定银行卡
    public function userbank(){
        $name=I('post.name','');
        $type=I('post.type','');
        $num=I('post.num','');
        if($name && $type && $num){
            if(preg_match("/^\d*$/",$num)){
                $user=M('user_infor')->field('yhk_sta')->where(['uid'=>$_SESSION['sc']['id']])->find();
                $isyhk=M('user_infor')->field('id')->where(['yhk_kh'=>$num])->find();
                if($isyhk){
                    $info['msg']='银行卡已绑定,请更换银行卡！';
                    $this->ajaxReturn($info);exit;
                }
                if($user['yhk_sta'] == 2){
                    $info['msg']='您已绑定银行卡！';
                    $this->ajaxReturn($info);exit;
                }else{
                    if(false !== M('user_infor')->where(['uid'=>$_SESSION['sc']['id']])->save(['yhk_kh'=>$num,'yhk_name'=>$name,'yhk_type'=>$type,'yhk_sta'=>2])){
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
    //提现管理
    public function packet(){
        $total = M('wht_tilog')->where(['uid'=>$_SESSION['sc']['id']])->count();
        $limit = 8;
        $page = new Pagei($total,$limit);
        $info = M('wht_tilog')
            ->where(['uid'=>$_SESSION['sc']['id']])
            ->limit($page->firstRow.','.$limit)
            ->order('id desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    //申请提现--审核跳转
    public function doTiXian(){
        $user=M('user_infor')->field('yhk_sta')->where(['uid'=>$_SESSION['sc']['id']])->find();
        if($user['yhk_sta'] == 3){
            die('您还没有绑定银行卡,请在安全中心中绑定！');
        }else{
            die('ok');
        }
    }
    //申请提现--提交页面
    public function deposit(){
        $this->display();
    }
    //验证--银行是否绑定
    public function checkBank(){
        $user=M('user_infor')->field('bal,yhk_kh,yhk_name,yhk_type,yhk_sta')->where(['uid'=>$_SESSION['sc']['id']])->find();
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
                $summoney=M('wht_tilog')->field('sum(money)')->where("uid='{$_SESSION['sc']['id']}' and {$day_start}<=ctime and ctime<$day_end ")->find();
                $is=$summoney['sum(money)']+$money;
                if($summoney['sum(money)'] <= 50000 ){
                    if($is <= 50000){
                        $userbal = M('user_infor')->field('bal')->where(['uid'=>$_SESSION['sc']['id']])->find();
                        $user=M("user")->field('pay_pwd,pay_rand_str')->where(['id'=>$_SESSION['sc']['id']])->find();
                        $user_pwd=md5(md5(md5($pass)).$user['pay_rand_str']);
                        if($user_pwd == $user['pay_pwd']){
                            if($userbal['bal'] >= $money){
                                //开启事务
                                M()->startTrans();
                                //添加提现记录
                                $order_num=date("YmdHis",time()).$this->_randStr(6,1);
                                $res1=M('wht_tilog')->add(['uid'=>$_SESSION['sc']['id'],'money'=>$money,'shiji'=>$money-5,'ctime'=>time(),'status'=>2,'number'=>$order_num]);
                                //跟新余额
                                $bal=$userbal['bal']-$money;
                                $res2 =M('user_infor')->where(['uid'=>$_SESSION['sc']['id']])->setInc(['bal'=>$bal]);
                                //添加资金变动表
                                //$res3 = M('bill')->add(['uid'=>$_SESSION['sc']['id'],'number'=>$money,'money'=>$bal,'btime'=>time(),'type'=>5,'billnum'=>date("YmdHis",time()).$this->_randStr(4,1),'sta'=>2]);
                                $res3=$this->billadd($_SESSION['sc']['id'],5,$money,$bal,2,3,2);
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
    public function postPay(){
        $where['uid'] = $_SESSION['sc']['id'];
        $where['status'] = 2;
        $buy_bao = M('buy_bao');
        $baoinfo = $buy_bao->where($where)->find();
        if(($baoinfo['buy_time'] + 1800) < time()){
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
        //$money = $baoinfo['money'];
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
    public function balPay(){
        $uid = $_SESSION['sc']['id'];
        $pass=I('post.pass','');
        if(!$uid){
            die('操作错误!');
        }
        $user=M("user")->field('mobile,pay_pwd,pay_rand_str')->where(['id'=>$uid])->find();
        $user_pwd=md5(md5(md5($pass)).$user['pay_rand_str']);
        if($user_pwd != $user['pay_pwd']){
            die('交易密码错误!');
        }
        $where['uid'] = $uid;
        $where['status'] = 2;
        $buy_bao = M('buy_bao');
        $baoinfo = $buy_bao->where($where)->find();
        if(!$baoinfo){
            die('暂无可支付套餐包!');
        }
        #扣款金额
        $money = $baoinfo['money'] + ($baoinfo['money'] * 0.003);
        $user_bal=M("user_infor")->where(['uid'=>$uid])->getField('bal');
        if($money > $user_bal){
            die('余额不足,请选择其他方式支付!');
        }
        $infodata['bal'] = $user_bal - $money;
        $infores = M("user_infor")->where('uid='.$uid)->save($infodata);
        if($infores){
            $where['id'] = $baoinfo['id'];
            $data['status'] = 3;
            $res = $buy_bao->where($where)->save($data);
            if($res){
                die('ok');
            }else{
                $infodata['bal'] = $user_bal;
                $infores = M("user_infor")->where('uid='.$uid)->save($infodata);
                die('网络异常!');
            }
        }else{
            die('操作失败!');
        }
        die;
    }
    public function postYinsbPay($amount,$pay_number) {
        $SubmitUrl  = 'http://extman.baiduannet.com/pay/pay_mobile.action';
        $key        = '8e3b8fc750abefd24300abc3cd7078d5';                     #商户key
        $data['userid']     = '019699';                                       #商户IDID
        $data['orderCode']  = 'up_gateway';                                   #固定up_gatewayPay网关
        $data['notifyURL']  = 'https://www.fdcfsy.com/home/Api/yinShengPaynotify';        #异步通知地址
        $data['frontURL']   = 'https://www.fdcfsy.com/home/Pcenter/resfront'; #成功后返回地址
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
        $where['ok_type'] = 2;
        $where['status'] = 2;
        $buy_bao = M('buy_bao');
        $baoinfo = $buy_bao->where($where)->find();
        if(!$baoinfo){
             echo '<script>location.href="/home/pcenter/buy_bao_lst.html"</script>';
        }
        $SubmitUrl  = 'http://extman.baiduannet.com/pay/pay_mobile.action';
        $key             = '8e3b8fc750abefd24300abc3cd7078d5';         #商户KEY
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
            $buy_bao_data['ok_type'] = 3;
            $buy_bao_where['id'] = $baoinfo['id'];
            $buy_bao->where($buy_bao_where)->save($buy_bao_data);
            echo '<script>alert("购买成功");location.href="/home/pcenter/buy_bao_lst.html"</script>';
        }
        die;
    }
    //转账管理
    public function transfer(){
        $where['uid']=$_SESSION['sc']['id'];
        $total = M('transfer')->where(['uid'=>$_SESSION['sc']['id']])->count();
        $limit = 8;
        $page = new Pagei($total,$limit);
        $info = M('transfer')
            ->where($where)
            ->limit($page->firstRow.','.$limit)
            ->order('ztime desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    //申请转账
    public function dotran(){
        $user=M('user_infor')->field('bal')->where(['uid'=>$_SESSION['sc']['id']])->find();
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
        if($mobile == $_SESSION['sc']['usermobile']){
            $info['msg']='您不可以给自己转账！';
            $this->ajaxReturn($info);exit;
        }
        $pass=I('post.pass','');
        if($money != '' && $pass != '' && $mobile != ''){
            if($money >=100){
                if($money <= 30000){
                    $userbal = M('user_infor')->field('bal')->where(['uid'=>$_SESSION['sc']['id']])->find();
                    $user=M("user")->field('mobile,pay_pwd,pay_rand_str')->where(['id'=>$_SESSION['sc']['id']])->find();
                    $user_pwd=md5(md5(md5($pass)).$user['pay_rand_str']);
                    if($user_pwd == $user['pay_pwd']){
                        if($userbal['bal'] >= $money){
                            //开启事务
                            M()->startTrans();
                            //添加提现记录
                            $order_num=date("YmdHis",time()).$this->_randStr(6,1);
                            $res1=M('transfer')->add(['uid'=>$_SESSION['sc']['id'],'money'=>$money,'mobile'=>$mobile,'ztime'=>time(),'status'=>2,'number'=>$order_num]);
                            //跟新余额
                            $bal1=$userbal['bal']-$money;
                            $bal2=$userbal2['bal']+$money;
                            $res2 =M('user_infor')->where(['uid'=>$_SESSION['sc']['id']])->setInc(['bal'=>$bal1]);
                            $res3 =M('user_infor')->where(['uid'=>$userz['id']])->setInc(['bal'=>$bal2]);
                            //添加资金变动表
                            //$res4 = M('bill')->add(['uid'=>,'number'=>$money,'money'=>$bal1,'btime'=>time(),'type'=>7,'billnum'=>date("YmdHis",time()).$this->_randStr(4,1),'sta'=>2]);
                            //$res5 = M('bill')->add(['uid'=>,'number'=>$money,'money'=>$bal2,'btime'=>time(),'type'=>7,'billnum'=>date("YmdHis",time()).$this->_randStr(4,1),'sta'=>2]);
                            $res4=$this->billadd($_SESSION['sc']['id'],7,$money,$bal1,2,3,2);
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
    public function chepay(){
        $id = $_POST['id'];
        $tilog = M('wht_tilog');
        $tilog_find = $tilog->where('status=2 and id ='.$id)->find();
        if(empty($tilog_find)){
            die('操作异常！');
        }
        $data['status'] = 9;
        $wheres['id'] = $id;
        //开启事务
        M()->startTrans();
        //修改提现记录
        $res1=M('wht_tilog')->where($wheres)->save($data);
        //跟新余额
        $userbal = M('user_infor')->field('bal')->where(['uid'=>$tilog_find['uid']])->find();
        $bal=$userbal['bal']+$tilog_find['money'];
        $res2 =M('user_infor')->where(['uid'=>$tilog_find['uid']])->setInc(['bal'=>$bal]);
        //添加资金变动表
        $res3 = M('bill')->add(['uid'=>$tilog_find['uid'],'number'=>$tilog_find['money'],'money'=>$bal,'btime'=>time(),'type'=>6,'billnum'=>date("YmdHis",time()).$this->_randStr(4,1),'sta'=>2]);
        if($res1 && $res2 && $res3){
            M()->commit();
            die('ok');
        }else{
            M()->rollback();
            die('撤回失败！');
        }
        exit;
    }
}