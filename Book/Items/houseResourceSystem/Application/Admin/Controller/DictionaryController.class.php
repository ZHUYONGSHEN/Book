<?php
namespace Admin\Controller;
use Org\Net\UploadFile;
use Think\PageAdv;
class DictionaryController extends CommonController {

    protected $model;
    public function __construct() {
        parent::__construct();
        $this->model = D(CONTROLLER_NAME);
        C('TOKEN_ON', false);
    }
    /**
     * 添加楼盘
     * @author dz
     */
    public function add() {
		if (IS_POST){
			if ($this->model->create(I('post.'),1)){
				if ($this->model->add()){
					$this->success('添加成功!',U('successMsg'),true);
					exit;
				}
			}
			$this->error($this->model->getError(),'',true);
		}else {
			$this->display('edit');
		}
	}
    /**
     * 添加楼盘成功页面
     * @author dz
     */
    public function successMsg() {

			$this->display();

	}

    /**
     * 查询提交数据筛选过滤
     * @return array 结果集
     */
    private function _mapFilter() {

    	    $keyword     = I('get.keyword', '', 'trim');
    	    $province_adcode = I('get.province_code', 0, 'intval'); // 所在省
	        $city_adcode = I('get.city_code', 0, 'intval'); // 所在市
	        $country_adcode = I('get.country_code', 0, 'intval'); // 所在区
                /* 条件查询：过滤地区 */
            if (!empty($country_adcode)) {
                $where['district'] = array('like', "%" . $this->model_area->getFieldByAdcode($country_adcode, 'name') . "%");
            } else if (!empty($city_adcode)) {
                $where['city'] = array('like', "%" . $this->model_area->getFieldByAdcode($city_adcode, 'name') . "%");
            } else if (!empty($province_adcode)) {
                $where['province'] = array('like', "%" . $this->model_area->getFieldByAdcode($province_adcode, 'name') . "%");
            }

			if($keyword){
			    	$where['name'] = array('like',"%".$keyword."%");
		    	}
			 return $where;
    }

    /**
     * 小区列表
     * @author dz
     */
    public function index() {
		$where = $this->_mapFilter();
        $field = 'id, name, city, district, detail_address, build_num, build_year, FROM_UNIXTIME(create_time) as create_time, input_user';
        $count = $this->model->Distinct(true)->where($where)->count();
        $p     = new PageAdv($count, C('PAGE_LISTROWS'));
        $list  = $this->model->Distinct(true)->field($field)->where($where)->limit($p->firstRow . ',' . $p->listRows)->order('id DESC')->select();
        $page  = $p->show();
/*        foreach ($list as $key => $value) {
            $urls[$key][]         = array('btn_word' => '编辑小区', 'btn_url' => U('edit', array('id' => $value['id'])));
            $urls[$key][]         = array('btn_word' => '小区房源数据', 'btn_url' => U('data', array('cid' => $value['id'])));
            $list[$key]['acturl'] = $urls[$key];
        }*/
        $this->assign("page", $page);
        $this->cHandler($list);
    }

     /**
     * ajax动态查询楼盘框架信息
     * @author dz
     */
    public function getSearchWords() {
        $keywords = I('get.term', '', 'trim');
        $map['house_name'] = array('like', '%' . $keywords . '%');
        $map['status'] = array('eq',1);
        $field = 'hid,house_name as label,address';
        $data = M('House', 'pano_')->field($field)->where($map)->limit(50)->select();

        if ($data) {
			echo json_encode($data);
        }else {
        	$data = array('hid'=>'','label'=>'暂无楼盘信息！','address'=>'');
        	echo json_encode($data);
        }
    }
    /**
     * 编辑楼盘字典
     * @author dz
     */
    public function edit() {
        $id = I('get.id');
        if (empty($id)) {
            $this->alertBack('缺少参数');
        }
        if (IS_POST) {
        	$_POST['id'] = $id;
    		if($this->model->create(I('post.'), 2)){
    			if($this->model->save() !== FALSE)
    			{
    				$this->success('修改成功!',U('successMsg'),true);
    				exit;
    			}
    		}
    		$this->error($this->model->getError());
        } else {
            $community = $this->model->find($id);
            $this->assign($community);
            $this->assign('act', Ed1);
            $this->display();
        }
    }

