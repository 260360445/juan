<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="UTF-8">
<meta name="keywords" content="<?php echo $_SESSION['sc']['infor']['keywords']?>">
<meta name="description" content="<?php echo $_SESSION['sc']['infor']['description']?>">
<link rel="shortcut icon" href="/<?php echo $_SESSION['sc']['infor']['ico']?>" type="image/x-icon" /> 
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE = edge">
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/comm.min.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/footer_header.min.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/index.min.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/new_join.min.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/login_box/login_box.min.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/goods.min.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/new_index.min.css"></link>
<script type="text/javascript" src="/Public/Home/static/js/uaredirect.js"></script>
<link rel="stylesheet" href="/Public/Home/static/userCenter/css/forgetPwd.css"/>
<link rel="stylesheet" href="/Public/Home/static/userCenter/css/login.css"/>
<link rel="stylesheet" href="/Public/Home/static/css/front/login_box/login_box.css"/>
<link rel="stylesheet" href="/Public/Home/static/userCenter/css/registerNew.css"/>

<title>万花筒_离梦想最近的地方</title>
<script type="text/javascript">
	//uaredirect("/wap.php/Home/Index/index","");
</script>
<style>
	
	body{
		background: #f5f5f5;
	}
	.module_loading {
		width: 1208px;
		height: 418px;
		text-align: center;
	}

	.news_loading {
		width: 368px;
		height: 376px;
		text-align: center;
	}

	.expose_loading {
		width: 771px;
		height: 411px;
		text-align: center;
		border: 1px solid #ddd;
	}

	.addtime_loading {
		width: 1208px;
		height: 581px;
		text-align: center;
		border: 1px solid #ddd;
	}
	.x_addtime_loading{
		border:none;
	}
	/*2015 9 16*/
	.yConNew ul {
		width: 1211px;
	}

	.y_new_index_Center {
		height: 720px;
	}

	.y_new_index_Center .yConCenterIn {
		height: 655px;
	}
	.y_new_index_Center .w_goods_one {
		width: 1210px;
	}
	.y_new_index_Center .yConCenterInList {
		height: 655px;
	}

	.y_new_index_Center .w_goods_details {
		height: 290px;
	}

	/* 2015 12 21 */
	.yCon h2 {
		margin-top: 0px;
		padding-top: 15px;
	}

	.header2 #ww_span {
		background: url(/Public/Home/static/img/front/index/newyear_2016/yuandan2_2016.jpg)
		no-repeat left bottom;
		display: block;
		width: 260px;
		height: 40px;
		background-size: 260px;
		position: absolute;
		left: -14px;
		bottom: 0px;
	}

/*  .sd_yContent {
background: url(/static/img/front/index/newyear_2016/yuandan_2016.jpg)
	no-repeat center 0px;
}  */
/*S 底部浮条样式   2015-12-28*/
.w_bottomImg {
	position: fixed;
	bottom: 0px;
	left: 0px;
	width: 100%;
	height: 147px;
	background: url(/Public/Home/static/img/front/index/bimg.png) no-repeat center 0;
	z-index: 5;
}

.w_bottomGif {
	width: 1200px;
	height: 100%;
	margin: 0px auto;
	position: relative;
}

.w_bottomGif img {
	position: absolute;
	top: -64px;
	left: 200px;
}

.w_bottomGif .w_closs {
	width: 60px;
	height: 60px;
	background: #000;
	filter: alpha(opacity = 50);
	-moz-opacity: 0.5;
	-khtml-opacity: 0.5;
	opacity: 0.5;
	position: absolute;
	right: -4px;
	top: -60px;
}

