<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>腾讯街景找房</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="腾讯街景找房">
    <meta name="author" content="Muhammad Usman">
		<link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css"/>
		<link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css">
		<link href='/Public/Admin/bower_components/chosen/chosen.min.css' rel='stylesheet'>


		<script type="text/javascript" src="/Public/Admin/js/jquery.min.js" ></script>
		<script type="text/javascript" src="/Public/Admin/js/bootstrap.min.js" ></script>



    <!-- jQuery
    <script src="/Public/Admin/bower_components/jquery/jquery.min.js"></script>
    <script src="/Public/Admin/bower_components/chosen/chosen.jquery.min.js"></script>
    <script src="/Public/Admin/js/jquery_validate_min.js"></script>
   	<script type="text/javascript" src="/Public/Admin/js/layer/layer.js"></script>

-->
    <script src="/Public/Admin/js/layer.js"></script>
<script src="/Public/Admin/js/jquery_validate_min.js"></script>
<script src="/Public/Admin/bower_components/chosen/chosen.jquery.min.js"></script>
<script src="/Public/Admin/js/jquery.twbsPagination.js" type="text/javascript"></script>
<script src="/Public/Admin/js/base.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="/Public/Admin/img/favicon.ico">
</head>

<body>
<!-- topbar starts -->
		<!--头部开始-->
		<div class="ho-top">
			<div class="ho-main">
				<!--logo开始-->
				<div class="ho-logo"><a href="/"><img src="/Public/Admin/img/logo.png"></a></div>
				<!--logo结束-->
				<!--导航开始-->
				<div class="ho-nav">
	               <ul>
	                    <li><a href="<?php echo U('HouseManage/houseList');?>" <?php if(CONTROLLER_NAME == 'HouseManage'): ?>class="active"<?php endif; ?>>房源管理</a></li>
	                    <li><a href="<?php echo U('Dictionary/index');?>" <?php if(CONTROLLER_NAME == 'Dictionary'): ?>class="active"<?php endif; ?>>楼盘字典</a></li>
                        <li><a href="<?php echo U('NewHouse/index');?>" <?php if(in_array((CONTROLLER_NAME), explode(',',"NewHouse,HouseType"))): ?>class="active"<?php endif; ?>>新房管理</a></li>
	                     <li><a href="<?php echo U('Log/index');?>" <?php if(CONTROLLER_NAME == 'Log'): ?>class="active"<?php endif; ?>>操作日志</a></li>
	                </ul>
					<div class="clear"></div>
				</div>
				<!--导航结束-->
				<div class="clear"></div>
			</div>
		</div>
		<!--头部结束-->
