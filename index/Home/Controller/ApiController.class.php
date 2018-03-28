<?php

namespace Home\Controller;

use Think\Controller;

class ApiController extends ComController {
	#方大商城转入收益为余额
    public function whtRuBal(){
        $key = '118482494389c9ce536ae699cd127999';
        $data['wht_pay']  = $wht_pay   = $_GET['wht_pay'];
        $where['shop_pay']= $data['shop_pay'] = $shop_pay  = $_GET['shop_pay'];
        $data['type']     = $type      = $_GET['type'];
        $data['money']    = $money     = $_GET['money'];
        $data['ctime']   = time();
        $sign             = $_GET['sign'];
        if(empty($wht_pay) || empty($shop_pay) || empty($type) || empty($money) || empty($sign)){
            die('1001');#参数不全
        }
        $typearr = array(2,3,4,5,6);
        if(!in_array($type, $typearr)){
            die('1002');#套包类型不正确
        }
        $isSign = md5(md5($wht_pay).md5($shop_pay).md5($type).md5($money).md5(md5($key)));
        if($sign != $isSign){
            die('1003');#签名错误
        }
        $user = M('user')->where($where)->find();
        $data['uid'] = $user['id'];
        if(empty($user)){
            die('1004');#用户不存在钱包地址有误
        }
        M()->startTrans();#开启事物
        $res = M('wht_ru_log')->add($data);
        if(!$res){
            M()->rollback();
            die('1005');#操作错误
        }
        if($type == 2){
            $sql = 'update sc_user_infor set ke_bal=ke_bal+'.$money.' where uid='.$user['id'];
        }elseif($type == 3){
            $sql = 'update sc_user_infor set xfb_bal=xfb_bal+'.$money.' where uid='.$user['id'];
        }else{
            $sql = 'update sc_user_infor set bal=bal+'.$money.' where uid='.$user['id'];
        }
        $Model = new \Think\Model();
        $res = $Model->execute($sql);
        if(!$res){
            M()->rollback();
            die('1005');#操作错误
        }
        M()->commit();
        die('1000');
    }
    #网关支付异步返回通知
    public function yinShengPaynotify(){
        $pay_number = trim($_POST['pay_number']);
        $currencyType = trim($_POST['currencyType']);
        $amount = trim($_POST['amount']);
        $resCode = trim($_POST['resCode']);
        $resInfo = trim($_POST['resInfo']);
        $orderId = trim($_POST['orderId']);
        $sign = trim($_POST['sign']);
        $key             = '8e3b8fc750abefd24300abc3cd7078d5';         #商户KEY
        $isSign = md5("pay_number=$pay_number&amount=$amount&orderId=$orderId$key"); 
        if($isSign == $sign){
            $where['number'] = $pay_number;
            $where['ok_type'] = 2;
            $buy_bao = M('buy_bao');
            $baoinfo = $buy_bao->where($where)->find();
            if(!$baoinfo){
                die;
            }
            $buy_bao_data['status'] = 3;
            $buy_bao_data['ok_type'] = 3;
            $buy_bao_where['id'] = $baoinfo['id'];
            $res = $buy_bao->where($buy_bao_where)->save($buy_bao_data);
        }else{
            die('签名错误');
        }
        exit;
    }
    #代付异步通知
    public function daifuPaynotify(){
        $resCode = trim($_POST['resCode']);
        $resInfo = trim($_POST['resInfo']);
        $amount = trim($_POST['amount']);
        $pay_number = trim($_POST['pay_number']);
        $orderId = trim($_POST['orderId']);
        $sign = trim($_POST['sign']);
        $key             = '8e3b8fc750abefd24300abc3cd7078d5';         #商户KEY
        $isSign = md5("pay_number=$pay_number&amount=$amount&orderId=$orderId$key"); 
        if($isSign == $sign){
            $where['number'] = $pay_number;
            $where['status'] = 4;
            $wht_tilog = M('wht_tilog');
            $tiinfo = $wht_tilog->where($where)->find();
            if(!$tiinfo){
                //file_put_contents(time().'log.txt', '查询失败');
                die;
            }
            if($resCode == '000000'){
                $wht_tilog_data['status'] = 7;
            }else{
                $wht_tilog_data['status'] = 8;
            }
            $wht_tilog_where['id'] = $tiinfo['id'];
            $res = $wht_tilog->where($wht_tilog_where)->save($wht_tilog_data);
            if($res){
                //file_put_contents(time().'log.txt', 'ok');
                die;
            }else{
                //file_put_contents(time().'log.txt', 'no');
                die;
            }
        }else{
            //file_put_contents(time().'log.txt', '签名失败');
        }
        exit;
    }



    /*public function testApi(){
        $url = 'http://ly.shop.com/home/api/whtrubal/';
        $key = '118482494389c9ce536ae699cd127999';
        $wht_pay = 'e2a6a1ace352668000aed191a817d143';
        $shop_pay = 'F3346D95B1AF33F4FC0315BC81904BC0';
        $money = 999;
        $type = 2;
        $sign = md5(md5($wht_pay).md5($shop_pay).md5($type).md5($money).md5(md5($key)));
        $url .= 'wht_pay/'.$wht_pay.'/shop_pay/'.$shop_pay.'/type/'.$type.'/money/'.$money.'/sign/'.$sign.'.html';
        echo $url;
        die;
    }
*/    /*public function delyhk(){
        $Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
        $lst = $Model->query("select yhk_kh,count(*) as num  from sc_user_infor GROUP BY yhk_kh ORDER BY num desc,yhk_kh desc");
        $uid = ' ';
        foreach ($lst as $key => $value) {
            $yhk = $value['yhk_kh'];
            if($yhk){
                if($value['num']>1){
                    $lsta = $Model->query("select uid,yhk_kh from sc_user_infor where yhk_kh='$yhk'");
                    foreach ($lsta as $k => $v) {
                        if($k>0){
                            $uid .= ','.$v['uid'];
                        }
                    }
                }
            }
            if($key == 1000){
                 break;
            }
        }
        echo $uid;
        die;
    }*/
}