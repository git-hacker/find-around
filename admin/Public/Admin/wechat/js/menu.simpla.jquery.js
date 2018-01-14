$(document).ready(function(){
    //隐藏所有菜单
    $("#main-nav li ul").hide();
    //默认选中的菜单  子菜单下拉出现
    $("#main-nav li a.current").parent().find("ul").slideToggle("fast");

    //点击顶菜单 子菜单下拉出现  未选中菜单隐藏
    $("#main-nav li a.nav-top-item").click(
         function () {
         //选中顶菜单标记为选中状态  未选中移除选中状态
         $(this).parent().siblings().find("a").removeClass('current');
         $(this).addClass('current');
         //上拉 下拉效果
         $(this).parent().siblings().find("ul").slideUp("fast");
         $(this).next().slideToggle("fast");
         return false;
         }
     );
    //子菜单选中状态改变
    $("#main-nav li ul li a").click(function(){
        $(this).parent().siblings().find("a").removeClass('current');
        $(this).addClass('current');
     });
    //没有子菜单的顶菜单 点击效果
    $("#main-nav li a.no-submenu").click(
         function () {
         window.open(this.href,"main");
         return false;
         }
     );
    // 鼠标移动到顶菜单的效果
    $("#main-nav li .nav-top-item").hover(
         function () {
         $(this).stop().animate({ paddingRight: "25px" }, 200);
         },
         function () {
         $(this).stop().animate({ paddingRight: "15px" });
         }
     );
 });