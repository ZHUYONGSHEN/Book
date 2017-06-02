<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<script language="JavaScript"> 
if (window != top) 
top.location.href = location.href; 
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="keywords" content="微信帮手 微信公众账号 微信公众平台 微信公众账号开发 微信二次开发 微信接口开发 微信托管服务 微信营销 微信公众平台接口开发" />
<meta name="description" content="微信公众平台接口开发、托管、营销活动、二次开发" />
<!-- Mobile Devices Support @begin -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <!-- Mobile Devices Support @end -->
        <link rel="shortcut icon" href="/tpl/static/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css" media="all" />
		<link rel="stylesheet" type="text/css" href="/Public/Admin/css/bootstrap1.css" media="all" />
   		<script src="/Public/Admin/bower_components/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="/Public/Admin/js/placeholder.js?v=2c99b443.js"></script>
<title>登录-腾讯地图找房</title>
<style>
.fn-clear:after {visibility: hidden;display: block;font-size: 0;content: " ";clear: both;height: 0;}
.fn-clear{*zoom:1;}
.fl{float:left;}
body{width:100%;height:100%;background:#fff url(/Public/Admin/images/login_bg.png) repeat;font-family:"Microsoft YaHei";}
#doc{position:absolute;top:46%;left:50%;width:760px;margin:-190px 0 0 -380px;}
#bd .content{width:490px;height:auto;background:#fff;border:1px solid #25bbff;padding:30px 0;}
.logo{margin:78px 60px 0 0;}
.login-btn{float:left;display:block;width:150px;height:40px;line-height:40px;margin:0 8px;background:#25bbff;border:none;font-size:18px;color:#fff;text-align:center;cursor:pointer; border-radius:3px;}
a.login-btn:hover{color:#fff;}
.control-groupas label{color:#727171}
input[type="text"], input[type="password"]{width:246px;}
input[type="text"], input[type="password"], input[type="submit"] {font-family:"Microsoft YaHei";}
.content p{text-indent:88px;height:50px;line-height:50px;color:#727171;}
#ft{position:absolute;bottom:0;left:0;width:100%;height:156px;border-top:1px dotted #6CC9F2;padding-left:0;text-align:center;color:#888;}
#ft ul{width:270px;margin:40px auto 0;}
#ft li{float:left;height:40px;line-height:40px;margin:0 13px;}
#ft li a{font-size:16px;color:#888;}
#ft p{height:30px;line-height:30px;font-size:14px;}
.reg-wrapper-quick{margin-left:0;padding-top:0;}
input:focus{ outline:none!important;}
</style>
</head>
    <body onkeydown="bindEnterKey(event);">
<div id="doc">
	<form name="" action="<?php echo U('Public/login');?>" id="formSubmit" method='post'>
    <div id="bd" class="quc-clearfix reg-wrapper-quick">
        <div class="logo fl"><img src="/Public/Admin/images/login_logo.png" alt=""></div>
        <div class="content fl">
            <div id="loginWrap" class="fn-clear">
                <div id="modLoginWrap" class="mod-qiuser-pop fn-clear">
                    <dl class="login-wrap">
                        <dt>
                            <span id="loginTitle"></span>
                        </dt>
                        <div class="ipbox">
                            <b class="r1"></b>
                            <b class="r2"></b>
                            <b class="r5"></b>
                            <div class="con">
							   <dd class="control-groupas" style="z-index:10;">
                                    <div class="quc-clearfix login-item">
                                        <label for="username">帐号：</label>
                                        <input type="text" id="username" name="account" value='' tabindex="1" class="control-label" placeholder="手机号/用户名/邮箱" autocomplete="off" maxlength="100" suggestwidth="374px" />
                                    </div>
                                </dd>
                                <dd class="control-groupas">
                                    <div class="quc-clearfix login-item">
                                        <label for="password">密码：</label>
                                        <input type="password" id="password" name="password" value='' tabindex="2" class="control-label" placeholder="请输入您的密码" maxlength="20" autocomplete="off" />
                                    </div>
									<div>
										<input type='hidden' name='token' value = '<?php echo ($token); ?>' />
									</div>
                                </dd>
                            </div>
                            <b class="r5"></b>
                            <b class="r3"></b>
                            <b class="r4"></b>
                        </div>
                        <div style="margin:0 0 10px 10px;; color:#c35d00;" id="error_box">
                            <span id="error_tips"></span>
                        </div>
                        <dd class="submit">
                            <span><input type="submit" class="login-btn" value='马上登录'/><!--<input type="submit" tabindex="4" class="login-btn" id="btn-login" value="马上登陆" />--></span>
                            <span><a href="<?php echo U('Public/ruzhu');?>" target="_blank" class="login-btn">立即入驻</a></span>
                        </dd>
                    </dl>
                </div>
                <p>已入驻用户才允许登录平台</p>
            </div>
        </div>
    </div>
	</form>
</div>

<div id="ft">
    <ul class="fn-clear">
        <li><a href="#">关于我们</a></li>
        <li><a href="#">联系我们</a></li>
        <li><a href="#">合作加盟</a></li>
    </ul>
    <p class="fn-clear">COPYRIGHT &copy; 2010 - 2016 深圳市尊豪网络技术有限公司 粤ICP备 12050060号-2</p>
</div>

<script type="text/javascript" src="/Public/Admin/js/huishuo.js"></script>
<script type="text/javascript" src="/Public/Admin/js/login.js"></script>
<script type="text/javascript" src="/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery_validate_min.js"></script>
<!-- <script type="text/javascript" src="/Public/Admin/js/public.js"></script> -->
<!-- <script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script> -->
<script type="text/javascript">
    //表单验证
      $("#formSubmit").validate({
        submitHandler: function(o) {
            var tourl = $(o).attr("action");  
            $.post(tourl,$(o).serialize(),function(data){
                if(data.status == 1){
					$("#error_tips").text(data.info);
					setTimeout(function(){
						parent.location.href=data.to_url;
					},2000)
                   /* layer.msg(data.info, {
                    time: 2000
                    }, function(){
                        parent.location.href=data.to_url;
                    }); */
                }else{
					$("#error_tips").text(data.info);
					setTimeout(function(){
					$("#error_tips").text("");
					},2000)
                   /* layer.msg(data.info, {
                    time: 2000
                    }, function(){
                         layer.closeAll();
                    });*/
                }                
            })
         }
      });
</script>
</body>
</html>