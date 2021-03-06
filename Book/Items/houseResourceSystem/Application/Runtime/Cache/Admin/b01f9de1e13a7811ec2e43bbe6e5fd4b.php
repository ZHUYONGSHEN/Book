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
		<div class="fixedHeader">
			<a href="javascript:history.go(-1)" class="returnUpPage"></a>
			<h4>头部幅度</h4>
		</div>
		
		<img src="/Public/Admin/images/b.jpg" alt="">
		<a href="" class="linkerUrl"></a>
	</header>
	<div class="houseBasicMassages">
		<h4></h4>
		<div class="fontColorRed houseBasicPrice"><span></span></div>
		<div class="houseBasicTag"></div>
		<ul class="houseDressTime">
			<li>
				<div class="houseDressicon">
					<i class="mapIcon"></i>
				</div>
				<div class="houseDressMessages">
					<p></p>
				</div>
			</li>
			<li>
				<div class="houseTimeicon">
					<i class="timeIcon"></i>
				</div>
				<div class="houseTimeMessages">
					<p></p>
					<p></p>
				</div>
			</li>
		</ul>
	</div>
	<div class="houseType">
		<div class="houseTypeTitle">
			<h4>主力户型<span></span></h4>
		</div>
		<ul>
			
		</ul>
	</div>
	<div class="popUp">
		<div class="popUpTitle">
			<a class="returnUpPage"></a>
			<h4></h4>
		</div>
		<div class="popUpMain">
			<ul>
				<li></li>
			</ul>
		</div>
		<div class="popUpFooter">
		</div>
	</div>
	<div class="houseTab">
		<div class="houseTabTitle">
			<h4 class="active">楼盘配套</h4>
			<h4>楼盘详情</h4>
		</div>
		<div class="houseTabMain">
			<div class="houseTabMainList">
				<h5>小区介绍</h5>
				<p></p>
				<h5>周边公交</h5>
				<p></p>
				<h5>周边医院</h5>
				<p></p>
				<h5>周边商业</h5>
				<p></p>
			</div>
			<div class="houseTabMainList">
				<div class="houseTabMainListTitle">
					<p>开发商：</p>
					<p>物业公司：</p>
					<p>建筑总面积：</p>
					<p>竣工年代：</p>
					<p>总户数：</p>
					<p>容积率：</p>
					<p>绿化率：</p>
					<p>车位数：</p>
					<p>物业费用：</p>
				</div>
				<div class="houseTabMainListMessages">
					<p></p>
					<p></p>
					<p></p>
					<p></p>
					<p></p>
					<p></p>
					<p></p>
					<p></p>
					<p></p>
				</div>
			</div>
		</div>
	</div>
	<div class="fixedMessages">
		<div class="returnHome"><a href="javascript:history.go(-1)"><i class="returnHomeIcon"></i></a></div>
		<div class="agentMan">
			<a>
				<i class="telWhiteIcon"></i>
				<h5><span></span>认证经纪人</h5>
			</a>
		</div>
		<div class="yuYueHouse"><a>预约看房</a></div>
	</div>
	<script type="text/javascript" src="/Public/Admin/js/jquery.min.js" ></script>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script>
	/*var _href = location.href.split('#')[0];*/
	var _href = 'http://test.xiaoq.hiweixiao.com/Admin/H5Share/houseMessages?loupan_id=230062&user_id=68';
	$.ajax({
        type: "get",
        url: "http://test.xiaoq.hiweixiao.com/Broker/Share/getZFConfig",
        data: {
        	"url": _href
        },
        dataType: "json",
        beforeSend: function(){
       		//加载动画开始
  		},
        success: function(resources){
        	if(resources.info =="success"){
        		console.log(resources.data);
            	wx.config({
					debug : true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
					appId : resources.data.appId, // 必填，公众号的唯一标识
					timestamp : resources.data.timestamp, // 必填，生成签名的时间戳
					nonceStr : resources.data.nonceStr, // 必填，生成签名的随机串
					signature : resources.data.signature,// 必填，签名，见附录1
					jsApiList : ['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareTimeline','onMenuShareQQ','onMenuShareWeibo' ,'onMenuShareQZone']
				// 必填，需要使用的JS接口列表，所有JS接口列表见附录2
				});
            }
        },
        error: function(error){
            console.log(error);
        }
    });
		
		$(function(){
			var stage ={},textArr=[],heightAuto = [];
			var listsLen = 0,
                isUserInteracting = false,
                mouseX,
                mouseY,
                movelength,
                thisindex,
                moveMainWidth = $('.houseTypeTitle').width(),
                moveMainUlWidth = 0,
                popUpLiWidth = 0,
                houseTabIndex=0,
                houseTabMainWidt=0,
                padingL=0;
			window.location.search.slice(1).split("&").forEach(function(i){
			    var key = i.split("=")[0], val = i.split("=")[1];
			    if (key) {
			        stage[key] = decodeURIComponent(val);
			    }
			});
			$('.yuYueHouse a').attr('href','/Admin/H5Share/yuYueHouse?loupan_id='+stage.loupan_id);

	     	$.ajax({
	            type: "get",
	            url: "http://test.xiaoq.hiweixiao.com/Broker/NewHouse/getDetailForH5",
	            data:stage,
	            dataType: "json",
	            beforeSend: function(){
               		//加载动画开始
          		},
	            success: function(resources){
	            	if(resources.info =="success"){
	                	renderHouseMessages(resources.data);
	                }
	            },
	            error: function(error){
	                console.log(error);
	            }
	        });
	        //house详情渲染
	        function renderHouseMessages (data){
	        	//头图
	        	$('header img').attr('src',data.cover_path);
	        	//houseBasicMassages
	        	$('.fixedHeader h4').text(data.name);
	        	$('.houseBasicMassages h4').html(data.name +'<i class="linkeHrefIcon"></i> <span>'+ data.sell_status +'</span>');
	        	if(data.sell_status == "待售"){
	        		$('.houseBasicMassages h4 span').css('background-color','#f9943a');
	        	} else if (data.sell_status == "售罄"){
	        		$('.houseBasicMassages h4 span').css('background-color','#c8cacf');
	        	}
	        	//linkerUrl
	        	$('.linkerUrl').attr('href',data.link_url);
	        	//houseBasicPrice
	        	$('.houseBasicPrice').html('<span>'+data.price+'</span>元/m²');
	        	//houseBasicTag
	        	var houseBasicTagArr = data.project_feature.split(','),houseBasicTagHtml="",hosueTypeHtml="",popUpHtml ="";
	        	for (var i = 0,tagLeg = houseBasicTagArr.length; i < tagLeg; i++) {
	        		if(i%3==0){
	        			houseBasicTagHtml+='<span class="fontColorGreen">'+ houseBasicTagArr[i] +'</span>'
	        		} else if(i%3==1){
	        			houseBasicTagHtml+='<span class="fontColorOrange">'+ houseBasicTagArr[i] +'</span>'
	        		} else if(i%3==2){
	        			houseBasicTagHtml+='<span class="fontColorBlue">'+ houseBasicTagArr[i] +'</span>'
	        		}
	        	}
	        	$('.houseBasicTag').html(houseBasicTagHtml);
	        	//houseDressMessages
	        	$('.houseDressMessages p').text(data.address);
	        	//houseTimeMessages
	        	$('.houseTimeMessages p').eq(0).html('开盘时间：'+data.open_date);
	        	$('.houseTimeMessages p').eq(1).html('交房时间：'+data.checkin_date);
	        	for (var i = 0,tagLeg = data.huxing.length; i < tagLeg; i++) {
	        		hosueTypeHtml+= '<li><div class="houseTypeImage"><img src="'+ data.huxing[i].house_path +'" alt="'+ data.huxing[i].name +'"><p>'+ data.huxing[i].name +'</p></div><div class="houseTypeMessages"><p>'+ data.huxing[i].type +'<span>'+ data.huxing[i].build_area +'m²</span></p><p class="fontColorRed">'+ data.huxing[i].average_price +'元/m²</p></div></li>';
	        		popUpHtml+='<li><img src="'+ data.huxing[i].house_path +'" alt="'+ data.huxing[i].name +'"/></li>';
	        		textArr.push(data.huxing[i].name);
	        	}
	        	listsLen = data.huxing.length;
	        	$('.houseType ul').html(hosueTypeHtml);
	        	$('.popUp ul').html(popUpHtml);
	        	$('.houseTypeTitle h4 span').html(' ['+ listsLen +']')
	        	
	        	var rightCSS = $('.houseType ul li').css('margin-right').replace('px',"");
	        	
	        	$('.houseType ul').width(listsLen * $('.houseType ul li').width()+listsLen * rightCSS+ listsLen*2+5);
	        	moveMainUlWidth = listsLen * $('.houseType ul li').width()+listsLen * rightCSS+ listsLen*2+5;
	        	addEvent();
	        	//popUp
	        	popUpLiWidth = $('.popUp ul li').width();
	        	$('.popUp ul').css('width',listsLen * popUpLiWidth);
	        	//houseTab
	        	$('.houseTabMainList:first-child p').eq(0).text(data.build_content);
	        	$('.houseTabMainList:first-child p').eq(1).text(data.traffic);
	        	$('.houseTabMainList:first-child p').eq(2).text(data.hospital);
	        	$('.houseTabMainList:first-child p').eq(3).text(data.business);

	        	$('.houseTabMainListMessages p').eq(0).text(data.developer);
	        	$('.houseTabMainListMessages p').eq(1).text(data.management);
	        	$('.houseTabMainListMessages p').eq(2).text(data.build_area);
	        	$('.houseTabMainListMessages p').eq(3).text(data.build_year);
	        	$('.houseTabMainListMessages p').eq(4).text(data.household_num);
	        	$('.houseTabMainListMessages p').eq(5).text(data.plot_rate);
	        	$('.houseTabMainListMessages p').eq(6).text(data.green_rate);
	        	$('.houseTabMainListMessages p').eq(7).text(data.car_num);
	        	$('.houseTabMainListMessages p').eq(8).text(data.management_price);
	        	padingL = $('.houseTabMainList').eq(0).css('padding-right').replace('px',"");
	        	houseTabMainWidt = $('.houseTabMainList').eq(1).width();
	        	var lse = parseInt(padingL)+ houseTabMainWidt;
	        	$('.houseTabMain').width(2*lse);
	        	for (var i = 0; i < $('.houseTabMainList').length; i++) {
	        		heightAuto.push($('.houseTabMainList').eq(i).height());
	        	}
	        	//fixedMessages
	        	$('.agentMan a').attr('href','tel:'+ data.user.mobile);
	        	$('.agentMan h5 span').text(data.user.name);
	        	$('.houseTypeImage img').each(function(){
	        		var par = $(this).parents('.houseTypeImage');
				    var image=new Image();
				    image.src=this.src;
				    if(image.complete){
				        //存在缓存中，立即处理
				        cutImgz(this,par);
				    } else{
				        //不存在缓存中，onload处理
				        this.onload=function(){
				            cutImgz(this,par);
				        }
				    }
				});
				initWxApi(data);
	        }
	        function onDocumentTouchStart( event ) {
		        if ( event.touches.length == 1 ) {
		            event.preventDefault();
		            mouseX = event.touches[ 0 ].pageX;
	                movelength = 0;
		        }
		    }
		    function onDocumentTouchMove( event ) {
		        if ( event.touches.length == 1 ) {
		            event.preventDefault();
		            var moveWidth = mouseX - event.touches[ 0 ].pageX;
                    var leftNub = parseInt($(this).find('ul').css('left').replace('px',""));
                    if(movelength > moveWidth){
                        leftNub+=2;
                    } else if (movelength < moveWidth){
                        leftNub-=2;
                    }
                   movelength = moveWidth;
                    if(leftNub >= 0){
                        $(this).find('ul').css('left', 0);
                    } else if((-leftNub) + moveMainWidth >= moveMainUlWidth ){
                        $(this).find('ul').css('left', moveMainWidth-moveMainUlWidth);
                    } else{
                        $(this).find('ul').css('left', leftNub);
                    }
		        }
		    }
		    function onDocumentTouchEnd( event ) {
		    	if ( event.touches.length <= 1 ) {
		    		if(Math.abs(movelength) == 0){
	                    $('.popUp').fadeIn();
	                }
		    	}
            }
	        function onDocumentMouseDown( event ) {
                event.preventDefault();
                isUserInteracting = true;
                movelength = 0;
                mouseX = event.clientX;
            }
            function onDocumentMouseMove( event ) {
                if ( isUserInteracting == true ) {
                    var moveWidth = mouseX - event.clientX; 
                    var leftNub = parseInt($(this).find('ul').css('left').replace('px',""));
                    if(movelength > moveWidth){
                        leftNub+=2;
                    } else if (movelength < moveWidth){
                        leftNub-=2;
                    }
                   movelength = moveWidth;
                    if(leftNub >= 0){
                        $(this).find('ul').css('left', 0);
                    } else if((-leftNub) + moveMainWidth >= moveMainUlWidth ){
                        $(this).find('ul').css('left', moveMainWidth-moveMainUlWidth);
                    } else{
                        $(this).find('ul').css('left', leftNub);
                    }
                    
                }
            }
            function onDocumentMouseUp( event ) {
                isUserInteracting = false;
                if(Math.abs(movelength) == 0){
                    $('.popUp').fadeIn();
                }
            }
           function onDocumentMouseDownLi() {
                thisindex = $(this).index();
                $('.popUpTitle h4').text(textArr[thisindex]);
                var  index = thisindex + 1;
                $('.popUpFooter').html('<span class="fontColorRed">'+ index +'</span>/'+ listsLen)
                $('.popUp ul').animate({'left':-thisindex * popUpLiWidth},300);
            }
            /*浮层事件*/
            function onPopUpMouseDown (event){
            	event.preventDefault();
                isUserInteracting = true;
                movelength = 0;
                mouseX = event.clientX;
            }
            function onPopUpMouseMove( event ) {
                if ( isUserInteracting == true ) {
                    movelength = mouseX - event.clientX;
                }
            }
            function onPopUptMouseUp( event ) {
                isUserInteracting = false;
                if(Math.abs(movelength) == 0){
                	return false;
                }
                if (movelength >0) {
                	if (thisindex <= 0) {
                		thisindex=0;
                	} else {
                		--thisindex
                	}
                } else {
                	if (thisindex >= listsLen-1) {
                		thisindex=listsLen-1;
                	} else {
                		++thisindex
                	}
                }
                var  index = thisindex + 1;
                $('.popUpFooter').html('<span class="fontColorRed">'+ index +'</span>/'+ listsLen)
                $('.popUpTitle h4').text(textArr[thisindex]);
                $('.popUp ul').animate({'left':-thisindex * popUpLiWidth},300);
            }
             function onPopUpTouchStart (event){
            	if ( event.touches.length == 1 ) {
		            event.preventDefault();
		            mouseX = event.touches[ 0 ].pageX;
	                movelength = 0;
		        }
            }
            function onPopUpTouchMove( event ) {
		        if ( event.touches.length == 1 ) {
		            event.preventDefault();
		            movelength = mouseX - event.touches[ 0 ].pageX;
		        }
		    }
		    function onPopUpTouchEnd( event ) {
		    	if ( event.touches.length <= 1 ) {
		    		if(Math.abs(movelength) == 0){
	                    return false;
	                }
	                if (movelength >0) {
	                	if (thisindex <= 0) {
	                		thisindex=0;
	                	} else {
	                		--thisindex
	                	}
	                } else {
	                	if (thisindex >= listsLen-1) {
	                		thisindex=listsLen-1;
	                	} else {
	                		++thisindex
	                	}
	                }
	                var  index = thisindex + 1;
	                $('.popUpFooter').html('<span class="fontColorRed">'+ index +'</span>/'+ listsLen)
	                $('.popUpTitle h4').text(textArr[thisindex]);
	                $('.popUp ul').animate({'left':-thisindex * popUpLiWidth},300);
		    	}
            }
            //楼盘信息事件
            function onHouseTabMainMouseDown( event ) {
            	event.preventDefault();
                isUserInteracting = true;
                movelength = 0;
                mouseX = event.clientX;
            }
            function onHouseTabMainMouseMove( event ) {
                if ( isUserInteracting == true ) {
                    movelength = mouseX - event.clientX;
                }
            }
            function onHouseTabMainMouseUp( event ) {
                isUserInteracting = false;
                if(Math.abs(movelength) == 0){
                	return false;
                }
                if(movelength >0) {
                	if (houseTabIndex <= 0) {
                		houseTabIndex=0;
                	} else {
                		--houseTabIndex
                	}
                } else {
                	if (houseTabIndex >= 1) {
                		houseTabIndex=1;
                	} else {
                		++houseTabIndex
                	}
                }
                $('.houseTabMainList').height(heightAuto[houseTabIndex]);
                $('.houseTabTitle h4').eq(houseTabIndex).addClass('active').siblings().removeClass('active');
                if(houseTabIndex==0){
                	$('.houseTabMain').animate({'left':0},300);
                	return false;
                } 
                $('.houseTabMain').animate({'left':-(houseTabIndex * houseTabMainWidt+ parseInt(padingL/2))},300);
            }
            function onHouseTabMainTouchStart( event ) {
                if ( event.touches.length == 1 ) {
            		event.preventDefault();
		            mouseX = event.touches[ 0 ].pageX;
	                movelength = 0;
            	}
            }
            function onHouseTabMainTouchMove( event ) {
                if ( event.touches.length == 1 ) {
		            event.preventDefault();
		            movelength = mouseX - event.touches[ 0 ].pageX;
		        }
            }
            function onHouseTabMainTouchEnd( event ) {
            	if ( event.touches.length <= 1 ) {
            		if(Math.abs(movelength) == 0){
	                	return false;
	                }
	                if(movelength >0) {
	                	if (houseTabIndex <= 0) {
	                		houseTabIndex=0;
	                	} else {
	                		--houseTabIndex
	                	}
	                } else {
	                	if (houseTabIndex >= 1) {
	                		houseTabIndex=1;
	                	} else {
	                		++houseTabIndex
	                	}
	                }
	                $('.houseTabMainList').height(heightAuto[houseTabIndex]);
	                $('.houseTabTitle h4').eq(houseTabIndex).addClass('active').siblings().removeClass('active');
	                if(houseTabIndex==0){
	                	$('.houseTabMain').animate({'left':0},300);
	                	return false;
	                } 
	                $('.houseTabMain').animate({'left':-(houseTabIndex * houseTabMainWidt+ parseInt(padingL/2))},300);

            	}  
            }
            function addEvent (){
            	$('.houseType')[0].addEventListener( 'touchstart', onDocumentTouchStart, false );
       			$('.houseType')[0].addEventListener( 'touchmove', onDocumentTouchMove, false );
       			$('.houseType')[0].addEventListener( 'touchend', onDocumentTouchEnd, false );
            	$('.houseType')[0].addEventListener( 'mousedown', onDocumentMouseDown, false );
            	$('.houseType')[0].addEventListener( 'mousemove', onDocumentMouseMove, false );
	            $('.houseType')[0].addEventListener( 'mouseup', onDocumentMouseUp, false );

	            $('.popUp .popUpMain')[0].addEventListener( 'touchstart', onPopUpTouchStart, false );
       			$('.popUp .popUpMain')[0].addEventListener( 'touchmove', onPopUpTouchMove, false );
       			$('.popUp .popUpMain')[0].addEventListener( 'touchend', onPopUpTouchEnd, false );
            	$('.popUp .popUpMain')[0].addEventListener( 'mousedown', onPopUpMouseDown, false );
            	$('.popUp .popUpMain')[0].addEventListener( 'mousemove', onPopUpMouseMove, false );
	            $('.popUp .popUpMain')[0].addEventListener( 'mouseup', onPopUptMouseUp, false );

	            $('.houseTabMain')[0].addEventListener( 'mousedown', onHouseTabMainMouseDown, false );
            	$('.houseTabMain')[0].addEventListener( 'mousemove', onHouseTabMainMouseMove, false );
	            $('.houseTabMain')[0].addEventListener( 'mouseup', onHouseTabMainMouseUp, false );
	            $('.houseTabMain')[0].addEventListener( 'touchstart', onHouseTabMainTouchStart, false );
            	$('.houseTabMain')[0].addEventListener( 'touchmove', onHouseTabMainTouchMove, false );
	            $('.houseTabMain')[0].addEventListener( 'touchend', onHouseTabMainTouchEnd, false );
		        for(var i=0; i < listsLen; i++){
		            $('.houseType li')[i].addEventListener( 'mousedown', onDocumentMouseDownLi, false );
		             $('.houseType li')[i].addEventListener( 'touchstart', onDocumentMouseDownLi, false );
		        }
            }
            $('.popUp').on('click','.returnUpPage',function(){
            	$(this).parents('.popUp').fadeOut();
            });
            $('.houseTabTitle h4').click(function(){
            	houseTabIndex = $(this).index();
            	$(this).addClass('active').siblings().removeClass('active');
            	$('.houseTabMainList').height(heightAuto[houseTabIndex]);
            	if(houseTabIndex==0){
                	$('.houseTabMain').animate({'left':0},300);
                	return false;
                } 
                $('.houseTabMain').animate({'left':-(houseTabIndex * houseTabMainWidt+ parseInt(padingL/2))},300);
            });
            $(window).scroll(function(){
		       if($(document).scrollTop()>=200){
		       		$('.fixedHeader h4').fadeIn();
		       		$('.fixedHeader').css({'backgroundColor':'rgba(255,255,255,1)','border-bottom':'1px solid #b8b8b8'});
		       		$('.returnUpPage').css({'background':'url(/Public/Admin/images/returnBlack.png) no-repeat no-repeat center center','background-size':'contain'})
		       	} else {
		       		$('.fixedHeader h4').fadeOut();
		       		$('.fixedHeader').css({'backgroundColor':'rgba(255,255,255,0)','border-bottom':'none'});
		       		$('.returnUpPage').css({'background':'url(/Public/Admin/images/return.png) no-repeat no-repeat center center','background-size':'contain'})
		       	}
		    });
            function cutImgz(obj,par){
			    var image=new Image();
			    image.src=obj.src;
			    $this=$(obj);
			    var iwidth=par.width();//获取在CSS里固定的图片显示宽度
			    var iheight=par.height();//获取在CSS里固定的图片显示高度
			    if(1*image.width*iheight!=1*iwidth*image.height){
			    		
			        //原始图片的尺寸与CSS里固定的图片尺寸比例不一致，则进行处理
			        if(image.width/image.height>=iwidth/iheight){
			            $this.height(iheight+'px');
			            $this.width((image.width*iheight)/image.height+'px');
			        } else{
			            $this.width(iwidth+'px');
			            $this.height((image.height*iwidth)/image.width+'px');
			        }
			    }
			}
			function initWxApi(linkerData){
				var title=linkerData.name;
				var desc='我在这里发现了一套好房，快来看看吧！';
				var link=_href;
				var imgUrl=linkerData.cover_path;
				var type='link';
				var dataUrl='';
				wx.ready(function(){
					wx.onMenuShareAppMessage({
				        title:title, // 分享标题
				        desc:desc, // 分享描述
				        link:link, // 分享链接
				        imgUrl: imgUrl, // 分享图标
				        type: type, // 分享类型,music、video或link，不填默认为link
				        dataUrl: dataUrl, // 如果type是music或video，则要提供数据链接，默认为空
				        success: function () {
				            // 用户确认分享后执行的回调函数
				        },
				        cancel: function () {
				            // 用户取消分享后执行的回调函数
				        }
				    });
					wx.onMenuShareTimeline({
				        title:title, // 分享标题
				        link: link, // 分享链接
				        imgUrl:imgUrl, // 分享图标
				        success: function () {
				            // 用户确认分享后执行的回调函数
				        },
				        cancel: function () {
				            // 用户取消分享后执行的回调函数
				        }
				    });
					wx.onMenuShareQQ({
					   title: title, // 分享标题
					   desc:desc, // 分享描述
					   link: link, // 分享链接
					   imgUrl: imgUrl, // 分享图标
					   success: function () {
					       // 用户确认分享后执行的回调函数
					   },
					   cancel: function () {
					       // 用户取消分享后执行的回调函数
					   }
					});

				  	wx.onMenuShareWeibo({
				    	title:title, // 分享标题
				    	desc:desc, // 分享描述
				    	link:link, // 分享链接
				    	imgUrl: imgUrl, // 分享图标
				    	success: function () {
				       	// 用户确认分享后执行的回调函数
				    	},
				    	cancel: function () {
				      	// 用户取消分享后执行的回调函数
				    	}
				  	});

				  	wx.onMenuShareQZone({
				      	title:title, // 分享标题
				      	desc:desc, // 分享描述
				      	link:link, // 分享链接
				      	imgUrl:imgUrl, // 分享图标
				      	success: function () {
				         	// 用户确认分享后执行的回调函数
				      	},
				      	cancel: function () {
				        	// 用户取消分享后执行的回调函数
				      	}
				    });
				});
			}
	       
		});
	</script>
</body>
</html>