.w_closs span {
	display: block;
	width: 40px;
	height: 40px;
	background: url(/Public/Home/static/img/front/index/closs.png) no-repeat center
	center;
	margin: 10px;
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
/*S 2015-12-1 新增  */
body{min-width: 1210px;}
/*E 2015-12-1 新增  */
.yConNew dl.yTimesDl .yddName, dl.yTimesDl .yGray{
	text-align: center;
}
.yConNew ul li.yTimesLi{
	border: 1px solid #fff;
}
#newGoodsList .w_goods_three, #newGoodsList b{
	text-align: center;
}
</style>
<style type="text/css">
.Box {position: relative;}
.Box .content {width: 1200px;margin: 0 auto;}
.Box h2 {text-align: center;margin-bottom: 35px;padding-top: 250px;}
.Box .Box_con {position: relative;}
.Box .Box_con .conbox {position: relative;overflow: hidden;}
.Box .Box_con .conbox ul {position: relative;list-style: none;}
.Box .Box_con .conbox ul li {float: left;width: 180px;height: 255px;margin-left: 20px;overflow: hidden;}
/*	.Box .Box_con .conbox ul li:first-child {margin-left: 0;}*/
.Box .Box_con .conbox ul li .aa{width: 180px;height: 200px;overflow: hidden;}
.Box .Box_con .conbox ul li img {display: block;width: 180px;height: 200px;transition: all 0.5s;}
.Box .Box_con .conbox ul li:hover img {transform: scale(1.1);height: 200px;}

.Box .BoxSwitch {margin-top: 30px;text-align: center;}
.Box .BoxSwitch span {display: inline-block;*display: inline;*zoom: 1;vertical-align: middle;width: 30px;height: 3px;background: #ccc;margin: 0 5px;cursor: pointer;}
.Box .BoxSwitch span.cur {background: red;}


.sk_item_name{
position: relative;
top: 4px;
left: 0px;
width: 160px;
padding: 0 15px;
line-height: 30px;
-o-text-overflow: ellipsis;
text-overflow: ellipsis;
overflow: hidden;
white-space: nowrap;
}
.sk_item_price{
	position: relative;
	left: 0;
	top: 2px;
	width:100%;
	height: 20px;
	padding: 1px;
	background: #e6382f;
	line-height: 20px;
}
.sk_item_price_new{
	float: left;
	width: 50%;
	height: 20px;
	text-align: center;
	color: #fff;
	font-size: 14px;
	font-weight: bold;
}
.mod_price i{
margin-right: 3px;
font-family: arial;
font-weight: 400;
font-size: 12px;
}
.sk_item_price_origin{
	float: left;
	width: 50%;
	height: 20px;
	background: #fff;
	text-align: center;
	color: #b7bcb8;
	font-size: 12px;
	border-right: 2px solid #e6382f;
	box-sizing: border-box;
}
.sd_yContent .Box .content .conbox img.ad{
display: block;
float: left;
width:200px;
height: 255px;
cursor: pointer;
}
.pullDownList li{
	position: static;
}

.por{
	position: absolute;
	width: 400px;
	height: 450px;
	left: 240px;
	top: -50px;
	padding: 20px;
	box-sizing: border-box;
	display: none;
	background: rgba(0,0,0,.5);
}
.por h3{
	padding-bottom: 10px;
}
.por a{
	line-height: 30px;
	color: #fff;
}

.pullDownList li span{
	position: static;
	float: right;
	margin: 20px 20px 0 0;
}
.w_goods_details.x_goods_classfix_img{
	width: 303.2px;
}
.w_goods_details{
	width: 266.2px;
}
#newGoodsList .w_goods_details{
	width: 265.2px;
}
</style>
</head>
<body onselectstart='return false'>
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
	<div style="clear:both;"></div>
	<div class="yNavIndexOut">
		<div class="yNavIndex">
			<div class="pullDown" style="">
				<h4 class="pullDownTitle" style="color: #fff;font-size: 16px;display: block;">所有商品分类</h4>
				<ul class="pullDownList" style="display: block;">
				<!-- <li class=""><i></i>
					<a href="#">商品分类</a><span></span>
					<div class="por">
				        <h3>商品分类1111</h3>
				        <a href="#">11111111</a>
				        <a href="#">11111111</a>
				        <a href="#">11111111</a>
				        <a href="#">11111111</a>
				        <a href="#">11111111</a>
				    </div>
				</li> -->
				<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li class=""><i></i><a href="<?php echo U('Good/allgood',['id'=>$list['goods_class_id']]);?>"><?php echo ($list["name"]); ?></a><span></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
	</div>
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
	<!-- 引入左侧 -->

	<!--E 2015 11 21 -->
	<input type="hidden" id="mid" value="<?php echo $_SESSION['sc']['id']?>"/>
	<input type="hidden" id="sta" value="<?php echo $_SESSION['sc']['status']?>"/>
	
	<div class="a_world_bg" style="z-index:1011"></div>
