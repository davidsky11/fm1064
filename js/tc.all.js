jQuery.support.cors = true;  

// 设置cookie
function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires;
}

// 获取Cookie
function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(";");
	for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
    }
    return "";
}

// 清除cookie
function clearCookie(cname) {
	setCookie(name, "", -1);
}

function newWin(obj, mac, id, user_id, level, uid, status, HTTP_HOST) {
	var cookie = getCookie("winNum");  // 获取Cookie中winNum的值
	var index = 0;
	
	if (cookie == "" || cookie < 0 || cookie == null || typeof(cookie) == undefined )
	{
		index = 0;
		setCookie("winNum", 0, 1);
	} else {
		index = parseInt(cookie);
		setCookie("winNum", (index + 1), 1);
	}

	var timer2 = setInterval(function () {
		refresh(id, HTTP_HOST, index);
	},3000);

	var playWin = "";
	playWin += "<div id='popWin" + index + "' equipment_id = '" + id + "' class = 'popWin' status = '"+status+"'>";
	playWin += "<div class='tit" +index + "'><i class='close" + index + "'>关闭</i></div>";
	playWin += "<div class='pm'>";
	playWin += "<embed pluginspage='http://www.videolan.org' type='application/x-vlc-plugin' version='VideoLAN.VLCPlugin.2.2.1' width='500px' height='350px' text='Waiting for video' toolbar='false' fullscreen='false' name='vlc" + index + "'>";
	playWin += "<param name='Volume' value='50'/>";
	playWin += "<param name='ToolBar' value=false'/>";
	playWin += "</embed>";
	playWin += "</div>";
	playWin += "<div class=''></div>";
	playWin += "<div class='content'>";
	playWin += "<div class='nav'>";
	playWin += "<li>";
	playWin += "<a href='javascript:;' data = '0'>普清</a>";
	playWin += "</li>";
	playWin += "<div class='second'>";
	playWin += "<a href='javascript:;' data = '0'>普清</a><br />";
	playWin += "</div>";
	playWin += "</div>";
	playWin += "<div class='tbbox'>";
	playWin += "<ul>";
	if(status.substr(0,1) == "1"){
		playWin += "<a href='javascript:;' class='stream" + index +"' type = '2'><li><img src='images/selected-sx.png' alt='直播' title='直播' width='34px' height='25px' /></li></a>";
	}else{
		playWin += "<a href='javascript:;' class='stream" + index +"' type = '1'><li><img src='images/icon-sp.png' alt='直播' title='直播' width='34px' height='25px' /></li></a>";
	}
	if(status.substr(1,1) == "1"){
		playWin += "<a href='javascript:;' class='flash" + index + "' type = '4'><li><img src='images/selected-sd.png' alt='补光灯' title='补光灯' width='27px' height='33px' /></li></a>";
	}else{
		playWin += "<a href='javascript:;' class='flash" + index + "' type = '3'><li><img src='images/sd.png' alt='补光灯' title='补光灯' width='27px' height='33px' /></li></a>";
	}
	if(status.substr(2,1) == "1"){
		playWin += "<a href='javascript:;' class='ray" + index + "' type = '6'><li><img src='images/selected-dp.png' alt='红外灯' title='红外灯' width='21px' height='34px' /></li></a>";
	}else{
		playWin += "<a href='javascript:;' class='ray" + index + "' type = '5'><li><img src='images/icon-dp.png' alt='红外灯' title='红外灯' width='21px' height='34px' /></li></a>";
	}
	if(status.substr(3,1) == "1"){
		playWin += "<a href='javascript:;' class='lazer" + index + "' type = '8'><li><img src='images/selected-ls.png' alt='镭射灯' title='镭射灯' width='23px' height='27px' /></li></a>";
	}else{
		playWin += "<a href='javascript:;' class='lazer" + index + "' type = '7'><li><img src='images/icon-ls.png' alt='镭射灯' title='镭射灯' width='23px' height='27px' /></li></a>";
	}
	playWin += "<a href='javascript:;'><li><img src='images/icon-qp.png' alt='全屏' title='全屏' width='28px' height='20px' /></li></a>";
	playWin += "</ul>";
	playWin += "</div>";
	playWin += "</div>";

	var _z=9000;
	var _mv=false;
	var _x,_y;
	var parentDiv = $("."+obj);
	parentDiv.append(playWin);

	var _obj= $("#popWin"+index);
	var _wid= parentDiv.width();
	var _hei= parentDiv.height();
	var _tit= _obj.find(".tit" + index);
	var _cls=_obj.find(".close" + index);
	
	var _stream=_obj.find(".stream" + index);
	var _flash=_obj.find(".flash" + index);
	var _ray=_obj.find(".ray" + index);
	var _lazer=_obj.find(".lazer" + index);

	var docE =document.documentElement;
	var left=($(document).width()-parentDiv.width())/2;
	var top =(docE.clientHeight-parentDiv.height())/2;

	_obj.css({ "position":"absolute","background":"#666", "width":"500px", "height":"350px", "left":left,"top":top,"display":"block","z-index":_z-(-1)});
	_tit.css({ "background":"#666", "display":"block", "height":"28px", "cursor":"move"});
	_cls.css({ "float":"right", "line-height":"28px", "padding":"0 8px", "color":"#333","cursor":"default"});

	_tit.mousedown(function(e){
		_mv=true;
		_x=e.pageX-parseInt(_obj.css("left"));//获得左边位置
		_y=e.pageY-parseInt(_obj.css("top"));//获得上边位置
		_obj.css({"z-index":_z-(-1)+index}).fadeTo(50,.5);//点击后开始拖动并透明显示	
		_cls.css({"z-index":_z-(-1)+index});
	});
	_tit.mouseup(function(e){
		_mv=false;
		_obj.fadeTo("fast",1);//松开鼠标后停止移动并恢复成不透明				 
	});
	
	$(document).mousemove(function(e){
		if(_mv){
			var x=e.pageX-_x;//移动时根据鼠标位置计算控件左上角的绝对位置
			if(x<=0){x=0};
			x=Math.min(docE.clientWidth-_wid,x)-5;
			var y=e.pageY-_y;
			if(y<=0){y=0};
			y=Math.min(docE.clientHeight-_hei,y)-5;
			_obj.css({
				top:y,left:x
			});//控件新位置
		}
	});

	_cls.live("click",function(){
		_obj.remove();
		clearInterval(timer2);
	});

	//直播按钮
	_stream.live("click",function(){
		var data = $(this).parents(".content").find("li a").attr("data");
		var statusNew = $(this).parents(".popWin").attr("status");
		if(level == 1){
			if(statusNew.substr(0,1) == "1"){
				$(this).attr("type","2");
				$(this).find("img").attr("src","images/selected-sx.png");
			}else{
				$(this).attr("type","1");
				$(this).find("img").attr("src","images/icon-sp.png");
			}
			var type = $(this).attr("type");
			cmd(index,mac,type,data,HTTP_HOST);
		}else{
			if(user_id == uid){
				if(statusNew.substr(0,1) == "1"){
					$(this).attr("type","2");
					$(this).find("img").attr("src","images/selected-sx.png");
				}else{
					$(this).attr("type","1");
					$(this).find("img").attr("src","images/icon-sp.png");
				}
				var type = $(this).attr("type");
				cmd(index,mac,type,data);
			}else{
				_stream.unbind("click");
			}
		}

	});

	//补光灯按钮
	_flash.live("click",function(){
		if(level == 1){
			var data = "0";
			/*if($(this).attr("type") == "4"){
				$(this).attr("type","3");
			}else{
				$(this).attr("type","4");
			}*/
			var type = $(this).attr("type");
			if(status.substr(1,1) == "1"){
				$(this).find("img").attr("src","images/selected-sd.png");
			}else{
				$(this).find("img").attr("src","images/sd.png");
			}
			cmd(index,mac,type,data);
		}else{
			if(user_id == uid){
				var data = "0";
				/*if($(this).attr("type") == "4"){
					$(this).attr("type","3");
				}else{
					$(this).attr("type","4");
				}*/
				var type = $(this).attr("type");
				if(status.substr(1,1) == "1"){
					$(this).find("img").attr("src","images/selected-sd.png");
				}else{
					$(this).find("img").attr("src","images/sd.png");
				}
				cmd(index,mac,type,data);
			}else{
				_flash.unbind("click");
			}
		}

	});

	//红外灯按钮
	_ray.live("click",function(){
		if(level == 1){
			var data = "0";
			/*if($(this).attr("type") == "6"){
				$(this).attr("type","5");
			}else{
				$(this).attr("type","6");
			}*/
			var type = $(this).attr("type");
			if(status.substr(2,1) == "1"){
				$(this).find("img").attr("src","images/selected-dp.png");
			}else{
				$(this).find("img").attr("src","images/icon-dp.png");
			}
			cmd(index,mac,type,data);
		}else{
			if(user_id == uid){
				var data = "0";
				/*if($(this).attr("type") == "6"){
					$(this).attr("type","5");
				}else{
					$(this).attr("type","6");
				}*/
				var type = $(this).attr("type");
				if(status.substr(2,1) == "1"){
					$(this).find("img").attr("src","images/selected-dp.png");
				}else{
					$(this).find("img").attr("src","images/icon-dp.png");
				}
				cmd(index,mac,type,data);
			}else{
				_ray.unbind("click");
			}
		}
	});

	//镭射灯按钮
	_lazer.live("click",function(){
		if(level == 1){
			var data = "0";
			/*if($(this).attr("type") == "6"){
				$(this).attr("type","5");
			}else{
				$(this).attr("type","6");
			}*/
			var type = $(this).attr("type");
			if(status.substr(3,1) == "1"){
				$(this).find("img").attr("src","images/selected-ls.png");
			}else{
				$(this).find("img").attr("src","images/icon-ls.png");
			}
			cmd(index,mac,type,data);
		}else{
			if(user_id == uid){
				var data = "0";
				/*if($(this).attr("type") == "6"){
					$(this).attr("type","5");
				}else{
					$(this).attr("type","6");
				}*/
				var type = $(this).attr("type");
				if(status.substr(3,1) == "1"){
					$(this).find("img").attr("src","images/selected-ls.png");
				}else{
					$(this).find("img").attr("src","images/icon-ls.png");
				}
				cmd(index,mac,type,data);
			}else{
				_ray.unbind("click");
			}
		}
	});

	if (status.substr(0,1) == "1")
	{
		var vlc = getVlc('vlc' + index);
		var mrl = "rtsp://192.168.2.113:1935/live/" + mac;  // 流媒体的URL
		//alert(mrl);
		vlc.playlist.clear();
		var itemId = vlc.playlist.add(mrl);
		vlc.playlist.playItem(itemId);
	}
}
/**
 *
 */
