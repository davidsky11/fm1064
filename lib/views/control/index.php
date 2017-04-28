<!DOCTYPE html>
<!-- saved from url=(0038)http://www.bjeit.gov.cn/ggfw/index.htm -->
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="http://www.bjeit.gov.cn/js/skins/default.css" rel="stylesheet" id="lhgdglink">
    <title>设备管理</title>
    <link href="css/base.css" rel="stylesheet" type="text/css">
    <link href="css/style_ggfw.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="css/b5m-plugin.css" type="text/css">
    <link rel="stylesheet" href="css/b5m.botOrTopBanner.css" type="text/css">
</head>
<body>
<div class="" style="display: none; visibility: hidden; position: absolute;">
    <table class="ui_border">
        <tbody>
        <tr>
            <td class="ui_lt"></td>
            <td class="ui_t"></td>
            <td class="ui_rt"></td>
        </tr>
        <tr>
            <td class="ui_l"></td>
            <td class="ui_c">
                <div class="ui_inner">
                    <table class="ui_dialog">
                        <tbody>
                        <tr>
                            <td colspan="2">
                                <div class="ui_title_bar">
                                    <div class="ui_title" unselectable="on" style="cursor: move;"></div>
                                    <div class="ui_title_buttons">
                                        <a class="ui_min" href="javascript:void(0);" title="最小化" style="display: inline-block;"><b class="ui_min_b"></b></a>
                                        <a class="ui_max" href="javascript:void(0);" title="最大化" style="display: inline-block;"><b class="ui_max_b"></b></a>
                                        <a class="ui_res" href="javascript:void(0);" title="还原"><b class="ui_res_b"></b><b class="ui_res_t"></b></a>
                                        <a class="ui_close" href="javascript:void(0);" title="关闭(esc键)" style="display: inline-block;">×</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="ui_icon" style="display: none;">
                                <img src="" class="ui_icon_bg">
                            </td>
                            <td class="ui_main" style="width: auto; height: auto;">
                                <div class="ui_content" style="padding: 10px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="ui_buttons" style="display: none;"></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </td>
            <td class="ui_r"></td>
        </tr>
        <tr>
            <td class="ui_lb"></td>
            <td class="ui_b"></td>
            <td class="ui_rb" style="cursor: se-resize;"></td>
        </tr>
        </tbody>
    </table>
</div>


<!-- 行政事项列表 -->
<div class="g_sp_list_wrap" id="g_sp_nav_statics_wrap">
    <div class="g_sp_list_tit">
        <h3 id="xzfwdh" style="font-size:26px; color:#333;">设备管理</h3>
        <a href="?r=site/index" >
			<img style="display:block;position:absolute;margin:-40px 0px 0 1100px; float:right" src="images/back_03.png"> <span style="">返回</span>
		</a>
    </div>
    <div class="g_sp_list_nav clr"></div>
    <div class="g_sp_list">
        <ul class="g_sp_list_menu" id="g_sp_list_menu0">
            <?php foreach($data[0] as $k => $v):?>
                <li>
                    <h3 class="nav-top-item current"><em><i>共6类子项</i></em><a href="#">
					信阳市火车站<?php echo $v['d_name'];?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					设备名称：<?php echo $v['e_name']?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					执法人：<?php echo $v['username']?></a>
                    </h3>
                    <ul style="display: block; width:1052px; margin:0 auto;">
                        <li><b>01</b>设备用户：<select style="width:156px;">
                                <option><?php echo $v['username']?></option>
                                <?php foreach($data[1] as $key => $val):?>
                                    <?php if($v['username'] != $val['realname']): ?>
                                        <option><?php echo $val['realname']?></option>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </select>
                        </li>
                        <li><b>02</b>设备编号：<input type="text" name = "number" value="<?php echo $v['number']?>" /></li>
                        <li><b>03</b>设备名称：<input type="text" name = "name" value="<?php echo $v['e_name']?>" /></li>
                        <li><b>04</b>设备类型：<input type="text" name = "type" value="<?php echo $v['type']?>" /></li>
                        <li><b>05</b>设备状态：<span><?php echo $v['status']?></span></li>
                        <li><b>06</b>mac地址：<span><?php echo $v['mac_address']?></span></li>
                        <li><input type = "hidden" value="<?php echo $v['user_id']?>" /></li>
                        <li class = submit><a style="font-size:16px; text-align:center; color:#FFF; background:#06F; width:70px; height:30px; line-height:30px; display:block; margin-left:50px; padding-left:20px;" href="javascript:;">确认修改</a></li>
                    </ul>
                    <div class="blank_5"></div>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>
<!-- 行政事项列表 End -->
<script type="text/javascript" src="js/lhgdialog.min.js"></script>
<script src="js/jquery.placeholder.1.3.min.js" type="text/javascript" language="javascript"></script>
<script src="js/simpla.jquery.configuration.js" type="text/javascript" language="javascript"></script>
<script src="js/public.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript">
    $(function(){
        $(".submit").live("click",function(){
            var username = $(this).parent().find("select option:selected").text();
            var number = $(this).parent().find("input[name = 'number']").val();
            var name = $(this).parent().find("input[name = 'name']").val();
            var type = $(this).parent().find("input[name = 'type']").val();
            var status = $(this).parent().find("input[name = 'status']").val();
            var mac_address = $(this).parent().find("input[name = 'mac_address']").val();
            var id = $(this).prev().find("input[type = 'hidden']").val();
            if(confirm("确认修改？")){
               $.ajax({
                    type:'POST',
                    url:"http://"+"<?php echo HTTP_HOST?>"+"/tlj_cms/index.php?r=control/update",
                    data:{
                        id:id,
                        username:username,
                        number:number,
                        name:name,
                        type:type,
                        status:status,
                        mac_address:mac_address
                    },
                   dataType:'json',
                   success: function (msg) {
                       if(msg == 1){
                           alert("修改成功！");
                           window.location.href = "http://"+"<?php echo HTTP_HOST?>"+"/tlj_cms/index.php?r=control/index";
                       }else{
                           alert("修改失败！")
                       }
                   }
                });
            }
        })
    });
</script>
</body>
</html>