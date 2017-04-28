<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-11-9
 * Time: ����2:48
 */
class pay{
    public function service(){
		$row = array();

		$sql_banner = "SELECT * FROM `bannerdic`";
		$result_banner = mysql_query($sql_banner);
		while($res_banner = mysql_fetch_assoc($result_banner)){
			$data[0][] = $res_banner;
		}

		//��ѯ�۸��б�
		$sql_price = "SELECT * FROM `pricedic`";
		$result_price = mysql_query($sql_price);
		while($res_price = mysql_fetch_assoc($result_price)){
			$data[1][] = $res_price;
		}

		//$data = $row;
		getView($data,$v = 'pay',$f = 'service');
    }

}
