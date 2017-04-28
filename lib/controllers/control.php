<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-11-23
 * Time: ионГ2:22
 */
class control{
    public function index(){
        if(!empty($_SESSION['username'])){
            $sql = "SELECT *,tlj_t_equipment.name AS e_name,tlj_t_department.name AS d_name FROM `tlj_t_equipment` join `tlj_t_department`
 on tlj_t_equipment.department_id = tlj_t_department.id ORDER BY tlj_t_equipment.id";
            $result = mysql_query($sql);
            while($res = mysql_fetch_assoc($result)){
                $data[0][] = $res;
            }
            $sql_user = "SELECT tlj_t_user.realname FROM `tlj_t_user`";
            $result_user = mysql_query($sql_user);
            while($res_user = mysql_fetch_assoc($result_user)){
                $data[1][] = $res_user;
            }
            getView($data,$v = "control",$f = "index");
        }else{
            header("location:".HOSTNAME."?r=login/index");
        }
    }

    public function update(){
        if(!empty($_SESSION['username'])){
            if(!empty($_POST)){
                $number = $_POST['number'];
                $name = $_POST['name'];
                $type = $_POST['type'];
                $status = $_POST['status'];
                $mac_address = $_POST['mac_address'];
                $id = $_POST['id'];
                $username = $_POST['username'];
                $sql_id = "SELECT * FROM `tlj_t_user` WHERE username = '".$username."'";
                $result_id = mysql_query($sql_id);
                $res_id = mysql_fetch_assoc($result_id);
                $sql = "UPDATE `tlj_t_equipment` SET number = '".$number."',name = '".$name."',type = '".$type."',user_id = '".$res_id['id']."',
username = '".$username."'  WHERE user_id = '".$id."'";
                $result = mysql_query($sql);
                $row = mysql_affected_rows();
                if($row){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }else{
            header("location:".HOSTNAME."?r=login/index");
        }
    }
}