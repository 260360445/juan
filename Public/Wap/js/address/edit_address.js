$(document).ready(function(){
	$('.delete').click(function(){
		$(this).parent('li').remove();
		console.log($('ul li:first'));
		$('ul li i:first').addClass('current');
	})
})