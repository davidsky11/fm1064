<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Xenon Boostrap Admin Panel" />
    <meta name="author" content="" />

    <title>麦可FM管理系统</title>

    <link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
	<link rel="stylesheet" href="css/bootstrap-table.min.css"/>
    <link rel="stylesheet" href="css/xenon-core.css"/>
    <link rel="stylesheet" href="css/back.css"/>

    <script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-table.min.js"></script>
	<script src="js/bootstrap-table-zh-CN.min.js"></script>

	<script type="text/javascript">

		function searchOrder() {
			var search = document.getElementById("search").value;
		   
			if(search == ""  ){
				alert("请输入您要搜索的关键字!");
				return false;
			}

			document.getElementById("searchFrm").submit();
		}

		function editOrder(id) {
			//alert(id);
			var formEdit = document.getElementById("idform");
			formEdit.action = "<?php echo HOSTNAME?>"+"index.php?r=site/editOrder&id="+id;
			formEdit.method = "post";
			formEdit.submit();
		}

		function updateOrder(id) {
			var buyerName = document.getElementById("buyerName"+id).value;
			var buyerPhone = document.getElementById("buyerPhone"+id).value;
			var userName = document.getElementById("userName"+id).value;
			var userPhone = document.getElementById("userPhone"+id).value;
			var songer = document.getElementById("songer"+id).value;
			var songName = document.getElementById("songName"+id).value;
			var songTime = document.getElementById("songTime"+id).value;

			$.ajax({
				type:'post',
				url:"<?php echo HOSTNAME?>"+"index.php?r=site/updateOrder",
				data:{
					id: id,
					buyerName: buyerName,
					buyerPhone: buyerPhone,
					userName: userName,
					userPhone: userPhone,
					songer: songer,
					songName: songName,
					songTime: songTime
					},
				dataType:'json',
				success:function(data){
					if(data==null){
					}else{
						alert("修改订单成功!");
					}
					window.location.reload();
				},
				error:function(){
					window.location.reload();
				}
			});
		}

		function delOrder(id) {
			var boo = confirm("您将要删除一个订单，确定要删除吗？");	
			if (boo){
				
			} else {
				return false;
			}

			$.ajax({
				type:'post',
				url:"<?php echo HOSTNAME?>"+"index.php?r=site/delOrder2",
				data:{id:id},
				dataType:'json',
				success:function(data){
					alert(data);
					if(data==null){
					}else{
						alert("删除订单成功!");
					}
					window.location.reload();
				},
				error:function(){
					window.location.reload();
				}
			});
		}

		function editOrder1(id){
			$.ajax({
				type:'post',
				url:"<?php echo HOSTNAME?>"+"index.php?r=site/editOrder",
				data:{
					id:id
					},
				async:true,
				dataType:'json',
				success:function(data){
					alert(data);
					if(data==null){
						
					}else{
						alert("修改价格成功!");
					}
				}
			});
		}

	</script>

</head>
<body>

