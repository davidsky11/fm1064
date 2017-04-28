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

    <style type="text/css">
        .stepdiv{position: relative; top: 5px; bottom: 5px;}
    </style>

    <script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-table.min.js"></script>
	<script src="js/bootstrap-table-zh-CN.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$("#i_1").load(function() {
				var url=$("#i_1").contents().find("#pic").html();
				if (url != null)
				{
					$("#tag_img").attr("src", url);
				}
			});

            $('#id_select').change(function(){
                var id = $('#id_select').val();
                var name = $("#name" + id).val();
                var title = $("#title" + id).val();
                var location = $("#location" + id).val();
                var description = $("#description" + id).val();

                $('#bannerId').attr("value", id);
                var url = "<?php echo HOSTNAME?>"+"images/banner/"+location;
                $("#tag_img").attr("src", url);
                $('#title').attr("value", title);
                $('#name').attr("value", name);
                $('#description').val(description);
            })
		});

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
		  
        </nav>

        <!-- Table Styles -->
        <div >
            <div id="toolbar" class="fixed-table-toolbar" style="margin-bottom: -40px">

                <div class="panel panel-default padding-r-50">
                    <div class="panel-heading">
                        <h3 class="panel-title">广告页管理</h3>
					</div>

                    <div class="panel-body" style="overflow-x:auto">
                        <span style="font-size: 18px; color: darkblue;">当前广告页信息（列表）：</span>
                        （<span style="font-size: 12px; color:darkred;">注意：管理员只需要上传图片和修改标题即可。 图片建议尺寸：610x280像素。</span>）
                        <br/>
                        <table border="1">
                            <tr>
                                <th>广告编号</th>
                                <th>广告页名称</th>
                                <th>广告标题</th>
                                <th>图片名称</th>
                                <th cols="2">广告描述</th>
                            </tr>

                        <?php foreach($data as $key1 => $value1):?>
                            <tr>
                                <td style="text-align:center;">
                                    <input id="id<?php echo $value1['id'] ?>" value="<?php echo $value1['id'] ?>" readonly/>
                                </td>
                                <td style="text-align:center;">
                                    <input id="name<?php echo $value1['id'] ?>" value="<?php echo $value1['name'] ?>" readonly/>
                                </td>
                                <td style="text-align:center;">
                                    <input id="title<?php echo $value1['id'] ?>" value="<?php echo $value1['title'] ?>" readonly/>
                                </td>
                                <td style="text-align:center;">
                                    <input id="location<?php echo $value1['id'] ?>" value="<?php echo $value1['location'] ?>" readonly/>
                                </td>
                                <td>
                                    <input id="description<?php echo $value1['id'] ?>" value="<?php echo $value1['description'] ?>" readonly/>
                                </td>

                            </tr>
                        <?php endforeach;?>
                        </table>
                    </div>

                    <div style="display: block; width:50%; ">
                        <span>&nbsp;</span>
                    </div>

					<div class="panel-body" >

						<form enctype="multipart/form-data" action="index.php?r=site/setBanner" method="post" target="upload_target">
                            <div style="position:relative; top:5px; bottom:5px;left:5px">

                                <div class="stepdiv">
                                    <span style="font-size: 18px; color: darkblue;">1、选择需要修改的广告页： </span>
                                    <select id="id_select" name="select">
                                        <?php foreach($data as $key1 => $value1):?>
                                            <option value="<?php echo $value1['id'] ?>"><?php echo $value1['name']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>

                                <div class="stepdiv">
                                    <input type="text" id="bannerId" name="bannerId" value="" style="display:none;"/>
                                    <div>
                                        <div style="float:right; width:49%; height:280px; border:1px solid #000;">
                                            <img id="tag_img" src="" style="width:100%; height:280px;" />
                                        </div>
                                    </div>
                                    <div>
                                        <span>广告标题：</span>
                                        <input type="text" id="title" name="title" value="" />
                                    </div>
                                    <div>
                                        <span>广告简称：</span>
                                        <input type="text" id="name" name="name" value="" /><br/>
                                    </div>
                                   <div>
                                       <span style="float: top;">广告描述：</span>
                                       <textarea id="description" name="description" rows="3" cols="22" style="" ></textarea>
                                   </div>
                                </div>

                                <div style="display: block; width:50%; ">
                                    <span>&nbsp;</span>
                                </div>

                                <div class="stepdiv">
                                    <div>
                                        <span style="display:inline; font-size: 18px; color: darkblue;">2、选择广告文件：</span>
                                        <input type="file" id="img" name="img" class="file" value="" style="display:inline;" />
                                    </div>

                                </div>

                                <div style="display: block; width:50%; ">
                                    <span>&nbsp;</span>
                                </div>

                                <div class="stepdiv" style="top: 10px;">
                                    <span style="font-size: 18px; color: darkblue;">3、提交需要修改的信息：</span>
                                    <input type="submit" name="uploadimg" value=" 提 交 "
                                    style="background:darkblue;border-bottom:#1dab59 2px solid;position:relative; top:0px; bottom:0;left:0px"/>
                                </div>

                                <div style="display: block; width:50%; ">
                                    <span>&nbsp;</span>
                                </div>

                                <div style="float:left; width:49%; height:280px border:1px solid #F00; display:block;">
                                    <!-- span style="color: darkblue; position:relative; top: 20px;">新上传图片:</span -->
                                    <iframe id="i_1" name="upload_target" ></iframe><br/>
                                </div>
                            </div>
						</form>

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

<!-- JavaScripts initializations and stuff -->
<script src="js/xenon-custom.js"></script>

</body>
</html>