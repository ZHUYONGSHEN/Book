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
                        <li><a href="<?php echo U('NewHouse/index');?>" <?php if(in_array((CONTROLLER_NAME), explode(',',"NewHouse,HouseType,City"))): ?>class="active"<?php endif; ?>>新房管理</a></li>
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
                    <input type="hidden" id="s_adcode" name="adcode"   value="<?php echo ($_GET['adcode']); ?>"/>
                    <div class="form-group">
                        <select name="province_code" id="province" style="width: 90px" class="form-control">
                            <option value="">省份</option>
                            <?php if(is_array($province)): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["adcode"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                       </select>
                    </div>
                    <div class="form-group">
                        <select name="city_code" id="city" style="width: 90px" class="form-control">
                            <option value="">城市</option>
                       </select>
                    </div>
                    <div class="form-group">
                        <select name="country_code" id="country" style="width: 90px" class="form-control">
                            <option value="">区域</option>
                       </select>
                    </div>
                   <div class="form-group">
                        <select name="proxy_status" class="form-control" style="width: 105px">
                            <option value="">代理状态</option>
                            <option value="0">已完结</option>
                            <option value="1">代理中</option>
                            <option value="2">代理中止</option>
                       </select>
                    </div>
                     <div class="form-group">
                        <select name="property_type" class="form-control" style="width: 105px">
                            <option value="">物业类型</option>
                            <?php if(is_array($property)): $i = 0; $__LIST__ = $property;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                       </select>
                    </div>
                    <div class="form-group">
                        <select name="price_type" class="form-control">
                            <option value="1">均价</option>
                            <option value="2">总价</option>
                       </select>
                    </div>
                   <div class="form-group">
                        <input type="text" style="width: 80px" maxlength="6" name="min_price" class="form-control" placeholder="最低价">
                    </div>
                    <div class="form-group">
                       <label for="">-</label>
                    </div>
                    <div class="form-group">
                        <input type="text" style="width: 80px" maxlength="6" name="max_price" class="form-control" placeholder="最高价">
                    </div>
                    <div class="form-group">
                        <select name="source" class="form-control">
                            <option value="">来源</option>
                            <option value="1">合作</option>
                            <option value="0">采集</option>
                       </select>
                    </div>
                    <div class="form-group">
                        <input type="text" style="width: 169px" name="keyword" class="form-control" placeholder="项目名称">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-blue"><i class="searchNewIcon"></i> 搜索</button>
                        <button type="reset" class="btn btn-blue"><i class="resetIcon"></i> 重置</button>
                    </div>
                </form>
            </div>
            <div class="clearfix text-right">
              <a href="<?php echo U('City/index');?>" class="btn btn-blue">区域配置</a>
              <a href="<?php echo U('addNewItem');?>" class="btn btn-blue">新增项目</a>
            </div>
            <br />
            <div class="ho-list table-border-block border">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                              <th data-column="province">省份</th>
                              <th data-column="city">城市</th>
                              <th data-column="district">城区</th>
                              <th data-column="name">项目名称</th>
                              <th data-column="property_type" width="120px">物业类型</th>
                              <th data-column="proxy_status">代理状态</th>
                              <th data-column="sale_total">余量</th>
                              <th data-column="pay">首付</th>
                              <th data-column="com">佣金</th>
                              <th data-column="average_min">均价(元/m²)</th>
                              <th data-column="sum">总价（万）</th>
                              <th data-column="source">来源</th>
                              <th data-column="status">上下架状态</th>
                              <th data-func="acturl" width="180px">操作</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="ho-row"><?php echo ($page); ?></div>
            </div>
        </div>
        <div  class="close_del_up_mian" style="display:none;">
            <div>
                <p class="alert_title border-bottom">提示信息</p>
                <div class="text-center padding30">
                    是否确定删除该房源数据?
                </div>
            </div>
        </div>
        <div class="promptBox" style="display:none;"><p class="background-white"></p></div>
        <script>
          //返回操作按钮
          function acturl(response) {
              var str = ''
                  if (response.state == 1) {
                    str+= '<a data-id="'+ response.id +'" data-type="0" class="btn actionStare">下架</a>'
                  }else{
                    str+= '<a data-id="'+ response.id +'" data-type="1" class="btn actionStare">上架</a>'
                  }
                  str+= '<a href="<?php echo U("detail");?>?id='+ response.id +'" class="btn">编辑</a>'
                  str+= '<a data-id="'+ response.id +'" class="btn delMessage">删除</a>'
              return str;
          }
          // 修改房源上下架状态
          $('body').on('click', '.actionStare', function(){
            var btn      = $(this)
            var thisText = btn.text();
            var status   = btn.attr('data-type');
            var id       = btn.attr('data-id');
            var html     = btn.parent().prev('td')
            $.post("<?php echo U('changeHouseStatus');?>", {id: id, type: status}, function(res){
              // 根据返回值显示tips
              res.status == true ? promptBoxHidden(thisText+"成功!") : promptBoxHidden(thisText+"失败!")
              // 根据更改的状态页面ajax修改数据
              if (status == 0) {
                btn.attr('data-type', 1).html('上架')
                html.html('已下架')
              }else{
                btn.attr('data-type', 0).html('下架')
                html.html('上架中')
              }
            })
          });
          // 删除(隐藏)房源
          $('body').on('click', '.delMessage', function(){
            var that = $(this)
            var id   = that.attr('data-id')
            alertbox({
              msg: $('.close_del_up_mian').html(),
              tcallfn_tx:'删除',
              alerttap:1,
              tcallfn:function(){
                $.post("<?php echo U('delHouse');?>", {id: id}, function(response) {
                    if(response.status == 1) {
                        promptBoxHidden("删除成功!")
                        that.parent().parent().hide()
                    }else {
                        promptBoxHidden("删除失败!")
                    }
                }, 'json');
              }
            })
          });
          // 城市三级联动-copy
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
          // 搜索记录
          $('select[name=province_code]').val(<?php echo ($_GET['province_code']); ?>)
          $('select[name=city_code]').val(<?php echo ($_GET['city_code']); ?>)
          $('select[name=country_code]').val(<?php echo ($_GET['country_code']); ?>)
          $('select[name=proxy_status]').val(<?php echo ($_GET['proxy_status']); ?>)
          $('select[name=property_type]').val("<?php echo ($_GET['property_type']); ?>")
          $('select[name=price_type]').val(<?php echo ($_GET['price_type']); ?>)
          $('input[name=min_price]').val(<?php echo ($_GET['min_price']); ?>)
          $('input[name=max_price]').val(<?php echo ($_GET['max_price']); ?>)
          $('select[name=source]').val(<?php echo ($_GET['source']); ?>)
          $('input[name=keyword]').val(<?php echo ($_GET['keyword']); ?>)
        </script>
    </body>
</html>