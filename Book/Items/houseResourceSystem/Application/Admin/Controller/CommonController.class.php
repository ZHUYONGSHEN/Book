<?php
namespace Admin\Controller;
use Org\Net\UploadFile;
use Think\Controller;
use Think\PageAdv;
use Admin\Helper\Rbac;

class CommonController extends Controller {
    public $showActionBar = false;
    protected $model_area;

    public function __construct() {
        parent::__construct();
        $this->model_area = M('Area', 'zf_');

        if (in_array(MODULE_NAME, C('NOT_AUTH_MODULE'))) {
            return;
        }
/*
        if (in_array(CONTROLLER_NAME, C('NOT_AUTH_MODULE'))) {
            return;
        }

        // 用户权限检查
        if (C('USER_AUTH_ON')) {
            if (!session(C('USER_AUTH_KEY'))) { //检查认证识别号
                session(null);  //跳转到认证网关
                redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
            }
            if (!Rbac::AccessDecision('ZHAOFANG')) {

                // 没有权限 抛出错误
                if (C('RBAC_ERROR_PAGE')) {
                    // 定义权限错误页面
                    if (CONTROLLER_NAME == 'Index') {
                        session(null);
                    }
                    redirect(C('RBAC_ERROR_PAGE'));
                } else {
                    if (CONTROLLER_NAME == 'Index') {
                        redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
                    }
                    if(IS_AJAX){
                        $this->error(L('_VALID_ACCESS_'), $_SERVER['HTTP_REFERER'],true);
                    }
                    $this->error(L('_VALID_ACCESS_'), $_SERVER['HTTP_REFERER']);
                    if (C('GUEST_AUTH_ON')) {
                        if (CONTROLLER_NAME == 'Index') {
                            session(null);
                            redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
                        }
                        redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
                    }

                }
            }
        }
		*/
        $datas['last_time'] = time();
        $this->userid =    session(C('USER_AUTH_KEY'));
        D('ProxyUser')->where("id=" .$this->userid )->save($datas);
        $this->username =   session('loginAccount');
    }
    /**
     * 根据表单生成查询条件进行列表过滤
     * @param  object  $model  操作模型
     * @param  array   $map    where条件筛选
     * @param  string  $field  筛选数据字段
     */
    protected function _list($model, $map = array(), $field = '*') {
        if (isset($_GET['sort_by'])) {
            $this->assign('sort_by', $_GET['sort_by']);
            $this->assign('sort_order', ($_GET['sort_order'] == 'desc') ? 'asc' : 'desc');
            $sortBy = $_GET['sort_by'] . ' ' . $_GET['sort_order'];
        }
        $order     = !empty($sortBy) ? $sortBy : $model->getPk() . ' desc'; // 排序字段 默认为主键降序
        $count     = $model->where($map)->count($model->getPk()); //取得满足条件的记录数
        $p         = new PageAdv($count, C('PAGE_LISTROWS'));
        $page      = $p->show();
        // if ($this->showActionBar) {
        //     $p->setActionBar();
        // }
        // 分页查询数据
        $list = $model->field($field)->where($map)->order($order)->limit($p->firstRow . ',' . $p->listRows)->select();
        // 分页跳转的时候保证查询条件
        foreach ($map as $key => $val) {
            if (!is_array($val)) {
                $p->parameter .= "$key=" . urlencode($val) . "&";
            }
        }
        $this->assign("page", $page); // 分页显示
        $this->assign("_list_querys", $_SERVER['QUERY_STRING']);
        $this->assign('count', $count);
        cookie('_currentUrl_', __SELF__);
        return $list;
    }
    /**
     * 获取数一条数据公共方法
     * @author linchlin
     * @param object $model 操作模型
     * @param array  $where where查询条件
     * @param string $field 筛选数据字段
     * @param array  $split 图片路径拼接 [键名为要拼接的字段，键值为要拼接的字符串 如：$spilt=array('picture'=>"www/Public/Upload/Controller/")]
     * @param string $assign 渲染到视图的变量名
     *   */
    protected function _oneDetail($model,$where = array(),$field = '*',$split = array(),$assign = 'data'){
    	$data = $model->where($where)->field($field)->find();
    	empty($data) and exit('无数据返回');
    	if (!empty($split)) {
    		foreach ($split as $key=>$val) {
    			$data[$key] = $val . $data[$key];
    		}
    	}
    	$this->assign($assign,$data);
    }
    /**
     * 智能返回，多次调用
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function cHandler($data) {
        if(IS_AJAX) {
            exit(json_encode($data));
        } else {
            $this->assign('list', $data);
            $this->assign($_GET);
            $this->display();
        }
    }
    /**
     * 省市关联
     * @return [type] [description]
     */
    public function getCitys() {
        $adcode         = I('get.adcode', 0, 'intval');
        $adcode         = substr($adcode, 0, 2);
        $equelCondition = array('neq', $adcode . '0000');
        $map['adcode']  = array($equelCondition, array('like', (string) ($adcode) . "%00"));
        $map['level']   = 2;
        $citys          = $this->model_area->where($map)->cache(true, 86400)->select();
        if ($citys) {
            $this->ajaxReturn(array('status' => 1, 'info' => "OK", 'data' => $citys));
        } else {
            $citys = $this->model_area->where(array('adcode' => $adcode . '0000'))->find();// 直辖市的数据会走这里处理
            if ($citys) {
                $this->ajaxReturn(array('status' => 2, 'info' => "OK", 'data' => $citys));
            } else {
                $this->ajaxReturn(array('status' => 0, 'info' => "false", 'data' => ""));
            }
        }
    }
    /**
     * 市区关联
     * @return [type] [description]
     */
    public function getCountrys() {
        $adcode = I('get.adcode', 0, 'intval');
        $map    = array('adcode' => $adcode);
        $level  = $this->model_area->where($map)->getField('level');
        if ($level == 1) {
            //直辖市，特殊处理
            $adcode         = substr($adcode, 0, 3);
            $equelCondition = array('neq', $adcode . '000');
        } else {
            $adcode         = substr($adcode, 0, 4);
            $equelCondition = array('neq', $adcode . '00');
        }
        $map           = array();
        $map['adcode'] = array($equelCondition, array('like', (string) ($adcode) . "%"));
        $citys         = $this->model_area->where($map)->cache(true, 86400)->select();
        if ($citys) {
            $this->ajaxReturn(array('status' => 1, 'info' => "OK", 'data' => $citys));
        } else {
            $this->ajaxReturn(array('status' => 0, 'info' => "false", 'data' => ""));
        }
    }
    /**
     * 上传文件
     */
    public function upload() {
        if (IS_SAE === false) {
            import('ORG.UploadFile_sae');
        } else {
            import('ORG.Net.UploadFile');
        }
        $upload = new UploadFile(); // 实例化上传类
        $upload->maxSize = 31457280; // 设置附件上传大小
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
        $upload->savePath =  './'. C('UPLOAD_FLOAD') . '/' . I('post.savePath') . '/'; // 设置附件上传目录
        $data['status'] = 1;
        $data['info'] = '上传成功';
        if (!$upload->upload()) {// 上传错误提示错误信息
            $data['status'] = 0;
            $data['info'] = $upload->getErrorMsg();
        } else { // 上传成功
            $info = $upload->getUploadFileInfo();
            $info = $info[0];
            $data['url'] = /*ltrim($info['savepath'], '..') . '' .*/'/' . I('post.savePath') . '/' . $info['savename'];
            $data['name'] = $info['name'];
            if (IS_SAE === false) {
                $data['url'] = $upload->getUrl($data['url']);
            }
        }
        $this->ajaxReturn($data, 'JSON');
    }
    /**
     * 批量处理显示图片的路径，一个赋值给显示看的img，一个赋值给传参用的hidden标签
     * @param  [type] $path        数据库存储的图片路径
     * @param  [type] $target_name DOM元素的属性name
     * @param [type] $extend 附加
     * @param [type] $default 默认背景
     */
    public function handleImgPath($path, $target_name, $extend = true, $default) {
        $data['show_'.$target_name] = '/'.C('UPLOAD_FLOAD').$path;
        $data['hidden_'.$target_name] = $path;
        if(!!$extend) {
            if (empty($path) || !is_file('.'.$data['show_'.$target_name])) {
                $data['show_'.$target_name] = $default ? : C('DEFAULT_IMAGES');
                $data['hidden_'.$target_name]     = "";
                $data[$target_name.'_delete']  = 1;
            }
        }
        $this->assign($data);
    }
    /**
     * 动态生成二维码
     * @param String $url
     * @param String $code_name
     * @return string
     */
    static public function createQRcode($url, $code_name) {
        $obj = new \Common\Org\Util\Qcode();
        $imgurl = $obj->createQrimage($url, $code_name);
        return $imgurl;
    }
    /**
     * 配置Excel
     * @param  [type] $expTitle     [description]
     * @param  [type] $expCellName  [description]
     * @param  [type] $expTableData [description]
     * @return [type]               [description]
     */
    public function exportExcel($expTitle, $expCellName, $expTableData) {
        vendor('Execl.PHPExcel', '', '.php');
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle); //文件名称
        $fileName = $_SESSION['account'] . date('_YmdHis'); //or $xlsTitle 文件名称可根据自己情况设定
        $cellNum  = count($expCellName);
        $dataNum  = count($expTableData);
        $dataKs   = array_keys($expTableData);

