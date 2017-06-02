<?php
namespace Admin\Model;
use Think\Model;

/**
 * 新房楼盘
 */
class HouseModel extends Model {
    protected $tablePrefix = 'zf_';
    protected $tableName   = 'loupan';
    protected $_validate   = array(
        array('kaifashang_id', 'require', '请选择开发商'),
        array('name', 'require', '楼盘名称必填'),
        array('name', 'checkName', '楼盘名称不能超过10个字', 2, 'callback'),
        array('jianzhu_area', 'double', '建筑面积只能为数字'),
        array('zhandi_area', 'double', '占地面积只能为数字'),
        array('city', 'require', '区域（城市）录入错误，请重新选择'),
        array('country', 'require', '区域（区县）录入错误，请重新选择'),
        array('min_area', 'require', '户型最小面积必填'),
        array('min_area', 'double', '户型最小面积只能为数字'),
        array('max_area', 'require', '户型最大面积必填'),
        array('max_area', 'double', '户型最大面积只能为数字'),
        array('loupan_address', 'require', '楼盘街道地址必填'),
        array('xiangmu_intro', 'require', '项目简介必填'),
        array('telphone', 'require', '联系电话必填'),
    );

    protected $_auto = array(
        array('allow', 0),
        array('add_staff', 'sessionPid', 1, 'callback'),
        array('is_show', 'hidden'),
        array('xiaoshou_status', 'getSaleStatus', 3, 'callback'),
        array('geohash', 'getGeohash', 3, 'function'),
        array('loupan_address', 'getAddress', 3, 'callback'),
        array('kaifashang_id', 'getDev', 1, 'callback'),
    );
    /**
     * 填充add_staff字段
     * @return string
     */
    public function sessionPid() {
        return session(C('USER_AUTH_KEY'));
    }
    /**
     * 填充xiaoshou_status字段
     * @return string 销售状态
     */
    public function getSaleStatus() {
        $xiaoshou = I('post.xiaoshou');
        if ($xiaoshou == 'sale') {
            return '在售';
        }
        if ($xiaoshou == 'rent') {
            return '招租';
        }
        if ($xiaoshou == 'wait') {
            return '待售';
        }
        if ($xiaoshou == 'over') {
            return '售罄';
        }
        if ($xiaoshou == 'pending') {
            return '待定';
        }
        if ($xiaoshou == 'invest') {
            return '招商';
        }
        if ($xiaoshou == '') {
            return '';
        }
    }
    /**
     * 检查楼盘名称格式
     */
    public function checkName() {
        $name = I('post.name');
        if (strlen($name) > 30) {
            return false;
        } else {
            return $name;
        }
    }
    /**
     * 获取完整楼盘地址
     * @return string
     */
    public function getAddress() {
        $is_city = M('Area')->where(array('id' => I('post.provice_id')))->getField('is_city');
        $address = I('post.loupan_address');
        $hid     = I('post.hid', 0, 'intval');
        if ($is_city) {
            return concatAddress(trim($address), I('post.adcode'), true);
        } else {
            return concatAddress(trim($address), I('post.adcode'));
        }
    }
    /**
     * 获取开发商名称
     */
    public function getDev() {
        return M('Dev')->getFieldById(I('post.kaifashang_id'), 'name');
    }
}