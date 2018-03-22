<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>万花筒管理系统</title>
<link rel="stylesheet" type="text/css" href="/Public/Admin/login/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/login/css/demo.css" />
<!--必要样式-->
<link rel="stylesheet" type="text/css" href="/Public/Admin/login/css/component.css" />
<!--[if IE]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body>
	<div class="container demo-1">
		<div class="content">
			<div id="large-header" class="large-header">
				<canvas id="demo-canvas"></canvas>
				<div class="logo_box">
					<h3>万花筒管理系统</h3>
					<form action="#" name="f" method="post">
						<div class="input_outer">
							<span class="u_user"></span>
							<input name="logname" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入账户">
						</div>
						<div class="input_outer">
							<span class="us_uer"></span>
							<input name="logpass" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;"value="" type="password" placeholder="请输入密码">
						</div>
						<div class="mb2"><a class="act-but submit" href="javascript:sublogin();" style="color: #FFFFFF">登录</a></div>
					</form>
				</div>
			</div>
		</div>
	</div><!-- /container -->
<script src="/Public/Admin/javascripts/jquery.min.js"></script>
<script src="/Public/Admin/javascripts/layer/layer.js"></script>
<script src="/Public/Admin/login/js/TweenLite.min.js"></script>
<script src="/Public/Admin/login/js/EasePack.min.js"></script>
<script src="/Public/Admin/login/js/demo-1.js"></script>
<script>
function sublogin(){
	var name=$("input[name=logname]").val();
	var pass=$("input[name=logpass]").val();
	var url = "<?php echo U('Login/doLogin');?>";
	if(name == ''){
		layer.msg('请输入账户',{offset: '300px',time: 1500,icon: 2});
		return false;
	}
	if(pass == ''){
		layer.msg('请输入密码',{offset: '300px',time: 1500,icon: 2});
		return false;
	}
    $.ajax({
        type : 'post',
        url : url,
        data : {name:name,pass:pass},
        error : function () {
            layer.msg('网络故障，请稍后重试!',{offset: '300px',time: 1500,icon: 7});
        },
        success : function (responses) {
            if (responses == 'ok'){
                layer.msg('登录成功',{offset: '300px',time: 1500,icon: 1},function () {
                   window.location.href = "<?php echo U('Index/index');?>";
                });
            }else{
                layer.msg(responses,{offset: '300px',time: 1500,icon: 2});
            }
        }
    });
}
</script>
</body>
</html>