<?php
namespace Admin\Model;
use Think\Model;

class CityModel extends Model {
    protected $tablePrefix = 'xq_';
    protected $tableName   = 'city';
    protected $_validate   = array(
        array('province', 'require', '请选择省份'),
        array('city', 'require', '请选择城市'),
        array('adcode', 'require', '请选择到城市'),
        array('adcode', '', '该城市已添加,请选择其他城市', Model::EXISTS_VALIDATE, 'unique', Model::MODEL_INSERT),
        array('min_price', 'require', '请填写价格内容'),
        array('max_price', 'require', '请填写价格内容'),
        array('min_price', '0,6', '价格区间请限制在0-6位数字内', Model::EXISTS_VALIDATE, 'length'),
        array('max_price', '0,6', '价格区间请限制在0-6位数字内', Model::EXISTS_VALIDATE, 'length'),
        array('min_price', 'checkPirce', '最小价格不能大于最大价格', Model::EXISTS_VALIDATE, 'callback'),
        array('max_price', 'checkPirce', '最小价格不能大于最大价格', Model::EXISTS_VALIDATE, 'callback'),
    );

    /**
     * [checkPirce description]
     * @return [type] [description]
     */
    public function checkPirce() {
        $min_price = I('post.min_price');
        $max_price = I('post.max_price');
        if ($min_price > $max_price) return false;
    }

}