function getVlc(name) {
	if (window.document[name]) {
		return window.document[name];
	}
	if (navigator.appName.indexOf("Microsoft Internet") == -1) {
		if (document.embeds && document.embeds[name]) {
			return document.embeds[name];
		}
	} 
	else {
		return document.getElementById(name);
	}
}

function refresh(id,HTTP_HOST,index){

	$.ajax({
		type:'GET',
		url:"http://"+HTTP_HOST+"/tlj_cms/index.php?r=site/getstatus",
		data:{id:id},
		dataType:'json',
		success:function(data){
			$("#popWin"+index).attr('status',data);
			var html = '';
			if(data.substr(0,1) == "1"){
				html += "<a href='javascript:;' class='stream" + index +"' type = '2'><li><img src='images/selected-sx.png' alt='直播' title='直播' width='34px' height='25px' /></li></a>";
			}else{
				html += "<a href='javascript:;' class='stream" + index +"' type = '1'><li><img src='images/icon-sp.png' alt='直播' title='直播' width='34px' height='25px' /></li></a>";
			}
			if(data.substr(1,1) == "1"){
				html += "<a href='javascript:;' class='flash" + index + "' type = '4'><li><img src='images/selected-sd.png' alt='补光灯' title='补光灯' width='27px' height='33px' /></li></a>";
			}else{
				html += "<a href='javascript:;' class='flash" + index + "' type = '3'><li><img src='images/sd.png' alt='补光灯' title='补光灯' width='27px' height='33px' /></li></a>";
			}
			if(data.substr(2,1) == "1"){
				html += "<a href='javascript:;' class='ray" + index + "' type = '6'><li><img src='images/selected-dp.png' alt='红外灯' title='红外灯' width='21px' height='34px' /></li></a>";
			}else{
				html += "<a href='javascript:;' class='ray" + index + "' type = '5'><li><img src='images/icon-dp.png' alt='红外灯' title='红外灯' width='21px' height='34px' /></li></a>";
			}
			if(data.substr(3,1) == "1"){
				html += "<a href='javascript:;' class='lazer" + index + "' type = '8'><li><img src='images/selected-ls.png' alt='镭射灯' title='镭射灯' width='23px' height='27px' /></li></a>";
			}else{
				html += "<a href='javascript:;' class='lazer" + index + "' type = '7'><li><img src='images/icon-ls.png' alt='镭射灯' title='镭射灯' width='23px' height='27px' /></li></a>";
			}
			html += "<a href='javascript:;'><li><img src='images/icon-qp.png' alt='全屏' title='全屏' width='28px' height='20px' /></li></a>";
			$("#popWin"+index).find("ul").html(html);
		}
	});
}

