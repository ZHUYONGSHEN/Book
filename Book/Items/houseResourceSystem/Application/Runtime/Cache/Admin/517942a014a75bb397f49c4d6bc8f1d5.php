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

		
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
			$(document).ready(function(){
				$("#search-form").on('input',function(e){
					$(this).autocomplete({
					source: "<?php echo U('Dictionary/getSearchWords');?>",
					    select: function(event, ui){
				        $(this).val (ui.item.label);
				        $("#hid").val(ui.item.hid);
				        $("#detail_address").val(ui.item.address);
				        event.preventDefault();     
				   	 },
				   	 change:function(e,a){
			   	 		if(!a.item || a.item.label =="暂无楼盘信息！"){
				   	 		$(this).val ('');
				       	 	$("#hid").val('');
				        	$("#detail_address").val('');
			   	 		}
				   	 }
				});
				})
			});
</script>

		
		<!--主体开始-->
		<div class="ho-main">
			
			<div class="ho-biaoti">
				<div class="ho-bg ho-bg1" id="ho_bg">
					<ul>
						<li class="bg1 ho-active">基本信息</li>
						<li class="bg2">周边设施</li>
						<li class="bg3">保存成功</li>
					</ul>		
				</div>
			</div>
     <form id="formSubmit" method="post" name="addform"  action="">
			<div class="ho-add-main">
                <!--基本信息开始-->
				<div class="add-xinxi" id="add-xinxi01" style="dis play:none;">
					<table class="table">
						<tbody>
							<tr>
								<td class="bold">* 楼盘名称：</td>
								<td colspan="3" class="ho-bi">
								<input id="search-form" class="form-control" name="name" value="<?php echo ($name); ?>" type="text" placeholder="输入楼盘名称" maxlength="30">
								</td>
								<input id="hid" type="hidden" name="hid" value="<?php echo ($hid); ?>">
								<td class="bold">&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td class="bold">楼盘别名：</td>
								<td colspan="3" class="ho-bi"><input type="text" class="form-control" id="alias" name="alias" value="<?php echo ($alias); ?>" placeholder="输入楼盘别名" maxlength="30"></td>
								<td class="bold">&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td class="bold">* 楼盘区域：</td>
								<td colspan="3" class="ho-bi">
									<select id="province" name="province_code" class="form-control put-sm" >
									        <option value="">请选择省份</option>
									        <!-- <?php $_result=getProvince();if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
									        <option value="<?php echo ($vo["adcode"]); ?>"><?php echo ($vo["name"]); ?></option>
									        <!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
									</select>
   									<select id="city" name="city_code" class="form-control put-sm" >
   									
   									</select>
									<span id="seachdistrict_div" >
									<select id="country" name="country_code" class="form-control put-sm" >
									</select>
									</span>
							
									<input type="hidden" name="province" value="<?php echo ($province); ?>">
                                    <input type="hidden" name="city" value="<?php echo ($city); ?>">
                                    <input type="hidden" name="district" value="<?php echo ($district); ?>">
									<input type="hidden" id="s_adcode" name="adcode" value="<?php echo ($adcode); ?>"/>
								</td>
								<td class="bold">&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
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
// select 改变事件
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


