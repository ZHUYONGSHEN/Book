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

    <!--检索开始-->
    <div class="ho-search">
        <form method="get">
            <div class="ho-search-li">
                <label>楼盘名称：</label>
                <input type="text" class="ho-put" placeholder="请输入" name="house_name" value="<?php echo ($_GET['house_name']); ?>">
            </div>
            <div class="ho-search-li">
                <label>房源标题：</label>
                <input type="text" class="ho-put" placeholder="请输入" name="house_title" value="<?php echo ($_GET['house_title']); ?>">
            </div>
            <div class="ho-search-li">
                <label>房源来源：</label>
                <select name="house_from">
                    <option <?php echo ($_GET['house_from'] == '-1' ? 'selected' : ''); ?> value="-1">全部</option>
                    <option <?php echo ($_GET['house_from'] == '小Q全景' ? 'selected' : ''); ?> value="小Q全景">小Q全景</option>
                    <!--<option <?php echo ($_GET['house_from'] == '小Q生活' ? 'selected' : ''); ?> value="小Q生活">小Q生活</option>-->
                    <!--<option <?php echo ($_GET['house_from'] == '找房' ? 'selected' : ''); ?> value="找房">找房</option>-->
                </select>
            </div>
            <div class="ho-search-li">
                <label>审核状态：</label>
                <select>
                    <option <?php echo ($_GET['audit_status'] === '-1' ? 'selected' : ''); ?> value="">全部</option>
                    <option <?php echo ($_GET['audit_status'] === '0' ? 'selected' : ''); ?> value="0">未审核</option>
                    <option <?php echo ($_GET['audit_status'] === '1' ? 'selected' : ''); ?> value="1">通过</option>
                    <option <?php echo ($_GET['audit_status'] === '2' ? 'selected' : ''); ?> value="2">未通过</option>
                </select>
            </div>
            <div class="ho-search-btn">
                <input type="submit" class="ho-btn" value="搜索">
                <input class="ho-btn btn1" type='reset' value="重置">
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
                    <th class="text-center" data-column="house_title" style="width: 220px;">房源标题</th>
                    <th class="text-center" data-column="house_name">楼盘名称</th>
                    <th class="text-center" data-column="house_building">栋座单元</th>
                    <th class="text-center" data-column="room_no">房号</th>
                    <th class="text-center" data-column="floor">楼层</th>
                    <th class="text-center" data-column="household">户型</th>
                    <th class="text-center" data-column="area">面积</th>
                    <th class="text-center" data-column="orientation">朝向</th>
                    <th class="text-center" data-column="sell_price">售/租价(元)</th>
                    <th class="text-center" data-column="detail_address">LBS地址</th>
                    <!--<th class="text-center" data-func="getAuditStatus">审核状态</th>-->
                    <th class="text-center" data-column="add_time">创建时间</th>
                    <th class="text-center" data-column="user">创建人</th>
                    <th class="text-center" data-column="link">连接器</th>
                    <th class="text-center" data-column="acturl">操作</th>
                </tr>
            </thead>
            <tbody></tbody>
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
<script>
    function getAuditStatus(response) {
        console.log(response)
        switch (parseInt(response.audit_status)) {
            case 0:
                return '<span class="text-muted">待审核</span>';
            case 1:
                return '<span class="text-success">通过</span>';
            case 2:
                return '<span class="text-danger">未通过</span>';
        }
    }

    $(function () {
        $('.table').on('click', '.delete', function () {
            $.layerConfirm('确定要删除这项数据吗?删除后无法恢复。', $(this).attr('data-url'));
        });

        $('input[type="reset"]').click(function () {
            location.href = "<?php echo U('houseList');?>"
        });
        //删除
        // $(".ho-delete").click(function () {
        //     layer.confirm('确定要删除这条数据吗？删除后无法恢复', {
        //         btn: ['确定', '取消'] //按钮
        //     }, function () {
        //         //删除操作
        //     });
        // })

        //审核
        $(".ho-change").click(function () {
            layer.open({
                type: 2,
                title: '房源审核',
                shadeClose: true,
                shade: 0.8,
                area: ['400px', '310px'],
                content: 'house_list_chenge.html' //iframe的url
            });
        })
    })
</script>
</body>
</html>