<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
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
<!--时间插件-->
<script type="text/javascript" src="/Public/Admin/js/laydate/laydate.js"></script>	
<!--主体开始-->
		<div class="ho-main">
			
			<!--检索开始-->
			<div class="ho-search">
				<form action="/Admin/Log/index" method="GET" name="searchForm">
					<div class="ho-search-li">
						<label>日志类型：</label>
						<select name="type">
					        <option value="0">全部类型</option>
					        <option value="2">楼盘字典</option>
					        <option value="3">房源管理</option>
					    </select>
					</div>
					<div class="ho-search-li">
						<label>操作时间：</label>
						<input name="sta_time" value="<?php echo I('get.sta_time');?>" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="ho-put" placeholder="开始时间"> - 
						<input name="end_time" value="<?php echo I('get.end_time');?>"onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="ho-put" placeholder="结束时间">
					</div>
					<div class="ho-search-btn">
						<input type="submit" class="ho-btn" value="搜索">
						<input type="reset" class="ho-btn btn1" value="重置">
					</div>
					<div class="clear"></div>
				</form>
			</div>
			<!--检索结束-->
			
			<!--列表开始-->
		<div class="ho-list">
			<table class="table table-striped table-hover">
				    <thead>
				        <tr>
				            <th data-column="note">操作内容</th>
				            <th data-func="get_type">操作类型</th>
				            <th data-column="create_time">操作时间</th>
				            <th data-column="admin_name">操作人</th>
				        </tr>
				    </thead>
				    <tbody>
				    </tbody>
				</table>
        <!--分页开始-->
        <div class="row ho-row">
            <?php echo ($page); ?>
        </div>
        <!--分页结束-->
			</div>
			<!--列表结束-->
			
		</div>
		<!--主体结束-->
<script type="text/javascript">
/* 查询条件记忆 */
if("<?php echo ($_GET['type']); ?>") {
    $('select[name="type"]').val("<?php echo ($_GET['type']); ?>");
}
function get_type(response) {
    if(response.type == 1) {
        return '楼盘框架';
    }else if(response.type == 2){
        return '楼盘字典';
    }else if(response.type ==3){
        return '房源管理';
    }
}
</script>

	</body>
</html>