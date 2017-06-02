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

<div class="ho-header">
      楼盘字典
      <a href="<?php echo U('add');?>" class="btn" style="font-size: 14px;padding: 4px 20px;">增加楼盘</a>
</div>
<!--检索开始-->
<div class="ho-search">
	<form>
		<div class="ho-search-li">
		    <label>省份：</label>
			<select id="province" name="province_code" class="form-control put-sm" >
			<option value="">请选择省份</option>
	        <!-- <?php $_result=getProvince();if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
	        <option value="<?php echo ($vo["adcode"]); ?>"><?php echo ($vo["name"]); ?></option>
	        <!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
			</select>
		</div>
		<div class="ho-search-li">
		    <label>城市：</label>
						<select id="city" name="city_code" class="form-control put-sm" ></select>
					</div>
					<div class="ho-search-li">
					    <label>区域：</label>
			<span id="seachdistrict_div" class="select_m"><select id="country" class="form-control put-sm" name="country_code"></select></span>
		</div>
		<div class="ho-search-li">
			<label>楼盘名称：</label>
			<input type="text" name="keyword"  value="<?php echo ($_GET['keyword']); ?>" class="ho-put" placeholder="请输入">
			<input type="hidden" id="s_adcode" name="adcode"   value="<?php echo ($_GET['adcode']); ?>"/>
		</div>
		<div class="ho-search-btn">
			<input type="submit" class="ho-btn" value="搜索">
			<a class="btn ho-btn btn1" href="<?php echo U('index');?>">重置</a>
		</div>
		<div class="clear"></div>
	</form>
</div>
<!--检索结束-->
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
$(selector_province).change(function() {
    $('#s_adcode').val($(this).val());
    fnGetCity(selector_province, selected_city, selector_city, function() { $(selector_country).html('<option value="">请选择区域</option>');});
});
$(selector_city).change(function() {
    $('#s_adcode').val($(this).val());
    fnGetCountry(selector_city, selected_country, selector_country);
});
$(selector_country).change(function() {
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

    <!--列表开始-->
		<div class="ho-list">
		<table class="table table-striped table-hover">
            <thead>
              <tr>
                   <th class="text-center" data-func="getname" style="width: 200px;">楼盘名称</th>
                   <th class="text-center" data-column="city">城市</th>
                   <th class="text-center" data-column="district">区域</th>
                   <th class="text-center" data-column="detail_address" style="width: 240px;">详细地址</th>
                   <th class="text-center" data-column="build_num">栋座</th>
                   <th class="text-center" data-column="build_year">竣工年代</th>
                   <th class="text-center" data-column="create_time">录入时间</th>
                   <th class="text-center" data-column="input_user">录入人</th>
                   <th class="text-center"  data-func="acturl">操作</th>                                   
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

                      <script type="text/javascript">
                      function getname(response) {
   						 return '<a href="/Admin/Dictionary/data/id/' + response.id + '" >' + response.name + '</a> ';
                 	  }
                      function acturl(response) {
      					 return '<a href="/Admin/Dictionary/edit/id/' + response.id + '" class="btn btn-primary btn-sm">编辑</a><a  onclick="deletedata(' + response.id + ')" href="javascript:;" class="btn btn-danger btn-sm ho-delete">删除</a>';

      					 
                      }
                  	  function deletedata(id)
                      {
                          layer.confirm('确定要删除这个楼盘吗？删除后无法恢复。', {
                              btn: ['确定','取消'] //按钮
                          }, function(){
                           //确定执行
                          	$.ajax({
                          		type : 'post',
                          		url : "<?php echo U('Dictionary/delete');?>",
                          		data : {id:id},
                          		datatype :'json',
                          		success : function(data)
                          		{
                          			if(data.status == 1)
                          				{
                          				layer.msg(data.info, {icon: 6});
                      					location.href = data.url
                          				}
                          			else if(data.status == 0)
                          				{
                          				layer.msg(data.info, {icon: 5});
                          				}
                          		}
                          	})

                          }, function(){
                           //取消执行
                          });
                      }
                      </script> 
</body>
</html>