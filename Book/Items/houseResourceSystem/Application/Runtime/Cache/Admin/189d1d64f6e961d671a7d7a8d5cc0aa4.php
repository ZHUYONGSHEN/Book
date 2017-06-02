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
<style type="text/css">
.choseType{ color: #0084ff!important; border-color: #0084ff!important; }
.dateTime { background-position: 95% center; padding-right: 30px; }
.promptBox p { width: 240px; }
.moveBoxShadowLeft,
.moveBoxShadowRight,
.moveBoxShadowTop,
.moveBoxShadowBottom{
    position: absolute;
    background: rgba(0,0,0, 0.5);
}
.moveBoxShadowLeft {
    left: 0;
    top: 0;
    bottom: 0;
    z-index: 11;
    width: 161px;
    height: 100%;
}
.moveBoxShadowRight {
    left: 701px;
    top: 0;
    bottom: 0;
    z-index: 11;
    width: 161px;
    height: 100%;
}
.moveBoxShadowTop {
    left: 161px;
    top: 0;
    z-index: 11;
    width: 540px;
    height: 67px;
}
.moveBoxShadowBottom {
    left: 161px;
    bottom: 0;
    z-index: 11;
    width: 540px;
    height: 67px;
}

.moveBox {
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 111;
    transform: translate(-50%,-50%);
    width: 540px;
    height: 405px;
    cursor: move;
    background:url(/Public/Admin/images/popCut.png) no-repeat center center;
}
input::-webkit-outer-spin-button,input::-webkit-inner-spin-button{ -webkit-appearance: none !important; }
</style>
<!--主体开始-->
<br>
	<div class="ho-main">
		<!-- <div class="background-white border padding30">
            <div class="row">
                <div class="col-sm-4 EditBootstrap">
                    <h2>东海花园福禄居 <i class="btn btn-green">代理中</i></h2>
                    <p class="font-color-526a7a margin-top-20">对应楼盘：东海花园</p>
                </div>
                <div class="col-sm-8 text-right">
                    <a href="#" class="btn btn-blue margin-top-20"><i class="searchNewIcon"></i>上架</a>
                </div>
            </div>
        </div> -->
		<br/>
        <img id="imagesPic" style="transform: scale(.8);-moz-transform:scale(.8); -webkit-transform:scale(.8); -o-transform:scale(.8); " src="http://dg3.zol-img.com.cn/74_module_images/19/53911d7018e23.jpg" alt="">
		<form class="form-horizontal" method="post" enctype="multipart/form-data">
			<div class=" hoMain-body background-white border EditBootstrap">
				<div class="row">
					<div class="hoMain-title">
                        <h3>新建项目</h3>
                    </div>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1" class="col-sm-2 control-label padding-right-zero">所属楼盘：</label>
					<div class="col-sm-6" style="position: relative;">
                        <input type="hidden" name="hid" value="">
                    	<input type="text" class="form-control" id="exampleInputEmail1" placeholder="请选择当前项目所属楼盘">
                    	<div class="showBox">
                    		<ul>
                                <?php if(is_array($house)): $i = 0; $__LIST__ = $house;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-id="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    		</ul>
                    	</div>
                    </div>
                    <label class="pull-left control-label margin-right-15"><a href="<?php echo U('Dictionary/add');?>">没有找到楼盘？点此到楼盘字典新增</a></label>
                    <label class="pull-left control-label"><i class="required">*</i></label>
				</div>
                <div class="form-group">
                    <label for="exampleInputEmail10" class="col-sm-2 control-label padding-right-zero">项目名称：</label>
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" placeholder="请输入项目名称" maxlength="20">
                    </div>
                    <label class="pull-left control-label text-left padding-left-zero"><i class="required">*</i></label>
                </div>
				<div class="form-group">
					<label for="exampleInputEmail2" class="col-sm-2 control-label padding-right-zero">推广名称：</label>
					<div class="col-sm-6">
        	           <input type="text" name="market_name" class="form-control" id="exampleInputEmail2" placeholder="请输入推广名称" maxlength="20">
                    </div>
                    <label class="col-sm-1 control-label text-left padding-left-zero"><i class="required">*</i></label>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label padding-right-zero">物业类型：</label>
					<div class="col-sm-9">
                        <?php if(is_array($property)): $i = 0; $__LIST__ = $property;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox-inline">
                                <input type="checkbox" name="property_ids[]" value="<?php echo ($vo["id"]); ?>"> <?php echo ($vo["name"]); ?>
                            </label><?php endforeach; endif; else: echo "" ;endif; ?>
                        <label class="checkbox-inline padding-left-zero">
                            <i class="required">*</i>
                        </label>
                    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label padding-right-zero">代理状态：</label>
					<div class="col-sm-2">
						<select name="proxy_status" class="form-control">
                            <option value="" style="display:none">请选择代理状态</option>
                            <option value="1">代理中</option>
                            <option value="0">已完结</option>
                            <option value="2">已中止</option>
                        </select>
					</div>
					<label class="col-sm-1 control-label text-left padding-left-zero"><i class="required">*</i></label>
				</div>
                <div class="form-group">
                    <label class="col-sm-2 control-label padding-right-zero">开盘时间：</label>
                    <div class="col-sm-2">
                        <input type="text" name="open_date" class="form-control dateIcon dateTime" id="open_date" placeholder="开盘日期">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label padding-right-zero">入住时间：</label>
                    <div class="col-sm-2">
                        <input type="text" name="checkin_date" class="form-control dateIcon dateTime" id="checkin_date" placeholder="入住日期">
                    </div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label padding-right-zero">合同日期：</label>
					<div class="col-sm-2">
						<input type="text" name="contract_start" class="form-control dateIcon" id="start" placeholder="开始日期">
					</div>
					<label class="control-label text-center pull-left">-</label>
					<div class="col-sm-2">
						<input type="text" name="contract_end" class="form-control dateIcon" id="end" placeholder="结束日期">
					</div>
					<label class="col-sm-1 control-label text-left padding-left-zero"><i class="required">*</i></label>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label padding-right-zero">代理方式：</label>
					<div class="col-sm-7">
						<div class="col-sm-2 padding-left-zero">
							<label class="radio-inline">
                                <input type="radio" name="proxy_mod" value="0"> 联通代理
                            </label>
						</div>
						<div class="col-sm-2 padding-left-zero">
							<label class="radio-inline">
                                <input type="radio" name="proxy_mod" value="1"> 策划代理
                            </label>
						</div>
						<div class="col-sm-2 padding-left-zero">
							<label class="radio-inline">
                                <input type="radio" name="proxy_mod" value="2"> 现场代理
                            </label>
						</div>
						<label class="col-sm-1 control-label text-left padding-left-zero"><i class="required">*</i></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label padding-right-zero">均价：</label>
					<div class="col-sm-2">
						<input type="number" name="average_min" data-length="6" class="form-control" placeholder="12000">
					</div>
					<label class="control-label text-center pull-left">-</label>
					<div class="col-sm-2">
						<input type="number" name="average_max" data-length="6" class="form-control" placeholder="12000">
					</div>
					<label class="control-label text-center pull-left">元/㎡</label>
					<label class="col-sm-1 control-label text-left"><i class="required">*</i></label>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label padding-right-zero">总价：</label>
					<div class="col-sm-2">
						<input type="number" name="total_min" data-length="6" class="form-control" placeholder="12000">
					</div>
					<label class="control-label text-center pull-left">-</label>
					<div class="col-sm-2">
						<input type="number" name="total_max" data-length="6" class="form-control" placeholder="12000">
					</div>
					<label class="control-label text-center pull-left">万元</label>
					<label class="col-sm-1 control-label text-left"><i class="required">*</i></label>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label padding-right-zero">首付比例：</label>
					<div class="col-sm-2">
						<input type="number" name="pay_min" data-type="float" data-length="5" class="form-control" placeholder="12000">
					</div>
					<label class="control-label text-center pull-left">-</label>
					<div class="col-sm-2">
						<input type="number" name="pay_max" data-type="float" data-length="5" class="form-control" placeholder="12000">
					</div>
					<label class="control-label text-center pull-left">%</label>
					<label class="col-sm-1 control-label text-left"><i class="required">*</i></label>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label padding-right-zero">在售楼盘：</label>
					<div class="col-sm-2">
						<input type="number" name="sale_total" data-length="6" class="form-control" placeholder="12000">
					</div>
					<label class="control-label text-center pull-left">套</label>
					<label class="col-sm-1 control-label text-left"><i class="required">*</i></label>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label padding-right-zero">面积范围：</label>
					<div class="col-sm-2">
						<input type="number" name="area_min" data-length="6" class="form-control" placeholder="12000">
					</div>
					<label class="control-label text-center pull-left">-</label>
					<div class="col-sm-2">
						<input type="number" name="area_max" data-length="6" class="form-control" placeholder="12000">
					</div>
					<label class="control-label text-center pull-left">㎡</label>
					<label class="col-sm-1 control-label text-left"><i class="required">*</i></label>
				</div>
				<div class="form-group">
                    <label class="col-sm-2 control-label padding-right-zero">项目特色：</label>
                    <div class="col-sm-9">
                        <?php if(is_array($project)): $i = 0; $__LIST__ = $project;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox-inline">
                                <input type="checkbox" name="project_ids[]" value="<?php echo ($vo["id"]); ?>"> <?php echo ($vo["name"]); ?>
                            </label><?php endforeach; endif; else: echo "" ;endif; ?>
                        <label class="checkbox-inline padding-left-zero"><i class="required">*</i></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label padding-right-zero">来源：</label>
                    <div class="col-sm-9">
                        <label class="radio-inline">
                            <input type="radio" name="source" value="1" checked="checked"> 合作
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="source" value="0"> 采集
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label padding-right-zero">楼盘标签：</label>
                    <div class="col-sm-9">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="house_tag[]" value="0" checked="checked"> 热销
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="house_tag[]" value="1"> 新盘
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="cover_path" value="">
                    <label class="col-sm-2 control-label padding-right-zero">封面图：</label>
                    <div class="col-sm-9">
                        <div class="col-sm-4">
                            <div class="upDataImage upDataFile" id="upDataImage" data-model="cutPic" data-elemShow ="upDataImage" data-upDataUrl="<?php echo U('Dictionary/ImgUpload');?>" data-Type="png/jpg/jpeg/gif/bmp" data-fileSize="5"></div>
                        </div>
                        <label class="col-sm-1 control-label text-left padding-left-zero" style="margin-top: 60px;"><i class="required">*</i></label>
                        <div class="col-sm-3 fontColor" style="margin-top: 40px;">
                            <span>1.图片大小不能超过5M</span><br />
                            <span>2.图片必须为jpg或者png格式</span><br />
                            <span>3.图片分辨率为1200*900</span>
                        </div>
                    </div>
                </div>
			</div>
			<br />
			<div class=" hoMain-body background-white border">
				<div class="row">
					<div class="hoMain-title">
                    	<h3>联系人</h3>
                    </div>
				</div>
			 	<div class="ho-list table-border-block clearfix ">
                    <div class="form-group">
                        <label class="col-sm-2 control-label padding-right-zero"> 驻场：</label>
                        <div class="col-sm-10 padding-left-zero">
                            <input type="hidden" class="form-control" name="contact_type" value="4">
                            <div class="col-sm-3 EditBootstrap">
                                <input type="text" name="cont_name" class="form-control" placeholder="请输入人员姓名">
                            </div>
                            <div class="col-sm-2 padding-right-zero" style=" width: 85px;">
                                <label class="control-label"> 联系电话：</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="cont_mobile" class="form-control" placeholder="请输入人员联系方式">
                            </div>
                            <div class="col-sm-4">
                                <label class="control-label fontColor">（该联系方式为经纪人拨打的联系电话）</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label padding-right-zero"></label>
                        <div class="col-sm-10 padding-left-zero">
                            <div class="col-sm-4 EditBootstrap">
                                <a class="btn btn-grayNoBackground getContType choseType" data-type="4">负责咨询</a>
                                <a class="btn btn-grayNoBackground getContType" data-type="5">现场对接</a>
                                <a class="btn btn-grayNoBackground getContType" data-type="6">报备对接人</a>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<br />
			<div class="row text-center">
				<span id="submit" class="btn btn-blue">保存</span>
                <span onclick="javascript:history.go(-1)" class="btn btn-blue">取消</span>
			</div>
		</form>
	</div>
    <div class="modal" data-module="cutPic" style="display: none;">
        <div class="modal-dialog" style="max-width: 864px;" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close outline" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">裁剪图片</h4>
            </div>
            <div class="modal-body" id="zoomElem" style=" width: 100%; padding: 0; line-height: 540px; text-align:center;margin: 0; height: 540px; overflow: hidden; position: relative;">
                <img src="" alt="" style="vertical-align:middle;">
                <div class="moveBoxShadowLeft"></div>
                <div class="moveBoxShadowRight"></div>
                <div class="moveBoxShadowTop"></div>
                <div class="moveBoxShadowBottom"></div>
                <div class="moveBox"></div>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                <span id="submit" data-type="add" class="btn btn-blue outline">保存</span>
                <span id="miss" class="btn btn-default outline" data-dismiss="modal">取消</span>
                </div>
            </div>
        </div>
        </div>
    </div>
	<input type="file" id="fileImages" style="display: none;">
    <div class="promptBox" style="display:none;"><p class="background-white"></p></div>
	<script type="text/javascript" src="/Public/Admin/js/laydate/laydate.js" ></script>
    <script type="text/javascript">
    // 输入搜索
    var thisValue = "",seachHouse;
    $('#exampleInputEmail1').on('input propertychange',function(){
        var keyword = thisValue = $(this).val();
        if (!keyword) {
            return false;
        }
        clearTimeout(seachHouse);
        seachHouse =  setTimeout(function(){
            $.post("<?php echo U('searchHouse');?>", {keyword: keyword}, function(res){
                var data = res.data
                var str = ''
                $(data).each(function(key, val){
                    str+= '<li data-id="'+ data[key].id +'">'+ data[key].name +'</li>'
                })
                $('.showBox ul').html(str)
            });
         }, 1000)

    });
    // 初始内容
    $('#exampleInputEmail1').focus(function(){
        if($('.showBox').is(':hidden')){
            $('.showBox').show();
        }
    });
    $('body').click(function(){
        if(!$('.showBox').is(':hidden') && $('#exampleInputEmail1').is(':focus')){
            $('.showBox').show();
        } else {
            $('.showBox').hide();
        }
        return;
    });
    $('.showBox').on('click','li',function(){
    	$('#exampleInputEmail1').val($(this).text());
        $('input[name=hid]').val($(this).attr('data-id'));
    	$('.showBox').hide();
    });
    function hideShowBox (){
    	clearTimeout(clearHideShowBoxTime);
        var clearHideShowBoxTime = setTimeout(function(){
            $('#exampleInputEmail1').blur();
            $('.showBox').hide();
            clearTimeout(clearHideShowBoxTime);
        },3000);
    }
    // 点击提交按钮将表单所有数据提交到新增方法中
    $('#submit').click(function(event) {
        event.preventDefault();
        var data = $('form').serialize()
        $.post("<?php echo U('doAddNewItem');?>", data, function(res){
            if (res.status == 0) {
                promptBoxHidden(res.info)
            }else{
                promptBoxHidden('添加成功')
                setTimeout(function(){ window.location.href='index' }, 1100)
            }
        })
    });
    // 更换联系人状态
    $('.getContType').click(function(event) {
        event.preventDefault();
        var type = $(this).attr('data-type')
        $(this).siblings('a').removeClass('choseType')
        $(this).addClass('choseType')
        $('input[name=contact_type]').val(type)
    })
    // 控制输入框长度
    $('input[type=number]').keyup(function(){
        var reg  = /^[0-9]{1,2}(\.[0-9]{1,2})?$/;
        var cont = $(this).val();
        var len  = cont.length;
        var max  = $(this).attr('data-length');
        var type = $(this).attr('data-type');
        if (!$.isNumeric(cont) || cont == 0) {
            $(this).val('')
        }
        if (!reg.test(cont) && type == 'float'){
            if (cont.toString().indexOf('.') > 0) {
                $(this).val(parseInt(cont));
                return;
            }
            if (len > 2) {
                $(this).val(cont.substring(0,2))
            }
        } else {
            if (len > max) {
                $(this).val(cont.substring(0,max))
            }
        }
    })
    </script>
	<script>
        //关闭自定义弹框
        $(".modal[data-module] [data-dismiss='modal']").click(function(){
          $(this).parents('.modal[data-module]').fadeOut();
          return false;
        });
        // 日期选择参数
		var start = {
		  elem: '#start',
		  format: 'YYYY/MM/DD',
		  min: laydate.now(), //设定最小日期为当前日期
		  max: '2099-06-16', //最大日期
		  istime: true,
		  istoday: false,
		  choose: function(datas){
		     end.min = datas; //开始日选好后，重置结束日的最小日期
		     end.start = datas //将结束日的初始值设定为开始日
		  }
		};
		var end = {
		  elem: '#end',
		  format: 'YYYY/MM/DD',
		  min: laydate.now(),
		  max: '2099-06-16',
		  istime: true,
		  istoday: false,
		  choose: function(datas){
		    start.max = datas; //结束日选好后，重置开始日的最大日期
		  }
		};
        var open_date = {
          elem: '#open_date',
          format: 'YYYY/MM/DD',
          min: '1970-01-01',
          max: '2099-06-16',
          istime: true,
          istoday: false
        };
        var checkin_date = {
          elem: '#checkin_date',
          format: 'YYYY/MM/DD',
          min: '1970-01-01',
          max: '2099-06-16',
          istime: true,
          istoday: false
        };
		laydate(start);
		laydate(end);
        laydate(open_date);
        laydate(checkin_date);
        var zoomElem = document.getElementById('zoomElem'),
            zoomNumber=1;
        zoomElem.addEventListener( 'wheel', onDocumentMouseWheel, false ); 
        function onDocumentMouseWheel (e){
            var theEvent = window.event || e,
                wheelDel=0;
            if ( theEvent && theEvent.preventDefault ) 
                theEvent.preventDefault(); 
            else
                theEvent.returnValue = false; 
            // WebKit
            if (theEvent.wheelDeltaY) {
                wheelDel = theEvent.wheelDeltaY * 0.05;
                // Opera / Explorer 9
            } else if (theEvent.wheelDelta) {
                wheelDel = theEvent.wheelDelta * 0.05;
                // Firefox
            } else if (theEvent.detail) {
                wheelDel = theEvent.detail * 1.0;
            }
            setTimeout(function(){   
                if(wheelDel>0){
                    zoomNumber+=0.01;
                    $(zoomElem).find('img').css({
                        "transform": "scale("+ zoomNumber +")"
                    });
                } else {
                    zoomNumber-=0.01;
                    $(zoomElem).find('img').css({
                        "transform": "scale("+ zoomNumber +")"
                    });
                }
                
            },500)
            console.log(wheelDel);
           
        }
        //文件上传
		var fileId = document.getElementById("fileImages")//change执行事件目标
			imgageType = "",//文件类型
			imgageSize = "",//文件大小
			imageWidth = "",//宽
			imageHeight = "",//高
			request= "",
            zoom=0.
            imgWidth=0,
            imgHeight=0;//终止ajax上传变量
	    fileId.addEventListener("change",upLoadImage,false );
	        function upLoadImage() {
                var data = this.files[0];
	            (function createUpDateFile(fileData) {
	            	//是否有文件数据
	            	if (fileData) {
	            		var URL = window.URL || window.webkitURL;
		                var blob = URL.createObjectURL(fileData);
		                var img = new Image();
		                var type = fileData.type.substring(fileData.type.indexOf('/')+1,fileData.type.length);
	                	//文件类型与大小
	                	if (!!imgageType) {
	                		if (imgageType.indexOf(type) < 0 || !fileData.type) {
			                 	alert('请上传'+ imgageType +'后缀的文件!');
			                 	return false;
			                }
	                	}
		                if(!!imgageSize){
		                	if (fileData.type > imgageSize*1024) {
			                 	alert('请上传文件大小小于/等于'+ upDataFileSize +'M!');
			                 	return false;
			                }
		                }
		                img.src = blob;
                         if(!!modelShow){
                            $(".modal[data-module='" + modelShow+"']").find('img').attr('src',blob);
                            $(".modal[data-module='" + modelShow+"']").fadeIn();
                        }
		                img.onload = function () {
		                	imgWidth = img.width;
		                	imgHeight = img.height;
                            if(imgWidth>=864){
                                $(zoomElem).find('img').css('max-width','100%')
                            }
                            /*if(!!modelShow){
                                
                            }*/
                        };
                        
		                	/*//文件尺寸
		                	if (!!imageWidth) {
		                		if (imgWidth > imageWidth) {
			                		alert('请上传文件尺寸小于/等于'+ imageWidth +'(宽)!');
			                		return false;
			                	}
		                	}
		                	if (!!imageHeight) {
		                		if ( imgHeight > imageHeight) {
			                		alert('请上传文件尺寸小于/等于'+ imageHeight +'(高)!');
			                		return false;
			                	}
		                	}
		                	//显示目标
	                		if(!!upDataElemShowId){
	                			document.getElementById(upDataElemShowId).style.backgroundImage = "url("+ blob +")";
	                		}
		                    if(!!upDataUrl){
                                console.log(fileData);
		                    	request = $.ajax({
			                        type: "POST",
			                        url: upDataUrl,
			                        data: fd,
			                        processData: false,
			                        contentType: false,
			                        success: function (res) {
			                            var result = res;
			                            //是否上传成功(根据返回字段微调)
			                            if (result.returnCode == "SUCCESS") {
                                            $('input[name=cover_path]').val(result.imgPath)
			                            }
			                        }
			                        error: function (data) {
			                        	//提交出错
			                        }
			                    });
		                    }

		                }*/
			        }
	           	})(data);
	        }
	        $('.upDataFile').click(function (argument) {
                $("#fileImages").wrap('<form>').closest('form').get(0).reset();
	        	//点击触发change
	        	var _that = this;
	        	imgageType = _that.getAttribute('data-Type'),//文件类型
        		imageWidth = _that.getAttribute('data-fileWidth'),//文件宽
        		imageHeight = _that.getAttribute('data-fileheight'),//文件高
        		upDataElemShowId = _that.getAttribute('data-elemShow'),//本地展示目标ID
        		upDataElemStopId = _that.getAttribute('data-elemStop'),//强制取消上传ID
        		upDataElemAnimationId = _that.getAttribute('data-elemAnimation'),//上传动画元素ID
        		upDataFileSize = _that.getAttribute('data-fileSize'),//文件大小单位(m)
        		upDataElemName = _that.getAttribute('data-elemName'),//文件名称
        		upDataUrl = _that.getAttribute('data-upDataUrl');//ajax提交地址
                modelShow = _that.getAttribute('data-model');
				fileId.click();
				return false;
	        });
			$(function() {
				$('.lookBigImage').click(function() {
					var imageUrl = $(this).attr('data-imageUrl');
					$('.lookImage').fadeIn();
					$('.lookImage img').attr('src', imageUrl);
				});
				$('.lookImage').click(function(){
					$(this).fadeOut();
				});
			})
	</script>
	</body>
</html>