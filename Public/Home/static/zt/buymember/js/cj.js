(function($){
    $.fn.textSlider = function(settings){    
            settings = jQuery.extend({
                speed : "normal",
                line : 1,
                timer : 3000
            }, settings);
            return this.each(function() {
                $.fn.textSlider.scllor( $( this ), settings );
            });
        };
    $.fn.textSlider.scllor = function($this, settings){
            var ul = $("table:eq(0)",$this );
            var timerID;
            var li = ul.children().children();
            var liHight=$(li[0]).height();
            var upHeight=0-settings.line*liHight;//滚动的高度；
            var scrollUp=function(){
                ul.animate({marginTop:upHeight},settings.speed,function(){
                    for(i=0;i<settings.line;i++){
                        ul.find("tr:first",$this).appendTo(ul);
                    }
                    ul.css({marginTop:0});
                });
            };
            var autoPlay=function(){
                timerID = window.setInterval(scrollUp,settings.timer);
            };
            var autoStop = function(){
                clearInterval(timerID);
            };
            //事件绑定
            ul.hover(autoStop,autoPlay).mouseout();
    };

})(jQuery);
function check(i) {
    switch (i) {
        case 1:
            return 0;
        case 2:
            return 1;
        case 3:
            return 2;
        case 4:
            return 3;
        case 5:
            return 5;
        case 6:
            return 6;
        case 7:
            return 7;
        default :
            return 8;
    }
}
var time = 30,can_Click = true,times = 0;
var cur = 0, cur1 = 0;
$(function(){
	queryLuckList({page:1, pageSize:50}, queryLuckListBack);
	queryPrizeAjax(queryPrizeBack);
	queryMemberInfo();
		$('.Mask').height(document.documentElement.clientHeight)
	    $('.wp_icopz').css('left',((document.body.clientWidth-710)/2)+'px');
	    window.onresize = function(){
	        $('.Mask').height(document.documentElement.clientHeight)
	        $('.wp_icopz').css('left',((document.body.clientWidth-710)/2)+'px');
	    };
        $('.cj').click(function () {
            $('body').stop().animate({
                scrollTop: 900
            }, 300);
            return false;
        });
        $('.close').click(function(){
            closeBomb();
        });
        $(document).on("click", ".cjbtn", function() {
        	console.log(can_Click)
        	if (can_Click) {
                time = 30;
                cur = 0, cur1 = 0;
                $('.cjzpBox th').removeClass('cur');
                $('.cjzpBox th').eq(0).addClass('cur');
//                TODO   调用setI时传值为中奖的等级
//                setI(time,4);
                can_Click = false;
                lottery(lotteryBack);
            }
        });
        
        $(document).on("click", ".cjBtnBox img", function() {
        	window.location.href="/member_new/stockRight.do?look=1";
        });
        $(document).on("click", ".cjBtnBox .Login", function() {
        	window.location.href="/api/uc/login.do?isForum=4";
        });
    });

function queryLuckList(param, callbackFun) {
	$.ajax({
		url:'/activity/lotteryList.do?t='+ Math.random(),
		type:'post',
		dataType:"json",
		async: false,
		data:param,
		success : function(data){
			callbackFun(data);
		},  
		error:function(){  
			handlingException(r);
		} 
	});
}

function queryLuckListBack(data) {
	var html="";
	if(data.status) {
		if(data.luckDrawList && data.luckDrawList.length>0) {
			for(var i=0;i<data.luckDrawList.length;i++) {
				html+="<tr><th>"+getName(data.luckDrawList[i].nickname)+"</th>";
				html+="<th>"+data.luckDrawList[i].name+"</th>";
				html+="<th><p>"+formatDate(data.luckDrawList[i].add_time,"HH:mm:ss")+"</p><p>"+formatDate(data.luckDrawList[i].add_time,"yyyy-MM-dd")+"</p></th>";
				html+="</tr>";
			}
			$(".phbList").html(html);  
			$('.listBox').textSlider({
				speed : 1000,
                line : 1,
                timer : 2000
			});
		} else {
			$(".listBox").html("<p class='noDetial'>暂无数据~</p>");  
		}
	}
}

function queryMemberInfo() {
	$.ajax({
		url:'/activity/queryMemberInfo.do?t='+ Math.random(),
		type:'post',
		dataType:"json",
		async: false,
		success : function(data){
			if(data.status) {
				$(".myMsg").hide();
				$(".no").show();
				$(".LoginOrNum").show();
				$(".unLogin").hide();
				$(".Login").hide();
				$("#memberName").html(data.nickname);
				$("#memberLevel").html(data.levelName?data.levelName:"普通会员");
				$(".LoginOrNum i").html(data.lotteryNumber);
			} else {
				$(".myMsg").hide();
				$(".yes").show();
				$(".unLogin").show();
				$(".LoginOrNum").hide();
				$(".Login").show();
			}
		},  
		error:function(){  
			handlingException(r);
		} 
	});
}

function queryPrizeAjax(callbackFun) {
	$.ajax({
		url:'/activity/memberLotteryPrizes.do?t='+ Math.random(),
		type:'post',
		dataType:"json",
		async: false,
		success : function(data){
			callbackFun(data);
		},  
		error:function(){  
			handlingException(r);
		} 
	});
}

