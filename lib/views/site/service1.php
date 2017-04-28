<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<title>我要点歌</title>
		<link type="text/css" rel="stylesheet" href="css/zhuce.css" />
		<link href="css/common.css" rel="stylesheet" type="text/css" />
	
		<!-- WAP ADD START -->
		<meta name="viewport" content="width=device-width, initial-scale=0.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="format-detection" content="email=no">
		<!-- WAP ADD END -->

		<script type="text/javascript" src="js/jquery-1.11.1.js" ></script>
		<script type="text/javascript" src="js/date.js" ></script>
		<script type="text/javascript" src="js/iscroll.js" ></script>
		<script type="text/javascript">
			$(function(){
				$('#beginTime').date();
				$('#endTime').date({theme:"datetime"});
			});
		</script>
	</head>
   
	<body>
		<form action="admin/category/doAction1.php" method="post">
			<!--<div class="top_1">
				<div class="top_6"><img src="img/a9.png" alt="" /></div>
				<div class="top_7">我的订单</div>
			</div>-->
			<div class="top_3"></div>
			<div class="top_2">
				<div class="top_4"><img src="images/person.png" alt="" /></div>
				<div class="top_5">
					<input type="text" name="username"  placeholder="请输入自己的名字"  required/>
				</div>
			</div>
			<div class="top_8" style="margin-top:5px">
				<div class="top_9">
					<input type="radio" name="sex" value="男" />&nbsp;先生</div>
				<div class="top_10">
					<input type="radio" name="sex" value="女" />&nbsp;小姐</div>
			</div>
			<div class="top_2">
				<div class="top_4"><img src="images/phone.png" alt="" /></div>
				<div class="top_5">
					<input type="text" name="tel"  placeholder="请输入自己的手机号" required />
				</div>
			</div>
			<div class="top_11">送给：</div>
			<div class="top_2">
				<div class="top_4"><img src="images/person.png" alt="" /></div>
				<div class="top_5">
			 <input type="text" name="zcname"  placeholder="请输入赠予者的名字"  required/>
				</div>
			</div>
			<div class="top_8" style="margin-top:5px">
				<div class="top_9">
					<input type="radio" name="giversex" value="男" />&nbsp;先生</div>
				<div class="top_10">
					<input type="radio" name="giversex" value="女" />&nbsp;小姐</div>
			</div>
			<div class="top_2">
				<div class="top_4"><img src="images/phone.png" alt="" /></div>
				<div class="top_5">
					<input type="text" name="givertel"  placeholder="请输入赠予者的手机号" required/>
				</div>
			</div>
			<div class="top_2" style="margin-top:15px">
				<div class="top_4"><img src="images/music.jpg" alt="" /></div>
				<div class="top_5">
					<input type="text" name="music"  placeholder="请输入歌曲名" required />
				</div>
			</div>
			<div class="top_2" style="margin-top:15px">
				<div class="top_4"><img src="images/person.png" alt="" /></div>
				<div class="top_5">
					<input type="text" name="songer"  placeholder="请输入歌手名" required />
				</div>
			</div>
			<div class="top_2" style="margin-top:15px">
				<div class="top_4"><img src="images/time.jpg" alt="" /></div>
				<div class="top_5">
					<div class="demo">
	<div class="lie"><input id="endTime" class="kbtn" name="time" placeholder="请输入时间" required/></div>
</div>
		<div id="datePlugin"></div>
				</div>
			</div>
			<div class="top_2" style="margin-top:15px">
				<div class="top_4"><img src="images/price.jpg" alt="" /></div>
				<div class="top_5">
					<input type="text" name="price" class="jw" placeholder="金额" value="0" readonly="readonly" />元
				</div>
			</div>
			<div class="top_12" style="margin-top:15px">
				<div class="top_4"><img src="images/bless.jpg" alt="" /></div>
				<div>
					<div class="top_13"></div>
					<textarea rows="6"  placeholder="请输入祝福语" name="sentiment" required></textarea>
				</div>
			</div>
			<div class="top_16" style="margin-top:15px">
				<!--<div class="top_14">选择时间</div>-->
				<div class="top_15"><input type="submit" value="支付"></div>
			</div>
		</form>
	</body>
</html>