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
<br>
		<div class="ho-main">
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
			<br/>
			<form class="form-horizontal">
				<div class=" hoMain-body background-white border EditBootstrap">
					<div class="row">
						<div class="hoMain-title">
		                  <h3>项目信息编辑</h3>
		                </div>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1" class="col-sm-2 control-label padding-right-zero">项目名称：</label>
						<div class="col-sm-7">
		                	<input type="text" class="form-control" id="exampleInputEmail1" placeholder="请选择当前项目所属楼盘">
		                </div>
		                <label class="col-sm-1 control-label text-left padding-left-zero"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail2" class="col-sm-2 control-label padding-right-zero">推广名称：</label>
						<div class="col-sm-7">
		                	<input type="text" class="form-control" id="exampleInputEmail2" placeholder="推广名称">
		                </div>
		                <label class="col-sm-1 control-label text-left padding-left-zero"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">物业类型：</label>
						<div class="col-sm-9">
		                	<label class="checkbox-inline">
		                      <input type="checkbox" value="写字楼"> 写字楼
		                    </label>
		                    <label class="checkbox-inline">
		                      <input type="checkbox" value="商铺"> 商铺
		                    </label>
		                    <label class="checkbox-inline">
		                      <input type="checkbox" value="工业"> 工业
		                    </label>
		                    <label class="checkbox-inline">
		                      <input type="checkbox" value="教育"> 教育
		                    </label>
		                    <label class="checkbox-inline">
		                      <input type="checkbox" value="医疗"> 医疗
		                    </label>
		                    <label class="checkbox-inline">
		                      <input type="checkbox" value="车位"> 车位
		                    </label>
		                    <label class="checkbox-inline">
		                      <input type="checkbox" value="住宅"> 住宅
		                    </label>
		                    <label class="checkbox-inline">
		                      <input type="checkbox" value="公寓"> 公寓
		                    </label>
		                    <label class="checkbox-inline">
		                      <input type="checkbox" value="酒店式公寓"> 酒店式公寓
		                    </label>
		                    <label class="checkbox-inline">
		                      <input type="checkbox" value="花园式洋房"> 花园式洋房
		                    </label>
		                    <label class="checkbox-inline">
		                      <input type="checkbox" value="别墅"> 别墅
		                    </label>
		                    <label class="checkbox-inline padding-left-zero">
		                      <i class="required">*</i>
		                    </label>
		                </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">代理状态：</label>
						<div class="col-sm-2">
							<select class="form-control">
		                        <option value="">代理人名称</option>
		                    </select>
						</div>
						<label class="col-sm-1 control-label text-left padding-left-zero"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">合同日期：</label>
						<div class="col-sm-2">
							<input type="text" class="form-control dateIcon" id="start" placeholder="日期">
						</div>
						<label class="control-label text-center pull-left">-</label>
						<div class="col-sm-2">
							<input type="text" class="form-control dateIcon" id="end" placeholder="日期">
						</div>
						<label class="col-sm-1 control-label text-left padding-left-zero"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label style="margin-top: 5px;" class="col-sm-2 control-label padding-right-zero">客户保护日期：</label>
						<div class="col-sm-7">
							<div class="col-sm-3 padding-left-zero">
								<label class="radio-inline">
			                      <input type="radio" checked="checked" name="endDate" style="margin-top: 10px;"> 按天
			                      <input type="text" class="form-control" style="width: 50%; display: inline-block;" placeholder="时间"> 天
			                    </label>
							</div>
							<div class="col-sm-2 padding-left-zero" style="margin-top: 7px;">
								<label class="radio-inline">
			                      <input type="radio" name="endDate"> 成交为王
			                    </label>
							</div>
							<div class="col-sm-4 padding-left-zero">
								<label class="radio-inline">
			                      <input type="radio" name="endDate" style="margin-top: 10px;"> 别墅
			                      <input type="text" class="form-control" style="width: 80%; display: inline-block;" placeholder="时间">
			                    </label>
							</div>
							<label class="col-sm-1 control-label text-left padding-left-zero"  style="margin-top: 7px;"><i class="required">*</i></label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">代理方式：</label>
						<div class="col-sm-7">
							<div class="col-sm-2 padding-left-zero">
								<label class="radio-inline">
			                      <input type="radio" name="agentMode"> 联通代理
			                    </label>
							</div>
							<div class="col-sm-2 padding-left-zero">
								<label class="radio-inline">
			                      <input type="radio" name="agentMode"> 策划代理
			                    </label>
							</div>
							<div class="col-sm-2 padding-left-zero">
								<label class="radio-inline">
			                      <input type="radio" name="agentMode"> 现场代理
			                    </label>
							</div>
							<label class="col-sm-1 control-label text-left padding-left-zero"><i class="required">*</i></label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">均价：</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" placeholder="12000">
						</div>
						<label class="control-label text-center pull-left">-</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" placeholder="12000">
						</div>
						<label class="control-label text-center pull-left">元/㎡</label>
						<label class="col-sm-1 control-label text-left"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">总价：</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" placeholder="12000">
						</div>
						<label class="control-label text-center pull-left">-</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" placeholder="12000">
						</div>
						<label class="control-label text-center pull-left">万元</label>
						<label class="col-sm-1 control-label text-left"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">首付比例：</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" placeholder="12000">
						</div>
						<label class="control-label text-center pull-left">-</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" placeholder="12000">
						</div>
						<label class="control-label text-center pull-left">%</label>
						<label class="col-sm-1 control-label text-left"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">在售楼盘：</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" placeholder="12000">
						</div>
						<label class="control-label text-center pull-left">套</label>
						<label class="col-sm-1 control-label text-left"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">面积范围：</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" placeholder="12000">
						</div>
						<label class="control-label text-center pull-left">-</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" placeholder="12000">
						</div>
						<label class="control-label text-center pull-left">㎡</label>
						<label class="col-sm-1 control-label text-left"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">项目特色：</label>
						<div class="col-sm-8">
		                	<label class="radio-inline">
		                      <input type="radio" checked="checked"> 真房源
		                    </label>
		                    <label class="radio-inline">
		                      <input type="radio"> 真房源
		                    </label>
		                    <label class="radio-inline">
		                      <input type="radio"> 真房源
		                    </label>
		                    <label class="radio-inline">
		                      <input type="radio"> 真房源
		                    </label>
		                    <label class="radio-inline">
		                      <input type="radio"> 真房源
		                    </label>
		                    <label class="radio-inline">
		                      <input type="radio"> 真房源
		                    </label>
		                    <label class="radio-inline">
		                      <input type="radio"> 真房源
		                    </label>
		                    <label class="radio-inline">
		                      <input type="radio"> 真房源
		                    </label>
		                    <label class="radio-inline">
		                      <input type="radio"> 真房源
		                    </label>
		                    <label class="radio-inline">
		                      <input type="radio"> 真房源
		                    </label>
		                    <label class="radio-inline">
		                      <input type="radio"> 真房源
		                    </label>
		                    <label class="radio-inline">
		                      <input type="radio"> 真房源
		                    </label>
		                    <label class="radio-inline">
		                      <input type="radio"> 真房源
		                    </label>
		                    <label class="radio-inline">
		                      <input type="radio"> 真房源
		                    </label>
		                    <label class="radio-inline control-label text-left padding-left-zero"><i class="required">*</i></label>
		                </div>
		            </div>  
		            <div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">来源：</label>
						<div class="col-sm-9">
		                	<label class="radio-inline">
		                      <input type="radio" name="origin" checked="checked"> 合作
		                    </label>
		                    <label class="radio-inline">
		                      <input type="radio" name="origin"> 真房源
		                    </label>
		                </div>
		            </div>
		            <div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">楼盘标签：</label>
						<div class="col-sm-9">
		                	<label class="radio-inline">
		                      <input type="radio" name="buildingTag" checked="checked"> 热销
		                    </label>
		                    <label class="radio-inline">
		                      <input type="radio" name="buildingTag"> 新盘
		                    </label>
		                </div>
		            </div>
		            <div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">封面图：</label>
						<div class="col-sm-9">
							<div class="col-sm-4">
								<div class="upDataImage upDataFile" id="upDataImage" data-elemShow ="upDataImage" data-upDataUrl="url" data-Type="png/jpg/jpeg" data-fileSize="5" data-fileWidth="1200" data-fileheight="900"></div>
							</div>
							<label class="col-sm-1 control-label text-left padding-left-zero" style="margin-top: 60px;"><i class="required">*</i></label>
							<div class="col-sm-3 fontColor" style="margin-top: 40px;">
								<span>1.图片大小不能超过5M</span><br />
								<span>2.图片必须为jpg或者png格式</span><br />
								<span>3.图片分辨率为1200*900</span>
							</div>
		                </div>
		            </div>
		            <!-- <div class="form-group">
		                         						<label class="col-sm-2 control-label padding-right-zero" style="margin-top: 6px;">连接器：</label>
		                         						<div class="col-sm-9">
		                         							<div>
		                         								<label class="radio-inline" style="width:430px;">
		                         			                      <input type="radio" checked="checked" name="linker" style="margin-top: 10px;"> 720全景
		                         			                      <input type="text" class="form-control" style="width: 340px; display: inline-block; margin-left: 10px;" placeholder="720全景连接">
		                         			                    </label>
		                         			                    <label class="radio-inline control-label text-left padding-left-zero"><i class="required">*</i></label>
		                         							</div>
		                         							<div>
		                         								<label class="radio-inline" style="width:430px;">
		                         			                      <input type="radio" name="linker" style="margin-top: 10px;"> 打折优惠
		                         			                      <input type="text" class="form-control" style="width: 340px; display: inline-block; margin-left: 10px;" placeholder="打折优惠">
		                         			                    </label>
		                         			                    <label class="radio-inline control-label text-left padding-left-zero"><i class="required">*</i></label>
		                         							</div>
		                             </div>
		                         </div>   -->             
				</div>
				<br />
				<div class=" hoMain-body background-white border">
					<div class="row">
						<div class="hoMain-title">
							<a class="addIcon pull-right" data-toggle="modal" data-target="#addPermit"></a>
		                  	<h4>预售许可编辑</h4>
		                </div>
					</div> 
				 	<div class="ho-list table-border-block padding30 clearfix ">
						<div class="table-responsive">
		                    <table class="table table-bordered table-hover">
		                        <thead>
		                            <tr>
		                              <th>序号</th>
		                              <th>栋座</th>
		                              <th>预售许可证编号</th>
		                              <th>到期时间</th>
		                              <th>操作</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                            <tr>
		                              <td>100</td>
		                              <td>20-30%</td>
		                              <td>4-5%</td>
		                              <td>43000</td>
		                              <td>
		                                 <a class="btn">删除</a>
		                                 <a class="btn lookBigImage" data-imageUrl="/Public/Admin/images/daiyan.png">查看</a>
		                              </td>
		                            </tr>
		                            <tr>
			                            <td>100</td>
			                            <td>20-30%</td>
			                            <td>4-5%</td>
			                            <td>43000</td>
			                            <td>
			                                <a class="btn">删除</a>
			                                <a class="btn lookBigImage" data-imageUrl="/Public/Admin/images/daiyan.png">查看</a>
			                            </td>
			                        </tr>
			                        <tr>
			                            <td>100</td>
			                            <td>20-30%</td>
			                            <td>4-5%</td>
			                            <td>43000</td>
			                            <td>
			                                <a class="btn">删除</a>
			                                <a class="btn lookBigImage" data-imageUrl="/Public/Admin/images/daiyan.png">查看</a>
			                            </td>
		                            </tr>
		                        </tbody>
		                    </table>
		                </div>
		            </div>   
				</div>
				<br />
				<div class="row text-center">
					<button type="submit" class="btn btn-blue">保存</button>
				</div>
			</form>
			<div class="lookImage">
				<img src="" alt="图片">
			</div>
			<div class="modal fade" id="addPermit" tabindex="-1" role="dialog">
			  	<div class="modal-dialog" role="document">
				    <div class="modal-content">
					    <div class="modal-header">
					        <button type="button" class="close outline" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h3 class="modal-title">添加预售许可证</h4>
					    </div>
				      	<div class="modal-body">
				    		<form class="form-horizontal">
				    			<div class="form-group">
									<label class="col-sm-3 control-label padding-right-zero"><i class="required">*</i>栋阁名称：</label>
									<div class="col-sm-7">
					                	<input type="text" class="form-control" maxlength="10" minlength="2" placeholder="请输入许可证对应的栋阁">
					                </div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label padding-right-zero"><i class="required">*</i>预售许可证编号：</label>
									<div class="col-sm-7">
					                	<input type="text" class="form-control" placeholder="请输入许可证编号">
					                </div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label padding-right-zero"><i class="required">*</i>到期时间：</label>
									<div class="col-sm-7">
					                	<input type="text" class="form-control dateIcon" id="addPermitDate" placeholder="日期">
					                </div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label padding-right-zero"><i class="required">*</i>许可证图片：</label>
									<div class="col-sm-7">
										<div class="clearfix">
											<div class="pull-left" id="upDataImagesShow"></div>
							                <div class="col-sm-5">
							                	<a class="btn upDataFile" id="" data-elemShow ="upDataImagesShow" data-upDataUrl="url" data-elemStop ="upDataImagesStop" data-elemAnimation ="upDataAnimationBar" data-elemName ="upDataName" data-Type="png/jpg/jpeg" >上传</a>
							                	<p class="fontColor">图片只支持jpg、png格式文件</p>
							                </div>
										</div>
										<div class="clearfix .margin-top-10">
											<div class="clearfix">
												<a class="btn pull-right" id="upDataImagesStop">取消</a>
												<span id="upDataName"></span>
											</div>
						                	
						                	<div class="upDataBar clearfix border">
						                		<div id="upDataAnimationBar"></div>
						                	</div>
						                </div>
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
		</div>
		<input type="file" id="fileImages" style="display: none;">
		<script type="text/javascript" src="/Public/Admin/js/laydate/laydate.js" ></script>
		<script>
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
			var addPermitDate = {
			  elem: '#addPermitDate',
			  format: 'YYYY/MM/DD',
			  min: laydate.now(), //设定最小日期为当前日期
			  max: '2099-06-16', //最大日期
			  istime: true,
			  istoday: false
			};
			laydate(start);
			laydate(end);
			laydate(addPermitDate);
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