$(document).ready(function(){
    //主内容  其他两个内容框
    $(".content-box-header h3").css({ "cursor":"s-resize" }); // 改变鼠标样式
    $(".closed-box .content-box-content").hide(); // 隐藏内容框
    $(".closed-box .content-box-tabs").hide(); // 隐藏选择标签

    //内容框的收起与下拉
    /*$(".content-box-header h3").click(
        function () {
          $(this).parent().next().toggle();
          $(this).parent().parent().toggleClass("closed-box");
          $(this).parent().find(".content-box-tabs").toggle();
        }
    );*/

    // 默认的内容框显示 右侧标签选中状态
    $('.content-box .content-box-content div.tab-content').hide();
    $('ul.content-box-tabs li a.default-tab').addClass('current');
    $('.content-box-content div.default-tab').show();

    //内容框右侧切换标签
    $('.content-box ul.content-box-tabs li a').click(
        function() {
            $(this).parent().siblings().find("a").removeClass('current');
            $(this).addClass('current');
            var currentTab = $(this).attr('href');
            $(currentTab).siblings().hide();  //另一个隐藏
            $(currentTab).show();    //选中的div显示
            return false;
        }
    );

    //提示框的 关闭
    $(".close").click(
        function () {
            $(this).parent().fadeTo(400, 0, function () {
                $(this).slideUp(400);
            });
            return false;
        }
    );

    // 全选
    $('.check-all').click(
        function(){
            $(this).parent().parent().parent().parent().find("input[type='checkbox']").attr('checked', $(this).is(':checked'));
        }
    );
    //隔行换色
    $('tbody tr:even').addClass("alt-row");

    //弹出层
    //$('a[rel*=modal]').facebox();

    //$(".wysiwyg").wysiwyg();
});
  
  
  
