<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--meta http-equiv="Access-Control-Allow-Origin" content="*" /-->
<title>首页</title>
</head>
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/title.css">
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/tc.all.js"></script>
<body>
    <div class="pop" style="position: absolute;">
        <input class = "data" type = "hidden" level = "<?php echo $data[3];?>" uid = "<?php echo $data[4];?>" department_id = 1>
    </div>
    <div class="header" style="position: fixed;z-index: 100;">
    <ul class="tit">
        <li><span><img src="images/icon-xz.png" width="26" height="24" /></span><a href="download/firefox.exe">火狐浏览器</a></li>
        <li><span><img src="images/icon-xz.png" width="26" height="24" /></span><a href="download/railway.apk">APP下载</a></li>
        <li><span><img src="images/icon-xz.png" width="26" height="24" /></span><a href="download/vlc-2.2.1-win32.exe">播放器下载</a></li>
		<li><span><img src="images/icon-all.png" width="26" height="24" /></span><a href="?r=control/index">设备管理</a></li>
        <li><span><img src="images/icon-back.png" width="22" height="20" /></span><a href="?r=loginout/index">退出</a></li>
    </ul>
 </div>

    <div class="section" style="position: absolute;top:92px;">
        <div class="section-left">
            <div style="width: 272px;height: 808px;overflow: hidden">
                <ul id="cd" style="overflow: auto;">
                    <?php foreach($data[0] as $key0 => $value0):?>
                        <li id="<?php echo $value0['id'];?>"><?php echo $value0['name'];?></li>
                    <?php endforeach;?>
                </ul>
            </div>
            <div class="section-cont01" style="display:block;">
                <ul id="shblb">
                    <?php foreach($data[1] as $key1 => $value1):?>
                        <li id="<?php echo $value1['id'] ;?>">
                            <?php if($value1['status'] == "-1"):?>
                                <img src="images/lb-h.jpg" />
                            <?php elseif(substr($value1['status'],0,1) == "1"):?>
                                <img src="images/lb_new.png" />
                            <?php else:?>
                                <img src="images/lb.png" />
                            <?php endif;?>
                            <p>
                                <?php if($value1['status'] != "-1"):?><a href="javascript:;"><?php endif;?>设备名称：<?php echo $value1['name'] ;?><br />具体地点：信阳市<br />执法人：<?php echo $value1['username'];?><?php if($value1['status'] != "-1"):?></a><?php endif;?>
                                <input type="hidden" mac = "<?php echo $value1['mac_address']?>" user_id = "<?php echo $value1['user_id']?>" status = "<?php echo $value1['status']?>"/>
                            </p>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <div class="section-right">
            <h2>最近查看</h2><!--<a href="#"><span>查看全部</span></a>-->
            <div class="hx"></div>
            <div class="wrapper">
                <ul id="xxlb">
                    <?php foreach($data[2] as $key2 => $value2):?>
                        <li>
                            <h3>设备名称：<?php echo $value2['name'];?></h3>
                            <p><?php echo $value2['last_usetime'];?></p><br />
                            <p>地点：信阳火车站A区<br />编号：<?php echo $value2['number'];?></p>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(function () {
        $("#cd li").first().addClass("cdclick");
        setInterval("startRefresh()", 3000);

        //设备列表刷新
        $("#cd li").click(function () {
            $(this).siblings("li").removeClass("cdclick");
            $(this).addClass("cdclick");
            var department_id = $(this).attr("id");
            $(".pop").find("input").attr("department_id",department_id);
            $.ajax({
                type:'GET',
                url:"http://"+"<?php echo HTTP_HOST?>"+"/tlj_cms/index.php?r=site/getequipmentlist",
                data:{department_id:department_id},
                dataType:'json',
                success:function(data){
                    var html = '';
                    if(data == null){
                        $("#shblb").html(html);
                    }else{
                        for(i=0;i<data.length;i++){
                            html += "<li id="+data[i]['id']+">";
                            if(data[i]['status'] == "-1"){
                                html += "<img src='images/lb-h.jpg' />";
                            }else if(data[i]['status'].substr(0,1) == "1"){
                                html += "<img src='images/lb_new.png' />";
                            }else{
                                html += "<img src='images/lb.png' />";
                            }
                            html += "<p>";
                            if(data[i]['status'] != "-1"){
                                html += "<a href='javascript:;'>";
                            }
                            html += "设备名称："+data[i]['name'];
                            html += "<br />";
                            html += "具体地点：信阳市";
                            html += "<br />";
                            html += "执法人："+data[i]['username'];
                            if(data[i]['status'] != "-1"){
                                html += "</a>";
                            }
                            html += "<input type = 'hidden' user_id=" + data[i]['user_id'] + " mac="+data[i]['mac_address'] + " status="+data[i]['status']+ ">";
                            html += "</p>";
                            html += "</li>";
                        }
                        $("#shblb").html(html);
                    }
                }
            })
        });
    });


    function startRefresh(){
        var department_id = $(".pop").find("input").attr("department_id");
        $.ajax({
            type:'GET',
            url:"http://"+"<?php echo HTTP_HOST?>"+"/tlj_cms/index.php?r=site/getequipmentlist",
            data:{department_id:department_id},
            dataType:'json',
            success:function(data){
                var html = '';
                if(data == null){
                    $("#shblb").html(html);
                }else{
                    for(i=0;i<data.length;i++){
                        html += "<li id="+data[i]['id']+">";
                        if(data[i]['status'] == "-1"){
                            html += "<img src='images/lb-h.jpg' />";
                        }else if(data[i]['status'].substr(0,1) == "1"){
                            html += "<img src='images/lb_new.png' />";
                        }else{
                            html += "<img src='images/lb.png' />";
                        }
                        html += "<p>";
                        if(data[i]['status'] != "-1"){
                            html += "<a href='javascript:;'>";
                        }
                        html += "设备名称："+data[i]['name'];
                        html += "<br />";
                        html += "具体地点：信阳市";
                        html += "<br />";
                        html += "执法人："+data[i]['username'];
                        if(data[i]['status'] != "-1"){
                            html += "</a>";
                        }
                        html += "<input type = 'hidden' user_id=" + data[i]['user_id'] + " mac="+data[i]['mac_address'] + " status="+data[i]['status']+ ">";
                        html += "</p>";
                        html += "</li>";
                    }
                    $("#shblb").html(html);
                }
            }
        });

    }