//发送指令
function cmd(index, mac, type, data) {
	var host = "192.168.2.113";
	host = "localhost";
	var vlc = getVlc("vlc" + index);
	var url="http://" + host + ":8080/PushServer/servlet/send";

	alert("发送指令... 请静待几秒... [TYPE] " + type);
	$.ajax({
		type:'POST',
		url:url,
		dataType:'text',
		async:false,
		data:{
			MAC : mac,
			TYPE : type,
			DATA : data,
			TEMP : new Date()  // 加上时间戳
		},
		success:function(data, textStatus) {  // ajax调用成功
			if (type=="1")
			{
				var time = 10;
				vlc.playlist.clear();
				var mrl = "rtsp://" + host + ":1935/live/" + mac;  // 流媒体的URL
				var itemId = vlc.playlist.add(mrl);
				alert("[开始直播]发送成功.. 等待直播线路打通.. ");
				//alert("延迟播放[" + time + "s] : " +mrl + "||" + XMLHttpRequest.status + "||" + XMLHttpRequest.readyState + "||" + textStatus);
				setTimeout(function(){					
					vlc.playlist.playItem(itemId);
				}, 1000 * time);
			} else if (type=="2")
			{
				alert("[停止直播]发送成功... 等待服务器响应... ");
				vlc.playlist.stop(); 
				vlc.playlist.clear();
			} else if (type=="3")
			{
			} else if (type=="4")
			{
			} else if (type=="5")
			{
			} else if (type=="6")
			{
			}	
		},
		complete:function(XMLHttpRequest, textStatus){  // ajax调用完成
			//textStatus的值：success,notmodified,nocontent,error,timeout,abort,parsererror
			if (type=="1")
			{
				//alert("[开始直播]发送成功.. 等待直播线路打通.. ");
			} else if (type=="2")
			{
				//alert("[停止直播]发送成功... 等待服务器响应... ");
			} else if (type=="3")
			{

			} else if (type=="4")
			{

			} else if (type=="5")
			{

			} else if (type=="6")
			{
			}
		},
		error:function(XMLHttpRequest, textStatus, errorThrown){  // ajax调用失败
			//textStatus的值：null, timeout, error, abort, parsererror  
			//errorThrown的值：收到http出错文本，如 Not Found 或 Internal Server Error. 

			var errMsg = "";
			var showMsg = "";
			
			switch (errorThrown.message)
			{
			case "NetworkError":
				errMsg = "服务器访问失败";
				break;
			case "No Transport":
				errMsg = "指令未成功送出";
				break;
			case "Uncaught TypeError":
				break;
			case "parsererror":
				errMsg = "返回数据格式异常";
				break;
			default:
				errMsg = "";
				break;
			}

			if (type=="1")
			{
				showMsg = "[异常]：'开始直播'发送失败 . . . ";
				//vlc._streaming.attr("type", "1");
			} else if (type=="2")
			{
				showMsg = "[异常]：'停止直播'发送失败 . . . ";
				//vlc._streaming.attr("type", "2");
			} else if (type=="3")
			{
				//alert("[打开补光灯]发送失败 ... ||" + XMLHttpRequest.status + "||" + XMLHttpRequest.readyState + "||" + textStatus + "||" + errorThrown);
				vlc._flash.attr("type", "3");
			} else if (type=="4")
			{
				//alert("[关闭补光灯]发送失败 ... ||" + XMLHttpRequest.status + "||" + XMLHttpRequest.readyState + "||" + textStatus + "||" + errorThrown);
				vlc._flash.attr("type", "4");
			} else if (type=="5")
			{
				//alert("[开发红外灯]发送失败 ... ||" + XMLHttpRequest.status + "||" + XMLHttpRequest.readyState + "||" + textStatus + "||" + errorThrown);
				vlc._ray.attr("type", "5");
			} else if (type=="6")
			{
				//alert("[关闭红外灯]发送失败 ... ||" + XMLHttpRequest.status + "||" + XMLHttpRequest.readyState + "||" + textStatus + "||" + errorThrown);
				vlc._ray.attr("type", "6");
			} else if (type=="7")
			{
				vlc._lazer.attr("type", "7");
			} else if (type == "8")
			{
				vlc._lazer.attr("type", "8");
			}

			if (errMsg==""||errMsg==undefined||errMsg==null) {

			} else {
				showMsg = showMsg + "\n[原因]：" + errMsg + "\n[代码]：[" 
					+ XMLHttpRequest.status + " " + XMLHttpRequest.readyState + " " + textStatus + " " + errorThrown + "]";
			}
			if (showMsg==""||showMsg==undefined||showMsg==null) {

			} else {
				alert(showMsg);
			}

		}
	});

}

