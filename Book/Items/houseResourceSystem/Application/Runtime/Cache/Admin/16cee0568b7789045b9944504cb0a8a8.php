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
                        <span><?php if((ACTION_NAME) == "add"): ?>新增<?php else: ?>编辑<?php endif; ?>小区</span>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="box col-md-12">
                    <div class="box-inner">
                        <div class="box-header well">
                            <h2>
                                <?php if((ACTION_NAME) == "add"): ?>新增<?php else: ?>编辑<?php endif; ?>小区
                            </h2>
                        </div>
                        <div class="box-content clearfix">
                            <form class="form-horizontal" id="formSubmit">
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-sm-2 control-label">小区名称：</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo ($name); ?>" placeholder="必填">
                                    </div>
                                    <label for="inputEmail2" class="col-sm-2 control-label">通用名称：</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="alias" name="alias" value="<?php echo ($alias); ?>" placeholder="选填">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">区域：</label>
      									 <div class="col-sm-4">
                                            <div class="padding-left-zore col-sm-4">
    <select name="province_code" data-placeholder="省/市/自治区" id="province" class="col-sm-12 padding-left-zore padding-right-zore" data-rel="chosen">
        <option value="">请选择省份</option>
        <!-- <?php $_result=getProvince();if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
        <option value="<?php echo ($vo["adcode"]); ?>"><?php echo ($vo["name"]); ?></option>
        <!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
    </select>
