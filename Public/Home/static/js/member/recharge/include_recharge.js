var proportion = $("#proportion").val();
var brokerageKey = $("#brokerageKey").val();
var rechargeSalesShow = false;
// 初始化函数
$(function() {
	if (brokerageKey == 0) {
		$(".c_fan_money").remove();
		$(".c_recharge_num_money").remove();
	}
	$("#rebate1").html((50 + 50 * proportion) + "元");
	$("#rebate2").html((100 + 100 * proportion) + "元");
	$("#rebate3").html((200 + 200 * proportion) + "元");
	$("#rebate4").html((500 + 500 * proportion) + "元");
	$("#rebate5").html((1000 + 1000 * proportion) + "元");
})
function loadRechargeSales(){
	var rechargeSales = $("#rechargeSales").val();
	rechargeSalesShow = true;
	$("#rechargeSales1").html(50 * rechargeSales);
	$("#rechargeSales2").html(100 * rechargeSales);
	$("#rechargeSales3").html(200 * rechargeSales);
	$("#rechargeSales4").html(500 * rechargeSales);
	$("#rechargeSales5").html(1000 * rechargeSales);
	$(".c_fan_money_1").eq(0).show();
}
function ifShow() {
	var inputVal = $("#inputM").val();
	if (inputVal == '') {
		$('#inputMli div').hide();
	} else {
		$('#inputMli div').show();
	}
	if(rechargeSalesShow){
		var inputVal = $("#inputM").val();
		var rechargeSales = $("#rechargeSales").val();
		$("#rechargeSales6").html(inputVal * (rechargeSales*100)/100);
		if (inputVal == '') {
			$('#inputMli .c_fan_money_1').hide();
		} else {
			$('#inputMli .c_fan_money_1').show();
		}
	}
}
function check() {
	var input = $("#inputM").val();
	if (input.length == 1) {
		$("#inputM").val(input.replace(/[^1-9]/g, ''));
	} else {
		$("#inputM").val(input.replace(/\D/g, ''));
	}
	$("#inputVal").html(input);
	inputRounding = input * (1 + proportion / 1) - input % 10 * proportion;
	var inputStr = moneyFormat(inputRounding) + "元";
	$("#rebate6").html(inputStr);
	if (inputStr.length >9) {
		$(".c_fan_money").css("width", "180px");
	} else {
		$(".c_fan_money").css("width", "149px");
		
	}
	ifShow();
}
// 关闭充值提醒弹窗
$(".c_remind_close").click(function() {
	$(".c_recharge_remind").hide();
	$(".c_remind_bj").hide();
	window.location.reload();
})
// 充值提醒(右上角关闭)
$(".c_qq_close").click(function() {
	$(".c_recharge_remind").hide();
	$(".c_remind_bj").hide();
	window.location.reload();
})

// 输入其它金额失去焦点时，把输入的充值金额值传递给li标签
$("#inputM").blur(function() {
	$("#inputMli").attr("data-val", $("#inputM").val());
});

$(".w_alertsBoxButton").click(function() {
	$(".alertsbg").hide();
	$(".alertsBox").hide();
	window.location.reload();
})

