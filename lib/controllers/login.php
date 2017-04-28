<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-11-6
 * Time: 下午2:18
 */

class login{
    public function index(){
        getView($data = array(),$v = "login",$f = "dl");
    }

    public function dl(){
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest"){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM `user` WHERE username = '".$username."' AND password = '".$password."'";
            $result = mysql_query($sql);
            $row = mysql_fetch_assoc($result);
            $data = array();
            if(!empty($row)){
                $_SESSION['username'] = $username;
                $data['type'] = 1;
            }else{
                $data['type'] = 0;
            }
            echo json_encode($data);
        }else{
            $username = str_replace(' ','',str_replace('/[ ]/g',"",$_POST['username']));
            $password = str_replace(' ','',str_replace('/[ ]/g',"",$_POST['password']));
            if($username == ''){
                echo '请输入用户名';
                header("Refresh:3;url=index.php?r=login/index");
                exit();
            }else{
                if($password == ''){
                    echo '请输入密码';
                    header("Refresh:3;url=index.php?r=login/index");
                    exit();
                }else{
                    $sql = "SELECT * FROM `user` WHERE username = '".$username."' AND password = '".$password."'";
                    $result = mysql_query($sql);
                    $row = mysql_fetch_assoc($result);
                    if(!empty($row)){
                        $_SESSION['username'] = $username;
                        header("location:http://localhost/weipay/index.php?r=site/main");
                        exit();
                    }else{
                        echo "用户名或密码错误";
                        header("Refresh:3;url=index.php?r=login/index");
                        exit();
                    }
                }
            }
        }
    }
}