<span id="index" style="display: none">index</span>
<div class="yBanner">
	<div id="banner" class="flexslider">
		<ul class="slides">	
			<?php if(is_array($ban)): $i = 0; $__LIST__ = $ban;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
					<div onclick="window.location='<?php echo ($item['url']); ?>'" class="img" style="background:url(/<?php echo ($item['logo']); ?>) no-repeat center 0px;"></div>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
			
		</ul>
	</div>
</div>
<div class="yscroll_list">
	<div class="yscroll_listin">
		<span><i></i><a href="" target="_blank">最新动态：</a></span>
		<ul class="yscroll_list_left">
		<li><p class="yscrollfont"><a href="" title="">关于国庆节工作安排公告</a></p><p class="yscrolltime">2016/09/29</p></li>
		<li><p class="yscrollfont"><a href="" title="">关于近期网站公告</a></p><p class="yscrolltime">2016/09/19</p></li>
		</ul>
		<ul class="yscroll_list_right">
			<a href="" target="_blank"><span></span><em>更多</em></a>
		</ul>
	</div>
</div>
<div class="sd_yContent">
	<div class="yContent">
		<div class="yConNew yCon" style="position: relative;">
			<!--E sd2015 -->
			<h2 class="x_left_line">
				<a href="<?php echo U('Good/specialSale');?>" class="yMoreLink" id="topMore" target="_blank">更多<em></em></a>
			</h2>
		</div>
		<div class="Box">
    	<div class="content">
    		<div class="Box_con clearfix"> 			
    			<div class="conbox" id="BoxUl">
						<a href="<?php echo U('Good/specialSale');?>" class="yMoreLink" id="topMore" target="_blank"><img class="ad" src="/Public/Home/static/img/front/goods/tmhclogo.png" alt=""></a>
	    			<ul >
	    			<?php if(is_array($good_tm)): $i = 0; $__LIST__ = $good_tm;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li class="cur">
	    					<a href="<?php echo U('Good/goodlist',['id'=>$list['id']]);?>" target="_blank">
								<div class="aa">
									
									<img src="/Uploads<?php echo ($list["goods_logo"]); ?>" alt="">
								</div>
							</a>
							<p class="sk_item_name"><a href="<?php echo U('Good/goodlist',['id'=>$list['id']]);?>" target="_blank"><?php echo ($list["goods_title"]); ?></a></p>
							<div class="sk_item_price">
								<span class="mod_price sk_item_price_new"><i>￥</i><span><?php echo ($list["price"]); ?></span></span>
								<span class="mod_price sk_item_price_origin"><i>￥</i><span><?php echo ($list["xfb"]); ?></span></span>
							</div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
    				</ul>
    			</div>
    		</div>
    	</div>
    </div>
	</div>
	<div id="modules">
	<?php if(is_array($goods)): $k = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$first): $mod = ($k % 2 );++$k;?><div class="yCon yCon<?php echo ($k-1); ?> yConCenter">
			<h2>
				<i><?php echo ($k); ?>F</i><a href="" class="yCon-title" id="module_1_name" target="_blank"><?php echo ($first["name"]); ?></a>
				<a href="<?php echo U('Good/allgood',['id'=>$first['goods_class_id']]);?>" class="yMoreLink" id="module_1_more" target="_b`lank" style="top: 0px;">更多<em></em></a>
				<ul id="module_1_child_nav">
				<?php if(is_array($first["pid"])): $key = 0; $__LIST__ = $first["pid"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$second): $mod = ($key % 2 );++$key; $goods = M('goods'); $idstr[$key]=$second['goods_class_id']; $map['goods_cate_id'] = $idstr['1']; $map['sta'] = 3; $good_arr = $goods->field("id,goods_title,goods_logo,goods_cate_id,price,kucun,sell,comment,xfb")->where($map)->order('goods_time desc')->limit(7)->select(); ?>
					<li data-index="<?php echo ($k-1); ?>" data-adimg="/Uploads<?php echo ($second["pic"]); ?>" data-adimglink="<?php echo U('Good/allgood',['id'=>$first['goods_class_id'],'sonid'=>$second['goods_class_id']]);?>" data-cid="<?php echo ($first["goods_class_id"]); ?>" data-id="<?php echo ($second["goods_class_id"]); ?>">
					<?php if($key == '1'){?>
						<a href="javascript:void(0);" class="yhoversH1List"><?php echo ($second["name"]); ?></a></li>
					<?php }else{?>
						<a href="javascript:void(0);" ><?php echo ($second["name"]); ?></a></li>
					<?php } endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</h2>
			<div class="yConCenterIn" id="module_1_child_html">
				<div class="yConCenterInList" style="display: block;">
					<ul class="w_goods_one">
					<?php if(is_array($first["pid"])): $key = 0; $__LIST__ = $first["pid"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$second): $mod = ($key % 2 );++$key; if($key == '1'){?>
					<li class="w_goods_details x_goods_classfix_img" style="">
						<a href="<?php echo U('Good/allgood',['id'=>$first['goods_class_id'],'sonid'=>$second['goods_class_id']]);?>"><img src="/Uploads<?php echo ($second["pic"]); ?>"></a>
					</li>
					<?php } endforeach; endif; else: echo "" ;endif; ?>
					<!-- 循环二级分类下的商品 -->
					<?php if(is_array($good_arr)): $i = 0; $__LIST__ = $good_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="w_goods_details x_goods_details">
							<div class="w_imgOut">
								<a target="_blank" href="<?php echo U('Good/goodlist',['id'=>$vo['id']]);?>" class="w_goods_img x_action">
									<img id="img_<?php echo ($vo['id']); ?>" src="/Uploads/<?php echo ($vo["goods_logo"]); ?>"></a>
							</div>
							<a target="_blank" href="<?php echo U('Good/goodlist',['id'=>$vo['id']]);?>" class="w_goods_three"><?php echo ($vo['goods_title']); ?></a>
							<b>可用金：<span style="font-size:16px;color:#dd2726;"><?php echo ($vo["price"]); ?></span></b>
							<b>消费币：<span style="font-size:16px;color:#dd2726;"><?php echo ($vo["xfb"]); ?></span></b>
							<ul class="w_number">
								<li class="w_amount"><?php echo ($vo["sell"]); ?></li>
								<li class="w_amount"><?php echo ($vo["kucun"]); ?></li>
								<li class="w_amount"><?php echo ($vo["comment"]); ?></li>
								<li>成交</li>
								<li>库存</li>
								<li>评价</li>
							</ul> 
							<dl class="w_rob">
								<dd>
									<a href="javascript:gotoCartOrder(<?php echo ($vo['id']); ?>);" class="w_slip">立即购买</a>
									<a class="w_slip2" href="javascript:cartoon(<?php echo ($vo['id']); ?>,1)"></a>
									<input type="hidden" id="priceArea_<?php echo ($vo['id']); ?>" value="<?php echo ($vo['id']); ?>">
								</dd>
							</dl>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						<li class="w_goods_details x_goods_details" style="background:url('/Public/Home/static/img/front/goods/expect.jpg') no-repeat center 0;"></li>
					</ul>
				</div>
			</div>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>	
	</div>
