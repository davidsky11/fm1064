<?php
/**
 * Created by PhpStorm.
 * User: grc
 * Date: 15-11-6
 * Time: 上午11:51
 * name: cms单入口文件
 */
session_start();
define('BASE_PATH','');    //定义网站根目录
//define('HTTP_HOST',$_SERVER["HTTP_HOST"]);
//define('HTTP_HOST','syu2182920001.my3w.com');
//define('HTTP_HOST','localhost');
//define('HTTP_HOST', 'kvlt.ngrok.natapp.cn');
define('HTTP_HOST','mkfm1064.com');
define('HOSTNAME','http://'.HTTP_HOST.'/');    //定义网站入口网址
define('C_PATH',BASE_PATH.'lib/controllers/');     //定义控制器根目录
define('M_PATH',BASE_PATH.'lib/models/');      //定义模型层根目录
define('V_PATH',BASE_PATH.'lib/views/');       //定义视图层根目录
define('CONF_PATH',BASE_PATH.'lib/config/');       //定义配置文件根目录
define('CSS_PATH',BASE_PATH.'css/');       //定义CSS文件根目录
define('JS_PATH',BASE_PATH.'js/');     //定义JS文件根目录
define('IMG_PATH',BASE_PATH.'images/');        //定义图片文件根目录
define('BANNER_PATH', BASE_PATH.'images/banner/');  // 定义banner图片存放路径

include CONF_PATH."comment.php";
include CONF_PATH."db.php";
connect_sql();

if(empty($_GET['r'])){
    include C_PATH."login.php";
    if(method_exists('login','index')){
        call_user_func(array('login','index'));
    }else{
        return false;
    }
}else{
    $root = explode('/',$_GET['r']);
	$count = count($root);

    include C_PATH.$root[0].".php";
    if(empty($root[1])){
        if(method_exists("$root[0]",'index')){
            call_user_func(array("$root[0]",'index'));
        }else{
            return false;
        }
    }else{
		/*if(method_exists("$root[0]","$root[1]","$root[2]")) {
			//echo "3";
			call_user_func(array("$root[0]","$root[1]"),"$root[2]");
		} else*/
		if(method_exists("$root[0]","$root[1]")){
            call_user_func(array("$root[0]","$root[1]"));
        } else {
			return false;
        }
    }

	//if ($count > 2) {
	//	call_user_func(array("$root[0]","$root[1]"), array_slice($root, 2)));
	//}
}
