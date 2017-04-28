<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Xenon Boostrap Admin Panel" />
    <meta name="author" content="" />

    <title>麦可FM管理系统</title>

    <link rel="stylesheet" href="http://fonts.useso.com/css?family=Arimo:400,700,400italic">
    <link rel="stylesheet" href="../css/fonts/linecons/css/linecons.css">
    <link rel="stylesheet" href="../css/fonts/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/xenon-core.css">
    <link rel="stylesheet" href="../css/back.css"/>

    <script src="../js/jquery-1.11.1.min.js"></script>

</head>
<body>

<div class="page-container">
    <div class="sidebar-menu  toggle-others fixed">
        <div class="sidebar-menu-inner">
            <header class="logo-env">

                <!-- logo -->
                <div class="logo">
                    <a href="dashboard-1.html" class="logo-expanded">
                        <img src="../img/back/logo.jpg" width="150" alt="" />
                    </a>

                    <a href="dashboard-1.html" class="logo-collapsed">
                        <img src="../img/back/logo.jpg" width="40" alt="" />
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

            <ul id="main-menu" class="main-menu">
                <li class="opened">
                    <a href="#">
                        <span class="title">用户管理</span>
                    </a>
                    <ul>
                        <li class="active">
                            <a href="../index.php">
                                <span class="title">查询定单</span>
                            </a>
                        </li>
                        <li>
                            <a href="../dd.php">
                                <span class="title">设置价格</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">

        <!-- User Info, Notifications and Menu Bar -->
        <nav class="navbar user-info-navbar" role="navigation">
		<!-- Right links for user info navbar -->
            <ul class="user-info-menu right-links list-inline list-unstyled margin-r-10">

                <li class="dropdown user-profile">
                    <a href="../public/exit.php" data-toggle="dropdown">
                            退出
                    </a>

                    <ul class="dropdown-menu user-profile-menu list-unstyled">
                        <li class="last">
							<a href="#">
								<i class="fa-lock"></i>返回
							</a>
							<br/>
                            <a href="../public/exit.php">
                                <i class="fa-lock"></i>退出
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>

        </nav>
        <!-- Table Styles -->
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default padding-r-50">
                    <div class="panel-heading">
                        <h3 class="panel-title">修改客户信息</h3>
                    </div><form action="doAction2.php" method="post">
                    <div class="panel-body panel-border padding-top-10">

                        <div class="row">
                            <div class="col-sm-12">
                               
                            </div>
                            <div class="col-sm-12">

                                <table class="table table-model-2 table-hover table-lo" border="1">
                                    <thead>
									                                    <tr>
										<th>订单号</th>
										<td width="90%" align="left">201601280751522034</td>
                                    </tr>
                                    </thead>
									<tbody>
										<tr>
											<th>点歌人名字</th>
											<td><input type="hidden" name="id" value="792"/><input type="text" value="" name="username" size="40" /></td>
										</tr>
									</tbody>
									<tbody>
										<tr>
										    <th>点歌人性别</th>
											<td><input type="radio" name="sex" value="男"  />&nbsp;先生
												<input type="radio" name="sex" value="女"  />&nbsp;女士</td>
										</tr>
									</tbody>
									<tbody>
										<tr>
										    <th>点歌人手机号</th>
											<td><input type="text" value="" name="tel" size="40" /></td>
										</tr>
									</tbody>
									<tbody>
										<tr>
											<th>赠送人姓名</th>
											<td><input type="text" value="" name="givername" size="40" /></td>
										</tr>
									</tbody>
									<tbody>
										<tr>
										    <th>赠送人性别</th>
											<td><input type="radio" name="giversex" value="男"  />&nbsp;先生
												<input type="radio" name="giversex" value="女"  />&nbsp;女士</td>
										</tr>
									</tbody>
									<tbody>
										<tr>
										    <th>赠送人手机号</th>
											<td><input type="text" value="" name="givertel" size="40" /></td>
										</tr>
									</tbody>
									<tbody>
										<tr>
											<th>歌曲名</th>
											<td><input type="text" value="" name="music" size="40" /></td>
										</tr>
									</tbody>
									<tbody>
										<tr>
											<th>祝福语</th>
											<td><input type="text" value="" name="sentiment" size="40"/></td>
										</tr>
									</tbody>
									<tbody>
										<tr>
											<th>选择时间</th>
											<td><input type="text" value="" name="time" size="40" /></td>
										</tr>
									</tbody>
									<tbody>
										<tr>
											<th>操作</th>
											<td colspan="2"><input type="submit" value="修改"/></td>
										</tr>
									</tbody>

									                                </table>
							





                            </div>
                        </div>

                    </div>
</form>
                </div>

            </div>
        </div>
    </div>

	<!-- Modal del-->
	<div class="modal fade" id="modal-del">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">再次确定</h4>
				</div>
				
				<div class="modal-body">
				您确定要删除该管理员账号？
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
					<button type="button" class="btn btn-danger">确定删除</button>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Modal add-->
	<div class="modal fade" id="modal-add">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">添加管理员</h4>
				</div>
				
				<div class="modal-body">
				
					<div class="row">
						<div class="col-md-12">
							
							<div class="form-group">
								<label for="field-1" class="control-label">姓名</label>
								
								<input type="text" class="form-control" id="field-1" placeholder="">
							</div>	
							
						</div>
						
						<div class="col-md-12">
							
							<div class="form-group">
								<label for="field-2" class="control-label">登录邮箱</label>
								
								<input type="text" class="form-control" id="field-2" placeholder="">
							</div>	
						
						</div>
					
						<div class="col-md-12">
							
							<div class="form-group">
								<label for="field-3" class="control-label">登录密码</label>
								
								<input type="text" class="form-control" id="field-3" placeholder="">
							</div>	
							
						</div>
					
						<div class="col-md-12">
							
							<div class="form-group">
								<label for="field-4" class="control-label">重复登录密码</label>
								
								<input type="text" class="form-control" id="field-4" placeholder="">
								<span class="text-danger"><i class="fa fa-exclamation-circle"></i>两次输入的密码不一致</span>
							</div>	
							
						</div>
					</div>
				
					
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
					<button type="button" class="btn btn-secondary">添加</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal del end-->

</div>






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