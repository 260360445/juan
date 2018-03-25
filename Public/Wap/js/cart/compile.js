$(document).ready(function(){
	// 全选
	$('footer input').change(function(){
		if ($(this).prop('checked') == true) {
			$(this).siblings('.cho').show();
			$(this).siblings('.choose').hide();
		} else{
			$(this).siblings('.cho').hide();
			$(this).siblings('.choose').show();
		}
	 	var all = $(this).is(":checked");  //声明这个 var 代表的是布尔值，true 和 false，代表两种状态。
	 	$("ul li input").each(function(){  // each 遍历
	 		$(this).prop("checked",all);
			if ($(this).prop('checked') == true) {
				$(this).siblings('.cho').show();
				$(this).siblings('.choose').hide();
			} else{
				$(this).siblings('.cho').hide();
				$(this).siblings('.choose').show();
			}
	 	})
	 })
 	// 在全选的情况下，下面的input其中有取消勾选的，全选功能失效（全选的勾选取消）
 	$("ul li input").bind('click', function () {
 			if ($(this).prop('checked') == true) {
				$(this).siblings('.cho').show();
				$(this).siblings('.choose').hide();
			} else{
				$(this).siblings('.cho').hide();
				$(this).siblings('.choose').show();
			}
        if ($(this).prop("checked") != true) {
            // if ($('footer input').prop("checked") == true) {
            //     $('footer input').prop('checked', false);
            // }

				$('footer input').siblings('.cho').hide();
				$('footer input').siblings('.choose').show();
        }
        else {
            //判断当页每一行的checkbox 是否被选中
            CheckBoxCheckedALL();
        }
    })
	function CheckBoxCheckedALL(){
	    var n = 0;
	    var che = true; //标示位
	    //获取所有的checkbox
	    var items = $('input[name="check"]');
	    for (var i = 0; i < items.length; i++) {
	        if (!items[i].checked) {
	            che = false;
	            return;
	        }
	        n++;
	    }
	    if (che) {
	        $('footer input').prop('checked', true);
	    }
	}
	// 选择
	$('.xiangqing ul li i').click(function(){
		$(this).addClass('current').siblings().removeClass();
	})
})