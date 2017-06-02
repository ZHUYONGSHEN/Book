<?php
namespace  Vendor\Tianyi;
class ChinaNetSMS{
	function __construct($config) {
		$this->app_id =$config['app_id'];//app_id
		$this->app_secret = $config['app_secret'];//app_secret
		$this->access_token_url = 'https://oauth.api.189.cn/emp/oauth2/v3/access_token';
		$this->authorize_url = 'https://oauth.api.189.cn/emp/oauth2/v3/authorize';
		$this->token_url = 'http://api.189.cn/v2/dm/randcode/token';
		$this->send_url = 'http://api.189.cn/v2/dm/randcode/send';
		$this->send_self_url = 'http://api.189.cn/v2/dm/randcode/sendSms';//自定义短信验证码
		$this->cacheFile ='./'.$this->app_id.'_cacheFile';//access_token保存文件
		$this->access_token = '';
		$this->token = '';
		$this->callBack = isset($config['callBack'])?$config['callBack']:'';

	 }

	 /**
	  * function:
	  * 	get access_token AC CC,if cache file access_token is not usable,throw net get access_token
	  *and write to cache file,and change the class paramas access_token value 	
	  * input:
	  * 	none
	  * output:
	  * 	string,access_token or null
	  */
	public function getAccessToken($type){
		// $access_token = $this->getCache($type.'_access_token');

		if(!$access_token){
			$data['app_id'] = $this->app_id;
			$data['app_secret'] = $this->app_secret;
			switch($type){
				case 'AC':
					$data['code'] = '123434';
					$data['grant_type'] = 'authorization_code';
					$data['redirect_uri'] = 'http://127.0.0.1';
					break;
				case 'CC':
					$data['grant_type'] = 'client_credentials';
					break;

				case 'RE':
					$data['grant_type'] = 'refresh_token';
					$data['refresh_token'] = 'access_token';
			}
			$access_token_re = $this->curl_postUn($this->access_token_url, $data);
			if($access_token_re){
				$access_token_re = json_decode($access_token_re,true);
				// var_dump($access_token_re);
				$access_token = $access_token_re['access_token'];
				// $this->setCache($type.'_access_token',$access_token_re['access_token'],intval($access_token_re['expires_in']));				
			}
		}	
		if($access_token){
			$this->access_token = $access_token;
			return $access_token;
		}		
	}

	/*
	*function: 
	*	get token by access_token.if access_token is empty,get access_token first.change class parama token
	*input:
	*	none
	*output:
	*	string,token value.or null	
	 */
	public function getToken(){
		$access_token = $this->access_token;
		if(!$access_token){
			$access_token = $this->getAccessToken('CC');
		}
		$data['app_id'] = $this->app_id;
		$data['access_token'] = $access_token;
		$data['timestamp'] = date('Y-m-d H:i:s');
		$data = $this->signData($data,$this->app_secret);
		$data = implode('&', $data);
		$token_re = $this->curl_get($this->token_url.'?'.$data, '');
		if($token_re){
			$token_re = json_decode($token_re,true);
			if(isset($token_re['token'])){
				$this->token = $token_re['token'];
				return $token_re['token'];
			}
		}
		return null;
	}

	/*
	*function:send SMS by phone number;
	*input:
	*	phone:string,valued phone number
	*output:
	*	array of send result,or null
	 */
	public function sendSMS($phone, $code='', $exp_time=2){
		if(!$this->access_token){
			$this->getAccessToken('CC');
		}
		if(!$this->token){
			$this->getToken();
		}
		$data['app_id'] = $this->app_id;
		$data['access_token'] = $this->access_token;
		$data['token'] = $this->token;
		
		$data['phone'] = $phone;
		//$data['exp_time'] = $exp_time; 天翼短信接口优化不写默认2分钟
		$data['timestamp'] = date('Y-m-d H:i:s');

		if($code!=''){
			$data['randcode'] = $code;
			$_send_url = $this->send_self_url;
		}else{
			$data['url'] = $this->callBack;
			$_send_url = $this->send_url;
		}
		$data = $this->signData($data,$this->app_secret);
		$data = implode('&', $data);
		$send_re = $this->curl_post($_send_url,$data);
		if($send_re){
			$send_re = json_decode($send_re,true);
			if(isset($send_re['identifier'])){
				return $send_re;
			}
		}
		return null;
	}	

	/*
	*function:
	*	sign array data with check_key
	*input:
	*	data:data array to sign
	*	check_key:the key to sign,string
	*output:
	*	return changed array data
	 */
	private function signData($data,$check_key){
		ksort($data);
		foreach ($data as $key => $value) {
			$data[$key] = $key.'='.$value;
		}
		$sort_str = implode('&', $data);
		$data['sign'] = 'sign='.rawurlencode(base64_encode(hash_hmac("sha1", $sort_str, $check_key, true)));
		ksort($data);
		return $data;
	}


	private function curl_postUn($url='', $postdata=''){
		//有点bug，access_token似乎只能用这个才能成功
		$post=array('Host'=>'oauth.api.189.cn');
		if(is_array($postdata))
			$url.="?".http_build_query($postdata);
		$ch=curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch,  CURLOPT_FOLLOWLOCATION, 1);//跳转
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $data = curl_exec($ch); // 执行操作
	    
	    if (curl_errno($ch)) {
	       echo 'Errno'.curl_error($ch);//捕抓异常
	    }
	    curl_close($ch);
	    return $data;
	}

	function curl_post($url='', $postdata=''){
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	    $data = curl_exec($ch);
	    curl_close($ch);
	    return $data;
	}

	private  function curl_get($url='', $paramas=''){
		if(is_array($paramas)){
				$paramas = http_build_query($paramas);
		}
		if($paramas!='')
			$url .='?'.$paramas;
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	    curl_setopt($ch,  CURLOPT_FOLLOWLOCATION, 1);//跳转
	    $data = curl_exec($ch);
	    curl_close($ch);
	    return $data;
	}

}

?>