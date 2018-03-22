<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<meta name="keywords" content="<?php echo $_SESSION['sc']['infor']['keywords']?>"></meta>
<meta name="description" content="<?php echo $_SESSION['sc']['infor']['description']?>"></meta>
<meta name="renderer" content="webkit"></meta>
<meta http-equiv="X-UA-Compatible" content="IE = edge"></meta>
<title> 
<?php if($type == 'yes'){?>
    <?php echo ($info["goods_title"]); ?>
<?php }else{?>
    该商品已删除或已下架
<?php } ?>

</title>
<link rel="shortcut icon" href="/<?php echo $_SESSION['sc']['infor']['ico']?>" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/comm.min.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/footer_header.min.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/index.min.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/new_join.min.css">
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/login_box/login_box.min.css">
<link rel="stylesheet" type="text/css" href="/Public/Home/static/css/front/c_cloud.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/css/front/goods.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/css/front/s_goods.css"></link>
<link rel="stylesheet" href="/Public/Home/static/userCenter/css/login.css"/>
<link rel="stylesheet" href="/Public/Home/static/css/front/login_box/login_box.css"/>
<link rel="stylesheet" href="/Public/Home/static/min.css/css/page.css"/>
<style>
    .w_rob_another.y_rob_another dd {
        width: 211px;
        margin: 0px 20px;
        height: 50px;
    }

    .w_rob_another.y_rob_another dd a {
        height: 50px;
        line-height: 50px;
        font-size: 20px;
    }

    .w_rob_another.y_rob_another dd.w_slip_out a {
        background: #ffb922;
    }

    .w_rob_another.y_rob_another dd.w_slip_out a:hover {
        background: #ffa200;
    }

    .w_rob_another.y_rob_another dd.w_slip_out {
        margin-right: 0px;
    }

    .w_spans_bg {
        dispaly: block;
        width: 100%;
        height: 100%;
        background: #fff;
        filter: alpha(opacity=50);
        -moz-opacity: 0.5;
        -khtml-opacity: 0.5;
        opacity: 0.7;
        position: absolute;
        top: 0px;
        left: 0px;
    }

    .w_addss_img {
        width: 100%;
        text-align: center;
        height: 100%;
        position: absolute;
        top: 0px;
        left: 0px;
    }

    /* 新手体验专区商品样式--S */
    .w_greenHands {
        width: 420px;
        padding: 0px 25px;
        height: 50px;
        background: #fceaea;
        border-radius: 25px;
        font-size: 14px;
        color: #e72500;
        line-height: 50px;
        margin: 0px auto 20px;
        display: none;
    }

    .w_greenHands a {
        font-size: 14px;
        color: #0096ff;
        text-decoration: underline;
    }

    /* 新手体验专区商品样式--E */
    .c_sold_out {
        position: absolute;
        top: 0px;
        right: 0px;
        width: 90px;
        height: 90px;
    }

    .c_sold_out img {
        width: 90px;
        height: 90px;
    }

    .loginContent {
        padding: 0px 0 0;
    }

    .loginContent form {
        padding-top: 30px;
    }

    /* S 2015-11-30 新增  */
    .a_login_register_box {
        height: 375px;
    }

    .ygqq_b {
        background: #e7e7e7 none repeat scroll 0 0;
        display: block;
        float: left;
        height: 1px;
        margin-top: 7px;
        width: 107px;
    }

    /*E 2015-11-30 新增  */
    /*S 2015-12-1 新增  */
    body {
        min-width: 1210px;
        background-color: #f5f5f5;
    }

    /*E 2015-12-1 新增  */
    .tm-fcs-panel {
        background-color: #e9e9e9;
        background-repeat: no-repeat;
        backgroung-position: left 0;
        position: relative;
        left: 0;
        z-index: 10;
        font: 12px/1.5 "Microsoft Yahei",tahoma,arial;
        padding-bottom: 5px;
        padding-top: 5px;
        margin-right: 5px;
    }

    .tm-price-panel {
        position: static;
        color: #333;
        padding-left: 0;
    }

    .tm-fcs-panel dl dt.tb-metatit {
        color: #999;
        font-size: 12px;
        text-align: left;
        float: left;
        width: 69px;
        margin: 0 0 0 8px;
    }

    .tm-fcs-panel dl dd {
        color: #333;
        margin-left: 70px;
        font-family: Arial;
    }

    .tm-yen {
        font-family: arial;
    }

    .tm-price-panel .tm-price {
        text-decoration: line-through;
        font-size: 12px;
    }

    .tm-fcs-panel dl dt.tb-metatit {
        color: #999;
        font-size: 12px;
        text-align: left;
        float: left;
        width: 69px;
        margin: 0 0 0 8px;
    }

    .tm-promo-panel .tm-promo-price {
        line-height: 24px;
        font-size: 12px;
        position: relative;
    }

    .tm-promo-panel.tm-promo-cur .tm-promo-price .tm-yen {
        vertical-align: middle;
        color: #FF0036;
        font-size: 18px;
        font-family: Arial;
        -webkit-font-smoothing: antialiased;
    }

    .tm-promo-panel.tm-promo-cur .tm-promo-price .tm-price {
        vertical-align: middle;
        font-size: 22px;
        color: #FF0036;
        font-weight: bolder;
        font-family: Arial;
        -webkit-font-smoothing: antialiased;
    }

    .tm-promo-panel .tm-promo-price .tm-promo-type {
        background-color: #f47a86;
        border-radius: 1px;
        color: #fff;
        height: 16px;
        line-height: 16px;
        margin: 0 2px 4px 6px;
        padding: 1px 5px;
        position: relative;
    }

    .tm-promo-panel .tm-promo-price .tm-promo-type s {
        position: absolute;
        width: 0;
        display: block;
        font-size: 0;
        left: -4px;
        bottom: 0;
        height: 0;
        border: 3px solid #f47a86;
        border-color: transparent #f47a86 #f47a86 transparent;
    }

    .tm-ind-panel {
        border: 1px dotted #c9c9c9;
        border-width: 1px 0;
        margin: -1px 5px 0 0;
        padding: 10px 0;
        position: relative;
        overflow: hidden;
        clear: both;
        display: flex;
        list-style: none;
    }

    .tm-ind-item {
        float: left;
        width: 33%;
        text-align: center;
        position: relative;
        left: -1px;
        border-left: 1px solid #e5dfda;
        flex: 1;
        line-height: 16px;
    }

    .tm-ind-item .tm-label, .tm-ind-item .tm-monthavg {
        display: inline-block;
        line-height: 16px;
        height: 16px;
        color: #999;
    }

    .tm-ind-panel .tm-count {
        display: inline-block;
        line-height: 16px;
        height: 16px;
        color: #FF0036;
        font-weight: 700;
        margin-left: 3px;
    }

    .tm-ind-item .tm-label, .tm-ind-item .tm-monthavg {
        display: inline-block;
        line-height: 16px;
        height: 16px;
        color: #999;
    }

    .tm-ind-panel .tm-count {
        display: inline-block;
        line-height: 16px;
        height: 16px;
        color: #FF0036;
        font-weight: 700;
        margin-left: 3px;
    }

    .tm-ind-emPointCount .tm-indcon {
        display: inline-block;
        margin: 0 auto;
        line-height: 16px;
    }

    .tm-ind-item .tm-label, .tm-ind-item .tm-monthavg {
        display: inline-block;
        line-height: 16px;
        height: 16px;
        color: #999;
    }

    .tm-ind-panel .tm-count {
        display: inline-block;
        line-height: 16px;
        height: 16px;
        color: #FF0036;
        font-weight: 700;
        margin-left: 3px;
    }

    .yFootBottomLeft .x_newadd_aBox {
        width: 88px;
        background: url(/Public/Home/static/images/wjhb.jpg) no-repeat center center;
    }

    .yFootBottomLeft .x_newadd_aBox:hover {
        background: url(/Public/Home/static/images/wj.jpg) no-repeat center center;
    }

    .yFootBottomLeft a.s_footer_icon {
        background-position: -481px 0;
    }

    .yFootBottomLeft a.s_footer_icon:hover {
        background-position: -393px 0;
    }

    .yFootBottomLeft a.s_footer_icon1 {
        background-position: -387px 0;
    }

    .yFootBottomLeft a.s_footer_icon1:hover {
        background-position: -491px 0;
    }
    .w_results_right{
        float: left;
    }
    .c_newest_prize_con .w_results_right{
        width: 801px;
        margin-left: 10px;
    }
    .r-fixed{
        visibility: visible !important;
    }
