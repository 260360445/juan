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
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/login_box/login_box.min.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/goods.min.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/Home/static/min.css/css/front/new_index.min.css"></link>
<script type="text/javascript" src="/Public/Home/static/js/uaredirect.js"></script>

<title>领卷卷_领卷购物 实惠 省钱</title>
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
                    <li><a style="padding-left:33px;" href="/"><i class="header-home"></i><?php echo $_SESSION['sc']['infor']['name']?>首页</a></li>
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
                                    <p style="white-space: nowrap">QQ</p>
                                    <div style="width: 100px; height: 100px; margin-left: 10px;">
                                        <img src="/<?php echo $_SESSION['sc']['infor']['qqlogo']?>" width="100" height="100" border="0" alt="">
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
				<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li class=""><i></i><a href="<?php echo U('Good/allgood',['gclass'=>$list['goods_class_id']]);?>"><?php echo ($list["name"]); ?></a><span></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
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
    margin:0 16px 20px 0;
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
				<a href="javascript:void(0)"  style="top: 0px;color: #f61d5a;padding-left: 10px;font-size: 12px;">实时更新\独享优惠券\每天10点，准时更新<em></em></a>
			</h2>
		</div>
		<div class="discount">
        <!-- 领券优惠头部-->
        <!--领券优惠商品-->
        <div class="dis_product">
            <!-- 商品-->
            <?php if(is_array($good_tm)): $i = 0; $__LIST__ = $good_tm;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="theme-hover-border-color-1 pro_detail addLeft" >
                <a rel="nofollow"  href="<?php echo U('Good/goodlist',['id'=>$list['id'],'t'=>ls]);?>" target="_blank">
                    <img src="<?php echo ($list['glogo']); ?>" height="272" style="border: 0;max-width:272px;">
                </a>
                <div class="pro_intro fr" >
                    <p class="pro_title">
                        <a href="<?php echo U('Good/goodlist',['id'=>$list['id'],'t'=>ls]);?>" rel="nofollow" target="_blank" title="<?php echo ($list['title']); ?>" style="font-size: 16px;" ><?php echo ($list['title']); ?></a>
                    </p>
                    <div class="pro_price color_p">
                        <span class="coupon theme-bg-color-9 theme-color-1 theme-border-color-1"><b><i><?php echo ($list['yhj_price']); ?></i></b></span>
                        <div class="out-time theme-color-4" data-goodsid="41699747788" data-seller="64752412">店铺名称：<?php echo ($list['store']); ?></div>
                    </div>
                    <div class="residue">优惠券总数<i class="color_p theme-color-1"><?php echo ($list['yhj_num']); ?></i>张</div>
                    <div class="pro_nowPri theme-bg-color-1">
                        <div class="buy-price">¥<?php echo ($list['price']); ?></div>
                        <div class="go-buy">
                            <a class="theme-color-1" href="<?php echo U('Good/goodlist',['id'=>$list['id'],'t'=>ls]);?>" target="_blank">去抢购</a>

                        </div>
                    </div>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    	</div>
	</div>