</div>
<!-- <?php if(3 >= 2): ?>-->
<div class="padding-left-zore col-sm-4">
<select name="city_code" data-placeholder="市/其他" id="city" class="col-sm-12 select-height-default" data-rel="chosen"></select>
</div>
<!--<?php endif; ?> -->
<!-- <?php if(3 == 3): ?>-->
<div class="padding-left-zore padding-right-zore col-sm-4">
<select name="country_code" data-placeholder="区/县" id="country" class="col-sm-12 select-height-default padding-left-zore padding-right-zore" data-rel="chosen"></select>
</div>
<!--<?php endif; ?> -->
<input type="hidden" id="s_adcode" name="adcode" value="<?php echo ($adcode); ?>"/>

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
                                            <input type="hidden" name="province" value="<?php echo ($province); ?>">
                                            <input type="hidden" name="city" value="<?php echo ($city); ?>">
                                            <input type="hidden" name="district" value="<?php echo ($district); ?>">
                                        </div>
                                    <label for="selectError4" class="col-sm-2 control-label">建筑类型：</label>
                                    <div class="col-sm-4">
                                         <select name="purpose" class="form-control">
				                            <option value="1">住宅</option>
				                            <option value="2">别墅</option>
				                            <option value="3">商住两用</option>
				                            <option value="4">其他</option>
				                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">建筑年代：</label>
                                    <div class="col-sm-4">
                             
                                        <div class="input-group">
				                            <input type="text" class="form-control" id="build_year" name="build_year" value="<?php echo ($build_year); ?>">
				                            <div class="input-group-addon">年</div>
				                        </div>
                                    </div>
                                    <label for="inputEmail4" class="col-sm-2 control-label">小区均价：</label>
                                    <div class="col-sm-4">
	                                    <div class="input-group">
				                            <input type="text" class="form-control" id="average_price" name="average_price" value="<?php echo ($average_price); ?>">
				                            <div class="input-group-addon">元/m²</div>
				                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">小区经纬：</label>
                                   <div class="col-sm-2">
                        			<input type="text" class="form-control" id="FLongitude" name="longitude" value="<?php echo ((isset($longitude) && ($longitude !== ""))?($longitude):'114.085947'); ?>" placeholder="必填：经度">
                   				   </div>
				                    <div class="col-sm-2">
				                        <input type="text" class="form-control" id="FLatitude" name="latitude" value="<?php echo ((isset($latitude) && ($latitude !== ""))?($latitude):'22.547'); ?>" placeholder="必填：纬度">
				                    </div>
                                    <label for="inputEmail6" class="col-sm-2 control-label">楼栋数：</label>
				                    <div class="col-sm-4">
				                        <input type="text" class="form-control" id="building_count" name="building_count" value="<?php echo ($building_count); ?>">
				                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">当前地址：</label>
                                     <div class="col-sm-6">
                        				<input type="text" class="form-control" name='cur_address' disabled id="getAddress">
                    				 </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail13" class="col-sm-2 control-label">详细地址：</label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                             <input type="text" class="form-control" id="soaddress" placeholder="必须填写楼盘街道地址" name="detail_address" value="<?php echo ($detail_address); ?>">
                                               <span class="input-group-addon btn btn-primary text-color-white border-none" onclick="codeAddress()">
                                                    搜索
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">地图选择：</label>
                                    <div class="col-sm-6">
                        				<div class="form-control inline-block" id="map_container" style="width:100%; height:310px;"></div>
                   					 </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail6" class="col-sm-2 control-label">绿化率：</label>
                                   <div class="col-sm-4">
				                        <div class="input-group">
				                            <input type="text" class="form-control" id="green_rate" name="green_rate" value="<?php echo ((isset($green_rate) && ($green_rate !== ""))?($green_rate):0); ?>">
				                            <span class="input-group-addon">%</span>
				                        </div>
				                   </div>
                                    <label for="inputEmail7" class="col-sm-2 control-label">容积率：</label>
                                    <div class="col-sm-4">
				                        <div class="input-group">
				                            <input type="text" class="form-control" id="plot_rate" name="plot_rate" value="<?php echo ((isset($plot_rate) && ($plot_rate !== ""))?($plot_rate):0); ?>">
				                            <span class="input-group-addon">%</span>
				                        </div>
			                   		</div>
                                </div>

                                <div class="form-group">
				                     <label for="inputEmail8" class="col-sm-2 control-label">开发商：</label>
				                    <div class="col-sm-4">
				                        <input type="text" class="form-control" id="developer" name="developer" value="<?php echo ($developer); ?>">
				                    </div>
				                    <label for="inputEmail9" class="col-sm-2 control-label">物业公司：</label>
				                    <div class="col-sm-4">
				                        <input type="text" class="form-control" id="management" name="management" value="<?php echo ($management); ?>">
				                    </div>
				                </div>
				                
				                <div class="form-group">
				                    <label for="inputEmail10" class="col-sm-2 control-label">地铁信息：</label>
				                    <div class="col-sm-4">
				                        <textarea name="by_subway" id="by_subway" class="form-control" rows="3"><?php echo ($by_subway); ?></textarea>
				                    </div>
				                    <label for="inputEmail11" class="col-sm-2 control-label">公交信息：</label>
				                    <div class="col-sm-4">
				                        <textarea name="by_bus" id="by_bus" class="form-control" rows="3"><?php echo ($by_bus); ?></textarea>
				                    </div>
				                </div>
                                
                                <div class="form-group">
				                    <label for="inputEmail12" class="col-sm-2 control-label">小区街景连接：</label>
				                    <div class="col-sm-6">
				                        <input type="text" class="form-control" id="street_url" name="street_url" value="<?php echo ($street_url); ?>">
				                    </div>
				                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-default" onclick="window.location='<?php echo U('index');?>'";>返回</button>
                                            <button type="submit" class="btn btn-primary">保存</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    
<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
<script type="text/javascript" src="/Public/Admin/js/loadmap.js"></script>
<script type="text/javascript">
    $('select[name="purpose"]').val(<?php echo ($purpose); ?>);
    $('select[name="province_code"]').change(function() {
        $('input[name="province"]').val($(this).find('option:selected').text());
    });
    $('select[name="city_code"]').change(function() {
        $('input[name="city"]').val($(this).find('option:selected').text());
    });
    $('select[name="country_code"]').change(function() {
        $('input[name="district"]').val($(this).find('option:selected').text());
    });
</script>
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