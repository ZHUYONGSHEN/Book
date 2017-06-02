<?php
namespace Think;
class PageAdv {
    public $firstRow; // 起始行数
    public $listRows; // 列表每页显示行数
    public $parameter; // 分页跳转时要带的参数
    public $totalRows; // 总行数
    public $totalPages; // 分页总页面数
    public $rollPage   = 11; // 分页栏每页显示的页数
    public $lastSuffix = true; // 最后一页是否显示总页数

    private $p       = 'p'; //分页参数名
    private $url     = ''; //当前链接URL
    private $nowPage = 1;

    // 分页显示定制
    private $config = array(
        'header' => '<li><span class="rows">共 %TOTAL_ROW% 条记录</span></li>',
        'prev'   => '<<',
        'next'   => '>>',
        'first'  => '1...',
        'last'   => '...%TOTAL_PAGE%',
        'theme'  => '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
    );

    /**
     * 架构函数
     * @param array $totalRows  总的记录数
     * @param array $listRows  每页显示记录数
     * @param array $parameter  分页跳转的参数
     */
    public function __construct($totalRows, $listRows = 20, $parameter = array()) {
        C('VAR_PAGE') && $this->p = C('VAR_PAGE'); //设置分页参数名称
        /* 基础设置 */
        $this->totalRows = $totalRows; //设置总记录数
        $this->listRows  = $listRows; //设置每页显示行数
        $this->parameter = empty($parameter) ? $_GET : $parameter;
        $this->nowPage   = empty($_GET[$this->p]) ? 1 : intval($_GET[$this->p]);
        $this->nowPage   = $this->nowPage > 0 ? $this->nowPage : 1;
        $this->firstRow  = $this->listRows * ($this->nowPage - 1);
    }

    /**
     * 定制分页链接设置
     * @param string $name  设置名称
     * @param string $value 设置值
     */
    public function setConfig($name, $value) {
        if (isset($this->config[$name])) {
            $this->config[$name] = $value;
        }
    }

    /**
     * 生成链接URL
     * @param  integer $page 页码
     * @return string
     */
    private function url($page) {
        return str_replace(urlencode('[PAGE]'), $page, $this->url);
    }

    /**
     * 组装分页链接
     * @return string
     */
    public function show() {
        /* 生成URL */
        $this->parameter[$this->p] = '[PAGE]';
        $this->url                 = U(ACTION_NAME, $this->parameter);
        /* 计算分页信息 */
        $this->totalPages = ceil($this->totalRows / $this->listRows); //总页数
        if (!empty($this->totalPages) && $this->nowPage > $this->totalPages) {
            $this->nowPage = $this->totalPages;
        }
        $jump = $this->totalPages > 1 ? "<div class='input-group' style='width: 120px; display: inline-table;'>
                            <input type='text' name='".C('VAR_PAGE')."' id='getpage' class='form-control' data-toggle='tooltip' data-placement='top' title='输入跳转页码' />
                            <span class='input-group-btn'><button class='btn btn-primary' id='btn-paging-jump' type='button'>跳转</button></span>
                        </div>" : "";
        return "<div class='row'>
                    <div class='col-sm-2 text-left' style='line-height: 38px;'>共 ".$this->totalRows." 条记录</div>
                    <div class='col-sm-10 text-right'>
                        <ul class='pagination' id='pagination'></ul>
                        $jump
                    </div>
                </div>".$this->codeScript();
    }

    private function codeScript() {
        return '<script>
                        var ajaxUrl = "'.__SELF__.'";
                        window.pagObj = $("#pagination").twbsPagination({
                            totalPages: '.$this->totalPages.',
                            visiblePages: 6,
                            first: "首页",
                            prev: "上一页",
                            next: "下一页",
                            last: "末页",
                            onInit: function() {
                                $(".table tbody").html("<tr><td class=\'text-center\'  colspan=\'" + $(".table").find("tr:eq(0)").find("th").length + "\'>暂无数据</td></tr>");
                                $(".table").attr("data-totalpages", '.$this->totalPages.');
                            },
                            onPageClick: function (event, page) {
                                if(typeof reAjaxJump == "function") {
                                    reAjaxJump(page);// 具体页面具体重写~
                                } else {
                                    ajaxJump({"'.$this->p.'": page});
                                }
                                $(".table").attr("data-totalpages", '.$this->totalPages.');
                            }
                        });
                        $("#btn-paging-jump").on("click", function() {
                            if($("#getpage").val() == "") {
                                layer.msg("请输入页码数！");
                                return;
                            }
                            if(!/^[0-9]*[1-9][0-9]*$/.test($("#getpage").val())) {
                                layer.msg("请输入正整数！");
                                return;
                            }
                            window.pagObj.twbsPagination("show", parseInt($("#getpage").val()));
                        });
                    </script>';
    }
}
