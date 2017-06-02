<?php
namespace Admin\Controller;
/**
 * 开发商管理
 * @author ruby
 */
class DeveloperController extends CommonController {
    protected $dao_user;
    public function __construct() {
        parent::__construct();
        $this->dao_user = D('ProxyUser');
    }
    /**
     * 开发商列表
     */
    public function index() {
        $keywords = I('get.keywords', '', 'trim');
        if (!empty($keywords)) {
            $where['account'] = array('like', "%$keywords%");
        }
        $where['parent_id'] = session(C('USER_AUTH_KEY'));
        $where['role_id'] = 2;//开发商
        $list = $this->_list($this->dao_user, $where, '*');
        foreach ($list as $key => $value) {
            $urls[$key][]         = array('btn_word' => '楼盘', 'btn_url' => U('house', array('id' => $value['id'])));
            $urls[$key][]         = array('btn_word' => '编辑', 'btn_url' => U('edit', array('id' => $value['id'])), 'is_ajax' => 1);
            $urls[$key][]         = array('btn_word' => '重置密码', 'btn_url' => U('repassword', array('id' => $value['id'])), 'is_ajax' => 1);
            $urls[$key][]         = array('btn_word' => '删除', 'btn_url' => U('del', array('id' => $value['id'])), 'is_ajax' => '', 'addClass' => 'btn-del');
            $list[$key]['acturl'] = $urls[$key];
        }
        $this->act = 'Db1';
        $this->cHandler($list);
    }
    /**
     * 添加开发商
     */
    public function add() {
        if (IS_POST) {
            $this->createData($this->dao_user);
            $this->dao_user->hash_code = $hash_code = rand_hash_code(4);
            $this->dao_user->password = makePassword($_POST['password'], $hash_code);
            if (($finalresult = $this->dao_user->add()) !== false) {
                if ($finalresult > 0) {
                    $this->msgBack(1, '添加成功', U('index'));
                } else {
                    $this->msgBack(0, '无改动');
                }
            } else {
                $this->msgBack(0, '添加失败');
            }
        } else {
            $this->act = 'Db1';
            $this->display('edit');
        }
    }
    /**
     * 编辑开发商
     */
    public function edit() {
        $id = I('id', 0, 'intval');
        if(IS_POST) {
            $this->updateData($this->dao_user, $id, U('index'));
        } else {
            $info = $this->dao_user->where(array('id' => $id))->find();
            $this->assign($info);
            $this->display();
        }
    }
    /**
     * 重置密码
     */
    public function repassword() {
        if(IS_POST) {
            $this->createData($this->dao_user);
            $this->dao_user->hash_code = $hash_code = rand_hash_code(4);
            $this->dao_user->password = makePassword($_POST['password'], $hash_code);
            if (($finalresult = $this->dao_user->save()) !== false) {
                if ($finalresult > 0) {
                    $this->msgBack(1, '重置成功', U('index'));
                } else {
                    $this->msgBack(0, '并未作出任何改动');
                }
            } else {
                $this->msgBack(0, '重置失败');
            }
        } else {
            $this->id = I('get.id');
            $this->display();
        }
    }
    /**
     * 删除帐号
     */
    public function del() {
        $where['id'] = I('get.id');
        if (false !== $this->dao_user->where($where)->delete()) {
            $this->msgBack(1, '删除成功', U('index'));
        } else {
            $this->msgBack(0, '删除失败');
        }
    }
    /**
     * 开发商拥有楼盘
     */
    public function house() {
        $user_id = I('get.id');
        if(empty($user_id)) {
            $this->alertBack('缺少传参 id');
        }
        $map['hid'] = array('in', getAuthHids(D('HouseRelation'), $user_id));
        $list    = $this->_list(M('loupan'), $map, 'hid,name,city,price,zhuangxiu_status,country');
        foreach ($list as $key => $value) {
            $urls[$key][]         = array('btn_word' => '取消分配', 'btn_url' => U('cancel', array('hid' => $value['hid'], 'user_id' => $user_id)), 'is_ajax' => '', 'addClass' => 'btn-cancel');
            $list[$key]['acturl'] = $urls[$key];
        }
        $this->act = 'Db1';
        $this->cHandler($list);
    }
    /**
     * 罗列可分配的楼盘
     */
    public function column() {
        $user_id = I('get.user_id');
        if(empty($user_id)) {
            $this->alertBack('缺少参数 user_id');
        }
        if (!session(C('ADMIN_AUTH_KEY'))) {
            if (in_array(session('user_role_id'), C('ADMIN_ROLE'))) {
                $map['hid'] = array('in', getHids(session(C('USER_AUTH_KEY'))));
            } else {
                $map['hid'] = array('in', getAuthHids(D('HouseRelation'), session(C('USER_AUTH_KEY'))));
            }
        }
        $list    = $this->_list(M('loupan'), $map, 'hid,name,city,price,zhuangxiu_status,country');
        foreach ($list as $key => $value) {
            $urls[$key][]         = array('btn_word' => '分配', 'btn_url' => U('allocate', array('hid' => $value['hid'], 'user_id' => $user_id)), 'is_ajax' => '', 'addClass' => 'btn-allocate');
            $list[$key]['acturl'] = $urls[$key];
        }
        $this->act = 'Db1';
        $this->cHandler($list);
    }
     /**
     * 分配楼盘给开发商
     */
    public function allocate() {
        $data['user_id'] = $user_id = I('get.user_id');
        $data['hid'] = I('get.hid');
        if (!$this->_checkAllocation($data) && $this->_Allocation($data)) {
            $this->msgBack(1, '分配成功', U('house', array('id' => $user_id)));
        }
        $this->msgBack(0, '分配失败');
    }
    /**
     * 取消分配楼盘给开发商
     */
    public function cancel() {
        $map = array();
        $map['user_id'] = $user_id = I('get.user_id');
        $map['hid'] = I('get.hid');
        if ($this->_cancelAllocation($map)) {
            $this->msgBack(1, '取消分配成功', U('house', array('id' => $user_id)));
        }
        $this->msgBack(0, '取消分配失败');
    }
    /**
     * 检测是否分配
     */
    protected function _checkAllocation($map) {
        if (D('HouseRelation')->where($map)->count()) {
            return true;
        }
        return false;
    }
    /**
     * 执行分配
     */
    protected function _Allocation($data) {
        $data['create_time'] = time();
        $data['add_user_id'] = session(C('USER_AUTH_KEY'));
        if (D('HouseRelation')->add($data)) {
            return true;
        }
        return false;
    }
    /**
     * 取消分配
     */
    protected function _cancelAllocation($map) {
        if (empty($map)) {
            return;
        }
        if (D('HouseRelation')->where($map)->delete()) {
            return true;
        }
        return false;
    }
    /**
     * 当前用户修改密码
     */
    public function rekeys() {
        if (IS_POST) {
            $auth_key = session(C('USER_AUTH_KEY'));
            $field = 'password,hash_code';
            $info = $this->dao_user->field($field)->where(array('id' => $auth_key))->find();
            if ($info['password'] != makePassword($_POST['oldpassword'], $info['hash_code'])) {
                $this->msgBack(0, '原密码错误！');
            }
            $this->dao_user->hash_code = $hash_code = rand_hash_code(4);
            $this->dao_user->password = makePassword($_POST['password'], $hash_code);
            if (($finalresult = $this->dao_user->where(array('id' => $auth_key))->save()) !== false) {
                $this->msgBack(1, '修改密码成功', U('rekeys'));
            } else {
                $this->msgBack(0, '修改密码失败');
            }
        } else {
            $this->act = 'Db2';
            $this->display();
        }
    }
}