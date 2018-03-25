<?php 
		#代付接口订单查询
		#支付接口地址
	    $SubmitUrl  = 'http://extman.baiduannet.com/pay/pay_mobile.action';
	    $key             = '0ca7a8f74e1c79fae9db8c8ea2884aa5';         #商户KEY
	    $userid  = '019699';
	    $pay_number          = '20180226042352742896';                          #固定up_QueryWithdrawOrder
	    $route           = 'baiduan';                                  #baiduan
	    $orderCode      = 'up_Querygateway';                         #用户姓名
	    $sign       = md5("route=baiduan&userid=019699&key=$key");     #数字签名
	    #生成请求支付接口表单并提交
	    $sHtml = "<form id='alipaysubmit' action='".$SubmitUrl."' method='post' target='_blank'>";
	    $sHtml.= "<input type='text' style='width:500px;' name='orderCode' value='".$orderCode."'/><br />";
	    $sHtml.= "<input type='text' style='width:500px;' name='pay_number' value='".$pay_number."'/><br />";
	    $sHtml.= "<input type='text' style='width:500px;' name='route' value='".$route."'/><br />";
	    $sHtml.= "<input type='text' style='width:500px;' name='userid' value='".$userid."'/><br />";
	    $sHtml.= "<input type='text' style='width:500px;' name='sign' value='".$sign."'/><br />";
	    $sHtml.= "<script>document.forms['alipaysubmit'].submit();</script>";
	    echo  $sHtml;