/*
 * 频率控制 返回函数连续调用时，fn 执行频率限定为每多少时间执行一次
 * @param fn {function} 需要调用的函数
 * @param delay {number} 延迟时间，单位毫秒
 * @param immediate {bool} 给 immediate 参数传递false 绑定的函数先执行，而不是delay后执行
 * @return {function} 实际调用的函数
 */
var throttle = function (fn, delay, immediate, debounce) {
	var curr = +new Date(),  // 当前时间
		last_call = 0,
		last_exec = 0,
		timer = null,
		diff,  // 时间差
		context,  // 上下文
		args, 
		exec = function() {
			last_exec = curr;
			fn.apply(context, args);
		};
	return function() {
		curr= +new Date();
		context = this,
		args = arguments,
		diff = curr - (debounce ? last_call : last_exec) - delay;
		clearTimeout(timer);
		if (debounce)
		{
			if (immediate)
			{
				timer = setTimeout(exec, delay);
			} else if (diff >= 0)
			{
				exec();
			}
		} else {
			if (diff >= 0)
			{
				exec();
			} else if (immediate)
			{
				timer = setTimeout(exec, -diff);
			}
		}
		last_call = curr;
	}
};

/*
 * 空闲控制 返回番薯连续调用时，空闲时间必须大于或等于 delay, fn 才会执行
 * @param fn {function} 要调用的函数
 * @param delay {number} 空闲时间
 * @param immediate {bool} 给 immediate 参数传递false 绑定的函数先执行，而不是delay后执行
 * @return {function} 实际调用的函数
 */
