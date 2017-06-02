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
                        <a href="javascript:;">房源管理</a>
                    </li>
                    <li>
                        <span>房源管理</span>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="box col-sm-12 relative">
                    <div class="box-inner">
                        <div class="box-content">
                            <!--新增的下拉框-->
                            
                            
                               <form class="form-group form-search" method="get">
                                <div class="row">
	                        		<div class="col-sm-12">
	                                    <div class="padding-left-zore col-sm-1">
    <select name="province_code" data-placeholder="省/市/自治区" id="province" class="col-sm-12 padding-left-zore padding-right-zore" data-rel="chosen">
        <option value="">请选择省份</option>
        <!-- <?php $_result=getProvince();if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
        <option value="<?php echo ($vo["adcode"]); ?>"><?php echo ($vo["name"]); ?></option>
        <!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
    </select>
</div>
<!-- <?php if(3 >= 2): ?>-->
<div class="padding-left-zore col-sm-1">
<select name="city_code" data-placeholder="市/其他" id="city" class="col-sm-12 select-height-default" data-rel="chosen"></select>
</div>
<!--<?php endif; ?> -->
<!-- <?php if(3 == 3): ?>-->
<div class="padding-left-zore padding-right-zore col-sm-1">
<select name="country_code" data-placeholder="区/县" id="country" class="col-sm-12 select-height-default padding-left-zore padding-right-zore" data-rel="chosen"></select>
</div>
<!--<?php endif; ?> -->
<input type="hidden" id="s_adcode" name="adcode" value=""/>

<script type="text/javascript">
var cityUrl = "<?php echo U('getCitys');?>";
var countryUrl = "<?php echo U('getCountrys');?>";
var selector_province = '#province';
var selector_city = '#city';
var selector_country = '#country';
// 记忆所选市省区，用于列表查询
var selected_province = "<?php echo ($_GET['province_code']); ?>";
var selected_city = "<?php echo ($_GET['city_code']); ?>";
var selected_country = "<?php echo ($_GET['country_code']); ?>";
if(selected_province) {
    $(selector_province).val(selected_province);
    fnGetCity(selector_province, selected_city, selector_city, function() {
        if(selected_city) {
            $(selector_city).val(selected_city);
        }
        fnGetCountry(selector_city, selected_country, selector_country, function() {
            if(selected_country) {
                $(selector_country).val(selected_country);
            }
        });
    });
}
// select chosen插件值改变事件
$(selector_province).chosen().change(function() {
    $('#s_adcode').val($(this).val());
    fnGetCity(selector_province, selected_city, selector_city, function() { $(selector_country).html('<option value="">请选择区域</option>');});
});
$(selector_city).chosen().change(function() {
    $('#s_adcode').val($(this).val());
    fnGetCountry(selector_city, selected_country, selector_country);
});
$(selector_country).chosen().change(function() {
    $('#s_adcode').val($(this).val());
});
// 用于编辑页面参数传递
var s_adcode = $('#s_adcode').val();
if(s_adcode != '') {
    var province_adcode = s_adcode.substring(0,2)+'0000';
    var zarr = ['11', '12', '31', '50', '81', '82'];
    var city_adcode = '';
    //直辖市开头
    if(zarr.indexOf(s_adcode.substring(0,2)) != -1) {
        city_adcode = province_adcode;
    } else {
        city_adcode = s_adcode.substring(0,4)+'00';
    }
    $(selector_province + ' option[value="' + province_adcode + '"]').attr("selected","selected");// 选中 省份
    $(selector_province).trigger("chosen:updated");
    fnGetCity(selector_province, city_adcode, selector_city);
}
</script>
	                                    
	                                    <div class="col-sm-1">
				                            <select  name="room_count" id="huxing"  class="form-control" data-placeholder="户型" id="selectError3" data-rel="chosen">
				                                <option value=""></option>
				                                <optgroup label="户型">
				                       		    <option value="1">一室</option>
									            <option value="2">二室</option>
									            <option value="3">三室</option>
									            <option value="4">四室</option>
									            <option value="5">五室及以上</option>
				                                </optgroup>
				                            </select>
	                                    </div>
	                                   <div class="padding-left-zore padding-right-zore col-sm-1">
				                            <select name="build_type" id="build_type" class="form-control"  data-placeholder="建筑类型" id="selectError4" data-rel="chosen">
				                                <option value=""></option>
				                                <optgroup label="建筑类型">
				                               	    <option>塔楼</option>
										            <option>板楼</option>
										            <option>板塔结合</option>
				                                </optgroup>
				                            </select>
			                            </div>
			                            <div class="form-inline">
			                            		<label class="control-label" for="inputSuccess4">总价:</label>
			                               <div class="input-group col-sm-2">
			                                   <input type="text" class="form-control" data-toggle="tooltip" data-placement="top" name="min_price" placeholder="最小总价" value="<?php echo ($_GET['min_price']); ?>">
			                                   <div class="input-group-addon">万</div>
			                               </div>
			                               ~
			                               <div class="input-group col-sm-2">
			                                   <input type="text" class="form-control" data-toggle="tooltip" data-placement="top" name="max_price" placeholder="最大总价" value="<?php echo ($_GET['max_price']); ?>">
			                                   <div class="input-group-addon">万</div>
			                               </div>
			                           <div class="inline-block search_mes">
			                               <div class="form-group margin-bottom-zore">  
			                                    <div class="input-group-btn">
			                                     <input type="text" class="form-control" data-toggle="tooltip" data-placement="top" name="keyword" value="<?php echo ($_GET['keyword']); ?>" id="keyword" placeholder="录入小区名称">
			                                     <button type="submit" class="btn btn-primary">搜索</button>
			                                    </div>
			                               </div>
			                           </div>
		                               </div>
	                            </div>
							</div>
                            </form>
                            
                           <div class="relative page-houses">
                                <table class="table table-striped table-bordered   responsive ">
                                    <thead>
                                        <tr>
                                            <th class="text-center" data-column="hid">房源ID</th>
                                            <th class="text-center" data-func="getimg">头图</th>
                                            <th class="text-center" data-column="name">小区名称</th>
                                            <th class="text-center" data-column="village_name">录入小区名称</th>
                                            <th class="text-center" data-column="build_type">建筑类型</th>
                                            <th class="text-center" data-func="getroom">户型</th>
                                            <th class="text-center" data-column="build_area">面积</th>
                                            <th class="text-center" data-column="sell_price">价格</th>
                                            <th class="text-center" data-column="title">标题</th>
                                            <th class="text-center" data-func="getstatus">状态</th>
                                            <th class="text-center" data-func="acturl">操作</th>                                               
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
            				<div class="row" ><?php echo ($page); ?></div>                           
                        </div>
                    </div>
                </div>
                <!--/span-->

            </div>
        </div>
    </div>
    <script type="text/javascript">