     /**
     * ajax上传图片
     * @author dz
     */
    public function ImgUpload() {

    	$savePath  = date('Y').'/'.date('m').'/';
        if(!is_dir('./'. C('UPLOAD_FLOAD') . '/image/' .$savePath)) {
            mkdir('./'. C('UPLOAD_FLOAD') . '/image/' .$savePath, 0777, true);
        }
        $abPath  =  C('APP_URL').'/'. C('UPLOAD_FLOAD') . '/image/' .$savePath;
        $rePath  =  '/'. C('UPLOAD_FLOAD') . '/image/' .$savePath;
        $dbPath  =  'image/' .$savePath;    //新房管理
		$savePath	=  './'. C('UPLOAD_FLOAD') . '/image/' .$savePath;

        if (IS_SAE === false) {
            import('ORG.UploadFile_sae');
        } else {
            import('ORG.Net.UploadFile');
        }
        $upload            = new UploadFile(); // 实例化上传类
        $upload->maxSize   = 214572800; // 设置附件上传大小
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
        $upload->savePath  = $savePath; // 设置附件上传目录
        if (!$upload->upload()) {
            $data['status'] = 0;
            $data['info']   = $upload->getErrorMsg();
        } else {
            // 上传成功
            $info         = $upload->getUploadFileInfo();
            $info         = $info[0];
            $data['imgUrl']  = $rePath.$info['savename'];
            $data['imgPath']  = $dbPath.$info['savename']; // 新房管理
            $data['returnCode'] = 'SUCCESS';
            $data['returnMsg']   = '上传成功';
            $data['fileName'] = $info['name'];
        }
        $this->ajaxReturn($data, 'JSON');
    }

     /**
     * ajax将图片信息录库
     * @author dz
     */
    public function Imgsava() {

        if (IS_POST) {
        	$_POST['build_id'] = I('post.build_id', 0, 'intval');
        	$_POST['img_type'] = I('post.img_type', 0, 'intval');
            $this->insertData(M('DictionaryImg', 'pano_'), U('index'));
        }

    }

    /**
     * 楼盘字典详情
     * @author dz
     */
    public function data() {
        $id = I('get.id');
        if (empty($id)) {$this->alertBack('缺少参数');}
        $community = $this->model->find($id);
        $where['build_id'] = array('eq',$id);
        $images['images'] = M('DictionaryImg', 'pano_')->where($where)->select();
        $this->assign($community);
        $this->assign($images);
		$this->assign('empty','<div style="text-align:center;">暂无照片</div>');
        $this->display();

    }
     /**
     * ajax获取图片列表
     * @author dz
     */
    public function Imglist(){
    	if (IS_AJAX) {
    	$img_type = I('post.img_type');
    	$build_id = I('post.build_id');
    	$where['build_id'] = array('eq',$build_id);
    	$where['img_type'] = array('eq',$img_type);
        $row = M('DictionaryImg', 'pano_')->field('img_url')->where($where)->select();
    	if ($row){
			$ret['status'] = 1;
			$ret['info'] = '成功!';
			$ret['list'] = $row;
			$this->ajaxReturn($ret);

		}else{
			$ret['status'] = 0;
			$ret['info'] = '失败!';
			$this->ajaxReturn($ret);
		}
    	}
    }
    /**
	 * 删除功能
	 * @author liwenzhong
	 * @email 823380452@qq.com
	 */
	public function delete()
	{
		$id = I('post.id');
		$where = array('id'=>$id);
		$row = $this->model->where($where)->delete();
		if ($row !== false){
			$ret['status'] = 1;
			$ret['info'] = '删除成功!';
			$ret['url'] = U('index');
			$this->ajaxReturn($ret);

		}else{
			$ret['status'] = 0;
			$ret['info'] = '删除失败,请稍后重试!';
			$this->ajaxReturn($ret);
		}

	}

}
