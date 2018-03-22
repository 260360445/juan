var aid=0;//兑换活动id 
$(function(){
	 ajaxGetTransferRedList(bindDate);
 })
 //绑定数据
 function bindDate(json){
	 if(json.account){
		 $(".noLogin").hide();
		 $(".login span").html(json.account.scoreUsable);
		 $(".login").show();
	 }
	 $(".rules").html(json.rules.join(","));
	 var str='';
	 var tr1='';
	 var tr2='';
	 for(var i=0;i<json.redActivities.length;i++){
		 var redLength = json.redActivities[i].redInfo.length;
		 var redInfo = json.redActivities[i].redInfo;
		 var redStr = '';
		 var redMoney=0;
		 for(var j=0;j<redLength;j++){
			 redMoney+=redInfo[j].redMoney*redInfo[j].total;
			 redStr+="<span>"+redInfo[j].redMoney+"元红包"+redInfo[j].total+"个</span>"
		 }
		 tr1+='<td>'+redMoney+'元</td>';
		 tr2+='<td>'+json.redActivities[i].redActivity.number+'个</td>';
		 str+='<div class="c_exchange_type">';
		 str+='<div class="c_exchange_num">';
		 str+='<span>'+redMoney+'</span>';
		 str+='</div>';
		 str+='<div class="c_exchange_details">';
		 str+='<span>'+json.redActivities[i].redActivity.title+'</span>';
		 str+='<span>消耗：'+json.redActivities[i].redActivity.score+'积分</span>';
		 str+='<div class="c_red_set classfix">';
		 str+='<i>红包配置：</i><p>'+redStr+'</p>';
		 str+='</div>';
		 if(json.account&&json.redActivities[i].redActivity.score>json.account.scoreUsable ){
			 str+='<a href="javascript:;" class="c_exchange_btn c_exchange_insufficient">积分不足</a>';
		 }else if(json.redActivities[i].outTimesFlag==0){
			 str+='<a href="javascript:setAid('+json.redActivities[i].redActivity.id+');" class="c_exchange_btn j_exchange_start">立即兑换</a>';
		 }else{
			 var index = json.rules.indexOf(json.redActivities[i].redActivity.rule);
			 if(index+1<json.rules.length){
				 str+='<a href="javascript:;" class="c_exchange_btn c_exchange_time j_exchange_end">'+json.rules[index+1]+'</a>';
			 }else{
				 str+='<a href="javascript:;" class="c_exchange_btn c_exchange_time j_exchange_end">'+json.rules[0]+'</a>';
			 }
		 }
		 str+='</div>';
		 str+='</div>';
	 }
	 $(".c_exchange_redBox").html(str);
	 $("#tr1").append(tr1);
	 $("#tr2").append(tr2);
	  $(".j_exchange_start").click(function(){
          $(".j_true_exchange1").show();
          $(".j_exchange_window").show();
       });
 }
 
 
 function ajaxGetTransferRedList(bindDate){
		$.ajax({
			type: "post",
			dataType: "json",
			cache: true,
			url:"/scoreConvert/getTransferRedList.do",
			success: function(result) {
				bindDate(result);//调用回调函数 传输json结果
			},
			error: function(r) {
			} //错误处理
		});

 }
 function scoreTransferRed(){
	 $.ajax({
			type: "post",
			dataType: "json",
			cache: true,
			data:{aid:aid},
			url:"/scoreConvert/scoreTransferRed.do",
			success: function(result) {
				if(result.status){
					$('.j_true_exchange3').show();
				}else{
					ajaxGetTransferRedList(bindDate);
					switch (result.code) {
					case '1101':
						$('.j_true_exchange2').show();
						break;
					default:
						if(result.msg=='登录超时！请刷新页面重新登录！'){
							window.location.href='/api/uc/login.html';
						}
						$('.j_true_exchange4').show();
						var times=3;
						$(".c_close_time").html(times);
				        t=setInterval(function(){
				            times--;
				            $(".c_close_time").html(times);
				            if (times==0) {
				            	$('.j_true_exchange4').hide(); 
				            	$(".j_true_exchange").hide();
				                $(".j_exchange_window").hide();
				                clearInterval(t);
				            }
				        },1000);
						break;
					}
				}
			},
			error: function(r) {
			} //错误处理
		});
 }
 
 function setAid(id){
	 aid=id;
 }