<div class="page-container">
    <div class="sidebar-menu  toggle-others fixed">

        <div class="sidebar-menu-inner">

            <header class="logo-env">

                <!-- logo -->
                <div class="logo">
                    <a href="dashboard-1.html" class="logo-expanded">
                        <img src="images/back/logo.jpg" width="150" alt="" />
                    </a>

                    <a href="dashboard-1.html" class="logo-collapsed">
                        <img src="images/back/logo.jpg" width="40" alt="" />
                    </a>
                </div>

                <div class="mobile-menu-toggle visible-xs">
                    <a href="#" data-toggle="user-info-menu">
                        <i class="fa-bell-o"></i>
                    </a>

                    <a href="#" data-toggle="mobile-menu">
                        <i class="fa-bars"></i>
                    </a>
                </div>
            </header>

			<ul>
				<span style="color:#fdfdfd; position:relative; left:0px;">您好, <?php echo $_SESSION["username"] ?></span>&nbsp;&nbsp;&nbsp;
				<span >
					<a href="?r=loginout/index">退出</a>
				</span>
			</ul>
            <ul id="main-menu" class="main-menu">
                <li class="opened">
                    <a href="#">
                        <span class="title" style="display:inline-block;">用户管理</span> 
                    </a>
                    <ul>
                        <li class="active">
                            <a href="index.php?r=site/main">
                                <span class="title">查询订单</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?r=site/price">
                                <span class="title">设置价格</span>
                            </a>
                        </li>
						<li>
							<a href="index.php?r=site/banner">
								<span class="title">设置广告</span>
							</a>
						</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <nav class="navbar user-info-navbar" role="navigation">
		  <div class="">
		 
			<form id="searchFrm" action="?r=site/searchOrder" method="post" style="position:relative; left:60px; margin: auto 0; top:12px; height: 50px;">
				<input id="search" name="search" name="search" type="text" />
				<select id="searchType" name="searchType">
					<option value="1">订单号</option>
					<option value="2">姓名</option>
					<option value="3">电话</option>
				</select>
				<button type="button" onclick="searchOrder();">搜索</button>

				
			</form>

			</div>
        </nav>

        <!-- Table Styles -->
        <div >
            <div id="toolbar" class="fixed-table-toolbar" style="margin-bottom: -40px">

                <div class="panel panel-default padding-r-50">
                    <div class="panel-heading">
                        <h3 class="panel-title">订单管理</h3>
					</div>
                    
					<div class="panel-body" style="overflow-x:auto">
					<table id="table" data-toggle="table"
						
						data-click-to-select="true"
						data-row-style="rowStyle"
						data-query-params="queryParams"
						data-pagination="true"
						data-search="false"
						   data-width="480"
						data-height="600">
						<thead>
						<tr>
							<th data-field="orderNum" style="width: 10%">订单号</th>
							<th data-field="buyerName">点歌人姓名</th>
							<th data-field="buyerPhone">点歌人手机号</th>
							<th data-field="userName">赠送人姓名</th>
							<th data-field="userPhone">赠送人手机号</th>
							<th data-field="songer">歌手</th>
							<th data-field="songName">歌曲名</th>
							<th data-field="price" style="width:10%;">套餐(圆)</th>
							<th data-field="blessings">祝福语</th>
							<th data-field="time">选择时间</th>
							<th data-field="action" data-formatter="actionFormatter" data-events="actionEvents" style="width: 10%;">操作</th>
						</tr>
						</thead>

						<tbody>
						<!-- form id="idform" action="?r=site/editOrder" method="post" -->
						<?php foreach($data as $key1 => $value1):?>
							<tr>
								<td align="center">
									<?php echo $value1['orderNum']?>
								</td>
								<td>
									<?php echo $value1['buyerName']?>&nbsp;
									<?php if($value1['buyerSex'] == "0"):?>
										男
									<?php elseif($value1['buyerSex'] == "1"):?>
										女
									<?php endif;?>
								</td>
								<td>
									<?php echo $value1['buyerPhone']?>
								</td>
								<td>
									<?php echo $value1['userName']?>&nbsp;
									<?php if($value1['userSex'] == "0"):?>
										男
									<?php elseif($value1['userSex'] == "1"):?>
										女
									<?php endif;?>
								</td>

								<td>
									<?php echo $value1['userPhone']?>
								</td>
								<td>
									<?php echo $value1['songer']?>
								</td>
								<td>
									<?php echo $value1['songName']?>
								</td>
								<td>
									<?php echo $value1['price']?>
								</td>
								<td>
									<?php echo $value1['blessings']?>
								</td>
								<td>
									<?php echo $value1['songTime']?>
								</td>

								<td>
									<!-- class="btn btn-success btn-xs" data-toggle="modal" data-target="#reviseOrder" onclick="editOrder(<?php echo $value1['id'];?>)" -->
									<a href="javascript: void(0);" onclick="editOrder(<?php echo $value1['id'];?>)"> <p class="creative"><a href = "javascript:void(0)" onclick = "document.getElementById('light<?php echo $value1['id'];?>').style.display='block';document.getElementById('fade<?php echo $value1['id'];?>').style.display='block'">修改</a></p> </a>
									<br>
									<a href="javascript: void(0);" onclick="delOrder(<?php echo $value1['id'];?>)">删除</a>
									<!-- class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteOrder" onclick="delOrder(<?php echo $value1['id'];?>)" -->
								</td>
							</tr>

							<div id="light<?php echo $value1['id'];?>" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
								<!-- form id="idform" -->
								<div class="modal-dialog">
								<div class="modal-content">
								
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" onclick = "document.getElementById('light<?php echo $value1['id'];?>').style.display='none';document.getElementById('fade<?php echo $value1['id'];?>').style.display='none'" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="gridSystemModalLabel">修改订单</h4>
										<a href = "javascript:void(0)" onclick = "alert('1');document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"><span style="float:right; color:#FFF; margin:20px;">退出</span></a>
									</div> 

									<div class="modal-body">
										<div class="container-fluid">
											<!-- form class="form-horizontal" role="form" -->
											<fieldset>
												<div class="form-group">
													<label for="orderNum" class="col-xs-6 control-label">订单号：</label>
													<div class="col-xs-6">
														<input type="text" readOnly class="form-control input-sm duiqi" id="orderNum<?php echo $value1['id']?>" placeholder="<?php echo $value1['orderNum']?>" value="<?php echo $value1['orderNum']?>"/>
													</div>
												</div>
												<div class="form-group">
													<label for="buyerName" class="col-xs-6 control-label">点歌人：</label>
													<div class="col-xs-6">
														<input type="text" class="form-control input-sm duiqi" id="buyerName<?php echo $value1['id']?>" placeholder="<?php echo $value1['buyerName']?>" value="<?php echo $value1['buyerName']?>"/>
													</div>
												</div>
												<div class="form-group">
													<label for="buyerPhone" class="col-xs-6 control-label">点歌人手机：</label>
													<div class="col-xs-6">
														<input type="text" class="form-control input-sm duiqi" id="buyerPhone<?php echo $value1['id']?>" placeholder="<?php echo $value1['buyerPhone']?>" value="<?php echo $value1['buyerPhone']?>"/>
													</div>
												</div>
												<div class="form-group">
													<label for="userName" class="col-xs-6 control-label">赠送人：</label>
													<div class="col-xs-6">
														<input type="text" class="form-control input-sm duiqi" id="userName<?php echo $value1['id']?>" placeholder="<?php echo $value1['userName']?>" value="<?php echo $value1['userName']?>"/>
													</div>
												</div>
												<div class="form-group">
													<label for="userPhone" class="col-xs-6 control-label">赠送人手机：</label>
													<div class="col-xs-6">
														<input type="text" class="form-control input-sm duiqi" id="userPhone<?php echo $value1['id']?>" placeholder="<?php echo $value1['userPhone']?>" value="<?php echo $value1['userPhone']?>"/>
													</div>
												</div>
												<div class="form-group">
													<label for="songer" class="col-xs-6 control-label">歌手：</label>
													<div class="col-xs-6">
														<input type="text" class="form-control input-sm duiqi" id="songer<?php echo $value1['id']?>" placeholder="<?php echo $value1['songer']?>" value="<?php echo $value1['songer']?>"/>
													</div>
												</div>
												<div class="form-group">
													<label for="songName" class="col-xs-6 control-label">歌曲：</label>
													<div class="col-xs-6">
														<input type="text" class="form-control input-sm duiqi" id="songName<?php echo $value1['id']?>" placeholder="<?php echo $value1['songName']?>" value="<?php echo $value1['songName']?>"/>
													</div>
												</div>
												<div class="form-group">
													<label for="songTime" class="col-xs-6 control-label">时间：</label>
													<div class="col-xs-6">
														<input type="text" class="form-control input-sm duiqi" id="songTime<?php echo $value1['id']?>" placeholder="<?php echo $value1['songTime']?>" value="<?php echo $value1['songTime']?>"/>
													</div>
												</div>
												<!-- div class="form-group">
													<label for="orderStatus" class="col-xs-6 control-label">状态：</label>
													<div class="col-xs-6">
														<label class="control-label" for="anniu">
															<input type="radio" name="situation" id="normal">正常
														</label> 
														<label class="control-label" for="meun">
															<input type="radio" name="orderStatus" id="forbid"> 禁用
														</label>
													</div>
												</div -->
											</fieldset>
											<!-- /form -->
										</div>
									</div>

									<div class="modal-footer">
										<button class="btn btn-xs btn-red" data-dismiss="modal" aria-hidden="true" onclick="document.getElementById('light<?php echo $value1['id'];?>').style.display='none';document.getElementById('fade<?php echo $value1['id'];?>').style.display='none'">取 消</button>
										<button class="btn btn-xs btn-primary" onclick="updateOrder(<?php echo $value1['id']?>);">保 存</button>
									</div>
								</div>
								<!-- /form -->
								<!-- /div -->
							</div>
							</div>
						</div>
						<div id="fade<?php echo $value1['id'];?>" class="black_overlay"></div>
						<?php endforeach;?>
					<!-- /form -->
					</tbody>	

					</table>
					</div>
                </div>
            </div>

        </div>

		
    </div>

	
