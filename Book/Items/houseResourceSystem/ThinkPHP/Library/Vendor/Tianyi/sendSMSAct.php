<?php
require './ChinaNetSMS.class.php';
session_start();
$file_name = './cache/code';

if(isset($_POST['phone']) && $_POST['code']==''){
	//只提交了手机号
	$chinaNetSMS = new ChinaNetSMS();
	$acc = $chinaNetSMS->sendSMS($_POST['phone']);

	if($acc){
		$_SESSION['phone']=$_POST['phone'];
		$_SESSION['identifier'] = $acc['identifier'];
		die('send success');
	}else{
		die('send error');
	}


}else if(isset($_POST['phone']) && $_POST['code']!=''){
	if(isset($_SESSION['identifier'])){
		$identifier = $_SESSION['identifier'];
		$file_content = file_get_contents($file_name);
		if($file_content){
			$file_content = unserialize($file_content);
			if(isset($file_content[$identifier]) && $file_content[$identifier] == $_POST['code']){
				die('check success');
			}
		}		
	}

	echo 'check error';
}


?>