</style>
</head>
<body>
<!-- 顶部 -->
<!-- 引入头部 -->
<div class="header header_fixed">
        <div class="header1">
            <div class="header1in">
                <ul class="headerul1 header_yytc">
                    <li><a style="padding-left:33px;" href="/"><i class="header-home"></i>万花筒首页</a></li>
                    <!-- <li><a>客服QQ：<?php echo $_SESSION['sc']['infor']['service']?></a></li>
                    <li>
                        <span class="c_contact_icon c_kik">
                            <div id="wechat-popover-content" class="pophover-content popover bottom" style="top: 40px;left: -60px;">
                                <div class="arrow"></div>
                                <div class="popover-content">
                                    <p style="white-space: nowrap">微信</p>
                                    <div style="width: 100px; height: 100px; margin-left: 10px;">
                                        <img src="/<?php echo $_SESSION['sc']['infor']['weixinlogo']?>" width="100" height="100" border="0" alt="">
                                    </div>
                                </div>
                            </div>
                        </span>
                        <span class="c_contact_icon c_qq">
                            <div id="wechat-app-popover-content" class="pophover-content popover bottom" style="top: 40px;left: -60px;">
                                <div class="arrow"></div>
                                <div class="popover-content">
                                    <p style="white-space: nowrap">扫码下载客户端</p>
                                    <div style="width: 100px; height: 100px; margin-left: 10px;">
                                        <img src="/Public/Home/static/img/front/cloud_global/fullPage/android_app.jpg" width="100" height="100" border="0" alt="">
                                    </div>
                                </div>
                            </div>
                        </span>
                        <a href="http://weibo.com/u/5463325697?topnav=1&wvr=6&topsug=1&is_hot=1#_loginLayer_1474361903097" style="display:inline-block;" target="blank">
                            <span class="c_contact_icon c_microblog">
                                <div id="weibo-popover-content" class="pophover-content popover bottom" style="top: 40px;left: -60px;">
                                    <div class="arrow"></div>
                                    <div class="popover-content">
                                        <p style="white-space: nowrap">新浪微博</p>
                                        <div style="width: 100px; height: 100px; margin-left: 10px;">
                                            <img src="/Public/Home/static/img/front/cloud_global/fullPage/cloud_xx.jpg" width="100" height="100" border="0" alt="">
                                        </div>
                                    </div>
                                </div>
                            </span>
                        </a>
                    </li> -->
                </ul>
                <ul class="headerul2">
                    <?php if($_SESSION['sc']['usermobile']){?>
                        <li><a id="memberMobile" href="<?php echo U('Pcenter/account');?>"><?php echo $_SESSION['sc']['usermobile']?></a></li>
                        <li><a href="<?php echo U('Login/logout');?>">退出</a></li>
                    <?php }else{?>
                        <li class="li_popup_doregister"><a href="<?php echo U('Register/register');?>" style="padding-left:30px;color:#dd2726;"><img style="position:absolute;top:14px;left:7px;" src="/Public/Home/static/img/front/add_index/top_add.png">免费注册</a></li>
                    <li class="li_popup_login"><a href="<?php echo U('Login/login');?>">登录</a></li>
                    <?php }?>
                    <?php if($_SESSION['sj']['id']){?>
                        <li><a href="<?php echo U('Merchant/merchant');?>" target="_blank"><?php echo $_SESSION['sj']['account']?></a></li>
                    <?php }else{?>
                        <li><a href="<?php echo U('Mlogin/member');?>" target="_blank">商家登录</a></li>
                    <?php }?>
                    <!-- <li><a href="/footer/cmsArticle.do?typeId=3">帮助</a></li> -->
                </ul>
            </div>
        </div>
        <div class="header2_out yNavIndexOut_fixed">
            <div class="header2 header2_yytc">
                <a href="/" class="header_logo"><img src="/<?php echo ($_SESSION['sc']['infor']['logo']); ?>"></a>
                <ul id="yMenuIndex" class="yMenuIndex">
                    <li><a href="/" class="yMenua">首页</a></li>
                    <li><a href="<?php echo U('Good/specialsale');?>">特卖会场</a></li>
                    <li><a href="<?php echo U('Good/newgood');?>">新品上架</a></li>
                    <!-- <li class="hide-menu-nav" style="padding: 0 13px 0px 15px;">
                    <span></span><a href="#" class="hide-menu-nava">发现</a>
                        <dl>
                            <dd style="border-top:1px solid #ddd;"><a href="<?php echo U('Index/score');?>" target="_blank">积分兑换</a></dd>
                            <dd style="border-top:1px solid #ddd;"><a href="<?php echo U('Index/draw');?>" target="_blank">会员抽奖</a></dd>
                        </dl>
                    </li> -->
                </ul>
                    <div class="search_header2">
                        <input type="text" placeholder="搜索商品" id="query" name="query" value="<?php echo $_GET['query']?>" />
                        <a href="javascript:void(0);" id="seach" class="btnHSearch"></a>
                    </div>
                </div>
            </div>
    </div>
