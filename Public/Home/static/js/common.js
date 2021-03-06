window.imagePath = 'http://img02.ygqq.com';
var imgsize = '_200x200.png';
if(window.location.host=="ygqq-qt.dadetongkeji.net.cn"){
	window.imagePath = "http://ygqq-ht.dadetongkeji.net.cn"; //前台   （头像 、晒单）
	imgsize = ""; //首页商品列表图片大小
}
window.imageGoodsPath = window.imagePath+'/upload/goodsfile/';
window.path = window.imagePath;
var experience_activity_address ="http://www.ygqq.com/static/zt/yaoqing/index.html";//新手体验活动地址
var timeout=20000;//ajax 超时时间 
var publishTimeCycle=30000;//最新揭晓 追加周期
var publishTimes=10;//动画揭晓完成后的揭晓次数  5次后将提示 "福彩中心通讯故障~请耐心等待"
/**              
 * 获取 时分秒 毫秒 组合字符串           
 * @param <int> unixTime    待时间戳(秒)              
 * @param <bool> isFull    返回完整时间(Y-m-d 或者 Y-m-d H:i:s)              
 * @param <int>  timeZone   时区              
 */
function formatDate(date, format) {
    if (!format) format = "yyyy-MM-dd HH:mm:ss";
    date = new Date(parseInt(date));
    var dict = {
        "yyyy": date.getFullYear(),
        "M": date.getMonth() + 1,
        "d": date.getDate(),
        "H": date.getHours(),
        "m": date.getMinutes(),
        "s": date.getSeconds(),
        "S": ("" + (date.getMilliseconds() + 1000)).substr(1),
        "MM": ("" + (date.getMonth() + 101)).substr(1),
        "dd": ("" + (date.getDate() + 100)).substr(1),
        "HH": ("" + (date.getHours() + 100)).substr(1),
        "mm": ("" + (date.getMinutes() + 100)).substr(1),
        "ss": ("" + (date.getSeconds() + 100)).substr(1)
    };
    return format.replace(/(y+|M+|d+|H+|s+|m+|S)/g,
    function(a) {
        return dict[a]
    })
};

/**
 * 描述：图片延迟加载
 * 参数：tag 标识，避免已经延迟加载的图片重新执行
 * 参数：type 表示 如果为1 则tag表示图片大小
 * */
function lazyload(tag,type){
	//设置图片延迟加载  距离屏幕100像素开始加载图片
	 	$("img.lazy"+tag).lazyload({
	 		effect : "fadeIn",
	 		placeholder : type=="1"?"/static/img/front/loading_"+tag+".gif":"/static/img/front/loading_200.gif",
	 		threshold : 100
	 	});
}

/*
 * 描述：Ajax请求异常处理
 * 参数：(errorJson)系统返回错误Json
 * 返回值：无
 * */
function  handlingException(errorJson){
	
}

/*
 * 描述:云购后台返回json是否正常（验证返回结果不为空、""且状态为true
 * 参数:调用Action返回的json 结果
 * 返回值:成功为true; 失败为false;
 * */
function verification(result,isOutErrorMsg){
	 	if(result!=null&&result!=""&&typeof(result)!="undefined"&&result.status){
	 		return true;
	 	}else{
	 		if(isOutErrorMsg!=false){
	 			//dialog(result.res_msg);
	 		}
	 		return false;
	 	}
}



/*
 * 描述：Ajax请求前页面展示特效 
 * 适用对象：所有带分页的列表展示效果
 * 使用方法：列表页面添加  id="more" 和 id="loading" 的div 对象
 * */
function ajaxBeforeSendOfList() {
	if(typeof(tableId)!="undefined" && tableId!='' ){
		$(".pageStr").hide();
		if(tableId=='#brokerage_source_list_table'||tableId=='#brokerage_consume_list_table'){
			$(tableId).html("<tr><td colspan='5'><div style='width:940px;text-align: center;margin-top: 50px;'>" +
			"<img style='width:50px;height:50px'src='/static/img/loading.gif'></div></td></tr>");
		}else{
			$(tableId).html("<div style='width:940px;text-align: center;margin-top: 50px;'>" +
			"<img style='width:50px;height:50px'src='/static/img/loading.gif'></div>");
		}
	}
}

/*
 * 描述：判断是否数据为空及是否显示更多连接
 * 参数：result（数据json结果）,len(数据集合的长度) ,page（当前页） 
 * 返回值：bool ;true继续向下执行 false;直接return
 * */
function isNull(pageName,id,h,href){
		var src="";
		switch(pageName){
		    case "no_record"://该用户没有参与记录
				src="/static/img/no_record.png";
				break;
		    case "no_presell"://该用户没有参与记录
		    	src="/static/img/no_presell.png";
		    	break;
		    case "self_win"://中奖纪录
				src="/static/img/self_win.png";
				break;
		    case "no_num"://充值纪录
		    	src="/static/img/no_num.png";
		    	break;
		    case "single_self"://已晒单或未晒单
		    	src="/static/img/single_self.png";
		    	break;
		    case "no_nums"://晒单评论	
		    	src="/static/img/no_nums.png";
		    	break;
		    case "hb"://红包
		    	src="/static/img/hb.png";
		    	break;
		    case "invite_no"://邀请好友
		    	src="/static/img/invite_no.png";
		    	break;
		    case "other_num":
		    	src="/static/img/other_num.png";
		    	break;
		    case "other_win":
		    	src="/static/img/other_win.png";
		    	break;
		    case "other_presell":
		    	src="/static/img/other_presell.png";
		    	break;
		    case "single_other":
		    	src="/static/img/single_other.png";
		    	break;
		    case "brokerage_no":
		    	src="/static/img/yjjl.png";
		    	break;
		    case "no-ru":
		    	src="/static/img/no-ru.png";
		    	break;
		    case "jie_no":
		    	src="/static/img/jie_no.png";
		    	break;
			default:
				src="/static/img/function/null_data.jpg"; //暂无数据
				break;
		
		}
		 var html='<div style="text-align:center;width:948px;height:'+h+'px;padding-top:'+((h/2)+25)+'px;">';
		 if(href){
			 html+='<a href="'+href+'"  target="_blank" >'
			 html+='<img style="width:377px;height:49px;" src="'+src+'" alt="暂无数据" >';
			 html+='</a>';
		 }else{
			 html+='<img src="'+src+'" alt="暂无数据" >';
		 }
		
		 html+='</div>';
		 $("#"+id).html(html);
	
}
/*替换undefined
 * data 要替换的数据
 * */
function replaceUndefined(data){
	if(typeof(data) == "undefined"){
		return '';
	}else{
		return data;
	}
}
/**
 * 加入购物车
 * gid 商品id
 * buyTimes 次数
 * */
function addCart(a) {
	$.ajax({
        url: '/index.php/Home/Cart/docart',
        type: 'POST',
        dataType: 'json',
        data: {id: a},
        success:function(data){
            if(data == 'ok'){
                cartCount();
            }else{
                layer.msg('添加失败！',{offset: '300px',time: 1500,icon: 2});    
            }
        }
    });
}


/******************************直购购物车方法 end**********************************************/
/**
 * @description 正则提取 字符串中 数字
 * @param {String} str
 * @return {Array} 数字数组集合
 * */
function regMatchNum(str){
	 return str.match(/\d+(\.\d+)?/g)
}
/**
 * @description 正则提取 字符串中符号
 * @param {String} str
 * @return {Array} 字符数组集合
 * */
function regMatchSymbol(str){
	 return str.match(/[^\d\.]/g)
}