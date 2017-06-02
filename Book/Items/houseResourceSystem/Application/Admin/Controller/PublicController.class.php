<?php

namespace Admin\Controller;


use Admin\Helper\Rbac;
// +----------------------------------------------------------------------
// | @filename PublicController.class.php 
// +----------------------------------------------------------------------
// | @encoding UTF-8 
// +----------------------------------------------------------------------
// | @author xingcuntian@qq.com 
// +----------------------------------------------------------------------
// | @datetime 2015-11-18  13:53:22
// +----------------------------------------------------------------------
// | @Description 公共模块无需验证
// +----------------------------------------------------------------------
class PublicController extends \Think\Controller {

    public $error;

    public function login() {
		$datas['token_msg'] = $_GET['token_msg'];
        if (IS_AJAX || IS_POST) {
			$account = $_POST['account'];
			$data['token'] = $_POST['token'];
			session_start();
			$_SESSION['account']=$account;
			if(!empty($account)){
				D('ProxyUser')->where(array('account' => $account))->save($data);
			}else{
				D('ProxyUser')->add($data);
			}
            if (!$this->_checkLogin()) {
                $this->ajaxReturn(array('status' => 0, 'info' => $this->error));
            }
            if (checkAccessFromUrl('Index/index')) {
                $redirect_url = U('Index/index');
            } else {
                $redirect_url = U('Index/index');

            }
            $this->ajaxReturn(array('status' => 1, 'info' => '登录成功', 'to_url' => $redirect_url));
        }
		if($datas['token_msg']){
			if($datas['token_msg'] == 123){
				$account = $_GET['account'];
				$data['token'] = '';
				D('ProxyUser')->where(array('account' => $account))->save($data);
				session(null);
			}
		}

        if (session(C('USER_AUTH_KEY'))) {
            if (checkAccessFromUrl('Index/index')) {
                $redirect_url = U('Index/index');
            } else {
                $redirect_url = U('Index/index');
            }
            $this->redirect($redirect_url);
        }
		$this->assign('token',time());
        $this->display();
    }

    /**
     * 登录检测
     */
    protected function _checkLogin() {
        $account = I('post.account', '', 'htmlspecialchars');
        $password = I('post.password', '', 'htmlspecialchars');
        if (empty($account)) {
            session(NULL);
            $this->error = '帐号错误';
            return false;
        } elseif (empty($password)) {
            session(NULL);
            $this->error = '密码必须';
            return false;
        }
        //生成认证条件
        $map = array('account' => $account, 'status' => 1);
        $authInfo = Rbac::authenticate($map);
        if (null === $authInfo) {
            session(NULL);
            $this->error = '帐号不存在或已禁用';
            return false;
        }
        //密码加密校验
        if ($authInfo['password'] != makePassword($password, $authInfo['hash_code'])) {
            session(NULL);
            $this->error = '密码错误！';
            return false;
        } else {
            if (empty($authInfo['id_alias'])) {
                $id_alias = rand_string(6) . $authInfo['id'];
                D(C('USER_AUTH_MODEL'))->where(array('id' => $authInfo['id']))->save(array('id_alias' => $id_alias));
                session('id_alias', $id_alias);
            } else {
                session('id_alias', $authInfo['id_alias']);
            }
            session(C('USER_AUTH_KEY'), $authInfo['id']);
            session('loginAccount', $authInfo['account']);
            session('lastLoginTime', $authInfo['last_login_time']);
            session('lastLoginIP', $authInfo['last_login_ip']);
            session('loginCount', $authInfo['login_count'] + 1);

            // setLoginSession();
            //管理员角色
            if ($authInfo['account'] == 'administrator') {
                session(C('ADMIN_AUTH_KEY'), true);
                session('loginRole', 'Super Administrator');
            } else {
                session('user_role_id', $authInfo['role_id']);
                session('loginRole', getDataName($authInfo['role_id'], 'Role'));
            }
            //保存登录信息
            $data = array(
                'id' => $authInfo['id'],
                'last_login_time' => time(),
                'login_count' => array('exp', 'login_count+1'),
                'last_login_ip' => get_client_ip()
            );
            D('ProxyUser')->save($data);
            // 缓存访问权限
            Rbac::saveAccessList();
            /* 写管理员日志 */
            // writeLog("登录成功");
            return true;
        }
    }

    /**
     * 退出系统
     */
    public function logout() {
		$account = $_GET['account'];
		$data['token'] = '';
		D('ProxyUser')->where(array('account' => $account))->save($data);
        session(NULL);
        $this->redirect(U('Public/login'));
    }

 
}
