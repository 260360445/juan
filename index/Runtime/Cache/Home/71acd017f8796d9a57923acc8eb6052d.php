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

<title>方大商城_离梦想最近的地方</title>
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
		height: auto;
	}
	.y_new_index_Center .w_goods_one {
		width: 1210px;
	}
	

	.y_new_index_Center .w_goods_details {
		height: 300px;
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
/*#newGoodsList .w_goods_three, #newGoodsList b{
	text-align: center;
}*/
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
	    width: 196px;
    margin: 0 10px 20px 0;
}
</style>
</head>
<body onselectstart='return false'>
	<!-- 引入头部 -->
	<div class="header header_fixed">
        <div class="header1">
            <div class="header1in">
                <ul class="headerul1 header_yytc">
                    <li><a style="padding-left:33px;" href="/"><i class="header-home"></i>方大商城首页</a></li>
                     <li><a>客服QQ：<?php echo $_SESSION['sc']['infor']['service']?></a></li>
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
                    </li>
                </ul>
            </div>
        </div>
        <div class="header2_out yNavIndexOut_fixed">
            <div class="header2 header2_yytc">
                <a href="/" class="header_logo"><img src="/<?php echo ($_SESSION['sc']['infor']['logo']); ?>"></a>
                <ul id="yMenuIndex" class="yMenuIndex">
                    <li><a href="/" class="yMenua">首页</a></li>
                    <li><a href="<?php echo U('Good/allgood');?>">领卷优惠直播</a></li>
                    <li><a href="<?php echo U('Good/specialsale');?>">咚咚抢</a></li>
                    <li><a href="<?php echo U('Good/popularity');?>">超级人气榜</a></li>
                    <li><a href="<?php echo U('Good/newgood');?>">9块9包邮</a></li>
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
				<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li class=""><i></i><a href="<?php echo U('Good/allgood',['id'=>$list['goods_class_id']]);?>"><?php echo ($list["name"]); ?></a><span></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
	</div>
	<!-- 引入左侧 -->
		<style type="text/css">
