<?php
	date_default_timezone_set("PRC");
	header("content-type:text/html;charset=utf-8");
	#代付接口提交
	function request_by_curl() {
		$url  = 'http://extman.baiduannet.com/pay/pay_mobile.action';
	    $key        = '8e3b8fc750abefd24300abc3cd7078d5';           #商户key
	    $data['userid']     = '019699';                             #用户ID
	    $data['type']       = 'gateway';                            #固定gateway网关
	    $data['orderCode']  = 'up_Withdraw';                        #固定：up_Withdraw
	    $data['name']       = '梁阅';                               #用户姓名
	    $data['cardNo']     = '6217001140037393060';                #银行卡号
	    $data['pay_number'] = date('YmdHis') . rand(100000,999999); #订单号
	    $data['purpose']    = '用户提现';                           #付款目的
	    $data['amount']     = 39998;                                #代付金额单位分2347,3523
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
	var_dump(request_by_curl());
 ?>