<div class="yCon yCon8 yConCenter y_new_index_Center x_new_index_Center">
	<h2>
		<i>2F</i><a href="" class="yCon-title" target="_blank">领券优惠直播</a> <a href="<?php echo U('Good/allgood');?>" class="yMoreLink" target="_blank" style="top: 0px;">更多<em></em></a>
	</h2>
	<div class="yConCenterIn">
		<div class="yConCenterInList" style="display: block;">
			<div class="addtime_loading x_addtime_loading">
				<ul class="w_goods_one" id="newGoodsList">
				<?php if(is_array($good)): $i = 0; $__LIST__ = $good;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li class="w_goods_details">
						<div class="w_imgOut">
							<a target="_blank" href="<?php echo U('Good/goodlist',['id'=>$list['id'],'t'=>ls]);?>" class="w_goods_img x_action">
								<img style="height:220px;width:196px;" class="w_goods_three" src="<?php echo ($list["glogo"]); ?>"></a>
						</div>
						<a target="_blank" href="<?php echo U('Good/goodlist',['id'=>$list['id'],'t'=>ls]);?>" class="w_goods_three">
							<?php echo ($list['title']); ?>
						</a>
						<div class="price">
							<h4>￥<span><?php echo ($list['price']); ?></span></h4>
							<p><?php echo ($list['yhj_price']); ?></p>
						</div>
						<div class="xiaoliang">
							<h4>销量<span><?php echo ($list['sell']); ?></span></h4>
							<!-- <img src="/Public/Home/static/img/front/11111111111111111111111111111111111111.png" alt="">
							<img src="/Public/Home/static/img/front/11111111111111111111111111111111111111.png" alt=""> -->
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
              <dd title="服务热线" style="background:url(/Public/Home/static/img/front/index/phone.png) no-repeat 0px 5px;margin-top: 29px;"><?php echo $_SESSION['sc']['infor']['service']?></dd>
              <dd title="服务器时间" style="background:url(/Public/Home/static/img/front/index/time.png) no-repeat 0px 6px;background-size:21px;margin-top: 15px;" class="sysTime" id="showTime"></dd>
            </dl>
            <script>
            setInterval(function(){
              var date = new Date();
              var h = date.getHours();
              var i = date.getMinutes();
              var s = date.getSeconds();
              document.getElementById("showTime").innerHTML = ((h=h%12)<10?'0' + h:h) + ' : ' + (i<10?'0' + i:i) + ' : ' + (s<10?'0' + s:s);
            },500);
            </script>

            <dl class="dlLast">
              <a href="javascript:void(0);">
                <dd class="dlLast-WeChat">
                  <div class="y-popover">
                    <span class="y-arrow"></span>
                    <!-- <b>云购全球官方微信</b> -->
                    <img src="/<?php echo $_SESSION['sc']['infor']['weixinlogo']?>" alt="">
                  </div>
                </dd>
              </a>
              <a href="javascript:void(0);">
                <dd class="dlLast-Android">
                  <div class="y-popover">
                    <span class="y-arrow"></span>
                    <!-- <b>扫二维码下载</b> -->
                    <img src="/<?php echo $_SESSION['sc']['infor']['qqlogo']?>" alt="">
                  </div>
                </dd>
              </a>
            </dl>
          </div>
          <div class="footer-time-list" id="pageEnd">
            <div class="yFootBottomRight">
              <?php echo $_SESSION['sc']['infor']['copyright']?>
            </div>
            <div class="yFootBottomLeft">
              <a href="javascript:void(0);" target="_blank" class="s_footer_icon"><img src="http://v.trustutn.org/images/cert/bottom_large_img.png"/></a>
              <a href="javascript:void(0);javascript:void(0);" class="yFootBottomLeft2" target="_blank"></a>
              <a href="javascript:void(0);" target="_blank" class="yFootBottomLeft3"></a>
              <a href="javascript:void(0);" target="_blank" class="yFootBottomLeft4"></a>
              <a target="_blank" class="x_newadd_aBox" href="javascript:void(0);">
              </a>
            </div>
          </div>
        </div>
        <!-- <div class="yFootBottom">
          <div class="yFootBottomIn" style="clear: both;">
            <p>友情链接：
              <a target="_blank" href=""></a>
            </p>
          </div>
        </div> -->
      </div>
    </div>
<!-- 引入底部 -->
<script type="text/javascript" src="/Public/Home/static/js/front/slider.js"></script>
<script type="text/javascript" src="/Public/Home/static/min.js/js/include/footer_header_new.min.js"></script>
<script>
$(function() {
	$('#banner').flexslider({
		animation : "slide",
		direction : "horizontal",
		easing : "swing",
		slideshowSpeed: 3500  
	});
});

</script>
</body>
</html>