$(document).ready(function(){
    //点击查询
    $('.search-btn').click(function(){
        if($('.search-input').val() == '' || $('.search-input').val() == '请输入商铺名称'){
            $('.search-input').focus();
            return;
        }else{
            $('.search-form').submit();
        }
    });
    //查询输入框获取焦点
    $('.search-input').focus(function(){
        if(this.value=='请输入商铺名称'){
            $('.search-input').css('color','black');
            this.value='';
        }
    });
    //选择分类
    $('.search-by-cate').change(function(){
        $('.search-form').submit();
    });

    //查询输入框失去焦点
    $('.search-input').blur(function(){
        if(this.value==''){
            $('.search-input').css('color','#cccccc');
            this.value='请输入商铺名称';
        }
    });

    //输入框失去焦点判空
    $('.text-input').blur(function(){
        if($(this).val() != ''){
            $(this).next('span').hide();
        }
    });

});