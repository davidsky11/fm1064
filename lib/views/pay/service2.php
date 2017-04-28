<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Xenon Boostrap Admin Panel" />
    <meta name="author" content="" />

    <title>麦可FM管理系统</title>

	<link rel="stylesheet" href="css/googleapi-fonts.css"/>
	<link rel="stylesheet" href="css/googleapi-fonts1.css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/style.css">

    <script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-table.min.js"></script>
	<script src="js/bootstrap-table-zh-CN.min.js"></script>

	<script type="text/javascript">
		
	$(function(){
		//日期选择
		var currYear = (new Date()).getFullYear();	
		var opt={};
		opt.date = {preset : 'date'};
		opt.datetime = {preset : 'datetime'};
		opt.time = {preset : 'time'};
		opt.default = {
			theme: 'android-ics light',		//皮肤样式
			display: 'modal',				//显示方式 
			mode: 'scroller',				//日期选择模式
			dateFormat: 'yyyy-mm-dd',		//日期格式
			lang: 'zh',
			showNow: true,
			nowText: "今天",
			startYear: currYear - 50,		//开始年份
			endYear: currYear + 10			//结束年份
		};

		$("#songTime").mobiscroll($.extend(opt['date'], opt['default']));

	});

	function submitOrder(){
		$.ajax({
			type: "POST",
			url: "pay/order.php",
			data: {
				buyerName: $("#buyerName").val(),
				buyerSex: $("#buyerSex").val(),
				buyerPhone: $("#buyerPhone").val(),
				userName: $("#userName").val(),
				userSex: $("#userSex").val(),
				userPhone: $("#userPhone").val(),
				songer: $("#songer").val(),
				songName: $("#songName").val(),
				songTime: $("#songTime").val(),
				price: $("#price").val(),
				blessings: $("#blessings").val()
			},
			dataType: "json",
			success: function(data){
					// 做出相应的处理
					alert(data);
				}
		});
	}

	</script>

	<style id="style-1-cropbar-clipper">
	.en-markup-crop-options {
		top: 18px !important;
		left: 50% !important;
		margin-left: -100px !important;
		width: 200px !important;
		border: 2px rgba(255,255,255,.38) solid !important;
		border-radius: 4px !important;
	}

	.en-markup-crop-options div div:first-of-type {
		margin-left: 0px !important;
	}
	</style>

</head>
<body>

<div class="header">
    <div class="container">

        <div class="row">
			<div class="logo span4">
				<h1>麦可FM<span class="red">.</span></h1>
			</div>
		</div>
	</div>
</div>

<div class="register-container container">
	<div class="row">
		<div class="register span6">
			<form action="pay/order.php" method="post" _lpchecked="1">
				<h2>我要点歌<span class="red"><strong>我要点歌</strong></span></h2>

				<label for="buyerName">点歌人</label>
				<input type="text" id="buyerName" name="buyerName" placeholder="点歌人姓名" style="cursor: pointer; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; background-repeat: no-repeat;">

				<label for="buyerPhone">点歌人手机</label>
				<input text="text" id="buyerPhone" name="buyerPhone" placeholder="点歌人手机">

				<label for="userName">被赠人姓名</label>
                <input type="text" id="userName" name="userName" placeholder="被赠人姓名">

				<label for="userPhone">被赠人手机</label>
                <input type="text" id="userPhone" name="userPhone" placeholder="被赠人手机">

				<label for="userName">被赠人姓名</label>
                <input type="text" id="userName" name="userName" placeholder="被赠人姓名">

				<label for="songer">歌手名</label>
                <input type="text" id="songer" name="songer" placeholder="歌手名">

				<label for="songName">歌名</label>
                <input type="text" id="songName" name="songName" placeholder="歌名">

				<label for="songTime">点歌时间</label>
                <input type="text" id="songTime" name="songTime" placeholder="点歌时间" readonly >

				<label for="blessings">祝福语</label>
                <input type="text" id="blessings" name="blessings" placeholder="祝福语">
				
				<input type="button">支付</input>
			</form>
		</div>
	</div>
</div>

<div align="center">Copyright © 2014.Company name All rights reserved.</div>

<!-- Javascript -->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/scripts.js"></script>
		
</body>
</html>