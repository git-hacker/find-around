/**
 * 全局js
 */
$(function(){
	//自定义函数
	jQuery.extend({
		check_login:function(){//检查登录状态，并弹出登录对话框
    		var result = false;
			   $.ajax({
				  url:""+check_loginurl+"",
				  dataType:"json",
                  type: "post",
                  async: false,// 同步传输执行
                  success: function (data) {
                      if(data.status == false){
                    	  window.location.href=data.url;
                      }else{
                    	  result=true;
                      }
                  }
              })
              return result;
		  },
		  click_clime:function(event){//点击其他地方时应该自动关闭
				var e=window.event || event;
				if(e.stopPropagation){
					e.stopPropagation();
				}else{
					e.cancelBubble = true;
				}
	     },
		/**
	       * 当前时间戳
	       * @return <int>        unix时间戳(秒)   
	       */
	      CurTime: function(){
	          return Date.parse(new Date())/1000;
	      },
	      DateToUnix: function(string) {
	          var f = string.split(' ', 2);
	          var d = (f[0] ? f[0] : '').split('-', 3);
	          var t = (f[1] ? f[1] : '').split(':', 3);
	          return (new Date(
	                  parseInt(d[0], 10) || null,
	                  (parseInt(d[1], 10) || 1) - 1,
	                  parseInt(d[2], 10) || null,
	                  parseInt(t[0], 10) || null,
	                  parseInt(t[1], 10) || null,
	                  parseInt(t[2], 10) || null
	                  )).getTime() / 1000;
	      }, 
	      UnixToDate: function(format, timestamp) {
	    	  var a, jsdate=((timestamp) ? new Date(timestamp*1000) : new Date());
	    	    var pad = function(n, c){
	    	        if((n = n + "").length < c){
	    	            return new Array(++c - n.length).join("0") + n;
	    	        } else {
	    	            return n;
	    	        }
	    	    };
	    	    var txt_weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
	    	    var txt_ordin = {
	    	        1:"st",
	    	        2:"nd",
	    	        3:"rd",
	    	        21:"st",
	    	        22:"nd",
	    	        23:"rd",
	    	        31:"st"
	    	    };
	    	    var txt_months = ["", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	    	    var f = {
	    	        // Day
	    	        d: function(){
	    	            return pad(f.j(), 2)
	    	        },
	    	        D: function(){
	    	            return f.l().substr(0,3)
	    	        },
	    	        j: function(){
	    	            return jsdate.getDate()
	    	        },
	    	        l: function(){
	    	            return txt_weekdays[f.w()]
	    	        },
	    	        N: function(){
	    	            return f.w() + 1
	    	        },
	    	        S: function(){
	    	            return txt_ordin[f.j()] ? txt_ordin[f.j()] : 'th'
	    	        },
	    	        w: function(){
	    	            return jsdate.getDay()
	    	        },
	    	        z: function(){
	    	            return (jsdate - new Date(jsdate.getFullYear() + "/1/1")) / 864e5 >> 0
	    	        },

	    	        // Week
	    	        W: function(){
	    	            var a = f.z(), b = 364 + f.L() - a;
	    	            var nd2, nd = (new Date(jsdate.getFullYear() + "/1/1").getDay() || 7) - 1;
	    	            if(b <= 2 && ((jsdate.getDay() || 7) - 1) <= 2 - b){
	    	                return 1;
	    	            } else{
	    	                if(a <= 2 && nd >= 4 && a >= (6 - nd)){
	    	                    nd2 = new Date(jsdate.getFullYear() - 1 + "/12/31");
	    	                    return date("W", Math.round(nd2.getTime()/1000));
	    	                } else{
	    	                    return (1 + (nd <= 3 ? ((a + nd) / 7) : (a - (7 - nd)) / 7) >> 0);
	    	                }
	    	            }
	    	        },

	    	        // Month
	    	        F: function(){
	    	            return txt_months[f.n()]
	    	        },
	    	        m: function(){
	    	            return pad(f.n(), 2)
	    	        },
	    	        M: function(){
	    	            return f.F().substr(0,3)
	    	        },
	    	        n: function(){
	    	            return jsdate.getMonth() + 1
	    	        },
	    	        t: function(){
	    	            var n;
	    	            if( (n = jsdate.getMonth() + 1) == 2 ){
	    	                return 28 + f.L();
	    	            } else{
	    	                if( n & 1 && n < 8 || !(n & 1) && n > 7 ){
	    	                    return 31;
	    	                } else{
	    	                    return 30;
	    	                }
	    	            }
	    	        },

	    	        // Year
	    	        L: function(){
	    	            var y = f.Y();
	    	            return (!(y & 3) && (y % 1e2 || !(y % 4e2))) ? 1 : 0
	    	        },
	    	        //o not supported yet
	    	        Y: function(){
	    	            return jsdate.getFullYear()
	    	        },
	    	        y: function(){
	    	            return (jsdate.getFullYear() + "").slice(2)
	    	        },

	    	        // Time
	    	        a: function(){
	    	            return jsdate.getHours() > 11 ? "pm" : "am"
	    	        },
	    	        A: function(){
	    	            return f.a().toUpperCase()
	    	        },
	    	        B: function(){
	    	            // peter paul koch:
	    	            var off = (jsdate.getTimezoneOffset() + 60)*60;
	    	            var theSeconds = (jsdate.getHours() * 3600) + (jsdate.getMinutes() * 60) + jsdate.getSeconds() + off;
	    	            var beat = Math.floor(theSeconds/86.4);
	    	            if (beat > 1000) beat -= 1000;
	    	            if (beat < 0) beat += 1000;
	    	            if ((String(beat)).length == 1) beat = "00"+beat;
	    	            if ((String(beat)).length == 2) beat = "0"+beat;
	    	            return beat;
	    	        },
	    	        g: function(){
	    	            return jsdate.getHours() % 12 || 12
	    	        },
	    	        G: function(){
	    	            return jsdate.getHours()
	    	        },
	    	        h: function(){
	    	            return pad(f.g(), 2)
	    	        },
	    	        H: function(){
	    	            return pad(jsdate.getHours(), 2)
	    	        },
	    	        i: function(){
	    	            return pad(jsdate.getMinutes(), 2)
	    	        },
	    	        s: function(){
	    	            return pad(jsdate.getSeconds(), 2)
	    	        },
	    	        //u not supported yet

	    	        // Timezone
	    	        //e not supported yet
	    	        //I not supported yet
	    	        O: function(){
	    	            var t = pad(Math.abs(jsdate.getTimezoneOffset()/60*100), 4);
	    	            if (jsdate.getTimezoneOffset() > 0) t = "-" + t; else t = "+" + t;
	    	            return t;
	    	        },
	    	        P: function(){
	    	            var O = f.O();
	    	            return (O.substr(0, 3) + ":" + O.substr(3, 2))
	    	        },
	    	        //T not supported yet
	    	        //Z not supported yet

	    	        // Full Date/Time
	    	        c: function(){
	    	            return f.Y() + "-" + f.m() + "-" + f.d() + "T" + f.h() + ":" + f.i() + ":" + f.s() + f.P()
	    	        },
	    	        //r not supported yet
	    	        U: function(){
	    	            return Math.round(jsdate.getTime()/1000)
	    	        }
	    	    };

	    	    return format.replace(/[\\]?([a-zA-Z])/g, function(t, s){
	    	        if( t!=s ){
	    	            // escaped
	    	            ret = s;
	    	        } else if( f[s] ){
	    	            // a date function exists
	    	            ret = f[s]();
	    	        } else{
	    	            // nothing special
	    	            ret = s;
	    	        }
	    	        return ret;
	    	    });
	      }
	});
	
})
/**
 * 返回顶部
 */
function scrollToTop() {
	var d = $(".floor_left_box"), e = d, f = $(window).height();
	/*loli.delay(window, "scroll", null, function() {
		if ($(window).scrollTop() > 0) {
			e.css("display", "block")
		} else {
			e.css("display", "none")
		}
		if ($.browser.msie && $.browser.version <= 6) {
			d.css("top", (f - 480 - 30 + $(window).scrollTop()) + "px")
		}
	});*/
	  $(window).bind("scroll", function() {
		  if ($(window).scrollTop() > 0) {
				e.css("display", "block");
			} else {
				e.css("display", "none");
			}
		  if ($.browser.msie && $.browser.version <= 6) {
				d.css("top", (f - 480 - 30 + $(window).scrollTop()) + "px")
			}
	  });
	$(".toTop", e).click(function() {
		$("body,html").stop().animate({
			scrollTop : 0
		});
		return false
	});
	/*$(".fixedRight").delegate(".fanli_code_wrap", "mouseenter", function() {
		$(".fanli_code", this).show()
	});
	$(".fixedRight").delegate(".fanli_code_wrap", "mouseleave", function() {
		$(".fanli_code", this).hide()
	})*/
}
/**
 * 获取短信验证码
 * @param userPhone 手机号
 * @returns String
 */

function saveUserCode(userPhone,type){
	var returndata="";
	$.ajax({
	      url:saveUsercode,
	      data:{"userPhone":userPhone,"type":type},
	      type:"post",
	      async:false,
	      dataType:"json",           
	      success : function(data){	            
	    	  returndata=data;	        		    
	       },
	       error : function(i, data){
	    	   returndata={"status":"n","info":"发送失败!"};
			}
	    })
  return returndata;
}
/**
 * 金额的输入判断
 * @param obj 当前元素
 * @param pos 保留几位小数
 * @param def 
 * @param max 最大输入值
 * 例如：validNum(this,2,'',10000000);
 */
function validNum(obj, pos, def, max) {
	var val = $.trim(obj.value);
	if (val == '') {
		obj.value = '0';
		return;
	}
	if (!isNaN(val)) {
		var num = parseFloat(val);
		if (num > max) {
			obj.value = def;
		} else {
			var _s1 = val.split('.')[0];
			var _ss = val.split('.')[1];
			if (_s1 == '') {
				_s1 = '0';
			}
			obj.value = _ss == undefined ? _s1 : _s1 + '.'
					+ (_ss.length > pos ? _ss.substring(0, pos) : _ss);
		}
	} else {
		if (val.indexOf('.') == 0) {
			if (val.length == 1) {
				obj.value = val;
			} else {
				var _ss = val.split('.')[1];
				if (_ss.length > pos) {
					_ss = _ss.substring(0, pos);
				}
				obj.value = parseInt(_ss, 10) != NaN ? def : '0' + val;
			}
		} else {
			obj.value = def;
		}
	}
	var __val = obj.value;
	var __arr = __val.split(".");
	var __len = __arr.length;
	if (__len == 1) {
		obj.value = parseFloat(__arr[0]);
	} else if (__len == 2) {
		if (__arr[0] != "") {
			var __tStr = '';
			if (__arr[1] && __arr[1] != undefined) {
				__tStr = __arr[1];
			}
			obj.value = parseInt(__arr[0]) + "." + __tStr;
		}
	}
	if (obj.value == 'NaN' || obj.value == NaN) {
		obj.value = def;
	}
}
/**
 * 收藏
 * @param type   收藏类别1：商品信息；2：商家
 * @param coll_id 收藏对象id
 * @param returninfo 回显提示
 */
function jsctcollection(type,coll_id,returninfo,classcss) {
	 if(!$.check_login()){
		return false;
	 }
	 var $returninfo=$(".returninfo");
	$.ajax({
	      url:ctcollection,
	      data:{"type":type,"coll_id":coll_id},
	      type:"post",
	      async:true,
	      dataType:"json",           
	      success : function(data){	            
	    	 if(data.status){
	    		 $returninfo.html(returninfo).removeAttr("onclick");
	    		 if(classcss=="1"){
	    			 $returninfo.addClass("collectionhover");
	    		 }
	    		 alert(data.info);
	    	 }else{
	    		 alert(data.info);
	    	 }	        		    
	       },
	       error : function(i, data){
	    	   alert("系统繁忙，请稍候继续！");
			}
	    })
}
/**
 * 删除收藏
 * @param type   收藏类别1：商品信息；2：商家
 * @param coll_id 收藏对象id
 * @param returninfo 回显提示
 */
function jsctcolledelete(collid,obj) {
  if(confirm("确定要删除收藏吗？")){
	$.ajax({
	      url:ctcollectiondelete,
	      data:{"collid":collid},
	      type:"post",
	      async:true,
	      dataType:"json",           
	      success : function(data){	            
	    	 if(data.status){
	    		 $(obj).closest(".markctcelete").remove();
	    		 alert(data.info);
	    	 }else{
	    		 alert(data.info);
	    	 }	        		    
	       },
	       error : function(i, data){
	    	   alert("系统繁忙，请稍候继续！");
			}
	    })
	 }
}
/**
 * 电话号码
 * @param valuevar 
 * @returns
 */
function istel(value){
    var Reg =/(^((0[1,2,3]{1}\d{1}-?\d{8})|(0[3-9]{1}\d{2}-?\d{7,8}))$)|(^0?(13[0-9]|15[0-35-9]|18[0236789]|14[57])[0-9]{8}$)/;
    return Reg.test(value);
}