var numArr = [];
$(function(){
	queryBuyMember(queryBuyMemberBack);
	$(document).on("click", ".reduce", function(){
		$('.tips').hide();
		var priceIndexId = $("#priceIndexId").val();
		var price = numArr[priceIndexId];
		var num = $(".num").val();
		var result = num-price;
		if(result>=price) {
			$(".num").val(result);
			$("#total").html(result);
			$("#money").val(result);
		} else {
			if(priceIndexId > 0) {
				priceIndexId--;
				result = num-numArr[priceIndexId];
				
				for(var i=numArr.length-1;i>=0;i--) {
					if(result>=numArr[i]) {
						priceIndexId=i;
						$('.VipList span').removeClass('cur');
						$($('.VipList span')[priceIndexId]).addClass('cur');
						$("#priceIndexId").val(priceIndexId);
						$(".num").val(result);
						$("#total").html(result);
						$("#money").val(result);
						break;
					}
				}
			}
		}
		$("#levelName").val($(".VipList .cur").html());
	});
	
	$(document).on("click", ".plus", function() {
		$('.tips').hide();
		var priceIndexId = $("#priceIndexId").val();
		var price = numArr[priceIndexId];
		var num = $(".num").val();
		var result = parseInt(num)+parseInt(price);
		if(parseInt(priceIndexId)+1<=(numArr.length-1)) {
			if(result<=numArr[parseInt(priceIndexId)+1]) {
				$(".num").val(result);
				$("#total").html(result);
				$("#money").val(result);
				if(result==numArr[parseInt(priceIndexId)+1]){
					priceIndexId++;
					$('.VipList span').removeClass('cur');
					$($('.VipList span')[priceIndexId]).addClass('cur');
					$("#priceIndexId").val(priceIndexId);
				}
			} else {
				priceIndexId++;
				result = parseInt(num)+parseInt(numArr[priceIndexId]);
				if(result <= numArr[numArr.length-1]) {
					$('.VipList span').removeClass('cur');
					$($('.VipList span')[priceIndexId]).addClass('cur');
					$("#priceIndexId").val(priceIndexId);
					$(".num").val(result);
					$("#total").html(result);
					$("#money").val(result);
				} else {
					if(priceIndexId == (numArr.length-1)) {
						$('.VipList span').removeClass('cur');
						$($('.VipList span')[priceIndexId]).addClass('cur');
						$("#priceIndexId").val(priceIndexId);
						$(".num").val(numArr[numArr.length-1]);
						$("#total").html(numArr[numArr.length-1]);
						$("#money").val(numArr[numArr.length-1]);
					}
				}
			}
		}
		$("#levelName").val($(".VipList .cur").html());
	});
	
	$(document).on("click", ".Pay", function() {
		$.ajax({
			url:'/buymember/validataBuyMemberMoney.do?t='+ Math.random(),
			type:'post',
			dataType:"json",
			async: false,
			data:{money:$("#money").val()},
			success : function(data){
				if(data.status) {
					$("#payFormId").submit();
				} else {
					if(data.code && data.code == 1) {
						window.location.href="/api/uc/login.do?isForum=5";
					} else {
						$('.tips').html(data.msg).show();
//						layer.tips(data.msg, '#inputMoney');

					}
				}
			},  
			error:function(){  
				handlingException(r);
			} 
		});
	});
	
    $('.suspension').height(document.documentElement.clientHeight);
    $('.rg').click(function(){
        $('.suspension').show();
    });
    $('.cj').click(function(){
        location.href = 'cj.html';
    });
    $('.close').click(function(){
        $('.suspension').hide();
    });
    $('.VipList span').click(function(){
    	$('.tips').hide();
        var i = $('.VipList span').index($(this));
        $('.VipList span').removeClass('cur');
        $(this).addClass('cur');
        $('.num').val(numArr[i]);
        $("#total").html(numArr[i]);
        $("#money").val(numArr[i]);
        $("#priceIndexId").val(i);
        $("#levelName").val($(".VipList .cur").html());
    });
});

function queryBuyMember(callbackFun) {
	$.ajax({
		url:'/buymember/queryBuyMemberIndexAjax.do?t='+ Math.random(),
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

function queryBuyMemberBack(data) {
	if(data.status) {
		var html="";
		var html1="";
		if(data.memberLevelList) {
			for(var i=0;i<data.memberLevelList.length;i++) {
				var level=data.memberLevelList[i];
				numArr.push(level.price);
	        	html+="<tr>";
	        	html+="<th>"+level.name+"</th>";
	        	html+="<th>"+level.price+"</th>";
	        	html+="<th>每股"+level.pricePerShare+"元，总计"+(level.price/level.pricePerShare)+"股</th>";
	        	html+="<th>"+level.remark+"</th>";
	        	html+="</tr>";
	        	
	        	if(i==0) {
	        		html1+="<span class='cur'>"+level.name+"</span>";
	        	} else {
	        		html1+="<span>"+level.name+"</span>";
	        	}
			}
		}
		html+="<tr class='lastTr'>"+
		"<th colspan='4'>"+
		"<span class='bz'>备注：</span>"+
		"<span>如2018年底之前成功挂牌或上市，则虚拟股权需在中国法律框架允许前提下依托持股平台予以代持。</span>"+
		"<p class='redColor'>如云购全球在2018年底前未能成功在“新三板”挂牌，会员可于2019年1月1日起向云购全球申请退款。</p>"+
		"<p class='redColor'>退款标准按：会员持有股数×每股6元给予退还，退款后会员身份及所持有的虚拟股权自动失效。</p>"+
		"<p>会员可以在2016年12月31日前一次性购买或多次购买会员服务升级会员等级，最高可升到皇冠级，会员服务及获赠的虚拟股权按照会员等级叠加计算。还可免费抽奖，100%中奖！</p>"+
		"</th></tr>";
		$(".tab").append(html);
		$(".VipList").html(html1);
	}
}
