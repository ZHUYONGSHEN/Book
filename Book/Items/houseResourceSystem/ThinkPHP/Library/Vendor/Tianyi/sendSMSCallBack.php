<?php


$data['post'] = $_POST;
$data['get'] = $_GET;
$log = date('Y-m-d H:i:s')."\n".serialize($data);

if(isset($_POST['rand_code']) && isset($_POST['identifier'])){
	$rand_code = $_POST['rand_code'];
	$identifire = $_POST['identifier'];
	// $content = file_get_contents($file_name);
	// $re_data = array($identifire=>$rand_code);
	// if($content){
	// 	$content = unserialize($content);
	// }else{
	// 	$content = array();
	// }
	// $content = array_merge($content,$re_data);
	// file_put_contents($file_name,serialize($content));
	die('{"res_code":0}');
}else{
	die('{"res_code":1}');
}

