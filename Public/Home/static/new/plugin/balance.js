$(document).ready(function(){
	$('.safety ul li div p').click(function(){
		$(this).addClass('current').siblings().removeClass('current');
		$('.safety ul li span i').html($(this).children('i').html());
		$('#paytype').val($(this).index() + 2);
	})
	var $inputs = $(".safety ul li div input");
	$inputs.keyup(function() {
		if (isNaN($inputs.val())) {
			layer.msg('请正确填写金额！',{offset: '300px',time: 1500,icon: 7});
    		return false;
		}
		$('.safety ul li span i').html($inputs.val());
		if ($inputs.val()!=='') {
			$('.safety li div p').removeClass();
			// alert('请输入数字金额');
		}else{
			$('.safety li div p:first').addClass('current');
			$('.safety li span i').html('100');
		}
	   
	});
	
})