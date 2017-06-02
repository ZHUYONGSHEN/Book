<?php
namespace Admin\Controller;
use Think\PageAdv;

/**
 * 新房项目管理
 */
class NewHouseController extends CommonController {
    public function __construct() {
        parent::__construct();
        $this->model_JpCommision = M('JumpCommision', 'xq_');
        $this->model_commision   = M('commision', 'xq_');
        $this->model_loupan      = M('Loupan', 'xq_');
        $this->model_contact     = M('Contact', 'xq_');
        $this->model_huxing      = M('Huxing', 'xq_');
        $this->model_report_cfg  = M('ReportCfg', 'xq_');
        $this->model_licence     = M('Licence', 'xq_');
        $this->model_property    = M('property', 'xq_');
        $this->model_project     = M('project', 'xq_');
        $this->model_jieyong     = M('jieyong', 'xq_');
        $this->model_log         = M('log', 'xq_');
        $this->dao_licence       = D('Licence');
        $this->dao_loupan        = D('Loupan');
    }

    /**
     * [_mapFilter 查询字段]
     * @return [type] [description]
     */
    private function _mapFilter() {
        $province_adcode = I('get.province_code');  //所在省
        $city_adcode     = I('get.city_code');      //所在市
        $country_adcode  = I('get.country_code');   //所在区
        $property_type   = I('get.property_type');  //物业类型
        $proxy_status    = I('get.proxy_status');   //代理状态
        $price_type      = I('get.price_type');     //查询价格类型
        $min_price       = I('get.min_price');      //最低价格
        $max_price       = I('get.max_price');      //最高价格
        $source          = I('get.source');         //来源
        $name            = I('get.name');           //项目名称
        if (!empty($province_adcode)) {
            $where['lp.adcode'] = array('like', substr($province_adcode, 0, 2) . '%');
        }
        if (!empty($city_adcode)) {
            $where['lp.adcode'] = array('like', substr($city_adcode, 0, 4) . '%');
        }
        if (!empty($country_adcode)) {
            $where['lp.adcode'] = $country_adcode;
        }
        if ($property_type != null) {
            $where['lp.property_type'] = array('like', '%' . $property_type . '%');
        }
        if ($proxy_status != null) {
            $where['lp.proxy_status'] = intval($proxy_status);
        }
        if ($price_type == 1) {
            if (!empty($min_price)) {
                $where['lp.average_min'] = array('EGT', $min_price);
            }
            if (!empty($max_price)) {
                $where['lp.average_max'] = array('ELT', $max_price);
            }
        }else{
            if (!empty($min_price)) {
                $where['lp.total_min'] = array('EGT', $min_price);
            }
            if (!empty($max_price)) {
                $where['lp.total_max'] = array('ELT', $max_price);
            }
        }
        if ($source != null) {
            $where['lp.source'] = intval($source);
        }
        if ($name != null) {
            $where['lp.name'] = array('like', '%' . $name . '%');
        }
        $where['is_show'] = 1;
        return $where;
    }

