<?php
//session_start();  // 开启session
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

require_once "./lib/WxPay.Api.php";
require_once './lib/WxPay.Notify.php';
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("./logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		Log::DEBUG("query:" . json_encode($result));
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		Log::DEBUG("call back:" . json_encode($data));
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}

		// 支付成功后，添加订单信息到本地数据库
		//Log::DEBUG("开始订单添加。。。");

		$orderNum = $data["transaction_id"];  // 此处为微信支付的订单号

		//Log::DEBUG($data["attach"]);
		$arrStr = $data["attach"];

		if(!$this->AddOrder($data["transaction_id"], $arrStr)){
			//Log::DEBUG("订单 false");
			$msg = "本地订单生成失败";
			return false;
		}

		return true;
	}

	/**
	 * 新增订单
	 */
	 function AddOrder($transaction_id, $arrStr) {
		 Log::DEBUG("连接数据库");
		 $this->connect_sql();  // 连接数据库

		 $array=explode("^", $arrStr);

		 $orderNum = $transaction_id;  // 此处为微信支付的订单号
		 $buyerName = $array[0];
		 $buyerSex = $array[1];
		 $buyerPhone = $array[2];
		 $userName = $array[3];
		 $userSex = $array[4];
		 $userPhone = $array[5];
		 $songer = $array[6];
		 $songName = $array[7];
		 $songTime = $array[8];
		 $blessings = $array[9];
		 $price = $array[10];
		 $price=$price;
		 //Log::DEBUG("从Session中获取的数据：\n orderNum : ".$orderNum."  buyerName : ".$buyerName.".$buyerSex : ".$buyerSex." buyerPhone : ".$buyerPhone);

		 $sql_order = "insert into `order`(`orderNum`, `buyerName`, `buyerSex`, `buyerPhone`, `userName`, `userSex`, `userPhone`, `songer`, `songName`, `songTime`,`blessings`,  `price`)
				values('".$orderNum."', '".$buyerName."', '".$buyerSex."', '".$buyerPhone."', '".$userName."', '".$userSex."', '".$userPhone."', '".$songer."', '".$songName."','".$songTime."', '".$blessings."',  '".$price."')";

		 //$sql_order = "insert into `order`(`orderNum`, `buyerName`) values('".$orderNum."', '".$buyerName."')";
		 $result_order = mysql_query($sql_order);
		 if(mysql_affected_rows()){
			 Log::DEBUG("订单插入成功！");
			 return true;
		 }else{
			 Log::DEBUG("订单插入失败！");
			 return false;
		 }
	 }

	//function connect_sql($localhost='localhost',$root='root',$pasw='123',$db='radio'){
	//function connect_sql($localhost, $root, $pasw, $db){
	function connect_sql($localhost='sdm209639586.my3w.com',$root='sdm209639586',$pasw='huang127126',$db='sdm209639586_db'){
		$conn = mysql_connect($localhost,$root,$pasw);
		if(!$conn){
			//Log::DEBUG("数据库用户名和密码错误!");
			die('数据库用户名和密码错误');
		}

		mysql_select_db($db,$conn);
		if(!mysql_select_db($db,$conn)){
			//Log::DEBUG("数据库不存在!");
			die('数据库不存在');
		}

		mysql_query('set names utf8');//设置传输编码
		//Log::DEBUG("数据库连接成功!");
	}
}

Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);