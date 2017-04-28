<?php

class upload {
    var $upload_name;
    var $upload_tmp_address;
    var $upload_server_name;
    var $upload_filetype;
    var $file_type;
    var $file_server_address;
    var $image_w = 450;
    var $image_h = 280;
    var $upload_file_size;
    var $upload_max_size = 500000;

    function upload_file() {
        $this->upload_name = $_FILES['img']['name'];  // 获取上传文件名
        $this->upload_filetype = $_FILES['img']['type'];
        //$this->upload_server_name = date('y_m_dh_i_s').$this->upload_name;
        $this->upload_server_name = $this->upload_name;
        $this->upload_tmp_address = $_FILES['img']['tmp_name'];  // 获取临时地址
        $this->file_type = array("image/jpeg", "image/jpg", "image/png", "image/gif");  // 允许上传文件的类型
        $this->upload_file_size = $_FILES['img']['size'];  // 上传文件的大小
        if (in_array($this->upload_filetype, $this->file_type)) {
            if ($this->upload_file_size < $this->upload_max_size) {
                //echo ("上传成功!");
                $this->file_server_address = BANNER_PATH.$this->upload_server_name;
                move_uploaded_file($this->upload_tmp_address, $this->file_server_address);  // 从tmp目录中移出
                echo("<img src=$this->file_server_address width=$this->image_w height=$this->image_h />");  // 显示图片
            } else {
                echo ("文件容量太大");
            }
        } else {
            echo ("不支持此文件类型，请重新选择!");
        }
    }
}