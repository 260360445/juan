$(document).ready(function(){
	$(document).scroll(function(){
        if($("html").scrollTop() < $(".banner").height()){
			$('.header').css('background','rgba(0,0,0,'+ $("html").scrollTop() / $(".banner").height() * .9 +')')
		}
	})
    // 轮播
    $dragBln = false;  
    $(".main_image").touchSlider({
        flexible : true,
        speed : 500,
        btn_prev : $("#btn_prev"),
        btn_next : $("#btn_next"),
        paging : $(".flicking_con a"),
        counter : function (e){
            $(".flicking_con a").removeClass("on").eq(e.current-1).addClass("on");
        }
    }); 
    $(".main_image").bind("mousedown", function() {
        $dragBln = false;
    });  
    $(".main_image").bind("dragstart", function() {
        $dragBln = true;
    });    
    $(".main_image a").click(function(){
        if($dragBln) {
            return false;
        }
    });    
    timer = setInterval(function(){
        $("#btn_next").click();
    }, 3000);
    
    $(".main_visual").hover(function(){
        clearInterval(timer);
    },function(){
        timer = setInterval(function(){
            $("#btn_next").click();
        },3000);
    });   
    $(".main_image").bind("touchstart",function(){
        clearInterval(timer);
    }).bind("touchend", function(){
        timer = setInterval(function(){
            $("#btn_next").click();
        }, 3000);
    })


    // 动态字行滚动
    var ul_lable = $('.news ul'); //只更改类名、ID名即可 
    var ul_h = $('.news ul li').height();   //单行（一个li滚动）
    var ul_h = ul_lable.height();
    setInterval(function(){  
        var ul_li_first = ul_lable.find('li').first();  
        var ul_li_last = ul_lable.find('li').last();  
        ul_li_first.animate({marginTop:-ul_h,opacity:0},'slow',function(){  
            ul_li_first.css({'margin-top':0,'opacity':1}).insertAfter(ul_li_last);  
        });  
    },3000); 

    // footer 切换
    // $('footer a').click(function(){
    //     $(this).addClass('current').siblings().removeClass('current');
    // })
})