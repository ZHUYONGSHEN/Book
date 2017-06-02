<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>分享</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="format-detection" content="telephone=no" />
	<link href="/Public/Admin/css/h5Share.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="/Public/Admin/img/favicon.ico">
	<script>
		!(function(win, doc) {
			function setFontSize() {
				var docEl = doc.documentElement;
				var winWidth = docEl.clientWidth;
				doc.documentElement.style.fontSize = (winWidth / 750) * 100 + 'px';
			}
			var evt = 'onorientationchange' in win ? 'orientationchange' : 'resize';
			var timer = null;
			win.addEventListener(evt, function() {
				clearTimeout(timer);
				timer = setTimeout(setFontSize, 300);
			}, false);
			win.addEventListener('pageshow', function(e) {
				if (e.persisted) {
					clearTimeout(timer);
					timer = setTimeout(setFontSize, 300);
				}
			}, false)
			setFontSize();
		}(window, document))
	</script>
</head>
<body class="background-f5f5fa">
	<header class="hosuseHeader">
		<a href="javascript:history.go(-1)" class="returnBlack"></a>
		<h4>预约看房</h4>
	</header>
	<div class="yuYueHouseMassages">
		<div class="from-input">
			<span>姓名</span>
			<input type="text" name="name" placeholder="请输入客户姓名">
		</div>
		<div class="from-input">
			<span>手机</span>
			<input type="text" maxlength="11" name="mobile" placeholder="请输入手机号码">
		</div>
		<div class="from-input">
			<span>看房日期</span>
			<input type="text" name="look_date" id="DateTime" placeholder="点击选择看房日期">
		</div>
		<textarea name="remark" placeholder="输入备注信息（选填）"></textarea>
	</div>
	<span class="upDataFrom">确认提交</span>
	<div class="promptBox" style="display:none;"><p></p></div>
	<script type="text/javascript" src="/Public/Admin/js/jquery.min.js" ></script>
	<link href="/Public/Admin/css/mobiscroll.core-2.5.2.css" rel="stylesheet" type="text/css">
	<link href="/Public/Admin/css/mobiscroll.android-ics-2.5.2.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="/Public/Admin/js/mobiscroll.core-2.5.2.js" ></script>
	<script type="text/javascript" src="/Public/Admin/js/mobiscroll.datetime-2.5.1.js" ></script>
	<script>
		$(function(){
			function promptBoxHidden(val){
				$('.promptBox').fadeIn();
				$('.promptBox p').text(val);
				var clearTime = setTimeout(function(){
					$('.promptBox').fadeOut();
					clearTimeout(clearTime);
				},1000);
			}
			var stage ={};
			window.location.search.slice(1).split("&").forEach(function(i){
			    var key = i.split("=")[0], val = i.split("=")[1];
			    if (key) {
			        stage[key] = decodeURIComponent(val);
			    }
			});
			console.log(stage);
			//正则表达式
			var telephone =/0?(13|14|15|17|18)[0-9]{9}/,
				dateTime =/\d{4}(\-|\/|.)\d{1,2}\1\d{1,2}/;
			var customer = $('[name="name"]'),
				mobile = $('[name="mobile"]'),
				look_date = $('[name="look_date"]'),
				remark= $('[name="remark"]');
			$('.yuYueHouseMassages input').blur(function(){
				var _this = $(this),
					name = _this.attr('name'),
					valName = _this.val().trim();
				if(name =="mobile"){
					if(!$.isNumeric(valName) || !telephone.test(valName)){
						_this.parent().css("border-bottom-color","#ff4e4a");
						promptBoxHidden("请输入手机号码");
						_this.focus();
						return false;
					}
					_this.parent().css("border-bottom-color","#e7e7e7");
				} else if(name=="name"){
					if(valName==""){
						promptBoxHidden("请输入客户姓名");
						_this.parent().css("border-bottom-color","#ff4e4a");
						_this.focus();
						return false;
					}
					_this.parent().css("border-bottom-color","#e7e7e7");
				} else if(name =="look_date"){
					var dateTm = null;
					if(valName.indexOf("上午") > 0){
						dateTm = valName.replace('上午','')
					} else if (valName.indexOf("下午") > 0){
						dateTm = valName.replace('下午','')
					}
					if(!dateTime.test(dateTm)){
						/*promptBoxHidden("点击选择看房日期");*/
					}
				}
			});
			$('.upDataFrom').click(function(){
				if(customer.val().trim()==""){
					//customer.parent().css("border-bottom-color","#ff4e4a");
					promptBoxHidden("请输入你的称呼");
					customer.focus();
					return false;
				} else if (mobile.val().trim()==""){
					//mobile.parent().css("border-bottom-color","#ff4e4a");
					promptBoxHidden("请输入手机号码");
					mobile.focus();
					return false;
				} else if (look_date.val().trim()==""){
					//look_date.parent().css("border-bottom-color","#ff4e4a");
					//promptBoxHidden("点击选择看房日期");
					//look_date.focus();
					return false;
				} else {
					/*//日期时间单独处理
					var appointmentTimeVal = appointmentTime.val().trim(),
						appointmentTimeValLength = appointmentTimeVal.length;
					//日期
					var dataTime = appointmentTimeVal.substring(0, appointmentTimeValLength-2);
					//上下午
					var appointmentSd = appointmentTimeVal.substring(appointmentTimeValLength-2, appointmentTimeValLength);*/
					var data = {
						"loupan_id":stage.loupan_id,
						"name":customer.val().trim(),
						"mobile": mobile.val().trim(),
						"look_date":look_date.val().trim(),
						"remark":remark.val().trim()
					};
					if(_state == true){
						$.post("http://test.xiaoq.hiweixiao.com/Broker/NewHouse/addLookHouse/",data,function(result){
						    if(result.returnCode == "SUCCESS"){
								promptBoxHidden("提交成功");
								_state = false;
								/*window.history.back();*/
						    } else {
								promptBoxHidden("提交失败");
						    }
						 });
					}
					return false;
				}
			});
			(function ($) {
			    $.mobiscroll.i18n.zh = $.extend($.mobiscroll.i18n.zh, {
			        dateFormat: 'yyyy-mm-dd',
			        dateOrder: 'yymmdd',
			        dayNames: ['周日', '周一;', '周二;', '周三', '周四', '周五', '周六'],
					dayNamesShort: ['日', '一', '二', '三', '四', '五', '六'],
			        dayText: '日',
			        hourText: '时',
			        minuteText: '分',
			        monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
			        monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
			        monthText: '月',
			        secText: '秒',
			        timeFormat: 'HH:ii',
			        timeWheels: 'HHii',
			        yearText: '年',
			        ampmText:'上午/下午',
			        timeFormat: 'A',
			        timeWheels: 'A',
			        setText: '确定',
			   		cancelText: '取消'
			    });
			})(jQuery);
			var currYear = (new Date()).getFullYear();
			var opt = {};
			opt.datetime = {
				preset: 'datetime'
			};
			opt.default = {
				theme: 'android-ics light', //皮肤样式
				display: 'bottom（底部）', //显示方式 ：modal（正中央）  bottom（底部）
				mode: 'scroller', //日期选择模式
				lang: 'zh',
				startYear: currYear - 5, //开始年份currYear-5不起作用的原因是加了minDate: new Date()
				endYear: currYear + 5, //结束年份
				//minDate: new Date() //加上这句话会导致startYear:currYear-5失效，去掉就可以激活startYear:currYear-5,
			};
			var _state = true;
			$("#appDate").val('').scroller('destroy').scroller($.extend(opt['date'], opt['default']));
			var optDateTime = $.extend(opt['datetime'], opt['default']);
			$("#DateTime").mobiscroll(optDateTime).datetime(optDateTime);
		});
	</script>
</body>
</html>