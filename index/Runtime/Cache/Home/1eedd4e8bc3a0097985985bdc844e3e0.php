<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords"content="<?php echo $_SESSION['sc']['infor']['keywords']?>"/>
<meta name="description" content="<?php echo $_SESSION['sc']['infor']['description']?>"/>
<link rel="shortcut icon" href="/<?php echo $_SESSION['sc']['infor']['ico']?>" type="image/x-icon" /> 
<meta name="author"  content="网页作者的资料"/>
<meta name="robots" content="" />
<meta http-equiv="Content－Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
<meta name="format-detection" content="telephone=no,address=no,email=no"/>
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"/> 
<meta name="renderer" content="webkit"/>
<link rel="stylesheet" href="/Public/Home/static/userCenter/css/forgetPwd.css"/>
<link rel="stylesheet" href="/Public/Home/static/userCenter/css/registerNew.css"/>
<link rel="stylesheet" href="/Public/Home/static/userCenter/css/login.css"/>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/comm.min.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/footer_header.min.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/index.min.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/new_join.min.css">
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/login_box/login_box.min.css">

<title>方大商城-登录</title>
<style type="text/css">
#forgetPwdA:hover {color:#dd2726;}
.w_other span {
    margin-left: 90px;
}
.c_add_ygqq{
    position: absolute;
    top:264px;
    right:434px;
    display: block;
    width:130px;
    height:170px;
    cursor: pointer;
    margin-right:-452px;
  }
  .footer{
    padding-top: 0 !important;

  }
  .header{
    overflow: hidden;
    background-color: #fff;
    border-bottom: 1px solid #e5e5e5;
    padding: 10px 0;
  }
  .header div{
    width: 1200px;
    margin: 0 auto;
  }
  .header a{
    float: left;
  }
  .header p{
    float: left;
    font-size: 20px;
    color: #b3b3b3;
    padding-left: 15px;
    line-height: 40px;
    border-left: 1px solid #e5e5e5;
  }
  .loginContent{
    width: 1200px;
    margin: 0 auto;
    position: relative;
  }
  .loginContent form{
    float: right;
    margin: 0;
    background-color: #fff;
    padding: 0 35px 40px 35px;
    border: 1px solid #e5e5e5;
  }
  .w_bg_box{
    background: #f5f5f5 none;
  }
  .loginContent h3{
    float: left;
    position: absolute;
    left: -30px;
  }
  .zhanghao {
    float: right;
    margin: 0;
  }
  .zhanghao a{
    color: #69a3da;
    text-decoration: underline;
  }
  .top{
    line-height: 66px;
    color: #d44e49;
  }
  .top img{
    float: left;
    width: 28px;
    height: 28px;
    margin: 18px 10px 0 0;
  }
  .w_other a{
    display: block;
    text-align: right;
    color: #69a3da;
    margin-top: 35px;
  }
  .denglu{
    border-radius: 6px;
  }
</style>
</head>
<body>
  <!-- header -->
  <div class="header">
    <div>
        <a href="/"><img src="/<?php echo $_SESSION['sc']['infor']['logo']?>" title="方大商城" alt=""/></a>
        <p>欢迎登录</p>
    </div>
  </div>
 <!-- center -->
<div class="w_bg_box" style="background-size: 100% 100%;height:579px;">
  <div class="loginContent">
      <h3><img src="/Public/Home/static/zt/buymember/images/back.png" alt="" /></h3>
      <form method="post">
             <div class="top">
                <img src="/Public/Home/static/zt/buymember/images/store.png" alt="" />
                登录<p class="zhanghao">还没有账号？<a href="<?php echo U('Register/register');?>" >免费注册>></a></p></div>
             <div style="clear: both;"></div>
          <div class="user" id="user">
              <span></span>
              <input type="text" name="username" id="username" class="border" value="请输入您的手机号" maxlength="30"/>
              <p class="c_error w_error c_error_username"></p>
          </div>
          <div class="pas" id="pas">
              <span></span>
              <input type="text" name="password" id="prompt"  value="请输入密码" maxlength="20"/>
              <input name="retPassword" id="password" type="password" value="请输入密码" style="display: none;" maxlength="20"/>
              <p class="c_error w_error c_error_password"></p>
          </div>
              <input type="button" class="denglu" value="立即登录" id="loginSubmit"/>
          <div class="w_other">
            <a href="<?php echo U('Login/reset');?>" id="forgetPwdA">忘记密码？</a>
          </div>
          
      </form>
  </div>
</div>
<!-- footer -->

<div class="footer_change" >
      <div class="footer">
        <div class="yFootSupport">
          <div class="yFootSupport_in">
            <dl>
            <dt>新手指南</dt>
            <dd><a href="#" target="_blank">购物指南</a></dd>
            <dd><a href="#" target="_blank">常见问题</a></dd>
            <dd><a href="#" target="_blank">服务协议</a></dd>
            </dl>
            <dl>
            <dt>服务支持</dt>
            <dd><a href="#" target="_blank">保障体系</a></dd>
            <dd><a href="#" target="_blank">风险提示</a></dd>
            <dd><a href="#" target="_blank">安全支付</a></dd>
            </dl>
            <dl>
            <dt>商品配送</dt>
            <dd><a href="#" target="_blank">配送费用</a></dd>
            <dd><a href="#" target="_blank">验货签收</a></dd>
            <dd><a href="#" target="_blank">会员福利</a></dd>
            </dl>
            <dl>
            <dt>关于我们</dt>
            <dd><a href="#" target="_blank">了解我们</a></dd>
            <dd><a href="#" target="_blank">联系我们</a></dd>
            <dd><a href="#" target="_blank">诚聘英才</a></dd>
            </dl>