<script type="text/javascript" src="/Public/Home/static/js/jquery-1.11.3.js"></script>
<script>
$("#seach").click(function(){
    var query=$("#query").val();
    if(query){
        window.location.href="<?php echo U(MODULE_NAME.'/Seach/seach/query/"+query+"');?>";
    }else{
        window.location.href="<?php echo U('Seach/seach');?>";
    }
})
</script>
<!-- 引入头部 -->
<!-- 引入左侧 -->
<div class="r-fixed" style="visibility: hidden;">
        <ul class="r-fixed-nav">
            <li class="toolbar-item" >
                <a href="javascript:CartOrder();" class="shoppingCartRightFix">
                    <em class="" id="cartCount"></em> 
                    <div class="item-tip-c item-tip-checkpage">
                        <div class="item-box">
                            <u class="u-code u-g-ft-wx"></u>
                            <div class="item-tip">购物车</div>
                        </div>
                    </div>
                    <i id="cartLabel" class="iconfont" style="background:url(/Public/Home/static/img/front/add_index/r-fixed1.png) no-repeat center center;"></i>
                </a>
            </li>
            <li class="toolbar-item">
                <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $_SESSION['sc']['infor']['service']?>&amp;Site=qq&amp;Menu=yes" title="在线客服" target="_blank">
                    <div class="item-tip-c item-tip-kefu">
                        <div class="item-box">
                            <div class="item-tip">在线客服</div>
                        </div>
                    </div>
                    <i class="iconfont" style="background:url(/Public/Home/static/img/front/add_index/r-fixed2.png) no-repeat center center;"></i>
                </a>
            </li>
            <li class="toolbar-item">
                <a href="javascript:void(0);">
                    <div class="item-tip-c item-tip-wx">
                        <div class="item-box">
                            <u class="u-code u-g-ft-wx">
                                <img src="/<?php echo $_SESSION['sc']['infor']['weixinlogo']?>">
                            </u>
                            <div class="item-tip">关注微信</div>
                        </div>
                    </div>
                    <i class="iconfont" style="background:url(/Public/Home/static/img/front/add_index/r-fixed3.png) no-repeat center center;"></i>
                </a>
            </li>
            <!-- <li class="toolbar-item">
                <a href="javascript:void(0);">
                    <div class="item-tip-c item-tip-app">
                        <div class="item-box">
                            <u class="u-code u-g-ft-app">
                                <img src="/Public/Home/static/img/front/cloud_global/fullPage/android_app.jpg">
                            </u>
                            <div class="item-tip">扫码下载APP</div>
                        </div>
                    </div>
                    <i class="iconfont" style="background:url(/Public/Home/static/img/front/add_index/r-fixed4.png) no-repeat center center;"></i>
                </a>
            </li> -->
            <li class="toolbar-item">
                <a href="<?php echo U('Pcenter/checkstand');?>" target="_blank" title="购买套包">
                    <div class="item-tip-c item-tip-checkpage">
                        <div class="item-box">
                            <div class="item-tip">购买套包</div>
                        </div>
                    </div>
                    <i class="iconfont" style="background:url(/Public/Home/static/img/front/add_index/r-fixed5.png) no-repeat center center;"></i>
                </a>
            </li>
            <li id="back" class="toolbar-item">
                <a href="javascript:void(0);">
                    <div class="item-tip-c item-tip-back">
                        <div class="item-box">
                            <div class="item-tip">返回顶部</div>
                        </div>
                    </div>
                    <i class="iconfont" style="background:url(/Public/Home/static/img/front/add_index/r-fixed6.png) no-repeat center center;"></i>
                </a>
            </li>
        </ul>
    </div>
    <!--E 2015 11 21 -->