<!-- topbar ends -->
<script type="text/javascript" src="/Public/Admin/js/common.js" ></script>
<!--主体开始-->
        <div class="ho-main">
          <br />
            <div class="ho-search restoreBootstrap">
                <form class="form-inline">
                    <div class="form-group">
                        <select name="province_code" class="form-control">
                            <option value="">省份-全部</option>
                            <option value="110000">北京市</option>
                       </select>
                    </div>
                    <div class="form-group">
                        <select name="province_code" class="form-control">
                            <option value="">城市-全部</option>
                            <option value="110000">北京市</option>
                       </select>
                    </div>
                   <div class="form-group">
                        <select name="province_code" class="form-control">
                            <option value="">新房-全部</option>
                            <option value="110000">北京市</option>
                       </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="请输入关键字">
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-blue"><i class="searchNewIcon"></i> 搜索</button>
                    </div>      
                </form>
            </div>
            <div class="clearfix text-right margin-right-20">
              <a class="btn btn-blue BombElem" data-module="regionConfigure" data-title="添加城市">添加城市</a>
            </div>
            <br />
            <div class="ho-list table-border-block border">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                              <th>序号</th>
                              <th>省份</th>
                              <th>城市</th>
                              <th>新房</th>
                              <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>深圳</td>
                              <td>罗湖</td>
                              <td>碧海湾</td>
                              <td>住宅</td>
                              <td>
                                <a class="btn BombElem" data-module="regionConfigure" data-title="编辑城市">编辑</a>
                                <a class="btn BombElem" data-module="configurePrice" data-title="配置总价">配置总价</a>
                                <a class="btn delMessage">删除</a>
                              </td>
                            </tr>
                            <tr>
                              <td>深圳</td>
                              <td>罗湖</td>
                              <td>碧海湾</td>
                              <td>住宅</td>
                              <td>
                                <a class="btn BombElem" data-module="regionConfigure" data-title="编辑城市">编辑</a>
                                <a class="btn BombElem" data-module="configurePrice" data-title="配置总价">配置总价</a>
                                <a class="btn delMessage">删除</a>
                              </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="ho-row">
                    <div class="row">
                        <div class="col-sm-4" style="line-height: 35px;">共 65112 条记录</div>
                        <div class="col-sm-8 text-right">
                            <ul class="pagination" style="margin-bottom: 0; margin-top: 0;">
                                <li>
                                  <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">首页</span>
                                  </a>
                                </li>
                                <li>
                                  <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">上一页</span>
                                  </a>
                                </li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                  <a href="#" aria-label="Next">
                                    <span aria-hidden="true">下一页</span>
                                  </a>
                                </li>
                            </ul>
                            <div class="input-group" style="width: 120px; display: inline-table;">
                                <input type="text" name="" class="form-control">
                                <span class="input-group-btn"><button class="btn btn-primary" id="btn-paging-jump" type="button">跳转</button></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" data-module="regionConfigure">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close outline" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">添加城市</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"> <i class="required">*</i>省份：</label>
                    <div class="col-sm-7 padding-left-zero">
                      <select class="form-control">
                        <option>请选择省份</option>  
                        <option>朝向</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"> <i class="required">*</i>城市：</label>
                    <div class="col-sm-7 padding-left-zero">
                      <select class="form-control">
                        <option>请选择城市</option>  
                        <option>朝向</option>
                      </select>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
               <div class="text-center">
                  <button type="button" class="btn btn-blue outline">保存</button>
                  <button type="button" class="btn btn-default outline" data-dismiss="modal">取消</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal" data-module="configurePrice">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close outline" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">配置总价</h4>
              </div>
              <div class="modal-body" style="max-height: 770px; overflow-y: auto;">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"> 省份：</label>
                    <div class="col-sm-7 padding-left-zero">深圳市</div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"> <i class="required">*</i>最小总价：</label>
                    <div class="pull-left margin-right-15">
                      <input type="text" class="form-control" placeholder="价格">
                    </div>
                    <div class="pull-left control-label">万元以下</div>
                  </div>
                  <div class="sectionPrice">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> 其他区间：</label>
                      <div class="pull-left margin-right-15">
                        <input type="text" class="form-control" placeholder="价格">
                      </div>
                      <div class="pull-left control-label margin-right-15">一</div>
                      <div class="pull-left margin-right-15">
                        <input type="text" class="form-control" placeholder="价格">
                      </div>
                      <div class="pull-left control-label margin-right-15">万</div>
                      <span class="btn addIcon addNewElem" style="margin-top: 5px;"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"> <i class="required">*</i>最大总价：</label>
                    <div class="pull-left margin-right-15">
                      <input type="text" class="form-control" placeholder="价格">
                    </div>
                    <div class="pull-left control-label">万元以上</div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
               <div class="text-center">
                  <button type="button" class="btn btn-blue outline">保存</button>
                  <button type="button" class="btn btn-default outline" data-dismiss="modal">取消</button>
                </div>
              </div>
            </div>
          </div>
        </div>        
        <div  class="close_del_up_mian" style="display:none;">
            <div>
                <p class="alert_title border-bottom">提示信息</p>
                <div class="text-center padding30">
                    删除数据将无法恢复，是否继续？
                </div>
            </div>
        </div>
        <div class="promptBox" style="display:none;"><p class="background-white"></p></div>
        <script>
          $(function(){
            $('.table-responsive').on('click','.delMessage',function(){
              var _that = $(this);
              alertbox({
                msg: $('.close_del_up_mian').html(),
                tcallfn_tx:'确认',
                alerttap:1,
                tcallfn:function(){
                  //点击删除按钮后操作
                  _that.parents('tr').remove();
                  promptBoxHidden('删除成功');
                }
              })
            });
            $('.addNewElem').click(function(){
              var _html='<div class="form-group">'+
                      '<label class="col-sm-2 control-label"> </label>'+
                      '<div class="pull-left margin-right-15">'+
                        '<input type="text" class="form-control" placeholder="价格">'+
                      '</div>'+
                      '<div class="pull-left control-label margin-right-15">一</div>'+
                      '<div class="pull-left margin-right-15">'+
                        '<input type="text" class="form-control" placeholder="价格">'+
                      '</div>'+
                      '<div class="pull-left control-label margin-right-15">万</div>'+
                      '<span class="btn minusIcon delElem" style="margin-top: 13px;"></span>'+
                    '</div>';
              var parentElem = $(this).parents('.sectionPrice');
              parentElem.append(_html);
            });
            $('.sectionPrice').on('click','.delElem',function(){
              $(this).parents('.form-group').remove();
            });
            $('.BombElem').click(function(){
              var showModule,_thisText;
                showModule = $(this).attr('data-module'),
                _thisText = $(this).attr('data-title');
                $(".modal[data-module='"+ showModule +"']").find('.modal-title').text(_thisText);
              $(".modal[data-module]").fadeOut();
              $(".modal[data-module='" + showModule+"']").fadeIn();
              return false;
            });
            //关闭自定义弹框
            $(".modal[data-module] [data-dismiss='modal']").click(function(){
              $(this).parents('.modal[data-module]').fadeOut();
              return false;
            });
            function promptBoxHidden(val){
              $('.promptBox').fadeIn();
              $('.promptBox p').text(val);
              var clearTime = setTimeout(function(){
                $('.promptBox').fadeOut();
                clearTimeout(clearTime);
              },1000);
            }
          });
        </script>
    </body>
</html>