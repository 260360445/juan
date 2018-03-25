var canNext = false;//下一步是否可以点击
$(function(){
	$(window).resize(function(){
	  var widthL=$("body").width();
	  $(".add_car").css({left:(widthL-270)/2+"px"});
	  $(".c_add_ygqq").css({right:($("body").width()-130)/2+"px"});
	});
	$(window).resize();
   // 2015-6-19 end

	//验证码输入框获得焦点
		$("#validCode").focus(function(){
			if($("#mobile").val()=="验证码"||$("#mobile").val()==""){
				$("#mobile").focus();
				return;
			}
			$("#validCode").css({color:"#333"});
			$("#validCode").val('');
		})
		$("#validCode").blur(function(){
			if($("#validCode").val()==""){
				$("#validCode").val("验证码").css({color:"#c9c9cf"});
			}
		})
		
		$("#mobile").focus(function(){
			var mobile=$("#mobile").val();
			if(mobile =="请输入手机号"){
				$("#mobile").css({color:"#333"});
				$("#mobile").val('');
			}
		});
	$("#mobile").blur(function(){
		var mobile=$("#mobile").val();
		if(mobile ==""){
			$("#mobile").val('请输入手机号');
		}
	});
		$("#c").focus(function(){
			$("#mobile").focus();
		});
		$("#code").focus(function(){
			$("#code").css({color:"#333"});
			$("#code").val('');
		});
		$("#code").blur(function(){
			if($("#code").val()==""){
				$("#code").val("验证码").css({color:"#c9c9cf"});
			}
		});
		
//密码输入框
$(".pass_y_find1").focus(function(){
	$(this).hide();
	$(this).parent("label").find(".pass_y_find").show().focus().css({color:"#333"});
});
//第一个密码框
$("#password").blur(function(){
	var password=$(this).val();
	if(password==null || password == ""){
		$(this).hide();
		$(this).parent("label").find(".pass_y_find1").show();
	}else if(!/^[A-Za-z0-9]{6,20}$/.test(password)){
		$("#passwordP").html("长度为6-20位字母或者数字的组合!");
		$("#passwordP").show();
	}
});
//第二个密码框
$("#repassword").blur(function(){
	var password=$("#password").val();
	var repassword=$(this).val();
	if(repassword==null || repassword == ""){
		$(this).hide();
		$(this).parent("label").find(".pass_y_find1").show();
	}else if(repassword!=password){
		$("#repasswordP").html("两次输入的密码不同！");
		$("#repasswordP").show();
	}
});
//密码错误提示
$('.c_error2').mouseover(function(){
	$(this).hide();
	$(this).parent("label").find(".pass_y_find").show().focus().css({color:"#333"});
});
})
