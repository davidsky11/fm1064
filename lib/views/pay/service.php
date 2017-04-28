<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>我要点歌</title>

		<!-- WAP ADD START -->
		<meta name="viewport" content="width=device-width, initial-scale=0.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="format-detection" content="email=no">
		<!-- WAP ADD END -->

        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">

        <!-- Custom Google font -->
        <link href='http://fonts.googleapis.com/css?family=Lato:400' rel='stylesheet' type='text/css'>
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/styles.min.css" rel="stylesheet">
		<link href="css/mobiscroll.css" rel="stylesheet" />
		<link href="css/mobiscroll_date.css" rel="stylesheet" />

		<link rel="stylesheet" href="image/style.css" type="text/css" />

		<!-- Javascript -->
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/scripts.min.js"></script>
		<script src="js/mobiscroll_date.js" charset="gb2312" ></script> 
		<script src="js/mobiscroll.js"></script> 
		
		<!-- script type="text/javascript" src="js/jquery.js"></script -->
		<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>

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
				var buyerSex = $("input:radio[name=buyerSex]:checked").val();   
				var userSex = $("input:radio[name=userSex]:checked").val();   
				//alert(buyerSex + "  " + userSex);

				$.post({
					type: "POST",
					url: "pay/order.php",
					data: {
						buyerName: $("#buyerName").val(),
						buyerSex: buyerSex,
						buyerPhone: $("#buyerPhone").val(),
						userName: $("#userName").val(),
						userSex: userSex,   
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

		<div class="block_home_slider">
			<div id="home_slider" class="flexslider">
				<ul class="slides">
					<!-- li>
						<div class="slide">
							<img src="images/banner/banner1.jpg" alt="" />
							<div class="caption">
								<p class="title">魅力武汉·品质广播</p>
							</div>
						</div>
					</li>
					
					<li>
						<div class="slide">
							<img src="images/banner/banner2.jpg" alt="" />
							<div class="caption">
								<p class="title">魅力武汉·品质广播</p>
							</div>
						</div>
					</li>
					
					<li>
						<div class="slide">
							<img src="images/banner/3.jpg" alt="" />
							<div class="caption">
								<p class="title">魅力武汉·品质广播</p>
								</div>
						</div>
					</li>
					
					<li>
						<div class="slide">
							<img src="images/banner/4.jpg" alt="" />
							<div class="caption">
								<p class="title">魅力武汉·品质广播</p>
							</div>
						</div>
					</li -->
					<!-- p>90天让您的网站升级100倍。国内金准营销服务中心.国内金准营销服务中心国内金准营销服务中心国内金准营销服务中心国内金准营销服务中心</p -->

					<?php foreach($data[0] as $key0 => $value0):?>
						<li>
							<div class="slide">
								<img src="images/banner/<?php echo $value0['location']?>" alt="<?php echo $value0['name']?>" />
								<div class="caption">
									<p class="title"><?php echo $value0['title']?></p>
								</div>
							</div>
						</li>
					<?php endforeach;?>
				</ul>
			</div>

			<script type="text/javascript">
				$(function () {
					$('#home_slider').flexslider({
						animation : 'slide',
						controlNav : true,
						directionNav : true,
						animationLoop : true,
						slideshow : false,
						useCSS : false
					});
					
				});
			</script>
		</div>

        <div id="phizzForm" class="form">
            <form action="pay/order.php" method="post">
                <div class="formPanel">
                    <!-- h2>我要点歌</h2 -->
                    <p>请将点歌信息填入填写完毕，然后提交订单，谢谢！</p>
                    <div class="errors"><i class="icon-exclamation-sign"></i>
						Oops! You&#39;ve entered some incorrect details.</div>
                    <fieldset>
                        <legend>麦可FM点歌</legend>
                        <div class="formRow">
                            <label for="buyerName">点歌人姓名</label>
                            <span class="inputAddOn"><i class="icon-user"></i></span>
                            <input type="text" value="" placeholder="点歌人姓名" name="buyerName" id="buyerName" required>
                            <div class="tooltip"><p>您的姓名？</p><i class="icon-caret-down"></i></div>
                        </div>
						<div class="formRow">
							<input type="radio" name="buyerSex" value="0"><label class="radioLabel">男</label>
                            <input type="radio" name="buyerSex" value="1"><label class="radioLabel">女</label>
                        </div>
						<div class="formRow">
                            <label for="buyerPhone">点歌人手机</label>
                            <span class="inputAddOn"><i class="icon-phone"></i></span>
                            <input type="tel" value="" placeholder="点歌人手机" name="buyerPhone" id="buyerPhone" required>
                            <div class="tooltip"><p>您的手机号码？</p><i class="icon-caret-down"></i></div>
                        </div>
						<div class="formRow">
                            <label for="userName">听歌人姓名</label>
                            <span class="inputAddOn"><i class="icon-user"></i></span>
                            <input type="text" value="" placeholder="听歌人姓名" name="userName" id="userName" required>
                            <div class="tooltip"><p>您想点歌给谁听？</p><i class="icon-caret-down"></i></div>
                        </div>
						<div class="formRow">
							<input type="radio" name="userSex" value="0"><label class="radioLabel">男</label>
                            <input type="radio" name="userSex" value="1"><label class="radioLabel">女</label>
                        </div>
						<div class="formRow">
                            <label for="userPhone">听歌人手机</label>
                            <span class="inputAddOn"><i class="icon-phone"></i></span>
                            <input type="tel" value="" placeholder="听歌人手机" name="userPhone" id="userPhone" required>
                            <div class="tooltip"><p>听歌人的手机号码？</p><i class="icon-caret-down"></i></div>
                        </div>

                        <div class="formRow">
                            <label for="songer">歌手名</label>
                            <span class="inputAddOn"><i class="icon-user"></i></span>
                            <input type="text" value="" placeholder="歌手名" name="songer" id="songer" required>
                            <div class="tooltip"><p>您想点谁的歌？</p><i class="icon-caret-down"></i></div>
                        </div>
                        <div class="formRow">
                            <label for="songName">歌曲名</label>
                            <span class="inputAddOn"><i class="icon-music"></i></span>
                            <input type="text" value="" placeholder="歌曲名" name="songName" id="songName" required>
                            <div class="tooltip"><p>您要点什么歌曲？</p><i class="icon-caret-down"></i></div>
                        </div>
                        <div class="formRow">
                            <label for="songTime">播出时间</label>
                            <span class="inputAddOn"><i class="icon-time"></i></span>
                            <input type="text" value="" placeholder="播出时间" name="songTime" id="songTime" readonly="readonly" required>
                            <div class="tooltip"><p>您想什么时候播出这首歌呢？</p><i class="icon-caret-down"></i></div>
                        </div>
						<div class="formRow">
							<span class="inputAddOn"><i class="icon-money"></i></span>
							<select id="price" name="price" placeholder="金额" readonly="readonly">
								<?php foreach($data[1] as $key1 => $value1):?>
								<option value="<?php echo $value1['price']?>">
									<?php echo $value1['name']?>:<?php echo $value1['description']?> &nbsp;
									<span style="color: red;">￥<?php echo $value1['price'];?></span>元
								</option>
								<?php endforeach;?>
                            </select>
							<div class="tooltip"><p>您想选择什么套餐？</p><i class="icon-caret-down"></i></div>
						</div>

                        <div class="formRow">
                            <label for="blessings">祝福语</label>
                            <span class="inputAddOn"><i class="icon-gift"></i></span>
                            <!-- input type="text" value="" placeholder="祝福语" name="blessings" id="blessings" -->
							<!-- textarea placeholder="祝福语" name="blessings" id="blessings" onblur="if(this.innerHTML==''){this.innerHTML='祝福语';this.style.color='#D1D1D1'}") onKeyUp="if (this.value.length>=20){event.returnValue=false}"></textarea -->
							<input type="text" value="" placeholder="祝福语" name="blessings" id="blessings" maxlength="25">
                            <div class="tooltip"><p>您想给TA说点什么呢？</p><i class="icon-caret-down"></i></div>
                        </div>
                        <button style="background:#2ecc71;border-bottom:#1dab59 2px solid;position:absolute;bottom:0;left:120px" onclick="submitOrder();">&nbsp;&nbsp;提&nbsp;&nbsp;交&nbsp;&nbsp;</button>
                    </fieldset>
                </div>
            </form>
        </div>

        <script>
            $('body').phizzForms({
            });
        </script>

		<div style="text-align:center;clear:both">
	</div>

</body>
</html>