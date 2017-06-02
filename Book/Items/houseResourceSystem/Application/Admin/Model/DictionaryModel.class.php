<?php
namespace Admin\Model;
use Think\Model;

class DictionaryModel extends Model {
	protected $_validate = array(
		array('name', 'require', '楼盘名称必填', 1, 'regex', 3),
		//array('hid', 'require', '楼盘框架中暂无该楼盘，暂不能添加', 1, 'regex', 3),
		//array('hid', 'unique', '该楼盘已存在，请勿重复添加', 1, 'regex', 3),
		array('province_code', 'require', '省份必选', 1, 'regex', 3),
		array('city_code', 'require', '城市必选', 1, 'regex', 3),
		array('district_code', 'require', '县区必选', 1, 'regex', 3),
		array('detail_address', 'require', '楼盘地址必填', 1, 'regex', 3),
		array('build_year', 'number', '竣工年代只能输入数字', 2, 'regex', 3),
		array('management_price','currency', '物业费用格式不正确', 2, 'regex', 3),
		array('average_price','currency', '成交均价格式不正确', 2, 'regex', 3),
		array('plot_rate', 'number', '容积率只能输入数字', 2, 'regex', 3),
		array('green_rate', 'number', '绿化率只能输入数字', 2, 'regex', 3),
		array('build_area','currency', '总面积格式不正确', 2, 'regex', 3),
		array('household_num', 'number', '总户数只能输入数字', 2, 'regex', 3),
		array('car_num', 'number', '车位总数只能输入数字', 2, 'regex', 3),
		array('build_num', 'number', '栋座总数只能输入数字', 2, 'regex', 3),
		array('developer', '1,50', '开发商的值最长不能超过 50 个字符！', 2, 'length', 3),
		array('management', '1,50', '物业公司的值最长不能超过 50 个字符！', 2, 'length', 3),
		array('build_content', '1,500', '小区简介的值最长不能超过 500 个字符！', 2, 'length', 3),
		array('traffic', '1,500', '周边公交的值最长不能超过 500 个字符！', 2, 'length', 3),
		array('hospital', '1,500', '周边医院的值最长不能超过 500 个字符！', 2, 'length', 3),
		array('business', '1,500', '周边商业的值最长不能超过 500 个字符！', 2, 'length', 3),
		
		
	
	);

    protected $_map = array(
        'country_code'  => 'district_code',
    );
	protected function _before_insert(&$data, $option){
		$hid = $data['hid'];
		if (!$hid){
			$this->error = '该楼盘不在楼盘框架，暂不能添加！';
			return false;
		}
		$where['hid'] = array('eq',$hid);
		$row = $this->where($where)->find();
		if ($row){
			$this->error = '该楼盘已经添加，请换个楼盘！';
			return false;
		}
		$data['input_user'] = session('loginAccount');
		$data['create_time'] = time();

		}

	protected function _before_update(&$data, $option){
		$id = $option['where']['id'];
		$hid = $data['hid'];
		if (!$hid){
		$this->error = '该楼盘不在楼盘框架，暂不能添加！';
		return false;
		}
		$where['hid'] = array('eq',$hid);
		$row = $this->where($where)->find();
		if ($row && $row['id']!=$id){
			$this->error = '该楼盘已经添加，请换个楼盘！';
			return false;
		}
	}
	protected function _after_insert($data, $options){
		$befor_str = '新增楼盘字典-';
		$log['note'] = $befor_str."'".$data['name']."'";
		$log['type'] = 2;
		$log['create_time'] = $data['create_time'];
		$log['admin_name'] = session('loginAccount');
		M('Log', 'pano_')->add($log);
	}
	protected function _after_update($data, $options){
		$befor_str = '修改楼盘字典-';
		$log['note'] = $befor_str."'".$data['name']."'";
		$log['type'] = 2;
		$log['create_time'] = time();
		$log['admin_name'] = session('loginAccount');
		M('Log', 'pano_')->add($log);
	}
	protected function _before_delete($options){
		$data = $this->field('name')->find($options);
		$befor_str = '删除楼盘字典-';
		$log['note'] = $befor_str."'".$data['name']."'";
		$log['type'] = 2;
		$log['create_time'] = time();
		$log['admin_name'] = session('loginAccount');
		M('Log', 'pano_')->add($log);
	}
}