<div class="a_login_fixed_box a_login_register_box loginContent" style="z-index:1012">
    <h4 class="a_world_title">账号登录</h4>
        <form class="a_login_register_form a_login_form">
            <div class="user" id="user">
           <span></span>
           <input type="text" id="user_name" class="border" placeholder="手机号" datacol='yes' checkexpession='NotNull' err='手机号' maxlength="11"/>
        </div>
        <div class="pas" id="pas">
           <span></span>
           <input type="password" id="pass_word"  maxlength="20" placeholder="密码" datacol='yes' checkexpession='NotNull' err='密码'/>
        </div>
        <a href="javascript:void(0);" class="a_login_btn_go" id="loginSubmitUser">立即登录</a>
        <a href="<?php echo U('Login/reset');?>" class="cz_ps">忘记密码？</a>
        <a href="<?php echo U('Register/register');?>" class="cz_ps" style="margin-left: 162px;">立即注册</a>
       <div style="margin-top: 7px" class="ygqq_login_other"> 
        <!--  <span><b class="ygqq_b"></b><h3>第三方登录</h3><b class="ygqq_b"></b></span>
         <ul class="yygqq_login_other_ul">
           <li class="ygqq_qq ygqq_qq_all"><a href="/api/uc/qqLogin.do?platform=qq"></a></li>
           <li class="ygqq_wx ygqq_wx_all"><a href="/api/uc/qqLogin.do?platform=wx_scan"></a></li>
           <li class="ygqq_wb"><a href="/api/uc/qqLogin.do?platform=wb"></a></li>
         </ul> -->
      </div>
     </form>
    <span class="a_world_close a_login_world_close"></span>
