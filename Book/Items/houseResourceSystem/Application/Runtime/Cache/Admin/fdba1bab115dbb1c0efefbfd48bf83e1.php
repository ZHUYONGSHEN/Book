<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>腾讯街景找房</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="腾讯街景找房">
    <meta name="author" content="Muhammad Usman">
    <!-- The styles -->
    <link id="bs-css" href="/Public/Admin/css/bootstrap-cerulean.min.css" rel="stylesheet">
    <link href="/Public/Admin/css/charisma-app.css" rel="stylesheet">
    <link href='/Public/Admin/bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='/Public/Admin/bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='/Public/Admin/css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='/Public/Admin/css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="/Public/Admin/bower_components/jquery/jquery.min.js"></script>
    <script src="/Public/Admin/bower_components/chosen/chosen.jquery.min.js"></script>
    <script src="/Public/Admin/js/jquery.twbsPagination.js" type="text/javascript"></script>
    <script src="/Public/Admin/js/layer.js"></script>
    <script src="/Public/Admin/js/jquery_validate_min.js"></script>
    <script type="text/javascript">var JS_DIR = "/Public/Admin/js"; var UPLOAD_DIR = "/<?php echo C('UPLOAD_FLOAD');?>";</script>
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
<div class="navbar navbar-default" role="navigation">

    <div class="navbar-inner">
        <button type="button" class="navbar-toggle pull-left animated flip">
<!--             <span class="sr-only">导航</span> -->
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">
            <img alt="" src="/Public/Admin/img/logo20.png" class="hidden-xs"/>
        </a>

        <!-- user dropdown starts -->
        <div class="btn-group pull-right">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-sm hidden-xs"> 您好，<?php echo ($username); ?> </span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="/Admin/Public/logout/account/<?php echo ($username); ?>">注销</a></li>
            </ul>
        </div>
        <!-- user dropdown ends -->
    </div>
</div>
<!-- topbar ends -->
<div class="ch-container">
    <div class="row">

        <!-- left menu starts -->
		<!-- left menu starts -->
<div class="col-sm-2 col-lg-2">
    <div class="sidebar-nav">
        <div class="nav-canvas">
            <div class="nav-sm nav nav-stacked">

            </div>
            <ul class="nav nav-pills nav-stacked main-menu">
                <!-- <li class="nav-header">导航</li> -->
                <li  <?php if($act == Aa1): ?>class='active'<?php endif; ?>>
                    <a class="ajax-link" href="<?php echo U('Index/index');?>">
                        <i class="glyphicon glyphicon-home"></i>
                        <span> 首页</span>
                    </a>
                </li>

                <li class="accordion" style="display:none">
                    <a class="ajax-link" href="#">
                        <i class="glyphicon glyphicon-cog"></i>
                        <span> 相关设置</span>
                        <i class="glyphicon glyphicon-chevron-down pull-right "></i>
                    </a>
                    <ul class="nav nav-pills nav-stacked">
         				<li class="accordion">
                            <a href="#">
                                <span>账号管理</span>
                            </a>
                            <ul class="nav nav-pills nav-stacked">
                                <li <?php if($act == 'Db1'): ?>class='active'<?php endif; ?>><a href="<?php echo U('Developer/index');?>">开发商管理</a></li>
                                <li <?php if($act == 'Db2'): ?>class='active'<?php endif; ?>><a href="<?php echo U('Developer/rekeys');?>">修改密码</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="accordion">
                    <a class="ajax-link" href="#">
                        <i class="glyphicon glyphicon-tree-conifer"></i>
                        <span>房源管理后台</span>
                        <i class="glyphicon glyphicon-chevron-down pull-right "></i>
                    </a>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="accordion">
                            <a href="#">
                                <span>房源管理</span>
                                <i class="glyphicon glyphicon-chevron-down pull-right "></i>
                            </a>
                            <ul class="nav nav-pills nav-stacked">
                                <li <?php if($act == 'Ec1'): ?>class='active'<?php endif; ?>>
                                    <a href="<?php echo U('HouseManage/secondHouseList');?>">
                                        <span>房源管理</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="accordion">
                            <a href="#">
                                <span>楼盘字典</span>
                                <i class="glyphicon glyphicon-chevron-down pull-right "></i>
                            </a>
                            <ul class="nav nav-pills nav-stacked">
                                <li <?php if($act == 'Ed1'): ?>class='active'<?php endif; ?>>
                                    <a href="<?php echo U('Community/index');?>">
                                        <span>小区管理</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
        
        
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="<?php echo U('Index/index');?>">首页</a>
                    </li>
                    <li>
                        <a href="javascript:;">找房经纪人</a>
                    </li>
                    <li>
                        <a href="javascript:;">小区管理</a>
                    </li>
                    <li>
                        <span>小区列表</span>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="box col-sm-12 relative">
                    <div class="box-inner">
                        <div class="box-content">
                            <!--新增的下拉框-->
                            <form class="form-group" method="get" action>
                            	<div class="row">
                            		<div class="col-sm-12">
		                            	<div class="padding-left-zore col-sm-1">
			                                <select style="width:100%" name="purpose" class="form-control"  data-placeholder="用途类型" id="selectError1" data-rel="chosen" >
			                                <option value="">用途类型</option>
			                                <option value="1">住宅</option>
			                                <option value="2">别墅</option>
			                                <option value="3">商住两用</option>
			                                <option value="4">其他</option>
			                                </select>
		                                </div>    
		                                
					                    <div class="form-inline">                                                     
			                                <div class="input-group col-sm-2">
				                                <input type="text" class="form-control" name="min_price" placeholder="小区均价最低价" value="<?php echo ($_GET['min_price']); ?>">
				                                <div class="input-group-addon">元</div>
			                               </div>
			                               ~                              
			                              	<div class="input-group col-sm-2">
												<input type="text" class="form-control" name="max_price" placeholder="小区均价最高价" value="<?php echo ($_GET['max_price']); ?>">
			                               		<div class="input-group-addon">元</div>     
			                              	 </div>
			                                
			                                <div class="inline-block search_mes">
				                                <div class="form-group margin-bottom-zore">  
				                                    <div class="input-group">
				                                       <input class="form-control" type="text" placeholder="小区名称关键字" maxlength="40" id="keyword" name="keyword" value="<?php echo ($_GET['keyword']); ?>">
				                                        <span class="input-group-btn"><button type="submit" class="btn btn-primary">搜索</button></span>
				                                    </div>
				                                </div>
			                           		</div>
			                                <a class="btn btn-primary pull-right" href="<?php echo U('add');?>" >
			                                    添加小区
			                                </a>
			                                
		                           		</div>
									</div>
                        		</div>
                            </form>
                            <div class="relative page-houses">
                                <table class="table table-striped table-bordered   responsive ">
                                    <thead>
                                        <tr>
                                            <th class="text-center" data-column="id">ID</th>
                                            <th class="text-center" data-column="name">小区名称</th>
                                            <th class="text-center" data-column="average_price">小区均价(元/m²)</th>
                                            <th class="text-center" data-column="purpose">用途类型</th>
                                            <th class="text-center" data-column="pcd">区域</th>
                                            <th class="text-center"  data-column="acturl">操作</th>                                   
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
            				<div class="row" ><?php echo ($page); ?></div>
                            
                      <script type="text/javascript">

                            /* 查询条件记忆 */
                            if("<?php echo ($_GET['purpose']); ?>") {
                                $('select[name="purpose"]').val("<?php echo ($_GET['purpose']); ?>");
                            }
                      </script>  
                        </div>
                    </div>
                </div>
                <!--/span-->

            </div>
        </div>
    </div>
    <hr>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>设置</h3>
                </div>
                <div class="modal-body">
                    <p>请输入内容</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">关闭</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">保存</a>
                </div>
            </div>
        </div>
    </div>

