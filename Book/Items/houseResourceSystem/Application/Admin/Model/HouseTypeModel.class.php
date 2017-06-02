<?php
namespace Admin\Model;
use Think\Model;

class HouseTypeModel extends Model {

    protected $tablePrefix = 'xq_';
    protected $tableName   = 'huxing';
    protected $_validate   = array(
        array('name', 'require', '请输入户型名称'),
        array('name', '2,10', '请输入2-10个字的正确户型名称', Model::EXISTS_VALIDATE, 'length'),
        array('average_price', 'require', '请输入均价'),
        array('average_price', '1,6', '请输入1-999999的正确均价', Model::EXISTS_VALIDATE, 'length'),
        array('sale_type', array(0, 1, 2), '请选择正确的销售状态', Model::EXISTS_VALIDATE, 'in'),
        array('room_count', 'require', '请输入房间数'),
        array('hall_count', 'require', '请输入客厅数'),
        array('toilet_count', 'require', '请输入卫生间数'),
        array('build_area', 'require', '请输入建筑面积'),
        array('house_area', 'require', '请输入套内面积'),
        array('house_path', 'require', '请上传户型图'),
        array('orientation', 'require', '请选择朝向')
    );

    protected $_auto = array(
        array('create_time', 'getTime', Model::MODEL_INSERT, 'callback')
    );

    public function getTime() {
        return date('Y-m-d H:i:s', time());
    }

}