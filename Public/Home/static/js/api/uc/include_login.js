
	
   
	    $(".loginContent #user input").focus(function(){
			$(".loginContent #user input").css({color:"#333"});
			$(".c_error_username").hide();
			if($(".loginContent #user input").val() == "请输入您的手机号"){
				$(".loginContent #user input").val("");
			}
		})
		
		$(".loginContent #user input").blur(function(){
			var username = $(".loginContent #user input").val();
			if(username =="请输入您的手机号" || username =="" || username == null){
				$("#username").val("请输入您的手机号").css({color:"#c9c9cf"});
			}
		})
		
		$("#prompt").focus(function(){
			 $(this).hide();
			 $("#password").show();
			 $("#password").focus();
		})
		$("#password").blur(function(){
			var password = $("#password").val();
			if( password=="请输入密码" || password == "" || password == null){
				$(this).hide();
				 $("#prompt").show();
			}
		})
		//点击用户名错误提示信息
		$(".c_error_username").click(function(){
			$(".loginContent #user input").focus()
			$(".c_error_username").hide();
		});
  
	    $("#password").focus(function(){
			$("#password").css({color:"#333"});
			$(".c_error_password").hide();
			if($("#password").val() == "请输入密码"){
				$("#password").val("");
			}
		})
		//点击密码错误提示信息
		$(".c_error_password").click(function(){
			$(".loginContent #pas input").focus()
			$(".c_error_password").hide();
		});
	 	//按回车键执行下一步操作(按回车登录)
	   	$(document).keydown(function(event){ 
	   	 if(event.keyCode == 13){
	   		$("#loginSubmit").trigger("click");
	   	}
	   });  
		