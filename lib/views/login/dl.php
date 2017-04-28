<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录页面</title>
<link rel="stylesheet" type="text/css" href="css/dl.css">
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery.md5.js"></script>
</head>
<body onLoad="Resize()" onResize="Resize()">
<div class="content" style="padding-top:14px;">
    <div class="signin">
        <form action="index.php?r=login/dl" method="post">
            <ul class="signinul">
				<span >麦可FM后台管理系统</span>
                <li>
                    <input name="username" type="text" placeholder="用户名"/>
                    <input name="password" type="password" placeholder="密码" />
                </li>
            </ul>
            <div class="registerbtn" style="margin-bottom:40px;">
                <span class="login"><input type="submit" id="sub" value="登录" style="width: 101px;height: 38px;background: #F6F8F7 none repeat scroll 0% 0%;border-width: 0px; cursor: pointer;color: #38A0F0;border: 1px solid #DCDCDC;margin-top: -3px;"/></span>
                <!-- span class="register"><a href="?r=register/index">注册</a></span -->
            </div>
        </form>
    </div>
    <div class="clear" style="height:auto;"></div>
</div>
</body>
<script type="text/javascript">
    $(function(){
        $("#sub").live('click',function(){
            var username = $("input[name='username']").val();
            var password = $("input[name='password']").val();
            if(username.replace(/[ ]/g,"") == ''){
                if($("input[name='username']").prev("span").length > 0){
                    $("input[name='username']").prev("span").remove();
                    $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>请输入用户名</span>");
                }else{
                    $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>请输入用户名</span>");
                }
            }else{
                if(password.replace(/[ ]/g,"") == ''){
                    if($("input[name='username']").prev("span").length > 0){
                        $("input[name='username']").prev("span").remove();
                        $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>请输入密码</span>");
                    }else{
                        $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>请输入密码</span>");
                    }
                }else{
                    $.ajax({
                        type:'POST',
                        url:"<?php echo HOSTNAME?>"+"index.php?r=login/dl",
                        data:{
                            username:username,
                            password:password,
                        },
                        dataType:'json',
                        success:function (data){
                            if(data['type'] == 1){
                                window.location.href = "<?php echo HOSTNAME?>"+"index.php?r=site/main";
                            }else{
                                if($("input[name='username']").prev("span").length > 0){
                                    $("input[name='username']").prev("span").remove();
                                    $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>用户名或密码错误</span>");
                                }else{
                                    $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>用户名或密码错误</span>");
                                }
                            }
                        }
                    });
                }
            }
            return false;
        });

        document.onkeydown = function(e){
            var ev = document.all ? window.event : e;
            if(ev.keyCode==13) {
                var username = $("input[name='username']").val();
                var password = $("input[name='password']").val();
                if(username.replace(/[ ]/g,"") == ''){
                    if($("input[name='username']").prev("span").length > 0){
                        $("input[name='username']").prev("span").remove();
                        $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>请输入用户名</span>");
                    }else{
                        $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>请输入用户名</span>");
                    }
                }else{
                    if(password.replace(/[ ]/g,"") == ''){
                        if($("input[name='username']").prev("span").length > 0){
                            $("input[name='username']").prev("span").remove();
                            $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>请输入密码</span>");
                        }else{
                            $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>请输入密码</span>");
                        }
                    }else{
                        $.ajax({
                            type:'POST',
                            url:"<?php echo HOSTNAME?>"+"index.php?r=login/dl",
                            data:{
                                username:username,
                                password: password,
                            },
                            dataType:'json',
                            success:function (data){
                                if(data['type'] == 1){
                                    window.location.href = "<?php echo HOSTNAME?>"+"index.php?r=site/main";
                                }else{
                                    if($("input[name='username']").prev("span").length > 0){
                                        $("input[name='username']").prev("span").remove();
                                        $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>用户名或密码错误</span>");
                                    }else{
                                        $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>用户名或密码错误</span>");
                                    }
                                }
                            }
                        });
                    }
                }
            }
        }

        //用户名input框失去焦点事件
        $("input[name = 'username']").blur(function () {
            var username = $(this).val();
            if(username.replace(/[ ]/g,"") == ''){
                if($(this).prev("span").length > 0){
                    $(this).prev("span").remove();
                    $(this).before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>请输入用户名</span>");
                }else{
                    $(this).before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>请输入用户名</span>");
                }
            }else{
                $(this).prev("span").remove();
            }
        })

        //密码input框失去焦点事件
        $("input[name = 'password']").blur(function () {
            var username = $("input[name = 'username']").val();
            var password = $(this).val();
            if(username.replace(/[ ]/g,"") == ''){
                if($("input[name='username']").prev("span").length > 0){
                    $("input[name='username']").prev("span").remove();
                    $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>请输入用户名</span>");
                }else{
                    $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>请输入用户名</span>");
                }
            }else{
                if(password.replace(/[ ]/g,"") == ''){
                    if($("input[name='username']").prev("span").length > 0){
                        $("input[name='username']").prev("span").remove();
                        $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>请输入密码</span>");
                    }else{
                        $("input[name='username']").before("<span style='color: red;display: block;font-size: 12px;width:230px;height:24px;line-height: 24px;margin:10px 0 0 45px;float:left;position: absolute;'>请输入密码</span>");
                    }
                }else{
                    $("input[name='username']").prev("span").remove();
                }
            }
        })

        Resize = function(){
            var wwww = $(window).width(),
                hhhh = $(window).height();
            $("body").css({
                "width":"100%",
                "height":hhhh,
                "overflow":"hidden"
            });
            if(wwww <= 1000 || hhhh <= 700){
                $("body").css({
                    "overflow":"auto"
                });
            }
        };
    });
</script>
</html>
