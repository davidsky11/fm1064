<?php
include 'upload.class.php';

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-11-9
 * Time: 下午2:48
 */
class site{
    public function index(){
		$row = array();

		//查询价格列表
		$sql_price = "SELECT * FROM `pricedic`";
		$result_price = mysql_query($sql_price);
		while($res_price = mysql_fetch_assoc($result_price)){
			$row[] = $res_price;
		}

		$data = $row;
		getView($data,$v = 'site',$f = 'service');
    }

	/**
	 * 获取订单列表
	 */
	public function main(){
        if(!empty($_SESSION['username'])){
            $row = array();
            $username = $_SESSION['username'];
            $sql_user = "SELECT * FROM `user` WHERE username = '".$username."'";
            $result_user = mysql_query($sql_user);
            $row_user = mysql_fetch_assoc($result_user);
            
            //查询订单列表
            $sql_order = "SELECT * FROM `order`";
            $result_order = mysql_query($sql_order);
            while($res_order = mysql_fetch_assoc($result_order)){
                $row[] = $res_order;
            }

            $data = $row;
            getView($data,$v = 'site',$f = 'main');
        }else{
            header("location:".HOSTNAME."?r=login/index");
        }
    }

	public function view(){
		if(!empty($_SESSION['username'])){
			$row = array();
			$username = $_SESSION['username'];
			$sql_user = "SELECT * FROM `user` WHERE username = '".$username."'";
			$result_user = mysql_query($sql_user);
			$row_user = mysql_fetch_assoc($result_user);

			//查询订单列表
			$sql_order = "SELECT * FROM `order`";
			$result_order = mysql_query($sql_order);
			while($res_order = mysql_fetch_assoc($result_order)){
				$row[] = $res_order;
			}

			$data = $row;
			getView($data,$v = 'site',$f = 'view');
		}else{
			header("location:".HOSTNAME."?r=login/index");
		}
	}

	/**
	 * 根据指定条件获取订单列表
	 */
	public function searchOrder(){
		$search = $_REQUEST['search'];
		$searchType = $_REQUEST['searchType'];
        if(!empty($_SESSION['username'])){
            $row = array();
            $username = $_SESSION['username'];
            $sql_user = "SELECT * FROM `user` WHERE username = '".$username."'";
            $result_user = mysql_query($sql_user);
            $row_user = mysql_fetch_assoc($result_user);

            //查询订单列表
            $sql_order = "";

			// 按照订单号查找
			if ($searchType == "1") {
				$sql_order = "SELECT * FROM `order` WHERE orderNum = '".$search."'";
			}

			// 按照姓名查找
			if ($searchType == "2") {
				$sql_order = "SELECT * FROM `order` WHERE buyerName = '".$search."' OR userName = '".$search."'";
			}

			// 按照电话号码查找
			if ($searchType == "3") {
				$sql_order = "SELECT * FROM `order` WHERE buyerPhone = '".$search."' OR userPhone = '".$search."'";
			}

            $result_order = mysql_query($sql_order);
            while($res_order = mysql_fetch_assoc($result_order)){
                $row[] = $res_order;
            }

            $data = $row;
            getView($data,$v = 'site',$f = 'main');
        }else{
            header("location:".HOSTNAME."?r=login/index");
        }
    }

	/**
	 * 获取价格列表
	 */
	public function price(){
        if(!empty($_SESSION['username'])){
            $row = array();
            
            //查询价格列表
            $sql_price = "SELECT * FROM `pricedic`";
            $result_price = mysql_query($sql_price);
            while($res_price = mysql_fetch_assoc($result_price)){
                $row[] = $res_price;
            }

            $data = $row;
            getView($data,$v = 'site',$f = 'price');
        }else{
            header("location:".HOSTNAME."?r=login/index");
        }
    }

	/**
	 * 获取banner列表
	 */
	public function banner(){
		if(!empty($_SESSION['username'])){
			$row = array();

			//查询价格列表
			$sql_banner = "SELECT * FROM `bannerdic`";
			$result_banner = mysql_query($sql_banner);
			while($res_banner = mysql_fetch_assoc($result_banner)){
				$row[] = $res_banner;
			}

			$data = $row;
			getView($data,$v = 'site',$f = 'banner');
		}else{
			header("location:".HOSTNAME."?r=login/index");
		}
	}

