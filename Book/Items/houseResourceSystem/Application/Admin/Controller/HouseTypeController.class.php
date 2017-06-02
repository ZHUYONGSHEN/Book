<?php
namespace Admin\Controller;
use Think\PageList;
use Think\PageAdv;
use Think\Page;

/**
 * 项目户型管理
 */
class HouseTypeController extends CommonController {

    public function __construct() {
        parent::__construct();
        $this->model_huxing = M('huxing', 'xq_');
        $this->model_loupan = M('loupan', 'xq_');
        $this->dao_huxing   = D('HouseType');
    }

    /**
     * [index 户型管理列表]
     * @return [type] [description]
     */
    public function index() {
        $sale_type = I('get.sale_type');
        $id        = I('get.id');
        $where['loupan_id'] = $id;
        if ($sale_type != null) {
            $where['sale_type'] = $sale_type;
        }
        $data = $this->model_loupan
                     ->alias('l')
                     ->field('l.id,
                              l.name,
                              l.status,
                              d.name as hname,
                              if(proxy_status = 1, "代理中", if(proxy_status = 2, "代理中止", "已完结")) as proxy_status_text')
                     ->join('left join pano_dictionary d on d.id = l.hid')
                     ->where(array('l.id' => $id))
                     ->find();
        $count = $this->model_huxing->where($where)->count('id'); //取得满足条件的记录数
        $p     = new PageList($count, 4);
        $page  = $p->show();
        $list  = $this->model_huxing
                      ->field('*,CONCAT("'. C('APP_URL') . C('IMAGE_BASE_URL') .'",house_path) as house_path,
                              if(sale_type = 1, "在售", if(sale_type = 2, "售罄", "待售")) as sale_str')
                      ->where($where)->order('id desc')->limit($p->firstRow . ',' . $p->listRows)
                      ->select();
        $house_count = array(
            'all'      => $this->model_huxing->field('COUNT(id) as count')->where(array('loupan_id' => $id))->find()['count'],
            'in_sale'  => $this->model_huxing->field('COUNT(id) as count')->where(array('loupan_id' => $id, 'sale_type' => 1))->find()['count'],
            'for_sale' => $this->model_huxing->field('COUNT(id) as count')->where(array('loupan_id' => $id, 'sale_type' => 0))->find()['count'],
            'sale_out' => $this->model_huxing->field('COUNT(id) as count')->where(array('loupan_id' => $id, 'sale_type' => 2))->find()['count'],
        );
        $this->assign('house_count', $house_count);
        $this->assign('list', $list);
        $this->assign('data', $data);
        $this->assign('page', $page);
        $this->display('NewHouse/houseAdministration');
    }

    /**
     * [addHouseType 添加新户型]
     */
    public function addHouseType() {
        unset($_POST['id']);
        $loupan_id = I('post.loupan_id');
        if (!$this->dao_huxing->create()) {
            $this->msgBack(0, $this->dao_huxing->getError());
        }
        $operation = '新增户型: "' . $this->dao_huxing->name .'"<br />';
        $operation .= '户型均价: "' . $this->dao_huxing->average_price .'元/㎡"<br />';
        $operation .= '销售状态: "' . L('SALE_MAP')[$this->dao_huxing->sale_type] .'"<br />';
        $operation .= '户型室数: "' . $this->dao_huxing->room_count .'室'. $this->dao_huxing->hall_count .'厅'. $this->dao_huxing->toilet_count .'卫"<br />';
        $operation .= '建筑面积: "' . $this->dao_huxing->build_area .'㎡"<br />';
        $operation .= '套内面积: "' . $this->dao_huxing->house_area .'㎡"<br />';
        $operation .= '户型朝向: "' . $this->dao_huxing->orientation .'"<br />';
        $res = $this->dao_huxing->add();
        if (!$res) {
            $this->msgBack(0, '操作失败');
        }
        $operation = '删除户型: "'. $name .'"';
        $this->addLog($loupan_id, $operation, 1, L('HUXING'));
        $this->msgBack(1, 'success', U('index', array('id' => $loupan_id)));
    }

    /**
     * [showHouseType 查看户型详细信息]
     * @return [type] [description]
     */
    public function showHouseType() {
        $where['id'] = I('post.huxing_id');
        $res = $this->model_huxing->field('*,CONCAT("'. C('APP_URL') . C('IMAGE_BASE_URL') .'",house_path) as show_path')->where($where)->find();
        if (!$res) {
            $this->msgBack(0, '户型id错误');
        }
        $this->msgBack(1, 'ok', '', $res);
    }

    /**
     * [editHouseType 修改户型信息]
     * @return [type] [description]
     */
    public function editHouseType() {
        $id        = I('post.id');
        $loupan_id = I('post.loupan_id');
        $post = I('post.', '', 'trim,htmlspecialchars');
        $old = $this->dao_huxing->where(array('id' => $id))->find();
        $operation = '编辑户型: "' . $old['name'] . '"<br />';   
        if ($post['name'] != $old['name']) {
            $operation .= '户型名称: 从"' . $old['name'] .'"修改为"'. $post['name'] .'"<br />';
        }
        if ($post['average_price'] != $old['average_price']) {
            $operation .= '户型均价: 从"' . $old['average_price'] .'元/㎡"修改为"'. $post['average_price'] .'元/㎡"<br />';
        }
        if ($post['sale_type'] != $old['sale_type']) {
            $operation .= '销售状态: 从"' . L('SALE_MAP')[$old['sale_type']] .'"修改为"'. L('SALE_MAP')[$post['sale_type']] .'"<br />';
        }
        $huxing_type = $post['room_count'] .'室'. $post['hall_count'] .'厅'. $post['toilet_count'] .'卫';
        $huxing_old_type = $old['room_count'] .'室'. $old['hall_count'] .'厅'. $old['toilet_count'] .'卫';
        if ($huxing_type != $huxing_old_type) {
            $operation .= '户型室数: 从"' . $huxing_old_type .'"修改为"'. $huxing_type .'"<br />';
        }
        if ($post['build_area'] != $old['build_area']) {
            $operation .= '建筑面积: 从"' . $old['build_area'] .'㎡"修改为"'. $post['build_area'] .'㎡"<br />';
        }
        if ($post['house_area'] != $old['house_area']) {
            $operation .= '套内面积: 从"' . $old['house_area'] .'㎡"修改为"'. $post['house_area'] .'㎡"<br />';
        }
        if (!empty($post['orientation']) && $post['orientation'] != $old['orientation']) {
            $operation .= '朝向: 从"' . $old['orientation'] .'"修改为"'. $post['orientation'] .'"<br />';
        }
        $this->addLog($loupan_id, $operation, 2, L('HUXING'));
        $this->updateData($this->dao_huxing, $id, U('index', array('id' => $loupan_id)));
    }

    /**
     * [delHouseType 删除户型]
     * @return [type] [description]
     */
    public function delHouseType() {
        $where['id'] = I('post.huxing_id');
        $loupan_id = $this->model_huxing->where($where)->getField('loupan_id');
        $name = $this->model_huxing->where($where)->getField('name');
        $res = $this->model_huxing->where($where)->delete();
        if (!$res) {
            $this->msgBack(0, '删除户型');
        }
        $operation = '删除户型: "'. $name .'"';
        $this->addLog($loupan_id, $operation, 3, L('HUXING'));
        $this->msgBack(1, 'ok', U('index'));
    }

}