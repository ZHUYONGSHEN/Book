<?php
namespace Admin\Controller;
use Think\PageAdv;

class CommisionController extends CommonController {

    public function __construct() {
        parent::__construct();
        $this->model_JpCommision = M('JumpCommision', 'xq_');
        $this->model_commision   = M('commision', 'xq_');
        $this->model_jieyong   = M('jieyong', 'xq_');
        $this->model_huxing   = M('huxing', 'xq_');
    }

    /**
     * [_mapFilter 查询字段]
     * @return [type] [description]
     */
    // private function _mapFilter() {
    //     $province_adcode = I('get.province_code');  //所在省
    //     $city_adcode     = I('get.city_code');      //所在市
    //     $country_adcode  = I('get.country_code');   //所在区
    //     $property_type   = I('get.property_type');  //物业类型
    //     $proxy_status    = I('get.proxy_status');   //代理状态
    //     //$price_type      = I('get.price_type');     //查询价格类型
    //     $average_min     = I('get.average_min');    //最低均价
    //     $average_max     = I('get.average_max');    //最高均价
    //     $total_min       = I('get.total_min');      //最低总价
    //     $total_max       = I('get.total_max');      //最高总价
    //     $source          = I('get.source');         //来源
    //     $name            = I('get.name');           //项目名称
    //     if (!empty($province_adcode)) {
    //         $where['lp.adcode'] = $province_adcode;
    //     }
    //     if (!empty($city_adcode)) {
    //         $where['lp.adcode'] = $city_adcode;
    //     }
    //     if (!empty($country_adcode)) {
    //         $where['lp.adcode'] = $country_adcode;
    //     }
    //     if (!empty($property_type)) {
    //         $where['lp.property_type'] = array('like', '%' . $property_type . '%');
    //     }
    //     if (!empty($proxy_status)) {
    //         $where['lp.proxy_status'] = $proxy_status;
    //     }
    //     if (!empty($average_min)) {
    //         $where['lp.average_min'] = array('GT', $average_min);
    //     }
    //     if (!empty($average_max)) {
    //         $where['lp.average_max'] = array('LT', $average_max);
    //     }
    //     if (!empty($total_min)) {
    //         $where['lp.total_min'] = array('GT', $total_min);
    //     }
    //     if (!empty($total_max)) {
    //         $where['lp.total_max'] = array('LT', $total_max);
    //     }
    //     if (!empty($source)) {
    //         $where['lp.source'] = $source;
    //     }
    //     if (!empty($name)) {
    //         $where['lp.name'] = array('like', '%' . $name . '%');
    //     }
    //     return $where;
    // }

    public function _before_doJyAction() {
        $this->setHeader();
        $act = I('post.act', 'add', 'trim,htmlspecialchars');
        $id = I('post.id', 0, 'intval');
        $loupan_id = I('post.loupan_id', 0, 'intval');
        $property_ids = I('post.property_ids', 0, 'intval');
        $cycle_type = I('post.cycle_type', 0, 'intval');
        $jieyong_type = I('post.jieyong_type', 0, 'intval');
        $cycle_time = I('post.cycle_time', '', 'trim,htmlspecialchars');
        if ($act == 'save') {
            if (empty($id)) {
                $this->msgBack(0, '请指定要编辑的结佣信息配置');
            }
        }
        if (empty($loupan_id)) {
            $this->msgBack(0, '请指定项目');
        }
        if (empty($property_ids)) {
            $this->msgBack(0, '请指定物业类型');
        }
        if (empty($cycle_time)) {
            $this->msgBack(0, '请选择对账日期/描述');  
        }
    }