</div>
<script type="text/javascript" src="/Public/Home/static/js/jquery-1.11.3.js"></script>
<script>
$("#loginSubmitUser").click(function () {
    var url = "<?php echo U('Login/dologin');?>";
    if(CheckDataValid(".a_login_form")){
      $.ajax({
          type : 'post',
          url : url,
          dataType:'json',
          async: false,
          data : {username:$("#user_name").val(),password:$("#pass_word").val()},
          error : function () {
              layer.msg('网络故障，请稍后重试!',{offset: '300px',time: 1500,icon: 7});
          },
          success : function (responses) {
            if (responses == '0'){
                layer.msg('登录成功',{offset: '300px',time: 1500,icon: 1},function () {
                    window.location.reload();
                });
            }else if (responses == '1'){//  账号错误
                layer.msg('账号错误',{offset: '300px',time: 1500,icon: 2});
            }else if (responses == '2'){//  密码错误
                layer.msg('密码错误',{offset: '300px',time: 1500,icon: 2});
            }
          }
      });
    }
})
</script>
<!--S 遮罩背景 -->
<!--E 2015 11 21 -->
<!--S 遮罩背景 -->
<!-- 引入左侧 -->
<input type="hidden" id="mid" value="<?php echo $_SESSION['sc']['id']?>" />
<input type="hidden" id="sta" value="<?php echo $_SESSION['sc']['status']?>" />
<input type="hidden" value="<?php echo ($info["id"]); ?>" id="gid" />
<?php if($type == 'yes'){?>
<div class="w_con" id="goods_details" style="display: block;">
    <div class="w_details_left s_details_left">
        <h4 class="w_guide">
            <a href="/">首页</a>
            <a href="<?php echo U('Good/allgood');?>">全部商品</a>
            <a class="w_accord" href="javascript:void(0)">商品详情</a>
        </h4>
        <div class="w_details_top">
            <div class="w_details_choose" style="position:relative;">
                <dl class="w_big_img">
                    <!-- 大图 -->
                    <?php  $imgarr=M('goods_imgs')->where(['gid'=>$info['id']])->order('id asc')->select(); ?>
                    <?php if(is_array($imgarr)): $i = 0; $__LIST__ = $imgarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><dd><img src="/Uploads<?php echo ($list['showlogo']); ?>"/></dd><?php endforeach; endif; else: echo "" ;endif; ?>
                </dl>
                <ul class="w_small_img">
                    <i class='w_modified'></i>
                    <?php if(is_array($imgarr)): $key = 0; $__LIST__ = $imgarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($key % 2 );++$key; if($key == 1): ?><li class="w_small_color"><img style="width:53px;height:53px;" src="/Uploads<?php echo ($list['showlogo']); ?>"/></li>
                        <?php else: ?>
                            <li><img style="width:53px;height:53px;" src="/Uploads<?php echo ($list['showlogo']); ?>" /></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    <!-- 小图 -->
                </ul>
                <ul class="w_security s_security">
                    <li class="s_security_one">四大服务保证：</li>
                    <li class="w_security_one">公平公正</li>
                    <li class="w_security_two">正品保证</li>
                    <li class="w_security_four">权益保障</li>
                    <li class="w_security_three">急速配送</li>
                    <div class="w_clear"></div>
                </ul>
            </div>
            <div class="w_details_text s_details_text" style="position:relative;">
                <div class="zhengchang s_goods_detail" style="display:;">
                    <!-- 正常购买 -->
                    <p id="zc_title" class="s_title">
                        <span id="cart_period">
                            <strong>
                                <c id="cart_title" style="font-size:18px;"><?php echo ($info["goods_title"]); ?></c>
                            </strong>
                        </span>
                        <i style="color:"></i>
                    </p>
                    <div class="tm-fcs-panel">
                        <dl class="tm-price-panel" id="J_StrPriceModBox">
                            <dt class="tb-metatit">价格</dt>
                            <dd>
                                <em class="tm-yen">￥</em>
                                <span class="tm-price"><?php echo ($info["money"]); ?></span>
                            </dd>
                        </dl>
                        <dl class="tm-promo-panel tm-promo-cur" id="J_PromoPrice" data-label="可用金">
                            <dt class="tb-metatit">可用金</dt>
                            <dd>
                                <div class="tm-promo-price">
                                    <em class="tm-yen">￥</em>
                                    <span class="tm-price"><?php echo ($info["price"]); ?></span>
                                </div>
                            </dd>
                            <dt class="tb-metatit">消费币</dt>
                            <dd>
                                <div class="tm-promo-price">
                                    <em class="tm-yen">￥</em>
                                    <span class="tm-price"><?php echo ($info["xfb"]); ?></span>
                                    <em class="tm-promo-type ">
                                        <s></s>
                                        感恩回馈
                                    </em>
                                    &nbsp;&nbsp;
                                <p></p>
                            </dd>
                        </dl>
                        <dl class="tm-phoneprice">
                            <dt class="tb-metatit">&nbsp;</dt>
                            <dd>
                        </dl>
                    </div>
                    <ul class="tm-ind-panel">
                        <li class="tm-ind-item tm-ind-sellCount " data-label="月销量">
                            <div class="tm-indcon">
                                <span class="tm-label">销量</span>
                                <span class="tm-count"><?php echo ($info["sell"]); ?></span>
                            </div>
                        </li>
                        <li class="tm-ind-item tm-ind-reviewCount canClick tm-line3" id="J_ItemRates">
                            <div class="tm-indcon">
                                <span class="tm-label">累计评价</span>
                                <span class="tm-count"><?php echo ($info["comment"]); ?></span>
                            </div>
                        </li>
                        <li class="tm-ind-item tm-ind-emPointCount" data-spm="1000988">
                            <div class="tm-indcon">
                                <span class="tm-label">库存</span>
                                <span class="tm-count"><?php echo ($info["kucun"]); ?></span>
                            </div>
                        </li>
                    </ul>
                    <div class="w_cumulative w_cumulative_another">
                        <strong>数量：</strong>
                        <input type="text" class="w_detailsinputs w_detailsinputs_one times" onkeyup="bugTimesInput()" value="1" min="1" max="<?php echo ($info["kucun"]); ?>" maxlength="7" id="buyNum">
                        <span class="w_subtracts_one" onclick="cutBuyTimes()"></span>
                        <span class="w_pluss_one" onclick="addBuyTimes()"></span>
                    </div>
                    <dl class="w_rob w_rob_another y_rob_another s_rob">
                        <dd>
                            <a id="iWantyg" class="w_slip" data-gid="5" data-pid="161106202515806" href="javascript:void(0)" onclick="gotoCart('<?php echo ($info["id"]); ?>')">立即购买</a>
                        </dd>
                        <dd class="w_slip_out">
                            <a class="w_slip_in" href="javascript:void(0)" onclick="cartoons('<?php echo ($info["id"]); ?>')">加入购物车</a>
                        </dd>
                        <div class="w_clear"></div>
                    </dl>
                    <!--未登录开始-->
                </div>
            </div>
        </div>
        <div class="more_product">
            <div class="shangjia">
                <h3><?php echo ($store['store_name']); ?></h3>
                <ul>
                    <li class="first">
                        <h4>商品</h4>
                        <p><?php echo ($store_good); ?></p>
                    </li>
                    <li>
                        <h4>月售</h4>
                        <p><?php echo ($store_sell); ?></p>
                    </li>
                </ul>
            </div>
            <div class="look">
                <h3>看了又看...</h3>
                <div>
                    <ul>
                    <?php if(is_array($store_look)): $i = 0; $__LIST__ = $store_look;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li>
                            <h4><a href="<?php echo U('Good/goodlist',['id'=>$list['id']]);?>" target="_blank"><img src="/Uploads<?php echo ($list['goods_logo']); ?>" style="width: 169px;height: 169px;"></a></h4>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>   
                    </ul>
                </div>
                <span class="up"></span>
                <span class="down"></span>
            </div>
        </div>
    </div>
    <!--揭晓前-->
    <!--揭晓后结束-->
    <div class="w_clear"></div>
    <div class="w_details_bottom s_details_bottom">
        <!--最新上架-->
        <!--奖品详情-->
        <div class="w_prize pgp c_newest_prize">
            <dl class="w_calculate_nav">
                <dd class="w_results_arrow">商品详情</dd>
                <dd>评价</dd>
            </dl>
            <div style="clear: both;"></div>
            <div class="w_calculate_con">
                <div class="w_prize_con w_prize_img c_newest_prize_con" style="display: block;">
                    <!-- 商品详情 -->
                    <!-- <p>1</p> -->
                    <div class="title"></div>
                    <!-- <ul>
                        <li>
                            <div>
                                <h3>品牌：</h3>
                                <p>希梵（SHEVAN）</p>
                            </div>
                            <div>
                                <h3>重量：</h3>
                                <p>0.62KG</p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>面料：</h3>
                                <p>牛皮+PU</p>
                            </div>
                            <div>
                                <h3>结构：</h3>
                                <p>主袋、侧袋、拉链袋</p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>功能：</h3>
                                <p>双肩、单肩、手提</p>
                            </div>
                            <div>
                                <h3>内里：</h3>
                                <p>涤纶</p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>用途：</h3>
                                <p>上班、上学、逛街</p>
                            </div>
                            <div>
                                <h3>容量：</h3>
                                <p>雨伞、钱包、IPAD、化妆品</p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>尺寸:</h3>
                                <p>高31、底宽29、厚14、手提9（cm）</p>
                            </div>
                        </li>
                    </ul> -->
                    <div ><?php echo ($info["cont"]); ?></div>
                    <p>
                        <!-- <img src="http://img02.ygqq.com/upload/goodsfile/20160530/1464595978429003348.jpg" title="1464595978429003348.jpg" alt="重要说明.jpg" style="white-space: normal;"/> -->
                    </p>
                </div>
                <!--晒单-->
                <div class="w_prize_con c_newest_prize_con c_newest_prize" style="display: none;" id="ajax_lists">
                    
                </div>
            </div>
        </div>
        <div class="hot_sale">
            <div class="title">
                <p>热卖推荐</p>
            </div>
            <ul>
            <?php if(is_array($store_hot)): $i = 0; $__LIST__ = $store_hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li>
                    <h4><a href="<?php echo U('Good/goodlist',['id'=>$list['id']]);?>" target="_blank"><img src="/Uploads<?php echo ($list['goods_logo']); ?>" style="width: 207px;height: 207px;margin: 0 auto;"></a></h4>
                    <p>可用金：￥<?php echo ($list['price']); ?></p><p>消费币：￥<?php echo ($list['xfb']); ?></p>
                    <span><a href="<?php echo U('Good/goodlist',['id'=>$list['id']]);?>" target="_blank"><?php echo ($list['goods_title']); ?></a></span>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>   
            </ul>
        </div>
        <div class="w_clear"></div>
    </div>
</div>
<?php }else{?>

    <div class="w_con" id="goods_details" style="display: block;">
        <img style="display:block;margin:80px auto;" src="/Public/Home/static/img/shangpinxiajia.png">
    </div>

<?php }?>