<!--             <dl class="dl_Time">
              <dd title="服务热线" style="background:url(/Public/Home/static/img/front/index/phone.png) no-repeat 0px 5px;margin-top: 29px;"></dd>
              <dd title="服务器时间" style="background:url(/Public/Home/static/img/front/index/time.png) no-repeat 0px 6px;background-size:21px;margin-top: 15px;" class="sysTime">00:00:00</dd>
            </dl> -->
<!--             <dl class="dlLast">
              <a href="javascript:void(0);">
                <dd class="dlLast-WeChat">
                  <div class="y-popover">
                    <span class="y-arrow"></span>
                    <b>官方微信</b>
                    <img src="/<?php echo $_SESSION['sc']['infor']['weixinlogo']?>" alt="">
                  </div>
                </dd>
              </a>
              <a href="javascript:void(0);">
                <dd class="dlLast-Sina">
                  <div class="y-popover">
                    <span class="y-arrow"></span>
                    <b>新浪微博</b>
                    <img src="/Public/Home/static/img/front/cloud_global/fullPage/cloud_xx.jpg" alt="">
                  </div>
                </dd>
              </a>
              <a href="javascript:void(0);">
                <dd class="dlLast-apple">
                  <div class="y-popover">
                    <span class="y-arrow"></span>
                    <b>扫二维码下载</b>
                    <img src="/Public/Home/static/img/front/cloud_global/fullPage/android_app.jpg" alt="">
                  </div>
                </dd>
              </a>
              <a href="javascript:void(0);">
                <dd class="dlLast-Android">
                  <div class="y-popover">
                    <span class="y-arrow"></span>
                    <b>扫二维码下载</b>
                    <img src="/Public/Home/static/img/front/cloud_global/fullPage/android_app.jpg" alt="">
                  </div>
                </dd>
              </a>
            </dl> -->
          </div>
          <div class="footer-time-list" id="pageEnd">
            <div class="yFootBottomIn" style="clear: both;">
                <p>友情链接：
                  <a target="_blank" href="">阿萨德</a>|
                  <a target="_blank" href="">奥术大师</a>|
                  <a target="_blank" href="">下次再</a>
                </p>
            </div>
            <div class="yFootBottomRight">
              <?php echo $_SESSION['sc']['infor']['copyright']?>
            </div>
            <div class="yFootBottomLeft">
              <a href="#"  class="s_footer_icon"><img src="http://v.trustutn.org/images/cert/bottom_large_img.png"/></a>
              <a href="#"  class="yFootBottomLeft1"></a>
              <a href="#" class="yFootBottomLeft2" ></a>
              <a href="#"  class="yFootBottomLeft3"></a>
              <a href="#"  class="yFootBottomLeft4"></a>
              <a  class="x_newadd_aBox" href="#">
              </a>
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript" src="/Public/Home/static/userCenter/js/jquery.js"></script>
<script src="/Public/Admin/javascripts/layer/layer.js"></script>
<script type="text/javascript" src="/Public/Home/static/js/api/uc/include_login.js"></script>
<script>
  //背景高度
    var hei=window.innerHeight;
    // $('.w_bg_box').css('height',559+'px');

  //会员登录
  $("#loginSubmit").click(function(){
    var username = $("#username").val();    
    var password = $("#password").val();  
    if(username==null || username == "" || username == "请输入您的手机号" ){
      $(".c_error_username").html("请输入您的手机号");
      $("#username").siblings(".c_error_username").show(100).delay(2000).hide(0);
      return ;
    }else if(password==null ||password =="" || password == "请输入密码"){
      $(".c_error_password").html("请输入密码");
      $("#password").siblings(".c_error_password").show(100).delay(2000).hide(0);
      return ;
    }else{
      var url = "<?php echo U('Login/dologin');?>";
      password = $("#password").val();
      $("#loginSubmit").val("等待...");
      $.ajax({
        type: "post",
        url: url,
        dataType:'json',
        data:{
          username :username,
          password : password
        },
        success:function(data){
          if(data=="0"){
             window.location.href = "<?php echo U('Pcenter/account');?>";
          }else{ 
            $("#loginSubmit").val("立即登录");
            if(data == "1"){
              $(".c_error_username").html("账号不正确！");
              $("#username").siblings(".c_error_username").show(100).delay(2000).hide(0);
            }else if(data == "2" ){
              $(".c_error_password").html("密码不正确");
              $("#password").siblings(".c_error_password").show(100).delay(2000).hide(0);
            }
          } 
        }
      });   
    }
  });
</script>
</body>
</html>