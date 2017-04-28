<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册页面</title>
<link rel="stylesheet" type="text/css" href="css/zc.css">
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery.md5.js"></script>
</head>
<body scroll="no" style="overflow-x:hidden;overflow-y:hidden">
<div class="content" style="padding-top:14px;">
    <div class="signin"><img src="images/signin_tit.jpg" width="367" height="62" />
        <form action="index.php?r=register/zc" method="post">
            <ul class="signinul">
                <li class = "username"><span>用户名： </span>
                    <input name="username" type="text" />
                </li>
                <li class = "password"><span>密码：</span>
                    <input name="password" type="password" />
                </li>
                <li class = "pwd"><span>确认密码：</span>
                    <input name="pwd" type="password" />
                </li>
            </ul>
            <div class="registerbtn" style="margin-bottom:40px;">
                <span class="cancel_register"><a href="?r=login/index">取消注册</a></span>
                <span class="register"><input type="submit" value="立即注册" id="sub" /></span>
            </div>
        </form>
    </div>
    <div class="clear" style="height:auto;"></div></div>
</body>
<script type="text/javascript">
    $(function(){
        $("#sub").live('click', function () {
            var username = $("input[name='username']").val();
            var password = $("input[name='password']").val();
            var pwd = $("input[name='pwd']").val();
            var i = 0;
            //用户名
            if(username.replace(/[ ]/g,"") == ''){
                if($(".username").next("span").length > 0){
                    $(".username").next("span").remove();
                    $(".username").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请输入用户名</span>");
                }else{
                    $(".username").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请输入用户名</span>");
                }
                i += 1;
            }else{
                $.ajax({
                    type:'POST',
                    url:"http://"+"<?php echo HTTP_HOST?>"+"/tlj_cms/index.php?r=register/checkusername",
                    data:{
                        username:username
                    },
                    dataType:'json',
                    success:function(msg){
                        if(msg == 1){
                            if($(".username").next("span").length > 0){
                                $(".username").next("span").remove();
                                $(".username").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>用户名已存在</span>");
                            }else{
                                $(".username").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>用户名已存在</span>");
                            }
                            i += 1;
                        }else{
                            $(".username").next("span").remove();
                            i += 0;
                        }
                    }
                });
            }

            //密码
            if(password.replace(/[ ]/g,"") == ''){
                if($(".password").next("span").length > 0){
                    $(".password").next("span").remove();
                    $(".password").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请输入密码</span>");
                }else{
                    $(".password").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请输入密码</span>");
                }
                i += 1;
            }else{
                if(password.length < 6 || password.length > 16){
                    if($(".password").next("span").length > 0){
                        $(".password").next("span").remove();
                        $(".password").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>密码长度为6到16位</span>");
                    }else{
                        $(".password").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>密码长度为6到16位</span>");
                    }
                    i += 1;
                }else{
                    $(".password").next("span").remove();
                    i += 0;
                }
            }

            //确认密码
            if(pwd.replace(/[ ]/g,"") == ''){
                if($(".pwd").next("span").length > 0){
                    $(".pwd").next("span").remove();
                    $(".pwd").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请再次输入密码</span>");
                }else{
                    $(".pwd").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请再次输入密码</span>");
                }
                i += 1;
            }else{
                if(pwd == password){
                    $(".pwd").next("span").remove();
                    i += 0;
                }else{
                    if($(".pwd").next("span").length > 0){
                        $(".pwd").next("span").remove();
                        $(".pwd").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>两次输入的密码不一致</span>");
                    }else{
                        $(".pwd").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>两次输入的密码不一致</span>");
                    }
                    i += 1;
                }
            }

            //ajax提交
            if(i == 0){
                $.ajax({
                    type:'POST',
                    url:"http://"+"<?php echo HTTP_HOST?>"+"/tlj_cms/index.php?r=register/zc",
                    data:{
                        username:username,
                        password: $.md5(password),
                    },
                    dataType:'json',
                    success: function (msg) {
                        if(msg == 1){
                            window.location.href = "http://"+"<?php echo HTTP_HOST?>"+"/tlj_cms/index.php?r=site/index";
                        }else{
                            alert("注册失败");
                        }
                    }
                });
            }
            return false;
        });

        /*回车事件开始*/
        document.onkeydown = function(e){
            var ev = document.all ? window.event : e;
            if(ev.keyCode==13) {
                var username = $("input[name='username']").val();
                var password = $("input[name='password']").val();
                var pwd = $("input[name='pwd']").val();
                var i = 0;
                //用户名
                if(username.replace(/[ ]/g,"") == ''){
                    if($(".username").next("span").length > 0){
                        $(".username").next("span").remove();
                        $(".username").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请输入用户名</span>");
                    }else{
                        $(".username").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请输入用户名</span>");
                    }
                    i += 1;
                }else{
                    $.ajax({
                        type:'POST',
                        url:"http://"+"<?php echo HTTP_HOST?>"+"/tlj_cms/index.php?r=register/checkusername",
                        data:{
                            username:username
                        },
                        dataType:'json',
                        success:function(msg){
                            if(msg == 1){
                                if($(".username").next("span").length > 0){
                                    $(".username").next("span").remove();
                                    $(".username").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>用户名已存在</span>");
                                }else{
                                    $(".username").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>用户名已存在</span>");
                                }
                                i += 1;
                            }else{
                                $(".username").next("span").remove();
                                i += 0;
                            }
                        }
                    });
                }

                //密码
                if(password.replace(/[ ]/g,"") == ''){
                    if($(".password").next("span").length > 0){
                        $(".password").next("span").remove();
                        $(".password").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请输入密码</span>");
                    }else{
                        $(".password").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请输入密码</span>");
                    }
                    i += 1;
                }else{
                    if(password.length < 6 || password.length > 16){
                        if($(".password").next("span").length > 0){
                            $(".password").next("span").remove();
                            $(".password").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>密码长度为6到16位</span>");
                        }else{
                            $(".password").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>密码长度为6到16位</span>");
                        }
                        i += 1;
                    }else{
                        $(".password").next("span").remove();
                        i += 0;
                    }
                }

                //确认密码
                if(pwd.replace(/[ ]/g,"") == ''){
                    if($(".pwd").next("span").length > 0){
                        $(".pwd").next("span").remove();
                        $(".pwd").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请再次输入密码</span>");
                    }else{
                        $(".pwd").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请再次输入密码</span>");
                    }
                    i += 1;
                }else{
                    if(pwd == password){
                        $(".pwd").next("span").remove();
                        i += 0;
                    }else{
                        if($(".pwd").next("span").length > 0){
                            $(".pwd").next("span").remove();
                            $(".pwd").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>两次输入的密码不一致</span>");
                        }else{
                            $(".pwd").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>两次输入的密码不一致</span>");
                        }
                        i += 1;
                    }
                }


                //ajax提交
                if(i == 0){
                    $.ajax({
                        type:'POST',
                        url:"http://"+"<?php echo HTTP_HOST?>"+"/tlj_cms/index.php?r=register/zc",
                        data:{
                            username:username,
                            password: $.md5(password),
                        },
                        dataType:'json',
                        success: function (msg) {
                            if(msg == 1){
                                window.location.href = "http://"+"<?php echo HTTP_HOST?>"+"/tlj_cms/index.php?r=site/index";
                            }else{
                                alert("注册失败");
                            }
                        }
                    });
                }
            }
        }
        /*回车事件结束*/


        /*用户名input框失去焦点事件*/
        $("input[name='username']").blur(function () {
            var username = $(this).val();
            if(username.replace(/[ ]/g,"") == ''){
                if($(".username").next("span").length > 0){
                    $(".username").next("span").remove();
                    $(".username").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请输入用户名</span>");
                }else{
                    $(".username").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请输入用户名</span>");
                }
            }else{
                $.ajax({
                    type:'POST',
                    url:"http://"+"<?php echo HTTP_HOST?>"+"/tlj_cms/index.php?r=register/checkusername",
                    data:{
                        username:username
                    },
                    dataType:'json',
                    success:function(msg){
                        if(msg == 1){
                            if($(".username").next("span").length > 0){
                                $(".username").next("span").remove();
                                $(".username").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>用户名已存在</span>");
                            }else{
                                $(".username").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>用户名已存在</span>");
                            }
                        }else{
                            $(".username").next("span").remove();
                        }
                    }
                });
            }
        })
        /*用户名input框失去焦点事件结束*/

        //密码input框失去焦点事件
        $("input[name = 'password']").blur(function () {
            var password = $(this).val();
            if(password.replace(/[ ]/g,"") == ''){
                if($(".password").next("span").length > 0){
                    $(".password").next("span").remove();
                    $(".password").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请输入密码</span>");
                }else{
                    $(".password").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请输入密码</span>");
                }
            }else{
                if(password.length < 6 || password.length > 16){
                    if($(".password").next("span").length > 0){
                        $(".password").next("span").remove();
                        $(".password").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>密码长度为6到16位</span>");
                    }else{
                        $(".password").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>密码长度为6到16位</span>");
                    }
                }else{
                    $(".password").next("span").remove();
                }
            }
        })


        //确认密码input框失去焦点事件
        $("input[name = 'pwd']").blur(function () {
            var pwd = $(this).val();
            var password = $("input[name='password']").val();
            if(pwd.replace(/[ ]/g,"") == ''){
                if($(".pwd").next("span").length > 0){
                    $(".pwd").next("span").remove();
                    $(".pwd").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请再次输入密码</span>");
                }else{
                    $(".pwd").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>请再次输入密码</span>");
                }
            }else{
                if(pwd == password){
                    $(".pwd").next("span").remove();
                }else{
                    if($(".pwd").next("span").length > 0){
                        $(".pwd").next("span").remove();
                        $(".pwd").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>两次输入的密码不一致</span>");
                    }else{
                        $(".pwd").after("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:-43px 0 0 520px;position: absolute;'>两次输入的密码不一致</span>");
                    }
                }
            }
        })
    });
</script>
</html>

