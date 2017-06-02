<?php

define('__COMURL__', 'http://house.map.qq.com/');
define('__TUURL__', 'http://www.hiweixiao.com/');
return array(
    //'配置项'=>'配置值'
    'LOAD_EXT_CONFIG' => 'db,redis',
	'DEFAULT_MODULE' => 'Admin',    
	'DEFAULT_ROLE' => '工作人员',
    'DEVELOPER_ROLE_ID' => 1,
    'AGENT_ROLE_ID' => 2,
    'URL_MODEL' => 2, // 如果你的环境不支持PATHINFO 请设置为3
    'UBAC_ACTION_TABLE' => 'operate_action',
    'UBAC_USER_TABLE' => 'operate_staff',
    'OPERATE_OPERATE_ROLE' => 'operate',
    'OPERATE_DEVELOPER_ROLE' => 'developer',
    'OPERATE_STAFF_ROLE' => 'staff',
    'OPERATE_ADMIN_ROLE' => 'admin',
    //设置cookie共享域名
    'COOKIE_DOMAIN' => '.hiweixiao.com',
);
