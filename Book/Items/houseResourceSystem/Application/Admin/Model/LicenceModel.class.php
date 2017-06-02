<?php
namespace Admin\Model;
use Think\Model;

/**
 * 新房预售许可证
 */
class LicenceModel extends Model {

    protected $tablePrefix = 'xq_';
    protected $tableName   = 'licence';

    protected $_validate   = array(
        array('loupan_id', 'require', '项目信息错误'),
        array('name', 'require', '请输入许可证对应栋阁'),
        array('name', '2,10', '栋阁名称字数范围为2-10个字', Model::EXISTS_VALIDATE, 'length'),
        array('licence_num', 'require', '请输入预售许可证编号'),
        array('licence_num', '2,30', '预售许可证编号字数范围为2-30个字', Model::EXISTS_VALIDATE, 'length'),
        array('licence_path', 'require', '请上传许可证图片'),
        array('licence_time', 'require', '请选择许可证到期时间')
    );

    protected $_auto = array(
        array('create_time', 'getTime', Model::MODEL_INSERT, 'callback')
    );

    public function getTime() {
        return date('Y-m-d H:i:s', time());
    }

}