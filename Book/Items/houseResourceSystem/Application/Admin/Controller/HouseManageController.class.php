<?php

namespace Admin\Controller;
use Think\PageAdv;
use Service\Service;

class HouseManageController extends CommonController {

    // protected $model_area;
    public function __construct() {
        parent::__construct();
        $this->model_area = M('Area', 'zf_');
    }
    
    /**
     * 查询提交数据筛选过滤
     * @return array 结果集
     */
    private function _mapFilter() {
		$house_name    = I('get.house_name', '', 'trim');
		$house_title    = I('get.house_title', '', 'trim');
		$house_from     = I('get.house_from', '', 'trim');
		$audit_status     = I('get.audit_status', '', 'trim');	
		if (!empty($house_name)) {
			$where['HouseResource.house_name'] = array('like', "%" . $house_name . "%");
		}
		if (!empty($house_title)) {
			$where['HouseResource.house_title'] = array('like', "%" . $house_title . "%");
		}
		if (!empty($house_from) && $house_from != -1) {
			$where['HouseResource.house_from'] = $house_from;
		}
		if (is_numeric($audit_status) && $audit_status != -1) {
			$where['HouseResource.audit_status'] = $audit_status;
		}
		return $where;
    }
    
	/**
	 * 二手房房源管理
	 * @author dz
	 * */
	public function houseList() {
		$where = $this->_mapFilter();
		// $where['HouseResource.status'] = 1; // TODO
		// $where['HouseResource.hid'] = array('NEQ', 0); // TODO
		$model = D('HouseResourceView')->distinct(true);
		C('TOKEN_ON',false);
		// $order = 'HouseResource.id desc';
		$list = $this->_list($model, $where);
		foreach ($list as $key => $value) {
			if (!empty($value['hid'])) {
				$data = D('HouseResourcePartView')->where(array('HouseResource.id' => $value['id']))->find();
				$list[$key] = array_merge($value, $data);
			}
			$total = !empty($value['hrtotal_floor']) ? $value['hrtotal_floor'] : $value['hftotal_floor'];
			$value['floor'] = $value['floor'] . '/' . $total;
			// 字数限制换行
			$list[$key]['house_title'] = '<a href="' . U('houseDetail', array('id' => $value['id'])) . '">' . $value['house_title'] . '</a>';
			$list[$key]['house_name'] = $value['house_name'];
			$list[$key]['house_building'] = $value['house_building'];
			$list[$key]['room_no'] = $value['room_no'];
			$list[$key]['floor'] = $value['floor'];
			$list[$key]['link'] = '<a href="' . C('LINKER_URL') . '/Panorama/Linker/index/l/' . $value['id'] . '" target="_blank"><img src="' . C('TMPL_PARSE_STRING.__IMG__') . '/link_icon.png" /></a>';
			$urls[$key][]          = array('btn_word' => '删除', 'btn_url' => U('delResource', array('id' => $value['id'])), 'is_ajax' => '', 'addClass' => 'delete', 'imgurl' => C('TMPL_PARSE_STRING.__IMG__') . '/delete_icon.png');
			// $urls[$key][]          = array('btn_word' => '审核', 'btn_url' => U('changeStatus', array('id' => $value['id'])), 'is_ajax' => 1);
			$list[$key]['acturl'] = $urls[$key];
		}
		$this->cHandler($list);
	}

	public function delResource()
	{
		$where['id'] = I('get.id', 0, 'intval');
        if (empty($where['id'])) {
            $this->msgBack(0, '请指定要删除的数据');
        }
        
        $data = M('HouseResource')->where($where)->field('house_name')->find();
		$befor_str = '删除房源管理-';
		$log['note'] = $befor_str."'".$data['house_name']."'";
		$log['type'] = 3;
		$log['create_time'] = time();
		$log['admin_name'] = session('loginAccount');
		M('Log', 'pano_')->add($log);
		
        // M('HouseResource')->where($where)->setField('status', 0);
        M('HouseResource')->where($where)->delete();
        $this->msgBack(1, '删除成功', U('houseList'));
	}

	public function houseDetail()
	{
		$where['HouseResource.id'] = $img_where['rid'] = I('get.id', 0, 'intval');
		$group = I('get.group', '', 'trim');
		!empty($group) && $img_where['scene'] = $group;
		$list = M('ResourcePhoto')->where($img_where)->field('CONCAT("'.C(IMAGE_BASE_URL).'Qpano/",img_4k) as image')->select();
		$this->assign('list', $list);
		$house = D('HouseResourceView')->where($where)->find();
		$house_part = D('HouseResourcePartView')->where(array('HouseResource.id' => $house['id']))->find();
		$house = array_merge($house, $house_part);
		$house['build_type'] = $this->getBuildType($house['build_type']);
		$house['house_use'] = $this->getUseType($house['house_use']);
		$house['house_tips'] = explode(',', $house['house_tips']);
		$house['head_url'] = M('ResourcePhoto')->getFieldByRid($house['id'], 'img_4k');
		$house['head_url'] = C(IMAGE_BASE_URL) . 'Qpano/' . $house['head_url'];
		$house['house_certificate'] = $house['house_certificate'] ? C(IMAGE_BASE_URL) . 'Qpano/' . $house['house_certificate'] : '';
		$house['owner_id_card'] = $house['owner_id_card'] ? C(IMAGE_BASE_URL) . 'Qpano/' . $house['owner_id_card'] : '';
		$house['owner_delegation'] = $house['owner_delegation'] ? C(IMAGE_BASE_URL) . 'Qpano/' . $house['owner_delegation'] : '';
		$total = !empty($house['hrtotal_floor']) ? $house['hrtotal_floor'] : $house['hftotal_floor'];
		$house['floor'] = $house['floor'] . '/' . $total;
		$this->assign($house);
		$this->assign('imglist', $list);
		$this->display();
	}

	public function allImage()
	{
		$where['rid'] = I('get.id', 0, 'intval');
		$group = I('get.group', '', 'trim');
		!empty($group) && $where['scene'] = $group;
		$list = M('ResourcePhoto')->where($where)->field('CONCAT("'.C(IMAGE_BASE_URL).'Qpano/",img_4k) as image')->select();
		$this->assign('list', $list);
		$this->display();
	}

	public function groupImage()
	{
		$where['rid'] = I('get.id', 0, 'intval');
		$list = M('ResourcePhoto')->where($where)->field('rid as id,CONCAT("'.C(IMAGE_BASE_URL).'Qpano/",img_4k) as image, COUNT(id) as sum, scene as g')->group('scene')->select();
		$this->assign('list', $list);
		$this->display();
	}
	
	public function getBuildType($type)
	{	
		switch (intval($type)) {
			case 1:
				return '钢筋混凝土结构';
			case 2:
				return '搭板结构';
			default:
				return '';
		}
	}
	
	public function getUseType($type)
	{
		switch (intval($type)) {
			case 1:
				return '普通住在';
			case 2:
				return '商住两用';
			case 3:
				return '商品房';
			default:
				return '';
		}
	}
}
