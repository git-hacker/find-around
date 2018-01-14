/**
 * @name dom  linkto 属性增强
 * @author topqiang
 * @version 1.0
 * **/
function top_linkto(){
	$("[linkto]").on('click',function(){
		var self = $(this);
		var url = $.trim(self.attr("linkto"));
		if( url == ""){
			return;
		}
		//匹配全路径跳转
		if( url.indexOf("http://") == 0 || url.indexOf("https://") == 0 ){
			window.location.href = url;
		}else if( url.indexOf("/") == 0 ){
			//匹配   类似于Thinkphp类型的URL {:U('Index/index')} => /项目名/index.php/Index/index  
			var hostname = getRootPath();
			url = hostname + url;
			window.location.href = url;
		}else if( url.indexOf("tel:") == 0){
			window.location.href = url;
		}else if( url.indexOf("javascript:") == 0){
			var start = url.indexOf(":");
			var str = url.substring(start+1);
			eval(str);
		}else if( url.indexOf("./") == 0 || url.indexOf("/") == -1){
			//匹配静态跳转，已经相对路径跳转。
			var curUrl = window.location.href;
			url = curUrl.substr(0,curUrl.lastIndexOf("/")+1) + url;
			window.location.href = url;
		}
	});
}
function getRootPath(){
    var curWwwPath=window.document.location.href;
    var pathName=window.document.location.pathname;
    var pos=curWwwPath.indexOf(pathName);
    var localhostPaht=curWwwPath.substring(0,pos);
    var projectName=pathName.substring(0,pathName.substr(1).indexOf('/')+1);
    return(localhostPaht);
}
/**
 * @name check响应
 * @author topqiang
 * @version 1.0
 * **/
function top_check(){
	$(".top_radio").off('click');
	$(".top_check").off('click');
	$(".top_radio").on('click',function(){
		var self = $(this);
		self.addClass("on");
		self.siblings().removeClass("on");

		if (typeof radioAfter === 'function') {
			radioAfter(self);
		}
	});
	$(".top_check").on('click',function(){
		var self = $(this);
		if(self.hasClass("on")){
			self.removeClass("on");
		}else{
			self.addClass("on");
		}

		if (typeof checkAfter === 'function') {
			checkAfter(self);
		}
	});
}
/**
 * @name  星级评价组件
 * @author topqiang
 * @version 1.0
 * **/
function top_rate(){
	$(".top_rate span").on('click',function(){
		var self = $(this);
		self.nextAll().removeClass("on");
		self.prevAll().addClass("on");
		if(!self.hasClass("on")){
			self.addClass("on");
		}
	});
}
/**
 * @name  购物车显示隐藏
 * @author topqiang
 * @version 1.0
 * **/
function top_ingley(){
	$(".gley .icongley").on('click',function(){
		if($(this).parents('.gley').hasClass('on')){
			$(".zhao").toggleClass('disn');
			$(".zhcon").toggleClass('disn');
		}
	});
}
/**
 * @name 隐式下拉框交互
 * @author topqiang
 * @version 1.0
 * **/
function top_select(){
	$("select.opainput").on('change',function(){
		var self = $(this);
		var elename = self.attr("forele");
		if($.trim(elename) != ""){
			var ele = self.parent().find("[ele="+elename+"]");
			var value = self.val();
			var inValue = self.find('option[value='+value+']').text();
			// ele.text(self.val());
			ele.text(inValue);
		}

		if (typeof selectAfter === 'function') {
			selectAfter(self);
		}
	});
}

/**
 * @name 回顶部
 * @author topqiang
 * @version 1.0
 * **/
function top_gohead(){
	$(".top_gohead").on('click',function(){
		var height = $(document).scrollTop();
		$("html,body").animate({scrollTop:0},500);
	});
}

/**
 * @name 分类筛选
 * @author topqiang
 * @version 1.0
 * **/
function top_sifting(){
	$(".dosifting").on('click',function(){
		$(".sifting").slideToggle();
	});
}

/**
*ajax 请求封装
*@author topqiang
*@name requestUrl
**/ 
function requestUrl(URL,DATA,CALLBACK,TYPE,ISLOAD,DATATYPE){
	if (!URL) return;
	if (!TYPE) TYPE ="post";
	if (!DATATYPE) DATATYPE ="json";
	 if (ISLOAD) layer.open({type:3});
	//layer.open({
	// 	type:1,
	// 	title:false,
	// 	closeBtn:false,
	// 	content:'<div id="dingbox"><span class="span1">￥</span><span class="span2">￥</span></div>'
	// });
	var times = new Date().getTime();
	$.ajax({
		"url":URL,
		"data" : DATA,
		"dataType" : DATATYPE,
		"type" : TYPE,
		"success" : function(res){
			if (typeof CALLBACK == 'function') {
				CALLBACK(res,times);
			}
		}
	});
}

/**
*获取用户信息
*@author  topqiang
***/
function getUserInfo(URL){
	var jsonstr = sessionStorage.getItem("top_user");
	if (jsonstr) {
		window.top_user = JSON.parse(jsonstr);
		return top_user;
	}else{
		if(!URL){
			console.warn("请在获取用户信息时，填写登录页面URL");
			return "";
		}else{
			window.location.href = URL;
		}
	}
}


function getCode(url,type,port){
    $(".getcode,.getlcode").on('click',function(){
        var self = $(this);
        var account = $(".account").val();
        var verify_code = $(".verify_code").val();
        if (self.attr('disabled')) return;
        if ( account == "" ) {
            layer.msg("请填写手机号！");
            return;
        }
        if ( verify_code == "" ) {
            layer.msg("请填写验证码！");
            return;
        }
        requestUrl(url,{"tel":account,"type":type,"port":port,"verify_code":verify_code},function( res ){
            if (res.flag == "success") {
                var i = 60;
                var time = setInterval(function(){
                    self.text(i+"秒").attr("disabled","true");
                    --i;
                    if (i == 0) {
                        clearInterval(time);
                        self.text("获取验证码").removeAttr("disabled");
                    }   
                },1000);
            }else{
                layer.msg(res.message);
            }
        });
    });
}


//将用户信息挂在到
var jsonstr = sessionStorage.getItem("top_user") || localStorage.getItem("top_user");
	if (jsonstr) {
		window.top_user = JSON.parse(jsonstr);
	}else{
		window.top_user = false;
	}


$(function(){
	//吊起linkto增强页面跳转
	top_linkto();
	//吊起check响应
	top_check();
	//开启星级评价
	top_rate();
	//开启购物车
	top_ingley();
	//吊起统一下拉框
	top_select();
	//吊起回顶部
	top_gohead();
	//吊起分类刷选事件
	top_sifting();
	$(".rigshe").on('click',function(){
        $(".goinmsg").toggle();
    }).on('blur',function () {
        $(".goinmsg").hide();
    });
});
