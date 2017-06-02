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
		<h4>意见反馈</h4>
		<span class="upData">发送</span>
	</header>
	<div class="yuYueHouseMassages">
		<textarea style="display:block;width: 7.13rem; height: 2.74rem; border-bottom: 1px solid #eaebed;" name="remark" maxlength="100" placeholder="写下你使用过程中发现的问题"></textarea>
		<div class="from-input">
			<input type="text" maxlength="11" name="mobile" placeholder="请留下你的联系方式">
		</div>
	</div>
	<div class="promptBox" style="display:none;"><p></p></div>
	<script type="text/javascript" src="/Public/Admin/js/jquery.min.js" ></script>
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
			//正则表达式
			var telephone =/0?(13|14|15|17|18)[0-9]{9}/,
				dateTime =/\d{4}(\-|\/|.)\d{1,2}\1\d{1,2}/;
			var mobile = $('[name="mobile"]'),
				remark= $('[name="remark"]');
			$('.yuYueHouseMassages input').blur(function(){
				var _this = $(this),
					name = _this.attr('name'),
					valName = _this.val().trim();
				if(name =="mobile"){
					if(!$.isNumeric(valName) || !telephone.test(valName)){
						_this.parent().css("border-bottom-color","#ff4e4a");
						promptBoxHidden("请填写正确手机号码!");
						_this.focus();
						return false;
					}
					_this.parent().css("border-bottom-color","#e7e7e7");
				} else if(name=="remark"){
					if(valName==""){
						promptBoxHidden("写下你使用过程中发现的问题");
						_this.parent().css("border-bottom-color","#ff4e4a");
						_this.focus();
						return false;
					}
					_this.parent().css("border-bottom-color","#e7e7e7");
				}
			});
			$('.upData').click(function(){
				if(remark.val().trim()==""){
					remark.parent().css("border-bottom-color","#ff4e4a");
					promptBoxHidden("写下你使用过程中发现的问题");
					remark.focus();
					return false;
				} else if (mobile.val().trim()==""){
					mobile.parent().css("border-bottom-color","#ff4e4a");
					promptBoxHidden("请填写正确手机号码!");
					mobile.focus();
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
						"mobile": mobile.val().trim(),
						"remark":remark.val().trim()
					};
					if(_state == true){
						$.post("http://test.xiaoq.hiweixiao.com/Broker/NewHouse/addLookHouse/",data,function(result){
						    if(result.returnCode == "SUCCESS"){
								promptBoxHidden("发送成功");
								_state = false;
								/*window.history.back();*/
						    } else {
								promptBoxHidden("发送失败");
						    }
						 });
					}
					return false;
				}
			});
		});
	</script>
</body>
</html>