function queryPrizeBack(data) {
	var html="";
	if(data.status) {
		if(data.prizes && data.prizes.length > 0) {
			for(var i=0;i<data.prizes.length;i++) {
				var img = imagePath+data.prizes[i].img;
				switch (i) {
				case 0:html+="<tr><th style=\"background-image:url('"+img+"')\" class='cur'>"+data.prizes[i].name+"</th>";
					continue;
				case 1:html+="<th style=\"background-image:url('"+img+"')\">"+data.prizes[i].name+"</th>";
					continue;
				case 2:html+="<th style=\"background-image:url('"+img+"')\">"+data.prizes[i].name+"</th></tr>";
					continue;
				case 3:html+="<tr><th style=\"background-image:url('"+img+"')\">"+data.prizes[i].name+"</th>";
					continue;
				case 4:html+="<th class='cjbtn'></th><th style=\"background-image:url('"+img+"')\" class='cjbtnNext'>"+data.prizes[i].name+"</th></tr>";
					continue;
				case 5:html+="<tr><th style=\"background-image:url('"+img+"')\">"+data.prizes[i].name+"</th>";
					continue;
				case 6:html+="<th style=\"background-image:url('"+img+"')\">"+data.prizes[i].name+"</th>";
					continue;
				case 7:html+="<th style=\"background-image:url('"+img+"')\">"+data.prizes[i].name+"</th></tr>";
					continue;
				default:
					continue;
				}
			}
			$("#prizeLists").html(html);
		}
	}
}

//num 中奖的奖品index， allTime 中奖转盘转多长时间
function setI(time1,num,allTime) {
    var interval = setInterval(function () {
        times += time;
        time +=3;
        cur++;
        if (times>=allTime&&cur1==num) {
            clearInterval(interval);
            reward('获得'+$('.cjzpBox th.cur').html());
            can_Click = true;
            queryLuckList({page:1, pageSize:50}, queryLuckListBack);
    		queryMemberInfo();
        }else{
        	switch (cur){
				case 0:
					cur1 = 0;
					break;
				case 1:
					cur1 = 1;
					break;
				case 2:
					cur1 = 2;
					break;
				case 3:
					cur1 = 5;
					break;
				case 4:
					cur1 = 8;
					break;
				case 5:
					cur1 = 7;
					break;
				case 6:
					cur1 = 6;
					break;
				case 7:
					cur1 = 3;
					break;
				default:
					cur = 0;
					cur1 = 0; 
					clearInterval(interval);
	                setI(time,num,allTime);
			}
        $('.cjzpBox th').removeClass('cur');
        $('.cjzpBox th').eq(cur1).addClass('cur');
    }
      }, time1);
}

function lottery(callbackFun) {
	$.ajax({
		url:'/activity/scoreLottery.do?t='+ Math.random(),
		type:'post',
		dataType:"json",
		async: false,
		success : function(data){
			callbackFun(data);
		},  
		error:function(){  
			handlingException(r);
		} 
	});
}

function lotteryBack(data) {
	if(data.status) {
		times = 0;
		time = 30;
		setI(time,check(data.index),data.delayTime*1000);
		
	} else {
		can_Click=true;
		if(data.code=="scoreLotteryError0") {//您还没有登录，请先登录
			window.location.href="/api/uc/login.do?isForum=4";
		} else if(data.code=="scoreLotteryError1") {//您还不是会员，快去购买会员吧！
			frequency("", "您还不是会员，快去购买会员吧！");
		} else if(data.code=="lotteryError2") {//抽奖次数已用完！
			frequency();
		} else if(data.code=="lotteryError3") {//当前活动已关闭！
			frequency("当前活动已关闭！");
		} else if(data.code=="scoreLotteryError4") {//距离上次抽奖还有一段时间
			frequency("距离上次抽奖还有一段时间");
		} else if(data.code=="scoreLotteryError9" || data.code=="scoreLotteryError10") {//中奖红包缺失，请联系客服！
			frequency("中奖红包缺失，请联系客服！");
		} else {
			frequency("系统异常");
		}
	}
}

function reward(text){
    $('.rewardText').html(text);
    $('.Mask').show();
    $('.reward').show();
}
function frequency(text,text1){
	var btnTag = true;
	if(text){
		btnTag = false;
	}
    text = text ||'主人，您的免费抽奖次数已用完。';
    text1 = text1 ||'赶快购买云购全球会员免费获得抽奖机会吧！';
    $('.Mask').show();
    if(text){
        $('.frequencyText').html(text);
    }
    if(text1){
        $('.frequencyText1').html(text1);
    }
    if(btnTag){
    	$('.ljrg').show();
    }else{
    	$('.ljrg').hide();
    }
    $('.Mask').show();
    $('.frequency').show();
}
function closeBomb(){
    $('.Mask').hide();
    $('.frequency').hide();
    $('.reward').hide();
}

function getName(name){
	if(name.length>4){
		return name.substring(0,4)+'...'
	}else{
		return name
	}
}