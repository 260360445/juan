$(document).ready(function(){
	// 点击银行卡时
	$('.bank_card li').click(function(){
		$(this).addClass('current').siblings().removeClass('current');
		$(this).parent().siblings('.thirdparty').children('li').removeClass('active');
	})
	// 点击微信 支付宝时
	$('.thirdparty li').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
		$(this).parent().siblings('.bank_card').children('li').removeClass('current');
	})
	$('.mask').click(function(){
		$('.mask').hide();
	})
})