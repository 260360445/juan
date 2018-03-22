$(document).ready(function(){   
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

    // 头部变化
    $(window).scroll(function(){
        if ($(window).scrollTop() > $('.main_visual').height() - $('header').height()) {
            $('header').hide();
            $('.header').show();
        }else{
            $('header').show();
            $('.header').hide();
        }
    })

    // 商品详情   晒单切换
    $('.product_detdils_con .title h3').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        $('.product_detdils_con .product_info').eq($(this).index()).addClass('current').siblings().removeClass('current');
        $(window).scrollTop($('.main_visual').height() + $('.particulars').height() - 30);
    })


    // 弹出
    $('footer a.shopping,footer a.buy').click(function(){
        $('.mask').show();
        $('.xiangqing').slideDown(300);
    })
    $('.mask').click(function(){
        $('.mask').hide();
        $('.xiangqing').slideUp(300);
    })

    // 选择
    $('.xiangqing ul li i').click(function(){
        $(this).addClass('current').siblings().removeClass();
    })



    // + -
    var num = 1;
    $('.amount span.add').click(function(){
        num++;
        if (num > 9) {
            num = 10;
        }
        $(this).siblings('p').html(num);
    })
    $('.amount span.minus').click(function(){
        num--;
        if (num < 2) {
            num = 1;
        }
        $(this).siblings('p').html(num);
    })


})