$(document).ready(function(){
	$('.money ul li').click(function(e){
		// console.log($(this).attr("data-sum"))
		$(this).addClass('active').siblings().removeClass();
		$('footer p span i').html($(this).attr("data-sum"));
	})
})