<?php

defined('THINK_PATH') or exit('No Access!');
$config = array(
    /* COOKIE AND SESSION PREFIX */
    'SESSION_PREFIX' => 'Admin',
    'COOKIE_PREFIX' => 'Admin',
    'URL_MODEL' => 2,
    /* 新增模板中替换字符串 */
    'TMPL_PARSE_STRING' => array(
        '__UPLOAD__' => __ROOT__ . '/Uploads',
        '__PUBLIC__' => __ROOT__ . '/Public/Admin',
        '__CSS__' => __ROOT__ . '/Public/Admin/css',
        '__IMG__' => __ROOT__ . '/Public/Admin/img',
        '__IMAGE__' => __ROOT__ . '/Public/Admin/images',
        '__JS__' => __ROOT__ . '/Public/Admin/js',
        '__LAYER__' => __ROOT__ . '/Public/Admin/layer',
        '__TPLS__' => __ROOT__ . '/Public/Admin/template',
        '__THEME__' => __ROOT__ . '/Public/Admin/theme',
        '__DEFAULT_IMG__' => '/Public/Admin/images',
        'IMAGE_BASE_URL' => 'https://test.hiweixiao.com/Public/Uploads/',
    ),
    'IMAGE_BASE_URL' => __ROOT__ . '/Public/Uploads/',
    'API_DOMAIN' => 'http://test.xiaoq.hiweixiao.com',
    'API_IMAGE_BASE_URL' => 'http://test.xiaoq.hiweixiao.com/Public/Uploads/',
    'UPLOAD_FLOAD' => 'Public/Uploads',
    'DEFAULT_IMAGES' => '/Public/Admin/images/default.png',
    // 默认参数过滤方法 用于 $this->_get('变量名');$this->_post('变量名')...
    'DEFAULT_FILTER' => 'trim,htmlspecialchars',
    /* 分页 */      
    'PAGE_LISTROWS' => 15,
    'UPLOAD_FILE_RULE' => 'uniqid',
    //提示信息模板
    'TMPL_ACTION_SUCCESS' => 'Public/message', //成功信息模板
    'TMPL_ACTION_ERROR' => 'Public/error', //错误的信息模板
    'DEFAULT_THEME' => '', //默认模板
    'URL_HTML_SUFFIX' => '',
    'SITE_URL' => '/',
    'APP_URL' => 'http://' . $_SERVER['SERVER_NAME'],
    'LINKER_URL' => 'https://test.hiweixiao.com',
    'BASE_HB_URL' => 'http://testh5.szzunhao.com',
    'MAJ_INDEX' => 'http://test.fang.zooming-data.com',//美安居首页接口地址
    //语言设置
    'LANG_SWITCH_ON' => true,
    'DEFAULT_LANG' => 'zh-cn', // 默认语言
    'LANG_AUTO_DETECT' => true, // 自动侦测语言
    /* 载入扩展配置 */
    'LOAD_EXT_CONFIG' => 'user,icon',
    /* 不能删除的商家角色，开发商代理商 */
    'UN_CHANGE_OPERATE_ROLE' => array('1', '2', '3','4'),
    //角色配置
    'ROLE_CONF' => array(
        1 => array('id' => '1', 'name' => '代理商'),
        2 => array('id' => '2', 'name' => '开发商'),
        3 => array('id' => '3', 'name' => '操作员'),
        4 => array('id' => '4', 'name' => '区域自营'),
    ),
   //角色组
   'ADMIN_ROLE' => array('1','4'),
   'IS_PRODUCT' => 'false',

    // 'TOKEN_ON'      =>    true,  // 开启令牌验证
    // 'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称
    // 'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则
    // 'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌
);
return $config;
?>