    /**
     *  @description 数据校验
     */
    public function doJyAction() {
        $this->setHeader();
        $post = I('post.', '', 'trim,htmlspecialchars');
        $model = $this->model_jieyong;
        $dataset = array();
        $nowtime = date('Y-m-d H:i:s', time());
        foreach ($post['property_ids'] as $key => $item) {
            $data = array(
                'loupan_id' => $post['loupan_id'],
                'property_ids' => $item,
                'cycle_type' => $post['cycle_type'],
                'cycle_time' => $post['cycle_time'],
                'jieyong_type' => $post['jieyong_type']
            );
            $point = $post['point_list'][$key] ?: $post['point_list'][0];
            if ($post['act'] == 'save' && $key == 0) {
                $operation = "编辑结佣信息<br/>";
                $operation .= '物业类型: "'. $post['property_texts'] .'"<br />';
                $post['cycle_type'] == 0 && $text = '每周' . $post['cycle_time'];
                $post['cycle_type'] == 1 && $text = '每月' . $post['cycle_time'] . '日';
                $post['cycle_type'] == 2 && $text = $post['cycle_time'];
                $operation .= '对账周期: "'. $text .'"<br />';
                $operation .= '结佣类型: "'. ($post['jieyong_type'] == 0 ? "按揭付款" : "一次性付款/分次付款") .'"<br />';
                $operation .= '结佣节点: "'. L('POINT_MAP')[$item['point_type']] .'"<br />';
                $operation .= '结算金额: "'. $item['count_price'] . ($item['count_type'] < 2 ? '%' : '元') .'(' . L('RULE_TYPE')[$item['count_type']] . ')"<br />';
                $operation .= '办理日: "'. $item['apply_day'] .'天"<br />';
                $operation .= '回款日: "'. $item['return_day'] .'天"<br />';
                $this->addLog($post['loupan_id'], $operation, 2, L('JIEYONG'));
                $model->where(array('id' => $post['id']))->save(array_merge($data, $point));
            } else {
                $operation = "新增结佣信息<br/>";
                $operation .= '物业类型: "'. $post['property_texts'] .'"<br />';
                $post['cycle_type'] == 0 && $text = '每周' . $post['cycle_time'];
                $post['cycle_type'] == 1 && $text = '每月' . $post['cycle_time'] . '日';
                $post['cycle_type'] == 2 && $text = $post['cycle_time'];
                $operation .= '对账周期: "'. $text .'"<br />';
                $operation .= '结佣类型: "'. ($post['jieyong_type'] == 0 ? "按揭付款" : "一次性付款/分次付款") .'"<br />';
                $operation .= '结佣节点: "'. L('POINT_MAP')[$item['point_type']] .'"<br />';
                $operation .= '结算金额: "'. $item['count_price'] . ($item['count_type'] < 2 ? '%' : '元') .'(' . L('RULE_TYPE')[$item['count_type']] . ')"<br />';
                $operation .= '办理日: "'. $item['apply_day'] .'天"<br />';
                $operation .= '回款日: "'. $item['return_day'] .'天"<br />';
                $this->addLog($post['loupan_id'], $operation, 1, L('JIEYONG'));
                $data['create_time'] = $nowtime;
                $dataset[] = array_merge($data, $point);
            }
        }
        $model->addAll($dataset);
        $this->msgBack(1, '操作成功');
    }

    /**
     *  @description 数据校验
     */
    protected function checkData($post) {
        $price = $post['proxy_service'];
        switch ($post['count_type']) {
            case 1:
                if (!($price > 0 && $price < 100)) {
                    $this->msgBack(0, '请输入0.01-99.99的正确佣金比例');
                }
                break;
            case 2:
                if (!($price > 0 && $price < 10000000)) {
                    $this->msgBack(0, '请输入1-9999999的正确佣金金额范围');
                }
                break;
        }
        if (!empty($post['has_cash']) && $post['cash'] <= 0) {
            $this->msgBack(0, '现金不能小于0');
        }
        if ($post['has_huxing'] == 1 && empty($post['huxing_ids'])) {
            $this->msgBack(0, '请选择户型');
        }
        if (isset($post['min_count'])) {
            if (empty($post['min_count'])) {
                $this->msgBack(0, '最小套数必须大于0');
            }
            if (empty($post['max_count'])) {
                $this->msgBack(0, '最大套数必须大于0');
            }
            if ($post['min_count'] > $post['max_count']) {
                $this->msgBack(0, '最小套数不能大于最大套数');
            }
        }
    }

