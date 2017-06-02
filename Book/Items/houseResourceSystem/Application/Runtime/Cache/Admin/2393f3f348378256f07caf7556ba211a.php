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
<body>
	<header class="header">
		<a href="javascript:history.go(-1)" class="returnUpPage"></a>
		<div class="headerTitle fontColorWhite"></div>
	</header>
	<div class="user">
		<div class="userBody">
			<img class="userImages">
			<div class="userMessages">
				<h4><span>XXX</span><i></i><i></i></h4>
				<div class="useSource">
					<span></span>
					<span>|</span>
					<span>访问量：<i></i>人</span>
				</div>
				<p></p>
			</div>
			<a class="userTel"></a>
		</div>
	</div>
	<div class="house">
		<ul>
		</ul>
	</div>
	<div class="showBottomPrompt" style="display: none;"><p>我是有底线的!</p></div>
	<div class="loading"></div>
	<script type="text/javascript" src="/Public/Admin/js/jquery.min.js" ></script>
	<script>
		$(function(){
			var pageNumber = 1;
			var id = 68;
			var data = {
				"id" : id,
				"page":1
			};
			var allPage=0;
     		$.ajax({
	            type: "get",
	            url: "http://test.xiaoq.hiweixiao.com/Broker/MicroShop/shopDetailForH5?id="+id,
	            dataType: "json",
	            success: function(resources){
	                if(resources.info =="success"){
	                	renderWeiMessages(resources.data);
	                	console.log(resources.data);
	                }
	            },
	            error: function(error){
	                console.log(error);
	            }
	        });
	     	$.ajax({
	            type: "get",
	            url: "http://test.xiaoq.hiweixiao.com/Broker/MicroShop/getHouseForH5",
	            data:data,
	            dataType: "json",
	            beforeSend: function(){
               		//加载动画开始
          		},
	            success: function(resources){
	            	if(resources.info =="success"){
	                	renderHouseMessages(resources.data);
	                	allPage = resources.data.page;
	                	++pageNumber;
	                }
	            },
	            error: function(error){
	                console.log(error);
	            }
	        });
	        //微店信息渲染
	        function renderWeiMessages (data){
	        	//标题
	        	document.head.children[1].innerText = data.userInfo.name;
	        	$('.headerTitle').text(data.userInfo.name +'的微店');
	        	//头像
	        	$('.userImages').attr('src',data.userInfo.avatar);
	        	//姓名
	        	$('.userMessages h4 span').text( data.userInfo.name);
	        	//认证
	        	if(data.userInfo.status == 2){
	        		$('.userMessages i').eq(0).addClass('authShi');
	        	} else {
	        		$('.userMessages i').eq(0).addClass('noAuthShi');
	        	}
	        	if(data.userInfo.company_check == 2){
	        		$('.userMessages i').eq(1).addClass('authQi');
	        	} else {
	        		$('.userMessages i').eq(1).addClass('noAuthQi');
	        	}
	        	$('.userMessages p').text(data.userInfo.remark);
	        	$('.userTel').attr('href','tel:'+ data.userInfo.mobile);
	        	$('.useSource span').eq(0).text(data.userInfo.company_name);
	        	$('.useSource span').eq(2).find('i').text(data.shopInfo.browse_count);
	        }
	        //hosue信息渲染
	        function renderHouseMessages (data){
	        	var houseListLength = data.length,
	        		i,
	        		hosueUl = $('.house ul'),
	        		_html="";
	        	for(i=0; i < houseListLength; i++){
	        		_html += '<li><a href="/Admin/H5Share/houseMessages?loupan_id='+ data[i].id +'&user_id='+ data[i]. user_id+'"><div class="hosueList"><div class="hosueListImage"><img src="'+ data[i].cover_path +'" /><p>'+ data[i].average_min +'</p></div><div class="hosueListMessage"><h4>'+ data[i].name +'</h4><p>'+ data[i].district +'</p></div></div></a></li>';
	        	}
	        	hosueUl.append(_html);
	        }
	        $(window).scroll(function(){
		       if($(document).scrollTop()>=$(document).height()-$(window).height()){
			       	if(pageNumber <= allPage){
			       		$.ajax({
				            type: "get",
				            url: "http://test.xiaoq.hiweixiao.com/Broker/MicroShop/getHouseForH5?id="+ id +"&page="+ pageNumber,
				            dataType: "json",
				            beforeSend: function(){
			               		//加载动画开始
			          		},
				            success: function(resources){
				            	if(resources.info =="success"){
				            		renderHouseMessages(resources.data);
		            				++pageNumber;
				                }
				            },
				            error: function(error){
				                console.log(error);
				            }
				        });
			       	}else {
            			var showBottomPrompt = $('.showBottomPrompt');
            			if(showBottomPrompt.is(':hidden')){
            				showBottomPrompt.show();
            			}
	            	}
		       		
		    	   
		       }
		    });
		});
	</script>
</body>
</html>