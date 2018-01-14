$(document).ready(function(){
    //主内容  其他两个内容框
    //$(".content-box-header h3").css({ "cursor":"s-resize" }); // 改变鼠标样式
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
    $('.content-box ul.content-box-tabs-switch li a').click(
        function() {
            $(this).parent().parent().find("li").removeClass('active');
            $(this).parent().addClass('active');
            var currentTab = $(this).attr('href');
            $(currentTab).parent().find('.content-box-content').hide();  //另一个隐藏
            $(currentTab).show();    //选中的div显示
            return false;
        }
    );

    //提示框的 关闭
    /*$(".close").click(
        function () {
            $(this).parent().fadeTo(400, 0, function () {
                $(this).slideUp(400);
            });
            return false;
        }
    );*/

    // 全选
    $('.check-all').click(
        function(){
            $(this).parent().parent().parent().parent().find("input[type='checkbox']").attr('checked', $(this).is(':checked'));
            //改变选中行的背景色
            if($(this).is(':checked') == true){
                $('.tbody tr').addClass("row-select");
                //全选后 全部输入框背景色改变
                $('.tbody tr:odd .follow-input').removeClass("odd-input");
                $('.tbody tr .follow-input').addClass("follow-input-select");
            }else{
                $('.tbody tr').removeClass("row-select");
                //取消全选后 全部输入框背景色复原
                $('.tbody tr .follow-input').removeClass("follow-input-select");
                $('.tbody tr:odd .follow-input').addClass("odd-input");
            }
        }
    );

    //隔行换色
    $('.tbody .every-line:odd').addClass("alt-row");
    //基数行输入框背景色
    $('.tbody tr:odd').find('.follow-input').addClass("odd-input");
    //鼠标进入换色
    $('tbody tr').mouseover(function(){
        $(this).addClass('mouse-in');
        //鼠标进入tr行后输入框背景色改变
        $(this).find('.follow-input').removeClass("odd-input");
        $(this).find('.follow-input').addClass('follow-mouse-in');
    });
    $('tbody tr').mouseout(function(){
        $(this).removeClass('mouse-in');
        //鼠标一处tr行后输入框背景色复原
        $(this).find('.follow-input').removeClass('follow-mouse-in');
        //判断是否奇数行  如果是奇数行并且该行的复选框未被选中 则执行鼠标移除变色
        var index = $(this).index();
        var checked = $(this).find("input[type='checkbox']").is(':checked');
        if(index%2 != 0 && checked == false){
            $(this).find('.follow-input').addClass("odd-input");
        }
    });
    //选中行改变背景色
    $("input[type='checkbox']").click(function(){
        if($(this).is(':checked') == true){
            $(this).parent().parent().addClass("row-select");
            //点击tr行前的复选框选中  输入框改变背景色
            $(this).parent().parent().find('.follow-input').addClass("follow-input-select");
        }else{
            $(this).parent().parent().removeClass("row-select");
            //点击tr行前的复选取消框选中  输入框背景色复原
            $(this).parent().parent().find('.follow-input').removeClass("follow-input-select");
        }
    });
});
  
  
  