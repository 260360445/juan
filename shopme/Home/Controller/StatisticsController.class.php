<?php

namespace Home\Controller;
use Think\Controller;
use Think\Page;




class StatisticsController extends ComController

{

    #兑出统计
    public function tilog()

    {
        $date_key = array();
        $off_time = strtotime(date('Ymd000000')) - (3600 * 24 * 44);
        for($i=44;$i>0;$i--){
            $key = date('md',$off_time + (3600 * 24 * $i));
            $date_key_array[$key] = array('tiqing_money'=>0,'ok_money'=>0,'chu_money'=>0,'no_money'=>0,'time'=>0);
        }
        $tilog = M('wht_tilog');

            $wheredep['ctime'] = array('gt',$off_time);#大于

            $tilog_lst = $tilog->where($wheredep)->field('money,status,ctime')->order('ctime desc')->select();

            foreach($tilog_lst as $k=>$v){

                $date_key = date('md',$v['ctime']);

                $date_key_array[$date_key]['tiqing_money'] += $v['money'];
                if($v['status'] == 3){

                    $date_key_array[$date_key]['chu_money'] += $v['money'];

                }
                if($v['status'] == 4){

                    $date_key_array[$date_key]['ok_money'] += $v['money'];

                }
                if($v['status'] == 5){

                    $date_key_array[$date_key]['no_money'] += $v['money'];

                }
                $date_key_array[$date_key]['time'] = $v['ctime'];
            }
        $this->assign('date_key_array',$date_key_array);
        $this->assign('number',$number);
        $this->display();
    }
    public function transfer(){
        $mob = I('get.mob','');
        $cond='';
        if ($mob != ''){
            $cond['u.mobile'] = ['like',"%$mob%"];
        }
        $total = M('transfer')
            ->alias('t')
            ->join('left join __USER__ u on t.uid = u.id')
            ->where($cond)
            ->count();
        $limit = 10;
        $page = new Page($total,$limit);
        $info = M('transfer')
            ->alias('t')
            ->join('left join __USER__ u on t.uid = u.id')
            ->where($cond)
            ->field('t.number,t.mobile tmobile,u.mobile umobile,t.money,t.ztime,t.status')
            ->limit($page->firstRow.','.$limit)
            ->order('t.id desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    public function bill(){
        $acc = I('get.acc','');
        $cond='';
        if ($acc != ''){
            $user=M('user')->field('id')->where(['mobile'=>$acc])->find();
            $cond= ['uid'=>$user['id']];
        }
        $total = M('bill')
            ->where($cond)
            ->count();
        $limit = 10;
        $page = new Page($total,$limit);
        $info = M('bill')
            ->where($cond)
            ->limit($page->firstRow.','.$limit)
            ->order('id desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
}