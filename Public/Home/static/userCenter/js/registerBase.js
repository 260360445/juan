$(function(){
	
    //居中显示
    function wx_login(){
		$(".ygqq_float_con").css({left:($(window).width()-$(".ygqq_float_con").width())/2,
			                      top:($(window).height()-$(".ygqq_float_con").height())/2});
		$(".ygqq_float_qq_con").css({left:($(window).width()-$(".ygqq_float_qq_con").width())/2,
			                      top:($(window).height()-$(".ygqq_float_qq_con").height())/2});
		$(".register_img_con").css({left:($(window).width()-$(".register_img_con").width())/2,
			                      top:($(window).height()-$(".register_img_con").height())/2});
		$("#b_Contract").css({left:($(window).width()-$("#b_Contract").width())/2,
			                      top:($(window).height()-$("#b_Contract").height())/2});
		$(window).resize(function(){
			$(".ygqq_float_con").css({left:($(window).width()-$(".ygqq_float_con").width())/2,
			                      top:($(window).height()-$(".ygqq_float_con").height())/2});
			$(".ygqq_float_qq_con").css({left:($(window).width()-$(".ygqq_float_qq_con").width())/2,
			                      top:($(window).height()-$(".ygqq_float_qq_con").height())/2});
		    $("#b_Contract").css({left:($(window).width()-$("#b_Contract").width())/2,
			                      top:($(window).height()-$("#b_Contract").height())/2});
		})
	}
      //注册获取验证码
		
		$(".register_img_close").click(function(){
			$(".ygqq_float").css({display:"none"});
			$(".register_img_con").css({display:"none"});
		})
        //协议
        //鼠标滑过显示提示
        $(".ygqq_register_xy").hover(function(){
            $(".b_login_btn_xy").css({display:"block"})
        },function(){
        	$(".b_login_btn_xy").css({display:"none"})
        })

        //点击出现协议
        $(".ygqq_register_xy a").click(function(){
        	wx_login();
        	$("#b_Contract").css({display:"block"});
        	$(".ygqq_float").css({display:"block"});
        })
 
        //点击关闭协议
        $(".b_close1").click(function(){
        	$("#b_Contract").css({display:"none"});
        	$(".ygqq_float").css({display:"none"});
        })
        //点击关闭协议
        $(".b_btn-primary").click(function(){
        	$("#b_Contract").css({display:"none"});
        	$(".ygqq_float").css({display:"none"});
        })

})
