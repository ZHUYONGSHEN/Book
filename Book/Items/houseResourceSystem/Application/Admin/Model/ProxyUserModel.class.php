<?php
namespace Admin\Model;
use Think\Model;
/**
 * 管理员表模型
 * */
class ProxyUserModel extends Model{
    protected $tablePrefix = 'operate_';
    protected $tableName = 'user';
    protected $_validate = array(
        array('account', 'require', '帐号必填'),
        array('account', '/1[3458]{1}\d{9}$/', '帐号名请输入正确的手机号格式', Model::EXISTS_VALIDATE, 'regex'),
        array('account', '', '帐号已存在！', Model::EXISTS_VALIDATE, 'unique'),
        array('password', 'require', '密码必须填写！'),
        array('repassword', 'password', '二次输入的密码不一致', Model::MUST_VALIDATE, 'confirm'),
        array('password', '6,200', '密码不符合规则密码长度至少要6位', Model::EXISTS_VALIDATE, 'length'),
    );
    protected $_auto = array(
        array('role_id', '2', 1),
        array('create_time', 'time', 1, 'function'),
        array('last_login_time', 'time', 1, 'function'),
        array('parent_id', 'getParentId', 1, 'callback'),
    );

    public function getParentId() {
        return session(C('USER_AUTH_KEY'));
    }
}