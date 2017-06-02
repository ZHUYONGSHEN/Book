<?php
defined('THINK_PATH') or exit('No Access!');

return array(
	//正在用的测试环境
    'REDIS_HOST'             => '127.0.0.1 ', // 数据库类型
    'REDIS_PORT'             => '6379', // 服务器地址
    'REDIS_EXPIRE'           =>  10*60, // redis 缓存时间
	'REDIS_PREFIX'			 => 'CS_PHP_', // redis 数据缓存前缀
	'REDIS_PERSISTENT'		 => false ,//当值为 true时表示用pconnect连接,否则用conncet 连接,
	'REDIS_TIMEOUT'		 	=> '' ,		//连接过期时间,不设置则表示永远不过期
	'REDIS_PWD' 			=> '75OghhjzWPvbDPr0',
	//'REDIS_INSTANCEID'       => 'd8a0f0ed-29e0-458a-8b0e-f48f5a0413a8', // 腾讯云的redis云服务的实例
	//'REDIS_INSTANCEID_PWD'              => 'Zunhao0123', // 腾讯云的redis云服务的实例
	
	
	
	/* ------------------------------------- */
	//本地环境
/*	'REDIS_HOST'           => '127.0.0.1', // 数据库类型
	'REDIS_PORT'           => '6379', // 服务器地址
	'REDIS_EXPIRE'         => '3600', // redis 缓存时间
	'REDIS_PREFIX'			=> 'zfphp_', // redis 数据缓存前缀
	'REDIS_PERSISTENT'		=> false ,//当值为 true时表示用pconnect连接,否则用conncet 连接,
	'REDIS_TIMEOUT'		 	=> '0' ,		//连接时间,不设置表示不限链接时间.*/

);




?>
