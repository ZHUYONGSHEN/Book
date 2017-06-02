<?php
namespace Admin\Controller;
use Org\Net\UploadFile;
use Think\PageAdv;
class LogController extends CommonController {

    protected $model;
    public function __construct() {
        parent::__construct();
        $this->model = D(CONTROLLER_NAME);
        C('TOKEN_ON', false);
    }
    
    /**
     * 查询提交数据筛选过滤
     * @return array 结果集
     */
    private function _mapFilter() {
    	// 添加时间
		$fa = strtotime(I('get.sta_time'));
		$ta = strtotime(I('get.end_time'));
		$type = I('get.type');
		if($fa && $ta)
			$where['create_time'] = array('between', array($fa, $ta)); 
		elseif ($fa)
			$where['create_time'] = array('egt', $fa);   
		elseif ($ta)
			$where['create_time'] = array('elt', $ta);   
        if (!$type){
        	$where['type'] = array('IN', array(2, 3));  
        }else{
        	$where['type'] = array('eq', $type);  
        }
    	   
			 return $where;
    }

    /**
     * 小区列表
     * @author dz
     */
    public function index() {
		$where = $this->_mapFilter();
        $field = 'id, note, type,FROM_UNIXTIME(create_time) as create_time,admin_name';
        $count = $this->model->Distinct(true)->where($where)->count();
        $p     = new PageAdv($count, C('PAGE_LISTROWS'));
        $list  = $this->model->Distinct(true)->field($field)->where($where)->limit($p->firstRow . ',' . $p->listRows)->order('id DESC')->select();
        $page  = $p->show();
        $this->assign("page", $page);
        $this->cHandler($list);
    }


}
