<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-11-6
 * Time: 下午2:18
 */
class register{
    public function index(){
        getView($data = array(),$v = 'register',$f = 'zc');
    }

    public function zc(){
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest"){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sql = "INSERT INTO `user`(`username`,`password`) VALUE ('".$username."','".$password."')";
            $result = mysql_query($sql);
            $row = mysql_affected_rows();//受影响的行数
            if($row > 0){
                $_SESSION['username'] = $username;
                echo 1;
            }else{
                echo 0;
            }
        }else{
            $username = str_replace(' ','',str_replace('/[ ]/g',"",$_POST['username']));
            $password = str_replace(' ','',str_replace('/[ ]/g',"",$_POST['password']));
            if($username == ''){
                echo '请输入用户名';
                header("Refresh:3;url=index.php?r=register/index");
                exit();
            }else{
                $sql = "SELECT * FROM `user` WHERE username = '".$username."'";
                $result = mysql_query($sql);
                $num = mysql_num_rows($result);
                if($num > 0){
                    echo '用户名已存在';
                    header("Refresh:3;url=index.php?r=register/index");
                    exit();
                }else{
                    if($password == ''){
                        echo '请输出密码';
                        header("Refresh:3;url=index.php?r=register/index");
                        exit();
                    }else{
                        if(strlen($password) < 6 || strlen($password) > 16){
                            echo '密码长度为6到16位';
                            header("Refresh:3;url=index.php?r=register/index");
                            exit();
                        }else{
                            $sql = "INSERT INTO `user`(`username`,`password`) VALUE ('".$username."','".$password."')";
                            $result = mysql_query($sql);
                            $row = mysql_affected_rows();//受影响的行数
                            if($row > 0){
                                $_SESSION['username'] = $username;
                                header("location:http://localhost/tlj_cms/index.php?r=site/index");
                                exit();
                            }else{
                                echo "注册失败";
                                header("Refresh:3;url=index.php?r=register/index");
                                exit();
                            }
                        }
                    }
                }
            }
        }
    }

    public function checkUsername(){
        $username = $_POST['username'];
        $sql = "SELECT * FROM `user` WHERE username = '".$username."'";
        $result = mysql_query($sql);
        $num = mysql_num_rows($result);
        if($num > 0){
            echo 0;
        }else{
            echo 0;
        }
    }
}
