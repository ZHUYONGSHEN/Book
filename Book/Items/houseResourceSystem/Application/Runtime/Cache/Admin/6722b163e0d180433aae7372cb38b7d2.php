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
input::-webkit-outer-spin-button,input::-webkit-inner-spin-button{ -webkit-appearance: none !important; }
</style>
<!--主体开始-->
<br>
		<div class="ho-main">
			<div class="background-white border padding30">
    <div class="row">
        <div class="col-sm-4 EditBootstrap">
            <h2><?php echo ($data['name']); ?> <i class="btn btn-green"><?php echo ($data['proxy_status_text']); ?></i></h2>
            <p class="font-color-526a7a margin-top-20">对应楼盘：<?php echo ($data['hname']); ?></p>
        </div>
        <div class="col-sm-8 text-right status">
            <?php if($data['status'] == 0): ?><a class="btn btn-blue margin-top-20 doUpHouse" data-id="<?php echo ($data['id']); ?>">
                    <i class="searchNewIcon"></i>上架
                </a>
            <?php else: ?>
                <a class="btn btn-blue margin-top-20">
                    <i class="searchNewIcon"></i>已上架
                </a><?php endif; ?>
        </div>
    </div>
</div>
<div class="promptBox" style="display:none;"><p class="background-white"></p></div>
<script type="text/javascript">
    // 上架操作
    $('.doUpHouse').click(function(){
        var str = '<a class="btn btn-blue margin-top-20"><i class="searchNewIcon"></i>已上架</a>'
        $.post("<?php echo U('changeHouseStatus');?>", { id: $(this).attr('data-id'), type: 1 }, function(res) {
            if (res.status == 1) {
                promptBoxHidden('上架成功')
                $('.status').html(str)
            }else{
                promptBoxHidden('操作失败')
            }
        });
    })
