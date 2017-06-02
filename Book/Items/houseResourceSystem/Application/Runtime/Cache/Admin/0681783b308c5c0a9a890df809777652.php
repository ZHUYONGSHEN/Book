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
                        <li><a href="<?php echo U('NewHouse/index');?>" <?php if(CONTROLLER_NAME == 'NewHouse'): ?>class="active"<?php endif; ?>>新房管理</a></li>
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
<!--主体开始-->
        <div class="ho-main">
          <div class="hoMain-body">
            <form class="form-horizontal">
              <div class="background-white border fontColor">
                <div class="hoMain-title">
                  <h3>新建项目</h3>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-2 control-label padding-right-zero"><i class="required">*</i> 所属楼盘：</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="请选择当前项目所属楼盘">
                  </div>
                  <div class="col-sm-3 control-label" style="text-align: left;">
                    <a href="#">没有找到楼盘？点此到楼盘字典新增</a>
                  </div>
                </div>
              </div>
              <br>
              <div class="background-white border fontColor">
                <div class="hoMain-title">
                  <a href="#" class="btn btn-blue pull-right">新增物业类型</a>
                  <h3>佣金信息</h3>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-2 control-label padding-right-zero"><i class="required">*</i> 物业类型：</label>
                  <div class="col-sm-6">
                    <label class="checkbox-inline">
                      <input type="checkbox" value="option1"> 1
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" value="option1"> 1
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" value="option1"> 1
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" value="option1"> 1
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" value="option1"> 1
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" value="option1"> 1
                    </label>
                   <label class="checkbox-inline">
                      <input type="checkbox" value="option1"> 1
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" value="option1"> 1
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" value="option1"> 1
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" value="option1"> 1
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" value="option1"> 1
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" value="option1"> 1
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i> 佣金结算标准：</label>
                  <div class="col-sm-6">
                    <select class="form-control">
                      <option value="">按成交价比例</option>
                      <option value="110000">按成交价比例</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i> 代理服务费：</label>
                  <div class="col-sm-10">
                    <div class="col-sm-2 padding-right-zero">
                      <div class="input-group">
                        <input type="text" for="basic-addon2" class="form-control" placeholder="佣金比例">
                        <span class="input-group-addon" id="basic-addon2">%</span>
                      </div>
                    </div>
                    <div class="col-sm-1 padding-right-zero">
                      <label class="control-label"><i class="required">*</i> 现金奖：</label>
                    </div>
                    <div class="col-sm-2 padding-right-zero">
                      <select class="form-control">
                        <option value="">按成交价比例</option>
                        <option value="110000">按成交价比例</option>
                      </select>
                    </div>
                    <div class="col-sm-2 padding-right-zero" style=" width: 85px;">
                      <label class="control-label"> 额外奖励：</label>
                    </div>
                    <div class="col-sm-3 padding-right-zero">
                     <input type="text" class="form-control" placeholder="请输入额外奖励内容">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label padding-right-zero"> 备注：</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="请输入当前佣金结算标准备注">
                  </div>
                </div>
              </div>
              <br/>
              <div class="background-white border fontColor">
                <div class="hoMain-title">
                  <a href="#" class="btn btn-blue pull-right">新增合作方</a>
                  <h3>联系人</h3>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label padding-right-zero"> 项目负责人：</label>
                  <div class="col-sm-10 padding-left-zero">
                    <div class="col-sm-3">
                      <input type="text" class="form-control" placeholder="请输入人员姓名">
                    </div>
                    <div class="col-sm-2 padding-right-zero" style=" width: 85px;">
                      <label class="control-label"> 联系电话：</label>
                    </div>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" placeholder="请输入人员联系方式">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label padding-right-zero"> 项目统筹人：</label>
                  <div class="col-sm-10 padding-left-zero">
                    <div class="col-sm-3">
                      <input type="text" class="form-control" placeholder="请输入人员姓名">
                    </div>
                    <div class="col-sm-2 padding-right-zero" style=" width: 85px;">
                      <label class="control-label"> 联系电话：</label>
                    </div>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" placeholder="请输入人员联系方式">
                    </div>
                    <div class="col-sm-2 padding-right-zero" style=" width: 85px;">
                      <label class="control-label"> 分配比例：</label>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group">
                        <input type="text" for="basic-addon3" class="form-control" placeholder="分配比例">
                        <span class="input-group-addon" id="basic-addon3">%</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label padding-right-zero"> 拓盘：</label>
                  <div class="col-sm-10 padding-left-zero">
                    <div class="col-sm-3">
                      <input type="text" class="form-control" placeholder="请输入人员姓名">
                    </div>
                    <div class="col-sm-2 padding-right-zero" style=" width: 85px;">
                      <label class="control-label"> 联系电话：</label>
                    </div>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" placeholder="请输入人员联系方式">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label padding-right-zero"> 驻场：</label>
                  <div class="col-sm-10 padding-left-zero">
                    <div class="col-sm-3">
                      <input type="text" class="form-control" placeholder="请输入人员姓名">
                    </div>
                    <div class="col-sm-2 padding-right-zero" style=" width: 85px;">
                      <label class="control-label"> 联系电话：</label>
                    </div>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" placeholder="请输入人员联系方式">
                    </div>
                    <div class="col-sm-4">
                      <label class="control-label"> （该联系方式为经纪人拨打的联系电话）</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group text-center">
                <br/>
                <button type="submit" class="btn btn-blue">保存</button>
              </div>
            </form>
          </div>
        </div>
    </body>
</html>