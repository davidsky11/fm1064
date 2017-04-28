<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-11-10
 * Time: 上午10:08
 */
//function connect_sql($localhost='localhost',$root='root',$pasw='123',$db='radio'){
//function connect_sql($localhost='kvlt.ngrok.natapp.cn',$root='root',$pasw='123',$db='radio'){
function connect_sql($localhost='sdm209639586.my3w.com',$root='sdm209639586',$pasw='huang127126',$db='sdm209639586_db'){
    $conn = mysql_connect($localhost,$root,$pasw);
    if(!$conn){
        die('数据库用户名和密码错误');
    }

    mysql_select_db($db,$conn);
    if(!mysql_select_db($db,$conn)){
        die('数据库不存在');
    }

    mysql_query('set names utf8');//设置传输编码
}