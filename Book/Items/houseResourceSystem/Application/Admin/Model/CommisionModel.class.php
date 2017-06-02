<?php
namespace Admin\Model;
use Think\Model;

/**
 * 佣金
 */
class CommisionModel extends Model {
    protected $tablePrefix = 'xq_';
    protected $tableName   = 'commision';
    protected $_validate   = array(
        array('loupan_id', 'require', '项目ID必传'),
        array('property_id', 'require', '请选择物业类型'),
        array('count_type', 'require', '请选择结算标准')
    );
    
}