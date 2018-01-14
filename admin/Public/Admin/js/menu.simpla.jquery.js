$(document).ready(function(){
    /**************************  左边菜单下拉效果  ***********************/
        //隐藏所有菜单
    $("#left-menu li ul").hide();
    //默认选中的菜单  子菜单下拉出现
    $("#left-menu li a.active").parent().find("ul").slideToggle("fast");

    //点击顶菜单 子菜单下拉出现  未选中菜单隐藏
    $("#left-menu li a.nav-top-item").click(function(){
        //选中顶菜单标记为选中状态  未选中移除选中状态
        $(this).parent().siblings().find("a").removeClass('active');
        $(this).addClass('active');
        //上拉 下拉效果
        $(this).parent().siblings().find("ul").slideUp("fast");
        $(this).next().slideToggle("fast");
        return false;
    });
    //子菜单选中状态改变
    $("#left-menu li ul li a").click(function(){
        $(this).parent().siblings().find("a").removeClass('active');
        $(this).addClass('active');
    });
    //没有子菜单的顶菜单 点击效果
    $("#left-menu li a.no-submenu").click(function(){
        window.open(this.href,"main");
        return false;
    });
 });