// 点击充值先校验表单重复提交
$("#submit_ok")
		.click(
				function() {
					// 充值服务协议是否选择
					var test = document.getElementById("checkbox").checked;

					if (test == false) {
						alerts("提示", "请勾选充值服务协议!", "350", "150");
					} else if (test == true) {

						$
								.ajax({
									type : "post",
									url : "/member/recharge/checkRecharge.do",
									dataType : 'json',
									data : {
										tradeMoney : $(
												".c_select_money li.c_pay_this")
												.attr("data-val"),
										rechargeToken : $("#rechargeToken")
												.val(),
										// 充值类型
										tradeType : $(
												".c_cloud_way li.c_pay_this")
												.attr("data-val")
									},
									async : false,
									success : function(data) {
										// 检查表单重复提交
										if (data.status == true) {
											// 交易类型
											var tradeType = $(
													".c_cloud_way li.c_pay_this")
													.attr("data-val");

											// 如果交易类型为微信JHF_SCAN_WX
											if (tradeType == "JHF_SCAN_WX"
													|| tradeType == "JD_GW"
													|| tradeType == "JD_PC"
													|| tradeType == "UP_WEB"
													|| tradeType == "JHF_ZFB"
													|| tradeType == "KJ_PAY"
													|| tradeType == "ZFB_WEB") {
												// 获取充值金额
												var tradeMoney = $(
														".c_select_money li.c_pay_this")
														.attr("data-val");
												// 给form表单隐藏域设置值
												$("#tradeType").val(tradeType);
												$("#money").val(tradeMoney);
												$("#formDoRecharge").submit();
												$(".c_recharge_remind").show();
												$(".c_remind_bj").show();
											} else if (tradeType == "YGTYK") {
												// 如果交易类型为云购体验卡
												$
														.ajax({
															type : "post",
															url : "/goodsorder/activateCard.do",
															dataType : 'json',
															data : {
																validCode : $(
																		"#validCode")
																		.val(),
																cardNo : $(
																		"#cardNo")
																		.val(),
																pwd : $("#pwd")
																		.val()
															},
															success : function(
																	data) {
																if (data.status) {
																	alert(data.msg);
																	window.location
																			.reload();
																} else if (data.status == false) {
																	if (data.code == "img_code_error") {
																		alerts(
																				"提示",
																				data.msg,
																				"350",
																				"150");
																	} else if (data.code == "500") {
																		alert(data.msg);
																	} else if (data.code == "petcard_ac_err_1") {
																		alerts(
																				"提示",
																				"您输入的密码不正确!",
																				"350",
																				"150");
																	} else if (data.code == "petcard_ac_err_2") {
																		alerts(
																				"提示",
																				"该卡不存在!",
																				"350",
																				"150");
																	} else if (data.code == "petcard_ac_err_3") {
																		alerts(
																				"提示",
																				"该卡已使用!(如有疑问请联系晋商贷客服)",
																				"350",
																				"150");
																	} else if (data.code == "petcard_ac_err_4") {
																		alerts(
																				"提示",
																				"中奖通知未收到!(请联系晋商贷客服)",
																				"350",
																				"150");
																	} else if (data.code == "petcard_ac_err_5") {
																		alerts(
																				"提示",
																				"该卡已过有效期!",
																				"350",
																				"150");
																	} else {
																		alerts(
																				"提示",
																				data.msg,
																				"350",
																				"150");
																	}
																	$(
																			"#captcha_img")
																			.trigger(
																					"onclick");
																	$(
																			"#validCode")
																			.focus();
																	$(
																			"#rechargeToken")
																			.val(
																					data.rechargeToken);
																}
															}
														});

											}

										} else if (data.status == false) {
											if (data.code == "form-token-failure"
													|| data.code == "session-token-failure") {
												alerts("提示", "请刷新页面重试。", "350",
														"150");
											} else {
												alerts("提示", data.msg, "350",
														"150");
											}

										}
									}
								});
					}

				});

// 输入云购体验卡失去焦点
$("#cardNo").blur(function() {
	var cardNo = $("#cardNo").val();
	if (cardNo.length < 16) {
		$(".c_card_money").html("卡号长度不正确");
		return;
	} else {
		$.ajax({
			type : "post",
			url : "/member/recharge/selectYGPetCard.do",
			dataType : 'json',
			data : {
				cardNo : cardNo
			},
			success : function(data) {
				if (data.status) {
					if (data.code == "dw") {
						$(".c_card_money").html("金额：<b>" + data.msg + "</b>元");
					} else {
						$(".c_card_money").html(data.msg);
					}
				} else if (data.status == false) {
					if (data.code == "500") {
						alert(data.msg);
					} else {
						$(".c_card_money").html(data.msg);
					}
				}

			}
		});

	}
});

// 点击图片右侧按钮，更换验证码
$(".c_verification_imgs").click(function() {
	$("#captcha_img").trigger("onclick");
})
