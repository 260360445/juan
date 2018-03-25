<?php
namespace Home\Controller;
use Think\Controller;
use Think\Pagei;
class MerchantController extends ComSjController {
    //商家主页
    public function merchant(){
        $merchant = M('merchant_infor')->field('ke_bal,xfb_bal')->where(['sid'=>$_SESSION['sj']['id']])->find();
        $goods = M('goods')->field('id')->where(['sid'=>$_SESSION['sj']['id']])->count();
        $wanjie = M('order')->field('order_id')->where(['sid'=>$_SESSION['sj']['id'],'state'=>4])->count();
        $fahuo = M('order')->field('order_id')->where(['sid'=>$_SESSION['sj']['id'],'state'=>3])->count();
        $this->assign("merchant",$merchant);
        $this->assign("goods",$goods);
        $this->assign("fahuo",$fahuo);
        $this->assign("wanjie",$wanjie);
        $this->display();
    }
    //基本设置
    public function infor(){
        $res=M("store")->where(['sj_id'=>$_SESSION['sj']['id']])->find();
        $this->assign("res",$res);
        //省
        $province=M("province");
        $province_arr=$province->where("pid=0")->select();
        $this->assign("province_arr",$province_arr);
        $this->display();
    }
    //安全中心
    public function save(){
        $info = M('user')
            ->field('u.pay_pwd,i.usta,u.shop_pay,u.wht_pay')
            ->alias('u')
            ->join('left join __USER_INFOR__ i on u.id = i.uid')
            ->where(['u.id'=>$_SESSION['sc']['id']])
            ->find();
        $this->assign('info',$info);
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
    //身份认证
    public function idCardAuth(){
        $merchant_infor=M("merchant_infor");
        $data['uname']=I("post.realname","");
        $data['ucode']=I("post.idcard","");
        $data['stype']=2;
        if(false !== $merchant_infor->where(['sid'=>$_SESSION['sj']['id']])->save($data)){
            $info='2';
            $this->ajaxReturn($info) ;exit;
        }else{
            $info='3';
            $this->ajaxReturn($info) ;exit;
        }
    }
    //验证登录原密码
    public function checkOldPass(){
        $oldPass=I("post.pass","");
        $user=M("merchant")->field('pwd,rand_str')->where(['sid'=>$_SESSION['sj']['id']])->find();
        $user_pwd=md5(md5(md5($oldPass)).$user['rand_str']);
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
        $user=M("merchant")->field('pwd,rand_str')->where(['sid'=>$_SESSION['sj']['id']])->find();
        $user_pwd=md5(md5(md5($oldPass)).$user['rand_str']);
        if($user_pwd == $user['pwd']){
            if($pass == $repass){
                $str=$this->_randStr(4);
                $user_pass=md5(md5($pass));
                $data['pwd']=md5($user_pass.$str);
                $data['rand_str']=$str;                 
                if( false!==M("merchant")->where(['sid'=>$_SESSION['sj']['id']])->save($data)){
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
    public function setInfo(){
        $data['store_name']=I("post.name","");
        $data['store_intro']=I("post.intro","");
        $data['store_cont']=stripslashes(htmlspecialchars_decode($_POST['cont']));
        $data['pro_id']=I("post.pro","");
        $data['city_id']=I("post.citys","");
        $data['area_id']=I("post.areas","");
        $data['sj_id']=$_SESSION['sj']['id'];
        $res1=M("store")->where(['sj_id'=>$_SESSION['sj']['id']])->save($data);
        if($res1){
            echo 'ok';exit;
        }else{
            echo '设置失败';exit;
        }
    }
    //商家发布商品
    public function sell(){
        if(IS_POST){
            $merchant=M('store')->field('store_name')->where(['sj_id'=>$_SESSION['sj']['id']])->find();
            if($merchant['store_name']){
                if(empty($_FILES['logo']['name'])){
                    echo '请上传商品Logo图片！';
                    exit;
                }
                if(empty($_FILES['showlogo1']['name']) && empty($_FILES['showlogo2']['name']) && empty($_FILES['showlogo3']['name']) && empty($_FILES['showlogo4']['name']) && empty($_FILES['showlogo5']['name'])){
                    echo '最少上传一张商品页详情展示图！';
                    exit;
                }
                if(!empty($_FILES['logo']['name']) || !empty($_FILES['showlogo1']['name']) || !empty($_FILES['showlogo2']['name']) || !empty($_FILES['showlogo3']['name']) || !empty($_FILES['showlogo4']['name']) || !empty($_FILES['showlogo5']['name'])){
                    foreach ($_FILES as $key => $item) {
                        $dir=date("Ymd",time());
                        if($key == 'logo'){
                            $saveName=date("Ymd",time()).$this->_randStr(4,1);
                            $saveExtStr=explode('/',$_FILES['logo']['type']);
                            $saveExt=$saveExtStr[1];
                            $logo=$this->_createThumImg('logo', 'Goods/'.$dir, $saveName, $saveExt);
                            if($logo['tag'] == '1'){
                                echo '图片大小不得超过3MB';exit;
                            }else if($logo['tag'] == '2'){
                                echo '文件格式不正确';exit;
                            }else if($logo['tag'] == '3'){
                                echo '系统繁忙,请稍后再试';exit;
                            }else if($logo['tag'] == '4'){
                                $data['goods_logo']=$logo['con'];
                            }    
                        }else{
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
                }
                $data['goods_title']=$_POST['title'];
                $data['goods_cate_pid']=$_POST['p_id'];
                $data['goods_cate_id']=$_POST['son_id'];
                $data['price']=$_POST['pic'];
                $data['xfb']=$_POST['xfb'];
                $data['sid']=$_SESSION['sj']['id'];
                $data['money']=$_POST['my'];
                $data['goods_small_title']=$_POST['small'];
                $data['kucun']=$_POST['num'];
                $data['cont'] = stripslashes(htmlspecialchars_decode($_POST['cont']));
                $data['goods_time']=time();
                $data['number']=date("YmdHis",time()).$this->_randStr(6,1);
                //开启事务
                M()->startTrans();
                $res1=M("goods")->add($data);
                //添加
                foreach ($files as $key => $value) {
                    $data['showlogo']=$value;
                    $res2 = M('goods_imgs')->add(['showlogo'=>$value,'gid'=>$res1]);
                }
                //$res2 = M('goods_img')->add(['goods_id'=>$res1,'showlogo1'=>$data['showlogo1'],'showlogo2'=>$data['showlogo2'],'showlogo3'=>$data['showlogo3'],'showlogo4'=>$data['showlogo4'],'showlogo5'=>$data['showlogo5']]);
                //$res3 =M("goods")->where("id=".$res1)->save(['img_id'=>$res2]);
                if ($res1 && $res2 ){
                    M()->commit();
                    echo 'ok';
                    exit;
                }else{
                    $save_path='./Uploads';
                    if(!empty($data['goods_logo'])){
                        @unlink($save_path.$data['goods_logo']);//删除原来的图片
                    }
                    if(!empty($files)){
                        foreach ($files as $key => $value) {
                            @unlink($save_path.$value);//删除原来的图片
                        }
                    }
                    M()->rollback();
                    echo '发布失败';
                    exit;
                }       
            }else{
                echo '请先完善店铺基本信息！';
                exit;
            }
        }else{
            //查询分类
            $data=M("goods_class")->field("goods_class_id,name")->where(['pid'=>0,'state'=>2])->order('sort asc,goods_class_id asc')->select();
            //$tree = $this->getTree($data, 0);
            $this->assign('goodclass',$data);
            $this->display();
        }
    }
    //修改商品
    public function sellupd(){
        if(IS_POST){
            $merchant=M('store')->field('store_name')->where(['sj_id'=>$_SESSION['sj']['id']])->find();
            $gid=I('post.setid','');
            $glogo=M('goods')->field('goods_logo')->where(['id'=>$gid])->find();
            if($merchant['store_name']){
                if(!empty($_FILES['logo']['name']) || !empty($_FILES['showlogo1']['name']) || !empty($_FILES['showlogo2']['name']) || !empty($_FILES['showlogo3']['name']) || !empty($_FILES['showlogo4']['name']) || !empty($_FILES['showlogo5']['name'])){
                    foreach ($_FILES as $key => $item) {
                        $dir=date("Ymd",time());
                        if($key == 'logo'){
                            $saveName=date("Ymd",time()).$this->_randStr(4,1);
                            $saveExtStr=explode('/',$_FILES['logo']['type']);
                            $saveExt=$saveExtStr[1];
                            $logo=$this->_createThumImg('logo', 'Goods/'.$dir, $saveName, $saveExt);
                            if($logo['tag'] == '1'){
                                echo '图片大小不得超过3MB';exit;
                            }else if($logo['tag'] == '2'){
                                echo '文件格式不正确';exit;
                            }else if($logo['tag'] == '3'){
                                echo '系统繁忙,请稍后再试';exit;
                            }else if($logo['tag'] == '4'){
                                $save_path='./Uploads';
                                @unlink($save_path.$glogo['goods_logo']);//删除原来的图片
                                $data['goods_logo']=$logo['con'];
                            }    
                        }else{
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
                                    M('goods_imgs')->where(['gid'=>$gid])->delete();
                                    $files[$key]=$uploadinfo['con'];
                                }
                            }
                        }
                    }
                }
                $data['goods_title']=$_POST['title'];
                $data['goods_cate_pid']=$_POST['p_id'];
                $data['goods_cate_id']=$_POST['son_id'];
                $data['price']=$_POST['pic'];
                $data['xfb']=$_POST['xfb'];
                $data['money']=$_POST['my'];
                $data['goods_small_title']=$_POST['small'];
                $data['kucun']=$_POST['num'];
                $data['cont'] = stripslashes(htmlspecialchars_decode($_POST['cont']));
                $data['goods_time']=time();
                $data['number']=date("YmdHis",time()).$this->_randStr(6,1);
                //开启事务
                M()->startTrans();
                $res1=M("goods")->where(['id'=>$gid])->save($data);
                //添加
                if(!empty($files)){
                    foreach ($files as $key => $value) {
                        $data['showlogo']=$value;
                        $res2 = M('goods_imgs')->add(['showlogo'=>$value,'gid'=>$gid]);
                    }
                }
                
                //$res2 = M('goods_img')->add(['goods_id'=>$res1,'showlogo1'=>$data['showlogo1'],'showlogo2'=>$data['showlogo2'],'showlogo3'=>$data['showlogo3'],'showlogo4'=>$data['showlogo4'],'showlogo5'=>$data['showlogo5']]);
                //$res3 =M("goods")->where("id=".$res1)->save(['img_id'=>$res2]);
                if ($res1 ){
                    M()->commit();
                    echo 'ok';
                    exit;
                }else{
                    $save_path='./Uploads';
                    if(!empty($data['goods_logo'])){
                        @unlink($save_path.$data['goods_logo']);//删除原来的图片
                    }
                    if(!empty($files)){
                        foreach ($files as $key => $value) {
                            @unlink($save_path.$value);//删除原来的图片
                        }
                    }
                    M()->rollback();
                    echo '修改失败';
                    exit;
                }       
            }else{
                echo '请先完善店铺基本信息！';
                exit;
            }
        }else{
            $id=I('get.item','');
            $goods=M('goods')->field('id,goods_title,goods_logo,goods_cate_id,goods_cate_pid,price,money,goods_small_title,kucun,cont,xfb')->where(['id'=>$id])->find();
            $this->assign('goods',$goods);
           //查询分类
            $data=M("goods_class")->field("goods_class_id,name")->where(['pid'=>0,'state'=>2])->order('sort asc,goods_class_id asc')->select();
            $datas=M("goods_class")->field("goods_class_id,name")->where(['goods_class_id'=>$goods['goods_cate_id'],'state'=>2])->find();
            //$tree = $this->getTree($data, 0);
            $this->assign('goodclass',$data);
            $this->assign('datas',$datas);
            $this->display(); 
        }
    }
    //二级分类
    public function sonClass(){
        $pid=I("post.pid","");
        $data=M("goods_class")->field("goods_class_id,name")->where(['pid'=>$pid,'state'=>2])->order('sort asc,goods_class_id asc')->select();
        $this->ajaxReturn($data);
        exit;
    }
    //出售中的商品
    public function auction_list(){
        $total = M('goods')->where(['sid'=>$_SESSION['sj']['id']])->count();
        $limit = 8;
        $page = new Pagei($total,$limit);
        $info = M('goods')
            ->field('g.id,g.goods_title,g.goods_logo,g.goods_cate_id,g.sid,g.price,g.money,g.xfb,g.kucun,g.number,g.sell,g.goods_time,i.goods_class_id,i.name')
            ->alias('g')
            ->join('left join __GOODS_CLASS__ i on g.goods_cate_id = i.goods_class_id')
            ->where(['g.sid'=>$_SESSION['sj']['id']])
            ->limit($page->firstRow.','.$limit)
            ->order('g.sell desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    //商品下架
    public function auction_list_in(){
        $total = M('goods')->where(['sid'=>$_SESSION['sj']['id']])->count();
        $limit = 8;
        $page = new Pagei($total,$limit);
        $info = M('goods')
            ->field('g.id,g.goods_title,g.goods_logo,g.goods_cate_id,g.sid,g.price,g.money,g.xfb,g.kucun,g.number,g.sell,g.goods_time,i.goods_class_id,i.name')
            ->alias('g')
            ->join('left join __GOODS_CLASS__ i on g.goods_cate_id = i.goods_class_id')
            ->where(['g.sid'=>$_SESSION['sj']['id'],'sta'=>3])
            ->limit($page->firstRow.','.$limit)
            ->order('g.sell desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    //已下架商品
    public function auction_list_out(){
        $total = M('goods')->where(['sid'=>$_SESSION['sj']['id']])->count();
        $limit = 8;
        $page = new Pagei($total,$limit);
        $info = M('goods')
            ->field('g.id,g.goods_title,g.goods_logo,g.goods_cate_id,g.sid,g.price,g.money,g.xfb,g.kucun,g.number,g.sell,g.goods_time,i.goods_class_id,i.name')
            ->alias('g')
            ->join('left join __GOODS_CLASS__ i on g.goods_cate_id = i.goods_class_id')
            ->where(['g.sid'=>$_SESSION['sj']['id'],'sta'=>2])
            ->limit($page->firstRow.','.$limit)
            ->order('g.sell desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    //商品下架
    public function setout(){
        $id=isset($_POST['id'])?$_POST['id']:'';
        if ($id!="") {
            $where['state']=['in','2,3,5'];
            $result = M('order')->field('order_id')->where(['gid'=>$id,$where])->select();
            if ($result) {
                $info['msg']='该商品有订单未处理完成，不允许删除！';
                $this->ajaxReturn($info);
                exit;
            }else{
                if (false !== M('goods')->where(['id'=>$id])->save(['sta'=>2])) {
                    $info['msg']='ok';
                    $this->ajaxReturn($info);
                    exit;
                }else{
                    $info['msg']='下架失败，稍后再试！';
                    $this->ajaxReturn($info);
                    exit;
                }
            }
        }
    }
    //商品从新上架
    public function setin(){
        $id=isset($_POST['id'])?$_POST['id']:'';
        if ($id!="") {
            if (false !== M('goods')->where(['id'=>$id])->save(['sta'=>3])) {
                $info['msg']='ok';
                $this->ajaxReturn($info);
                exit;
            }else{
                $info['msg']='上架失败，稍后再试！';
                $this->ajaxReturn($info);
                exit;
            }
        }
    }
    //订单管理
    public function order_list(){
        $where['sid']=$_SESSION['sj']['id'];
        $total = M('order')->where($where)->count();
        $limit = 8;
        $page = new Pagei($total,$limit);
        $info = M('order')
            ->field('o.order_id,o.order_num,o.uid,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.price,o.xfb,g.id,g.goods_title,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['o.sid'=>$_SESSION['sj']['id']])
            ->limit($page->firstRow.','.$limit)
            ->order('o.order_id desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    //订单管理--订单详情--未发货
    public function detailorder(){
        $id=I('get.order','');
        $info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.settime,o.price,o.xfb,g.id,g.goods_title,g.goods_cate_id,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['o.order_id'=>$id])
            ->find();
        $address=M('express')->field('express_time,express_user')->where(['order_id'=>$info['order_id']])->find();
        $this->assign("address",$address);
        $this->assign("info",$info);
        $this->display();
    }
    //订单管理--订单详情--已发货
    public function detail(){
        $id=I('get.order','');
        $info = M('order')
            ->field('o.order_id,o.order_num,o.gid,o.buytime,o.uid,o.state,o.buynum,o.sid,o.sumpay,o.settime,o.price,o.xfb,g.id,g.goods_title,g.goods_cate_id,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['o.order_id'=>$id])
            ->find();
        $address=M('express')->field('express_name,express_num,express_time,express_user')->where(['order_id'=>$info['order_id']])->find();
        $this->assign("address",$address);
        $this->assign("info",$info);
        $this->display();
    }
    //未发货
    public function sendout(){
        $total = M('order')->where(['sid'=>$_SESSION['sj']['id'],'state'=>3])->count();
        $limit = 8;
        $page = new Pagei($total,$limit);
        $info = M('order')
            ->field('o.order_id,o.order_num,o.uid,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.price,o.xfb,g.id,g.goods_title,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['o.sid'=>$_SESSION['sj']['id'],'o.state'=>3])
            ->limit($page->firstRow.','.$limit)
            ->order('o.order_id desc')
            ->select();
        $html = $page->show();
        $yifahuo = M('order')->where(['sid'=>$_SESSION['sj']['id'],'state'=>2])->count();
        $wanjie = M('order')->where(['sid'=>$_SESSION['sj']['id'],'state'=>4])->count();
        $this->assign('page',$html);
        $this->assign('total',$total);
        $this->assign('yifahuo',$yifahuo);
        $this->assign('wanjie',$wanjie);
        $this->assign('info',$info);
        $this->display();
    }
    //已发货
    public function sendoutf(){
        $total = M('order')->where(['sid'=>$_SESSION['sj']['id'],'state'=>2])->count();
        $limit = 8;
        $page = new Pagei($total,$limit);
        $info = M('order')
            ->field('o.order_id,o.order_num,o.uid,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.price,o.xfb,g.id,g.goods_title,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['o.sid'=>$_SESSION['sj']['id'],'state'=>2])
            ->limit($page->firstRow.','.$limit)
            ->order('o.order_id desc')
            ->select();
        $html = $page->show();
        $weifa = M('order')->where(['sid'=>$_SESSION['sj']['id'],'state'=>3])->count();
        $wanjie = M('order')->where(['sid'=>$_SESSION['sj']['id'],'state'=>4])->count();
        $this->assign('page',$html);
        $this->assign('total',$total);
        $this->assign('weifa',$weifa);
        $this->assign('wanjie',$wanjie);
        $this->assign('info',$info);
        $this->display();
    }
    //已完结
    public function sendOutw(){
        $total = M('order')->where(['sid'=>$_SESSION['sj']['id'],'state'=>4])->count();
        $limit = 8;
        $page = new Pagei($total,$limit);
        $info = M('order')
            ->field('o.order_id,o.order_num,o.uid,o.gid,o.buytime,o.state,o.buynum,o.sid,o.sumpay,o.price,o.xfb,g.id,g.goods_title,g.goods_logo')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['o.sid'=>$_SESSION['sj']['id'],'state'=>4])
            ->limit($page->firstRow.','.$limit)
            ->order('o.order_id desc')
            ->select();
        $html = $page->show();
        $weifa = M('order')->where(['sid'=>$_SESSION['sj']['id'],'state'=>3])->count();
        $yifahuo = M('order')->where(['sid'=>$_SESSION['sj']['id'],'state'=>2])->count();
        $this->assign('page',$html);
        $this->assign('weifa',$weifa);
        $this->assign('yifahuo',$yifahuo);
        $this->assign('total',$total);
        $this->assign('info',$info);
        $this->display();
    }
    //发货填写物流
    public function send_list_new(){
        $oid=I('get.order','');
        $info=M('order')
            ->field('o.order_id,o.address_id,g.goods_title')
            ->alias('o')
            ->join('left join __GOODS__ g on o.gid = g.id')
            ->where(['o.order_id'=>$oid])
            ->find();
        $address=M('address')->field('name,street,mobile,uid,pro_id,city_id,area_id')->where(['id'=>$info['address_id']])->find();
        $province_arr=M("province")->where("pid=0")->select();
        $ads_arr=M("province")->select();
        $this->assign("ads_arr",$ads_arr);
        $this->assign("province_arr",$province_arr);
        $this->assign("order",$order);
        $this->assign("info",$info);
        $this->assign("address",$address);
        $this->display();
    }
    //发货预约快递
    public function express(){
        $this->display();
    }
    //确认发货
    public function doexp(){
        $oid=I('post.ordid','');
        $num=I('post.num','');
        $name=I('post.name','');
        $sjads=I('post.sjads','');
        $userads=I('post.userads','');
        if($oid != '' && $num != "" && $name != "" && $sjads != "" && $userads != ""){
            //开启事务
            M()->startTrans();
            $res1 = M('express')->add(['order_id'=>$oid,'express_name'=>$name,'express_num'=>$num,'express_time'=>time(),'express_sj'=>$sjads,'express_user'=>$userads]);
            $res2 = M('order')->where(['order_id'=>$oid])->setInc(['state'=>2,'ftime'=>time()]);
            if ($res1 && $res2){
                M()->commit();
                $this->ajaxReturn('ok');
                exit;
            }else{
                M()->rollback();
                $this->ajaxReturn('发货失败！');
                exit;
            } 
        }else{
            $this->ajaxReturn('提交信息错误！');
            exit;
        }
    }
}
			
			