var _func_handle = function(i, hid) {
    _url = "<?php echo U('Admin/Community/state');?>";
    if(i == 'up') {
    _data = {hid: hid, args: 1};
    } else if(i == 'down') {
    _data = {hid: hid, args: 0};
    }
    $.getJSON(_url, _data, function(response) {
        layer.msg(response.info);
        if(response.status == 1) {
          location.reload();
        }
    });
}


var DEFAULT_IMAGES = "<?php echo C('DEFAULT_IMAGES');?>";
function getimg(response) {	                    	
		if(response.cover_path){
			return '<img style="width:150px" src="' + UPLOAD_DIR + response.cover_path + '" alt="' + response.title + '">';
		}else{
			return '<img style="width:150px" src="' + DEFAULT_IMAGES + '" alt="' + response.title + '">';
		}
	}
function getroom(response) {
    if(response.room_count == 1) {
      return '一室';
    } else if(response.room_count == 2) {
      return '二室';
    } else if(response.room_count == 3) {
      return '三室';
    } else if(response.room_count == 4) {
      return '四室';
    } else if(response.room_count == 5) {
      return '五室';
    } else if(response.room_count == 6) {
      return '六室';
    } else if(response.room_count == 7) {
      return '七室';
    } else if(response.room_count == 8) {
      return '八室';
    } else if(response.room_count == 9) {
      return '九室';
    } else if(response.room_count == 10) {
      return '十室';
    } else {
      return '';
    }
  }
function getstatus(response) {
    if(response.status == 1) {
        return '上架';
    } else{
        return '下架';
    }
}
function acturl(response) {
    if(response.status == 1) {
        var func_str_down = "javascript:_func_handle('down', " + response.hid + ")";
        op_str = '<a href="' + func_str_down + '" class="btn btn-default btn-sm">下架</a>';
    } else {
        var func_str_up = "javascript:_func_handle('up', " + response.hid + ")";
        op_str = '<a href="' + func_str_up + '" class="btn btn-default btn-sm"->上架</a>';
    }
    return '<a href="/Admin/HouseManage/editHouse/hid/' + response.hid + '" class="btn btn-default btn-sm">修改</a> <a href="/Admin/HouseManage/showBookingList/hid/' + response.hid + '" class="btn btn-default btn-sm">报名查看</a> <a href="/Admin/HouseManage/showShareList/hid/' + response.hid + '" class="btn btn-default btn-sm">分享查看</a> ' + op_str;
}


$(function() {
    // 记忆所选户型
    if("<?php echo ($_GET['room_count']); ?>") {
        $('#huxing').val("<?php echo ($_GET['room_count']); ?>");
    }
    // 记忆所选建筑类型
    if("<?php echo ($_GET['build_type']); ?>") {
        $('#build_type').val("<?php echo ($_GET['build_type']); ?>");
    }
})
</script>
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