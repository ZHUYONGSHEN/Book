<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>帮助与反馈</title>
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
		<h4>帮助与反馈</h4>
		<a href="/Admin/H5Share/yuYueHouse" class="upData">反馈</a>
	</header>
	<div class="helpMain">
		<h4>热门问题</h4>
		<div class="helpMainList">
			<dl>
				<dt><span>Q:</span><p>什么是门店码？</p></dt>
				<dd>
					<span>A:</span>
					<p>门店码是找房经纪人合作门店的唯一标识，您可咨询您的店长，绑定门店码后报备带看客户可赚取佣金。</p>
				</dd>
			</dl>
			<dl>
				<dt><span>Q:</span><p>什么是红包推广服务？</p></dt>
				<dd>
					<span>A:</span>
					<p>红包服务是找房经纪人推出的帮助经纪人降低获客成本，扩展获客渠道，获取更多客户资源的服务。红包分为企业红包（免费领取）和个人红包（付费购买）</p>
				</dd>
			</dl>
			<dl>
				<dt><span>Q:</span><p>如何进行楼盘的红包推广？</p></dt>
				<dd>
					<span>A:</span>
					<p>企业红包可直接在房源详情页领取，领取成功后将连接器分享给客户，客户可在连接器里进行抢红包活动。个人红包需要在详情页内支付购买，购买成功后，将红包活动分享给客户即可参与抢红包活动。</p>
				</dd>
			</dl>
			<dl>
				<dt><span>Q:</span><p>如何报备客户？</p></dt>
				<dd>
					<span>A:</span>
					<p>途径一：在客户首页，点击“报备客户”，填写客户姓名和手机号码提交即可。<br />途径二：新房楼盘列表页，点击“报备”，填写客户姓名和手机号码提交即可。<br />途径三：在新房楼盘详情页，点击右下底栏“报备客户”，填写客户姓名和手机号码提交即可。
					</p>
				</dd>
			</dl>
		</div>
	</div>
	<script type="text/javascript" src="/Public/Admin/js/jquery.min.js" ></script>
	<script>
		$(function(){
			$('.helpMainList').on('click','dt',function(){
				var _that = $(this),
					_thatNextElemStrae = _that.siblings('dd').is(':hidden');
				if(_thatNextElemStrae){
					_that.addClass('active').siblings('dd').slideDown();
					_that.parents('dl').siblings('dl').find('dd').slideUp().siblings('dt').removeClass('active');
					return;
				}
				_that.removeClass('active').siblings('dd').slideUp();
				_that.parents('dl').siblings('dl').find('dd').slideUp().siblings('dt').removeClass('active');
			});
		});
	</script>
</body>
</html>