<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />

		<title>我要点歌</title>
		<link href="css/zhuce.css" type="text/css" rel="stylesheet" />
		<link href="css/common.css" rel="stylesheet" type="text/css" />
		<link href="css/mobiscroll.css" rel="stylesheet" />
		<link href="css/mobiscroll_date.css" rel="stylesheet" />
		<link rel="stylesheet" href="css/normalize3.0.2.min.css" />
		<link rel="stylesheet" href="css/style.css?v=7" />
		<link href="css/bs.css" rel="stylesheet">
		<link href="css/index.css" rel="stylesheet">

		<!-- WAP ADD START -->
		<meta name="viewport" content="width=device-width, initial-scale=0.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="format-detection" content="email=no">
		<!-- WAP ADD END -->

		<script src="js/jquery.min.js"></script> 
		<script src="js/mobiscroll_date.js" charset="gb2312" ></script> 
		<script src="js/mobiscroll.js"></script> 

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

			function setSession(){
				alert("###");
				$.session.clear();  // 清除数据

				$.session.set('buyerName', $("#buyerName").val());
				$.session.set('buyerSex', $("#buyerSex").val());
				$.session.set('buyerPhone', $("#buyerPhone").val());
				$.session.set('buyerName', $("#buyerName").val());
				$.session.set('userName', $("#userName").val());
				$.session.set('userSex', $("#userSex").val());
				$.session.set('userPhone', $("#userPhone").val());
				$.session.set('songer', $("#songer").val());
				$.session.set('songName', $("#songName").val());
				$.session.set('songTime', $("#songTime").val());
				$.session.set('blessings', $("#blessings").val());
				alert("设置session成功...");
			}

			/*function submitOrder(){
				alert(" # # # ");
				var buyerName = document.getElementById("buyerName").value;
				var buyerSex = document.getElementById("buyerSex").value;
				var buyerPhone = document.getElementById("buyerPhone").value;
				var userName = document.getElementById("userName").value;
				var userSex = document.getElementById("userSex").value;
				var userPhone = document.getElementById("userPhone").value;
				var songer = document.getElementById("songer").value;
				var songName = document.getElementById("songName").value;
				var blessings = document.getElementById("blessings").value;
				var songTime = document.getElementById("songTime").value;
				var price = document.getElementById("price").value;

				alert(buyerName + " " + buyerPhone + " " + userName + " " + userPhone + " " + price);

				var url = "pay/order.php?buyerName=" +buyerName+ "&buyerPhone=" +buyerPhone+ "&userName=" +userName+ "&userPhone=" +userPhone+ "&songer=" +songer+ "&songName=" +songName+ "&songTime=" +songTime+ "&price=" +price+ "&blessings=" +blessings;

				window.location.href = url + "&backurl=" +window.location.href;
			}*/
			
		</script>

		<script>
		if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
			var msViewportStyle = document.createElement('style')
			msViewportStyle.appendChild(
					document.createTextNode(
							'@-ms-viewport{width:auto!important}'
					)
			)
			document.querySelector('head').appendChild(msViewportStyle)
		}

		</script>
	</head>
   
	<body>
		<form action="pay/order.php" method="post">
		<div class="panel" style="background: url(images/back/back.png)" >
			<div class="top_3"></div>
			<div class="top_2">
				<div class="top_4"><img src="images/person.png" alt="" /></div>
				<div class="top_5">
					<input type="text" id="buyerName" name="buyerName"  placeholder="请输入自己的名字" required/>
				</div>
			</div>
			<div class="top_8" style="margin-top:5px">
				<div class="top_9">
					<input type="radio" id="buyerSex" name="buyerSex" value="0" />&nbsp;先生</div>
				<div class="top_10">
					<input type="radio" id="buyerSex" name="buyerSex" value="1" />&nbsp;女士</div>
			</div>
			<div class="top_2">
				<div class="top_4"><img src="images/phone.png" alt="" /></div>
				<div class="top_5">
					<input type="text" id="buyerPhone" name="buyerPhone"  placeholder="请输入自己的手机号" required/>
				</div>
			</div>
			<div class="top_11">送给：</div>
			<div class="top_2">
				<div class="top_4"><img src="images/person.png" alt="" /></div>
				<div class="top_5">
					<input type="text" id="userName" name="userName" placeholder="请输入赠予者的名字" required/>
				</div>
			</div>
			<div class="top_8" style="margin-top:5px">
				<div class="top_9">
					<input type="radio" id="userSex" name="userSex" value="0" />&nbsp;先生</div>
				<div class="top_10">
					<input type="radio" id="userSex" name="userSex" value="1" />&nbsp;女士</div>
			</div>
			<div class="top_2">
				<div class="top_4"><img src="images/phone.png" alt="" /></div>
				<div class="top_5">
					<input type="text" id="userPhone" name="userPhone"  placeholder="请输入赠予者的手机号" required/>
				</div>
			</div>
			<div class="top_2" style="margin-top:15px">
				<div class="top_4"><img src="images/person.png" alt="" /></div>
				<div class="top_5">
					<input type="text" id="songer" name="songer" placeholder="请输入歌手名" required />
				</div>
			</div>
			<div class="top_2" style="margin-top:15px">
				<div class="top_4"><img src="images/music.jpg" alt="" /></div>
				<div class="top_5">
					<input type="text" id="songName" name="songName" placeholder="请输入歌曲名" required/>
				</div>
			</div>
			<div class="top_2" style="margin-top:15px">
				<div class="top_4"><img src="images/time.jpg" alt="" /></div>
				<div class="top_5">
					<div class="demo">
						<div class="lie"><input id="songTime" name="songTime" type="text" readonly class="kbtn" placeholder="请输入时间" required/></div>
					</div>
				</div>
			</div>
			<div class="top_2" style="margin-top:15px">
				<div class="top_4"><img src="images/price.jpg" alt="" /></div>
				<div width="30px">
					<select id="price" name="price" class="jw" placeholder="金额" readonly="readonly">
						<?php foreach($data as $key1 => $value1):?>
							<option value="<?php echo $value1['price']?>">
								<?php echo $value1['name']?>:&nbsp;<?php echo $value1['desc']?> &nbsp;<?php echo $value1['price']/100;?>/
							</option>
						<?php endforeach;?>
					</select>元
				</div>
			</div>

			<div class="top_12" style="margin-top:15px">
				<div class="top_4"><img src="images/bless.jpg" alt="" /></div>
				<div>
					<div class="top_13"></div>
					<textarea id="blessings" rows="6" placeholder="请输入祝福语" name="blessings" required></textarea>
				</div>
			</div>
			<div class="top_16" style="margin-top:15px">
				<div class="top_15">
					<input type="submit" value="提交订单">
				</div>
			</div>
		</div>
		</form>
	</body>
</html>