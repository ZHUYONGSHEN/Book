<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>红包引导页</title>
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
<body>
	<div class="topImage">
		<img src="/Public/Admin/images/redBag.jpg" alt="图片">
	</div>
	<div class="redBagMain">
		<div class="procedure">
			<h3>什么是个人红包推广</h3>
			<p>个人红包推广是找房经纪人推出的帮助经纪人降低获客成本，扩展获客渠道，获取更多客户资源的服务。</p>
		</div>
		<div class="procedure">
			<h3>红包推广有什么优势</h3>
			<div style="margin-top: .5rem;">
				<img src="/Public/Admin/images/redBagList1.png" alt="图片">
			</div>
			<div style="margin-top: .5rem;">
				<img src="/Public/Admin/images/redBagList2.png" alt="图片">
			</div>
		</div>
		<div class="procedure">
			<h3>红包购买和使用</h3>
			<h4>1、选择想要推广的楼盘，点击底栏“红包推广”</h4>
			<div style="padding-left: 1.26rem;padding-right: 1.26rem;">
				<img src="/Public/Admin/images/redBagList3.png" alt="图片">
			</div>
			<h4>2、设置红包发送的个数和单个金额</h4>
			<div style="padding-left: 1.26rem;padding-right: 1.26rem;">
				<img src="/Public/Admin/images/redBagList4.png" alt="图片">
			</div>
			<h4>3、微信支付购买</h4>
			<div style="padding-left: 1.26rem;padding-right: 1.26rem;">
				<img src="/Public/Admin/images/redBagList5.png" alt="图片">
			</div>
			<h4>4、去分享带有红包的连接器</h4>
			<div style="margin-bottom: .11rem; padding-left: 1.26rem;padding-right: 1.26rem;">
				<img src="/Public/Admin/images/redBagList6.png" alt="图片">
			</div>
		</div>
		<span class="btnBuy">我要购买</span>
	</div>
</body>
</html>