    /**
     *  @description 前置操作
     */
    public function _before_doAction() {
        $this->setHeader();
        $act = I('post.act', 'add', 'trim,htmlspecialchars');
        $id = I('post.id', 0, 'intval');
        $loupan_id = I('post.loupan_id', 0, 'intval');
        $property_id = I('post.property_id', 0, 'intval');
        $count_type = I('post.count_type', 0, 'intval');
        if ($act == 'save') {
            if (empty($id)) {
                $this->msgBack(0, '请指定要编辑的佣金信息配置');
            }
        }
        if (empty($loupan_id)) {
            $this->msgBack(0, '请指定项目');
        }
        if (empty($property_id)) {
            $this->msgBack(0, '请指定物业类型');
        }
        if (empty($count_type)) {
            $this->msgBack(0, '请指定佣金结算标准');  
        }
    }

    /**
     * @description 添加/编辑
     */
    public function doAction() {
        $model = $this->model_commision;
        $post = I('post.', '', 'trim,htmlspecialchars');
        $nowtime = date('Y-m-d H:i:s', time());
        $dataset = array();
        if ($post['count_type'] == 3) {
            $dataset = $this->makeJumpSet($post);
            $model = $this->model_JpCommision;
        } else if ($post['count_type'] == 4) {
            $item = array();
            $this->checkData($post);
            $item['has_huxing'] = $post['has_huxing'];
            $item['remark'] = $post['remark'];
            $item['loupan_id'] = $post['loupan_id'];
            $item['property_id'] = $post['property_id'];
            $item['count_type'] = $post['count_type'];
            $item['content'] = $post['content'] ?: '';
            $item['create_time'] = $nowtime;
            if ($post['act'] == 'save') {
                $operation = '';
                $old = $this->model_commision->where(array('id' => $post['id']))->find();
                if ($old['property_id'] != $post['property_id']) {
                    $operation .= '物业类型从"'. L('PROPERTY_MAP')[$old['property_id']] .'"修改为"'. L('PROPERTY_MAP')[$post['property_id']] .'"<br />';
                }
                if ($old['content'] != $post['content']) {
                    $operation .= '佣金结算内容从"'. $old['content'] .'"修改为"'. $post['content'] .'"<br />';
                }
                if ($old['remark'] != $item['remark']) {
                    $operation .= '备注从"'. (empty($old['remark']) ? '无' : $old['remark']) .'"修改为"'. $item['remark'] .'"<br />';
                }
                $this->model_commision->where(array('id' => $post['id']))->save($item);
                if (!empty($operation)) {
                    $this->addLog($post['loupan_id'], $operation, 2, L('YONGJIN'));
                }
            } else {
                $operation = "新增佣金信息<br/>";
                $operation .= '物业类型: "'. L('PROPERTY_MAP')[$post['property_id']] .'"<br />';
                unset($item['huxing']);
                $operation .= '佣金结算内容: "'. $item['content'] .'"<br />';
                if (!empty($item['remark'])) {
                    $operation .= '备注: "'. $item['remark'] .'"<br />';
                }
                $this->addLog($post['loupan_id'], $operation, 1, L('YONGJIN'));
                $dataset[] = $item;
            }
        } else {
            foreach ($post['rule_list'] as $key => $item) {
                $operation = '';
                $item['has_huxing'] = $post['has_huxing'];
                $this->checkData($item);
                $item['loupan_id'] = $post['loupan_id'];
                $item['property_id'] = $post['property_id'];
                $item['count_type'] = $post['count_type'];
                $item['content'] = $post['content'] ?: '';
                $item['create_time'] = $nowtime;
                if ($post['act'] == 'save' && $key == 0) {
                    $old = $this->model_commision->where(array('id' => $post['id']))->find();
                    unset($item['create_time']);
                    if ($old['property_id'] != $post['property_id']) {
                        $operation .= '物业类型从"'. L('PROPERTY_MAP')[$old['property_id']] .'"修改为"'. L('PROPERTY_MAP')[$post['property_id']] .'"<br />';
                    }
                    if ($old['count_type'] != $post['count_type']) {
                        $operation .= '佣金结算标准从"'. L('RULE_TYPE')[$old['count_type']] .'"修改为"'. L('RULE_TYPE')[$post['count_type']] .'"<br />';
                    }
                    if ($old['proxy_service'] != $item['proxy_service']) {
                        $operation .= '代理服务费从"'. $old['proxy_service'] .'"修改为"'. $item['proxy_service'] .'"<br />';
                    }
                    if ($old['cash'] != $item['cash'] || $old['has_cash'] != $item['has_cash'] ) {
                        $operation .= '现金奖从"'. ($old['has_cash'] == 0 ? '无' : $old['cash'] . '元') .'"修改为"'. ($item['has_cash'] == 0 ? '无' : $item['cash'] . '元') .'"<br />';
                    }
                    if ($old['extra_award'] != $item['extra_award']) {
                        $operation .= '额外奖励从"'. (empty($old['extra_award']) ? '无' : $old['extra_award']) .'"修改为"'. $item['extra_award'] .'"<br />';
                    }
                    if ($old['remark'] != $item['remark']) {
                        $operation .= '备注从"'. (empty($old['remark']) ? '无' : $old['remark']) .'"修改为"'. $item['remark'] .'"<br />';
                    }
                    if ($old['huxing_ids'] != $item['huxing_ids']) {
                        $old_huxing = $this->model_huxing->where(array('id' => array('IN', $old['huxing_ids'])))->getField('GROUP_CONCAT(name)');
                        $old_huxing = str_replace(',', ';', $old_huxing);
                        $operation .= '户型从"'. (empty($old['huxing_ids']) ? '无' : $old_huxing) .'"修改为"'. $item['huxing'] .'"<br />';
                    }
                    unset($item['huxing']);
                    $this->model_commision->where(array('id' => $post['id']))->save($item);
                    $this->addLog($post['loupan_id'], $operation, 2, L('YONGJIN'));
                } else {
                    $operation = "新增佣金信息<br/>";
                    $operation .= '物业类型: "'. L('PROPERTY_MAP')[$post['property_id']] .'"<br />';
                    $operation .= '佣金结算标准: "'. L('RULE_TYPE')[$post['count_type']] .'"<br />';
                    if (!empty($item['huxing_ids'])) {
                        $operation .= '户型: "'. $item['huxing'] .'"<br />';
                    }
                    unset($item['huxing']);
                    $operation .= '代理服务费: "'. $item['proxy_service'] .'"<br />';
                    if ($item['has_cash'] == 1) {
                        $operation .= '现金奖: "'. $item['cash'] . '元"<br />';
                    }
                    if (!empty($item['extra_award'])) {
                        $operation .= '额外奖励: "'. $item['extra_award'] .'"<br />';
                    }
                    if (!empty($item['remark'])) {
                        $operation .= '备注: "'. $item['remark'] .'"<br />';
                    }
                    $this->addLog($post['loupan_id'], $operation, 1, L('YONGJIN'));
                    $dataset[] = $item;
                }
            }
        }
        $model->addAll($dataset);
        $this->msgBack(1, '操作成功');
    }

