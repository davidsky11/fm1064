<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Xenon Boostrap Admin Panel" />
    <meta name="author" content="" />
    <title>麦可FM管理系统</title>
    <link rel="stylesheet" href="css/fonts/linecons/css/linecons.css">
    <link rel="stylesheet" href="css/fonts/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/xenon-core.css">
    <link rel="stylesheet" href="css/xenon-forms.css">
    <link rel="stylesheet" href="css/xenon-components.css">
    <link rel="stylesheet" href="css/xenon-skins.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/back.css"/>
    <script src="js/jquery-1.11.1.min.js"></script>

	<script type="text/javascript">

		function modPrice(id) {
			var price = document.getElementById("price" + id).value;
            var desc = document.getElementById("desc" + id).value;
			$.ajax({
				type:'GET',
				url:"<?php echo HOSTNAME?>"+"index.php?r=site/modPrice",
				data:{
					id:id,
					price:price,
                    desc:desc
					},
				dataType:'json',
				success:function(data){
					if(data==null){
						alert("修改价格失败!");
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
                        <img src="images/back/logo.jpg" width="120" alt="" />
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
				<span>
					<a href="index.php?r=loginout/index">退出</a>
				</span>
			</ul>

            <ul id="main-menu" class="main-menu">
                <li class="opened">
                    <a href="#">
                        <span class="title">用户管理</span>
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

        <!-- User Info, Notifications and Menu Bar -->
        <nav class="navbar user-info-navbar" role="navigation">
            <!-- Right links for user info navbar -->
            <ul class="user-info-menu right-links list-inline list-unstyled margin-r-10">
				
				<div style="position:relative; left:60px; margin: auto 0; top:12px; height: 50px;">
				</div>
            </ul>

        </nav>
        <!-- Table Styles -->
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default padding-r-50">
                    <div class="panel-heading">
                        <h3 class="panel-title">修改支付价格</h3>
                    </div>
                    <div class="panel-body panel-border padding-top-10">

                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-model-2 table-hover table-lo">
                                    <thead>
                                    <tr>
                                        <td>套餐名称</td>
										<td>描述</th>
                                        <th>价格（单位: 元）</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($data as $key1 => $value1):?>
										<tr>
                                            <td>
                                                <?php echo $value1['name'];?>
                                            </td>
											<td>
                                                <input id="desc<?php echo $value1['id']?>" name="desc<?php echo $value1['id']?>" type="text" value="<?php echo $value1['description']?>" size="20"/>
											</td>
											<td>
												<input id="price<?php echo $value1['id']?>"
												name="price<?php echo $value1['id']?>" type="text" value="<?php echo $value1['price']?>" size="10"/> <span style="text-color: darkblue;"> 元 </span>
											</td>
											<td>
												<input name="" type="button" value="修改" onclick='javascript: modPrice(<?php echo $value1["id"]?>)' />
											</td>
										</tr>
									<?php endforeach;?>
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

<!-- Bottom Scripts -->
<script src="js/bootstrap.min.js"></script>
<script src="js/TweenMax.min.js"></script>
<script src="js/resizeable.js"></script>
<script src="js/joinable.js"></script>
<script src="js/xenon-api.js"></script>
<script src="js/xenon-toggles.js"></script>



<!-- Imported scripts on this page -->
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/timepicker/bootstrap-timepicker.min.js"></script>

<!-- JavaScripts initializations and stuff -->
<script src="js/xenon-custom.js"></script>

</body>
</html>