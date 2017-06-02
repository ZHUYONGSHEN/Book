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
          <br />
          <div class="background-white border padding30">
            <div class="row">
              <div class="col-sm-4 EditBootstrap">
                <h2>东海花园福禄居 <i class="btn btn-green">代理中</i></h2>
                <p class="font-color-526a7a margin-top-20">对应楼盘：东海花园</p>
              </div>
              <div class="col-sm-8 text-right">
                <a href="#" class="btn btn-blue margin-top-20"><i class="searchNewIcon"></i>上架</a>
              </div>
            </div>
          </div>
          <br />
          <div class="background-white border">
            <div class="tableTitle border-bottom">
              <a href="#">项目信息</a>
              <a href="#">户型管理</a>
              <a href="#" class="active">操作记录</a>
            </div>
            <div class="hoMain-body">
              <br />
              <div class="ho-list table-border-block border">
                  <div class="table-responsive">
                      <table class="table table-hover">
                          <thead>
                              <tr>
                                <th>序号</th>
                                <th>操作内容</th>
                                <th>操作类型</th>
                                <th>操作时间</th>
                                <th>操作人</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                <td>深圳</td>
                                <td>罗湖</td>
                                <td>碧海湾</td>
                                <td>住宅</td>
                                <td>代理中</td>
                              </tr>
                              <tr>
                                <td>深圳</td>
                                <td>罗湖</td>
                                <td>碧海湾</td>
                                <td>住宅</td>
                                <td>代理中</td>
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
          </div>
    </body>
</html>