</div>

<!--弹出修改用户窗口-->
					<!-- div class="modal fade" id="reviseOrder" role="dialog" aria-labelledby="gridSystemModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="gridSystemModalLabel">修改订单</h4>
								</div>
								<div class="modal-body">
									<div class="container-fluid">
										<form class="form-horizontal">
											<div class="form-group ">
												<label for="sName" class="col-xs-3 control-label">订单号：</label>
												<div class="col-xs-8 ">
													<input type="email" class="form-control input-sm duiqi" id="sName" placeholder="">
												</div>
											</div>
											<div class="form-group">
												<label for="sLink" class="col-xs-3 control-label">点歌人：</label>
												<div class="col-xs-8 ">
													<input type="" class="form-control input-sm duiqi" id="sLink" placeholder="">
												</div>
											</div>
											<div class="form-group">
												<label for="sOrd" class="col-xs-3 control-label">点歌人手机：</label>
												<div class="col-xs-8">
													<input type="" class="form-control input-sm duiqi" id="sOrd" placeholder="">
												</div>
											</div>
											<div class="form-group">
												<label for="sKnot" class="col-xs-3 control-label">赠送人：</label>
												<div class="col-xs-8">
													<input type="" class="form-control input-sm duiqi" id="sKnot" placeholder="">
												</div>
											</div>
											<div class="form-group">
												<label for="sKnot" class="col-xs-3 control-label">赠送人手机：</label>
												<div class="col-xs-8">
													<input type="" class="form-control input-sm duiqi" id="sKnot" placeholder="">
												</div>
											</div>
											<div class="form-group">
												<label for="sKnot" class="col-xs-3 control-label">歌手：</label>
												<div class="col-xs-8">
													<input type="" class="form-control input-sm duiqi" id="sKnot" placeholder="">
												</div>
											</div>
											<div class="form-group">
												<label for="sKnot" class="col-xs-3 control-label">歌曲：</label>
												<div class="col-xs-8">
													<input type="" class="form-control input-sm duiqi" id="sKnot" placeholder="">
												</div>
											</div>
											<div class="form-group">
												<label for="sKnot" class="col-xs-3 control-label">时间：</label>
												<div class="col-xs-8">
													<input type="" class="form-control input-sm duiqi" id="sKnot" placeholder="">
												</div>
											</div>
											<div class="form-group">
												<label for="situation" class="col-xs-3 control-label">状态：</label>
												<div class="col-xs-8">
													<label class="control-label" for="anniu">
														<input type="radio" name="situation" id="normal">正常</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="control-label" for="meun">
														<input type="radio" name="situation" id="forbid"> 禁用</label>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
									<button type="button" class="btn btn-xs btn-green">保 存</button>
								</div>
							</div>
							
						</div>
						
					</div-->
					

					<!--弹出删除用户警告窗口-->
					<!-- div class="modal fade" id="deleteOrder" role="dialog" aria-labelledby="gridSystemModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="gridSystemModalLabel">提示</h4>
								</div>
								<div class="modal-body">
									<div class="container-fluid">
										确定要删除该订单？删除后不可恢复！
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-xs btn-white" data-dismiss="modal">取 消</button>
									<button type="button" class="btn  btn-xs btn-danger">保 存</button>
								</div>
							</div>
						</div>
					</div-->


<!-- Bottom Scripts -->
<script src="js/bootstrap.min.js"></script>
<script src="js/TweenMax.min.js"></script>
<script src="js/resizeable.js"></script>
<script src="js/joinable.js"></script>
<script src="js/xenon-api.js"></script>
<script src="js/xenon-toggles.js"></script>


<!-- JavaScripts initializations and stuff -->
<script src="js/xenon-custom.js"></script>

</body>
</html>