</div>
<div class="yCon yCon8 yConCenter y_new_index_Center x_new_index_Center">
	<h2>
		<i>XF</i><a href="" class="yCon-title" target="_blank">新品上架</a> <a href="" class="yMoreLink" target="_blank" style="top: 0px;">更多<em></em></a>
	</h2>
	<div class="yConCenterIn">
		<div class="yConCenterInList" style="display: block;">
			<div class="addtime_loading x_addtime_loading">
				<ul class="w_goods_one" id="newGoodsList">
				<?php if(is_array($good_xp)): $i = 0; $__LIST__ = $good_xp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li class="w_goods_details">
						<div class="w_imgOut">
							<a target="_blank" href="<?php echo U('Good/goodlist',['id'=>$list['id']]);?>" class="w_goods_img x_action">
								<img style="height:220px;width:220px;" class="w_goods_three" src="/Uploads<?php echo ($list["goods_logo"]); ?>"></a>
						</div>
						<a target="_blank" href="<?php echo U('Good/goodlist',['id'=>$list['id']]);?>" class="w_goods_three">
							<?php echo ($list['goods_title']); ?>
						</a>
						<b>可用金<span style="font-size:16px;color:#dd2726;">￥ <?php echo ($list["price"]); ?></b>
						<b>消费币<span style="font-size:16px;color:#dd2726;">￥ <?php echo ($list["xfb"]); ?></b>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/Public/Home/static/js/jquery-1.11.3.js"></script>