<!-- 夺宝期数弹窗 end -->
 <script type="text/javascript" src="/Public/Home/static/js/jquery-1.11.3.js"></script>
<script type="text/javascript">
    var url_ajax = "<?php echo U('Good/pingjia');?>";
    var gid="<?php echo $_GET['id']?>";
    $(function() {
       $("#ajax_lists").delegate(".pager a", "click", function() {
            var page = $(this).attr("data-page");
            getPage(page,gid);
        })
        getPage(1,gid);
    })
    function getPage(page) {
        $.get(url_ajax, {p: page,gid:gid}, function(data) {
            $('#ajax_lists').html(data);
        })
    }
</script>
 <script type="text/javascript">
    $(document).ready(function(){
        // 商品详情、晒单切换
        $('.w_calculate_nav dd').click(function(){
            $(this).addClass('w_results_arrow').siblings().removeClass();
            $('.w_calculate_con>div').eq($(this).index()).css('display','block').siblings('div').css('display','none');
        })

        // 看了又看
        var lis_change = 0;
        $('.more_product .look .down').click(function(){
            lis_change++;
            if (lis_change > 2) {
                lis_change = 2;
            }
            $('.more_product .look div ul').animate({top: lis_change * -97.5 + "%"},300);
        })

        $('.more_product .look .up').click(function(){
            lis_change--;
            if (lis_change < 0) {
                lis_change = 0;
            }
            $('.more_product .look div ul').animate({top: lis_change * -97.5 + "%"},300);
        })

    })
