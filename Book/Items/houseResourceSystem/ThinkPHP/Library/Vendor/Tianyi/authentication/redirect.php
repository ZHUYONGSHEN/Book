<?php
include "appSettings.php";
if(isset($_GET))
{  
    if(isset($_GET["code"]))
        $code = $_GET["code"];//AC模式得到AC授权码
    else if(isset($_GET["access_token"]))
    {    
         $access_token = $_GET["access_token"];//IG模式直接获得Access_Token
	     echo "Access_Token:".$access_token;
    }
} 

if(isset($_POST) && isset($_POST["app_id"]) && isset($_POST["app_secret"]) && isset($_POST["grant_type"]))
{
   
    $refreshtoken = $_POST['refresh_token'];
    $app_id = $_POST["app_id"];
    $app_secret = $_POST["app_secret"];
    $grant_type = $_POST["grant_type"];
   
    $send = 'app_id='.$app_id.'&app_secret='.$app_secret.'&grant_type='.$grant_type;
    if($grant_type=="refresh_token")
    $send .='&refresh_token='.$refreshtoken;
    $access_token = curl_post("https://oauth.api.189.cn/emp/oauth2/v2/access_token", $send);
    $access_token = json_decode($access_token, true);
    if($grant_type=="refresh_token")
    {
        echo "Access_Token has been refreshed!";
        echo "<br/>The latest Access_Token is ".$access_token['access_token'];
    }
}


$redirect_uri = "http://101.227.251.180:10001/open189/authentication/redirect.php";
#AC模式根据AC授权码请求Access_Token
if(!$access_token)
{  
	$send = 'app_id='.$appid.'&redirect_uri='.urlencode($redirect_uri).'&app_secret='.$appsecret.'&grant_type=authorization_code&code='.$code;
	$access_token = curl_post("https://oauth.api.189.cn/emp/oauth2/v2/access_token", $send);
	$access_token = json_decode($access_token, true);
	echo "Access_Token:".$access_token['access_token'];//AC模式得到Access_Token
    echo "<br/>Refresh_Token:".$access_token['refresh_token'];//AC模式得到Refresh_Token,可以用于刷新Access_Token
}
//print_r($access_token);

?>