    /**
     * [index 新房管理列表]
     * @return [type] [description]
     */
    public function index(){
        $where = $this->_mapFilter();
        $count = $this->model_loupan
                      ->alias('lp')
                      ->join('left join pano_dictionary dic on dic.id = lp.hid')
                      ->where($where)->count();
        $p     = new PageAdv($count, C('PAGE_LISTROWS'));
        $page  = $p->show();
        $list  = $this->model_loupan
                      ->alias('lp')
                      ->field('lp.id,
                               lp.hid,
                               lp.adcode,
                               dic.province,
                               dic.city,
                               dic.district,
                               lp.name,
                               lp.property_type,
                               if(lp.proxy_status = 1, "代理中", if(lp.proxy_status = 2, "代理中止", "已完结")) as proxy_status,
                               lp.sale_total,
                               concat_ws("-", pay_min, pay_max) as pay,
                               lp.average_min,
                               concat_ws("-", total_min, total_max) as sum,
                               if(lp.source = 1, "合作", "采集") as source,
                               if(lp.status = 1, "上架中", "已下架") as status,
                               lp.create_time,
                               lp.status as state')
                      ->join('left join pano_dictionary dic on dic.id = lp.hid')
                      ->where($where)
                      ->order("id DESC")
                      ->limit($p->firstRow . ',' . $p->listRows)
                      ->select();
        foreach ($list as $key => $val) {
            // TODO 待优化完善
            $com = $this->model_commision->where(array('loupan_id' => $val['id']))->find();
            switch ($com['count_type']) {
              case 3: $jpCom = $this->model_JpCommision->where(array('commision_id' => $com['id']))->find();
                      if (!empty($jpCom)) {
                          $unit = $jpCom['count_type'] == 1 ? '元/套' : '%';
                          $list[$key]['com'] = ($jpCom['count_type'] == 1 ? intval($jpCom['proxy_service']) : $jpCom['proxy_service']) . $unit;
                      };
                  break;
              case 1: $list[$key]['com'] = $com['proxy_service'] . '%';
                  break;
              case 2: $list[$key]['com'] = intval($com['proxy_service']) . '元/套';
                  break;
              case 4: $list[$key]['com'] = '其他';
                  break;
              default:$list[$key]['com'] = '无';
                  break;
            }
        }
        $province = M('area', 'xq_')->where(array('level' => 1))->field('adcode,name')->select();
        $property = $this->model_property->field('id,name')->select();
        $this->assign('province', $province);
        $this->assign('property', $property);
        $this->assign('page', $page);
        $this->cHandler($list);
    }

    /**
     * [addNewhosue 新增新房项目]
     * @return [type] [description]
     */
    public function addNewItem() {
      $id      = $this->model_loupan->field('GROUP_CONCAT(hid) as id')->find();
      $where['id'] = array('not in', $id['id']);
      $property = $this->model_property->field('id,name')->select();
      $project  = $this->model_project->field('id,name')->select();
      $house    = M('dictionary')->where($where)->field('id,name')->limit(0,10)->select();
      $this->assign('property', $property);
      $this->assign('project', $project);
      $this->assign('house', $house);
      $this->display();
    }

    /**
     * [searchHouse 搜索楼盘字典]
     * @return [type] [description]
     */
    public function searchHouse() {
      $keyword = I('post.keyword');
      $where['name'] = array('like', '%' . $keyword . '%');
      $where['id']   = array('not in', $this->model_loupan->field('GROUP_CONCAT(hid) as id')->find()['id']);
      $house = M('dictionary')->where($where)->field('id,name')->limit(0,10)->select();
      $this->ajaxReturn(array('status' => true, 'info' => 'success', 'data' => $house));
    }

    /**
     * [getAddData 添加项目前置操作]
     * @return [type] [description]
     */
    public function getAddData() {
      $post = I('post.');
      $property_name            = $this->model_property->where(array('id' => array('in', $post['property_ids'])))->field('GROUP_CONCAT(name)')->find();
      $project_name             = $this->model_project->where(array('id' => array('in', $post['project_ids'])))->field('GROUP_CONCAT(name)')->find();
      $_POST['house_tag']       = implode(',', $post['house_tag']);
      $_POST['property_ids']    = implode(',', $post['property_ids']);
      $_POST['project_ids']     = implode(',', $post['project_ids']);
      $_POST['property_type']   = implode(',', $property_name);
      $_POST['project_feature'] = implode(',', $project_name);
    }

    /**
     * [doAddNewItem 执行新增项目操作]
     * @return [type] [description]
     */
    public function doAddNewItem() {
        if (IS_AJAX || IS_POST) {
            $this->getAddData();
            if (!$this->dao_loupan->create()) {
                $this->msgBack(0, $this->dao_loupan->getError());
            }
            $operation = "项目名称: " . $this->dao_loupan->name;
            $res = $this->dao_loupan->add();
            $this->addLog($res, $operation, 1, L('PROJECT'));
            if (!$res) {
                $this->msgBack(0, '操作失败');
            }
            $this->addContact($res);
            $this->msgBack(1, 'ok', U('index'));
        }
    }

    /**
     * [addContact 新增项目模块-添加联系人]
     * @param [type] $id [description]
     */
    public function addContact($id) {
      $data['mobile']       = I('post.cont_mobile');
      $data['name']         = I('post.cont_name');
      $data['contact_type'] = I('post.contact_type');
      $data['loupan_id'] = $id;
      if (!empty($data['mobile'])) {
          M('contact', 'xq_')->add($data);
      }
    }

    /**
     * [editNewhosue 编辑新房项目]
     * @return [type] [description]
     */
    public function editNewItem() {
        $id   = I('get.id');
        $data = $this->model_loupan
                     ->alias('l')
                     ->field('l.*,
                              d.name as hname,
                              if(proxy_status = 1, "代理中", if(proxy_status = 2, "代理中止", "已完结")) as proxy_status_text,
                              FROM_UNIXTIME(contract_start,"%Y-%m-%d") as contract_start,
                              FROM_UNIXTIME(contract_end,"%Y-%m-%d") as contract_end,
                              CONCAT("'. C('APP_URL') . C('IMAGE_BASE_URL') .'",l.cover_path) as show_path')
                     ->join('left join pano_dictionary d on d.id = l.hid')
                     ->where(array('l.id' => $id))
                     ->find();
        $data['property_ids'] = explode(',', $data['property_ids']);
        $data['project_ids']  = explode(',', $data['project_ids']);
        if ($data['house_tag'] !== '') {
            $data['house_tag'] = explode(',', $data['house_tag']);
        }
        $data['licence']      = $this->model_licence
                                     ->field('*,CONCAT("'. C('APP_URL') . C('IMAGE_BASE_URL') .'",licence_path) as licence_path')
                                     ->where(array('loupan_id' => $data['id']))
                                     ->select();
        $property = $this->model_property->field('id,name')->select();
        $project  = $this->model_project->field('id,name')->select();
        //dump($data);die;
        $this->assign('property', $property);
        $this->assign('project', $project);
        $this->assign('data', $data);
        $this->display();
    }

    /**
     * [doEditNewItem 执行编辑项目操作]
     * @return [type] [description]
     */
    public function doEditNewItem() {
        if (IS_AJAX || IS_POST) {
            $link_tencent      = I('post.link_tencent');
            $link_720          = I('post.link_720');
            $id                = I('post.id');
            $_POST['link_url'] = '';
            $old = $this->dao_loupan->find($id);
            if (!empty($link_tencent)) {
                $_POST['link_url'] = $link_tencent;
            }
            if (!empty($link_720)){
                $_POST['link_url'] = $link_720;
            }
            $this->getAddData();
            unset($_POST['link_tencent']);
            unset($_POST['link_720']);
            $post = I('post.', '', 'trim,htmlspecialchars');
            $operation = '';
            if (!empty($post['name']) && $post['name'] != $old['name']) {
                $operation .= '项目名称: 从"'. ($old["name"] ?: "无") .'"修改为"'. $post["name"] .'"<br />';
            }
            if (!empty($post['market_name']) && $post['market_name'] != $old['market_name']) {
                $operation .= '推广名称名称: 从"'. ($old["market_name"] ?: "无") .'"修改为"'. $post["market_name"] .'"<br />';
            }
            if (!empty($post['property_ids']) && $post['property_ids'] != $old['property_ids']) {
                $old_property = $this->model_property->where(array('id' => array('IN', $old['property_ids'])))->getField('GROUP_CONCAT(name)');
                $new_property = $this->model_property->where(array('id' => array('IN', $post['property_ids'])))->getField('GROUP_CONCAT(name)');
                $operation .= '物业类型: 从"'. ($old_property ?: "无") .'"修改为"'. $new_property .'"<br />';
            }
            if (!empty($post['proxy_status']) && $post['proxy_status'] != $old['proxy_status']) {
                $old_proxy = L('PROXY_STATUS')[$old['proxy_status']];
                $new_proxy = L('PROXY_STATUS')[$post['proxy_status']];
                $operation .= '代理状态: 从"'. ($old_proxy ?: "无") .'"修改为"'. $new_proxy .'"<br />';
            }
            if (!empty($post['open_date']) && $post['open_date'] != $old['open_date']) {
                $operation .= "开盘时间: 从'". ($old['open_date'] ?: "无") ."'修改为'". $post['open_date'] ."'<br />";
            }
            if (!empty($post['checkin_date']) && $post['checkin_date'] != $old['checkin_date']) {
                $operation .= '入住时间: 从"'. $old["checkin_date"] ?: "无" .'"修改为"'. $post["checkin_date"] .'"<br />';
            }
            if (!empty($post['contract_start']) && (strtotime($post['contract_start']) != $old['contract_start']) || strtotime($post['contract_end']) != $old['contract_end']) {
                $operation .= '合同日期: 从"'. date("Y-m-d", $old["contract_start"]) .'-'. date("Y-m-d", $old["contract_end"]) .'"修改为"'. date("Y-m-d", $post["contract_start"]) .'-'. date("Y-m-d", $post["contract_end"]) .'"<br />';
            }
            if (!empty($post['proxy_mod']) && $post['proxy_mod'] != $old['proxy_mod']) {
                $operation .= '代理方式: 从"'. L("PROXY_MOD")[$old["proxy_mod"]] .'"修改为"'. L("PROXY_MOD")[$post["proxy_mod"]] .'"<br />';
            }
            if (!empty($post['average_min']) && ($post['average_min'] != $old['average_min'] || $post['average_max'] != $old['average_max'])) {
                $operation .= '均价: 从"'. $old["average_min"] .'-'. $old["average_max"] .'/㎡"修改为"'. $post["average_min"] .'-'. $post["average_max"] .'/㎡"<br />';
            }
            if (!empty($post['total_min']) && ($post['total_min'] != $old['total_min'] || $post['total_max'] != $old['total_max'])) {
                $operation .= '总价: 从"'. $old["average_min"] .'-'. $old["average_max"] .'万元"修改为"'. $post["average_min"] .'-'. $post["average_max"] .'万元"<br />';
            }
            if (!empty($post['pay_min']) && ($post['pay_min'] != $old['pay_min'] || $post['pay_max'] != $old['pay_max'])) {
                $operation .= '首付比例: 从"'. $old["pay_min"] .'-'. $old["pay_max"] .'%"修改为"'. $post["pay_min"] .'-'. $post["pay_max"] .'%"<br />';
            }
            if (!empty($post['sale_total']) && $post['sale_total'] != $old['sale_total']) {
                $operation .= '在售楼盘: 从"'. $old["sale_total"] .'套"修改为"'. $post["sale_total"] .'套"<br />';
            }
            if (!empty($post['area_min']) && ($post['area_min'] != $old['area_min'] || $post['area_max'] != $old['area_max'])) {
                $operation .= '面积范围: 从"'. $old["area_min"] .'-'. $old["area_max"] .'㎡"修改为"'. $post["area_min"] .'-'. $post["area_max"] .'㎡"<br />';
            }
            if (!empty($post['project_feature']) && $post['project_feature'] != $old['project_feature']) {
                $operation .= '项目特色: 从"'. $old["project_feature"] .'"修改为"'. $post["project_feature"] .'"<br />';
            }
            if (!empty($post['source']) && $post['source'] != $old['source']) {
                $map = array('采集', '合作');
                $operation .= '来源: 从"'. $map[$old["source"]] .'"修改为"'. $map[$post["source"]] .'"<br />';
            }
            if (!empty($post['house_tag']) && $post['house_tag'] != $old['house_tag']) {
                $map = array('热销', '新盘');
                $old_text= str_word_count(',', 0, $old['house_tag']) >= 1 ? '热销;新盘' : $map[$old['house_tag']];
                $new_text= str_word_count(',', 0, $post['house_tag']) >= 1 ? '热销;新盘' : $map[$post['house_tag']];
                $operation .= '楼盘标签: 从"'. $old_text .'"修改为"'. $new_text .'"<br />';
            }
            if (!empty($post['cover_path']) && $post['cover_path'] != $old['cover_path']) {
                $operation .= '封面图<br />';
            }
            if (!empty($post['link_url']) && $post['link_url'] != $old['link_url']) {
                $operation .= '连接器链接<br />';
            }
            if (!empty($operation)) {
                $this->addLog($id, $operation, 2, L('PROJECT_MSG'));
            }
            $this->updateData($this->dao_loupan, $id, U('detail', array('id' => $id)));
        }
    }

    /**
     * [doUpHouse 上架项目操作]
     * @return [type] [description]
     */
    public function changeHouseStatus() {
        $where['id'] = I('post.id');
        $type        = I('post.type');
        $res = $this->model_loupan->where($where)->setField('status', $type);
        if (!$res) {
            $this->msgBack(0, '操作失败');
        }
        $operation = '上架状态: 从"' . ($type == 1 ? '下架' : '上架') .'"修改为"' . ($type == 1 ? '上架' : '下架') .'"';
        $this->addLog($where['id'], $operation, 2, L('PROJECT_MSG'));
        $this->msgBack(1, 'ok');
    }

    /**
     * [delHouse 隐藏项目信息]
     * @return [type] [description]
     */
    public function delHouse() {
        $where['id'] = I('post.id');
        $res = $this->model_loupan->where($where)->setField('is_show', 0);
        if (!$res) {
            $this->msgBack(0, '操作失败');
        }
        $name = $this->model_loupan->where($where)->getField('name');
        $operation = "删除项目: " . $name;
        $this->addLog($where['id'], $operation, 3, L('PROJECT'));
        $this->msgBack(1, '删除成功');
    }

    /**
     * [addLicence 添加新房预售许可证]
     */
    public function addLicence() {
        if (!$this->dao_licence->create()) {
            $this->msgBack(0, $this->dao_licence->getError());
        }
        $operation = "预售许可证编号: " . $this->dao_licence->licence_num;
        $loupan_id = $this->dao_licence->loupan_id;
        $res = $this->dao_licence->add();
        if (!$res) {
            $this->msgBack(0, '操作失败');
        }
        $this->addLog($loupan_id, $operation, 1, L('LICENCE'));
        $data = $this->model_licence
                     ->field('*,CONCAT("'. C('APP_URL') . C('IMAGE_BASE_URL') .'",licence_path) as licence_path')
                     ->where(array('id' => $res))
                     ->find();
        $this->msgBack(1, '添加成功', '', $data);
    }

    /**
     * [delLicence 删除新房预售许可证]
     * @return [type] [description]
     */
    public function delLicence() {
        $id = I('post.id');
        $licence = $this->model_licence->where(array('id' => $id))->field('loupan_id,licence_num')->find();
        $res = $this->model_licence->where(array('id' => $id))->delete();
        if (!$res) {
            $this->msgBack(0, '操作失败');
        }
        $operation = "删除预售许可证: " . $licence['licence_num'];
        $this->addLog($licence['loupan_id'], $operation, 3, L('LICENCE'));
        $this->msgBack(1, '删除成功');
    }

    /**
     * [detail 详情]
     * @return [type] [description]
     */
    public function detail() {
        C('TOKEN_ON',false);
        $id = I('get.id', 0, 'intval');
        $tag_map = array('热销', '新盘');
        $proxy_map = array('已完结', '代理中', '代理中止');
        $build_type_map = array('无', '钢筋混凝土', '塔板结构');
        $data = $this->model_loupan
                     ->where(array('L.id' => $id))
                     ->alias('L')
                     ->join('LEFT JOIN pano_dictionary PD ON PD.id=L.hid LEFT JOIN xq_report_cfg RC ON RC.loupan_id=L.id')
                     ->field('L.id,
                              L.hid,
                              L.name,
                              L.property_type,
                              L.property_ids,
                              L.proxy_status,
                              L.contract_start,
                              L.contract_end,
                              L.average_min,
                              L.average_max,
                              L.total_min,
                              L.total_max,
                              L.sale_total,
                              L.area_min,
                              L.area_max,
                              L.project_feature,
                              L.project_ids,
                              CONCAT("' . C('IMAGE_BASE_URL') . '", L.cover_path) AS cover_path,
                              L.source,
                              L.house_tag,
                              L.status,
                              L.link_type,
                              L.link_url,
                              L.open_date,
                              L.checkin_date,
                              PD.name AS hname,
                              PD.green_rate,
                              PD.household_num,
                              PD.car_num,
                              CONCAT(PD.province,PD.city,PD.district, PD.detail_address,PD.name) AS address,
                              PD.management_price,
                              PD.plot_rate,
                              PD.build_area,
                              PD.build_type,
                              PD.build_content,
                              PD.developer,
                              PD.management,
                              RC.id AS rcid,
                              RC.report_rule,
                              RC.see_rule')
                     ->find();
        $data['property_text'] = str_replace(',', '、', $data['property_type']);
        $data['property_type_arr'] = explode(',', $data['property_type']);
        $data['property_ids_arr'] = explode(',', $data['property_ids']);
        $data['open_date'] = date('Y年m月d日', strtotime($data['open_date']));
        $data['checkin_date'] = date('Y年m月d日', strtotime($data['checkin_date']));
        $data['contract_start'] = date('Y-m-d', $data['contract_start']);
        $data['contract_end'] = date('Y-m-d', $data['contract_end']);
        $data['project_feature'] = explode(',', $data['project_feature']);
        $data['source'] = $data['source'] == 1 ? "合作" : "采集";
        $data['house_tag'] = str_word_count($data['house_tag'], 0, ',') != 0 ? $tag_map : array($tag_map[$data['house_tag']]);
        $data['proxy_status_text'] = $proxy_map[$data['proxy_status']];
        $data['build_type_text'] = $build_type_map[$data['build_type']];
        // 许可证
        $data['licences'] = $this->model_licence
                                 ->where(array('loupan_id' => $data['id']))
                                 ->field('licence_num,CONCAT("'. C('IMAGE_BASE_URL') .'", licence_path) as licence_path')
                                 ->select();
        // 联系人
        $contacts = $this->getContacts($data['id']);
        // 佣金
        $commisions = $this->getCommisions($data['id']);
        $commision_total_num = $this->model_commision->where(array('loupan_id' => $data['id']))->count();
        // 结佣
        $jieyongs = $this->getJieyongs($data['id']);
        $jieyong_total_num = $this->model_jieyong->where(array('loupan_id' => $data['id']))->count();
        // 在售户型
        $huxings = $this->model_huxing
                        ->field('*,CONCAT("'. C('APP_URL') . C('IMAGE_BASE_URL') .'",house_path) as house_path')
                        ->where(array('loupan_id' => $id, 'sale_type' => 1))
                        ->select();
        $huxing_count = $this->model_huxing->field('COUNT(id) as count')->where(array('loupan_id' => $id, 'sale_type' => 1))->find();
        // dump($data);exit;
        $this->assign('data', $data);
        $this->assign('contacts', $contacts);
        $this->assign('commisions', $commisions);
        $this->assign('commision_total_num', $commision_total_num);
        $this->assign('jieyong_total_num', $jieyong_total_num);
        $this->assign('jieyongs', $jieyongs);
        $this->assign('huxings', $huxings);
        $this->assign('count', $huxing_count);
        $this->display('ItemMessages');
    }

    /**
     * [getContacts 获取联系人]
     * @param [int] $loupan_id [项目ID]
     */
    protected function getContacts($loupan_id) {
        $list = $this->model_contact->where(array('loupan_id' => $loupan_id))->select();
        $dateset = array();
        foreach ($list as $key => $item) {
            if (in_array($item['contact_type'], array(4, 5, 6))) {
                $dataset[4][] = array(
                    'name' => $item['name'],
                    'mobile' => $item['mobile'],
                    'scale' => $item['scale'],
                    'text' => L('CONTACT_MAP')[$item['contact_type']],
                    'type' => $item['contact_type']
                );
            } else {
                $dataset[$item['contact_type']] = array(
                    'name' => $item['name'],
                    'mobile' => $item['mobile'],
                    'scale' => $item['scale'],
                    'text' => L('CONTACT_MAP')[$item['contact_type']]
                );
            }
        }
        return $dataset;
    }

    /**
     * @description 获取佣金规则
     * [getCommisions 获取佣金规则]
     * @param int $loupan_id 项目ID(房源表主键)
     */
    public function getCommisions($loupan_id, $page = 1, $page_num = 2) {
        $list = $this->model_commision
                      ->where(array('loupan_id' => $loupan_id))
                      ->field('id,
                               has_huxing,
                               huxing_ids,
                               property_id,
                               count_type,
                               proxy_service,
                               remark,
                               content')
                        ->page($page, $page_num)
                        ->order('create_time desc')
                        ->select();
        $dataset = array();
        foreach ($list as $key => $item) {
            $index = $page * 2;
            $key == 0 && $index = $page * 2 - 1;
            $id = $item['id'];
            $huxing_ids = $item['huxing_ids'];
            $item['property'] = L('PROPERTY_MAP')[$item['property_id']];
            $item['index'] = $index;
            $item['huxings'] = $item['rule'] = '';
            $unit = $item['count_type'] == '1' ? '%' : '元/套';
            unset($item['huxing_ids'], $item['property_id']);
            if ($item['count_type'] != 3) {
                if ($item['has_huxing'] == 1) {
                    $item['huxings'] = $this->model_huxing
                                            ->where(array('id' => array('IN', $huxing_ids)))
                                            ->getField('GROUP_CONCAT(room_count, "房", hall_count, "厅", toilet_count, "卫")', false);
                    $item['huxings'] = $item['huxings'] ?: '';
                }
                $item['rule'] = $item['count_type'] == 4 ? $item['content'] : $item['proxy_service'] . $unit;
                $dataset[] = $item;
                continue;
            }
            $jumps = $this->getJumpCommisions($id, $item['property'], $item['count_type'], $item['remark']);
            $jumps['index'] = $index;
            $dataset[] = $jumps;
        }
        if (IS_AJAX) {
            $this->msgBack(1, 'success', '', $dataset);
        }
        return $dataset;
    }

    /**
     * @description 获取佣金规则
     * @param int $commision_id 佣金主键
     * @param string $property 物业类型
     * @param int $count_type 主佣金结算标准类型
     * @param string $remark 备注
     */
    protected function getJumpCommisions($commision_id, $property, $count_type, $remark) {
        $data = $this->model_JpCommision
                     ->where(array('commision_id' => $commision_id))
                     ->field('"" as huxings,
                              "'. $property .'" as property,
                              "'. $remark .'" as remark,
                              count_type,
                              "" as content,
                              proxy_service,
                              min_count,
                              max_count')
                     ->find();
        $unit = $data['count_type'] == '1' ? '%' : '元/套';
        $data['id'] = $commision_id;
        $data['rule'] = $data['min_count'] . '-' . $data['max_count'] . '套: ' . $data['proxy_service'] . $unit;
        return $data;
    }

    /**
     * [editCfg 编辑报备参数]
     */
    public function editCfg() {
        $post = I('post.', '', 'trim,htmlspecialchars');
        $operation = '';
        if (!empty($post['id'])) {
            if (!empty($post['report_rule'])) {
                $old = $this->model_report_cfg->where(array('loupan_id' => $post['loupan_id']))->getField('report_rule');
                $old == $post['report_rule'] && $operation .= '报备规则: 从"' . $old . '"修改为"' . $post['report_rule'] . '"<br />';
            }
            if (!empty($post['see_rule'])) {
                $old = $this->model_report_cfg->where(array('loupan_id' => $post['loupan_id']))->getField('see_rule');
                $old == $post['see_rule'] && $operation .= '带看规则: 从"' . $old . '"修改为"' . $post['see_rule'] . '"<br />';
            }
            $this->model_report_cfg->save($post);
            $this->addLog($post['loupan_id'], $operation, 2, L('CONFIG'));
        } else {
            $operation .= '新增报备参数<br />';
            if (!empty($post['report_rule'])) {
                $operation .= '报备规则: ' . $post['report_rule'] . '<br />';
            }
            if (!empty($post['see_rule'])) {
                $operation .= '带看规则: ' . $post['see_rule'] . '<br />';
            }
            $this->model_report_cfg->add($post);
            $this->addLog($post['loupan_id'], $operation, 1, L('CONFIG'));
        }
        $this->msgBack(1, '编辑成功');
    }

    /**
     * @description 获取佣金规则
     * [getCommisions 获取佣金规则]
     * @param int $loupan_id 项目ID(房源表主键)
     */
    public function getJieYongs($loupan_id, $page = 1, $page_num = 2) {
        $dataset = array();
        $list = $this->model_jieyong
                      ->where(array('loupan_id' => $loupan_id))
                      ->field('id,
                               property_ids,
                               point_type,
                               jieyong_type,
                               count_type,
                               count_price,
                               apply_day,
                               return_day')
                        ->page($page, $page_num)
                        ->order('create_time desc')
                        ->select();
        foreach ($list as $key => $item) {
            $item['point_text'] = L('POINT_MAP')[$item['point_type']];
            $item['count_text'] = L('RULE_TYPE')[$item['count_type']];
            $item['jieyong_text'] = L('JIEYONG_TYPE')[$item['jieyong_type']];
            $item['property_type'] = L('PROPERTY_MAP')[$item['property_ids']];
            if ($item['count_type'] < 2) {
                $item['count_price'] .= '%';
            } else {
                $item['count_price'] .= '元';
            }
            $dataset[] = $item;
        }
        if (IS_AJAX) {
            $this->msgBack(1, 'success', '', $dataset);
        }
        return $dataset;
    }

    /**
     * @description 操作记录
     */
    public function operationLog() {
        $id = I('get.id', 0, 'intval');
        $page = I('get.page', 1, 'intval');
        $list = $this->model_log->where(array('loupan_id' => $id))->page($page, 20)->order('create_time desc')->select();
        $total_num = $this->model_log->where(array('loupan_id' => $id))->count();
        $total_page = ceil($total_num / 20);
        $base_index = 20 * ($page - 1) + 1;
        foreach ($list as $key => $item) {
            $list[$key]['index'] = $base_index + $key;
            $list[$key]['username'] = M('User', 'operate_')->where(array('id' => $item['operator_id']))->getField('account');
            $list[$key]['type'] = $item['action'] . $item['module'];
        }
        // dump($list);exit;
        $data = $this->model_loupan
                     ->alias('L')
                     ->field('L.id,
                              L.name,
                              L.status,
                              PD.name AS hname,
                              IF(L.proxy_status = 1, "代理中", IF(L.proxy_status = 2, "代理中止", "已完结")) AS proxy_status_text')
                     ->join('left join pano_dictionary PD on PD.id = L.hid')
                     ->where(array('L.id' => $id))
                     ->find();
        $this->assign('id', $id);
        $this->assign('data', $data);
        $this->assign('total_num', $total_num);
        $this->assign('page', $page);
        $this->assign('total_page', $total_page);
        $this->assign('list', $list);
        $this->display();
    }
}