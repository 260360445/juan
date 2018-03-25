$(function(){
	//中奖名单滚动 
    var content_three = document.getElementById("c_record_con");  
    var list_copy = document.getElementById("list_copy");  
    var list_all = document.getElementById("list_all");  
    move(content_three,list_all,list_copy,40);
    loadData();
})
 function move(boxs,uls,copy,speed){
	    copy.innerHTML = uls.innerHTML + uls.innerHTML;
	    function Marquee() {  
	        if (copy.offsetTop - boxs.scrollTop <= 0)  
	            boxs.scrollTop -= uls.offsetHeight  
	        else {  
	            boxs.scrollTop++  
	        }  
	    }  
	    var MyMar = setInterval(Marquee, speed)  
	    boxs.onmouseover = function() { clearInterval(MyMar) }  
	    boxs.onmouseout = function() { MyMar = setInterval(Marquee, speed) } 
    }
function loadData(){
	$.ajax({
		type: "post",
		url: "/rebate/rebateDate.do?randomTime=" + (new Date()).getTime(),
		dataType:'json',
		success:function(json){
			bindData(json);
		}
	});
}
function bindData(json){
	var str = '';
	$('#sum').html(json.sum)
	$('#brokerageKey').html(json.brokerageKey*100+'<sub>%</sub>')
	$('#total').html(json.total)
	if(json.hasLogin){
		$('.c_money_record').show();
		$('.nologin').hide();
		$('.login').show();
		$('.c_login_money').html((json.myBrokerageSum)+"<sub>元</sub>");
		if(!json.list||json.list.length==0){
			str='<span style="text-align:center; font-size: 30px;color:#fff;height:180px;line-height:150px">您还没有好友充值哦，快去邀请好友吧</span>';
		}
		if(json.list){
			for(var i =0;i<json.list.length;i++){
				str+='';
				str+='<li>';
				str+='<span>'+json.list[i].inviteMember.mobile.substr(0,3)+'****'+json.list[i].inviteMember.mobile.substr(7,4)+'</span>';
				str+='<p>充值<i>'+json.list[i].money+'</i>元</p>';
				str+='</li>';
			}
		}
	}else{
		$('.c_money_record').hide();
		$('.login').hide();
		$('.nologin').show();
		if(json.list){
			for(var i =0;i<json.list.length;i++){
				str+='';
				str+='<li>';
				str+='<span>'+json.list[i].mobile.substr(0,3)+'****'+json.list[i].mobile.substr(7,4)+'</span>';
				str+='<p>已获得返现<i>'+json.list[i].rebate+'</i>元</p>';
				str+='</li>';
			}
		}
	}
	$('#list_all').html(str);
}