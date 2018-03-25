$(document).ready(function(){
	// 只能选择一种支付方式
	$('.cashier_desk_pay_con ul li div p').click(function(){
		$(this).addClass('current').siblings('p').removeClass('current').parent().parent().siblings('li').children('div').children('p').removeClass('current');	
	})
	// 点击展开、收起
	$('.cashier_desk_pay_con ul li i').click(function(){
		if ($(this).siblings().css('height') == '112px') {
			$('.cashier_desk_pay_con ul li div').css('height','auto');
			$(this).css('margin-top',194).html('收起').append('<img src="/Public//Home/static/new/img/images/close.png" alt="">');
		} else {
			$('.cashier_desk_pay_con ul li div').css('height','112px');
			$(this).css('margin-top',60).html('展开更多').append('<img src="/Public//Home/static/new/img/images/open.png" alt="">');
		}
	})
	// 
	/*$('.cashier_desk_pay_con ul li button').click(function(){
		if ($('.pay_zfb').hasClass('current')) {
			$('.cashier_desk_mask1').css('display','block');
			$('.cashier_desk_mask_con i img').click(function(){
				$('.cashier_desk_mask1').css('display','none');
			})
		} else if($('.pay_wx').hasClass('current')) {
			$('.cashier_desk_mask2').css('display','block');
			$('.cashier_desk_mask_con i img').click(function(){
				$('.cashier_desk_mask2').css('display','none');
			})
		}
		
	})*/
})