<style>
.yFootBottomLeft  .x_newadd_aBox{
width:88px;
background:url(/Public/Home/static/images/wjhb.jpg) no-repeat center center;
}
.yFootBottomLeft  .x_newadd_aBox:hover{
background:url(/Public/Home/static/images/wj.jpg) no-repeat center center;
}
.yFootBottomLeft a.s_footer_icon{ background-position: -481px 0;}
.yFootBottomLeft a.s_footer_icon:hover{ background-position: -393px 0;}
.yFootBottomLeft a.s_footer_icon1{ background-position: -387px 0;}
.yFootBottomLeft a.s_footer_icon1:hover{ background-position: -491px 0;}
</style>
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
              <dd title="服务热线" style="background:url(/Public/Home/static/img/front/index/phone.png) no-repeat 0px 5px;margin-top: 29px;color:red;">客服:0351-6855922</dd>
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
<script type="text/javascript" src="/Public/Home/static/js/front/slider.js"></script>
<script type="text/javascript" src="/Public/Home/static/min.js/js/common.min.js"></script>
<script type="text/javascript" src="/Public/Home/static/js/ajaxfunctionMain.js"></script>
<script type="text/javascript" src="/Public/Home/static/min.js/js/include/footer_header_new.min.js"></script>
<script type="text/javascript" src="/Public/Home/static/min.js/js/index/index.min.js"></script>
<script type="text/javascript" src="/Public/Home/static/min.js/js/index/indexExt.min.js"></script>
<script type="text/javascript" src="/Public/Home/static/plugin/jquery/jquery.lazyload.min.js"></script>
<script src="/Public/Admin/javascripts/layer/layer.js"></script>
<script src="/Public/Admin/javascripts/JValidator.js"></script>
<script>
/*描述：根据条件获取商品列表
	 * 参数：param{
	 * 			size:行数，page：页数，cid：栏目ＩＤ，bid：品牌ID，q：关键字，
	 * 			order：排序方式（即将揭晓：publicTime，剩余人次：takedout 人气：periods 最新商品：addTime 价格：totalPrice_up\totalPrice_down）
	 * 			type：价格专区(几元区就传几比如10元就传10)
	 * 			baoyuan：包圆(bao_yuan)
	 * 			maxBuy：限购(maxbuy)			
	 * }
	 * 数量 callbackFun回调函数
	 * 返回值 商品列表
	 * 
	 */