</script>
<script type="text/javascript">
    $(function(){
        $(".nav li a").live('click',function(){
            $(".second").css('display','block');
        });
        $(".second a").live('click', function () {
            var html = $(this).html();
            var data = $(this).attr("data");
            $(".nav li a").html(html);
            $(".nav li a").attr("data",data);
            $(".second").css('display','none');
        })
    });
</script>
<script type="text/javascript">
    $("#shblb li a").live('click', function () {
        var id = $(this).parents('li').first().attr('id');
        var mac = $(this).next('input').attr('mac');
        var status = $(".pop").find("input").attr("status");
        if(status){
            status = $(".pop").find("input").attr("status");
        }else{
            status = $(this).next('input').attr('status');
        }
        var user_id = $(this).next('input').attr('user_id');
        var level = $(".data").attr("level");
        var uid = $(".data").attr("uid");
        var HTTP_HOST = "<?php echo HTTP_HOST?>";
        var arr = new Array();
        $(".popWin").each(function () {
            arr.push($(this).attr("equipment_id"));
        })
        if($.inArray(id,arr) < 0){
            //弹出设备窗口
            newWin("pop", mac, id, user_id, level, uid, status, HTTP_HOST);

            //更新最近查看列表
            $.ajax({
                type:'GET',
                url:"http://"+"<?php echo HTTP_HOST?>"+"/tlj_cms/index.php?r=site/getrecentlist",
                data:{id:id},
                dataType:'json',
                success: function (data) {
                    var html = "";
                    for(i=0;i<data.length;i++){
                        html += "<li>";
                        html += "<h3>";
                        html += "设备名称："+data[i]['name'];
                        html += "</h3>";
                        html += "<p>";
                        html += data[i]['last_usetime'];
                        html += "</p>";
                        html += "<br />";
                        html += "<p>";
                        html += "地点：信阳火车站A区";
                        html += "<br />";
                        html += "编号："+data[i]['number'];
                        html += "</p>";
                        html += "</li>";
                    }
                    $("#xxlb").html(html);
                }
            });
        }else{
            $(this).unbind("click");
        }
    });
</script>
</html>
