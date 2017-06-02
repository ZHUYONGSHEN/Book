<html>
<head>
<title>天翼开放平台OAuth2.0认证授权接口示例</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    fieldset
    {
        margin-top:30px;
    }
</style>
<script>
    function checkRefresh_token()
    {
        if(document.getElementById('refresh_token').value=="" )
        {  
            alert("请输入您的Refresh_Token");
            return false;
        }
        else
            return true;
    }
</script>
</head>
<body>
    <?php 
	include "appSettings.php";
    ?>
    <h2 style="text-align:center">天翼开放平台认证授权接口示例 for PHP SDK</h2>
    <form method="post" action="../test.php">
        <div>
            <fieldset>
                <legend>AC模式</legend>
                AppID:<input name="app_id" type="text" value="<?php echo $appid?>" readonly= "readonly" />
                RedirectUri:<input name="redirect_uri" type="text" value="<?php echo $redirectUri ?>" readonly= "readonly" />
                ResponseType:<input name="response_type" type="text" value="code" readonly= "readonly" /> 
                <input name="btn_acauth" type="submit" value="认证授权">
            </fieldset>
        </div>
    </form>
    
    <form method="post" action="<?php echo $authorizeAPI ?>">
        <div>
            <fieldset>
                <legend>IG模式</legend>
                AppID: <input name="app_id" type="text" value="<?php echo $appid?>" readonly= "readonly" />
                AppSecret:<input name="app_secret" type="text" value="<?php echo $appsecret ?>" readonly= "readonly" />
                RedirectUri:<input name="redirect_uri" type="text" value="<?php echo $redirectUri ?>" readonly= "readonly" />
                ResponseType: <input name="response_type" type="text" value="token"  readonly= "readonly"  />
                <input name="btn_igauth" type="submit" value="认证授权"/>
            </fieldset>
        </div>
    </form>

    <form method="post" action="<?php echo $tokenAPI ?>">
        <div>
            <fieldset>
                <legend>CC模式</legend>
                AppID:<input name="app_id" type="text" value="<?php echo $appid ?>" readonly= "readonly" />
                AppSecret: <input name="app_secret" type="text" value="<?php echo $appsecret ?>" readonly= "readonly" />
                GrantType: <input name="grant_type" type="text" value="client_credentials" readonly= "readonly" />
                <input name="btn_ccauth" type="submit" value="认证授权" />
            </fieldset>
        </div>
    </form>

    <form method="post" action="redirect.php">
    	<div>
	    <fieldset>
	    	<legend>刷新令牌</legend>
		    AppID:<input name="app_id" type="text" value="<?php echo $appid ?>" readonly= "readonly" />
            AppSecret: <input name="app_secret" type="text" value="<?php echo $appsecret ?>" readonly= "readonly" />
            GrantType: <input name="grant_type" type="text" value="refresh_token" readonly= "readonly" />
            RefreshToken:<input id= "refresh_token" name="refresh_token" type="text" value="" />
            <input name="btn_refresh" type="submit" value="认证授权" onclick="return checkRefresh_token();" />
        </fieldset>
    </form>	
</body>
</html>
