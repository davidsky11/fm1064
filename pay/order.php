<?php 
session_start();  // 开启session
//header('Content-Type: application/json; charset=utf8');
ini_set('date.timezone','Asia/Shanghai');
/* Report all errors except E_NOTICE */
error_reporting(E_ALL^E_NOTICE);

require_once "./lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';

//初始化日志
$logHandler = new CLogFileHandler("./logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

Log::DEBUG("统一下单......");

//setValue("buyerName");

	//if(isset($_SESSION['buyerName'])){
	//	$_SESSION['buyerName']="";
	//}

	// 1、设置buyerName
	if (empty($_SESSION['buyerName'])) {
		$_SESSION['buyerName']=$_REQUEST['buyerName'];
	}

	if(!empty($_REQUEST['buyerName'])) {
		$_SESSION['buyerName']=$_REQUEST['buyerName'];
	}

	// 2、设置buyerSex
	if (empty($_SESSION['buyerSex'])) {
		$_SESSION['buyerSex']=$_REQUEST['buyerSex'];
	}

	if(!empty($_REQUEST['buyerSex'])) {
		$_SESSION['buyerSex']=$_REQUEST['buyerSex'];
	}

//setValue("buyerPhone");

	// 3、设置buyerPhone
	if (empty($_SESSION['buyerPhone'])) {
		$_SESSION['buyerPhone']=$_REQUEST['buyerPhone'];
	}

	if(!empty($_REQUEST['buyerPhone'])) {
		$_SESSION['buyerPhone']=$_REQUEST['buyerPhone'];
	}

//setValue("userName");

	// 4、设置userName
	if (empty($_SESSION['userName'])) {
		$_SESSION['userName']=$_REQUEST['userName'];
	}

	if(!empty($_REQUEST['userName'])) {
		$_SESSION['userName']=$_REQUEST['userName'];
	}

	// 5、设置userSex
	if (empty($_SESSION['userSex'])) {
		$_SESSION['userSex']=$_REQUEST['userSex'];
	}

	if(!empty($_REQUEST['userSex'])) {
		$_SESSION['userSex']=$_REQUEST['userSex'];
	}

//setValue("userPhone");

	// 6、设置userPhone
	if (empty($_SESSION['userPhone'])) {
		$_SESSION['userPhone']=$_REQUEST['userPhone'];
	}

	if(!empty($_REQUEST['userPhone'])) {
		$_SESSION['userPhone']=$_REQUEST['userPhone'];
	}

//setValue("songer");

	// 7、设置songer
	if (empty($_SESSION['songer'])) {
		$_SESSION['songer']=$_REQUEST['songer'];
	}

	if(!empty($_REQUEST['songer'])) {
		$_SESSION['songer']=$_REQUEST['songer'];
	}

//setValue("songName");

	// 8、设置songName
	if (empty($_SESSION['songName'])) {
		$_SESSION['songName']=$_REQUEST['songName'];
	}

	if(!empty($_REQUEST['songName'])) {
		$_SESSION['songName']=$_REQUEST['songName'];
	}

//setValue("songTime");

	// 9、设置songTime
	if (empty($_SESSION['songTime'])) {
		$_SESSION['songTime']=$_REQUEST['songTime'];
	}

	if(!empty($_REQUEST['songTime'])) {
		$_SESSION['songTime']=$_REQUEST['songTime'];
	}

//setValue("blessings");

	// 10、设置blessings
	if (empty($_SESSION['blessings'])) {
		$_SESSION['blessings']=$_REQUEST['blessings'];
	}

	if(!empty($_REQUEST['blessings'])) {
		$_SESSION['blessings']=$_REQUEST['blessings'];
	}

//setValue("price");

	//if(isset($_SESSION['price'])){
	//	$_SESSION['price']="";
	//}

	// 11、设置price
	if (empty($_SESSION['price'])) {
		$_SESSION['price']=$_REQUEST['price'];
	}

	if(!empty($_REQUEST['price'])) {
		$_SESSION['price']=$_REQUEST['price'];
	}

$a1=$_SESSION['buyerName'];
$a2=$_SESSION['buyerSex'];
$a3=$_SESSION['buyerPhone'];
$a4=$_SESSION['userName'];
$a5=$_SESSION['userSex'];
$a6=$_SESSION['userPhone'];
$a7=$_SESSION['songer'];
$a8=$_SESSION['songName'];
$a9=$_SESSION['songTime'];
$a10=$_SESSION['blessings'];
$a11=$_SESSION['price'];

//$attach="<xml><buyerName>{$a1}</buyerName><buyerSex>{$a2}</buyerSex><buyerPhone>{$a3}</buyerPhone><userName>{$a4}</userName><userSex>{$a5}</userSex><userPhone>{$a6}</userPhone><songer>{$a7}</songer><songName>{$a8}</songName><songTime>{$a9}</songTime><blessings>{$a10}</blessings><price>{$a11}</price></xml>";
//$attach=$a1.$a2.$a3.$a4.$a5.$a6.$a7.$a8.$a9.$a10.$a11;
$array=array($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11);
$attach= implode("^", $array);

	// 12、设置attach
	if (empty($_SESSION['attach'])) {
		$_SESSION['attach']=$attach;
	}

	if(!empty($attach)) {
		$_SESSION['attach']=$attach;
	}

$index = 0;

if(isset($_SESSION['index'])){
	$_SESSION['index']=$_SESSION['index']+1;
	$index = $_SESSION['index'];
} else {
	$_SESSION['index']=0;
}

Log::DEBUG("第[$index]次 buyerName: $a1 --- buyerSex: $a2 --- userSex: $a5 --- songer: $a7");

//①、获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid();

Log::DEBUG("openId: $openId");

//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody("麦可FM点歌单");

$input->SetAttach($_SESSION['attach']);  // 添加附属信息，供notify.php中处理
$att=$_SESSION['attach'];
Log::DEBUG("attach : $att");
Log::DEBUG("attach : $attach");
$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
if($_SESSION['price'] > 0)
	$input->SetTotal_fee($_SESSION['price']*100);
else
	$input->SetTotal_fee(1);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("麦可FM点歌");
$input->SetNotify_url("http://mkfm1064.com/pay/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);

$jsApiParameters = $tools->GetJsApiParameters($order);
Log::DEBUG("jsApiParameters: $jsApiParameters");

//获取共享收货地址js函数参数
$editAddress = $tools->GetEditAddressParameters();

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />

		<title>确认订单</title>
		<link type="text/css" rel="stylesheet" href="../css/zhuce.css" />
		<link href="../css/common.css" rel="stylesheet" type="text/css" />
		<link href="../css/mobiscroll.css" rel="stylesheet" />
		<link href="../css/mobiscroll_date.css" rel="stylesheet" />
		<link rel="stylesheet" href="../css/normalize3.0.2.min.css" />
		<link rel="stylesheet" href="../css/style.css?v=7" />
		<link href="../css/bs.css" rel="stylesheet">
		<link href="../css/index.css" rel="stylesheet">

		<meta name="viewport" content="width=device-width, initial-scale=0.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="format-detection" content="email=no">

		<!-- script type="text/javascript" src="http://www.bcty365.com/statics/js/ad/show_400x25.js"></script -->
		<script src="../js/jquery.min.js"></script> 
		<script src="../js/mobiscroll_date.js" charset="gb2312" ></script> 
		<script src="../js/mobiscroll.js"></script> 

		<script type="text/javascript">
		//调用微信JS api 支付
		function jsApiCall()
		{
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest',
				<?php echo $jsApiParameters; ?>,
				function(res){
					WeixinJSBridge.log(res.err_msg);
					//alert(res.err_code+res.err_desc+res.err_msg);

					// res.err_msg 将在用户支付成功后返回 ok， 但并不保证它绝对可靠
					// 支付成功
					switch(res.err_msg) {
						case 'get_brand_wcpay_request:cancel':
							alert('用户取消支付！');
							break;
						case 'get_brand_wcpay_request:fail':
							alert('支付失败！（'+res.err_desc+'）');
							break;
						case 'get_brand_wcpay_request:ok':
							alert('支付成功！现在退回订单页面');
							history.go(-1);  // 后退
							break;
						default:
							alert(JSON.stringify(res));
							break;
					}

				}
			);
		}

		function callpay()
		{
			if (typeof WeixinJSBridge == "undefined"){
				if( document.addEventListener ){
					document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
				}else if (document.attachEvent){
					document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
					document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
				}
			}else{
				jsApiCall();
			}
		}
		</script>
		<script type="text/javascript">
		//获取共享地址
		function editAddress()
		{
			WeixinJSBridge.invoke(
				'editAddress',
				<?php echo $editAddress; ?>,
				function(res){
					var value1 = res.proviceFirstStageName;
					var value2 = res.addressCitySecondStageName;
					var value3 = res.addressCountiesThirdStageName;
					var value4 = res.addressDetailInfo;
					var tel = res.telNumber;
					
					alert(value1 + value2 + value3 + value4 + ":" + tel);
				}
			);
		}
		
		/*window.onload = function(){
			if (typeof WeixinJSBridge == "undefined"){
				if( document.addEventListener ){
					document.addEventListener('WeixinJSBridgeReady', editAddress, false);
				}else if (document.attachEvent){
					document.attachEvent('WeixinJSBridgeReady', editAddress); 
					document.attachEvent('onWeixinJSBridgeReady', editAddress);
				}
			}else{
				editAddress();
			}
		};*/
		
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
	<div class="panel">
		<div style="text-align:center;">
			<span style="color: darkblue; font-size: 24px;">订单信息</span>
		</div>

		<br/>
		<!--<div class="top_2"></div>-->
		<div class="top_4">赠与方:</div>
		<div class="top_5">
			<?php echo $_SESSION['buyerName'];?>(
			<?php
				if ($_SESSION['buyerSex']==0)
					echo "男";
				else if ($_SESSION['buyerSex']==1)
					echo "女";
			?>&nbsp; <?php echo $_SESSION['buyerPhone'];?>)
		</div>

		<div class="top_2"></div>
		<div class="top_4">接收方:</div>
		<div class="top_5">
			<?php echo $_SESSION['userName'];?>(
			<?php
			if ($_SESSION['userSex']==0)
				echo "男";
			else if ($_SESSION['userSex']==1)
				echo "女";
			?>&nbsp; <?php echo $_SESSION['userPhone'];?>)
		</div>

		<div class="top_2"></div>
		<div class="top_4">歌曲信息:</div>
		<div class="top_5">
			<?php echo $_SESSION['songName'];?>(<?php echo $_SESSION['songer'];?>)
		</div>

		<div class="top_2"></div>
		<div class="top_4">播出时间:</div>
		<div class="top_5">
			<?php echo $_SESSION['songTime'];?>
		</div>

		<div class="top_2"></div>
		<div class="top_4">订单价格:</div>
		<div class="top_5">
			<span style="font-size: 16px; font-vweight: bold; color: red;" >￥<?php echo $_SESSION['price'];?></span>（元/人民币）
		</div>

		<div class="top_2"></div>
		<div class="top_4">祝福语:</div>
		<div class="top_5">
			<?php echo $_SESSION['blessings'];?>
		</div>

		<br/>
		<div style="margin-top:15px">
			<div >
				<button style="width:160px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white; font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
			</div>
		</div>
	</body>
</html>