<!--     <footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">
            <a href="#" target="_blank">底部</a>
        </p>

        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">
            <a href="#">底部</a>
        </p>
    </footer> -->
	</div>
<!-- 日期选择器依赖此css -->
<link rel="stylesheet" href="/Public/Admin/css/jquery-ui-1.8.21.custom.css" />
<script src="/Public/Admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/Public/Admin/js/jquery.cookie.js"></script>
<script src="/Public/Admin/bower_components/responsive-tables/responsive-tables.js"></script>
<script src="/Public/Admin/js/jquery.iphone.toggle.js"></script>
<script src="/Public/Admin/js/My97DatePicker/WdatePicker.js"></script>
<script src="/Public/Admin/js/charisma.js"></script>
<script src="/Public/Admin/js/jquery.autogrow-textarea.js"></script>
<script>
    $(function(){
        if($('#formSubmit').length == 1) {
            $.jqSubmit('#formSubmit');// 默认表单Ajax提交
        }
        $.ajaxLoad('.ajax-load');// 按钮ajax弹窗事件
        function warn(_warn){
            if(typeof _warn.val() != 'undefined') {
                var _length = _warn.val().length;
                if (_length > 0)
                    _warn.siblings('span.warn-message').children('b').html(_length);
                $('input,textarea').on('input propertychange valuechange', function() {
                    var _length = _warn.val().length;
                    $(this).siblings('span.warn-message').children('b').html(_length);
                });
            }
        }
        $('[data-warn="warn"]').each(function() {
            warn($(this));
            $(this).on('keyup', function(event) {
                warn($(this));
            });
        })
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-rel="chosen"],[rel="chosen"]').chosen();
        $('.iphone-toggle').iphoneStyle();

        //表单input,textarea统计剩余字数
        $('.input-count').each(function() {
            statInputNum($(this).find('input,textarea'), $(this).find('span'));
        });
        // formobj代表input或textarea的对象
        function statInputNum(formobj, numobj) {
            var max = numobj.text(),
                curLength;
            formobj[0].setAttribute("maxlength", max);
            curLength = formobj.val().length;
            numobj.text(max - curLength);
            formobj.on('input propertychange', function() {
                numobj.text(max - $(this).val().length);
            });
        }
    });
</script>
</body>
</html>