<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-11-23
 * Time: ионГ1:29
 */
class loginout{
    public function index(){
        unset($_SESSION['username']);
        header("location:".HOSTNAME."?r=login/index");
    }
}