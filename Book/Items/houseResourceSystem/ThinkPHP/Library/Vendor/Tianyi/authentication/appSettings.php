<?php 
    $appid = "423527170000036031";
    $appsecret = "58dcfeaa3db56a21079f4c6accbf5a74";
    $redirectUri = "http://101.227.251.180:10001/open189/authentication/redirect.php";
    $authorizeAPI = "https://oauth.api.189.cn/emp/oauth2/v3/authorize";
    $tokenAPI = "https://oauth.api.189.cn/emp/oauth2/v3/access_token";
/**
 * curl�ຯ��
 */
//post��ʽ�ύ��ȡ���
function curl_post($url='', $postdata='', $options=array()){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    if (!empty($options)){
        curl_setopt_array($ch, $options);
    }
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

//get��ʽ�ύ��ȡ���
function curl_get($url='', $options=array()){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    if (!empty($options)){
        curl_setopt_array($ch, $options);
    }
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
?>