.r-fixed{
  bottom: 140px;
}
</style>
<div class="r-fixed" style="visibility: hidden;">
        <ul class="r-fixed-nav">
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
<style type="text/css">
.discount{
	    width: 1200px;
    margin: 0 auto;
}
.discount .dis_product .pro_detail{
	height: 272px;
    width: 582px;
    margin-bottom: 20px;
    display: inline-block;
    border: 1px solid #eee;
    background-color: #fffcfd;
}
.discount .dis_product .pro_detail .pro_intro{
	    width: 290px;
    margin: 26px 0 26px 20px;
}
.discount .dis_product .pro_detail .pro_intro .pro_title{
	    font-size: 15px;
    padding: 0 15px 0 0;
    height: 70px;
    overflow: hidden;
}
.discount .dis_product .pro_detail .pro_intro .pro_title a{
	    color: #787878;
	        font-size: 16px;
}
.discount .dis_product .pro_detail .pro_intro .pro_price{
	font-size: 14px;
    margin-top: 6px;
    position: relative;
    overflow: hidden;
    height: 26px;
}
.discount .dis_product .pro_detail .pro_intro .pro_price .coupon{
	position: relative;
    left: 0;
    font: 12px Simsun;
    text-align: center;
    background: #dd2726;
    color: #fff;
    height: 24px;
    line-height: 24px;
    padding: 0 8px;
    margin: 0 10px 0 0;
    border: 1px dotted #ff0060;
    float: left;
    border-left: none;
    border-right: none;
}
.theme-color-4{
	    color: #FE4A65!important;
}
.discount .dis_product .pro_detail .pro_intro .pro_price .coupon b{
	    font-size: 14px;
    font-family: "Microsoft Yahei";
    float: right;
    position: relative;
}
.discount .dis_product .pro_detail .pro_intro .pro_price .out-time{
	    margin-top: 4px;
    height: 16px;
    line-height: 29px;
    color: #fc7e91;
    padding-right: 5px;
}
.discount .dis_product .pro_detail .pro_intro .residue{
	    margin-top: 10px;
    font-size: 12px;
    color: #333;
}
.discount .dis_product .pro_detail .pro_intro .residue i{
	padding: 0 5px;
    color: #dd2726;
    font-size: 14px;
    font-weight: 700;
    font-family: Arial;
}
 .discount .dis_product .pro_detail .pro_intro .pro_nowPri{
	    background-color: #dd2726;
    color: #fff;
    font-size: 15px;
    margin-top: 35px;
    width: 100%;
    height: 50px;
    line-height: 50px;
    position: relative;
    display: block;
}
.discount .dis_product .pro_detail .pro_intro .pro_nowPri .buy-price{
	    font: 36px/50px Arial;
    font-weight: 700;
    padding-left: 15px;
    float: left;
}
.discount .dis_product .pro_detail .pro_intro .pro_nowPri .old-price{
	    float: left;
    height: 30px;
    margin: 10px 0 10px 10px;
    text-align: left;
}
.discount .dis_product .pro_detail .pro_intro .pro_nowPri .old-price p{
	    display: block;
    height: 16px;
    margin: 0;
    padding: 0;
    color: #fef181;
    line-height: 16px;
    text-decoration: line-through;
}
.discount .dis_product .pro_detail .pro_intro .pro_nowPri .old-price span{
	    display: block;
    height: 12px;
    font: 12px/12px "Microsoft Yahei";
    color: #fff;
}
.discount .dis_product .pro_detail .pro_intro .pro_nowPri .go-buy{
	    position: absolute;
    right: 0;
    background: -webkit-gradient(linear,0 0,right 0,from(#fef490),to(#fee44d));
    width: 80px;
    font-size: 16px;
    text-align: center;
    font-family: "Microsoft Yahei";
}
.discount .dis_product .pro_detail .pro_intro .pro_nowPri{
	    background-color: #dd2726;
    color: #fff;
    font-size: 15px;
    margin-top: 35px;
    width: 100%;
    height: 50px;
    line-height: 50px;
    position: relative;
    display: block;
}
.discount .dis_product .pro_detail .pro_intro .pro_nowPri .go-buy a{
	color: #f61d5a;
    display: block;
}
.discount .dis_product .fr{
	    float: right;
}
.discount .dis_product .pro_detail:hover{
	border: 1px solid #dd2726;
}
.go-buy .theme-color-1::after{
	position: absolute;
    display: block;
    content: "";
    top: 0;
    left: -12px;
    border-top: 25px solid transparent;
    border-bottom: 25px solid transparent;
    border-right: 12px solid #fef490;
    width: 0;
    height: 0;
}
.price{
	overflow: hidden;
}
.price h4{
	float: left;
	font-size: 12px;
	color: #ff0060;
	line-height: 22px;
}
.price h4 span{
	font-size: 16px;
}
.w_goods_details .price p{
	float: right;
	font-size: 12px;
	color: #ff0060;
	border: 1px dashed #ff0060;
	padding: 0 5px;
	line-height: 22px;
}
.w_goods_details .xiaoliang{
	overflow: hidden;
	margin-top: 10px;
}
.w_goods_details .xiaoliang h4{
	float: left;
	font-size: 12px;
	color: #787878;
}
.w_goods_details .xiaoliang h4 span{
	color: #fc903d;
	margin-left: 5px;
	line-height: 22px;
}
.w_goods_details .xiaoliang img{
	float: right;
	width: 16px;
	height: 16px;
	margin: 3px 0 0 5px;
}
</style>
<div class="sd_yContent">
	<div class="yContent">
		<div class="yConNew yCon" style="position: relative;">
			<!--E sd2015 -->
			<h2 class="x_left_line">
				<i>1F</i><a href="javascript:void(0)" class="yCon-title" id="module_1_name">领券秒杀精选</a>
				<a href="javascript:void(0)"  style="top: 0px;color: #f61d5a;padding-left: 10px;font-size: 12px;">实时更新\独享优惠券<em></em></a>
			</h2>
		</div>
		<div class="discount">
        <!-- 领券优惠头部-->
        
        <!--领券优惠商品-->
        <div class="dis_product">
            <!-- 商品-->
            <div class="theme-hover-border-color-1 pro_detail addLeft" >
                <a rel="nofollow" data-gid="6358817" data-ci="301963" data-in="1" data-uid="820138" data-cn="20" href="/index.php?r=l/d&amp;id=6358817&amp;u=820138" biz-itemid="41699747788" isconvert="1" target="_blank">
                    <img src="http://img.alicdn.com/imgextra/i1/64752412/TB2bwekhbBmpuFjSZFuXXaG_XXa_!!64752412.jpg_310x310.jpg" height="272" style="border: 0;max-width:272px;">
                </a>
                <div class="pro_intro fr" >
                    <p class="pro_title">
                        <a href="/index.php?r=l/d&amp;id=6358817&amp;u=820138" rel="nofollow" target="_blank" biz-itemid="41699747788" isconvert="1" title="【天天特价】韩版高弹力黑色橡皮筋 DIY发绳打底发圈发绳约100根" style="font-size: 16px;" data-gid="6358817" data-ci="301963" data-in="1" data-uid="820138" data-cn="20">【天天特价】韩版高弹力黑色橡皮筋 DIY发绳打底发圈发绳约100根</a>
                    </p>
                    <div class="pro_price color_p">
                        <span class="coupon theme-bg-color-9 theme-color-1 theme-border-color-1">券<b><i>￥</i>3</b></span>
                        <div class="out-time theme-color-4" data-goodsid="41699747788" data-seller="64752412">店铺名称：陶子饰品批发商城</div>
                    </div>
                                                    <div class="residue">优惠券总数<i class="color_p theme-color-1">5000</i>张</div>
                    
                    <div class="pro_nowPri theme-bg-color-1">
                        <div class="buy-price">9.9</div>
                        <div class="old-price">
                            <p><i>￥</i>12.9</p>
                            <span>券后价</span>
                        </div>
                        <div class="go-buy">
                            <a class="theme-color-1" data-gid="6358817" data-ci="301963" data-in="1" data-uid="820138" data-cn="20" href="/index.php?r=index/middleurl&amp;id=6358817" target="_blank">去抢购</a>

                        </div>
                    </div>
                </div>
            </div>

                
                    <div class="theme-hover-border-color-1 pro_detail fr">

                        <a rel="nofollow" data-gid="6281762" data-ci="300025" data-in="1" data-uid="820138" data-cn="20" href="/index.php?r=l/d&amp;id=6281762&amp;u=820138" biz-itemid="13610177464" isconvert="1" target="_blank">
                            <img src="https://img.alicdn.com/imgextra/i3/2255795767/TB22Tu6a6gy_uJjSZSgXXbz0XXa_!!2255795767.jpg_310x310.jpg" height="272" style="border: 0;max-width:272px;">
                        </a>
                        <div class="pro_intro fr">
                            <p class="pro_title">
                                <a href="/index.php?r=l/d&amp;id=6281762&amp;u=820138" rel="nofollow" target="_blank" biz-itemid="13610177464" isconvert="1" title="唇刷 金属便携伸缩口红刷 唇膏唇彩刷 带盖迷你化妆刷唇笔刷 款" style="font-size: 16px;" data-gid="6281762" data-ci="300025" data-in="1" data-uid="820138" data-cn="20">唇刷 金属便携伸缩口红刷 唇膏唇彩刷 带盖迷你化妆刷唇笔刷 款</a>
                            </p>
                            <div class="pro_price color_p">
                                <span class="coupon theme-bg-color-9 theme-color-1 theme-border-color-1">券<b><i>￥</i>10</b></span>
                                <div class="out-time theme-color-4" data-goodsid="13610177464" data-seller="784497909">店铺名称：zoreya旗舰店</div>
                            </div>
                                                            <div class="residue">优惠券总数<i class="color_p theme-color-1">60000</i>张</div>
                            
                            <div class="pro_nowPri theme-bg-color-1">
                                <div class="buy-price">5.9</div>
                                <div class="old-price">
                                    <p><i>￥</i>15.9</p>
                                    <span>券后价</span>
                                </div>
                                <div class="go-buy">
                                    <a class="theme-color-1" data-gid="6281762" data-ci="300025" data-in="1" data-uid="820138" data-cn="20" href="/index.php?r=index/middleurl&amp;id=6281762" target="_blank">去抢购</a>
                                </div>
                            </div>
                        </div>
                        <em class="border_l_b border"></em>
                        <em class="border_l_t border"></em>
                        <em class="border_r_b border"></em>
                        <em class="border_r_t border"></em>
                    </div>

                
                    <div class="theme-hover-border-color-1 pro_detail addLeft">

                        <a rel="nofollow" data-gid="6336701" data-ci="300358" data-in="1" data-uid="820138" data-cn="20" href="/index.php?r=l/d&amp;id=6336701&amp;u=820138" biz-itemid="542034018863" isconvert="1" target="_blank">
                            <img src="https://img.alicdn.com/imgextra/i4/784497909/TB24eSOhS7PL1JjSZFHXXcciXXa_!!784497909.jpg_310x310.jpg" height="272" style="border: 0;max-width:272px;">
                        </a>
                        <div class="pro_intro fr">
                            <p class="pro_title">
                                <a href="/index.php?r=l/d&amp;id=6336701&amp;u=820138" rel="nofollow" target="_blank" biz-itemid="542034018863" isconvert="1" title="睫毛夹初学者卷翘夹睫毛器卷翘迷你持久便携不夹眼皮化妆睫毛工具" style="font-size: 16px;" data-gid="6336701" data-ci="300358" data-in="1" data-uid="820138" data-cn="20">睫毛夹初学者卷翘夹睫毛器卷翘迷你持久便携不夹眼皮化妆睫毛工具</a>
                            </p>
                            <div class="pro_price color_p">
                                <span class="coupon theme-bg-color-9 theme-color-1 theme-border-color-1">券<b><i>￥</i>5</b></span>
                                <div class="out-time theme-color-4" data-goodsid="542034018863" data-seller="784497909">店铺名称：zoreya旗舰店</div>
                            </div>
                                                            <div class="residue">优惠券总数<i class="color_p theme-color-1">80000</i>张</div>
                            
                            <div class="pro_nowPri theme-bg-color-1">
                                <div class="buy-price">4.9</div>
                                <div class="old-price">
                                    <p><i>￥</i>9.9</p>
                                    <span>券后价</span>
                                </div>
                                <div class="go-buy">
                                    <a class="theme-color-1" data-gid="6336701" data-ci="300358" data-in="1" data-uid="820138" data-cn="20" href="/index.php?r=index/middleurl&amp;id=6336701" target="_blank">去抢购</a>
                                </div>
                            </div>
                        </div>
                        <em class="border_l_b border"></em>
                        <em class="border_l_t border"></em>
                        <em class="border_r_b border"></em>
                        <em class="border_r_t border"></em>
                    </div>

                
                    <div class="theme-hover-border-color-1 pro_detail fr">

                        <a rel="nofollow" data-gid="6474377" data-ci="307879" data-in="1" data-uid="820138" data-cn="20" href="/index.php?r=l/d&amp;id=6474377&amp;u=820138" biz-itemid="557414944379" isconvert="1" target="_blank">
                            <img src="https://img.alicdn.com/imgextra/i2/3216583513/TB2i11bXEUIL1JjSZFrXXb3xFXa_!!3216583513.jpg_310x310.jpg" height="272" style="border: 0;max-width:272px;">
                        </a>
                        <div class="pro_intro fr">
                            <p class="pro_title">
                                <a href="/index.php?r=l/d&amp;id=6474377&amp;u=820138" rel="nofollow" target="_blank" biz-itemid="557414944379" isconvert="1" title="159素食全餐代餐粉正品官网佐五谷杂粮丹粗食品力膳食能量辟谷餐" style="font-size: 16px;" data-gid="6474377" data-ci="307879" data-in="1" data-uid="820138" data-cn="20">159素食全餐代餐粉正品官网佐五谷杂粮丹粗食品力膳食能量辟谷餐</a>
                            </p>
                            <div class="pro_price color_p">
                                <span class="coupon theme-bg-color-9 theme-color-1 theme-border-color-1">券<b><i>￥</i>60</b></span>
                                <div class="out-time theme-color-4" data-goodsid="557414944379" data-seller="3216583513">店铺名称：禹府旗舰店</div>
                            </div>
                                                            <div class="residue">优惠券总数<i class="color_p theme-color-1">30000</i>张</div>
                            
                            <div class="pro_nowPri theme-bg-color-1">
                                <div class="buy-price">19</div>
                                <div class="old-price">
                                    <p><i>￥</i>79</p>
                                    <span>券后价</span>
                                </div>
                                <div class="go-buy">
                                    <a class="theme-color-1" data-gid="6474377" data-ci="307879" data-in="1" data-uid="820138" data-cn="20" href="/index.php?r=index/middleurl&amp;id=6474377" target="_blank">去抢购</a>
                                </div>
                            </div>
                        </div>
                        <em class="border_l_b border"></em>
                        <em class="border_l_t border"></em>
                        <em class="border_r_b border"></em>
                        <em class="border_r_t border"></em>
                    </div>

                
                    <div class="theme-hover-border-color-1 pro_detail addLeft">

                        <a rel="nofollow" data-gid="6514073" data-ci="310696" data-in="1" data-uid="820138" data-cn="20" href="/index.php?r=l/d&amp;id=6514073&amp;u=820138" biz-itemid="556069789405" isconvert="1" target="_blank">
                            <img src="https://img.alicdn.com/imgextra/i1/2099783878/TB2WX1neNOMSKJjSZFlXXXqQFXa_!!2099783878.jpg_310x310.jpg" height="272" style="border: 0;max-width:272px;">
                        </a>
                        <div class="pro_intro fr">
                            <p class="pro_title">
                                <a href="/index.php?r=l/d&amp;id=6514073&amp;u=820138" rel="nofollow" target="_blank" biz-itemid="556069789405" isconvert="1" title="美国自然兰蚕丝面膜补水保湿细嫩提亮肤色清洁收缩毛孔含EGF" style="font-size: 16px;" data-gid="6514073" data-ci="310696" data-in="1" data-uid="820138" data-cn="20">美国自然兰蚕丝面膜补水保湿细嫩提亮肤色清洁收缩毛孔含EGF</a>
                            </p>
                            <div class="pro_price color_p">
                                <span class="coupon theme-bg-color-9 theme-color-1 theme-border-color-1">券<b><i>￥</i>20</b></span>
                                <div class="out-time theme-color-4" data-goodsid="556069789405" data-seller="3365082098">店铺名称：自然兰旗舰店</div>
                            </div>
                                                            <div class="residue">优惠券总数<i class="color_p theme-color-1">10000</i>张</div>
                            
                            <div class="pro_nowPri theme-bg-color-1">
                                <div class="buy-price">78</div>
                                <div class="old-price">
                                    <p><i>￥</i>98</p>
                                    <span>券后价</span>
                                </div>
                                <div class="go-buy">
                                    <a class="theme-color-1" data-gid="6514073" data-ci="310696" data-in="1" data-uid="820138" data-cn="20" href="/index.php?r=index/middleurl&amp;id=6514073" target="_blank">去抢购</a>
                                </div>
                            </div>
                        </div>
                        <em class="border_l_b border"></em>
                        <em class="border_l_t border"></em>
                        <em class="border_r_b border"></em>
                        <em class="border_r_t border"></em>
                    </div>

                
                    <div class="theme-hover-border-color-1 pro_detail fr">

                        <a rel="nofollow" data-gid="6474263" data-ci="307981" data-in="1" data-uid="820138" data-cn="20" href="/index.php?r=l/d&amp;id=6474263&amp;u=820138" biz-itemid="43497406752" isconvert="1" target="_blank">
                            <img src="https://img.alicdn.com/imgextra/i4/2096878391/TB2gQq5XsrHK1Jjy1zdXXbTwXXa_!!2096878391.jpg_310x310.jpg" height="272" style="border: 0;max-width:272px;">
                        </a>
                        <div class="pro_intro fr">
                            <p class="pro_title">
                                <a href="/index.php?r=l/d&amp;id=6474263&amp;u=820138" rel="nofollow" target="_blank" biz-itemid="43497406752" isconvert="1" title="复青品牌菊花茶 金丝皇菊一朵一杯黄菊茶叶贡菊大朵 礼盒装花茶" style="font-size: 16px;" data-gid="6474263" data-ci="307981" data-in="1" data-uid="820138" data-cn="20">复青品牌菊花茶 金丝皇菊一朵一杯黄菊茶叶贡菊大朵 礼盒装花茶</a>
                            </p>
                            <div class="pro_price color_p">
                                <span class="coupon theme-bg-color-9 theme-color-1 theme-border-color-1">券<b><i>￥</i>5</b></span>
                                <div class="out-time theme-color-4" data-goodsid="43497406752" data-seller="2096878391">店铺名称：复青旗舰店</div>
                            </div>
                                                            <div class="residue">优惠券总数<i class="color_p theme-color-1">20000</i>张</div>
                            
                            <div class="pro_nowPri theme-bg-color-1">
                                <div class="buy-price">24.9</div>
                                <div class="old-price">
                                    <p><i>￥</i>29.9</p>
                                    <span>券后价</span>
                                </div>
                                <div class="go-buy">
                                    <a class="theme-color-1" data-gid="6474263" data-ci="307981" data-in="1" data-uid="820138" data-cn="20" href="/index.php?r=index/middleurl&amp;id=6474263" target="_blank">去抢购</a>
                                </div>
                            </div>
                        </div>
                        <em class="border_l_b border"></em>
                        <em class="border_l_t border"></em>
                        <em class="border_r_b border"></em>
                        <em class="border_r_t border"></em>
                    </div>
            </div>
    	</div>
	</div>

<div class="yCon yCon8 yConCenter y_new_index_Center x_new_index_Center">
	<h2>
		<i>2F</i><a href="" class="yCon-title" target="_blank">领券优惠直播</a> <a href="" class="yMoreLink" target="_blank" style="top: 0px;">更多<em></em></a>
	</h2>
	<div class="yConCenterIn">
		<div class="yConCenterInList" style="display: block;">
			<div class="addtime_loading x_addtime_loading">
				<ul class="w_goods_one" id="newGoodsList">
				<?php if(is_array($good_xp)): $i = 0; $__LIST__ = $good_xp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li class="w_goods_details">
						<div class="w_imgOut">
							<a target="_blank" href="<?php echo U('Good/goodlist',['id'=>$list['id']]);?>" class="w_goods_img x_action">
								<img style="height:220px;width:196px;" class="w_goods_three" src="/Uploads<?php echo ($list["goods_logo"]); ?>"></a>
						</div>
						<a target="_blank" href="<?php echo U('Good/goodlist',['id'=>$list['id']]);?>" class="w_goods_three">
							<?php echo ($list['goods_title']); ?>
						</a>
						<div class="price">
							<h4>￥<span>18.9</span>券后价</h4>
							<p>券￥15</p>
						</div>
						<div class="xiaoliang">
							<h4>销量<span>11888</span></h4>
							<img src="/Public/Home/static/img/front/11111111111111111111111111111111111111.png" alt="">
							<img src="/Public/Home/static/img/front/11111111111111111111111111111111111111.png" alt="">
						</div>
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
<style type="text/css">
.footer_change .footer .yFootSupport dl.dl_Time{
      padding-left: 195px;
}
.yFootBottomLeft{
  padding:0;
}
.footer_change .footer .yFootSupport{
  padding-bottom: 8px;
}
.yFootBottomRight{
      padding-top: 5px;
    padding-bottom: 5px;
}
.footer_change .footer .yFootSupport dl.dlLast dd{
      margin-left: 60px;
}
</style>
<div class="footer_change" >
      <div class="footer">
        
        <div class="yFootSupport" style="background:url(/Public/Home/static/img/front/index/footer_bg.jpg);">
          <div class="bt" style="font-size: 36px;font-weight: 200; color: #a9a9a9;text-align: center;padding-top: 30px;">
            “感谢有你，我们的坚持才更有意义”
        </div>
          <div class="yFootSupport_in">
            <dl class="dl_Time">
              <dd title="服务热线" style="background:url(/Public/Home/static/img/front/index/phone.png) no-repeat 0px 5px;margin-top: 29px;">400-814-0777</dd>
              <dd title="服务器时间" style="background:url(/Public/Home/static/img/front/index/time.png) no-repeat 0px 6px;background-size:21px;margin-top: 15px;" class="sysTime">00:00:00</dd>
            </dl>
            <dl class="dlLast">
              <a href="javascript:void(0);">
                <dd class="dlLast-WeChat">
                  <div class="y-popover">
                    <span class="y-arrow"></span>
                    <!-- <b>云购全球官方微信</b> -->
                    <img src="/Public/Home/static/img/front/cloud_global/fullPage/android_app.jpg" alt="">
                  </div>
                </dd>
              </a>
              <a href="javascript:void(0);">
                <dd class="dlLast-Android">
                  <div class="y-popover">
                    <span class="y-arrow"></span>
                    <!-- <b>扫二维码下载</b> -->
                    <img src="/Public/Home/static/img/front/cloud_global/fullPage/android_app.jpg" alt="">
                  </div>
                </dd>
              </a>
            </dl>
          </div>
          <div class="footer-time-list" id="pageEnd">
            <div class="yFootBottomRight">
              山西云购电子商务有限公司版权所有 © 2016 ICP证晋ICP备15005633号-1
            </div>
            <div class="yFootBottomLeft">
              <a href="http://si.trustutn.org/info?sn=836160421021216393517&certType=1" target="_blank" class="s_footer_icon"><img src="http://v.trustutn.org/images/cert/bottom_large_img.png"/></a>
              <a href="http://webscan.360.cn/index/checkwebsite/url/www.ygqq.com" class="yFootBottomLeft2" target="_blank"></a>
              <a href="http://www.itrust.org.cn/yz/pjwx.asp?wm=1325737350" target="_blank" class="yFootBottomLeft3"></a>
              <a href="http://218.26.1.108/businessPublicity.jspx?id=4FA23AC6152B1BAC3D5A1FF847D3D615" target="_blank" class="yFootBottomLeft4"></a>
              <a target="_blank" class="x_newadd_aBox" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=14019902000004">
              </a>
            </div>
          </div>
        </div>
        <div class="yFootBottom">
          <div class="yFootBottomIn" style="clear: both;">
            <p>友情链接：
              <a target="_blank" href="">大德通集团</a>
            </p>
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