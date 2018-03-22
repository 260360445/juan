$(document).ready(function(){
	// 点击显示 .mask
	$('.order_record_con ul li button').click(function(){
		$('.mask').show();
		$('.mask .pay_password').show();
		$('.i-text').focus(); //先让 input 自动获得焦点
	})
	$('.mask .pay_password button').click(function(){
		$('.mask .pay_success').show();
	})
	$('.mask em').click(function(){
		$('.mask').hide();
	})


	// 支付密码
    $(".i-text").keyup(function() {
        var inp_v = $(this).val();
        var inp_l = inp_v.length;
        for (var x = 0; x <= 6; x++) {
            $(".sixDigitPassword").find("i").eq(inp_l).addClass("active").siblings("i").removeClass("active");
            $(".sixDigitPassword").find("i").eq(inp_l).prevAll("i").find("b").css({ "display": "block" });
            $(".sixDigitPassword").find("i").eq(inp_l - 1).nextAll("i").find("b").css({ "display": "none" });

            $(".guangbiao").css({ "left": inp_l * 31 }); //光标位置

            if (inp_l == 0) {
                $(".sixDigitPassword").find("i").eq(0).addClass("active").siblings("i").removeClass("active");
                $(".sixDigitPassword").find("b").css({ "display": "none" });
                $(".guangbiao").css({ "left": 0 });
            } else if (inp_l == 6) {
                $(".sixDigitPassword").find("b").css({ "display": "block" });
                $(".sixDigitPassword").find("i").eq(5).addClass("active").siblings("i").removeClass("active");
                $(".guangbiao").css({ "left": 5 * 31 });
            }
        }
    });


})