</script>
			<br/>
			<form class="form-horizontal" id="editForm">
				<input type="hidden" name="id" value="<?php echo ($data['id']); ?>">
				<div class=" hoMain-body background-white border EditBootstrap">
					<div class="row">
						<div class="hoMain-title">
		                  <h3>项目信息编辑</h3>
		                </div>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1" class="col-sm-2 control-label padding-right-zero">项目名称：</label>
						<div class="col-sm-7">
		                	<input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="请选择当前项目所属楼盘" value="<?php echo ($data['name']); ?>">
		                </div>
		                <label class="col-sm-1 control-label text-left padding-left-zero"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail2" class="col-sm-2 control-label padding-right-zero">推广名称：</label>
						<div class="col-sm-7">
		                	<input type="text" class="form-control" name="market_name" id="exampleInputEmail2" placeholder="推广名称" value="<?php echo ($data['market_name']); ?>">
		                </div>
		                <label class="col-sm-1 control-label text-left padding-left-zero"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">物业类型：</label>
						<div class="col-sm-9">
							<?php if(is_array($property)): $key = 0; $__LIST__ = $property;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><label class="checkbox-inline">
								<?php if(in_array($vo['id'],$data['property_ids'])): ?><input type="checkbox" checked name="property_ids[]" value="<?php echo ($vo["id"]); ?>"> <?php echo ($vo["name"]); ?>
							    <?php else: ?>
							      	<input type="checkbox" name="property_ids[]" value="<?php echo ($vo["id"]); ?>"> <?php echo ($vo["name"]); endif; ?>
							    </label><?php endforeach; endif; else: echo "" ;endif; ?>
		                    <label class="checkbox-inline padding-left-zero"><i class="required">*</i></label>
		                </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">代理状态：</label>
						<div class="col-sm-2">
							<select class="form-control" name="proxy_status">
	                            <option value="" style="display:none">请选择代理状态</option>
	                            <option value="1" <?php if($data['proxy_status'] == 1): ?>selected<?php endif; ?> >代理中</option>
	                            <option value="0" <?php if($data['proxy_status'] == 0): ?>selected<?php endif; ?> >已完结</option>
	                            <option value="2" <?php if($data['proxy_status'] == 2): ?>selected<?php endif; ?> >已中止</option>
		                    </select>
						</div>
						<label class="col-sm-1 control-label text-left padding-left-zero"><i class="required">*</i></label>
					</div>
	                <div class="form-group">
	                    <label class="col-sm-2 control-label padding-right-zero">开盘时间：</label>
	                    <div class="col-sm-2">
	                        <input type="text" name="open_date" class="form-control dateIcon dateTime" id="open_date" placeholder="开盘日期" value="<?php echo ($data['open_date']); ?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="col-sm-2 control-label padding-right-zero">入住时间：</label>
	                    <div class="col-sm-2">
	                        <input type="text" name="checkin_date" class="form-control dateIcon dateTime" id="checkin_date" placeholder="入住日期" value="<?php echo ($data['checkin_date']); ?>">
	                    </div>
	                </div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">合同日期：</label>
						<div class="col-sm-2">
							<input type="text" name="contract_start" class="form-control dateIcon" id="start" placeholder="日期" value="<?php echo ($data['contract_start']); ?>">
						</div>
						<label class="control-label text-center pull-left">-</label>
						<div class="col-sm-2">
							<input type="text" name="contract_end" class="form-control dateIcon" id="end" placeholder="日期" value="<?php echo ($data['contract_end']); ?>">
						</div>
						<label class="col-sm-1 control-label text-left padding-left-zero"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">代理方式：</label>
						<div class="col-sm-7">
							<div class="col-sm-2 padding-left-zero">
								<label class="radio-inline">
			                      <input type="radio" name="proxy_mod" value="0" <?php if($data['proxy_mod'] == 0): ?>checked<?php endif; ?> > 联通代理
			                    </label>
							</div>
							<div class="col-sm-2 padding-left-zero">
								<label class="radio-inline">
			                      <input type="radio" name="proxy_mod" value="1" <?php if($data['proxy_mod'] == 1): ?>checked<?php endif; ?> > 策划代理
			                    </label>
							</div>
							<div class="col-sm-2 padding-left-zero">
								<label class="radio-inline">
			                      <input type="radio" name="proxy_mod" value="2" <?php if($data['proxy_mod'] == 2): ?>checked<?php endif; ?> > 现场代理
			                    </label>
							</div>
							<label class="col-sm-1 control-label text-left padding-left-zero"><i class="required">*</i></label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">均价：</label>
						<div class="col-sm-2">
							<input type="number" name="average_min" data-length="6" class="form-control" placeholder="12000" value="<?php echo ($data['average_min']); ?>" maxlength="6">
						</div>
						<label class="control-label text-center pull-left">-</label>
						<div class="col-sm-2">
							<input type="number" name="average_max" data-length="6" class="form-control" placeholder="12000" value="<?php echo ($data['average_max']); ?>" maxlength="6">
						</div>
						<label class="control-label text-center pull-left">元/㎡</label>
						<label class="col-sm-1 control-label text-left"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">总价：</label>
						<div class="col-sm-2">
							<input type="number" name="total_min" data-length="6" class="form-control" placeholder="12000" value="<?php echo ($data['total_min']); ?>" maxlength="9">
						</div>
						<label class="control-label text-center pull-left">-</label>
						<div class="col-sm-2">
							<input type="number" name="total_max" data-length="6" class="form-control" placeholder="12000" value="<?php echo ($data['total_max']); ?>" maxlength="9">
						</div>
						<label class="control-label text-center pull-left">万元</label>
						<label class="col-sm-1 control-label text-left"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">首付比例：</label>
						<div class="col-sm-2">
							<input type="number"name="pay_min" data-type="float" data-length="5" class="form-control" placeholder="12000" value="<?php echo ($data['pay_min']); ?>" maxlength="5">
						</div>
						<label class="control-label text-center pull-left">-</label>
						<div class="col-sm-2">
							<input type="number"name="pay_max" data-type="float" data-length="5" class="form-control" placeholder="12000" value="<?php echo ($data['pay_max']); ?>" maxlength="5">
						</div>
						<label class="control-label text-center pull-left">%</label>
						<label class="col-sm-1 control-label text-left"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">在售楼盘：</label>
						<div class="col-sm-2">
							<input type="number" name="sale_total" data-length="6" class="form-control" placeholder="12000" value="<?php echo ($data['sale_total']); ?>" maxlength="6">
						</div>
						<label class="control-label text-center pull-left">套</label>
						<label class="col-sm-1 control-label text-left"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">面积范围：</label>
						<div class="col-sm-2">
							<input type="number" name="area_min" data-length="6" class="form-control" placeholder="12000" value="<?php echo ($data['area_min']); ?>">
						</div>
						<label class="control-label text-center pull-left">-</label>
						<div class="col-sm-2">
							<input type="number" name="area_max" data-length="6" class="form-control" placeholder="12000" value="<?php echo ($data['area_max']); ?>">
						</div>
						<label class="control-label text-center pull-left">㎡</label>
						<label class="col-sm-1 control-label text-left"><i class="required">*</i></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">项目特色：</label>
						<div class="col-sm-8">
		                	<?php if(is_array($project)): $i = 0; $__LIST__ = $project;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox-inline">
								<?php if(in_array($vo['id'],$data['project_ids'])): ?><input type="checkbox" checked name="project_ids[]" value="<?php echo ($vo["id"]); ?>"> <?php echo ($vo["name"]); ?>
							    <?php else: ?>
							      	<input type="checkbox" name="project_ids[]" value="<?php echo ($vo["id"]); ?>"> <?php echo ($vo["name"]); endif; ?>
		                	    </label><?php endforeach; endif; else: echo "" ;endif; ?>
		                    <label class="radio-inline control-label text-left padding-left-zero"><i class="required">*</i></label>
		                </div>
		            </div>
		            <div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">来源：</label>
						<div class="col-sm-9">
		                	<label class="radio-inline">
		                      	<input type="radio" name="source" value="1" <?php if($data['source'] == 1): ?>checked<?php endif; ?> > 合作
		                    </label>
		                    <label class="radio-inline">
		                      	<input type="radio" name="source" value="0" <?php if($data['source'] == 0): ?>checked<?php endif; ?> > 采集
		                    </label>
		                </div>
		            </div>
		            <div class="form-group">
						<label class="col-sm-2 control-label padding-right-zero">楼盘标签：</label>
						<div class="col-sm-9">
		                	<label class="checkbox-inline">
	                      		<input type="checkbox" name="house_tag[]" value="0" <?php if(in_array(0,$data['house_tag'])): ?>checked<?php endif; ?> > 热销
		                    </label>
		                    <label class="checkbox-inline">
	                      		<input type="checkbox" name="house_tag[]" value="1" <?php if(in_array(1,$data['house_tag'])): ?>checked<?php endif; ?> > 新盘
		                    </label>
		                </div>
		            </div>
		            <div class="form-group">
                    	<input type="hidden" name="cover_path" value="<?php echo ($data["cover_path"]); ?>">
						<label class="col-sm-2 control-label padding-right-zero">封面图：</label>
						<div class="col-sm-9">
							<div class="col-sm-4">
								<div class="upDataImage upDataFile" id="upDataImage" data-elemShow ="upDataImage" data-upDataUrl="<?php echo U('Dictionary/ImgUpload');?>" data-Type="png/jpg/jpeg" data-fileSize="5" data-fileWidth="1200" data-fileheight="900" style="background-image:url(<?php echo ($data['show_path']); ?>)"></div>
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
									<input type="radio" name="link_type" value="1" style="margin-top: 10px;" <?php if($data['link_type'] == 1 || empty($data['link_type'])): ?>checked<?php endif; ?> > 720全景
									<input type="text" name="link_720" class="form-control" style="width: 340px; display: inline-block; margin-left: 10px;" placeholder="720全景连接" <?php if($data['link_type'] == 1): ?>value="<?php echo ($data['link_url']); ?>"<?php endif; ?> >
								</label>
								<label class="radio-inline control-label text-left padding-left-zero"><i class="required">*</i></label>
							</div>
							<div>
								<label class="radio-inline" style="width:430px;">
									<input type="radio" name="link_type" value="2" style="margin-top: 10px;" <?php if($data['link_type'] == 2): ?>checked<?php endif; ?> > 腾讯街景
									<input type="text" name="link_tencent" class="form-control" style="width: 340px; display: inline-block; margin-left: 10px;" placeholder="腾讯街景" <?php if($data['link_type'] == 2): ?>value="<?php echo ($data['link_url']); ?>"<?php endif; ?> >
								</label>
								<label class="radio-inline control-label text-left padding-left-zero"><i class="required">*</i></label>
							</div>
						</div>
					</div> -->
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
		                    <table class="table table-bordered table-hover licence_table">
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
			                        <?php if(is_array($data['licence'])): $i = 0; $__LIST__ = $data['licence'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			                        	  <td><?php echo ($vo["id"]); ?></td>
			                        	  <td><?php echo ($vo["name"]); ?></td>
			                        	  <td><?php echo ($vo["licence_num"]); ?></td>
			                        	  <td><?php echo ($vo["licence_time"]); ?></td>
			                        	  <td>
			                        	     <a class="btn delLicence" data-id="<?php echo ($vo["id"]); ?>">删除</a>
			                        	     <a class="btn lookBigImage" data-imageUrl="<?php echo ($vo["licence_path"]); ?>">查看</a>
			                        	  </td>
			                        	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		                        </tbody>
		                    </table>
		                </div>
		            </div>
				</div>
				<br />
				<div class="row text-center">
					<span class="btn btn-blue" id="submit">保存</span>
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
				    		<form class="form-horizontal" id="licenceForm">
				    			<input type="hidden" name="loupan_id" value="<?php echo ($data["id"]); ?>">
				    			<div class="form-group">
									<label class="col-sm-3 control-label padding-right-zero"><i class="required">*</i>栋阁名称：</label>
									<div class="col-sm-7">
					                	<input type="text" name="name" value="" class="form-control" maxlength="10" minlength="2" placeholder="请输入许可证对应的栋阁">
					                </div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label padding-right-zero"><i class="required">*</i>预售许可证编号：</label>
									<div class="col-sm-7">
					                	<input type="text" name="licence_num" value="" class="form-control" placeholder="请输入许可证编号" maxlength="30">
					                </div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label padding-right-zero"><i class="required">*</i>到期时间：</label>
									<div class="col-sm-7">
					                	<input type="text" name="licence_time" value="" class="form-control dateIcon" id="addPermitDate" placeholder="日期">
					                </div>
								</div>
								<div class="form-group">
                    				<input type="hidden" name="licence_path" value="">
									<label class="col-sm-3 control-label padding-right-zero"><i class="required">*</i>许可证图片：</label>
									<div class="col-sm-7">
										<div class="clearfix">
											<div class="pull-left" id="upDataImagesShow"></div>
							                <div class="col-sm-5">
							                	<a class="btn upDataFile" id="" data-elemShow ="upDataImagesShow" data-upDataUrl="<?php echo U('Dictionary/ImgUpload');?>" data-elemStop ="upDataImagesStop" data-elemAnimation ="upDataAnimationBar" data-elemName ="upDataName" data-Type="png/jpg/jpeg" >上传</a>
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
				      			<button type="button" id="addLicence" class="btn btn-blue outline">保存</button>
					        	<button type="button" id="miss" class="btn btn-default outline" data-dismiss="modal">取消</button>
				      		</div>
				      	</div>
				    </div>
				 </div>
			</div>
		</div>
		<input type="file" id="fileImages" style="display: none;">
		<script type="text/javascript" src="/Public/Admin/js/laydate/laydate.js" ></script>
		<script type="text/javascript">
			// 修改项目内容
			$('#submit').click(function() {
				var data = $('#editForm').serialize()
				$.post("<?php echo U('doEditNewItem');?>", data, function(res){
				    if (res.status == 0) {
				        promptBoxHidden(res.info)
				    }else{
				        promptBoxHidden('修改成功')
				        setTimeout(function(){ window.location.href="<?php echo U('detail',array('id' => $data['id']));?>" }, 1100)
				    }
				})
			})
			// 提交预售与可证
			$('#addLicence').click(function() {
				var data = $('#licenceForm').serialize()
				$.post("<?php echo U('addLicence');?>", data, function(res){
					var msg = res.data;
					var str  = '<tr>'
			            str += '<td>'+ msg.id +'</td>'
			            str += '<td>'+ msg.name +'</td>'
			            str += '<td>'+ msg.licence_num +'</td>'
			            str += '<td>'+ msg.licence_time +'</td>'
			            str += '<td><a class="btn delLicence" data-id="'+ msg.id +'">删除</a><a class="btn lookBigImage" data-imageurl="'+ msg.licence_path +'">查看</a></td>'
			            str += '</tr>'
				    if (res.status == 0) {
				        promptBoxHidden(res.info)
				    }else{
				        promptBoxHidden('添加成功')
				        $('.licence_table').find('tbody').append(str)
				        $('#upDataImagesShow,#upDataAnimationBar').attr('style', '');
				        $('#licenceForm').find('input[type="text"]').val('');
				        $('#upDataName').html('')
				        $('#miss').click();
				    }
				});
			});
			// 删除预售许可证
			$('body').on('click', '.delLicence', function() {
				var that = $(this)
				var id = that.attr('data-id');
				$.post("<?php echo U('delLicence');?>", {id: id}, function(res){
					if (res.status == 0) {
					    promptBoxHidden(res.info)
					}else{
					    promptBoxHidden(res.info)
					    that.parent().parent('tr').remove()
					}
				});
			});
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
			laydate(addPermitDate);
			laydate(open_date);
			laydate(checkin_date);
			var fileId = document.getElementById("fileImages")//change执行事件目标
				imgageType = "",//文件类型
				imgageSize = "",//文件大小
				imageWidth = "",//宽
				imageHeight = "",//高
				request= "";//终止ajax上传变量
		    fileId.addEventListener("change",upLoadImage,false );
		        function upLoadImage() {
		        	var data = this.files[0];
	                var fd   = new FormData();
	                    fd.append("file", data);
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
										request.abort();
									}
								}
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
				                            	switch (upDataElemShowId){
				                            		case 'upDataImage':
				                            			$('input[name=cover_path]').val(result.imgPath);
				                            			break;
				                            		case 'upDataImagesShow':
				                            			$('input[name=licence_path]').val(result.imgPath);
				                            			break;
			                            			default:
			                            				break;
				                            	}
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
					$('body').on('click', '.lookBigImage', function() {
						var imageUrl = $(this).attr('data-imageUrl');
						$('.lookImage').fadeIn();
						$('.lookImage img').attr('src', imageUrl);
					});
					$('body').on('click', '.lookImage', function() {
						$(this).fadeOut();
					});
				})
		</script>
	</body>
</html>