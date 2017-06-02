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
<!-- <link href="/Public/Admin/css/mobiscroll.core-2.5.2.css" rel="stylesheet" type="text/css">
<link href="/Public/Admin/css/mobiscroll.android-ics-2.5.2.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/Public/Admin/js/mobiscroll.core-2.5.2.js" ></script>
<script type="text/javascript" src="/Public/Admin/js/mobiscroll.datetime-2.5.1.js" ></script> -->
<!--主体开始-->
	<div class="ho-main">
		<br />
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
		<br />
		<div class="background-white border">
			<div class="tableTitle border-bottom">
				<a href="<?php echo U('NewHouse/detail', array('id' => $data['id']));?>" class="active">项目信息</a>
				<a href="<?php echo U('HouseType/index', array('id' => $data['id']));?>">户型管理</a>
				<a href="<?php echo U('operationLog', array('id' => $data['id']));?>">操作记录</a>
			</div>
			<div class="tableBody">
				<div class="row">
					<div class="col-sm-8">
						<div class="hoMain-body border">
							<div class="row">
								<div class="hoMain-title">
									<a href="<?php echo U('editNewItem', array('id' => $data['id']));?>" class="pull-right editIcon"></a>
				                  	<h4>项目信息</h4>
				                </div>
							</div>
							<div class="itemMessages EditBootstrap" data-module="editItemMessages">
						        <div class="itemMessages-body clearfix">
						        	<div class="col-sm-6">
							        	<div class="form-group clearfix">
							                <label class="col-sm-4 control-label text-right padding-right-zero"> 均价：</label>
							                <div class="col-sm-8 control-label"> <?php echo ($data["average_min"]); ?>~<?php echo ($data["average_max"]); ?>元/m²</div>
							             </div>
							             <div class="form-group clearfix">
							                <label class="col-sm-4 control-label text-right padding-right-zero"> 客户保护期：</label>
							                <div class="col-sm-8 control-label"> 无</div>
							             </div>
							             <div class="form-group clearfix">
							                <label class="col-sm-4 control-label text-right padding-right-zero"> 物业类型：</label>
							                <div class="col-sm-8 control-label"> <?php echo ($data["property_text"]); ?></div>
							             </div>
							             <div class="form-group clearfix">
							                <label class="col-sm-4 control-label text-right padding-right-zero"> 合同期限：</label>
							                <div class="col-sm-8 control-label"> <?php echo ($data["contract_start"]); ?> 至 <?php echo ($data["contract_end"]); ?></div>
							             </div>
							             <div class="form-group clearfix">
							                <label class="col-sm-4 control-label text-right padding-right-zero"> 入住时间：</label>
							                <div class="col-sm-8 control-label"> <?php echo ($data["checkin_date"]); ?></div>
							             </div>
							             <div class="form-group clearfix">
							                <label class="col-sm-4 control-label text-right padding-right-zero"> 楼盘特色：</label>
							                <div class="col-sm-8 control-label">
												<?php if(is_array($data["project_feature"])): $i = 0; $__LIST__ = $data["project_feature"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pf): $mod = ($i % 2 );++$i;?><button class="btn btn-default"><?php echo ($pf); ?></button><?php endforeach; endif; else: echo "" ;endif; ?>
							                </div>
							             </div>
							             <div class="form-group clearfix">
							                <label class="col-sm-4 control-label text-right padding-right-zero"> 来源：</label>
							                <div class="col-sm-8 control-label"> <?php echo ($data["source"]); ?></div>
							             </div>
							             <div class="form-group clearfix">
							                <label class="col-sm-4 control-label text-right padding-right-zero"> 封面图：</label>
							                <div class="col-sm-8 control-label">
							                	<img src="<?php echo ($data["cover_path"]); ?>" style="width: 135px; height: 80px;" alt="图片">
							                </div>
							             </div>
						        	</div>
						        	<div class="col-sm-6">
							        	<div class="form-group clearfix">
							                <label class="col-sm-4 control-label text-right padding-right-zero"> 总价范围：</label>
							                <div class="col-sm-8 control-label"> <?php echo ($data["total_min"]); ?>万元~<?php echo ($data["total_max"]); ?>万元</div>
							             </div>
							             <div class="form-group clearfix">
							                <label class="col-sm-4 control-label text-right padding-right-zero"> 在售盘量：</label>
							                <div class="col-sm-8 control-label"> <?php echo ($data["sale_total"]); ?>套</div>
							             </div>
							             <div class="form-group clearfix">
							                <label class="col-sm-4 control-label text-right padding-right-zero"> 面积范围：</label>
							                <div class="col-sm-8 control-label"> <?php echo ($data['area_min']); ?>-<?php echo ($data['area_max']); ?>m²</div>
							             </div>
							             <div class="form-group clearfix">
							                <label class="col-sm-4 control-label text-right padding-right-zero"> 开盘日期：</label>
							                <div class="col-sm-8 control-label"> <?php echo ($data["open_date"]); ?></div>
							             </div>
							             <div class="form-group clearfix">
							                <label class="col-sm-4 control-label text-right padding-right-zero"> 连接器：</label>
							                <div class="col-sm-8 control-label">
												<?php switch($data["link_type"]): case "1": ?>720全景 <a href="<?php echo ($data["link_url"]); ?>">查看</a> <span>复制链接</span><?php break;?>
													<?php case "2": ?>腾讯街景 <a href="<?php echo ($data["link_url"]); ?>">查看</a> <span>复制链接</span><?php break;?>
													<?php default: ?>无<?php endswitch;?>
											</div>
							             </div>
							             <div class="form-group clearfix">
							                <label class="col-sm-4 control-label text-right padding-right-zero"> 楼盘标签：</label>
							                <div class="col-sm-8 control-label">
												<?php if(is_array($data["house_tag"])): $i = 0; $__LIST__ = $data["house_tag"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ht): $mod = ($i % 2 );++$i;?><button class="btn btn-default"><?php echo ($ht); ?></button><?php endforeach; endif; else: echo "" ;endif; ?>
							                </div>
							             </div>
							             <div class="form-group clearfix">
							                <label class="col-sm-4 control-label text-right padding-right-zero"> 预售许可证：</label>
							                <div class="col-sm-8 control-label">
							                	<ul>
													<?php if(is_array($data["licences"])): $i = 0; $__LIST__ = $data["licences"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lc): $mod = ($i % 2 );++$i;?><li class="lookBigImage" data-imageUrl="<?php echo ($lc["licence_path"]); ?>"><?php echo ($lc["licence_num"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
							                	</ul>
							                </div>
							             </div>
						        	</div>
						        </div>
							</div>
						</div>
						<br />
					    <div class="itemMessages">
					    	<div class="hoMain-body border tab">
								<div class="row">
									<div class="hoMain-title">
										<a class="pull-right addIcon BombElem"></a>
					                  	<h4 class="display-inlineBlock margin-right-15 tabController" data-title="新增佣金信息" data-module ="editYongJinMessages">佣金信息</h4>
					                  	<h4 class="display-inlineBlock act tabController" data-title="新增结佣信息" data-module="editJieYongMessages">结佣条件</h4>
					                </div>
								</div>
								<div class="tabMain">
									<div data-module ="editYongJinMessages">
										<div class="table-responsive">
						                    <table class="table table-bordered table-hover">
						                        <thead>
						                            <tr class="active">
						                              <th>序号</th>
						                              <th>物业类型</th>
						                              <th>户型</th>
						                              <th>佣金计算规则</th>
						                              <th>备注</th>
						                              <th>操作</th>
						                            </tr>
						                        </thead>
						                        <tbody>
													<?php if(is_array($commisions)): $i = 0; $__LIST__ = $commisions;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><tr>
															<td><?php echo ($c["index"]); ?></td>
															<td><?php echo ($c["property"]); ?></td>
															<td><?php echo ($c["huxings"]); ?></td>
															<td><?php echo ($c["rule"]); ?></td>
															<td><?php echo ($c["remark"]); ?></td>
															<td>
																<a data-id=<?php echo ($c["id"]); ?> data-url="<?php echo U('Commision/editComm', array('id' => $c['id']));?>" class="btn editMessages" data-title="编辑佣金信息">编辑</a>
																<a data-id=<?php echo ($c["id"]); ?> data-url="<?php echo U('Commision/delComm', array('id' => $c['id']));?>" class="btn delMessage">删除</a>
															</td>
														</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						                        </tbody>
						                    </table>
						                </div>
						                <div class="ho-row padding0">
						                    <div class="row">
						                        <div class="col-sm-4" style="line-height: 35px;">共 <?php echo ($commision_total_num); ?> 条记录</div>
						                        <div class="col-sm-8 text-right">
						                            <ul class="pagination" style="margin-bottom: 0; margin-top: 0;">
						                                <li class='prevpage'>
						                                  <a href="#" aria-label="Previous">
						                                    <span aria-hidden="true">上一页</span>
						                                  </a>
						                                </li>
														<?php
 for ($i = 1; $i <= ceil($commision_total_num/2); $i++) { if ($i == 1) { ?>
																	<li class="active"><a data-module="editYongJinMessages" data-action='getCommisions' data-modify='editComm' data-del='delComm' href="#">1</a></li>
														<?php
 } else { ?>
																	<li><a data-module="editYongJinMessages" data-action='getCommisions' data-modify='editComm' data-del='delComm' href="#"><?php echo $i; ?></a></li>
														<?php
 } } ?>
						                                <li class='nextpage'>
						                                  <a href="#" aria-label="Next">
						                                    <span aria-hidden="true">下一页</span>
						                                  </a>
						                                </li>
						                            </ul>
						                            <div class="input-group" style="width: 120px; display: inline-table;">
						                                <input type="text" name="" class="form-control">
						                                <span class="input-group-btn"><button class="btn btn-primary btn-paging-jump" type="button">跳转</button></span>
						                            </div>
						                        </div>
						                    </div>
						                </div>
									</div>
									<div data-module ="editJieYongMessages">
										<div class="table-responsive">
						                    <table class="table table-bordered table-hover">
						                        <thead>
						                            <tr class="active">
						                              <th>物业类型</th>
						                              <th>结算方式</th>
						                              <th>结佣节点</th>
						                              <th>结算金额比例</th>
						                              <th>成交后办理日</th>
						                              <th>对账后回款日</th>
						                              <th>操作</th>
						                            </tr>
						                        </thead>
						                        <tbody>
													<?php if(is_array($jieyongs)): $i = 0; $__LIST__ = $jieyongs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jy): $mod = ($i % 2 );++$i;?><tr>
															<td><?php echo ($jy["property_type"]); ?></td>
															<td><?php echo ($jy["jieyong_text"]); ?></td>
															<td><?php echo ($jy["point_text"]); ?></td>
															<td><?php echo ($jy["count_price"]); ?>(<?php echo ($jy["count_text"]); ?>)</td>
															<td><?php echo ($jy["apply_day"]); ?>天</td>
															<td><?php echo ($jy["return_day"]); ?>天</td>
															<td>
																<a data-id=<?php echo ($jy["id"]); ?> data-url="<?php echo U('Commision/editJieyong', array('id' => $jy['id']));?>" class="btn editMessages" data-title="编辑佣金信息">编辑</a>
																<a data-id=<?php echo ($jy["id"]); ?> data-url="<?php echo U('Commision/delJieyong', array('id' => $jy['id']));?>" class="btn delMessage">删除</a>
															</td>
														</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						                        </tbody>
						                    </table>
						                </div>
						                <div class="ho-row padding0">
						                    <div class="row">
						                        <div class="col-sm-4" style="line-height: 35px;">共 <?php echo ($jieyong_total_num); ?> 条记录</div>
						                        <div class="col-sm-8 text-right">
						                            <ul class="pagination" style="margin-bottom: 0; margin-top: 0;">
						                                <li class='prevpage'>
						                                  <a href="#" aria-label="Previous">
						                                    <span aria-hidden="true">上一页</span>
						                                  </a>
						                                </li>
														<?php
 for ($i = 1; $i <= ceil($jieyong_total_num/2); $i++) { if ($i == 1) { ?>
																	<li class="active"><a data-module="editJieYongMessages" data-action='getJieYongs' data-modify='editJieyong' data-del='delJieyong' href="#">1</a></li>
														<?php
 } else { ?>
																	<li><a data-module="editJieYongMessages" data-action='getJieYongs' data-modify='editJieyong' data-del='delJieyong' href="#"><?php echo $i; ?></a></li>
														<?php
 } } ?>
						                                <li class='nextpage'>
						                                  <a href="#" aria-label="Next">
						                                    <span aria-hidden="true">下一页</span>
						                                  </a>
						                                </li>
						                            </ul>
						                            <div class="input-group" style="width: 120px; display: inline-table;">
						                                <input type="text" name="" class="form-control">
						                                <span class="input-group-btn"><button class="btn btn-primary btn-paging-jump" type="button">跳转</button></span>
						                            </div>
						                        </div>
						                    </div>
						                </div>
									</div>
								</div>
							</div>
					    </div>
					    <br />
					    <div class="floorMessages">
					    	<div class="hoMain-body border">
								<div class="row">
									<div class="hoMain-title">
										<a href="<?php echo U('Dictionary/edit', array('id' => $data['hid']));?>" class="pull-right editIcon"></a>
					                  	<h4>楼盘信息</h4>
					                </div>
								</div>
								<div class="itemMessages EditBootstrap">
							        <div class="clearfix">
							        	<div class="row">
							        	<div class="col-sm-6">
								        	<div class="form-group clearfix">
								                <label class="col-sm-4 control-label text-right padding-right-zero"> 规划户数：</label>
								                <div class="col-sm-8 control-label"> <?php echo ($data["household_num"]); ?>户</div>
								             </div>
								             <div class="form-group clearfix">
								                <label class="col-sm-4 control-label text-right padding-right-zero"> 绿 化 率：</label>
								                <div class="col-sm-8 control-label"> <?php echo ($data["green_rate"]); ?>%</div>
								             </div>
								             <div class="form-group clearfix">
								                <label class="col-sm-4 control-label text-right padding-right-zero"> 容 积 率：</label>
								                <div class="col-sm-8 control-label"> <?php echo ($data["plot_rate"]); ?>%</div>
								             </div>
								             <div class="form-group clearfix">
								                <label class="col-sm-4 control-label text-right padding-right-zero"> 建筑面积：</label>
								                <div class="col-sm-8 control-label"> <?php echo ($data["build_area"]); ?>m²</div>
								             </div>
								             <div class="form-group clearfix">
								                <label class="col-sm-4 control-label text-right padding-right-zero"> 物业公司：</label>
								                <div class="col-sm-8 control-label padding-right-zero"> <?php echo ($data["management"]); ?></div>
								             </div>
								             <div class="form-group clearfix">
								                <label class="col-sm-4 control-label text-right padding-right-zero"> 建筑类型：</label>
								                <div class="col-sm-8 control-label"><?php echo ($data["build_type_text"]); ?></div>
								             </div>
							        	</div>
							        	<div class="col-sm-6">
								        	<div class="form-group clearfix">
								                <label class="col-sm-4 control-label text-right padding-right-zero"> 停 车 位：</label>
								                <div class="col-sm-8 control-label"> <?php echo ($data["car_num"]); ?>个</div>
								             </div>
								             <div class="form-group clearfix">
								                <label class="col-sm-4 control-label text-right padding-right-zero"> 产 权：</label>
								                <div class="col-sm-8 control-label"> 无</div>
								             </div>
								             <div class="form-group clearfix">
								                <label class="col-sm-4 control-label text-right padding-right-zero"> 物业费用：</label>
								                <div class="col-sm-8 control-label"> <?php echo ($data["management_price"]); ?>元/㎡</div>
								             </div>
								             <div class="form-group clearfix">
								                <label class="col-sm-4 control-label text-right padding-right-zero"> 占地面积：</label>
								                <div class="col-sm-8 control-label"> 无</div>
								             </div>
								             <div class="form-group clearfix">
								                <label class="col-sm-4 control-label text-right padding-right-zero"> 开 发 商：</label>
								                <div class="col-sm-8 control-label"> <?php echo ($data["developer"]); ?></div>
								             </div>
								             <div class="form-group clearfix">
								                <label class="col-sm-4 control-label text-right padding-right-zero"> 装修：</label>
								                <div class="col-sm-8 control-label"> 无</div>
								             </div>
							        	</div>
							        	</div>
							        	<div class="row">

								        	<div class="col-sm-12">
								        		<div class="form-group clearfix">
									                <label class="col-sm-2 control-label text-right padding-right-zero" style="width: 15.9%"> 楼盘地址：</label>
									                <div class="col-sm-8 control-label"> <?php echo ($data["address"]); ?></div>
									             </div>
									             <div class="form-group clearfix">
									                <label class="col-sm-2 control-label text-right padding-right-zero" style="width: 15.9%"> 项目简介：</label>
									                <div class="col-sm-10 control-label"> <?php echo ($data["build_content"]); ?></div>
									             </div>
								        	</div>
							        	</div>
							        </div>
								</div>
							</div>
					    </div>
					    <br />
					    <div class="sellHouseMessages">
					    	<div class="hoMain-body border">
								<div class="row">
									<div class="hoMain-title">
										<a href="<?php echo U('HouseType/index');?>?id=<?php echo ($data["id"]); ?>" class="pull-right editIcon"></a>
					                  	<h4>在售户型<span>(<?php echo ($count["count"]); ?>个)</span></h4>
					                </div>
								</div>
								<div class="itemMessages EditBootstrap" data-module="editItemMessages">
									<?php if(is_array($huxings)): $i = 0; $__LIST__ = $huxings;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="border-bottom padding-bottom-10 margin-bottom-10">
						        			<div class="row">
						        				<div class="col-sm-3">
						        					<img src="<?php echo ($vo["house_path"]); ?>" style="width: 150px; height: 80px;" alt="图片">
						        				</div>
						        				<div class="col-sm-5">
						        					<h4><?php echo ($vo["name"]); ?> <?php echo ($vo["room_count"]); ?>室<?php echo ($vo["hall_count"]); ?>厅<?php echo ($vo["toilet_count"]); ?>卫</h4>
						        					<p><?php echo ($vo["build_area"]); ?>㎡</p>
						        				</div>
						        				<div class="col-sm-3">
						        					<p>均价<span class="font-color-fd1933"><?php echo ($vo["average_price"]); ?>/㎡</span></p>
						        				</div>
						        			</div>
								    	</div><?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
					    </div>
					</div>
					<div class="col-sm-4">
						<div class="hoMain-body border">
							<div class="row">
								<div class="hoMain-title">
									<a class="pull-right editIcon BombElem" data-module="editReportMessages"></a>
				                  	<h4>报备参数</h4>
				                </div>
							</div>
							<div class="itemMessages" data-module="editReportMessages">
						        <div class="clearfix">
						        	<!--<div class="form-group clearfix">
						                <label class="col-sm-5 control-label text-right"> 报备保护期：</label>
						                <div class="col-sm-7 control-label" style="padding-left:0;"> 2天</div>
						            </div>-->
						            <div class="form-group clearfix">
						                <label class="col-sm-5 control-label text-right"> 报备细则：</label>
						                <div class="col-sm-7 control-label padding-left-zero"> <?php echo ($data["report_rule"]); ?></div>
						             </div>
						             <!--<div class="form-group clearfix">
						                <label class="col-sm-5 control-label text-right"> 客户保护期：</label>
						                <div class="col-sm-7 control-label" style="padding-left:0;">3天</div>
						             </div>-->
						             <div class="form-group clearfix">
						                <label class="col-sm-5 control-label text-right"> 带看细则：</label>
						                <div class="col-sm-7 control-label" style="padding-left:0;"> <?php echo ($data["see_rule"]); ?></div>
						             </div>
						             <!--<div class="form-group clearfix">
						                <label class="col-sm-5 control-label text-right"> 自动接客：</label>
						                <div class="col-sm-7 control-label" style="padding-left:0;"> 是</div>
						             </div>
						             <div class="form-group clearfix">
						                <label class="col-sm-5 control-label text-right"> 报备方式：</label>
						                <div class="col-sm-7 control-label" style="padding-left:0;"> 全号报备</div>
						             </div>
						             <div class="form-group clearfix">
						                <label class="col-sm-5 control-label text-right" style="padding-left: 0;"> 提前报备时间：</label>
						                <div class="col-sm-7 control-label" style="padding-left:0;"> 60分钟</div>
						             </div>
						             <div class="form-group clearfix">
						                <label class="col-sm-5 control-label text-right"> 成交保护期：</label>
						                <div class="col-sm-7 control-label" style="padding-left:0;"> 无</div>
						             </div>
						             <div class="form-group clearfix">
						                <label class="col-sm-5 control-label text-right"> 短信验证：</label>
						                <div class="col-sm-7 control-label" style="padding-left:0;"> 是</div>
						             </div>
						             <div class="form-group clearfix">
						                <label class="col-sm-5 control-label text-right"> 成交为王：</label>
						                <div class="col-sm-7 control-label" style="padding-left:0;"> 是</div>
						             </div>-->
						        </div>
							</div>
						</div>
						<br />
						<div class="hoMain-body border">
							<div class="row">
								<div class="hoMain-title">
									<a class="pull-right editIcon BombElem" data-module="editLinkManMessages"></a>
				                  	<h4>联系人</h4>
				                </div>
							</div>
							<div class="itemMessages" data-module="editReportMessages">
						        <div class="clearfix">
						        	<div class="table-responsive">
					                    <table class="table table-bordered table-hover" id="contact_list">
					                        <thead>
					                            <tr class="active">
					                              <th>分工</th>
					                              <th>对接人</th>
					                              <th>电话</th>
					                              <th>比例</th>
					                            </tr>
					                        </thead>
					                        <tbody>
												<?php if(is_array($contacts)): $i = 0; $__LIST__ = $contacts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$contact): $mod = ($i % 2 );++$i; if($key == 4): if(is_array($contact)): $i = 0; $__LIST__ = $contact;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subcontact): $mod = ($i % 2 );++$i;?><tr>
																<td><?php echo ($subcontact["text"]); ?></td>
																<td><?php echo ($subcontact["name"]); ?></td>
																<td><?php echo ($subcontact["mobile"]); ?></td>
																<td><?php echo ($subcontact["scale"]); ?>%</td>
															</tr><?php endforeach; endif; else: echo "" ;endif; ?>
													<?php else: ?>
														<tr>
															<td><?php echo ($contact["text"]); ?></td>
															<td><?php echo ($contact["name"]); ?></td>
															<td><?php echo ($contact["mobile"]); ?></td>
															<td><?php echo ($contact["scale"]); ?>%</td>
														</tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					                        </tbody>
					                    </table>
					                </div>
						        </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div style="position: fixed; top: 100px; left: 500px;">
			<input type="text" name="appointmentTime" id="DateTime" value="${data.appointmentSd}" placeholder="请输选时间" required="required" />
		</div> -->
	</div>
	<div class="modal" data-module="editYongJinMessages">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
			   <div class="modal-header">
			   		<button type="button" class="close outline" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">新增佣金信息</h4>
			   </div>
			   <div class="modal-body" style="max-height: 770px; overflow-y: auto;">
			   		<form class="form-horizontal">
						<input type="hidden" name="loupan_id" value="<?php echo ($data["id"]); ?>">
						<input type="hidden" name="id" value="">
			   			<div class="form-group">
							<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>物业类型：</label>
							<div class="col-sm-7 wuYeType">
								<?php if(is_array($data["property_type_arr"])): $i = 0; $__LIST__ = $data["property_type_arr"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pro): $mod = ($i % 2 );++$i;?><label class="radio-inline">
					                <input type="radio" data-index=<?php if($data['property_ids_arr'][$key] == 7): ?>1<?php else: ?>0<?php endif; ?> <?php if($key == 0): ?>checked="checked"<?php endif; ?> name="property_id" value=<?php echo ($data['property_ids_arr'][$key]); ?>> <?php echo ($pro); ?>
									</label><?php endforeach; endif; else: echo "" ;endif; ?>
			                </div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>佣金结算标准：</label>
							<div class="col-sm-7">
								<div class="col-sm-7 padding-left-zero">
									<select class="form-control yongJinJieSuan" name="count_type">
				                      <option data-index="0" value=1>按成交价比例收佣</option>
				                      <option data-index="1" value=2>每套固定佣金</option>
				                      <option data-index="2" value=3>跳点结算</option>
				                      <option data-index="3" value=4>其他结算规则</option>
				                    </select>
								</div>
			                	<label class="checkbox-inline showAddHouseModule">
					                <input type="checkbox" name="has_huxing"> 按户型区分
					            </label>
			                </div>
						</div>
						<div class="editYongJinMessages">
							<div class="editYongJinModule">
								<div class="copyElemModule">
									<div class="form-group addHouseModule">
										<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>请选择户型：</label>
										<div class="col-sm-3">
											<input type="hidden" name="huxing_ids">
											<input type="text" name="huxing" class="form-control" placeholder="请选择户型">
											<div class="col-sm-12">
												<?php if(is_array($huxings)): $i = 0; $__LIST__ = $huxings;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$h): $mod = ($i % 2 );++$i;?><label class="checkbox-inline showAddHouseModule" style="display: inline-block;">
														<input type="checkbox" name="tmp[]" value="<?php echo ($h["id"]); ?>"> <?php echo ($h["name"]); ?>
													</label><?php endforeach; endif; else: echo "" ;endif; ?>
											</div>
										</div>
										<a href="<?php echo U("HouseType/index", array('id' => I("id")));?>" class="pull-left btn">若无户型信息，请先在户型管理中新增户型</a>
										<span class="btn btn-blue pull-left addHousesElem">添加户型节点</span>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>代理服务费：</label>
										<div class="col-sm-2">
											<input type="text" name="proxy_service" class="form-control" placeholder="请输入佣金值">
										</div>
										<div class="pull-left control-label margin-right-10">%</div>
										<div class="pull-left control-label margin-right-10">
											<i class="required">*</i>现金奖
										</div>
										<div class="pull-left margin-right-10 selectTab">
											<select class="form-control" name="has_cash">
						                      <option data-index="0" value="0">无</option>
						                      <option data-index="1" value="1">有</option>
						                    </select>
										</div>
										<div class="pull-left margin-right-10 selectTabStare" style="width:140px;">
											<input type="text" name="cash" class="form-control" placeholder="请输入佣金值">
										</div>
										<div class="pull-left control-label margin-right-10 selectTabStare">元</div>
										<div class="pull-left control-label">额外奖励：</div>
										<div class="pull-left">
											<input type="text" name="extra_award" class="form-control" placeholder="请输入额外奖励内容">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label padding-right-zero">备注：</label>
										<div class="col-sm-9">
											<input type="text" name="remark" class="form-control" placeholder="请输入当前佣金结算标准备注">
										</div>
									</div>
								</div>

							</div>
							<div class="editYongJinModule">
								<div class="copyElemModule">
									<div class="form-group addHouseModule">
										<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>请选择户型：</label>
										<div class="col-sm-3">
											<input type="hidden" name="huxing_ids">
											<input type="text" name="huxing" class="form-control" placeholder="请选择户型">
											<div class="col-sm-12">
												<?php if(is_array($huxings)): $i = 0; $__LIST__ = $huxings;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$h): $mod = ($i % 2 );++$i;?><label class="checkbox-inline showAddHouseModule" style="display: inline-block;">
														<input type="checkbox" name="tmp[]" value="<?php echo ($h["id"]); ?>"> <?php echo ($h["room_count"]); ?>房<?php echo ($h["hall_count"]); ?>厅<?php echo ($h["toilet_count"]); ?>卫
													</label><?php endforeach; endif; else: echo "" ;endif; ?>
											</div>
										</div>
										<a href="#" class="pull-left btn">若无户型信息，请先在户型管理中新增户型</a>
										<span class="btn btn-blue pull-left addHousesElem">添加户型节点</span>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>代理服务费：</label>
										<div class="col-sm-2">
											<input type="text" name="proxy_service" class="form-control" placeholder="请输入佣金值">
										</div>
										<div class="pull-left control-label margin-right-10">元</div>
										<div class="pull-left control-label margin-right-10">
											<i class="required">*</i>现金奖
										</div>
										<div class="pull-left margin-right-10 selectTab">
											<select class="form-control" name="has_cash">
												<option data-index="0" value=0>无</option>
												<option data-index="1" value=1>有</option>
											</select>
										</div>
										<div class="pull-left margin-right-10 selectTabStare" style="width:140px;">
											<input type="text" class="form-control" name="cash" placeholder="现金金额">
										</div>
										<div class="pull-left control-label margin-right-10 selectTabStare">元</div>
										<div class="pull-left control-label">额外奖励：</div>
										<div class="pull-left">
											<input type="text" class="form-control" name="extra_award" placeholder="请输入额外奖励内容">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label padding-right-zero">备注：</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="remark" placeholder="请输入当前佣金结算标准备注">
										</div>
									</div>
								</div>
							</div>
							<div class="editYongJinModule">
								<div class="cpFuWuFei">
									<div class="form-group">
										<div class="col-sm-12 padding-left-zero padding-right-zero">
											<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>代理服务费：</label>
											<div class="col-sm-10">
												<div class="col-sm-2 padding-left-zero">
													<input type="text" name="min_count" class="form-control" placeholder="套数">
												</div>
												<div class="pull-left control-label margin-right-15">至</div>
												<div class="col-sm-2 padding-left-zero">
													<input type="text" name="max_count" class="form-control" placeholder="套数">
												</div>
												<div class="pull-left control-label margin-right-15">套</div>
												<div class="pull-left margin-right-10">
													<select class="form-control" name="count_type">
													<option value="1">按成交价比例</option>
													<option value="2">固定佣金</option>
													</select>
												</div>
												<div class="col-sm-2">
													<input type="text" class="form-control" name="proxy_service" placeholder="请输入佣金值">
												</div>
												<div class="pull-left control-label margin-right-15">%</div>
												<span class="btn btn-blue pull-left addFuWuFei">添加节点</span>
											</div>
										</div>
										<div class="col-sm-12 padding-left-zero padding-right-zero margin-top-20">
											<label class="col-sm-2 control-label padding-right-zero"></label>
											<div class="col-sm-10">
												<div class="pull-left control-label margin-right-10">
													现金奖
												</div>
												<div class="pull-left margin-right-10 selectTab">
													<select class="form-control" name="has_cash">
														<option data-index="0" value=0>无</option>
														<option data-index="1" value=1>有</option>
													</select>
												</div>
												<div class="pull-left margin-right-10 selectTabStare" style="width:140px;">
													<input type="text" class="form-control" name="cash" placeholder="现金金额">
												</div>
												<div class="pull-left control-label margin-right-15">额外奖励：</div>
												<div class="col-sm-3">
													<input type="text" class="form-control" name="extra_award" placeholder="额外奖励">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label padding-right-zero">备注：</label>
									<div class="col-sm-9">
										<input type="text" name="remark" class="form-control" placeholder="请输入当前佣金结算标准备注">
									</div>
								</div>
							</div>
							<div class="editYongJinModule">
								<div class="form-group">
									<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>佣金结算内容：</label>
									<div class="col-sm-9">
										<textarea class="col-sm-12" rows="10" name="content"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label padding-right-zero">备注：</label>
									<div class="col-sm-9">
										<input type="text" name="remark" class="form-control" placeholder="请输入当前佣金结算标准备注">
									</div>
								</div>
							</div>
						</div>
			   		</form>
			   </div>
			   <div class="modal-footer">
				   <div class="text-center">
		      			<button type="submit" class="btn btn-blue outline">保存</button>
			        	<button type="button" class="btn btn-default outline" data-dismiss="modal">取消</button>
		      		</div>
			    </div>
		    </div>
		</div>
	</div>
	<div class="modal" data-module="editJieYongMessages">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
			   <div class="modal-header">
			   		<button type="button" class="close outline" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">编辑结佣信息</h4>
			   </div>
			   <div class="modal-body" style="max-height: 770px; overflow-y: auto;">
			   		<form class="form-horizontal">
						<input type="hidden" name="loupan_id" value="<?php echo ($data["id"]); ?>">
						<input type="hidden" name="id">
			   			<div class="form-group">
							<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>物业类型：</label>
							<div class="col-sm-10 wuYeType">
								<?php if(is_array($data["property_type_arr"])): $i = 0; $__LIST__ = $data["property_type_arr"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><label class="checkbox-inline">
										<input type="checkbox"  name="property_ids[]" value="<?php echo ($data['property_ids_arr'][$key]); ?>"> <?php echo ($p); ?>
									</label><?php endforeach; endif; else: echo "" ;endif; ?>
					            <p class="fontColor">例：住宅和商铺的结佣条件不一样，则需新增类型分开填写；若一致，选中住宅和商铺，填写一次结佣信息即可</p>
			                </div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label padding-right-zero" style="margin-top: 5px;"><i class="required">*</i>对账周期：</label>
							<div class="col-sm-10 wuYeType">
								<label class="radio-inline">
					                <input type="radio" checked="checked" name="cycle_type" value=0> 按周
					            </label>
					            <label class="radio-inline" style="margin-left: 0; padding-left: 10px;">
					            	<select class="form-control" name="cycle_time">
				                      <option value=1>星期一</option>
				                      <option value=2>星期二</option>
				                      <option value=3>星期三</option>
				                      <option value=4>星期四</option>
				                      <option value=5>星期五</option>
				                      <option value=6>星期六</option>
				                      <option value=7>星期日</option>
				                    </select>
					            </label>
					            <label class="radio-inline">
					                <input type="radio" name="cycle_type" value=1> 按月
					            </label>
					            <div class="dataMonth" style="display: inline-block;">
					            	<label class="radio-inline dataMonth" style="margin-left: 0; padding-left: 10px;">
					            		<input type="text" class="form-control" placeholder="月" name="cycle_time">
					            	</label>
					            	<ul>
					               		<li>1</li>
					               		<li>2</li>
					               		<li>3</li>
					               		<li>4</li>
					               		<li>5</li>
					               		<li>6</li>
					               		<li>7</li>
					               		<li>8</li>
					               		<li>9</li>
					               		<li>10</li>
					               		<li>11</li>
					               		<li>12</li>
					               		<li>13</li>
					               		<li>14</li>
					               		<li>15</li>
					               		<li>16</li>
					               		<li>17</li>
					               		<li>18</li>
					               		<li>19</li>
					               		<li>20</li>
					               		<li>21</li>
					               		<li>22</li>
					               		<li>23</li>
					               		<li>24</li>
					               		<li>25</li>
					               		<li>26</li>
					               		<li>27</li>
					               		<li>28</li>
					               		<li>29</li>
					               		<li>30</li>
					               		<li>31</li>
					               	</ul>
					            </div>
					            <label class="radio-inline">
					                <input type="radio" name="cycle_type" value=3> 其他
					            </label>
					            <label class="radio-inline" style="margin-left: 0; padding-left: 10px;">
					                <input type="text" class="form-control" name="cycle_time" placeholder="请输入对账周期描述">
					            </label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label padding-right-zero">结佣类型：</label>
							<div class="col-sm-8 jieYongType">
								<div class="col-sm-4 padding-left-zero">
									<select class="form-control" name="jieyong_type">
				                      <option data-index="0" value=0>按揭付款</option>
				                      <option data-index="1" value=1>一次性付款/分次付款</option>
				                    </select>
								</div>
								<span class="btn btn-blue pull-right addYongJinTypeElem">添加节点</span>
							</div>
						</div>
						<div class="showElemModule"></div>
			   		</form>
			   </div>
			   <div class="modal-footer">
				   <div class="text-center">
		      			<button type="submit" class="btn btn-blue outline">保存</button>
			        	<button type="button" class="btn btn-default outline" data-dismiss="modal">取消</button>
		      		</div>
			   </div>
		    </div>
		</div>
	</div>
	<div class="modal" data-module="editReportMessages">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
			   <div class="modal-header">
			   		<button type="button" class="close outline" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">编辑分销设置</h4>
			   </div>
			   <div class="modal-body" style="max-height: 770px; overflow-y: auto;">
			   		<form class="form-horizontal" method='post' action="<?php echo U('editCfg');?>">
						<input type='hidden' name="id" value=<?php echo ($data["rcid"]); ?>>
						<input type='hidden' name="loupan_id" value=<?php echo ($data["id"]); ?>>
			   			<!--<div class="form-group">
							<div class="col-sm-2 control-label padding-right-zero">
								<label class="checkbox-inline fontColor" style="padding-top: 0">
					                <input type="checkbox"> 成交为王：
					            </label>
							</div>
							<div class="col-sm-8 control-label font-color-526a7a" style="text-align: left;">开启后，无需确认报备有效性，各类保护期均无效</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 fontColor control-label padding-right-zero"><i class="required">*</i>报备保护期：</label>
							<div class="col-sm-2" style="width: 100px;">
								<input type="text" class="form-control" placeholder="抵扣金">
							</div>
							<div class="col-sm-2 padding-left-zero">
								<select class="form-control">
			                      <option>按成交比例</option>
			                      <option>按成交比例</option>
			                    </select>
							</div>
						</div>-->
						<div class="form-group">
							<label class="col-sm-2 fontColor control-label padding-right-zero">报备细则：</label>
							<div class="col-sm-8">
								<textarea name="report_rule" class="col-sm-12" rows="10" placeholder="请输入报备的详细情况"><?php echo ($data["report_rule"]); ?></textarea>
							</div>
						</div>
						<!--<div class="form-group">
							<label class="col-sm-2 fontColor control-label padding-right-zero">客户保护期：</label>
							<div class="col-sm-2" style="width: 100px;">
								<input type="text" class="form-control" placeholder="抵扣金">
							</div>
							<div class="pull-left control-label">天</div>
						</div>-->
						<div class="form-group">
							<label class="col-sm-2 fontColor control-label padding-right-zero">带看细则：</label>
							<div class="col-sm-8">
								<textarea name="see_rule" class="col-sm-12" rows="10" placeholder="请输入带看细则的详细情况"><?php echo ($data["see_rule"]); ?></textarea>
							</div>
						</div>
						<!--<div class="form-group">
							<div class="col-sm-2 control-label padding-right-zero">
								<label class="checkbox-inline fontColor" style="padding-top: 0">
					                <input type="checkbox"> 自动接客：
					            </label>
							</div>
							<div class="col-sm-8 control-label font-color-526a7a" style="text-align: left;">宝贝客户自动有效，无需驻场方或开发商确认</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2 control-label padding-right-zero">
								<label class="checkbox-inline fontColor" style="padding-top: 0">
					                <input type="checkbox"> 全号报备：
					            </label>
							</div>
							<div class="col-sm-8 control-label font-color-526a7a" style="text-align: left;">开启后，经纪人必须使用完整的11位手机号码报备。</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2 control-label padding-right-zero">
								<label class="checkbox-inline fontColor" style="padding-top: 0">
					                <input type="checkbox"> 短信验证：
					            </label>
							</div>
							<div class="col-sm-8 control-label font-color-526a7a" style="text-align: left;">开启后，驻场确认带看需要输入客户收到的带看验证码</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 fontColor control-label padding-right-zero">提前报备时间：</label>
							<div class="col-sm-2" style="width: 100px;">
								<input type="text" class="form-control" placeholder="时间">
							</div>
							<div class="pull-left control-label">分钟</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 fontColor control-label padding-right-zero">成交保护期：</label>
							<div class="col-sm-2" style="width: 100px;">
								<input type="text" class="form-control" placeholder="天数">
							</div>
							<div class="pull-left control-label">天</div>
						</div>-->
			   		</form>
			   </div>
			   <div class="modal-footer">
				   <div class="text-center">
		      			<button type="submit" class="btn btn-blue outline">保存</button>
			        	<button type="button" class="btn btn-default outline" data-dismiss="modal">取消</button>
		      		</div>
			    </div>
			</div>
		</div>
	</div>
	<div class="modal" data-module="editLinkManMessages">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
			   <div class="modal-header">
			   		<button type="button" class="close outline" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">编辑联系人信息</h4>
			   </div>
			   <div class="modal-body" style="max-height: 770px; overflow-y: auto;">
			   		<form class="form-horizontal" id="contactForm">
			   			<input type="hidden" name="loupan_id" value="<?php echo ($data["id"]); ?>">
			   			<!-- 分配比例占位 -->
			   			<input type="hidden" name="scale[]"><input type="hidden" name="scale[]"><input type="hidden" name="scale[]">
			   			<div class="form-group">
		                  	<label class="col-sm-2 control-label"> 项目负责人：</label>
		                  	<input type="hidden" name="type[]" value="0">
		                  	<div class="pull-left margin-right-15">
		                      	<input type="text" name="name[]" value="<?php echo ($contacts["0"]["name"]); ?>" class="form-control" placeholder="请输入人员姓名">
		                   	</div>
		                   	<div class="pull-left">
		                      	<label class="control-label margin-right-15"> 联系电话：</label>
		                   	</div>
		                   	<div class="pull-left">
		                      	<input type="text" name="mobile[]" value="<?php echo ($contacts["0"]["mobile"]); ?>" class="form-control" placeholder="请输入人员联系方式">
		                   	</div>
		                </div>
		                <div class="form-group">
		                  	<label class="col-sm-2 control-label"> 项目统筹人：</label>
		                  	<input type="hidden" name="type[]" value="1">
		                  	<div class="pull-left margin-right-15">
		                      	<input type="text" name="name[]" value="<?php echo ($contacts["1"]["name"]); ?>" class="form-control" placeholder="请输入人员姓名">
		                   	</div>
		                   	<div class="pull-left">
		                      	<label class="control-label margin-right-15"> 联系电话：</label>
		                   	</div>
		                   	<div class="pull-left">
		                      	<input type="text" name="mobile[]" value="<?php echo ($contacts["1"]["mobile"]); ?>" class="form-control" placeholder="请输入人员联系方式">
		                   	</div>
		                </div>
		                <div class="form-group">
		                  	<label class="col-sm-2 control-label"> 财务：</label>
		                  	<input type="hidden" name="type[]" value="2">
		                  	<div class="pull-left margin-right-15">
		                      	<input type="text" name="name[]" value="<?php echo ($contacts["2"]["name"]); ?>" class="form-control" placeholder="请输入人员姓名">
		                   	</div>
		                   	<div class="pull-left">
		                      	<label class="control-label margin-right-15"> 联系电话：</label>
		                   	</div>
		                   	<div class="pull-left">
		                      	<input type="text" name="mobile[]" value="<?php echo ($contacts["2"]["mobile"]); ?>" class="form-control" placeholder="请输入人员联系方式">
		                   	</div>
		                </div>
		                <div class="form-group">
		                  	<label class="col-sm-2 control-label"> 拓盘：</label>
		                  	<input type="hidden" name="type[]" value="3">
		                  	<div class="pull-left margin-right-15">
		                      	<input type="text" name="name[]" value="<?php echo ($contacts["3"]["name"]); ?>" class="form-control" placeholder="请输入人员姓名">
		                   	</div>
		                   	<div class="pull-left">
		                      	<label class="control-label margin-right-15"> 联系电话：</label>
		                   	</div>
		                   	<div class="pull-left margin-right-15">
		                      	<input type="text" name="mobile[]" value="<?php echo ($contacts["3"]["mobile"]); ?>" class="form-control" placeholder="请输入人员联系方式">
		                   	</div>
		                   	<div class="pull-left">
		                      	<label class="control-label margin-right-15"> 分配比例：</label>
		                   	</div>
		                   	<div class="pull-left margin-right-15">
		                      	<input type="text" name="scale[]" value="<?php echo ($contacts["3"]["scale"]); ?>" class="form-control" placeholder="分配比例">
		                   	</div>
		                   	<div class="pull-left">
		                      	<label class="control-label"> %</label>
		                   	</div>
		                </div>
		                <div class="showDress">
							<?php if(!empty($contacts["4"])): if(is_array($contacts["4"])): $key = 0; $__LIST__ = $contacts["4"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$contact): $mod = ($key % 2 );++$key;?><div class="form-group">
	                				<label class="col-sm-2 control-label"> 驻场：</label>
		                  			<input type="hidden" name="type[]" value="<?php echo ($contact["type"]); ?>">
	                				<div class="col-sm-10 padding-left-zero">
	                					<div class="pull-left margin-right-15">
	                						<input type="text" name="name[]" value="<?php echo ($contact["name"]); ?>" class="form-control" placeholder="请输入人员姓名">
	                					</div>
	                					<div class="pull-left">
	                						<label class="control-label margin-right-15"> 联系电话：</label>
	                					</div>
	                					<div class="pull-left margin-right-15">
	                						<input type="text" name="mobile[]" value="<?php echo ($contact["mobile"]); ?>" class="form-control" placeholder="请输入人员联系方式">
	                					</div>
	                					<div class="pull-left">
	                						<label class="control-label margin-right-15"> 分配比例：</label>
	                					</div>
	                					<div class="pull-left margin-right-15">
	                						<input type="text" name="scale[]" value="<?php echo ($contact["scale"]); ?>" class="form-control" placeholder="分配比例">
	                					</div>
	                					<div class="pull-left margin-right-15">
	                						<label class="control-label"> %</label>
	                					</div>
	                					<?php if($key == 1): ?><div class="pull-left addIcon addDress" style="margin-top: 5px;"></div>
	                                   	<?php else: ?>
	                						<div class="pull-left delDress minusIcon" style="margin-top: 5px;"></div><?php endif; ?>
	                					<div class="row EditBootstrap telMassages" style="display: table; margin-left: 0;padding-top: 10px; width: 100%">
	                						<a class=" margin-right-10 <?php if($contact["type"] == 4): ?>acti<?php endif; ?>">免费咨询</a>
	                						<a class=" margin-right-10 <?php if($contact["type"] == 5): ?>acti<?php endif; ?>">现场对接</a>
	                						<a class=" margin-right-10 <?php if($contact["type"] == 6): ?>acti<?php endif; ?>">报备对接人</a>
	                					</div>
	                				</div>
	                			</div><?php endforeach; endif; else: echo "" ;endif; ?>
							<?php else: ?>

	                			<div class="form-group">
	                				<label class="col-sm-2 control-label"> 驻场：</label>
		                  			<input type="hidden" name="type[]" value="">
	                				<div class="col-sm-10 padding-left-zero">
	                					<div class="pull-left margin-right-15">
	                						<input type="text" name="name[]" value="" class="form-control" placeholder="请输入人员姓名">
	                					</div>
	                					<div class="pull-left">
	                						<label class="control-label margin-right-15"> 联系电话：</label>
	                					</div>
	                					<div class="pull-left margin-right-15">
	                						<input type="text" name="mobile[]" value="" class="form-control" placeholder="请输入人员联系方式">
	                					</div>
	                					<div class="pull-left">
	                						<label class="control-label margin-right-15"> 分配比例：</label>
	                					</div>
	                					<div class="pull-left margin-right-15">
	                						<input type="text" name="scale[]" value="" class="form-control" placeholder="分配比例">
	                					</div>
	                					<div class="pull-left margin-right-15">
	                						<label class="control-label"> %</label>
	                					</div>
										<div class="pull-left addIcon addDress" style="margin-top: 5px;"></div>
	                					<div class="row EditBootstrap telMassages" style="display: table; margin-left: 0;padding-top: 10px; width: 100%">
	                						<a class=" margin-right-10 <?php if($contact["type"] == 4): ?>acti<?php endif; ?>">免费咨询</a>
	                						<a class=" margin-right-10 <?php if($contact["type"] == 5): ?>acti<?php endif; ?>">现场对接</a>
	                						<a class=" margin-right-10 <?php if($contact["type"] == 6): ?>acti<?php endif; ?>">报备对接人</a>
	                					</div>
	                				</div>
	                			</div><?php endif; ?>
		                </div>

		                <div class="form-group">
		                  	<label class="col-sm-2 control-label"> 结佣：</label>
                  			<input type="hidden" name="type[]" value="7">
		                  	<div class="pull-left margin-right-15">
		                      	<input type="text" name="name[]" value="<?php echo ($contacts["7"]["name"]); ?>" class="form-control" placeholder="请输入人员姓名">
		                   	</div>
		                   	<div class="pull-left">
		                      	<label class="control-label margin-right-15"> 联系电话：</label>
		                   	</div>
		                   	<div class="pull-left margin-right-15">
		                      	<input type="text" name="mobile[]" value="<?php echo ($contacts["7"]["mobile"]); ?>" class="form-control" placeholder="请输入人员联系方式">
		                   	</div>
		                   	<div class="pull-left">
		                      	<label class="control-label margin-right-15"> 分配比例：</label>
		                   	</div>
		                   	<div class="pull-left margin-right-15">
		                      	<input type="text" name="scale[]" value="<?php echo ($contacts["7"]["scale"]); ?>" class="form-control" placeholder="分配比例">
		                   	</div>
		                   	<div class="pull-left">
		                      	<label class="control-label"> %</label>
		                   	</div>
		                </div>
		                <div class="form-group">
		                  	<label class="col-sm-2 control-label"> 转介：</label>
                  			<input type="hidden" name="type[]" value="8">
		                  	<div class="pull-left margin-right-15">
		                      	<input type="text" name="name[]" value="<?php echo ($contacts["8"]["name"]); ?>" class="form-control" placeholder="请输入人员姓名">
		                   	</div>
		                   	<div class="pull-left">
		                      	<label class="control-label margin-right-15"> 联系电话：</label>
		                   	</div>
		                   	<div class="pull-left margin-right-15">
		                      	<input type="text" name="mobile[]" value="<?php echo ($contacts["8"]["mobile"]); ?>" class="form-control" placeholder="请输入人员联系方式">
		                   	</div>
		                   	<div class="pull-left">
		                      	<label class="control-label margin-right-15"> 分配比例：</label>
		                   	</div>
		                   	<div class="pull-left margin-right-15">
		                      	<input type="text" name="scale[]" value="<?php echo ($contacts["8"]["scale"]); ?>" class="form-control" placeholder="分配比例">
		                   	</div>
		                   	<div class="pull-left">
		                      	<label class="control-label"> %</label>
		                   	</div>
		                </div>
		                <div class="form-group">
		                  	<label class="col-sm-2 control-label"> 会计：</label>
                  			<input type="hidden" name="type[]" value="9">
		                  	<div class="pull-left margin-right-15">
		                      	<input type="text" name="name[]" value="<?php echo ($contacts["9"]["name"]); ?>" class="form-control" placeholder="请输入人员姓名">
		                   	</div>
		                   	<div class="pull-left">
		                      	<label class="control-label margin-right-15"> 联系电话：</label>
		                   	</div>
		                   	<div class="pull-left margin-right-15">
		                      	<input type="text" name="mobile[]" value="<?php echo ($contacts["9"]["mobile"]); ?>" class="form-control" placeholder="请输入人员联系方式">
		                   	</div>
		                   	<div class="pull-left">
		                      	<label class="control-label margin-right-15"> 分配比例：</label>
		                   	</div>
		                   	<div class="pull-left margin-right-15">
		                      	<input type="text" name="scale[]" value="<?php echo ($contacts["9"]["scale"]); ?>" class="form-control" placeholder="分配比例">
		                   	</div>
		                   	<div class="pull-left">
		                      	<label class="control-label"> %</label>
		                   	</div>
		                </div>
			   		</form>
			   	</div>
			   	<div class="modal-footer">
				   <div class="text-center">
		      			<span id="addContact" class="btn btn-blue outline">保存</span>
			        	<button id="miss" type="button" class="btn btn-default outline" data-dismiss="modal">取消</button>
		      		</div>
			    </div>
			</div>
		</div>
	</div>
	<div class="lookImage">
		<img src="" alt="图片">
	</div>
	<div  class="close_del_up_mian" style="display:none;">
	    <div>
	        <p class="alert_title border-bottom">提示信息</p>
	        <div class="text-center padding30">
	            是否确定删除该佣金信息?
	        </div>
	    </div>
	</div>
	<div  class="close_del_up_jieYong" style="display:none;">
        <div>
            <p class="alert_title border-bottom">提示信息</p>
            <div class="text-center padding30">
                删除结佣条件节点将无法恢复，是否继续？
            </div>
        </div>
    </div>
    <div class="promptBox" style="display:none;"><p class="background-white"></p></div>
	<script>
		var loupan_id = <?php echo ($data["id"]); ?>;
		var prefix_url = "/Admin/";
		var commision_page_total_num = Math.ceil(<?php echo ($commision_total_num); ?> / 2);
		var jieyong_page_total_num = Math.ceil(<?php echo ($jieyong_total_num); ?> / 2);
		var yongjin_default_html = $(".modal[data-module='editYongJinMessages']").html();
		var jieyong_default_html = $(".modal[data-module='editJieYongMessages']").html();
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
				if(!!$(this).attr('data-module')){
					showModule = $(this).attr('data-module');
				} else {
					showModule= $(this).siblings('.tabController:not(.act)').attr('data-module'),
					_thisText = $(this).siblings('.tabController:not(.act)').attr('data-title');
					module_default_html = yongjin_default_html;
					if (showModule == 'editJieYongMessages') {
						module_default_html = jieyong_default_html;
					}
					$(".modal[data-module='" + showModule+"']").html(module_default_html);
					$(".modal[data-module='"+ showModule +"']").find('.modal-title').text(_thisText);
				}
				$(".modal[data-module]").fadeOut();
				$(".modal[data-module='" + showModule+"']").fadeIn();
				return false;
			});

			//图片放大
			$('.lookBigImage').click(function() {
				var imageUrl = $(this).attr('data-imageUrl');
				$('.lookImage').fadeIn();
				$('.lookImage img').attr('src', imageUrl);
			});
			$('.lookImage').click(function(){
				$(this).fadeOut();
			});
			$('.ho-main').on('click', '.delMessage', function() {
				var that = $(this);
				alertbox({
					msg: $('.close_del_up_mian').html(),
					tcallfn_tx: '删除',
					alerttap: 1,
					tcallfn: function () {
						var url = that.attr('data-url');
						$.get(url, function(res) {
							promptBoxHidden(res.info);
							if (res.status) {
								setTimeout(function() {location.reload()}, 1100);
							}
						});
					}
				})
			});
			//选项卡切换
			$('.tab .tabController').click(function(){
				var _that = $(this),
					_thisModule = _that.attr('data-module'),
					_thisSiblingsControllerLength = _that.siblings('.tabController').length;
					if (_thisSiblingsControllerLength > 0) {
						var parentElem = _that.parents('.tab');
						_that.removeClass('act').siblings('.tabController').addClass('act');
						parentElem.find(".tabMain div[data-module='"+ _thisModule +"']").show().siblings("div[data-module]").hide();
					}
			});
			//佣金结算标准模块切换
			$('.modal').on('change', '.yongJinJieSuan',function(){
				var index = $(this).find('option:selected').attr('data-index'),
					wuYeTypeIndex = $('.wuYeType input[type="radio"]:checked').attr('data-index');
				$('.editYongJinMessages .editYongJinModule').eq(index).show().siblings().hide();
				if(index == 2 || index == 3 || wuYeTypeIndex != 1){
					$('.showAddHouseModule').hide();
				} else {
					$('.showAddHouseModule').show();
				}
			});
			//房子节点显示隐藏
			$('.modal').on('click', '.showAddHouseModule input[name="has_huxing"]',function(){
				var thisChecked = $(this).is(':checked');
				if(thisChecked){
					$('.addHouseModule').show();
				} else {
					$('.addHouseModule').hide();
					var count_type = $(this).parent().siblings().find('.yongJinJieSuan').val();
					var copyElemModule = $('.editYongJinModule:nth-child(' + count_type + ') .copyElemModule');
					for (var i = 1;  i < copyElemModule.length; i++) {
						if (copyElemModule.length > 1) {
							copyElemModule.eq(i).remove();
						}
					}
				}
			});
			//房子节点新增
			//TODO
			$('.modal').on('click', '.addHousesElem',function(){
				var _html="",
					_html1 = '<div class="copyElemModule">' +
							'<div class="form-group addHouseModule" style="display: block;">' +
								'<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>请选择户型：</label>' +
								'<div class="col-sm-3">' +
									'<input type="hidden" name="huxing_ids">' +
									'<input type="text" name="huxing" class="form-control" placeholder="请选择户型">' +
									'<div class="col-sm-12">' +
										<?php if(is_array($huxings)): $i = 0; $__LIST__ = $huxings;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$h): $mod = ($i % 2 );++$i;?>'<label class="checkbox-inline showAddHouseModule" style="display: inline-block;">' +
												'<input type="checkbox" name="tmp[]" value="<?php echo ($h["id"]); ?>"> <?php echo ($h["room_count"]); ?>房<?php echo ($h["hall_count"]); ?>厅<?php echo ($h["toilet_count"]); ?>卫' +
											'</label>' +<?php endforeach; endif; else: echo "" ;endif; ?>
									'</div>' +
								'</div>' +
								'<a href="#" class="pull-left btn">若无户型信息，请先在户型管理中新增户型</a>' +
								'<span class="btn btn-blue pull-left delHousesElem">删除</span>' +
							'</div>' +
							'<div class="form-group">' +
								'<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>代理服务费：</label>' +
								'<div class="col-sm-2">' +
									'<input type="text" name="proxy_service" class="form-control" placeholder="请输入佣金值">' +
								'</div>',
					_html2 = '<div class="pull-left control-label margin-right-10">%</div>',
					_html3 = '<div class="pull-left control-label margin-right-10">元</div>',
					_html4 = '<div class="pull-left control-label margin-right-10">' +
									'<i class="required">*</i>现金奖' +
								'</div>' +
								'<div class="pull-left margin-right-10 selectTab">' +
									'<select class="form-control" name="has_cash">' +
										'<option data-index="0" value="0">无</option>' +
										'<option data-index="1" value="1">有</option>' +
									'</select>' +
								'</div>' +
								'<div class="pull-left margin-right-10 selectTabStare" style="width:140px;">' +
									'<input type="text" name="cash" class="form-control" placeholder="请输入佣金值">' +
								'</div>' +
								'<div class="pull-left control-label">额外奖励：</div>' +
										'<div class="pull-left">' +
											'<input type="text" name="extra_award" class="form-control" placeholder="请输入额外奖励内容">' +
										'</div>' +
									'</div>' +
									'<div class="form-group">' +
										'<label class="col-sm-2 control-label padding-right-zero">备注：</label>' +
										'<div class="col-sm-9">' +
											'<input type="text" name="remark" class="form-control" placeholder="请输入当前佣金结算标准备注">' +
										'</div>' +
									'</div>' +
								'</div>';
				var parentElem = $(this).parents('.editYongJinModule'),
					yongJinJieSuanActiveIndex = $('.yongJinJieSuan').find('option:selected').attr('data-index');
				if(yongJinJieSuanActiveIndex ==0){
					_html+= _html1 +_html2 +_html4;
				} else if(yongJinJieSuanActiveIndex ==1){
					_html+= _html1+_html3+_html4;
				}
				parentElem.append(_html);
			});
			//房子节点删除
			$('.modal').on('click', '.delHousesElem',function(){
				$(this).parents('.copyElemModule').remove();
			});
			//现金奖状态
			$('.modal').on('change', '.selectTab',function(){
				var index = $(this).find('option:selected').attr('data-index');
				if(index == 0){
					$(this).siblings('.selectTabStare').hide();
				} else if (index == 1) {
					$(this).siblings('.selectTabStare').show();
				}
			});
			//编辑结佣周期月
			$('body').on('focus', '.dataMonth input', function(){
				clearTimeout(timeOut);
				$(this).parent('label').siblings('ul').fadeIn();
				hideDataMonth();
			});
			var timeOut = null;
			$('body').on('click', '.dataMonth li', function(){
				clearTimeout(timeOut);
				var thisActiveState = $(this).hasClass('active'),
					inputVal = $('.dataMonth input').val(),
					_thisTextext= $(this).text();
				if(thisActiveState){
					$(this).removeClass('active');
					$('.dataMonth input').val(inputVal.replace(_thisTextext+';',""));
				}else{
					$(this).addClass('active');
					inputVal += _thisTextext+';';
					$('.dataMonth input').val(inputVal);
				}
				hideDataMonth();
			});
			//隐藏月
			function hideDataMonth (){
				timeOut = setTimeout(function (){
					$('.dataMonth ul').fadeOut();
				},2000);
				$('.dataMonth input').blur();
			}
			//TODO
			$('.modal').on('click', '.addYongJinTypeElem',function(){
				var index = $('.jieYongType').find('option:selected').attr('data-index'),
					_html1 = '<div class="cpJieYongHtml"><div class="form-group">'+
							'<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>结佣节点1：</label>'+
							'<div class="col-sm-8">'+
								'<div class="col-sm-4 padding-left-zero">'+
									'<select class="form-control" name="point_type">'+
				                      '<option value=0>放按揭款</option>'+
				                      '<option value=1>交定金</option>'+
				                      '<option value=2>签订认购书</option>'+
				                      '<option value=3>网签买卖合同</option>'+
				                      '<option value=4>交首期款</option>'+
				                      '<option value=5>签订按揭合同</option>'+
				                      '<option value=6>银行审批</option>'+
				                      '<option value=7>草签买卖合同</option>'+
				                    '</select>'+
								'</div>'+
								'<span class="btn btn-blue pull-right jieYongTypeElemDel">删除节点</span>'+
							'</div>'+
						'</div>'+
						'<div class="form-group">'+
							'<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>结算金额：</label>'+
							'<div class="col-sm-8">'+
								'<div class="col-sm-4 padding-left-zero">'+
									'<select class="form-control" name="count_type">'+
				                      '<option value=0>总佣金比例</option>	'+
				                      '<option value=1>按成交价比例</option>'+
				                      '<option value=2>固定金额</option>'+
				                      '<option value=3>现金奖</option>'+
				                      '<option value=4>套结佣金</option>'+
				                    '</select>'+
								'</div>'+
								'<div class="col-sm-4 padding-left-zero">'+
									'<input type="text"  class="form-control" name="count_price" placeholder="请输入佣金值">'+
								'</div>'+
								'<div class="pull-left control-label yongJinState">%</div>'+
							'</div>'+
						'</div>'+
						'<div class="form-group">'+
							'<label class="col-sm-2 control-label padding-right-zero">办理日：</label>'+
							'<div class="col-sm-8">'+
								'<div class="pull-left control-label">签订认购书后</div>'+
								'<div class="col-sm-2">'+
									'<input type="text"  class="form-control" name="apply_day" placeholder="天数">'+
								'</div>'+
								'<div class="pull-left control-label">天内办理</div>'+
								'<p class="col-sm-12 padding-left-zero fontColor">（例：假设该节点为交足定金，开发商约定客户须在签订认购书后<span class="font-color-fd1933">1</span>日内交足定金，则此处填<span class="font-color-fd1933">1</span>日）</p>'+
							'</div>'+
						'</div>'+
						'<div class="form-group">'+
							'<label class="col-sm-2 control-label padding-right-zero">回款日：</label>'+
							'<div class="col-sm-8">'+
								'<div class="pull-left control-label">合同约定对账后</div>'+
								'<div class="col-sm-2">'+
									'<input type="text"  class="form-control" name="return_day" placeholder="天数">'+
								'</div>'+
								'<div class="pull-left control-label">天内进账</div>'+
								'<p class="col-sm-12 padding-left-zero fontColor">（例：合同约定每月<span class="font-color-fd1933">10</span>对账后<span class="font-color-fd1933">15</span>日内回款，则此处填<span class="font-color-fd1933">15</span>日）</p>'+
							'</div>'+
						'</div>'+

					'</div>',
					_html2 = '<div class="cpJieYongHtml"><div class="form-group">'+
							'<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>结佣节点1：</label>'+
							'<div class="col-sm-8">'+
								'<div class="col-sm-4 padding-left-zero">'+
									'<select class="form-control" name="point_type">'+
				                      '<option value=0>放按揭款</option>'+
				                      '<option value=1>交定金</option>'+
				                      '<option value=2>签订认购书</option>'+
				                      '<option value=3>网签买卖合同</option>'+
				                      '<option value=4>交首期款</option>'+
				                      '<option value=5>签订按揭合同</option>'+
				                      '<option value=6>银行审批</option>'+
				                      '<option value=7>草签买卖合同</option>'+
				                    '</select>'+
								'</div>'+
								'<span class="btn btn-blue pull-right jieYongTypeElemDel">删除节点</span>'+
							'</div>'+
						'</div>'+
						'<div class="form-group">'+
							'<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>结算金额：</label>'+
							'<div class="col-sm-8">'+
								'<div class="col-sm-4 padding-left-zero">'+
									'<select class="form-control" name="count_type">'+
				                      '<option value=0>总佣金比例</option>	'+
				                      '<option value=1>按成交价比例</option>'+
				                      '<option value=2>固定金额</option>'+
				                      '<option value=3>现金奖</option>'+
				                      '<option value=4>套结佣金</option>'+
				                    '</select>'+
								'</div>'+
								'<div class="col-sm-4 padding-left-zero">'+
									'<input type="text"  class="form-control" name="count_price" placeholder="请输入佣金值">'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="form-group">'+
							'<label class="col-sm-2 control-label padding-right-zero">办理日：</label>'+
							'<div class="col-sm-8">'+
								'<div class="pull-left control-label">签订认购书后</div>'+
								'<div class="col-sm-2">'+
									'<input type="text"  class="form-control" name="apply_day" placeholder="天数">'+
								'</div>'+
								'<div class="pull-left control-label">天内办理</div>'+
								'<p class="col-sm-12 padding-left-zero fontColor">（例：假设该节点为交足定金，开发商约定客户须在签订认购书后<span class="font-color-fd1933">1</span>日内交足定金，则此处填<span class="font-color-fd1933">1</span>日）</p>'+
							'</div>'+
						'</div>'+
						'<div class="form-group">'+
							'<label class="col-sm-2 control-label padding-right-zero">回款日：</label>'+
							'<div class="col-sm-8">'+
								'<div class="pull-left control-label">合同约定对账后</div>'+
								'<div class="col-sm-2">'+
									'<input name="return_day" type="text"  class="form-control" placeholder="天数">'+
								'</div>'+
								'<div class="pull-left control-label">天内进账</div>'+
								'<p class="col-sm-12 padding-left-zero fontColor">（例：合同约定每月<span class="font-color-fd1933">10</span>对账后<span class="font-color-fd1933">15</span>日内回款，则此处填<span class="font-color-fd1933">15</span>日）</p>'+
							'</div>'+
						'</div>'+

					'</div>';

				if (index==0) {
					$('.showElemModule').append(_html1);
				} else if(index==1){
					$('.showElemModule').append(_html2);
				}
			});
			$('.showElemModule').on('click','.jieYongTypeElemDel',function(){
				var _that = $(this);
				alertbox({
	              msg: $('.close_del_up_jieYong').html(),
	              tcallfn_tx:'确认',
	              alerttap:1,
	              tcallfn:function(){
	                //点击删除按钮后操作
	                _that.parents('.cpJieYongHtml').remove();
	                promptBoxHidden('删除成功');
	              }
	            })
			});
			// TODO
			$('.modal').on('click', '.addFuWuFei',function(){
				var _html = '<div class="form-group">' +
					'<div class="col-sm-12 padding-left-zero padding-right-zero">'+
						'<label class="col-sm-2 control-label padding-right-zero"><i class="required">*</i>代理服务费：</label>'+
						'<div class="col-sm-10">'+
							'<div class="col-sm-2 padding-left-zero">'+
								'<input type="text" name="min_count" class="form-control" placeholder="套数">'+
							'</div>'+
							'<div class="pull-left control-label margin-right-15">至</div>'+
							'<div class="col-sm-2 padding-left-zero">'+
								'<input type="text" name="max_count" class="form-control" placeholder="套数">'+
							'</div>'+
							'<div class="pull-left control-label margin-right-15">套</div>'+
							'<div class="pull-left margin-right-10">'+
								'<select class="form-control" name="count_type">'+
								'<option value="1">按成交价比例</option>'+
								'<option value="2">固定佣金</option>'+
								'</select>'+
							'</div>'+
							'<div class="col-sm-2">'+
								'<input type="text" class="form-control" name="proxy_service" placeholder="请输入佣金值">'+
							'</div>'+
							'<div class="pull-left control-label margin-right-15">%</div>'+
							'<span class="btn btn-blue pull-left delFuWuFeiElem">删除</span>'+
						'</div>'+
					'</div>'+
					'<div class="col-sm-12 padding-left-zero padding-right-zero margin-top-20">'+
						'<label class="col-sm-2 control-label padding-right-zero"></label>'+
						'<div class="col-sm-10">'+
							'<div class="pull-left control-label margin-right-10">'+
								'现金奖</div>'+

							'<div class="pull-left margin-right-10 selectTab">'+
								'<select class="form-control" name="has_cash">'+
									'<option data-index="0" value=0>无</option>'+
									'<option data-index="1" value=1>有</option>'+
								'</select></div>'+
							'<div class="pull-left margin-right-10 selectTabStare" style="width:140px;">'+
								'<input type="text" class="form-control" name="cash" placeholder="现金金额"></div>'+

							'<div class="pull-left control-label margin-right-15">额外奖励：</div>'+
							'<div class="col-sm-3">' +
								'<input type="text" class="form-control" name="extra_award" placeholder="额外奖励">'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'
				$('.cpFuWuFei').append(_html);
			});
			//代理服务费节点删除
			$('.modal').on('click', '.cpFuWuFei .delFuWuFeiElem',function(){
				$(this).parents('.form-group').remove();
			});
			// TODO
			$('.addDress').click(function(){
				var _html = '<div class="form-group">'+
								'<label class="col-sm-2 control-label"> 驻场：</label>'+
	                  			'<input type="hidden" name="type[]" value="<?php echo ($contact["type"]); ?>">'+
								'<div class="col-sm-10 padding-left-zero">'+
									'<div class="pull-left margin-right-15">'+
										'<input type="text" name="name[]" value="<?php echo ($contact["name"]); ?>" class="form-control" placeholder="请输入人员姓名">'+
									'</div>'+
									'<div class="pull-left">'+
										'<label class="control-label margin-right-15"> 联系电话：</label>'+
									'</div>'+
									'<div class="pull-left margin-right-15">'+
										'<input type="text" name="mobile[]" value="<?php echo ($contact["mobile"]); ?>" class="form-control" placeholder="请输入人员联系方式">'+
									'</div>'+
									'<div class="pull-left">'+
										'<label class="control-label margin-right-15"> 分配比例：</label>'+
									'</div>'+
									'<div class="pull-left margin-right-15">'+
										'<input type="text" name="scale[]" value="<?php echo ($contact["scale"]); ?>" class="form-control" placeholder="分配比例">'+
									'</div>'+
									'<div class="pull-left margin-right-15">'+
										'<label class="control-label"> %</label>'+
									'</div>'+
									'<div class="pull-left minusIcon delDress" style="margin-top: 12px;"></div>'+
									'<div class="row EditBootstrap telMassages" style="display: table; margin-left: 0;padding-top: 10px; width: 100%">'+
										'<a class=" margin-right-10 <?php if($contact["type"] == 4): ?>acti<?php endif; ?>">免费咨询</a>'+
										'<a class=" margin-right-10 <?php if($contact["type"] == 5): ?>acti<?php endif; ?>">现场对接</a>'+
										'<a class=" margin-right-10 <?php if($contact["type"] == 6): ?>acti<?php endif; ?>">报备对接人</a>'+
										'<span class="fontColor">（该联系方式为经纪人拨打的联系电话）</span>'+
									'</div>'+
								'</div>'+
							'</div>';
				var contact_len = $('.showDress').find('.form-group').length  // 驻场联系人总数
				if (contact_len < 3) {
					$('.showDress').append(_html);
				}
			});
			$('.showDress').on('click','.delDress',function(){
				$(this).parents('.form-group').remove();
			});
			$('#addContact').click(function(){
				var data = $('#contactForm').serialize();
				$.post("<?php echo U('Contact/addContact');?>", data, function(res) {
					console.log(res)
					var data = res.data
					var str  = ''
					if (res.status == 1) {
						$(data).each(function(key,val){
							str += '<tr>'+
									   '<td>'+ val.type_str +'</td>'+
									   '<td>'+ val.name +'</td>'+
									   '<td>'+ val.mobile +'</td>'+
									   '<td>'+ val.scale +'</td>'+
								   '</tr>';
						})
						$('#contact_list').find('tbody').html(str);
						$('#miss').click();

					}
				})
			})
			$('.showDress').on('click','.telMassages a',function(){
				var parentIndex = $(this).parent('.telMassages').index('.telMassages');
				var thisIndex   = $('.telMassages a').index(this)
				var indexNum    = thisIndex-(parentIndex*3)
				$(this).addClass('acti').siblings().removeClass('acti');
				$(this).parent().parent().siblings('input[name="type[]"]').val(indexNum+4)
			});
			/*(function ($) {
			    $.mobiscroll.i18n.zh = $.extend($.mobiscroll.i18n.zh, {
			        dateFormat: 'yyyy-mm-dd',
			        dateOrder: 'yymmdd',
			        dayNames: ['周日', '周一;', '周二;', '周三', '周四', '周五', '周六'],
					dayNamesShort: ['日', '一', '二', '三', '四', '五', '六'],
			        dayText: '日',
			        hourText: '时',
			        minuteText: '分',
			        monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
			        monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
			        monthText: '月',
			        secText: '秒',
			        timeFormat: 'HH:ii',
			        timeWheels: 'HHii',
			        yearText: '年',
			        ampmText:'上午/下午',
			        timeFormat: 'A',
			        timeWheels: 'A',
			        setText: '确定',
			   		cancelText: '取消'
			    });
			})(jQuery);
			var currYear = (new Date()).getFullYear();
			var opt = {};
			opt.datetime = {
				preset: 'datetime'
			};
			opt.default = {
				theme: 'android-ics light', //皮肤样式
				display: 'bottom（底部）', //显示方式 ：modal（正中央）  bottom（底部）
				mode: 'scroller', //日期选择模式
				lang: 'zh',
				startYear: currYear - 5, //开始年份currYear-5不起作用的原因是加了minDate: new Date()
				endYear: currYear + 5, //结束年份
				//minDate: new Date() //加上这句话会导致startYear:currYear-5失效，去掉就可以激活startYear:currYear-5,
			};
			var _state = true;
			$("#appDate").val('').scroller('destroy').scroller($.extend(opt['date'], opt['default']));
			var optDateTime = $.extend(opt['datetime'], opt['default']);
			$("#DateTime").mobiscroll(optDateTime).datetime(optDateTime);*/

			$('.modal[data-module="editReportMessages"] button[type=submit]').click(function() {
				var form = $(this).parent().parent().prev('.modal-body').find('form');
				var url = form.attr('action');
				var data = form.serialize();
				$.post(url, data, function(res) {
					promptBoxHidden(res.info);
					if (res.status) {
						setTimeout(function() {location.reload()}, 1100);
					}
				}, 'json');
			});

			$(".prevpage,.nextpage,.btn-paging-jump,.pagination li").click(function(e) {
				e.preventDefault();
				var that = $(this);
				if (that.hasClass('btn-paging-jump')) {
					var a = that.parents('.input-group').eq(0).prev().find('li.active a');
				} else {
					var a = that.siblings('.active').find('a');
				}
				var cur_page = parseInt(a.text());
				var url = prefix_url + 'NewHouse/' + a.attr('data-action'); // 列表页api
				var del_url = prefix_url + 'Commision/' + a.attr('data-del') + '/id/'; // 删除api
				var edit_url = prefix_url + 'Commision/' + a.attr('data-modify') + '/id/'; // 编辑api
				var module = a.attr('data-module'); // 页面模块
				var total_page_num = module == "editYongJinMessages" ? commision_page_total_num : jieyong_page_total_num;
				var data = {
					loupan_id: loupan_id
				}
				if (that.hasClass('btn-paging-jump')) {
					var input = parseInt(that.parent().prev().val())
					if (input < 1 || input > total_page_num || isNaN(input)) {
						return;
					}
					page = input;
				} else if (that.attr('class') != undefined && that.attr('class') != "") {
					if (that.hasClass('prevpage')) {
						if (cur_page > 1) {
							page = cur_page-1
						} else {
							return;
						}
					} else {
						if (cur_page < total_page_num) {
							page = cur_page+1
						} else {
							return;
						}
					}
				} else {
					a = that.find('a');
					page = a.text();
				}
				data.page = page;
				$.get(url, data, function(res) {
					if (res.status == 1 && res.data.length > 0) {
						var data = res.data
						var html = ''
						for (var i = 0; i < data.length; i++) {
							if (module == "editYongJinMessages") {
								html += '<tr><td>' + data[i]['index'] + '</td><td>' + data[i]['property'] + '</td><td>' + data[i]['huxings'] + '</td><td>' + data[i]['rule'] + '</td><td>' + data[i]['remark'] + '</td><td><a data-url="' + edit_url + data[i]['id'] + '" class="btn editMessages" data-title="编辑佣金信息">编辑</a><a data-url="' + del_url + data[i]['id'] + '" class="btn delMessage">删除</a></td></tr>';
							} else {
								html += '<tr><td>' + data[i]['property_type'] + '</td><td>' + data[i]['jieyong_text'] + '</td><td>' + data[i]['point_text'] + '</td><td>' + data[i]['count_price'] + '('+ data[i]['count_text'] +')</td><td>' + data[i]['apply_day'] + '天</td><td>' + data[i]['return_day'] + '天</td><td><a data-url="' + edit_url + data[i]['id'] + '" class="btn editMessages" data-title="编辑结佣信息">编辑</a><a data-url="' + del_url + data[i]['id'] + '" class="btn delMessage">删除</a></td></tr>'
							}
							if (that.hasClass('btn-paging-jump')) {
								that.parents('.input-group').eq(0).siblings('ul').find('li').removeClass('active').eq(page).addClass('active');
							} else if (that.attr('class') != undefined && that.attr('class') != "") {
								console.log('hi')
								if (that.hasClass('prevpage')) {
									a.parent().removeClass('active').prev().addClass('active');
								} else if (that.hasClass('nextpage')) {
									a.parent().removeClass('active').next().addClass('active');
								}
							} else {
								that.addClass('active').siblings().removeClass('active');
							}
						}
						$('div[data-module="' + module + '"] table tbody').html(html);
					}
				}, 'json');
			});

			$('.modal[data-module="editYongJinMessages"]').on('click', '[name="property_id"]', function(e) {
				var index = $('.yongJinJieSuan').find('option:selected').attr('data-index');
				if ($(this).attr('data-index') == 1 && (index == 0 || index == 1)) {
					$(this).parents('form').eq(0).find('.showAddHouseModule').show();
				} else {
					var input = $(this).parents('form').eq(0).find('.showAddHouseModule').hide().find('input[name="has_huxing"]:checked').click();
				}
			});

			$('.modal').on('click', '.editYongJinModule .cpFuWuFei select[name="count_type"]', function(e) {
				var unit = $(this).val() == 1 ? "%" : "元";
				$(this).parent().siblings('span').prev().text(unit);
			});

			$('.modal[data-module="editYongJinMessages"]').on('click', '[name="tmp[]"]', function(e) {
				var parent = $(this).parents('.col-sm-12').eq(0);
				var huxing_arr = [], huxing_ids_arr = [];
				parent.find('[name="tmp[]"]:checked').each(function(i) {
					huxing_ids_arr.push($(this).val());
					huxing_arr.push($(this).parent().text().trim());
				});
				parent.siblings('[name="huxing"]').val(huxing_arr.join(';'));
				parent.siblings('[name="huxing_ids"]').val(huxing_ids_arr.join(','));
			});

			$('.modal[data-module="editYongJinMessages"]').on('click', 'button[type="submit"]', function(e) {
				var form = $('.modal[data-module="editYongJinMessages"] form');
				var id = form.find('[name="id"]').val();
				var request_params = {
					loupan_id: <?php echo ($data["id"]); ?>,
					huxing_ids: '',
					property_id: form.find('[name="property_id"]:checked').val(),
					count_type: form.find('[name="count_type"]').eq(0).val(),
					has_huxing: form.find('[name="has_huxing"]').is(':checked') ? 1 : 0,
					rule_list: [],
					remark: '',
					act: 'add'
				}
				var url = prefix_url + 'Commision/doAction';
				if (!isNaN(parseInt(id))) {
					request_params.act = 'save';
					request_params.id = id;
				}
				switch (parseInt(request_params.count_type)) {
					case 1:
					case 2:
						$('.editYongJinMessages .editYongJinModule:nth-child('+ request_params.count_type +') .copyElemModule').each(function(index) {
							data = {
								proxy_service: $(this).find('[name="proxy_service"]').val(),
								has_cash: $(this).find('[name="has_cash"]').val(),
								cash: $(this).find('[name="cash"]').val(),
								extra_award: $(this).find('[name="extra_award"]').val(),
								remark: $(this).find('[name="remark"]').val(),
							}
							if (request_params.has_huxing == 1) {
								data.huxing_ids = $(this).find('[name="huxing_ids"]').val()
								data.huxing = $(this).find('[name="huxing"]').val()
							}
							request_params.rule_list.push(data)
						});
						break;
					case 3:
						var $editYongJinModule = $('.editYongJinMessages .editYongJinModule:nth-child('+ request_params.count_type +')');
						$editYongJinModule.find('.cpFuWuFei .form-group').each(function(index) {
							data = {
								max_count: $(this).find('[name="max_count"]').val(),
								min_count: $(this).find('[name="min_count"]').val(),
								proxy_service: $(this).find('[name="proxy_service"]').val(),
								count_type: $(this).find('[name="count_type"]').val(),
								has_cash: $(this).find('[name="has_cash"]').val(),
								cash: $(this).find('[name="cash"]').val(),
								extra_award: $(this).find('[name="extra_award"]').val(),
							}
							request_params.rule_list.push(data)
						});
						request_params.remark = $editYongJinModule.children('.form-group').eq(0).find('[name="remark"]').val();
						break;
					case 4:
						var $editYongJinModule = $('.editYongJinMessages .editYongJinModule:nth-child('+ request_params.count_type +')');
						request_params.remark = $editYongJinModule.find('[name="remark"]').val();
						request_params.content = $editYongJinModule.find('[name="content"]').val();
						break;
					default:
				}

				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'json',
					data: request_params,
					success: function(res) {
						promptBoxHidden(res.info);
						if (res.status) {
							setTimeout(function() {location.reload()}, 1100);
						}
					}
				});
			});

			//编辑信息
			$('.itemMessages').on('click','.editMessages',function(){
				var _thisModule = $(this).parents('[data-module]').attr('data-module'),
					_thisText = $(this).attr('data-title');
				var url = $(this).attr('data-url');
				var parent = $(".modal[data-module='"+ _thisModule +"']");
				var form = parent.find('form');
				if (_thisModule == 'editYongJinMessages') {
					$.ajax({
						url: url,
						dataType: 'json',
						async: true,
						success: function(res) {
							if (res.status) {
								var data = res.data;
								form.find('[name="id"]').val(data.id);
								form.find('[name="act"]').val('save');
								form.find('[name="property_id"]').eq(data.property_id-1).click();
								form.find('[name="count_type"]').val(data.count_type);
								form.find('[name="remark"]').val(data.remark);
								form.find('.editYongJinMessages .editYongJinModule').hide();
								var chunk = form.find('.editYongJinMessages .editYongJinModule:nth-child('+ data.count_type +')');
								switch (parseInt(data.count_type)) {
									case 1:
									case 2:
										var copyElemModule = chunk.find('.copyElemModule').eq(0);
										if (data.has_huxing == 1) {
											form.find('[name="has_huxing"]').click();
											// copyElemModule.find('[name="huxing_ids"]').val(data.huxing_ids);
											// copyElemModule.find('[name="huxing"]').val(data.huxing_arr);
											var ids_arr = data.huxing_ids.split(',');
											copyElemModule.find('[name="tmp[]"]').each(function(i) {
												if (ids_arr.indexOf($(this).val()) !== -1) {
													$(this).click();
												}
											});
										}
										copyElemModule.find('[name="proxy_service"]').val(data.proxy_service);
										copyElemModule.find('[name="extra_award"]').val(data.extra_award);
										copyElemModule.find('[name="remark"]').val(data.remark);
										if (data.has_cash == 1) {
											copyElemModule.find('[name="has_cash"]').val(data.has_cash).parent().siblings('.selectTabStare').show().find('[name="cash"]').val(data.cash);
										} else {
											copyElemModule.find('[name="has_cash"]').val(data.has_cash).parent().siblings('.selectTabStare').hide().find('[name="cash"]').val('')
										}
										break;
									case 3:
										var len = data.rule_list.length;
										var list = data.rule_list;
										var form_len = chunk.find('.cpFuWuFei').children('.form-group').length;
										for (var i = 0; i < len; i++) {
											var unit = '%';
											var group = chunk.find('.cpFuWuFei').children('.form-group').eq(i);
											group.find('[name="min_count"]').val(list[i].min_count)
											group.find('[name="max_count"]').val(list[i].max_count)
											group.find('[name="proxy_service"]').val(list[i].proxy_service)
											group.find('[name="extra_award"]').val(list[i].extra_award)
											if (2 == list[i].count_type) {
												unit = '元';
											}
											group.find('[name="count_type"]').val(list[i].count_type).parent().next().next().text(unit);
											if (list[i].has_cash == 1) {
												group.find('[name="has_cash"]').val(list[i].has_cash).parent().siblings('.selectTabStare').show().find('[name="cash"]').val(list[i].cash);
											} else {
												group.find('[name="has_cash"]').val(list[i].has_cash).parent().siblings('.selectTabStare').hide().find('[name="cash"]').val('')
											}
											if (i < len - 1 && form_len < len) {
												chunk.find('.addFuWuFei').click();
											}
										}
										break;
									case 4:
										chunk.find('[name="remark"]').val(data.remark);
										chunk.find('[name="content"]').val(data.content);
										break;
									default:
								}
							}
							chunk.show();
							$(".modal[data-module]").fadeOut();
							parent.fadeIn().end().find('.modal-title').text(_thisText);
						}
					});

				} else {
					$.ajax({
						url: url,
						dataType: 'json',
						async: true,
						success: function(res) {
							var data = res.data;
							$('.addYongJinTypeElem').click();
							form.find('[name="property_ids[]"]').attr('checked', false);
							form.find('[name="jieyong_type"]').attr(data.jieyong_type);
							form.find('[name="count_type"]').attr(data.count_type);
							form.find('[name="id"]').val(data.id);
							form.find('[name="point_type"]').val(data.point_type);
							form.find('[name="count_type"]').val(data.count_type);
							form.find('[name="count_price"]').val(data.count_price);
							form.find('[name="apply_day"]').val(data.apply_day);
							form.find('[name="return_day"]').val(data.return_day);
							form.find('[name="property_ids[]"][value="'+ data.property_ids +'"]').prop('checked', true);
							form.find('[name="cycle_time"]').val('');
							form.find('[name="cycle_type"][value="'+ data.cycle_type +'"]').click().parent().next().find('[name="cycle_time"]').val(data.cycle_type == 1 ? data.cycle_time + ";" : data.cycle_time);
							$(".modal[data-module]").fadeOut();
							parent.fadeIn().end().find('.modal-title').text(_thisText);
						}
					});
				}
			});
			//关闭自定义弹框
			$(".modal[data-module]").on('click', "[data-dismiss='modal']", function(){
				$(this).parents('.modal[data-module]').fadeOut();
				$('[name="id"]').val('');
				$('.addYongJinTypeElem').remove();
				setTimeout(function() {
					if ($('[name="has_huxing"]').is(':checked')) {
						$('[name="has_huxing"]').click();
					}
				}, 1001);
				return false;
			});

			$('.modal[data-module="editJieYongMessages"]').on('change', '[name="count_type"]', function(e) {
				if ($(this).val() < 2) {
					$(this).parent().siblings('.yongJinState').text('%');
				} else {
					$(this).parent().siblings('.yongJinState').text('元');
				}
			});

			$('.modal[data-module="editJieYongMessages"]').on('click', '[type="submit"]', function(e) {
				var form = $('.modal[data-module="editJieYongMessages"] form');
				var id = form.find('[name="id"]').val();
				var request_params = {
					loupan_id: <?php echo ($data["id"]); ?>,
					jieyong_type: form.find('[name="jieyong_type"]').val(),
					point_list: [],
					cycle_type: form.find('[name="cycle_type"]:checked').val(),
					cycle_time: form.find('[name="cycle_type"]:checked').parent().next().find('[name="cycle_time"]').val(),
					act: 'add'
				};
				var url = prefix_url + 'Commision/doJyAction';
				if (!isNaN(parseInt(id))) {
					request_params.act = 'save';
					request_params.id = id;
				}
				var properties = form.find('[name="property_ids[]"]:checked');
				var property_len = properties.length, property_ids = [], property_texts = [];
				properties.each(function(i) {
					property_ids.push($(this).val());
					property_texts.push($(this).parent().text().trim());
				});
				request_params.property_ids = property_ids;
				request_params.property_texts = property_texts.join(',');
				if (request_params.cycle_type == 1) {
					request_params.cycle_time = request_params.cycle_time.substr(0, request_params.cycle_time.length - 1);
				}
				form.find('.cpJieYongHtml').each(function(index) {
					var data = {
						point_type: $(this).find('[name="point_type"]').val(),
						count_type: $(this).find('[name="count_type"]').val(),
						count_price: $(this).find('[name="count_price"]').val(),
						apply_day: $(this).find('[name="apply_day"]').val(),
						return_day: $(this).find('[name="return_day"]').val(),
					}
					request_params.point_list.push(data);
				});

				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'json',
					data: request_params,
					success: function(res) {
						promptBoxHidden(res.info);
						if (res.status) {
							setTimeout(function() {location.reload()}, 1100);
						}
					}
				});
			});
		});
	</script>
    </body>
</html>