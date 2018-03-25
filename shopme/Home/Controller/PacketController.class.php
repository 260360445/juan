<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;
class PacketController extends ComController {
    //初审
    public function chu(){
        $filter = I('get.filter','');
        $this->assign('filter',$filter);
        $cond = ['u.status'=>2];
        if ($filter != '')
        {
            $cond[] = 'u.number=\''.$filter.'\' or m.mobile=\''.$filter.'\' or i.yhk_kh=\''.$filter.'\' or i.yhk_name=\''.$filter.'\'';
        }
        $total = M('wht_tilog')->alias('u')->join('left join __USER__ m on u.uid = m.id')->join('left join __USER_INFOR__ i on u.uid = i.uid')->where($cond)->count();
        $limit = 100;
        $page = new Page($total,$limit);
        $info = M('wht_tilog')
            ->field('u.id,u.money,u.ctime,u.status,u.shiji,u.number,m.mobile,i.yhk_name,i.yhk_type,i.yhk_kh')
            ->alias('u')
            ->join('left join __USER__ m on u.uid = m.id')
            ->join('left join __USER_INFOR__ i on u.uid = i.uid')
            ->where($cond)
            ->limit($page->firstRow.','.$limit)
            ->order('u.ctime asc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    //通过初审
    public function chushen(){
        $strid=I('post.ids','');
        $idarr = explode('-',$_POST['ids']);
        $coun = count($idarr);
        $num = 0;
        for ($i=0; $i < $coun; $i++) {
            if($idarr[$i]){
               $tilog = M('wht_tilog');
               $tilog_find = $tilog->where('id ='.$idarr[$i])->find();
               if($tilog_find['status'] != 2){
                    $info['msg']='操作失败！';
                    $this->ajaxReturn($info);
                    exit;
               }
                $data['status'] = 3;
                $wheres['id'] = $idarr[$i];
                $result = $tilog->where($wheres)->save($data);
                if($result){
                    $num++;
                }
            }
        }
        $info['msg']='ok';
        $info['flg']=$num;
        $this->ajaxReturn($info);
        exit;
   }
   //返回代付操作
    public function tidai(){
        $strid=I('post.ids','');
        $idarr = explode('-',$_POST['ids']);
        $coun = count($idarr);
        $num = 0;
        for ($i=0; $i < $coun; $i++) {
            if($idarr[$i]){
               $tilog = M('wht_tilog');
               $tilog_find = $tilog->where('id ='.$idarr[$i])->find();
               if($tilog_find['status'] != 3){
                    $info['msg']='操作失败！';
                    $this->ajaxReturn($info);
                    exit;
               }
                $data['type'] = 2;
                $wheres['id'] = $idarr[$i];
                $result = $tilog->where($wheres)->save($data);
                if($result){
                    $num++;
                }
            }
        }
        $info['msg']='ok';
        $info['flg']=$num;
        $this->ajaxReturn($info);
        exit;
   }
   public function bohui(){
        $idarr = explode('-',$_POST['ids']);
        $coun = count($idarr);
        $num = 0;
        for ($i=0; $i < $coun; $i++) {
            if($idarr[$i]){
                $tilog = M('wht_tilog');
                $tilog_find = $tilog->where('id ='.$idarr[$i])->find();
                $data['status'] = 5;
                $wheres['id'] = $idarr[$i];
                //开启事务
                M()->startTrans();
                //添加提现记录
                $res1=M('wht_tilog')->where($wheres)->save($data);

                //跟新余额
                $userbal = M('user_infor')->field('bal')->where(['uid'=>$tilog_find['uid']])->find();
                $bal=$userbal['bal']+$tilog_find['money'];
                $res2 =M('user_infor')->where(['uid'=>$tilog_find['uid']])->setInc(['bal'=>$bal]);
                //添加资金变动表
                $res3 = M('bill')->add(['uid'=>$tilog_find['uid'],'number'=>$tilog_find['money'],'money'=>$bal,'btime'=>time(),'type'=>6,'billnum'=>date("YmdHis",time()).$this->_randStr(4,1),'sta'=>2]);
                if($res1 && $res2 && $res3){
                    M()->commit();
                    $num++;
                    $info['msg']='ok';
                    $info['flg']=$num;
                }else{
                    M()->rollback();
                    $info['msg']='驳回失败！';
                    $this->ajaxReturn($info);exit;
                }
            }
        }
        $this->ajaxReturn($info);exit;
    }
    public function quxiao()
    {
       $idarr = explode('-',$_POST['ids']);
       $coun = count($idarr);
       $num = 0;
       for ($i=0; $i < $coun; $i++) {
            if($idarr[$i]){
                $data['status'] = 6;
                $wheres['id'] = $idarr[$i];
                $tilog = M('wht_tilog');
                $res = $tilog->where($wheres)->save($data);
                if($res){
                    $num++;
                }
            }
       }
       $this->ajaxReturn($num);exit;
    }
    //审核
    public function shen(){
        $filter = I('get.filter','');
        $this->assign('filter',$filter);
        $cond = ['u.status'=>3];
        if ($filter != '')
        {
            $cond[] = 'u.number=\''.$filter.'\' or m.mobile=\''.$filter.'\' or i.yhk_kh=\''.$filter.'\' or i.yhk_name=\''.$filter.'\'';
        }
        $total = M('wht_tilog')->alias('u')->join('left join __USER__ m on u.uid = m.id')->join('left join __USER_INFOR__ i on u.uid = i.uid')->where($cond)->count();
        $limit = 100;
        $page = new Page($total,$limit);
        $info = M('wht_tilog')
            ->field('u.id,u.money,u.ctime,u.status,u.number,u.shiji,m.mobile,i.yhk_name,i.yhk_type,i.yhk_kh')
            ->alias('u')
            ->join('left join __USER__ m on u.uid = m.id')
            ->join('left join __USER_INFOR__ i on u.uid = i.uid')
            ->where($cond)
            ->limit($page->firstRow.','.$limit)
            ->order('u.ctime asc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
	public function ticheck(){
        $filter = I('get.filter','');
        $this->assign('filter',$filter);
        $cond = ['u.status'=>3,'u.type'=>2];
        if ($filter != '')
        {
            $cond[] = 'u.number=\''.$filter.'\' or m.mobile=\''.$filter.'\' or i.yhk_kh=\''.$filter.'\' or i.yhk_name=\''.$filter.'\'';
        }
        $total = M('wht_tilog')->alias('u')->join('left join __USER__ m on u.uid = m.id')->join('left join __USER_INFOR__ i on u.uid = i.uid')->where($cond)->count();
        $limit = 100;
        $page = new Page($total,$limit);
        $info = M('wht_tilog')
            ->field('u.id,u.money,u.ctime,u.status,u.number,u.shiji,m.mobile,i.yhk_name,i.yhk_type,i.yhk_kh')
            ->alias('u')
            ->join('left join __USER__ m on u.uid = m.id')
            ->join('left join __USER_INFOR__ i on u.uid = i.uid')
            ->where($cond)
            ->limit($page->firstRow.','.$limit)
            ->order('u.ctime asc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    public function shoucheck(){
        $filter = I('get.filter','');
        $this->assign('filter',$filter);
        $cond = ['u.status'=>3,'u.type'=>4];
        if ($filter != '')
        {
            $cond[] = 'u.number=\''.$filter.'\' or m.mobile=\''.$filter.'\' or i.yhk_kh=\''.$filter.'\' or i.yhk_name=\''.$filter.'\'';
        }
        $total = M('wht_tilog')->alias('u')->join('left join __USER__ m on u.uid = m.id')->join('left join __USER_INFOR__ i on u.uid = i.uid')->where($cond)->count();
        $limit = 100;
        $page = new Page($total,$limit);
        $info = M('wht_tilog')
            ->field('u.id,u.money,u.ctime,u.status,u.number,u.shiji,m.mobile,i.yhk_name,i.yhk_type,i.yhk_kh')
            ->alias('u')
            ->join('left join __USER__ m on u.uid = m.id')
            ->join('left join __USER_INFOR__ i on u.uid = i.uid')
            ->where($cond)
            ->limit($page->firstRow.','.$limit)
            ->order('u.ctime asc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    public function tishen(){
       $idarr = explode('-',$_POST['ids']);
       $coun = count($idarr);
       $num = 0;
       for ($i=0; $i < $coun; $i++) {
            if($idarr[$i]){
               $tilog = M('wht_tilog');
               $tilog_find = $tilog->where('id ='.$idarr[$i])->find();
               if($tilog_find['status'] == 3){
                    $data['status'] = 7;
                    $wheres['id'] = $idarr[$i];
                    $result = $tilog->where($wheres)->save($data);
                    if($result){
                        $num++;
                    }
               }
            }
       }
       $this->ajaxReturn($num);exit;
   }
   public function tipostcheck(){
       $idarr = explode('-',$_POST['ids']);
       $coun = count($idarr);
       $num = 0;
       for ($i=0; $i < $coun; $i++) {
            if($idarr[$i]){
               $tilog = M('wht_tilog');
               $tilog_find = $tilog->where('id ='.$idarr[$i])->find();
               $uinfo = M('user_infor')->where('uid='.$tilog_find['uid'])->field('yhk_kh,yhk_name')->find();
               if($tilog_find['status'] == 3 && $uinfo){
                    $res = self::tipostcheckapiysb($uinfo['yhk_name'],$uinfo['yhk_kh'],$tilog_find['number'],$tilog_find['shiji']);
                    $resarr = (array)json_decode($res);
                    if($resarr['resCode'] == '000000'){
                        $data['status'] = 4;
                        $data['type'] = 3;
                        $wheres['id'] = $idarr[$i];
                        $result = $tilog->where($wheres)->save($data);
                        if($result){
                            $num++;
                        }
                    }
               }
            }
       }
       $this->ajaxReturn($num);exit;
   }
   function tipostcheckapiysb($name,$cardNo,$number,$amount) {
        $url  = 'http://extman.baiduannet.com/pay/pay_mobile.action';
        $key        = '8e3b8fc750abefd24300abc3cd7078d5';           #商户key
        $data['userid']     = '019699';                             #用户ID
        $data['type']       = 'gateway';                            #固定gateway网关
        $data['orderCode']  = 'up_Withdraw';                        #固定：up_Withdraw
        $data['name']       = $name;                               #用户姓名
        $data['cardNo']     = $cardNo;                #银行卡号
        $data['pay_number'] = $number;               #订单号
        $data['purpose']    = '用户提现';                           #付款目的
        $data['amount']     = $amount;                                #代付金额单位分
        $data['notifyurl']  = 'https://www.fdcfsy.com/home/Api/daifuPaynotify';        #响应地址
        $data['route']      = 'baiduan';                            #固定：baiduan
        $signstr            = 'amount='.$data['amount'];
        $signstr           .= '&cardNo='.$data['cardNo'];
        $signstr           .= '&name='.$data['name'];
        $signstr           .= '&route='.$data['route'];
        $signstr           .= '&type='.$data['type'];
        $signstr           .= '&userid='.$data['userid'];
        $signstr           .= '&key='.$key;
        $data['sign']      = md5($signstr);
        /*提交代付信息至接口*/
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
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
    //通过初审
    public function shoupostcheck(){
        $strid=I('post.ids','');
        $idarr = explode('-',$_POST['ids']);
        $coun = count($idarr);
        $num = 0;
        for ($i=0; $i < $coun; $i++) {
            if($idarr[$i]){
               $tilog = M('wht_tilog');
               $tilog_find = $tilog->where('id ='.$idarr[$i])->find();
               if($tilog_find['status'] != 3){
                    $info['msg']='操作失败！';
                    $this->ajaxReturn($info);
                    exit;
               }
                $data['type'] = 4;
                $wheres['id'] = $idarr[$i];
                $result = $tilog->where($wheres)->save($data);
                if($result){
                    $num++;
                }
            }
        }
        $info['msg']='ok';
        $info['flg']=$num;
        $this->ajaxReturn($info);
        exit;
   }
    //记录
    public function log(){
        $filter = I('get.filter','');
        $this->assign('filter',$filter);
        $cond = [];
        $sta['u.status'] = array('gt',3);
        if ($filter != '')
        {
            $cond[] = 'u.number=\''.$filter.'\' or m.mobile=\''.$filter.'\' or i.yhk_kh=\''.$filter.'\' or i.yhk_name=\''.$filter.'\'';
        }
        $total = M('wht_tilog')->alias('u')->join('left join __USER__ m on u.uid = m.id')->join('left join __USER_INFOR__ i on u.uid = i.uid')->where($sta)->where($cond)->count();
        $limit = 100;
        $page = new Page($total,$limit);
        $info = M('wht_tilog')
            ->field('u.id,u.money,u.ctime,u.status,u.number,u.shiji,m.mobile,i.yhk_name,i.yhk_type,i.yhk_kh')
            ->alias('u')
            ->join('left join __USER__ m on u.uid = m.id')
            ->join('left join __USER_INFOR__ i on u.uid = i.uid')
            ->where($sta)
            ->where($cond)
            ->limit($page->firstRow.','.$limit)
            ->order('u.ctime desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
	//审核
    public function dailog(){
        $filter = I('get.filter','');
        $this->assign('filter',$filter);
        $cond = ['u.type'=>3];
        if ($filter != '')
        {
            $cond[] = 'u.number=\''.$filter.'\' or m.mobile=\''.$filter.'\' or i.yhk_kh=\''.$filter.'\' or i.yhk_name=\''.$filter.'\'';
        }
        $total = M('wht_tilog')->alias('u')->join('left join __USER__ m on u.uid = m.id')->join('left join __USER_INFOR__ i on u.uid = i.uid')->where($cond)->count();
        $limit = 100;
        $page = new Page($total,$limit);
        $info = M('wht_tilog')
            ->field('u.id,u.money,u.ctime,u.status,u.number,u.shiji,m.mobile,i.yhk_name,i.yhk_type,i.yhk_kh')
            ->alias('u')
            ->join('left join __USER__ m on u.uid = m.id')
            ->join('left join __USER_INFOR__ i on u.uid = i.uid')
            ->where($cond)
            ->limit($page->firstRow.','.$limit)
            ->order('u.status asc,u.ctime asc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    public function dexcel(){
        header("Content-type:application/vnd.ms-excel");
        $doctitle = time();   //文件名
        header("Content-Disposition:attachment; filename=$doctitle.xls");
        $cond = ['u.status'=>3,'u.type'=>4];
        $info = M('wht_tilog')
            ->field('u.id,u.money,u.ctime,u.status,u.number,u.shiji,m.mobile,i.yhk_name,i.yhk_type,i.yhk_kh')
            ->alias('u')
            ->join('left join __USER__ m on u.uid = m.id')
            ->join('left join __USER_INFOR__ i on u.uid = i.uid')
            ->where($cond)
            ->order('u.ctime asc')
            ->select();
        echo iconv("UTF-8", "GBK", "订单\t流水号\t收款人账户名\t收款人账户号\t收款人账户联行号\t收款人账户开户行名称\t金额（元）\t付款摘要\n");
        foreach ($info as $key => $value) {
            echo iconv("UTF-8", "GBK", $value['number']."\t".$value['number']."\t".$value['yhk_name']."\t".$value['yhk_kh']."\t无\t".$value['yhk_type']."\t".$value['shiji']."\t代付采暖\n");
        }
    }
}
