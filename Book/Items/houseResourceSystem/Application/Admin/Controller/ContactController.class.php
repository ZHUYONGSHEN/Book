<?php
namespace Admin\Controller;
use Think\PageAdv;

/**
 * 项目联系人管理
 */
class ContactController extends CommonController {

    public function __construct() {
        parent::__construct();
        $this->model_contact = M('contact', 'xq_');
    }

    /**
     * [index 联系人列表-项目详情编辑]
     * @return [type] [description]
     */
    public function index() {
        $loupan_id = I('request.id');
        if (empty($loupan_id)) {
            $this->msgBack(0, '楼盘id为必要参数');
        }
        $res = $this->model_contact->where(array('loupan_id' => $loupan_id))->order('contact_type')->select();
        if (!$res) {
            $this->msgBack(0, '暂无数据');
        }
        $this->msgBack(1, 'ok', '', $res);
    }


    /**
     * [_getData description]
     * @return [type]       [description]
     */
    protected function _getData() {
        $loupan_id    = I('post.loupan_id');
        if (empty($loupan_id)) $this->msgBack(0, '楼盘id为必要参数');
        $data         = array();
        $contact_type = I('post.type');
        $mobile       = I('post.mobile');
        $scale        = I('post.scale');
        $name         = I('post.name');
        $data         = array();
        foreach ($mobile as $key => $val) {
            $data[$key]['contact_type'] = $contact_type[$key];
            $data[$key]['loupan_id']    = $loupan_id;
            $data[$key]['mobile']       = $val;
            $data[$key]['name']         = $name[$key];
            $data[$key]['scale']        = $scale[$key];
        }
        return $data;
    }

    /**
     * [addContact 修改]
     * @return [type] [description]
     */
    public function addContact() {
        $data = $this->_getData();
        $loupan_id = I('post.loupan_id', 0, 'intval');
        $this->model_contact->where(array('loupan_id' => I('post.loupan_id')))->delete();
        $res  = $this->model_contact->addALL($data);
        if (!$res) {
            $this->msgBack(0, '编辑失败');
        }
        $list = $this->model_contact->where(array('loupan_id' => $loupan_id))->select();
        $operation = '编辑联系人<br />';
        foreach($list as  $key => $val){
            $list[$key]['type_str'] = L('CONTACT_MAP')[$val['contact_type']];
            $operation .= L('CONTACT_MAP')[$val['contact_type']] . ': "' . $val['name'] .'"<br />';
            $operation .= '联系电话: ' . $val['mobile'] .'<br />';
            if ($val['contact_type'] > 2) {
                $operation .= '分配比例: ' . $val['scale'] .'%<br />';
            }
        }
        $this->addLog($loupan_id, $operation, 2, L('CONTACT'));
        $this->msgBack(1, 'ok', '', $list);
    }

}