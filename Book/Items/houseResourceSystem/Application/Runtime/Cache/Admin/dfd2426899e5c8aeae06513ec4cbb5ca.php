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
<script type="text/javascript" src="/Public/Admin/js/common.js" ></script>
<!--主体开始-->
        <div class="ho-main">
          <br />
          <div class="background-white border padding30">
            <div class="row">
              <div class="col-sm-4 EditBootstrap">
                <h2>东海花园福禄居 <i class="btn btn-green">代理中</i></h2>
                <p class="font-color-526a7a margin-top-20">对应楼盘：东海花园</p>
              </div>
              <div class="col-sm-8 text-right">
                <a href="#" class="btn btn-blue margin-top-20"><i class="searchNewIcon"></i>上架</a>
              </div>
            </div>
          </div>
          <br />
          <div class="background-white border">
            <div class="tableTitle border-bottom">
              <a href="#">项目信息</a>
              <a href="#" class="active">户型管理</a>
              <a href="#">操作记录</a>
            </div>
            <div class="hoMain-body houseAdmin">
              <div class="houseAdminTypeTag border">
                <div class="row">
                  <div class="col-sm-3 padding-right-zero">
                    <ul class="houseAdminTypeTagList">
                      <li class="active">
                        <a href="#" class="but">全部户型(27)</a>
                      </li>
                      <li>
                        <a href="#" class="but">在售户型(5)</a>
                      </li>
                      <li>
                        <a href="#" class="but">待售户型(7)</a>
                      </li>
                      <li>
                        <a href="#" class="but">已售罄(0)</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-9 padding-left-zero">
                    <div class="houseAdminTitle border-bottom clearfix background-white">
                      <a class="btn btn-blue pull-right BombElem" data-module="houseAdmin" data-title="新增户型">新增用户</a>
                    </div>
                    <div class="houseAdminBody background-white">
                      <div class="houseAdminList border-bottom">
                        <div class="row">
                          <div class="col-sm-3">
                            <img src="/Public/Admin/images/b.jpg" style="width: 167px; height: 116px;" alt="图片">
                          </div>
                          <div class="col-sm-3 EditBootstrap">
                            <h4>户型名称<i class="btn btn-green margin-left-15">在售</i></h4>
                            <p>户型均价：12000元/㎡</p>
                            <p>建筑面积：120㎡</p>
                          </div>
                          <div class="col-sm-3">
                            <p style="margin-top: 48px;">户型均价：12000元/㎡</p>
                            <p>建筑面积：120㎡</p>
                          </div>
                          <div class="col-sm-3">
                            <div class="clearfix">
                              <a class="btn btn-blue pull-right BombElem" data-module="houseAdmin" data-title="编辑户型">编辑</a>
                              <a class="btn btn-blue pull-right margin-right-15 houseAdminDelElem">删除</a>
                            </div>
                            <p>朝向：南北通透</p>
                          </div>
                        </div>
                      </div>
                      <div class="houseAdminList border-bottom">
                        <div class="row">
                          <div class="col-sm-3">
                            <img src="/Public/Admin/images/b.jpg" style="width: 167px; height: 116px;" alt="图片">
                          </div>
                          <div class="col-sm-3 EditBootstrap">
                            <h4>户型名称<i class="btn btn-green margin-left-15">在售</i></h4>
                            <p>户型均价：12000元/㎡</p>
                            <p>建筑面积：120㎡</p>
                          </div>
                          <div class="col-sm-3">
                            <p style="margin-top: 48px;">户型均价：12000元/㎡</p>
                            <p>建筑面积：120㎡</p>
                          </div>
                          <div class="col-sm-3">
                            <div class="clearfix">
                              <a class="btn btn-blue pull-right BombElem" data-module="houseAdmin" data-title="编辑户型">编辑</a>
                              <a class="btn btn-blue pull-right margin-right-15 houseAdminDelElem">删除</a>
                            </div>
                            <p>朝向：南北通透</p>
                          </div>
                        </div>
                      </div>
                      <div class="houseAdminList border-bottom">
                        <div class="row">
                          <div class="col-sm-3">
                            <img src="/Public/Admin/images/b.jpg" style="width: 167px; height: 116px;" alt="图片">
                          </div>
                          <div class="col-sm-3 EditBootstrap">
                            <h4>户型名称<i class="btn btn-green margin-left-15">在售</i></h4>
                            <p>户型均价：12000元/㎡</p>
                            <p>建筑面积：120㎡</p>
                          </div>
                          <div class="col-sm-3">
                            <p style="margin-top: 48px;">户型均价：12000元/㎡</p>
                            <p>建筑面积：120㎡</p>
                          </div>
                          <div class="col-sm-3">
                            <div class="clearfix">
                              <a class="btn btn-blue pull-right BombElem" data-module="houseAdmin" data-title="编辑户型">编辑</a>
                              <a class="btn btn-blue pull-right margin-right-15 houseAdminDelElem">删除</a>
                            </div>
                            <p>朝向：南北通透</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="houseAdminFooter background-white">
                      <div class="ho-row padding0">
                        <div class="row">
                            <div class="col-sm-4" style="line-height: 35px;">共 65112 条记录</div>
                            <div class="col-sm-8 text-right">
                                <ul class="pagination" style="margin-bottom: 0; margin-top: 0;">
                                    <li>
                                      <a href="#" aria-label="Previous">
                                        <span aria-hidden="true">上一页</span>
                                      </a>
                                    </li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li>
                                      <a href="#" aria-label="Next">
                                        <span aria-hidden="true">下一页</span>
                                      </a>
                                    </li>
                                </ul>
                                <div class="input-group" style="width: 120px; display: inline-table;">
                                    <input type="text" name="" class="form-control">
                                    <span class="input-group-btn"><button class="btn btn-primary" id="btn-paging-jump" type="button">跳转</button></span>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal" data-module="houseAdmin">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close outline" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">编辑联系人信息</h4>
                </div>
                <div class="modal-body" style="max-height: 770px; overflow-y: auto;">
                  <form class="form-horizontal">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> <i class="required">*</i>项目负责人：</label>
                      <div class="col-sm-8 padding-left-zero">
                          <input type="text" class="form-control" placeholder="请输入户型名称">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> <i class="required">*</i>户型均价：</label>
                      <div class="col-sm-7 padding-left-zero">
                          <input type="text" class="form-control" placeholder="请输入户型均价">
                      </div>
                      <div class="pull-left control-label">元/㎡</div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> <i class="required">*</i>销售状态：</label>
                      <div class="col-sm-7 padding-left-zero">
                          <a class="btn btn-grayNoBackground margin-right-10">已售</a>
                          <a class="btn btn-grayNoBackground margin-right-10">在售</a>
                          <a class="btn btn-grayNoBackground margin-right-10"">已售完</a>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> <i class="required">*</i>户型室数：</label>
                      <div class="pull-left margin-right-15" style="width: 80px;">
                        <input type="text" class="form-control" placeholder="室">
                      </div>
                      <div class="pull-left control-label margin-right-15">室</div>
                      <div class="pull-left margin-right-15" style="width: 80px;">
                        <input type="text" class="form-control" placeholder="厅">
                      </div>
                      <div class="pull-left control-label margin-right-15">厅</div>
                      <div class="pull-left margin-right-15" style="width: 80px;">
                        <input type="text" class="form-control" placeholder="卫">
                      </div>
                      <div class="pull-left control-label margin-right-15">卫</div>
                      <div class="pull-left margin-right-15" style="width: 80px;">
                        <input type="text" class="form-control" placeholder="厨">
                      </div>
                      <div class="pull-left control-label margin-right-15">厨</div>
                      <div class="pull-left margin-right-15" style="width: 80px;">
                        <input type="text" class="form-control" placeholder="阳">
                      </div>
                      <div class="pull-left control-label">阳</div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> <i class="required">*</i>建筑面积：</label>
                      <div class="col-sm-7 padding-left-zero">
                          <input type="text" class="form-control" placeholder="请输入建筑面积">
                      </div>
                      <div class="pull-left control-label">㎡</div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> <i class="required">*</i>套内面积：</label>
                      <div class="col-sm-7 padding-left-zero">
                          <input type="text" class="form-control" placeholder="请输入套内面积">
                      </div>
                      <div class="pull-left control-label">㎡</div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> <i class="required">*</i>户型图：</label>
                      <div class="col-sm-7 padding-left-zero">
                          <div class="upDataImage upDataFile" id="upDataImage" data-elemShow ="upDataImage" data-upDataUrl="url" data-Type="png/jpg/jpeg" data-fileSize="5" data-fileWidth="1200" data-fileheight="900"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> <i class="required">*</i>户型朝向：</label>
                      <div class="col-sm-7 padding-left-zero">
                        <select class="form-control">
                          <option>朝向</option>  
                          <option>朝向</option>
                        </select>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                 <div class="text-center">
                    <button type="button" class="btn btn-blue outline">保存</button>
                    <button type="button" class="btn btn-default outline" data-dismiss="modal">取消</button>
                  </div>
                </div>
              </div>
            </div>
          </div>  
          <div  class="close_del_up_houseAdmin" style="display:none;">
            <div>
                <p class="alert_title border-bottom">提示信息</p>
                <div class="text-center padding30">
                    删除户型数据将无法恢复，是否继续？
                </div>
            </div>
        </div>
        <div class="promptBox" style="display:none;"><p class="background-white"></p></div>
        <input type="file" id="fileImages" style="display: none;">
        <script>
          $(function() {
            function promptBoxHidden(val){
              $('.promptBox').fadeIn();
              $('.promptBox p').text(val);
              var clearTime = setTimeout(function(){
                $('.promptBox').fadeOut();
                clearTimeout(clearTime);
              },1000);
            }
            $('.BombElem').click(function(){
              var showModule,_thisText;
                showModule = $(this).attr('data-module'),
                _thisText = $(this).attr('data-title');
                $(".modal[data-module='"+ showModule +"']").find('.modal-title').text(_thisText);
              $(".modal[data-module]").fadeOut();
              $(".modal[data-module='" + showModule+"']").fadeIn();
              return false;
            });
            //关闭自定义弹框
            $(".modal[data-module] [data-dismiss='modal']").click(function(){
              $(this).parents('.modal[data-module]').fadeOut();
              return false;
            });
            $('.houseAdminBody').on('click','.houseAdminDelElem',function(){
              var _that = $(this);
              alertbox({
                      msg: $('.close_del_up_houseAdmin').html(),
                      tcallfn_tx:'确认',
                      alerttap:1,
                      tcallfn:function(){
                        //点击删除按钮后操作
                        _that.parents('.houseAdminList').remove();
                        promptBoxHidden('删除成功');
                      }
                    })
            });
            var fileId = document.getElementById("fileImages")//change执行事件目标
        imgageType = "",//文件类型
        imgageSize = "",//文件大小
        imageWidth = "",//宽
        imageHeight = "",//高
        request= "";//终止ajax上传变量
        fileId.addEventListener("change",upLoadImage,false );
            function upLoadImage() {
              var data = this.files[0];
              if (!!upDataElemName) {
            document.getElementById(upDataElemName).innerHTML = "";
          }
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
                      img.onload = function () {
                        var imgWidth = img.width;
                        var imgHeight = img.height;
                        //文件尺寸
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
                        //显示目标名称
                        if (!!upDataElemName) {
                  document.getElementById(upDataElemName).innerHTML = data.name
                }
                if (!!upDataElemStopId) {
                  document.getElementById(upDataElemStopId).addEventListener('click',requestAbort, false);
                  function requestAbort(argument) {
                    console.log(0);
                    request.abort();
                  }
                }
                          var fd = new FormData();
                          fd.append('file', blob);
                          var startimes = new Date();
                          if(!!upDataUrl){
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
                                    } else {
                                    }
                                },
                                xhr: function (e) {
                                  //进度流
                                  var xhr = $.ajaxSettings.xhr();
                        if(onprogress && xhr.upload) {
                          xhr.upload.addEventListener("progress" , onprogress, false);
                          return xhr;
                        } 
                                },
                                error: function (data) {
                                  //提交出错
                                }
                            });
                          }
                          
                      }
                }
                })(data);
            }
            $('.upDataFile').click(function (argument) {
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
              fileId.click();
              if (!!upDataElemAnimationId && !!upDataElemStopId) {
                document.getElementById(upDataElemAnimationId).style.width = 0;
              }
              return false;
          });
          function onprogress(evt){
              var loaded = evt.loaded;     //已经上传大小情况 
              var tot = evt.total;      //附件总大小 
              var per = Math.floor(100*loaded/tot);  //已经上传的百分比
              if (!!upDataElemAnimationId && !!upDataElemStopId) {
                document.getElementById(upDataElemAnimationId).style.width = per + '%';
              }
          }
          })
        </script>
    </body>
</html>