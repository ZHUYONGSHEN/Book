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
                        <li><a href="<?php echo U('NewHouse/index');?>" <?php if(in_array((CONTROLLER_NAME), explode(',',"NewHouse,HouseType"))): ?>class="active"<?php endif; ?>>新房管理</a></li>
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
                        <select name="province_code" id="province" class="form-control">
                            <option value="">省份-全部</option>
                            <?php if(is_array($province)): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["adcode"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                       </select>
                    </div>
                    <div class="form-group">
                        <select name="city_code" id="city" class="form-control">
                            <option value="">城市-全部</option>
                       </select>
                    </div>
                   <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="">新房-全部</option>
                            <option value="1">开启</option>
                            <option value="0">关闭</option>
                       </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="keyword" value="<?php echo ($_GET['keyword']); ?>" class="form-control" placeholder="请输入关键字">
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-blue"><i class="searchNewIcon"></i> 搜索</button>
                    </div>
                </form>
            </div>
            <div class="clearfix text-right margin-right-20">
              <a class="btn btn-blue BombElem" data-module="regionConfigure" data-title="添加城市">添加城市</a>
            </div>
            <br />
            <div class="ho-list table-border-block border">
                <div class="table-responsive">
                    <table class="table table-hover" id="city_list">
                        <thead>
                            <tr>
                              <th data-column="id">序号</th>
                              <th data-column="province">省份</th>
                              <th data-column="city">城市</th>
                              <th data-column="status_text">新房</th>
                              <th data-func="acturl">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <td>深圳</td>
                              <td>罗湖</td>
                              <td>碧海湾</td>
                              <td>住宅</td>
                              <td>
                                <a class="btn BombElem" data-module="regionConfigure" data-title="编辑城市">编辑</a>
                                <a class="btn BombElem" data-module="configurePrice" data-title="配置总价">配置总价</a>
                                <a class="btn delMessage">删除</a>
                              </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="ho-row"><?php echo ($page); ?></div>
            </div>
        </div>
        <div class="modal" data-module="regionConfigure">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close outline" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">添加城市</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" id="cityForm">
                  <input type="hidden" name="id" value="">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"> <i class="required">*</i>省份：</label>
                    <input type="hidden" id="province_adcode" name="province_adcode" value="">
                    <div class="col-sm-7 padding-left-zero">
                      <select class="form-control" id="chose_province">
                        <option value="">请选择省份</option>
                        <?php if(is_array($province)): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["adcode"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"> <i class="required">*</i>城市：</label>
                    <input type="hidden" id="city_adcode" name="city_adcode" value="">
                    <div class="col-sm-7 padding-left-zero">
                      <select class="form-control" id="chose_city">
                        <option value="">请选择城市</option>
                      </select>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
               <div class="text-center">
                  <span id="citySubmit" data-type="add" class="btn btn-blue outline">保存</span>
                  <span class="btn btn-default outline miss" data-dismiss="modal">取消</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal" data-module="configurePrice">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close outline" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">配置总价</h4>
              </div>
              <div class="modal-body" style="max-height: 770px; overflow-y: auto;">
                <form class="form-horizontal" id="priceForm">
                  <input type="hidden" name="city_id" value="">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"> 省份：</label>
                    <div class="col-sm-7 padding-left-zero"></div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"> <i class="required">*</i>最小总价：</label>
                    <div class="pull-left margin-right-15">
                      <input type="text" name="min_price" class="form-control" placeholder="价格">
                    </div>
                    <div class="pull-left control-label">万元以下</div>
                  </div>
                  <div class="sectionPrice">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> 其他区间：</label>
                      <div class="pull-left margin-right-15">
                        <input type="text" name="start_price[]" class="form-control" placeholder="价格">
                      </div>
                      <div class="pull-left control-label margin-right-15">一</div>
                      <div class="pull-left margin-right-15">
                        <input type="text" name="end_price[]" class="form-control" placeholder="价格">
                      </div>
                      <div class="pull-left control-label margin-right-15">万</div>
                      <span class="btn addIcon addNewElem" style="margin-top: 5px;"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"> <i class="required">*</i>最大总价：</label>
                    <div class="pull-left margin-right-15">
                      <input type="text" name="max_price" class="form-control" placeholder="价格">
                    </div>
                    <div class="pull-left control-label">万元以上</div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
               <div class="text-center">
                  <span id="priceSubmit" class="btn btn-blue outline">保存</span>
                  <span class="btn btn-default outline miss" data-dismiss="modal">取消</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div  class="close_del_up_mian" style="display:none;">
            <div>
                <p class="alert_title border-bottom">提示信息</p>
                <div class="text-center padding30">
                    删除数据将无法恢复，是否继续？
                </div>
            </div>
        </div>
        <div class="promptBox" style="display:none;"><p class="background-white"></p></div>
        <script type="text/javascript">
            // 记录筛选条件
            $('select[name=status]').val(<?php echo ($_GET['status']); ?>)
            // 返回按钮
            function acturl(response) {
                var str = '<a data-id="'+ response.id +'" class="btn BombElem" data-module="regionConfigure" data-title="编辑城市">编辑</a>'+
                          '<a data-id="'+ response.id +'" class="btn BombElem" data-module="configurePrice" data-title="配置总价">配置总价</a>'+
                          '<a data-id="'+ response.id +'" class="btn delMessage">删除</a>';
                return str;
            }
            // 清楚记录
            $('.miss').click(function() {
                $('#citySubmit').attr('data-type', 'add');
                $('#cityForm').find('input').val('');
                $('#cityForm').find('select').val('');
                $('#priceForm').find('input').val('');
                $('.sectionPrice').find('.form-group').not('.form-group:first').remove();
            })
            // 添加/编辑城市
            $('#citySubmit').click(function() {
                var data = $('#cityForm').serialize();
                var type = $(this).attr('data-type');
                if (type == 'add') {
                    var url = "<?php echo U('addNewCity');?>";
                }else{
                    var url = "<?php echo U('editCity');?>";
                }
                $.post(url, data, function(res) {
                    var info  = res.data;
                    var count = $('.row').find('div').eq(0).html().substring(2,3);
                    if (res.status == 1) {
                        var str = '<tr>'+
                                    '<td class="text-center">'+ info.id +'</td>'+
                                    '<td class="text-center">'+ info.province +'</td>'+
                                    '<td class="text-center">'+ info.city +'</td>'+
                                    '<td class="text-center">'+ info.status_text +'</td>'+
                                    '<td class="text-center">'+
                                        '<a data-id="'+ info.id +'" class="btn BombElem" data-module="regionConfigure" data-title="编辑城市">编辑</a>'+
                                        '<a data-id="'+ info.id +'" class="btn BombElem" data-module="configurePrice" data-title="配置总价">配置总价</a>'+
                                        '<a data-id="'+ info.id +'" class="btn delMessage">删除</a>'+
                                    '</td>'+
                                  '</tr>';
                        promptBoxHidden('添加成功');
                        $('.row').find('div').eq(0).html('共 '+(count*1+1*1)+' 条记录')
                        $('#city_list').prepend(str);
                        $('.miss').click();
                    }else if (res.status == 2) {
                        $('#city_list').find('tbody tr').each(function(key, val) {
                            var str = '<td class="text-center">'+ info.id +'</td>'+
                                      '<td class="text-center">'+ info.province +'</td>'+
                                      '<td class="text-center">'+ info.city +'</td>'+
                                      '<td class="text-center">'+ info.status_text +'</td>'+
                                      '<td class="text-center">'+
                                          '<a data-id="'+ info.id +'" class="btn BombElem" data-module="regionConfigure" data-title="编辑城市">编辑</a>'+
                                          '<a data-id="'+ info.id +'" class="btn BombElem" data-module="configurePrice" data-title="配置总价">配置总价</a>'+
                                          '<a data-id="'+ info.id +'" class="btn delMessage">删除</a>'+
                                      '</td>';
                            if ($(this).find('td:first').html() == info.id) {
                                $(this).html(str)
                            }
                        });
                        promptBoxHidden('修改成功');
                    }else{
                        promptBoxHidden(res.info);
                    }
                });
            })
            // 编辑总价
            $('#priceSubmit').click(function() {
                var data = $('#priceForm').serialize();
                var url  = "<?php echo U('editPrice');?>";
                $.post(url, data, function(res) {
                    if (res.status == 1) { promptBoxHidden('编辑成功');$('.miss').click(); }
                });
            })
            // 城市三级联动-copy(搜索条件)
            var cityUrl           = "<?php echo U('getCitys');?>";
            var countryUrl        = '';
            var selector_province = '#province';
            var selector_city     = '#city';
            var selector_country  = '';
            // 记忆所选市省区，用于列表查询
            var selected_province = "<?php echo ($_GET['province_code']); ?>";
            var selected_city     = "<?php echo ($_GET['city_code']); ?>";
            if(selected_province) {
                $(selector_province).val(selected_province);
                fnGetCity(selector_province, selected_city, selector_city, function() {
                    if(selected_city) {
                        $(selector_city).val(selected_city);
                    }
                });
            }
            // select chosen插件值改变事件
            $(selector_province).change(function() {
                $('#s_adcode').val($(this).val());
                fnGetCity(selector_province, selected_city, selector_city, function() {});
            });
            // 城市三级联动-copy(添加编辑)
            var chose_province = '#chose_province';
            var chose_city     = '#chose_city';
            // select chosen插件值改变事件
            $('.modal').on('change', chose_province, function() {
                $('#province_adcode').val($(this).val());
                fnGetCity(chose_province, $('#city_adcode').val(), chose_city);
            });
            $('body').on('change', chose_city, function() {
                $('#city_adcode').val($(this).val());
            });
        </script>
        <script>
          $(function(){
            $('.table-responsive').on('click','.delMessage',function(){
              var _that = $(this);
              var id    = _that.attr('data-id');
              var count = $('.row').find('div').eq(0).html().substring(2,3);
              alertbox({
                msg: $('.close_del_up_mian').html(),
                tcallfn_tx:'确认',
                alerttap:1,
                tcallfn:function(){
                  //点击删除按钮后操作
                  $.post("<?php echo U('delCity');?>", { id: id }, function(res) {
                      if (res.status == 1 ) {
                          _that.parents('tr').remove();
                          promptBoxHidden('删除成功');
                          $('.row').find('div').eq(0).html('共 '+(count-1)+' 条记录')
                      }else{
                          promptBoxHidden('操作失败');
                      }
                  })

                }
              })
            });
            $('body').on('click', '.addNewElem', function(){
              var _html='<div class="form-group">'+
                      '<label class="col-sm-2 control-label"> </label>'+
                      '<div class="pull-left margin-right-15">'+
                        '<input type="text" name="start_price[]" class="form-control" placeholder="价格">'+
                      '</div>'+
                      '<div class="pull-left control-label margin-right-15">一</div>'+
                      '<div class="pull-left margin-right-15">'+
                        '<input type="text" name="end_price[]" class="form-control" placeholder="价格">'+
                      '</div>'+
                      '<div class="pull-left control-label margin-right-15">万</div>'+
                      '<span class="btn minusIcon delElem" style="margin-top: 13px;"></span>'+
                    '</div>';
              var parentElem = $(this).parents('.sectionPrice');
              parentElem.append(_html);
            });
            $('.sectionPrice').on('click','.delElem',function(){
              $(this).parents('.form-group').remove();
            });
            $('body').on('click', '.BombElem', function(){
              var showModule,_thisText;
                showModule = $(this).attr('data-module'),
                _thisText = $(this).attr('data-title');
                $(".modal[data-module='"+ showModule +"']").find('.modal-title').text(_thisText);
                $(".modal[data-module]").fadeOut();
                $(".modal[data-module='" + showModule+"']").fadeIn();
              var index = $(this).parent('td').find('a').index(this);
              var id    = $(this).attr('data-id');
              switch(index){
                case 0:
                    // 获取城市信息
                    $.post("<?php echo U('getCityDetail');?>", { city_id: id }, function(res){
                        var data = res.data
                        $('#chose_province').val(data.province_adcode)
                        $('#province_adcode').val(data.province_adcode)
                        $('#city_adcode').val(data.adcode)
                        $('#chose_city').val(data.adcode)
                        fnGetCity('#chose_province', $('#city_adcode').val(), '#chose_city');
                        $('input[name=id]').val(data.id)
                        $('#citySubmit').attr('data-type', 'eidt')
                    });
                    break;
                case 1: ;
                    // 获取价格信息
                    $.post("<?php echo U('getCityPrice');?>", { city_id: id }, function(res){
                        var data     = res.data;
                        var priceArr = data.price_area;
                        var str      = '';
                        $('#priceForm').find('.padding-left-zero').html(data.city)
                        $('input[name=city_id]').val(data.city_id)
                        $('input[name=min_price]').val(data.min_price);
                        $('input[name=max_price]').val(data.max_price);
                        $(priceArr).each(function(key, val){
                            str += '<div class="form-group">';
                            if (key == 0) {
                                str += '<label class="col-sm-2 control-label"> 其他区间：</label>';
                            }else{
                                str += '<label class="col-sm-2 control-label"> </label>';
                            }
                                 str += '<div class="pull-left margin-right-15">'+
                                          '<input type="text" name="start_price[]" value="'+ val.start_price +'" class="form-control" placeholder="价格">'+
                                        '</div>'+
                                        '<div class="pull-left control-label margin-right-15">一</div>'+
                                        '<div class="pull-left margin-right-15">'+
                                          '<input type="text" name="end_price[]" value="'+ val.end_price +'" class="form-control" placeholder="价格">'+
                                        '</div>'+
                                        '<div class="pull-left control-label margin-right-15">万</div>';
                            if (key == 0) {
                                str += '<span class="btn addIcon addNewElem" style="margin-top: 5px;"></span>';
                            }else{
                                str += '<span class="btn minusIcon delElem" style="margin-top: 13px;"></span>';
                            }
                            str += '</div>';
                        });
                        if (priceArr != null) { $('.sectionPrice').html(str) }
                    });
                    break;
                default: ; break;
              }
              return false;
            });
            //关闭自定义弹框
            $(".modal[data-module] [data-dismiss='modal']").click(function(){
              $(this).parents('.modal[data-module]').fadeOut();
              return false;
            });
            function promptBoxHidden(val){
              $('.promptBox').fadeIn();
              $('.promptBox p').text(val);
              var clearTime = setTimeout(function(){
                $('.promptBox').fadeOut();
                clearTimeout(clearTime);
              },1000);
            }
          });
        </script>
    </body>
</html>