</script>
<script type="text/javascript" src="/Public/Home/static/js/common.js"></script>
<script type="text/javascript" src="/Public/Home/static/min.js/js/ajaxfunctionMain.min.js"></script>
<script type="text/javascript" src="/Public/Home/static/min.js/js/include/footer_header_new.min.js"></script>
<script type="text/javascript" src="/Public/Home/static/min.js/js/goods/timeline.min.js"></script>
<script type="text/javascript" src="/Public/Home/static/min.js/js/goods/goods_details_online.min.js"></script>
<script src="/Public/Admin/javascripts/layer/layer.js"></script>
<script src="/Public/Admin/javascripts/JValidator.js"></script> 
<!-- 引入底部 -->
<?php
$menu = M("menu")->where(['state'=>2])->where('id != 123')->order('sort asc,id asc')->select(); $tree = $this->getTreeArc($menu,0); ?>
<div class="footer_change" >
      <div class="footer">
        <div class="abc">
          <ul class="footerIn">
          <li>
            <span></span>
            <p>100%公平公正公开</p>
          </li>
          <li>
            <span></span>
            <p>100%品质保障</p>
          </li>
          <li>
            <span></span>
            <p>全国急速</p>
          </li>
          <li>
            <span></span>
            <p>100%权益保障</p>
          </li>
        </ul>
        </div>
        <div class="yFootSupport">
          <div class="yFootSupport_in">
            <!-- <?php if(is_array($tree)): $i = 0; $__LIST__ = $tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><dl>
              <dt><?php echo ($list["name"]); ?></dt>
                <?php if(is_array($list["pid"])): $key = 0; $__LIST__ = $list["pid"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($key % 2 );++$key;?><dd><a href="<?php echo U('Help/help',['p'=>$list['id'],'m'=>$v['id']]);?>" target="_blank"><?php echo ($v["name"]); ?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?>  
            </dl><?php endforeach; endif; else: echo "" ;endif; ?> -->
            
            <dl class="dl_Time">
              <dd title="服务热线" style="background:url(/Public/Home/static/img/front/index/phone.png) no-repeat 0px 5px;margin-top: 29px;color:red;">客服:13313433197</dd>
              <dd title="服务器时间" style="background:url(/Public/Home/static/img/front/index/time.png) no-repeat 0px 6px;background-size:21px;margin-top: 15px;color:red;" class="sysTime">时间:09:00至18:00</dd>
            </dl>
            <dl class="dlLast">
              <a href="javascript:void(0);">
                <dd class="dlLast-WeChat">
                  <div class="y-popover">
                    <span class="y-arrow"></span>
                    <b>客服微信</b>
                    <img src="/<?php echo $_SESSION['sc']['infor']['weixinlogo']?>" alt="">
                  </div>
                </dd>
              </a>
              <!-- 
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
              </a> -->
            </dl>
          </div>
          <div class="footer-time-list" id="pageEnd">
            <div class="yFootBottomIn" style="clear: both;">
                <p>友情链接：
                  <a target="_blank" href="https://www.wanht.net/">万花筒</a>
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
<!--               <a  class="x_newadd_aBox" href="#">
              </a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- 引入底部 -->
<!-- 引入底部 -->
<script>
function CartOrder(){
    var a = $("#mid").val();
    var b = $("#sta").val();
    if(null != a && "" != a){
        if(b == '2'){//账号处于激活状态
            window.location.href="<?php echo U('Cart/cart');?>"; 
        }else if(b == '3'){//账号处于冻结状态
            layer.msg('账号处于冻结状态,请联系管理员解封',{offset: '300px',time: 2000,icon: 7});
        }
    }else{
        go2Login();
    }
}
function addCarts(a,b) {
    var url = "<?php echo U('Cart/docarts');?>";
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {id: a,num:b},
        success:function(data){
            if(data == 'ok'){
                cartCount();
            }else{
                layer.msg(data,{offset: '300px',time: 1500,icon: 2});    
            }
        }
    });
}
function cartCount() {
    var url = "<?php echo U('Cart/cartCount');?>";
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: '',
        success:function(data){
            if(data > 0){
                $("#cartCount").html(data);
                $("#cartCount").addClass("num-rt");
                $("#row").html(data);
            }else{
                $("#cartCount").html("");
            }
        }
    });
}
/**
 * 跳转到结算页面
 */
function gotoCartOrder(k){
    var a = $("#mid").val();
    var b = $("#sta").val();
    var c = $("#buyNum").val();
    // 创建一个示例数据
    // 使用 JSON.stringify 转换为 JSON 字符串
    // 然后使用 sessionStorage 保存在 buyNum 名称里
    var d=[];
    d.push({gid: k,buyNum: c });
    sessionStorage.setItem("buyNum",JSON.stringify(d));
    sessionStorage.setItem("buyType",1);
    if(null != a && "" != a){
        if(b == '2'){//账号处于激活状态
            window.location.href = "<?php echo U('Order/confirm_order');?>";
        }else if(b == '3'){//账号处于冻结状态
            layer.msg('账号处于冻结状态,请联系管理员解封',{offset: '300px',time: 2000,icon: 7});
        }
    }else{
        go2Login();
    }
}

</script>
</body>
</html>