$('.pullDownList>li').hover(function(){
	$(this).children('.por').css('display','block')
},function(){
    $(this).children('.por').css('display','none')
});
    
function bindRecommendGoods1(a, c) {
    var b = "";
    if (a && 0 < a.length){
    	$.each(a, function(key, e){ 
			b +='<li class="w_goods_details x_goods_details">';
				b +='<div class="w_imgOut">';
					b +='<a target="_blank" href="<?php echo U(MODULE_NAME."/Good/goodlist/id/'+e.id+'");?>" class="w_goods_img x_action">';
						b +='<img id="img_'+e.id+'" src="/Uploads'+e.goods_logo+'"></a>';
				b +='</div>';
				b +='<a target="_blank" href="<?php echo U(MODULE_NAME."/Good/goodlist/id/'+e.id+'");?>" class="w_goods_three">'+e.goods_title+'</a>';
				b +='<b>可用金：<span style="font-size:16;color:#dd2726;">'+e.price+'</span></b>';
                b +='<b>消费币：<span style="font-size:16;color:#dd2726;">'+e.price+'</span></b>';
				b +='<ul class="w_number">';
					b +='<li class="w_amount">'+e.sell+'</li>';
					b +='<li class="w_amount">'+e.kucun+'</li>';
					b +='<li class="w_amount">'+e.comment+'</li>';
					b +='<li>成交</li>';
					b +='<li>库存</li>';
					b +='<li>评价</li>';
				b +='</ul> ';
				b +='<dl class="w_rob">';
					b +='<dd>';
						b +='<a href="javascript:gotoCartOrder('+e.id+',1);"class="w_slip">立即购买</a>';
						b +='<a class="w_slip2" href="javascript:cartoon('+e.id+',1)"></a>';
						b +='<input type="hidden" id="priceArea_'+e.id+'" value="'+e.id+'">';
					b +='</dd>';
				b +='</dl>';
			b +='</li>';
		}); 
    }else{
        b = '\x3cli class\x3d"w_goods_details x_goods_details" style\x3d"background:url(\'/Public/Home/static/img/front/goods/expect.jpg\') no-repeat center 0;"\x3e\x3c/li\x3e';
    }
    $(".yCon" + c.index + " .w_goods_one").html($($(".yCon" + c.index + " .w_goods_one").find("li")[0]).prop("outerHTML"));
    $(".yCon" + c.index + " .w_goods_one").append(b)

}


function ajaxGoodsListTopGoods(param,callbackFun){
	var url = "<?php echo U('Good/getGoods');?>";
	$.ajax({
		type: "post",
		url: url,
		dataType:'json',
		async: false,
		data:param,
		success:function(data){
			callbackFun(data,param);
		},  
		error:function(){  
			//handlingException(r);
		} 
	});
}
$(function() {
	$('#banner').flexslider({
		animation : "slide",
		direction : "horizontal",
		easing : "swing",
		slideshowSpeed: 3500  
	});
});
function gotoCartOrder(k) {
    var a = $("#mid").val();
    var b = $("#sta").val();
    if(null != a && "" != a){
        if(b == '2'){//账号处于激活状态	
        	window.location.href="<?php echo U(MODULE_NAME.'/Good/goodlist/id/"+k+"');?>"; 
        }else if(b == '3'){//账号处于冻结状态
            layer.msg('账号处于冻结状态,请联系管理员解封',{offset: '300px',time: 2000,icon: 7});
        }
    }else{
        go2Login();
    }
}
function addCart(a) {
    var url = "<?php echo U('Cart/docart');?>";
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {id: a},
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
</script>
</body>
</html>