        $objPHPExcel = new \PHPExcel();
        $cellName    = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:' . $cellName[$cellNum - 1] . '1'); //合并单元格
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle . ' 导出总数:' . $dataNum . '  导出时间:' . date('Y-m-d H:i:s'));
        /*设置特别表格的宽度*/
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(20); //表示设置A这一列的宽度,以下一样
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(20);

        /*设置font*/
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(14);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold(true);

        for ($i = 0; $i < $cellNum; $i++) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i] . '2', $expCellName[$i][1]);
        }
        foreach ($dataKs as $i) {
            $k++;
            for ($j = 0; $j < $cellNum; $j++) {
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j] . (($k) + 2), ($expTableData[$i][$expCellName[$j][0]] ?: ''));
            }
        }
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header('Content-type:application/vnd.ms-excel;charset=utf-8;');
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header("Content-Disposition:attachment;filename=" . $fileName . ".xls");
        header("Content-Transfer-Encoding:binary");
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
    /**
     * 获取公司/门店等
     */
    public function getCompany() {
        if(isset($_GET['level'])) {
            $where['level'] = intval($_GET['level']);
        }
        if(isset($_GET['pid'])) {
            $where['pathid'] = intval($_GET['pid']);
        }
        $where['state'] = 1;
        $list = M('CompanyType')->where($where)->select();
        if(!empty($list)) {
            $this->ajaxReturn(array('status' => 1, 'info' => '有数据返回', 'data' => $list));
        }
        $this->ajaxReturn(array('status' => 0, 'info' => '无数据返回'));
    }

    /**
     * 获取公司下级门店/区域
     * [getTree description]
     * @param  [type] $store_code [description]
     * @param  string $field      [description]
     * @param  array  $where      [description]
     * @return [type]             [description]
     */
    public function getTree($id) {
        $child = M('CompanyType')->where(array('pathid' => $id, 'state' => 1))->select();
        if ($child[0]['level'] == 3) {
            return $child;
        }
        foreach ($child as $key => $value) {
            $child[$key]['_child'] = $this->getTree($value['id']);
        }
        return $child;
    }

    /**
     * 生成门店码
     * @param  String $company_code 公司编码
     * @param  String $store_code 父级编码
     * @param  Int $level 生成几级编码
     * @return String 成功返回新编码
     */
    public function generateStoreCode($company_code, $store_code, $level) {
        $store_code = str_replace($company_code, '', $store_code);
        if ($level == 2) {
            $num = intval($store_code) + 1;
            $len = strlen($num);
            $str = implode('', array_pad(array(), 3-$len, '0'));
            return $company_code . $str . $num;
        } else if ($level == 3) {
            if (strlen($store_code) < 4) {
                return $company_code . $store_code . '001';
            }
            $num = substr($store_code, -3, 3);
            $index = stripos($store_code, $num);
            $result = substr($store_code, 0, 3);
            $num = intval($num) + 1;
            $len = strlen($num);
            $str = implode('', array_pad(array(), 3-$len, '0'));
            return $company_code . $result . $str . $num;
        }
        return false;
    }

    public function msgBack($status = 0, $info = '', $locate = '', $data) {
        if($status == 0) {
            $tokenName  = C('TOKEN_NAME',null,'__hash__');
            $tokenType  = C('TOKEN_TYPE',null,'md5');
            if(!isset($_SESSION[$tokenName])) {
                $_SESSION[$tokenName]  = array();
            }
            // 标识当前页面唯一性
            $tokenKey   =  md5($_SERVER['REQUEST_URI']);
            if(!isset($_SESSION[$tokenName][$tokenKey])) {
                $tokenValue = $tokenType(microtime(TRUE));
                $_SESSION[$tokenName][$tokenKey]   =  $tokenValue;
                if(IS_AJAX && C('TOKEN_RESET',null,true)) {
                    $return['hash_name'] = $tokenName;
                    $return['hash_value'] = $tokenKey.'_'.$tokenValue;
                    $return['session_hash'] = $_SESSION[$tokenName];
                }
            }
        }
        $return['status'] = $status;
        $return['info'] = $info;
        if(!empty($locate)) {
            $return['locate'] = $locate;
        }
        if(!empty($data)) {
            $return['data'] = $data;
        }
        $this->ajaxReturn($return);
    }

    public function alertBack($info) {
        echo "<script>alert('$info');window.history.back();</script>";
        exit;
    }

    public function createData($dao) {
        if(false === $dao->create()) {
            $this->msgBack(0, $dao->getError());
        }
    }

    public function insertData($dao, $locate = '') {
        $this->createData($dao);
        $result = $dao->add();
        if ($result !== false) {
            if($result > 0) {
                $this->msgBack(1, '操作成功', $locate);
            } else {
                $this->msgBack(0, '无改动');
            }
        }
        $this->msgBack(0, '操作失败');
    }

    public function updateData($dao, $pkval, $locate) {
        $this->createData($dao);
        $pk = $dao->getPk();
        $where[$pk] = $pkval;
        if(isset($_POST[$pk])) unset($_POST[$pk]);
        $result = $dao->where($where)->save();
        if ($result !== false) {
            if($result > 0) {
                $this->msgBack(1, '操作成功', $locate, $dao->where($where)->find());
            } else {
                $this->msgBack(0, '无改动');
            }
        } else {
            $this->msgBack(0, $dao->getError());
        }
    }

    /**
     * 跨域设置
     */
    protected function setHeader()
    {
        header('Content-Type:application/json; charset=utf-8');
        header("Access-Control-Allow-Origin:*");
        header("Access-Control-Allow-Methods:POST,GET");
    }

    /**
     * 新增操作日志(新房)
     */
    protected function addLog($loupan_id, $operation, $action, $module) {
        M('Log', 'xq_')->add(array('loupan_id' => $loupan_id, 'operation' => $operation, 'action' => $action, 'module' => $module, 'operator_id' => $this->userid, 'create_time' => date('Y-m-d H:i:s', time() + 10)));
    }

}