	/**
	 * 上传banner图片
	 */
	public function setBanner() {
		$id = $_REQUEST['bannerId'];
		$name = $_REQUEST['name'];
		$title = $_REQUEST['title'];
		$description = $_REQUEST['description'];

		// 上传图片
		$upload = new upload();
		$upload->upload_file();

		$location = $upload->upload_server_name;  // 文件名称

		$sql_banner = "UPDATE `bannerdic` set name = '".$name."', title = '".$title."', location = '".$location."', description = '".$description."' where id = '".$id."'";
		$result_banner = mysql_query($sql_banner);
		if($result_banner)
			echo "true";
		else
			echo "false";
	}

	/**
	 * 异步获取价格列表
	 */
	public function getPrice(){
		$row = array();

		//查询价格列表
		$sql_price = "SELECT * FROM `pricedic`";
		$result_price = mysql_query($sql_price);
		while($res_price = mysql_fetch_assoc($result_price)){
			$row[] = $res_price;
		}

		return $row;
	 }


	/**
	 * 修改价格
	 */
	public function modPrice(){
		if(!empty($_SESSION['username'])){
			$id = $_REQUEST['id'];
			$price = $_REQUEST['price'];
			$desc = $_REQUEST['desc'];
			
            //修改价格
            $sql_price = "UPDATE `pricedic` set price = '".$price."', description = '".$desc."' where id = '".$id."'";
            $result_price = mysql_query($sql_price);
            /**while($res_price = mysql_fetch_assoc($result_price)){
                $row[] = $res_price;
            }**/
			if($result_price)
				echo "true";
        }else{
            header("location:".HOSTNAME."?r=login/index");
        }
	}

	/**
	 * 新增订单
	 */
	 public function addOrder() {
		 $id = $_REQUEST['id'];
		 $orderNum = "45589585858";  // 此处为微信支付的订单号
		 $username = $_REQUEST['username'];
		 $price = $_REQUEST['price'];
		 $buyerName = $_REQUEST['buyerName'];
		 $buyerSex = $_REQUEST['buyerSex'];
		 $buyerPhone = $_REQUEST['buyerPhone'];
		 $userName = $_REQUEST['userName'];
		 $userSex = $_REQUEST['userSex'];
		 $userPhone = $_REQUEST['userPhone'];
		 $songer = $_REQUEST['songer'];
		 $songName = $_REQUEST['songName'];
		 $blessings = $_REQUEST['blessings'];
		 $songTime = $_REQUEST['songTime'];

		 $sql_order = "insert into `order`(`orderNum`, `buyerName`, `buyerSex`, `buyerPhone`, `userName`, `userSex`, `userPhone`, `songer`, `songName`, `blessings`, `songTime`) values('".$orderNum."', '".$buyerName."', '".$buyerSex."', '".$buyerPhone."', '".$userName."', '".$userSex."', '".$userPhone."', '".$songer."', '".$songName."', '".$blessings."', '".$songTime."')";
		 $result_order = mysql_query($sql_order);
		 if(mysql_affected_rows()){
			 getView(null, $v = 'site', $f = 'result');
		 }else{
			 echo json_encode("insert false");
		 }
	 }

	/**
	 * 更新订单信息
	 */
	public function updateOrder() {
		//if(!empty($_SESSION['username'])){
			$row = array();
			$id = $_REQUEST['id'];
			$buyerName = $_REQUEST['buyerName'];
			$buyerPhone = $_REQUEST['buyerPhone'];
			$userName = $_REQUEST['userName'];
			$userPhone = $_REQUEST['userPhone'];
			$songer = $_REQUEST['songer'];
			$songName = $_REQUEST['songName'];
			$songTime = $_REQUEST['songTime'];
			
            // 更新订单信息
            $sql_order = "update `order` set `buyerName` = '".$buyerName."', `buyerPhone` = '".$buyerPhone."', `userName` = '".$userName."', `userPhone` = '".$userPhone."', `songer` = '".$songer."', `songName` = '".$songName."', `songTime` = '".$songTime."' where id = '".$id."'";
            $result_order = mysql_query($sql_order);
            while($res_order = mysql_fetch_assoc($result_order)){
                $row[] = $res_order;
            }

			echo json_encode("update success");
            //getView(null, $v = 'site',$f = 'main');
        //}else{
        //    header("location:".HOSTNAME."?r=login/index");
        //}
	}

	/**
	 * 删除订单
	 */
	public function delOrder2(){
		$id = $_REQUEST['id'];

		//删除订单
		$sql_order = "delete from `order` where id = '".$id."'";
		$result_order = mysql_query($sql_order);
	}

	public function delOrder(){
		echo "true";
		//删除订单
		//$sql_order = "delete from `order` where id = '".$id."'";
		//$result_order = mysql_query($sql_order);
	}

}