    /**
     *  @description 跳点
     */
    protected function makeJumpSet($post) {
        $nowtime = date('Y-m-d H:i:s', time());
        $operation = '';
        if (isset($post['id']) && !empty($post['id'])) {
            $id = $post['id'];
            $this->model_JpCommision->where(array('commision_id' => $id))->delete();
            $operation = "修改佣金信息<br/>";
            $type = 2;
        } else {
            $id = $this->model_commision->add(array(
                'loupan_id' => $post['loupan_id'],
                'property_id' => $post['property_id'],
                'count_type' => $post['count_type'],
                'remark' => $post['remark'],
                'create_time' => $nowtime
            ));
            $operation = "新增佣金信息<br/>";
            $type = 1;
        }
        $operation .= '物业类型: "'. L('PROPERTY_MAP')[$post['property_id']] .'"<br />';
        $operation .= '佣金结算标准: "'. L('RULE_TYPE')[$post['count_type']] .'"<br />';
        if (empty($id)) {
            $this->msgBack(0, '服务出错');
        }
        foreach ($post['rule_list'] as $key => $item) {
            $this->checkData($item);
            $item['commision_id'] = $id;
            $item['create_time'] = $nowtime;
            $dataset[] = $item;
            $operation .= '('. ($key+1) .')代理服务费: "'. $item['min_count'] . '至' . $item['max_count'] . '套 ' . $item['proxy_service'] . ($item['count_type'] == 1 ? '%' : '元') .'"<br />';
            if ($item['has_cash'] == 1) {
                $operation .= '现金奖: "'. $item['cash'] . '元"<br />';
            }
            if (!empty($item['extra_award'])) {
                $operation .= '额外奖励: "'. $item['extra_award'] .'"<br />';
            }
        }
        if (!empty($item['remark'])) {
            $operation .= '备注: "'. $item['remark'] .'"<br />';
        }
        $this->addLog($post['loupan_id'], $operation, $type, L('YONGJIN'));
        return $dataset;
    }

