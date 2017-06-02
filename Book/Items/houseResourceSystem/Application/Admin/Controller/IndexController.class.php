<?php
namespace Admin\Controller;
// +----------------------------------------------------------------------
// | @filename IndexController.class.php 
// +----------------------------------------------------------------------
// | @encoding UTF-8 
// +----------------------------------------------------------------------
// | @author xingcuntian@qq.com 
// +----------------------------------------------------------------------
// | @datetime 2015-11-18  13:34:11
// +----------------------------------------------------------------------
// | @Description 公共基础方法
// +----------------------------------------------------------------------
class IndexController extends CommonController {

	public function __construct()
    {
        parent::__construct();

        $this->assign('id',1);
    }

    public function Index(){
        
        $this->display('Index/welcome');
    }
//     public function Index()
//     {
// 		$this->_listRows = 8;
//         $data = array();
//         $map['type'] = 'bulletin';
//         $field = 'id,title,abstract,content,create_time';
//         $data['list'] = $this->_list(M('Article'), $map, $field, false);
//         $this->assign($data);
//         $this->display('Index/welcome');
//     }
    
    /**
     * 详情
     */
    public function detail(){
      $id = I('get.id',0,'intval');
      $field = 'id,title,abstract,content,create_time';
      $info = M('Article')->field($field)->where(array('id'=>$id))->find();
      $info['content'] = html_entity_decode($info['content']);
      $this->assign($info);
      $this->display();
    }

    /**
     * 统计图
     */
    public function viewLine() {
        Vendor('Jpgraph.Chart');
        $chart = new \Chart;
        $title = "ssss"; //标题
        $data = array(20, 27, 45, 75, 90, 10, 80, 100, 200); //数据
        $size = 140; //尺寸
        $width = 1000; //宽度
        $height = 260; //高度
        $legend = array('2006年', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014'); //说明
        $chart->createmonthline($title, $data, $size, $height, $width, $legend);
    }

    /**
     * 统计图
     * 7日数据统计
     */
    public function oneWeekLine() {
        Vendor('Jpgraph.Chart');
        $chart = new \Chart;
        $title = "7日"; //标题
        $data = array(20, 27, 45, 75, 90, 10, 80, 100, 200); //数据
        $size = 140; //尺寸
        $width = 1000; //宽度
        $height = 260; //高度
        $legend = array('2006年', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014'); //说明
        $chart->createmonthline($title, $data, $size, $height, $width, $legend);
    }

    /**
     * 统计图
     * 两周的统计
     */
    public function twoWeekLine() {
        Vendor('Jpgraph.Chart');
        $chart = new \Chart;
        $title = "14日"; //标题
        $data = array(20, 27, 45, 75, 90, 10, 80, 100, 200); //数据
        $size = 140; //尺寸
        $width = 1000; //宽度
        $height = 260; //高度
        $legend = array('2006年', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014'); //说明
        $chart->createmonthline($title, $data, $size, $height, $width, $legend);
    }

    /**
     * 统计图
     * 30 天数据统计
     */
    public function oneMonthLine() {
        Vendor('Jpgraph.Chart');
        $chart = new \Chart;
        $title = "30日"; //标题
        $data = array(20, 27, 45, 75, 90, 10, 80, 100, 200); //数据
        $size = 140; //尺寸
        $width = 1000; //宽度
        $height = 260; //高度
        $legend = array('2006年', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014'); //说明
        $chart->createmonthline($title, $data, $size, $height, $width, $legend);
    }

}