var debounce = function (fn, delay, immediate) {
	return throttle (fn, delay, immediate, true);
}


//自动关闭提示框  
function Alert(str) {  
    var msgw,msgh,bordercolor;  
    msgw=350;//提示窗口的宽度  
    msgh=80;//提示窗口的高度  
    titleheight=25 //提示窗口标题高度  
    bordercolor="#336699";//提示窗口的边框颜色  
    titlecolor="#99CCFF";//提示窗口的标题颜色  
    var sWidth,sHeight;  
    //获取当前窗口尺寸  
    sWidth = document.body.offsetWidth;  
    sHeight = document.body.offsetHeight;  
//    //背景div  
    var bgObj=document.createElement("div");  
    bgObj.setAttribute('id','alertbgDiv');  
    bgObj.style.position="absolute";  
    bgObj.style.top="0";  
    bgObj.style.background="#E8E8E8";  
    bgObj.style.filter="progid:DXImageTransform.Microsoft.Alpha(style=3,opacity=25,finishOpacity=75";  
    bgObj.style.opacity="0.6";  
    bgObj.style.left="0";  
    bgObj.style.width = sWidth + "px";  
    bgObj.style.height = sHeight + "px";  
    bgObj.style.zIndex = "10000";  
    document.body.appendChild(bgObj);  
    //创建提示窗口的div  
    var msgObj = document.createElement("div")  
    msgObj.setAttribute("id","alertmsgDiv");  
    msgObj.setAttribute("align","center");  
    msgObj.style.background="white";  
    msgObj.style.border="1px solid " + bordercolor;  
    msgObj.style.position = "absolute";  
    msgObj.style.left = "50%";  
    msgObj.style.font="12px/1.6em Verdana, Geneva, Arial, Helvetica, sans-serif";  
    //窗口距离左侧和顶端的距离   
    msgObj.style.marginLeft = "-225px";  
    //窗口被卷去的高+（屏幕可用工作区高/2）-150  
    msgObj.style.top = document.body.scrollTop+(window.screen.availHeight/2)-150 +"px";  
    msgObj.style.width = msgw + "px";  
    msgObj.style.height = msgh + "px";  
    msgObj.style.textAlign = "center";  
    msgObj.style.lineHeight ="25px";  
    msgObj.style.zIndex = "10001";  
    document.body.appendChild(msgObj);  
    //提示信息标题  
    var title=document.createElement("h4");  
    title.setAttribute("id","alertmsgTitle");  
    title.setAttribute("align","left");  
    title.style.margin="0";  
    title.style.padding="3px";  
    title.style.background = bordercolor;  
    title.style.filter="progid:DXImageTransform.Microsoft.Alpha(startX=20, startY=20, finishX=100, finishY=100,style=1,opacity=75,finishOpacity=100);";  
    title.style.opacity="0.75";  
    title.style.border="1px solid " + bordercolor;  
    title.style.height="18px";  
    title.style.font="12px Verdana, Geneva, Arial, Helvetica, sans-serif";  
    title.style.color="white";  
    title.innerHTML="提示信息";  
    document.getElementById("alertmsgDiv").appendChild(title);  
    //提示信息  
    var txt = document.createElement("p");  
    txt.setAttribute("id","msgTxt");  
    txt.style.margin="16px 0";  
    txt.innerHTML = str;  
    document.getElementById("alertmsgDiv").appendChild(txt);  
    //设置关闭时间  
    window.setTimeout("closewin()",2000);   
}  
function closewin() {  
    document.body.removeChild(document.getElementById("alertbgDiv"));  
    document.getElementById("alertmsgDiv").removeChild(document.getElementById("alertmsgTitle"));  
    document.body.removeChild(document.getElementById("alertmsgDiv"));  
} 