    /**
     * @description 获取佣金列表
     */
    public function getList() {
        $this->setHeader();
        $loupan_id = I('get.loupan_id', 0, 'intval');
        $page_index = I('get.page', 1, 'intval');
        $where = array(
            'a.loupan_id' => $loupan_id
        );
        $list = $this->model_commision
                    ->where($where)
                    ->alias('a')
                    ->field('a.id,
                            a.loupan_id,
                            a.has_huxing,
                            a.huxing_ids,
                            a.property_id,
                            a.count_type,
                            a.proxy_service,
                            a.has_cash,
                            a.cash,
                            a.extra_award,
                            a.remark,content,
                            a.create_time,
                            b.name as property')
                    ->join('LEFT JOIN xq_property b ON a.property_id=b.id')
                    ->order('create_time desc')
                    ->page($page_index, 2)
                    ->select();
        foreach ($list as $key => $item) {
            $list[$key]['index'] = 2 * $page_index - 1;
            1 == $key && $list[$key]['index'] = 2 * $page_index - 1;
            $list[$key]['huxing'] = '';
            switch ($item['count_type']) {
                case 3:
                    $rule_raw_data = $this->model_JpCommision->where(array('commision_id' => $item['id']))->find();
                    $list[$key]['rule'] = '代理服务费(' . L('RULE_TYPE')[$rule_raw_data['count_type']] . 
                                            ');额外奖励:' . $rule_raw_data['extra_award'];
                    break;
                case 4:
                    $list[$key]['rule'] = $item['content'];
                    break;
                default:
                    $list[$key]['huxing'] = M('huxing', 'xq_')->where(array('id' => array('IN', $item['huxing_ids'])))->getField('GROUP_CONCAT(name)');
                    $list[$key]['huxing'] = str_replace(',', ';', $list[$key]['huxing']); // e.g. 'huxing' => string '户型1;户型2'
                    $list[$key]['rule'] = '代理服务费(' . L('RULE_TYPE')[$item['count_type']] . 
                                            ');额外奖励:' . $item['extra_award'];
                    break;
            }
        }
    }

    /**
     * @description 删除
     */
    public function delComm() {
        $this->setHeader();
        $id = I('request.id', 0, 'intval');
        $loupan_id = $this->model_commision->where(array('id' => $id))->getField('loupan_id');
        $this->model_commision->where(array('id' => $id))->delete();
        $operation = '删除一条佣金规则';
        $this->addLog($loupan_id, $operation, 3, L('YONGJIN'));
        $this->msgBack(1, '删除成功');
    }

    /**
     * @editComm 编辑页
     */
    public function editComm() {
        $this->setHeader();
        $id = I('request.id', 0, 'intval');
        $data = $this->model_commision->where(array('id' => $id))->find();
        if ($data['has_huxing'] == 1) {
            $data['huxing_arr'] = $this->model_huxing->where(array('id' => array('IN', $data['huxing_ids'])))->getField('GROUP_CONCAT(name)');
            $data['huxing_arr'] = str_replace(',', ';', $data['huxing_arr']);
        }
        if ($data['count_type'] == 3) {
            $data['rule_list'] = $this->model_JpCommision->where(array('commision_id' => $id))->select();
        }
        $this->msgBack(1, 'success', '', $data);
    }

    /**
     * @editComm 编辑页
     */
    public function editJieyong() {
        $this->setHeader();
        $id = I('request.id', 0, 'intval');
        $data = $this->model_jieyong->where(array('id' => $id))->find();
        
        $this->msgBack(1, 'success', '', $data);
    }

    /**
     * @description 删除
     */
    public function delJieyong() {
        $this->setHeader();
        $id = I('request.id', 0, 'intval');
        $this->model_jieyong->where(array('id' => $id))->delete();
        $this->msgBack(1, '删除成功');
    }

}