$('select[name="province_code"]').change(function() {
    $('input[name="province"]').val($(this).find('option:selected').text());
});
$('select[name="city_code"]').change(function() {
    $('input[name="city"]').val($(this).find('option:selected').text());
});
$('select[name="country_code"]').change(function() {
    $('input[name="district"]').val($(this).find('option:selected').text());
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
							<tr>
								<td class="bold">* 小区地址：</td>
								<td colspan="3" class="ho-bi"><input type="text" class="form-control" id="detail_address" name="detail_address" value="<?php echo ($detail_address); ?>"  placeholder="输入小区地址" maxlength="50"></td>
								<td class="bold">&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td class="bold">房屋用途：</td>
								<td>
							        <select name="house_use" class="form-control" style="width: 150px;">
                                       	<option value="0">请选择</option>
			                            <option value="1">普通住宅</option>
			                            <option value="2">商住两用</option>
			                            <option value="3">商品房</option>
			                            <option value="4">别墅洋房</option>
			                            <option value="5">公寓</option>
			                            <option value="6">写字楼</option>
			                            <option value="7">商铺</option>
								</td>
								<td class="bold">建筑类型：</td>
								<td>
							        <select name="build_type" class="form-control" style="width: 150px;">
                                       	<option value="0">请选择</option>
			                            <option value="1">塔楼</option>
			                            <option value="2">板楼</option>
			                            <option value="3">塔板结合</option>
			                        </select>
								</td>
								<td class="bold">竣工年代：</td>
								<td><input type="text" class="form-control" style="width: 150px;" id="build_year" name="build_year" value="<?php echo ($build_year); ?>" placeholder="" maxlength="8" onkeyup='this.value=this.value.replace(/\D/gi,"")'></td>
							</tr>
							<tr>
								<td class="bold">物业费用：</td>
								<td>
								   <div class="input-group" style="width: 150px;">
									  <input type="text" class="form-control" id="management_price" name="management_price" value="<?php echo ($management_price); ?>" placeholder="" aria-describedby="basic-addon2" maxlength="8" onkeyup="value=value.replace(/[^\d.]/g,'')" >
									  <span class="input-group-addon" id="basic-addon2">元/m²/月</span>
									</div>
								</td>
								<td class="bold">成交均价：</td>
								<td>
								   <div class="input-group" style="width: 180px;">
									  <input type="text" class="form-control" id="average_price" name="average_price" value="<?php echo ($average_price); ?>"  placeholder="" aria-describedby="basic-addon2" maxlength="8" onkeyup="value=value.replace(/[^\d.]/g,'')">
									  <span class="input-group-addon" id="basic-addon2">元/m²</span>
									</div>
								</td>
								<td class="bold">容积率：</td>
								<td>
								   <div class="input-group" style="width: 150px;">
									  <input type="text" class="form-control" id="plot_rate" name="plot_rate" value="<?php echo ($plot_rate); ?>"  placeholder="" aria-describedby="basic-addon2" maxlength="8" onkeyup='this.value=this.value.replace(/\D/gi,"")'>
									  <span class="input-group-addon" id="basic-addon2">%</span>
									</div>
								</td>
							</tr>
							<tr>
								<td class="bold">绿化率：</td>
								<td>
								   <div class="input-group" style="width: 150px;">
									  <input type="text" class="form-control" id="green_rate" name="green_rate" value="<?php echo ($green_rate); ?>"  placeholder="" aria-describedby="basic-addon2" maxlength="8" onkeyup='this.value=this.value.replace(/\D/gi,"")'>
									  <span class="input-group-addon" id="basic-addon2">%</span>
									</div>
								</td>
								<td class="bold">总面积：</td>
								<td>
								   <div class="input-group" style="width: 150px;">
									  <input type="text" class="form-control" id="build_area" name="build_area" value="<?php echo ($build_area); ?>" placeholder="" aria-describedby="basic-addon2" maxlength="8" onkeyup="this.value=this.value.replace(/[^\d\.]+/g,'')" onblur="this.value=this.value.replace(/(\.\d{2})\d*$/,'\$1')">
									  <span class="input-group-addon" id="basic-addon2">m²</span>
									</div>
								</td>
								<td class="bold">总户数：</td>
								<td>
								   <input type="text" class="form-control" style="width: 150px;" id="household_num" name="household_num" value="<?php echo ($household_num); ?>" placeholder="" maxlength="8" onkeyup='this.value=this.value.replace(/\D/gi,"")'>
								</td>
							</tr>
							<tr>
								<td class="bold">车位总数：</td>
								<td>
								   <input type="text" class="form-control" style="width: 150px;" id="car_num" name="car_num" value="<?php echo ($car_num); ?>" placeholder="" maxlength="8" onkeyup='this.value=this.value.replace(/\D/gi,"")'>
								</td>
								<td class="bold">栋座总数：</td>
								<td>
								   <input type="text" class="form-control" style="width: 150px;" id="build_num" name="build_num" value="<?php echo ($build_num); ?>" placeholder="" maxlength="8" onkeyup='this.value=this.value.replace(/\D/gi,"")'>
								</td>
								<td class="bold">&nbsp;</td>
								<td>
								   &nbsp;
								</td>
							</tr>
							<tr>
								<td class="bold">开发商：</td>
								<td colspan="3"><input type="text" class="form-control" id="developer" name="developer" value="<?php echo ($developer); ?>" placeholder="" maxlength="50"></td>
								<td class="bold">&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td class="bold">物业公司：</td>
								<td colspan="3"><input type="text" class="form-control" id="management" name="management" value="<?php echo ($management); ?>" placeholder="" maxlength="50"></td>
								<td class="bold">&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td class="bold">小区简介：</td>
								<td colspan="3"><textarea name="build_content" class="form-control" rows="3" maxlength="500"><?php echo ($build_content); ?></textarea></td>
								<td class="tips"><div class="content"><span>0/500</span><i class="TipsG TipsR"></i></div></td>
							</tr>
							<tr>
								<td colspan="6" align="center"><a href="javascript:void(0)" id="btn1" class="btn btn-primary btn-sm">下一步</a></td>
							</tr>
						</tbody>
					</table>
				</div>
				
				<!--基本信息结束-->
				<!--设施开始-->
				<div class="add-xinxi" id="add-xinxi02" style="display:none;">
					<table class="table">
						<tbody>							
							<tr>
								<td class="bold">周边公交：</td>
								<td colspan="4"><textarea name="traffic" class="form-control" rows="5" maxlength="500"><?php echo ($traffic); ?></textarea></td>
								<td class="tips"><div class="content"><span>0/500</span><i class="TipsG TipsR"></i></div></td>
							</tr>
							<tr>
								<td class="bold">周边医院：</td>
								<td colspan="4"><textarea name="hospital" class="form-control" rows="5" maxlength="500"><?php echo ($hospital); ?></textarea></td>
								<td class="tips"><div class="content"><span>0/500</span><i class="TipsG TipsR"></i></div></td>
							</tr>
							<tr>
								<td class="bold">周边商业：</td>
								<td colspan="4"><textarea name="business" class="form-control" rows="5" maxlength="500"><?php echo ($business); ?></textarea></td>
								<td class="tips"><div class="content"><span>0/500</span><i class="TipsG TipsR"></i></div></td>
							</tr>
							<tr>
								<td colspan="6" align="center">
									<a href="javascript:void(0)" id="btn2" class="btn btn-default btn-sm">上一步</a>
									<button type="submit" class="btn btn-primary btn-sm">保存</button>
									
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!--设施结束-->
			</div>
			</form>
			
			
		</div>
		<!--主体结束-->
		
		
		<script>
			$(function(){
				$('textarea[name="build_content"],textarea[name="traffic"],textarea[name="hospital"],textarea[name="business"]')
					.focus(function() {
						$('.tips .content').hide();
						let len = $(this).val().length;
						let text = len + '/500';
						$(this).parent().siblings('.tips').find('.content').find('span').text(text).end().show();
					})
					.blur(function(){
						$('.content').hide();
					})
					.keydown(function(e) {
						let len = $(this).val().length;
						if (len == 500 && 
							((e.keyCode >= 48 && e.keyCode <= 111) || (e.keyCode >= 186 && e.keyCode <= 222)) && 
							e.originalEvent.ctrlKey === false) {
							e.preventDefault();
							return;
						}
					})
					.keyup(function() {
						let len = $(this).val().length;
						if (len > 500) {
							$(this).val($(this).val().slice(0,500));
							len = 500
						}
						let text = len + '/500';
						$(this).parent().siblings('.tips').find('.content span').text(text);
					});
					
				$('#btn1').click(function(){
					  var a =$("#search-form").val();
					  var b =$("#detail_address").val();
					  var c =$("#province").val();
					  var d =$("#city").val();
					  var e =$("#country").val();
					if(!a){
						layer.msg('楼盘名称必填', {icon: 5});
						return false
						}
					if(!c){
						layer.msg('省份必填', {icon: 5});
						return false
						}
					if(!d){
						layer.msg('城市必填', {icon: 5});
						return false
						}
					if(!e){
						layer.msg('区域必填', {icon: 5});
						return false
						}
					if(!b){
						layer.msg('小区地址必填', {icon: 5});
						return false
						}

                   $('#add-xinxi01').hide(); 
                   $('#add-xinxi02').show();
                   $('#ho_bg').removeClass('ho-bg1');
                   $('#ho_bg').addClass('ho-bg2');
                   $('#ho_bg .bg2').addClass('ho-active');
                })
                $('#btn2').click(function(){
                   $('#add-xinxi01').show(); 
                   $('#add-xinxi02').hide();
                   $('#ho_bg').removeClass('ho-bg2');
                   $('#ho_bg').addClass('ho-bg1');
                   $('#ho_bg .bg2').removeClass('ho-active');
                })
				
				
			})
		</script>
<script type="text/javascript">
    $('select[name="house_use"]').val(<?php echo ($house_use); ?>);
    $('select[name="build_type"]').val(<?php echo ($build_type); ?>);
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
		

<script>
$(function(){
	$('form[name=addform]').submit(function(){
		$.ajax({
			type :"POST",
			url : "/Admin/Dictionary/add",
			data : $(this).serializeArray(),
			dataType : "json",
			success : function(data){
				if(data.status == 1){
					//layer.msg(data.info, {icon: 6});
					location.href = data.url
				}else if(data.status == 0){
					layer.msg(data.info, {icon: 5});
				}
			}
			});
		return false;

	})
})
</script>
		
	</body>
</html>