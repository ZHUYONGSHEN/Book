<?php
namespace Admin\Controller;
use Think\PageAdv;

class CityController extends CommonController {

    public function __construct() {
        parent::__construct();
        $this->model_cityPrice = M('CityPrice', 'xq_');
        $this->model_city      = M('city', 'xq_');
        $this->model_area      = M('area', 'xq_');
        $this->dao_city        = D('City');
    }

    /**
     * [_mapFilter 查询字段]
     * @return [type] [description]
     */
    private function _mapFilter() {
        $province_adcode = I('get.province_code');  //所在省
        $city_adcode     = I('get.city_code');      //所在市
        $status          = I('get.status');         //开关状态
        $keyword         = I('get.keyword');        //关键字
        if (!empty($province_adcode)) {
            $where['province'] = array('like', '%' . $this->model_area->getFieldByAdcode($province_adcode, 'name') . '%');
        }
        if (!empty($city_adcode)) {
            $where['city'] = array('like', '%' . $this->model_area->getFieldByAdcode($city_adcode, 'name') . '%');
        }
        if ($status != null) {
            $where['status'] = $status;
        }
        if (!empty($keyword)) {
            $where['province|city|adcode'] = array('like', '%' . $keyword . '%');
        }
        return $where;
    }

    /**
     * [index 区域配置中心列表]
     * @return [type] [description]
     */
    public function index() {
        $where = $this->_mapFilter();
        $field = '*,if(status = 1, "开启", "关闭") as status_text';
        $list = $this->_list($this->dao_city, $where, $field);
        $province = M('area', 'xq_')->where(array('level' => 1))->field('adcode,name')->select();
        $this->assign('province', $province);
        $this->cHandler($list);
    }

    protected function _getData() {
        $post              = I('post.');
        $_POST['province'] = $this->model_area->getFieldByAdcode($post['province_adcode'], 'name');
        $_POST['city']     = $this->model_area->getFieldByAdcode($post['city_adcode'], 'name');
        $_POST['adcode']   = $post['city_adcode'];
        unset($_POST['province_adcode']);
        unset($_POST['city_adcode']);
        return $_POST;
    }

    /**
     * [addNewCity 新增可选城市]
     */
    public function addNewCity() {
        $this->_getData();
        if (!$this->dao_city->create()) $this->msgBack(0, $this->dao_city->getError());
        if (!$this->dao_city->add()) $this->msgBack(0, '添加失败');
        $data = $this->model_city->field('*,if(status = 1, "开启", "关闭") as status_text')->where(array('id' => $res))->find();
        $this->msgBack(1, 'success', '', $data);
    }

    /**
     * [getCityDetail 获取一个城市详细信息]
     * @return [type] [description]
     */
    public function getCityDetail() {
        $where['id'] = I('post.city_id');
        $res = $this->model_city->where($where)->field('id,adcode,province,city')->find();
        $res['province_adcode'] = substr($res['adcode'],0,2).'0000';
        $this->msgBack(1, 'success', '', $res);
    }

    /**
     * [editCity 编辑城市内容]
     * @return [type] [description]
     */
    public function editCity() {
        $this->_getData();
        $id = I('post.id');
        if (!$this->dao_city->create()) $this->msgBack(0, $this->dao_city->getError());
        $res = $this->dao_city->where(array('id' => $id))->save();
        if ($res == false){
            $this->msgBack(0, '修改失败');
        }else if($res == 0){
            $this->msgBack(0, '无修改');
        }else{
            $data = $this->model_city->field('*,if(status = 1, "开启", "关闭") as status_text')->where(array('id' => $id))->find();
            $this->msgBack(2, 'success', '', $data);
        }
    }

    /**
     * [getCityPrice 获取城市区间价格]
     * @return [type] [description]
     */
    public function getCityPrice() {
        $id = I('post.city_id');
        $price = $this->model_city->field('id,city,min_price,max_price')->where(array('id' => $id))->find();
        $res['price_area'] = $this->model_cityPrice->field('start_price,end_price')->where(array('city_id' => $id))->select();
        $res['min_price']  = $price['min_price'];
        $res['max_price']  = $price['max_price'];
        $res['city_id']    = $price['id'];
        $res['city']       = $price['city'];
        $this->msgBack(1, 'success', '', $res);
    }

    /**
     * [editPrice 添加/修改城市价格搜索条件]
     * @return [type] [description]
     */
    public function editPrice() {
        $data        = array();
        $start_price = I('post.start_price');
        $end_price   = I('post.end_price');
        $city_id     = I('post.city_id');
        if (!$this->dao_city->create()) $this->msgBack(0, $this->dao_city->getError());
        if (empty($city_id)) $this->msgBack(0, '缺少必要参数');
        foreach ($start_price as $key => $val) {
            if (empty($start_price[$key]) || empty($end_price[$key])) {
                $this->msgBack(0, '价格区间不能为空');
            }
            if ($start_price[$key] > $end_price[$key]) {
                $this->msgBack(0, '起始价格不能大于结束价格');
            }
            $data[$key]['city_id']     = $city_id;
            $data[$key]['start_price'] = $start_price[$key];
            $data[$key]['end_price']   = $end_price[$key];
            $data[$key]['create_time'] = date('Y-m-d H:i:s', time());
        }
        $this->model_cityPrice->where(array('city_id' => $city_id))->delete();
        $priceRes = $this->model_cityPrice->addAll($data);
        $cityRes  = $this->dao_city->where(array('id' => $city_id))->save();
        //if (!$cityRes || !$priceRes) $this->msgBack(0, '添加失败');
        $this->msgBack(1, 'success');
    }

    /**
     * [delCity 删除城市]
     * @return [type] [description]
     */
    public function delCity() {
        $where['id']    = I('post.id');
        $map['city_id'] = $this->model_city->where($where)->getField('id');
        $price_res      = $this->model_cityPrice->where($map)->delete();
        $city_res       = $this->model_city->where($where)->delete();
        if (!$city_res) $this->msgBack(0, '操作失败');
        $this->msgBack(1, 'success');
    }

}