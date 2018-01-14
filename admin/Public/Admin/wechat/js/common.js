$(document).ready(function(){
    //删除
    $('.delete-delete').click(function(){
        if(confirm('确认要执行删除操吗？')){
            window.location.href = $(this).next('input').val();
        }
    });
    //批量删除
    $('.delete-batch').click(function(){
        if(confirm('确认要执行批量删除操作吗？')){
            $('.batch-form').submit();
        }
    });
    //自定义页号跳转
    $('#go').click(function(){
        var p = $('#p').val();
        var url = $(this).next('input').val();
        var page_num = $('#page_num').val();
        if(page_num == ''){
            alert('请输入页号');return;
        }else{
            if(url.indexOf('/p/') == -1){
                url = url+'/p/'+page_num;
                window.location.href = url;
            }else{
                url = url.replace('/p/'+p,'/p/'+page_num);
                window.location.href = url;
            }
        }
    });
    //是否显示操作
    $('.is-show-operate').click(function(){
        var arr = $(this).next('input').val().split('||');
        ajaxIsShow(arr[0],arr[1],arr[2],this);
    });

    //浮动图片显示
    $('.pop').mouseover(function(){
        var top = 0, left = 0, obj = this;
        while (obj) {
            top = top + obj.offsetTop;
            left = left + obj.offsetLeft;
            obj = obj.offsetParent
        }
        $(this).next('.img-position').css('left',left+$(this).width()+20);
        $(this).next('.img-position').css('top',top-40);
        $(this).next('.img-position').fadeIn(300);
    });
    $('.pop').mouseout(function(){
        $(this).next('.img-position').fadeOut(300);
    });

    //浮动订单显示
    $('.order-pop').mouseover(function(){
        var top = 0, left = 0, obj = this;
        while (obj) {
            top = top + obj.offsetTop;
            left = left + obj.offsetLeft;
            obj = obj.offsetParent
        }
        $(this).find('.order-position').css('left',left+30);
        $(this).find('.order-position').css('top',top+15);
        //$(this).find('.order-position').fadeIn(100);
        $(this).find('.order-position').show();
    });
    $('.order-pop').mouseout(function(){
        //$(this).find('.order-position').fadeOut(100);
        $(this).find('.order-position').hide();
    });

    //排序只能添加数字
    $('.only-num').keyup(function(){
        this.value=this.value.replace(/[^\d]/g,'');
    });

    //输入框高亮
    $('form .text-input').focus(function(){
        $(this).css({"border":"1px solid #6CAF02"});
    });
    $('form .text-input').blur(function(){
        $(this).css({"border":"1px solid #d5d5d5"});
    });
    //刷新操作
    $('.reload').click(function(){
        window.location.reload();
    });
});
