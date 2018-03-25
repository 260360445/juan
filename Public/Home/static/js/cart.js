$("#cartpay").click(function(){
	var buy=[]; 
	var num='';
    $("input[name=items]").each(function(k,v) {  
        if ($(this).is(":checked")) { 
        	buynum=$("#buynum_"+$(this).val()+"").val();
        	buy.push({gid:$(this).val(),num:buynum});
        	
        	sessionStorage.setItem("buyType",2);
        	sessionStorage.setItem("buyNum",JSON.stringify(buy));
        }
    });
    if(buy == ""){
    	layer.msg('请选择商品',{offset: '300px',time: 2000,icon: 2});
    	return false;
    }else{
    	gotoCartOrder();
    }
})
