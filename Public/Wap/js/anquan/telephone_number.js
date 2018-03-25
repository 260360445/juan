$(document).ready(function(){
	var validCode = true;
		$("ul li span").click (function (){
			var time = 60;
			var code = $(this);
			if (validCode){
				validCode = false;
				code.addClass("msgs1");
				var t = setInterval(function () {
				$("ul li span").css('color','#b2b2b2');
				time--;
				code.html(time+"s");
					if (time == 0) {
						clearInterval(t);
					code.html("重新获取");
						validCode = true;
					code.removeClass("msgs1");
		
					}
				},1000)
			}
		})
	
		
})