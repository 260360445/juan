<?php 
		header("content-type:text/html;charset=utf-8");
	    $SubmitUrl  = 'http://extman.baiduannet.com/pay/pay_mobile.action';
        $key        = '8e3b8fc750abefd24300abc3cd7078d5';                     #商户key
        $data['userid']     = '019699';                                       #商户IDID
        $data['orderCode']  = 'up_gateway';                                   #固定up_gatewayPay网关
        $data['notifyURL']  = 'https://www.fdcfsy.com/home/Api/yinShengPaynotify';        #异步通知地址
        $data['frontURL']   = 'https://www.fdcfsy.com/home/Pcenter/resfront'; #成功后返回地址
        $data['pay_number'] = time().'123456';                                    #订单号
        $data['amount']     = $_POST['money'];                                        #支付金额
        $data['remark']     = '代付账户充值';                                   #订单号
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
        $resarr = (array)json_decode($file_contents);
        if($resarr['resCode'] == '000000'){
            echo '<script>location.href="'.$resarr['payUrl'].'"</script>';
        }
 ?>