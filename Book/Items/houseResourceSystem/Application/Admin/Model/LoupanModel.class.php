<?php
namespace Admin\Model;
use Think\Model;

/**
 * 新房楼盘
 */
class LoupanModel extends Model {
    protected $tablePrefix = 'xq_';
    protected $tableName   = 'loupan';
    protected $_validate   = array(
        array('hid', 'require', '请选择当前项目所属楼盘'),
        array('name', 'require', '请输入项目名称'),
        array('name', '2,20', '项目名称字数范围为2-20个字', Model::EXISTS_VALIDATE, 'length'),
        array('market_name', 'require', '请输入项目推广名称'),
        array('market_name', '2,20', '推广名称字数范围为2-20字', Model::EXISTS_VALIDATE, 'length'),
        array('property_type', 'require', '请选择物业类型'),
        array('proxy_status', 'require', '请选择代理状态'),
        array('open_date', 'require', '请选择开盘时间'),
        array('checkin_date', 'require', '请选择入住时间'),
        array('contract_start', 'require', '请选择完整合同代理时间'),
        array('contract_end', 'require', '请选择完整合同代理时间'),
        array('contract_start', 'checkContract', '合同开始时间不能大于结束时间', Model::EXISTS_VALIDATE, 'callback'),
        array('contract_end', 'checkContract', '合同开始时间不能大于结束时间', Model::EXISTS_VALIDATE, 'callback'),
        array('average_min', 'require', '请填写完整均价'),
        array('average_max', 'require', '请填写完整均价'),
        array('average_min', 'checkAverage', '最低均价不能大于最高均价', Model::EXISTS_VALIDATE, 'callback'),
        array('average_max', 'checkAverage', '最低均价不能大于最高均价', Model::EXISTS_VALIDATE, 'callback'),
        array('total_min', 'require', '请填写完整总价'),
        array('total_max', 'require', '请填写完整总价'),
        array('total_min', 'checkTotal', '最低总价不能大于最高总价', Model::EXISTS_VALIDATE, 'callback'),
        array('total_max', 'checkTotal', '最低总价不能大于最高总价', Model::EXISTS_VALIDATE, 'callback'),
        array('pay_min', 'require', '请填写完整首付比例'),
        array('pay_max', 'require', '请填写完整首付比例'),
        array('pay_min', 'checkPay', '最低首付比例不能大于最高首付比例', Model::EXISTS_VALIDATE, 'callback'),
        array('pay_max', 'checkPay', '最低首付比例不能大于最高首付比例', Model::EXISTS_VALIDATE, 'callback'),
        array('pay_min', 'checkPaySize', '请输入1~99.99之间的首付比例!', Model::EXISTS_VALIDATE, 'callback'),
        array('pay_max', 'checkPaySize', '请输入1~99.99之间的首付比例!', Model::EXISTS_VALIDATE, 'callback'),
        array('sale_total', 'require', '请填写在售盘量'),
        array('area_min', 'require', '请填写完整面积范围'),
        array('area_max', 'require', '请填写完整面积范围'),
        array('area_min', 'checkArea', '最低面积范围不能大于最高面积范围', Model::EXISTS_VALIDATE, 'callback'),
        array('area_max', 'checkArea', '最低面积范围不能大于最高面积范围', Model::EXISTS_VALIDATE, 'callback'),
        array('project_feature', 'require', '请选择项目特色'),
        array('cover_path', 'require', '请上传封面图')
    );

    protected $_auto = array(
        array('contract_start', 'getUnixTime', Model::MODEL_BOTH, 'callback', '1'),
        array('contract_end', 'getUnixTime', Model::MODEL_BOTH, 'callback', '2'),
        array('adcode', 'getAdcode', Model::MODEL_INSERT, 'callback'),
        array('create_time', 'getTime', Model::MODEL_INSERT, 'callback')
    );

    public function getPk() {
        return 'id';
    }

    public function getUnixTime($data,$name) {
        switch ($name) {
            case '1': $time_name = I('post.contract_start'); break;
            case '2': $time_name = I('post.contract_end'); break;
            default: break;
        }
        return strtotime($time_name);
    }

    public function getTime() {
        return date('Y-m-d H:i:s', time());
    }

    public function getAdcode() {
        $hid = I('post.hid');
        $adcode = M('dictionary', 'pano_')->where(array('id' => $hid))->getField('adcode');
        return $adcode;
    }


    public function checkContract() {
        $contract_start = I('post.contract_start');
        $contract_end   = I('post.contract_end');
        if ($contract_start > $contract_end) return false;
    }

    public function checkAverage() {
        $average_min = I('post.average_min');
        $average_max = I('post.average_max');
        if ($average_min > $average_max) return false;
    }

    public function checkTotal() {
        $total_min = I('post.total_min');
        $total_max = I('post.total_max');
        if ($total_min > $total_max) return false;
    }

    public function checkPay() {
        $pay_min = I('post.pay_min');
        $pay_max = I('post.pay_max');
        if ($pay_min > $pay_max) return false;
    }

    public function checkPaySize() {
        $pay_min = I('post.pay_min');
        $pay_max = I('post.pay_max');
        if ($pay_min >= 100 || $pay_min <= 0 || $pay_max >= 100 || $pay_max <= 0) return false;
    }

    public function checkArea() {
        $area_min = I('post.area_min');
        $area_max = I('post.area_max');
        if ($area_min > $area_max) return false;
    }

}