<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-11-6
 * Time: 下午3:06
 */
function getView($data = array(),$v = '',$f = ''){
    extract($data);
    include V_PATH.$v.'/'.$f.'.php';
}